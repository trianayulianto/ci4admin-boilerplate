<?php

/**
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 * (c) Agung Sugiarto <me.agungsugiarto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fluent\JWTAuth\Claims;

use CodeIgniter\Http\Request;
use Fluent\JWTAuth\Support\UtilsTrait;

use function array_key_exists;
use function bin2hex;
use function method_exists;
use function random_bytes;

class Factory
{
    /**
     * The request.
     *
     * @var Request
     */
    protected $request;

    /**
     * The TTL.
     *
     * @var int
     */
    protected $ttl = 60;

    /**
     * Time leeway in seconds.
     *
     * @var int
     */
    protected $leeway = 0;

    /**
     * The classes map.
     *
     * @var array
     */
    private $classMap = [
        'aud' => Audience::class,
        'exp' => Expiration::class,
        'iat' => IssuedAt::class,
        'iss' => Issuer::class,
        'jti' => JwtId::class,
        'nbf' => NotBefore::class,
        'sub' => Subject::class,
    ];

    /**
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the instance of the claim when passing the name and value.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return Claim
     */
    public function get($name, $value)
    {
        if ($this->has($name)) {
            $claim = new $this->classMap[$name]($value);

            return method_exists($claim, 'setLeeway')
                ? $claim->setLeeway($this->leeway)
                : $claim;
        }

        return new Custom($name, $value);
    }

    /**
     * Check whether the claim exists.
     *
     * @param  string  $name
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->classMap);
    }

    /**
     * Generate the initial value and return the Claim instance.
     *
     * @param  string  $name
     * @return Claim
     */
    public function make($name)
    {
        return $this->get($name, $this->$name());
    }

    /**
     * Get the Issuer (iss) claim.
     *
     * @return string
     */
    public function iss()
    {
        return $this->request->getUri()->getScheme().'://'.$this->request->getUri()->getHost();
    }

    /**
     * Get the Issued At (iat) claim.
     *
     * @return int
     */
    public function iat()
    {
        return UtilsTrait::now()->getTimestamp();
    }

    /**
     * Get the Expiration (exp) claim.
     *
     * @return int
     */
    public function exp()
    {
        return UtilsTrait::now()->addMinutes($this->ttl)->getTimestamp();
    }

    /**
     * Get the Not Before (nbf) claim.
     *
     * @return int
     */
    public function nbf()
    {
        return UtilsTrait::now()->getTimestamp();
    }

    /**
     * Get the JWT Id (jti) claim.
     *
     * @return string
     */
    public function jti()
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Add a new claim mapping.
     *
     * @param  string  $name
     * @param  string  $classPath
     * @return $this
     */
    public function extend($name, $classPath)
    {
        $this->classMap[$name] = $classPath;

        return $this;
    }

    /**
     * Set the request instance.
     *
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Set the token ttl (in minutes).
     *
     * @param  int  $ttl
     * @return $this
     */
    public function setTTL($ttl)
    {
        $this->ttl = $ttl;

        return $this;
    }

    /**
     * Get the token ttl.
     *
     * @return int
     */
    public function getTTL()
    {
        return $this->ttl;
    }

    /**
     * Set the leeway in seconds.
     *
     * @param  int  $leeway
     * @return $this
     */
    public function setLeeway($leeway)
    {
        $this->leeway = $leeway;

        return $this;
    }
}
