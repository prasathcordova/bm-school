<fieldset>
    <div class="row" id="search_student">
    </div>

    <form action="#" id="parent_details">
        <input type="hidden" id="is_parent_update" name="is_parent_update" value="0" />
        <input type="hidden" id="father_id" name="father_id" value="0" />
        <input type="hidden" id="mother_id" name="mother_id" value="0" />
        <input type="hidden" id="guardian_id" name="guardian_id" value="0" />
        <input type="hidden" id="parent_id" name="parent_id" value="0" />
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Parent Details</label></a>
                        </h5>
                        <input type="hidden" id="sibling_student_data_id" name="sibling_student_data_id" value="0" />
                    </div>
                    <?php if ($this->session->userdata('inst_id') == 2) {
                        $parent_label = "Father Name";
                        $permanent_address_label = "Home Country Address";
                    } else {
                        $parent_label = "Parent Name";
                        $permanent_address_label = "Permanent Address";
                    } ?>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                    <label> <?php echo $parent_label ?></label><span class="mandatory"> *</span>
                                    <input id="fname" name="fname" placeholder="<?php echo $parent_label ?>" type="text" class="form-control alpha" maxlength="40">
                                </div>
                                <?php if ($this->session->userdata('inst_id') == 2) { ?>
                                    <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                        <label> Relation Type</label><span class="mandatory"> *</span>
                                        <input type="hidden" value="F" id="reltype" name="reltype">
                                        <input type="text" value="Father" disabled class="form-control alpha">
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                        <label> Relation Type</label><span class="mandatory"> *</span>
                                        <select name="reltype" id="reltype" class="form-control select2_registration" style="width:100%;">
                                            <option value="F" selected>Father</option>
                                            <option value="M">Mother</option>
                                            <option value="G">Guardian</option>
                                        </select>
                                    </div>
                                <?php } ?>

                                <div class="col-lg-4 col-xs-12 col-md-12">
                                    <div class="form-group <?php
                                                            if (form_error('fprofession')) {
                                                                echo 'has-error';
                                                            }
                                                            ?>">
                                        <label>Profession</label><span class="mandatory"> *</span><br />

                                        <select name="fprofession" id="fprofession" class="form-control select2_registration" style="width:100%;">

                                            <option selected value="-1">Select</option>
                                            <?php
                                            if (isset($profession_data) && !empty($profession_data)) {
                                                foreach ($profession_data as $profession) {
                                                    echo '<option value ="' . $profession['profession_id'] . '" >' . $profession['profession_name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error('fprofession', '<div class="form-error">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-group" id="accordion1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#ddd"><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Communication Address</label></a><span class="mandatory"> *</span>
                                        </h5>
                                    </div>
                                    <div id="ddd" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 1</label><span class="mandatory"> *</span>
                                                    <input id="fadd1" name="fadd1" maxlength="30" minlength="3" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2</label><span class="mandatory"> *</span>
                                                    <input id="fadd2" name="fadd2" maxlength="30" minlength="3" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 3</label>
                                                    <input id="fadd3" name="fadd3" maxlength="30" minlength="3" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code/P.O Box Number</label><span class="mandatory"> *</span>
                                                    <input id="fzip" name="fzip" placeholder="Enter Zip Code/P.O Box Number" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number</label><span class="mandatory"> *</span>
                                                    <input id="fphone" name="fphone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number</label><span class="mandatory"> *</span>
                                                    <input id="fmobile" name="fmobile" maxlength="12" minlength="9" onkeypress="return typeNumberOnly(event)" placeholder="Enter Mobile Number" type="text" maxlength="20" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID</label><span class="mandatory"> *</span>
                                                    <input id="fmail" name="fmail" placeholder="Enter Email ID " type="text" class="form-control" maxlength="50">
                                                    <i style="margin-top: 5px;">Temporary Registration details will be sent to this Email Address<br /></i>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#ooo"><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;<?php echo $permanent_address_label ?></label></a><span class="mandatory"> *</span>
                                        </h5>
                                    </div>
                                    <div id="ooo" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="checkbox checkbox-success">
                                                <input id="father_check" name="father_check" type="checkbox">
                                                <label for="father_check">
                                                    &nbsp;Same as communication address
                                                </label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 1</label><span class="mandatory"> *</span>
                                                    <input id="fcadd1" name="fcadd1" maxlength="30" minlength="3" placeholder="Enter  Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2</label><span class="mandatory"> *</span>
                                                    <input id="fcadd2" name="fcadd2" maxlength="30" minlength="3" placeholder="Enter  Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 3</label>
                                                    <input id="fcadd3" name="fcadd3" maxlength="30" minlength="3" placeholder="Enter  Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code/P.O Box Number</label><span class="mandatory"> *</span>
                                                    <input id="fczip" name="fczip" placeholder="Enter Zip Code/P.O Box Number" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number</label><span class="mandatory"> *</span>
                                                    <input id="fcphone" name="fcphone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number</label><span class="mandatory"> *</span>
                                                    <input id="fcmobile" name="fcmobile" maxlength="12" minlength="9" placeholder="Enter  Mobile Number" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID</label><span class="mandatory"> *</span>
                                                    <input id="fcmail" name="fcmail" placeholder="Enter  Email ID " type="text" class="form-control" maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#office_address"><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Office Address</label></a>
                                        </h5>
                                    </div>
                                    <div id="office_address" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 1</label>
                                                    <input id="foadd1" name="foadd1" maxlength="30" minlength="3" placeholder="Enter  Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2</label>
                                                    <input id="foadd2" name="foadd2" maxlength="30" minlength="3" placeholder="Enter  Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 3</label>
                                                    <input id="foadd3" name="foadd3" maxlength="30" minlength="3" placeholder="Enter  Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code/P.O Box Number</label>
                                                    <input id="fozip" name="fozip" placeholder="Enter Zip Code/P.O Box Number" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number</label>
                                                    <input id="fophone" name="fophone" placeholder="Enter Phone Number" minlength="5" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number</label>
                                                    <input id="fomobile" name="fomobile" maxlength="12" minlength="9" placeholder="Enter  Mobile Number" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID</label>
                                                    <input id="fomail" name="fomail" placeholder="Enter  Email ID " type="text" class="form-control" minlength="5" maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default" style="<?php echo $shj_display ?>">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#otherdetails"><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Other Details</label></a>
                                        </h5>
                                    </div>
                                    <div id="otherdetails" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Father Qualification</label>
                                                    <select name="f_qualification" id="f_qualification" class="form-control select2_registration" style="width:100%;">
                                                        <option value="">Select</option>
                                                        <option value="Middle School">Middle School</option>
                                                        <option value="Secondary School">Secondary School</option>
                                                        <option value="Graduate">Graduate</option>
                                                        <option value="Post Graduate">Post Graduate</option>
                                                        <option value="Doctorate">Doctorate</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Father Nationality</label>
                                                    <select name="f_nationality" id="f_nationality" class="form-control select2_registration" style="width:100%;">
                                                        <option value="">Select</option>
                                                        <?php
                                                        if (isset($country_data) && !empty($country_data)) {
                                                            foreach ($country_data as $country) {
                                                                if ($country['country_id'] == 2) {
                                                                    echo '<option selected value ="' . $country['country_nation'] . '" >' . $country['country_nation'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $country['country_nation'] . '" >' . $country['country_nation'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Father Passport No.</label>
                                                    <input id="f_passport" name="f_passport" maxlength="20" minlength="3" placeholder="Father Passport No." type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Father Emirate ID</label>
                                                    <input id="f_emirate_id" name="f_emirate_id" maxlength="15" minlength="3" placeholder="Father Emirate ID" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mother Name</label>
                                                    <input id="m_name" name="m_name" maxlength="40" minlength="3" placeholder="Mother Name" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mother Qualification</label>
                                                    <select name="m_qualification" id="m_qualification" class="form-control select2_registration" style="width:100%;">
                                                        <option value="">Select</option>
                                                        <option value="Middle School">Middle School</option>
                                                        <option value="Secondary School">Secondary School</option>
                                                        <option value="Graduate">Graduate</option>
                                                        <option value="Post Graduate">Post Graduate</option>
                                                        <option value="Doctorate">Doctorate</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mother Profession</label>
                                                    <select name="m_profession" id="m_profession" class="form-control select2_registration" style="width:100%;">
                                                        <option selected value="">Select</option>
                                                        <?php
                                                        if (isset($profession_data) && !empty($profession_data)) {
                                                            foreach ($profession_data as $profession) {
                                                                echo '<option value ="' . $profession['profession_id'] . '" >' . $profession['profession_name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h4>Total Number of Children in the Family</h4>
                                                    <hr>
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label>Daughter/s</label>
                                                    <input id="daughter_count" name="daughter_count" maxlength="3" minlength="1" placeholder="Daughter/s" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Son/s</label>
                                                    <input id="son_count" name="son_count" maxlength="3" minlength="1" placeholder="Son/s" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Siblings in this School</label>
                                                    <input id="sibling_count" name="sibling_count" maxlength="3" minlength="1" placeholder="Siblings in this School" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
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
    </form>
</fieldset>
<script>
    var parent_details_validator;
    parent_details_validator = $('#parent_details').validate({
        rules: {
            fprofession: {
                required: true,
                synchronousRemote: true
            },
            reltype: {
                required: true
            },
            fname: {
                required: true,
                minlength: 3,
                regex: /^[a-zA-Z ]*$/,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },

            fadd1: {
                required: true,
                minlength: 3,
                maxlength: 300,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fadd2: {
                required: true,
                minlength: 3,
                maxlength: 300,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fadd3: {
                required: false,
                minlength: 3,
                maxlength: 300,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fzip: {
                required: true,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fphone: {
                required: true,
                minlength: 7,
                regex: /^[0-9]+$/,
                maxlength: 12,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fmobile: {
                required: true,
                minlength: 9,
                maxlength: 12,
                regex: /^[0-9]+$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-mobile/',
                    data: {
                        mobile: function() {
                            return $('#fmobile').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        relation: "F"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fmail: {
                required: true,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-email/',
                    data: {
                        email: function() {
                            return $('#fmail').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        relation: "F",
                        loc: "Fmail"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fcadd1: {
                required: true,
                minlength: 3,
                maxlength: 300,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fcadd2: {
                required: true,
                minlength: 3,
                maxlength: 300,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fcadd3: {
                required: false,
                minlength: 3,
                maxlength: 300,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fczip: {
                required: true,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                //                            number: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fcphone: {
                required: true,
                minlength: 7,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fcmobile: {
                required: true,
                minlength: 9,
                maxlength: 12,
                regex: /^[0-9]+$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-mobile/',
                    data: {
                        mobile: function() {
                            return $('#fcmobile').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        relation: "F"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },

            fcmail: {
                required: true,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-email/',
                    data: {
                        email: function() {
                            return $('#fcmail').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        relation: "F"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            }
        },
        foadd1: {
            required: false,
            minlength: 3,
            maxlength: 300,
            normalizer: function(value) {
                return $.trim(value);
            }
        },
        foadd2: {
            required: false,
            minlength: 3,
            maxlength: 300,
            normalizer: function(value) {
                return $.trim(value);
            }
        },
        foadd3: {
            required: false,
            minlength: 3,
            maxlength: 300,
            normalizer: function(value) {
                return $.trim(value);
            }
        },
        fozip: {
            required: false,
            minlength: 6,
            maxlength: 7,
            normalizer: function(value) {
                return $.trim(value);
            }
        },
        fophone: {
            required: false,
            minlength: 7,
            regex: /^[0-9]+$/,
            normalizer: function(value) {
                return $.trim(value);
            }
        },
        fomobile: {
            required: false,
            minlength: 9,
            maxlength: 12,
            regex: /^[0-9]+$/,
            remote: {
                type: "POST",
                cache: false,
                url: 'validate-mobile/',
                data: {
                    mobile: function() {
                        return $('#fomobile').val();
                    },
                    sibling_student_id: function() {
                        return $('#sibling_student_data_id').val();
                    },
                    relation: "F"
                }
            },
            normalizer: function(value) {
                return $.trim(value);
            }
        },
        fomail: {
            required: false,
            minlength: 5,
            email: true,
            regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/, //regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
            remote: {
                type: "POST",
                cache: false,
                url: 'validate-email/',
                data: {
                    email: function() {
                        return $('#fomail').val();
                    },
                    sibling_student_id: function() {
                        return $('#sibling_student_data_id').val();
                    },
                    relation: "F"
                }
            },
            normalizer: function(value) {
                return $.trim(value);
            }
        },
        messages: {
            fprofession: {
                required: 'Select Profession',
                synchronousRemote: 'Select Profession'
            },
            reltype: {
                required: 'Select Relation Type',
            },
            fname: {
                required: "Enter Father Name",
                minlength: "Enter atleast three characters.",
                regex: "Enter valid Characters.",
                maxlength: "Enter Characters less than 50 Characters"
            },
            fadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three characters."
            },
            fadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three characters."
            },
            fzip: {
                required: "Enter Zip Code/P.O Box Number",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter Maximum 7 Digit",
                regex: "Enter valid Characters."
            },
            fphone: {
                required: "Enter Phone Number",
                minlength: "Enter atleast 7 Digit ",
                maxlength: "Maximum Characters should be less than 12 Numbers",
                regex: "Enter valid Characters"

            },
            fmobile: {
                required: "Enter Mobile Number",
                regex: "Enter valid Characters.",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter Maximum 12 Digit"

            },
            fmail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID"
            },
            fcadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three Characters"
            },
            fcadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three Characters"
            },
            fczip: {
                required: "Enter Zip Code/P.O Box Number",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter Maximum 7 Digit",
                regex: "Enter valid Characters."
            },
            fcphone: {
                required: "Enter Phone Number",
                minlength: "Enter atleast 7 Digit ",
                regex: "Enter valid Characters.",
                maxlength: "Enter  12 Digit Number"

            },
            fcmobile: {
                required: "Enter Mobile Number",
                regex: "Enter valid Characters.",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter Maximum 12 Digit"

            },
            fcmail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characters",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID"
            },
            foadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three Characters."
            },
            foadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three Characters."
            },
            fozip: {
                required: "Enter Zip Code/P.O Box Number",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter Maximum 7 Digit",
                regex: "Enter valid Characters."
            },
            fophone: {
                required: "Enter Phone Number",
                minlength: "Enter atleast 7 Digit ",
                regex: "Enter valid Characters.",
                maxlength: "Enter  12 Digit Number"

            },
            fomobile: {
                required: "Enter Mobile Number",
                regex: "Enter valid Characters.",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter Maximum 12 Digit"

            },
            fomail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID"
            }
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }

    });
</script>