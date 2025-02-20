<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <title>SD N 1 Ngemplak</title>
</head>

<body class="scroll-smooth bg-slate-100">
    {{-- <script src="{{ asset('asset/js/spinner.js') }}"></script> --}}
    @include('layouts.header')
    @include('layouts.sidebar')
    @yield('content')
    @include('components.loading')
    @include('layouts.footer')
    @include('sweetalert::alert')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
    <script src="{{ asset('asset/js/master.js') }}"></script>

</body>

</html>
