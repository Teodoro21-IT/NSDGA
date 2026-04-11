@extends('student.layouts.app')

@section('content')
<div class="p-4 md:p-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">My Documents</h1>
        <p class="text-gray-500 text-sm">Please upload clear scanned copies of the required documents for verification. Ensure files are in PDF or JPEG format.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-white">
                        <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Document Name</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Last Updated</th>
                        <th class="px-6 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($documents as $document)
                        @php
                            $status = strtolower($document->document_status);
                            
                            // Badge configuration based on status
                            $badgeConfig = match($status) {
                                'verified' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'dot' => 'bg-green-500'],
                                'under_review' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'dot' => 'bg-blue-500'],
                                'action_needed' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'dot' => null], // Uses icon instead
                                default => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'dot' => 'bg-slate-400'], // not_uploaded
                            };
                        @endphp
                        
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="text-gray-400">
                                        @if(str_contains(strtolower($document->document_type), 'picture'))
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @elseif(str_contains(strtolower($document->document_type), 'certificate'))
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        @endif
                                    </div>
                                    
                                    @if ($document->document_path)
                                        <a href="{{ asset('storage/' . $document->document_path) }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-gray-900 hover:text-[#8b1515] transition-colors">
                                            {{ ucwords(str_replace('_', ' ', $document->document_type)) }}
                                        </a>
                                    @else
                                        <span class="font-semibold text-gray-900">
                                            {{ ucwords(str_replace('_', ' ', $document->document_type)) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $badgeConfig['bg'] }} {{ $badgeConfig['text'] }}">
                                    @if($status === 'action_needed')
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    @else
                                        <span class="w-1.5 h-1.5 rounded-full {{ $badgeConfig['dot'] }}"></span>
                                    @endif
                                    {{ ucwords(str_replace('_', ' ', $document->document_status)) }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-5 text-gray-500">
                                {{ $document->updated_at?->format('M d, Y') ?? '—' }}
                            </td>
                            
                            <td class="px-6 py-5">
                                <button type="button" data-modal-open="document-modal-{{ $document->id }}" class="transition-colors">
                                    @if(in_array($status, ['verified', 'under_review'], true))
                                        <span class="font-bold text-[#8b1515] hover:text-[#6b1010]">Update</span>
                                    @else
                                        <span class="inline-flex items-center justify-center bg-[#8b1515] hover:bg-[#6b1010] text-white px-5 py-2 rounded text-xs font-semibold shadow-sm">
                                            Upload
                                        </span>
                                    @endif
                                </button>

                                <div id="document-modal-{{ $document->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm" aria-hidden="true">
                                    <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
                                        <div class="flex items-center justify-between mb-2">
                                            <h2 class="text-lg font-bold text-slate-900">
                                                Upload {{ ucwords(str_replace('_', ' ', $document->document_type)) }}
                                            </h2>
                                            <button type="button" class="rounded-full p-1 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors" aria-label="Close" data-modal-close="document-modal-{{ $document->id }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('student.documents.update', $document) }}" enctype="multipart/form-data" class="mt-4">
                                            @csrf
                                            <input id="document-file-{{ $document->id }}" type="file" name="document_file" class="hidden" required>
                                            
                                            <label for="document-file-{{ $document->id }}" class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 px-4 py-10 text-center text-slate-600 hover:border-[#8b1515] hover:bg-red-50 transition-all duration-200" data-dropzone data-input="document-file-{{ $document->id }}">
                                                <svg class="w-8 h-8 mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                                <span class="text-sm font-semibold text-slate-700">Drag and drop your file here</span>
                                                <span class="mt-1 text-xs text-slate-500">or click to browse</span>
                                                <span class="mt-4 text-xs font-medium text-[#8b1515] bg-red-100 px-3 py-1 rounded-full" data-dropzone-filename>No file selected</span>
                                            </label>

                                            <div class="mt-6 flex items-center justify-end gap-3">
                                                <button type="button" class="rounded-lg px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors" data-modal-close="document-modal-{{ $document->id }}">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="rounded-lg bg-[#8b1515] px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#6b1010] transition-colors">
                                                    {{ in_array($status, ['verified', 'under_review'], true) ? 'Update Document' : 'Upload Document' }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-8 text-center text-gray-500" colspan="4">No documents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-[#fcf8f8] border border-red-100 rounded-xl p-6">
            <h3 class="text-[#8b1515] font-bold text-sm mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Submission Guidelines
            </h3>
            <ul class="text-sm text-gray-600 space-y-3 leading-relaxed">
                <li>All scanned documents must be legible and in high resolution.</li>
                <li>Maximum file size for each document is 5MB.</li>
                <li>The Registrar's Office typically reviews documents within 3-5 working days.</li>
                <li>Ensure that PSA Birth Certificates show the registry number clearly.</li>
            </ul>
        </div>

        <div class="bg-slate-50 border border-slate-100 rounded-xl p-6">
            <h3 class="text-slate-900 font-bold text-sm mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Need Help?
            </h3>
            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                If you are experiencing issues with uploading your documents or have questions about the requirements, please contact the Registrar's Office.
            </p>
            <div class="space-y-2 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    registrar@nsdga.edu.ph
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    +63 (2) 8123-4567
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        function openModal(modal) {
            if (!modal) return;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.setAttribute('aria-hidden', 'false');
        }

        function closeModal(modal) {
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.setAttribute('aria-hidden', 'true');
        }

        document.addEventListener('click', function (event) {
            var openTarget = event.target.closest('[data-modal-open]');
            if (openTarget) {
                var modalId = openTarget.getAttribute('data-modal-open');
                openModal(document.getElementById(modalId));
                return;
            }

            var closeTarget = event.target.closest('[data-modal-close]');
            if (closeTarget) {
                var closeId = closeTarget.getAttribute('data-modal-close');
                closeModal(document.getElementById(closeId));
                return;
            }

            var backdrop = event.target.closest('[id^="document-modal-"]');
            if (backdrop && event.target === backdrop) {
                closeModal(backdrop);
            }
        });

        document.querySelectorAll('[data-dropzone]').forEach(function (zone) {
            var inputId = zone.getAttribute('data-input');
            var input = document.getElementById(inputId);
            var nameLabel = zone.querySelector('[data-dropzone-filename]');

            function updateLabel(files) {
                if (!nameLabel) return;
                nameLabel.textContent = files && files.length ? files[0].name : 'No file selected';
            }

            if (input) {
                input.addEventListener('change', function (event) {
                    updateLabel(event.target.files);
                });
            }

            zone.addEventListener('dragover', function (event) {
                event.preventDefault();
                zone.classList.add('border-[#8b1515]', 'bg-red-50');
            });

            zone.addEventListener('dragleave', function () {
                zone.classList.remove('border-[#8b1515]', 'bg-red-50');
            });

            zone.addEventListener('drop', function (event) {
                event.preventDefault();
                zone.classList.remove('border-[#8b1515]', 'bg-red-50');
                if (!input || !event.dataTransfer) return;
                
                var dt = new DataTransfer();
                Array.from(event.dataTransfer.files).slice(0, 1).forEach(function (file) {
                    dt.items.add(file);
                });
                input.files = dt.files;
                updateLabel(input.files);
            });
        });
    })();
</script>
@endsection