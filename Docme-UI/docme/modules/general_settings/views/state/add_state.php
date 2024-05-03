<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0)" onclick="close_add_state();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" data-placement="right" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('state/add-state', array('id' => 'state_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix" id="pagetop">
                    <div class="col-lg-6">
                        <div class="form-line <?php
                                                if (form_error('country_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <b>Country Name *</b>

                            <select name="country_select" id="country_select" class="form-control" style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($country_data) && !empty($country_data)) {
                                    foreach ($country_data as $country) {
                                        if (isset($country_selected) && !empty($country_selected) && $country_selected == $country['country_id']) {
                                            echo '<option selected value = "' . $country['country_id']  . '" >' . $country['country_name'] . "</option>";
                                        } else {
                                            echo '<option value = "' . $country['country_id'] . '" >' . $country['country_name']  . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('country_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>State Name</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('state_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" placeholder="Enter state Name" name="state_name" id="state_name" value="<?php echo set_value('state_name', isset($state_name) ? $state_name : '');  ?>" maxlength="30" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>State Abbreviation</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('state_abbr')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <!--                                change placeholder by vinoth @ 28-05-2019 09:05-->
                                <input type="text" class="form-control text-uppercase" placeholder="Enter State Abbreviation" name="state_abbr" id="state_abbr" value="<?php echo set_value('state_abbr', isset($state_abbr) ? $state_abbr : '');  ?>" maxlength="15" />
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>

    </div>
</div>

<script>
    $('#state_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>