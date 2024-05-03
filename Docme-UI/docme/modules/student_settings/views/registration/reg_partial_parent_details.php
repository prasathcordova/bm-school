<style>
    .panel-heading {
        cursor: pointer;
    }

    .notvisible {
        display: none;
    }
</style>
<fieldset>
    <div class="row" id="search_student">
    </div>

    <form action="#" id="parent_details">
        <input type="hidden" id="is_parent_update" name="is_parent_update" value="0" />
        <input type="hidden" id="father_id" name="father_id" value="0" />
        <input type="hidden" id="mother_id" name="mother_id" value="0" />
        <input type="hidden" id="guardian_id" name="guardian_id" value="0" />
        <input type="hidden" id="sibling_student_data_id" name="sibling_student_data_id" value="0" />
        <div class="panel-body" id="staff_concession">
            <div class="panel-group">
                <div class="panel panel-info" id='panelclass'>
                    <div class="panel-heading">
                        <h4 class="panel-title" id='titleforstaffcon'>
                            <div class="checkbox checkbox-warning">
                                <input type="checkbox" id="staff_con" name="staff_con"><label>&nbsp;&nbsp;AVAIL FOR STAFF CONCESSION</label>
                            </div>
                        </h4>
                    </div>
                    <div class="panel-body notvisible" id="forstaffcon">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <h5 class="panel-title">
                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;FATHER DETAILS</label></a>
                        </h5>

                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label> Father Name </label><span class="mandatory"> *</span>
                                    <input id="fname" name="fname" placeholder="Enter Father Name" maxlength="30" type="text" class="form-control alpha">
                                </div>
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
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
                                <div class="clearfix"></div>
                                <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                    <label class="control-label unique_identity_label" for="f_unique_identity"><?php
                                                                                                                if ($uuid_unit_limit == 12) {
                                                                                                                    echo 'Aadhar Number';
                                                                                                                } else {
                                                                                                                    echo 'Emirates ID';
                                                                                                                }
                                                                                                                ?> </label><span class="mandatory"> *</span>
                                    <div class="input-group" style="display:flex !important;">
                                        <!--maxlength set by vinothkumar k @ 09-05-2019 12:00 -->
                                        <input type="text" id="f_unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="f_unique_identity" value="" placeholder="Enter <?php
                                                                                                                                                                                    if ($uuid_unit_limit == 12) {
                                                                                                                                                                                        echo 'Aadhar Number';
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo 'Emirates ID';
                                                                                                                                                                                    }
                                                                                                                                                                                    ?> " class="form-control digits" style="text-align:left" required="">
                                        <!--onkeyup="f_checkEmirateAvailable()"-->

                                    </div>
                                    <div id="f_id_spot_check"></div>
                                </div>
                                <div class="form-group col-lg-2 col-xs-12 col-md-12" style="margin-top:24px;">
                                    <a class="btn btn-primary btn-sm" href="javascript:void(0);" id='parentSearch' onclick="new_search();"> <i class="fa fa-user ">&nbsp;</i><strong>Parent Search</strong></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-group" id="accordion2">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion2" href="#ddd">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i></a><label>&nbsp;&nbsp;Communication Address</label><span class="mandatory"> *</span>
                                        </h5>
                                    </div>
                                    <div id="ddd" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 1 </label><span class="mandatory"> *</span>
                                                    <input id="fadd1" name="fadd1" maxlength="50" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label><span class="mandatory"> *</span>
                                                    <input id="fadd2" name="fadd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="fadd3" name="fadd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label><span class="mandatory"> *</span>
                                                    <input id="fzip" name="fzip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number </label><span class="mandatory"> *</span>
                                                    <input id="fphone" name="fphone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label><span class="mandatory"> *</span>
                                                    <input id="fmobile" name="fmobile" maxlength="12" minlength="9" onkeypress="return typeNumberOnly(event)" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label><span class="mandatory"> *</span>
                                                    <input id="fmail" name="fmail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion2" href="#fff">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Official Address</label></a>
                                        </h5>
                                    </div>
                                    <div id="fff" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 1 </label>
                                                    <input id="foadd1" name="foadd1" maxlength="50" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label>
                                                    <input id="foadd2" name="foadd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="foadd3" name="foadd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label>
                                                    <input id="fozip" name="fozip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number </label>
                                                    <input id="fophone" name="fophone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label>
                                                    <input id="fomobile" name="fomobile" maxlength="12" minlength="9" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label>
                                                    <input id="fomail" name="fomail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion2" href="#ooo">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i></a><label>&nbsp;&nbsp;Permanent Address</label><span class="mandatory"> *</span>
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
                                                    <label> Address Line 1 </label><span class="mandatory"> *</span>
                                                    <input id="fcadd1" name="fcadd1" maxlength="50" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label><span class="mandatory"> *</span>
                                                    <input id="fcadd2" name="fcadd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="fcadd3" name="fcadd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label><span class="mandatory"> *</span>
                                                    <input id="fczip" name="fczip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number </label><span class="mandatory"> *</span>
                                                    <input id="fcphone" name="fcphone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label><span class="mandatory"> *</span>
                                                    <input id="fcmobile" name="fcmobile" maxlength="12" minlength="9" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label><span class="mandatory"> *</span>
                                                    <input id="fcmail" name="fcmail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <h4 class="panel-title">
                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;MOTHER DETAILS</label></a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label> Mother Name </label><span class="mandatory"> *</span>
                                    <input id="mname" name="mname" placeholder="Enter Mother Name" maxlength="30" type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label>Profession</label><span class="mandatory"> *</span><br />

                                    <select name="mprofession" id="mprofession" class="form-control select2_registration" style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($mprofession_data) && !empty($mprofession_data)) {
                                            foreach ($mprofession_data as $mprofession) {

                                                echo '<option value ="' . $mprofession['profession_id'] . '" >' . $mprofession['profession_name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('mprofession', '<div class="form-error">', '</div>'); ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label class="control-label unique_identity_label" for="m_unique_identity"><?php
                                                                                                                if ($uuid_unit_limit == 12) {
                                                                                                                    echo 'Aadhar Number';
                                                                                                                } else {
                                                                                                                    echo 'Emirates ID';
                                                                                                                }
                                                                                                                ?> </label>
                                    <div class="input-group" style="display:flex !important;">
                                        <!--maxlength set by vinothkumar k @ 09-05-2019 12:00 -->
                                        <input type="text" id="m_unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="m_unique_identity" value="" placeholder="Enter <?php
                                                                                                                                                                                    if ($uuid_unit_limit == 12) {
                                                                                                                                                                                        echo 'Aadhar Number';
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo 'Emirates ID';
                                                                                                                                                                                    }
                                                                                                                                                                                    ?> " class="form-control digits" style="text-align:left" required="">
                                        <!--onkeyup="m_checkEmirateAvailable()"-->
                                    </div>

                                    <div id="m_id_spot_check"></div>
                                </div>
                            </div>
                            <div class="panel-group" id="accordion1">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion1" href="#qqq">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Communication Address</label></a>
                                        </h5>
                                    </div>
                                    <div id="qqq" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="checkbox checkbox-success" id="mthr_com_check_div">
                                                <input id="mthr_com_check" name="mthr_com_check" type="checkbox">
                                                <label for="mthr_com_check">
                                                    &nbsp;Same as Father's address
                                                </label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 1 </label>
                                                    <input id="madd1" name="madd1" maxlength="50" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label>
                                                    <input id="madd2" name="madd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="madd3" name="madd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label>
                                                    <input id="mzip" name="mzip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number</label>
                                                    <input id="mphone" name="mphone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label>
                                                    <input id="mmobile" name="mmobile" maxlength="12" minlength="9" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label>
                                                    <input id="mmail" name="mmail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion1" href="#www">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Official Address</label></a>
                                        </h5>
                                    </div>
                                    <div id="www" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 1 </label>
                                                    <input id="moadd1" maxlength="50" name="moadd1" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label>
                                                    <input id="moadd2" name="moadd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="moadd3" name="moadd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label>
                                                    <input id="mozip" name="mozip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number </label>
                                                    <input id="mophone" name="mophone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label>
                                                    <input id="momobile" name="momobile" maxlength="12" minlength="9" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label>
                                                    <input id="momail" name="momail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion1" href="#eee">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Permanent Address</label></a>
                                        </h5>
                                    </div>
                                    <div id="eee" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="checkbox checkbox-success">
                                                <input id="mother_check" name="mother_check" type="checkbox">
                                                <label for="mother_check">
                                                    &nbsp;Same as communication address </label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 1 </label>
                                                    <input id="mcadd1" name="mcadd1" maxlength="50" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label>
                                                    <input id="mcadd2" name="mcadd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="mcadd3" name="mcadd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label>
                                                    <input id="mczip" name="mczip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number </label>
                                                    <input id="mcphone" name="mcphone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label>
                                                    <input id="mcmobile" name="mcmobile" maxlength="12" minlength="9" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label>
                                                    <input id="mcmail" name="mcmail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        <h4 class="panel-title">
                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;GUARDIAN DETAILS</label></a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label> Name </label>
                                    <input id="gname" name="gname" placeholder="Enter Name" maxlength="30" type="text" class="form-control">
                                </div>
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label>Profession </label><br>
                                    <select name="gprofession" id="gprofession" class="form-control select2_registration" style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($gprofession_data) && !empty($gprofession_data)) {
                                            foreach ($gprofession_data as $gprofession) {

                                                echo '<option value ="' . $gprofession['profession_id'] . '" >' . $gprofession['profession_name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label>Gender </label><br>
                                    <select class="select2_demo_3 form-control" name="ggender" id="ggender">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label class="control-label unique_identity_label" for="g_unique_identity"><?php
                                                                                                                    if ($uuid_unit_limit == 12) {
                                                                                                                        echo 'Aadhar Number';
                                                                                                                    } else {
                                                                                                                        echo 'Emirates ID';
                                                                                                                    }
                                                                                                                    ?> </label>
                                        <div class="input-group" style="display:flex !important;">
                                            <!--maxlength set by vinothkumar k @ 09-05-2019 12:00 -->
                                            <input type="text" id="g_unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="g_unique_identity" value="" placeholder="Enter <?php
                                                                                                                                                                                        if ($uuid_unit_limit == 12) {
                                                                                                                                                                                            echo 'Aadhar Number';
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo 'Emirates ID';
                                                                                                                                                                                        }
                                                                                                                                                                                        ?> " class="form-control digits" style="text-align:left" required="">
                                            <!--onkeyup="g_checkEmirateAvailable()"-->
                                        </div>
                                    </div>
                                    <div id="g_id_spot_check"></div>
                                </div>
                            </div>
                            <div class="panel-group" id="accordion3">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion3" href="#ttt">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Communication Address</label></a>
                                        </h5>
                                    </div>
                                    <div id="ttt" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 1 </label>
                                                    <input id="gadd1" name="gadd1" maxlength="50" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label>
                                                    <input id="gadd2" name="gadd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="gadd3" name="gadd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label>
                                                    <input id="gzip" name="gzip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number </label>
                                                    <input id="gphone" name="gphone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label>
                                                    <input id="gmobile" name="gmobile" maxlength="12" minlength="9" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label>
                                                    <input id="gmail" name="gmail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion3" href="#mmm">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Official Address</label></a>
                                        </h5>
                                    </div>
                                    <div id="mmm" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 1 </label>
                                                    <input id="goadd1" name="goadd1" maxlength="50" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label>
                                                    <input id="goadd2" name="goadd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="goadd3" name="goadd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label>
                                                    <input id="gozip" name="gozip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number </label>
                                                    <input id="gophone" name="gophone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label>
                                                    <input id="gomobile" name="gomobile" maxlength="12" minlength="9" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label>
                                                    <input id="gomail" name="gomail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion3" href="#111">
                                        <h5 class="panel-title">
                                            <a><i class="fa fa-unsorted"></i><label>&nbsp;&nbsp;Permanent Address</label></a>
                                        </h5>
                                    </div>
                                    <div id="111" class="panel-collapse collapse in">
                                        <div class="panel-body">

                                            <div class="checkbox checkbox-success">
                                                <input id="guardian_check" name="guardian_check" type="checkbox">
                                                <label for="guardian_check">
                                                    &nbsp;Same as communication address </label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 1 </label>
                                                    <input id="gcadd1" name="gcadd1" maxlength="50" placeholder="Enter Address Line 1" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Address Line 2 </label>
                                                    <input id="gcadd2" name="gcadd2" maxlength="50" placeholder="Enter Address Line 2" type="text" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Address Line 3 </label>
                                                    <input id="gcadd3" name="gcadd3" maxlength="50" placeholder="Enter Address Line 3" type="text" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Zip Code </label>
                                                    <input id="gczip" name="gczip" placeholder="Enter Zip Code" type="text" maxlength="7" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Phone Number </label>
                                                    <input id="gcphone" name="gcphone" placeholder="Enter Phone Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Mobile Number </label>
                                                    <input id="gcmobile" name="gcmobile" maxlength="12" minlength="9" placeholder="Enter Mobile Number" type="text" maxlength="12" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Email ID </label>
                                                    <input id="gcmail" name="gcmail" placeholder="Enter Email ID " maxlength="50" type="text" class="form-control">
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
    var parent_details = $('#parent_details');
    var parent_details_validator;
    parent_details_validator = parent_details.validate({
        ignore: [],
        rules: {
            f_unique_identity: {
                required: true,
                unique_length: true,
                unique_type: true,
                // minlength: $('#uuid_unit_limit').val(),
                // maxlength: $('#uuid_unit_limit').val(),
                // number: true,
                remote: {
                    url: 'validate-adhar/',
                    type: "POST",
                    cache: false,
                    async: false,
                    mode: "abort",
                    data: {
                        unique_identity: function() {
                            return $('#f_unique_identity').val(); //This will be passed to DB for checking ,others for checking Enter ed same or not
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
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        unique_limit_name: function() {
                            return $('#uuid_unit_limit_name').val();
                        },
                    }
                }
            },
            fprofession: {
                required: true,
                synchronousRemote: true
            },
            mprofession: {
                required: true,
                synchronousRemote: true
            },
            fname: {
                required: true,
                minlength: 3,
                regex: /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fadd1: {
                required: true,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fadd2: {
                required: true,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fadd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
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
                        student_id: function() {
                            return $('#studentid').val();
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
                maxlength: 50,
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
                        student_id: function() {
                            return $('#studentid').val();
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
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fcadd2: {
                required: true,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fcadd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
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
                        student_id: function() {
                            return $('#studentid').val();
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
                maxlength: 50,
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
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "F"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            foadd1: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            foadd2: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            foadd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            fozip: {
                required: false,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                //                            number: true,
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
                        student_id: function() {
                            return $('#studentid').val();
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
                maxlength: 50,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
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
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "F"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mname: {
                required: true,
                minlength: 3,
                regex: /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            m_unique_identity: {
                required: false,
                unique_length: true,
                unique_type: true,
                // minlength: $('#uuid_unit_limit').val(),
                // maxlength: $('#uuid_unit_limit').val(),
                // number: true,
                remote: {
                    url: 'validate-adhar/',
                    type: "POST",
                    cache: false,
                    async: false,
                    mode: "abort",
                    data: {
                        unique_identity: function() {
                            return $('#m_unique_identity').val(); //This will be passed to DB for checking ,others for checking Enter ed same or not
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
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        unique_limit_name: function() {
                            return $('#uuid_unit_limit_name').val();
                        },
                    }
                }
            },
            madd1: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            madd2: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            madd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mzip: {
                required: false,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                //                            number: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mphone: {
                required: false,
                minlength: 7,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mmobile: {
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
                            return $('#mmobile').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "M"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mmail: {
                required: false,
                maxlength: 50,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-email/',
                    data: {
                        email: function() {
                            return $('#mmail').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "M"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mcadd1: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mcadd2: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mcadd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mczip: {
                required: false,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mcphone: {
                required: false,
                minlength: 7,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mcmobile: {
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
                            return $('#mcmobile').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "M"
                    }
                },
                //                                number: true,

                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mcmail: {
                required: false,
                maxlength: 50,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-email/',
                    data: {
                        email: function() {
                            return $('#mcmail').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "M"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            moadd1: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            moadd2: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            moadd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mozip: {
                required: false,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                //                            number: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            mophone: {
                required: false,
                minlength: 7,
                maxlength: 12,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            momobile: {
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
                            return $('#momobile').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "M"
                    }
                },
                //                                number: true,

                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            momail: {
                required: false,
                maxlength: 50,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-email/',
                    data: {
                        email: function() {
                            return $('#momail').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "M"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gname: {
                required: false,
                minlength: 3,
                regex: /^[a-zA-Z ]*$/,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            g_unique_identity: {
                required: false,
                unique_length: true,
                unique_type: true,
                // minlength: $('#uuid_unit_limit').val(),
                // maxlength: $('#uuid_unit_limit').val(),
                // number: true,
                remote: {
                    url: 'validate-adhar/',
                    type: "POST",
                    cache: false,
                    async: false,
                    //mode: "abort",
                    data: {
                        unique_identity: function() {
                            return $('#g_unique_identity').val(); //This will be passed to DB for checking ,others for checking Enter ed same or not
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
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        unique_limit_name: function() {
                            return $('#uuid_unit_limit_name').val();
                        },
                    }
                }
            },
            gadd1: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gadd2: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gadd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gzip: {
                required: false,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gphone: {
                required: false,
                minlength: 7,
                maxlength: 12,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gmobile: {
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
                            return $('#gmobile').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "G"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gmail: {
                required: false,
                maxlength: 50,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-email/',
                    data: {
                        email: function() {
                            return $('#gmail').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "G",
                        loc: "Gmail"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gcadd1: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gcadd2: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gcadd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gczip: {
                required: false,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gcphone: {
                required: false,
                minlength: 7,
                maxlength: 12,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gcmobile: {
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
                            return $('#gcmobile').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "G"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gcmail: {
                required: false,
                maxlength: 50,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-email/',
                    data: {
                        email: function() {
                            return $('#gcmail').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "G",
                        loc: "gcmail"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            goadd1: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            goadd2: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            goadd3: {
                required: false,
                minlength: 3,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gozip: {
                required: false,
                minlength: 6,
                maxlength: 7,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gophone: {
                required: false,
                minlength: 7,
                maxlength: 12,
                regex: /^[0-9]+$/,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gomobile: {
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
                            return $('#gomobile').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "G"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            gomail: {
                required: false,
                maxlength: 50,
                minlength: 5,
                email: true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                remote: {
                    type: "POST",
                    cache: false,
                    url: 'validate-email/',
                    data: {
                        email: function() {
                            return $('#gomail').val();
                        },
                        sibling_student_id: function() {
                            return $('#sibling_student_data_id').val();
                        },
                        student_id: function() {
                            return $('#studentid').val();
                        },
                        relation: "G",
                        loc: "gomail"
                    }
                },
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
        },
        messages: {
            fprofession: {
                required: 'Select Profession',
                synchronousRemote: 'Select Profession'
            },
            mprofession: {
                required: 'Select Profession',
                synchronousRemote: 'Select Profession'
            },
            fname: {
                required: "Enter Father Name",
                minlength: "Enter atleast 3 characters",
                regex: "Input valid characters",
                maxlength: "Input Characters Less Than 50 Characters"
            },
            f_unique_identity: {
                required: function() {
                    return "Enter " + $('#uuid_unit_limit_name').val()
                },
                unique_length: function() {
                    return "Enter " + $('#uuid_unit_limit').val() + " Digit " + $('#uuid_unit_limit_name').val()
                },
                unique_type: function() {
                    return "Enter valid " + $('#uuid_unit_limit_name').val()
                }
            },
            fadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast 3 characters"
            },
            fadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast 3 characters"
            },
            fzip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 digits",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters"
            },
            fphone: {
                required: "Enter Phone Number",
                minlength: "Enter atleast 7 digits",
                maxlength: "maximum Characters Should Be Less Than 12 Numbers",
                regex: "Input valid Characters"

            },
            fmobile: {
                required: "Enter Mobile Number",
                regex: "Input valid characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 digits",
                maxlength: "Enter maximum 12 digits"

            },
            fmail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"
            },
            fcadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three characters"
            },
            fcadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three characters"
            },
            fczip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters"
            },
            fcphone: {
                required: "Enter Phone Number",
                minlength: "Enter atleast 7 digits",
                regex: "Input valid characters",
                maxlength: "Enter 12 Digit Number"

            },
            fcmobile: {
                required: "Enter Mobile Number",
                regex: "Input valid Characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter maximum 12 Digit"

            },
            fcmail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"
            },
            foadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast 3 characters"
            },
            foadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three characters"
            },
            fozip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters"
            },
            fophone: {
                required: "Enter Phone Number",
                regex: "Input valid characters",
                minlength: "Enter atleast 7 digits ",
                maxlength: "Enter 12 Digit Number"
            },
            fomobile: {
                required: "Enter Mobile Number",
                regex: "Input valid Characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter maximum 12 Digit"
            },
            fomail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"
            },
            mname: {
                required: "Enter Mother Name",
                minlength: "Enter atleast 3 characters",
                regex: "Input valid characters",
                maxlength: "Input Characters Less Than 50 Characters"
            },
            m_unique_identity: {
                required: function() {
                    return "Enter " + $('#uuid_unit_limit_name').val()
                },
                unique_length: function() {
                    return "Enter " + $('#uuid_unit_limit').val() + " Digit " + $('#uuid_unit_limit_name').val()
                },
                unique_type: function() {
                    return "Enter valid " + $('#uuid_unit_limit_name').val()
                }
            },
            madd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast 3 characters"
            },
            madd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast 3 characters"
            },
            mzip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters",
            },
            mphone: {
                required: "Enter Phone Number",
                regex: "Input valid characters",
                minlength: "Enter atleast 7 digits ",
                maxlength: "Enter 12 Digit Number"

            },
            mmobile: {
                required: "Enter Mobile Number",
                regex: "Input valid characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter maximum 12 Digit"

            },
            mmail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"

            },
            mcadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three characters"
            },
            mcadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three characters"
            },
            mczip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters"
            },
            mcphone: {
                required: "Enter Phone Number",
                regex: "Input valid characters",
                minlength: "Enter atleast 7 digits",
                maxlength: "Enter 12 Digit Number"

            },
            mcmobile: {
                required: "Enter Mobile Number",
                regex: "Input valid characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter maximum 12 Digit"

            },
            mcmail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"
            },
            moadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three characters"
            },
            moadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three characters"
            },
            mozip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters"
            },
            mophone: {
                required: "Enter Phone Number",
                regex: "Input valid characters",
                minlength: "Enter atleast 7 digits",
                maxlength: "Enter 12 Digit Number"

            },
            momobile: {
                required: "Enter Mobile Number",
                regex: "Input valid characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter maximum 12 Digit"

            },
            momail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"
            },
            gname: {
                required: "Enter Guardian Name",
                minlength: "Enter atleast three characters",
                regex: "Input valid characters",
                maxlength: "Input Characters Less Than 50 Characters"
            },
            g_unique_identity: {
                required: function() {
                    return "Enter " + $('#uuid_unit_limit_name').val()
                },
                unique_length: function() {
                    return "Enter " + $('#uuid_unit_limit').val() + " Digit " + $('#uuid_unit_limit_name').val()
                },
                unique_type: function() {
                    return "Enter valid " + $('#uuid_unit_limit_name').val()
                }
            },
            gadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three characters"
            },
            gadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three characters"
            },
            gzip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters"
            },
            gphone: {
                required: "Enter Phone Number",
                regex: "Input valid characters",
                minlength: "Enter atleast 7 digits",
                maxlength: "Enter 12 Digit Number"

            },
            gmobile: {
                required: "Enter Mobile Number",
                regex: "Input valid characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 Digit",
                maxlength: "Enter maximum 12 Digit"

            },
            gmail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"
            },
            gcadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three characters"
            },
            gcadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three characters"
            },
            gczip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 Digit",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters",
            },
            gcphone: {
                required: "Enter Phone Number",
                regex: "Input valid characters",
                minlength: "Enter atleast 7 digits ",
                maxlength: "EnterMaximum 12 digits"

            },
            gcmobile: {
                required: "Enter Mobile Number",
                regex: "Input valid characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 digits",
                maxlength: "Enter maximum 12 digits"

            },
            gcmail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 Characher ",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"
            },
            goadd1: {
                required: "Enter Address Line 1",
                minlength: "Enter atleast three characters"
            },
            goadd2: {
                required: "Enter Address Line 2",
                minlength: "Enter atleast three characters"
            },
            gozip: {
                required: "Enter Zip Code",
                minlength: "Enter atleast 6 digits",
                maxlength: "Enter maximum 7 digits",
                regex: "Input valid characters",
            },
            gophone: {
                required: "Enter Phone Number",
                regex: "Input valid characters",
                minlength: "Enter atleast 7 digits ",
                maxlength: "Enter 12 Digit Number"

            },
            gomobile: {
                required: "Enter Mobile Number",
                regex: "Input valid characters",
                remote: "Mobile no already exists",
                minlength: "Enter atleast 9 digits",
                maxlength: "Enter maximum 12 digits"

            },
            gomail: {
                required: "Enter Email ID",
                minlength: "Enter atleast 5 characters",
                maxlength: "Email Id should not exceed 30 Character",
                regex: "Enter valid Email ID",
                email: "Enter valid Email ID",
                remote: "Email Id already exists"
            }
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }

    });
    $(document).ready(function() {

        $('#staff_con').change(function() {
            if ($(this).prop("checked")) {
                $('#forstaffcon').removeClass('notvisible');
                $("#forstaffcon").load(baseurl + 'registration/load-staff-conc-page');
                $("#parentSearch").addClass('notvisible');
            } else {
                $('#forstaffcon').addClass('notvisible');
                $("#parentSearch").removeClass('notvisible');
                /*  $('#forstaffcon').addClass('notvisible');
                  $("#parentSearch").removeClass('notvisible');
                  $('#mthr_com_check_div').removeClass('notvisible');
                  $('#is_parent_update').val(0);
                  $('#father_id').val(0);
                  $('#mother_id').val(0);
                  $('#sibling_student_data_id').val(0);
                  $('#fname').val('');
                  $('#fname').prop('disabled', false);
                  $('#f_unique_identity').val('');
                  $('#f_unique_identity').prop('disabled', false);
                  $("#fprofession").val('');
                  $('#fprofession').trigger('change');
                  $('#fprofession').prop('disabled', false);
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

                  $('#mname').val('');
                  $('#mname').prop('disabled', false);
                  $('#m_unique_identity').val('');
                  $('#m_unique_identity').prop('disabled', false);
                  $("#mprofession").val('');
                  $('#mprofession').trigger('change');
                  $('#mprofession').prop('disabled', false);
                  $('#madd1').val('');
                  $('#madd1').prop('disabled', false);

                  $('#madd2').val('');
                  $('#madd2').prop('disabled', false);

                  $('#madd3').val('');
                  $('#madd3').prop('disabled', false);

                  $('#mzip').val('');
                  $('#mzip').prop('disabled', false);

                  $('#mphone').val('');
                  $('#mphone').prop('disabled', false);

                  $('#mmobile').val('');
                  $('#mmobile').prop('disabled', false);

                  $('#mmail').val('');
                  $('#mmail').prop('disabled', false);

                  $('#moadd1').val('');
                  $('#moadd1').prop('disabled', false);

                  $('#moadd2').val('');
                  $('#moadd2').prop('disabled', false);

                  $('#moadd3').val('');
                  $('#moadd3').prop('disabled', false);

                  $('#mozip').val('');
                  $('#mozip').prop('disabled', false);

                  $('#mophone').val('');
                  $('#mophone').prop('disabled', false);

                  $('#momobile').val('');
                  $('#momobile').prop('disabled', false);

                  $('#momail').val('');
                  $('#momail').prop('disabled', false);

                  $('#mcadd1').val('');
                  $('#mcadd1').prop('disabled', false);

                  $('#mcadd2').val('');
                  $('#mcadd2').prop('disabled', false);

                  $('#mcadd3').val('');
                  $('#mcadd3').prop('disabled', false);

                  $('#mczip').val('');
                  $('#mczip').prop('disabled', false);

                  $('#mcphone').val('');
                  $('#mcphone').prop('disabled', false);

                  $('#mcmobile').val('');
                  $('#mcmobile').prop('disabled', false);

                  $('#mcmail').val('');
                  $('#mcmail').prop('disabled', false);*/

            }
        });
    });
</script>