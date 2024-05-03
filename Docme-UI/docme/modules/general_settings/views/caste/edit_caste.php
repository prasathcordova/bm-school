    <div class="ibox-title">
        <h5><?php echo $title; ?></h5>
        <div class="clearfix"></div>
        <div class="ibox-tools" id="edit_type">
            <span><a href="javascript:void(0)" onclick="close_add_caste();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close">close</i></a> </span>
            <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Save">save</i></a> </span>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <?php
            echo form_open('caste/edit-caste', array('id' => 'caste_save', 'role' => 'form'));
            ?>
            <div class="col-md-6">
                <div class="form-group <?php
                                        if (form_error('religion_select')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <label class="control-label">Religion Name</label><span class="mandatory"> *</span>
                    <!--<select class="form-control select" data-live-search="true" data-style="btn-home-basic " >-->
                    <input type="hidden" name="load" value="0" />

                    <input type="hidden" name="caste_id" value="<?php echo set_value('caste_id', isset($caste_id) ? $caste_id : '');  ?>" id="caste_id" />
                    <select id="religion_select" name="religion_select" class="form-control select capitalize" data-live-search="true">
                        <!--<option  <?php echo set_select('religion_select', '-1'); ?> disabled>Select</option>-->
                        <option value="-1" selected>Select</option>
                        <?php
                        $religion_selected = isset($religion_select) ? $religion_select : $caste_data['religion_id'];
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
                    <?php echo form_error('religion_select', '<div class="control-label">', '</div>'); ?>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group <?php
                                        if (form_error('community_select')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <label class="control-label">Community Name</label> <span class="mandatory"> *</span>
                    <select id="community_select" name="community_select" class="form-control select capitalize" data-live-search="true">
                        <!--<option  <?php echo set_select('community_select', '-1'); ?> disabled>Select</option>-->
                        <option value="-1" selected>Select</option>
                        <?php
                        $community_selected = isset($community_select) ? $community_select : $caste_data['community_id'];
                        if (isset($community_data) && !empty($community_data)) {
                            foreach ($community_data as $community) {
                                if (isset($community_selected) && !empty($community_selected) && $community_selected == $community['community_id']) {
                                    echo '<option selected value = "' . $community['community_id'] . '" >' . $community['community_name'] . "</option>";
                                } else {
                                    echo '<option value = "' . $community['community_id'] . '" >' . $community['community_name'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>

                    <?php echo form_error('community_select', '<div class="control-label">', '</div>'); ?>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group <?php
                                        if (form_error('caste_name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <label class="control-label">Caste Name</label><span class="mandatory"> *</span>
                    <input type="text" id="caste_name" name="caste_name" placeholder="Caste Name" class="form-control text-uppercase" value="<?php echo set_value('caste_name', isset($caste_data['caste_name']) ? $caste_data['caste_name'] : ''); ?>" maxlength="50" />
                    <?php echo form_error('caste_name', '<div class="control-label">', '</div>'); ?>
                </div>
            </div>
        </div>
        <input type="submit" style="display:none;" id="typer" />
        <?php
        echo form_close();
        ?>
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
    <script type="text/javascript">
        function toggle_edit_panel() {
            if ($('#caste_add').is(":visible") == true) {
                $("#caste_add").slideUp("slow", function() {
                    $("#caste_add").hide();
                });
            }
        }

        function clear_controls() {
            $('#caste_name').val('');
            $('#caste_abbr').val('');
            $('#currency_select').selectpicker('deselectAll');
        }
    </script>