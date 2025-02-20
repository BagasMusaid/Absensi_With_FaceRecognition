<div id="tambah-kelas" tabindex="-0" aria-hidden="{{ $errors->any() ? 'false' : 'true' }}"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full backdrop-blur-sm bg-opacity-95 drop-shadow-sm p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="tambah-kelas">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl  dark:text-white text-center text-indigo-700 font-bold border-b pb-4">Tambah
                    Data Kelas
                </h3>
                <form class="space-y-6" method="post" action="{{ route('kelas.store') }}">
                    @csrf
                    <div>
                        <label for="nama_kelas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas"
                            class="bg-gray-50 border {{ $errors->has('nama_kelas') ? 'border-red-600' : 'border-gray-300' }}  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Masukan Nama Kelas(contoh: IV)" value="{{ old('nama_kelas') }}">
                        @error('nama_kelas')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="kd_tahun_ajaran" class="block text-gray-700 text-sm font-medium mb-2">
                            Tahun Ajaran
                        </label>
                        <select id="kd_tahun_ajaran" name="kd_tahun_ajaran"
                            class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('kd_tahun_ajaran') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                            <option value="" disabled {{ old('kd_tahun_ajaran') ? '' : 'selected' }}>Pilih Tahun
                                Ajaran
                            </option>
                            @foreach ($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}"
                                    {{ old('kd_tahun_ajaran') == $ta->id ? 'selected' : '' }}>
                                    {{ $ta->tahun_mulai }}/{{ $ta->tahun_selesai }}
                                </option>
                            @endforeach
                        </select>
                        @error('kd_tahun_ajaran')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="catatan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan Kelas</label>
                        <input type="text" name="catatan" id="catatan"
                            class="bg-gray-50 border {{ $errors->has('catatan') ? 'border-red-600' : 'border-gray-300' }}  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Masukan Catatan" value="{{ old('catatan') }}">
                        @error('catatan')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>


                    <button type="submit"
                        class="w-full text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">SIMPAN</button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
