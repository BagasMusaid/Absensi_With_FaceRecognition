@extends('layouts.master2')
@section('content')
    <!-- component -->
    <div class="relative min-h-screen flex items-center justify-center bg-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover"
        style="background-image: url({{ asset('asset/images/login.jpg') }});">
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-lg z-10">
            <div class="grid  gap-8 grid-cols-1">
                <div>
                    <img class="w-40 h-28 mx-auto" src="{{ asset('asset/images/email.png') }}" alt="">
                    <h1 class="text-center font-bold md:text-2xl text-gray-800 text-xl">Verifikasi Email Anda</h1>
                    <p class="text-center font-light text-gray-400 mt-0.5">Silakan cek email Anda untuk memverifikasi alamat
                        email
                        Anda.</p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="flex mt-4 md:mt-6 justify-center">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Kirim Ulang Verifikasi </button>
                            <a href="https://mail.google.com"
                                class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Buka
                                Email</a>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
