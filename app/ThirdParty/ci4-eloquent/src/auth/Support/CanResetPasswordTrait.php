<?php

namespace Fluent\Auth\Support;

use CodeIgniter\Events\Events;
use Fluent\Auth\Contracts\ResetPasswordInterface;

trait CanResetPasswordTrait
{
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset() {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token) {
        Events::trigger(ResetPasswordInterface::class, $this->getEmailForPasswordReset(), $token);
    }
}