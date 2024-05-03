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
    <link href="<?php echo base_url('assets/theme/css/plugins/slick/slick.css" rel="stylesheet'); ?>">
    <link href="<?php echo base_url('assets/theme/css/plugins/slick/slick-theme.css" rel="stylesheet'); ?>">
    <link href="<?php echo base_url('assets/theme/css/animate.css" rel="stylesheet'); ?>">
    <script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>
    <!-- slick carousel-->
    <script src="<?php echo base_url('assets/theme/js/plugins/slick/slick.min.js'); ?>"></script>
    <style>

    </style>


</head>

<body class="fixed top-navigation">

    <div id="wrapper">
        <!--<div id="page-wrapper" class="gray-bg" style="background-color: white;">-->
        <div id="page-wrapper" class="white-bg" style="padding-right: 350px; padding-left:0px">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <MARQUEE WIDTH=900 HEIGHT=50>
                            <a href="<?php echo base_url(); ?>" class="navbar-brand" style="background: #006fba !important; "><?php echo APP_TITLE; ?></a>
                        </MARQUEE>

                    </div>
                    <div class="navbar-collapse collapse" id="navbar" style="background: #006fba !important;">


                    </div>
                </nav>
            </div>
            <div class="wrapper wrapper-content" style="width: 1194px;">
                <div class="container">
                    <div id="data-content">
                        <?php
                        echo $this->load->view($template);
                        ?>
                    </div>

                </div>
                <div class="wrapper wrapper-content" style="width:8145px;margin-left: -56px;height: 350px;background-color: #006fba !important;">
                    <!--<section id="features" class="container services" Style="padding-top:80px;">-->
                    <div class="row">
                        <div class="col-sm-3" style="color:white;">
                            <!--                                <h1>Contact</h1>
                                                                <section id="features" class="container services pull-left" >
                                                                    <div class="row" >
                                                                        <div class="col-sm-3">
                                                                            <h2>Activities</h2>
                                                                            
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <h2>Curriculum</h2>
                                                                           
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <h2>Transportation</h2>
                                                                            
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <h2>Principal's Desk</h2>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <br>
                                                                <br>
                                                                <hr>-->
                            <section id="features" class="container services pull-left">
                                <div class="row">

                                    <div class="col-sm-3">
                                        <h2>Our Motto</h2>
                                        <p>It is unequivocal that the role of a school today, is not only to pursue academic excellence but also to motivate and empower its students to be lifelong learners, critical thinkers, effective analyzers and productive members of an ever changing global society.</p>
                                        <!--<p><a class="navy-link" href="http://www.acetvm.com/admission/" target="_blank" role="button">Details »</a></p>-->
                                    </div>
                                    <div class="col-sm-3">
                                        <h2>Transportation</h2>
                                        <p>School have a fleet of 66 buses to cater to the transportation of students and staff. The specifications and regulations laid by the RTA of Dubai are strictly followed and exceptional safety standards are ensured by the school management, all bus drivers are well trained and certified by RTA.</p>
                                        <!--<p><a class="navy-link" href="http://www.acetvm.com/facilities/transportation/" target="_blank" role="button">Details »</a></p>-->
                                    </div>
                                    <div class="col-sm-3">
                                        <h2>Principal's Desk</h2>
                                        <p>The Teachers of our school are motivated to provide an environment in the school for enquiry and discovery, where students are encouraged to be creative and curious. While we give priority for academic excellence, the school also prepares the students for life.</p>
                                        <!--<p><a class="navy-link" href="http://www.acetvm.com/iedc/" target="_blank" role="button">Details »</a></p>-->
                                    </div>
                                    <div class="col-sm-3">
                                        <h1>Contact Us</h1>
                                        <address>
                                            <strong><span class="info">New Indian Model School</span>,</strong><br>
                                            Dubai,UAE <br>
                                            P.B No: 3100<br>
                                            <abbr title="Phone">P:</abbr> 00971 4 2824313
                                            <abbr title="FAX">F:</abbr> 00971 4 2825454
                                        </address>
                                        <div class="container">


                                            <div class="row">
                                                <div class="col-lg-12 ">
                                                    <!--<a href="mailto:info@acetvm.com" class="btn btn-info" style="background-color:#006fba!important;border-color:#006fba">Send us mail</a>-->
                                                    <p class="m-t-sm">
                                                        Or follow us on social platform
                                                    </p>
                                                    <ul class="list-inline social-icon">
                                                        <li><a href="https://twitter.com/nimsdubai"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li><a href="https://www.facebook.com/NIModel.Dubai/"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li><a href="https://in.linkedin.com/company/nimsgroupdubai"><i class="fa fa-linkedin"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<p><a class="navy-link" href="http://www.acetvm.com/" target="_blank" role="button">Details »</a></p>-->
                                    </div>
                                </div>
                            </section>

                        </div>

                        <!--</section>-->
                        <div class="container">
                            <div id="data-content">
                                <?php
                                //                            echo $this->load->view($template);
                                ?>
                            </div>

                        </div>


                    </div>

                </div>


                <div class="footer fixed">

                    <div class="container">



                        <div>
                            <strong> DocMe </strong>&copy; <?php echo date('Y') . " - " . (date('Y') + 1); ?> <?php echo APP_VERSION; ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>





</body>

</html>
<style>
    .slick_demo_2 .ibox-content {
        margin: 0 10px;
    }
</style>
<script>
    $(document).ready(function() {


        $('.slick_demo_1').slick({
            dots: true
        });

        $('.slick_demo_2').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.slick_demo_3').slick({
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            adaptiveHeight: true
        });
    });
</script>