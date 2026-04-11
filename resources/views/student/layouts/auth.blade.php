<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NSDGA | Student Auth</title>
	@vite(['resources/css/app.css'])
</head>

<body class="bg-white font-sans antialiased">
    <div class="flex min-h-screen w-full">
        
        <aside class="hidden lg:block lg:w-1/2">
            @includeIf('student.auth.components.side')
        </aside>

        <main class="flex w-full flex-col justify-center px-8 sm:px-12 lg:w-1/2 xl:px-24">
            <div class="mx-auto w-full max-w-sm">
                @yield('content')
            </div>
        </main>

    </div>
</body>
</html>
