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
        echo form_open('', array('id' => 'trip_edit_save', 'role' => 'form'));
        ?>
        <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
        <input type="hidden" value="<?php echo $trip_data['id']; ?>" name="id" id="id" />
             
        <div class="col-md-6">
            <b>Trip Name</b>
            <div class="form-group">
                <div class="form-line <?php                    
                if (form_error('trip')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('id', isset($trip_data['id']) ? $trip_data['id'] : ''); ?>" id="id" name="id" />
                    <input type="text" maxlength="10" class="form-control "  name="trip" id="trip" value="<?php echo set_value('trip', isset($trip_data['tripName']) ? $trip_data['tripName'] : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Description</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('description')) {
                    echo 'has-error';
                }
                ?> "> 

                    <input type="text" maxlength="10" class="form-control "  name="description" id="description" value="<?php echo set_value('trip_desc', isset($trip_data['tripDescription']) ? $trip_data['tripDescription'] : '');   ?>" />
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
        $('#trip').val('');
        $('#description').val('');       
    }

</script>