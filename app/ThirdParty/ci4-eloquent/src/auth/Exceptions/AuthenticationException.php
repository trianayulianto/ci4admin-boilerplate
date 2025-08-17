<?php

namespace Fluent\Auth\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    /**
     * All of the guards that were checked.
     *
     * @var array
     */
    protected $guards;

    /**
     * Create a new authentication exception.
     *
     * @param  string  $message
     * @param  string|null  $redirectTo
     * @return void
     */
    public function __construct($message = 'Unauthenticated.', array $guards = [], int $code = 401, /**
     * The path the user should be redirected to.
     */
        protected $redirectTo = null)
    {
        parent::__construct($message, $code);

        $this->guards = $guards;
    }

    /**
     * Get the guards that were checked.
     *
     * @return array
     */
    public function guards()
    {
        return $this->guards;
    }

    /**
     * Get the path the user should be redirected to.
     *
     * @return string
     */
    public function redirectTo()
    {
        return $this->redirectTo;
    }
}
