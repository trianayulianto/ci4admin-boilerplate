<?php

namespace App\Models;

use App\Traits\UserLogableTrait;
use Artesaos\Defender\Permission as DefenderPermission;

class Permission extends DefenderPermission
{
    use UserLogableTrait;
}
