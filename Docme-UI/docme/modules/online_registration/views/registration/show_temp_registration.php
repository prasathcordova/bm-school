<link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/theme/css/plugins/steps/step.styles.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<!--<script src="<?php // echo base_url('assets/theme/plugins/validate/jquery.validate.js');                                                                                                           
                    ?>"></script>-->



<!--<script src="<?php // echo base_url('assets/theme/js/plugins/validate/jquery.validate.min.js')                                                                                      
                    ?>"></script>-->
<script src="<?php echo base_url('assets/theme/plugins/validate/jquery.validate.js') ?>"></script>
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
<!--div class="row wrapper border-bottom white-bg page-heading registration-view">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
       </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            ?>
       </ol>        
   </div>    
</div-->
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

<div class="wrapper wrapper-content animated fadeInRight registration-view" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--                    <div class="ibox-title">
                                            <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                                       </div>-->
                <?php
                $reg_open = 0;
                if (isset($reg_date_data) && !empty($reg_date_data)) {
                    foreach ($reg_date_data as $regrow) {
                        if (strtotime($regrow['closing_date']) >= strtotime(date('Y-m-d'))) {
                            $reg_open++;
                        }
                    }
                }

                if ($reg_open == 0) { ?>
                    <div class='alert alert-danger' style='margin-top:150px;'>
                        <h1 style="text-align:center">REGISTRATION CLOSED</h1>
                    </div>
                <?php } else { ?>
                    <div class="ibox-title" style="text-align :center">
                        <h2>ONLINE REGISTRATION FORM</h2>
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
                                <div class="ibox collapsed">
                                    <div class="ibox-title">
                                        <h5>Admission Schedule</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="table-responsive m-t">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Class</th>
                                                        <th>Opening Date</th>
                                                        <th>Closing Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody align="left">
                                                    <?php if (isset($reg_date_data) && !empty($reg_date_data)) {
                                                        foreach ($reg_date_data as $regrow) { ?>
                                                            <tr>
                                                                <td class="label_tb"><?php echo $regrow['class_name']; ?></td>
                                                                <td class="alignment"><?php echo date("d-m-Y", strtotime($regrow['opening_date'])); ?></td>
                                                                <td class="alignment"><?php echo date("d-m-Y", strtotime($regrow['closing_date'])); ?></td>

                                                            </tr>
                                                    <?php       }
                                                    } ?>

                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <!--a href="javascript:void(0)"  onclick="showview();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a-->
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 wizard-big" id="wizard">
                                <!--<form id="form" action="#" class="">-->
                                <h1>CANDIDATE DETAILS</h1>
                                <?php $this->view('registration/partial-candidate-temp-registration'); ?>

                                <h1>ACADEMIC AND REGISTRATION</h1>
                                <?php $this->view('registration/partial-academic-temp-registration'); ?>

                                <h1>FAMILY DETAILS</h1>
                                <?php $this->view('registration/partial-family-temp-registration'); ?>

                                <h1>OTP VERIFICATION</h1>
                                <?php $this->view('registration/partial-otp-temp-registration'); ?>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- </fieldset>
</div>
</div>
</div> -->
<?php } ?>
<!-- </div>
</div>
</div>
</div> -->


<input type="hidden" name="admission_number_new" id="admission_number_new" value="" />
<input type="hidden" name="token_number_new" id="token_number_new" value="" />
<input type="hidden" name="uuid_unit_limit" id="uuid_unit_limit" value="<?php echo $uuid_unit_limit; ?>" />
<input type="hidden" name="uuid_unit_limit_name" id="uuid_unit_limit_name" value="<?php echo $uuid_unit_limit == 12 ? 'Aadhar Number' : 'Emirates ID'; ?>" />
<input type="hidden" name="inst_id_val" id="inst_id_val" value="<?php echo 'c2Nob29sX2lk=' . base64_encode($this->session->userdata('inst_id')); ?>" />
<input type="hidden" name="inst_id" id="inst_id" value="<?php echo $this->session->userdata('inst_id'); ?>" />
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


    function changed_country() {
        var nationality = $("#country_select :selected").data('nationality');
        var country_id = $('#country_select').val();
        $('#nationality').val(nationality);
        $('#state_select').empty().trigger("change");
        $('#birth_country').val($("#country_select :selected").text());
        $('#birth_country').trigger("change");
        var ops_url = baseurl + 'online-registration/get-state-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "country_id": country_id
            },
            success: function(result) {
                $('#state_select').empty().trigger("change");
                $('#district_select').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var state_data = data.data;
                    $('#state_select').append("<option value='-1' selected >Select State</option>");
                    $.each(state_data, function(i, v) {
                        if (v.state_id == 1) {
                            $('#state_select').append("<option selected value='" + v.state_id + "' >" + v.state_name + "</option>");
                        } else {
                            $('#state_select').append("<option  value='" + v.state_id + "' >" + v.state_name + "</option>");
                        }
                    });
                    $('#state_select').trigger('change');
                    $('#state_select').valid();
                } else {
                    $('#state_select').empty().trigger("change");
                    $('#state_select').append("<option value='-1' selected >Select State</option>");
                    $('#state_select').trigger("change");
                }
            }
        });
    }

    function birth_changed_country() {
        var country_id = $("#birth_country :selected").data('sel-id');
        //var country_id = $('#birth_country_select').val();
        $('#birth_state').empty().trigger("change");
        var ops_url = baseurl + 'online-registration/get-state-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "country_id": country_id
            },
            success: function(result) {
                $('#birth_state').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var state_data = data.data;
                    $('#birth_state').append("<option value='' selected >Select State</option>");
                    $.each(state_data, function(i, v) {
                        $('#birth_state').append("<option  data-sel-id='" + v.state_id + "' value='" + v.state_name + "' >" + v.state_name + "</option>");
                    });
                    $('#birth_state').trigger('change');
                } else {
                    $('#birth_state').empty().trigger("change");
                    $('#birth_state').append("<option value='-1' selected >Select State</option>");
                    $('#birth_state').trigger("change");
                }
            }
        });
    }

    function changed_state() {
        var state_id = $('#state_select').val();
        $('#district_select').empty().trigger("change");
        var ops_url = baseurl + 'online-registration/get-city-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "state_id": state_id
            },
            success: function(result) {

                var data = JSON.parse(result);
                if (data.status == 1) {
                    var city_data = data.data;
                    $('#district_select').empty().trigger("change");
                    $('#district_select').append("<option value='-1' selected >Select District</option>");
                    $.each(city_data, function(i, v) {

                        $('#district_select').append("<option value='" + v.city_id + "' >" + v.city_name + "</option>");
                    });
                    $('#district_select').trigger('change');
                } else {
                    $('#district_select').empty().trigger("change");
                    $('#district_select').append("<option value='-1' selected >Select District</option>");
                    $('#district_select').trigger("change");
                }
            }
        });
    }

    function birth_changed_state() {
        var state_id = $("#birth_state :selected").data('sel-id');
        //var state_id = $('#birth_state').val();
        $('#birth_district').empty().trigger("change");
        var ops_url = baseurl + 'online-registration/get-city-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "state_id": state_id
            },
            success: function(result) {

                var data = JSON.parse(result);
                if (data.status == 1) {
                    var city_data = data.data;
                    $('#birth_district').empty().trigger("change");
                    $('#birth_district').append("<option value='' selected >Select District</option>");
                    $.each(city_data, function(i, v) {

                        $('#birth_district').append("<option value='" + v.city_name + "' >" + v.city_name + "</option>");
                    });
                    $('#birth_district').trigger('change');
                } else {
                    $('#birth_district').empty().trigger("change");
                    $('#birth_district').append("<option value='' selected >Select District</option>");
                    $('#birth_district').trigger("change");
                }
            }
        });
    }

    function typeNumberOnly(eve) {
        var e = (eve.which) ? eve.which : eve.keyCode;
        if (e != 8 && e != 0 && (e < 48 || e > 57)) {
            return false;
        }
    }

    function showreg() {
        $('#student_profile_enter').show().addClass('animated fadeInRight');
        $('#student_profile_view').hide();
    }

    function showview() {
        swal({
            title: '',
            text: 'Need Confirmation, Do you want to cancel this process ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + "registration/temp-registration";
                return true;
            }
        });
    }

    $('#admission_no').on('keypress', function(e) {
        if (e.keyCode == 13) {
            if ($('#admission_no').val().trim().length < 3) {
                swal('', 'Enter atleast three characters.', 'info');
                return false;
            } else {
                filterbyAdmno();
                return true;
            }
        }
        if (/[0-9a-zA-Z/]+$/.test(e.key)) {
            return true;
        } else {
            return false;
        }
    });

    $('#sname').on('keypress', function(e) {
        if (e.keyCode == 13) {
            if ($('#sname').val().trim().length < 3) {
                swal('', 'Enter atleast three characters.', 'info');
                return false;
            } else {
                filterbyname();
                return true;
            }
        }
        if (/[a-zA-Z\s]+$/.test(e.key)) {
            return true;
        } else {
            return false;
        }
    });

    function changed_religion() {
        var religion_id = $('#religion_select').val();
        var ops_url = baseurl + 'online-registration/get-caste-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "religion_id": religion_id
            },
            success: function(result) {
                $('#caste_select').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var caste_data = data.data;
                    $('#caste_select').empty().trigger("change");
                    $.each(caste_data, function(i, v) {
                        $('#caste_select').append("<option value='" + v.caste_id + "' data-communityselect='" + v.community_id + "' >" + v.caste_name + "</option>");
                    });
                    $('#caste_select').trigger('change');
                    $('#caste_select').valid();
                } else {
                    $('#caste_select').empty().trigger("change");
                }
            }
        });
    }
    $("#wizard").steps({
        headerTag: "h1",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        autoFocus: true,
        onStepChanging: function(event, currentIndex, newIndex) {
            // Always allow going backward even if the current step contains invalid fields!
            if (currentIndex > newIndex) {
                $('input').removeClass('error');
                return true;
            }

            // if (currentIndex < newIndex) {
            //     // To remove error styles
            //     $(".body:eq(" + newIndex + ") label.error", form).remove();
            //     $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
            // }
            // Disable validation on fields that are disabled or hidden.
            //                form.validate().settings.ignore = ":disabled,:hidden";

            $('.registration-content').slimScroll({
                position: 'right',
                height: '350px',
                railVisible: true,
                alwaysVisible: false
            });
            // Start validation; Prevent going forward if false

            if (newIndex == 1) {
                var personal_details = $('#personal_details');
                var studentid = $('#studentid').val();
                if (parseInt($('#personal_details input#age').val()) < 2) {

                    swal('', 'Cannot register a student with age as ' + $('#personal_details input#age').val(), 'info');
                    return false;
                }
                if (personal_details.valid() && personal_details.valid()) {
                    $('#registration_loader').addClass('sk-loading');
                    change_class_for_reg();
                    personal_details_validator.resetForm();
                    academic_profile_validator.resetForm();
                    return true;
                } else {
                    $('#firstname').focus();
                    swal('', 'Enter the mandatory fields.', 'info');
                    return false;
                }
            } else if (newIndex == 2) {
                $('#stream_id').focus();
                var academic_profile = $('#academic_profile');
                if (academic_profile.valid() && academic_profile.valid()) {
                    admnTYPE = $('#admn_type').val();
                    ad_type_textVal = $('#ad_type_text').val();
                    if (admnTYPE != 'General' && ad_type_textVal == '') {
                        var inst_id = $('#inst_id').val();
                        if (inst_id == 2 && admnTYPE == 'Sibling') {
                            var count = 0;
                            var class_error = 0;
                            $('#ad_type_text').val('');
                            $('.sib_name').each(function() {
                                if ($(this).val() != '') {
                                    count++;
                                    if ($(this).parent().parent().find('.sib_class').val() == '') {
                                        $(this).parent().parent().find('.sib_class_error').html('Class is required.');
                                        class_error = 1;
                                    } else {
                                        $(this).parent().parent().find('.sib_class_error').html('')
                                    }
                                }
                            });
                            if (count != 0) {
                                if (class_error == 1) {
                                    $('#stream_id').focus();
                                    $('#sibling_error').html('Fill the class details for siblings entered');
                                    return false;
                                } else {
                                    academic_profile_validator.resetForm();
                                    parent_details_validator.resetForm();
                                    $('#sibling_error').html('');
                                    return true;
                                }

                            } else {
                                $('#stream_id').focus();
                                $('#sibling_error').html('Atleast One Sibling is required.');
                                return false;
                            }
                        } else {
                            $('#stream_id').focus();
                            $('#admn_error_info').text("Enter this field");
                            return false;
                        }

                    } else {
                        academic_profile_validator.resetForm();
                        parent_details_validator.resetForm();
                        $('#admn_error_info').text("");
                        return true;
                    }
                } else {
                    $('#stream_id').focus();
                    swal('', 'Enter all the mandatory fields.', 'info');
                    return false;
                }
            } else if (newIndex == 3) {
                $('#registration_loader').addClass('sk-loading');
                //setTimeout(function() {
                $('#fname').focus();
                var parent_details = $('#parent_details');
                $('.panel-collapse:not(".in")')
                    .collapse('show');
                if (parent_details.valid() && parent_details.valid()) {
                    //$('#myNav').width("100%");

                    if (save_temp_details() == true) {
                        var admn_no = $('#admission_number_new').val();
                        var ops_url = baseurl + 'online_registration/select-student-temporary-reg';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            async: false,
                            url: ops_url,
                            data: {
                                "load": 1,
                                "admn": admn_no
                            },
                            success: function(result) {

                                //$('#myNav').width("0%");
                                var res = JSON.parse(result);
                                if (res.status == 1) {
                                    set_values_for_update(res.data);
                                    // flag = 1;
                                } else {
                                    if (data.message) {
                                        swal('', data.message, 'info')
                                    }
                                    flag = 0;
                                }
                            },
                            error: function() {
                                flag = 0;
                            }
                        });
                        $('#registration_loader').removeClass('sk-loading');
                        parent_details_validator.resetForm();
                        return true;
                    }


                } else {
                    $('#registration_loader').removeClass('sk-loading');
                    $('#fname').focus();
                    swal('', 'Enter all the mandatory fields.', 'info');
                    return false;
                }
                // }, 3000);
            }

        },
        onStepChanged: function(event, currentIndex, priorIndex) {

        },
        onFinishing: function(event, currentIndex) {
            $('#registration_loader').addClass('sk-loading');
            $('html, body').stop().animate({
                scrollTop: $($('.ibox-content')).offset().top + 350
            }, 500);
            setTimeout(function() {
                var send_OTP = sendOTP();
                if (send_OTP == 1) {
                    var admn_no = $('#admission_number_new').val();
                    var inst_id_val = $('#inst_id_val').val();
                    var email_result_json;
                    var redirect_link;
                    email_result_json = sendTempRegEmail(admn_no);
                    email_result = JSON.parse(email_result_json);
                    $('#registration_loader').removeClass('sk-loading');
                    if (email_result.status == 1) {
                        $('#registration_loader').removeClass('sk-loading');
                        //$('#myNav').width("0%");
                        var cancel_btn;
                        var token_no = $('#token_number_new').val();
                        var text = 'Your online registration submitted successfully. ';
                        if ($('#studentid').val() > 0) {
                            text = 'Your online registration submitted successfully. ';
                        }
                        if (email_result.payment_link != '') {
                            text = text + 'Proceed to Payment Page for your token number : ' + token_no + '.';
                            redirect_link = email_result.payment_link;
                            cancel_btn = true;
                        } else {
                            text = text + 'Acknowledgement mail will be sent to your communication email.Your token number is ' + token_no + '.';
                            redirect_link = baseurl + "online-registration/return-view";
                            cancel_btn = false
                        }
                        swal({
                            title: 'Success',
                            text: text,
                            type: 'success',
                            showCancelButton: cancel_btn,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'PAY ONLINE',
                            cancelButtonText: 'PAY AT SCHOOL',
                            closeOnConfirm: false
                        }, function(isConfirm) {
                            if (isConfirm)
                                window.location.href = redirect_link
                            else
                                window.location.href = baseurl + "online-registration/return-view";

                        });
                        return true;
                    } else {
                        $('#registration_loader').removeClass('sk-loading');
                        //$('#myNav').width("0%");
                        var text = 'Temporary Registration Failed.';
                        swal({
                            title: 'Please Try Again',
                            text: text,
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#DD6B55',
                            //cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            closeOnConfirm: true
                        }, function(isConfirm) {
                            return false;
                        });
                        //return true;
                    }
                } else if (send_OTP == 2) {
                    $('#registration_loader').removeClass('sk-loading');
                    var text = 'Temporary Registration Failed';
                    swal({
                        title: 'Please Try Again',
                        text: text,
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#DD6B55',
                        //cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true
                    }, function(isConfirm) {
                        return false;
                    });
                } else {
                    $('#registration_loader').removeClass('sk-loading');
                    //$('#myNav').width("0%");
                    $('#otp_verification').val('');
                    var text = 'OTP Validation Failed';
                    swal({
                        title: 'Please Try Again',
                        text: text,
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#DD6B55',
                        //cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true
                    }, function(isConfirm) {
                        return false;
                    });
                    //return true;
                }
            }, 3000);
            //$('#myNav').width("100%");


        },
        onFinished: function(event, currentIndex) {}
    });


    var inst_id = $('#inst_id').val();
    if (inst_id == 5 || inst_id == 8 || inst_id == 20) {
        $('#dob_date').datepicker({
            format: 'dd-mm-yyyy',
            endDate: '31-12-' + (new Date().getFullYear() - 2).toString(),
            //  endDate: moment($('#agelimit').val() + '/' + new Date().getFullYear()).isValid() == true ? moment($('#agelimit').val() + '/' + new Date().getFullYear()).subtract(Number($('#agelimit').attr('data-val')), 'years').format('DD-MM-YYYY') : '-365d',
            //  maxDate: '',
            //                todayBtn: "linked",
            autoclose: true,

        }).on('changeDate', function() {
            age_changer();
            $(this).valid(); // triggers the validation test

        });

    } else {
        $('#dob_date').datepicker({
            format: 'dd-mm-yyyy',
            endDate: '31-12-' + (new Date().getFullYear() - 3).toString(),
            //  endDate: moment($('#agelimit').val() + '/' + new Date().getFullYear()).isValid() == true ? moment($('#agelimit').val() + '/' + new Date().getFullYear()).subtract(Number($('#agelimit').attr('data-val')), 'years').format('DD-MM-YYYY') : '-365d',
            //  maxDate: '',
            //                todayBtn: "linked",
            autoclose: true,

        }).on('changeDate', function() {
            age_changer();
            $(this).valid(); // triggers the validation test
        });
    }

    /*$('#admission_date').datepicker({
        format: 'dd-mm-yyyy',
        endDate: '+0d',
        todayBtn: "linked",
        autoclose: true,
        onClose: function () {

        }
    });*/
    //$('#admission_date').val(moment().format('DD-MM-YYYY'));
    $('#search_student').hide();
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    //    });
    function show_search() {
        $('#search_student').slideDown("slow");
    }

    function hide_search() {
        $('#search_student').slideUp("slow");
    }

    function age_changer() {
        if (moment($("#dob_date").datepicker("getDate")).isValid()) {
            var age = getAge(moment($("#dob_date").datepicker("getDate")).format('YYYY-MM-DD'));
            //                var diff = getDiff(moment($("#dob_date").datepicker("getDate")).format('YYYY-MM-DD'));
            $('#age').attr('data-val', age.age);
            $('#age').val(age.agestr);
        } else {
            $('#age').attr('data-val', '');
            $('#age').val('0 Years 0 Months 0 Days');
        }
        //change_class_for_reg();
    }

    function getAge(dateVal) {
        let date1 = moment();
        if ($('#agelimit').val() != '0') {
            date1 = moment($('#agelimit').val(), "DD-MM-YYYY");
        } else {
            date1 = moment();
        }
        //alert(age_limit_date);
        let date2 = moment(dateVal);
        let years = date1.diff(date2, 'year');
        date2.add(years, 'years');

        let months = date1.diff(date2, 'months');
        date2.add(months, 'months');

        let days = date1.diff(date2, 'days');
        date2.add(days, 'days');

        var yearstring;
        var monthstring;
        var daystring;

        if (years <= 1) {
            yearstring = ' Year ';
        } else {
            yearstring = ' Years ';
        }

        if (months <= 1) {
            monthstring = ' Month ';
        } else {
            monthstring = ' Months ';
        }
        if (days <= 1) {
            daystring = ' Day ';
        } else {
            daystring = ' Days ';
        }


        return {
            agestr: years + yearstring + months + monthstring + days + daystring,
            age: years
        };
    }

    function save_temp_details() {
        var firstname = $('#firstname').val();
        var middlename = $('#middlename').val();
        var lastname = $('#lastname').val();
        var gender = $('#gender').val();
        var country_selected = $('#country_select').val();
        var nationality = $('#nationality').val();
        var state_selected = $('#state_select').val();
        var district_selected = $('#district_select').val();
        var dob = moment($("#dob_date").datepicker("getDate")).format('YYYY-MM-DD');
        //var age = $('#age').val();
        var age = $('#age').attr('data-val');
        var religion_select = $('#religion_select').val();
        var caste_select = $('#caste_select').val();
        var community_select = $('#community_select').val();
        var blood_group = $('#blood_group').val();
        var pickup_point = $('#pickup_point').val();
        var mother_tongue = $('#mother_tongue').val();
        var language_select = $('#language_select').val();
        var unique_identity = $('#unique_identity').val();
        var studentid = $('#studentid').val();
        var admission_no = $('input[name=admission_no]').val();
        // var admission_date = moment($("#admission_date").datepicker("getDate")).format('YYYY-MM-DD');
        var admission_date_raw = $('#admission_date').val();
        var d = new Date(admission_date_raw.split("/").reverse().join("-"));
        var dd = d.getDate();
        var mm = d.getMonth() + 1;
        var yy = d.getFullYear();
        var admission_date = yy + "-" + mm + "-" + dd;
        var acd_year_id = $('#academic_year :selected').val();
        var stream = $('#stream_id :selected').val();
        var course_id = $('#class_details :selected').val();
        var course_master_id = $('#class_details :selected').data('masterid');
        var optional_sub1 = $('#optional_subject1 :selected').val();
        var optional_sub2 = $('#optional_subject2 :selected').val();
        var birth_country = $('#birth_country').val();
        var birth_place = $('#birth_place').val();

        var birth_state = $('#birth_state').val();
        var birth_district = $('#birth_district').val();

        if ($('#entrance_date :selected').val() != '' && $('#entrance_date :selected').val() != null) {
            var entrance_date = moment($('#entrance_date :selected').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
        } else {
            var entrance_date = '';
        }

        if (admission_date.length == 0 || admission_date == 'Invalid date') {
            swal('', 'check admission date.', 'info');
            return false;
        }
        var admn_type = $('#admn_type').val();
        var ad_type_text = $('#ad_type_text').val();
        //father details
        var fname = $('#fname').val();
        var freltype = $('#reltype').val();
        var fprofession_selected = $('#fprofession').val();
        //communication address
        var fcadd1 = $('#fadd1').val();
        var fcadd2 = $('#fadd2').val();
        var fcadd3 = $('#fadd3').val();
        var fczip = $('#fzip').val();
        var fcphone = $('#fphone').val();
        var fcmobile = $('#fmobile').val();
        var fcmail = $('#fmail').val();
        //permanent address
        var fpadd1 = $('#fcadd1').val();
        var fpadd2 = $('#fcadd2').val();
        var fpadd3 = $('#fcadd3').val();
        var fpzip = $('#fczip').val();
        var fpphone = $('#fcphone').val();
        var fpmobile = $('#fcmobile').val();
        var fpmail = $('#fcmail').val();
        //office address
        var foadd1 = $('#foadd1').val();
        var foadd2 = $('#foadd2').val();
        var foadd3 = $('#foadd3').val();
        var fozip = $('#fozip').val();
        var fophone = $('#fophone').val();
        var fomobile = $('#fomobile').val();
        var fomail = $('#fomail').val();

        var studentid = $('#studentid').val();
        var admission_no = $('#admission_no').val();

        var stud_passport = $('#stud_passport').val();
        var stud_placeofissue = $('#stud_placeofissue').val();
        var f_qualification = $('#f_qualification').val();
        var f_nationality = $('#f_nationality').val();
        var f_passport = $('#f_passport').val();
        var f_emirate_id = $('#f_emirate_id').val();
        var m_name = $('#m_name').val();
        var m_profession = $('#m_profession').val();
        var m_qualification = $('#m_qualification').val();
        var daughter_count = $('#daughter_count').val();
        var son_count = $('#son_count').val();
        var sibling_count = $('#sibling_count').val();
        var prev_school = $('#prev_school').val();
        var prev_class = $('#prev_class').val();
        var prev_curriculum = $('#prev_curriculum').val();
        var prev_acdyr = $('#prev_acdyr').val();
        var prev_moi = $('#prev_moi').val();


        var temp_register_phase = new Object();
        temp_register_phase.firstname = firstname;
        temp_register_phase.middlename = middlename;
        temp_register_phase.lastname = lastname;
        temp_register_phase.gender = gender;
        temp_register_phase.country_selected = country_selected;
        temp_register_phase.nationality = nationality;
        temp_register_phase.state_selected = state_selected;
        temp_register_phase.district_selected = district_selected;
        temp_register_phase.dob = dob;
        temp_register_phase.age = age;
        temp_register_phase.religion_select = religion_select;
        temp_register_phase.caste_select = caste_select;
        temp_register_phase.community_select = community_select;
        temp_register_phase.blood_group = blood_group;
        temp_register_phase.pickup_point = pickup_point;
        temp_register_phase.mother_tongue = mother_tongue;
        temp_register_phase.language_data = language_select
        temp_register_phase.unique_identity = unique_identity;
        temp_register_phase.admission_date = admission_date;
        temp_register_phase.acd_year_id = acd_year_id;
        temp_register_phase.stream = stream;
        temp_register_phase.course_id = course_id;
        temp_register_phase.course_master_id = course_master_id;
        temp_register_phase.optional_sub1 = optional_sub1;
        temp_register_phase.optional_sub2 = optional_sub2;
        temp_register_phase.birth_country = birth_country;
        temp_register_phase.birth_place = birth_place;
        temp_register_phase.birth_state = birth_state;
        temp_register_phase.birth_district = birth_district;
        temp_register_phase.entrance_date = entrance_date;
        temp_register_phase.admn_type = admn_type;
        temp_register_phase.ad_type_text = ad_type_text;
        if ($.trim(admission_no).length > 0 && admission_no != 'Auto') {
            temp_register_phase.admission_no = admission_no;
        }
        temp_register_phase.fname = fname;
        temp_register_phase.freltype = freltype;
        temp_register_phase.fprofession = fprofession_selected;
        temp_register_phase.cadd1 = fcadd1;
        temp_register_phase.cadd2 = fcadd2;
        temp_register_phase.cadd3 = fcadd3;
        temp_register_phase.czip = fczip;
        temp_register_phase.cphone = fcphone;
        temp_register_phase.cmobile = fcmobile;
        temp_register_phase.cmail = fcmail;
        temp_register_phase.oadd1 = fpadd1;
        temp_register_phase.oadd2 = fpadd2;
        temp_register_phase.oadd3 = fpadd3;
        temp_register_phase.ozip = fpzip;
        temp_register_phase.ophone = fpphone;
        temp_register_phase.omobile = fpmobile;
        temp_register_phase.omail = fpmail;
        temp_register_phase.ofadd1 = foadd1;
        temp_register_phase.ofadd2 = foadd2;
        temp_register_phase.ofadd3 = foadd3;
        temp_register_phase.ofzip = fozip;
        temp_register_phase.ofphone = fophone;
        temp_register_phase.ofmobile = fomobile;
        temp_register_phase.ofmail = fomail;


        temp_register_phase.stud_passport = stud_passport;
        temp_register_phase.stud_placeofissue = stud_placeofissue;
        temp_register_phase.f_qualification = f_qualification;
        temp_register_phase.f_nationality = f_nationality;
        temp_register_phase.f_passport = f_passport;
        temp_register_phase.f_emirate_id = f_emirate_id;
        temp_register_phase.m_name = m_name;
        temp_register_phase.m_profession = m_profession;
        temp_register_phase.m_qualification = m_qualification;
        temp_register_phase.daughter_count = daughter_count;
        temp_register_phase.son_count = son_count;
        temp_register_phase.sibling_count = sibling_count;
        temp_register_phase.prev_school = prev_school;
        temp_register_phase.prev_class = prev_class;
        temp_register_phase.prev_curriculum = prev_curriculum;
        temp_register_phase.prev_acdyr = prev_acdyr;
        temp_register_phase.prev_moi = prev_moi;

        var temp_register_sibling_data = new Object();
        var sibling_data;
        if (admn_type == 'Sibling') {
            var k = 0;
            for (var i = 1; i <= 5; i++) {
                if ($('#sib_name_' + i).val() != '') {
                    temp_register_sibling_data[k] = new Object();
                    temp_register_sibling_data[k].sib_rel = $('#sib_rel_' + i).val();
                    temp_register_sibling_data[k].sib_admn = $('#sib_admn_' + i).val();
                    temp_register_sibling_data[k].sib_name = $('#sib_name_' + i).val();
                    temp_register_sibling_data[k].sib_class = $('#sib_class_' + i).val();
                    k++;
                }
            }
            sibling_data = JSON.stringify(temp_register_sibling_data);
        }

        //console.log(sibling_data);
        temp_register_phase.siblings_details = sibling_data;

        var flag = 0;
        var update_profile = 0;
        var student_id = $('#studentid').val();
        if (student_id > 0) {
            update_profile = 1;
        }
        var studentdata = JSON.stringify(temp_register_phase);
        //console.log(temp_register_phase, studentdata);
        var ops_url = baseurl + 'online_registration/save-student-temporary-reg';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "update_profile": update_profile,
                "studentid": student_id,
                "studentdata": studentdata,
                "flag": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {

                    $('#admission_number_new').val(data.studentid);
                    flag = 1;
                } else {
                    if (data.message) {
                        swal('', data.message, 'info')
                    }
                    flag = 0;
                }
            },
            error: function() {
                flag = 0;
            }
        });
        $('#otp_verification').val('');
        return flag === 1;

    }

    function ResendOTP() {
        $('#dataviewverification').show();
        var commun_mail = $('#email_val_verify').val();
        var TempregId = $('#studentid').val();
        if (commun_mail != '') {
            ops_url = baseurl + 'online-registration/Send-email';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "commun_mail": commun_mail,
                    "TempregId": TempregId
                },
                success: function(result) {
                    if (result != 0) {
                        $('#otp_verification').val('');
                        $('#verify_well').html('Your one time verification code is resend to your communication email ' + commun_mail);
                    } else {
                        $('#verify_well').html('<b style="color:red">Your one time verification code sending failed. Please check your Communication Email/Internet Connection </b>');
                    }
                }
            });
        }
    }

    function set_values_for_update(data) {
        $('#dataviewverification').show();
        var commun_mail = data.L_mail;
        var TempregId = data.TempReg_ID;
        if (commun_mail != '') {
            ops_url = baseurl + 'online-registration/Send-email';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "commun_mail": commun_mail,
                    "TempregId": TempregId
                },
                success: function(result) {
                    if (result != 0) {
                        $('#verify_well').html('Your one time verification code is send to your communication <b>email</b>  ' + commun_mail);
                    } else {
                        $('#verify_well').html('<b style="color:red">Your one time verification code sending failed. Please check your Communication Email/Internet Connection </b>');
                    }
                }
            });
        }

        console.log(data);
        $('#firstName').html(data.fname);
        if (data.mname != '') {
            $('#middleName').html(data.mname);
        } else {
            $('#middleName').html('-');
        }

        $('#lastName').html(data.lname);
        $('#gendeR').html(data.gender);
        $('#country_selecT').html(data.country_name);
        $('#nationalitY').html(data.nationality);
        $('#state_selecT').html(data.state_name);
        $('#district_selecT').html(data.city_name);
        $('#dob_datE').html(data.dob);
        $('#agE').html(data.age);
        $('#religion_selecT').html(data.religion_name);
        $('#caste_selecT').html(data.caste_name);
        $('#community_selecT').html(data.community_name);
        $('#bloodGroup').html(data.blood_group);
        if (data.pickpointName != '' && data.pickpointName != null) {
            $('#pickupPOINT').html(data.pickpointName);
        } else {
            $('#pickupPOINT').html('-');
        }
        $('#mother_tonguE').html(data.mothertongue);
        $('#language_selecT').html(data.optionallanguage);
        if (data.emirate_Id != '' && data.emirate_Id != null) {
            $('#unique_identitY').html(data.emirate_Id);
        } else {
            $('#unique_identitY').html('-');
        }

        $('#studentid').html(data.TempReg_ID);
        $('#studentid').val(data.TempReg_ID);
        $('#admission_nO').html(data.TempAdmn_No);
        $("#view_entrance_date").html(data.entrance_date);
        $('#academic_yeaR').html(data.acdyr);
        $('#stream_iD').html(data.stream_code);
        $('#class_detailS').html(data.class);
        if (data.mand_optional_subjects != '') {
            $('#subjects_list').show();
            $("#mand_subjects").html('');
            $.each(data.mand_optional_subjects.mandatory_subject, function(i, v) {
                console.log(v);
                if (i == 0) {
                    $("#mand_subjects").append(v);
                } else {
                    $("#mand_subjects").append(" , " + v);
                }

            });

            $('#opt_sub_1').html(data.Optional_subject_1);
            $('#opt_sub_2').html(data.Optional_subject_2);

        } else {
            $('#subjects_list').hide();
            $('#mand_subjects').html('');
            $('#opt_sub_1').html('');
            $('#opt_sub_2').html('');
        }

        $('#birth_countrY').html(data.birthCountry);
        $('#birth_placE').html(data.birthPlace);
        $('#birth_state_view').html(data.birth_state);
        $('#birth_district_view').html(data.birth_district);
        $('#fnamE').html(data.parentName);
        if (data.parentRelation == 'F') {
            var parentRelation = 'Father';
        } else if (data.parentRelation == 'M') {
            var parentRelation = 'Mother';
        } else {
            var parentRelation = 'Guardian';
        }
        $('#reltypE').html(parentRelation);
        if (data.type_data != '') {
            $('#admType').html(data.admn_type + ' (' + data.type_data + ')');
        } else {
            $('#admType').html(data.admn_type);
        }

        $('#admission_datE').html(data.applicationDate)
        $('#fprofessioN').html(data.profession_name);
        $('#fadD1').html(data.formatted_address.communication_address_string);
        //$('#fadD2').html(data.L_Address2);
        //$('#fadD3').html(data.L_Address3);
        $('#fziP').html(data.L_zip);
        $('#fphonE').html(data.L_phone);
        $('#fmobilE').html(data.L_mobile);
        $('#fmaiL').html(data.L_mail);
        $('#f_c_email').html(data.L_mail);
        $('#email_val_verify').val(data.L_mail);
        $('#fcadD1').html(data.formatted_address.permanent_address_string);
        //$('#fcadD2').html(data.O_Address2);
        //$('#fcadD3').html(data.O_Address3);
        $('#fczIP').html(data.O_zip);
        $('#fcphonE').html(data.O_phone);
        $('#fcmobilE').html(data.O_mobile);
        $('#fcmaiL').html(data.O_mail);
        $('#ofcadD1').html(data.formatted_address.office_address_string);

        //$('#ofcadD2').html(data.Of_Address2);
        //$('#ofcadD3').html(data.Of_Address3);
        $('#ofczIP').html(data.Of_zip);
        $('#ofcphonE').html(data.Of_phone);
        $('#ofcmobilE').html(data.Of_mobile);
        $('#ofcmaiL').html(data.Of_mail);
        if (data.admn_type == 'Sibling') {
            if (data.siblings_details.length > 0) {
                var k = 1;
                var batch;
                $('#siblingList').html('');
                $.each(data.siblings_details, function(i, v) {
                    if (v.Batch_Name == null) {
                        batch = 'Batch not allotted';
                    } else {
                        batch = v.Batch_Name;
                    }
                    $('#siblingList').append('<tr><td>' + k + '. ' + v.Admn_No + ', <b>' + v.student_name + '</b> - ' + batch + '</td></tr>');
                    k++;
                });
            }

        }
        $('#stud_passport_view').html(data.stud_passport)
        $('#stud_placeofissue_view').html(data.stud_placeofissue)
        $('#f_qualification_view').html(data.f_qualification)
        $('#f_nationality_view').html(data.f_nationality)
        $('#f_passport_view').html(data.f_passport)
        $('#f_emirate_id_view').html(data.f_emirate_id)
        $('#m_name_view').html(data.m_name)
        $('#m_profession_view').html(data.mother_profession)
        $('#m_qualification_view').html(data.m_qualification)
        $('#daughter_count_view').html(data.daughter_count)
        $('#son_count_view').html(data.son_count)
        $('#sibling_count_view').html(data.sibling_count)
        $('#prev_school_view').html(data.prev_school)
        $('#prev_class_view').html(data.prev_class)
        $('#prev_curriculum_view').html(data.prev_curriculum)
        $('#prev_acdyr_view').html(data.prev_acdyr)
        $('#prev_moi_view').html(data.prev_moi)

    }

    function sendTempRegEmail(admn_no) {
        //$('#myNav').width("100%");
        var CommuEmail = $('#email_val_verify').val();
        var agelimit = moment($('#agelimit').val(), "DD-MM-YYYY").format('DD-MM-YYYY');
        var lastsubmissiondate = $('#lastsubmissiondate').val();
        var age = getAge(moment($("#dob_date").datepicker("getDate")).format('YYYY-MM-DD'));
        var flag = 0;
        var resflag = 0;
        var ops_url = baseurl + 'online_registration/select-student-temporary-reg';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "admn": admn_no
            },
            success: function(result) {
                var res = JSON.parse(result);
                if (res.status == 1) {
                    $('#token_number_new').val(res.data.TempAdmn_No);
                    var ops_url = baseurl + 'online_registration/sent-Email-TempData';
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "load": 1,
                            "tempregdata": res.data,
                            "CommuEmail": CommuEmail,
                            "agelimit": agelimit,
                            "lastsubmissiondate": lastsubmissiondate,
                            "agestr": age.agestr
                        },
                        success: function(result) {
                            // if (result == 200) {
                            //     resflag = 1;
                            // }
                            resflag = result;
                        }
                    });
                }

            }
        });
        return resflag;
    }

    function caste_change() {
        var community_id = $("#caste_select :selected").data("communityselect");
        $('#community_select').val(community_id);
        $('#community_select').trigger('change');
    }

    function change_class_for_reg() {
        var batchid = '#class_details';
        var age = $('#age').attr('data-val');
        var ops_url = baseurl + 'online_registration/get-classs-with-age-restriction/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "age": age
            },
            success: function(result) {
                $(batchid).empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batch_data = data.data;
                    $.each(batch_data, function(i, v) {
                        $(batchid).append("<option value='" + v.Course_Det_ID + "' data-masterid='" + v.Course_Master_ID + "' >" + v.Description + "</option>");
                    });
                    $(batchid).trigger('change');
                } else {
                    $(batchid).empty().trigger("change");
                    $(batchid).append("<option value='-1' selected>Select</option>");
                    $(batchid).trigger('change');
                }
                $('#registration_loader').removeClass('sk-loading');
            }
        });


    }

    function admission_type() {
        var inst_id = $('#inst_id').val();
        $('#emp_inst_id').val(-1);
        $('#emp_inst_id').trigger('change');
        cleardata();
        if (inst_id != 2) {
            var admission_type = $('#admn_type').val();


            if (admission_type == 'Staff') {
                $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(1)").addClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(2)>a").removeAttr("href");
                $(".actions ul li:nth-child(1)>a").removeAttr("href");
                $('#adType').text('Employee Code *');
                $('#admn_info').html('(Format - Employee Code : EMP/000111)<br/>');
                $('#ad_type_text').attr("placeholder", "Employee Code");
                $('#ad_type_text').val('');
                $('#hide_show_admn').show();
                $('#institutiondiv').show();
            } else if (admission_type == 'Sibling') {
                $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(1)").addClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(2)>a").removeAttr("href");
                $(".actions ul li:nth-child(1)>a").removeAttr("href");
                $('#adType').text('Admission Number *');
                $('#admn_info').html('(Format - Admn.No : 01234/14)<br/>');
                $('#ad_type_text').attr("placeholder", "Admission Number");
                $('#ad_type_text').val('');
                $('#hide_show_admn').show();
                $('#institutiondiv').hide();

            } else {
                $(".actions ul li:nth-child(2)").removeClass("disabled").attr("aria-disabled", "false");
                $(".actions ul li:nth-child(1)").removeClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(2)>a").attr("href", "#next");
                $(".actions ul li:nth-child(1)>a").attr("href", "#previous");
                $('#ad_type_text').val('');
                $('#hide_show_admn').hide();
                $('#institutiondiv').hide();
                $('#otpdiv').hide();
            }
            $('#siblings_list').hide();
        } else {
            var admission_type = $('#admn_type').val();
            if (admission_type == 'Staff') {
                $('#adType').text('Employee Code *');
                $('#admn_info').text('(Format - Employee Code : EMP/000111)');
                $('#ad_type_text').attr("placeholder", "Employee Code");
                $('#ad_type_text').val('');
                $('#hide_show_admn').show();
                $('#institutiondiv').show();
                $('#siblings_list').hide();
                $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(1)").addClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(2)>a").removeAttr("href");
                $(".actions ul li:nth-child(1)>a").removeAttr("href");
            } else if (admission_type == 'Sibling') {
                $('#siblings_list').show();
                $('#hide_show_admn').hide();
                $('#ad_type_text').val('');
                $('#institutiondiv').hide();
                $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(1)").addClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(2)>a").removeAttr("href");
                $(".actions ul li:nth-child(1)>a").removeAttr("href");

            } else {
                $(".actions ul li:nth-child(2)").removeClass("disabled").attr("aria-disabled", "false");
                $(".actions ul li:nth-child(1)").removeClass("disabled").attr("aria-disabled", "true");
                $(".actions ul li:nth-child(2)>a").attr("href", "#next");
                $(".actions ul li:nth-child(1)>a").attr("href", "#previous");
                $('#ad_type_text').val('');
                $('#hide_show_admn').hide();
                $('#siblings_list').hide();
                $('#institutiondiv').hide();
            }
        }



    }

    function cleardata() {
        $('#fname').val('');
        $('#fname').prop('disabled', false);

        $('#reltype').val('F');
        $('#reltype').trigger('change');
        $("#reltype").prop('disabled', false);

        $('#fprofession').val(-1);
        $('#fprofession').trigger('change');
        $("#fprofession").prop('disabled', false);

        $('#fadd1').val('');
        $('#fadd1').prop('disabled', false);

        $('#fadd2').val('');
        $('#fadd2').prop('disabled', false);

        $('#fadd3').val('');
        $('#fadd3').prop('disabled', false);

        $('#fzip').val('');
        $('#fzip').prop('disabled', false);

        $('#fphone').val('');
        $('#fphone').prop('disabled', false);

        $('#fmobile').val('');
        $('#fmobile').prop('disabled', false);

        $('#fmail').val('');
        $('#fmail').prop('disabled', false);

        $('#foadd1').val('');
        $('#foadd1').prop('disabled', false);

        $('#foadd2').val('');
        $('#foadd2').prop('disabled', false);

        $('#foadd3').val('');
        $('#foadd3').prop('disabled', false);

        $('#fozip').val('');
        $('#fozip').prop('disabled', false);

        $('#fophone').val('');
        $('#fophone').prop('disabled', false);

        $('#fomobile').val('');
        $('#fomobile').prop('disabled', false);

        $('#fomail').val('');
        $('#fomail').prop('disabled', false);

        $('#fcadd1').val('');
        $('#fcadd1').prop('disabled', false);

        $('#fcadd2').val('');
        $('#fcadd2').prop('disabled', false);

        $('#fcadd3').val('');
        $('#fcadd3').prop('disabled', false);

        $('#fczip').val('');
        $('#fczip').prop('disabled', false);

        $('#fcphone').val('');
        $('#fcphone').prop('disabled', false);

        $('#fcmobile').val('');
        $('#fcmobile').prop('disabled', false);

        $('#fcmail').val('');
        $('#fcmail').prop('disabled', false);


    }

    function sendOTP() {
        var OTPval = $('#otp_verification').val();
        var email_val_verify = $('#email_val_verify').val();
        var flag = 0;
        if (OTPval == '') {
            $('#otp_error').text('Enter OTP');
            return flag;
        } else {
            var ops_url = baseurl + 'online-registration/select-OTP/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "email": email_val_verify,
                    "OTP": OTPval
                },
                success: function(result) {
                    var res = JSON.parse(result);
                    if (res.status == 1) {
                        var dcount = res.data;
                        if (dcount.OTP == OTPval) {
                            if (dcount.status == 1) {
                                flag = 1;
                                $('#otp_error').text('');
                            } else {
                                flag = 2; //Failed to update
                            }

                        } else {
                            flag = 0;
                        }
                    } else {
                        flag = 0;
                    }

                }
            });
            return flag;

        }
    }

    function getentrancedate(class_id) {
        if (class_id == 154 || class_id == 160 || class_id == 164 || class_id == 180 || class_id == 181 || class_id == 182) {
            getmandatory_subjects(class_id);
        } else {
            $("#optional_subject_div1").hide();
            $("#optional_subject_div2").hide();
            $("#mandatory_subjects").hide();
        }
        var inst_id = $('#inst_id').val();
        var ops_url = baseurl + 'online_registration/get-entrance-date';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "inst_id": inst_id,
                "class_id": class_id
            },
            success: function(result) {
                $('#entrance_date').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var entrance_dates = data.data;
                    $.each(entrance_dates, function(i, v) {
                        var formated_date = moment(v.entrance_date, 'YYYY-MM-DD').format('DD-MM-YYYY');
                        $("#entrance_date").append("<option value='" + formated_date + "'  >" + formated_date + "</option>");
                    });
                    $("#entrance_date").trigger('change');
                    $("#entrance_date_div").show();
                } else {
                    $("#entrance_date_div").hide();
                    $("#entrance_date").empty().trigger("change");

                }
            }
        });
    }

    function getmandatory_subjects(class_id) {
        var inst_id = $('#inst_id').val();
        var ops_url = baseurl + 'online_registration/get-mandatory-subjects';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "inst_id": inst_id,
                "class_id": class_id
            },
            success: function(result) {
                $('#entrance_date').empty().trigger("change");
                var data = JSON.parse(result);
                console.log(result);
                if (data.status == 1) {
                    // $("#mandatory_subjects").show();
                    // $("#optional_subject1").show();
                    // $("#mandatory_sub").html(data.data);
                    var optional_sub1 = data.data.optional_subjects_1;
                    var optional_sub2 = data.data.optional_subjects_2;
                    var mandatory_sub = data.data.mandatory_subject;
                    $("#optional_subject1").html('');
                    $("#optional_subject2").html('');
                    $("#mandatory_sub").html('');

                    $.each(optional_sub1, function(i, v) {
                        console.log(v);
                        $("#optional_subject1").append("<option value='" + v + "'  >" + v + "</option>");
                    });
                    $.each(optional_sub2, function(i, v) {
                        console.log(v);
                        $("#optional_subject2").append("<option value='" + v + "'  >" + v + "</option>");
                    });
                    $.each(mandatory_sub, function(i, v) {
                        console.log(v);
                        if (i == 0) {
                            $("#mandatory_sub").append(v);
                        } else {
                            $("#mandatory_sub").append(" , " + v);
                        }

                    });

                    $("#optional_subject1").trigger('change');
                    $("#optional_subject2").trigger('change');
                    if (optional_sub1 != '') {
                        $("#optional_subject_div1").show();
                    } else {
                        $("#optional_subject_div1").hide();
                    }
                    if (optional_sub2 != '') {
                        $("#optional_subject_div2").show();
                    } else {
                        $("#optional_subject_div2").hide();
                    }
                    $("#mandatory_subjects").show();


                } else {
                    // $("#mandatory_subjects").hide();
                    // $("#optional_subject1").empty().trigger("change");

                }
            }
        });
    }

    $(document).ready(function() {


        $(".select2_registration").select2({
            "theme": "bootstrap",
            "width": "100%"
        });

        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $('#hide_show_admn').hide();
        $('#institutiondiv').hide();
        $('#otpdiv').hide();
        $('#otphiddenval').val('');
        $('#dataviewverification').hide();
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );
        /* Author :docme
         * Date 07/10/2017
         * Purpose : Address fill when same as checkbox is selected */
        // $('input, select').change(function() {
        //     $(this).focusout();
        // });
        $('#father_check').click(function() {

            if ($("#father_check").prop("checked") == true) {
                //                alert("Checkbox is checked.");
                var fcadd1 = $('#fadd1').val();
                var fcadd2 = $('#fadd2').val();
                var fcadd3 = $('#fadd3').val();
                var fczip = $('#fzip').val();
                var fcphone = $('#fphone').val();
                var fcmobile = $('#fmobile').val();
                var fcmail = $('#fmail').val();
                $("#fcadd1").val(fcadd1).focusout();
                $("#fcadd2").val(fcadd2).focusout();
                $("#fcadd3").val(fcadd3).focusout();
                $("#fczip").val(fczip).focusout();
                $("#fcphone").val(fcphone).focusout();
                $("#fcmobile").val(fcmobile).focusout();
                $("#fcmail").val(fcmail).focusout();
                $("#fcmail").focusout();
                $("#fcmobile").focusout();
            } else if ($("#father_check").prop("checked") == false) {
                $("#fcadd1").val("").focusout();
                $("#fcadd2").val("").focusout();
                $("#fcadd3").val("").focusout();
                $("#fczip").val("").focusout();
                $("#fcphone").val("").focusout();
                $("#fcmobile").val("").focusout();
                $("#fcmail").val("").focusout();
            }
            $("#fcmobile").focusout();
        });

        // $(".select2-selection").on("focus", function() {
        //     $(this).parent().parent().prev().select2("open");
        // });

        /*$('#language_select').select2({
            placeholder: 'Select language',
            "width": "100%"
        }).on('mouseup', function(e) {
            e.preventDefault();
            // i also tried return false but nothing happen.
        });*/
    });

    $("select").on("select2:close", function(e) {
        $(this).valid();
    });


    changed_country();
    birth_changed_country();

    $(document).on("keypress", "#ad_type_text", function(e) {
        $('#admn_error_info').text("");
    });
</script>