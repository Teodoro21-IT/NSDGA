<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile | {{ $student->first_name }} {{ $student->last_name }}</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; }

        /* Tab system */
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .tab-btn {
            position: relative;
            padding: 14px 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #94a3b8;
            cursor: pointer;
            background: none;
            border: none;
            transition: color 0.2s;
            white-space: nowrap;
        }
        .tab-btn::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: #7f0000;
            transform: scaleX(0);
            transition: transform 0.2s;
            border-radius: 2px 2px 0 0;
        }
        .tab-btn.active {
            color: #7f0000;
        }
        .tab-btn.active::after {
            transform: scaleX(1);
        }
        .tab-btn:hover:not(.active) { color: #475569; }

        /* Field styles */
        .field-label {
            font-size: 9px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 4px;
            display: block;
        }
        .field-value {
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
        }

        /* Section label */
        .section-title {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        /* History card bar */
        .history-card { border-left: 3px solid #7f0000; }

        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { background: white; }
            main { margin: 0 !important; padding: 0 !important; }
        }
        .print-only { display: none; }

        /* Smooth tab transition */
        .tab-content.active {
            animation: fadeIn 0.18s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen flex text-slate-800">

    <div class="no-print">
        @include('components.registrar.registrar-sidebar')
    </div>

    <main class="flex-1 ml-[260px] p-8 pt-24 transition-all duration-300">
        <div class="no-print">
            @include('components.registrar.registrar-navbar')
        </div>

        <div class="max-w-4xl mx-auto">

            {{-- Success Notification --}}
            @if(session('success'))
                <div class="no-print mb-4 p-4 bg-green-500 text-white rounded-xl font-bold text-sm shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Breadcrumb --}}
            <div class="no-print flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-6">
                <span>Documents</span>
                <span class="text-slate-300">›</span>
                <span class="text-slate-600">Student Profile</span>
            </div>

            {{-- Print Header --}}
            <div class="print-only mb-6 pb-4 border-b-2 border-slate-900">
                <h2 class="text-lg font-black text-[#7f0000]">NUESTRA SEÑORA DE GUIA ACADEMY</h2>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Official Student Master Record</p>
            </div>

            {{-- Student Header Card --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-1">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        {{-- Photo --}}
                        @php
                            $photoDocument = $student->documents->firstWhere('document_type', 'two_by_two_picture');
                            $photoPath = $photoDocument?->file_path ?? $photoDocument?->document_path;
                        @endphp
                        <div class="w-20 h-20 rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 flex items-center justify-center flex-shrink-0">
                            @if($photoPath)
                                <img src="{{ asset('storage/' . $photoPath) }}" alt="Photo" class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @endif
                        </div>

                        {{-- Name & Meta --}}
                        <div>
                            <h1 class="text-xl font-bold text-slate-900 tracking-tight leading-tight">
                                {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                            </h1>
                            <p class="text-[11px] font-semibold text-slate-400 mt-1 font-mono">
                                LRN: {{ $student->lrn ?? 'Not Assigned' }} &nbsp;·&nbsp; {{ $student->grade_level_applying_for }}
                            </p>
                            <div class="mt-2.5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 border border-green-200 text-green-600 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    Currently Enrolled
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 no-print">
                        <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-lg text-[10px] font-bold uppercase tracking-wider text-slate-500 hover:bg-slate-50 transition bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            Print
                        </button>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-lg text-[10px] font-bold uppercase tracking-wider text-slate-500 hover:bg-slate-50 transition bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            Edit Profile
                        </a>
                    </div>
                </div>

                {{-- Tabs --}}
                <div class="flex gap-6 mt-6 border-t border-slate-100 pt-1 no-print">
                    <button class="tab-btn active" onclick="switchTab('profile', this)">Profile Overview</button>
                    <button class="tab-btn" onclick="switchTab('academic', this)">Academic History</button>
                    <button class="tab-btn" onclick="switchTab('documents', this)">Uploaded Documents</button>
                </div>
            </div>

            {{-- ─────────────────────────────────────────────
                 TAB 1: Profile Overview
            ───────────────────────────────────────────── --}}
            <div id="tab-profile" class="tab-content active mt-4">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                    <p class="section-title">Personal Information</p>

                    <div class="grid grid-cols-2 gap-x-10 gap-y-6">
                        <div>
                            <span class="field-label">Birthplace</span>
                            <p class="field-value">{{ $student->birthplace ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="field-label">Date of Birth</span>
                            <p class="field-value">{{ optional($student->date_of_birth)->format('m/d/Y') ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <span class="field-label">Home Address</span>
                            <p class="field-value">{{ $student->home_address ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="field-label">Gender</span>
                            <p class="field-value">{{ ucfirst($student->sex) ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="field-label">Nationality</span>
                            <p class="field-value">{{ $student->nationality ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="field-label">Contact Number</span>
                            <p class="field-value">{{ $student->contact_number ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="field-label">LRN</span>
                            <p class="field-value font-mono">{{ $student->lrn ?? 'Not Assigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─────────────────────────────────────────────
                 TAB 2: Academic History
            ───────────────────────────────────────────── --}}
            <div id="tab-academic" class="tab-content mt-4">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                    <div class="flex items-center justify-between mb-5">
                        <p class="section-title mb-0">Academic History</p>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                            {{ ($academicHistories ?? $student->academicHistories)->count() }} Records
                        </span>
                    </div>

                    @if(($academicHistories ?? $student->academicHistories)->isEmpty())
                        <div class="text-center py-14 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">No academic history records found.</p>
                        </div>
                    @else
                        @php
                            $histories = ($academicHistories ?? $student->academicHistories);
                            $seniorGrades = ['Grade 11', 'Grade 12'];
                            $seniorHistories = $histories->filter(fn($h) => in_array($h->grade_level, $seniorGrades));
                            $juniorHistories = $histories->filter(fn($h) => !in_array($h->grade_level, $seniorGrades));
                        @endphp

                        @if($seniorHistories->isNotEmpty())
                            <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3">Senior High School</p>
                            <div class="space-y-3 mb-7">
                                @foreach($seniorHistories as $history)
                                    <div class="history-card bg-slate-50 rounded-xl p-4 pl-5">
                                        <div class="flex items-center gap-3 mb-1">
                                            <span class="text-sm font-bold text-slate-800">{{ $history->grade_level }}</span>
                                            @php
                                                $isCurrentYear = str_contains($history->school_year ?? '', date('Y')) || str_contains($history->school_year ?? '', date('Y') - 1 . '-' . date('Y'));
                                            @endphp
                                            @if($history->remarks === 'current' || $isCurrentYear)
                                                <span class="px-2.5 py-0.5 bg-red-50 border border-red-100 text-[#7f0000] text-[9px] font-black uppercase tracking-wider rounded-full">Current</span>
                                            @else
                                                <span class="px-2.5 py-0.5 bg-green-50 border border-green-100 text-green-600 text-[9px] font-black uppercase tracking-wider rounded-full">Completed</span>
                                            @endif
                                        </div>
                                        <p class="text-xs font-semibold text-slate-600 uppercase tracking-wide">{{ $history->school_name }}</p>
                                        <p class="text-[11px] text-slate-400 font-medium mt-0.5">A.Y. {{ $history->school_year }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if($juniorHistories->isNotEmpty())
                            <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3">Junior High School</p>
                            <div class="space-y-3">
                                @foreach($juniorHistories as $history)
                                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                        <div class="flex items-center gap-3 mb-1">
                                            <span class="text-sm font-bold text-slate-800">{{ $history->grade_level }}</span>
                                            <span class="px-2.5 py-0.5 bg-green-50 border border-green-100 text-green-600 text-[9px] font-black uppercase tracking-wider rounded-full">Completed</span>
                                        </div>
                                        <p class="text-xs font-semibold text-slate-600 uppercase tracking-wide">{{ $history->school_name }}</p>
                                        <p class="text-[11px] text-slate-400 font-medium mt-0.5">A.Y. {{ $history->school_year }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            {{-- ─────────────────────────────────────────────
                 TAB 3: Uploaded Documents
            ───────────────────────────────────────────── --}}
            <div id="tab-documents" class="tab-content mt-4">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                    <p class="section-title">Uploaded Documents</p>

                    <div class="space-y-2.5">
                        @foreach($documents as $doc)
                            @php
                                $isMissing = $doc->document_status == 'not_uploaded';
                                $isUnderReview = $doc->document_status == 'under_review';
                                $isVerified = $doc->document_status == 'verified';
                                $isActionNeeded = $doc->document_status == 'action_needed';

                                // Format verified date if available
                                $verifiedDate = $isVerified && $doc->updated_at ? $doc->updated_at->format('m/d/Y') : null;
                            @endphp

                            <div class="flex items-center justify-between py-3.5 px-4 rounded-xl border border-slate-100 hover:bg-slate-50/70 transition group">
                                <div class="flex items-center gap-3.5">
                                    {{-- Icon --}}
                                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0
                                        {{ $isMissing || $isActionNeeded ? 'bg-red-50' : ($isUnderReview ? 'bg-blue-50' : 'bg-green-50') }}">
                                        @if($isVerified)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $isMissing || $isActionNeeded ? 'text-red-400' : 'text-blue-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        @endif
                                    </div>

                                    {{-- Name & Status --}}
                                    <div>
                                        <p class="text-xs font-bold text-slate-700 capitalize">
                                            {{ ucwords(str_replace('_', ' ', $doc->document_type)) }}
                                        </p>
                                        <p class="text-[10px] font-medium mt-0.5
                                            {{ $isMissing || $isActionNeeded ? 'text-red-400' : ($isUnderReview ? 'text-blue-400' : 'text-slate-400') }}">
                                            @if($isVerified && $verifiedDate)
                                                Verified on {{ $verifiedDate }}
                                            @elseif($isActionNeeded)
                                                Action needed
                                            @elseif($isUnderReview)
                                                Under review
                                            @elseif($isMissing)
                                                Not uploaded
                                            @else
                                                {{ ucfirst(str_replace('_', ' ', $doc->document_status)) }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex items-center gap-2">
                                    {{-- View --}}
                                    @if(!$isMissing)
                                        <a href="{{ asset('storage/' . $doc->document_path) }}" target="_blank"
                                           class="px-3.5 py-1.5 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-100 transition">
                                            View
                                        </a>
                                    @endif

                                    {{-- Approve / Correct (only for under_review) --}}
                                    @if($isUnderReview)
                                        <form action="{{ route('registrar.documents.update_status', $doc->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="document_status" value="verified">
                                            <button type="submit"
                                                class="px-3.5 py-1.5 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-slate-200 text-slate-500 hover:bg-green-500 hover:text-white hover:border-green-500 transition">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('registrar.documents.update_status', $doc->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="document_status" value="action_needed">
                                            <button type="submit"
                                                class="px-3.5 py-1.5 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-slate-200 text-slate-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition">
                                                Correct
                                            </button>
                                        </form>
                                    @elseif($isVerified || $isActionNeeded)
                                        <form action="{{ route('registrar.documents.update_status', $doc->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="document_status" value="under_review">
                                            <button type="submit"
                                                class="px-3.5 py-1.5 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-400 hover:text-white transition">
                                                Reset
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Print Footer --}}
            <div class="print-only mt-20">
                <div class="flex justify-between">
                    <div class="text-center w-56 border-t-2 border-slate-900 pt-2">
                        <p class="text-[10px] font-black uppercase">Registrar Signature</p>
                    </div>
                    <div class="text-center w-56 border-t-2 border-slate-900 pt-2">
                        <p class="text-[10px] font-black uppercase">Date Issued</p>
                        <p class="text-xs font-bold">{{ date('F d, Y') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        function switchTab(tab, btn) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            // Deactivate all buttons
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

            // Show selected tab
            document.getElementById('tab-' + tab).classList.add('active');
            btn.classList.add('active');
        }

        // Restore active tab from URL hash on load
        window.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash.replace('#', '');
            if (hash && document.getElementById('tab-' + hash)) {
                const btn = document.querySelector(`.tab-btn[onclick*="'${hash}'"]`);
                if (btn) switchTab(hash, btn);
            }
        });
    </script>
</body>
</html>