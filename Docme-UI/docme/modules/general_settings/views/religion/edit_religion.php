<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type">
        <span><a href="javascript:void(0)" onclick="close_add_religion();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>

    </div>
</div>

<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('religion/edit-religion', array('id' => 'religion_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Religion Name</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('religion_name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="hidden" value="<?php echo set_value('religion_id', isset($religion_id) ? $religion_id : ''); ?>" id="religion_id" name="religion_id" />
                    <input type="text" class="form-control text-uppercase" maxlength="30" placeholder="Enter Religion Name" name="religion_name" id="religion_name" value="<?php echo set_value('religion_name', isset($religion_name) ? $religion_name : ''); ?>" />
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script>
    $('#religion_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>



<script type="text/javascript">
    function toggle_edit_panel() {
        if ($('#religion_add').is(":visible") == true) {
            $("#religion_add").slideUp("slow", function() {
                $("#religion_add").hide();
            });
        }
    }

    function clear_controls() {
        $('#religion_name').val('');
    }
</script>