<?php

namespace Artesaos\Defender\Traits\Models;

use Artesaos\Defender\Pivots\PermissionRolePivot;
use Artesaos\Defender\Pivots\PermissionUserPivot;
use CodeIgniter\Config\Factories;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait Permission.
 */
trait Permission
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        // Must to be declared before parent::__construct call
        $this->fillable = $fillable = [
            'name',
            'readable_name',
        ];

        parent::__construct($attributes);

        $this->table = self::config('permission_table');
    }

    /**
     * Many-to-many permission-role relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(
            self::config('role_model'),
            self::config('permission_role_table'),
            self::config('permission_key'),
            self::config('role_key')
        )->withPivot('value', 'expires');
    }

    /**
     * Many-to-many permission-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            self::config('user_model'),
            self::config('permission_user_table'),
            self::config('permission_key'),
            'user_id'
        )->withPivot('value', 'expires');
    }

    /**
     * @param Model  $parent
     * @param array  $attributes
     * @param string $table
     * @param bool   $exists
     * @param  string|null  $using
     *
     * @return PermissionUserPivot|\Illuminate\Database\Eloquent\Relations\Pivot
     */
    public function newPivot(Model $parent, array $attributes, $table, $exists, $using = null)
    {
        $userModel = self::config('user_model');
        $roleModel = self::config('role_model');

        if ($parent instanceof $userModel) {
            return PermissionUserPivot::fromAttributes($parent, $attributes, $table, $exists);
        }

        if ($parent instanceof $roleModel) {
            return PermissionRolePivot::fromAttributes($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
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
