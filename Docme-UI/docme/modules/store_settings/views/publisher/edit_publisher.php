<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="ibox-tools" id="edit_type" >
        <span><a href="javascript:void(0);"  onclick="close_add_publisher();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons">close</i></a> </span>
        <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C8; padding-right: 10px;" class="material-icons">save</i></a> </span>
    </div>
</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('publisher/edit-publisher', array('id' => 'publisher_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Name </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('pub_name')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('pub_id', isset($pub_id) ? $pub_id: ''); ?>" id="pub_id" name="pub_id" />
                    <input type="text" class="form-control text-uppercase"  name="pub_name" id="pub_name" value="<?php echo set_value('pub_name', isset($name) ? $name : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Code</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('pub_code')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" class="form-control text-uppercase"  name="pub_code" id="pub_code" value="<?php echo set_value('pub_code', isset($code) ? $code : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Address1</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('pub_address1')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" class="form-control text-uppercase"  name="pub_address1" id="pub_address1" value="<?php echo set_value('pub_address1', isset($address1) ? $address1 : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Address2 </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('pub_address2')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" class="form-control text-uppercase"  name="pub_address2" id="pub_address2" value="<?php echo set_value('pub_address2', isset($address2) ? $address2 : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Address3</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('pub_address3')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" class="form-control text-uppercase"  name="pub_address3" id="pub_address3" value="<?php echo set_value('pub_address3', isset($address3) ? $address3 : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Contact</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('pub_contact')) {
                    echo 'has-error';
                }
                ?> ">
                    <input type="text" class="form-control text-uppercase"  name="pub_contact" id="pub_contact" value="<?php echo set_value('pub_contact', isset($contact) ? $contact : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>E-mail</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('pub_email')) {
                    echo 'has-error';
                }
                ?> ">
                    <input type="text" class="form-control text-uppercase"  name="pub_email" id="pub_email" value="<?php echo set_value('pub_email', isset($email) ? $email : ''); ?>" />
                </div>                           
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>






<script type="text/javascript">


    function toggle_edit_panel() {
        if ($('#publisher_add').is(":visible") == true) {
            $("#publisher_add").slideUp("slow", function () {
                $("#publisher_add").hide();
            });
        }
    }

    function clear_controls() {
        $('#name').val('');
        $('#code').val('');
        $('#address1').val('');
        $('#address2').val('');
        $('#address3').val('');
        $('#contact').val('');
        $('#email').val('');
    }

</script>





