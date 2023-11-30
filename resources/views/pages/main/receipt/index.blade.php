@extends('layouts.main')



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <div class="">
                    <a href="{{ route('receipts.create') }}"  > <button type="button" class="btn btn-info btn-block mb-3"><i class="fa fa-plus"></i> Payment Upload </button></a>
                    <div class="col-12 ">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-file-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Transactions</span>
                                <span class="info-box-number">{{$receipts->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-file-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Confirmed</span>
                                <span class="info-box-number">{{$confirmed->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-file-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pending</span>
                                <span class="info-box-number">{{$pending->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-file-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Canceled</span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">

                    <div class="card-header p-2">
                        <div class="float-right">
                            <a href="{{ route('receipts.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Payment Upload ') }}
                            </a>
                        </div>
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">All</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Pending</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Confirmed</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">All Transactions</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Trans ID</th>
                                                <th>Client Name</th>
                                                <th>Estate Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($receipts as $receipt)
                                            <tr>
                                                <td style="color: green;"><b>TRNS0{{ $receipt->id }}{{ $i++ }}</b></td>
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
                                                <td>
                                                    <form action="{{ route('receipts.destroy',$receipt->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-warning" href="{{route('download', [$receipt->id])}}"><i class="fa fa-fw fa-download"></i>Download</a>
                                                        <a class="btn btn-sm btn-info " href="{{ route('receipts.show',$receipt->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('receipts.edit',$receipt->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>

                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Trans ID</th>
                                                <th>Client Name</th>
                                                <th>Estate Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>



                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Pending Transactions</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Trans ID</th>
                                                <th>Client Name</th>
                                                <th>Estate Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($pending as $receipt)
                                                <tr>
                                                    <td style="color: green;"><b>TRNS0{{ $receipt->id }}{{ $i++ }}</b></td>
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
                                                    <td>
                                                        <form action="{{ route('receipts.destroy',$receipt->id) }}" method="POST">
                                                            <a class="btn btn-sm btn-warning" href="{{route('download', [$receipt->id])}}"><i class="fa fa-fw fa-download"></i>Download</a>
                                                            <a class="btn btn-sm btn-info " href="{{ route('receipts.show',$receipt->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                            <a class="btn btn-sm btn-success" href="{{ route('receipts.edit',$receipt->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>

                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Trans ID</th>
                                                <th>Client Name</th>
                                                <th>Estate Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Completed Transactions</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Trans ID</th>
                                                <th>Client Name</th>
                                                <th>Estate Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($confirmed as $receipt)
                                                <tr>
                                                    <td style="color: green;"><b>TRNS0{{ $receipt->id }}{{ $i++ }}</b></td>
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
                                                    <td>
                                                        <form action="{{ route('receipts.destroy',$receipt->id) }}" method="POST">
                                                            <a class="btn btn-sm btn-warning" href="{{route('download', [$receipt->id])}}"><i class="fa fa-fw fa-download"></i>Download</a>
                                                            <a class="btn btn-sm btn-info " href="{{ route('receipts.show',$receipt->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                            <a class="btn btn-sm btn-success" href="{{ route('receipts.edit',$receipt->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>

                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Trans ID</th>
                                                <th>Client Name</th>
                                                <th>Estate Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
            </div>
        </div>


    </div>
    @include('includes.admin.data')
@endsection
