@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <nav class="flex mt-20" aria-label="Breadcrumb">
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
                        <a href="{{ url('jadwal-kelas') }}"
                            class="ms-1 text-xs md:text-sm font-medium  {{ request()->is('jadwal-kelas') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Data Jadwal Kelas</a>

                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ url('jadwal-kelas') }}"
                            class="ms-1 text-xs md:text-sm font-medium  {{ request()->is('jadwal-kelas*') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Jadwal Kelas {{ $mapelDetail->nama_kelas }}</a>

                    </div>
                </li>
            </ol>
        </nav>
        <div class="p-4 bg-white dark:border-gray-700 mt-5">
            <div
                class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4  dark:bg-gray-900">
                <div
                    class="flex cursor-pointer bg-purple-700 mt-3.5 md:mt-0 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg">
                    <svg class="feather feather-arrow-left ml-3 mt-0.5 w-4 text-white" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <line x1="19" x2="5" y1="12" y2="12" />
                        <polyline points="12 19 5 12 12 5" />
                    </svg>
                    <a href="{{ url('jadwal-kelas') }}"
                        class="text-white  text-sm pl-1.5 pr-3 py-2 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</a>
                </div>

                <div class="flex">
                    <div class=" inset-y-0 start-0 flex items-center ">
                        <svg class="w-4 h-4 absolute ml-4 text-gray-500  dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="search" name="search"
                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full md:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search" autocomplete="off">
                </div>


            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right rounded-lg text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase  bg-slate-200 border  border-slate-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Nama Mapel
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Hari
                            </th>
                            <th scope="col" class="px-4 py-3 text-center">
                                Jam Mulai
                            </th>
                            <th scope="col" class="px-2 py-3 text-center">
                                Jam Selesai
                            </th>
                        </tr>
                    </thead>
                    <tbody id="detail-kelas-list">
                        @foreach ($mapel as $ks => $mp)
                            <tr
                                class= "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-3 text-center">
                                    {{ $ks + 1 }}
                                </td>
                                <td class="px-8 py-3 text-center text-sm font-semibold capitalize">{{ $mp->nama_mapel }}
                                </td>
                                <td class="px-5 py-3 text-center">{{ $mp->hari }}</td>
                                <td class="px-2 py-3 text-center">
                                    {{ \Carbon\Carbon::parse($mp->jam_mulai)->format('H:i') }}
                                </td>
                                <td class="px-2 py-3 text-center">
                                    {{ \Carbon\Carbon::parse($mp->jam_selesai)->format('H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $mapel->links() }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let delayTimer;
        $("#search").on("input", function() {
            clearTimeout(delayTimer);
            let search = $(this).val().trim();
            let kelasId = "{{ $mapelDetail->id }}";
            delayTimer = setTimeout(() => {
                $.ajax({
                    url: "{{ route('jadwal.detail', ['id' => '__ID__']) }}".replace('__ID__',
                        kelasId),
                    type: "GET",
                    data: {
                        search: search
                    },
                    beforeSend: function() {
                        $("#loading").show();
                    },
                    success: function(data) {
                        $("#detail-kelas-list").html($(data).find("#detail-kelas-list").html());
                    },
                    complete: function() {
                        $("#loading").hide();
                    }
                });
            }, 300);
        });
    </script>
@endpush
