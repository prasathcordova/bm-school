<div class="ibox-title">
    <h5><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></h5>
    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type" >
        <span><a href="javascript:void(0);"  onclick="toggle_edit_panel();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>

</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('', array('id' => 'fee_type_edit_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Fee Type</b>
            <!-- Added by SALAHUDHEEN May 29-->
            <span class="mandatory" > *</span>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('feeTypeName')) {
                    echo 'has-error';
                }
                ?> "> 
                     <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
                    <input type="hidden" value="<?php echo set_value('fee_type_id', isset($fee_type_id) ? $fee_type_id : ''); ?>" id="fee_type_id" name="fee_type_id" />
                    <input type="text" class="form-control " maxlength="20"  name="feeTypeName" id="feeTypeName" value="<?php echo set_value('feeTypeName', isset($feeTypeName) ? $feeTypeName : ''); ?>" />
                </div>                           
            </div>
        </div>






        <?php echo form_close(); ?>
    </div>
</div>



<script type="text/javascript">


    function toggle_edit_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function () {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }

    function clear_controls() {
        $('#feeTypeName').val('');

    }

</script>