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

namespace Fluent\JWTAuth\Contracts;

use Fluent\JWTAuth\Exceptions\InvalidClaimException;

interface ClaimInterface
{
    /**
     * Set the claim value, and call a validate method.
     *
     * @param  mixed  $value
     * @return $this
     *
     * @throws InvalidClaimException
     */
    public function setValue($value);

    /**
     * Get the claim value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Set the claim name.
     *
     * @param  string  $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get the claim name.
     *
     * @return string
     */
    public function getName();

    /**
     * Validate the Claim value.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function validateCreate($value);
}
