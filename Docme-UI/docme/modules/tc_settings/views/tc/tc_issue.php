<link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet"> 
<link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
<link href="<?php //echo base_url('assets/plugins/steps/jquery.steps.min.js');                                                      ?>" rel="stylesheet">
<!--<div class="row wrapper border-bottom white-bg page-heading" style="padding-top: 6px !important;">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            // dev_export($subject_data);die;
            ?>
        </ol>        
    </div>    
</div>-->
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">

            <div class="wrapper wrapper-content  animated fadeInRight">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h2>TC Preparation</h2> <hr>
                            </div>

                            <div class="ibox-content" style="padding-top: 0px">
                                <!--<h2>TC Preparation</h2> <hr>-->
                                <div class="row ">
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="b-r" style="background: #fff;text-align: center;border: #F7A54A;border-radius: 10px; ">
                                            <div class="form-group ">
                                                  <?php
                    $profile_image = "";
                    if (isset($tcdetails[0]['profile_image']) && !empty($tcdetails[0]['profile_image'])) {

                        $profile_image = "data:image/png;base64," . $tcdetails[0]['profile_image'];
                    } else {
                        $profile_image = base_url('assets/img/a0.jpg');
                    }
                    ?>


                                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="width: 128px;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-md-12" style="padding-top: 23px;">
                                        <div class="form-group">
                                            <label class="control-label" for="order_id">Student Name :</label>
                                            <input type="text" id="order_id" name="order_id" class="form-control" value="<?php echo $tcdetails[0]['name'] ?>"disabled="" style="background-color: white">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-md-12" style="margin-bottom:25px;">
                                        <div class="form-group">
                                            <label class="control-label" for="order_id">Batch Name :</label>
                                            <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['batch_name']; ?>" class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: -5px !important">
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="customer">Leaving Year :</label>
                                            <input type="text" id="customer" name="customer" value="<?php echo $tcdetails[0]['batch_name']; ?>"  class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="customer">Last Date of Attendance :</label>
                                            <input type="text" id="customer" name="customer" value="<?php echo date('d-m-Y', strtotime($tcdetails[0]['last_date_of_attendance']));  ?>"  class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="customer">Total Working Days :</label>
                                            <input type="text" id="customer" name="customer" value="<?php echo $tcdetails[0]['total_no_of_days']; ?>"  class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="customer">Total Attendance :</label>
                                            <input type="text" id="customer" name="customer" value="<?php echo $tcdetails[0]['total_no_of_present']; ?>"  class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="customer">Eligible For Higher Education :</label>
                                            <input type="text" id="customer" name="customer" value="" placeholder="Yes" class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="customer">Character/Conduct :</label>
                                            <input type="text" id="customer" name="customer" value="<?php echo $tcdetails[0]['character_and_conduct']; ?>" placeholder="Good" class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="customer">Promoted Year :</label>
                                            <input type="text" id="customer" name="customer" value="<?php echo $tcdetails[0]['promoyr']; ?>" class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="customer">Promoted Class :</label>
                                            <input type="text" id="customer" name="customer" value="<?php echo $tcdetails[0]['promoclass']; ?>" placeholder="6" class="form-control" disabled="" style="background-color: white">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <div class="tab-content">
                                    <div id="contact-1" class="tab-pane active">
                                        <div class="row m-b-lg">
                                            <div class="col-lg-12 ">
                                                <h2>TC Issue
                                                    <span> <i style="font-size: 30px !important; float: right; color: #23c6c8; padding-right: 0.5px;" class="material-icons" data-toggle="tooltip" title="Save">save</i> </span>
                                                </h2><hr>
                                            </div>
                                        </div>
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-lg-12 col-xs-12 col-md-12" >
                                                    <div class="form-group">
                                                        <label for="title">Received By :</label>
                                                        <input id="title" type="text" class="form-control" placeholder=""  />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <div class="col-lg-12 col-xs-12 col-md-12">
                                                    <div class="form-group" id="data_1">
                                                        <label class="font-noraml">Date Of Issue :</label>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <div class="col-lg-12 col-xs-12 col-md-12" >
                                                    <div class="form-group">
                                                        <label for="title">Reason for leaving :</label>
                                                        <input id="title" type="text" class="form-control" placeholder=""  />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <div class="col-lg-12 col-xs-12 col-md-12" >
                                                    <div class="form-group">
                                                        <label for="title">Remark :</label>
                                                        <input id="title" type="text" class="form-control" placeholder=""  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
</script>