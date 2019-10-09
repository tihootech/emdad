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
