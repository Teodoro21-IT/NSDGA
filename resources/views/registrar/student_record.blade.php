<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Student Records</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    @include('components.registrar.registrar-sidebar')
    
    <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
        @include('components.registrar.registrar-navbar')

        <div class="p-10 pt-24 w-full">
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-[32px] font-extrabold text-[#7f0000] tracking-tight">Enrolled Student Records</h1>
                    <p class="text-slate-500 font-medium">Archive of all officially enrolled students for the current academic year.</p>
                </div>
                <div class="px-4 py-2 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Total Enrolled</span>
                    <span class="text-xl font-bold text-slate-700">{{ $enrolledStudents->total() }}</span>
                </div>
            </div>
            
            {{-- Search & Filter Bar --}}
            <form action="{{ route('registrar.student_records') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-8">
                <div class="relative flex-1 min-w-[300px]">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or 12-digit LRN..." 
                        class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#7f0000]/20 outline-none transition-all text-sm font-medium">
                </div>
                
                <select name="grade_level" onchange="this.form.submit()" 
                    class="pl-6 pr-10 py-3 bg-white border border-slate-200 rounded-xl font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm focus:outline-none">
                    <option value="">All Grade Levels</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="grade {{ $i }}" {{ request('grade_level') == "grade $i" ? 'selected' : '' }}>
                            Grade {{ $i }}
                        </option>
                    @endfor
                </select>

                @if(request()->anyFilled(['search', 'grade_level']))
                    <a href="{{ route('registrar.student_records') }}" class="text-xs font-black text-red-600 uppercase tracking-tighter hover:underline">Clear</a>
                @endif
            </form>

            {{-- Records Table --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Learner Name</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">LRN</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Level</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Requirement Status</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($enrolledStudents as $student)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-8 py-5">
                                <p class="font-bold text-slate-800">{{ $student->last_name }}, {{ $student->first_name }}</p>
                                <p class="text-[10px] text-slate-400 font-medium">{{ $student->email ?? 'No Email Provided' }}</p>
                            </td>
                            <td class="px-8 py-5 text-sm font-mono text-slate-600 tracking-tight">
                                {{ $student->lrn }}
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-bold text-slate-600 uppercase">{{ $student->grade_level_applying_for }}</span>
                            </td>
                            <td class="px-8 py-5">
                                @php
                                    $allDone = $student->documents->where('document_status', 'verified')->count() == 5; // Assuming 5 required docs
                                @endphp
                                @if($allDone)
                                    <span class="flex items-center gap-1.5 text-green-600 text-[10px] font-black uppercase tracking-wide">
                                        <div class="h-1.5 w-1.5 rounded-full bg-green-500"></div> Complete
                                    </span>
                                @else
                                    <span class="flex items-center gap-1.5 text-orange-500 text-[10px] font-black uppercase tracking-wide">
                                        <div class="h-1.5 w-1.5 rounded-full bg-orange-400"></div> Lacking Docs
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <a href="{{ route('registrar.records.view', $student->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-[#7f0000] text-white text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-[#5a0000] transition shadow-md shadow-red-900/10">
                                    View Record
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p class="text-slate-400 font-medium uppercase text-[10px] tracking-[0.2em]">No enrolled students found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination Links --}}
                <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                    {{ $enrolledStudents->links() }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>