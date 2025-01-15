<?php
  require_once('sess_auth.php');
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
    <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
    
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"> -->
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">
    
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/custom.css">
    
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">
    
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <style type="text/css">
        /* Milk tea-inspired color scheme */
        body {
            background-color: #fff5e1; /* Milky White background */
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: rgba(168, 100, 18, 0.9); /* Soft milk tea color */
            color: #fff;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #6b4f3a; /* Dark Milk Tea color */
        }

        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #f4c542; /* Warm Yellow on hover */
        }

        .card {
            background-color: rgba(168, 100, 18, 0.38); /* Soft milk tea color */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: rgba(168, 100, 18, 0.6); /* Milk tea color for headers */
            color: #fff;
        }

        .btn-primary {
            background-color: #f4c542; /* Warm Yellow for buttons */
            border-color: #f4c542;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #f4a03d; /* Slightly darker yellow on hover */
        }

        .alert-danger {
            background-color: rgb(229, 22, 39); /* Red background for errors */
            color: #721c24;
            border-radius: 5px;
            padding: 15px;
            font-size: 14px;
        }

        .alert-success {
            background-color: rgb(39, 226, 83); /* Green background for success */
            color: #155724;
            border-radius: 5px;
            padding: 15px;
            font-size: 14px;
        }

        .toast {
            background-color: #f4c542; /* Milk tea toast background */
            color: white;
            font-size: 14px;
            border-radius: 8px;
            padding: 10px 20px;
            text-align: center;
        }
    </style>

    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>

    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>

</head>
s