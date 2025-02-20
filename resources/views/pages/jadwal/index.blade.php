@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 bg-white dark:border-gray-700 mt-20">
            <div
                class="flex items-end justify-end flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4  dark:bg-gray-900">
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
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nama Walikelas
                        </th>
                        <th scope="col" class="px-4 py-3 text-center">
                            Jumlah Mapel
                        </th>
                        <th scope="col" class="px-2 py-3 text-center">
                            Jumlah Murid
                        </th>
                        <th scope="col" class="px-5 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="jadwal-list">
                    @foreach ($kelas as $ks)
                        <tr
                            class= "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-4 py-3 text-center">
                                {{ $loop->iteration + ($kelas->currentPage() - 1) * $kelas->perPage() }}
                            </td>
                            <td class="px-8 py-3 text-center text-sm font-semibold capitalize">{{ $ks->nama_kelas }}</td>
                            <td class="px-5 py-3 text-center">{{ $ks->walikelas->guru->nama_guru }}</td>
                            <td class="px-2 py-3 text-center">{{ $ks->mapel->count() }}</td>
                            <td class="px-5 py-3 text-center">{{ $ks->siswa->count() }}</td>
                            <td class="px-5 py-3 text-center mx-auto">
                                <!-- Modal toggle -->
                                <div>
                                    <a href="{{ route('jadwal.detail', $ks->id) }}"
                                        class="py-1.5 px-3 bg-purple-700 text-white text-xs rounded-md">Lihat
                                        Jadwal
                                        Kelas</a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $kelas->links() }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let delayTimer;
        $("#search").on("input", function() {
            clearTimeout(delayTimer);
            let search = $(this).val().trim();

            delayTimer = setTimeout(() => {
                $.ajax({
                    url: "{{ route('jadwal.') }}",
                    type: "GET",
                    data: {
                        search: search
                    },
                    beforeSend: function() {
                        $("#loading").show();
                    },
                    success: function(data) {
                        $("#jadwal-list").html($(data).find("#jadwal-list").html());
                    },
                    complete: function() {
                        $("#loading").hide();
                    }
                });
            }, 300);
        });
    </script>
@endpush
