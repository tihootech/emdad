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
    return $user && ( $user->owner_type == \App\Master::class || $user->owner_type == \App\Root::class);
}

function root()
{
    $user = auth()->user();
    return $user && $user->owner_type == \App\Root::class;
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
    return $user && $user->is_organ() ? $user->owner_id : 0;
}

function current_operator_id()
{
    $user = auth()->user();
    return $user && $user->is_operator() ? $user->owner_id : 0;
}

function class_name($input, $prefix='App\\')
{
    return $prefix.str_replace('_', '', ucwords($input, '_'));;
}

function persian($class, $plural=false)
{
    if ($class == \App\Operator::class) {
        return $plural ? "مددکارها" : "مددکار";
    }
    if ($class == \App\Organ::class) {
        return $plural ? "موسسات" : "موسسه";
    }
    if ($class == \App\Madadju::class) {
        return $plural ? "مددجویان" : "مددجو";
    }
    if ($class == \App\Master::class) {
        return "مرکز";
    }
    return $class;
}

function english($class)
{
    if ($class == \App\Operator::class) return "operator";
    if ($class == \App\Organ::class) return "organ";
    if ($class == \App\Madadju::class) return "madadju";
    if ($class == \App\Master::class) return "master";
    return $class;
}

function rs($length = 10) {
    return substr(str_shuffle(str_repeat($x='123456789ABCDEFGHJKLMNPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function upload($new_file, $old_file=null)
{
    delete_file($old_file);
    if ($new_file) {
        $relarive_path = "storage/app/public";
        $file_name = random_sha(20) . '.' . $new_file->getClientOriginalExtension();
        $result = $new_file->move(base_path($relarive_path),$file_name);
        return 'storage/' . $file_name;
    }else {
        return null;
    }
}

function delete_file($file)
{
    if ($file && file_exists($file)) {
        \File::delete($file);
    }
}

function random_sha($l=10)
{
	return substr(md5(rand()), 0, $l);
}

function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function prepare_multiple($inputs)
{
    $result = [];
    foreach ($inputs as $key => $array) {
        if(is_array($array) && count($array)){
            foreach ($array as $i => $value) {
                $result[$i][$key] = $value;
            }
        }
    }
    return $result;
}

function random_rgba($opacity=null)
{
    $opacity = $opacity ?? rand(0,10)/10;
    return "rgba(".rand(1,255).", ".rand(1,255).", ".rand(1,255).", $opacity)";
}
