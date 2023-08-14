<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        
        <title>Admin</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <!-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}"> -->
        <link rel="stylesheet" href="<?=base_url();?>assets/js/summernote/summernote-0.8.18-dist/summernote-bs4.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/js/summernote/summernote-list-styles-master/summernote-list-styles-bs4.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/js/summernote/summernote-ext-table-master/script/summernote/plugin/table/summernote-ext-table.css">
        <!-- sweetalert -->
        <link rel="stylesheet" href="<?=base_url();?>assets/css/sweetalert/sweetalert2.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- X-editable -->
        <link rel="stylesheet" href="<?=base_url();?>assets/js/bootstrap3-editable/css/bootstrap-editable.css">
    
        <style>
            .overlay {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                height: 100%;
                width: 100%;
                opacity: 0;
                transition: 0.3s ease;
                background-color: black;
            }

            .article-list-content-card:hover .overlay {
                opacity: 0.7;
            }

            .icon {
                color: black;
                font-size: 100px;
                position: absolute;
                top: 50%;
                left: 25%;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                text-align: center;
            }

            .icon-2 {
                color: black;
                font-size: 100px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                text-align: center;
            }

            .icon-3 {
                color: black;
                font-size: 100px;
                position: absolute;
                top: 50%;
                left: 75%;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                text-align: center;
            }
        </style>

        <!-- Javascript -->
        <!-- jQuery -->
        <script src="<?=base_url();?>assets/plugins/jquery/jquery.min.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
        <!-- <script src="<?=base_url();?>assets/plugins/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script> -->
        <!-- jQuery UI 1.11.4 -->
        <script src="<?=base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- End Javascript -->

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">