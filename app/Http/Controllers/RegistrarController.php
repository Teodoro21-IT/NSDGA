<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $totalPending = StudentEnrollmentForm::where('student_type', 'new')->count();
        
        $docsForReview = StudentDocument::whereIn('document_status', ['under_review', 'action_needed'])
            ->distinct('student_enrollment_form_id')
            ->count('student_enrollment_form_id'); 
        
        // Use with('documents') to prevent N+1 queries even on the preview list
        $newestApplications = StudentEnrollmentForm::with('documents')
            ->where('student_type', 'new')
            ->latest()
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
            ->where('student_type', 'new');

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
            $query->whereDate('created_at', $request->start_date);
        }

        // SCALING FIX: paginate(15) instead of get()
        $newestApplications = $query->latest()->paginate(15)->withQueryString();

        return view('registrar.application', compact('newestApplications'));
    }

    public function showApplication($id)
    {
        $student = StudentEnrollmentForm::with('documents')->findOrFail($id);
        $documents = $student->documents;

        return view('registrar.applications_show', compact('student', 'documents'));
    }

    public function show($id)
    {
        $student = StudentEnrollmentForm::with('documents')->findOrFail($id);
        $documents = $student->documents;

        $allVerified = $documents->isNotEmpty() && $documents->every(fn($doc) => $doc->document_status === 'verified');

        return view('registrar.student_record_view', compact('student', 'documents', 'allVerified'));
    }

    /**
     * DOCUMENT REVIEW QUEUE
     * Scaling fix: Grouping 1,000+ files can be slow; we now paginate by Student.
     */
    public function documentIndex(Request $request) 
    {
        // We query students WHO HAVE documents needing review
        $query = StudentEnrollmentForm::whereHas('documents', function($q) {
            $q->whereIn('document_status', ['under_review', 'action_needed']);
        })->with(['documents' => function($q) {
            $q->whereIn('document_status', ['under_review', 'action_needed']);
        }]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('last_name', 'LIKE', "%{$search}%");
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
        $student = StudentEnrollmentForm::findOrFail($id);
        
        $hasMissingDocs = StudentDocument::where('student_enrollment_form_id', $id)
            ->where('document_status', 'not_uploaded')
            ->exists();

        $student->student_type = 'enrolled'; 
        $student->save();

        return redirect()->route('registrar.student_records')
            ->with($hasMissingDocs ? 'warning' : 'success', 'Student enrollment status updated.');
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
        $request->validate(['notes' => 'required|string|max:500']);

        $student = StudentEnrollmentForm::findOrFail($id);
        $student->registrar_notes = $request->notes;
        $student->save();

        return back()->with('success', 'Notes updated successfully.');
    }
}