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

namespace Fluent\JWTAuth;

use Fluent\JWTAuth\Validators\TokenValidator;

class Token implements \Stringable
{
    /** @var string */
    private $value;

    /**
     * Create a new JSON Web Token.
     *
     * @param  string  $value
     * @return void
     */
    public function __construct($value)
    {
        $this->value = (string) (new TokenValidator)->check($value);
    }

    /**
     * Get the token.
     *
     * @return string
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * Get the token when casting to string.
     */
    public function __toString(): string
    {
        return $this->get();
    }
}
