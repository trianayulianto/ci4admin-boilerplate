<?php

namespace App\Controllers;

use App\Models\Permission;
use Illuminate\Database\Capsule\Manager as DB;
use Irsyadulibad\DataTables\DataTables;

/**
 * Class PermissionController
 *
 */
class PermissionController extends BaseController
{
    public function index()
    {
        defender('api')->canDo('access.permissions.index');
        
        return render('modules.permissions.index');
    }

    public function getData()
    {
        defender('api')->canDo('access.permissions.index');
        
        return DataTables::use('permissions')
            ->addIndexColumn()
            ->addColumn('button', function ($data) {
                return render('modules.permissions.partials._table_button', compact('data'));
            })
            ->rawColumns(['assignment','button'])
            ->make();
    }

    public function store($id = null)
    {
        if ($this->request->getMethod() === 'post')
            defender('api')->canDo('access.permissions.create');

        if ($this->request->getMethod() === 'put')
            defender('api')->canDo('access.permissions.update');
        
        if (
            ! $this->validate([
                'name' => 'required|is_unique[permissions.name,id,'.$id.',]',
                'readable_name' => 'required'
            ])
        ) {
            return $this->fail($this->validator->getErrors());
        }

        $data = (array) $this->request->getPost();

        if ($this->request->getMethod() === 'put') {
            $data = (array) $this->request->getRawInput();

            $message = 'Permission data was updated';
        }

        DB::beginTransaction();
        try {
            $newRole = Permission::updateOrCreate(['id' => $id], $data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->fail(['error' => $e->getMessage()]);
        }

        return $this->respondCreated([
            'status'  => $this->codes['created'],
            'message' => $message ?? 'Permission data was created',
            'data'    => $newRole
        ]);
    }

    public function destroy($id)
    {
        defender('api')->canDo('access.permissions.delete');
        
        $role = Permission::find($id);

        $role->delete();

        return $this->respondDeleted([
            'status'  => $this->codes['deleted'],
            'message' => 'User data was deleted',
        ]);
    }
}
