<?php

namespace Artesaos\Defender\Contracts;

/**
 * Interface Role.
 *
 * @var \Illuminate\Database\Eloquent\Model
 */
interface Role
{
    /**
     * Many-to-many role-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();
}
