<div id="tambah-mapel" tabindex="-0" aria-hidden="{{ $errors->any() ? 'false' : 'true' }}"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full backdrop-blur-sm bg-opacity-95 drop-shadow-sm p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="tambah-mapel">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl  dark:text-white text-center text-indigo-700 font-bold border-b pb-4">Tambah
                    Data Mata Pelajaran
                </h3>
                <form class="space-y-6" method="post" action="{{ route('mapel.store') }}">
                    @csrf
                    <div>
                        <label for="nama_mapel"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Mapel </label>
                        <input type="text" name="nama_mapel" id="nama_mapel"
                            class="bg-gray-50 border {{ $errors->has('nama_mapel') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Masukan Nama Mapel" value="{{ old('nama_mapel') }}"
                            value="{{ old('nama_mapel') }}" autocomplete="off">
                        @error('nama_mapel')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex flew-row justify-between gap-4">
                        <div class="w-full">
                            <label for="kd_kelas" class="block text-gray-700 text-sm font-medium mb-2">
                                Kelas
                            </label>
                            <select id="kd_kelas" name="kd_kelas"
                                class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('kd_kelas') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option value="" disabled {{ old('kd_kelas') ? '' : 'selected' }}>Pilih Kelas
                                    Mapel
                                </option>
                                @foreach ($kelas as $ks)
                                    <option value="{{ $ks->id }}"
                                        {{ old('kd_kelas') == $ks->id ? 'selected' : '' }}>
                                        Kelas {{ $ks->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kd_kelas')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="hari" class="block text-gray-700 text-sm font-bold mb-2">
                                Hari
                            </label>
                            <select id="hari" name="hari"
                                class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('hari') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option value="" disabled {{ old('hari') ? '' : 'selected' }}>Pilih Hari Mapel
                                </option>
                                <option value="senin" {{ old('hari') == 'senin' ? 'selected' : '' }}>
                                    Senin
                                </option>
                                <option value="selasa" {{ old('hari') == 'selasa' ? 'selected' : '' }}>
                                    Selesa</option>
                                <option value="rabu" {{ old('hari') == 'rabu' ? 'selected' : '' }}>
                                    Rabu</option>
                                <option value="kamis" {{ old('hari') == 'kamis' ? 'selected' : '' }}>
                                    Kamis</option>
                                <option value="jumat" {{ old('hari') == 'jumat' ? 'selected' : '' }}>
                                    Jumat</option>
                                <option value="sabtu" {{ old('hari') == 'sabtu' ? 'selected' : '' }}>
                                    Sabtu</option>
                            </select>
                            @error('hari')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flew-row gap-4 justify-between">
                        <div class="w-full">
                            <label for="jam_mulai" class="block text-gray-700 text-sm font-medium mb-2">
                                Jam Mulai
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="jam_mulai" name="jam_mulai"
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    min="00:00" max="18:00" value="{{ old('jam_mulai', '00:00') }}" required />
                            </div>
                            @error('jam_mulai')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="jam_selesai" class="block text-gray-700 text-sm font-medium mb-2">
                                Jam Selesai
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="jam_selesai" name="jam_selesai"
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    min="00:00" max="18:00" value="{{ old('jam_selesai', '00:00') }}" required />
                            </div>
                            @error('jam_selesai')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <button type="submit"
                        class="w-full text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SIMPAN</button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
