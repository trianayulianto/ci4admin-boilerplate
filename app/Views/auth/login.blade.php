@extends('theme.auth')

@section('content')
<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
<div class="col-lg-6">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
        </div>
        <form class="user" method="POST">
            @csrf

            <div id="status" class="collapse">
                <div class="alert alert-danger" role="alert"></div>
            </div>

            <div class="form-group row">
                <input id="email" type="email" class="form-control form-control-user" name="email" required autocomplete="email" autofocus placeholder="Enter Email Address...">
            </div>

            <div class="form-group row">
                <input id="password" type="password" class="form-control form-control-user" name="password" required autocomplete="current-password" placeholder="Enter Password...">
            </div>

            <div class="form-group row">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                    <label class="custom-control-label" for="remember">Remember Me</label>
                </div>
            </div>

            <div class="form-group row">
                <button type="submit" id="login" class="btn btn-primary btn-user btn-block">
                    LOGIN <i class="fas fa-arrow-circle-right"></i>
                </button>
                <hr>
            </div>

            <div class="form-group text-center mb-n1">
                @if (true)
                    <a class="small" href="{{ route_to('password.request') }}">
                        {{ 'Forgot Your Password?' }}
                    </a>
                @endif
            </div>

            <div class="form-group text-center">
                <a class="small" href="{{ route_to('register') }}">
                    {{ 'Create an Account!' }}
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
        let url = '{{ route_to('login.post') }}';

        $.ajax({
            data: data,
            url: url,
            type: 'POST',
            beforeSend: () => {
                $('#login').prop('disabled', true);
                $('.invalid-feedback').remove();
                $('.form-control').removeClass('is-invalid');
                $('#status').collapse('hide')
                    .find('div')
                    .attr('class', 'alert')
                    .html('');
            },
            success: (response) => {
                Cookies.set('token', response.access_token, { 
                    expires: new Date(new Date().getTime() + response.expires_in * 60 * 1000)
                });

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
            $('#login').prop('disabled', false);
        });
    });
</script>
@endpush