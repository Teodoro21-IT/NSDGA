<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class StudentLoginController extends Controller
{
    private const OTP_SESSION_KEY = 'student_otp_account_id';

    public function showLogin()
    {
        return view('student.auth.contents.login');
    }

    public function showOtp(Request $request)
    {
        if (! $request->session()->has(self::OTP_SESSION_KEY)) {
            return redirect()->route('student_login')->withErrors([
                'login' => 'Please login first.',
            ]);
        }

        return view('student.auth.contents.otp');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => [
                'required',
                'string',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
                    $isLrn = preg_match('/^\d{12}$/', $value) === 1;

                    if (! $isEmail && ! $isLrn) {
                        $fail('Use a valid email address or a 12-digit LRN.');
                    }
                },
            ],
            'password' => ['required', 'string'],
        ]);

        $login = (string) $request->input('login');
        $student = StudentAccount::query()
            ->where('email', $login)
            ->orWhere('lrn', $login)
            ->first();

        if (! $student || ! Hash::check($request->input('password'), $student->password)) {
            return back()->withErrors([
                'login' => 'Invalid credentials.',
            ])->onlyInput('login');
        }

        if ($student->is_locked) {
            return back()->withErrors([
                'login' => 'This account has been locked. Please contact the administrator.',
            ])->onlyInput('login');
        }

        $otp = (string) random_int(100000, 999999);
        $student->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        try {
            Mail::to($student->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            \Log::error('Student OTP email failed: '.$e->getMessage());
        }

        $request->session()->regenerate();
        $request->session()->put(self::OTP_SESSION_KEY, $student->id);

        return redirect()->route('student.otp.view');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $studentId = $request->session()->get(self::OTP_SESSION_KEY);
        $student = StudentAccount::find($studentId);

        if (! $student) {
            return redirect()->route('student_login')->withErrors([
                'login' => 'Session expired. Please login again.',
            ]);
        }

        if ($student->is_locked) {
            $request->session()->forget(self::OTP_SESSION_KEY);

            return redirect()->route('student_login')->withErrors([
                'login' => 'This account has been locked. Please contact the administrator.',
            ]);
        }

        $otpExpired = ! $student->otp_expires_at || now()->isAfter($student->otp_expires_at);

        if ($student->otp_code !== $request->input('otp') || $otpExpired) {
            return back()->withErrors([
                'otp' => 'The code is invalid or has expired.',
            ]);
        }

        $student->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        $request->session()->forget(self::OTP_SESSION_KEY);
        $request->session()->put([
            'student_authenticated' => true,
            'student_account_id' => $student->id,
        ]);

        return redirect()->route('application');
    }

    public function resendOtp(Request $request)
    {
        $studentId = $request->session()->get(self::OTP_SESSION_KEY);
        $student = StudentAccount::find($studentId);

        if (! $student) {
            return redirect()->route('student_login')->withErrors([
                'login' => 'Session expired. Please login again.',
            ]);
        }

        if ($student->is_locked) {
            $request->session()->forget(self::OTP_SESSION_KEY);

            return redirect()->route('student_login')->withErrors([
                'login' => 'This account has been locked. Please contact the administrator.',
            ]);
        }

        $otp = (string) random_int(100000, 999999);
        $student->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        try {
            Mail::to($student->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            \Log::error('Student resend OTP email failed: '.$e->getMessage());
        }

        return back()->with('success', 'A new OTP has been sent to your email.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->forget([
            'student_authenticated',
            'student_account_id',
            self::OTP_SESSION_KEY,
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student_login');
    }
}
