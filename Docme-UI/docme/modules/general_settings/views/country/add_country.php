<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0)" onclick="close_add_country();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('country/add-country', array('id' => 'country_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Country Name</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('country_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" placeholder="Enter country name" name="country_name" id="country_name" value="<?php echo set_value('country_name', isset($country_name) ? $country_name : '');  ?>" maxlength="30" />
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
                                <input type="text" class="form-control text-uppercase" placeholder="Enter country abbreviation" name="country_abbr" id="country_abbr" value="<?php echo set_value('country_abbr', isset($country_abbr) ? $country_abbr : '');  ?>" maxlength="15" />
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
                                <input type="text" class="form-control text-uppercase" placeholder="Enter nationality" name="country_nation" id="country_nation" value="<?php echo set_value('country_nation', isset($country_nation) ? $country_nation : '');  ?>" maxlength="30" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php
                                                if (form_error('currency_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <!--                            create label class by vinoth @ 28-05-2019 12:34-->
                            <label class="lbl_ajus">Currency Name</label><span class="mandatory"> *</span><br />
                            <select name="currency_select" id="currency_select" class="form-control " style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($currency_data) && !empty($currency_data)) {
                                    foreach ($currency_data as $currency) {
                                        echo '<option value ="' . $currency['currency_id'] . '">' . $currency['currency_name'] . '</option>';
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
        </div>

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