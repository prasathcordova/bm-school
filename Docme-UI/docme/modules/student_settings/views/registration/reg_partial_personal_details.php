<fieldset>
    <form action="#" role="form" id="personal_details">
        <div class="row clearfix">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label">Is Citizen of India ?</label>
                    <div>
                        <label class="checkbox-inline i-checks">
                            <input type="radio" name="is_citz_india" id="check_yes" class="is_citz_india" value="1" checked> <span>Yes</span>
                        </label>
                        <label class="checkbox-inline i-checks">
                            <input type="radio" name="is_citz_india" id="check_no" class="is_citz_india" value="0"> <span>No</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label unique_identity_label" for="unique_identity"><?php
                                                                                                if ($uuid_unit_limit == 12) {
                                                                                                    echo 'Aadhar Number';
                                                                                                } else {
                                                                                                    echo 'Emirates ID';
                                                                                                }
                                                                                                ?> </label><span class="mandatory"> *</span>
                    <div class="input-group" style="display:flex !important;">
                        <!--maxlength set by vinothkumar k @ 09-05-2019 12:00 -->
                        <input type="text" id="unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="unique_identity" value="" placeholder="Enter <?php
                                                                                                                                                                if ($uuid_unit_limit == 12) {
                                                                                                                                                                    echo 'Aadhar Number';
                                                                                                                                                                } else {
                                                                                                                                                                    echo 'Emirates ID';
                                                                                                                                                                }
                                                                                                                                                                ?> " class="form-control digits" style="text-align:left" required="" onkeyup="checkEmirateAvailable()">
                        <span class="input-group-append">
                            <button id="go_button" type="button" class="btn btn-primary" onclick="get_uuid_status_data()">Go</button>
                        </span>

                    </div>
                </div>
                <div id="id_spot_check"></div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <p><span class="unique_identity_label"><?php
                                                                if ($uuid_unit_limit == 12) {
                                                                    echo 'Aadhar Number';
                                                                } else {
                                                                    echo 'Emirates ID';
                                                                }
                                                                ?></span> is a unique identification number to uniquely identify individuals. Use this option to
                            check whether the student is already registered or not.
                            <!--                                                            If the student is already registered with a different status then the student status will be updated except for a long absentee student.
                                                                                                                        For the long absent student, the  status need to be changed with the admission number provided. All other students this page will make the student 
                                                                                                                        as an active student in roll but the admission number won't be changed.                                                        -->
                        </p>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div id="student_uuid_data" style="display:none; padding-bottom: 8px;padding-top: 5px;"></div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <hr />
            </div>

            <div class="clearfix"></div>
            <div class="col-lg-4 col-xs-12 col-md-12" style=" z-index: 2;">
                <div class="ibox-content text-center">
                    <label class="control-label" title="Change the image" for="browse" style="float:right;cursor: pointer;"><span class="label label-warning pull-right" for="browse">CHANGE</span></label>
                    <input type="file" accept="image/*" id="browse" name="browse" style="display: none" onchange="readURL(this);">
                    <div class="m-b-sm">
                        <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/a0.jpg'); ?>" onclick="" id="profile_image" style="width: 128px;    height: 128px;">
                        <input type="hidden" name="profile_image_data" id="profile_image_data" />
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <p>Info regarding registration</p>

                    </div>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <input type="hidden" value="" name="studentid" id="studentid" />
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="firstname">First Name </label><span class="mandatory"> *</span>
                    <input type="text" id="firstname" maxlength="40" name="firstname" value="" placeholder="Enter First Name" class="form-control alpha">
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="middlename">Middle Name </label>
                    <input type="text" id="middlename" maxlength="30" name="middlename" value="" placeholder="Enter Middle Name" class="form-control alpha">
                </div>
            </div>

            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" required for="lastname">Last Name </label><span class="mandatory"> *</span>
                    <input type="text" id="lastname" maxlength="40" name="lastname" value="" placeholder="Enter Last Name" class="form-control alpha">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label>Gender </label><span class="mandatory"> *</span>
                    <select class="select2_demo_1 form-control" id="gender" name="gender">
                        <option selected value="-1">Select</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group" id="data_1">
                    <label>Date of Birth </label><span class="mandatory"> * </span>
                    <div class="input-group date" style="width:100%;">
                        <input type="text" class="form-control" onchange="age_changer();" readonly="" placeholder="Enter Date of Birth" style="background-color:#fff;" id="dob_date" name="dob_date">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="status">Age </label><span class="mandatory"> * <i>(as on <?php echo $this->session->userdata('Age_Limit') != '' && $this->session->userdata('Age_Limit') != 0 ? date('d-m-Y', strtotime($this->session->userdata('Age_Limit'))) : date('d-m-Y') ?>)</i></span>
                    <input type="text" id="age" name="age" readonly="" value="" placeholder="Age" class="form-control">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('country_select')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>Country</label><span class="mandatory"> *</span>
                    <select name="country_select" id="country_select" required="" class="form-control select2_registration" style="width:100%;" onchange="changed_country();" disabled>
                        <option value="-1">Select</option>
                        <?php
                        if (isset($country_data) && !empty($country_data)) {
                            foreach ($country_data as $country) {
                                if ($country['country_id'] == 2) {
                                    echo '<option selected value ="' . $country['country_id'] . '" data-nationality="' . $country['country_nation'] . '">' . $country['country_name'] . '</option>';
                                } else {
                                    echo '<option value ="' . $country['country_id'] . '" data-nationality="' . $country['country_nation'] . '">' . $country['country_name'] . '</option>';
                                }
                                // echo '<option value ="' . $country['country_id'] . '" data-nationality="' . $country['country_nation'] . '">' . $country['country_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('country_select', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="nationality">Nationality</label><span class="mandatory"> *</span>
                    <input type="text " disabled="" required="" placeholder="Nationality" id="nationality" name="nationality" value="" placeholder="Nationality" class="form-control required">
                </div>
            </div>

            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('state_select')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>State</label><span class="mandatory required_by_citizen"> *</span>
                    <select name="state_select" id="state_select" class="form-control select2_registration" style="width:100%;" onchange="changed_state();">
                        <option selected value="-1">Select</option>
                        <?php
                        if (isset($state_data) && !empty($state_data)) {
                            foreach ($state_data as $state) {
                                echo '<option value ="' . $state['state_id'] . '" >' . $state['state_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('state_select', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('district_select')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>District</label><span class="mandatory required_by_citizen"> *</span><br />

                    <select name="district_select" id="district_select" class="form-control select2_registration" style="width:100%;">

                        <option selected value="-1">Select</option>
                        <?php
                        if (isset($city_data) && !empty($city_data)) {
                            foreach ($city_data as $district) {
                                echo '<option value ="' . $district['city_id'] . '" >' . $district['city_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('district_select', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('mother_tongue')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>Mother Tongue</label><span class="mandatory"> *</span>
                    <select name="mother_tongue" id="mother_tongue" required="" class="form-control select2_registration" style="width:100%;">
                        <option selected value="-1">Select</option>
                        <?php
                        if (isset($language_data) && !empty($language_data)) {
                            foreach ($language_data as $language) {
                                if ($language['language_id'] == 1) {
                                    echo '<option selected value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                                } else {
                                    echo '<option value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                                }
                                //echo '<option value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('mother_tongue', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('language_select')) {
                                            //                                                echo 'has-error';
                                        }
                                        ?>">

                    <label>Known Languages</label><span class="mandatory"> *</span>
                    <select class="select2_demo_2 form-control" name="language_select" id="language_select" multiple="multiple">
                        <?php
                        if (isset($language_data) && !empty($language_data)) {
                            foreach ($language_data as $language) {

                                echo '<option value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                            }
                        }
                        ?>

                    </select>
                    <?php echo form_error('language_select', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('religion_select')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>Religion</label><span class="mandatory"> *</span>
                    <select name="religion_select" id="religion_select" class="form-control select2_registration" style="width:100%;" onchange="changed_religion();">
                        <option selected value="-1">Select</option>
                        <?php
                        if (isset($relegion) && !empty($relegion)) {
                            foreach ($relegion as $religion) {

                                echo '<option value ="' . $religion['religion_id'] . '" >' . $religion['religion_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('religion_select', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('caste_select')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>Caste</label><span class="mandatory"> *</span>
                    <select name="caste_select" id="caste_select" class="form-control select2_registration" style="width:100%;" onchange="caste_change();">
                        <option selected value="-1">Select</option>
                        <?php
                        if (isset($caste_data) && !empty($caste_data)) {
                            foreach ($caste_data as $caste) {
                                echo '<option value ="' . $caste['caste_id'] . '" data-communityselect="' . $caste['community_id'] . '">' . $caste['caste_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('caste_select', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('community_select')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>Community</label><span class="mandatory"> *</span>
                    <select name="community_select" id="community_select" class="form-control select2_registration" style="width:100%;">
                        <option selected value="-1">Select</option>
                        <?php
                        if (isset($community_data) && !empty($community_data)) {
                            foreach ($community_data as $community) {

                                echo '<option value ="' . $community['community_id'] . '" >' . $community['community_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('community_select', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('blood_group')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>Blood Group</label><span class="mandatory"></span>
                    <select name="blood_group" id="blood_group" class="form-control select2_registration" style="width:100%;">
                        <option selected value="-1">Select</option>
                        <?php
                        $bloodgroup  = array('A+ve', 'A-ve', 'B+ve', 'B-ve', 'AB+ve', 'AB-ve', 'O+ve', 'O-ve');
                        if (isset($bloodgroup) && !empty($bloodgroup)) {
                            foreach ($bloodgroup as $blood) {

                                echo '<option value ="' . $blood . '" >' . $blood . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('blood_group', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
        </div>
        <div class="clearfix"></div>
    </form>
</fieldset>
<script>
    var personal_details = $('#personal_details');
    var personal_details_validator;
    $(document).ready(function() {
        $('.is_citz_india').on('ifChanged', function() {
            personal_details_validator.resetForm();
            $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').val('');
            if ($(this).is(":checked") && $(this).val() == 1) {
                $('#uuid_unit_limit_name').val('<?php echo $uuid_unit_limit == 12 ? 'Aadhar Number' : 'Emirates ID'; ?>');
                $("#country_select option[value='2']").prop('disabled', false);
                $('#country_select').val(2);
                $('#country_select').prop('disabled', true);
                $('.required_by_citizen').show();
                $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').removeClass('alphanumeric');
                $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').addClass('digits');
                $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').attr('maxlength', <?php echo $uuid_unit_limit ?>);
            } else {
                $('#uuid_unit_limit_name').val('Unique ID');
                $('#country_select').trigger("change");
                $('#country_select').prop('disabled', false);
                $('#country_select').val(-1);
                $("#country_select option[value='2']").prop('disabled', true);
                $('.required_by_citizen').hide();
                $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').removeClass('digits');
                $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').addClass('alphanumeric');
                $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').attr('maxlength', 16);
            }
            $('#country_select').trigger("change");
            $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').attr('placeholder', 'Enter ' + $('#uuid_unit_limit_name').val());
            $('.unique_identity_label').html($('#uuid_unit_limit_name').val());

        });
    });


    jQuery.validator.addMethod("unique_length", function(value, element) {
        if ($('.is_citz_india:checked').val() == 1) {
            if (value == '') {
                return true;
            }
            if (value.length != parseInt($('#uuid_unit_limit').val())) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }, "Enter a valid value");

    jQuery.validator.addMethod("unique_type", function(value, element) {
        if ($('.is_citz_india:checked').val() == 1) {
            if (value == '') {
                return true;
            }
            var dec_numbers = /^[0-9]+$/;
            if (!dec_numbers.test(value)) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }

    }, "Enter a valid value");


    jQuery.validator.addMethod("required_by_citzen", function(value, element) {
        if ($('.is_citz_india:checked').val() == 1) {
            if (value == -1) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }

    }, "Select the feild");


    var studentid = $('#studentid').val();
    personal_details_validator = personal_details.validate({
        rules: {
            firstname: {
                required: true,
                minlength: 3,
                regex: /^[a-zA-Z ]*$/,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            middlename: {
                regex: /^[a-zA-Z ]*$/,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            lastname: {
                required: true,
                minlength: 1,
                regex: /^[a-zA-Z ]*$/,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            dob_date: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            unique_identity: {
                required: true,
                unique_length: true,
                unique_type: true,
                //maxlength: $('#uuid_unit_limit').val(),
                //minength: $('#uuid_unit_limit').val(),
                //number: true,
                remote: {
                    url: 'validate-adhar/',
                    type: "POST",
                    cache: false,
                    async: false,
                    mode: "abort",
                    data: {
                        unique_identity: function() {
                            return $('#unique_identity').val(); //This will be passed to DB for checking ,others for checking entered same or not
                        },
                        s_unique_identity: function() {
                            return $('#unique_identity').val();
                        },
                        f_unique_identity: function() {
                            return $('#f_unique_identity').val();
                        },
                        m_unique_identity: function() {
                            return $('#m_unique_identity').val();
                        },
                        g_unique_identity: function() {
                            return $('#g_unique_identity').val();
                        },
                        studentid: function() {
                            return $('#studentid').val();
                        },
                        unique_limit_name: function() {
                            return $('#uuid_unit_limit_name').val();
                        },
                    }
                }
            },
            gender: {
                required: true,
                synchronousRemote: true
            },
            country_select: {
                required: true,
                synchronousRemote: true
            },
            state_select: {
                required_by_citzen: true,
                // synchronousRemote: true
            },
            district_select: {
                required_by_citzen: true,
                //synchronousRemote: true
            },
            mother_tongue: {
                required: true,
                synchronousRemote: true
            },
            language_select: {
                required: true,
                synchronousRemote: true
            },
            religion_select: {
                required: true,
                synchronousRemote: true
            },
            caste_select: {
                required: true,
                synchronousRemote: true
            },
            community_select: {
                required: true,
                synchronousRemote: true
            },
        },
        messages: {
            firstname: {
                required: "Enter First Name",
                minlength: "Enter atleast three characters.",
                regex: "Input Valid Characters.(Only alphabets and space)",
                maxlength: "Input Characters Less Than 50 Characters"
            },
            middlename: {
                regex: "Input Valid Characters.",
                maxlength: "Input Characters Less Than 50 Characters"
            },
            lastname: {
                required: "Enter Last Name",
                minlength: "Enter atleast 1 character",
                regex: "Input Valid Characters.",
                maxlength: "Input Characters Less Than 50 Characters"
            },
            dob_date: {
                required: "Select Date of Birth"
            },
            unique_identity: {
                required: function() {
                    return "Enter " + $('#uuid_unit_limit_name').val()
                },
                unique_length: function() {
                    return "Enter " + $('#uuid_unit_limit').val() + " Digit " + $('#uuid_unit_limit_name').val()
                },
                unique_type: function() {
                    return "Enter valid " + $('#uuid_unit_limit_name').val()
                },
                remote: function() {
                    return $('#uuid_unit_limit_name').val() + " already exists"
                }
            },
            gender: {
                required: 'Select a Gender',
                synchronousRemote: 'Select a Gender'
            },
            country_select: {
                required: 'Select a Country',
                synchronousRemote: 'Select a Country'
            },
            state_select: {
                required_by_citzen: 'Select a State',
                synchronousRemote: 'Select a State'
            },
            district_select: {
                required_by_citzen: 'Select a District',
                synchronousRemote: 'Select a District'
            },
            mother_tongue: {
                required: 'Select a Mother Tongue',
                synchronousRemote: 'Select a Mother Tongue'
            },
            religion_select: {
                required: 'Select a Religion',
                synchronousRemote: 'Select a Religion'
            },
            language_select: {
                required: 'Select Known Languages',
                synchronousRemote: 'Select Known Languages'
            },
            caste_select: {
                required: 'Select a Caste',
                synchronousRemote: 'Select a Caste'
            },
            community_select: {
                required: 'Select a Community',
                synchronousRemote: 'Select a Community'
            }
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
</script>