@extends('layouts.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset('storage/users/'.$referral->avatar?? 'storage/users/default.png')}}"
                                     alt="{{ucwords($referral->name)}}">
                            </div>

                            <h3 class="profile-username text-center">{{ucwords($referral->name)}}</h3>

                            <p class="text-muted text-center">Realtor</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Referrals:</b>
                                    @if($downlines->count()>0)
                                        <a class="float-right">  {{ $downlines->count() }}</a>
                                    @else
                                       <span class="float-right">None</span>
                                    @endif
                                </li>

                                <li class="list-group-item">
                                    <b>  <i class="fas fa-envelope mr-1"></i>Email:</b> <a class="float-right" href="mailto:{{$referral->email}}">{{$referral->email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>  <i class="fas fa-phone mr-1"></i>Phone Number:</b> <a class="float-right" href="tel:{{$referral->phone}}">{{$referral->phone}}</a>
                                </li>

                            </ul>
                            <p hidden id="toCopy">{{url('register'.'/'.$referral->username)}}</p>
                            <button class="btn btn-primary btn-block"  onclick="copyToClipboard('#toCopy')"><b><i class="fas fa-copy me-2"></i> Copy Unique Link</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bank Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Bank Name:</b>
                                        <span class="float-right">None</span>

                                </li>

                                <li class="list-group-item">
                                    <b>  <i class="fas fa-envelope mr-1"></i>Email:</b> <a class="float-right" href="mailto:{{$referral->email}}">{{$referral->email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>  <i class="fas fa-phone mr-1"></i>Phone Number:</b> <a class="float-right" href="tel:{{$referral->phone}}">{{$referral->phone}}</a>
                                </li>

                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ucwords($referral->name)}} Downlines</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">S/N</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th >Reg. Date</th>
                                    <th >Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($downlines as $referral)
                                    @php $next = \App\Models\User::where('referal_id',$referral->id) @endphp
                                    <tr>

                                        <td>{{$i++}}</td>
                                        <td>{{ucwords($referral->name)}}</td>
                                        <td>{{$referral->email}}</td>
                                        <td>{{$referral->phone}}</td>

                                        <td>{{  date('j \\ F Y', strtotime($referral->created_at)) }}</td>
                                        <td class="project-actions">
                                            <a class="btn btn-sm btn-success " href="{{ route('view',$referral->username) }}"><i class="fa fa-fw fa-eye"></i>View</a>

                                        </td>
                                    </tr>
                                @endforeach



                                </tbody>
                                <tfoot>
                                <tr>
                                    <th >S/N</th>
                                    <th >Name</th>
                                    <th >Email</th>
                                    <th >Phone Number</th>

                                    <th >Reg. Date</th>

                                    <th >Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            alert ("link copied!");
        }
    </script>
@endsection
