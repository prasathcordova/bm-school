<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="x-ua-compatible" content="IE=edge">
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

    <link href="<?php echo base_url('assets/theme/css/plugins/cropper/cropper.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/switchery/switchery.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/jasny/jasny-bootstrap.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/nouslider/jquery.nouislider.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/datapicker/datepicker3.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/ionRangeSlider/ion.rangeSlider.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/clockpicker/clockpicker.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/select2/select2.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/dataTables/datatables.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/plugins/summernote/summernote.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/plugins/summernote/summernote-bs3.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/plugins/calendar/fullcalendar.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/plugins/sweetalert/swalExtend.css'); ?>" rel="stylesheet">
    <!-- <link href="<?php // echo base_url('assets/theme/plugins/bootstraptoggle/bootstrap-toggle.min.css');                                      
                        ?>" rel="stylesheet"> -->
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
    <script src="<?php echo base_url('assets/theme/js/plugins/clockpicker/clockpicker.js'); ?>"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?php echo base_url('assets/theme/js/plugins/fullcalendar/moment.min.js'); ?>"></script>

    <!-- Date range picker -->
    <script src="<?php echo base_url('assets/theme/js/plugins/daterangepicker/daterangepicker.js'); ?>"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url('assets/theme/js/plugins/select2/select2.full.min.js'); ?>"></script>

    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/theme/js/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>

    <!-- SUMMERNOTE -->
    <script src="<?php echo base_url('assets/theme/js/plugins/summernote/summernote.min.js'); ?>"></script>



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
    <script src="<?php echo base_url('assets/theme/plugins/sweetalert/swalExtend.js'); ?>"></script>
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
    <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.tooltip.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.spline.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.resize.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.pie.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/flot/jquery.flot.symbol.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/flot/curvedLines.js'); ?>"></script>


    <!-- ChartJS-->
    <script src="<?php echo base_url('assets/theme/js/plugins/chartJs/Chart.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/prevent_duplicate.js'); ?>"></script>



</head>
<?php
$img_ind = base_url('assets/img/flags/16/India.png');
$img_arab = base_url('assets/img/flags/16/United-Arab-Emirates.png');
?>
<!--<body class="md-skin fixed-sidebar">-->

<body class="md-skin">
    <noscript>
        <style>
            html {
                display: none;
            }
        </style>
        <style>
            div#body {
                display: none;
            }
        </style>
        <meta http-equiv="refresh" content="0;url=<?php echo base_url('script_error'); ?>">
    </noscript>
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <?php $this->load->view('template/menu_template.php') ?>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " data-toggle="tooltip" title="Maximize / minimize menu" href="#"><i class="fa fa-bars"></i> </a>

                    </div>
                    <div class="m-b-lg pull-right">
                        <img alt="image" style="float: right;" src="<?php echo $img_ind; ?>">

                        <span><img alt="image" style="float: right;" src="<?php echo $img_arab; ?>"></span>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>

                            <a href="javascript:void(0);" onclick="logout_confirm()">

                                <i class="fa fa-sign-out"></i> Log out

                            </a>
                        </li>


                    </ul>

                </nav>
            </div>
            <div id="content">
                <?php
                if (isset($template) && !empty($template)) {
                    $this->load->view($template);
                }
                ?>
            </div>
            <div class="footer fixed">
                <div>
                    <small><strong> DocMe </strong>&copy; <?php echo date('Y') . " - " . (date('Y') + 1); ?> <?php echo APP_VERSION; ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?> </small>
                </div>
            </div>

        </div>
    </div>

    <style>
        .contact-box.center-version>a {
            padding: 12px;
        }
    </style>
</body>

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
</script>
<script src="<?php echo base_url('assets/js/logout.js'); ?>"></script>



</html>