@extends('layouts.master2')
@section('content')
    <!-- component -->
    <div class="relative min-h-screen flex items-center justify-center bg-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover"
        style="background-image: url({{ asset('asset/images/login.jpg') }});">
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-lg z-10">
            <div class="grid  gap-8 grid-cols-1">
                <div class="flex flex-col ">
                    <h2 class="uppercase text-center mb-8 font-bold text-2xl text-gray-900">login</h2>
                    {{-- @if (session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="relative">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                autofocus
                                class="block w-full p-4 ps-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="email" required />
                            <div class=" absolute end-2.5 top-8 text-sm px-4 py-2 ">
                                <svg class="flex-shrink-0 w-7 h-7 text-slate-300 transition duration-75" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="8.5" cy="7" r="4" />
                                    <polyline points="17 11 19 13 23 9" />
                                </svg>
                            </div>

                            <div class="mt-4">

                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Password</label>
                                <input id="password" type="password" name="password" required
                                    autocomplete="current-password" placeholder="password"
                                    class="block w-full p-4 ps-5
                                text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500
                                focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

                            </div>
                            {{-- @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror --}}
                            @if (session('loginerror'))
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ session('loginerror') }}</p>
                            @endif
                            <div class="mt-4">
                                <button type="submit"
                                    class=" w-11/12 mx-auto block py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </form>
                    <h2 class="text-center">Belum punya akun ? <span class="underline text-blue-700"><a
                                href="{{ route('register') }}">Daftar</a></span>
                    </h2>
                </div>
            </div>
        </div>
    @endsection
