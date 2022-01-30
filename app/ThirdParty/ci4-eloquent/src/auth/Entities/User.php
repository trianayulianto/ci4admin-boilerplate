<?php

namespace Fluent\Auth\Entities;

use CodeIgniter\Entity;
use Fluent\Auth\Contracts\AuthenticatorInterface;
use Fluent\Auth\Contracts\ResetPasswordInterface;
use Fluent\Auth\Contracts\VerifyEmailInterface;
use Fluent\Auth\Support\AuthenticatableTrait;
use Fluent\Auth\Support\CanResetPasswordTrait;
use Fluent\Auth\Support\MustVerifyEmailTrait;

use function password_hash;

class User extends Entity implements
    AuthenticatorInterface,
    ResetPasswordInterface,
    VerifyEmailInterface
{
    use AuthenticatableTrait;
    use CanResetPasswordTrait;
    use MustVerifyEmailTrait;

    /**
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Fill set password hash.
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }
}