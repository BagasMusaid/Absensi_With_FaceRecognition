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
                                            placeholder="password" value="{{ old('password') }}">
                                    </div>
                                    @error('password')
                                        <small
                                            class="mt-1 ml-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-1">
                                <button type="submit"
                                    class=" w-11/12 mx-auto block py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Daftar') }}</button>
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
