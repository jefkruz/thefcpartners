@extends('layouts.admin')

@section('content')


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('includes.admin.alerts')
                    </div>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fa fa-credit-card"></i> Modify Commission Parameters</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{route('settings.wallet')}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">First Interest</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input type="text" class="form-control percent" name="first_interest" value="{{$setting->first_interest}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Second Interest</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input type="text" class="form-control percent" name="second_interest" value="{{$setting->second_interest}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Third Interest</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input type="text" class="form-control percent" name="third_interest" value="{{$setting->third_interest}}" required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Minimum Payout</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">N</span>
                                                    </div>
                                                    <input type="text" class="form-control amount" name="minimum_payout" value="{{$setting->minimum_payout}}" required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="col-md-4 offset-md-2">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h4><i class="fa fa-key"></i> Change Password</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{route('settings.password')}}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Current Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control" name="current_password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">New Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input type="password" class="form-control" name="password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Confirm Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <input type="password" class="form-control" name="password_confirmation" required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-dark"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>


@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.percent').mask('99');
        $('.amount').mask('99999999');
    </script>
    @endsection
