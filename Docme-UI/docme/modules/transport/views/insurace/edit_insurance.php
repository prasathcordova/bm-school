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
        echo form_open('', array('id' => 'insurance_edit_save', 'role' => 'form'));
        ?>
        <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
        <input type="hidden" value="<?php echo $insurance_data['id']; ?>" name="insurance_id" id="insurance_id" />
             
        <div class="col-md-6">
            <b>Insurance Company Name <span class="mandatory">*</span></b>
            <div class="form-group">
                <div class="form-line <?php                    
                if (form_error('insurance')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('id', isset($insurance_data['id']) ? $insurance_data['id'] : ''); ?>" id="insuranceid" name="insuranceid" />
                    <input type="text" maxlength="50" class="form-control "  name="insurance" id="insurance" placeholder="Insurance Company Name" value="<?php echo set_value('insurance', isset($insurance_data['insuranceName']) ? $insurance_data['insuranceName'] : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Description <span class="mandatory">*</span></b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('description')) {
                    echo 'has-error';
                }
                ?> "> 

                    <input type="text" maxlength="100" class="form-control "  name="description" id="description" placeholder="Description" value="<?php echo set_value('insurance_desc', isset($insurance_data['insuranceDescription']) ? $insurance_data['insuranceDescription'] : '');   ?>" />
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
        $('#insurance').val('');
        $('#description').val('');       
    }

</script>