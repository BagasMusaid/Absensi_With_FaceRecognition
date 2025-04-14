<div id="tambah-presensi" tabindex="-0" aria-hidden="{{ $errors->any() ? 'false' : 'true' }}"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full backdrop-blur-sm bg-opacity-95 drop-shadow-sm p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="tambah-presensi">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl  dark:text-white text-center text-indigo-700 font-bold border-b pb-4">Tambah
                    Presensi Khusus
                </h3>
                <form class="space-y-6" method="post" action="{{ route('presensi-siswa.store') }}">
                    @csrf
                    <div class="">
                        <label for="kd_kelas" class="block text-gray-700 text-sm font-medium mb-2">
                            Kelas Siswa
                        </label>
                        <select id="kd_kelas" name="kd_kelas"
                            class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('kd_kelas') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                            <option value="" disabled {{ old('kd_kelas') ? '' : 'selected' }}>Pilih Kelas
                                Siswa
                            </option>
                            @foreach ($kelas as $ks)
                                <option value="{{ $ks->id }}" {{ old('kd_kelas') == $ks->id ? 'selected' : '' }}>
                                    Kelas {{ $ks->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kd_kelas')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="default-datepicker" class="block text-gray-700 text-sm font-medium mb-2">
                            Tanggal Presensi
                        </label>
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker id="default-datepicker" name="tanggal" type="text"
                                class="bg-gray-50 border {{ $errors->has('tanggal') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date" autocomplete="off">
                        </div>
                        @error('tanggal')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="flex flew-row justify-between gap-4">
                        <div class="w-full">
                            <label for="nis_siswa" class="block text-gray-700 text-sm font-medium mb-2">
                                Nama Siswa
                            </label>
                            <select id="nis_siswa" name="nis_siswa"
                                class="block appearance-none w-full bg-gray-50 border rounded-lg {{ $errors->has('status') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option value="" disabled {{ old('nis_siswa') ? '' : 'selected' }}>Pilih Siswa
                                </option>
                            </select>
                            @error('nis_siswa')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                            Status Presensi
                        </label>
                        <select id="status" name="status"
                            class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('status') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                            <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih Kehadiran
                            </option>
                            <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }}>
                                Hadir
                            </option>
                            <option value="Alpha" {{ old('status') == 'Alpha' ? 'selected' : '' }}>
                                Alpha</option>
                            <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>
                                Sakit</option>
                            <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>
                                Izin</option>
                        </select>
                        @error('status')
                            <small class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                        @enderror
                    </div>


                    <button type="submit"
                        class="w-full text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">SIMPAN</button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
