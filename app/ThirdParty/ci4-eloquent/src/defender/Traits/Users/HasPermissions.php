<?php

namespace Artesaos\Defender\Traits\Users;

use Artesaos\Defender\Pivots\PermissionUserPivot;
use Artesaos\Defender\Traits\Permissions\InteractsWithPermissions;
use CodeIgniter\Config\Factories;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasPermissions.
 */
trait HasPermissions
{
    use InteractsWithPermissions;

    /**
     * Many-to-many permission-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(
            self::config('permission_model'),
            self::config('permission_user_table'),
            'user_id',
            self::config('permission_key')
        )->withPivot('value', 'expires');
    }

    /**
     * @param Model  $parent
     * @param array  $attributes
     * @param string $table
     * @param bool   $exists
     * @param  string|null  $using
     *
     * @return PermissionUserPivot
     */
    public function newPivot(Model $parent, array $attributes, $table, $exists, $using = null)
    {
        $permissionModel = self::config('permission_model');

        if ($parent instanceof $permissionModel) {
            return PermissionUserPivot::fromAttributes($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists, $using);
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
