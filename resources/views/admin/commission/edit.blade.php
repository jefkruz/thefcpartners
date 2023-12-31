@extends('layouts.admin')

@section('template_title')
    Update Commission
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Commission</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('commissions.update', $commission->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('commission.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
