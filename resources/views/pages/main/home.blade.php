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
                                @if(session('user') && session('user')->avatar)
                                    <img  class="profile-user-img img-fluid img-circle" src="{{ url('user_profile/' . session('user')->avatar) }}">
                                @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{ url('user_profile/default.png') }}">
                                @endif


                            </div>

                            <h3 class="profile-username text-center">{{session('user')->firstname}} {{session('user')->lastname}}</h3>

                            <p class="text-muted text-center">Realtor</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Referrals</b> <a class="float-right"><span class="badge badge-success">{{$referrals->count()}}</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Commissions:</b> <a class="float-right" href="{{route('commissions.index')}}">₦ {{number_format($commission->sum('interest_amount'))}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Withdrawals:</b> <a class="float-right" href="{{route('commissions.index')}}">₦ {{number_format($payouts->sum('amount'))}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pending Transactions</b> <a class="float-right"><span class="badge badge-warning">{{$pending->count()}}</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Completed Transactions</b> <a class="float-right"><span class="badge badge-success">{{$confirmed->count()}}</span></a>
                                </li>
                                @if($upline->role == 'user')
                                <li class="list-group-item">
                                    <b>Upline Name:</b> <a class="float-right">{{$upline->firstname . ' ' . $upline->lastname}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Upline's Phone</b> <a class="float-right">{{$upline->phone}}</a>
                                </li>
                                @endif

                            </ul>
                            <p hidden id="toCopy">{{url('register'.'/'.$username)}}</p>
                            <button class="btn btn-primary btn-block"  onclick="copyToClipboard('#toCopy')"><b><i class="fas fa-copy me-2"></i> Copy Unique Link</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
                <div class="col-md-9">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$referrals->count()}}</h3>

                                    <p>My Team</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="{{route('referrals')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{count($receipts)}}</h3>

                                    <p>My Transactions</p>

                                </div>
                                <div class="icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                <a href="{{route('receipts.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- ./col -->
                        <div class="col-lg-4 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>₦ {{number_format($commission->sum('interest_amount') - $payouts->sum('amount'))}}</h3>

                                    <p>Wallet Balance</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <a href="{{route('viewcommission')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->

                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">Latest Transactions</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                            <tr>
                                                <th>Trans ID</th>
                                                <th>Client Name</th>
                                                <th>Estate Name</th>
                                                <th>Status</th>


                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($receipts as $receipt)
                                            <tr>
                                                <td><a href="{{route('receipts.show',$receipt->id) }}"><b>TRNS0{{ $receipt->id }}{{ $i++ }}</b></a></td>
                                                <td>{{ ucwords($receipt->client_name) }}</td>
                                                <td>{{ ucwords($receipt->estate_name) }}</td>
                                                <td>
                                                    @if($receipt->status=='PENDING')
                                                        <span class="badge badge-warning">{{ $receipt->status }}</span>
                                                    @endif
                                                    @if($receipt->status=='APPROVED')
                                                        <span class="badge badge-success">{{ $receipt->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">

                                    <a href="{{route('receipts.index')}}" class="btn btn-sm btn-secondary float-right">View All</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Top Realtors</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                        @foreach($sum as $top)
                                            <li class="item">
                                                <div class="product-img">
                                                    <img src="{{asset('storage/users/'.$top->users->avatar )}}" alt="Product Image" class="img-size-50">
                                                </div>
                                                <div class="product-info">
                                                    <a href="javascript:void(0)" class="product-title">{{ucwords($top->users->name)}}
                                                        @php
                                                            $sumtotal =$top->totalsum($top->users->id);
                                                        @endphp
                                                        <span class="badge badge-success float-right">₦{{$sumtotal->sum('amount')}}</span>
                                                    </a>
                                                    <span class="product-description">{{$top->users->email}}</span>
                                                </div>
                                            </li>
                                    @endforeach
                                    <!-- /.item -->

                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                </div>
                                <!-- /.card-footer -->
                            </div>
                        </div>
                    </div>
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-12 col-md-6">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h3 class="card-title">Latest News</h3>--}}

{{--                                    <div class="card-tools">--}}
{{--                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                            <i class="fas fa-minus"></i>--}}
{{--                                        </button>--}}
{{--                                        <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                                            <i class="fas fa-times"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.card-header -->--}}
{{--                                <div class="card-body p-0">--}}
{{--                                    <ul class="products-list product-list-in-card pl-2 pr-2">--}}
{{--                                        @foreach($posts as $post)--}}
{{--                                            <li class="item">--}}
{{--                                                <div class="product-img">--}}
{{--                                                    <img src="{{asset('storage/posts/'.$post->image??'storage/posts/post.png')}}" alt="Product Image" class="img-thumbnail">--}}
{{--                                                </div>--}}
{{--                                                <div class="product-info">--}}
{{--                                                    <a href="{{route('viewpost',[$post->slug])}}" class="product-title">{{ucwords($post->title)}}--}}

{{--                                                        <a href="{{route('viewpost',[$post->slug])}}"> <span class="badge badge-success float-right">Read</span></a>--}}
{{--                                                    </a>--}}
{{--                                                    <span class="product-description"> {!! html_entity_decode($post->body) !!}</span>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                    @endforeach--}}
{{--                                    <!-- /.item -->--}}

{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <!-- /.card-body -->--}}
{{--                                <div class="card-footer text-center">--}}
{{--                                </div>--}}
{{--                                <!-- /.card-footer -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

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
