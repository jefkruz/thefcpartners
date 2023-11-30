@extends('layouts.main')


@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>N{{number_format($commissions->sum('interest_amount'))}}</h3>

                        <p>Total Commissions</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>N{{number_format($payouts->sum('amount'))}}</h3>

                        <p>Total Payouts</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- small box -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3>N{{number_format($commissions->sum('interest_amount') - $payouts->sum('amount'))}}</h3>

                        <p>Wallet Balance</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-credit-card"></i>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">My Commissions</h3>
                        <div class="float-right">
                            <a href="{{ route('home') }}" class="btn btn-danger btn-sm float-right"  data-placement="left">
                                Back
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SN</th>
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
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">My Payouts</h3>
                        <div class="float-right">
                            <button data-toggle="modal" data-target="#withdrawFundModal" class="btn btn-dark float-right"  data-placement="left">
                                Withdraw Fund
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>REFERENCE</th>
                                <th>AMOUNT</th>
                                <th>TRANSACTION FEE</th>
                                <th>DATE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($payouts as $j => $payout)
                                <tr>
                                    <td>{{$j + 1}}</td>
                                    <td>{{$payout->reference}}</td>
                                    <td>₦{{ number_format($payout->amount) }}</td>
                                    <td>₦{{ number_format($payout->fee) }}</td>
                                    <td>{{$payout->created_at->toFormattedDateString()}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="withdrawFundModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Withdraw Fund</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('withdrawFund')}}">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    Minimum withdrawal amount is NGN {{number_format($setting->minimum_payout)}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="text" id="amount" placeholder="Enter withdrawal amount" class="form-control" name="amount" required>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary"><i class="fa fa-credit-card"></i> Process Fund Withdrawal</button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#amount').mask('99999999');
    </script>
    @endsection
