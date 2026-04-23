@extends('student.layouts.auth')

@section('content')
<div class="mx-auto w-full max-w-sm">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Create Account</h2>
    <p class="mt-1 text-sm text-gray-500">Register with your student credentials to access the portal.</p>

    @if ($errors->any())
        <div class="mt-3 rounded-lg bg-red-50 p-3 text-sm text-red-600" role="alert">
            <span class="font-medium">Oops!</span> {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('student.signup.submit') }}" class="mt-6 space-y-3">
    @csrf

    <!-- Full Name -->
    <div>
        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
        <div class="relative">
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                placeholder="Juan Dela Cruz"
                class="block w-full rounded-lg border border-gray-300 py-2 pl-10 pr-3 text-sm focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                required>
        </div>
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <div class="relative">
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                placeholder="juandelacruz@gmail.com"
                class="block w-full rounded-lg border border-gray-300 py-2 pl-10 pr-3 text-sm focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                required>
        </div>
    </div>

    <!-- Password -->
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <div class="relative">
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <input type="password" id="password" name="password" placeholder="••••••••"
                class="block w-full rounded-lg border border-gray-300 py-2 pl-10 pr-10 text-sm focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                required oninput="validatePasswordRules()">
            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password')">
                <svg id="password-eye" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>

        {{-- Dynamic password rules box --}}
        <div id="password-rules-box" class="hidden mt-2 rounded-lg border border-red-100 bg-red-50 p-3">
            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Password must include:</p>
            <ul class="space-y-1">
                <li id="rule-length"    class="hidden items-center gap-2 text-xs text-red-500"><svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>12+ characters</li>
                <li id="rule-mixedcase" class="hidden items-center gap-2 text-xs text-red-500"><svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>Uppercase &amp; lowercase letters</li>
                <li id="rule-number"    class="hidden items-center gap-2 text-xs text-red-500"><svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>At least one number</li>
                <li id="rule-special"   class="hidden items-center gap-2 text-xs text-red-500"><svg class="h-3.5 w-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>At least one special character</li>
            </ul>
        </div>
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <div class="relative">
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••"
                class="block w-full rounded-lg border border-gray-300 py-2 pl-10 pr-10 text-sm focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                required>
            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password_confirmation')">
                <svg id="password_confirmation-eye" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Terms & Privacy -->
    <div class="flex items-start gap-2 pt-1">
        <input type="checkbox" id="terms" name="terms"
            class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#800000] focus:ring-[#800000]" required>
        <label for="terms" class="text-xs text-gray-600">
            I have read and agree to the
            <a href="#" class="font-semibold text-[#800000] hover:text-[#5a0000]">Terms of Service</a> and
            <a href="#" class="font-semibold text-[#800000] hover:text-[#5a0000]">Privacy Policy</a> of NSGA
        </label>
    </div>

    <!-- Submit -->
    <div class="pt-1">
        <button type="submit" class="w-full rounded-lg bg-[#8b0000] px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-[#6b0000] transition-colors focus:outline-none focus:ring-2 focus:ring-[#800000] focus:ring-offset-2">
            Create Account →
        </button>
    </div>

    <p class="text-center text-sm text-gray-600">
        Already have an account? <a href="{{ route('student_login') }}" class="font-semibold text-[#800000] hover:text-[#5a0000]">Sign in</a>
    </p>
</form>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon  = document.getElementById(fieldId + '-eye');
    if (field.type === 'password') {
        field.type = 'text';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 11-4.243-4.243M9.88 9.88l4.242 4.242M3 3l18 18" />`;
    } else {
        field.type = 'password';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    }
}

function validatePasswordRules() {
    const password = document.getElementById('password').value;
    const box = document.getElementById('password-rules-box');

    const rules = [
        { id: 'rule-length',    passed: password.length >= 12 },
        { id: 'rule-mixedcase', passed: /[a-z]/.test(password) && /[A-Z]/.test(password) },
        { id: 'rule-number',    passed: /\d/.test(password) },
        { id: 'rule-special',   passed: /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>\/?`~]/.test(password) },
    ];

    // Only run checks once the user has started typing
    if (password.length === 0) {
        box.classList.add('hidden');
        rules.forEach(({ id }) => document.getElementById(id).classList.replace('flex', 'hidden'));
        return;
    }

    const anyFailing = rules.some(r => !r.passed);
    box.classList.toggle('hidden', !anyFailing);

    rules.forEach(({ id, passed }) => {
        const el = document.getElementById(id);
        if (passed) {
            el.classList.remove('flex');
            el.classList.add('hidden');
        } else {
            el.classList.remove('hidden');
            el.classList.add('flex');
        }
    });
}
</script>
@endsection