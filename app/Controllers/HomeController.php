<?php 

namespace App\Controllers;

use App\Models\Permission;

class HomeController extends BaseController
{
	public function index()
	{
		$permissions = Permission::query()
			->when($this->request->getGet('search', null), function ($q, $s) {
				return $q->where('name', 'like', '%'.$s.'%');
			})
			->paginate(10);

		return render('welcome', compact('permissions'));
	}

	//--------------------------------------------------------------------

}
