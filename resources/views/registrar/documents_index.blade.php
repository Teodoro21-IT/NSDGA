<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSDGA | Document Review</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    @include('components.registrar.registrar-sidebar')
    
    <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
        @include('components.registrar.registrar-navbar')

        <div class="p-10 pt-24 w-full">
            <div class="mb-8">
                <h1 class="text-[32px] font-extrabold text-[#7f0000] tracking-tight">All Student Documents</h1>
                <p class="text-slate-500 font-medium">View every submitted student document, enrolled or applicant, with status and student details.</p>
            </div>

            {{-- Search Bar --}}
            <form action="{{ route('registrar.documents') }}" method="GET" class="mb-8 max-w-md">
                <div class="relative">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search student name or document type..." 
                        class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-[#7f0000]/20 outline-none text-sm font-medium transition-all">
                </div>
            </form>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest">Student Name</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Uploaded Documents</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            <th class="px-8 py-5 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        {{-- The $documents variable is now a paginated list of Students --}}
                        @forelse($documents as $student)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <span class="text-sm font-bold text-slate-700 uppercase tracking-tight">
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex flex-wrap justify-center gap-2">
                                    @foreach($student->documents as $doc)
                                        @php
                                            $statusClass = match($doc->document_status) {
                                                'verified' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
                                                'under_review' => 'bg-sky-50 border-sky-200 text-sky-700',
                                                'action_needed' => 'bg-rose-50 border-rose-200 text-rose-700',
                                                default => 'bg-slate-100 border-slate-200 text-slate-500',
                                            };
                                        @endphp
                                        <span class="px-2 py-1 border rounded text-[9px] font-bold uppercase tracking-[0.12em] {{ $statusClass }}">
                                            {{ str_replace('_', ' ', $doc->document_type) }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                @php
                                    $hasActionNeeded = $student->documents->contains('document_status', 'action_needed');
                                    $hasUnderReview = $student->documents->contains('document_status', 'under_review');
                                    $hasVerified = $student->documents->contains('document_status', 'verified');
                                @endphp
                                @if($hasActionNeeded)
                                    <span class="px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-100 text-red-600">Action Needed</span>
                                @elseif($hasUnderReview)
                                    <span class="px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-sky-100 text-sky-700">Under Review</span>
                                @elseif($hasVerified)
                                    <span class="px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-700">Verified</span>
                                @else
                                    <span class="px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-slate-100 text-slate-600">No Uploads</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <a href="{{ route('registrar.records.view', $student->id) }}" class="p-2 text-slate-400 hover:text-[#7f0000] transition inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center text-slate-400 font-medium italic">
                                No student documents found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination Links --}}
                @if($documents->hasPages())
                <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                    {{ $documents->links() }}
                </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>