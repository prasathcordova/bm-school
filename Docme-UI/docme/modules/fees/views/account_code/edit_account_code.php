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
        echo form_open('', array('id' => 'account_code_edit_save', 'role' => 'form'));
        ?>
        <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
        <input type="hidden" value="<?php echo $account_data['id']; ?>" name="account_code_id" id="account_code_id" />
             
        <div class="col-md-6">
            <b>Account Code</b>
            <!-- Added by SALAHUDHEEN May 29-->
            <span class="mandatory" > *</span>
            <div class="form-group">
                <div class="form-line <?php                    
                if (form_error('account_code')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('id', isset($account_data['id']) ? $account_data['id'] : ''); ?>" id="account_code_id" name="account_code_id" />
                    <input type="text" maxlength="10" class="form-control "  name="account_code" id="account_codes" value="<?php echo set_value('account_code', isset($account_data['accountCode']) ? $account_data['accountCode'] : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Description</b>
            <!-- Added by SALAHUDHEEN May 29-->
            <span class="mandatory" > *</span>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('description')) {
                    echo 'has-error';
                }
                ?> "> 

                    <input type="text" maxlength="20" class="form-control "  name="description" id="description" value="<?php echo set_value('account_desc', isset($account_data['accountDescription']) ? $account_data['accountDescription'] : '');   ?>" />
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
        $('#account_code').val('');
        $('#description').val('');       
    }

</script>