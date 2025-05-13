@extends('layouts.master2')
@section('content')
    <!-- component -->
    <div class="relative min-h-screen flex items-center justify-center bg-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover"
        style="background-image: url({{ asset('asset/images/login.jpg') }});">
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        <div class="max-w-md w-full space-y-8 p-10 z-10">
            <div class="grid  gap-8 grid-cols-1">
                <div>
                    <img src="{{ asset('asset/images/tut.png') }}" class="w-28 h-28 mx-auto" alt="">
                    <h1 class="text-center font-bold md:text-2xl text-white text-xl">Forgot Password</h1>
                    <p class="text-center font-semibold text-gray-400 mb-4">Silahkan Masukan Email Anda.</p>
                    <div class=" bg-white rounded-xl shadow-lg px-4 py-7">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Email</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 {{ $errors->has('email') ? 'mb-5' : '' }}"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 20 16">
                                        <path
                                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                        <path
                                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email"
                                    class="bg-gray-50 border {{ $errors->has('email') ? 'border-red-600' : 'border-gray-300 ' }} border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="name@gmail.com" value="{{ old('email') }}">
                                @error('email')
                                    <small class="mt-1 ml-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full mt-2.5">
                                <label for="guard" class="block text-gray-700 text-sm font-medium mb-2">
                                    Pilih Akun
                                </label>
                                <select id="guard" name="guard"
                                    class="block appearance-none w-full bg-gray-50 border rounded-lg border-gray-300 text-gray-700 py-2.5 px-3 pr-8 leading-tight  p-2.5 focus:outline-none focus:bg-white focus:border-indigo-500">
                                    <option value="" disabled {{ old('guard') ? '' : 'selected' }}>Pilih Akun Yang
                                        Direset</option>
                                    <option value="web">Admin</option>
                                    <option value="gurus">
                                        Kepala Sekolah
                                    </option>
                                    <option value="wali">
                                        Walikelas</option>
                                    <option value="guru_piket">
                                        Guru Piket</option>
                                </select>
                            </div>
                            <div class="flex mt-3 md:mt-4 justify-center">
                                <button type="submit"
                                    class=" w-10/12 text-center px-4 py-2 text-sm font-medium  text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                    Submit </button>
                            </div>
                            <h2 class="text-center mt-2 text-sm">Kembali ke Login? <span class=" text-blue-700 underline"><a
                                        href="{{ route('login') }}">Login</a></span>
                            </h2>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
