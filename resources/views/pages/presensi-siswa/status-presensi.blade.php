@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <nav class="flex mt-20" aria-label="Breadcrumb">
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
                        <a href="{{ url('presensi-siswa') }}"
                            class="ms-1 text-sm font-medium  {{ request()->is('presensi-siswa') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Data
                            Presensi
                            Siswa</a>

                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ url('status-presensi') }}"
                            class="ms-1 text-sm font-medium  {{ request()->is('status-presensi') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Status Presensi</a>

                    </div>
                </li>
            </ol>
        </nav>

        <div class="p-4 bg-white dark:border-gray-700 mt-5">
            <div
                class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4  dark:bg-gray-900">
                <div class="flex gap-1">
                    <form>
                        <label for="search" class="sr-only">Search</label>
                        <div class="flex">
                            <div class=" inset-y-0 start-0 flex items-center ">
                                <svg class="w-4 h-4 absolute ml-4 text-gray-500  dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="search" name="search"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full md:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search" autocomplete="off">
                        </div>
                    </form>
                </div>

            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right rounded-lg text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase  bg-slate-200 border  border-slate-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-center">
                                No
                            </th>
                            <th scope="col" class="px-8 py-3 text-center">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Jam Mulai
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Jam Selesai
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody id="presensi-list">
                        @foreach ($jadwalHariIni as $jdwl)
                            <tr
                                class= "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-3">
                                    {{ $loop->iteration + ($jadwalHariIni->currentPage() - 1) * $jadwalHariIni->perPage() }}
                                </td>
                                <td class="px-8 py-3 text-sm font-semibold capitalize text-center">
                                    {{ $jdwl->tanggal }}
                                </td>
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold capitalize text-center">
                                    {{ $jdwl->kelas->nama_kelas }}
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold capitalize text-center">
                                    {{ \Carbon\Carbon::parse($jdwl->jam_mulai)->format('H:i') }}
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold capitalize text-center">
                                    {{ \Carbon\Carbon::parse($jdwl->jam_selesai)->format('H:i') }}
                                </td>
                                <td>
                                    @if ($jdwl->status === 'live')
                                        <div class="flex justify-center items-center">
                                            <a href="{{ route('presensi.presensi-wajah', $jdwl->kelas_id) }}"
                                                class="bg-purple-500 hover:bg-purple-700 text-[10px] md:text-xs text-white font-bold py-1 px-1 md:px-4 rounded">
                                                Mulai Presensi
                                            </a>
                                        </div>
                                    @else
                                        <div class="flex justify-center items-center">
                                            <button disabled
                                                class="bg-gray-400 text-white text-[8px] md:text-xs font-bold py-1 px-2 md:px-3 rounded cursor-not-allowed">
                                                Presensi Ditutup
                                            </button>
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="mt-3">
            {{ $presensi->links() }}
        </div> --}}
    </div>
@endsection
