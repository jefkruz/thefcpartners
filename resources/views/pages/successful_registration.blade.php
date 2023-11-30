

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
            <p class="login-box-msg">
                You have successfully registered. <br> Please check your mailbox for verification link.
            </p>


            <p class="mt-4 text-center">
                <a href="{{route('login')}}"><i class="fa fa-sign-in-alt"></i> LOGIN</a>
            </p>



        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


@include('includes.admin.scripts')
