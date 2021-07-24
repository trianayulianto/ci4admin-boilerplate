<?php

namespace App\Models;

use App\Traits\UserLogableTrait;
use Artesaos\Defender\Role as DefenderRole;

class Role extends DefenderRole
{
	use UserLogableTrait;
}
