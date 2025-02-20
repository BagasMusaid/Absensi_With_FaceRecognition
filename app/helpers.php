<?php


function active_class($path, $active = 'bg-gray-500 hover:bg-gray-500 group-hover:bg-gray-500 text-white')
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
