<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <title>SD N 1 Ngemplak</title>
</head>

<body id="body" class="scroll-smooth bg-slate-200">

    @yield('content')
    @include('sweetalert::alert')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>
