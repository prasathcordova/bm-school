<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>


<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5>TC PREPARATION OF <?php echo $tcdetails[0]['name']; ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Save & Submit TC Prepration" data-placement="left" href="javascript:void(0)" onclick="tc_prepare_data('<?php echo $tcdetails[0]['batch_id']; ?>', '<?php echo $tcdetails[0]['student_id']; ?>', '<?php echo $tcdetails[0]['admn_no']; ?>', '<?php echo $tcdetails[0]['name']; ?>', '<?php echo $tcdetails[0]['app_id']; ?>', '<?php echo $tcdetails[0]['acd_year']; ?>', '<?php echo $tcdetails[0]['batch_name']; ?>', '<?php echo $tcdetails[0]['leaving_class']; ?>');"><i class="fa fa-save" style="padding-right:10px;"></i>SAVE & SUBMIT TC PREPARATION</a>
                    </div>
                </div>

                <input type="hidden" id="cur_acdyear" value="<?php echo $cur_acdyear; ?>">
                <input type="hidden" id="cur_batchid" value="<?php echo $cur_batchid; ?>">

                <div class="ibox-content">
                    <div class="row ">
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="b-r" style="background: #fff;text-align: center;border: #F7A54A;border-radius: 10px; ">
                                <div class="form-group ">
                                    <?php
                                    $profile_image = "";
                                    if (!empty(get_student_image($tcdetails[0]['student_id']))) {
                                        $profile_image = get_student_image($tcdetails[0]['student_id']);
                                    } else if (isset($tcdetails[0]['profile_image']) && !empty($tcdetails[0]['profile_image'])) {

                                        $profile_image = "data:image/png;base64," . $tcdetails[0]['profile_image'];
                                    } else {
                                        if (isset($tcdetails[0]['profile_image_alternate']) && !empty($tcdetails[0]['profile_image_alternate'])) {
                                            $profile_image = $tcdetails[0]['profile_image_alternate'];
                                        } else {
                                            $profile_image = base_url('assets/img/a0.jpg');
                                        }
                                    }
                                    ?>


                                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="width: 128px;">
                                    <!--<img src="<?php echo base_url('assets/img/a8.jpg'); ?>" class="img-circle circle-border  m-b-md" alt="profile">-->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12" style="padding-top: 23px;">
                            <div class="form-group">
                                <label>TC Type *</label>
                                <select id="tc_type" name="tc_type" class="form-control select2_demo_1">
                                    <option value="-1" selected>Select</option>
                                    <?php
                                    if (isset($tctypes) && !empty($tctypes)) {
                                        foreach ($tctypes as $row) {
                                            echo "<option value='" . $row["Type_Id"] . "'>TC-" . $row["Type_Code"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12" style="padding-top: 23px;">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Admission No.</label>
                                <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['admn_no']; ?>" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Student Name</label>
                                <input type="text" id="order_id" name="order_id" class="form-control" disabled="" value="<?php echo $tcdetails[0]['name']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Batch Name</label>
                                <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['batch_name']; ?>" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Guardian Name</label>
                                <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['Parent_Name']; ?>" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Relation</label>
                                <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['Relation']; ?>" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Address</label>
                                <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['Address']; ?>" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="order_id">Stream</label>
                                <input type="text" id="stream" name="stream" value="<?php echo $tcdetails[0]['stream_name']; ?>" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group <?php
                                                    if (form_error('leavingyear_select')) {
                                                        echo 'has-error';
                                                    }
                                                    ?>">
                                <label>Leaving Year </label><span class="mandatory"> *</span><br />

                                <select name="leavingyear_select" id="leavingyear_select" class="form-control select2_leavingyr" style="width:100%;">

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

                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group" id="data_1">
                                <label>Last Date Of Attendance *</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" placeholder="Enter Last Date Of Attendance" data-date-start-date="<?php echo date('d-m-Y', strtotime($tcdetails[0]['admn_date'])); ?>" name="last_date" id="last_date" value="" readonly="" style="background:#fff;" />
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Total Working Days *</label>
                                <input type="text" id="twdays" name="twdays" value="" placeholder="Enter Total Working Days" class="form-control digits" maxlength="4" style="background-color: white">
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Total Attendance *</label>
                                <input type="text" id="tattendance" name="tattendance" value="" placeholder="Enter Total Attendance" class="form-control digits" maxlength="4" style="background-color: white">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Eligible For Higher Education *</label>
                                <select class="select2_demo_1 form-control" name="elighigheredu" id="elighigheredu">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="3">Transfer</option>
                                </select> </div>
                        </div>

                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">Character/Conduct *</label>
                                <select class="select2_demo_1 form-control" name="characonduct" id="characonduct">
                                    <option value="1">Excellent</option>
                                    <option value="2">Very Good</option>
                                    <option value="3">Good</option>
                                    <option value="4">Bad</option>
                                </select> </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group <?php
                                                    if (form_error('promotedyear_select')) {
                                                        echo 'has-error';
                                                    }
                                                    ?>">
                                <label>Promoted Year </label><span class="mandatory"> *</span><br />

                                <select name="promotedyear_select" id="promotedyear_select" class="form-control select2_promotedyr" style="width:100%;">

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
                                <label>Promoted Class </label><span class="mandatory"> *</span><br />

                                <select name="class_select" id="class_select" required="" class="form-control select2_studclass " style="width:100%;">

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
                                <label>Subject to Re-Sit</label>
                                <input type="text" class="form-control" placeholder="Subject to Re-Sit" maxlength="30" name="resit_subj" id="resit_subj" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer"> Whether failed</label>
                                <select class="select2_demo_1 form-control" name="whether_failed" id="whether_failed">
                                    <option value="No">No</option>
                                    <option value="Once">Once</option>
                                    <option value="Twice">Twice</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label>Subjects Studied </label>
                                <input type="text" class="form-control" placeholder="Subjects Studied " maxlength="50" name="subjects_studied" id="subjects_studied" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <?php if ($institution_id == 5 or $institution_id == 8 or $institution_id == 20) $label_eid_adhar = 'Aadhar Number';
                                else $label_eid_adhar = 'Emirate ID'; ?>
                                <label class="control-label" for="order_id"><?php echo $label_eid_adhar; ?> </label>
                                <input type="text" id="order_id" name="order_id" value="<?php echo $tcdetails[0]['Adhar_No']; ?>" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer"> Whether NCC cadet/Boy Scout/Girl Guide</label>
                                <select class="select2_demo_1 form-control" name="whether_ncc" id="whether_ncc">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label>Games or Extra Curricular activities </label>
                                <input type="text" class="form-control" placeholder="Games or Extra Curricular activities" name="games_extra_curricular" id="games_extra_curricular" maxlength="50" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label>Remarks *</label>
                                <input type="text" class="form-control" placeholder="Remarks" name="remark" id="remark" maxlength="100" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!--                        <div class="col-lg-4 col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                       <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Save</strong></button> 
                                                        <button class="btn btn-primary " onclick="tc_prepare_data('<?php echo $tcdetails[0]['batch_id']; ?>', '<?php echo $tcdetails[0]['student_id']; ?>', '<?php echo $tcdetails[0]['admn_no']; ?>', '<?php echo $tcdetails[0]['name']; ?>', '<?php echo $tcdetails[0]['app_id']; ?>', '<?php echo $tcdetails[0]['acd_year']; ?>', '<?php echo $tcdetails[0]['batch_name']; ?>', '<?php echo $tcdetails[0]['leaving_class']; ?>');"  >Submit</button>                        
                        
                                                    </div>
                                                </div>-->





                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {

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

            $('#last_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                endDate: '+0d',
                format: 'dd-mm-yyyy'
            });
        });

        function tc_prepare_data(batch_id, student_id, admn_no, name, app_id, acd_year, batch_name, leaving_class) {

            var currentclass = parseInt('<?php echo $tcdetails[0]['leaving_class']; ?>');
            var batch_id = batch_id;
            var student_id = student_id;
            var admn_no = admn_no;
            var name = name;
            var app_id = app_id;
            var academicyear = acd_year;
            var batchname = batch_name;
            var leavingclass = leaving_class;
            var tctype = $('#tc_type').val()
            var cur_acdyear = $("#cur_acdyear").val();
            var cur_batchid = $("#cur_batchid").val();

            var Leavingyear = $('#leavingyear_select').val();
            var promotedyear = $('#promotedyear_select').val();
            var promotedclass = $('#class_select').val();
            var working_days = $('#twdays').val();
            var total_attend = $('#tattendance').val();
            var characonduct = $("#characonduct option:selected").text();
            var eligibleforhigher = $("#elighigheredu option:selected").text();
            var lastdateofattend = moment($('#last_date').datepicker('getDate')).format('YYYY-MM-DD');
            var resit_subject = $('#resit_subj').val();
            var stream = $('#stream').val();
            var remarks = $('#remark').val();

            var games_extra_curricular = $('#games_extra_curricular').val();
            var whether_ncc = $('#whether_ncc').val();
            var subjects_studied = $('#subjects_studied').val();
            var whether_failed = $('#whether_failed').val();

            var currentClassPriority = priorityClass(currentclass);
            var promottedClassPriority = priorityClass(promotedclass);

            if (tctype == -1) {
                swal('', 'TC type is required.', 'info');
                return false;
            }

            if (Leavingyear == -1) {
                swal('', 'Leaving year is required.', 'info');
                return false;
            }

            if (lastdateofattend == 'Invalid date') {
                swal('', 'Last date of attendance is required.', 'info');
                return false;
            }
            if (working_days == '') {
                swal('', 'Total working days is required.', 'info');
                return false;
            }
            if (total_attend == '') {
                swal('', 'Total attendance is required.', 'info');
                return false;
            }
            if (promotedyear == -1) {
                swal('', 'Promoted year is required.', 'info');
                return false;
            }
            if (promotedclass == -1) {
                swal('', 'Promoted class is required.', 'info');
                return false;
            }

            if (parseInt($('#promotedyear_select').val()) < parseInt($('#leavingyear_select').val())) {
                swal('', 'Promoted year should be greater than or equal to leaving year.', 'info');
                return false;
            }

            if (currentClassPriority > promottedClassPriority) {
                swal('', 'Promoted class should be greater than or equal to leaving class.', 'info');
                return false;
            }

            var a = working_days - total_attend;
            if (a < 0) {
                swal('', 'Total attendance should be less than or equals to total working days.', 'info');
                return false;
            }
            if (remarks == '') {
                swal('', 'Remarks is required.', 'info');
                return false;
            } else if (remarks.trim().length < 5) {
                swal('', 'Remarks should have atleast five characters.', 'info');
                return false;
            }

            var tc_prepare = new Object();

            tc_prepare.batch_id = batch_id;
            tc_prepare.student_id = student_id;
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
            tc_prepare.remark = remarks;
            tc_prepare.eligible_forhigher = eligibleforhigher;
            tc_prepare.last_dateofattend = lastdateofattend;
            tc_prepare.resit_subject = resit_subject == '' ? 'NIL' : resit_subject;
            tc_prepare.tctype = tctype;
            tc_prepare.games_extra_curricular = games_extra_curricular;
            tc_prepare.whether_ncc = whether_ncc;
            tc_prepare.subjects_studied = subjects_studied;
            tc_prepare.whether_failed = whether_failed;


            var studentdata = JSON.stringify(tc_prepare);
            var ops_url = baseurl + 'tc/tc-prepsave/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "studentdata": studentdata,
                    "cur_acdyear": academicyear,
                    "cur_batchid": batch_id
                },
                success: function(result) {
                    var data = $.parseJSON(result)
                    if (data.status == 1) {
                        swal('', 'TC Prepared & Issued Successfully.', 'success');
                        $('#content').html(atob(data.view));
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

        function priorityClass(class_id) {
            var ops_url = baseurl + 'tc/get-class/';
            var priority;
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "class_id": class_id
                },
                success: function(result) {
                    var data = $.parseJSON(result);
                    if (data.status == 1) {
                        priority = data.priority;
                    } else {
                        if (data.message) {
                            priority = 0;
                        } else {
                            priority = 0;
                        }
                    }

                }

            });
            return priority;
        }
    </script>