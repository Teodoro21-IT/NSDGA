<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Documents | Registrar Access</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    {{-- Sidebar --}}
    <div class="no-print">
        @include('components.registrar.registrar-sidebar')
    </div>
    
    <main class="flex-1 ml-[260px] p-10 pt-24 transition-all duration-300">
        {{-- Navbar --}}
        <div class="no-print">
            @include('components.registrar.registrar-navbar')
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Document Review </h1>
                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mt-1">
                    Manage and verify student uploads
                </p>
            </div>
            
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Student Name</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Uploaded Documents</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Overall Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        {{-- Iterate over the grouped documents (grouped by student_enrollment_form_id) --}}
                        @forelse($documents as $studentId => $studentDocs)
                        @php
                            // Get the first document to access the student's name info
                            $firstDoc = $studentDocs->first();
                            // Check if any document for this student needs correction
                            $needsCorrectionCount = $studentDocs->where('document_status', 'action_needed')->count();
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <span class="text-sm font-bold text-slate-700 uppercase tracking-tight">
                                    {{ $firstDoc->studentEnrollmentForm->first_name }} {{ $firstDoc->studentEnrollmentForm->last_name }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($studentDocs as $doc)
                                        <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[9px] font-bold rounded border border-slate-200 uppercase tracking-tighter">
                                            {{ str_replace('_', ' ', $doc->document_type) }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                @if($needsCorrectionCount > 0)
                                    <span class="px-3 py-1 bg-red-100 text-red-600 text-[9px] font-black rounded-md uppercase">
                                        {{ $needsCorrectionCount }} Correction(s) Needed
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-600 text-[9px] font-black rounded-md uppercase tracking-tighter">
                                        Under Review
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                {{-- Link to view the specific student record --}}
                                <a href="{{ route('registrar.student_records.view', $studentId) }}" 
                                   class="inline-flex items-center justify-center p-2 bg-slate-100 text-slate-400 rounded-lg hover:bg-[#7f0000] hover:text-white transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <p class="text-slate-400 font-bold text-xs uppercase tracking-[0.2em]">No pending documents found</p>
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