<?php

namespace Fluent\Laraci\Config;

use CodeIgniter\Config\BaseService;
use CodeIgniter\Config\Factories;
use eftec\bladeone\BladeOne as Blade;

class Services extends BaseService
{
    /**
     * The base auth class.
     */
    public static function render(bool $getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('render');
        }

        $path = APPPATH.'Views';
        $cache = WRITEPATH.'cache';

        return new Blade($path, $cache, Blade::MODE_AUTO);
    }

    /**
     * Helper to get the config values.
     *
     * @param  string  $key
     * @return mixed
     */
    protected static function config($key)
    {
        return Factories::config('Defender', ['getShared' => true])->$key;
    }
}
