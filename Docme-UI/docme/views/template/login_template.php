<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title><?php echo APP_TITLE; ?></title>
    <link rel="icon" href="<?php echo base_url('assets/theme/img/favicon.ico'); ?>" type="image/ico">
    <link href="<?php echo base_url('assets/theme/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/prevent_duplicate.js'); ?>"></script>
    <!-- MENU -->
    <script src="<?php echo base_url('assets/theme/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <script type="text/javascript">
        var baseurl = "<?php echo base_url(); ?>";
    </script>
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
    <noscript>
        <style>
            .login-message {
                background: #23C6C8;
                border-top: solid 5px #fff;
                border-bottom: solid 5px #fff;
                color: #fff;
                padding: 15px;
                box-shadow: 4px 1px 4px #c6c5c5;
                font-size: 16px;
            }
        </style>
        <div class="login-message">Javascript is mandatory for our application to run and it is turned off in your browser. So kindly enable javascript on your browser and try again to login into app.</div>


    </noscript>
    <style>
        p {
            text-align: justify
        }
    </style>
    <div class="loginColumns animated fadeInDown">

        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold" style="margin-top:0px;margin-bottom:20px">Welcome to DocMe</h2>

                <p>
                    Education management is a tough game. Keeping pace with this ever evolving metaphor is a daunting task. We are a market leader.
                    We believe a leader is the one who takes the courage and leaves footprints for others.
                </p>

                <p>
                    We empower one of the largest education group in Arabian Gulf with unmatched technological solutions. Mobility, Cloud and Bus tracking are our stronghold.
                </p>

                <p>
                    We empower the family to keep in touch with the development of students. Parents use our Apps to communicate and do much more.
                </p>



            </div>
            <div class="col-md-6">
                <div class="ibox-content" id="faculty_loader" style="margin-top:30px;padding-top:20px">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <?php echo $this->load->view($template); ?>

                    <p class="m-t">
                        <small><strong> DocMe </strong>&copy; <?php echo date('Y') . " - " . (date('Y') + 1); ?> <?php echo APP_VERSION; ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?> </small>
                    </p>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">



            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
    jQuery(function($) {
        if (window.IsDuplicate()) {
            // alert("This is duplicate window\n\n Closing...");
            // window.opener = self;
            // window.close();
            // Wrap in an IIFE accepting jQuery as a parameter.
            var setCookie,
                removeCookie,
                // Create constants for things instead of having same string
                // in multiple places in code.
                COOKIE_NAME = 'TabOpen',
                SITE_WIDE_PATH = {
                    path: '/'
                };

            setCookie = function() {
                $.cookie(COOKIE_NAME, '1', SITE_WIDE_PATH);
            };

            removeCookie = function() {
                $.removeCookie(COOKIE_NAME, SITE_WIDE_PATH);
            };

            // We don't need to wait for DOM ready to check the cookie
            if (COOKIE_NAME === undefined) {
                setCookie();
                $(window).unload(removeCookie);
            } else {
                // Replace the whole body with an error message when the DOM is ready.
                $(function() {
                    $('body').html(
                        '<div class="error" style="text-align:center;margin-top:15%">' +
                        '<h1>Sorry!</h1>' +
                        '<p>You can only have one instance of this web page open at a time.</p>' +
                        '</div>'
                    );
                });
            }
        }
    });
</script>


</html>