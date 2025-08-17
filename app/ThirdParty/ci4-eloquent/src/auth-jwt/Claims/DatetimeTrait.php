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

use DateInterval;
use DateTimeInterface;
use Fluent\JWTAuth\Exceptions\InvalidClaimException;
use Fluent\JWTAuth\Support\UtilsTrait;

use function is_numeric;

trait DatetimeTrait
{
    /**
     * Time leeway in seconds.
     *
     * @var int
     */
    protected $leeway = 0;

    /**
     * Set the claim value, and call a validate method.
     *
     * @param  mixed  $value
     * @return $this
     *
     * @throws InvalidClaimException
     */
    public function setValue($value)
    {
        if ($value instanceof DateInterval) {
            $value = UtilsTrait::now()->add($value);
        }

        if ($value instanceof DateTimeInterface) {
            $value = $value->getTimestamp();
        }

        return parent::setValue($value);
    }

    /**
     * {@inheritdoc}
     */
    public function validateCreate($value)
    {
        if (! is_numeric($value)) {
            throw new InvalidClaimException($this);
        }

        return $value;
    }

    /**
     * Determine whether the value is in the future.
     *
     * @param  mixed  $value
     * @return bool
     */
    protected function isFuture($value)
    {
        return UtilsTrait::isFuture($value, $this->leeway);
    }

    /**
     * Determine whether the value is in the past.
     *
     * @param  mixed  $value
     * @return bool
     */
    protected function isPast($value)
    {
        return UtilsTrait::isPast($value, $this->leeway);
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
