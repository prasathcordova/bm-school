<div class="ibox-title">
    <h5><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></h5>
    
    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type" >
        <span><a href="javascript:void(0);"  onclick="toggle_edit_panel();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>

</div>
<div class="ibox-content">
    <div class="row">                                    <?php
        echo form_open('', array('id' => 'vehicle_make_edit_save', 'role' => 'form'));
        ?>
        <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
        <input type="hidden" value="<?php echo $make_data['id']; ?>" name="vehicle_make_id" id="vehicle_make_id" />
             
        <div class="col-md-6">
            <b>Vehicle Make <span class="mandatory">*</span></b>
            <div class="form-group">
                <div class="form-line <?php                    
                if (form_error('vehicle_make')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('id', isset($make_data['id']) ? $make_data['id'] : ''); ?>" id="vehicle_type_id" name="vehicle_type_id" />
                    <input type="text" maxlength="50" placeholder="Vehicle Make" class="form-control "  name="vehicle_make" id="vehicle_make" value="<?php echo set_value('makeName', isset($make_data['makeName']) ? $make_data['makeName'] : ''); ?>" />
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
        $('#vehicle_type').val('');
        $('#description').val('');       
    }

</script>