@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 bg-white dark:border-gray-700 mt-20">
            <div
                class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4  dark:bg-gray-900">
                <div
                    class="flex cursor-pointer bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg">
                    <svg class="feather feather-plus ml-3 mt-0.5 w-5 text-white" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <line x1="12" x2="12" y1="5" y2="19" />
                        <line x1="5" x2="19" y1="12" y2="12" />
                    </svg>
                    <a data-modal-target="tambah-modal" data-modal-toggle="tambah-modal"
                        class="text-white  text-sm pl-1.5 pr-3 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
                        Guru</a>
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
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-8 py-3">
                            Nama Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nip
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Kelamin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No Telepone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="guru-list">
                    @foreach ($datas as $item)
                        <tr
                            class= "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-7 py-4">{{ $loop->iteration + ($datas->currentPage() - 1) * $datas->perPage() }}
                            </td>
                            <td class="px-9 py-4 text-sm font-semibold capitalize">{{ $item->nama_guru }}</td>
                            <td class="px-3 py-4">{{ $item->NIP }}</td>
                            <td class="px-8 py-4 text-center">{{ $item->alamat }}</td>
                            <td class="px-9 py-4">{{ $item->jenis_kelamin }}</td>
                            <td class="px-6 py-4">{{ $item->no_telp }}</td>
                            <td class="px-1 py-4">{{ $item->email }}</td>
                            <td class="px-6 py-4 flex items-center">
                                <!-- Modal toggle -->
                                <div>
                                    <a type="button" data-modal-target="edit-guru-{{ $item->kd_guru }}"
                                        data-modal-show="edit-guru-{{ $item->kd_guru }}"
                                        data-tooltip-target="tooltip-edit-{{ $loop->iteration }}">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-gray-400" viewBox="0 0 512 512"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <title />
                                            <path
                                                d="M464.37,49.2a22.07,22.07,0,0,0-31.88-.76L414.18,66.69l31.18,31.1,18-17.91A22.16,22.16,0,0,0,464.37,49.2Z" />
                                            <polygon
                                                points="252.76 336 239.49 336 208 336 176 336 176 304 176 272.51 176 259.24 185.4 249.86 323.54 112 48 112 48 464 400 464 400 188.46 262.14 326.6 252.76 336" />
                                            <polygon
                                                points="400 143.16 432.79 110.3 401.7 79.21 368.85 112 400 112 400 143.16" />
                                            <polygon
                                                points="208 304 239.49 304 400 143.16 400 112 368.85 112 208 272.51 208 304" />
                                        </svg>
                                    </a>
                                    <div id="tooltip-edit-{{ $loop->iteration }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700 ">
                                        Edit
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    @include('pages.guru.edit')
                                </div>
                                <form action="{{ route('guru.destroy', ['guru' => $item->kd_guru]) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button data-tooltip-target="tooltip-delete-{{ $loop->iteration }}" type="submit">
                                        <svg class="w-6 h-6 mt-1 text-red-600 dark:text-gray-400" viewBox="0 0 512 512"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <title />
                                            <path d="M296,64H216a7.91,7.91,0,0,0-8,8V96h96V72A7.91,7.91,0,0,0,296,64Z"
                                                style="fill:none" />
                                            <path d="M292,64H220a4,4,0,0,0-4,4V96h80V68A4,4,0,0,0,292,64Z"
                                                style="fill:none" />
                                            <path
                                                d="M447.55,96H336V48a16,16,0,0,0-16-16H192a16,16,0,0,0-16,16V96H64.45L64,136H97l20.09,314A32,32,0,0,0,149,480H363a32,32,0,0,0,31.93-29.95L415,136h33ZM176,416l-9-256h33l9,256Zm96,0H240V160h32ZM296,96H216V68a4,4,0,0,1,4-4h72a4,4,0,0,1,4,4Zm40,320H303l9-256h33Z" />
                                        </svg>
                                    </button>

                                    <div id="tooltip-delete-{{ $loop->iteration }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Hapus
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $datas->links() }}
        </div>
    </div>
    @include('pages.guru.create')
@endsection
@push('scripts')
    <script>
        $("#search").on("input", function() {
            let search = $(this).val();
            $.ajax({
                url: "{{ route('guru.index') }}",
                type: "GET",
                data: {
                    search: search,
                },
                success: function(data) {
                    // Only refresh the #guru-list content
                    $("#guru-list").html($(data).find("#guru-list").html());
                },
            });
        });
    </script>
@endpush
