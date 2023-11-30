@include('includes.main.homepage.header')
@include('includes.main.homepage.navbar')

<body>

<!-- Body Inner -->
<div class="body-inner">


<!-- Page Content -->
    <!-- Content -->
    <section id="page-content">
        <div class="container">
            <!-- post content -->
            <!-- Page title -->
            <div class="page-title">
                <h1>{{$page_title}}</h1>

            </div>
            <!-- end: Page title -->
            <!-- Blog -->
            <div id="blog" class="grid-layout post-2-columns m-b-30" data-item="post-item">
                <!-- Post item-->
                @foreach($blogs as $post)
                <div class="post-item border">
                    <div class="post-item-wrap">
                        <div class="post-image">
                            <a href="{{route('viewpost',[$post->slug])}}"> <img alt="" src="{{asset('storage/posts/'.$post->image??'storage/posts/post.png')}}"> </a> </div>
                        <div class="post-item-description">
                            <span class="post-meta-date"><i class="fa fa-calendar-o"></i>{{date('jS F, Y ', strtotime($post->created_at)) }}</span>
                            <h2><a href="{{route('viewpost',[$post->slug])}}">{{ucwords($post->title)}}</a></h2>
                            {!! html_entity_decode(Str::limit($post->body, 150)) !!}
                            <a href="{{route('viewpost',[$post->slug])}}" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
                <!-- end: Post item-->


            </div>
            <!-- end: Blog -->

        </div>
        <!-- end: post content -->
    </section>
    <!-- end: Content -->
<!-- end: Page Content -->
@include('includes.main.homepage.footer')
@include('includes.main.homepage.scripts')
