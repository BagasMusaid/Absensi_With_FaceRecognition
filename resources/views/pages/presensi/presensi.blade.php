@extends('layouts.master3')
@section('content')
    <div class="py-10 px-20">
        <h1 class="text-center uppercase font-bold text-xl md:text-3xl">Presensi Wajah <br>SD Negeri 1 Ngemplak</h1>
    </div>
    <div class=" md:flex md:items-center md:justify-center md:gap-20 mt-10 px-5">
        <div id="video-container" class="relative w-full max-w-lg ">
            <video id="video" autoplay class="w-full h-[400px] border-2 border-gray-500 bg-black"></video>
            <canvas id="canvas" class="absolute top-0 z-10  left-0 w-full h-full"></canvas>
        </div>
        <div class="bg-gray-300 w-full max-w-lg p-5 h-[400px]">
            <div class="-mb-3 mt-5">
                <img src="{{ asset('asset/images/wajah_diketahui.png') }}" alt="tidak_ditemukan"
                    class="h-56 mx-auto block ">
                <h2 class="text-center -mt-6 font-semibold">-Wajah Dikenali-</h2>
            </div>
            <div id="hasilPresensi" class="mx-10 mt-7 hidden">
                <h2 id="namaPresensi" class="text-center font-bold"></h2>
                <p class="text-center font-medium text-gray-500">Berhasil Presensi</p>
            </div>
            {{-- <input type="hidden" id="NIS" value="{{ $siswa->NIS }}">
            <div class="mx-10 mt-5">
                <input type="text" class="w-full rounded-md border border-gray-800 focus:border-blue-500 bg-gray-200"
                    value="{{ $siswa->NIS }}-{{ $siswa->nama_siswa }}" readonly>
            </div> --}}

        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('cam_js/js/face-api.min.js') }}"></script>
    <script src="{{ asset('cam_js/js/presensi.js') }}"></script>
@endpush
