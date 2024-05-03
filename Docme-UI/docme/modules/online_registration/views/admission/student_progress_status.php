    <link href="<?php echo base_url('assets/theme/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/plugins/iCheck/custom.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/peity/jquery.peity.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/pace/pace.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/demo/peity-demo.js'); ?>"></script>

    <div id="wrapper">

        <div id="page-wrapper" class="gray-bg">

            <div class="wrapper wrapper-content">
                <div class="row animated fadeInRight">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title" style="text-align :left">
                                <h2> Temporary Registration Timeline </h2>
                            </div>
                            <div class="ibox-content" id="ibox-content">
                                <?php
                                if (isset($user_data) && !empty($user_data)) { ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <dl class="row mb-0">
                                                <div class="col-sm-4 text-sm-left">
                                                    <dt>Student Name</dt>
                                                </div>
                                                <div class="col-sm-8 text-sm-left">
                                                    <dd class="mb-1">:&nbsp;<span class="label label-primary"><?php echo $user_data['fname'] . " " . $user_data['lname']; ?></span></dd>
                                                </div>
                                            </dl>
                                            <dl class="row mb-0">
                                                <div class="col-sm-4 text-sm-left">
                                                    <dt>Class</dt>
                                                </div>
                                                <div class="col-sm-8 text-sm-left">
                                                    <dd class="mb-1">:&nbsp;<?php echo $user_data['class']; ?></dd>
                                                </div>
                                            </dl>
                                            <dl class="row mb-0">
                                                <div class="col-sm-4 text-sm-left">
                                                    <dt>DOB</dt>
                                                </div>
                                                <div class="col-sm-8 text-sm-left">
                                                    <dd class="mb-1"> :&nbsp;<?php echo $user_data['dob']; ?></dd>
                                                </div>
                                            </dl>
                                            <dl class="row mb-0">
                                                <div class="col-sm-4 text-sm-left">
                                                    <dt>Parent Name</dt>
                                                </div>
                                                <div class="col-sm-8 text-sm-left">
                                                    <dd class="mb-1">:&nbsp;<?php echo $user_data['parentName']; ?></dd>
                                                </div>
                                            </dl>
                                        </div>
                                        <div class="col-lg-6" id="cluster_info">
                                            <dl class="row mb-0">
                                                <div class="col-sm-4 text-sm-left">
                                                    <dt>Mail ID</dt>
                                                </div>
                                                <div class="col-sm-8 text-sm-left">
                                                    <dd class="mb-1"> :&nbsp;<?php echo $user_data['L_mail']; ?></dd>
                                                </div>
                                            </dl>
                                            <dl class="row mb-0">
                                                <div class="col-sm-4 text-sm-left">
                                                    <dt>Registered On</dt>
                                                </div>
                                                <div class="col-sm-8 text-sm-left">
                                                    <dd class="mb-1"> :&nbsp;<?php echo date('d-M-Y', strtotime($user_data['createdon'])); ?></dd>
                                                </div>
                                            </dl>
                                            <dl class="row mb-0">
                                                <div class="col-sm-4 text-sm-left">
                                                    <dt>Address</dt>
                                                </div>
                                                <div class="col-sm-8 text-sm-left">
                                                    <dd class="mb-1">
                                                        :&nbsp;<?php echo $user_data['O_Address1'];
                                                                echo "</br>"; ?>
                                                    </dd>
                                                    <dd class="mb-1">
                                                        &nbsp;&nbsp;<?php echo $user_data['O_Address2'];
                                                                    echo "</br>"; ?>
                                                    </dd>
                                                    <dd class="mb-1">
                                                        &nbsp;&nbsp;<?php echo  $user_data['O_Address3']; ?>
                                                    </dd>
                                                </div>
                                            </dl>

                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                                <hr>
                                <div class="row">
                                    <div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">


                                        <?php if (isset($user_timeline_data) && !empty($user_timeline_data)) {
                                            $inc = 0;
                                            foreach ($user_timeline_data as $timeline) {

                                                if ($inc == 0) { ?>
                                                    <div class="vertical-timeline-block">
                                                        <div class="vertical-timeline-icon navy-bg">
                                                            <i class="fa fa-briefcase"></i>
                                                        </div>

                                                        <div class="vertical-timeline-content">
                                                            <h2>Temporary Registration</h2>
                                                            <p> Class :<?php echo " " . $user_data['class']; ?> <br />Registered on <?php echo date('d-M-Y', strtotime($user_data['createdon'])); ?></p>
                                                            <!--  <a href="#" class="btn btn-sm btn-primary"> More info</a> -->
                                                            <span class="vertical-date">
                                                                <small><?php echo date("d-M-Y", strtotime($user_data['createdon'])); ?></small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-block">
                                                        <div class="vertical-timeline-icon navy-bg">
                                                            <i class="fa fa-money"></i>
                                                        </div>

                                                        <div class="vertical-timeline-content">
                                                            <h2>Payment Status </h2>
                                                            <?php if ($user_data['payment_status'] == 1) {
                                                            ?>
                                                                <p> Payment Status : Paid <br />
                                                                    Paid Amount : <?php echo " " . $user_data['payment_amount']; ?> <br />
                                                                    Paid on : <?php echo date('d-M-Y', strtotime($user_data['payment_datetime'])); ?></p>

                                                            <?php } else { ?>
                                                                <p> Payment Status : Not paid </p>

                                                            <?php } ?>
                                                            <span class="vertical-date">
                                                                <small><?php if (isset($user_data['payment_datetime'])) {
                                                                            echo date("d-M-Y", strtotime($user_data['payment_datetime']));
                                                                        } ?></small>
                                                            </span>

                                                        </div>
                                                    </div>
                                                <?php $inc++;
                                                }  ?>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon navy-bg">
                                                        <i class="<?php echo $timeline['icon']; ?>"></i>
                                                    </div>

                                                    <div class="vertical-timeline-content">
                                                        <h2><?php echo $timeline['timeline_name']; ?></h2>
                                                        <p><?php echo $timeline['description']; ?>
                                                        </p>
                                                        <!--  <a href="#" class="btn btn-sm btn-primary"> More info</a> -->
                                                        <span class="vertical-date">
                                                            <small><?php echo date("d-M-Y", strtotime($timeline['created_on'])); ?></small>
                                                        </span>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <script>
        $(document).ready(function() {

            // Local script for demo purpose only
            $('#lightVersion').click(function(event) {
                event.preventDefault()
                $('#ibox-content').removeClass('ibox-content');
                $('#vertical-timeline').removeClass('dark-timeline');
                $('#vertical-timeline').addClass('light-timeline');
            });

            $('#darkVersion').click(function(event) {
                event.preventDefault()
                $('#ibox-content').addClass('ibox-content');
                $('#vertical-timeline').removeClass('light-timeline');
                $('#vertical-timeline').addClass('dark-timeline');
            });

            $('#leftVersion').click(function(event) {
                event.preventDefault()
                $('#vertical-timeline').toggleClass('center-orientation');
            });


        });
    </script>