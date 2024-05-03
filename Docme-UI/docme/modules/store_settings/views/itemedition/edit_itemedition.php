<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="ibox-tools" id="edit_type" >
        <span><a href="javascript:void(0);"  onclick="close_add_itemedition();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C8; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>
</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('itemedition/edit-itemedition', array('id' => 'edition_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Item Edition </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('edition_name')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('id', isset($id) ? $id: ''); ?>" id="id" name="id" />
                    <input type="text" class="form-control text-uppercase"  name="edition_name" id="edition_name" value="<?php echo set_value('edition_name', isset($edition_name) ? $edition_name : ''); ?>" />
                </div>                           
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>






<script type="text/javascript">


    function toggle_edit_panel() {
        if ($('#edition_add').is(":visible") == true) {
            $("#edition_add").slideUp("slow", function () {
                $("#edition_add").hide();
            });
        }
    }

    function clear_controls() {
        $('#edition_name').val('');
    }

</script>