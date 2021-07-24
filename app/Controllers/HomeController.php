<?php 

namespace App\Controllers;

use App\Models\User;

class HomeController extends BaseController
{
	public function index()
	{
		$users = User::query()
			->when($this->request->getGet('search', null), function ($q, $s) {
				return $q->orWhere('email', 'like', '%'.$s.'%')
					->orWhere('name', 'like', '%'.$s.'%');
			})
			->whereHas('roles', function($q) {
				$q->where('name', '!=', 'superuser');
			})
			->paginate(10);

		return render('welcome', ['users' => $users]);
	}

	//--------------------------------------------------------------------

}
