<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo APP_TITLE; ?></title>
    <link rel="icon" href="<?= base_url('assets/theme/img/favicon.ico') ?>" type="image/ico">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/theme/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/iCheck/custom.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/chosen/bootstrap-chosen.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>" rel="stylesheet">

    <!-- <link href="<?php echo base_url('assets/theme/css/plugins/cropper/cropper.min.css'); ?>" rel="stylesheet"> -->

    <link href="<?php echo base_url('assets/theme/css/plugins/switchery/switchery.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/jasny/jasny-bootstrap.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/nouslider/jquery.nouislider.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/datapicker/datepicker3.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/ionRangeSlider/ion.rangeSlider.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css'); ?>" rel="stylesheet">

    <!-- <link href="<?php echo base_url('assets/theme/css/plugins/clockpicker/clockpicker.css'); ?>" rel="stylesheet"> -->

    <link href="<?php echo base_url('assets/theme/css/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/select2/select2.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/dataTables/datatables.min.css'); ?>" rel="stylesheet">

    <!-- <link href="<?php echo base_url('assets/theme/css/plugins/summernote/summernote.css'); ?>" rel="stylesheet"> -->
    <!-- <link href="<?php echo base_url('assets/theme/css/plugins/summernote/summernote-bs3.css'); ?>" rel="stylesheet"> -->
    <link href="<?php echo base_url('assets/theme/plugins/calendar/fullcalendar.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
    <link href="<?php // echo base_url('assets/theme/plugins/bootstraptoggle/bootstrap-toggle.min.css');                                    
                ?>" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?php echo base_url('assets/theme/css/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/plugins/dragula/dragula.css'); ?>" rel="stylesheet">


    <link href="<?php echo base_url('assets/theme/plugins/select2/select2.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/plugins/select2/select2-bootstrap.css'); ?>" rel="stylesheet">


    <link href="<?php echo base_url('assets/theme/css/plugins/slick/slick.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/plugins/slick/slick-theme.css') ?>" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/bootstrap.min.js'); ?>"></script>

    <!-- Custom and plugin javascript -->

    <script src="<?php echo base_url('assets/theme/js/plugins/pace/pace.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/slimscroll/jquery.slimscroll.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>
    <!-- Input Mask-->
    <script src="<?php echo base_url('assets/theme/js/plugins/jasny/jasny-bootstrap.min.js'); ?>"></script>

    <!-- Data picker -->
    <script src="<?php echo base_url('assets/theme/js/plugins/datapicker/bootstrap-datepicker.js'); ?>"></script>

    <!-- NouSlider -->
    <script src="<?php echo base_url('assets/theme/js/plugins/nouslider/jquery.nouislider.min.js'); ?>"></script>

    <!-- Switchery -->
    <script src="<?php echo base_url('assets/theme/js/plugins/switchery/switchery.js'); ?>"></script>

    <!-- IonRangeSlider -->
    <script src="<?php echo base_url('assets/theme/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); ?>"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>

    <!-- MENU -->
    <script src="<?php echo base_url('assets/theme/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>

    <!-- Clock picker -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/clockpicker/clockpicker.js'); ?>"></script> -->

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?php echo base_url('assets/theme/js/plugins/fullcalendar/moment.min.js'); ?>"></script>

    <!-- Date range picker -->
    <script src="<?php echo base_url('assets/theme/js/plugins/daterangepicker/daterangepicker.js'); ?>"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url('assets/theme/js/plugins/select2/select2.full.min.js'); ?>"></script>

    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/theme/js/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>

    <!-- SUMMERNOTE -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/summernote/summernote.min.js'); ?>"></script> -->



    <!-- Tags Input -->
    <script src="<?php echo base_url('assets/theme/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js'); ?>"></script>
    <script type="text/javascript">
        var baseurl = "<?php echo base_url(); ?>";
    </script>
    <script src="<?php echo base_url('assets/theme/js/plugins/dataTables/datatables.min.js'); ?>"></script>
    <!-- FooTable -->
    <script src="<?php echo base_url('assets/theme/js/plugins/footable/footable.all.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/theme/js/plugins/toastr/toastr.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/dragula/dragula.js'); ?>"></script>

    <!-- iCheck -->

    <!--<script src="<?php // echo base_url('assets/theme/js/js/plugins/iCheck/icheck.min.js');                          
                        ?>"></script>-->
    <!-- Chosen -->
    <script src="<?php echo base_url('assets/theme/js/plugins/chosen/chosen.jquery.js'); ?>"></script>



    <!-- Data picker -->
    <link href="<?php echo base_url('assets/theme/css/plugins/datapicker/datepicker3.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/theme/js/plugins/datapicker/bootstrap-datepicker.js'); ?>"></script>

    <!-- Date range picker -->
    <link href="<?php echo base_url('assets/theme/css/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/theme/js/plugins/daterangepicker/daterangepicker.js'); ?>"></script>



    <script src="<?php echo base_url('assets/theme/plugins/select2/select2.full.js'); ?>"></script>

    <script src="<?php echo base_url('assets/theme/js/plugins/slick/slick.min.js'); ?>"></script>
    <!--FROM COMET-->
    <!-- Datatables responsive-->
    <link href="<?php echo base_url('assets/theme/plugins/datatables/responsive.dataTables.min.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/theme/plugins/datatables/dataTables.responsive.min.js'); ?>"></script>

    <!-- FooTable -->

    <!--<link href="<?php // echo base_url('assets/theme/plugins/footable/footable.core.css');                          
                    ?>" rel="stylesheet">-->






    <!-- Drop zone -->
    <link href="<?php echo base_url('assets/theme/css/plugins/dropzone/dropzone.css') ?>" rel="stylesheet">
    <!-- Drop zone-->
    <script src="<?php echo base_url('assets/theme/js/plugins/codemirror/codemirror.js'); ?>"></script>
    <!-- CodeMirror -->
    <link href="<?php echo base_url('assets/theme/css/plugins/codemirror/codemirror.css') ?>" rel="stylesheet">
    <!-- CodeMirror-->
    <script src="<?php echo base_url('assets/theme/js/plugins/dropzone/dropzone.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/codemirror/mode/xml/xml.js'); ?>"></script>




    <!-- Flot -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.js'); ?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.tooltip.min.js'); ?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.spline.js'); ?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.resize.js'); ?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.pie.js'); ?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.symbol.js'); ?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/flot/curvedLines.js'); ?>"></script> -->


    <!-- ChartJS-->
    <!-- <script src="<?php echo base_url('assets/theme/js/plugins/chartJs/Chart.min.js'); ?>"></script> -->



</head>
<?php
$img_ind = base_url('assets/img/flags/16/India.png');
$img_arab = base_url('assets/img/flags/16/United-Arab-Emirates.png');
$inst_id = $this->session->userdata('inst_id');

?>

<body class="top-navigation md-skin">

    <div id="wrapper">

        <div id="page-wrapper" class="gray-bg">

            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-collapse collapse" id="navbar">
                        <img src="<?php echo base_url('assets/dashboard_logos/' . $inst_id . '_dashboard.png'); ?>" alt="STORE MANAGEMENT" style="width: 20%;margin-left:5%;padding:5px" />
                    </div>
                    <div class="visible-xs">
                        <div style="width:75%;margin:auto;padding: 7px;">
                            <img class="img-fluid" src="<?php echo base_url('assets/dashboard_logos/' . $inst_id . '_dashboard.png'); ?>" alt="STORE MANAGEMENT" style="width: 100%;" />
                        </div>
                    </div>
                </nav>

            </div>
            <div class="wrapper wrapper-content" style="margin-top:50px;">
                <div id="myNav" class="overlay">
                    <div class="sk-spinner sk-spinner-wave" style="margin-top:25%">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                </div>
                <div class="container">
                    <!--div class="row">
                        <h2>
                            <span> ONLINE REGISTRATION </span>
                        </h2>
                    </div-->
                    <div class="row">
                        <?php
                        if (isset($template) && !empty($template)) {
                            $this->load->view($template);
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="footer fixed">
                <div>
                    <small><strong> DocMe </strong>&copy; <?php echo date('Y') . " - " . (date('Y') + 1); ?> <?php echo APP_VERSION; ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?> </small>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        function show_student_count_function() {
            var stat1 = $('#show_student_count').prop('checked');
            if (stat1) {
                $('#show_student_data').show();
            } else {
                $('#show_student_data').hide();
            }
        }

        function show_long_absentee_count_function() {
            var stat2 = $('#show_long_absentee_count').prop('checked');
            if (stat2) {
                $('#long_absent_data').show();
            } else {
                $('#long_absent_data').hide();
            }
        }

        function show_registration_count_function() {
            var stat3 = $('#show_registration_count').prop('checked');
            if (stat3) {
                $('#registration_data').show();
            } else {
                $('#registration_data').hide();
            }
        }

        function show_tc_count_function() {
            var stat4 = $('#show_tc_count').prop('checked');
            if (stat4) {
                $('#tc_data').show();
            } else {
                $('#tc_data').hide();
            }
        }

        function show_fee_count_function() {
            var stat5 = $('#show_fee_count').prop('checked');
            if (stat5) {
                $('#fee_data').show();
            } else {
                $('#fee_data').hide();
            }
        }

        function show_user_count_function() {
            var stat6 = $('#show_user_count').prop('checked');
            if (stat6) {
                $('#user_data').show();
            } else {
                $('#user_data').hide();
            }
        }

        $(document).on("keypress", ".numeric", function(e) {
            $(this).val(
                $(this)
                .val()
                .replace(/[^0-9\.]/g, "")
            );
            if (
                (event.which != 46 ||
                    $(this)
                    .val()
                    .indexOf(".") != -1) &&
                (event.which < 48 || event.which > 57)
            ) {
                event.preventDefault();
            }
        });

        $(document).on("keypress", ".digits", function(e) {
            var dec_numbers = /[0-9]+?$/;
            if (!dec_numbers.test(e.key)) {
                return false;
            } else {
                return true;
            }
        });
        $(document).on("keypress", ".alphanumeric", function(e) {
            var alphanumeric = /[\w]|\-|\s+?$/;
            if (!alphanumeric.test(e.key)) {
                return false;
            } else {
                return true;
            }
        });
        $(document).on("keypress", ".alpha", function(e) {
            var alpha = /[a-zA-Z]|\-|\s+?$/;
            if (!alpha.test(e.key)) {
                return false;
            } else {
                return true;
            }
        });



        $(document).on("click", function(event) {
            var $trigger = $(".right-sidebar-toggle");
            if ($trigger !== event.target && !$trigger.has(event.target).length) {
                //  //          $("#right-sidebar").slideUp("fast");
                //                $('#right-sidebar').removeClass('sidebar-open');
            }
        });
        var baseurl = '<?php echo base_url() ?>';
    </script>
    <!-- <script src="<?php echo base_url('assets/js/logout.js'); ?>"></script> -->

    <style>
        .sidebar-container ul.nav-tabs {
            background: #f9f9f9;
        }

        .overlay {
            /* Height & width depends on how you want to reveal the overlay (see JS below) */
            height: 100%;
            width: 0;
            position: fixed;
            /* Stay in place */
            z-index: 99999;
            /* Sit on top */
            left: 0;
            top: 0;
            background-color: rgb(0, 0, 0);
            /* Black fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/opacity */
            overflow-x: hidden;
            /* Disable horizontal scroll */
            transition: 0.5s;
            /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
        }

        .wizard>.actions {
            text-align: center;
        }
    </style>
    <?php
    switch ($this->session->userdata('inst_id')) {
        case 5:
            $school_name = 'The Oxford School , Trivandrum';
            break;
        case 8:
            $school_name = 'The Oxford School , Kollam';
            break;
        case 20:
            $school_name = 'The Oxford School , Calicut';
            break;
        default:
            $school_name = 'The Oxford School';
            break;
    }

    ?>
    <!-- Matomo -->
    <script type="text/javascript">
        var _paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u = "//analytics.educore.guru/";
            _paq.push(['setTrackerUrl', u + 'matomo.php']);
            _paq.push(['setSiteId', <?php echo MATOMO_SITE_ID ?>]);
            var d = document,
                g = d.createElement('script'),
                s = d.getElementsByTagName('script')[0];
            g.type = 'text/javascript';
            g.async = true;
            g.defer = true;
            g.src = u + 'matomo.js';
            s.parentNode.insertBefore(g, s);
        })();
        _paq.push(['setCustomVariable', 1, "School ID", '<?php echo $school_name  ?>', "visit"]);
        // _paq.push(['setCustomVariable', 2, "Role IDs", result.role_ids, "visit"]);
        // _paq.push(['setCustomVariable', 3, "Login Username ", result.quick_login_id, "visit"]);
        // _paq.push(['setCustomVariable', 4, "Admn No/Emp No ", empOrAdmnNo, "visit"]);
        // _paq.push(['setCustomVariable', 5, "User Details", userBatchDetails, "visit"]);
        _paq.push(['setUserId', 'Online Registration']);
        _paq.push(['trackPageView']);
    </script>
    <!-- End Matomo Code -->

</html>