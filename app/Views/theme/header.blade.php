
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <div class="d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        {{-- <h4 class="sidebar-brand-text mx-1">CILoq</h4> --}}
    </div>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-800 small">{{ auth()->user()->name ?? 'me' }}</span>
            <i class="fas fa-user-circle"></i>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            @auth
                <a href="{{ route_to('profile.index') }}" class="dropdown-item">
                    <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a href="#" id="logout" class="dropdown-item">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            @endauth
        </div>
        </li>

    </ul>

</nav>

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '#logout', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route_to('logout') }}",
                type: "POST",
                success: (response) => {
                    const delCookie = Cookies.remove('token');

                    return setTimeout(() => {
                        window.location = "{{ route_to('homepage') }}";
                    }, 1500);
                }
            });
        });
    </script>
@endpush