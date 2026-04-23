<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Registrar Portal</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-overlay {
            background: linear-gradient(rgba(127, 0, 0, 0.75), rgba(127, 0, 0, 0.75));
        }
    </style>
</head>
<body class="bg-white min-h-screen flex overflow-hidden">

    <div class="hidden lg:flex lg:w-1/2 relative items-center justify-center">
        <img src="{{ asset('images/campuslogin3.png') }}" class="absolute inset-0 w-full h-full object-cover" alt="Academy Facade">
        <div class="absolute inset-0 hero-overlay"></div>
        
        <div class="relative z-10 text-center p-12">
            <img src="{{ asset('images/logo.png') }}" class="w-32 h-32 mx-auto mb-8 shadow-2xl rounded-full border-4 border-white/20" alt="NSDGA Logo">
            <h1 class="text-5xl font-extrabold text-white tracking-tight leading-tight">
                Nuestra Señora de Guia <br> Academy
            </h1>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-[480px]">
            
            <div class="mb-10">
                <p class="text-[11px] font-black text-[#7f0000] uppercase tracking-[0.2em] mb-2"> </p>
                <h2 class="text-[44px] font-extrabold text-slate-900 tracking-tight leading-none mb-4">Secure Access</h2>
                <p class="text-slate-500 font-medium text-base">Welcome back. Please authenticate to access the registrar dashboard.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Combined Error Display --}}
                @if($errors->any())
                    <div class="p-4 bg-red-50 border border-red-100 text-red-700 rounded-2xl animate-fade-in">
                        <p class="text-xs font-bold uppercase tracking-widest mb-1">Authentication Error</p>
                        <p class="text-sm opacity-90">{{ $errors->first() }}</p>
                    </div>
                @endif

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Username</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        <input type="text" name="user" required 
                            class="w-full pl-12 pr-4 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#7f0000] transition-all outline-none font-medium text-slate-700 placeholder:text-slate-400" 
                            placeholder="juandelacruz">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Password</label>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </span>
                        <input type="password" name="password" required 
                            class="w-full pl-12 pr-4 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#7f0000] transition-all outline-none font-medium text-slate-700 placeholder:text-slate-400" 
                            placeholder="••••••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" class="w-5 h-5 rounded border-slate-300 text-[#7f0000] focus:ring-[#7f0000]">
                        <span class="text-sm font-semibold text-slate-500 group-hover:text-slate-700 transition">Remember me</span>
                    </label>
                    <a href="#" class="text-sm font-bold text-[#7f0000] hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="w-full bg-[#7f0000] hover:bg-[#600000] text-white font-bold py-5 rounded-2xl shadow-xl shadow-maroon-100 transition-all active:scale-[0.98] flex items-center justify-center gap-3">
                    <span class="uppercase tracking-widest text-xs">Sign In</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

        </div>
    </div>
</body>
</html>