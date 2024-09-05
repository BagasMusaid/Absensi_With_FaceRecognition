@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 bg-white border border-slate-100 rounded-lg dark:border-gray-700 mt-16">
            <h1 class="mb-3 text-sm md:text-lg font-bold text-gray-800">Selamat Datang....</h1>
            <div class="bg-slate-100 p-3">
                {{-- presensi --}}
                <div id="alert-1"
                    class="flex justify-end items-end p-1 mb-4 text-blue-800 rounded-lg bg-gray-200 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <h2 class="uppercase hidden md:block text-xs md:text-base text-gray-600 mb-2 pb-2 ml-6 font-semibold ">
                        Klik Proses
                        Presensi
                        untuk melakukan
                        presensi</h2>
                    <div class="ml-auto flex items-center">
                        <a href="{{ route('DaftarPresensi') }}"
                            class="py-2 px-5 ml-3 mt-2 mb-2 md:text-sm text-xs font-medium text-gray-800 focus:outline-none bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-600 focus:z-10 focus:ring-4 focus:ring-gray-100">
                            Buat Pendaftaran Wajah
                        </a>
                        <a href="{{ route('PresensiSiswa') }}"
                            class="py-2 px-5 ml-3 mt-2 mb-2 md:text-sm text-xs font-medium text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 rounded-lg">
                            Proses Presensi
                        </a>
                        <button type="button"
                            class="ml-3 bg-gray-200 text-gray-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-gray-300 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                            data-dismiss-target="#alert-1" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                </div>
                {{-- end presensi --}}
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div
                        class="flex items-center justify-center md:justify-between md:p-4 md:px-6 h-24 rounded bg-white shadow-sm dark:bg-gray-800">
                        <div class="hidden md:block">
                            <svg class="flex-shrink-0 w-10 text-red-500 h-10 transition duration-75" fill="currentColor"
                                viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                <title />
                                <polygon points="48 170 48 366.92 240 480 240 284 48 170" />
                                <path d="M272,480,464,366.92V170L272,284ZM448,357.64h0Z" />
                                <polygon points="448 144 256 32 64 144 256 256 448 144" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-xs text-center md:text-start md:text-lg font-bold text-gray-700">
                                Presensi Hari
                                Ini</h2>
                            <h2 class="text-center md:text-end font-semibold text-lg">0</h2>
                            <p class="text-xs md:text-sm text-gray-300 text-center md:text-end">Dari Total 0 Siswa</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-center md:justify-between md:p-4 md:px-6 h-24 rounded bg-white shadow-sm dark:bg-gray-800">
                        <div class="hidden md:block">
                            <svg class="flex-shrink-0 w-10 text-yellow-300 h-10 transition duration-75" fill="currentColor"
                                viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                <title />
                                <path
                                    d="M84,480H28a12,12,0,0,1-12-12V92A12,12,0,0,1,28,80H84A12,12,0,0,1,96,92V468A12,12,0,0,1,84,480Z" />
                                <path d="M240,208V156a12,12,0,0,0-12-12H124a12,12,0,0,0-12,12v52Z" />
                                <path d="M112,416v52a12,12,0,0,0,12,12H228a12,12,0,0,0,12-12V416Z" />
                                <rect height="144" width="128" x="112" y="240" />
                                <path
                                    d="M340,480H268a12,12,0,0,1-12-12V44a12,12,0,0,1,12-12h72a12,12,0,0,1,12,12V468A12,12,0,0,1,340,480Z" />
                                <path
                                    d="M369,100.7l30,367.83a12,12,0,0,0,13.45,10.92l72.16-9a12,12,0,0,0,10.47-12.9L465,91.21a12,12,0,0,0-13.2-10.94l-72.13,7.51A12,12,0,0,0,369,100.7Z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-xs text-center md:text-start md:text-lg font-bold text-gray-700">Total Data
                                Kelas</h2>
                            <h2 class="text-center md:text-end font-semibold text-lg">0</h2>
                            <p class="text-xs md:text-sm text-gray-300 text-center md:text-end">Kelas Yang Ada</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-center md:justify-between md:p-4 md:px-6 h-24 rounded bg-white shadow-sm dark:bg-gray-800">
                        <div class="hidden md:block">
                            <svg class="flex-shrink-0 w-10 text-emerald-300 h-10 transition duration-75" fill="currentColor"
                                viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                <title />
                                <polygon points="480 150 256 48 32 150 256 254 480 150" />
                                <polygon
                                    points="255.71 392.95 110.9 326.75 32 362 256 464 480 362 401.31 326.7 255.71 392.95" />
                                <path
                                    d="M480,256l-75.53-33.53L256.1,290.6,107.33,222.43,32,256,256,358,480,256S480,256,480,256Z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-xs text-center md:text-start md:text-lg font-bold text-gray-700">Jumlah Siswa
                            </h2>
                            <h2 class="text-center md:text-end font-semibold text-lg">0</h2>
                            <p class="text-xs md:text-sm text-gray-300 text-center md:text-end">Total Keseluruhan</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-center md:justify-between md:p-4 md:px-6 h-24 rounded bg-white shadow-sm dark:bg-gray-800">
                        <div class="hidden md:block">
                            <svg class="flex-shrink-0 w-10 text-purple-400 h-10 transition duration-75" fill="currentColor"
                                viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                <title />
                                <polygon points="496 496 16 496 16 16 48 16 48 464 496 464 496 496" />
                                <path d="M192,432H80V208H192Z" />
                                <path d="M336,432H224V160H336Z" />
                                <path d="M479.64,432h-112V96h112Z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h2 class="text-xs text-center md:text-start md:text-lg font-bold text-gray-700">Jumlah Guru
                            </h2>
                            <h2 class="text-center md:text-end font-semibold text-lg">{{ $gurus }}</h2>
                            <p class="text-xs md:text-sm text-gray-300 text-center md:text-end">Keseluruhan Guru</p>
                        </div>
                    </div>
                </div>
                {{-- endinformasi --}}
                <div class="block md:flex md:space-x-2 px-2 lg:p-0 mt-10 mb-10">
                    <img src="{{ asset('/asset/images/bocil.png') }}" alt="" class="lg:w-2/3 w-full">
                    <div class="w-full lg:w-1/3 px-3 bg-white shadow-sm mt-3 md:mt-0">
                        <div class="flex flex-col">
                            <h2 class="p-4 text-blue-600 font-bold">Detail Informasi Data Pelajaran</h2>
                            <div class="p-4 mt-5 md:mt-10">
                                <h2 class="font-semibold">Jumlah Mata Pelajaran</h2>
                                <h3 class="font-bold text-lg">0</h3>
                            </div>
                            <div class="p-4 mt-5 md:mt-8">
                                <h2 class="font-semibold">Tahun Ajaran</h2>
                                <h3 class="font-bold text-lg">2024</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
