

@include('includes.admin.header')
<body class="hold-transition login-page">
<div class="mt-5 ml-3 mr-3">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary ">
        <div class="card-header text-center">
            <a href="{{route('home')}}" class="h1">
                <img src="{{asset('logo.png')}}" height="60" alt="FCP" />

            </a>
        </div>
        <div class="card-body">

            @include('includes.admin.alerts')
            @if($refer->username != 'admin')
            <p class="login-box-msg">You are being referred by <b>{{ucwords($refer->firstname . ' ' . $refer->lastname)}}</b></p>
            @endif
            <form method="POST" >
                @csrf

                <input type="hidden" name="referral_id" value="{{$refer->id}}" required>
                <div class="row">
                    <div class="col-md-6 input-group mb-3">
                        <input name="firstname" type="text" placeholder="First name" class="form-control form-control-lg" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <input name="lastname" type="text" placeholder="Last name" class="form-control form-control-lg" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 input-group mb-3">
                        <input type="email" name="email" required class="form-control form-control-lg" value="{{ old('email') }}" placeholder="Email Address">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <input type="text" class="form-control form-control-lg"  name="username" required value="{{ old('username') }}" placeholder="Unique Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">


                    <div class="col-md-6 input-group mb-3">
                        <input type="text" class="form-control form-control-lg" name="b_date" value="{{old('b_date')}}" placeholder="Enter Birthday Date" required>

                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <select class="form-control form-control-lg " name="b_month" required>

                            @for($i = 1; $i <= 12; $i++)
                            <option value='{{date('m', strtotime('2023-' . $i))}}'>{{date('F', strtotime('2023-' . $i))}}</option>
                                @endfor

                        </select>
                    </div>
                    <div class="col-md-12 input-group mb-3">
                        <input type="text" class="form-control form-control-lg"  name="phone" inputmode="tel" required value="{{ old('phone') }}"placeholder="Phone Number" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 input-group mb-3">
                        <input type="password"  name="password" class="form-control form-control-lg" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <input type="password"  name="password_confirmation" required class="form-control form-control-lg" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                </div>
                @include('includes.admin.verify')


                <div class="row mt-3">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" required name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>


            <p class="mb-1">
                Already have an account?  <a href="{{ route('login') }}">Sign In</a>
            </p>





        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


@include('includes.admin.scripts')
