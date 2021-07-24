<button
	type="button"
	class="btn btn-link btn-sm text-warning btn-edit"
	data-user="{{ json_encode($data) }}"
	data-url="{{ route_to('users.update', $data->id) }}"
><i class="fas fa-pen"></i></button>

<button
	type="button"
	class="btn btn-link btn-sm text-danger btn-delete"
	data-url="{{ route_to('users.delete', $data->id) }}"
><i class="fas fa-trash"></i></button>