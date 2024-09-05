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
        <div class="bg-gray-300 w-full max-w-lg p-5">
            <div class="flex justify-center gap-5 p-2 mt-2">
                <a href="{{ route('DaftarPresensi') }}"
                    class="bg-blue-600 py-2 px-8 rounded-md font-semibold text-white text-sm md:text-lg {{ Route::is('DaftarPresensi') ? 'opacity-60 cursor-not-allowed' : '' }}">Pendaftaran
                    Wajah</a>
                <a href="{{ route('PresensiSiswa') }}"
                    class="bg-blue-600 py-2 px-10 rounded-md font-semibold text-white text-sm md:text-lg {{ Route::is('PresensiSiswa') ? 'opacity-60 cursor-not-allowed' : '' }}">Presensi
                    Wajah</a>
            </div>
            <div class="-mb-3 -mt-7 ">
                <img src="{{ asset('asset/images/wajah_tidak_diketahui.png') }}" alt="tidak_ditemukan"
                    class="h-56 mx-auto block ">
                <h2 class="text-center -mt-6 font-semibold">-Wajah Tidak Dikenali-</h2>
            </div>
            <div class="mx-10 mt-5">
                <input type="text" class="w-full rounded-md border border-gray-800 focus:border-blue-500 bg-gray-200">
            </div>
            <div class="flex justify-between mx-10 mt-3">
                <h1 class="font-semibold text-gray-800 ">Jumlah Pengujian : <span>5</span></h1>
                <a href=""
                    class="bg-blue-600 py-2 px-8 rounded-md font-semibold text-white text-sm md:text-lg">Simpan Wajah</a>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('cam_js/js/face-api.min.js') }}"></script>
    <script src="{{ asset('cam_js/js/pendaftaran.js') }}"></script>
@endpush
