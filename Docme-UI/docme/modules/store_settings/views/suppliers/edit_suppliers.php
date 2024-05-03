<!-- 
Description of edit_suppliers

 @author Saranya kumar G
-->

<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="ibox-tools" id="edit_type" >
        <span><a href="javascript:void(0);"  onclick="close_add_suppliers();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C8; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>
</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('suppliers/edit-suppliers', array('id' => 'suppliers_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Supplier Name</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('name')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('s_id', isset($s_id) ? $s_id : ''); ?>" id="s_id" name="s_id" />
                    <input type="text" class="form-control text-uppercase"  name="name" id="name" value="<?php echo set_value('name', isset($name) ? $name : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Supplier Code</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('code')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" class="form-control text-uppercase"  name="code" id="code" value="<?php echo set_value('code', isset($code) ? $code : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Address1 </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('address1')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" class="form-control text-uppercase"  name="address1" id="address1" value="<?php echo set_value('address1', isset($address1) ? $address1 : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Address2 </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('address2')) {
                    echo 'has-error';
                }
                ?> "> 

                    <input type="text" class="form-control text-uppercase"  name="address2" id="address2" value="<?php echo set_value('address2', isset($address2) ? $address2 : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Address3 </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('address3')) {
                    echo 'has-error';
                }
                ?> "> 

                    <input type="text" class="form-control text-uppercase"  name="address3" id="address3" value="<?php echo set_value('address3', isset($address3) ? $address3 : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Contact </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('contact')) {
                    echo 'has-error';
                }
                ?> "> 

                    <input type="text" class="form-control text-uppercase"  name="contact" id="contact" value="<?php echo set_value('contact', isset($contact) ? $contact : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Email Id </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('emailid')) {
                    echo 'has-error';
                }
                ?> "> 

                    <input type="text" class="form-control text-uppercase"  name="emailid" id="emailid" value="<?php echo set_value('emailid', isset($emailid) ? $emailid : ''); ?>" />
                </div>                           
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>



<script type="text/javascript">


    function toggle_edit_panel() {
        if ($('#suppliers_add').is(":visible") == true) {
            $("#suppliers_add").slideUp("slow", function () {
                $("#suppliers_add").hide();
            });
        }
    }

    function clear_controls() {
        $('#name').val('');
        $('#suppliers_abbr').val('');
        //$('#currency_select').selectpicker('deselectAll');
    }

</script>