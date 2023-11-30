@extends('layouts.admin')
@section('datastyles')
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('portal/plugins/summernote/summernote-bs4.min.css')}}">
@endsection



@section('content')
    <section class="content container-fluid">
        <div class="">
            @include('includes.admin.alerts')
            <div class="col-md-10">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Property</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('properties.update', $property->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.property.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('includes/map')
@section('datascripts')
    <!-- summernote -->
    <!-- Summernote -->
    <script src="{{asset('portal/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            // Summernote
            $('#description').summernote()
            $('#features').summernote()


        })
    </script>
@endsection
