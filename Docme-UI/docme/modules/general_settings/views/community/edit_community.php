<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type">
        <span><a href="javascript:void(0)" onclick="close_add_community();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>

    </div>
</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('community/edit-community', array('id' => 'community_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Community Name</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('community_name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="hidden" value="<?php echo set_value('community_id', isset($community_id) ? $community_id : ''); ?>" id="community_id" name="community_id" />
                    <input type="text" class="form-control text-uppercase" placeholder="Enter Community Name" name="community_name" id="community_name" value="<?php echo set_value('community_name', isset($community_name) ? $community_name : ''); ?>" maxlength="30" />
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $('#community_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>

<script type="text/javascript">
    function toggle_edit_panel() {
        if ($('#community_add').is(":visible") == true) {
            $("#community_add").slideUp("slow", function() {
                $("#community_add").hide();
            });
        }
    }

    function clear_controls() {
        $('#community_name').val('');
        //$('#community_select').selectpicker('deselectAll');
    }
</script>