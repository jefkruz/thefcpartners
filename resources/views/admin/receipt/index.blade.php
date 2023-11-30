@extends('layouts.admin')



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <div class="">
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
                            <a href="{{ route('admin') }}" class="btn btn-danger btn-sm float-right"  data-placement="left">
                                Back
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
                                                <th>Realtor</th>
                                                <th>Status</th>
                                                <th>Download</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($receipts as $receipt)
                                            <tr>
                                                <td style="color: green;"><b>TRNS0{{ $receipt->id }}{{ $i++ }}</b></td>
                                                <td>{{ ucwords($receipt->client_name) }}</td>
                                                <td>{{ ucwords($receipt->estate_name) }}</td>
                                                <td>{{ ucwords($receipt->realtor()->firstname . ' ' . $receipt->realtor()->lastname) }}</td>
                                                <td>
                                                    @if($receipt->status=='PENDING')
                                                    <span class="badge badge-warning">{{ $receipt->status }}</span>
                                                    @endif
                                                        @if($receipt->status=='APPROVED')
                                                        <span class="badge badge-success">{{ $receipt->status }}</span>
                                                        @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning" href="{{route('download', [$receipt->id])}}"><i class="fa fa-fw fa-download"></i>Download</a>

                                                </td>
                                                <td>
                                                    <form action="{{ route('receipts.destroy',$receipt->id) }}" method="POST">

                                                        <a class="btn btn-sm btn-info " href="{{ route('receipts.view',$receipt->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>

                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach

                                            </tbody>
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
                                    <div class="card-body table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Trans ID</th>
                                                <th>Client Name</th>
                                                <th>Estate Name</th>
                                                <th>Realtor</th>
                                                <th>Status</th>
                                                <th>Download</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($pending as $receipt)
                                                <tr>
                                                    <td style="color: green;"><b>TRNS0{{ $receipt->id }}{{ $i++ }}</b></td>
                                                    <td>{{ ucwords($receipt->client_name) }}</td>
                                                    <td>{{ ucwords($receipt->estate_name) }}</td>
                                                    <td>{{ ucwords($receipt->realtor()->firstname . ' ' . $receipt->realtor()->lastname) }}</td>
                                                    <td>
                                                        <span class="badge badge-warning">{{ $receipt->status }}</span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning" href="{{route('download', [$receipt->id])}}"><i class="fa fa-fw fa-download"></i>Download</a>

                                                    </td>
                                                    <td>
                                                        <form action="{{ route('receipts.destroy',$receipt->id) }}" method="POST">
                                                            <div class="btn-group">
                                                                <button data-id="{{$receipt->id}}" type="button" class="btn btn-primary btn-sm confirmBtn"><i class="fa fa-fw fa-check"></i>Confirm</button>
                                                            <a class="btn btn-sm btn-info " href="{{ route('receipts.show',$receipt->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                            <a class="btn btn-sm btn-light" href="{{ route('receipts.edit',$receipt->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>

                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
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
                                                <th>Realtor</th>
                                                <th>Status</th>
                                                <th>Download</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($confirmed as $receipt)
                                                <tr>
                                                    <td style="color: green;"><b>TRNS0{{ $receipt->id }}{{ $i++ }}</b></td>
                                                    <td>{{ ucwords($receipt->client_name) }}</td>
                                                    <td>{{ ucwords($receipt->estate_name) }}</td>
                                                    <td>{{ ucwords($receipt->realtor()->firstname . ' ' . $receipt->realtor()->lastname) }}</td>
                                                    <td>
                                                        <span class="badge badge-success">{{ $receipt->status }}</span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning" href="{{route('download', [$receipt->id])}}"><i class="fa fa-fw fa-download"></i>Download</a>

                                                    </td>
                                                    <td>
                                                        <form action="{{ route('receipts.destroy',$receipt->id) }}" method="POST">
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

    <div class="modal fade" id="confirmDialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="{{ route('confirm')}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="receiptID" required>
                        <div class="row">
                            <div class="col-md-12 text-center mt-3">
                                <p>Please enter verification code sent to your email address</p>
                            </div>

                            <div class="col-md-6 offset-md-3 text-center mt-3">
                                <input type="text" class="form-control" name="code" maxlength="6" required>
                            </div>


                            <div class="col-md-12 text-center mt-3 mb-3">
                                <button type="submit" class="btn btn-danger">Complete Transaction Process</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('includes.admin.data')
@endsection

@section('script')
    <script>
        const confirmModal = $('#confirmDialog');
        const confirmBtn = $('.confirmBtn');
        const validateBtn = $('#validateBtn');
        const receiptInput = $('#receiptID');

        confirmBtn.on('click', function(e){
            e.preventDefault();
            const id = $(this).data('id');
            receiptInput.val(id);

            if(confirm('Are you sure you want to approve this transaction?')){
                setCode(id);
                confirmModal.modal();
            }
        });


        function setCode(id){
            $.ajax({
                method: "PUT",
                data: {id: id, _token: '{{csrf_token()}}'},
                url: "{{route('setReceiptCode')}}",
                success: function(data){
                    console.log(data);
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    </script>
    @endsection
