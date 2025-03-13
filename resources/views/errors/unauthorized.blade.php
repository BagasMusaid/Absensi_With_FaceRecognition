@extends('layouts.master2')
@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center">
            <h1 class="font-extrabold text-9xl dark:text-gray-400">403</h1>
            <h2 class="text-2xl mt-4 font-semibold text-gray-700">Akses Ditolak</h2>
            <p class="text-gray-600 mt-2">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
            <a href="{{ route('dashbord') }}" class="mt-4 inline-block px-6 py-3 text-white bg-red-500 rounded-lg">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection
