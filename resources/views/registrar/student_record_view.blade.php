<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Record | {{ $student->first_name }} {{ $student->last_name }}</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; }
        
        /* Layout Styles */
        .section-label { @apply text-[11px] font-black text-[#B08968] uppercase tracking-[0.2em] mb-4 block; }
        .input-wrapper { @apply flex flex-col gap-1; }
        .field-label { @apply text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1; }
        .display-box { @apply w-full px-4 py-2.5 bg-[#FDFDFD] border border-slate-200 rounded-lg text-slate-700 text-sm font-medium; }
        
        /* PRINT LOGIC */
        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { background: white; }
            main { margin: 0 !important; padding: 0 !important; width: 100% !important; }
            .content-container { border: none !important; box-shadow: none !important; }
        }
        .print-only { display: none; }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    <div class="no-print">
        @include('components.registrar.registrar-sidebar')
    </div>
    
    <main class="flex-1 ml-[260px] p-10 pt-24 transition-all duration-300">
        <div class="no-print">
            @include('components.registrar.registrar-navbar')
        </div>

        <div class="max-w-6xl mx-auto content-container">
            
            <div class="flex justify-between items-start mb-8">
                <div>
                    <div class="print-only mb-6 border-b-2 border-slate-900 pb-4">
                        <h2 class="text-xl font-black text-[#7f0000]">NUESTRA SEÑORA DE GUIA ACADEMY</h2>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Official Student Master Record</p>
                    </div>

                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</h1>
                    <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mt-1">
                        APP-{{ $student->created_at->format('Y') }}-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }} • Incoming {{ $student->grade_level_applying_for }}
                    </p>
                </div>

                <div class="flex flex-col items-end gap-4">
                    <div class="px-6 py-2.5 bg-[#7f0000] text-white font-bold rounded-xl shadow-lg flex items-center gap-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Officially Enrolled
                    </div>
                    <button onclick="window.print()" class="no-print flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-slate-50 transition shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                        Print Document
                    </button>
                </div>
            </div>

            {{-- Personal Information --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 mb-6">
                <span class="section-label">Personal Information</span>
                
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div class="input-wrapper"><label class="field-label">First Name</label><div class="display-box">{{ $student->first_name }}</div></div>
                    <div class="input-wrapper"><label class="field-label">Middle Name</label><div class="display-box">{{ $student->middle_name ?? 'N/A' }}</div></div>
                    <div class="input-wrapper"><label class="field-label">Last Name</label><div class="display-box">{{ $student->last_name }}</div></div>
                </div>

                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div class="input-wrapper"><label class="field-label">LRN (12-digit)</label><div class="display-box">{{ $student->lrn ?? '136676090147' }}</div></div>
                    <div class="input-wrapper"><label class="field-label">Sex</label><div class="display-box">{{ $student->sex }}</div></div>
                    <div class="input-wrapper"><label class="field-label">Age</label><div class="display-box">{{ \Carbon\Carbon::parse($student->date_of_birth)->age }}</div></div>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div class="input-wrapper"><label class="field-label">Date of Birth</label><div class="display-box">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('m/d/Y') }}</div></div>
                    <div class="input-wrapper"><label class="field-label">Birthplace</label><div class="display-box">{{ $student->birthplace ?? 'Marikina City' }}</div></div>
                </div>

                <div class="input-wrapper mb-6">
                    <label class="field-label">Home Address</label>
                    <div class="display-box">{{ $student->home_address }}</div>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    <div class="input-wrapper"><label class="field-label">Contact Number</label><div class="display-box">{{ $student->contact_number }}</div></div>
                    <div class="input-wrapper"><label class="field-label">Grade Level Applying For</label><div class="display-box">{{ $student->grade_level_applying_for }}</div></div>
                    <div class="input-wrapper"><label class="field-label">School Year</label><div class="display-box">2024-2025</div></div>
                </div>
            </div>

            {{-- Academic Background --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 mb-6">
                <span class="section-label">Academic Background</span>
                <div class="grid grid-cols-2 gap-6">
                    <div class="input-wrapper"><label class="field-label">Previous School Attended</label><div class="display-box">{{ $student->previous_school ?? 'Biringan National High School' }}</div></div>
                    <div class="input-wrapper"><label class="field-label">GWA</label><div class="display-box">{{ $student->gwa ?? '94.00' }}</div></div>
                </div>
            </div>

            {{-- Document Registry with Verification Stages --}}
            <div class="bg-[#F8FAFC] rounded-3xl p-8 border border-slate-100 mb-10">
                <span class="section-label text-slate-400">Verified Documents Registry</span>
                <div class="space-y-3">
                    @foreach($documents as $doc)
                    <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="p-2 bg-slate-50 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">{{ str_replace('_', ' ', $doc->document_type) }}</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            {{-- Stage Indicator --}}
                            @if($doc->document_status == 'verified')
                                <span class="px-4 py-1 bg-green-100 text-green-600 text-[9px] font-black rounded-md uppercase tracking-wider">Verified</span>
                            @elseif($doc->document_status == 'action_needed')
                                <span class="px-4 py-1 bg-red-100 text-red-600 text-[9px] font-black rounded-md uppercase tracking-wider">Needs Correction</span>
                            @else
                                <span class="px-4 py-1 bg-indigo-100 text-indigo-600 text-[9px] font-black rounded-md uppercase tracking-wider">Under Review</span>
                            @endif

                            {{-- Action: View --}}
                            <a href="{{ asset('storage/' . $doc->document_path) }}" target="_blank" class="no-print px-4 py-1 bg-slate-100 text-slate-400 text-[9px] font-black rounded-md uppercase hover:bg-slate-200 transition">View File</a>

                            {{-- Form to Approve --}}
                            <form action="{{ route('registrar.document.updateStatus', $doc->id) }}" method="POST" class="no-print inline">
                                @csrf
                                <input type="hidden" name="document_status" value="verified">
                                <button type="submit" class="px-4 py-1 bg-slate-100 text-slate-400 text-[9px] font-black rounded-md uppercase hover:bg-green-600 hover:text-white transition">Approve</button>
                            </form>

                            {{-- Form to mark for Correction --}}
                            <form action="{{ route('registrar.document.updateStatus', $doc->id) }}" method="POST" class="no-print inline">
                                @csrf
                                <input type="hidden" name="document_status" value="action_needed">
                                <button type="submit" class="px-4 py-1 bg-slate-100 text-slate-400 text-[9px] font-black rounded-md uppercase hover:bg-red-600 hover:text-white transition">Correct</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="print-only mt-20">
                <div class="flex justify-between">
                    <div class="text-center w-64 border-t-2 border-slate-900 pt-2">
                        <p class="text-[10px] font-black uppercase">Registrar Signature</p>
                    </div>
                    <div class="text-center w-64 border-t-2 border-slate-900 pt-2">
                        <p class="text-[10px] font-black uppercase">Date Issued</p>
                        <p class="text-xs font-bold">{{ date('F d, Y') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>