<?php
namespace App\Models;

use App\Traits\UserLogableTrait;
use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Fluent\Auth\Contracts\AuthenticatorInterface;
use Fluent\Auth\Contracts\ResetPasswordInterface;
use Fluent\Auth\Contracts\UserProviderInterface;
use Fluent\Auth\Contracts\VerifyEmailInterface;
use Fluent\Auth\Support\AuthenticatableTrait;
use Fluent\Auth\Support\CanResetPasswordTrait;
use Fluent\Auth\Support\MustVerifyEmailTrait;
use Fluent\Auth\Support\UserProviderTrait;
use Fluent\JWTAuth\Contracts\JWTSubjectInterface;

class User extends Eloquent implements
    AuthenticatorInterface,
    JWTSubjectInterface,
    ResetPasswordInterface,
    VerifyEmailInterface,
    UserProviderInterface
{
    use AuthenticatableTrait;
    use CanResetPasswordTrait;
    use MustVerifyEmailTrait;
    use UserProviderTrait;
    use UserLogableTrait;
    use HasDefender;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * {@inheritdoc}
     */
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
