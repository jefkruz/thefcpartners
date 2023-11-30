@include('includes.main.homepage.header')
@include('includes.main.homepage.navbar')

<body>

<!-- Body Inner -->
<div class="body-inner">


<!-- Page Content -->
    <section id="page-content" class="sidebar-left">
        <div class="container">
            <div class="row">
                <!-- Sidebar-->
                <div class="sidebar sticky-sidebar col-lg-4">
                    <!--Tabs with Posts-->
                    <div class="widget widget-myaccount p-cb">
                        <a class="btn btn-block btn-primary" data-bs-target="#modal" data-bs-toggle="modal" href="#"><i class="fas fa-share"></i> Share this Profile</a>

                        <div class="d-block">
                            @if($profile && $profile->avatar)

                                <img class="img-circle" width="150px"  src=" {{ url('user_profile/' . $profile->avatar) }}">
                            @else
                                <img class="img-circle" width="150px"  src="  {{ url('user_profile/default.png') }}">

                            @endif

                        </div>
                        <br>
                        <span></span>
                        <h4>{{$profile->name}}<a class="btn btn-sm btn-success float-right" ><i class="fas fa-map-marker"></i> {{$profile->country}}</a></h4>
                        <div class="row">

                            <div class="col-md-6">
                                <a href="tel:{{$profile->phone}}"  class="btn btn-light btn-block">Call</a>
                            </div>
                            <div class="col-md-6">
                                <a href="mailto:{{$profile->email}}"  class="btn btn-light btn-block">Mail</a>
                            </div>
                            <br>
                            <div class="col-md-12">
                                @if($profile && $profile->address)
                                <p class="btn btn-light btn-block text-justify">{{$profile->address}}<br>{{$profile->city}}, {{$profile->state}}</p>
                                @endif
                                <a href="https://wa.me/{{$profile->phone}}" class="btn btn-light btn-block text-justify">
                                    <img src="{{asset('portal/dist/img/whatsapp.png')}}" alt="" class=" mr-2" style="height: 30px; width: auto; margin-top: -5px;">
                                    chat on Whatsapp </a>
                            </div>

                        </div>

                    </div>
                    <!--End: Tabs with Posts-->

                </div>
                <!-- end: Sidebar-->
                <!-- post content -->
                <div class="content col-lg-8">
                    <!-- Page title -->
                    <div class="page-title">
                        <h2 class="text-bold">Properties For You</h2>

                    </div>
                    <!-- end: Page title -->

                    <!-- Blog -->
                    <div id="blog" class="post-thumbnails">

                        <!-- Post item-->
                        @foreach($properties as $property)
                        <div class="post-item">
                            <div class="post-item-wrap">
                                <div class="post-slider">
                                    <div class="carousel dots-inside arrows-visible arrows-only" data-items="1" data-loop="true" data-autoplay="true" data-lightbox="gallery">
                                        <a href="{{ url('property_upload/' . $property->banner)}}" data-lightbox="gallery-image">
                                            <img alt="" src="{{ url('property_upload/' . $property->banner)}}">
                                        </a>
                                        @foreach ($property->images() as $picture)
                                        <a href="{{ url('property_upload/' . $picture->image)}}" data-lightbox="gallery-image">
                                            <img alt="" src="{{ url('property_upload/' . $picture->image)}}">
                                        </a>
                                        @endforeach

                                    </div>
{{--                                    <span class="post-meta-category">{{ucwords($property->location)}}</span>--}}
                                </div>
                                <div class="post-item-description">
                                    <span class="post-meta-date"><strong>Title: </strong> {{$property->title}}</span>
                                    <h2><a href="#">{{ucwords($property->name)}}</a></h2>
                                    <p><strong>Location:</strong> {{ucwords($property->location)}}</p>
                                    <p style="color: #ad7f00"><strong>Actual Price: </strong> NGN {{number_format($property->actual_price)}} </p>
                                    <p style="color: #ad7f00"><strong>Promo Price: </strong> NGN {{number_format($property->promo_price)}} </p>

                                    <div class="toggle accordion accordion-shadow">
                                        <div class="ac-item ">
                                            <h5 class="ac-title">Property Description</h5>
                                            <div class="ac-content">
                                                {!! html_entity_decode($property->description) !!}
                                            </div>
                                        </div>
                                        <div class="ac-item ">
                                            <h5 class="ac-title">Property Features</h5>
                                            <div class="ac-content">
                                                {!! html_entity_decode($property->features) !!}
                                            </div>
                                        </div>
                                        @if($property && $property->video)
                                        <div class="ac-item ">
                                            <h5 class="ac-title">Property Video</h5>
                                            <div class="ac-content">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe  src="{{$property->video}}" allowfullscreen=""></iframe></div>
                                            </div>
                                        </div>
                                            @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                       @endforeach
                        <!-- end: Post item-->

                    </div>
                    <!-- end: Blog -->

                </div>
                <!-- end: post content -->

            </div>
        </div>
    </section>
    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }
        div#social-links ul li {
            display: inline-block;
        }
        div#social-links ul li a {
            padding: 20px;
            border: 1px solid #ccc;
            margin: 10px;
            font-size: 30px;
            color: #ffffff;
            background-color: #ad7f00;
        }
    </style>
<!-- end: Page Content -->
    <!--Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-label">Social Share</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            {!! $shareComponent !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-b" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- end: Modal -->
@include('includes.main.homepage.scripts')
