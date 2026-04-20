<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\StudentEnrollmentController;
use App\Models\StudentEnrollmentForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\User;
use App\Models\AuditLog;
use App\Http\Controllers\PasswordController;
use App\Http\Middleware\RegistrarMiddleware;
use App\Http\Controllers\RegistrarController;


// --- Public Access ---
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');

//student public accwess
Route::get('/student/login', [StudentLoginController::class, 'showLogin'])->name('student_login');
Route::post('/student/login', [StudentLoginController::class, 'login'])->name('student.login.submit');

// --- OTP Verification (Guest/Authenticated) ---
Route::get('/verify-otp', function () { return view('auth.verify-otp'); })->name('otp.view');
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify')->middleware('throttle:3,1');
Route::post('/resend-otp', [LoginController::class, 'resendOtp'])->name('otp.resend')->middleware('throttle:2,1');

//student otp
Route::get('/student/verify-otp', [StudentLoginController::class, 'showOtp'])->name('student.otp.view');
Route::post('/student/verify-otp', [StudentLoginController::class, 'verifyOtp'])
    ->name('student.otp.verify')
    ->middleware('throttle:3,1');
Route::post('/student/resend-otp', [StudentLoginController::class, 'resendOtp'])
    ->name('student.otp.resend')
    ->middleware('throttle:2,1');

// --- Protected Routes (Requires Login) ---
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // --- ADMIN ONLY ROUTES ---
    // Uses the 'admin' alias you created in app.php
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        
        // Dashboard
        Route::get('/dashboard', function () {
            $accounts = User::all();
            $logs = AuditLog::with('user')->latest()->take(5)->get();
            return view('admin.manage_accounts', compact('accounts', 'logs'));
        })->name('admin.dashboard');

        // Account Management
        Route::post('/store', [LoginController::class, 'store'])->name('admin.store');
        Route::get('/edit/{id}', [LoginController::class, 'edit'])->name('admin.edit');
        Route::put('/update/{id}', [LoginController::class, 'update'])->name('admin.update');
        Route::delete('/delete/{id}', [LoginController::class, 'destroy'])->name('admin.delete');
        Route::post('/accounts/{id}/toggle-lock', [LoginController::class, 'toggleLock'])->name('accounts.toggleLock');

        // Admin Content
        Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
        Route::get('/events/create', [AdminController::class, 'createEvent'])->name('admin.events.create');
        Route::post('/events/store', [AdminController::class, 'storeEvent'])->name('admin.events.store');       
        Route::get('/change-password', [PasswordController::class, 'show'])->name('password.show');
        Route::post('/change-password', [PasswordController::class, 'update'])->name('password.update');

    });

  // --- REGISTRAR ONLY ROUTES ---
Route::middleware(['auth', 'registrar'])->prefix('registrar')->group(function () {
    
   Route::get('/dashboard', [RegistrarController::class, 'index'])->name('registrar_dashboard');

    
    // New Sidebar Routes
    Route::get('/registrar/applications', function () {
        return view('registrar.application');
    })->name('registrar.applications');

    Route::get('/registrar/documents', function () {
        return view('registrar.documents');
    })->name('registrar.documents');

    Route::get('/registrar/student-records', function () {
        return view('registrar.student_record');
    })->name('registrar.student_records');

    Route::get('/registrar/profile', function () {
        return view('registrar.my_profile');
    })->name('registrar.profile');
    
    Route::get('/change-password', [PasswordController::class, 'showRegistrar'])
        ->name('registrar.password.show');
    
    Route::post('/change-password', [PasswordController::class, 'updateRegistrar'])
        ->name('registrar.password.update');

    

});

Route::middleware(['student'])->group(function () {

// para sa ano to sah, for routing lang ng mga pages sah hheheehehe

    Route::get('/student/dashboard', function () {
        return view('student.contents.student_dashboard');
    })->name('student_dashboard');
     Route::get('/student/application', function (Request $request) {
        $studentAccountId = $request->session()->get('student_account_id');

        $enrollment = $studentAccountId
            ? StudentEnrollmentForm::query()
                ->with(['documents', 'studentAccount'])
                ->where('student_account_id', $studentAccountId)
                ->first()
            : null;

        $documents = $enrollment?->documents ?? collect();
        $requiredDocumentTypes = [
            'two_by_two_picture',
            'report_card',
            'form_137',
            'psa_birth_certificate',
            'good_moral',
        ];

        $documentsComplete = $enrollment
            ? collect($requiredDocumentTypes)->every(function (string $type) use ($documents): bool {
                return (bool) $documents->firstWhere('document_type', $type)?->document_path;
            })
            : false;

        $studentName = $enrollment
            ? trim(implode(' ', array_filter([
                $enrollment->first_name,
                $enrollment->middle_name,
                $enrollment->last_name,
            ])))
            : ($enrollment?->studentAccount?->full_name ?? 'Student');

        $submittedAt = $enrollment?->created_at;
        $documentsUpdatedAt = $documents->whereNotNull('document_path')->max('updated_at');

        return view('student.contents.application', [
            'enrollment' => $enrollment,
            'documentsComplete' => $documentsComplete,
            'studentName' => $studentName,
            'submittedAt' => $submittedAt,
            'documentsUpdatedAt' => $documentsUpdatedAt,
        ]);
    })->name('application');
    
    Route::get('/student/enrollment', [StudentEnrollmentController::class, 'create'])->name('enrollment');
    Route::post('/student/enrollment', [StudentEnrollmentController::class, 'store'])->name('student.enrollment.store');
    
    Route::get('/student/documents', [StudentEnrollmentController::class, 'documents'])->name('documents');
    Route::post('/student/documents/{document}', [StudentEnrollmentController::class, 'updateDocument'])
        ->name('student.documents.update');
    Route::delete('/student/documents/{document}', [StudentEnrollmentController::class, 'destroyDocument'])
        ->name('student.documents.destroy');

    Route::get('/student/notification', function (Request $request) {
        $studentAccountId = $request->session()->get('student_account_id');

        if (!$studentAccountId) {
            return view('student.contents.notification', [
                'todayAnnouncements' => collect(),
                'yesterdayAnnouncements' => collect(),
            ]);
        }

        $todayDate = now()->toDateString();

        $baseQuery = DB::table('announcements')
            ->join(
                'announcement_student_accounts',
                'announcements.id',
                '=',
                'announcement_student_accounts.announcement_id'
            )
            ->where('announcement_student_accounts.student_account_id', $studentAccountId)
            ->select('announcements.*')
            ->orderByDesc('announcements.created_at');

        $todayAnnouncements = (clone $baseQuery)
            ->whereDate('announcements.created_at', $todayDate)
            ->get();

        $yesterdayAnnouncements = (clone $baseQuery)
            ->whereDate('announcements.created_at', '<', $todayDate)
            ->get();

        return view('student.contents.notification', [
            'todayAnnouncements' => $todayAnnouncements,
            'yesterdayAnnouncements' => $yesterdayAnnouncements,
        ]);
    })->name('notification');
    Route::get('/student/profile', function (Request $request) {
        $studentAccountId = $request->session()->get('student_account_id');

        $enrollment = $studentAccountId
            ? StudentEnrollmentForm::query()
                ->with(['documents', 'studentAccount'])
                ->where('student_account_id', $studentAccountId)
                ->first()
            : null;

        $profilePhotoPath = $enrollment?->documents
            ?->firstWhere('document_type', 'two_by_two_picture')
            ?->document_path;

        return view('student.contents.profile', [
            'enrollment' => $enrollment,
            'profilePhotoPath' => $profilePhotoPath,
            'studentEmail' => $enrollment?->studentAccount?->email,
        ]);
    })->name('profile');

    Route::post('/student/profile', [StudentEnrollmentController::class, 'updateProfile'])
        ->name('student.profile.update');

    Route::post('/student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');
    
});

});