<link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet"> 
<!-- Steps -->   

<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
 
<div class="row wrapper border-bottom white-bg page-heading" >
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
</div>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
<!--                <div class="ibox-title">
                    <h5><?php // echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>-->
                <div class="ibox-content">
                    <div class="row ">
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="b-r" style="background: #fff;text-align: center;border: #F7A54A;border-radius: 10px; ">
                                <div class="form-group ">
                                    <!--<img src="img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">-->
                                    <!--<img src="<?php // echo base_url('assets/img/a4.jpg');                     ?>" class="img-circle circle-border m-b-md" alt="profile">-->
                                    <img src="<?php echo base_url('assets/img/a8.jpg'); ?>" class="img-circle circle-border  m-b-md" alt="profile">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12" style="padding-top: 23px;">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Admission  No :</label>
                                <input type="text" id="order_id" name="order_id" value=""  class="form-control" disabled="" style="background-color: white">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12" style="padding-top: 23px;">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Student Name :</label>
                                <input type="text" id="order_id" name="order_id" class="form-control" disabled="" style="background-color: white">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Batch Name :</label>
                                <input type="text" id="order_id" name="order_id" value="" class="form-control" disabled="" style="background-color: white">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Leaving Year :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <div class="form-group" id="data_1">
                                    <label class="font-noraml">Last Date Of Attendance :</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Total Working Days :</label>
                                <input type="text" id="customer" name="customer" value="" placeholder="170" class="form-control" disabled="" style="background-color: white">
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Total Attendance :</label>
                                <input type="text" id="customer" name="customer" value="" placeholder="110" class="form-control" disabled="" style="background-color: white">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Eligible For Higher Education :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="2">Transfer</option>
                                </select>                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Character/Conduct :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">Excellent</option>
                                    <option value="1">Very Good</option>
                                    <option value="2">Good</option>
                                    <option value="2">Bad</option>
                                </select>                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Promoted Year :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                </select>                      
                            </div>
                        </div>


                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Promoted Class :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="2">3</option>
                                    <option value="2">4</option>
                                    <option value="2">5</option>
                                    <option value="2">6</option>
                                </select>                            </div>
                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function () {

            $(".select2_demo_1").select2({
                "theme": "bootstrap",
                "width": "100%"

            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>