@extends('student.layouts.app')

@section('content')
<div class="p-4 md:p-8">
    
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @php
        $fullName = $enrollment
            ? trim(implode(' ', array_filter([
                $enrollment->first_name,
                $enrollment->middle_name,
                $enrollment->last_name,
            ])))
            : '-';
    @endphp

    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 flex items-center gap-6">
        <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-200 flex items-center justify-center">
            @if ($profilePhotoPath)
                <img src="{{ asset('storage/' . $profilePhotoPath) }}" alt="Profile picture" class="w-full h-full object-cover">
            @else
                <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-bold text-gray-900">{{ $fullName ?: '-' }}</h2>
            <p class="text-sm font-medium text-gray-500 mt-1">LRN: {{ $enrollment?->lrn ?? '-' }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
        <form method="POST" action="{{ route('student.profile.update') }}">
            @csrf

            <div class="flex items-center mb-6 mt-2">
                <div class="flex-grow border-t border-gray-100"></div>
                <span class="px-4 text-xs font-bold text-[#8b1515] tracking-[0.15em] uppercase">Personal Information</span>
                <div class="flex-grow border-t border-gray-100"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Birthdate</label>
                    <div class="bg-gray-50 text-gray-700 p-3.5 rounded-lg text-sm">
                        {{ $enrollment?->date_of_birth?->format('F d, Y') ?? '-' }}
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Birthplace</label>
                    <div class="bg-gray-50 text-gray-700 p-3.5 rounded-lg text-sm">
                        {{ $enrollment?->birthplace ?? '-' }}
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Gender</label>
                    <div class="bg-gray-50 text-gray-700 p-3.5 rounded-lg text-sm">
                        {{ $enrollment?->sex ?? '-' }}
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nationality</label>
                    <div class="bg-gray-50 text-gray-700 p-3.5 rounded-lg text-sm">
                        {{ $enrollment?->nationality ?? '-' }}
                    </div>
                </div>
            </div>

            <div class="relative flex items-center mb-6">
                <div class="flex-grow border-t border-gray-100"></div>
                <span class="px-4 text-xs font-bold text-[#8b1515] tracking-[0.15em] uppercase">Contact Information</span>
                <div class="flex-grow border-t border-gray-100"></div>
                
                <span class="absolute right-0 top-0 -mt-5 text-[10px] text-gray-400 font-medium">Editable Fields</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Mobile Number</label>
                    <input type="text" name="contact_number" value="{{ old('contact_number', $enrollment?->contact_number) }}" 
                           class="w-full bg-gray-200 text-gray-700 text-sm p-3.5 rounded-lg border-0 focus:ring-2 focus:ring-[#8b1515] focus:bg-white transition-colors duration-200 outline-none">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $studentEmail) }}" 
                           class="w-full bg-gray-200 text-gray-700 text-sm p-3.5 rounded-lg border-0 focus:ring-2 focus:ring-[#8b1515] focus:bg-white transition-colors duration-200 outline-none">
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Complete Address</label>
                <input type="text" name="home_address" value="{{ old('home_address', $enrollment?->home_address) }}" 
                       class="w-full bg-gray-200 text-gray-700 text-sm p-3.5 rounded-lg border-0 focus:ring-2 focus:ring-[#8b1515] focus:bg-white transition-colors duration-200 outline-none">
            </div>

            @if ($enrollment)
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#8b1515] hover:bg-[#6b1010] text-white text-sm font-semibold py-2.5 px-6 rounded-md flex items-center gap-2 transition-colors duration-200 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                        Save Changes
                    </button>
                </div>
            @endif
            
        </form>
    </div>
</div>
@endsection