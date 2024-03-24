<x-laravel-ui-adminlte::adminlte-layout>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ Auth::user()->avatar }}" class="user-image img-circle elevation-2"
                                alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="User Image">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-right"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')

                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"
                    rel="stylesheet">
                <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
                <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
                </script>
                <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
                <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                <link rel="stylesheet" type="text/css"
                    href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
                </head>
            </div>

            <!-- Main Footer -->
            <footer class="main-footer">
                <div class="d-none d-sm-block float-right">
                    <b>Version</b> 3.1.0
                </div>
                <strong>Copyright &copy; 2014-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer>
        </div>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
