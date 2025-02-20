        <!-- Edit user modal -->
        <div id="edit-tahun-ajaran-{{ $ta->id }}" tabindex="-1"
            aria-hidden="{{ $errors->any() ? 'false' : 'true' }}"
            class="fixed top-0 left-0 right-0 z-50 items-center backdrop-blur-sm bg-opacity-95 drop-shadow-sm justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <form class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                    action="{{ route('tahun-ajaran.update', $ta->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-indigo-700 dark:text-white">
                            Edit Data Tahun Ajaran
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="edit-tahun-ajaran-{{ $ta->id }}">
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
                        <div>
                            <label for="tahun_mulai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Mulai</label>
                            <input type="text" name="tahun_mulai" id="tahun_mulai"
                                class="shadow-sm bg-gray-50 border {{ $errors->has('tahun_mulai') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $ta->tahun_mulai }}">
                            @error('tahun_mulai')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="tahun_selesai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun
                                Selesai</label>
                            <input type="text" name="tahun_selesai" id="tahun_selesai"
                                class="shadow-sm bg-gray-50 border {{ $errors->has('tahun_selesai') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $ta->tahun_selesai }}">
                            @error('tahun_selesai')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="semester"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                            <select id="semester" name="semester"
                                class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 {{ $errors->has('semester') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option value="" disabled {{ old('semester', $ta->semester) ? '' : 'selected' }}>
                                    Pilih Semester
                                </option>
                                <option value="ganjil"
                                    {{ old('semester', $ta->semester) == 'ganjil' ? 'selected' : '' }}>
                                    Ganjil</option>
                                <option value="genap"
                                    {{ old('semester', $ta->semester) == 'genap' ? 'selected' : '' }}>
                                    Genap</option>
                            </select>
                            @error('semester')
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
