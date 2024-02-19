<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sgg') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-10 flex flex-col min-h-screen">

    <header class="bg-white shadow-lg p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold"><a href="/home">Laravel Technical Test</a></h1>
        <a href="/departments/hierarchy" class="bg-yellow-500 text-white py-2 px-4 rounded mr-2">{{ __('home.view_full_department_hierarchy') }}</a>
        <div class="flex">
            @yield('top-controls')
        </div>
    </header>

    <main class="flex-grow">
        @if ($errors->any() || session('success'))
            <div class="mx-6 my-6">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-200 py-4 text-center">
        <p class="text-gray-500"><i class="fab fa-linkedin mr-1"></i><a class="text-sky-800" href="https://www.linkedin.com/in/sergio-gonz%C3%A1lez-g%C3%B3mez-46a30594/">LinkedIn</a></p>
        <p class="font-bold">Sergio González ✌</p>
        <p class="text-gray-500"><i class="fas fa-envelope mr-1"></i><a class="text-sky-800" href="mailto:sergiogg1337@gmail.com">sergiogg1337@gmail.com</a></p>
    </footer>
</body>
</html>
