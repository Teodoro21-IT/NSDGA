<!DOCTYPE html>
<html lang="en">
<head>
	@includeIf('student.components.head')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
	<div class="flex min-h-screen">
		@includeIf('student.components.sidebar')

		<div class="flex min-w-0 flex-1 flex-col">
			@includeIf('student.components.navbar')

			<main class="min-w-0 flex-1 p-6">
				@hasSection('content')
					@yield('content')
				@else
					@includeIf('student.contents.student_dashboard')
				@endif
			</main>

			@includeIf('student.components.footer')
		</div>
	</div>
</body>
</html>
