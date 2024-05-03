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
        echo form_open('curency/edit-curency', array('id' => 'currency_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Currency Name</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('currency_name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="hidden" value="<?php echo set_value('currency_id', isset($currency_id) ? $currency_id : ''); ?>" id="currency_id" name="currency_id" />
                    <input type="text" class="form-control text-uppercase" name="currency_name" id="currency_name" value="<?php echo set_value('currency_name', isset($currency_name) ? $currency_name : ''); ?>" maxlength="30" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <b>Currency Abbreviation</b><span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('currency_abbr')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="hidden" value="<?php echo set_value('currency_id', isset($currency_id) ? $currency_id : ''); ?>" id="currency_id" name="currency_id" />
                    <input type="text" class="form-control text-uppercase" name="currency_abbr" id="currency_abbr" value="<?php echo set_value('currency_abbr', isset($currency_abbr) ? $currency_abbr : ''); ?>" maxlength="5" />
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $('#currency_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>

<script type="text/javascript">
    function toggle_edit_panel() {
        if ($('#currency_add').is(":visible") == true) {
            $("#currency_add").slideUp("slow", function() {
                $("#currency_add").hide();
            });
        }
    }

    function clear_controls() {
        $('#currency_name').val('');
        $('#currency_abbr').val('');
        //$('#currency_select').selectpicker('deselectAll');
    }
</script>