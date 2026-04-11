@extends('student.layouts.auth')

@section('content')
<div class="mx-auto w-full max-w-sm">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Student Portal Login</h2>
    <p class="mt-2 text-sm text-gray-500">Welcome back! Please enter your details.</p>

    @if ($errors->any())
        <div class="mt-4 rounded-lg bg-red-50 p-4 text-sm text-red-600" role="alert">
            <span class="font-medium">Oops!</span> {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('student.login.submit') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label for="login" class="block text-sm font-medium text-gray-700">Email or LRN number</label>
            <div class="relative mt-1">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    id="login" 
                    name="login" 
                    value="{{ old('login') }}"
                    placeholder="e.g. 136676090147"
                    class="block w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-3 text-sm placeholder-gray-400 focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                    required
                >
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative mt-1">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    placeholder="Enter password"
                    class="block w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-10 text-sm placeholder-gray-400 focus:border-[#800000] focus:outline-none focus:ring-1 focus:ring-[#800000]"
                    required
                >
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-[#800000] focus:ring-[#800000]">
                <span class="ml-2 text-sm text-gray-700">Remember me</span>
            </label>
            <a href="#" class="text-sm font-medium text-[#800000] hover:text-[#5a0000]">Forgot password?</a>
        </div>

        <div>
            <button type="submit" class="flex w-full justify-center rounded-lg bg-[#8b0000] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#6b0000] transition-colors focus:outline-none focus:ring-2 focus:ring-[#800000] focus:ring-offset-2">
                Sign In
            </button>
        </div>



        <p class="mt-8 text-center text-sm text-gray-600">
            Don't have an account yet? <a href="#" class="font-semibold text-[#800000] hover:text-[#5a0000]">Sign up</a>
        </p>
    </form>
</div>
@endsection