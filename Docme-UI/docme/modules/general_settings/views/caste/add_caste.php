<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0)" onclick="close_add_caste();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" data-placement="right" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('caste/add-caste', array('id' => 'caste_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="form-group <?php
                                                if (form_error('religion_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Religion Name</label><span class="mandatory"> *</span><br />

                            <select name="religion_select" id="religion_select" class="form-control" style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($relegion_data) && !empty($relegion_data)) {

                                    foreach ($relegion_data as $religion) {
                                        if (isset($religion_selected) && !empty($religion_selected) && $religion_selected == $religion['religion_id']) {
                                            echo '<option selected value = "' . $religion['religion_id'] . '" >' . $religion['religion_name'] . "</option>";
                                        } else {
                                            echo '<option value = "' . $religion['religion_id'] . '" >' . $religion['religion_name'] . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('religion_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group <?php
                                                if (form_error('community_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Community Name</label><span class="mandatory"> *</span><br />

                            <select name="community_select" id="community_select" class="form-control" style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($community_data) && !empty($community_data)) {

                                    foreach ($community_data as $community) {
                                        //                                                 dev_export($community);die;
                                        if (isset($community_selected) && !empty($community_selected) && $community_selected == $community['community_id']) {
                                            echo '<option selected value = "' . $community['community_id'] . '" >' . $community['community_name'] . "</option>";
                                        } else {
                                            echo '<option value = "' . $community['community_id'] . '" >' . $community['community_name'] . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('community_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Caste Name</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('caste_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" placeholder="Enter Caste Name" name="caste_name" id="caste_name" value="<?php echo set_value('caste_name', isset($caste_name) ? $caste_name : '');  ?>" maxlength="30" />
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
    $('#caste_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>