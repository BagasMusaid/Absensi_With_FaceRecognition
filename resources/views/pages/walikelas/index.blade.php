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
                        <a href="{{ url('walikelas') }}"
                            class="ms-1 text-xs md:text-sm font-medium  {{ request()->is('walikelas') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                            Data Walikelas</a>

                    </div>
                </li>
            </ol>
        </nav>
        <div class="p-4 bg-white dark:border-gray-700 mt-5">
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
                    <a data-modal-target="tambah-walikelas" data-modal-toggle="tambah-walikelas"
                        class="text-white  text-sm pl-1.5 pr-3 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
                        Walikelas</a>
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
            <div class="overflow-x-auto">
                <table
                    class="min-w-[800px] w-full text-sm text-left rtl:text-right rounded-lg text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-gray-700 uppercase  bg-slate-200 border  border-slate-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-center">
                                No
                            </th>
                            <th scope="col" class="px-8 py-3 text-center">
                                Nama walikelas
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                NIP
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Jenis Kelamin
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="wali-list">
                        @foreach ($walikelas as $wk)
                            <tr
                                class= "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-3 py-3 text-center">
                                    {{ $loop->iteration + ($walikelas->currentPage() - 1) * $walikelas->perPage() }}
                                </td>
                                <td class="px-8 py-3 text-sm font-semibold capitalize text-center">
                                    {{ $wk->guru->nama_guru }}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold capitalize text-center"> <span>
                                        Kelas {{ $wk->kelas->nama_kelas }}
                                    </span></td>
                                <td class="px-6 py-3 text-center">{{ $wk->guru->NIP }}</td>
                                <td class="px-6 py-3 text-center">{{ $wk->guru->email }}</td>
                                <td class="px-6 py-3 text-center">{{ $wk->guru->jenis_kelamin }}</td>
                                <td class="px-6 py-3 text-center flex items-center justify-center">
                                    <form action="{{ route('walikelas.destroy', ['walikela' => $wk->id]) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button data-tooltip-target="tooltip-hapus-{{ $loop->iteration }}" type="submit">
                                            <svg class="w-6 h-6 mt-1 text-red-600 dark:text-gray-400 " viewBox="0 0 512 512"
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

                                        <div id="tooltip-hapus-{{ $loop->iteration }}" role="tooltip"
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
        </div>
        <div class="mt-3">
            {{ $walikelas->links() }}
        </div>
    </div>
    @include('pages.walikelas.create')
@endsection
@push('scripts')
    <script>
        let delayTimer;
        $("#search").on("input", function() {
            clearTimeout(delayTimer);
            let search = $(this).val().trim();
            delayTimer = setTimeout(() => {
                $.ajax({
                    url: "{{ route('walikelas.index') }}",
                    type: "GET",
                    data: {
                        search: search
                    },
                    beforeSend: function() {
                        $("#loading").show();
                    },
                    success: function(data) {
                        $("#wali-list").html($(data).find("#wali-list").html());
                        attachDeleteEvent
                            ();
                    },
                    complete: function() {
                        $("#loading").hide();
                    }
                });
            }, 300);
        });
    </script>
@endpush
