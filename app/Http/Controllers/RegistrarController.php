<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentEnrollmentForm;
use App\Models\StudentDocument;
use Carbon\Carbon;

class RegistrarController extends Controller
{
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
        $docsForReview = StudentDocument::where('document_status', 'under_review')->count(); 
        
        $newestApplications = StudentEnrollmentForm::where('student_type', 'new')
            ->latest()
            ->take(20)
            ->get();

        return view('registrar.registrar_dashboard', compact(
            'totalPending', 'docsForReview', 'urgentTasks', 'newestApplications',
            'thisYearSubmissions', 'lastYearSubmissions', 'growth'
        ));
    }

    public function applications()
    {
        $newestApplications = StudentEnrollmentForm::with('documents')
            ->where('student_type', 'new')
            ->latest()
            ->get();

        return view('registrar.application', compact('newestApplications'));
    }

    // NEW: Specifically directs to the applications_show view
    public function showApplication($id)
    {
        $student = StudentEnrollmentForm::findOrFail($id);
        $documents = StudentDocument::where('student_enrollment_form_id', $id)->get();

        return view('registrar.applications_show', compact('student', 'documents'));
    }

    public function show($id)
    {
        $student = StudentEnrollmentForm::findOrFail($id);
        $documents = StudentDocument::where('student_enrollment_form_id', $id)->get();

        $allVerified = $documents->isNotEmpty() && $documents->every(fn($doc) => $doc->document_status === 'verified');

        return view('registrar.student_record_view', compact('student', 'documents', 'allVerified'));
    }

    public function enrollStudent($id)
    {
        $student = StudentEnrollmentForm::findOrFail($id);
        
        $student->student_type = 'enrolled'; 
        $student->save();

        return redirect()->route('registrar.student_records')
            ->with('success', $student->first_name . ' has been officially enrolled!');
    }

    public function studentRecords()
    {
        $enrolledStudents = StudentEnrollmentForm::where('student_type', 'enrolled')
            ->latest()
            ->get();

        return view('registrar.student_record', compact('enrolledStudents'));
    }

    public function viewEnrolled($id)
    {
        $student = StudentEnrollmentForm::where('id', $id)
            ->where('student_type', 'enrolled')
            ->firstOrFail();

        $documents = StudentDocument::where('student_enrollment_form_id', $id)->get();

        return view('registrar.student_record_view', compact('student', 'documents'));
    }

    public function updateDocumentStatus(Request $request, $id)
    {
        $request->validate([
            'document_status' => 'required|in:verified,under_review,action_needed',
        ]);

        $document = StudentDocument::findOrFail($id);
        $document->document_status = $request->document_status;
        $document->save();

        return back()->with('success', 'Document status updated successfully.');
    }

    public function updateNotes(Request $request, $id)
    {
        $student = StudentEnrollmentForm::findOrFail($id);
        $student->registrar_notes = $request->notes;
        $student->save();

        return back()->with('success', 'Notes updated and student notified.');
    }

    public function documentIndex()
    {
        $documents = StudentDocument::with('studentEnrollmentForm')
            ->whereIn('document_status', ['under_review', 'action_needed'])
            ->get();

        return view('registrar.documents_index', compact('documents'));
    }
}