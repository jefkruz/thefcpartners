@extends('layouts.admin')

@section('template_title')
    {{ $receipt->name ?? 'Show Receipt' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Transaction</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('receipts.admin') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">


                        <div class="form-group">
                            <strong>Client Name:</strong>
                            {{ucwords($receipt->client_name)  }}
                        </div>
                        <div class="form-group">
                            <strong>Client Phone:</strong>
                            {{ $receipt->client_phone }}
                        </div>
                        <div class="form-group">
                            <strong>Client Email:</strong>
                            {{ $receipt->client_email }}
                        </div>
                        <div class="form-group">
                            <strong>Estate Name:</strong>
                            {{ucwords($receipt->estate_name)  }}
                        </div>
                        <div class="form-group">
                            <strong>Payment Type:</strong>
                            {{ $receipt->payment_type }}
                        </div>
                        <div class="form-group">
                            <strong>Number of Properties:</strong>
                            {{ $receipt->plots }}
                        </div>
                        <div class="form-group">
                            <strong>Payment Plan:</strong>
                            {{ $receipt->payment_plan }}
                        </div>
                        <div class="form-group">
                            <strong>Bank:</strong>
                            {{ $receipt->bank }}
                        </div>
                        <div class="form-group">
                            <strong>Account Name:</strong>
                            {{ $receipt->account_name }}
                        </div>
                        <div class="form-group">
                            <strong>Amount:</strong>
                            {{ $receipt->amount }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $receipt->description }}
                        </div>
                        <div class="form-group">
                            <strong>File:</strong>
                            <a class="btn btn-sm btn-warning" href="{{route('download', [$receipt->id])}}"><i class="fa fa-fw fa-download"></i>Download</a>

                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>

                                @if($receipt->status=='PENDING')
                                    <span class="badge badge-warning">{{ $receipt->status }}</span>
                                @endif
                                @if($receipt->status=='APPROVED')
                                    <span class="badge badge-success">{{ $receipt->status }}</span>
                                @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
