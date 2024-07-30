<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title> {{ $title }} </title>
</head>

<body>
    <div class="h-screen flex items-center justify-center">
        {{ $slot }}
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
