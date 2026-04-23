<?php

namespace App\Http\Controllers;

use App\Models\StudentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentSignupController extends Controller
{
    /**
     * Display the student signup page.
     */
    public function showSignup()
    {
        return view('student.auth.contents.signup');
    }

    /**
     * Handle the student signup request.
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:student_accounts,email'],
            'password' => ['required', 'string', 'confirmed', Password::min(12)->mixedCase()->numbers()->symbols()],
        ]);

        StudentAccount::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_locked' => false,
        ]);

        return redirect()->route('student_login')->with('success', 'Your account has been created. Please log in.');
    }
}
