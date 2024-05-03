    <div class="ibox-title">
        <h5><?php echo $title; ?></h5>
        <div class="clearfix"></div>
        <div class="ibox-tools" id="edit_type">
            <span><a href="javascript:void(0)" onclick="close_add_language();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
            <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>

        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <?php
            echo form_open('language/edit-language', array('id' => 'language_save', 'role' => 'form'));
            ?>
            <div class="col-md-6">
                <b>Language </b><span class="mandatory"> *</span>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('language_name')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="hidden" value="<?php echo set_value('language_id', isset($language_id) ? $language_id : ''); ?>" id="language_id" name="language_id" />
                        <input type="text" class="form-control text-uppercase" placeholder="Enter Language Name" maxlength="30" name="language_name" id="language_name" value="<?php echo set_value('language_name', isset($language_name) ? $language_name : ''); ?>" />
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


    <script>
        $('#language_save').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>



    <script type="text/javascript">
        function toggle_edit_panel() {
            if ($('#language_add').is(":visible") == true) {
                $("#language_add").slideUp("slow", function() {
                    $("#language_add").hide();
                });
            }
        }

        function clear_controls() {
            $('#language_name').val('');

            //$('#language_select').selectpicker('deselectAll');
        }
    </script>