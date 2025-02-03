@extends('layouts.master2')
@section('content')
    <!-- component -->
    <div class="relative min-h-screen flex items-center justify-center bg-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover"
        style="background-image: url({{ asset('asset/images/login.jpg') }});">
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        <div class="max-w-lg w-full space-y-8 p-10 z-10">
            <div class="grid  gap-8 grid-cols-1">
                <div class=" bg-white rounded-xl shadow-lg px-7 py-7">
                    <div class="flex justify-center items-center mb-2">
                        <div class=" bg-purple-50 p-2 rounded-md">
                            <svg class="feather feather-lock text-purple-500" fill="none" height="24"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <rect height="11" rx="2" ry="2" width="18" x="3" y="11" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="font-bold text-gray-700 text-xl mb-1 text-center">Create New Password</h2>
                    <p class="font-light text-gray-500 text-[15px] text-center">Masukkan kata sandi baru di bawah ini untuk
                        menyelesaikan reset
                        password</p>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mt-4">
                            <label for="email"
                                class="block mb-2 ml-0.5 text-sm font-medium text-gray-400 dark:text-white">
                                Email</label>
                            <div class="relative">
                                <input type="email" id="email" name="email"
                                    class="bg-gray-50 border {{ $errors->has('email') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-4 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Enter email">
                                @error('email')
                                    <small class="mt-1 ml-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="password"
                                class="block mb-2 ml-0.5 text-sm font-medium text-gray-400 dark:text-white">New
                                Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="bg-gray-50 border {{ $errors->has('password') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-4 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Enter password">
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                    onclick="togglePassword()">
                                    <svg id="openEye" viewBox="0 0 576 512" class="h-[18px] w-[18px] mr-0.5 hidden"
                                        fill="gray" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
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
                                <small class="mt-1 ml-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="password"
                                class="block mb-2 ml-0.5 text-sm font-medium text-gray-400 dark:text-white">Confirm
                                Password</label>
                            <div class="relative">
                                <input type="password" id="passwordNew" name="password_confirmation"
                                    class="bg-gray-50 border {{ $errors->has('password_confirmation') ? 'border-red-600' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-4 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Re-enter password confirmation">
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                    onclick="togglePasswordNew()">
                                    <svg id="openEyeIcon" viewBox="0 0 576 512" class="h-[18px] w-[18px] mr-0.5 hidden"
                                        fill="gray" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM288 432c-99.48 0-191.2-67.5-239.6-175.1C97.01 147.4 188.6 80 288 80c99.48 0 191.2 67.5 239.6 175.1C478.1 364.6 387.4 432 288 432zM288 128C217.3 128 160 185.3 160 256s57.33 128 128 128c70.64 0 128-57.32 128-127.9C416 185.4 358.7 128 288 128zM288 336c-44.11 0-80-35.89-80-80c0-.748 .1992-1.441 .2207-2.184C213.3 255.1 218.5 256 224 256c35.35 0 64-28.65 64-64c0-5.48-.875-10.72-2.184-15.78C286.6 176.2 287.3 176 288 176c44.11 0 80 35.89 80 80.05C368 300.1 332.1 336 288 336z" />
                                    </svg>
                                    <svg id="closedEyeIcon" viewBox="0 0 640 512" class="h-5 w-5 " fill="gray"
                                        stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M630.8 469.1l-103.5-81.11c31.35-31.94 57.79-70.78 77.21-114.1c1.906-4.43 3.469-12.07 3.469-17.03c0-4.977-1.562-12.6-3.469-17.03c-54.25-123.4-161.6-206.1-284.5-206.1c-62.67 0-121.2 21.95-170.8 59.62L38.81 5.116C34.41 1.679 29.19 0 24.03 0C16.91 0 9.839 3.158 5.121 9.189c-8.188 10.44-6.37 25.53 4.068 33.7l591.1 463.1c10.5 8.203 25.57 6.333 33.69-4.073C643.1 492.4 641.2 477.3 630.8 469.1zM394.4 283.8l-81.65-63.1C316.1 211.3 319.1 202.2 319.1 192c0-5.48-.8744-10.73-2.183-15.78C318.6 176.2 319.3 176 320 176c44.11 0 80 35.89 80 80.05C400 265.9 397.7 275.1 394.4 283.8zM433.2 314.2C442.4 296.8 448 277.2 448 256.1C448 185.4 390.7 128 320 128C287.8 128 258.7 140.2 236.3 159.9L188.3 122.3C228 95.03 273.1 80 320 80c99.48 0 191.2 67.5 239.6 175.1c-18.06 40.38-42.41 74.43-70.61 101.9L433.2 314.2zM320 384c13.42 0 26.16-2.643 38.31-6.477L302.8 334C279.1 328.8 259.5 312.9 248.8 291.7L192.8 247.8C192.6 250.6 192 253.2 192 256C192 326.7 249.3 384 320 384zM320 432c-99.48 0-191.2-67.5-239.6-175.1c10.83-24.22 24.09-46.03 38.81-65.86L81.28 160.4c-17.77 23.74-33.27 50.04-45.81 78.59C33.56 243.4 31.1 251 31.1 256c0 4.977 1.562 12.6 3.469 17.03c54.25 123.4 161.6 206.1 284.5 206.1c45.46 0 88.77-11.49 128.1-32.14l-42.87-33.59C378 425.4 349.5 432 320 432z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="flex mt-3 md:mt-4 justify-center">
                            <button type="submit"
                                class=" w-full text-center px-4 py-3 text-sm font-medium  text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                Reset Password </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
