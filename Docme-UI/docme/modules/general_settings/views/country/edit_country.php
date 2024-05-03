<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type">
        <span><a href="javascript:void(0)" onclick="close_add_country();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>

</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('country/edit-country', array('id' => 'country_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Country Name</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('country_name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="hidden" value="<?php echo set_value('country_id', isset($country_id) ? $country_id : ''); ?>" id="country_id" name="country_id" />
                    <input type="text" placeholder="Enter country name" class="form-control text-uppercase" name="country_name" id="country_name" value="<?php echo set_value('country_name', isset($country_name) ? $country_name : ''); ?>" maxlength="30" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <b>Country Abbreviation</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('country_abbr')) {
                                            echo 'has-error';
                                        }
                                        ?> ">

                    <input type="text" class="form-control text-uppercase" name="country_abbr" id="country_abbr" value="<?php echo set_value('country_abbr', isset($country_abbr) ? $country_abbr : ''); ?>" maxlength="15" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <b>Nationality </b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('country_nation')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="text" class="form-control text-uppercase" name="country_nation" id="country_nation" value="<?php echo set_value('country_nation', isset($country_nation) ? $country_nation : ''); ?>" maxlength="30" />
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group <?php
                                    if (form_error('currency_select')) {
                                        echo 'has-error';
                                    }
                                    ?>">

                <label class=" lbl_ajus">Currency Name</label><span class="mandatory"> *</span><br />
                <input type="hidden" name="load" value="0" />

                <select name="currency_select" id="currency_select" class="form-control capitalize" style="width:100%;" data-live-search="true">
                    <?php echo set_select('currency_select', '-1'); ?>
                    <option value="-1" selected>Select</option>

                    <?php
                    $currency_selected = isset($currency_select) ? $currency_select : $country_data['currency_id'];
                    if (isset($currency_data) && !empty($currency_data)) {
                        foreach ($currency_data as $currency) {
                            if (isset($currency_selected) && !empty($currency_selected) && $currency_selected == $currency['currency_id']) {
                                echo '<option selected value = "' . $currency['currency_id'] . '" >' . $currency['currency_name'] . "</option>";
                            } else {
                                echo '<option value = "' . $currency['currency_id'] . '" >' . $currency['currency_name'] . "</option>";
                            }
                        }
                    }
                    ?>




                </select>
                <?php echo form_error('currency_select', '<div class="form-error">', '</div>'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script>
    $('#country_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>
<script type="text/javascript">
    function toggle_edit_panel() {
        if ($('#country_add').is(":visible") == true) {
            $("#country_add").slideUp("slow", function() {
                $("#country_add").hide();
            });
        }
    }

    function clear_controls() {
        $('#country_name').val('');
        $('#country_abbr').val('');
        //$('#currency_select').selectpicker('deselectAll');
    }
</script>