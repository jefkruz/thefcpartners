@extends('layouts.main')


@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Upload Receipt</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('receipts.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('pages.main.receipt.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
