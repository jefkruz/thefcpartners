<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('portal/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('portal/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@yield('modalscripts')
@yield('datascripts')

<!-- AdminLTE App -->
<script src="{{asset('portal/dist/js/adminlte.min.js')}}"></script>
<!-- Filterizr-->
<script src="{{asset('portal/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('portal/plugins/toastr/toastr.min.js')}}"></script>

<!-- bs-custom-file-input -->
<script src="{{asset('portal/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>


<script>

    $(function () {
        bsCustomFileInput.init();
    });
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

@yield('script')

</body>
</html>

