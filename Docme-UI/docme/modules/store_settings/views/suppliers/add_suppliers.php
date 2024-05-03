<!--
Description of add_suppliers

 @author Saranya kumar G
-->


<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_add_suppliers();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C8; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
                <?php
                echo form_open('suppliers/add-suppliers', array('id' => 'suppliers_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Supplier Name*</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('name')) {
                                echo 'has-error';
                            }
                            ?> "> 
                                <input type="text" class="form-control text-uppercase" maxlength="100"  name="name" id="name" value="<?php echo set_value('name', isset($name) ? $name : ''); ?>" />
                            </div>                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Supplier Code*</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('code')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="50" name="code" id="code" value="<?php echo set_value('code', isset($code) ? $code : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Address1* </b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('address1')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="200" name="address1" id="address1" value="<?php echo set_value('address1', isset($address1) ? $address1 : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Address2* </b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('address1')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="200" name="address2" id="address2" value="<?php echo set_value('address2', isset($address2) ? $address2 : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Address3* </b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('address1')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="200" name="address3" id="address3" value="<?php echo set_value('address3', isset($address3) ? $address3 : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Contact* </b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('address1')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="50" name="contact" id="contact" value="<?php echo set_value('contact', isset($contact) ? $contact : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Email Id* </b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('emailid')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="150" name="emailid" id="emailid" value="<?php echo set_value('emailid', isset($emailid) ? $emailid : ''); ?>" />
                            </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>