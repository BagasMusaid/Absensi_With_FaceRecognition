        <!-- Edit user modal -->
        <div id="edit-guru-{{ $item->kd_guru }}" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <form class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                    action="{{ route('guru.update', ['guru' => $item->kd_guru]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-indigo-700 dark:text-white">
                            Edit Data Guru
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="edit-guru-{{ $item->kd_guru }}">
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
                            <div class="col-span-6 sm:col-span-3">
                                <label for="nama_guru"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Guru</label>
                                <input type="text" name="nama_guru" id="nama_guru"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $item->nama_guru }}">
                                @error('nama_guru')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="nip_guru"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP
                                    Guru</label>
                                <input type="text" inputmode="numeric" name="nip_guru" id="nip_guru"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $item->NIP }}">
                                @error('nip_guru')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="gender_guru"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                    Kelamin</label>
                                <select id="gender_guru" name="gender_guru"
                                    class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 text-gray-700 py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="" disabled
                                        {{ old('gender_guru', $item->jenis_kelamin) ? '' : 'selected' }}>Pilih Jenis
                                        Kelamin
                                    </option>
                                    <option value="laki-laki"
                                        {{ old('gender_guru', $item->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="perempuan"
                                        {{ old('gender_guru', $item->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="tlp_guru"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepone
                                </label>
                                <input type="text" inputmode="numeric" name="tlp_guru" id="tlp_guru"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $item->no_telp }}">
                                @error('tlp_guru')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="email_guru"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email_guru" id="email_guru"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $item->email }}">
                                @error('email_guru')
                                    <small
                                        class="mt-1 ml-1 text-[10px] text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="alamat_guru"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                <input type="text" name="alamat_guru" id="alamat_guru"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $item->alamat }}">
                                @error('alamat_guru')
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
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
