<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type">
        <span><a href="javascript:void(0)" onclick="close_add_currency();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>

</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('sponserd_stud/edit_sponser', array('id' => 'sponser_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Sponsor Name</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('currency_name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="hidden" value="<?php echo set_value('sponser_id', isset($sponser_id) ? $sponser_id : ''); ?>" id="sponser_id" name="sponser_id" />
                    <input type="text" class="form-control" name="sponser_name" id="sponser_name" value="<?php echo set_value('sponser_name', isset($sponser_name) ? $sponser_name : ''); ?>" maxlength="30" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <b>Sponsor Address</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('currency_abbr')) {
                                            echo 'has-error';
                                        }
                                        ?> ">

                    <input type="text" class="form-control" name="sponser_add" id="sponser_add" value="<?php echo set_value('sponser_add', isset($sponser_add) ? $sponser_add : ''); ?>" maxlength="15" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <b>Sponsor Email</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('sponser_email')) {
                                            echo 'has-error';
                                        }
                                        ?> ">

                    <input type="text" class="form-control" placeholder="Enter Sponsors Email" name="sponser_email" id="sponser_email" value="<?php echo set_value('sponser_email', isset($sponser_email) ? $sponser_email : '');  ?>" maxlength="50" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <b>Sponsor Mobile Number</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('sponser_mob_no')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="text" class="form-control" placeholder="Enter Sponsors Mobile Number" name="sponser_mobile" id="sponser_mobile" value="<?php echo set_value('sponser_mobile', isset($sponser_mobile) ? $sponser_mobile : '');  ?>" maxlength="10" onkeypress="return typeNumberOnly(event)" />
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>



<script type="text/javascript">
    function toggle_edit_panel() {
        if ($('#currency_add').is(":visible") == true) {
            $("#currency_add").slideUp("slow", function() {
                $("#currency_add").hide();
            });
        }
    }

    function clear_controls() {
        $('.form-control').val('');
    }
</script>