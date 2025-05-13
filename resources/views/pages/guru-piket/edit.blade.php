        <!-- Edit user modal -->
        <div id="edit-guru-piket-{{ $GP->id }}" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 items-center  backdrop-blur-sm bg-opacity-20 d justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <form class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                    action="{{ route('guru-piket.update', $GP->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-indigo-700 dark:text-white">
                            Edit Data Guru Piket
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="edit-guru-piket-{{ $GP->id }}">
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
                                <label for="guru_id" class="block text-gray-700 text-sm font-medium mb-2">
                                    Nama Guru Piket
                                </label>
                                <select id="guru_id" name="guru_id"
                                    class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('guru_id') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="{{ $GP->guru->kd_guru }}">
                                        {{ $GP->guru->nama_guru }}
                                    </option>
                                    <option {{ $GP->id === null ? 'disabled' : '' }}>Pilih
                                        Nama Guru
                                    </option>
                                    @foreach ($gurus as $ks)
                                        @if ($ks->kd_guru != $GP->guru->kd_guru)
                                            <option value="{{ $ks->kd_guru }}"
                                                {{ old('guru_id', $GP->guru->kd_guru) == $ks->kd_guru ? 'selected' : '' }}>
                                                {{ $ks->nama_guru }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('guru_id')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="hari"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hari
                                    Piket</label>
                                <select id="hari" name="hari"
                                    class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('hari') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="" disabled {{ old('hari', $GP->hari) ? '' : 'selected' }}>
                                        Pilih
                                        Hari Piket
                                    </option>
                                    <option value="Senin" {{ old('hari', $GP->hari) == 'Senin' ? 'selected' : '' }}>
                                        Senin</option>
                                    <option value="Selasa" {{ old('hari', $GP->hari) == 'Selasa' ? 'selected' : '' }}>
                                        Selasa</option>
                                    <option value="Rabu" {{ old('hari', $GP->hari) == 'Rabu' ? 'selected' : '' }}>
                                        Rabu</option>
                                    <option value="Kamis" {{ old('hari', $GP->hari) == 'Kamis' ? 'selected' : '' }}>
                                        Kamis</option>
                                    <option value="Jumat" {{ old('hari', $GP->hari) == 'Jumat' ? 'selected' : '' }}>
                                        Jumat</option>
                                    <option value="Sabtu" {{ old('hari', $GP->hari) == 'Sabtu' ? 'selected' : '' }}>
                                        Sabtu</option>
                                </select>
                                @error('hari')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="kd_tahun_ajaran" class="block text-gray-700 text-sm font-medium mb-2">
                                    Tahun Ajaran
                                </label>
                                <select id="kd_tahun_ajaran" name="kd_tahun_ajaran"
                                    class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('kd_tahun_ajaran') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="{{ $GP->tahun_ajaran->id }}">
                                        {{ $GP->tahun_ajaran->tahun_mulai }}/{{ $GP->tahun_ajaran->tahun_selesai }}
                                    </option>
                                    <option {{ $GP->kd_tahun_ajaran === null ? '' : 'disabled' }}>Pilih
                                        Tahun Ajaran
                                    </option>
                                    @foreach ($tahunAjaran as $k)
                                        @if ($k->id != $GP->tahun_ajaran->id)
                                            <option value="{{ $k->id }}"
                                                {{ old('kd_tahun_ajaran') == $k->id ? 'selected' : '' }}>
                                                {{ $k->tahun_mulai }}/{{ $k->tahun_selesai }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                                @error('kd_tahun_ajaran')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
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
