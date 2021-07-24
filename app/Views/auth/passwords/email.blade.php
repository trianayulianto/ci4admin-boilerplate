@extends('theme.auth')

@section('content')
<div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
<div class="col-lg-6">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
            <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
        </div>

        <form class="user" method="POST">
            @csrf
            
            <div id="status" class="collapse">
                <div class="alert" role="alert"></div>
            </div>
            
            <div class="form-group row">
                <input id="email" type="email" name="email" class="form-control form-control-user" required autocomplete="email" autofocus>
            </div>

            <div class="form-group row">
                <button type="submit" id="send" class="btn btn-primary btn-user btn-block">
                    Send Password Reset Link <i class="fas fa-arrow-circle-right"></i>
                </button>
            </div>
            <hr>

            <div class="text-center">
                <a class="small" href="{{ route_to('register') }}">Create an Account!</a>
            </div>
            <div class="text-center">
                <a class="small" href="{{ route_to('login') }}">Already have an account? Login!</a>
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
        let url = '{{ route_to('password.email') }}';
        
        $.ajax({
            data: data,
            url: url,
            type: 'POST',
            beforeSend: () => {
                $('#send').prop('disabled', true);
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
                    
                    $('#'+key).addClass('is-invalid')
                        .after('<small class="invalid-feedback">'+val+'</small>');
                });
            }
        })
        .always(() => {
            $('#send').prop('disabled', false);
        });
    });
</script>
@endpush
