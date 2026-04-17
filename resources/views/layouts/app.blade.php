<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Change Password</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#F3F4F6] min-h-screen flex text-slate-800">

    @include('components.registrar.registrar-sidebar')

    <main class="flex-1 flex flex-col min-h-screen">
        
        <header class="bg-white/90 backdrop-blur-sm border-b border-slate-200 p-5 flex justify-between items-center sticky top-0 z-50">
            <h2 class="text-lg font-bold tracking-tight text-slate-700">Change Password</h2>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-900 leading-none">{{ Auth::user()->user }}</p>
                    <p class="text-[10px] text-indigo-500 font-bold uppercase">System Officer</p>
                </div>
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                    <span class="text-white font-black text-xs">RG</span>
                </div>
            </div>
        </header>

        <div class="p-8 max-w-xl mx-auto w-full">
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                <h3 class="text-2xl font-black text-slate-900 mb-6">Update Your Password</h3>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-semibold text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-2xl font-semibold text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('registrar.password.update') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Current Password</label>
                        <input type="password" name="current_password"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400 text-sm" required>
                        @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">New Password</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400 text-sm" required>
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-400 text-sm" required>
                    </div>
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl text-xs uppercase tracking-widest transition shadow-lg shadow-indigo-200">
                        Update Password
                    </button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>