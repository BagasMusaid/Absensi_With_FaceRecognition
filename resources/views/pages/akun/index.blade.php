@extends('layouts.master')
@section('content')
    <div class="p-4 sm:ml-64 ">
        <div class="mt-16 md:mt-20">
            <h3 class="font-semibold text-lg md:text-xl">Account Details</h3>
        </div>
        <div class="p-4 bg-white dark:border-gray-700 mt-5 ">
            <div class="flex items-start mx-5 md:mx-10 border-b border-purple-300">
                <a href="{{ url('akun') }}"
                    class="border py-2 px-6 @if (request()->is('akun')) bg-purple-700 text-white @endif">Profile</a>
                <a href="" class="border py-2 px-4">Password</a>
            </div>
            <div class="md:flex mx-5 items-center justify-between ">
                <div class="p-5 mt-10">
                    <div class="relative justify-center w-60 h-60 mx-auto">
                        <img src="{{ Auth::guard('wali')->user()->guru->foto_profil ? url(Storage::url('public/profil_wali/' . Auth::guard('wali')->user()->guru->foto_profil)) : asset('asset/images/profie.jpg') }}"
                            alt="Profile Picture"
                            class="w-full h-full rounded-full object-cover border-2 border-white shadow-lg">
                        <div
                            class="absolute bottom-3 right-5 bg-purple-700 p-1.5 rounded-full border-2 border-white cursor-pointer">
                            <a data-modal-target="edit-profil" data-modal-toggle="edit-profil">
                                <svg class="feather feather-camera w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                                    <circle cx="12" cy="13" r="4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <a data-modal-target="edit-profil" data-modal-toggle="edit-profil"
                            class="text-purple-700  cursor-pointer border border-purple-700 focus:ring-4 focus:ring-purple-300  rounded-lg mt-5 md:mt-10  text-sm font-bold px-10 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Ubah
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
                                placeholder="Masukan nama"
                                value="{{ Auth::guard('wali')->check() ? Auth::guard('wali')->user()->guru->nama_guru : Auth::user()->name }}"
                                autocomplete="off">
                        </div>
                        <div class="w-full">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" name="email" id="email" disabled
                                class="bg-gray-50 border text-gray-900  border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan email"
                                value="{{ Auth::guard('wali')->check() ? Auth::guard('wali')->user()->guru->email : Auth::user()->email }}"
                                autocomplete="off">
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
                                        {{ Auth::guard('wali')->check() && Auth::guard('wali')->user()->guru->jenis_kelamin == 'laki-laki' ? 'checked' : '' }}>
                                    <span class="text-gray-700 text-xs xl:text-base">Laki-laki</span>
                                </div>
                                <div class="border border-gray-300 pt-1.5 pb-2 pl-2 rounded-lg w-full bg-gray-50">
                                    <input type="checkbox" name="gender" disabled
                                        class="w-4 h-4  text-purple-600  border-gray-300 rounded focus:ring-blue-500"
                                        {{ Auth::guard('wali')->check() && Auth::guard('wali')->user()->guru->jenis_kelamin == 'perempuan' ? 'checked' : '' }}>
                                    <span class="text-gray-700 text-xs xl:text-base">Perempuan</span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-10 md:mt-0">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <input type="text" name="email" id="email" disabled
                                class="bg-gray-50 border text-gray-900  border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan email"
                                value="{{ Auth::guard('wali')->check() ? Auth::guard('wali')->user()->guru->alamat : Auth::user()->email }}"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="mt-10 mb-10">
                        <a data-modal-target="ubah-data" data-modal-toggle="ubah-data"
                            class="py-2 px-4 bg-purple-700 rounded-lg text-white font-semibold cursor-pointer">Ubah Data</a>
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
