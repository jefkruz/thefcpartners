@extends('layouts.main')



@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Transaction</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('receipts.update', $receipt->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('pages.main.receipt.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
