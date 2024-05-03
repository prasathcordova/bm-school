<link href="https://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
<!-- <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/theme/css/plugins/steps/step.styles.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script src="https://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
<!--<script src="<?php // echo base_url('assets/theme/plugins/validate/jquery.validate.js');                                                                                                           
                    ?>"></script>-->



<!--<script src="<?php // echo base_url('assets/theme/js/plugins/validate/jquery.validate.min.js')                                                                                      
                    ?>"></script>-->
<script src="<?php echo base_url('assets/theme/plugins/validate/jquery.validate.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>

<style>
    .alignment {
        text-align: left !important
    }

    .label_tb {
        font-weight: bold;
    }

    label.error {
        margin-left: 0px !important;
    }
</style>


<div id="profile-detail-content" style="display:none;"></div>

<style>
    .input-group-prepend,
    .input-group-append {
        display: flex !important;
    }

    .btn {
        position: relative;
        z-index: 2;
    }
</style>
<style type="text/css">
    .form-control:focus {
        outline: auto;
        outline-color: #23c6c8;
    }

    .wizard a,
    .tabcontrol a {
        border: 2px solid transparent;
    }

    .wizard a:focus,
    .tabcontrol a:focus {
        outline: 0;
        /*outline-color: #23c6c8;*/
        border: 2px solid;
        /* border-color: #3F51B5; */
    }
</style>

<div class="wrapper wrapper-content animated fadeInRight registration-view" style="padding-top: 20px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <?php
                $reg_open = 1;
                if (isset($reg_date_data) && !empty($reg_date_data)) {
                    foreach ($reg_date_data as $regrow) {
                        if (strtotime($regrow['closing_date']) >= strtotime(date('Y-m-d'))) {
                            $reg_open++;
                        }
                    }
                }

                if ($reg_open == 0) { ?>
                    <div class='alert alert-danger' style='margin-top:150px;'>
                        <h1 style="text-align:center">NO VERIFICATION FOUND</h1>
                    </div>
                <?php } else { ?>
                    <div class="ibox-title" style="text-align :left">
                        <h2> Verify User Documents </h2>
                    </div>
                    <div class="ibox-content" id="registration_loader">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>

                        <div class="row" id="student_profile_enter">
                            <div class="col-lg-12">
                                <div class="ibox" style="text-align :left">
                                    <div class="ibox-content">
                                        <?php
                                        if (isset($staff_personal) && !empty($staff_personal)) { ?>
                                            <div class="row">
                                                <div class="ibox-title" style="text-align :left">
                                                    <h2> Staff Details </h2>
                                                </div>
                                                <div class="col-lg-12" style="padding:25px">
                                                    <div class="col-lg-4">
                                                        <dl class="row mb-0">
                                                            <div class="col-sm-4 text-sm-left">
                                                                <dt>Staff Name</dt>
                                                            </div>
                                                            <div class="col-sm-8 text-sm-left">
                                                                <dd class="mb-1">:&nbsp;<span class="label label-primary"><?php echo $staff_personal['empfirst'] . " " . $staff_personal['emplast']; ?></span></dd>
                                                            </div>
                                                        </dl>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <dl class="row mb-0">
                                                            <div class="col-sm-4 text-sm-left">
                                                                <dt>Employee Code</dt>
                                                            </div>
                                                            <div class="col-sm-8 text-sm-left">
                                                                <dd class="mb-1"> :&nbsp;<?php echo $staff_personal['Emp_code']; ?></dd>
                                                            </div>
                                                        </dl>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <dl class="row mb-0">
                                                            <div class="col-sm-4 text-sm-left">
                                                                <dt>Designation</dt>
                                                            </div>
                                                            <div class="col-sm-8 text-sm-left">
                                                                <dd class="mb-1"> :&nbsp;<?php echo $staff_personal['Descript']; ?></dd>
                                                                <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $staff_personal['Emp_id']; ?>">
                                                            </div>
                                                        </dl>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <hr>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="m-b-md">
                                                    <h2> Verify Users List</h2>
                                                    <hr>
                                                </div>

                                            </div>
                                            <div class="col-lg-12" id="curd-content">
                                            </div>
                                            <div class="col-lg-12" id="close-main-content">
                                                <div class="row">
                                                    <?php
                                                    if (isset($assigned_data) && !empty($assigned_data) && is_array($assigned_data)) {
                                                        $breaker = 0;
                                                        $studentTempReg_ID = 0;
                                                        foreach ($assigned_data as $student) {
                                                            if ($studentTempReg_ID != $student['TempReg_ID']) {
                                                                $studentTempReg_ID = $student['TempReg_ID'];

                                                    ?>
                                                                <div class="col-lg-4">
                                                                    <div class="contact-box center-version">
                                                                        <a href="javascript:void(0);" style="height:225px !important;">
                                                                            <?php
                                                                            $profile_image = "";
                                                                            if (!empty(get_student_image($student['TempReg_ID']))) {
                                                                                $profile_image = get_student_image($student['TempReg_ID']);
                                                                            } else
                                                                        if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                                                $profile_image = "data:image/jpeg;base64," . $student['profile_image'];
                                                                            } else {
                                                                                if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                                                    $profile_image = $student['profile_image_alternate'];
                                                                                } else {
                                                                                    $profile_image = base_url('assets/img/a0.jpg');
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                                            <h3 class="m-b-xs" title="<?php echo $student['fname'] . " " . $student['mname'] .  " " . $student['lname']; ?>"><strong>
                                                                                    <?php echo substr($student['fname'], 0, 20); ?></strong></h3>
                                                                            <br>
                                                                            <?php if (isset($student['father_name'])) { ?>
                                                                                <div class="font-bold"><b>Parent : </b><?php echo $student['parentName'] ?></div>
                                                                            <?php } ?>
                                                                            <div class="font-bold"><b>Temp.Admission No. : </b><?php echo $student['TempAdmn_No'] ?></div>
                                                                            <div class="font-bold"><b>Class : </b><?php echo $student['class'] ?></div>

                                                                        </a>

                                                                        <div class="contact-box-footer">
                                                                            <div class="m-t-xs btn-group">
                                                                                <?php if ($student['fileverified'] == 3) { ?>
                                                                                    <a href="javascript:void(0);" title="Show account details of <?php echo $student['fname'] . " " . $student['mname'] .  " " . $student['lname']; ?> " class="btn btn-md btn-danger" disabled><i class="fa fa-ban"></i> Verify Cancelled</a>
                                                                                <?php } else if ($student['fileverified'] == 4) { ?>
                                                                                    <a href="javascript:void(0);" title="Show account details of <?php echo $student['fname'] . " " . $student['mname'] .  " " . $student['lname']; ?> " class="btn btn-md btn-warning" disabled><i class="fa fa-reply"></i> Resubmitted</a>
                                                                                <?php } else if (($student['fileverified'] == 1) || ($student['fileverified'] == 0)) { ?>
                                                                                    <a href="javascript:void(0);" title="Show account details of <?php echo $student['fname'] . " " . $student['mname'] .  " " . $student['lname']; ?> " onclick="verify_document('<?php echo $student['TempReg_ID']; ?>',1)" class="btn btn-md btn-info"><i class="fa fa-user-plus"></i> Show Verify Details</a>
                                                                                <?php } else { ?>
                                                                                    <a href="javascript:void(0);" title="Show account details of <?php echo $student['fname'] . " " . $student['mname'] .  " " . $student['lname']; ?> " class="btn btn-md btn-success" disabled><i class="fa fa-check-circle"></i> Verified Successfully</a>
                                                                                <?php }  ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                                        <div class="col-lg-12">
                                                            <div class="contact-box text-center">
                                                                No Data Found
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<script>
    //Address fill functionality Ends here

    //Code written by Elavarasan S @ May,9 2019 2:42
    $.validator.addMethod("synchronousRemote", function(value, element, param) {
        if (value == -1) {
            return false;
        } else {
            return true;
        }
    }, "Select the field");

    function typeNumberOnly(eve) {
        var e = (eve.which) ? eve.which : eve.keyCode;
        if (e != 8 && e != 0 && (e < 48 || e > 57)) {
            return false;
        }
    }

    function verify_document(temp_reg_id, isverified = 1) {
        $('#faculty_loader1').addClass('sk-loading');
        if (temp_reg_id == '') {
            swal('', 'Choose atleast 1  temporary registration.', 'info');
            $('#faculty_loader1').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'online-registration/allocate-registration-documents';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "checked_temp_ids": temp_reg_id,
                "flag": 3,
                "isverified": isverified,
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#faculty_loader').removeClass('sk-loading');
                    $('#close-main-content').hide();
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").show();
                    });
                } else {
                    $('#curd-content').removeClass('sk-loading');
                    swal('', 'Document upload failed,Please try again.', 'error');
                }
            }
        });
    }

    function submit_data(data_accept = "") {
        var verifyTable = new Array();
        var emp_id = $("#emp_id").val();
        $('#verify_table tr').each(function(row, tr) {
            verifyTable[row] = {
                "temp_id": $(tr).find('.temp_id').val(),
                "inst_id": $(tr).find('.inst_id').val(),
                "document_id": $(tr).find('.document_id').val(),
                "check_verify": $(tr).find('.check_verify').val(),
                "remarks": $(tr).find('.remarks').val(),
                "data_accept": data_accept,
                "emp_id": emp_id
            }
        });
        verifyTable.shift();
        var verify_table = JSON.stringify(verifyTable);
        var ops_url = baseurl + 'online-registration/staff-verified-documents';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                verify_table: verify_table
            },
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    swal({
                            title: "Success",
                            text: data.message, //This process is irreversible
                            type: "success",
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                $("#curd-content").hide();

                                $("#close-main-content").slideUp("slow", function() {
                                    $('#close-main-content').show();
                                    get_data()
                                });
                                $("#faculty_loader").removeClass("sk-loading");
                            }
                        });
                } else {
                    $("#faculty_loader2").removeClass("sk-loading");
                    swal('', 'Connection Error. Please contact administrator', 'info');

                }

            }
        });
    }

    function cancel_data() {
        $("#faculty_loader2").addClass("sk-loading");
        $("#curd-content").hide();
        $("#close-main-content").slideUp("slow", function() {
            $('#close-main-content').show();
            get_data()
        });
        $("#faculty_loader").removeClass("sk-loading");
    }

    $("select").on("select2:close", function(e) {
        $(this).valid();
    });
</script>