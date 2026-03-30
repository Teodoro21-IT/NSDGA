<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Registrar Portal</title>
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
            <a href="#" class="flex items-center space-x-3 p-3 rounded-xl bg-indigo-600 text-white font-semibold shadow-lg shadow-indigo-900/20 transition">
                <span class="text-lg">📋</span>
                <span>Enrollment</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition">
                <span class="text-lg">📂</span>
                <span>Student Files</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition">
                <span class="text-lg">📑</span>
                <span>Certifications</span>
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
            <h2 class="text-lg font-bold tracking-tight text-slate-700">Registrar Control Center</h2>
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

        <div class="p-8 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Students</p>
                    <h3 class="text-3xl font-black text-slate-800">1,402</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">New Enrollees</p>
                    <h3 class="text-3xl font-black text-indigo-600">84</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Pending TOR</p>
                    <h3 class="text-3xl font-black text-amber-500">12</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Completion Rate</p>
                    <h3 class="text-3xl font-black text-emerald-500">94%</h3>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                    <div class="text-center md:text-left">
                        <h3 class="text-3xl font-black text-slate-900 mb-2 leading-none">Manage School Records</h3>
                        <p class="text-slate-500 text-sm max-w-md mb-6 font-medium">Madali mo nang ma-a-access ang mga forms at transcripts ng mga estudyante gamit ang portal na ito.</p>
                        <div class="flex space-x-3">
                            <button class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold text-xs uppercase tracking-widest transition hover:bg-indigo-600 shadow-xl shadow-slate-200">View All Files</button>
                            <button class="bg-indigo-50 text-indigo-600 px-6 py-3 rounded-2xl font-bold text-xs uppercase tracking-widest transition hover:bg-indigo-100 border border-indigo-100">Generate Report</button>
                        </div>
                    </div>
                    <div class="mt-8 md:mt-0 opacity-10">
                        <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>