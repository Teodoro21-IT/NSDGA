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

    <aside class="w-64 bg-slate-900 text-white hidden md:flex flex-col sticky top-0 h-screen shadow-2xl">
        <div class="p-8">
            <h1 class="text-2xl font-black tracking-tighter text-white">NSDGA<span class="text-indigo-400">.</span></h1>
            <p class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest mt-1">Registrar Office</p>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ route('registrar_dashboard') }}"
                class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition">
                <span class="text-lg">📋</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('registrar.password.show') }}"
                class="flex items-center space-x-3 p-3 rounded-xl bg-indigo-600 text-white font-semibold shadow-lg transition">
                <span class="text-lg">🔒</span>
                <span>Settings</span>
            </a>
        </nav>

        <div class="p-6 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 p-3 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl transition-all font-bold text-xs uppercase tracking-widest">
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1">
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

        <div class="p-8 max-w-xl mx-auto">
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