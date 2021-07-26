<?php

namespace Artesaos\Defender;

use CodeIgniter\HTTP\RequestInterface;
use Config\Services;
use Fluent\Auth\Contracts\UserProviderInterface;
use Fluent\JWTAuth\JWT;
use Fluent\JWTAuth\JWTGuard;

/**
 * Extends of JWTGuard
 * 
 * @return JWTGuard
 */
class DefenderGuard extends JWTGuard
{
	/**
     * Instantiate the class.
     *
     * @return void
     */
	function __construct(JWT $jwt, RequestInterface $request, UserProviderInterface $provider)
	{
		parent::__construct($jwt, $request, $provider);
	}

    /**
     * @return Defender
     */
    public function defender()
    {
        if (! $this->defender) {
            $this->defender = new Defender(
                $this->getUser(),
                Services::getSharedInstance('defRoles'),
                Services::getSharedInstance('defPermission')
            );
        }

        return $this->defender;
    }
}