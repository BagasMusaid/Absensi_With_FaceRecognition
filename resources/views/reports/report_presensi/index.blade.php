@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <nav class="flex mt-[75px] md:mt-20" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ Route('dashbord') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ url('laporan-presensi') }}"
                            class="ms-1 text-sm font-medium  {{ request()->is('laporan-presensi') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Laporan Data Presensi</a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="p-4 bg-white dark:border-gray-700 mt-5 mb-16">
            <h2 class="font-bold md:text-2xl">Cetak Laporan Data Presensi Siswa</h2>
            <div class="border border-gray-300 rounded-sm  mt-4">
                <h2 class="font-bold text-slate-700 text-sm md:text-lg p-4">Cetak Keseluruhan</h2>
                <div class="bg-gray-100 p-4 mt-2 flex justify-center space-x-4">
                    <a href="{{ route('laporan-presensi.viewPresensi') }}"
                        class="bg-purple-500 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-purple-600">Print
                        Preview</a>
                    <a href="{{ route('laporan-presensi.downloadPresensi') }}"
                        class="bg-yellow-400 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-yellow-600">Download</a>
                    <a href="{{ route('laporan-presensi.excelPresensi') }}"
                        class="bg-red-600 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-red-700">Export
                        Excel</a>
                </div>
            </div>
            <form action="{{ route('laporan-presensi.filterPresensi') }}" method="GET" id="filterFormPresensi">
                <input type="hidden" name="action" id="formAction">
                <div class="border border-gray-300 rounded-sm mt-8 mb-5">
                    <h2 class="font-bold text-slate-700 text-sm md:text-lg p-4">Cetak Perperiode</h2>
                    <div class="flex justify-start p-4 border-t">
                        <h3 class="md:text-lg text-[10px] font-normal text-slate-700 mt-3 md:mt-1">Pilih Kelas <span
                                class="ml-0 md:ml-20">:</span>
                        </h3>
                        <div class=" ml-4 md:ml-3 px-2 ">
                            <select id="kelas" name="kelas"
                                class="block w-52 md:w-72  md:py-2.5 text-sm text-gray-900 border border-gray-300 rounded-md  bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled {{ old('kelas') ? '' : 'selected' }}>
                                    Pilih Kelas
                                </option>
                                @foreach ($kelas as $ks)
                                    <option value="{{ $ks->id }}" {{ old('kelas') == $ks->id ? 'selected' : '' }}>
                                        Kelas {{ $ks->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="bg-gray-100 flex justify-start p-4">
                        <h3 class="md:text-lg text-[10px] font-normal text-slate-700 mt-3 md:mt-2">Dari Tanggal <span
                                class="ml-0 md:ml-14">:</span>
                        </h3>
                        <div class="ml-1 md:ml-3 px-2">
                            <div class="relative max-w-md">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker id="default-datepicker" name="tanggal_awal" type="text"
                                    class="bg-gray-50 w-52 md:w-[295px] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Pilih Tanggal" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-start p-4">
                        <h3 class="md:text-lg text-[10px] font-normal text-slate-700 mt-1.5">Sampai <span
                                class=" block md:inline-block">Tanggal <span class="ml-0 md:ml-8">:</span></span>
                        </h3>

                        <div class="ml-6 md:ml-3 px-2">
                            <div class="relative max-w-md">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker id="tanggal_akhir" name="tanggal_akhir" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-52 md:w-[295px] ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Pilih Tanggal" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-100 p-4 mt-2 flex justify-center space-x-4">

                        <button type="submit"
                            class="bg-purple-500 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-purple-600"
                            onclick="submitForm('preview')">Print
                            Preview</button>
                        <button
                            class="bg-yellow-400 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-yellow-600"
                            onclick="submitForm('download')">Download</button>
                        <button
                            class="bg-red-600 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-red-700"
                            onclick="submitForm('export-excel')">Export
                            Excel</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function submitForm(action) {
            event.preventDefault(); // Biar tidak reload langsung
            document.getElementById('formAction').value = action; // set action
            document.getElementById('filterFormPresensi').submit(); // submit form
        }
    </script>
@endpush
