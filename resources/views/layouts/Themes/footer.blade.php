        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2020 a3laf by <a href="http://almusand.com/" target="_blank">almusand.com</a>
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->

    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{ url('design/adminlte/assets/') }}/node_modules/popper/popper.min.js"></script>
    <script src="{{ url('design/adminlte/assets/') }}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ url('design/adminlte/assets/') }}/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="{{ url('design/adminlte/assets/') }}/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ url('design/adminlte/assets/') }}/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ url('design/adminlte/assets/') }}/dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{ url('design/adminlte/assets/') }}/node_modules/raphael/raphael-min.js"></script>
   {{-- <script src="{{ url('design/adminlte/assets/') }}/node_modules/morrisjs/morris.min.js"></script>--}}
    <script src="{{ url('design/adminlte/assets/') }}/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart JS -->
    <script src="{{ url('design/adminlte/assets/') }}/dist/js/dashboard1.js"></script>

    <link  href="{{ url('design/adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <script src="{{ url('design/adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('design/adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ url('design/adminlte') }}/bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <script src="{{ url('design/adminlte/assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script src="{{ url('/design/adminlte/jstree/jstree.js') }}"></script>
    <script src="{{ url('/design/adminlte/jstree/jstree.wholerow.js') }}"></script>
    <script src="{{ url('/design/adminlte/jstree/jstree.checkbox.js') }}"></script>
    <script src="{{ url('/js/daterangepicker.min.js') }}"></script>
    <script src="{{ url('/js/select2.min.js') }}"></script>
     <!-- Calendar JavaScript -->
    <script src="{{ url('design/adminlte') }}/assets/node_modules/calendar/jquery-ui.min.js"></script>

    <script src='{{ url('design/adminlte') }}/assets/node_modules/calendar/dist/fullcalendar.js'></script>
    <script src="{{ url('design/adminlte') }}/assets/node_modules/wizard/jquery.steps.min.js"></script>
    <script src="{{ url('design/adminlte') }}/assets/node_modules/wizard/jquery.validate.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="{{ url('design/adminlte') }}/assets/node_modules/sweetalert/sweetalert.min.js"></script>
    <script src="{{ url('design/adminlte') }}/assets/node_modules/wizard/steps.js"></script>
    <script src="{{ url('design/adminlte') }}/assets/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
    
    <script src="{{ url('/js/main.js') }}"></script>

    @yield('scripts')
    @stack('js')
    @stack('scripts')

</body>
</html>