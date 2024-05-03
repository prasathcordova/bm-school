<link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet"> 
<!-- Steps -->   

<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>


<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--                <div class="ibox-title">
                                    <h5><?php // echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED"    ?></h5>
                                </div>-->
                <div class="ibox-content">
                    <div class="row ">
                        <div class="col-lg-4 col-xs-12 col-md-12">
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
                                    <!--<img src="<?php echo base_url('assets/img/a8.jpg'); ?>" class="img-circle circle-border  m-b-md" alt="profile">-->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12" style="padding-top: 23px;">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Admission  No :</label>
                                <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['admn_no']; ?>"  class="form-control" disabled="" style="background-color: white">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12" style="padding-top: 23px;">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Student Name :</label>
                                <input type="text" id="order_id" name="order_id" class="form-control" disabled="" style="background-color: white" value="<?php echo $tcdetails[0]['name']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Batch Name :</label>
                                <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['batch_name']; ?>" class="form-control" disabled="" style="background-color: white">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group <?php
                            if (form_error('leavingyear_select')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label>Leaving Year :</label><span class="mandatory" > *</span><br/>

                                <select name="leavingyear_select" id="leavingyear_select"  class="form-control select2_leavingyr" style="width:100%;" >                                

                                    <option selected value="-1">Select</option>
                                    <?php
                                    if (isset($acc_year) && !empty($acc_year)) {
                                        foreach ($acc_year as $acadyear) {
                                            echo '<option value ="' . $acadyear['Acd_ID'] . '" >' . $acadyear['Description'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('leavingyear_select', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                        <!--                        <div class="col-lg-4 col-xs-12 col-md-12">
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
                                                </div>-->
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group" id="data_1">
                                <label >Last Date Of Attendance:</label>
                                <div class="input-group date">                                
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control"  name="last_date" id="last_date" value="" />
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Total Working Days :</label>
                                <input type="text" id="twdays" name="twdays" value="" placeholder="Enter Total Working Days" class="form-control"  style="background-color: white">
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Total Attendance :</label>
                                <input type="text" id="tattendance" name="tattendance" value="" placeholder="Enter Total Attendance" class="form-control"  style="background-color: white">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Eligible For Higher Education :</label>
                                <select class="select2_demo_1 form-control" name="elighigheredu" id="elighigheredu">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="3">Transfer</option>
                                </select>                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Character/Conduct :</label>
                                <select class="select2_demo_1 form-control" name="characonduct" id="characonduct">
                                    <option value="1">Excellent</option>
                                    <option value="2">Very Good</option>
                                    <option value="3">Good</option>
                                    <option value="4">Bad</option>
                                </select>                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group <?php
                            if (form_error('promotedyear_select')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label>Promoted Year :</label><span class="mandatory" > *</span><br/>

                                <select name="promotedyear_select" id="promotedyear_select"  class="form-control select2_promotedyr" style="width:100%;" >                                

                                    <option selected value="-1">Select</option>
                                    <?php
                                    if (isset($acc_year) && !empty($acc_year)) {
                                        foreach ($acc_year as $acadyear) {
                                            echo '<option value ="' . $acadyear['Acd_ID'] . '" >' . $acadyear['Description'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('promotedyear_select', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group <?php
                            if (form_error('class_select')) {
                                echo 'has-error';
                            }
                            ?>">
                                <label>Promoted Class</label><span class="mandatory" > *</span><br/>

                                <select name="class_select" id="class_select" required="" class="form-control select2_studclass " style="width:100%;" >                                

                                    <option selected value="-1">Select</option>
                                    <?php
                                    if (isset($stud_class) && !empty($stud_class)) {
                                        foreach ($stud_class as $class_stud) {
                                            echo '<option value ="' . $class_stud['Course_Det_ID'] . '" >' . $class_stud['Description'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('class_select', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>  

                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                               <!--<button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Save</strong></button>--> 
                                <button class="btn btn-primary " onclick="tc_prepare_data('<?php echo $tcdetails[0]['admn_no']; ?>','<?php echo $tcdetails[0]['name']; ?>','<?php echo $tcdetails[0]['app_id']; ?>', '<?php echo $tcdetails[0]['acd_year']; ?>', '<?php echo $tcdetails[0]['batch_name']; ?>', '<?php echo $tcdetails[0]['leaving_class']; ?>');"  >Submit</button>                        

                            </div>
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
            $(".select2_studclass").select2({
                "theme": "bootstrap",
                "width": "100%"
            });
            $(".select2_leavingyr").select2({
                "theme": "bootstrap",
                "width": "100%"
            });
            $(".select2_promotedyr").select2({
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
        function tc_prepare_data(admn_no,name,app_id, acd_year,batch_name,leaving_class) {

            var admn_no = admn_no;
            var name = name;
            var app_id = app_id;
            var academicyear = acd_year;
             var batchname = batch_name;
            var leavingclass = leaving_class;
           
            var Leavingyear = $('#leavingyear_select').val();
            var promotedyear = $('#promotedyear_select').val();
            var promotedclass = $('#class_select').val();
            var working_days = $('#twdays').val();
            var total_attend = $('#tattendance').val();
            var characonduct = $("#characonduct option:selected").text();
            var eligibleforhigher = $("#elighigheredu option:selected").text();
            var lastdateofattend = moment($('#last_date').val()).format('YYYY-MM-DD');

            var tc_prepare = new Object();

            tc_prepare.admn_no = admn_no;
            tc_prepare.name = name;
            tc_prepare.app_id = app_id;
            tc_prepare.acd_year = academicyear;
            tc_prepare.leavingclass = leavingclass;
            tc_prepare.batch_name = batchname;
            tc_prepare.leaving_year = Leavingyear;
            tc_prepare.promoted_year = promotedyear;
            tc_prepare.totalworkdays = working_days;
            tc_prepare.totaldaysattend = total_attend;
            tc_prepare.characonduct = characonduct;
            tc_prepare.promotedclass = promotedclass;

            tc_prepare.eligible_forhigher = eligibleforhigher;
            tc_prepare.last_dateofattend = lastdateofattend;

            var studentdata = JSON.stringify(tc_prepare);
//            alert(studentdata);
//            return false;
            var ops_url = baseurl + 'tc/tc-prepsave/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {"load": 1, "studentdata": studentdata},
                success: function (result) {
                    var data = $.parseJSON(result)
                    if (data.status == 1) {
                        swal('', 'TC Prepared Successfully', 'success');
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error encountered while saving TC Preparation. Please try again later or contact administrator.');
                            return false;
                        }
                    }

                }
            });
        }
    </script>