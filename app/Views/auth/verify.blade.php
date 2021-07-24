@extends('theme.auth')

@section('content')
<div class="col-lg-6 d-none d-lg-block bg-password-image" style="min-height: 400px;"></div>
<div class="col-lg-6 d-flex align-items-center">
    <div class="p-3">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-2">{{ 'Verify Your Email Address' }}</h1>
            <p class="mb-4">
                {{ 'Before proceeding, please check your email for a verification link.' }}
                {{ 'If you did not receive the email' }}
                <button type="submit" id="resend" class="btn btn-link p-0 m-0 align-baseline">
                    {{ 'click here to request another' }}
                </button>.
            </p>
        </div>

        @if(session()->has('error'))
            <div id="error" class="alert alert-danger" role="alert">
                <h5 class="alert-heading">Whoops! Something went wrong.</h5>
                <hr>
                <p class="mb-0">{{ session('error') }}</p>
            </div>
        @endif

        <div id="status" class="collapse">
            <div class="alert" role="alert"></div>
        </div>

        <form class="d-inline user" method="POST">
            @csrf

            <hr>

            <div class="form-group">
                <button type="button" id="logout" class="btn btn-danger btn-user btn-block">
                    Not My Account
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).on('click', '#resend', function (e) {
        e.preventDefault();

        let url = '{{ route_to('verification.resend') }}';

        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: () => {
                $(this).prop('disabled', true);
                $('#error').remove();
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
                    $('#status').collapse('show')
                        .find('.alert')
                        .addClass('alert-danger')
                        .html(val);
                });
            }
        })
        .always(() => {
            $(this).prop('disabled', false);
        });
    });

    $(document).on('click', '#logout', function (e) {
        e.preventDefault();

        let url = '{{ route_to('logout') }}';

        $.ajax({
            url: url,
            type: 'POST',
            beforeSend: () => {
                $(this).prop('disabled', true);
            },
            success: (response) => {
                window.location = "{{ route_to('login') }}";
            }
        })
        .always(() => {
            $(this).prop('disabled', false);
        });
    });
</script>
@endpush