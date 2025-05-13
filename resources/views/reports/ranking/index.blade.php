@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <nav class="flex mt-[75px] md:mt-20" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ Route('dashbord') }}"
                        class="inline-flex items-center text-xs md:text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                        <a href="{{ url('ranking-kehadiran') }}"
                            class="ms-1 text-xs md:text-sm font-medium  {{ request()->is('ranking-kehadiran*') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Ranking Kehadiran</a>

                    </div>
                </li>
            </ol>
        </nav>
        <div class="p-4 bg-white dark:border-gray-700 mt-5 shadow-sm">
            <h5 class="text-gray-700 font-bold">Filters</h5>
            <form action="{{ route('ranking.kehadiran.filter') }}" method="GET">
                @csrf
                <div class="flex justify-start items-center gap-3 mt-3">
                    <div id="date-range-start" class="flex items-center gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker id="tanggal_mulai" name="tanggal_mulai" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Pilih Tanggal Mulai" autocomplete="off">
                        </div>

                    </div>
                    <div id="date-range-end" class="flex items-center gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker id="tanggal_selesai" name="tanggal_selesai" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Pilih Tanggal Mulai" autocomplete="off">
                        </div>

                    </div>
                    <button id="filter-button" type="submit"
                        class="bg-purple-500 text-white md:text-base text-[10px] px-4 md:px-6 md:font-semibold py-1 md:py-2 rounded-md">Tampilkan
                        Data</button>

                </div>
            </form>
        </div>
        <div class="p-4 bg-white dark:border-gray-700 mt-5">
            <h5 class="text-gray-700 font-bold">Ranking Siswa Banyak Sakit</h5>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right rounded-lg text-gray-500 dark:text-gray-400 mt-3">
                    <thead
                        class="text-xs text-gray-700 uppercase  bg-slate-200 border  border-slate-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-3">
                                No
                            </th>
                            <th scope="col" class="px-3 py-3 text-center">
                                NIS
                            </th>
                            <th scope="col" class="px-7 py-3 text-center">
                                Nama Siswa
                            </th>
                            <th scope="col" class="px-5 py-3 text-center">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Jumlah Sakit
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-sakit" class="bg-white">
                        @if (request()->filled('tanggal_mulai') && request()->filled('tanggal_selesai'))
                            @if (isset($rankingSakit))
                                @forelse ($rankingSakit as $item)
                                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} text-slate-700">
                                        <td class="px-3 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-3 py-3 text-center">{{ $item['nis'] }}</td>
                                        <td class="px-7 py-3 text-center">{{ $item['nama'] }}</td>
                                        <td class="px-5 py-3 text-center">{{ $item['kelas'] }}</td>
                                        <td class="px-6 py-3 text-center">{{ $item['jumlah_sakit'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-2 text-gray-400">Data siswa sakit tidak
                                            tersedia</td>
                                    </tr>
                                @endforelse
                            @endif
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-2 text-gray-400">Silakan pilih rentang tanggal.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-4 bg-white dark:border-gray-700 mt-5">
            <h5 class="text-gray-700 font-bold">Ranking Siswa Banyak Izin</h5>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right rounded-lg text-gray-500 dark:text-gray-400 mt-3">
                    <thead
                        class="text-xs text-gray-700 uppercase  bg-slate-200 border  border-slate-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-3">
                                No
                            </th>
                            <th scope="col" class="px-3 py-3 text-center">
                                NIS
                            </th>
                            <th scope="col" class="px-7 py-3 text-center">
                                Nama Siswa
                            </th>
                            <th scope="col" class="px-5 py-3 text-center">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Jumlah Izin
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-izin" class="bg-white">
                        @if (request()->filled('tanggal_mulai') && request()->filled('tanggal_selesai'))
                            @if (isset($rankingIzin))
                                @forelse ($rankingIzin as $item)
                                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} text-slate-700">
                                        <td class="px-3 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-3 py-3 text-center">{{ $item['nis'] }}</td>
                                        <td class="px-7 py-3 text-center">{{ $item['nama'] }}</td>
                                        <td class="px-5 py-3 text-center">{{ $item['kelas'] }}</td>
                                        <td class="px-6 py-3 text-center">{{ $item['jumlah_izin'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-2 text-gray-400">Data siswa izin tidak
                                            tersedia</td>
                                    </tr>
                                @endforelse
                            @endif
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-2 text-gray-400">Silakan pilih rentang tanggal.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-4 bg-white dark:border-gray-700 mt-5 mb-10">
            <h5 class="text-gray-700 font-bold">Ranking Siswa Banyak Alpha</h5>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right rounded-lg text-gray-500 dark:text-gray-400 mt-3">
                    <thead
                        class="text-xs text-gray-700 uppercase  bg-slate-200 border  border-slate-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-3">
                                No
                            </th>
                            <th scope="col" class="px-3 py-3 text-center">
                                NIS
                            </th>
                            <th scope="col" class="px-7 py-3 text-center">
                                Nama Siswa
                            </th>
                            <th scope="col" class="px-5 py-3 text-center">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Jumlah Alpha
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody-alpha" class="bg-white ">
                        @if (request()->filled('tanggal_mulai') && request()->filled('tanggal_selesai'))
                            @if (isset($rankingAlpha))
                                @forelse ($rankingAlpha as $item)
                                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} text-slate-700">
                                        <td class="px-3 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-3 py-3 text-center">{{ $item['nis'] }}</td>
                                        <td class="px-7 py-3 text-center">{{ $item['nama'] }}</td>
                                        <td class="px-5 py-3 text-center">{{ $item['kelas'] }}</td>
                                        <td class="px-6 py-3 text-center">{{ $item['jumlah_alpha'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-2 text-gray-400">Data siswa alpha tidak
                                            tersedia</td>
                                    </tr>
                                @endforelse
                            @endif
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-2 text-gray-400">Silakan pilih rentang tanggal.
                                </td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
