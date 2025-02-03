@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 bg-white dark:border-gray-700 mt-20">
            <h2 class="font-bold md:text-2xl">Cetak Laporan Data Guru</h2>
            <div class="border border-gray-300 rounded-sm  mt-4">
                <h2 class="font-bold text-slate-700 text-sm md:text-lg p-4">Cetak Keseluruhan</h2>
                <div class="bg-gray-100 p-4 mt-2 flex justify-center space-x-4">
                    <a href="{{ route('laporan-guru.viewGuru') }}"
                        class="bg-purple-500 text-white text-[10px] md:text-base font-semibold py-1 px-8 rounded hover:bg-purple-600">Print
                        Preview</a>
                    <a href="{{ route('laporan-guru.downloadGuru') }}"
                        class="bg-yellow-400 text-white text-[10px] md:text-base font-semibold py-1 px-8 rounded hover:bg-yellow-600">Download</a>
                    <a href="{{ route('laporan-guru.download-excel') }}"
                        class="bg-red-600 text-white text-[10px] md:text-base font-semibold py-1 px-8 rounded hover:bg-red-700">Export
                        Excel</a>
                </div>
            </div>
            <form action="{{ route('laporan-guru.viewFilterGuru') }}" method="GET" id="filterForm">
                <div class="border border-gray-300 rounded-sm mt-8">
                    <h2 class="font-bold text-slate-700 text-sm md:text-lg p-4">Cetak Dengan Filter</h2>
                    <div class="bg-gray-100 flex justify-start p-4">
                        <h3 class="md:text-lg font-normal text-slate-700 mt-2">Berdasarkan <span class="ml-3">:</span>
                        </h3>
                        <div class=" ml-3 px-2">
                            <select id="filter" name="filter"
                                class="block w-64 md:w-72 appearance-none shadow bg-white border rounded-md border-white  text-gray-700 py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-gray-600">
                                <option value="" disabled {{ old('filter') ? '' : 'selected' }}>Pilih Jenis
                                    Filter</option>
                                <option value="nama_guru" {{ old('filter') == 'nama_guru' ? 'selected' : '' }}>Nama Guru
                                </option>
                                <option value="NIP" {{ old('filter') == 'NIP' ? 'selected' : '' }}>
                                    NIP</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-start p-4">
                        <h3 class="md:text-lg font-normal text-slate-700 mt-1.5">Pencarian <span class="ml-8">:</span>
                        </h3>
                        <form>
                            <div class="flex  ml-3 px-2">
                                <div class=" inset-y-0 start-0 flex items-center ">
                                    <svg class="w-4 h-4 absolute ml-4 text-gray-500  dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="search" name="search"
                                    class="block pt-2 ps-10 text-sm py-2.5 text-gray-900 border w-64 border-gray-300 rounded-md md:w-72 bg-white focus:ring-gray-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-700"
                                    placeholder="Search" autocomplete="off">
                                <input type="hidden" id="actionType" name="action" value="">
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-100 p-4 mt-2 flex justify-center space-x-4">

                        <button type="submit"
                            class="bg-purple-500 text-white text-[10px] md:text-base font-semibold py-1 px-8 rounded hover:bg-purple-600"
                            onclick="submitForm('preview')">Print
                            Preview</button>
                        <button
                            class="bg-yellow-400 text-white text-[10px] md:text-base font-semibold py-1 px-8 rounded hover:bg-yellow-600"
                            onclick="submitForm('download')">Download</button>
                        <button
                            class="bg-red-600 text-white text-[10px] md:text-base font-semibold py-1 px-8 rounded hover:bg-red-700"
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
