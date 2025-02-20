@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 bg-white dark:border-gray-700 mt-20">
            <div
                class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4  dark:bg-gray-900">
                <div
                    class="flex cursor-pointer bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg">
                    <svg class="feather feather-arrow-left ml-3 mt-0.5 w-5 text-white" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <line x1="19" x2="5" y1="12" y2="12" />
                        <polyline points="12 19 5 12 12 5" />
                    </svg>
                    <a href="{{ url('jadwal-kelas') }}"
                        class="text-white  text-sm pl-1.5 pr-3 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</a>
                </div>
                <form>
                    <label for="search" class="sr-only">Search</label>
                    <div class="flex">
                        <div class=" inset-y-0 start-0 flex items-center ">
                            <svg class="w-4 h-4 absolute ml-4 text-gray-500  dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="search" name="search"
                            class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search" autocomplete="off">
                    </div>
                </form>

            </div>
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
                            <td class="px-8 py-3 text-center text-sm font-semibold capitalize">{{ $mp->nama_mapel }}</td>
                            <td class="px-5 py-3 text-center">{{ $mp->hari }}</td>
                            <td class="px-2 py-3 text-center">{{ \Carbon\Carbon::parse($mp->jam_mulai)->format('H:i') }}
                            </td>
                            <td class="px-2 py-3 text-center">
                                {{ \Carbon\Carbon::parse($mp->jam_selesai)->format('H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
