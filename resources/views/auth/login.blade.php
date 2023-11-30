

@include('includes.admin.header')
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{route('home')}}" class="h1">
                <img src="{{asset('logo.png')}}" height="60" alt="FCP" />

            </a>
        </div>
        <div class="card-body">
            @include('includes.admin.alerts')
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password"  name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @include('includes.admin.verify')

                <div class="row mt-1">
                    <div class="col-8 ">
                        <div class="icheck-primary">
                            <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-success btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            @if (Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                </p>

            @endif

            <p class="mt-4 text-center">
                <a href="{{route('register')}}">Not registered?</a>
            </p>



        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


@include('includes.admin.scripts')
