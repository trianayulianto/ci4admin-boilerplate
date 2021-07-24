<?php

namespace Artesaos\Defender\Config;

use Artesaos\Defender\Repositories\Eloquent\EloquentPermissionRepository;
use Artesaos\Defender\Repositories\Eloquent\EloquentRoleRepository;
use CodeIgniter\Config\BaseService;
use CodeIgniter\Config\Factories;

/**
 * 
 */
class Services extends BaseService
{
	public static function defRoles(bool $getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('defRoles');
        }

        return new EloquentRoleRepository(static::config('role_model'));
    }

    public static function defPermission(bool $getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('defPermission');
        }

        return new EloquentPermissionRepository(static::config('permission_model'));
    }

    /**
     * Helper to get the config values.
     *
     * @param string $key
     * @return mixed
     */
    protected static function config($key)
    {
        return Factories::config('Defender', ['getShared' => true])->$key;
    }
}