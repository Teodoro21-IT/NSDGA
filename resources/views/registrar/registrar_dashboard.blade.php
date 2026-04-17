<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Dashboard</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        .main-content { margin-left: 260px; } 
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen text-slate-800">
    
    {{-- Fixed Sidebar --}}
    @include('components.registrar.registrar-sidebar')

    <div class="main-content">
        {{-- Fixed Navbar --}}
        @include('components.registrar.registrar-navbar')

        <main class="p-8 pt-24">
            {{-- Header Section --}}
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Registrar Overview</h1>
                <p class="text-slate-500 font-semibold mt-1 uppercase text-xs tracking-[0.2em]">Academic Year 2026-2027</p>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-6">
                    <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a7 7 0 00-7 7v1h12v-1a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[42px] font-black text-slate-900 leading-none">1,284</p>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-2">Total Pending Applications</p>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-6">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"></path><path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[42px] font-black text-slate-900 leading-none">452</p>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-2">Documents for Review</p>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-6 relative overflow-hidden">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <p class="text-[42px] font-black text-slate-900 leading-none">55</p>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-2">Urgent Tasks</p>
                    </div>
                </div>
            </div>

            {{-- Newest Applications Table --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Newest Application</h2>
                <a href="#" class="text-[#7f0000] font-bold text-sm flex items-center gap-1 hover:underline">
                    View All Records 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest">Student Name</th>
                            <th class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest">Application ID No.</th>
                            <th class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-6 text-[11px] font-black text-slate-400 uppercase tracking-widest">Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6 font-bold text-slate-700 text-sm uppercase">Sean Andrei Amurao</td>
                            <td class="px-8 py-6 text-slate-500 font-medium text-sm">APP-2026-0001</td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 bg-[#E8F1A7] text-[#8A943E] text-[10px] font-black rounded-full uppercase tracking-widest">Pending Review</span>
                            </td>
                            <td class="px-8 py-6 text-slate-400 font-bold text-xs uppercase tracking-wider">April 15, 2026</td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6 font-bold text-slate-700 text-sm uppercase">Aliyah Thursday Francisco</td>
                            <td class="px-8 py-6 text-slate-500 font-medium text-sm">APP-2026-0002</td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 bg-[#A7F1BA] text-[#3E9452] text-[10px] font-black rounded-full uppercase tracking-widest">Approved</span>
                            </td>
                            <td class="px-8 py-6 text-slate-400 font-bold text-xs uppercase tracking-wider">April 15, 2026</td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6 font-bold text-slate-700 text-sm uppercase">Rafael Ryan Tilacas</td>
                            <td class="px-8 py-6 text-slate-500 font-medium text-sm">APP-2026-0003</td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 bg-[#F1A7A7] text-[#943E3E] text-[10px] font-black rounded-full uppercase tracking-widest">Needs Correction</span>
                            </td>
                            <td class="px-8 py-6 text-slate-400 font-bold text-xs uppercase tracking-wider">April 15, 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>