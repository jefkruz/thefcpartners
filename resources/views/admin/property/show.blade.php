@extends('layouts.admin')



@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
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
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">

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
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title">Property Images</h4>

                                        <button data-toggle="modal" data-target="#newImageModal" class="btn btn-dark btn-sm fa-pull-right"><i class="fa fa-plus"></i> Add Image</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($property->images() as $picture)
                                                <div class="col-sm-4">
                                                    <div class="card mb-2 bg-gradient-dark">
                                                        <img class="card-img-top" src="{{ url('property_upload/' . $picture->image)}}" alt="Property Image">
                                                        <div class="card-img-overlay text-right">
                                                            <button class="btn btn-sm btn-danger deleteBtn" data-form="delete-{{$picture->id}}"><i class="fa fa-times-circle"></i></button>
                                                        </div>
                                                        <form action="{{route('property.deleteImage', [$property->id, $picture->id])}}" method="post" id="delete-{{$picture->id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <div class="">
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
                        <br>



                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

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

        deleteBtn.on('click', function(e){
            e.preventDefault();
            const fm = $(this).data('form');
            if(confirm('Are you sure you want to delete?')){
                $('#' + fm).submit();
            }
        });
    </script>
    @endsection
