@extends('layouts.master2')
@section('content')
    <div class="relative min-h-screen flex items-center justify-center bg-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover"
        style="background-image: url({{ asset('asset/images/login.jpg') }});">
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        <div class="max-w-md w-full space-y-8 p-4 bg-white rounded-xl shadow-lg z-10">
            <div class="grid  gap-8 grid-cols-1">
                <div class="flex flex-col ">
                    <h2 class="uppercase text-center mb-8 mt-3 font-bold text-2xl text-gray-900">Registrasi Akun</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- component -->
                        <div class="rounded px-8 pt-3 flex flex-col my-2">
                            <div class="-mx-3 md:flex mb-3">
                                <div class="md:w-full px-3">
                                    <label
                                        class="block tracking-wide text-gray-700
                                     text-xs font-bold mb-2"
                                        for="nama">
                                        Nama
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" viewBox="0 0 512 512"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <title />
                                                <polygon
                                                    points="106 304 106 250 160 250 160 214 106 214 106 160 70 160 70 214 16 214 16 250 70 250 70 304 106 304" />
                                                <circle cx="288" cy="144" r="112" />
                                                <path
                                                    d="M288,288c-69.42,0-208,42.88-208,128v64H496V416C496,330.88,357.42,288,288,288Z" />
                                            </svg>
                                        </div>
                                        <input type="text" id="nama" name="nama"
                                            class="bg-gray-50 border {{ $errors->has('nama') ? 'border-red-600' : 'border-gray-300' }}  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="nama" value="{{ old('nama') }}">
                                    </div>
                                    @error('nama')
                                        <small
                                            class="mt-1 ml-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="-mx-3 md:flex mb-3">
                                <div class="md:w-full px-3">
                                    <label
                                        class="block tracking-wide text-gray-700
                                     text-xs font-bold mb-2"
                                        for="nama">
                                        Username
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                                                viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M512 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V96C576 60.65 547.3 32 512 32zM176 128c35.35 0 64 28.65 64 64s-28.65 64-64 64s-64-28.65-64-64S140.7 128 176 128zM272 384h-192C71.16 384 64 376.8 64 368C64 323.8 99.82 288 144 288h64c44.18 0 80 35.82 80 80C288 376.8 280.8 384 272 384zM496 320h-128C359.2 320 352 312.8 352 304S359.2 288 368 288h128C504.8 288 512 295.2 512 304S504.8 320 496 320zM496 256h-128C359.2 256 352 248.8 352 240S359.2 224 368 224h128C504.8 224 512 231.2 512 240S504.8 256 496 256zM496 192h-128C359.2 192 352 184.8 352 176S359.2 160 368 160h128C504.8 160 512 167.2 512 176S504.8 192 496 192z" />
                                            </svg>
                                        </div>
                                        <input type="text" id="username" name="username"
                                            class="bg-gray-50 border {{ $errors->has('username') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="username" value="{{ old('username') }}">
                                    </div>
                                    @error('username')
                                        <small
                                            class="mt-1 ml-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="-mx-3 md:flex mb-3">
                                <div class="md:w-full px-3">
                                    <label
                                        class="block tracking-wide text-gray-700
                                     text-xs font-bold mb-2"
                                        for="email">
                                        Email
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                                <path
                                                    d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                                <path
                                                    d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                            </svg>
                                        </div>
                                        <input type="email" id="email" name="email"
                                            class="bg-gray-50 border {{ $errors->has('email') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="email" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <small
                                            class="mt-1 ml-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="-mx-3 md:flex mb-3">
                                <div class="md:w-full px-3">
                                    <label
                                        class="block tracking-wide text-gray-700
                                     text-xs font-bold mb-2"
                                        for="password">
                                        Password
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" viewBox="0 0 512 512"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <title />
                                                <path
                                                    d="M420,192H198V111.25a58.08,58.08,0,0,1,99.07-41.07A59.4,59.4,0,0,1,314,112h38a96,96,0,1,0-192,0v80H92a12,12,0,0,0-12,12V484a12,12,0,0,0,12,12H420a12,12,0,0,0,12-12V204A12,12,0,0,0,420,192Z" />
                                            </svg>
                                        </div>
                                        <input type="password" id="password" name="password"
                                            class="bg-gray-50 border {{ $errors->has('password') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="password">
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                            onclick="togglePassword()">
                                            <svg id="openEye" viewBox="0 0 576 512"
                                                class="h-[18px] w-[18px] mr-0.5 hidden" fill="gray" stroke="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM288 432c-99.48 0-191.2-67.5-239.6-175.1C97.01 147.4 188.6 80 288 80c99.48 0 191.2 67.5 239.6 175.1C478.1 364.6 387.4 432 288 432zM288 128C217.3 128 160 185.3 160 256s57.33 128 128 128c70.64 0 128-57.32 128-127.9C416 185.4 358.7 128 288 128zM288 336c-44.11 0-80-35.89-80-80c0-.748 .1992-1.441 .2207-2.184C213.3 255.1 218.5 256 224 256c35.35 0 64-28.65 64-64c0-5.48-.875-10.72-2.184-15.78C286.6 176.2 287.3 176 288 176c44.11 0 80 35.89 80 80.05C368 300.1 332.1 336 288 336z" />
                                            </svg>
                                            <svg id="closedEye" viewBox="0 0 640 512" class="h-5 w-5 " fill="gray"
                                                stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M630.8 469.1l-103.5-81.11c31.35-31.94 57.79-70.78 77.21-114.1c1.906-4.43 3.469-12.07 3.469-17.03c0-4.977-1.562-12.6-3.469-17.03c-54.25-123.4-161.6-206.1-284.5-206.1c-62.67 0-121.2 21.95-170.8 59.62L38.81 5.116C34.41 1.679 29.19 0 24.03 0C16.91 0 9.839 3.158 5.121 9.189c-8.188 10.44-6.37 25.53 4.068 33.7l591.1 463.1c10.5 8.203 25.57 6.333 33.69-4.073C643.1 492.4 641.2 477.3 630.8 469.1zM394.4 283.8l-81.65-63.1C316.1 211.3 319.1 202.2 319.1 192c0-5.48-.8744-10.73-2.183-15.78C318.6 176.2 319.3 176 320 176c44.11 0 80 35.89 80 80.05C400 265.9 397.7 275.1 394.4 283.8zM433.2 314.2C442.4 296.8 448 277.2 448 256.1C448 185.4 390.7 128 320 128C287.8 128 258.7 140.2 236.3 159.9L188.3 122.3C228 95.03 273.1 80 320 80c99.48 0 191.2 67.5 239.6 175.1c-18.06 40.38-42.41 74.43-70.61 101.9L433.2 314.2zM320 384c13.42 0 26.16-2.643 38.31-6.477L302.8 334C279.1 328.8 259.5 312.9 248.8 291.7L192.8 247.8C192.6 250.6 192 253.2 192 256C192 326.7 249.3 384 320 384zM320 432c-99.48 0-191.2-67.5-239.6-175.1c10.83-24.22 24.09-46.03 38.81-65.86L81.28 160.4c-17.77 23.74-33.27 50.04-45.81 78.59C33.56 243.4 31.1 251 31.1 256c0 4.977 1.562 12.6 3.469 17.03c54.25 123.4 161.6 206.1 284.5 206.1c45.46 0 88.77-11.49 128.1-32.14l-42.87-33.59C378 425.4 349.5 432 320 432z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <small
                                            class="mt-1 ml-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-1">
                                <button type="submit"
                                    class=" w-11/12 mx-auto block py-3 text-base font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Daftar') }}</button>
                            </div>
                        </div>
                    </form>
                    <h2 class="text-center mb-3">Sudah punya akun ? <span class="underline text-blue-700"><a
                                href="{{ route('login') }}">Masuk</a></span>
                    </h2>
                </div>
            </div>
        </div>
    @endsection
