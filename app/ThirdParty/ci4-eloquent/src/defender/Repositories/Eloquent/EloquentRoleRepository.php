<?php

namespace Artesaos\Defender\Repositories\Eloquent;

use Artesaos\Defender\Contracts\Repositories\RoleRepository;
use Artesaos\Defender\Contracts\Role;
use Artesaos\Defender\Exceptions\RoleExistsException;

/**
 * Class EloquentRoleRepository.
 */
class EloquentRoleRepository extends AbstractEloquentRepository implements RoleRepository
{
    /**
     * @param Role  $model
     */
    public function __construct($model)
    {
        parent::__construct($model);
    }

    /**
     * Create a new role with the given name.
     *
     * @param $roleName
     *
     * @throws \RoleExistsException
     *
     * @return Role
     */
    public function create($roleName)
    {
        if (! is_null($this->findByName($roleName))) {
            // TODO: add translation support
            throw new RoleExistsException('A role with the given name already exists');
        }

        return $role = $this->model->create(['name' => $roleName]);
    }
}
