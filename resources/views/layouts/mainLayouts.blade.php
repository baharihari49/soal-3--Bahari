<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manajemen inventory</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">

        {{-- navbar --}}

        @include('layouts.navbar')

        <!-- Sidebar -->

        @include('layouts.sidebar')

        <main class="p-4 md:ml-64 h-auto pt-20">
            @yield('section')
        </main>
    </div>
</body>

</html>