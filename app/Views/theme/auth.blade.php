<!DOCTYPE html>
<html>
<head>
    <base href="{{ base_url('/') }}" target="_top">
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Auth') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}}
    
    <!-- Custom styles for this template-->
    <link href="{{ base_url('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-primary">
    <div class="container">
        <div class="row pt-4">
            <div class="col-lg-12 p-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('modal')
    </div>

    <!-- Custom scripts for all pages-->
    <script src="{{ base_url('js/manifest.js') }}"></script>
    <script src="{{ base_url('js/vendor.js') }}"></script>
    <script src="{{ base_url('js/app.js') }}"></script>
    <script src="{{ base_url('js/custom.js') }}"></script>
    @stack('scripts')
</body>
</html>
