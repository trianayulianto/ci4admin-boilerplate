<?php

namespace App\Listeners;

use App\Models\UserLogable;

class UserEventSubscriber
{
    protected $user;

    public function __construct(Object $user)
    {
        $this->user = $user;
    }

    /**
     * Handle user login events.
     */
    public function handleUserLogin()
    {
        $user = $this->user;

        $instance = \App\Models\User::class;
        if (!($user instanceof $instance)) {
            return;
        }

        try {
            $new_data = [
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            ];

            UserLogable::create([
                'user_id' => $user->id,
                'new_data' => $new_data,
                'logable_type' => $user::class,
                'logable_id' => $user->id,
                'old_data' => [],
                'type' => 'login',
            ]);
        } catch (\Throwable) {
        }
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout()
    {
        $user = $this->user;

        $instance = \App\Models\User::class;
        if (!($user instanceof $instance)) {
            return;
        }

        try {
            $new_data = [
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            ];

            UserLogable::create([
                'user_id' => $user->id,
                'new_data' => $new_data,
                'logable_type' => $user::class,
                'logable_id' => $user->id,
                'old_data' => [],
                'type' => 'logout',
            ]);
        } catch (\Throwable) {
        }
    }
}
