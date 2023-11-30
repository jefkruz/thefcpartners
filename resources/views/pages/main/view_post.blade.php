@extends('layouts.main')



@section('content')
    <div class="col-md-6">
        <!-- Box Comment -->
        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <img class="img-circle" src="{{asset('favicon.png')}}" alt="User Image">
                    <span class="username"><a href="#">Administrator</a></span>
                    <span class="description">Shared publicly -{{date('jS F, Y ', strtotime($post->created_at)) }}</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">

                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <img class="img-fluid pad" src="{{asset('storage/posts/'.$post->image??'storage/posts/post.png')}}" alt="Photo">
                <br>
                <h3>{{ucwords($post->title)}}</h3>
                {!! html_entity_decode($post->body) !!}

            </div>
            <!-- /.card-body -->

            <!-- /.card-footer -->
            <div class="card-footer">
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
                </div>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>


@endsection
