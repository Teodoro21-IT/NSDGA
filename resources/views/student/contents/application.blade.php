@extends('student.layouts.app')

@section('content')
@php
    $hasEnrollment = (bool) $enrollment;
    $progressStep = $documentsComplete ? 2 : ($hasEnrollment ? 1 : 0);
@endphp

<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900"></h1>
    </div>

    <div>
        <h2 class="text-xl font-bold text-slate-900">Welcome, {{ $studentName }}!</h2>
        <p class="text-sm text-slate-500">Track your progress and recent updates here.</p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-10 shadow-sm">
        <div class="relative mx-auto max-w-4xl">
            <div class="absolute top-4 left-0 h-0.5 w-full bg-slate-200"></div>
            
            <div class="absolute top-4 left-0 h-0.5 transition-all duration-500 {{ $documentsComplete ? 'w-full' : ($hasEnrollment ? 'w-1/2' : 'w-0') }} bg-slate-800"></div>

            <div class="relative flex justify-between">
                <div class="flex flex-col items-center">
                    <div class="z-10 flex h-9 w-9 items-center justify-center rounded-full {{ $hasEnrollment ? 'bg-emerald-500 text-white' : 'bg-white border-2 border-slate-300 text-slate-400' }}">
                        @if ($hasEnrollment)
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                        @else
                            <span class="text-sm font-bold">1</span>
                        @endif
                    </div>
                    <div class="mt-3 text-center">
                        <p class="text-sm font-bold text-slate-900">Form Submitted</p>
                        <p class="text-xs text-slate-500">{{ $hasEnrollment ? ($submittedAt?->format('M d, Y') ?? 'Oct 12, 2023') : 'Pending' }}</p>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="z-10 flex h-9 w-9 items-center justify-center rounded-full {{ $documentsComplete ? 'bg-emerald-500 text-white' : ($hasEnrollment ? 'bg-emerald-500 text-white' : 'bg-white border-2 border-slate-200 text-slate-400') }}">
                         @if ($documentsComplete)
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                        @else
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        @endif
                    </div>
                    <div class="mt-3 text-center">
                        <p class="text-sm font-bold text-slate-900">Documents</p>
                        <p class="text-xs text-slate-500">{{ $documentsComplete ? ($documentsUpdatedAt?->format('M d, Y') ?? 'Oct 15, 2023') : 'Pending' }}</p>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="z-10 flex h-9 w-9 items-center justify-center rounded-full {{ $documentsComplete ? 'bg-white border-2 border-slate-400 text-slate-600' : 'bg-white border-2 border-slate-200 text-slate-300' }}">
                        @if($documentsComplete)
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        @else
                            <span class="text-sm font-bold">3</span>
                        @endif
                    </div>
                    <div class="mt-3 text-center">
                        <p class="text-sm font-bold text-slate-900">Registrar Review</p>
                        <p class="text-xs text-slate-500 italic">{{ $documentsComplete ? 'In Progress' : 'Pending' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center justify-between gap-6 rounded-xl border border-slate-200 bg-[#E9EDF5] p-6 sm:flex-row">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white text-slate-600 shadow-sm">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-base font-bold text-slate-900">Additional Notes</p>
                <p class="text-sm text-slate-700">
                    {{ $documentsComplete
                        ? 'Your application is currently being processed by the Registrar office. Expect a response regarding your interview schedule within 3-5 business days.'
                        : ($hasEnrollment
                            ? 'Please complete all required documents so the registrar can begin the review.'
                            : 'Submit your enrollment form to start the review process.')
                    }}
                </p>
            </div>
        </div>
        <a href="{{ route('documents') }}" class="whitespace-nowrap rounded-lg bg-[#A30000] px-8 py-3 text-sm font-bold text-white transition-colors hover:bg-[#800000]">
            View Details
        </a>
    </div>
</div>
@endsection