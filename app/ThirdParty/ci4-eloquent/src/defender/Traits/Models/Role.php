<?php

namespace Artesaos\Defender\Traits\Models;

use Artesaos\Defender\Traits\Permissions\RoleHasPermissions;
use CodeIgniter\Config\Factories;

/**
 * Trait Role.
 */
trait Role
{
    use RoleHasPermissions;

    public function __construct(array $attributes = [])
    {
        $this->fillable = [
            'name',
        ];

        parent::__construct($attributes);

        $this->table = self::config('role_table');
    }

    /**
     * Many-to-many role-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            self::config('user_model'),
            self::config('role_user_table'),
            self::config('role_key'),
            'user_id'
        );
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
