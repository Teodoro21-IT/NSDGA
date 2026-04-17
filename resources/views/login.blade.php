<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>NSDGA | Login</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>


<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-[400px] animate-fade-in-up">
        <div class="text-center mb-8">
            
            <h1 class="text-4xl font-extrabold text-white tracking-tighter">NSDGA <span class="text-blue-400">.</span></h1>
            <p class="text-slate-400 text-sm mt-2 font-medium">School Management System</p>
        </div>

        <div class="glass rounded-3xl shadow-2xl overflow-hidden">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Welcome Back</h2>
                <p class="text-slate-500 text-sm mb-8">Please enter your details to sign in.</p>
<form action="{{ url('/login') }}" method="POST" class="space-y-6">
    
    @csrf

    {{-- Combined Error Display --}}
    @if($errors->any())
        <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-xl shadow-sm animate-pulse">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <p class="text-xs font-bold uppercase tracking-wide">
                    @if ($errors->has('throttle'))
                        Too many attempts!
                    @else
                        Login Failed
                    @endif
                </p>
            </div>
            <p class="mt-1 text-sm opacity-90">
                {{ $errors->first() }}
            </p>
        </div>
    @endif

    <div>
        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Username/Work_ID</label>
        <input type="text" name="user" required class="w-full px-4 py-3 bg-slate-100 border border-transparent rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all" placeholder="Enter your username">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-100 border border-transparent rounded-xl focus:bg-white focus:border-blue-500 outline-none transition-all" placeholder="••••••••">
    </div>

    <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-xl shadow-lg transition-all active:scale-[0.98]">
        Sign In
    </button>
</form>
            </div>
        </div>
    </div>
</body>
</html>