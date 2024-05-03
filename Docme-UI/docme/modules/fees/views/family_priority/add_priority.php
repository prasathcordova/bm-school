<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_add_country();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
                <?php 
                echo form_open('fees/add-feecode', array('id' => 'feecode_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
<!--                    <div class="col-md-6">
                        <b>Country Name</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('fee_code')) {
                                echo 'has-error';
                            } 
                            ?> "> 
                                <input type="text" class="form-control text-uppercase"  name="fee_code" id="fee_code" value="<?php echo set_value('fee_code', isset($fee_code)?$fee_code:'');  ?>" />
                            </div>                           
                        </div>
                    </div>-->
                    <div class="col-md-6">
                        <b><?php // echo $account_code;?></b>
                        <b><?php echo 'Priority';?></b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('fee_code')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" name="fees_code" id="fees_code" value="<?php echo set_value('fees_code', isset($fees_code)?$fees_code:'');  ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b><?php // echo $description;?></b>
                        <b><?php echo 'Description';?></b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('fee_code')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" name="fees_code" id="fees_code" value="<?php echo set_value('fees_code', isset($fees_code)?$fees_code:'');  ?>" />
                            </div>
                        </div>
                    </div>
                   
                     
                      
                      
                             
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>