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
    return $user && $user->owner_type == \App\Master::class;
}

function operator()
{
    $user = auth()->user();
    return $user && ($user->owner_type == \App\Master::class || $user->owner_type == \App\Operator::class);
}

function organ()
{
    $user = auth()->user();
    return $user && ($user->owner_type == \App\Master::class || $user->owner_type == \App\Operator::class || $user->owner_type == \App\Organ::class );
}

function only_organ()
{
    $user = auth()->user();
    return $user && $user->owner_type == \App\Organ::class;
}

function only_operator()
{
    $user = auth()->user();
    return $user && $user->owner_type == \App\Operator::class;
}

function short($string, $n=100)
{
    return strlen($string) > $n ? mb_substr($string, 0, $n).'...' : $string;
}

function current_organ_id()
{
    $user = auth()->user();
    return $user && $user->is_organ() ? $user->owner_id : null;
}

function current_operator_id()
{
    $user = auth()->user();
    return $user && $user->is_operator() ? $user->owner_id : null;
}

function class_name($input, $prefix='App\\')
{
    return $prefix.str_replace('_', '', ucwords($input, '_'));;
}

function persian($class, $plural=false)
{
    if ($class == \App\Operator::class) {
        return $plural ? "متصدیان" : "متصدی";
    }
    if ($class == \App\Organ::class) {
        return $plural ? "موسسات" : "موسسه";
    }
    if ($class == \App\Madadju::class) {
        return $plural ? "مددجویان" : "مددجو";
    }
}


function mycompact()
{
    $args = func_get_args();
    $result = [];
    foreach ($args as $variable) {
        if (isset($$variable)) {
            $result[$variable] = $$variable;
        }
    }
    return $result;
}
