<button
	type="button"
	class="btn btn-link btn-sm text-warning btn-edit"
	data-items="{{ json_encode($data) }}"
	data-url="{{ route_to('permissions.update', $data->id) }}"
><i class="fas fa-pen"></i></button>

<button
	type="button"
	class="btn btn-link btn-sm text-danger btn-delete"
	data-url="{{ route_to('permissions.delete', $data->id) }}"
><i class="fas fa-trash"></i></button>