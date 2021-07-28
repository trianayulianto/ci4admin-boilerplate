<?php

namespace App\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Irsyadulibad\DataTables\DataTables;

class RoleController extends BaseController
{
	public function index()
	{
		defender('api')->canDo('access.roles.index');

		return render('modules.roles.index');
	}

	public function getData()
	{
		defender('api')->canDo('access.roles.index');
		
		return DataTables::use('roles')
			->addIndexColumn()
			->addColumn('assignment', function ($data) {
				return '<a
					href="'.route_to('roles.show', $data->id).'" 
					class="btn btn-link btn-sm text-danger"
				>
					Assign Permission
				</a>';
			})
			->addColumn('button', function ($data) {
				return render('modules.roles.partials._table_button', compact('data'));
			})
			->rawColumns(['assignment','button'])
			->make();
	}

	public function store($id = null)
	{
        if ($this->request->getMethod() === 'post')
            defender('api')->canDo('access.roles.create');

        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('access.roles.update');
        
		if (! $this->validate(['name' => 'required|is_unique[roles.name,id,'.$id.']'])) {
            return $this->fail($this->validator->getErrors());
        }

		$data = (array) $this->request->getPost();

		if ($this->request->getMethod() === 'put') {
			$data = (array) $this->request->getRawInput();

			$message = 'Role name was updated';
		}

		DB::beginTransaction();
        try {
            $newRole = Role::updateOrCreate(['id' => $id], $data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

		return $this->respondCreated([
			'status'  => $this->codes['created'],
			'message' => $message ?? 'Role data was created',
			'data'    => $newRole
        ]);
	}

	public function show($id)
	{
		defender('api')->canDo('access.roles.assign');

		$role = Role::with('permissions')->where('id', $id)->first();

		$permissions = Permission::select(DB::raw("SUBSTRING_INDEX(`name`, '.', 2) as `group`"))
			->groupBy('group')
			->cursor()
			->map(function ($item) {
				$title = Str::of($item->group)
	                ->replace('.', ' ')
	                ->title();

				return [
					'name' => "$title",
		            'description' => 'User has permisssion for '.$title.' module',
					'permissions' => Permission::where('name', 'like', $item->group.'.%')
						->select('id', 'name', 'readable_name')
						->get()
						->flatten()
						->toArray()
				];
			});

		return render('modules.roles.index_assign', compact('permissions', 'role'));
	}

	public function assign($id)
	{
		defender('api')->canDo('access.roles.assign');
		
		$role = Role::find($id);

		$data = (array) $this->request->getRawInput();

		$permissions = Arr::get($data, 'permissions.id');

		try {
			$role->syncPermissions((array) $permissions);
		} catch (\Exception $e) {
			return $this->fail(['error' => $e->getMessage()]);			
		}

		return $this->respondCreated([
			'status' => $this->codes['created'],
			'message' => 'Role\'s and permissions was updated',
			'data' => [
				'permissions' => $role->permissions
			]
		]);
	}

	public function destroy($id)
	{
		defender('api')->canDo('access.roles.delete');
		
		$role = Role::find($id);

		$role->delete();

		return $this->respondDeleted([
			'status'  => $this->codes['deleted'],
			'message' => 'Role data was deleted',
        ]);
	}
}