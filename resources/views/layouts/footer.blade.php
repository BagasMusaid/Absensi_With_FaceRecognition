<footer
    class="fixed bottom-0 w-full justify-between items-center {{ in_array(request()->path(), ['dashboard', 'akun']) ? 'hidden' : 'flex' }} px-4 py-3 border-t md:ml-64 border-slate-200 bg-slate-100">

    <span class="text-xs text-gray-800 font-bold sm:text-center">
        Copyright © {{ now()->year }} <a class="hover:underline text-blue-500">SD N 1 Ngemplak.</a>
    </span>
</footer>
