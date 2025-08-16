<?php 

namespace App\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserLogable;

class DashboardController extends BaseController
{
	public function index()
	{
		$roles = Role::count();
		$permissions = Permission::count();
		$activities = UserLogable::count();
		$users = User::count();

		return render('dashboard', ['roles' => $roles, 'permissions' => $permissions, 'activities' => $activities, 'users' => $users]);
	}

	//--------------------------------------------------------------------

}
