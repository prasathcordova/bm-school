<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></h5>
                <div class="ibox-tools">
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_edit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                </div>

            </div>
            <div class="ibox-content">
                <?php
                //var_dump($feetermdata);
                echo form_open('', array('id' => 'feecode_edit_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="title_data" id="title_data" value="<?php echo $title; ?>" />
                <div class="row clearfix">

                    <div class="col-lg-12">
                        <div class="form-group <?php
                                                if (form_error('demand_type')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Fee Allocation Type</label><span class="mandatory"> *</span><br />
                            <?php //var_dump($demand_type); 
                            ?>
                            <select name="demand_type" id="demand_type" class="form-control " onchange="type_changed1(this);" style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($demand_type) && !empty($demand_type)) {
                                    foreach ($demand_type as $demand_type_data) {
                                        echo '<option value ="' . $demand_type_data['id'] . '" data-toggle="tooltip" title="' . $demand_type_data['type_desc'] . '"  ' . set_select('demand_type',  $demand_type_data['id'], isset($demand_type_select) && $demand_type_select == $demand_type_data['id'] ? TRUE : FALSE) . '  >' . $demand_type_data['type_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('demand_type', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Added by SALAHUDHEEN May 27-->
                        <div class="form-group">
                            <label>Fee Code</label><span class="mandatory"> *</span>
                            <div class="form-line <?php
                                                    if (form_error('fee_code')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="10" name="fees_code" readonly="" id="fees_code" value="<?php echo set_value('fees_code', isset($fees_code) ? $fees_code : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Added by SALAHUDHEEN May 27-->
                        <div class="form-group">
                            <label>Description</label><span class="mandatory"> *</span>
                            <div class="form-line <?php
                                                    if (form_error('description')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" name="description" readonly="" maxlength="20" id="description" value="<?php echo set_value('description', isset($description) ? $description : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Added by SALAHUDHEEN May 27-->
                        <div class="form-group">
                            <label>Fee Shortcode</label>
                            <div class="form-line <?php
                                                    if (form_error('fee_shortcode')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" name="fee_shortcode" readonly="" maxlength="3" id="fee_shortcode" value="<?php echo set_value('fee_shortcode', isset($fee_shortcode) ? $fee_shortcode : substr($description, 0, 3)); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group <?php
                                                if (form_error('is_vat')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label><?php echo print_tax_vat(); ?> Applicable</label><span class="mandatory"> *</span><br />

                            <select name="is_vat" id="is_vat" onchange="change_is_vat();" class="form-control " style="width:100%;">

                                <option value="-2" <?php echo  set_select('is_vat', '-2', isset($is_vat) && $is_vat == -2 ? TRUE : FALSE); ?>>Select</option>
                                <option value="1" <?php echo  set_select('is_vat', '1', isset($is_vat) && $is_vat == 1 ? TRUE : FALSE); ?>>Yes</option>
                                <option value="-1" <?php echo  set_select('is_vat', '-1', isset($is_vat) && ($is_vat == 0 || $is_vat == -1) ? TRUE : FALSE); ?>>No</option>
                            </select>
                            <?php echo form_error('is_vat', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label><?php echo print_tax_vat(); ?> % (If applicable)</label>
                            <div class="form-line <?php
                                                    if (form_error('vat_percent')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control" onkeypress="return validateDec(event)" onpast="return false" name="vat_percent" id="vat_percent" maxlength="5" <?php if ($is_vat != 1) {
                                                                                                                                                                                            echo 'readonly=""';
                                                                                                                                                                                        }  ?> value="<?php echo set_value('vat_percent', isset($vat_percent) ? $vat_percent : '0'); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6">
                        <div class="form-group <?php
                                                if (form_error('feetype_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Fee Type</label><span class="mandatory"> *</span><br />
                            <select name="feetype_select" id="feetype_select" class="form-control " style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($fee_type) && !empty($fee_type)) {
                                    foreach ($fee_type as $fee_type_data) {
                                        echo '<option value ="' . $fee_type_data['id'] . '" ' . set_select('is_vat',  $fee_type_data['id'], isset($feetype_select) && $feetype_select == $fee_type_data['id'] ? TRUE : FALSE) . ' >' . $fee_type_data['feeTypeName'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('feetype_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group <?php
                                                if (form_error('account_code_data')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Account Code</label><span class="mandatory"> *</span><br />
                            <select name="account_code_data" id="account_code_data" class="form-control " style="width:100%;">
                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($account_code) && !empty($account_code)) {
                                    foreach ($account_code as $account_code_data) {
                                        echo '<option value ="' . $account_code_data['id'] . '" data-toggle="tooltip" title="' . $account_code_data['accountDescription'] . '" ' . set_select('account_code_data',  $account_code_data['id'], isset($account_code_data_select) && $account_code_data_select == $account_code_data['id'] ? TRUE : FALSE) . ' >' . $account_code_data['accountCode'] . '(' . $account_code_data['accountDescription'] . ')' . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('account_code_data', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-6" id="demandselect">
                        <div class="form-group <?php
                                                if (form_error('demand_frequency')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <span id="viewdemandfrequency">
                                <label>Frequency Type</label><span class="mandatory"> *</span><br />

                                <select name="demand_frequency" id="demand_frequency" class="form-control " style="width:100%;" onchange="view_term(this);">

                                    <option selected value="-1">Select</option>
                                    <?php
                                    if (isset($demand_frequency) && !empty($demand_frequency)) {
                                        foreach ($demand_frequency as $demand_frequency_data) {
                                            echo '<option value ="' . $demand_frequency_data['id'] . '" data-monthspan="' . $demand_frequency_data['monthSpan'] . '" data-recurring="' . $demand_frequency_data['is_recurring'] . '" ' . set_select('demand_frequency',  $demand_frequency_data['id'], isset($demand_frequency_select) && $demand_frequency_select == $demand_frequency_data['id'] ? TRUE : FALSE) . ' >' . $demand_frequency_data['frequencyName'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('demand_frequency', '<div class="form-error">', '</div>'); ?>
                            </span>
                        </div>
                    </div>
                    <!-- <?php //if ($monthSpan == -3 && $is_recurring == 3) $disp = '';
                            //else $disp = 'style="display:none;"'; 
                            ?> -->
                    <!-- <div class="col-lg-12" id="viewtermdetails" <?php echo $disp ?>>
                        <div class="">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30%">Term Name</th>
                                        <th width="30%">Term From Date</th>
                                        <th width="30%">Term To Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($feetermdata['data'] as $ftd) { ?>
                                        <tr>
                                            <td><?php echo $ftd['Term_Name']; ?></td>
                                            <td><?php echo $ftd['term_fromdate']; ?></td>
                                            <td><?php echo $ftd['term_todate']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
            });
        }
    }
    $('#is_vat').select2({
        'theme': 'bootstrap'
    });
    $('#feetype_select').select2({
        'theme': 'bootstrap'
    });
    $('#demand_frequency').select2({
        'theme': 'bootstrap'
    });
    $('.demand_frequency').select2({
        'theme': 'bootstrap'
    });
    $('#account_code_data').select2({
        'theme': 'bootstrap'
    });
    $('#demand_type').select2({
        'theme': 'bootstrap'
    });



    function change_is_vat() {
        if ($('#is_vat ').val() == 1) {
            $('#vat_percent').removeAttr('readonly')
        } else if ($('#is_vat ').val() == -1) {
            $('#vat_percent').attr('readonly', 'true')
            $('#vat_percent').val('0');
        }
    }
    $('body').on('blur', '#description', function() {
        var str = $('#description').val();
        var res = str.substring(0, 3);
        $('#fee_shortcode').val(res);
    });
    //Function to allow only Decimal values to textbox
    function validateDec(key) {
        //getting key code of pressed key
        var keycode = (key.which) ? key.which : key.keyCode;
        //comparing pressed keycodes
        if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57)) {
            return false;
        } else {
            var parts = key.srcElement.value.split('.');
            if (parts.length > 1 && keycode == 46)
                return false;
            return true;
        }
    }
</script>