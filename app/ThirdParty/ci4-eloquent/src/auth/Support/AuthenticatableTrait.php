<?php

namespace Fluent\Auth\Support;

trait AuthenticatableTrait
{
    /**
     * Returns the name of the column used to uniquely
     * identify this user, typically 'id'.
     */
    public function getAuthIdColumn(): string
    {
        return 'id';
    }

    /**
     * Returns the unique identifier of the object for
     * authentication purposes. Typically user's id.
     *
     * @return mixed
     */
    public function getAuthId()
    {
        return $this->attributes[$this->getAuthIdColumn()] ?? null;
    }

    /**
     * Returns the name of the column with the
     * email address of this user.
     */
    public function getAuthEmailColumn(): string
    {
        return 'email';
    }

    /**
     * Returns the email address for this user.
     *
     * @return string|null
     */
    public function getAuthEmail()
    {
        return $this->attributes[$this->getAuthEmailColumn()] ?? null;
    }

    /**
     * Get the password for the user.
     *
     * @return string|null
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        if (! empty($this->getRememberColumn())) {
            return (string) $this->{$this->getRememberColumn()};
        }
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        if (! empty($this->getRememberColumn())) {
            $this->{$this->getRememberColumn()} = $value;
        }
    }

    /**
     * Returns the column name that stores the remember-me value.
     */
    public function getRememberColumn(): string
    {
        return 'remember_token';
    }
}