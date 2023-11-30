@section('datastyles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('portal/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('portal/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('portal/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('portal/plugins/summernote/summernote-bs4.min.css')}}">
@endsection

@section('datascripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('portal/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('portal/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('portal/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('portal/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('portal/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('portal/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('portal/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('portal/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('portal/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('portal/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('portal/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('portal/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(function () {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
@endsection

