<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Manage Students</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 min-h-screen flex text-slate-900">
    <x-admin.sidebar />
    
        <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
       @include('components.admin.admin_navbar')

        <div class="p-10 pt-24 w-full">
            {{-- Header Section --}}
            <div class="mb-8">
                <h1 class="text-[32px] font-extrabold text-[#7f0000] tracking-tight">Manage Students</h1>
                <p class="text-slate-500 font-medium">Manage and review student applications for Academic Year 2026-2027.</p>
            </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Total Students</p>
                    <h3 class="text-2xl font-black text-slate-800">1,240</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Pending Enrollment</p>
                    <h3 class="text-2xl font-black text-amber-500">45</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Active Academic Year</p>
                    <h3 class="text-2xl font-black text-blue-600">2026-2027</h3>
                </div>
            </div>

            <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h3 class="font-bold text-slate-800 text-lg">Master List</h3>
        <p class="text-slate-400 text-xs">Manage and monitor student enrollments for SY 2026-2027</p>
    </div>

    <form action="{{ route('admin.students') }}" method="GET" class="flex items-center gap-2 w-full md:w-auto">
        <div class="relative w-full md:w-72">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Search by ID or Name..." 
                class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-slate-50 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200"
            >
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-md shadow-blue-200 transition-all active:scale-95">
            Filter
        </button>
        @if(request('search'))
            <a href="{{ route('admin.students') }}" class="p-2 text-slate-400 hover:text-red-500 transition-colors" title="Clear Search">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </a>
        @endif
    </form>
</div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="p-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Student ID</th>
                            <th class="p-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Full Name</th>
                            <th class="p-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Grade Level</th>
                            <th class="p-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="p-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 text-sm font-medium text-slate-600">STU-2026-0001</td>
                            <td class="p-4">
                                <p class="text-sm font-bold text-slate-800">Juan Dela Cruz</p>
                                <p class="text-[11px] text-slate-400">juan.dela@example.com</p>
                            </td>
                            <td class="p-4 text-sm text-slate-600">Grade 11 - STEM</td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase">Enrolled</span>
                            </td>
                            <td class="p-4 text-right">
                                <button class="text-blue-500 hover:text-blue-700 mx-2">View</button>
                                <button class="text-slate-400 hover:text-slate-600 mx-2">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>