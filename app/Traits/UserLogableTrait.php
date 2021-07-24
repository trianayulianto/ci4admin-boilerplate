<?php

namespace App\Traits;

use App\Models\UserLogable;
use Illuminate\Support\Arr;

trait UserLogableTrait
{
    public function userLogable()
    {
        return $this->morphMany(UserLogable::class, 'logable');
    }

    public static function createUserLog($model, $event)
    {
        if (auth()->guest()) {
            return;
        }

        $user = auth()->user();

        $instance = \App\Models\User::class;
        if (!($user instanceof  $instance)) {
            return;
        }

        $oldData = (array) $model->getOriginal();
        if ($model instanceof $instance) {
            Arr::forget($oldData, ['password', 'remember_token']);
        }

        $model->userLogable()->create([
            'user_id'  => $user->id,
            'type'     => $event,
            'old_data' => $oldData,
            'new_data' => $model,
        ]);
    }

    protected static function bootUserLogableTrait()
    {
        self::created(function ($model) {
            self::createUserLog($model, 'create');
        });

        self::updated(function ($model) {
            self::createUserLog($model, 'edit');
        });

        self::deleted(function ($model) {
            self::createUserLog($model, 'delete');
        });
    }
}
