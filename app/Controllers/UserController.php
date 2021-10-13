<?php

namespace App\Controllers;

use App\Models\Permission;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Support\Arr;
use Irsyadulibad\DataTables\DataTables;
use Illuminate\Support\Str;

class UserController extends BaseController
{
	public function index()
	{
		defender('api')->canDo('account.users.index');

		return render('modules.users.index');
	}

	public function getData()
	{
		defender('api')->canDo('account.users.index');

		return DataTables::use('users')
			->addIndexColumn()
			->select('id, name, email')
			->addColumn('assignment', function ($data) {
				return '<a
					href="'.route_to('users.show', $data->id).'" 
					class="btn btn-link btn-sm text-danger"
				>
					Assign Permission
				</a>';
			})
			->filter(function ($query) {
				return $query->whereNotIn('id', [1, user_id()]);
			})
			->addColumn('button', function ($data) {
				return render('modules.users.partials._table_button', compact('data'));
			})
			->rawColumns(['assignment', 'button'])
			->make();
	}

	public function store($id = null)
	{
        if ($this->request->getMethod() === 'post')
            defender('api')->canDo('account.users.create');

        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('account.users.update');
        
		$rules = [
			'name' => 'required|min_length[3]',
			'email' => 'required|valid_email|is_unique[users.email,id,'.$id.']',
			'password' => 'permit_empty|min_length[8]',
			'repeat_password' => 'required_with[password]|matches[password]',
		];

		if (!$this->validate($rules)) {
			return $this->fail($this->validator->getErrors());
		}

		$data = (array) $this->request->getPost();

		if ($this->request->getMethod() === 'put') {
			$data = (array) $this->request->getRawInput();

			$message = 'User data was updated';
		}

		if (!is_null($id) && is_null($data["password"])) {
			$data["password"] = User::find($id)->password;
		} else {
			$data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);
		}

		DB::beginTransaction();
		try {
			$user = User::updateOrCreate(['id' => $id], $data);

			// force email mark as verified
			$user->markEmailAsVerified();

			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();

			return $this->fail(['error' => $e->getMessage()]);
		}

		return $this->respondCreated([
			'status'  => ResponseInterface::HTTP_CREATED,
			'message' => $message ?? 'User data was created',
			'data'    => $user
        ]);
	}

	public function show($id)
	{
		defender('api')->canDo('account.users.assign');
		
		$user = User::with('permissions')->where('id', $id)->first();

		$permissions = Permission::select(DB::raw("SUBSTRING_INDEX(`name`, '.', 2) as `group`"))
			->groupBy('group')
			->cursor()
			->map(function ($item) {
				$title = Str::of($item->group)
	                ->replace('.', ' ')
	                ->title();

				return [
					'name' => "$title",
		            'description' => 'User has permisssion for '.$title.' modules',
					'permissions' => Permission::where('name', 'like', $item->group.'.%')
						->select('id', 'name', 'readable_name')
						->get()
						->flatten()
						->toArray()
				];
			});
		
		// dd($permissions->toArray());

		return render('modules.users.index_assign', compact('permissions', 'user'));
	}

	public function assign($id)
	{
		defender('api')->canDo('account.users.assign');

		$user = User::find($id);

		$data = (array) $this->request->getRawInput();

		$roles = Arr::get($data, 'roles.id');

		$permissions = Arr::get($data, 'permissions.id');

		if (auth()->user()->isSuperUser()) {
			Arr::pull($roles, config('Defender', true)->superuser_role, null);
		}

		try {
			$user->syncRoles((array) $roles);
			$user->syncPermissions((array) $permissions);
		} catch (\Exception $e) {
			return $this->fail(['error' => $e->getMessage()]);			
		}

		return $this->respondCreated([
			'status' => ResponseInterface::HTTP_CREATED,
			'message' => 'User\'s roles and permissions was updated',
			'data' => [
				'roles' => $user->roles,
				'permissions' => $user->permissions
			]
		]);
	}

	public function destroy($id)
	{
		defender('api')->canDo('account.users.delete');

		$user = User::find($id);

		$user->delete();

		return $this->respondDeleted([
			'status'  => ResponseInterface::HTTP_ACCEPTED,
			'message' => 'User data was deleted',
        ]);
	}
}
