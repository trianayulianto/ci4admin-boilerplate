@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800 mb-n1">Assign User Access</h1>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="status" class="collapse">
                <div class="alert" role="alert"></div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="form" action="{{ route_to('users.assign', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @php
                            $hasPermissions = $user->permissions->map(function ($permission) {
                                return $permission->pivot->permission_id;
                            })
                            ->toArray();

                            $hasRoles = $user->roles->map(function ($role) {
                                return $role->pivot->role_id;
                            })
                            ->toArray();
                            
                            $viewMenu = function($permissions) use ($hasPermissions) {
                                $html = '';
                                foreach($permissions as $menus) {
                                    $html .= render('modules.users.partials._menus', [
                                        'menus' => $menus,
                                        'hasPermissions' => $hasPermissions
                                    ]);
                                }
                                return $html;
                            }
                        @endphp

                        <h1 class="h5 text-dark pb-2">
                            <i class="fas fa-fw fa-lock"></i>
                            Roles Based
                        </h1>
                        <ul class="list-permissions">
                            @includeIf('modules.users.partials._roles', [
                                'roles' => defender()->rolesList(),
                                'hasRoles' => $hasRoles
                            ])
                        </ul>

                        <div class="mt-4 mb-3"></div>

                        <h1 class="h5 text-dark pb-2">
                            <i class="fas fa-fw fa-lock"></i>
                            Permissions Based
                        </h1>
                        <ul class="list-permissions">
                            {!! $viewMenu($permissions) !!}
                        </ul>

                        <div class="row-cols-1">
                            <div class="float-right">
                                <a href="{{ route_to('users.index') }}" class="btn btn-sm btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-sm btn-primary">Save Permission</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
@endsection

@push('styles')
<style type="text/css">
    .list-permissions{
        list-style-type: none;
        /*ul {
            list-style-type: none;
        }*/
    }
</style>
@endpush

@push('scripts')
    <script type="text/javascript">
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

        $('#form').submit(function(e) {
            e.preventDefault();

            let data = $(this).serialize();
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                type: 'PUT',
                data: data,
                success: ({ message, data }) => {
                    console.log(data);

                    return setTimeout(() => {
                        showAlert('alert-success', message);
                    }, 500);

                    $.each(data.roles, function(index, el) {
                        $('#'.el.name+el.id).prop('checked', true);
                    });

                    $.$.each(data.permissions, function(index, val) {
                        $('#'.el.name+el.id).prop('checked', true);
                    });
                },
                error: ({ responseJSON }) => {
                    $.each(responseJSON.messages, (key, val) => {
                        if (key === 'error') {
                            showAlert('alert-danger', val);
                        }
                    });

                    if (responseJSON.message) {
                        showAlert('alert-danger', responseJSON.message);
                    }
                }
            })
            .always(function() {
                return setTimeout(() => {
                    hideAlert();
                }, 3200);
            });
        });
    </script>
@endpush
