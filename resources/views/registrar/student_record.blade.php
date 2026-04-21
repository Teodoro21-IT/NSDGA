<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records | NSDGA</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    @include('components.registrar.registrar-sidebar')
    
    <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
        @include('components.registrar.registrar-navbar')

        <div class="p-10 pt-24 w-full max-w-7xl mx-auto">
            {{-- Updated Header & Filter Section --}}
            <div class="flex flex-wrap justify-between items-end mb-10 gap-4">
                <div>
                    <h1 class="text-[32px] font-black text-slate-900 tracking-tight leading-none">Student Records</h1>
                    <p class="text-slate-400 font-bold mt-2 text-sm uppercase tracking-wider">Official Registry of Enrolled Students</p>
                </div>
                
                {{-- Filter Form --}}
                <form action="{{ route('registrar.student_records') }}" method="GET" class="flex items-center gap-3">
                    {{-- Grade Level Filter --}}
                    <select name="grade_level" onchange="this.form.submit()" 
                        class="pl-4 pr-10 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-[#7f0000]/10 outline-none transition text-xs font-black uppercase tracking-wider text-slate-500">
                        <option value="">All Levels</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="Grade {{ $i }}" {{ request('grade_level') == "Grade $i" ? 'selected' : '' }}>
                                Grade {{ $i }}
                            </option>
                        @endfor
                    </select>

                    {{-- Search Bar --}}
                    <div class="relative w-80">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by LRN or Name..." 
                            class="w-full pl-12 pr-4 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-[#7f0000]/10 outline-none transition text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    @if(request()->anyFilled(['search', 'grade_level']))
                        <a href="{{ route('registrar.student_records') }}" class="text-xs font-black text-red-500 uppercase tracking-widest hover:text-red-700 ml-2">Clear</a>
                    @endif
                </form>
            </div>

            <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Student Name</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">LRN</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Level</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Enrollment Date</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($enrolledStudents as $student)
                        <tr class="hover:bg-slate-50/30 transition-colors group">
                            <td class="px-8 py-6">
                                <p class="font-black text-slate-800 text-sm uppercase">{{ $student->first_name }} {{ $student->last_name }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase mt-0.5">{{ $student->email }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="font-mono text-xs font-bold text-slate-500">{{ $student->lrn ?? 'N/A' }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-black rounded-lg uppercase italic">{{ $student->grade_level_applying_for }}</span>
                            </td>
                            <td class="px-8 py-6 text-sm font-bold text-slate-500">
                                {{ $student->updated_at->format('M d, Y') }}
                            </td>
                            
                            <td class="px-8 py-6">
                                @php
                                    $missingDocs = $student->documents->whereIn('document_status', ['action_needed', 'not_uploaded'])->count();
                                @endphp

                                @if($missingDocs > 0)
                                    <div class="flex flex-col gap-1">
                                        <span class="w-fit px-3 py-1 bg-amber-100 text-amber-600 text-[9px] font-black rounded-full uppercase tracking-wider">
                                            Enrolled (Missing {{ $missingDocs }})
                                        </span>
                                        <span class="text-[8px] font-bold text-amber-400 uppercase tracking-tighter">Requirements Pending</span>
                                    </div>
                                @else
                                    <span class="px-3 py-1 bg-green-100 text-green-600 text-[9px] font-black rounded-full uppercase tracking-wider">
                                        Officially Enrolled
                                    </span>
                                @endif
                            </td>

                            <td class="px-8 py-6 text-right">
                                {{-- Fixed Route Name --}}
                                <a href="{{ route('registrar.records.view', $student->id) }}" 
                                   class="inline-block p-2 bg-slate-100 rounded-xl text-slate-400 hover:text-[#7f0000] hover:bg-white hover:shadow-md transition shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <p class="text-slate-300 font-black uppercase tracking-[0.2em] text-xs">No enrolled students found</p>
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