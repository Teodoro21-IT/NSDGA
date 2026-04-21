<?php

namespace App\Http\Controllers;

use App\Models\StudentDocument;
use App\Models\StudentEnrollmentForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentEnrollmentController extends Controller
{
    public function create()
    {
        $studentAccountId = session('student_account_id');

        $hasSubmittedEnrollment = $studentAccountId
            ? StudentEnrollmentForm::query()->where('student_account_id', $studentAccountId)->exists()
            : false;

        return view('student.contents.enrollment_form', [
            'hasSubmittedEnrollment' => $hasSubmittedEnrollment,
        ]);
    }

    public function store(Request $request)
    {
        $studentAccountId = $request->session()->get('student_account_id');

        if (! $studentAccountId) {
            return redirect()->route('student_login')->withErrors([
                'login' => 'Please login again to continue with enrollment.',
            ]);
        }

        if (StudentEnrollmentForm::query()->where('student_account_id', $studentAccountId)->exists()) {
            return redirect()->route('enrollment')->withErrors([
                'submit' => 'You have already submitted your enrollment form. Please wait while our registrar reviews your application.',
            ]);
        }

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'lrn' => ['required', 'digits:12', 'unique:student_enrollment_forms,lrn'],
            'sex' => ['required', 'in:male,female'],
            'age' => ['required', 'integer', 'min:1', 'max:99'],
            'date_of_birth' => ['required', 'date'],
            'birthplace' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'home_address' => ['required', 'string', 'max:1000'],
            'contact_number' => ['required', 'string', 'max:20'],
            'education_level' => ['required', 'in:elementary,highschool,seniorhigh'],
            'grade_level_applying_for' => ['required', 'string', 'max:100'],
            'school_year' => ['required', 'in:2024-2025,2025-2026,2027-2028'],
            'student_type' => ['required', 'in:new,transferee,returning'],
            'previous_school_attended' => ['nullable', 'string', 'max:255'],
            'course_strand_interested' => ['nullable', 'required_if:education_level,seniorhigh', 'string', 'max:255'],
            'last_grade_year_level_completed' => ['required', 'string', 'max:100'],
            'gwa' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'two_by_two_picture' => ['nullable', 'file', 'image', 'max:2048'],
            'report_card' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'form_137' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'psa_birth_certificate' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'good_moral' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ], [
            'school_year.in' => 'School year must be one of: 2024-2025, 2025-2026, or 2027-2028.',
        ]);

        try {
            DB::transaction(function () use ($request, $validated, $studentAccountId): void {
                $enrollment = StudentEnrollmentForm::create([
                    'student_account_id' => $studentAccountId,
                    'first_name' => $validated['first_name'],
                    'middle_name' => $validated['middle_name'] ?? null,
                    'last_name' => $validated['last_name'],
                    'lrn' => $validated['lrn'],
                    'sex' => $validated['sex'],
                    'age' => $validated['age'],
                    'date_of_birth' => $validated['date_of_birth'],
                    'birthplace' => $validated['birthplace'],
                    'nationality' => $validated['nationality'],
                    'home_address' => $validated['home_address'],
                    'contact_number' => $validated['contact_number'],
                    'education_level' => $validated['education_level'],
                    'grade_level_applying_for' => $validated['grade_level_applying_for'],
                    'school_year' => $validated['school_year'],
                    'student_type' => $validated['student_type'],
                    'previous_school_attended' => $validated['previous_school_attended'] ?? null,
                    'course_strand_interested' => $validated['course_strand_interested'] ?? null,
                    'last_grade_year_level_completed' => $validated['last_grade_year_level_completed'],
                    'gwa' => $validated['gwa'] ?? null,
                ]);

                $documentMap = [
                    'two_by_two_picture' => 'student_documents/two_by_two',
                    'report_card' => 'student_documents/report_cards',
                    'form_137' => 'student_documents/form_137',
                    'psa_birth_certificate' => 'student_documents/psa_birth_certificate',
                    'good_moral' => 'student_documents/good_moral',
                ];

                foreach ($documentMap as $documentType => $storagePath) {
                    $file = $request->file($documentType);
                    $storedPath = $file?->store($storagePath, 'public');

                    StudentDocument::create([
                        'student_enrollment_form_id' => $enrollment->id,
                        'document_type' => $documentType,
                        'document_status' => $storedPath ? 'under_review' : 'not_uploaded',
                        'document_path' => $storedPath,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->withErrors([
                'submit' => 'Unable to submit enrollment right now. Please try again.',
            ]);
        }

        return redirect()->route('enrollment')->with('success', 'Enrollment submitted successfully.');
    }

    public function documents(Request $request)
    {
        $studentAccountId = $request->session()->get('student_account_id');

        $enrollment = $studentAccountId
            ? StudentEnrollmentForm::query()->where('student_account_id', $studentAccountId)->first()
            : null;

        $documents = $enrollment
            ? $enrollment->documents()->orderBy('document_type')->get()
            : collect();

        return view('student.contents.documents', [
            'documents' => $documents,
        ]);
    }

    public function updateDocument(Request $request, StudentDocument $document)
    {
        $studentAccountId = $request->session()->get('student_account_id');

        $enrollmentId = $studentAccountId
            ? StudentEnrollmentForm::query()->where('student_account_id', $studentAccountId)->value('id')
            : null;

        if (! $enrollmentId || $document->student_enrollment_form_id !== $enrollmentId) {
            abort(403);
        }

        $validated = $request->validate([
            'document_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $storagePaths = [
            'two_by_two_picture' => 'student_documents/two_by_two',
            'report_card' => 'student_documents/report_cards',
            'form_137' => 'student_documents/form_137',
            'psa_birth_certificate' => 'student_documents/psa_birth_certificate',
            'good_moral' => 'student_documents/good_moral',
        ];

        $storagePath = $storagePaths[$document->document_type] ?? 'student_documents/others';

        if ($document->document_path) {
            Storage::disk('public')->delete($document->document_path);
        }

        $storedPath = $validated['document_file']->store($storagePath, 'public');

        $document->update([
            'document_path' => $storedPath,
            'document_status' => 'under_review',
        ]);

        return back()->with('success', 'Document uploaded successfully.');
    }

    public function destroyDocument(Request $request, StudentDocument $document)
    {
        $studentAccountId = $request->session()->get('student_account_id');

        $enrollmentId = $studentAccountId
            ? StudentEnrollmentForm::query()->where('student_account_id', $studentAccountId)->value('id')
            : null;

        if (! $enrollmentId || $document->student_enrollment_form_id !== $enrollmentId) {
            abort(403);
        }

        if ($document->document_path) {
            Storage::disk('public')->delete($document->document_path);
        }

        $document->update([
            'document_path' => null,
            'document_status' => 'not_uploaded',
        ]);

        return back()->with('success', 'Document removed successfully.');
    }

    public function updateProfile(Request $request)
    {
        $studentAccountId = $request->session()->get('student_account_id');

        $enrollment = $studentAccountId
            ? StudentEnrollmentForm::query()
                ->with('studentAccount')
                ->where('student_account_id', $studentAccountId)
                ->first()
            : null;

        if (! $enrollment || ! $enrollment->studentAccount) {
            abort(404);
        }

        $studentAccount = $enrollment->studentAccount;

        $validated = $request->validate([
            'contact_number' => ['required', 'string', 'max:20'],
            'email' => [
                'required',
                'email',
                Rule::unique('student_accounts', 'email')->ignore($studentAccount->id),
            ],
            'home_address' => ['required', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($validated, $enrollment, $studentAccount): void {
            $enrollment->update([
                'contact_number' => $validated['contact_number'],
                'home_address' => $validated['home_address'],
            ]);

            $studentAccount->update([
                'email' => $validated['email'],
            ]);
        });

        return back()->with('success', 'Profile updated successfully.');
    }
}
