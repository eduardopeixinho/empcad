<x-laravel-ui-adminlte::adminlte-layout>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
            </div>
            <!-- /.login-logo -->

            <!-- /.login-box-body -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <a href="{{ route('google.login') }}" class="btn btn-outline-dark btn-sm btn-block active"
                        role="button" aria-pressed="true">Conectar com Google</a>
                    <!-- /.login-card-body -->
                </div>

            </div>
            <!-- /.login-box -->
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
