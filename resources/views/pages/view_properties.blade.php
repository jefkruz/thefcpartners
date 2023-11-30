@include('includes.main.homepage.header')
@include('includes.main.homepage.navbar')

<body>

<!-- Body Inner -->
<div class="body-inner">


<!-- Page Content -->
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <!-- content -->
            <div class="content col-lg-9">
                <!-- Blog -->
                <div id="blog" class="single-post">
                    <!-- Post single item-->
                    <div class="post-item">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="#">
                                    <img alt="" src="{{asset('storage/properties/'.$property->banner)}}">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <h2>{{ucwords($property->name)}}</h2>
                                <div class="post-meta">
                                    <h4 ><strong>Title:</strong></i>{{$property->title}}</h4>

                                    <h4 ><strong>Actual Price:</strong> {{ $property->actual_price }}</h4>

                                    <h4 ><strong>Promo price:</strong></i>{{ $property->promo_price }}</h4>
{{--                                    <div class="post-meta-share">--}}
{{--                                        <a class="btn btn-xs btn-slide btn-facebook" href="#">--}}
{{--                                            <i class="fab fa-facebook-f"></i>--}}
{{--                                            <span>Facebook</span>--}}
{{--                                        </a>--}}
{{--                                        <a class="btn btn-xs btn-slide btn-twitter" href="#" data-width="100">--}}
{{--                                            <i class="fab fa-twitter"></i>--}}
{{--                                            <span>Twitter</span>--}}
{{--                                        </a>--}}
{{--                                        <a class="btn btn-xs btn-slide btn-instagram" href="#" data-width="118">--}}
{{--                                            <i class="fab fa-instagram"></i>--}}
{{--                                            <span>Instagram</span>--}}
{{--                                        </a>--}}
{{--                                        <a class="btn btn-xs btn-slide btn-googleplus" href="mailto:#" data-width="80">--}}
{{--                                            <i class="icon-mail"></i>--}}
{{--                                            <span>Mail</span>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                </div>
                                {!! html_entity_decode($property->description) !!}
                            </div>

                            <div class="post-navigation">
                                {!! html_entity_decode($property->features) !!}
                            </div>

                        </div>
                    </div>
                    <!-- end: Post single item-->
                </div>
            </div>
            <!-- end: content -->
            <!-- Sidebar-->
            <div class="sidebar sticky-sidebar col-lg-3">
                <h3>Videos</h3>
            @if(!empty($property->video1))
                    <div class="">


                        <div class="ratio ratio-16x9">
                            <iframe  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" src="{{$property->video1}}" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

            @if(!empty($property->video2))
                    <div class="">


                        <div class="ratio ratio-16x9">
                            <iframe  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" src="{{$property->video2}}" allowfullscreen></iframe>
                        </div>
                    </div>
            @endif

            @if(!empty($property->video3))
                    <div class="">


                        <div class="ratio ratio-16x9">
                            <iframe  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" src="{{$property->video3}}" allowfullscreen></iframe>
                        </div>
                    </div>
            @endif

            <!--Tabs with Posts-->

                <!--End: Tabs with Posts-->


            </div>

            <!-- end: Sidebar-->
        </div>
        <div class="line"></div>
        <!--Gallery Carousel -->
        <h4 class="mb-4">Property Images</h4>
        <div class="row">
            <div class="content col-lg-12">
                <div class="carousel" data-items="3" data-dots="false" data-lightbox="gallery">
                    <!-- portfolio item -->
                    @foreach (json_decode($property->images, true) as $picture)
                    <div class="portfolio-item img-zoom ct-photography ct-media ct-branding ct-Media">
                        <div class="portfolio-item-wrap">
                            <div class="portfolio-image">
                                <a href="#"><img src="{{ asset('storage/properties/' . $picture)}}" alt=""></a>
                            </div>
                            <div class="portfolio-description">
                                <a title="{{$property->name}}" data-lightbox="gallery-image" href="{{ asset('storage/properties/' . $picture)}}" class="btn btn-light btn-roundeded">Zoom</a>
                            </div>
                        </div>
                    </div>
                    <!-- end: portfolio item -->
                    @endforeach
                </div>
                <!--Gallery Carousel -->
            </div>
        </div>
    </div>
</section>
<!-- end: Page Content -->
@include('includes.main.homepage.footer')
@include('includes.main.homepage.scripts')
