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
            {{-- UPDATED: Wrapped in a form to handle Grade and Date logic --}}
            <form action="{{ route('registrar.applications') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8">
                <div class="relative flex-1 min-w-[300px]">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student name or application ID..." 
                        class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#7f0000]/20 focus:border-[#7f0000] outline-none transition-all shadow-sm text-sm font-medium">
                </div>
                
                {{-- Grade Level Dropdown (1-12) --}}
                <div class="relative">
                    <select name="grade_level" onchange="this.form.submit()" 
                        class="appearance-none pl-11 pr-10 py-3 bg-white border border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm focus:outline-none focus:ring-2 focus:ring-[#7f0000]/20">
                        <option value="">All Grades</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="Grade {{ $i }}" {{ request('grade_level') == "Grade $i" ? 'selected' : '' }}>
                                Grade {{ $i }}
                            </option>
                        @endfor
                    </select>
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4.5h18m-18 9h18m-18 9h18" />
                        </svg>
                    </span>
                </div>

                {{-- Date Range Picker --}}
                <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-1.5 shadow-sm">
                    <div class="flex flex-col">
                        <label class="text-[9px] font-black uppercase text-slate-400 ml-1">From</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" onchange="this.form.submit()"
                            class="text-xs font-bold text-slate-600 focus:outline-none bg-transparent">
                    </div>
                    <div class="h-8 w-[1px] bg-slate-100 mx-2"></div>
                    <div class="flex flex-col">
                        <label class="text-[9px] font-black uppercase text-slate-400 ml-1">To</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" onchange="this.form.submit()"
                            class="text-xs font-bold text-slate-600 focus:outline-none bg-transparent">
                    </div>
                </div>

                @if(request()->anyFilled(['grade_level', 'start_date', 'end_date', 'search']))
                    <a href="{{ route('registrar.applications') }}" class="text-sm font-bold text-red-600 hover:text-red-700 transition px-2">
                        Reset Filters
                    </a>
                @endif
            </form>
            

            {{-- Table View --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Student Name</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Grade Level</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Application ID No.</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($newestApplications as $app)
                        <tr onclick="window.location='{{ route('registrar.show', $app->id) }}'" 
                            class="hover:bg-slate-50/80 cursor-pointer transition-colors group">
                            <td class="px-8 py-5">
                                <p class="font-bold text-slate-800 group-hover:text-[#7f0000] transition">{{ $app->first_name }} {{ $app->last_name }}</p>
                            </td>
                            {{-- Added Grade Level Column --}}
                            <td class="px-8 py-5 text-sm font-bold text-slate-600">
                                {{ $app->grade_level_applying_for }}
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
                            <td colspan="5" class="px-8 py-20 text-center">
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