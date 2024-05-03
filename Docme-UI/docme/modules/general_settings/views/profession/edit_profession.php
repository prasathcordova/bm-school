    <div class="ibox-title">
        <h5><?php echo $title; ?></h5>
        <div class="clearfix"></div>
        <div class="ibox-tools" id="edit_type">
            <span><a href="javascript:void(0)" onclick="close_add_profession();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close">close</i></a> </span>
            <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Save">save</i></a> </span>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <?php
            echo form_open('profession/edit-profession', array('id' => 'profession_save', 'role' => 'form'));
            ?>
            <div class="col-md-6">
                <b>Profession Name</b><span class="mandatory"> *</span>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('profession_name')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="hidden" value="<?php echo set_value('profession_id', isset($profession_id) ? $profession_id : ''); ?>" id="profession_id" name="profession_id" />
                        <input type="text" class="form-control text-uppercase" placeholder="Enter Profession Name" maxlength="30" name="profession_name" id="profession_name" value="<?php echo set_value('profession_name', isset($profession_name) ? $profession_name : ''); ?>" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <b>Profession Code</b><span class="mandatory"> *</span>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('profession_code')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="hidden" value="<?php echo set_value('profession_id', isset($profession_id) ? $profession_id : ''); ?>" id="profession_id" name="profession_id" />
                        <input type="text" class="form-control text-uppercase" placeholder="Enter Profession Code" maxlength="15" name="profession_code" id="profession_code" value="<?php echo set_value('profession_code', isset($profession_code) ? $profession_code : ''); ?>" />
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


    <script>
        $('#profession_save').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>



    <script type="text/javascript">
        function toggle_edit_panel() {
            if ($('#profession_add').is(":visible") == true) {
                $("#profession_add").slideUp("slow", function() {
                    $("#profession_add").hide();
                });
            }
        }

        function clear_controls() {
            $('#profession_name').val('');
            $('#profession_code').val('');

            //$('#language_select').selectpicker('deselectAll');
        }
    </script>