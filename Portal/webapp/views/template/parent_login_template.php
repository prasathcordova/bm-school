<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo APP_TITLE; ?></title>
        <link rel="icon" href="<?= base_url('assets/theme/img/favicon.ico') ?>" type="image/ico">
        <link href="<?php echo base_url('assets/theme/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/theme/css/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">

        <link href="<?php echo base_url('assets/theme/css/animate.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet">

        <script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/theme/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert-dev.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/theme/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
       <script src="<?php echo base_url('assets/theme/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>

        <script type="text/javascript">var baseurl = "<?php echo base_url(); ?>";</script>
        <script src="<?php echo base_url('assets/theme/js/plugins/toastr/toastr.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>

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
    </head>

    <body class="gray-bg">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div id="data-view">
                <?php
                echo $this->load->view($template);
                ?>
            </div>
        </div>



    </body>

</html>
