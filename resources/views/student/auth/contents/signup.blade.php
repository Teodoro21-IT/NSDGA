@extends('student.layouts.auth')

@section('content')
<div class="mx-auto w-full max-w-sm">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Create Account</h2>
    <p class="mt-2 text-sm text-gray-500">Register with your student credentials to access the portal.</p>

    @if ($errors->any())
        <div class="mt-4 rounded-lg bg-red-50 p-4 text-sm text-red-600" role="alert">
            <span class="font-medium">Oops!</span> {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('student.signup.submit') }}" class="mt-8 space-y-5">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
            <div class="relative">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="{{ old('full_name') }}"
                    placeholder="Juan Della Cruz"
                    class="mt-1 block w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-3 text-sm focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                    required
                >
            </div>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <div class="relative">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="juandellacruz@gmail.com"
                    class="mt-1 block w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-3 text-sm focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                    required
                >
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    class="mt-1 block w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-10 text-sm focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                    required
                >
                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password')">
                    <svg id="password-eye" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
            <div class="relative">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="••••••••"
                    class="mt-1 block w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-10 text-sm focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                    required
                >
                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password_confirmation')">
                    <svg id="password_confirmation-eye" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Terms & Privacy -->
        <div class="flex items-start">
            <input
                type="checkbox"
                id="terms"
                name="terms"
                class="mt-1 h-4 w-4 rounded border-gray-300 text-[#800000] focus:ring-[#800000]"
                required
            >
            <label for="terms" class="ml-2 text-xs text-gray-600">
                I have read and agree to the <a href="#" class="font-semibold text-[#800000] hover:text-[#5a0000]">Terms of Service</a> and <a href="#" class="font-semibold text-[#800000] hover:text-[#5a0000]">Privacy Policy</a> of NSGA
            </label>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full rounded-lg bg-[#8b0000] px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-[#6b0000] transition-colors focus:outline-none focus:ring-2 focus:ring-[#800000] focus:ring-offset-2">
                Create Account →
            </button>
        </div>

        <!-- Sign In Link -->
        <p class="text-center text-sm text-gray-600">
            Already have an account? <a href="{{ route('student_login') }}" class="font-semibold text-[#800000] hover:text-[#5a0000]">Sign in</a>
        </p>
    </form>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 11-4.243-4.243m9.102 0a9.969 9.969 0 015.199 5.199m0 0a2.995 2.995 0 01-2.973 2.973m2.973-2.973a2.995 2.995 0 00-2.973-2.973m0 0a3 3 0 01-4.243-4.243m4.242 4.242L9.88 9.88" />`;
    } else {
        field.type = 'password';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    }
}
</script>
@endsection