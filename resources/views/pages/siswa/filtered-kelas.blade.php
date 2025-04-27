@foreach ($siswa as $item)
    <tr class= "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="px-4 py-3">
            {{ $loop->iteration + ($siswa->currentPage() - 1) * $siswa->perPage() }}
        </td>
        <td class="px-7 py-3 text-center text-sm font-semibold capitalize">{{ $item->nama_siswa }}
        </td>
        <td class="px-3 py-3 text-center">{{ $item->kelas->nama_kelas }}</td>
        <td class="px-5 py-3 text-center">{{ $item->NIS }}</td>
        <td class="px-6 py-3 text-center">{{ $item->jenis_kelamin }}</td>
        <td class="px-4 py-3 text-center">{{ $item->agama }}</td>
        @can('akses-wali')
            <td class="px-10 md:px-4 py-3 text-center">
                <a href="{{ route('daftar-wajah.index', ['id' => $item->kd_siswa]) }}"
                    class="bg-purple-600 text-white py-1 px-1 md:px-2 text-[5px] font-medium rounded-md md:text-sm 
                       {{ $item->wajah()->exists() ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ $item->wajah()->exists() ? 'aria-disabled=true tabindex=-1' : '' }}>
                    Buat Data Face
                </a>
                <p
                    class="text-[6px] md:text-xs md:mt-0.5 mt-0 {{ $item->wajah()->exists() ? 'text-green-600' : 'font-normal' }}">
                    {{ $item->wajah()->exists() ? 'Tersedia' : 'Belum Tersedia' }}
                </p>
            </td>
        @endcan
        @can('akses-admin')
            <td class="px-6 py-3 flex items-center justify-center">
                <!-- Modal toggle -->
                <div>
                    <a type="button" id="edit-btn" data-modal- target="edit-siswa-{{ $item->kd_siswa }}"
                        data-modal-show="edit-siswa-{{ $item->kd_siswa }}"
                        data-tooltip-target="tooltip-edit-{{ $loop->iteration }}" data-id="{{ $item->kd_siswa }}">
                        <svg class="w-6 h-6 text-blue-600 dark:text-gray-400" viewBox="0 0 512 512" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <title />
                            <path
                                d="M464.37,49.2a22.07,22.07,0,0,0-31.88-.76L414.18,66.69l31.18,31.1,18-17.91A22.16,22.16,0,0,0,464.37,49.2Z" />
                            <polygon
                                points="252.76 336 239.49 336 208 336 176 336 176 304 176 272.51 176 259.24 185.4 249.86 323.54 112 48 112 48 464 400 464 400 188.46 262.14 326.6 252.76 336" />
                            <polygon points="400 143.16 432.79 110.3 401.7 79.21 368.85 112 400 112 400 143.16" />
                            <polygon points="208 304 239.49 304 400 143.16 400 112 368.85 112 208 272.51 208 304" />
                        </svg>
                    </a>
                    <div id="tooltip-edit-{{ $loop->iteration }}" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700 ">
                        Edit
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @include('pages.siswa.edit', ['item' => $item])
                </div>
                <form action="{{ route('siswa.destroy', ['siswa' => $item->kd_siswa]) }}" method="POST"
                    class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button data-tooltip-target="tooltip-delete-{{ $loop->iteration }}" type="submit">
                        <svg class="w-6 h-6 mt-1 text-red-600 dark:text-gray-400" viewBox="0 0 512 512" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <title />
                            <path d="M296,64H216a7.91,7.91,0,0,0-8,8V96h96V72A7.91,7.91,0,0,0,296,64Z" style="fill:none" />
                            <path d="M292,64H220a4,4,0,0,0-4,4V96h80V68A4,4,0,0,0,292,64Z" style="fill:none" />
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
