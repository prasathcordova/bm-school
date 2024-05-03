<?php $this->session->unset_userdata('otp'); ?>
<fieldset>
    <form action="#" id="academic_profile">
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label>Temporary Admission No.</label>
                    <!--title changed by Elavarasan 08-05-2019 2:23-->
                    <input id="name" placeholder="Auto" readonly="" name="admission_no" type="text" title="Temporary Admission No. will be auto-generated" class="form-control" id="admn_no" name="admission_no">
                </div>
            </div>
            <div class="form-group col-lg-4 col-xs-12 col-md-12">
                <div class="form-group" id="data_1">
                    <label class="font-noraml"> Date of Application</label><span class="mandatory"> *</span>
                    <!--div class="input-group date" style="width:100%">
                                                        <<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
                    <input type="hidden" class="form-control" id="admission_date" name="admission_date" value="<?php echo date('Y-m-d'); ?>">
                    <input type="text" class="form-control" id="admission_date_1" name="admission_date_1" value="<?php echo date('d-m-Y'); ?>" readonly="readonly">
                    <!--/div-->
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label>Academic Year</label><span class="mandatory"> *</span>
                    <select class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%">
                        <?php
                        if (isset($acdyr_data) && !empty($acdyr_data)) {
                            foreach ($acdyr_data as $acd) {

                                if (isset($acd['Acd_ID']) && !empty($acd['Acd_ID']) && $this->session->userdata('acd_year') == $acd['Acd_ID']) {
                                    echo '<option selected value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                } else {
                                    echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                }
                                //                                                            echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                            }
                            //                                                            echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                        }
                        //}
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-6 col-md-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Syllabus</label><span class="mandatory"> *</span>
                            <select class="select2_registration form-control" id="stream_id" name="stream_id">
                                <?php
                                if (isset($stream_data) && !empty($stream_data)) {
                                    foreach ($stream_data as $stream) {
                                        if (isset($stream['stream_id']) && !empty($stream['stream_id']) && 1 == $stream['stream_id']) {
                                            echo '<option selected value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                        } else {
                                            echo '<option value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12" id="mandatory_subjects" style="display: none;">
                        <div class="form-group" style="margin-bottom: 49px;">
                            <label>Mandatory Subjects</label>
                            <div class="col-md-12" style="margin-left: -15px;">
                                <span id="mandatory_sub"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Birth Country</label><span class="mandatory"> *</span>
                            <!--<input  placeholder="Enter Birth Country" type="text" class="form-control" maxlength="30" id="birth_country" name="birth_country" />-->
                            <select name="birth_country" id="birth_country" required="" class="form-control select2_registration" style="width:100%;" onchange="birth_changed_country();">
                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($country_data) && !empty($country_data)) {
                                    foreach ($country_data as $country) {
                                        if ($country['country_id'] == 2) {
                                            echo '<option selected data-sel-id="' . $country['country_id'] . '" value ="' . $country['country_name'] . '" >' . $country['country_name'] . '</option>';
                                        } else {
                                            echo '<option data-sel-id="' . $country['country_id'] . '" value ="' . $country['country_name'] . '" >' . $country['country_name'] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Birth District</label>
                            <select name="birth_district" id="birth_district" class="form-control select2_registration" style="width:100%;">
                                <option selected value="">Select</option>
                                <?php
                                if (isset($city_data) && !empty($city_data)) {
                                    foreach ($city_data as $district) {
                                        echo '<option  value ="' . $district['city_name'] . '" >' . $district['city_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6 col-md-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> Class</label><span class="mandatory"> *</span>
                            <select class="select2_registration form-control" id="class_details" name="class_details" onchange="getentrancedate(this.value)">
                                <?php
                                //                                                            if (isset($class_data_for_registration) && !empty($class_data_for_registration)) {
                                //                                                                 foreach ($class_data_for_registration as $class_for_dive) {
                                //
                                //                                                                    echo '<option value="' . $class_for_dive['Course_Det_ID'] . '" data-masterid="' . $class_for_dive['Course_Master_ID'] . '"  >' . $class_for_dive['Description'] . '</option>';
                                //                                                                }
                                //                                                            }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6" id="optional_subject_div1" style="display: none;">
                        <div class="form-group ">
                            <label>Optional Subject 1 *</label>
                            <select name="optional_subject1" id="optional_subject1" class="form-control select2_registration" style="width:100%;">
                                <option value="">Select</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6" id="optional_subject_div2" style="display: none;">
                        <div class="form-group ">
                            <label>Optional Subject 2 *</label>
                            <select name="optional_subject2" id="optional_subject2" class="form-control select2_registration" style="width:100%;">
                                <option value="">Select</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group ">
                            <label>Birth State/Emirate</label>
                            <select name="birth_state" id="birth_state" class="form-control select2_registration" style="width:100%;" onchange="birth_changed_state();">
                                <option value="">Select</option>
                                <?php
                                if (isset($state_data) && !empty($state_data)) {
                                    foreach ($state_data as $state) {
                                        echo '<option data-sel-id="' . $state['state_id'] . '" value ="' . $state['state_name'] . '" >' . $state['state_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Birth Place</label><span class="mandatory"> *</span>
                            <input placeholder="Enter Birth Place" type="text" class="form-control" maxlength="30" id="birth_place" name="birth_place" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6 col-xs-12 col-md-12" id="entrance_date_div" style="display:none">
                <label>Entrance Date</label>
                <select name="entrance_date" id="entrance_date" class="form-control select2_registration" style="width:100%;">
                    <option selected value="-1">Select</option>
                    <?php
                    if (isset($entrance_date) && !empty($entrance_date)) {
                        foreach ($entrance_date as $etdate) {

                            echo '<option value ="' . $etdate['id'] . '" >' . $etdate['date'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                <label>Admission Type</label><span class="mandatory"> *</span>
                <select name="admn_type" id="admn_type" required="" class="form-control select2_registration" style="width:100%;" onchange="admission_type();">
                    <option value="-1">Select</option>
                    <option selected value="General">General</option>
                    <option value="Staff">Staff</option>
                    <option value="Sibling">Sibling</option>

                </select>

            </div>
            <div class="form-group col-lg-6 col-xs-12 col-md-12" id='institutiondiv'>
                <label>Institution </label><br>
                <select name="emp_inst_id" id="emp_inst_id" class="form-control select2_registration" style="width:100%;">
                    <option selected value="-1">Select</option>
                    <?php
                    if (isset($institution_list_data) && !empty($institution_list_data)) {
                        foreach ($institution_list_data as $inst_data) {
                            echo '<option value ="' . $inst_data['inst_id'] . '" >' . $inst_data['inst_name'] . ' - ' . $inst_data['inst_place'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-lg-6 col-xs-12 col-md-12" id='hide_show_admn'>
                <label id='adType'></label>
                <input placeholder="" type="text" class="form-control" maxlength="10" id="ad_type_text" name="ad_type_text" onBlur="sendotp();" />
                <span id='admn_info'></span>
                <span id='admn_error_info' style="color:#8a1f11;font-weight:bold"></span>
                <input type="hidden" class="form-control" id="otphiddenval" value="" />
            </div>

            <div class="form-group col-lg-6 col-xs-12 col-md-12" id='otpdiv'>
                <label>Enter OTP : </label>
                <input placeholder="" type="text" class="form-control" maxlength="10" id="parentotp" name="parentotp" onBlur="checkOTP();" />
                <a href='javascript:void(0)' onclick='sendotp()'>Resend OTP</a>
                <span id="otp_msg"></span>
            </div>

        </div>
        <div class="row" id="siblings_list" style="display:none">
            <h3 style="margin-left: 15px;">Details of Brother/Sister Studying in this school(if any)</h3>
            <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="row" style="margin-right:0px;margin-left:0px">
                    <!--- Sibling  Start ---->
                    <div class="col-lg-12">
                        <?php if ($i == 1) { ?>
                            <span id="sibling_error" style="color:#8a1f11;font-weight:bold"></span><br />
                        <?php } ?>
                        <span style="font-weight:bold;font-size:12px;text-decoration:underline">Sibling <?php echo $i ?></span>
                    </div>
                    <div class="form-group col-lg-3 col-xs-12 col-md-12">
                        <label>Relation</label>
                        <select name="sib_rel_<?php echo $i ?>" id="sib_rel_<?php echo $i ?>" class="form-control select2_registration" style="width:100%;">
                            <option selected="selected" value="">Select</option>
                            <option value="Brother">Brother</option>
                            <option value="Sister">Sister</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3 col-xs-12 col-md-12">
                        <label>Admission No.</label>
                        <input id="sib_admn_<?php echo $i ?>" name="sib_admn_<?php echo $i ?>" placeholder="Admission No." type="text" class="form-control" maxlength="8" />
                    </div>
                    <div class="form-group col-lg-3 col-xs-12 col-md-12">
                        <label>Name</label>
                        <input id="sib_name_<?php echo $i ?>" name="sib_name_<?php echo $i ?>" placeholder="Name" type="text" class="form-control sib_name" maxlength="25" />
                    </div>
                    <div class="form-group col-lg-3 col-xs-12 col-md-12">
                        <label>Class</label>
                        <select id="sib_class_<?php echo $i ?>" name="sib_class_<?php echo $i ?>" class="select2_registration form-control sib_class">
                            <option value="">Select</option>
                            <?php
                            if (isset($class_data_for_registration) && !empty($class_data_for_registration)) {
                                foreach ($class_data_for_registration as $class_for_dive) {

                                    echo '<option value="' . $class_for_dive['Description'] . '" >' . $class_for_dive['Description'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="sib_class_error" style="color:#8a1f11;font-weight:bold"></span>
                    </div>
                    <!---  Sibling  END ---->
                </div>
            <?php } ?>



        </div>
        <div class="row" style="<?php echo $shj_display ?>">
            <div class="col-lg-12">
                <h4>PREVIOUS SCHOOL DETAILS</h4>
                <hr>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="prev_school ">Name and Place of School</label>
                    <input type="text" maxlength="75" placeholder="Name and Place of School" id="prev_school" name="prev_school" class="form-control" style="<?php echo $shj_display ?>">
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="prev_class">Class</label>
                    <input type="text" maxlength="20" placeholder="Class" id="prev_class" name="prev_class" maxle class="form-control" style="<?php echo $shj_display ?>">
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="prev_curriculum">Curriculum</label>
                    <select class="select2_registration form-control" id="prev_curriculum" name="prev_curriculum" style="width: 100%">
                        <option value="">Select</option>
                        <option value="CBSE">CBSE</option>
                        <option value="KERALA BOARD">KERALA BOARD</option>
                        <option value="TAMIL NADU BOARD">TAMIL NADU BOARD</option>
                        <option value="OTHER INDIAN STATE BOARD">OTHER INDIAN STATE BOARD</option>
                        <option value="PAKISTAN BOARD">PAKISTAN BOARD</option>
                        <option value="BENGALI BOARD">BENGALI BOARD</option>
                        <option value="OTHER INTERNATIONAL BOARD">OTHER INTERNATIONAL BOARD</option>
                    </select>
                    <!-- <input type="text" maxlength="15" placeholder="Curriculum" id="prev_curriculum" name="prev_curriculum" class="form-control" style="<?php echo $shj_display ?>"> -->
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="prev_acdyr">Academic Year</label>
                    <select class="select2_registration form-control" id="prev_acdyr" name="prev_acdyr" style="width: 100%">
                        <option value="">Select</option>
                        <?php
                        if (isset($prev_acdyr_data) && !empty($prev_acdyr_data)) {
                            foreach ($prev_acdyr_data as $acd) {
                                echo '<option value="' . $acd['Description'] . '" >' . $acd['Description'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <!-- <input type="text" maxlength="10" placeholder="Academic Year" id="prev_acdyr" name="prev_acdyr" class="form-control" style=""> -->
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="prev_moi">Medium of Instruction</label>
                    <select class="select2_registration form-control" id="prev_moi" name="prev_moi" style="width: 100%">
                        <option value="">Select</option>
                        <option value="English">English</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Malayalam">Malayalam</option>
                        <option value="Tamil">Tamil</option>
                        <option value="Urdu">Urdu</option>
                        <option value="Bengali">Bengali</option>
                        <option value="Other">Other</option>
                    </select>
                    <!-- <input type="text" maxlength="10" placeholder="Medium of instruction" id="prev_moi" name="prev_moi" class="form-control" style=""> -->
                </div>
            </div>
        </div>



    </form>
</fieldset>
<script>
    var academic_profile_validator;
    academic_profile_validator = $('#academic_profile').validate({
        rules: {
            data_1: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            birth_country: {
                required: true,
                synchronousRemote: true
            },
            admission_date: {
                required: true
            },
            birth_place: {
                required: true,
                minlength: 3,
                //  regex: /^[a-zA-Z ]*$/,
                maxlength: 30,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            academic_year: {
                required: true,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'online-registration/validate-online-dropdowns/',
                    data: {
                        dropdown: function() {
                            return $('#academic_year').val();
                        }
                    }
                }
            },
            stream_id: {
                required: true,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'online-registration/validate-online-dropdowns/',
                    data: {
                        dropdown: function() {
                            return $('#stream_id').val();
                        }
                    }
                }
            },
            class_details: {
                required: true,
                synchronousRemote: true,
            },
            admn_type: {
                required: true,
                synchronousRemote: true,
            }
        },
        messages: {
            data_1: {
                required: "Select a Date"
            },
            admission_date: {
                required: "Select Admission Date ",
            },
            birth_country: {
                required: "Select Birth Country ",
                synchronousRemote: 'Select Birth Country'
            },
            birth_place: {
                required: "Enter Birth Place ",
                minlength: "Enter atleast three characters.",
                //  regex: "Enter valid Characters(Only alphabets and space)",
                maxlength: "Maximum Of 30 Characters Allowed"
            },
            class_details: {
                required: "Select Class",
                synchronousRemote: "Select Class"
            },
            admn_type: {
                required: "Select Admission Type",
                synchronousRemote: "Select Admission Type"
            }
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    function sendotp() {
        $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
        $(".actions ul li:nth-child(2)>a").removeAttr("href");
        $('#otphiddenval').val('');
        $('#admn_info').html('');
        var adtext = $('#ad_type_text').val();
        var adtype = $('#admn_type').val();
        var inst_id = $('#emp_inst_id').val();
        var admn_type = $('#admn_type').val();
        var addrflag = 10; //for address selection
        var otphiddenval = $('#otphiddenval').val();
        var flag = '';
        if (admn_type == 'Staff') {
            flag = 1;
        } else if (admn_type == 'Sibling') {
            flag = 0;

        } else {
            flag = '';
        }
        var ops_url = baseurl + 'online-registration/selectDetailsAndOTP';

        $('#otp_msg').html('');
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "adtext": adtext,
                "flag": flag,
                "inst_id": inst_id,
                "addrflag": addrflag

            },
            success: function(result) {

                var data = $.parseJSON(result);
                if (data.status == 1) {
                    var rawdata = data.data;
                    var communEmail;
                    communEmail = '';
                    $.each(rawdata, function(a, b) {
                        if (otphiddenval == '') {
                            if (b.EMail != '' && b.EMail != null) {
                                otphiddenval = 1;
                                communEmail = b.EMail;
                                $('#otphiddenval').val(1);
                            }
                        }
                    });
                    if (otphiddenval != 1) {
                        $('#admn_info').html('<label class="error">Email not found , Please contact school authority for updating email.</label>');
                        $('#otpdiv').hide();
                        $('#otp_msg').html('');
                    } else {
                        var ops_url = baseurl + 'online-registration/sendOTPParent';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            async: true,
                            url: ops_url,
                            data: {
                                "load": 1,
                                "communEmail": communEmail,
                                "admn_type": admn_type
                            },
                            success: function(result) {
                                if (result == 1) {
                                    $('#otpdiv').show();
                                    var sentmailid = EmailMask(communEmail); //for live
                                    //var sentmailid = communEmail;
                                    $('#admn_info').html('<span>OTP send to your email ' + sentmailid + '.</span>');
                                }
                            }
                        });
                    }

                } else {
                    if (flag == 1) {
                        $('#admn_info').html('<label class="error">Enter valid employee code.</label>');
                    } else if (flag == 0) {
                        $('#admn_info').html('<label class="error">Enter valid admission number.</label>');
                    } else {
                        $('#admn_info').html('<label class="error">Enter valid details.</label>');
                    }
                    $('#otpdiv').hide();
                    $('#otp_msg').html('');
                }
            }
        })

    }

    function EmailMask(myemailId) {
        var maskid = "";
        var prefix = myemailId.substring(0, myemailId.lastIndexOf("@"));
        var postfix = myemailId.substring(myemailId.lastIndexOf("@"));

        for (var i = 0; i < prefix.length; i++) {
            if (i == 0 || i == prefix.length - 1) { ////////
                maskid = maskid + prefix[i].toString();
            } else {
                maskid = maskid + "*";
            }
        }
        maskid = maskid + postfix;
        return maskid;
    }

    function checkOTP() {
        var adtext = $('#ad_type_text').val();
        var inst_id = $('#emp_inst_id').val();
        var admn_type = $('#admn_type').val();
        var flag = '';
        var addrflag = 0;
        var parentotp = $('#parentotp').val();
        $('#admn_info').html('');
        ops_url_new = baseurl + 'online-registration/checkotpsession';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url_new,
            data: {
                "load": 1,
                "parentotp": parentotp,
            },
            success: function(result) {
                if (result == 1) {
                    $('#otp_msg').html('<span>Your OTP verified successfully.Please continue your registration</span>');
                    $(".actions ul li:nth-child(2)").removeClass("disabled").attr("aria-disabled", "false");
                    $(".actions ul li:nth-child(2)>a").attr("href", "#next");
                    $(".actions ul li:nth-child(1)>a").attr("href", "#previous");
                    if (admn_type == 'Staff') {
                        flag = 1;
                    } else if (admn_type == 'Sibling') {
                        flag = 0;
                    } else {
                        flag = '';
                    }
                    var ops_url = baseurl + 'online-registration/selectDetailsAndOTP';
                    $('#otpdiv').show();
                    $('#otp_msg').html('');
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "load": 1,
                            "adtext": adtext,
                            "flag": flag,
                            "inst_id": inst_id,
                            "addrflag": addrflag
                        },
                        success: function(result) {
                            var data = $.parseJSON(result);
                            if (data.status == 1) {
                                var FC_address = '';
                                var FP_address = '';
                                var rawdata = data.data;
                                console.log(rawdata);
                                $.each(rawdata, function(a, b) {
                                    $('#parent_id').val(b.Parent_Id);
                                    $('#fname').val(b.Emp_Name);
                                    $('#fname').prop('disabled', true);
                                    if (b.Gender == 'M') {
                                        $("#reltype").val('F');
                                        $('#reltype').trigger('change');
                                    } else {
                                        $("#reltype").val('M');
                                        $('#reltype').trigger('change');
                                    }
                                    $("#reltype").prop('disabled', true);
                                    //$('#reltype').trigger('change');
                                    if (admn_type == 'Staff') {
                                        $("#fprofession").val(164);
                                    } else if (admn_type == 'Sibling') {
                                        $("#fprofession").val(b.profession_id);
                                    }

                                    $('#fprofession').trigger('change');
                                    $("#fprofession").prop('disabled', true);
                                    //$('#fprofession').trigger('change');

                                    if (b.Add_Type == 'C' || b.Add_Type == 1) {
                                        if (b.Add1 != '') {
                                            $('#fadd1').val(b.Add1);
                                            $('#fadd1').prop('disabled', true);
                                        } else {
                                            $('#fadd1').prop('disabled', false);
                                        }
                                        if (b.Add2 != '') {
                                            $('#fadd2').val(b.Add2);
                                            $('#fadd2').prop('disabled', true);
                                        } else {
                                            $('#fadd2').prop('disabled', false);
                                        }
                                        if (b.Add3 != '') {
                                            $('#fadd3').val(b.Add3);
                                            $('#fadd3').prop('disabled', true);
                                        } else {
                                            $('#fadd3').prop('disabled', false);
                                        }
                                        if (b.PBNo != '') {
                                            $('#fzip').val(b.PBNo);
                                            $('#fzip').prop('disabled', true);
                                        } else {
                                            $('#fzip').prop('disabled', false);
                                        }
                                        if (b.Phone != '') {
                                            $('#fphone').val(b.Phone);
                                            $('#fphone').prop('disabled', true);
                                        } else {
                                            $('#fphone').prop('disabled', false);
                                        }
                                        if (b.Mobile != '') {
                                            $('#fmobile').val(b.Mobile);
                                            $('#fmobile').prop('disabled', true);
                                        } else {
                                            $('#fmobile').prop('disabled', false);
                                        }
                                        if (b.EMail != '') {
                                            $('#fmail').val(b.EMail);
                                            $('#fmail').prop('disabled', true);
                                        } else {
                                            $('#fmail').prop('disabled', false);
                                        }

                                        FC_address = b.Add1 + b.Add2 + b.Add3 + b.PBNo + b.Phone + b.Mobile + b.EMail;
                                    }
                                    if (b.Add_Type == 'P' || b.Add_Type == 3) {
                                        if (b.Add1 != '') {
                                            $('#fcadd1').val(b.Add1);
                                            $('#fcadd1').prop('disabled', true);
                                        } else {
                                            $('#fcadd1').prop('disabled', false);
                                        }
                                        if (b.Add2 != '') {
                                            $('#fcadd2').val(b.Add2);
                                            $('#fcadd2').prop('disabled', true);
                                        } else {
                                            $('#fcadd2').prop('disabled', false);
                                        }
                                        if (b.Add3 != '') {
                                            $('#fcadd3').val(b.Add3);
                                            $('#fcadd3').prop('disabled', true);
                                        } else {
                                            $('#fcadd3').prop('disabled', false);
                                        }
                                        if (b.PBNo != '') {
                                            $('#fczip').val(b.PBNo);
                                            $('#fczip').prop('disabled', true);
                                        } else {
                                            $('#fczip').prop('disabled', false);
                                        }
                                        if (b.Phone != '') {
                                            $('#fcphone').val(b.Phone);
                                            $('#fcphone').prop('disabled', true);
                                        } else {
                                            $('#fcphone').prop('disabled', false);
                                        }
                                        if (b.Mobile != '') {
                                            $('#fcmobile').val(b.Mobile);
                                            $('#fcmobile').prop('disabled', true);
                                        } else {
                                            $('#fcmobile').prop('disabled', false);
                                        }
                                        if (b.EMail != '') {
                                            $('#fcmail').val(b.EMail);
                                            $('#fcmail').prop('disabled', true);
                                        } else {
                                            $('#fcmail').prop('disabled', false);
                                        }
                                        FP_address = b.Add1 + b.Add2 + b.Add3 + b.PBNo + b.Phone + b.Mobile + b.EMail;
                                    }

                                    if (b.Add_Type == 2) {
                                        if (b.Add1 != '') {
                                            $('#foadd1').val(b.Add1);
                                            $('#foadd1').prop('disabled', true);
                                        } else {
                                            $('#foadd1').prop('disabled', false);
                                        }
                                        if (b.Add2 != '') {
                                            $('#foadd2').val(b.Add2);
                                            $('#foadd2').prop('disabled', true);
                                        } else {
                                            $('#foadd2').prop('disabled', false);
                                        }
                                        if (b.Add3 != '') {
                                            $('#foadd3').val(b.Add3);
                                            $('#foadd3').prop('disabled', true);
                                        } else {
                                            $('#foadd3').prop('disabled', false);
                                        }
                                        if (b.PBNo != '') {
                                            $('#fozip').val(b.PBNo);
                                            $('#fozip').prop('disabled', true);
                                        } else {
                                            $('#fozip').prop('disabled', false);
                                        }
                                        if (b.Phone != '') {
                                            $('#fophone').val(b.Phone);
                                            $('#fophone').prop('disabled', true);
                                        } else {
                                            $('#fophone').prop('disabled', false);
                                        }
                                        if (b.Mobile != '') {
                                            $('#fomobile').val(b.Mobile);
                                            $('#fomobile').prop('disabled', true);
                                        } else {
                                            $('#fomobile').prop('disabled', false);
                                        }
                                        if (b.EMail != '') {
                                            $('#fomail').val(b.EMail);
                                            $('#fomail').prop('disabled', true);
                                        } else {
                                            $('#fomail').prop('disabled', false);
                                        }
                                    }

                                });
                                if (FC_address != '') {
                                    if (FC_address == FP_address) {
                                        $('#father_check').prop('checked', true);
                                    } else {
                                        $('#father_check').prop('checked', false);
                                    }
                                }
                            }
                        }
                    });
                } else {
                    $('#otp_msg').html('<label class="error">Your OTP verification failed.Try again</label>');
                }

            }
        });

        // if(parentotp == OTPSession){

        /*}else{
            alert("otp failed");
        }*/
    }
</script>