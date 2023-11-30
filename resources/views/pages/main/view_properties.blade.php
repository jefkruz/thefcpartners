@extends('layouts.main')



@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>{{ucwords($property->name)}}</b></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <div class="float-right">
                                        <a class="btn btn-primary" href="{{ route('properties.index') }}"> Back</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-12">
                                        <h5 class="">Title:
                                            <b class="">  {{ $property->title }}</b>
                                        </h5>
                                        <hr>
                                        <h4>Property Description</h4>
                                        <div class="post">
                                            {!! html_entity_decode($property->description) !!}

                                        </div>

                                        <div class="post clearfix">

                                            <h4>Property Features</h4>
                                            <div class="post">
                                                {!! html_entity_decode($property->features) !!}

                                            </div>

                                        </div>

                                        <div class="post">

                                            <div class="">

                                                <h5 class="">Size:
                                                    <b class=""> {{ $property->size }}</b>
                                                </h5>
                                                <hr>
                                                <h5 class="">Location:
                                                    <b class=""> {{ $property->location }}</b>
                                                </h5>
                                                <hr>
                                                <h5 class="">Subscription Form:
                                                    <a class="btn btn btn-warning float-right" href="{{route('subscribe', [$property->id])}}"><i class="fa fa-fw fa-download"></i>Download</a>

                                                </h5>

                                            </div>


                                        </div>
                                        @if ($property->images()->count() > 0)
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title">Property Images</h4>

                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach ($property->images() as $picture)
                                                            <div class="col-sm-4">
                                                                <div class="card mb-2 bg-gradient-dark">
                                                                    <img class="card-img-top" src="{{ url('property_upload/' . $picture->image)}}" alt="Property Image">


                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <button id="showDirectionBtn" class="btn btn-primary"><i class="fa fa-map"></i> Show Direction</button>
                            </div>
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col-md-12 img-fluid" id="directionDisplay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <img src="{{url('property_upload/'.$property->banner)}}" width="400px" class="img-thumbnail" >

                            </div>
                            <div class="col-12">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Actual Price </span>
                                        <span class="info-box-number text-red text-center text-muted mb-0">  NGN {{ number_format($property->actual_price) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Promo Price</span>
                                        <span class="info-box-number text-center text-red text-muted mb-0">NGN {{ number_format($property->promo_price) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="timeline-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ $property->video }}" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->


    <div class="modal fade" id="newImageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Property Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{route('property.uploadImage', $property->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="customFile">
                            <label class="custom-file-label" for="customFile">Select Image</label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-upload"></i> UPLOAD</button>
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
    <script>
        const deleteBtn = $('.deleteBtn');

        const directionDisplay = $('#directionDisplay');
        const showDirectionBtn = $('#showDirectionBtn');

        deleteBtn.on('click', function(e){
            e.preventDefault();
            const fm = $(this).data('form');
            if(confirm('Are you sure you want to delete?')){
                $('#' + fm).submit();
            }
        });

        function successPosition(pos){
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            let src = 'https://www.google.com/maps/embed/v1/directions?key={{env('GOOGLE_MAP_KEY')}}';
            src += '&origin=' + lat + ',' + lng;
            src += '&destination=place_id:{{$property->placeID}}';
            const iframe = '<iframe src="' + src + '" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';

            directionDisplay.html(iframe);
            showDirectionBtn.attr('disabled', false);
            showDirectionBtn.html('<i class="fa fa-map"></i> Show Direction');
        }

        function errorPosition(err){
            console.log(err);
        }

        const options = {};

        showDirectionBtn.on('click', function(e){
           if(navigator.geolocation){
               showDirectionBtn.attr('disabled', true);
               showDirectionBtn.html('<i class="fa fa-spinner fa-spin"></i> Loading direction');
               navigator.geolocation.getCurrentPosition(successPosition, errorPosition, options)
           }
        });
    </script>
    @endsection
