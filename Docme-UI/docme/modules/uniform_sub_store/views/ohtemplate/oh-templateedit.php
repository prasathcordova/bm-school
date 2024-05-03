<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="uniform_close_add_ohtemplate();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="uniform_submit_edit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="uniform_refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
                <?php 
                echo form_open('ohtemplate/add-ohtemplate', array('id' => 'ohtemplate_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="oh_id" id="oh_id" value="<?php echo $oh_data['id'] ?>" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Name</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('oh_name')) {
                                echo 'has-error';
                            } 
                            ?> "> 
                                <input type="text" maxlength="30" class="form-control text-uppercase"  name="oh_name" id="oh_name" value="<?php echo $oh_data['name'] ?>" />
                            </div>                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Description</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('oh_description')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" maxlength="150" class="form-control text-uppercase" name="oh_description" id="oh_description" value="<?php echo $oh_data['description'] ?>" />
                            </div>
                        </div>
                    </div>
                  
                     
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>