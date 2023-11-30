<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('estate_name') }}
                    {{ Form::text('name', $property->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-6">

                <div class="form-group">

                    {{ Form::label('featured_image') }}
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="banner" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>

            <input type="hidden" name="latitude" value="{{$property->latitude ? $property->latitude : 6.5244}}" id="latitude">
            <input type="hidden" name="longitude" value="{{$property->longitude ? $property->longitude : 3.3792}}" id="longitude">
            <input type="hidden" name="placeID" value="{{$property->placeID}}" id="placeID">

            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('location') }}
                    <div class="input-group">
                        {{ Form::text('location', $property->location, ['id' => 'locationInput', 'class' => 'form-control' . ($errors->has('location') ? ' is-invalid' : ''),'required', 'placeholder' => 'Location']) }}
                        <span class="input-group-append">
                    <button id="mapBtn" type="button" class="btn btn-info btn-flat"><i class="fa fa-map-marker-alt"></i> Select on Map</button>
                  </span>
                    </div>

                    {!! $errors->first('location', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('title') }}
                    {{ Form::text('title', $property->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'required', 'placeholder' => 'Title']) }}
                    {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('size') }}
                    {{ Form::text('size', $property->size, ['class' => 'form-control' . ($errors->has('size') ? ' is-invalid' : ''), 'placeholder' => 'Size']) }}
                    {!! $errors->first('size', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('actual_price') }}
                    {{ Form::text('actual_price', $property->actual_price, ['class' => 'form-control' . ($errors->has('actual_price') ? ' is-invalid' : ''), 'placeholder' => 'Actual Price']) }}
                    {!! $errors->first('actual_price', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('promo_price') }}
                    {{ Form::text('promo_price', $property->promo_price, ['class' => 'form-control' . ($errors->has('promo_price') ? ' is-invalid' : ''), 'placeholder' => 'Promo Price']) }}
                    {!! $errors->first('promo_price', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('video') }}
                    {{ Form::text('video', $property->video, ['class' => 'form-control' . ($errors->has('video') ? ' is-invalid' : ''), 'placeholder' => 'Video Link']) }}
                    {!! $errors->first('video', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-lg-6">

                <div class="form-group">

                    {{ Form::label('subscription form') }}
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"  name="form" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    {{ Form::label('description') }}
                    <textarea id="description" required name="description">
               {{$property->description}}
              </textarea>

                </div></div>
            <div class="col-lg-12">
                <div class="form-group">
                    {{ Form::label('features') }}
                    <textarea id="features"  name="features">
               {{$property->features}}
              </textarea>
                </div>
            </div>

        </div>


    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>


<div class="modal fade" id="mapModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="mapModalTitle">Select Location</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button class="btn btn-info" data-dismiss="modal"><i class="fa fa-map-marker-alt"></i> Set Position</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
