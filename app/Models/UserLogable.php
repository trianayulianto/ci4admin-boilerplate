<?php

namespace App\Models;

use App\Traits\UserLogableTrait;
use Illuminate\Database\Eloquent\Model as Eloquent;

class UserLogable extends Eloquent
{
    protected $fillable = [
        'user_id',
        'new_data',
        'old_data',
        'logable_type',
        'logable_id',
        'type'
    ];

    protected $casts = [
        'new_data' => 'array',
        'old_data' => 'array',
    ];

    public $colors = [
        'create' => 'success',
        'edit' => 'warning',
        'delete' => 'danger',
        'login' => 'success',
        'logout' => 'warning',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function logable()
    {
        return $this->morpthTo();
    }
}
