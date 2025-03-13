<!-- Edit user modal -->
<div id="ubah-data" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 items-center backdrop-blur-sm bg-opacity-95 drop-shadow-sm  justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <form class="relative bg-white rounded-lg shadow dark:bg-gray-700"
            action="{{ isset($user) ? route('akun.updateData', $param) : '#' }}" method="POST">
            @csrf
            @method('PATCH')
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-indigo-700 dark:text-white">
                    Edit Data Profil
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="ubah-data">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="  mx-5 mt-5 mb-5">
                <div class="flex flex-row gap-4 justify-between ">
                    <div class="w-full">
                        <label for="nama"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="bg-gray-50 border text-left 
                            text-gray-900 {{ $errors->has('nama') ? 'border-red-600' : 'border-gray-300' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 
                            block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500  
                            dark:placeholder-gray-400 dark:text-white"
                            placeholder="Masukan Nama" value="{{ getUserAttribute('nama_guru') }}" autocomplete="off">
                        @error('nama')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border text-gray-900  {{ $errors->has('email') ? 'border-red-600' : 'border-gray-300' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Masukan Email" value="{{ getUserAttribute('email') }}" autocomplete="off">
                        @error('email')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:flex-row gap-4 justify-between mt-10">
                    <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                            Kelamin</label>
                        <div class="flex w-full gap-3">
                            <div class="border border-gray-300 pt-1.5 pb-2 pl-2 rounded-lg w-full bg-gray-50">
                                <input type="checkbox" name="gender" value="laki-laki"
                                    class="w-4 h-4  single-checkbox text-purple-600 border-gray-300 rounded focus:ring-blue-500"
                                    {{ getUserAttribute('jenis_kelamin') == 'laki-laki' ? 'checked' : '' }}>
                                <span class="text-gray-700 text-sm xl:text-base">Laki-laki</span>
                            </div>
                            <div class="border border-gray-300 pt-1.5 pb-2 pl-2 rounded-lg w-full bg-gray-50">
                                <input type="checkbox" name="gender" value="perempuan"
                                    class="w-4 h-4 single-checkbox text-purple-600  border-gray-300 rounded focus:ring-blue-500"
                                    {{ getUserAttribute('jenis_kelamin') == 'perempuan' ? 'checked' : '' }}>
                                <span class="text-gray-700 text-sm xl:text-base">Perempuan</span>
                            </div>
                        </div>
                        @error('gender')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-full mt-10 md:mt-0">
                        <label for="alamat"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                            class="bg-gray-50 border text-gray-900  {{ $errors->has('alamat') ? 'border-red-600' : 'border-gray-300' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Masukan Alamat" value="{{ getUserAttribute('alamat') }}" autocomplete="off">
                        @error('alamat')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Ubah
                    Data</button>
            </div>
        </form>
    </div>
</div>
