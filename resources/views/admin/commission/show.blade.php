@extends('layouts.main')



@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Commission</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('commissions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $commission->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Receipt Id:</strong>
                            {{ $commission->receipt_id }}
                        </div>
                        <div class="form-group">
                            <strong>Amount:</strong>
                            {{ $commission->amount }}
                        </div>
                        <div class="form-group">
                            <strong>Commission:</strong>
                            {{ $commission->commission }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
