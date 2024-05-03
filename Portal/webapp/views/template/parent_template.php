<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo APP_TITLE; ?></title>
    <link rel="icon" href="<?= base_url('assets/theme/img/favicon.ico') ?>" type="image/ico">
    <link href="<?php echo base_url('assets/theme/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">
    <!--<link href="<?php // echo base_url('assets/css/plugins/select2/select2.min.css'); 
                    ?>" rel="stylesheet">-->
    <link href="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/toastr/toastr.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/pace/pace.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert-dev.js'); ?>"></script>
    <script type="text/javascript">
        var baseurl = "<?php echo base_url(); ?>";
    </script>
    <script type="text/javascript">
        function activate_toast_login(message, title, type) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "preventDuplicates": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": 200,
                "hideDuration": 200,
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr[type](message, title);

        }

        function activate_toast_login_for_error(message, title, type) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "preventDuplicates": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": 500,
                "hideDuration": 500,
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr[type](message, title);

        }
    </script>



    <!-- iCheck -->
    <link href="<?php echo base_url('assets/theme/css/plugins/iCheck/custom.css" rel="stylesheet'); ?>">
    <script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>

    <style>

    </style>


</head>

<body class="fixed top-navigation">

    <div id="wrapper">
        <!--<div id="page-wrapper" class="gray-bg" style="background-color: white;">-->
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="hidden-xs pull-left">
                        <img src="<?php echo base_url('assets/dashboard_logos/' . $this->session->userdata('inst_id') . '_dashboard.png'); ?>" alt="STORE MANAGEMENT" style="width: 45%;margin-left:20%;padding:5px" />
                    </div>
                    <div class="visible-xs">
                        <div style="width:75%;margin:auto;padding: 7px;">
                            <img class="img-fluid" src="<?php echo base_url('assets/dashboard_logos/' . $this->session->userdata('inst_id') . '_dashboard.png'); ?>" alt="STORE MANAGEMENT" style="width: 100%;" />
                        </div>
                    </div>
                    <?php if ($this->session->userdata('is_parent') == 1) { ?>
                        <div class="navbar-header">
                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <i class="fa fa-reorder"></i>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse" id="navbar">

                            <ul class="nav navbar-top-links navbar-right">
                                <li>
                                    <a href="<?php echo base_url('logout'); ?>" style="color: #000;margin-top: 16px;">
                                        <i class="fa fa-sign-out"></i> Log out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>

                </nav>

            </div>
            <!-- <div class="row border-bottom white-bg">
                <nav class="navbar navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="<?php echo base_url(); ?>" class="navbar-brand" style="background: #23C6C5 !important; "><?php echo APP_TITLE; ?></a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar" style="background: #23C6C5 !important;">

                        <ul class="nav navbar-top-links navbar-right">

                            <li>
                                <a href="<?php echo base_url('logout'); ?>" style="color: #fff;">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div> -->
            <div class="wrapper wrapper-content">
                <div class="container">
                    <div id="data-content">
                        <?php
                        echo $this->load->view($template);
                        ?>
                    </div>

                </div>

            </div>
            <div class="footer fixed">
                <div>
                    <strong> DocMe </strong>&copy; <?php echo date('Y') . " - " . (date('Y') + 1); ?> <?php echo APP_VERSION; ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?>
                </div>
            </div>

        </div>
    </div>





</body>

</html>