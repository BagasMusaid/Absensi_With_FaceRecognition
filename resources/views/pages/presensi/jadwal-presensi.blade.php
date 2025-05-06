<div id="jadwal-presensi" tabindex="-0" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full backdrop-blur-sm bg-opacity-95 drop-shadow-sm p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white  rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="jadwal-presensi">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-4 lg:px-8">
                <h3 class="mb-4 text-xl  dark:text-white text-indigo-700 font-bold border-b pb-3 text-center">Masukan
                    Batas Presensi
                </h3>

                <form method="post" action="{{ route('jadwal-presensi') }}">
                    @csrf
                    <div class="max-w-[29rem] mx-auto grid grid-cols-3 gap-4">
                        <div>
                            <label for="start-time"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mulai :</label>
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
                                <input type="time" id="start-time" name="jam_mulai"
                                    class="bg-gray-50 border leading-none {{ $errors->has('jam_mulai') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('jam_mulai', '00:00') }}" required />
                            </div>
                            @error('jam_mulai')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="end-time"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selesai :</label>
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
                                <input type="time" id="end-time" name="jam_selesai"
                                    class="bg-gray-50 border leading-none {{ $errors->has('jam_selesai') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('jam_selesai', '00:00') }}" required />
                            </div>
                            @error('jam_selesai')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="kelas_id" class="block text-gray-700 text-sm font-medium mb-2">
                                Kelas
                            </label>
                            <select id="kelas_id" name="kelas_id"
                                class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('kelas_id') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option value="" disabled {{ old('kelas_id') ? '' : 'selected' }}>Pilih Kelas
                                </option>
                                @foreach ($kelasDenganJadwalHariIni as $ks)
                                    <option value="{{ $ks->id }}"
                                        {{ old('kelas_id') == $ks->id ? 'selected' : '' }}>
                                        Kelas {{ $ks->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"
                        class="bg-purple-700 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 text-center w-full text-white">Lakukan
                        Presensi</button>
                </form>

            </div>

        </div>
    </div>
</div>
</div>
