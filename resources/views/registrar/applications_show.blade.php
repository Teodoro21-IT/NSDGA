<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->first_name }} {{ $student->last_name }} | NSDGA Review</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; }
        .figma-input { @apply w-full bg-[#F3F4F6] border-none rounded-xl py-3 px-4 text-slate-500 font-medium mt-1 focus:ring-2 focus:ring-[#7f0000]/20; }
        .figma-label { @apply text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1; }
    </style>
</head>

<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    @include('components.registrar.registrar-sidebar')
    
   <main class="flex-1 flex flex-col min-h-screen ml-[260px]">
    @include('components.registrar.registrar-navbar')

    <div class="p-10 pt-24 w-full max-w-5xl mx-auto">
        
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('registrar.applications') }}" 
               class="inline-flex items-center gap-2 text-slate-400 hover:text-[#7f0000] font-bold text-xs uppercase tracking-widest transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Applications
            </a>
        </div>
            
            {{-- Figma Header Section --}}
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-[32px] font-black text-slate-900 tracking-tight leading-none">{{ $student->first_name }} {{ $student->last_name }}</h1>
                    <p class="text-slate-400 font-bold mt-2 text-sm uppercase tracking-wider">
                        APP-{{ $student->created_at->format('Y') }}-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }} • Incoming {{ $student->grade_level_applying_for }}
                    </p>
                </div>
                <form action="{{ route('registrar.enroll', $student->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-10 py-4 bg-[#7f0000] text-white font-black rounded-xl shadow-xl hover:bg-[#600000] transition active:scale-95">
                        Approve Admission
                    </button>
                </form>
            </div>

            {{-- Main Form Container --}}
            <div class="space-y-8">
                
                {{-- Personal Information Section --}}
                <div class="bg-white p-10 rounded-[32px] shadow-sm border border-slate-100">
                    <h3 class="text-[11px] font-black text-slate-300 uppercase tracking-[0.3em] mb-8">Personal Information</h3>
                    
                    <div class="grid grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="figma-label">First Name</label>
                            <input type="text" readonly value="{{ $student->first_name }}" class="figma-input">
                        </div>
                        <div>
                            <label class="figma-label">Middle Name</label>
                            <input type="text" readonly value="{{ $student->middle_name ?? 'N/A' }}" class="figma-input">
                        </div>
                        <div>
                            <label class="figma-label">Last Name</label>
                            <input type="text" readonly value="{{ $student->last_name }}" class="figma-input">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="figma-label">LRN (12-digit)</label>
                            <input type="text" readonly value="{{ $student->lrn ?? '136676090147' }}" class="figma-input">
                        </div>
                        <div>
                            <label class="figma-label">Sex</label>
                            <input type="text" readonly value="{{ ucfirst($student->sex ?? 'Male') }}" class="figma-input">
                        </div>
                        <div>
                            <label class="figma-label">Age</label>
                            <input type="text" readonly value="{{ \Carbon\Carbon::parse($student->date_of_birth)->age }}" class="figma-input">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="figma-label">Date of Birth</label>
                            <input type="text" readonly value="{{ \Carbon\Carbon::parse($student->date_of_birth)->format('m/d/Y') }}" class="figma-input">
                        </div>
                        <div>
                            <label class="figma-label">Birthplace</label>
                            <input type="text" readonly value="{{ $student->birthplace ?? 'Marikina City' }}" class="figma-input">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="figma-label">Home Address</label>
                        <input type="text" readonly value="{{ $student->home_address }}" class="figma-input">
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <label class="figma-label">Contact Number</label>
                            <input type="text" readonly value="{{ $student->contact_number }}" class="figma-input">
                        </div>
                        <div>
                            <label class="figma-label">Education Level</label>
                            <input type="text" readonly value="{{ ucfirst($student->education_level ?? 'High School') }}" class="figma-input">
                        </div>
                        <div>
                            <label class="figma-label">Grade Level Applying For</label>
                            <input type="text" readonly value="{{ $student->grade_level_applying_for }}" class="figma-input">
                        </div>
                    </div>
                </div>

                {{-- Academic Background Section --}}
                <div class="bg-white p-10 rounded-[32px] shadow-sm border border-slate-100">
                    <h3 class="text-[11px] font-black text-slate-300 uppercase tracking-[0.3em] mb-8">Academic Background</h3>
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="figma-label">Previous School Attended</label>
                            <input type="text" readonly value="{{ $student->last_school_attended ?? 'N/A' }}" class="figma-input">
                        </div>
                        <div>
                            <label class="figma-label">GWA (General Weighted Average)</label>
                            <input type="text" readonly value="{{ $student->gwa ?? '0.00' }}" class="figma-input">
                        </div>
                    </div>
                    <div class="w-1/2">
                        <label class="figma-label">Last Grade/Year Level Completed</label>
                        <input type="text" readonly value="{{ $student->last_grade_year_level_completed ?? 'N/A' }}" class="figma-input">
                    </div>
                </div>

                {{-- Uploaded Documents Section --}}
                <div class="bg-white p-10 rounded-[32px] shadow-sm border border-slate-100">
                    <h3 class="text-[11px] font-black text-slate-300 uppercase tracking-[0.3em] mb-8">Uploaded Documents</h3>
                    
                    <div class="space-y-4">
                        @foreach($documents as $doc)
                            @php 
                                $isMissing = $doc->document_status == 'not_uploaded';
                                $isUnderReview = $doc->document_status == 'under_review';
                            @endphp
                            <div class="flex items-center bg-[#F3F4F6]/50 p-4 rounded-2xl border border-slate-50 shadow-sm">
                                <div class="flex-1 flex items-center gap-4">
                                    <div class="bg-white p-3 rounded-xl shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <span class="font-bold text-slate-700 uppercase text-xs tracking-wider">
                                        {{ str_replace('_', ' ', $doc->document_type) }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-4">
                                    {{-- Status Badge --}}
                                    <span class="px-6 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest 
                                        {{ $isMissing ? 'bg-red-100 text-red-500' : ($isUnderReview ? 'bg-blue-100 text-blue-500' : 'bg-green-100 text-green-500') }}">
                                        {{ str_replace('_', ' ', $doc->document_status) }}
                                    </span>

                                    {{-- Action Buttons --}}
                                    <div class="flex gap-2">
                                        @if(!$isMissing)
                                            <a href="{{ asset('storage/' . $doc->document_path) }}" target="_blank" class="px-4 py-2 bg-slate-200 text-slate-600 text-[10px] font-black rounded-lg uppercase hover:bg-slate-300 transition">View</a>
                                            <button class="px-4 py-2 bg-slate-200 text-slate-600 text-[10px] font-black rounded-lg uppercase hover:bg-green-500 hover:text-white transition">Approve</button>
                                        @endif
                                        <button class="px-4 py-2 bg-slate-200 text-slate-600 text-[10px] font-black rounded-lg uppercase hover:bg-red-500 hover:text-white transition">Correct</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Additional Notes Section --}}
                <div class="bg-white p-10 rounded-[32px] shadow-sm border border-slate-100">
                    <h3 class="text-[11px] font-black text-slate-300 uppercase tracking-[0.3em] mb-6">Additional Notes for Student</h3>
                    <div class="bg-[#F3F4F6] rounded-2xl p-6 border border-slate-100">
                        <textarea placeholder="Enter feedback or requested corrections here..." 
                            class="w-full bg-transparent text-sm font-medium text-slate-600 focus:outline-none resize-none" rows="5"></textarea>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-[10px] font-bold italic">Student will be notified immediately upon submission.</p>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>