@extends('theme.auth')

@section('content')
<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
<div class="col-lg-7">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
        </div>
        <form class="user" method="POST">
            @csrf

            <div id="status" class="collapse">
                <div class="alert" role="alert"></div>
            </div>

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group collapse">
                <input id="email" type="email" class="form-control form-control-user" name="email" value="{{ $email }}" required readonly="">
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control form-control-user" name="password" required autocomplete="new-password" autofocus placeholder="Enter Password...">
            </div>

            <div class="form-group">
                <input id="password_confirmation" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password"autofocus placeholder="Enter Repeat Password...">
            </div>

            <div class="form-group">
                <button type="submit" id="reset" class="btn btn-primary btn-user btn-block">
                    Reset Password <i class="fas fa-arrow-circle-right"></i>
                </button>

                <hr>

                <div class="text-center">
                    <a class="small" href="{{ route_to('register') }}">Create an Account!</a>
                </div>
                <div class="text-center">
                    <a class="small" href="{{ route_to('login') }}">Already have an account? Login!</a>
                </div>
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
        let url = '{{ route_to('password.update') }}';

        $.ajax({
            data: data,
            url: url,
            type: 'POST',
            beforeSend: () => {
                $('#reset').prop('disabled', true);
                $('.invalid-feedback').remove();
                $('.form-control').removeClass('is-invalid');
                $('#status').collapse('hide')
                    .find('div')
                    .attr('class', 'alert')
                    .html('');
            },
            success: (response) => {
                $('#status').collapse('show')
                    .find('.alert')
                    .addClass('alert-success')
                    .html(response.message+'. You can <a href="{{ route_to('login') }}">Login</a> now.');
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
            }
        });
    });


    $(document).on('click', '#send', (e) => {
        e.preventDefault();
        
        let email = $('#email').val();

        $.ajax({
            data: {
                email: email
            },
            url: '{{ route_to('password.email') }}',
            type: 'POST',
            beforeSend: () => {
                $(this).prop('disabled', true);
            },
            success: (response) => {
                $('#status').collapse('show')
                    .find('.alert')
                    .addClass('alert-success')
                    .html(response.message);
            },
            error: (response) => {
                $.each(response.responseJSON.messages, (key, val) => {
                    if (key === 'error') {
                        $('#status').collapse('show')
                            .find('.alert')
                            .addClass('alert-danger')
                            .html(val);
                    }
                });
            }
        })
        .always(() => {
            $(this).prop('disabled', false);
        });
    });
</script>
@endpush