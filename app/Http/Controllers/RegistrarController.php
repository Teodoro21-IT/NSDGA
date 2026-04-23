<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use App\Models\StudentAcademicHistory;
use App\Models\StudentEnrollmentForm;
use App\Models\StudentDocument;
use Carbon\Carbon;

class RegistrarController extends Controller
{
    /**
     * DASHBOARD / INDEX
     * Handles 1,000 students by limiting data for the dashboard "preview".
     */
    public function index()
    {
        $tenDaysAgo = Carbon::now()->subDays(10);
        $currentYear = Carbon::now()->year;
        $lastYear = Carbon::now()->subYear()->year;

        $urgentTasks = StudentEnrollmentForm::where('created_at', '<=', $tenDaysAgo)
            ->where('student_type', '!=', 'enrolled') 
            ->count();

        $thisYearSubmissions = StudentEnrollmentForm::whereYear('created_at', $currentYear)->count();
        $lastYearSubmissions = StudentEnrollmentForm::whereYear('created_at', $lastYear)->count();

        $growth = 0;
        if ($lastYearSubmissions > 0) {
            $growth = (($thisYearSubmissions - $lastYearSubmissions) / $lastYearSubmissions) * 100;
        }

        $totalPending = StudentEnrollmentForm::where('student_type', '!=', 'enrolled')
            ->orWhereNull('student_type')
            ->count();
        
        $docsForReview = StudentDocument::whereIn('document_status', ['under_review', 'action_needed'])
            ->distinct('student_enrollment_form_id')
            ->count('student_enrollment_form_id'); 
        
        // Use with('documents') to prevent N+1 queries even on the preview list
        $newestApplications = StudentEnrollmentForm::with('documents')
            ->where(function ($query) {
                $query->where('student_type', '!=', 'enrolled')
                      ->orWhereNull('student_type');
            })
            ->latest('created_at')
            ->take(25) // Small limit for dashboard performance
            ->get();

        return view('registrar.registrar_dashboard', compact(
            'totalPending', 'docsForReview', 'urgentTasks', 'newestApplications',
            'thisYearSubmissions', 'lastYearSubmissions', 'growth'
        ));
    }

    /**
     * STUDENT APPLICATIONS LIST
     * Scaling fix: Added Pagination and Keyword Search
     */
    public function applications(Request $request)
    {
        $query = StudentEnrollmentForm::with('documents')
            ->where(function ($q) {
                $q->where('student_type', '!=', 'enrolled')
                  ->orWhereNull('student_type');
            });

        // 1. Search Logic
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('lrn', 'LIKE', "%{$search}%");
            });
        }

        // 2. Grade Filter
        if ($request->filled('grade_level')) {
            $query->where('grade_level_applying_for', $request->grade_level);
        }

        // 3. Date Filter
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // SCALING FIX: paginate(15) instead of get()
        $newestApplications = $query->latest()->paginate(15)->withQueryString();

        return view('registrar.application', compact('newestApplications'));
    }

    public function showApplication($id)
    {
        $student = StudentEnrollmentForm::with('documents')->findOrFail($id);
        $documents = $student->documents;
        $canEnroll = $documents->isNotEmpty() && $documents->every(fn($doc) => in_array($doc->document_status, ['verified', 'action_needed']));

        return view('registrar.applications_show', compact('student', 'documents', 'canEnroll'));
    }

    public function show($id)
    {
        $student = StudentEnrollmentForm::with(['documents', 'academicHistories'])->findOrFail($id);
        $documents = $student->documents;
        $academicHistories = $student->academicHistories;

        $allVerified = $documents->isNotEmpty() && $documents->every(fn($doc) => $doc->document_status === 'verified');
        $canEnroll = $documents->isNotEmpty() && $documents->every(fn($doc) => in_array($doc->document_status, ['verified', 'action_needed']));

        return view('registrar.student_record_view', compact('student', 'documents', 'allVerified', 'academicHistories', 'canEnroll'));
    }

    /**
     * DOCUMENT REVIEW QUEUE
     * Scaling fix: Grouping 1,000+ files can be slow; we now paginate by Student.
     */
    public function documentIndex(Request $request)
    {
        // Show all students who have uploaded documents, regardless of enrollment status.
        $query = StudentEnrollmentForm::whereHas('documents')
            ->with('documents');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('first_name', 'LIKE', "%{$search}%")
                  ->orWhereHas('documents', function ($q2) use ($search) {
                      $q2->where('document_type', 'LIKE', "%{$search}%");
                  });
            });
        }

        $documents = $query->latest()->paginate(10)->withQueryString();

        return view('registrar.documents_index', compact('documents'));
    }

    public function updateDocumentStatus(Request $request, $id)
    {
        $request->validate([
            'document_status' => 'required|in:verified,under_review,action_needed',
        ]);

        $document = StudentDocument::findOrFail($id);
        $document->document_status = $request->document_status;
        $document->save();

        return back()->with('success', 'Document status updated.');
    }

    public function enrollStudent($id)
    {
        $student = StudentEnrollmentForm::with('documents')->findOrFail($id);
        $documents = $student->documents;

        $canEnroll = $documents->isNotEmpty() && $documents->every(fn($doc) => in_array($doc->document_status, ['verified', 'action_needed']));

        if (! $canEnroll) {
            return redirect()->route('registrar.show', $id)
                ->with('warning', 'Student documents must be reviewed before enrollment.');
        }

        $student->student_type = 'enrolled';
        $student->save();

        if ($student->student_account_id) {
            StudentAcademicHistory::updateOrCreate(
                ['student_account_id' => $student->student_account_id],
                [
                    'status' => 'current',
                    'grade_lvl' => $student->grade_level_applying_for,
                    'previous_school_attended' => $student->previous_school_attended,
                    'school_year' => $student->school_year,
                ]
            );
        }

        return redirect()->route('registrar.student_records')
            ->with('success', 'Student enrollment status updated.');
    }

    /**
     * STUDENT RECORDS
     * Scaling fix: Pagination added to handle thousands of graduates/enrollees.
     */
    public function studentRecords(Request $request)
    {
        $query = StudentEnrollmentForm::with(['documents'])
            ->where('student_type', 'enrolled');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('lrn', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('grade_level')) {
            $query->where('grade_level_applying_for', $request->grade_level);
        }

        // SCALING FIX: Changed get() to paginate(20)
        $enrolledStudents = $query->latest()->paginate(20)->withQueryString();

        return view('registrar.student_record', compact('enrolledStudents'));
    }

    public function updateNotes(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'announcement_text' => 'required|string|max:1000',
        ]);

        $student = StudentEnrollmentForm::with('studentAccount')->findOrFail($id);
        $studentAccount = $student->studentAccount;

        if (! $studentAccount) {
            return back()->withErrors(['student' => 'Student account not linked.']);
        }

        $announcement = Announcement::create([
            'title' => $request->title,
            'announcement_text' => $request->announcement_text,
            'urgency_level' => 'informational',
            'registrar_account_id' => Auth::id(),
        ]);

        DB::table('announcement_student_accounts')->updateOrInsert([
            'announcement_id' => $announcement->id,
            'student_account_id' => $studentAccount->id,
        ], [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Announcement sent to student.');
    }
}