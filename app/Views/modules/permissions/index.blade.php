@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800 mb-n1">Permissions</h1>
        <button class="btn btn-sm btn-primary btn-create">Create Permission</button>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="status" class="collapse">
                <div class="alert alert-danger" role="alert">Do know with own your act! You can break the system.</div>
            </div>

            <div class="card shadow-sm h-100 py-4">
                <div>
                    <div class="table-responsive" style="font-size: 11pt">
                        <table class="table table-md table-striped datatable display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="40">No</th>
                                    <th>Permission Name</th>
                                    <th>Readable Name</th>
                                    <th>Created At</th>
                                    <th width="80"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
@endsection

@section('modal')
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="data-form">
                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Pemission Name:</label>
                            <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus autofocus placeholder="Enter Permission Name...">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Readable Name:</label>
                            <input id="readable_name" type="text" class="form-control" name="readable_name" required autocomplete="readable_name" autofocus autofocus placeholder="Enter Readable Name...">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        let table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: '{{ route_to('permissions.data') }}',
                type: 'GET'
            },
            columns: [
                {data: 'index', name: 'index'},
                {data: 'name', name: 'name'},
                {data: 'readable_name', name: 'readable_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'button', name: 'button'}
            ],
            order: [[1, 'asc']]
        });

        function openModal(title) {
            $('#formModal').modal('show')
                .find('#formModalLabel')
                .html(title);
        }

        function showAlert(type, message) {
            $('#status').collapse('show')
                .find('.alert')
                .addClass(type)
                .html(message);
        }

        function hideAlert() {
            $('#status').collapse('hide')
                .find('div')
                .attr('class', 'alert')
                .html('');
        }

        $(document).ready(function() {
            $('#status').collapse('show');
        });

        $(document).on('click', '.btn-create', function(e) {
            e.preventDefault();

            openModal('Create Permission');

            $('#data-form').attr({
                action: '{{ route_to('permissions.create') }}',
                method: 'POST'
            });

            $('#password').attr('required', true);

            $('#repeat_password').attr('required', true);
        });

        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();

            openModal('Update Permission');

            let items = $(this).data('items');

            $.each(items, function(key, val) {
                $('#'+key).val(val);
            });

            $('#data-form').attr({
                action: $(this).data('url'),
                method: 'PUT'
            });
        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let url = $(this).data('url');

            if (confirm("Are you sure want to delete permission name?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: (response) => {
                        return setTimeout(() => {
                            showAlert('alert-warning', response.message);
                        }, 500);
                    }
                })
                .always(function() {
                    table.ajax.reload();

                    return setTimeout(() => {
                        hideAlert();
                    }, 3200);
                });
            }
        });

        $('#data-form').submit(function(e) {
            e.preventDefault();

            let data = $(this).serialize();
            let url = $(this).attr('action');
            let method = $(this).attr('method');

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: (response) => {
                    $('#formModal').modal('hide');

                    return setTimeout(() => {
                        showAlert('alert-success', response.message);
                    }, 500);
                },
                error: ({ responseJSON }) => {
                    console.log(responseJSON);
                    
                    $.each(responseJSON.messages, (key, val) => {
                        $('#'+key).addClass('is-invalid')
                            .after('<small class="invalid-feedback">'+val+'</small>');
                        
                        if (key === 'error') {
                            $('#formModal').modal('hide');

                            showAlert('alert-danger', val);
                        }
                    });

                    if (responseJSON.message) {
                        $('#formModal').modal('hide');

                        showAlert('alert-danger', responseJSON.message);
                    }
                }
            })
            .always(function() {
                table.ajax.reload();
            });
        });

        $('#formModal').on('show.bs.modal', function(e){
            $('.form-control')
                .removeClass('is-invalid')
                .find('.invalid-feedback')
                .remove();

            hideAlert();

            $('#password').attr('required', false);

            $('#repeat_password').attr('required', false);
        });

        $('#formModal').on('hidden.bs.modal', function(e){
            $('#data-form').trigger('reset');

            return setTimeout(() => {
                hideAlert();
            }, 3200);
        });
    </script>
@endpush