@extends('layouts.main')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach($properties as $property)
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class=" img-thumbnail " src="{{url('property_upload/'.$property->banner)}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ucwords($property->name)}}</h3>

                            <p class="text-muted text-center">{{ucwords($property->title)}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Actual Price</b> <a class="float-right">NGN {{ number_format($property->actual_price) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Promo Price</b> <a class="float-right">NGN {{ number_format($property->promo_price) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Location</b> <a class="float-right">{{$property->location}}</a>
                                </li>
                            </ul>

                            <a href="{{route('viewProperties',$property->id)}}" class="btn btn-primary btn-block"><b>View More</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            @endforeach

        <!-- /.col -->
    </div>
        </div>
    </section>

@endsection
