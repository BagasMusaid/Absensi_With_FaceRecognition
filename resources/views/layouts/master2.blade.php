<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <title>SD N 1 Ngemplak</title>

</head>

<body data-base-url="{{ '/' }}">
    @yield('content')

    @include('sweetalert::alert')
    @vite('resources/js/app.js')
    @stack('scripts')
</body>


</html>
