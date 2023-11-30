@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Total Commissions</h3>
                        <div class="float-right">
                            <a href="{{ route('admin') }}" class="btn btn-danger btn-sm float-right"  data-placement="left">
                                Back
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Commission</th>
                                <th>Percentage</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($commissions as $i => $commission)
                                <tr>

                                    <td>{{$i+ 1}}</td>
                                    <td>{{$commission->user->firstname}} {{$commission->user->lastname}}</td>
                                    <td>₦{{ number_format($commission->product_amount) }}</td>
                                    <td>₦{{ number_format($commission->interest_amount) }}</td>
                                    <td>{{$commission->percentage}}%</td>
                                    <td>{{$commission->created_at->toFormattedDateString()}}</td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Commission</th>
                                <th>Percentage</th>
                                <th>Date</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>

        </div>
    </div>
    @include('includes.admin.data')
@endsection
