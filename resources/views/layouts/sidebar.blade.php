<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-[39] w-64 h-screen pt-24 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 shadow-md"
    aria-label="Sidebar">
    <div
        class="h-full px-3 pb-4  bg-white dark:bg-gray-800 scrollbar-thin scrollbar-thumb-rounded-full scrollbar-track-rounded-full scrollbar-hide-arrow scrollbar-thumb-slate-700  overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <h5 class="text-[13px] text-gray-700 pb-1 ">UTAMA</h5>
            <li>
                <a href="{{ Route('dashbord') }}"
                    class="flex items-center p-2 text-gray-600 rounded-lg dark:text-white group {{ active_class(['dashbord']) }}">
                    <svg class="w-5 h-5 ms-2 text-gray-500 transition duration-75 {{ active_class(['dashbord']) }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-4">Dashboard</span>
                </a>

            </li>
            <h5 class="text-[13px] text-gray-700 pt-2 pb-1">KELAS</h5>
            @can('akses-presensi')
                <li>
                    <a href="{{ url('presensi-siswa') }}"
                        class="flex items-center p-2 text-gray-600  rounded-lg group {{ active_class(['presensi-siswa', 'status-presensi']) }}">
                        <svg class="flex-shrink-0 w-5 h-5 ms-2 text-gray-500 transition duration-75 {{ active_class(['presensi-siswa', 'status-presensi']) }}
                        aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-4 whitespace-nowrap">Presensi</span>
                    </a>
                </li>
            @endcan
            @can('akses-siswa')
                <li>
                    <a href="{{ url('siswa') }}"
                        class="flex items-center p-2 text-gray-600 rounded-lg {{ active_class('siswa') }} dark:text-white  dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 ms-2 {{ active_class('siswa') }} text-gray-500 transition duration-75 dark:text-gray-400  dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                            <title />
                            <path d="M256,42c-33.88,0-64-10-64-10l0,2A64,64,0,0,0,320,34l0-2S289.88,42,256,42Z" />
                            <path
                                d="M352,44c-5.49,47.76-46.79,85-96,85s-90.51-37.24-96-85L16,94,34,208l61.71,7.42c7.08.9,7.1.9,7.1,8.19L96,480H416l-6.81-256.39c-.21-7-.21-7,7.1-8.19L478,208,496,94Z" />
                        </svg>
                        <span class="flex-1 ms-4 whitespace-nowrap">Siswa</span>
                    </a>
                </li>
            @endcan
            @can('akses-guru')
                <li>
                    <a href="{{ url('guru') }}"
                        class="flex items-center {{ active_class('guru') }} p-2 text-gray-600 rounded-lg dark:text-white  dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 ms-2 {{ active_class('guru') }} text-gray-500 transition duration-75 dark:text-gray-400 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-4 whitespace-nowrap">Guru</span>
                    </a>
                </li>
            @endcan
            <li>
                <button type="button" id="master-data-btn"
                    class="flex {{ active_class(['mapel', 'kelas', 'walikelas', 'jadwal-kelas*', 'guru-piket', 'tahun-ajaran']) }} items-center w-full p-2 text-base text-gray-600 transition duration-75 rounded-lg group  dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example"
                    aria-expanded="{{ is_active_route(['mapel', 'kelas', 'walikelas', 'jadwal-kelas*', 'guru-piket', 'tahun-ajaran']) }}">
                    <svg class="flex-shrink-0 ms-2 {{ active_class(['mapel', 'kelas', 'walikelas', 'jadwal-kelas*', 'guru-piket', 'tahun-ajaran']) }} w-6 h-6  transition duration-75 text-gray-500 "
                        viewBox="0 0 512 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M276,192H422.31a2,2,0,0,0,1.42-3.41L275.41,40.27A2,2,0,0,0,272,41.69V188A4,4,0,0,0,276,192Z" />
                        <path d="M256,272c-8.82,0-16,6.28-16,14v18h32V286C272,278.28,264.82,272,256,272Z" />
                        <path
                            d="M248,224a8,8,0,0,1-8-8V32H92A12,12,0,0,0,80,44V468a12,12,0,0,0,12,12H420a12,12,0,0,0,12-12V224Zm88,175.91A16.1,16.1,0,0,1,319.91,416H192.09A16.1,16.1,0,0,1,176,399.91V320c0-10,7-16,16-16h16V286c0-25.36,21.53-46,48-46s48,20.64,48,46v18h16a15.8,15.8,0,0,1,16,16Z" />
                    </svg>
                    <span class="flex-1 ms-4 text-left rtl:text-right whitespace-nowrap">Master Data</span>
                    <svg id="master-icon"
                        class="feather feather-chevron-left w-5 h-5 transition-transform duration-300 {{ is_active_route(['mapel', 'kelas', 'walikelas', 'jadwal-kelas*', 'guru-piket', 'tahun-ajaran']) ? '-rotate-90' : 'rotate-0' }}"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                </button>
                <ul id="dropdown-example"
                    class="hidden py-2 space-y-2 {{ show_class(['mapel', 'kelas', 'walikelas', 'jadwal-kelas*', 'guru-piket', 'tahun-ajaran']) }}">

                    <li>
                        <a href="{{ url('jadwal-kelas') }}"
                            class="flex
                             items-center w-full {{ active_class(['jadwal-kelas*']) }} p-2 text-gray-600 transition duration-75 rounded-lg pl-14 group  dark:text-white dark:hover:bg-gray-700">Data
                            Jadwal</a>
                    </li>
                    @can('akses-admin')
                        <li>
                            <a href="{{ url('walikelas') }}"
                                class="flex items-center w-full p-2 {{ active_class(['walikelas']) }} text-gray-600 transition duration-75 rounded-lg pl-14 group  dark:text-white dark:hover:bg-gray-700">Data
                                Walikelas</a>
                        </li>
                        <li>
                            <a href="{{ url('kelas') }}"
                                class="flex items-center {{ active_class(['kelas']) }} w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-14 group  dark:text-white dark:hover:bg-gray-700">Data
                                Kelas</a>
                        </li>
                        <li>
                            <a href="{{ url('tahun-ajaran') }}"
                                class="flex items-center w-full {{ active_class(['tahun-ajaran']) }} p-2 text-gray-600 transition duration-75 rounded-lg pl-14 group  dark:text-white dark:hover:bg-gray-700">Data
                                Tahun Ajaran</a>
                        </li>
                    @endcan
                    @can('akses-mapel')
                        <li>
                            <a href="{{ url('/mapel') }}"
                                class="flex items-center {{ active_class(['mapel']) }} w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-14 group  dark:text-white dark:hover:bg-gray-700">Data
                                Mapel</a>
                        </li>
                    @endcan
                    @can('akses-guru_piket')
                        <li>
                            <a href="{{ url('guru-piket') }}"
                                class="flex items-center {{ active_class(['guru-piket']) }} w-full p-2 text-gray-600 transition duration-75 rounded-lg pl-14 group  dark:text-white dark:hover:bg-gray-700">Data
                                Guru Piket</a>
                        </li>
                    @endcan
                </ul>
            </li>
            <h5 class="text-[13px] text-gray-700 pt-2 pb-1">LAPORAN</h5>
            <li>
                <a href="{{ url('ranking-kehadiran') }}"
                    class="flex items-center p-2 text-gray-600 rounded-lg {{ active_class('ranking-kehadiran*') }} dark:text-white  dark:hover:bg-gray-700 group">
                    <svg viewBox="0 0 576 512"
                        class="w-5 h-5 ms-2 {{ active_class('ranking-kehadiran*') }} text-gray-500 transition duration-75 dark:text-gray-400  dark:group-hover:text-white"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M555.2 256.6L448 215.8V78.95c0-13.53-8.273-25.64-20.76-30.4l-116.8-44.42C303.2 1.377 295.6 0 288 0S272.8 1.377 265.5 4.135L148.8 48.56C136.3 53.31 128 65.42 128 78.95v136.8L20.76 256.6C8.273 261.3 0 273.5 0 287v146c0 13.53 8.273 25.65 20.76 30.4l116.8 44.42C144.8 510.6 152.4 512 160 512s15.23-1.379 22.47-4.135L288 467.7l105.5 40.15C400.8 510.6 408.4 512 416 512s15.23-1.379 22.47-4.135l116.8-44.42C567.7 458.7 576 446.6 576 433V287C576 273.5 567.7 261.3 555.2 256.6zM160 324.5L62.52 292L153.7 257.3l97.07 36.93L160 324.5zM264 425.5l-80 30.44V367.1l80-26.67V425.5zM190.5 84.03l92.08-35.03C284.3 48.34 286.2 48 288 48s3.662 .3359 5.404 .998l92.07 35.03L288 116.5L190.5 84.03zM400 129.8v80.55c-2.166 .5684-4.359 1.003-6.473 1.808L312 243.1V159.1L400 129.8zM416 324.5l-90.79-30.26l97.06-36.93l91.2 34.7L416 324.5zM528 422.4l-88 33.48V367.1l88-29.33V422.4z" />
                    </svg>
                    <span class="flex-1 ms-4 whitespace-nowrap">Ranking</span>
                </a>
            </li>
            @can('akses-laporan')
                <li>
                    <button type="button" id="Report"
                        class="flex items-center w-full {{ active_class(['laporan-guru', 'laporan-siswa', 'laporan-presensi', 'laporan-presensi', 'laporan-mata-pelajaran']) }} p-2 text-base text-gray-600 transition duration-75 rounded-lg group  dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-laporan" data-collapse-toggle="dropdown-laporan"
                        aria-expanded="{{ request()->is(['laporan-guru', 'laporan-siswa', 'laporan-presensi', 'laporan-mata-pelajaran']) ? 'true' : 'false' }}">
                        <svg class="flex-shrink-0 ms-2 {{ active_class(['laporan-guru', 'laporan-siswa', 'laporan-presensi', 'laporan-mata-pelajaran']) }} w-6 h-6 text-gray-500 transition duration-75 "
                            viewBox="0 0 512 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <title />
                            <path
                                d="M272,160V307.37l64-64L358.63,266,256,368.63,153.37,266,176,243.37l64,64V160H92a12,12,0,0,0-12,12V468a12,12,0,0,0,12,12H420a12,12,0,0,0,12-12V172a12,12,0,0,0-12-12Z" />
                            <rect height="128" width="32" x="240" y="32" />
                        </svg>
                        <span class="flex-1 ms-4 text-left rtl:text-right whitespace-nowrap">laporan</span>
                        <svg id="laporan-icon"
                            class="feather feather-chevron-left w-5 h-5 transition-transform duration-300 {{ is_active_route(['laporan-guru', 'laporan-siswa', 'laporan-presensi', 'laporan-mata-pelajaran']) ? '-rotate-90' : 'rotate-0' }}"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                    </button>
                    <ul id="dropdown-laporan"
                        class="hidden py-2 space-y-2 {{ show_class(['laporan-guru', 'laporan-siswa', 'laporan-mata-pelajaran', 'laporan-presensi']) }}">
                        @can('akses-kepala_sekolah')
                            <li>
                                <a href="{{ url('laporan-presensi') }}"
                                    class="flex items-center {{ active_class(['laporan-presensi']) }} w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group  dark:text-white dark:hover:bg-gray-700">Data
                                    Presensi</a>
                            </li>
                            <li>
                                <a href="{{ url('laporan-guru') }}"
                                    class="flex items-center w-full {{ active_class(['laporan-guru']) }} p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group  dark:text-white dark:hover:bg-gray-700">Data
                                    Guru</a>
                            </li>
                            <li>
                                <a href="{{ url('laporan-mata-pelajaran') }}"
                                    class="flex items-center w-full {{ active_class(['laporan-mata-pelajaran']) }} p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group  dark:text-white dark:hover:bg-gray-700">Data
                                    Mapel</a>
                            </li>
                        @endcan
                        @can('akses-laporan')
                            <li>
                                <a href="{{ url('laporan-siswa') }}"
                                    class="flex items-center w-full {{ active_class(['laporan-siswa']) }} p-2 text-gray-600 transition duration-75 rounded-lg pl-14 group  dark:text-white dark:hover:bg-gray-700">Data
                                    Siswa</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- <li class=" border-t">
                <div class="bg-red-500 w-full mt-4 rounded-md">
                    <a href="" class="text-center text-white block py-1">Logout</a>
                </div>

            </li> --}}
        </ul>
    </div>
</aside>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const masterDataBtn = document.getElementById('master-data-btn');
            const reports = document.getElementById('Report');
            const dropdownMenu = document.getElementById('dropdown-example');
            const dropdownReports = document.getElementById('dropdown-laporan');
            const masterIcon = document.getElementById('master-icon');
            const laporanIcon = document.getElementById('laporan-icon');


            // 🔹 Fungsi untuk memperbarui visibilitas dropdown Master Data
            function updateDropdownVisibility() {
                const isActivePage = window.location.pathname.includes('mapel') ||
                    window.location.pathname.includes('kelas') ||
                    window.location.pathname.includes('jadwal-kelas') ||
                    window.location.pathname.includes('guru-piket') ||
                    window.location.pathname.includes('tahun-ajaran') ||
                    window.location.pathname.includes('walikelas');

                if (isActivePage) {
                    dropdownMenu.classList.remove('hidden'); // Pastikan dropdown terbuka
                    masterIcon.classList.add('-rotate-90'); // Rotasi ikon
                    masterDataBtn.setAttribute('aria-expanded', 'true'); // Update atribut
                } else {
                    dropdownMenu.classList.add('hidden');
                    masterIcon.classList.remove('-rotate-90');
                    masterDataBtn.setAttribute('aria-expanded', 'false');
                }
            }

            // 🔹 Fungsi untuk memperbarui visibilitas dropdown Laporan
            function updateDropdownReports() {
                const isActiveReport = window.location.pathname.includes('laporan-guru') ||
                    window.location.pathname.includes('laporan-siswa') ||
                    window.location.pathname.includes('laporan-presensi') ||
                    window.location.pathname.includes('laporan-mata-pelajaran');

                if (dropdownReports && laporanIcon && reports) {
                    if (isActiveReport) {
                        dropdownReports.classList.remove('hidden');
                        laporanIcon.classList.add('-rotate-90');
                        reports.setAttribute('aria-expanded', 'true');
                    } else {
                        dropdownReports.classList.add('hidden');
                        laporanIcon.classList.remove('-rotate-90');
                        reports.setAttribute('aria-expanded', 'false');
                    }
                }
            }



            // 🔹 Tambahkan event listener untuk klik Master Data
            if (masterDataBtn && masterIcon) {
                masterDataBtn.addEventListener('click', () => {
                    dropdownMenu.classList.toggle('hidden');
                    masterIcon.classList.toggle('-rotate-90');
                    masterDataBtn.setAttribute('aria-expanded', dropdownMenu.classList.contains('hidden') ?
                        'false' : 'true');
                });
            }

            // 🔹 Tambahkan event listener untuk klik Laporan
            if (reports && laporanIcon && dropdownReports) {
                reports.addEventListener('click', () => {
                    dropdownReports.classList.toggle('hidden');
                    laporanIcon.classList.toggle('-rotate-90');
                    reports.setAttribute('aria-expanded', dropdownReports.classList.contains('hidden') ?
                        'false' : 'true');
                });
            }

            // 🔹 Inisialisasi status awal dropdown saat halaman dimuat
            updateDropdownVisibility();
            updateDropdownReports();

        });
    </script>
@endpush
