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
            </ol>
        </nav>

        <div class="p-4 bg-white dark:border-gray-700 mt-5">
            <div
                class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4  dark:bg-gray-900">
                <div class="flex gap-3">
                    <div
                        class="flex cursor-pointer bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg">
                        <svg class="feather feather-plus ml-3 mt-0.5 w-3 md:w-5 text-white" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <line x1="12" x2="12" y1="5" y2="19" />
                            <line x1="5" x2="19" y1="12" y2="12" />
                        </svg>
                        <a data-modal-target="tambah-presensi" data-modal-toggle="tambah-presensi"
                            class="text-white text-[11px] md:text-sm pl-1.5 pr-3 py-3 md:py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
                            Presensi Khusus</a>
                    </div>

                    <div
                        class=" flex justify-center items-center cursor-pointer border-2  border-blue-600 hover:border-blue-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg">
                        <a href="{{ Route('presensi.presensi-siswa') }}"
                            class="text-blue-600 hover:text-blue-500 font-bold text-center  text-[11px] md:text-sm px-4 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Presensi Wajah</a>
                    </div>
                </div>
                <div class="flex gap-1">
                    <div class="flex">
                        <div class=" inset-y-0 start-0 flex items-center ">
                            <svg fill="none" class="w-4 h-4 absolute ml-4 text-gray-500  dark:text-gray-400"
                                viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 7.0625C2 6.47569 2.48843 6 3.09091 6H24.9091C25.5116 6 26 6.47569 26 7.0625C26 7.64931 25.5116 8.125 24.9091 8.125H3.09091C2.48843 8.125 2 7.64931 2 7.0625Z"
                                    fill="black" />
                                <path
                                    d="M6.90909 14.5C6.90909 13.9132 7.39752 13.4375 8 13.4375H20C20.6025 13.4375 21.0909 13.9132 21.0909 14.5C21.0909 15.0868 20.6025 15.5625 20 15.5625H8C7.39752 15.5625 6.90909 15.0868 6.90909 14.5Z"
                                    fill="black" />
                                <path
                                    d="M12.3636 20.875C11.7612 20.875 11.2727 21.3507 11.2727 21.9375C11.2727 22.5243 11.7612 23 12.3636 23H15.6364C16.2388 23 16.7273 22.5243 16.7273 21.9375C16.7273 21.3507 16.2388 20.875 15.6364 20.875H12.3636Z"
                                    fill="black" />
                            </svg>

                        </div>
                        <select id="kelas" name="kelas"
                            class="block pt-2 ps-10 w-36 text-sm text-gray-900 border border-gray-300 rounded-md  bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" disabled {{ old('kelas') ? '' : 'selected' }} class="pl-0 important">
                                Filters
                            </option>
                            @foreach ($kelas as $ks)
                                <option value="{{ $ks->id }}" {{ old('kelas') == $ks->id ? 'selected' : '' }}>
                                    Kelas {{ $ks->nama_kelas }}
                                </option>
                            @endforeach
                        </select>

                    </div>
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
                                Nama Siswa
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                NIS
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Waktu
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="presensi-list">
                        @foreach ($presensi as $p)
                            <tr
                                class= "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-3">
                                    {{ $loop->iteration + ($presensi->currentPage() - 1) * $presensi->perPage() }}
                                </td>
                                <td class="px-8 py-3 text-sm font-semibold capitalize text-center">
                                    {{ $p->siswa->nama_siswa }}
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold capitalize text-center">{{ $p->siswa->NIS }}
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold capitalize text-center">
                                    {{ $p->siswa->kelas->nama_kelas }}
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold capitalize text-center">
                                    {{ $p->tanggal }}
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold capitalize text-center">
                                    {{ \Carbon\Carbon::parse($p->waktu_presensi)->format('H:i') }}
                                </td>
                                <td class="px-6 py-3 text-sm font-semibold capitalize text-center">
                                    {{ $p->status }}
                                </td>
                                @can('akses-wali')
                                    <td class="px-6 py-3 flex items-center justify-center">
                                        <!-- Modal toggle -->
                                        <div>
                                            <a type="button" id="edit-btn"
                                                data-modal-target="edit-presensi-{{ $p->id }}"
                                                data-modal-show="edit-presensi-{{ $p->id }}"
                                                data-tooltip-target="tooltip-edit-{{ $loop->iteration }}" id="edit-btn">
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
                                            @include('pages.presensi-siswa.edit', ['p' => $p])
                                        </div>
                                        <form action="{{ route('presensi-siswa.destroy', $p->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button data-tooltip-target="tooltip-delete-{{ $loop->iteration }}"
                                                type="submit">
                                                <svg class="w-6 h-6 mt-1 text-red-600 dark:text-gray-400"
                                                    viewBox="0 0 512 512" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
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
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $presensi->links() }}
        </div>
    </div>
    @include('pages.presensi-siswa.create')
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ==================== FILTER PRESENSI BERDASARKAN KELAS ====================
            const kelasSelect = document.getElementById('kelas');
            if (kelasSelect) {
                kelasSelect.addEventListener('change', function() {
                    const kelasId = this.value;

                    fetch(`/presensi/filter-by-kelas/${kelasId}`)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('presensi-list').innerHTML = data;
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                        });
                });
            }

            // ==================== SEARCH MAPEL (DEBOUNCED AJAX) ====================
            let delayTimer;
            $("#search").on("input", function() {
                clearTimeout(delayTimer);
                let search = $(this).val().trim();

                delayTimer = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('presensi-siswa.index') }}",
                        type: "GET",
                        data: {
                            search: search
                        },
                        beforeSend: function() {
                            $("#loading").show();
                        },
                        success: function(data) {
                            $("#presensi-list").html($(data).find("#presensi-list")
                                .html());
                            attachDeleteEvent(); // Re-bind delete button event

                            // Re-bind modal open buttons
                            $(document).on("click", "#edit-btn", function() {
                                let modalId = $(this).data("modal-target");
                                $("#" + modalId).removeClass("hidden").addClass(
                                    "flex backdrop-blur-sm bg-opacity-90 drop-shadow-sm"
                                );
                            });

                            // Re-bind modal close buttons
                            $(document).on("click", "[data-modal-hide]", function() {
                                let modalId = $(this).data("modal-hide");
                                $("#" + modalId).addClass("hidden");
                            });
                        },
                        complete: function() {
                            $("#loading").hide();
                        }
                    });
                }, 300); // Delay for debounce
            });

            // ==================== LOAD SISWA BERDASARKAN KELAS ====================
            const kelasDropdown = document.getElementById('kd_kelas');
            if (kelasDropdown) {
                kelasDropdown.addEventListener('change', function() {
                    let kelasId = this.value;
                    let siswaSelect = document.getElementById('nis_siswa');

                    siswaSelect.innerHTML = '<option value="">Memuat...</option>';

                    fetch(`/get-siswa-by-kelas/${kelasId}`)
                        .then(response => response.json())
                        .then(data => {
                            siswaSelect.innerHTML = '<option value="">Pilih Siswa</option>';
                            data.forEach(siswa => {
                                siswaSelect.innerHTML +=
                                    `<option value="${siswa.NIS}">${siswa.nama_siswa}</option>`;
                            });
                        })
                        .catch(error => {
                            console.error('Gagal mengambil data siswa:', error);
                            siswaSelect.innerHTML = '<option value="">Gagal memuat siswa</option>';
                        });
                });
            }
        });
    </script>
@endpush
