<div class="row">

    <div class="form-group col-lg-4 col-xs-12 col-md-12">
        <label>Institution </label><br>
        <select name="emp_inst_id" id="emp_inst_id" class="form-control select2_registration" onchange="fillclear(this.value)" style="width:100%;">
            <option selected value="-1">Select</option>
            <?php
            if (isset($institution_list_data) && !empty($institution_list_data)) {
                if (isset($emp_inst_id) && !empty($emp_inst_id)) {
                    foreach ($institution_list_data as $inst_data) {
                        if ($emp_inst_id == $inst_data['inst_id']) {
                            echo '<option value ="' . $inst_data['inst_id'] . '" selected>' . $inst_data['inst_name'] . ' - ' . $inst_data['inst_place'] . '</option>';
                        }
                    }
                } else {
                    foreach ($institution_list_data as $inst_data) {
                        echo '<option value ="' . $inst_data['inst_id'] . '" >' . $inst_data['inst_name'] . ' - ' . $inst_data['inst_place'] . '</option>';
                    }
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group col-lg-3 col-xs-12 col-md-12">
        <label>Who works in this institution? </label><br>
        <select class="select2_demo_3 form-control" name="who_worked" id="who_worked" onchange="getEmployees(this)">
            <?php if (isset($Empgender) && !empty($Empgender)) {
                if ($Empgender == 'M') { ?>
                    <option selected value="M">Father</option>
                <?php } else { ?>
                    <option selected value="F">Mother</option>
                <?php }
            } else {
                ?>
                <option selected value="-1">Select</option>
                <option value="M">Father</option>
                <option value="F">Mother</option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group col-lg-5 col-xs-12 col-md-12">
        <label>Select Employee </label><br>
        <select class="form-control select2_registration" name="emp_id" id="emp_id" onchange="getDetailsEmp(this)">
            <option value="-1">Select</option>
        </select>
    </div>
</div>
<div class="row" id="aadharWarning">
    <div class="form-group col-lg-12 col-xs-12 col-md-12">
        <div id="aadharalert" class="alert alert-warning notvisible"></div>
    </div>
    <div class="form-group col-lg-12 col-xs-12 col-md-12" id='siblings_view'>

    </div>
</div>


<script>
    $(document).ready(function() {
        // $('#emp_inst_id').prop('disabled',true);
        // $('#emp_id').prop('disabled',true);
    });

    function getDetailsEmp(ele) {
        var emp_id = $(ele).val();
        var inst_id = $('#emp_inst_id').val();
        var who_worked = $('#who_worked').val();
        cleardata();
        if (emp_id != '' && emp_id != -1) {
            var ops_url = baseurl + 'registration/get-employee-details-from-wfm/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "inst_id": inst_id,
                    "emp_id": emp_id
                },
                success: function(result) {
                    var data = $.parseJSON(result);
                    if (data.status == 1) {
                        var empdata = data.data;
                        $.each(empdata, function(i, v) {
                            if (v.AadhaarNo != '' && v.AadhaarNo != null) {
                                ops_url_check = baseurl + 'registration/get-sibling-details-for-staff/';
                                $.ajax({
                                    type: "POST",
                                    cache: false,
                                    async: false,
                                    url: ops_url_check,
                                    data: {
                                        "aadharno": v.AadhaarNo,
                                        "inst_id": inst_id
                                    },
                                    success: function(result) {
                                        var data = $.parseJSON(result);
                                        if (data.status == 1) {
                                            $('#siblings_view').html(data.view);
                                            $('#mthr_com_check_div').addClass('notvisible');
                                            var rawdata = data.raw_data;
                                            var MC_address_nw = '';
                                            var MP_address_nw = '';
                                            var FC_address_nw = '';
                                            var FP_address_nw = '';
                                            $.each(rawdata, function(a, b) {
                                                if (v.Gender == 'M') {
                                                    $('#is_parent_update').val(1);
                                                    $('#father_id').val(b.Father_Id);
                                                    $('#mother_id').val(b.Mother_Id);
                                                    $('#sibling_student_data_id').val(b.sibling_stud_id);
                                                    $('#mname').val(b.Parent_Name);
                                                    $('#mname').prop('disabled', true);
                                                    $('#m_unique_identity').val(b.Adhar_No);
                                                    $('#m_unique_identity').prop('disabled', true);
                                                    $("#mprofession").val(b.Profession);
                                                    $('#mprofession').trigger('change');
                                                    $('#mprofession').prop('disabled', true);

                                                    if (b.Address_Type == 1) {
                                                        if (b.Address1 != '') {
                                                            $('#madd1').val(b.Address1);
                                                            $('#madd1').prop('disabled', true);
                                                        } else {
                                                            $('#madd1').prop('disabled', false);
                                                        }
                                                        if (b.Address2 != '') {
                                                            $('#madd2').val(b.Address2);
                                                            $('#madd2').prop('disabled', true);
                                                        } else {
                                                            $('#madd2').prop('disabled', false);
                                                        }
                                                        if (b.Address3 != '') {
                                                            $('#madd3').val(b.Address3);
                                                            $('#madd3').prop('disabled', true);
                                                        } else {
                                                            $('#madd3').prop('disabled', false);
                                                        }
                                                        if (b.PO_No != '') {
                                                            $('#mzip').val(b.PO_No);
                                                            $('#mzip').prop('disabled', true);
                                                        } else {
                                                            $('#mzip').prop('disabled', false);
                                                        }
                                                        if (b.Phone1 != '') {
                                                            $('#mphone').val(b.Phone1);
                                                            $('#mphone').prop('disabled', true);
                                                        } else {
                                                            $('#mphone').prop('disabled', false);
                                                        }
                                                        if (b.Phone3 != '') {
                                                            $('#mmobile').val(b.Phone3);
                                                            $('#mmobile').prop('disabled', true);
                                                        } else {
                                                            $('#mmobile').prop('disabled', false);
                                                        }
                                                        if (b.Email != '') {
                                                            $('#mmail').val(b.Email);
                                                            $('#mmail').prop('disabled', true);
                                                        } else {
                                                            $('#mmail').prop('disabled', false);
                                                        }

                                                        MC_address_nw = b.Address1 + b.Address2 + b.Address3 + b.PO_No + b.Phone1 + b.Phone3 + b.Email;

                                                    }
                                                    if (b.Address_Type == 2) {
                                                        if (b.Address1 != '') {
                                                            $('#moadd1').val(b.Address1);
                                                            $('#moadd1').prop('disabled', true);
                                                        } else {
                                                            $('#moadd1').prop('disabled', false);
                                                        }
                                                        if (b.Address2 != '') {
                                                            $('#moadd2').val(b.Address2);
                                                            $('#moadd2').prop('disabled', true);
                                                        } else {
                                                            $('#moadd2').prop('disabled', false);
                                                        }
                                                        if (b.Address3 != '') {
                                                            $('#moadd3').val(b.Address3);
                                                            $('#moadd3').prop('disabled', true);
                                                        } else {
                                                            $('#moadd3').prop('disabled', false);
                                                        }
                                                        if (b.PO_No != '') {
                                                            $('#mozip').val(b.PO_No);
                                                            $('#mozip').prop('disabled', true);
                                                        } else {
                                                            $('#mozip').prop('disabled', false);
                                                        }
                                                        if (b.Phone1 != '') {
                                                            $('#mophone').val(b.Phone1);
                                                            $('#mophone').prop('disabled', true);
                                                        } else {
                                                            $('#mophone').prop('disabled', false);
                                                        }
                                                        if (b.Phone3 != '') {
                                                            $('#momobile').val(b.Phone3);
                                                            $('#momobile').prop('disabled', true);
                                                        } else {
                                                            $('#momobile').prop('disabled', false);
                                                        }
                                                        if (b.Email != '') {
                                                            $('#momail').val(b.Email);
                                                            $('#momail').prop('disabled', true);
                                                        } else {
                                                            $('#momail').prop('disabled', false);
                                                        }
                                                    }
                                                    if (b.Address_Type == 3) {

                                                        if (b.Address1 != '') {
                                                            $('#mcadd1').val(b.Address1);
                                                            $('#mcadd1').prop('disabled', true);
                                                        } else {
                                                            $('#mcadd1').prop('disabled', false);
                                                        }
                                                        if (b.Address2 != '') {
                                                            $('#mcadd2').val(b.Address2);
                                                            $('#mcadd2').prop('disabled', true);
                                                        } else {
                                                            $('#mcadd2').prop('disabled', false);
                                                        }
                                                        if (b.Address3 != '') {
                                                            $('#mcadd3').val(b.Address3);
                                                            $('#mcadd3').prop('disabled', true);
                                                        } else {
                                                            $('#mcadd3').prop('disabled', false);
                                                        }
                                                        if (b.PO_No != '') {
                                                            $('#mczip').val(b.PO_No);
                                                            $('#mczip').prop('disabled', true);
                                                        } else {
                                                            $('#mczip').prop('disabled', false);
                                                        }
                                                        if (b.Phone1 != '') {
                                                            $('#mcphone').val(b.Phone1);
                                                            $('#mcphone').prop('disabled', true);
                                                        } else {
                                                            $('#mcphone').prop('disabled', false);
                                                        }
                                                        if (b.Phone3 != '') {
                                                            $('#mcmobile').val(b.Phone3);
                                                            $('#mcmobile').prop('disabled', true);
                                                        } else {
                                                            $('#mcmobile').prop('disabled', false);
                                                        }
                                                        if (b.Email != '') {
                                                            $('#mcmail').val(b.Email);
                                                            $('#mcmail').prop('disabled', true);
                                                        } else {
                                                            $('#mcmail').prop('disabled', false);
                                                        }
                                                        MP_address_nw = b.Address1 + b.Address2 + b.Address3 + b.PO_No + b.Phone1 + b.Phone3 + b.Email;

                                                    }

                                                    if ($.trim(MC_address_nw) == $.trim(MP_address_nw)) {
                                                        $('#mother_check').prop('checked', true);
                                                        $('#mother_check').prop('disabled', true);
                                                    } else {
                                                        $('#mother_check').prop('checked', false);
                                                        $('#mother_check').prop('disabled', false);
                                                    }


                                                } else if (v.Gender == 'F') {
                                                    $('#fname').val(b.Parent_Name);
                                                    $('#is_parent_update').val(1);
                                                    $('#father_id').val(b.Father_Id);
                                                    $('#mother_id').val(b.Mother_Id);
                                                    $('#sibling_student_data_id').val(b.sibling_stud_id);
                                                    $('#fname').prop('disabled', true);
                                                    $('#f_unique_identity').val(b.Adhar_No);
                                                    $('#f_unique_identity').prop('disabled', true);
                                                    $("#fprofession").val(b.Profession);
                                                    $('#fprofession').trigger('change');
                                                    $('#fprofession').prop('disabled', true);

                                                    if (b.Address_Type == 1) {
                                                        if (b.Address1 != '') {
                                                            $('#fadd1').val(b.Address1);
                                                            $('#fadd1').prop('disabled', true);
                                                        } else {
                                                            $('#fadd1').prop('disabled', false);
                                                        }
                                                        if (b.Address2 != '') {
                                                            $('#fadd2').val(b.Address2);
                                                            $('#fadd2').prop('disabled', true);
                                                        } else {
                                                            $('#fadd2').prop('disabled', false);
                                                        }
                                                        if (b.Address3 != '') {
                                                            $('#fadd3').val(b.Address3);
                                                            $('#fadd3').prop('disabled', true);
                                                        } else {
                                                            $('#fadd3').prop('disabled', false);
                                                        }
                                                        if (b.PO_No != '') {
                                                            $('#fzip').val(b.PO_No);
                                                            $('#fzip').prop('disabled', true);
                                                        } else {
                                                            $('#fzip').prop('disabled', false);
                                                        }
                                                        if (b.Phone1 != '') {
                                                            $('#fphone').val(b.Phone1);
                                                            $('#fphone').prop('disabled', true);
                                                        } else {
                                                            $('#fphone').prop('disabled', false);
                                                        }
                                                        if (b.Phone3 != '') {
                                                            $('#fmobile').val(b.Phone3);
                                                            $('#fmobile').prop('disabled', true);
                                                        } else {
                                                            $('#fmobile').prop('disabled', false);
                                                        }
                                                        if (b.Email != '') {
                                                            $('#fmail').val(b.Email);
                                                            $('#fmail').prop('disabled', true);
                                                        } else {
                                                            $('#fmail').prop('disabled', false);
                                                        }
                                                        FC_address_nw = b.Address1 + b.Address2 + b.Address3 + b.PO_No + b.Phone1 + b.Phone3 + b.Email;
                                                    }
                                                    if (b.Address_Type == 2) {
                                                        if (b.Address1 != '') {
                                                            $('#foadd1').val(b.Address1);
                                                            $('#foadd1').prop('disabled', true);
                                                        } else {
                                                            $('#foadd1').prop('disabled', false);
                                                        }
                                                        if (b.Address2 != '') {
                                                            $('#foadd2').val(b.Address2);
                                                            $('#foadd2').prop('disabled', true);
                                                        } else {
                                                            $('#foadd2').prop('disabled', false);
                                                        }
                                                        if (b.Address3 != '') {
                                                            $('#foadd3').val(b.Address3);
                                                            $('#foadd3').prop('disabled', true);
                                                        } else {
                                                            $('#foadd3').prop('disabled', false);
                                                        }
                                                        if (b.PO_No != '') {
                                                            $('#fozip').val(b.PO_No);
                                                            $('#fozip').prop('disabled', true);
                                                        } else {
                                                            $('#fozip').prop('disabled', false);
                                                        }
                                                        if (b.Phone1 != '') {
                                                            $('#fophone').val(b.Phone1);
                                                            $('#fophone').prop('disabled', true);
                                                        } else {
                                                            $('#fophone').prop('disabled', false);
                                                        }
                                                        if (b.Phone3 != '') {
                                                            $('#fomobile').val(b.Phone3);
                                                            $('#fomobile').prop('disabled', true);
                                                        } else {
                                                            $('#fomobile').prop('disabled', false);
                                                        }
                                                        if (b.Email != '') {
                                                            $('#fomail').val(b.Email);
                                                            $('#fomail').prop('disabled', true);
                                                        } else {
                                                            $('#fomail').prop('disabled', false);
                                                        }
                                                    }
                                                    if (b.Address_Type == 3) {
                                                        if (b.Address1 != '') {
                                                            $('#fcadd1').val(b.Address1);
                                                            $('#fcadd1').prop('disabled', true);
                                                        } else {
                                                            $('#fcadd1').prop('disabled', false);
                                                        }
                                                        if (b.Address2 != '') {
                                                            $('#fcadd2').val(b.Address2);
                                                            $('#fcadd2').prop('disabled', true);
                                                        } else {
                                                            $('#fcadd2').prop('disabled', false);
                                                        }
                                                        if (b.Address3 != '') {
                                                            $('#fcadd3').val(b.Address3);
                                                            $('#fcadd3').prop('disabled', true);
                                                        } else {
                                                            $('#fcadd3').prop('disabled', false);
                                                        }
                                                        if (b.PO_No != '') {
                                                            $('#fczip').val(b.PO_No);
                                                            $('#fczip').prop('disabled', true);
                                                        } else {
                                                            $('#fczip').prop('disabled', false);
                                                        }
                                                        if (b.Phone1 != '') {
                                                            $('#fcphone').val(b.Phone1);
                                                            $('#fcphone').prop('disabled', true);
                                                        } else {
                                                            $('#fcphone').prop('disabled', false);
                                                        }
                                                        if (b.Phone3 != '') {
                                                            $('#fcmobile').val(b.Phone3);
                                                            $('#fcmobile').prop('disabled', true);
                                                        } else {
                                                            $('#fcmobile').prop('disabled', false);
                                                        }
                                                        if (b.Email != '') {
                                                            $('#fcmail').val(b.Email);
                                                            $('#fcmail').prop('disabled', true);
                                                        } else {
                                                            $('#fcmail').prop('disabled', false);
                                                        }
                                                        FP_address_nw = b.Address1 + b.Address2 + b.Address3 + b.PO_No + b.Phone1 + b.Phone3 + b.Email;

                                                    }

                                                    if (FC_address_nw == FP_address_nw) {
                                                        $('#father_check').prop('checked', true);
                                                        $('#father_check').prop('disabled', true);
                                                    } else {
                                                        $('#father_check').prop('checked', false);
                                                        $('#father_check').prop('disabled', false);
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
                                if (v.Gender == 'M') {
                                    $('#fname').val(v.Emp_Name);
                                    $('#fname').prop('disabled', true);
                                    $('#f_unique_identity').val(v.AadhaarNo);
                                    $('#f_unique_identity').prop('disabled', true);
                                    $("#fprofession").val(164); //oxford_staff id
                                    $('#fprofession').trigger('change');
                                    $('#fprofession').prop('disabled', true);
                                    var FC_address = '';
                                    var FP_address = '';
                                    if (v.Add_Type == 'C') {
                                        if (v.Add1 != '') {
                                            $('#fadd1').val(v.Add1);
                                            $('#fadd1').prop('disabled', true);
                                        } else {
                                            $('#fadd1').prop('disabled', false);
                                        }
                                        if (v.Add2 != '') {
                                            $('#fadd2').val(v.Add2);
                                            $('#fadd2').prop('disabled', true);
                                        } else {
                                            $('#fadd2').prop('disabled', false);
                                        }
                                        if (v.Add3 != '') {
                                            $('#fadd3').val(v.Add3);
                                            $('#fadd3').prop('disabled', true);
                                        } else {
                                            $('#fadd3').prop('disabled', false);
                                        }
                                        if (v.PBNo != '') {
                                            $('#fzip').val(v.PBNo);
                                            $('#fzip').prop('disabled', true);
                                        } else {
                                            $('#fzip').prop('disabled', false);
                                        }
                                        if (v.Phone != '') {
                                            $('#fphone').val(v.Phone);
                                            $('#fphone').prop('disabled', true);
                                        } else {
                                            $('#fphone').prop('disabled', false);
                                        }
                                        if (v.Mobile != '') {
                                            $('#fmobile').val(v.Mobile);
                                            $('#fmobile').prop('disabled', true);
                                        } else {
                                            $('#fmobile').prop('disabled', false);
                                        }
                                        if (v.EMail != '') {
                                            $('#fmail').val(v.EMail);
                                            $('#fmail').prop('disabled', true);
                                        } else {
                                            $('#fmail').prop('disabled', false);
                                        }

                                        FC_address = v.Add1 + v.Add2 + v.Add3 + v.PBNo + v.Phone + v.Mobile + v.EMail;
                                    }
                                    if (v.Add_Type == 'P') {

                                        if (v.Add1 != '') {
                                            $('#fcadd1').val(v.Add1);
                                            $('#fcadd1').prop('disabled', true);
                                        } else {
                                            $('#fcadd1').prop('disabled', false);
                                        }
                                        if (v.Add2 != '') {
                                            $('#fcadd2').val(v.Add2);
                                            $('#fcadd2').prop('disabled', true);
                                        } else {
                                            $('#fcadd2').prop('disabled', false);
                                        }
                                        if (v.Add3 != '') {
                                            $('#fcadd3').val(v.Add3);
                                            $('#fcadd3').prop('disabled', true);
                                        } else {
                                            $('#fcadd3').prop('disabled', false);
                                        }
                                        if (v.PBNo != '') {
                                            $('#fczip').val(v.PBNo);
                                            $('#fczip').prop('disabled', true);
                                        } else {
                                            $('#fczip').prop('disabled', false);
                                        }
                                        if (v.Phone != '') {
                                            $('#fcphone').val(v.Phone);
                                            $('#fcphone').prop('disabled', true);
                                        } else {
                                            $('#fcphone').prop('disabled', false);
                                        }
                                        if (v.Mobile != '') {
                                            $('#fcmobile').val(v.Mobile);
                                            $('#fcmobile').prop('disabled', true);
                                        } else {
                                            $('#fcmobile').prop('disabled', false);
                                        }
                                        if (v.EMail != '') {
                                            $('#fcmail').val(v.EMail);
                                            $('#fcmail').prop('disabled', true);
                                        } else {
                                            $('#fcmail').prop('disabled', false);
                                        }
                                        FP_address = v.Add1 + v.Add2 + v.Add3 + v.PBNo + v.Phone + v.Mobile + v.EMail;
                                    }
                                    if (FC_address != '') {
                                        if (FC_address == FP_address) {
                                            $('#father_check').prop('checked', true);
                                        } else {
                                            $('#father_check').prop('checked', false);
                                        }
                                    }

                                } else {
                                    $('#mname').val(v.Emp_Name);
                                    $('#mname').prop('disabled', true);
                                    $('#m_unique_identity').val(v.AadhaarNo);
                                    $('#m_unique_identity').prop('disabled', true);
                                    $("#mprofession").val(164);
                                    $('#mprofession').trigger('change');
                                    $('#mprofession').prop('disabled', true);
                                    var MC_address = '';
                                    var MP_address = '';

                                    if (v.Add_Type == 'C') {
                                        if (v.Add1 != '') {
                                            $('#madd1').val(v.Add1);
                                            $('#madd1').prop('disabled', true);
                                        } else {
                                            $('#madd1').prop('disabled', false);
                                        }
                                        if (v.Add2 != '') {
                                            $('#madd2').val(v.Add2);
                                            $('#madd2').prop('disabled', true);
                                        } else {
                                            $('#madd2').prop('disabled', false);
                                        }
                                        if (v.Add3 != '') {
                                            $('#madd3').val(v.Add3);
                                            $('#madd3').prop('disabled', true);
                                        } else {
                                            $('#madd3').prop('disabled', false);
                                        }
                                        if (v.PBNo != '') {
                                            $('#mzip').val(v.PBNo);
                                            $('#mzip').prop('disabled', true);
                                        } else {
                                            $('#mzip').prop('disabled', false);
                                        }
                                        if (v.Phone != '') {
                                            $('#mphone').val(v.Phone);
                                            $('#mphone').prop('disabled', true);
                                        } else {
                                            $('#mphone').prop('disabled', false);
                                        }
                                        if (v.Mobile != '') {
                                            $('#mmobile').val(v.Mobile);
                                            $('#mmobile').prop('disabled', true);
                                        } else {
                                            $('#mmobile').prop('disabled', false);
                                        }
                                        if (v.EMail != '') {
                                            $('#mmail').val(v.EMail);
                                            $('#mmail').prop('disabled', true);
                                        } else {
                                            $('#mmail').prop('disabled', false);
                                        }
                                        MC_address = v.Add1 + v.Add2 + v.Add3 + v.PBNo + v.Phone + v.Mobile + v.EMail;
                                    }
                                    if (v.Add_Type == 'P') {
                                        if (v.Add1 != '') {
                                            $('#mcadd1').val(v.Add1);
                                            $('#mcadd1').prop('disabled', true);
                                        } else {
                                            $('#mcadd1').prop('disabled', false);
                                        }
                                        if (v.Add2 != '') {
                                            $('#mcadd2').val(v.Add2);
                                            $('#mcadd2').prop('disabled', true);
                                        } else {
                                            $('#mcadd2').prop('disabled', false);
                                        }
                                        if (v.Add3 != '') {
                                            $('#mcadd3').val(v.Add3);
                                            $('#mcadd3').prop('disabled', true);
                                        } else {
                                            $('#mcadd3').prop('disabled', false);
                                        }
                                        if (v.PBNo != '') {
                                            $('#mczip').val(v.PBNo);
                                            $('#mczip').prop('disabled', true);
                                        } else {
                                            $('#mczip').prop('disabled', false);
                                        }
                                        if (v.Phone != '') {
                                            $('#mcphone').val(v.Phone);
                                            $('#mcphone').prop('disabled', true);
                                        } else {
                                            $('#mcphone').prop('disabled', false);
                                        }
                                        if (v.Mobile != '') {
                                            $('#mcmobile').val(v.Mobile);
                                            $('#mcmobile').prop('disabled', true);
                                        } else {
                                            $('#mcmobile').prop('disabled', false);
                                        }
                                        if (v.EMail != '') {
                                            $('#mcmail').val(v.EMail);
                                            $('#mcmail').prop('disabled', true);
                                        } else {
                                            $('#mcmail').prop('disabled', false);
                                        }
                                        MP_address = v.Add1 + v.Add2 + v.Add3 + v.PBNo + v.Phone + v.Mobile + v.EMail;
                                    }

                                    if (MC_address != '') {
                                        if (MC_address == MP_address) {
                                            $('#mother_check').prop('checked', true);
                                        } else {
                                            $('#mother_check').prop('checked', false);
                                        }
                                    }
                                }
                                $("#aadharalert").addClass('notvisible');
                                $("#aadharalert").text('');
                                $("#aadharalert").hide();
                            } else {
                                $("#aadharalert").show();
                                $("#aadharalert").removeClass('notvisible');
                                $('#aadharalert').text('Aadhaar Number is mandatory for staff concession.Please update your Aadhaar Number in WFM');
                            }

                        });
                    }

                }
            });
        } else {
            cleardata();
        }
    }

    function fillclear(val) {
        $('#who_worked').empty().trigger("change");
        $('#who_worked').append("<option value='-1' selected>Select</option>");
        $('#who_worked').append("<option value='M'>Father</option>");
        $('#who_worked').append("<option value='F'>Mother</option>");
        $('#who_worked').trigger('change');
        cleardata();
        $('#aadharalert').empty();
        $('#aadharalert').hide();
    }

    function cleardata() {
        $('#siblings_view').empty();
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
        $('#mcmail').prop('disabled', false);
    }
    $(".select2_registration").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
</script>