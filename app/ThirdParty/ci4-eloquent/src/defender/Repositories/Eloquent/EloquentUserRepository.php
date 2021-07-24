<?php

namespace Artesaos\Defender\Repositories\Eloquent;

use Artesaos\Defender\Contracts\Repositories\UserRepository;

class EloquentUserRepository extends AbstractEloquentRepository implements UserRepository
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function attachRole($roleName)
    {
        return $this->model->attachRole($roleName);
    }

    public function attachPermission($permissionName, array $options = [])
    {
        return $this->model->attachPermission($permissionName, $options);
    }
}
