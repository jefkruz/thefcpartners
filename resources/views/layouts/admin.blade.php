@include('includes.admin.header')

@include('includes.admin.navbar')

@include('includes.admin.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('includes.admin.breadcrumbs')
@yield('content')
</div>
<!-- /.content-wrapper -->


@include('includes.admin.footer')

@include('includes.admin.scripts')
