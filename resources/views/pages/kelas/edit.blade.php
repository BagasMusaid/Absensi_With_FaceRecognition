        <!-- Edit user modal -->
        <div id="edit-kelas-{{ $ks->id }}" tabindex="-1" aria-hidden="{{ $errors->any() ? 'false' : 'true' }}"
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <form class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                    action="{{ route('kelas.update', ['kela' => $ks->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-indigo-700 dark:text-white">
                            Edit Data Kelas
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="edit-kelas-{{ $ks->id }}">
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
                            <label for="nama_kelass"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Kelas</label>
                            <input type="text" name="nama_kelass" id="nama_kelass"
                                class="shadow-sm bg-gray-50 border {{ $errors->has('nama_kelas') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $ks->nama_kelas }}">
                            @error('nama_kelass')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="nama_walas" class="block text-gray-700 text-sm font-medium mb-2">
                                Nama Walikelas
                            </label>
                            <select id="nama_walas" name="nama_walas"
                                class="block appearance-none w-full bg-gray-50 border rounded-lg  {{ $errors->has('nama_walas') ? 'border-red-600' : 'border-gray-300' }} text-gray-700 py-2.5 px-3 pr-8 leading-tight p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option value="{{ $ks->walikelas->id }}">
                                    {{ $ks->walikelas->guru->nama_guru }}
                                </option>

                                @foreach ($walas as $w)
                                    <option value="{{ $w->id }}"
                                        {{ $ks->walikelas->id == $w->id ? 'selected' : '' }}>
                                        {{ $w->guru->nama_guru }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_walas')
                                <small
                                    class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
