<?php

namespace Artesaos\Defender\Traits\Permissions;

use Artesaos\Defender\Pivots\PermissionRolePivot;
use CodeIgniter\Config\Factories;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait RoleHasPermissions.
 */
trait RoleHasPermissions
{
    use InteractsWithPermissions;

    /**
     * Many-to-many permission-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        $permissionModel = self::config('permission_model');
        $permissionRoleTable = self::config('permission_role_table');
        $roleKey = self::config('role_key');
        $permissionKey = self::config('permission_key');

        return $this->belongsToMany($permissionModel, $permissionRoleTable, $roleKey, $permissionKey)->withPivot('value', 'expires');
    }

    /**
     * @param  string  $table
     * @param  bool  $exists
     * @param  string|null  $using
     * @return PermissionRolePivot|\Illuminate\Database\Eloquent\Relations\Pivot
     */
    public function newPivot(Model $parent, array $attributes, $table, $exists, $using = null)
    {
        $permissionModel = self::config('permission_model');

        if ($parent instanceof $permissionModel) {
            return PermissionRolePivot::fromAttributes($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists, $using);
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
