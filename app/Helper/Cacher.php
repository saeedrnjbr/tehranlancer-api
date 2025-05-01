<?php
namespace App\Helper;

use Illuminate\Support\Facades\Redis;

class Cacher
{

    public static function get($key)
    {
        return Redis::get($key);
    }

    public static function set($key, $value)
    {
        return Redis::set($key, $value);
    }

    public static function del($key)
    {
        return Redis::del($key);
    }

    public static function regexDel($keys)
    {
        return Redis::del(Redis::keys($keys));
    }

    public static function expire($key, $duration)
    {
        return Redis::expire($key, $duration);
    }


}
