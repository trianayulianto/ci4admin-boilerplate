<?php

namespace Fluent\Auth\Contracts;

use Fluent\Auth\Exceptions\AuthenticationException;
use Illuminate\Database\Eloquent\Model as Eloquent;

interface AuthenticationInterface
{
    /**
     * Determine if current user is authenticated. If not, throw an exception.
     *
     * @return AuthenticatorInterface|ResetPasswordInterface|VerifyEmailInterface
     *
     * @throws AuthenticationException
     */
    public function authenticate();

    /**
     * Attempts to authenticate a user with the given $credentials.
     *
     * @return bool
     */
    public function attempt(array $credentials, bool $remember = false);

    /**
     * Determine if the user was authenticated via "remember me" cookie.
     *
     * @return bool
     */
    public function viaRemember();

    /**
     * Validate a user's credentials.
     */
    public function validate(array $credentials): bool;

    /**
     * Checks if the user is currently logged in.
     */
    public function check(): bool;

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest();

    /**
     * Logs the given user in.
     *
     * @return mixed
     */
    public function login(AuthenticatorInterface $user, bool $remember = false);

    /**
     * Logs a user in based on their ID.
     *
     * @param  int|string  $userId
     * @return AuthenticatorInterface|bool
     */
    public function loginById($userId, bool $remember = false);

    /**
     * Logs the current user out.
     *
     * @return void
     */
    public function logout();

    /**
     * Returns the currently logged in user.
     *
     * @return AuthenticatorInterface|CanResetPasswordInterface|MustVerifyEmailInterface|Eloquent|\App\Models\User|null
     */
    public function user();

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id();

    /**
     * Determine if the adapter has a user instance.
     */
    public function hasUser(): bool;

    /**
     * Set the current user.
     *
     * @return $this
     */
    public function setUser(AuthenticatorInterface $user);

    /**
     * Get a unique identifier for the auth session value.
     *
     * @return string
     */
    public function getSessionName();

    /**
     * Get the name of the cookie used to store the "recaller".
     *
     * @return string
     */
    public function getCookieName();

    /**
     * Get the user provider used by the adapter.
     *
     * @return UserProviderInterface
     */
    public function getProvider();

    /**
     * Set the user provider used by the adapter.
     *
     * @return $this
     */
    public function setProvider(UserProviderInterface $provider);
}
