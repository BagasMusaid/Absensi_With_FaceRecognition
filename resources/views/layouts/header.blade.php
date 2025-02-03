<nav class="fixed top-0 z-[40] w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow-sm">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a class="flex ms-2 md:me-24">
                    <img src="{{ asset('asset/images/sekolah.png') }}" class="h-12  me-3 md:h-10 md:mt-1"
                        alt="logo sekolah" />
                    <span
                        class="self-center text-sm font-bold sm:text-base uppercase whitespace-nowrap dark:text-white">Presensi
                        SD Negeri <br> 1 Ngemplak</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="{{ Auth::user()->poto ? url(Storage::url(Auth::user()->poto)) : asset('asset/images/profie.jpg') }}"
                                alt="photo profile">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white border divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-semibold text-gray-900 uppercase" role="none">
                                @if (Auth::guard('wali')->check())
                                    {{ Auth::guard('wali')->user()->guru->nama_guru }}
                                @else
                                    {{ Auth::user()->name }}
                                @endif
                            </p>
                            <p class="text-sm font-normal text-gray-700 truncate dark:text-gray-300" role="none">
                                @if (Auth::guard('wali')->check())
                                    {{ Auth::guard('wali')->user()->guru->email }}
                                @else
                                    {{ Auth::user()->email }}
                                @endif
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ url('dashbord') }}"
                                    class="block px-4 py-2 text-sm {{ active_class(['dashbord']) }} text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ url('akun') }}"
                                    class="block px-4 {{ active_class(['akun']) }} py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Account</a>
                            </li>
                            <li>
                                <form id="logout-form" action="{{ url('logout') }}" method="GET"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a class="logout-link block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.logout-link').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin logout?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Logout',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'bg-red-600 text-white',
                            cancelButton: 'bg-gray-300 text-gray-700'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form')
                                .submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
