@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64 ">
        <div class="mt-16 md:mt-20">
            <h3 class="font-semibold text-lg md:text-xl">Account Details</h3>
        </div>
        <div class="p-4 bg-white dark:border-gray-700 mt-5 ">
            <div
                class="inline-flex items-start mx-5 md:mx-10 gap-2 
             bg-gray-300 rounded-md p-1.5 border-purple-300">
                <div class="flex bg-purple-700 text-white items-center justify-center px-4 gap-2 rounded-md">
                    <svg viewBox="0 0 576 512" class="w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z" />
                    </svg>
                    <a href="{{ url('akun') }}"
                        class="py-2 font-semibold {{ request()->is('akun') ? 'text-white' : 'text-gray-700' }}">
                        Profile
                    </a>
                </div>
                <div class="flex  text-gray-700 items-center justify-center px-4 gap-2 rounded-md">
                    <svg style="enable-background:new 0 0 24 24;" class="w-5" fill="currentColor" version="1.1"
                        viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="info" />
                        <g id="icons">
                            <path
                                d="M20,10h-4H8l0-2.8c0-2.1,1.5-4,3.6-4.2C14,2.8,16,4.7,16,7l0,0c0,0.6,0.4,1,1,1h1c0.6,0,1-0.4,1-1l0,0   c0-3.8-3-6.9-6.8-7C8.3-0.1,5,3.1,5,7v3H4c-1.1,0-2,0.9-2,2v7c0,2.8,2.2,5,5,5h10c2.8,0,5-2.2,5-5v-7C22,10.9,21.1,10,20,10z    M13,17.7V19c0,0.5-0.5,1-1,1s-1-0.5-1-1v-1.3c-0.6-0.3-1-1-1-1.7c0-1.1,0.9-2,2-2s2,0.9,2,2C14,16.7,13.6,17.4,13,17.7z"
                                id="password" />
                        </g>
                    </svg>
                    <a href=""
                        class="py-2 font-semibold {{ request()->is('password') ? 'text-white' : 'text-gray-700' }}">
                        Password
                    </a>
                </div>
            </div>
            <div class="md:flex mx-5 items-center justify-between ">
                <div class="p-5 mt-10">
                    <div class="relative justify-center w-60 h-60 mx-auto">
                        @php
                            if (Auth::guard('wali')->check()) {
                                $user = Auth::guard('wali')->user();
                                $foto =
                                    $user->guru && $user->foto_profil
                                        ? url(Storage::url('public/profil_wali/' . $user->foto_profil))
                                        : asset('asset/images/profie.jpg');
                            } elseif (Auth::guard('guru_piket')->check()) {
                                $user = Auth::guard('guru_piket')->user();
                                $foto = $user->foto_profil
                                    ? url(Storage::url('public/profil_guru_piket/' . $user->foto_profil))
                                    : asset('asset/images/profie.jpg');
                            } elseif (Auth::guard('gurus')->check()) {
                                $user = Auth::guard('gurus')->user();
                                $foto = $user->foto_profil
                                    ? url(Storage::url('public/profil_guru/' . $user->foto_profil))
                                    : asset('asset/images/profie.jpg');
                            } elseif (Auth::guard('web')->check()) {
                                $user = Auth::guard('web')->user();
                                $foto = $user->foto_profil
                                    ? url(Storage::url('public/profil_user/' . $user->foto_profil))
                                    : asset('asset/images/profie.jpg');
                            } else {
                                $foto = asset('asset/images/profie.jpg');
                            }
                        @endphp

                        <img src="{{ $foto }}" alt="Profile Picture"
                            class="w-full h-full rounded-full object-cover border-2 border-white shadow-lg">

                        <div
                            class="absolute bottom-3 right-5 bg-purple-700 p-1.5 rounded-full border-2 border-white cursor-pointer">
                            <a data-modal-target="edit-profil" data-modal-toggle="edit-profil">
                                <svg class="feather feather-camera w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d=" M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0
                                                                                                                                                                                                                                                                                                                                                                                                            1 2 2z" />
                                    <circle cx="12" cy="13" r="4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <a data-modal-target="edit-profil" data-modal-toggle="edit-profil"
                            class="text-purple-700  cursor-pointer border border-purple-700 focus:ring-4 focus:ring-purple-300  rounded-lg mt-5 md:mt-7  text-sm font-bold px-10 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Ubah
                            Profil</a>
                    </div>
                    <div class="flex justify-center mt-2 cursor-pointer">
                        <a href="{{ url('') }}" class="text-center font-semibold text-red-600 text-sm ">Delete
                            Profil</a>
                    </div>
                </div>
                <div class=" w-full md:ml-24 mt-5">
                    <div class="flex flex-row gap-4 justify-between ">
                        <div class="w-full">
                            <label for="nama"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="nama" id="nama" disabled
                                class="bg-gray-50 border text-left border-gray-300
                                text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 
                                block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 
                                dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan nama" value="{{ getUserAttribute('nama_guru') }}" autocomplete="off">
                        </div>
                        <div class="w-full">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" name="email" id="email" disabled
                                class="bg-gray-50 border text-gray-900  border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan email" value="{{ getUserAttribute('email') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="md:flex md:flex-row gap-4 justify-between mt-10">
                        <div class="w-full">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                Kelamin</label>
                            <div class="flex w-full gap-3">
                                <div class="border border-gray-300 pt-1.5 pb-2 pl-2 rounded-lg w-full bg-gray-50">
                                    <input type="checkbox" name="gender" disabled
                                        class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-blue-500"
                                        {{ getUserAttribute('jenis_kelamin') == 'laki-laki' ? 'checked' : '' }}>
                                    <span class="text-gray-700 text-xs xl:text-base">Laki-laki</span>
                                </div>
                                <div class="border border-gray-300 pt-1.5 pb-2 pl-2 rounded-lg w-full bg-gray-50">
                                    <input type="checkbox" name="gender" disabled
                                        class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-blue-500"
                                        {{ getUserAttribute('jenis_kelamin') == 'perempuan' ? 'checked' : '' }}>
                                    <span class="text-gray-700 text-xs xl:text-base">Perempuan</span>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-10 md:mt-0">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="email" id="email" disabled
                                class="bg-gray-50 border text-gray-900  border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan email" value="{{ getUserAttribute('alamat') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="mt-10 mb-10">
                        <a data-modal-target="ubah-data" data-modal-toggle="ubah-data"
                            class="py-2 px-4 bg-purple-700 rounded-lg text-white font-semibold cursor-pointer">Ubah
                            Data</a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    @include('pages.akun.ubah')
    @include('pages.akun.edit-data')
@endsection
@push('scripts')
    <script>
        document.querySelectorAll('.single-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                document.querySelectorAll('.single-checkbox').forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
            });
        });

        function updateNameProfil() {
            const fileInput = document.getElementById('foto_profil');
            const fileNameContainer = document.getElementById('file-name');

            if (fileInput.files.length > 0) {
                fileNameContainer.textContent = fileInput.files[0].name;
            } else {
                fileNameContainer.textContent = 'Drag and drop your file here or click';
            }
        }
    </script>
@endpush
