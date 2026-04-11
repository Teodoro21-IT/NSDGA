@extends('student.layouts.auth')

@section('content')

<div class="min-h-[70vh] bg-white px-4 py-12">
	<div class="mx-auto w-full max-w-md rounded-2xl border border-slate-200 bg-white/90 p-8 shadow-[0_20px_60px_-35px_rgba(15,23,42,0.35)]">
		<div class="mb-8 text-center">
			<div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-[#800000]/10 text-[#800000]">
				<svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 4h.01M6 6.5a6.5 6.5 0 1 1 13 0c0 4.2-6.5 10-6.5 10S6 10.7 6 6.5Z" />
				</svg>
			</div>
			<h2 class="text-2xl font-semibold text-slate-900">OTP Verification</h2>
			<p class="mt-2 text-sm text-slate-500">Enter the 6-digit code sent to your email.</p>
		</div>

		@if (session('success'))
			<div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
				{{ session('success') }}
			</div>
		@endif

		@if ($errors->any())
			<div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
				{{ $errors->first() }}
			</div>
		@endif

		<form method="POST" action="{{ route('student.otp.verify') }}" class="space-y-6" id="otp-form">
			@csrf
			<input type="hidden" name="otp" id="otp" value="">

			<div>
				<label class="block text-sm font-medium text-slate-700">OTP Code</label>
				<div class="mt-3 grid grid-cols-6 gap-2">
					@for ($i = 0; $i < 6; $i++)
						<input
							type="text"
							inputmode="numeric"
							autocomplete="one-time-code"
							maxlength="1"
							class="otp-box h-12 w-full rounded-lg border border-slate-200 bg-white text-center text-lg font-semibold text-slate-900 shadow-sm transition focus:border-[#800000] focus:outline-none focus:ring-2 focus:ring-[#800000]/15"
							aria-label="OTP digit {{ $i + 1 }}"
						>
					@endfor
				</div>
			</div>

			<button type="submit" class="w-full rounded-lg bg-[#800000] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#6b0000] focus:outline-none focus:ring-2 focus:ring-[#800000]/20">
				Verify OTP
			</button>
		</form>

		<form method="POST" action="{{ route('student.otp.resend') }}" class="mt-6">
			@csrf
			<button type="submit" class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
				Resend OTP
			</button>
		</form>

		<p class="mt-6 text-center text-xs text-slate-500">Did not receive a code? Check your spam folder.</p>
	</div>
</div>

<script>
	(() => {
		const inputs = Array.from(document.querySelectorAll('.otp-box'));
		const hiddenInput = document.getElementById('otp');
		const form = document.getElementById('otp-form');

		const updateHidden = () => {
			hiddenInput.value = inputs.map((input) => input.value).join('');
		};

		inputs.forEach((input, index) => {
			input.addEventListener('input', (event) => {
				const value = event.target.value.replace(/\D/g, '');
				event.target.value = value.slice(0, 1);
				updateHidden();
				if (value && index < inputs.length - 1) {
					inputs[index + 1].focus();
				}
			});

			input.addEventListener('keydown', (event) => {
				if (event.key === 'Backspace' && !input.value && index > 0) {
					inputs[index - 1].focus();
				}
			});

			input.addEventListener('paste', (event) => {
				event.preventDefault();
				const pasted = (event.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
				pasted.split('').slice(0, inputs.length).forEach((digit, idx) => {
					inputs[idx].value = digit;
				});
				updateHidden();
				const nextIndex = Math.min(pasted.length, inputs.length - 1);
				inputs[nextIndex].focus();
			});
		});

		form.addEventListener('submit', updateHidden);
		if (inputs.length) {
			inputs[0].focus();
		}
	})();
</script>

@endsection