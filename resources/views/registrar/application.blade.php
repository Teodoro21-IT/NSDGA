<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Applications</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
    </style>
</head>

<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    {{-- Fixed Sidebar --}}
    @include('components.registrar.registrar-sidebar')
    
    <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
        @include('components.registrar.registrar-navbar')

        <div class="p-10 pt-24 w-full">
            {{-- Header Section --}}
            <div class="mb-8">
                <h1 class="text-[32px] font-extrabold text-[#7f0000] tracking-tight">Student Applications</h1>
                <p class="text-slate-500 font-medium">Manage and review incoming admissions for Academic Year 2026-2027.</p>
            </div>
            
            {{-- Search & Filter Controls --}}
            <div class="flex flex-wrap items-center gap-4 mb-8">
                <div class="relative flex-1 min-w-[300px]">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Search by student name or application ID..." 
                        class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#7f0000]/20 focus:border-[#7f0000] outline-none transition-all shadow-sm">
                </div>
                
                <button class="flex items-center gap-2 px-5 py-3 bg-white border border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4.5h18m-18 9h18m-18 9h18" />
                    </svg>
                    Filter by Status
                </button>

                <button class="flex items-center gap-2 px-5 py-3 bg-white border border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Date Range
                </button>
            </div>

            {{-- Table View --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Student Name</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Application ID No.</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($newestApplications as $app)
                        {{-- UPDATED: Redirects to the show page instead of opening a modal --}}
                        <tr onclick="window.location='{{ route('registrar.show', $app->id) }}'" 
                            class="hover:bg-slate-50/80 cursor-pointer transition-colors group">
                            <td class="px-8 py-5">
                                <p class="font-bold text-slate-800 group-hover:text-[#7f0000] transition">{{ $app->first_name }} {{ $app->last_name }}</p>
                            </td>
                            <td class="px-8 py-5 text-sm font-medium text-slate-500 tracking-tight">
                                APP-2026-{{ str_pad($app->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-yellow-100 text-yellow-700">
                                    Pending Review
                                </span>
                            </td>
                            <td class="px-8 py-5 text-sm font-medium text-slate-500">
                                {{ $app->created_at->format('F d, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <p class="text-slate-400 font-medium">No pending applications found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>