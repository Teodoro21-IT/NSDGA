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
     * Purpose: Provides high-level stats for the "Registrar Overview".
     * Logic: 
     * - Calculates enrollment growth between years.
     * - Fix: Count UNIQUE students for "Docs for Review" to match the Document Review Queue.
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
        
        // FIXED LOGIC: Counts unique students with pending docs so dashboard matches the queue
        $docsForReview = StudentDocument::whereIn('document_status', ['under_review', 'action_needed'])
            ->distinct('student_enrollment_form_id')
            ->count('student_enrollment_form_id'); 
        
        $newestApplications = StudentEnrollmentForm::where('student_type', 'new')
            ->latest()
            ->take(20)
            ->get();

        return view('registrar.registrar_dashboard', compact(
            'totalPending', 'docsForReview', 'urgentTasks', 'newestApplications',
            'thisYearSubmissions', 'lastYearSubmissions', 'growth'
        ));
    }

  /**
     * STUDENT APPLICATIONS LIST (With Filtering)
     * Purpose: Lists "New" applications and allows filtering by Grade Level and Date.
     * Logic: 
     * - Default: Shows all new applications.
     * - Grade Filter: Narrow results by Grade 1 - 12.
     * - Date Filter: If start_date is picked, shows that day. If end_date is also picked, shows the range.
     */
    public function applications(Request $request)
    {
        $query = StudentEnrollmentForm::with('documents')
            ->where('student_type', 'new');

        // 1. Filter by Grade Level (1-12)
        if ($request->filled('grade_level')) {
            $query->where('grade_level_applying_for', $request->grade_level);
        }

        // 2. Filter by Date Range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            // Converts input strings to Carbon objects for a precise range check
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        } 
        elseif ($request->filled('start_date')) {
            // If only one date is picked, show students from that specific day
            $query->whereDate('created_at', $request->start_date);
        }

        $newestApplications = $query->latest()->get();

        return view('registrar.application', compact('newestApplications'));
    }

    /**
     * SHOW APPLICATION (New Applicant Detail)
     * Purpose: Detailed view for a new applicant before enrollment.
     */
    public function showApplication($id)
    {
        $student = StudentEnrollmentForm::findOrFail($id);
        $documents = StudentDocument::where('student_enrollment_form_id', $id)->get();

        return view('registrar.applications_show', compact('student', 'documents'));
    }

    /**
     * SHOW ENROLLED STUDENT (Record View)
     * Purpose: Displays the full record of an already enrolled student.
     * Note: This fixes the "Method show does not exist" error.
     */
    public function show($id)
    {
        $student = StudentEnrollmentForm::findOrFail($id);
        $documents = StudentDocument::where('student_enrollment_form_id', $id)->get();

        // Checks if all required files are verified to show "Officially Enrolled" status
        $allVerified = $documents->isNotEmpty() && $documents->every(fn($doc) => $doc->document_status === 'verified');

        return view('registrar.student_record_view', compact('student', 'documents', 'allVerified'));
    }

    /**
     * DOCUMENT REVIEW QUEUE
     * Purpose: Grouped view of students with documents needing attention.
     * Logic: Only shows students with status 'under_review', 'action_needed', or 'not_uploaded'.
     */
    public function documentIndex() 
    {
        $documents = StudentDocument::with('studentEnrollmentForm')
            ->whereIn('document_status', ['under_review', 'action_needed', 'not_uploaded'])
            ->get()
            ->groupBy('student_enrollment_form_id'); 

        return view('registrar.documents_index', compact('documents'));
    }

    /**
     * UPDATE DOCUMENT STATUS
     * Purpose: Triggered by "Approve" or "Correct" buttons.
     * Fix: Ensure your routes file (web.php) uses name 'registrar.document.updateStatus'.
     */
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

    /**
     * ENROLL STUDENT
     * Purpose: Changes status to 'enrolled' and checks for missing documents.
     */
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

   public function studentRecords(Request $request)
{
    // Start with enrolled students and eager load documents
    $query = StudentEnrollmentForm::with(['documents'])
        ->where('student_type', 'enrolled');

    // 1. Search Logic: Search by Name or LRN
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'LIKE', "%{$search}%")
              ->orWhere('last_name', 'LIKE', "%{$search}%")
              ->orWhere('lrn', 'LIKE', "%{$search}%");
        });
    }

    // 2. Grade Filter Logic: 1 to 12
    if ($request->filled('grade_level')) {
        $query->where('grade_level_applying_for', $request->grade_level);
    }

    $enrolledStudents = $query->latest()->get();

    return view('registrar.student_record', compact('enrolledStudents'));
}

    /**
     * UPDATE NOTES
     * Purpose: Saves feedback for the student regarding their requirements.
     */
    public function updateNotes(Request $request, $id)
    {
        $request->validate(['notes' => 'required|string|max:500']);

        $student = StudentEnrollmentForm::findOrFail($id);
        $student->registrar_notes = $request->notes;
        $student->save();

        return back()->with('success', 'Notes updated successfully.');
    }
}