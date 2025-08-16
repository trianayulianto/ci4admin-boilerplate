<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserLogable;
use Carbon\Carbon;
use Irsyadulibad\DataTables\DataTables;

class UserLogableController extends BaseController
{
	protected $model;

	public function __construct()
	{
		$this->model = new UserLogable;
	}

	public function index()
	{
		defender('api')->canDo('system.activity.index');

		return render('modules.user_logs.index');
	}

	public function getData()
	{
		defender('api')->canDo('system.activity.index');

		$colors = $this->model->colors;

		return DataTables::use('user_logables')
			->addIndexColumn()
			->select('user_logables.*, users.name as name, users.email as email')
			->join('users', 'users.id = user_logables.user_id', 'INNER JOIN')
			->editColumn('type', fn($data) => '<span class="badge badge-'.$colors[$data].'">'.ucwords((string) $data).'</span>')
			->addColumn('button', function ($data) use ($colors) {
				$data->new_data = (array) json_decode((string) $data->new_data);
				$data->old_data = (array) json_decode((string) $data->old_data);

				return render('modules.user_logs.partials._table_button', ['data' => $data, 'colors' => $colors]);
			})
			->rawColumns(['type', 'button'])
			->make();
	}

	public function destroy()
	{
		defender('api')->canDo('system.activity.delete');

		if (! $this->validate(['days' => 'required|in_list[7,14,21,30]'])) {
            return $this->fail($this->validator->getErrors());
        }

		$data = (object) $this->request->getRawInput();

		$date = Carbon::now()->subDays($data->days);

		$delete = UserLogable::where('created_at', '<=', $date)->delete();

		if (!$delete) {
			return $this->fail(['error' => 'No data older than '.$data->days.' days']);
		}

		return $this->respondDeleted([
			'status'  => $this->codes['deleted'],
			'message' => 'User logs data more then '.$data->days.' days was deleted',
        ]);
	}
}
