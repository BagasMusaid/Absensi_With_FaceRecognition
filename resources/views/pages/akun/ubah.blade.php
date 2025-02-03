<div id="edit-profil" tabindex="-6" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full backdrop-blur-sm bg-opacity-95 drop-shadow-sm p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="edit-profil">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <div class="flex items-start justify-center mx-auto ">
                    <div class="mx-auto">
                        <div class="input_field flex flex-col  mx-auto text-center mt-2">
                            <form action="" enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PUT')
                                <div class=" w-80 p-2 ">
                                    <div class="space-y-2">
                                        <div class="relative">
                                            <input type="file" name="gambarKopi" id="gambarKopi"
                                                class="opacity-0 absolute inset-0 w-full h-full cursor-pointer z-10 overflow-hidden"
                                                onchange="updateKopiName()">
                                            <div
                                                class="border-2 border-dashed border-indigo-700 md:w-30 py-3  rounded-md cursor-pointer hover:bg-gray-100 transition duration-300">
                                                <svg class="feather feather-upload text-indigo-700 mx-auto h-6 w-6 font-bold hidden md:block"
                                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                    width="24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                    <polyline points="17 8 12 3 7 8" />
                                                    <line x1="12" x2="12" y1="3" y2="15" />
                                                </svg>
                                                <div class="w-286 mx-auto ">
                                                    <p class="text-sm text-gray-600 px-2 " id="file-name">Drag and drop
                                                        your
                                                        file here or click</p>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="w-full mt-6 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                                            Upload
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
