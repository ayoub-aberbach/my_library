<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title> {{ strtoupper($title) }} </title>
</head>

<body class="relative">
    @include('includes.navbar')
    <div class="flex flex-col flex-1 w-full">
        <main class="h-full overflow-y-auto">
            <div class="container px-6 mx-auto grid">
                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
