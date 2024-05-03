<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0)" onclick="close_add_city();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>

                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('city/add-city', array('id' => 'city_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="form-line <?php
                                                if (form_error('state_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>State Name</label><span class="mandatory"> *</span><br />

                            <select name="state_select" id="state_select" class="form-control" style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($state_data) && !empty($state_data)) {
                                    foreach ($state_data as $state) {
                                        if (isset($state_selected) && !empty($state_selected) && $state_selected == $state['state_id']) {
                                            echo '<option selected value = "' . $state['state_id'] . '" >' . $state['state_name'] . "</option>";
                                        } else {
                                            if ($state['state_name'] != '') {
                                                echo '<option value = "' . $state['state_id'] . '" >' . $state['state_name'] . "</option>";
                                            }
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('state_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>District Name</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('city_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" placeholder="Enter district Name" name="city_name" id="city_name" value="<?php echo set_value('city_name', isset($city_name) ? $city_name : ''); ?>" maxlength="30" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>District Abbreviation</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('city_description')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" placeholder="Enter district Abbreviation" name="city_abbr" id="city_abbr" value="<?php echo set_value('City Abbreviation', isset($city_abbr) ? $city_abbr : ''); ?>" maxlength="15" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $('#city_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>