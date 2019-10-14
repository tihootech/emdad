<?php

function active($path)
{
    return request()->fullUrl() == url($path);
}

function expanded($array)
{
    $query = str_replace(request()->url(), '',request()->fullUrl());
    $path = request()->path();
    return in_array($path.$query,$array);
}


function select_old($key, $value, $object)
{
    return old($key) === null ? $object->$key === $value : old($key) == $value;
}

function master()
{
    $user = auth()->user();
    return $user && $user->type == 'master';
}

function operator()
{
    $user = auth()->user();
    return $user && ($user->type =='operator' || $user->type == 'master');
}

function organ()
{
    $user = auth()->user();
    return $user && ($user->type == 'organ' || $user->type =='operator' || $user->type == 'master');
}

function only_organ()
{
    $user = auth()->user();
    return $user && $user->type == 'organ';
}

function short($string, $n=100)
{
    return strlen($string) > $n ? mb_substr($string, 0, $n).'...' : $string;
}
