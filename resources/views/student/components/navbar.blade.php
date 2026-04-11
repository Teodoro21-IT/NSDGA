@php
    $studentAccountId = session('student_account_id');

    $studentAccount = $studentAccountId
        ? \App\Models\StudentAccount::query()
            ->with(['enrollmentForm.documents'])
            ->find($studentAccountId)
        : null;

    $enrollment = $studentAccount?->enrollmentForm;

    $studentName = $enrollment
        ? trim(implode(' ', array_filter([
            $enrollment->first_name,
            $enrollment->middle_name,
            $enrollment->last_name,
        ])))
        : ($studentAccount?->full_name ?? 'Student User');

    $studentLrn = $enrollment?->lrn ?? $studentAccount?->lrn ?? '-';

    $profilePhotoPath = $enrollment?->documents
        ?->firstWhere('document_type', 'two_by_two_picture')
        ?->document_path;
@endphp

<header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-end items-center sticky top-0 z-50">
    <div class="flex items-center space-x-3">
        <div class="text-right">
            <p class="text-sm font-bold text-gray-800">{{ $studentName }}</p>
            <p class="text-xs text-gray-500">LRN: {{ $studentLrn }}</p>
        </div>

        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-[#800000] bg-gray-100 flex items-center justify-center">
            @if ($profilePhotoPath)
                <img src="{{ asset('storage/' . $profilePhotoPath) }}" alt="Student profile" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('images/default_profile_picuture.png') }}" alt="Default student profile" class="w-full h-full object-cover">
            @endif
        </div>
    </div>
</header>