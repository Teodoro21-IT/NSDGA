@extends('student.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 shadow-sm rounded-xl border border-gray-100">
    
    <div class="mb-8 border-b border-gray-200 pb-4">
        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Student Enrollment Form</h2>
        <p class="text-sm text-slate-500 mt-1">Please fill out all required fields marked with an asterisk (<span class="text-red-500">*</span>) to process your registration.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @error('submit')
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm font-medium">
            {{ $message }}
        </div>
    @enderror

    @if ($hasSubmittedEnrollment ?? false)
        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-5 py-4 rounded-lg text-sm leading-relaxed">
            <p class="font-semibold">Enrollment form already submitted.</p>
            <p class="mt-1">We already received your enrollment application. Please wait for the registrar to review your submission. You will be notified once there is an update.</p>
        </div>
    @else

    <form method="POST" action="{{ route('student.enrollment.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div>
            <h3 class="text-lg font-bold text-[#800000] flex items-center space-x-2 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span>Personal Information <span class="text-red-500">*</span></span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">First Name <span class="text-red-500">*</span></label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required placeholder="Enter first name"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('first_name') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('first_name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name') }}" placeholder="Enter middle name"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('middle_name') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('middle_name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required placeholder="Enter last name"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('last_name') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('last_name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">LRN (12 digits) <span class="text-red-500">*</span></label>
                    <input type="text" name="lrn" maxlength="12" value="{{ old('lrn') }}" required placeholder="000000000000"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('lrn') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('lrn') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

               <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Sex <span class="text-red-500">*</span></label>
                        <select name="sex" required class="w-full text-sm px-3 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                            @error('sex') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                            <option value="">Sex</option>
                            <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('sex') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Age <span class="text-red-500">*</span></label>
                        <input type="number" name="age" value="{{ old('age') }}" required placeholder="e.g. 15"
                            class="w-full text-sm px-3 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                            @error('age') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                        @error('age') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nationality <span class="text-red-500">*</span></label>
                    <input type="text" name="nationality" value="{{ old('nationality') }}" required placeholder="Enter nationality"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('nationality') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('nationality') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required 
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('date_of_birth') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('date_of_birth') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Birthplace <span class="text-red-500">*</span></label>
                    <input type="text" name="birthplace" value="{{ old('birthplace') }}" required placeholder="City, Province"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('birthplace') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('birthplace') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Home Address <span class="text-red-500">*</span></label>
                    <input type="text" name="home_address" value="{{ old('home_address') }}" required placeholder="House No., Street, Brgy, City, Province"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('home_address') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('home_address') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Contact Number <span class="text-red-500">*</span></label>
                    <input type="text" name="contact_number" value="{{ old('contact_number') }}" required placeholder="09XX-XXX-XXXX"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('contact_number') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('contact_number') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Education Level <span class="text-red-500">*</span></label>
                    <select id="education_level" name="education_level" required class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('education_level') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                        <option value="">Select Level</option>
                        <option value="elementary" {{ old('education_level') === 'elementary' ? 'selected' : '' }}>Elementary</option>
                        <option value="highschool" {{ old('education_level') === 'highschool' ? 'selected' : '' }}>Junior High School</option>
                        <option value="seniorhigh" {{ old('education_level') === 'seniorhigh' ? 'selected' : '' }}>Senior High School</option>
                    </select>
                    @error('education_level') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Grade Level Applying For <span class="text-red-500">*</span></label>
                    <select id="grade_level_applying_for" name="grade_level_applying_for" required class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('grade_level_applying_for') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                        <option value="">Select Grade Level</option>
                        @php
                            $selectedEducationLevel = old('education_level');
                            $selectedGradeLevel = old('grade_level_applying_for');
                            $gradeOptions = match ($selectedEducationLevel) {
                                'elementary' => range(1, 6),
                                'highschool' => range(7, 10),
                                'seniorhigh' => [11, 12],
                                default => [],
                            };
                        @endphp
                        @foreach ($gradeOptions as $grade)
                            @php $optionValue = "Grade {$grade}"; @endphp
                            <option value="{{ $optionValue }}" {{ $selectedGradeLevel === $optionValue ? 'selected' : '' }}>{{ $optionValue }}</option>
                        @endforeach
                    </select>
                    @error('grade_level_applying_for') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">School Year <span class="text-red-500">*</span></label>
                    <select name="school_year" required class="w-full text-sm px-4 py-2.5 rounded-lg border bg-white focus:ring-2 focus:outline-none transition-colors 
                        @error('school_year') border-red-500 focus:ring-red-200 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                        <option value="">Select School Year</option>
                        <option value="2024-2025" {{ old('school_year') === '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                        <option value="2025-2026" {{ old('school_year') === '2025-2026' ? 'selected' : '' }}>2025-2026</option>
                        <option value="2027-2028" {{ old('school_year') === '2027-2028' ? 'selected' : '' }}>2027-2028</option>
                    </select>
                    @error('school_year') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Student Type <span class="text-red-500">*</span></label>
                    <select name="student_type" required class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('student_type') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                        <option value="">Select Type</option>
                        <option value="new" {{ old('student_type') === 'new' ? 'selected' : '' }}>New Student</option>
                        <option value="transferee" {{ old('student_type') === 'transferee' ? 'selected' : '' }}>Transferee</option>
                        <option value="returning" {{ old('student_type') === 'returning' ? 'selected' : '' }}>Returning</option>
                    </select>
                    @error('student_type') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div id="course-strand-field" class="transition-all duration-150 {{ old('education_level') === 'seniorhigh' ? '' : 'hidden' }}">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Course / Strand Interested <span class="text-red-500">*</span></label>
                    <select name="course_strand_interested" class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('course_strand_interested') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                        <option value="">Select a course / strand</option>
                        <option value="stem" {{ old('course_strand_interested') === 'stem' ? 'selected' : '' }}>STEM</option>
                        <option value="abm" {{ old('course_strand_interested') === 'abm' ? 'selected' : '' }}>ABM</option>
                        <option value="humss" {{ old('course_strand_interested') === 'humss' ? 'selected' : '' }}>HUMSS</option>
                        <option value="tvl" {{ old('course_strand_interested') === 'tvl' ? 'selected' : '' }}>TVL</option>
                    </select>
                    @error('course_strand_interested') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-200">
            <h3 class="text-lg font-bold text-[#800000] flex items-center space-x-2 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                <span>Academic Background <span class="text-red-500">*</span></span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Previous School Attended <span class="text-red-500">*</span></label>
                    <input type="text" name="previous_school_attended" value="{{ old('previous_school_attended') }}" placeholder="Enter school name"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('previous_school_attended') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('previous_school_attended') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Last Grade/Year Level Completed <span class="text-red-500">*</span></label>
                    <input type="text" name="last_grade_year_level_completed" value="{{ old('last_grade_year_level_completed') }}" placeholder="e.g. Grade 6"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('last_grade_year_level_completed') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('last_grade_year_level_completed') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">GWA (General Weighted Average) <span class="text-red-500">*</span></label>
                    <input type="text" name="gwa" value="{{ old('gwa') }}" placeholder="e.g. 92.5"
                        class="w-full text-sm px-4 py-2.5 rounded-lg border focus:ring-2 focus:outline-none transition-colors 
                        @error('gwa') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-300 focus:border-[#800000] focus:ring-[#800000]/20 @enderror">
                    @error('gwa') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-200">
            <h3 class="text-lg font-bold text-[#800000] flex items-center space-x-2 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Document Requirements <span class="text-red-500">*</span></span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div>
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-gray-50 transition-colors
                        @error('two_by_two_picture') border-red-500 bg-red-50 @else border-gray-300 bg-gray-50/50 @enderror">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <p class="text-sm font-bold text-gray-700">2x2 Picture <span class="text-red-500">*</span></p>
                            <p class="text-[10px] text-gray-400 mb-2">High quality, white background</p>
                            <span class="text-xs font-semibold text-[#800000]">Upload File</span>
                            <p class="mt-1 text-[10px] text-emerald-700 font-semibold text-center" data-file-name="two_by_two_picture">No file selected</p>
                        </div>
                        <input type="file" name="two_by_two_picture" accept="image/*" class="hidden" data-file-input="two_by_two_picture" />
                    </label>
                    @error('two_by_two_picture') <p class="text-red-500 text-xs mt-1 font-medium text-center">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-gray-50 transition-colors
                        @error('report_card') border-red-500 bg-red-50 @else border-gray-300 bg-gray-50/50 @enderror">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <p class="text-sm font-bold text-gray-700">Report Card <span class="text-red-500">*</span></p>
                            <p class="text-[10px] text-gray-400 mb-2">Scanned copy of latest grades</p>
                            <span class="text-xs font-semibold text-[#800000]">Upload File</span>
                            <p class="mt-1 text-[10px] text-emerald-700 font-semibold text-center" data-file-name="report_card">No file selected</p>
                        </div>
                        <input type="file" name="report_card" class="hidden" data-file-input="report_card" />
                    </label>
                    @error('report_card') <p class="text-red-500 text-xs mt-1 font-medium text-center">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-gray-50 transition-colors
                        @error('form_137') border-red-500 bg-red-50 @else border-gray-300 bg-gray-50/50 @enderror">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <p class="text-sm font-bold text-gray-700">Form 137</p>
                            <p class="text-[10px] text-gray-400 mb-2">Official Student Permanent Record</p>
                            <span class="text-xs font-semibold text-[#800000]">Upload File</span>
                            <p class="mt-1 text-[10px] text-emerald-700 font-semibold text-center" data-file-name="form_137">No file selected</p>
                        </div>
                        <input type="file" name="form_137" class="hidden" data-file-input="form_137" />
                    </label>
                    @error('form_137') <p class="text-red-500 text-xs mt-1 font-medium text-center">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-gray-50 transition-colors
                        @error('psa_birth_certificate') border-red-500 bg-red-50 @else border-gray-300 bg-gray-50/50 @enderror">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <p class="text-sm font-bold text-gray-700">PSA Birth Certificate <span class="text-red-500">*</span></p>
                            <p class="text-[10px] text-gray-400 mb-2">Clear copy from PSA</p>
                            <span class="text-xs font-semibold text-[#800000]">Upload File</span>
                            <p class="mt-1 text-[10px] text-emerald-700 font-semibold text-center" data-file-name="psa_birth_certificate">No file selected</p>
                        </div>
                        <input type="file" name="psa_birth_certificate" class="hidden" data-file-input="psa_birth_certificate" />
                    </label>
                    @error('psa_birth_certificate') <p class="text-red-500 text-xs mt-1 font-medium text-center">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer hover:bg-gray-50 transition-colors
                        @error('good_moral') border-red-500 bg-red-50 @else border-gray-300 bg-gray-50/50 @enderror">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <p class="text-sm font-bold text-gray-700">Good Moral Cert <span class="text-red-500">*</span></p>
                            <p class="text-[10px] text-gray-400 mb-2">From previous school principal</p>
                            <span class="text-xs font-semibold text-[#800000]">Upload File</span>
                            <p class="mt-1 text-[10px] text-emerald-700 font-semibold text-center" data-file-name="good_moral">No file selected</p>
                        </div>
                        <input type="file" name="good_moral" class="hidden" data-file-input="good_moral" />
                    </label>
                    @error('good_moral') <p class="text-red-500 text-xs mt-1 font-medium text-center">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-200 flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
            
            <label class="flex items-center space-x-2 text-xs text-gray-600 cursor-pointer">
                <input type="checkbox" required class="rounded border-gray-300 text-[#800000] focus:ring-[#800000]">
                <span>I have read and agree to the <a href="#" class="text-[#800000] font-semibold hover:underline">Terms of Service</a> and <a href="#" class="text-[#800000] font-semibold hover:underline">Privacy Policy</a> of NSDGA. <span class="text-red-500">*</span></span>
            </label>

            <div class="flex space-x-3 w-full md:w-auto">
                <button type="button" class="w-full md:w-auto px-6 py-2.5 border border-gray-300 text-gray-700 text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors">
                    Save Draft
                </button>
                <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-[#800000] text-white text-sm font-bold rounded-lg hover:bg-red-900 transition-colors shadow-md">
                    Submit Enrollment
                </button>
            </div>
        </div>

    </form>
    @endif
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInputs = document.querySelectorAll('[data-file-input]');
        const educationSelect = document.getElementById('education_level');
        const gradeSelect = document.getElementById('grade_level_applying_for');
        const courseWrapper = document.getElementById('course-strand-field');
        const courseSelect = document.querySelector('[name="course_strand_interested"]');

        const gradeOptions = {
            elementary: ['Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6'],
            highschool: ['Grade 7','Grade 8','Grade 9','Grade 10'],
            seniorhigh: ['Grade 11','Grade 12'],
        };

        function refreshGradeOptions() {
            const selectedEducation = educationSelect.value;
            const selectedGrade = gradeSelect.value;
            const options = gradeOptions[selectedEducation] || [];

            gradeSelect.innerHTML = '<option value="">Select Grade Level</option>';

            options.forEach(function (grade) {
                const option = document.createElement('option');
                option.value = grade;
                option.textContent = grade;
                if (grade === selectedGrade) {
                    option.selected = true;
                }
                gradeSelect.appendChild(option);
            });
        }

        function refreshCourseField() {
            const isSenior = educationSelect.value === 'seniorhigh';
            if (isSenior) {
                courseWrapper.classList.remove('hidden');
                courseSelect.required = true;
            } else {
                courseWrapper.classList.add('hidden');
                courseSelect.required = false;
                courseSelect.value = '';
            }
        }

        educationSelect.addEventListener('change', function () {
            refreshGradeOptions();
            refreshCourseField();
        });

        fileInputs.forEach(function (input) {
            input.addEventListener('change', function () {
                const key = input.getAttribute('data-file-input');
                const fileNameLabel = document.querySelector('[data-file-name="' + key + '"]');

                if (!fileNameLabel) {
                    return;
                }

                const selectedFile = input.files && input.files.length ? input.files[0].name : '';
                fileNameLabel.textContent = selectedFile || 'No file selected';
            });
        });

        if (educationSelect) {
            refreshGradeOptions();
            refreshCourseField();
        }
    });
</script>
@endsection