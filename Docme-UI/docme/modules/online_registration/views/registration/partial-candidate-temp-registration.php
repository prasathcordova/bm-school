<fieldset>
    <form action="#" role="form" id="personal_details">

        <input type="hidden" value="" name="studentid" id="studentid" />
        <input type="hidden" value="<?php echo $sys_parameters['AGE_LIMIT'] != '' ? date('d-m-Y', strtotime($sys_parameters['AGE_LIMIT'])) : date('d-m-Y') ?>" name="agelimit" id="agelimit">
        <input type="hidden" value="<?php echo $sys_parameters['LAST_SUBMISSION_DATE'] != '' ? date('d-m-Y', strtotime($sys_parameters['LAST_SUBMISSION_DATE'])) : date('d-m-Y') ?>" name="lastsubmissiondate" id="lastsubmissiondate">
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="firstname">First Name</label><span class="mandatory"> *</span>
                    <input type="text" id="firstname" maxlength="40" name="firstname" value="" placeholder="Enter First Name" class="form-control alpha">
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="middlename">Middle Name</label>
                    <input type="text" id="middlename" maxlength="30" name="middlename" value="" placeholder="Enter Middle Name" class="form-control alpha">
                </div>
            </div>

            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" required for="lastname">Last Name</label><span class="mandatory"> *</span>
                    <input type="text" id="lastname" maxlength="40" name="lastname" value="" placeholder="Enter Last Name" class="form-control alpha">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label>Gender</label><span class="mandatory"> *</span>
                    <select class="select2_registration form-control" id="gender" name="gender">
                        <option selected value="-1">Select</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group" id="data_1">
                    <label>Date of Birth</label><span class="mandatory"> *</span>
                    <div class="input-group date" style="width:100%;">
                        <input type="text" placeholder="Enter Date of Birth" class="form-control" readonly="" style="background-color:#fff;" id="dob_date" name="dob_date">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="status">Age</label><span><i>(as on <?php echo $sys_parameters['AGE_LIMIT'] != '' ? date('d-m-Y', strtotime($sys_parameters['AGE_LIMIT'])) : date('d-m-Y') ?>)</i></span>
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
                    <select name="country_select" id="country_select" required="" class="form-control select2_registration" style="width:100%;" onchange="changed_country();">
                        <option value="-1">Select</option>
                        <?php
                        if (isset($country_data) && !empty($country_data)) {
                            foreach ($country_data as $country) {
                                if ($country['country_id'] == 2) {
                                    echo '<option selected value ="' . $country['country_id'] . '" data-nationality="' . $country['country_nation'] . '">' . $country['country_name'] . '</option>';
                                } else {
                                    echo '<option value ="' . $country['country_id'] . '" data-nationality="' . $country['country_nation'] . '">' . $country['country_name'] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('country_select', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="nationality">Nationality</label>
                    <input type="text" disabled="" required="" placeholder="Nationality" id="nationality" name="nationality" value="" placeholder="Nationality" class="form-control required">
                </div>
            </div>

            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('state_select')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>State</label><span class="mandatory"> *</span>
                    <select name="state_select" id="state_select" class="form-control select2_registration" style="width:100%;" onchange="changed_state();">//
                        <option value="-1">Select</option>
                        <?php
                        if (isset($state_data) && !empty($state_data)) {
                            foreach ($state_data as $state) {
                                echo '<option selected value ="' . $state['state_id'] . '" >' . $state['state_name'] . '</option>';
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
                    <label>District</label><br />

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
                        <option value="-1">Select</option>
                        <?php
                        if (isset($language_data) && !empty($language_data)) {
                            foreach ($language_data as $language) {
                                if ($language['language_id'] == 1) {
                                    echo '<option selected value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                                } else {
                                    echo '<option value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                                }
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
                                            echo 'has-error';
                                        }
                                        ?>">

                    <label>Optional Language</label><span class="mandatory"> *</span>
                    <select name="language_select" id="language_select" required="" class="form-control select2_registration" style="width:100%;">
                        <option selected value="-1">Select</option>
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
                    <label>Community</label>
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
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('blood_group')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>Blood Group</label><span class="mandatory"> *</span>
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
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group <?php
                                        if (form_error('pickup_point')) {
                                            echo 'has-error';
                                        }
                                        ?>">
                    <label>Pickup Point</label>
                    <select name="pickup_point" id="pickup_point" class="form-control select2_registration" style="width:100%;">
                        <option selected value="-1">Select</option>
                        <?php
                        if (isset($pickup_point) && !empty($pickup_point)) {
                            foreach ($pickup_point as $pickup) {
                                echo '<option value ="' . $pickup['id'] . '" >' . $pickup['pickpointName'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('pickup_point', '<div class="form-error">', '</div>'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="control-label" for="unique_identity"><?php
                                                                        if ($uuid_unit_limit == 12) {
                                                                            echo 'Aadhar Number';
                                                                        } else {
                                                                            echo 'Emirates ID';
                                                                        }
                                                                        ?></label>
                    <div class="input-group" style="display:flex !important;">
                        <!--maxlength set by vinothkumar k @ 09-05-2019 12:00 -->
                        <input type="text" id="unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="unique_identity" value="" placeholder="Enter <?php
                                                                                                                                                                if ($uuid_unit_limit == 12) {
                                                                                                                                                                    echo 'Aadhar Number';
                                                                                                                                                                } else {
                                                                                                                                                                    echo 'Emirates ID';
                                                                                                                                                                }
                                                                                                                                                                ?> " class="form-control" onkeypress="return typeNumberOnly(event);"><!-- onkeyup="checkemirate();-->
                        <!--                                                        <span class="input-group-append"> 
                            <button type="button" class="btn btn-primary" onclick="get_uuid_status_data()">Go</button>
                        </span>-->

                    </div>
                </div>
                <div id="id_spot_check"></div>

            </div>
            <div class="clearfix"></div>
            <div class="col-lg-4 col-xs-12 col-md-12" style="<?php echo $shj_display ?>">
                <div class="form-group">
                    <label class="control-label" for="stud_passport">Passport No.</label>
                    <input type="text" maxlength="15" placeholder="Passport No." id="stud_passport" name="stud_passport" class="form-control">
                </div>
            </div>
            <div class=" col-lg-4 col-xs-12 col-md-12" style="<?php echo $shj_display ?>">
                <div class="form-group">
                    <label class="control-label" for="stud_placeofissue">Place of Issue</label>
                    <input type="text" maxlength="25" placeholder="Place of Issue" id="stud_placeofissue" name="stud_placeofissue" class="form-control">
                </div>
            </div>
            <div class="clearfix"></div>
    </form>

</fieldset>
<script>
    var personal_details_validator;
    personal_details_validator = $('#personal_details').validate({
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
                required: false,
                minlength: $('#uuid_unit_limit').val(),
                maxlength: $('#uuid_unit_limit').val(),
                number: true
            },
            gender: {
                required: true,
                synchronousRemote: true,
            },
            country_select: {
                required: true,
                synchronousRemote: true,
            },
            state_select: {
                required: true,
                synchronousRemote: true,
            },
            district_select: {
                required: false,
            },
            mother_tongue: {
                required: true,
                synchronousRemote: true,
            },
            language_select: {
                required: true,
                synchronousRemote: true,
            },
            religion_select: {
                required: true,
                synchronousRemote: true,
            },
            caste_select: {
                required: true,
                synchronousRemote: true,
            },
            community_select: {
                required: false,
            },

            blood_group: {
                required: true,
                synchronousRemote: true,
            },
        },
        messages: {
            firstname: {
                required: "Enter First Name",
                minlength: "Enter atleast three characters.",
                regex: "Enter valid Characters.(Only alphabets and space)",
                maxlength: "Enter Characters Less Than 50 Characters"
            },
            middlename: {
                regex: "Enter valid Characters.",
                maxlength: "Enter Characters Less Than 50 Characters"
            },
            lastname: {
                required: "Enter Last Name",
                minlength: "Enter atleast 1 character",
                regex: "Enter valid Characters.(Only alphabets and space)",
                maxlength: "Enter Characters Less Than 50 Characters"
            },
            dob_date: {
                required: "Select Date of Birth"
            },
            unique_identity: {
                minlength: "Enter " + $('#uuid_unit_limit').val() + " digit " + $('#uuid_unit_limit_name').val(),
                maxlength: $('#uuid_unit_limit_name').val() + " Should Not Exceed More Than " + $('#uuid_unit_limit').val()
            },
            gender: {
                required: 'Select  Gender',
                synchronousRemote: 'Select a Gender'
            },
            country_select: {
                required: 'Select a Country',
                synchronousRemote: 'Select a Country'
            },
            state_select: {
                required: 'Select a State',
                synchronousRemote: 'Select a State'
            },
            district_select: {
                required: 'Select a District',
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
                required: 'Select an Optional Language',
                synchronousRemote: 'Select an Optional Language'
            },
            caste_select: {
                required: 'Select a Caste',
                synchronousRemote: 'Select a Caste'
            },
            community_select: {
                required: 'Select a Community',
                synchronousRemote: 'Select a Community'
            },

            blood_group: {
                required: 'Select a Blood Group',
                synchronousRemote: 'Select a Blood Group'
            },
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
</script>