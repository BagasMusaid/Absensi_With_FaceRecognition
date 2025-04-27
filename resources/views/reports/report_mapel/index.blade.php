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
                        <a href="{{ url('laporan-mata-pelajaran') }}"
                            class="ms-1 text-sm font-medium  {{ request()->is('laporan-mata-pelajaran') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Laporan Data Mata Pelajaran</a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="p-4 bg-white dark:border-gray-700 mt-5 mb-14">
            <h2 class="font-bold md:text-2xl">Cetak Laporan Data Mata Pelajaran</h2>
            <div class="border border-gray-300 rounded-sm  mt-4">
                <h2 class="font-bold text-slate-700 text-sm md:text-lg p-4">Cetak Keseluruhan</h2>
                <div class="bg-gray-100 p-4 mt-2 flex justify-center space-x-4">
                    <a href="{{ route('laporan-mata-pelajaran.viewMapel') }}"
                        class="bg-purple-500 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-purple-600">Print
                        Preview</a>
                    <a href="{{ route('laporan-mata-pelajaran.downloadMapel') }}"
                        class="bg-yellow-400 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-yellow-600">Download</a>
                    <a href="{{ route('laporan-mata-pelajaran.excelMapel') }}"
                        class="bg-red-600 text-white text-[10px] md:text-base font-semibold py-1 px-4 md:px-8 rounded hover:bg-red-700">Export
                        Excel</a>
                </div>
            </div>
            <form action="{{ route('laporan-mata-pelajaran.filterMapel') }}" method="GET" id="filterFormPresensi">
                <input type="hidden" name="action" id="formAction">
                <div class="border border-gray-300 rounded-sm mt-8 mb-5">
                    <h2 class="font-bold text-slate-700 text-sm md:text-lg p-4">Cetak Dengan Filter</h2>
                    <div class="bg-gray-100 flex justify-start p-4">
                        <h3 class="md:text-lg text-[10px] font-normal text-slate-700 mt-2">Berdasarkan <span
                                class=" ml-0 md:ml-3 ">:</span>
                        </h3>
                        <div class=" ml-0 md:ml-3 px-2">
                            <select id="filter" name="filter"
                                class="block w-52 md:w-72 appearance-none shadow bg-white border rounded-md border-white  text-gray-700 py-2 md:py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-gray-600">
                                <option value="" disabled {{ old('filter') ? '' : 'selected' }}>Pilih Jenis
                                    Filter</option>
                                <option value="nama_mapel" {{ old('filter') == 'nama_mapel' ? 'selected' : '' }}>Nama Mapel
                                </option>
                                <option value="kelas" {{ old('filter') == 'kelas' ? 'selected' : '' }}>
                                    Kelas</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-start p-4">
                        <h3 class="md:text-lg text-[10px] font-normal text-slate-700 mt-1.5">Pencarian <span
                                class=" ml-0 md:ml-8">:</span>
                        </h3>
                        <form>
                            <div class="flex ml-3  md:ml-3 px-2">
                                <div class=" inset-y-0 start-0 flex items-center ">
                                    <svg class="w-4 h-4 absolute ml-4 text-gray-500  dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search"
                                    class="block pt-2 ps-10 text-sm py-2 md:py-2.5 text-gray-900 border  border-gray-300 rounded-md w-52 md:w-72 bg-white focus:ring-gray-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-700"
                                    placeholder="Search" autocomplete="off">
                                <input type="hidden" id="actionType" name="action" value="">
                            </div>
                        </form>
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
        function submitForm(actionType) {
            // Set the hidden input value to 'preview' or 'download'
            document.getElementById('actionType').value = actionType;

            // Submit the form
            document.getElementById('filterForm').submit();
        }
    </script>
@endpush
