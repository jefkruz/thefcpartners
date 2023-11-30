

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
            <p class="login-box-msg">You are being referred by <b>{{ucwords($refer->name)}}</b></p>
            <form method="POST" >
                @csrf
                <div class="row">
                    <div class="col-md-6 input-group mb-3">
                        <input name="referral_id" readonly type="text"  value="{{$refer->username}}" class="form-control form-control-lg" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <input type="text" class="form-control form-control-lg" name="name" value="{{old('name')}}" required placeholder="Full Name">
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
                        <input type="text" class="form-control form-control-lg" name="b_date" value="{{old('b_date')}}" placeholder="Enter Birthday Date">

                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <select class="form-control form-control-lg " name="b_month"  required>

                            <option value='January'>January</option>
                            <option value='February'>February</option>
                            <option value='March'>March</option>
                            <option value='April'>April</option>
                            <option value='May'>May</option>
                            <option value='June'>June</option>
                            <option value='July'>July</option>
                            <option value='August'>August</option>
                            <option value='September'>September</option>
                            <option value='October'>October</option>
                            <option value='November'>November</option>
                            <option value='December'>December</option>

                        </select>
                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <input type="text" class="form-control form-control-lg"  name="phone" inputmode="tel" required value="{{ old('phone') }}"placeholder="Phone Number" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <input type="text" name="bank" required class="form-control form-control-lg" value="{{ old('bank') }}" placeholder="Bank Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-building"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 input-group mb-3">
                        <input type="text" name="acc_name" required class="form-control form-control-lg" value="{{ old('acc_name') }}" placeholder="Account Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 input-group mb-3">
                        <input type="text" name="acc_number" required class="form-control form-control-lg" value="{{ old('acc_number') }}" placeholder="Account Number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-bank"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 input-group mb-3">
                        <input type="password"  name="password" class="form-control form-control-lg" placeholder="Password">
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
