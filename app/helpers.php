<?php

use Illuminate\Support\Facades\Auth;

function active_class($path, $active = 'bg-purple-700 hover:bg-gray-500 group-hover:bg-gray-500 text-white shadow-lg')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : 'hover:bg-gray-100 group-hover:text-gray-900';
}

function is_active_route($path)
{
    return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

function show_class($path)
{
    return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}
if (!function_exists('getUserAttribute')) {
    function getUserAttribute($attribute)
    {
        if (Auth::guard('wali')->check()) {
            return Auth::guard('wali')->user()->guru->$attribute ?? 'Tidak Diketahui';
        } elseif (Auth::guard('guru_piket')->check()) {
            return Auth::guard('guru_piket')->user()->guru->$attribute ?? 'Tidak Diketahui';
        } elseif (Auth::guard('gurus')->check()) {
            return Auth::guard('gurus')->user()->$attribute ?? 'Tidak Diketahui';
        } elseif (Auth::guard('web')->check()) {
            return Auth::guard('web')->user()->$attribute ?? 'Tidak Diketahui';
        }
        return 'Tidak Diketahui';
    }
}
