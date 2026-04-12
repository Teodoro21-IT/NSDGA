<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Change Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex text-slate-900">

    <x-admin.sidebar />

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="p-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Security Settings</h2>
                <p class="text-sm text-slate-500">Manage your account access and credentials</p>
            </div>
            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-12 flex justify-center items-start">
            <div class="w-full max-w-xl">
                <div class="glass-card rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-hidden">
                    
                    <div class="p-8 pb-0">
                        <h3 class="text-xl font-bold text-slate-800">Update Password</h3>
                        <p class="text-slate-500 text-sm mt-1">Please ensure your new password is secure.</p>
                    </div>

                    <div class="px-8 mt-6">
                        @if ($errors->any())
                            <div class="bg-red-50/50 border border-red-100 rounded-2xl p-4">
                                <ul class="text-red-600 text-xs font-medium space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-center gap-2">
                                            <span class="w-1 h-1 bg-red-400 rounded-full"></span>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="bg-emerald-50/50 border border-emerald-100 rounded-2xl p-4 flex items-center gap-3">
                                <div class="bg-emerald-500 rounded-full p-1">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="text-emerald-700 font-bold text-sm">{{ session('success') }}</p>
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('password.update') }}" class="p-8 space-y-5">
                        @csrf

                        <div class="space-y-2">
                            <label for="current_password" class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Current Password</label>
                            <input type="password" id="current_password" name="current_password" required
                                class="w-full p-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 placeholder:text-slate-300"
                                placeholder="••••••••">
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">New Password</label>
                            <input type="password" id="password" name="password" required
                                class="w-full p-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 placeholder:text-slate-300"
                                placeholder="••••••••">
                            <div class="flex items-center gap-2 mt-2 ml-1">
                                <div class="flex gap-1">
                                    <div class="h-1 w-4 bg-slate-200 rounded-full"></div>
                                    <div class="h-1 w-4 bg-slate-200 rounded-full"></div>
                                    <div class="h-1 w-4 bg-slate-200 rounded-full"></div>
                                </div>
                                <p class="text-[10px] text-slate-400 font-medium italic">Use 8+ characters with mixed case & numbers</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full p-4 bg-white/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-200 placeholder:text-slate-300"
                                placeholder="••••••••">
                        </div>

                        <div class="pt-6 flex flex-col sm:flex-row items-center gap-3">
                            <button type="submit" class="w-full sm:flex-1 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl text-sm font-bold shadow-lg shadow-blue-200 transition-all active:scale-[0.98]">
                                Save New Password
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl text-sm font-bold text-slate-500 hover:bg-slate-100 transition-all text-center">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
                
                <p class="text-center text-slate-400 text-xs mt-8">
                    &copy; {{ date('Y') }} NSDGA Security Protocol. All rights reserved.
                </p>
            </div>
        </div>
    </main>

</body>
</html>