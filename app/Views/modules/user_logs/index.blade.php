@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Logs</h1>
        <div class="form-inline float-right">
            <select id="days" name="days" class="form-control form-control-sm">
                <option value="7">7</option>
                <option value="14">14</option>
                <option value="21">21</option>
                <option value="30">30</option>
            </select>
            <label for="days" class="py-2 px-2">Days ago</label>
            
            <button class="btn btn-sm btn-danger btn-clear">Clear</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="status" class="collapse">
                <div class="alert" role="alert"></div>
            </div>

            <div class="card border-0 shadow-sm rounded-lg py-4">
                <div>
                    <div class="table-responsive" style="font-size: 11pt">
                        <table class="table table-md table-striped datatable" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Model</th>
                                    <th>Type</th>
                                    <th></th>
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
@push('scripts')
    <script type="text/javascript">
        let table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: '{{ route_to('activity.data') }}',
                type: 'GET'
            },
            columns: [
                {data: 'index', name: 'index'},
                {data: 'name', name: 'name'},
                {data: 'logable_type', name: 'logable_type'},
                {data: 'type', name: 'type'},
                {data: 'button', name: 'button'},
            ]
        });

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

        $(document).on('click', '.btn-clear', function(e) {
            e.preventDefault();

            let url = '{{ route_to('activity.clear') }}';
            let days = $('#days').val();

            if (confirm("Are you sure want to clear user logs?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        days: days
                    },
                    success: (response) => {
                        showAlert('alert-warning', response.message);
                    },
                    error: ({ responseJSON }) => {
                        console.log(responseJSON);
                        $.each(responseJSON.messages, (key, val) => {
                            if (key === 'error') {
                                $('#userModal').modal('hide');

                                showAlert('alert-danger', val);
                            }
                        });

                        showAlert('alert-danger', responseJSON.message);
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
    </script>
@endpush
