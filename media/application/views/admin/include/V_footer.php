            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.1.0-rc
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        
        <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>

        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="<?=base_url();?>assets/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="<?=base_url();?>assets/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="<?=base_url();?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?=base_url();?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?=base_url();?>assets/plugins/moment/moment.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?=base_url();?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <!-- <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script> -->
        <script src="<?=base_url();?>assets/js/summernote/summernote-0.8.18-dist/summernote-bs4.min.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-image-attributes-master/summernote-image-attributes.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-cleaner-master/summernote-cleaner.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-image-shapes-master/summernote-image-shapes.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-image-title-master/summernote-image-title.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-image-captionit-master/summernote-image-captionit.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-list-styles-master/summernote-list-styles-bs4.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-table-headers-master/summernote-table-headers.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-table-styles-master/summernote-table-styles.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-seo-master/summernote-seo.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-ext-table-master/script/summernote/plugin/table/summernote-ext-table.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-ext-codewrapper-master/dist/summernote-ext-codewrapper.min.js"></script>
        <script src="<?=base_url();?>assets/js/summernote/summernote-ext-highlight-master/src/summernote-ext-highlight.js"></script>
        <!-- <script src="{{ asset('js/summernote/summernote-video-attributes-master/summernote-video-attributes.js') }}"></script> -->
        <!-- overlayScrollbars -->
        <script src="<?=base_url();?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url();?>assets/dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?=base_url();?>assets/dist/js/demo.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?=base_url();?>assets/dist/js/pages/dashboard.js"></script>
        <!-- sweetalert -->
        <script src="<?=base_url();?>assets/js/sweetalert/sweetalert2.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/jszip/jszip.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- Select2 -->
        <script src="<?=base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
        <!-- X-Editable -->
        <script src="<?=base_url();?>assets/js/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
        <!-- Jquery Validation -->
        <script src="<?=base_url();?>assets/js/jquery-validation-1.19.3/dist/jquery.validate.min.js"></script>

        <!-- <script type="text/javascript">
            //Date and time picker
            $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
        </script> -->
    </body>

</html>
