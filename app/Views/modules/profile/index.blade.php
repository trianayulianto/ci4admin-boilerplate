@extends('theme.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div id="status" class="collapse">
                <div class="alert" role="alert"></div>
            </div>

            <div class="card shadow-sm h-100 py-4">
                <form id="form" action="" method="POST">
                    <div class="card-body">

                         @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">{{ 'Name' }}</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label">{{ 'Email' }}</label>
                            <div class="col-md-8">
                                <input id="email" type="text" class="form-control" name="email" value="{{ auth()->user()->email }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label">{{ 'Password' }}</label>
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="repeat_password" class="col-md-2 col-form-label">{{ 'Confirm Password' }}</label>
                            <div class="col-md-8">
                                <input id="repeat_password" type="password" class="form-control" name="repeat_password" autofocus>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row-cols-1">
                            <button type="submit" id="save" class="btn btn-primary float-right">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        function showAlert(type, message) {
            $('#status').collapse('show')
                .find('.alert')
                .addClass(type)
                .html(message);
        }

        $('#form').submit(function(e) {
            e.preventDefault();

            let data = $(this).serialize();
            let url = '{{ route_to('profile.update') }}';

            $.ajax({
                data: data,
                url: url,
                type: 'PUT',
                beforeSend: () => {
                    $('#save').prop('disabled', true);

                    $('.form-control')
                        .removeClass('is-invalid');
                        
                    $('.invalid-feedback')
                        .remove();

                    $('#status').collapse('hide')
                        .find('div')
                        .attr('class', 'alert')
                        .html('');
                },
                success: (response) => {
                    if (response.data.email_verified_at == null) {
                        showAlert('alert-warning', 'Your email was changed, you must reverification your account!');
                        
                        return setTimeout(() => {
                            window.location = "{{ route_to('verification.notice') }}";
                        }, 1000);
                    }
                    
                    showAlert('alert-success', response.message);

                    $('#userDropdown').find('span').html($('#name').val());
                },
                error: (response) => {
                    $.each(response.responseJSON.messages, (key, val) => {
                        if (key === 'error') {
                            showAlert('alert-danger', val);
                        }
                        
                        $('#'+key).addClass('is-invalid')
                            .after('<small class="invalid-feedback">'+val+'</small>');
                    });

                    if (response.responseJSON.message) {
                        showAlert('alert-danger', response.responseJSON.message);
                    }
                }
            })
            .always(() => {
                $('#save').prop('disabled', false);

                return setTimeout(() => {
                    $('#status').collapse('hide');
                }, 3600);
            });
        });
    </script>
@endpush