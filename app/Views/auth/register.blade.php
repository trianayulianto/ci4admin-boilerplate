@extends('theme.auth')

@section('content')
<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
<div class="col-lg-7">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
        </div>
        <form class="user" method="POST">
            @csrf

            <div id="status" class="collapse">
                <div class="alert alert-danger" role="alert"></div>
            </div>

            <div class="form-group">
                <input id="name" type="text" class="form-control form-control-user" name="name" required autocomplete="name" autofocus autofocus placeholder="Enter Username...">
            </div>

            <div class="form-group">
                <input id="email" type="email" class="form-control form-control-user" name="email" required autocomplete="email" autofocus placeholder="Enter Email Address...">
            </div>

            <div class="row">
                <div class="form-group col-sm-6 col-12">
                    <input id="password" type="password" class="form-control form-control-user" name="password" required autocomplete="new-password" autofocus placeholder="Enter Password...">
                </div>
                <div class="form-group col-sm-6 col-12">
                    <input id="repeat_password" type="password" class="form-control form-control-user" name="repeat_password" required autocomplete="new-password"autofocus placeholder="Enter Repeat Password...">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" id="register" class="btn btn-primary btn-user btn-block">
                    REGISTER <i class="fas fa-arrow-circle-right"></i>
                </button>
                <hr>
            </div>

            <div class="form-group text-center">
                <a class="small" href="{{ route_to('login') }}">
                    {{ 'Already Have an Account?' }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).on('submit', '.user', (e) => {
        e.preventDefault();

        let data = $('form').serialize();
        let url = '{{ route_to('register.post') }}';

        $.ajax({
            data: data,
            url: url,
            type: 'POST',
            beforeSend: () => {
                $('#register').prop('disabled', true);
                $('.invalid-feedback').remove();
                $('.form-control').removeClass('is-invalid');
                $('#status').collapse('hide')
                    .find('div')
                    .attr('class', 'alert')
                    .html('');
            },
            success: (response) => {
                Cookies.set('token', response.data.access_token, { 
                    expires: refreshTokenExpiration 
                });

                $('#status').collapse('show')
                    .find('.alert')
                    .addClass('alert-success')
                    .html(response.message);

                return setTimeout(() => {
                    window.location = "{{ route_to('dashboard.index') }}";
                }, 1000);
            },
            error: (response) => {
                $.each(response.responseJSON.messages, (key, val) => {
                    if (key === 'error') {
                        $('#status').collapse('show')
                            .find('.alert')
                            .addClass('alert-danger')
                            .html(val);
                    }
                    
                    $('#'+key).addClass('is-invalid')
                        .after('<small class="invalid-feedback">'+val+'</small>');
                });

                if (response.responseJSON.message) {
                    $('#status').collapse('show')
                        .find('.alert')
                        .addClass('alert-danger')
                        .html(response.responseJSON.message);
                }
            }
        })
        .always(() => {
            $('#register').prop('disabled', false);
        });
    });
</script>
@endpush