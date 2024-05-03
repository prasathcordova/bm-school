<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="ibox-tools" id="edit_type" >
        <span><a href="javascript:void(0);"  data-toggle="tooltip" title="Close & return to store list" data-placement="left"  onclick="close_add_store();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons">close</i></a> </span>        
    </div>
</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('store/edit-store', array('id' => 'store_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Store Name </b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('store_name')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('store_id', isset($store_id) ? $store_id : ''); ?>" id="store_id" name="store_id" />
                    <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="store_name" id="store_name" value="<?php echo set_value('store_name', isset($name) ? $name : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Store Code</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('store_code')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="store_code" id="store_code" value="<?php echo set_value('store_code', isset($code) ? $code : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Address1</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('address1')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="address1" id="address1" value="<?php echo set_value('address1', isset($address1) ? $address1 : ''); ?>" />
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
                    <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="address2" id="address2" value="<?php echo set_value('address2', isset($address2) ? $address2 : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Address3</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('address3')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="address3" id="address3" value="<?php echo set_value('address3', isset($address3) ? $address3 : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Phone No</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('phone')) {
                    echo 'has-error';
                }
                ?> ">
                    <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="phone" id="phone" value="<?php echo set_value('phone', isset($contact) ? $contact : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>E-mail</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('email')) {
                    echo 'has-error';
                }
                ?> ">
                    <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="email" id="email" value="<?php echo set_value('email', isset($email) ? $email : ''); ?>" />
                </div>                           
            </div>
        </div>

        <div class="col-md-6">
            <b>Store level </b>
            <div class="form-group" >
                <div class="form-line <?php
                if (form_error('ismain')) {
                    echo 'has-error';
                }
                ?> ">
                         <?php if ($store_data['ismain'] == 1) { ?>  
                        <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="email" id="email" value="Main Store" />
                    <?php } else if ($store_data['issub'] == 1) { ?>
                        <input type="text" readonly="" style="background-color: #FFF;" class="form-control text-uppercase"  name="email" id="email" value="Sub Store" />
                        <?php
                    }
                    ?>

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





