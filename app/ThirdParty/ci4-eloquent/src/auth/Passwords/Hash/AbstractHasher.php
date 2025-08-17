<?php

namespace Fluent\Auth\Passwords\Hash;

use function password_get_info;
use function password_verify;

abstract class AbstractHasher
{
    /**
     * Get information about the given hashed value.
     *
     * @param  string  $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        return password_get_info($hashedValue);
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if ((string) $hashedValue === '') {
            return false;
        }

        return password_verify($value, $hashedValue);
    }
}
