        <!-- Edit user modal -->
        <div id="edit-mapel-{{ $mp->kd_mapel }}" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 items-center backdrop-blur-sm bg-opacity-95 drop-shadow-sm  justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-xl max-h-full">
                <!-- Modal content -->
                <form class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                    action="{{ route('mapel.update', $mp->kd_mapel) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-indigo-700 dark:text-white">
                            Edit Data Mata Pelajaran
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="edit-mapel-{{ $mp->kd_mapel }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="nama_mapel"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Mapel</label>
                                <input type="text" name="nama_mapel" id="nama_mapel"
                                    class="shadow-sm bg-gray-50 border {{ $errors->has('nama_mapel') ? 'border-red-600' : 'border-gray-300' }} border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 first-letter:uppercase"
                                    value="{{ $mp->nama_mapel }}">
                                @error('nama_mapel')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <label for="kd_kelas" class="block text-gray-700 text-sm font-medium mb-2">
                                    Kelas
                                </label>
                                <select id="kd_kelas" name="kd_kelas"
                                    class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('kd_kelas') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="{{ $mp->kelas->id }}">
                                        Kelas {{ $mp->kelas->nama_kelas }}
                                    </option>
                                    <option {{ $mp->kelas_id === null ? 'disabled' : '' }}>Pilih
                                        Kelas
                                        Siswa
                                    </option>
                                    @foreach ($kelas as $ks)
                                        @if ($ks->id != $mp->kelas->id)
                                            <option value="{{ $ks->id }}"
                                                {{ old('kd_kelas') == $ks->id ? 'selected' : '' }}>
                                                Kelas {{ $ks->nama_kelas }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                                @error('kd_kelas')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <label for="hari"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hari
                                    Mapel</label>
                                <select id="hari" name="hari"
                                    class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('hari') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="" disabled {{ old('hari', $mp->hari) ? '' : 'selected' }}>
                                        Pilih
                                        Hari Mapel
                                    </option>
                                    <option value="senin" {{ old('hari', $mp->hari) == 'senin' ? 'selected' : '' }}>
                                        Senin</option>
                                    <option value="selasa" {{ old('hari', $mp->hari) == 'selasa' ? 'selected' : '' }}>
                                        Selasa</option>
                                    <option value="rabu" {{ old('hari', $mp->hari) == 'rabu' ? 'selected' : '' }}>
                                        Rabu</option>
                                    <option value="kamis" {{ old('hari', $mp->hari) == 'kamis' ? 'selected' : '' }}>
                                        Kamis</option>
                                    <option value="jumat" {{ old('hari', $mp->hari) == 'jumat' ? 'selected' : '' }}>
                                        Jumat</option>
                                    <option value="sabtu" {{ old('hari', $mp->hari) == 'sabtu' ? 'selected' : '' }}>
                                        Sabtu</option>
                                </select>
                                @error('hari')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-3 sm:col-span-3">
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
                                        min="00:00" max="18:00"
                                        value="{{ old('jam_mulai', $mp->jam_mulai ?? '00:00') }}" required />
                                </div>
                                @error('jam_mulai')
                                    <small
                                        class="mt-1
                                        ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-3 sm:col-span-3">
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
                                        min="00:00" max="18:00"
                                        value="{{ old('jam_selesai', $mp->jam_selesai ?? '00:00') }}" required />
                                </div>
                                @error('jam_mulai')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
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
