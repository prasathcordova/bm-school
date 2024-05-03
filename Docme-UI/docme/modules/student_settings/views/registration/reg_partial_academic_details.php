<fieldset>
    <form action="#" id="academic_profile">
        <div class="row">
            <div class="form-group col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label>Admission No. </label>
                    <!--title changed by Elavarasan 08-05-2019 2:23-->
                    <input placeholder="Auto" readonly="" name="admission_no" type="text" title="Admission No. will be auto-generated" class="form-control" id="admn_no">
                </div>
            </div>
            <div class="form-group col-lg-4 col-xs-12 col-md-12">
                <div class="form-group" id="data_1">
                    <label class="font-noraml"> Admission Date</label><span class="mandatory"> *</span>
                    <div class="input-group date" style="width:100%">
                        <!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
                        <input type="text" class="form-control" id="admission_date" name="admission_date" value="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-12">
                <div class="form-group">
                    <label>Current Academic Year </label><span class="mandatory"> *</span>
                    <select class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%">
                        <option value=-1>Select</option>
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
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-12 col-md-12">
                <div class="form-group">
                    <label>Current Stream </label><span class="mandatory"> *</span>
                    <select class="form-control select2_registration" id="stream_id" name="stream_id">
                        <option value=-1>Select</option>
                        <?php
                        if (isset($stream_data) && !empty($stream_data)) {
                            foreach ($stream_data as $stream) {
                                if ($stream['description'] == 'CBSE')
                                    $selected = 'selected';
                                else
                                    $selected = '';
                                echo '<option ' . $selected . ' value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                            }
                        }

                        ?>

                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-xs-12 col-md-12">
                <div class="form-group">
                    <label> Current Class </label><span class="mandatory"> *</span>
                    <select class="select2_registration form-control" id="class_details" name="class_details">
                        <option selected value="-1">Select</option>
                        <?php
                        if (isset($class_data_for_registration) && !empty($class_data_for_registration)) {
                            foreach ($class_data_for_registration as $class_for_dive) {

                                echo '<option value="' . $class_for_dive['Course_Det_ID'] . '" data-masterid="' . $class_for_dive['Course_Type_ID'] . '"  >' . $class_for_dive['Description'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                <label>Birth Country </label><span class="mandatory"> *</span>
                <!--<input  placeholder="Enter Birth Country" type="text" class="form-control" maxlength="30" id="birth_country" name="birth_country" />-->
                <select name="birth_country" id="birth_country" required="" class="form-control select2_registration" style="width:100%;">
                    <option selected value="-1">Select</option>
                    <?php
                    if (isset($country_data) && !empty($country_data)) {
                        foreach ($country_data as $country) {
                            echo '<option value ="' . $country['country_name'] . '" >' . $country['country_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                <label>Birth Place </label><span class="mandatory"> *</span>
                <input placeholder="Enter Birth Place" type="text" class="form-control alpha" maxlength="30" id="birth_place" name="birth_place" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                <label>Identification Mark 1 </label><span class="mandatory"> *</span>
                <input placeholder="Enter Identification Mark 1" type="text" class="form-control" id="id_mark1" name="id_mark_1" maxlength="100" />
            </div>
            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                <label>Identification Mark 2 </label><span class="mandatory"> *</span>
                <input placeholder="Enter Identification Mark 2" type="text" class="form-control" id="id_mark_2" name="id_mark_2" maxlength="100" />
            </div>
        </div>

    </form>
</fieldset>
<script>
    var academic_profile = $('#academic_profile');
    var academic_profile_validator;
    academic_profile_validator = academic_profile.validate({
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
            class_details: {
                required: true,
                synchronousRemote: true
            },
            admission_date: {
                required: true,
                // remote: {
                //     type: "POST",
                //     cache: false,
                //     url: 'validate-admissiondate/',
                //     data: {
                //         admission_date: function() {
                //             return $('#admission_date').val();
                //         },
                //         toyear: function() {
                //             return $("#academic_year :selected").data('toyear');
                //         },
                //         fromyear: function() {
                //             return $("#academic_year :selected").data('fromyear');
                //         }
                //     }
                // },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            birth_place: {
                required: true,
                minlength: 3,
                regex: /^[a-zA-Z ]*$/,
                maxlength: 30,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            id_mark_1: {
                required: true,
                minlength: 3,
                regex: /^[a-zA-Z ]*$/,
                maxlength: 200,
                normalizer: function(value) {
                    return $.trim(value);
                }

            },
            id_mark_2: {
                required: true,
                minlength: 3,
                regex: /^[a-zA-Z ]*$/,
                maxlength: 200,
                normalizer: function(value) {
                    return $.trim(value);
                }

            },
            academic_year: {
                required: true,
                synchronousRemote: true
            },
            stream_id: {
                required: true,
                synchronousRemote: true
            },
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
                synchronousRemote: "Select Birth Country "
            },
            class_details: {
                required: "Select Current Class",
                synchronousRemote: "Select Current Class"
            },
            birth_place: {
                required: "Enter Birth Place ",
                minlength: "Enter atleast three characters.",
                regex: "Input Valid Characters(Only alphabets and space)",
                maxlength: "Maximum of 30 Characters Allowed"
            },
            id_mark_1: {
                required: "Enter Identification Mark 1 ",
                minlength: "Enter atleast three characters.",
                regex: "Input Valid Characters(Only alphabets and space)",
                maxlength: "Maximum of 200 Characters Allowed"
            },
            id_mark_2: {
                required: "Enter Identification Mark 2 ",
                minlength: "Enter atleast three characters.",
                regex: "Input Valid Characters(Only alphabets and space)",
                maxlength: "Maximum of 200 Characters Allowed"
            },
            stream_id: {
                required: "Select a Stream",
                synchronousRemote: "Select a Stream",
            },
            academic_year: {
                required: "Select a Stream",
                synchronousRemote: "Select a Stream",
            }
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
</script>