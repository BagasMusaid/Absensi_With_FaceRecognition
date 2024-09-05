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

<body id="body" class="scroll-smooth bg-slate-200">

    @yield('content')
    @include('sweetalert::alert')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

    {{-- <script>
        async function setupCamera() {
            const video = document.getElementById('video');
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                video.srcObject = stream;
                video.onloadedmetadata = () => {
                    video.play();
                };
            } catch (error) {
                console.error('Error accessing the camera: ', error);
                alert(
                    'Kamera tidak dapat diakses. Pastikan Anda telah memberikan izin dan perangkat mendukung penggunaan kamera.'
                );
            }
        }

        setupCamera();
    </script> --}}
</body>

</html>
