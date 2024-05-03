<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_add_itemedition();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
                <?php
                echo form_open('itemediton/add-itemedition', array('id' => 'edition_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Item Edition </b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('edition_name')) {
                                echo 'has-error';
                            }
                            ?> "> 
                                <input type="text" class="form-control text-uppercase"  name="edition_name" id="edition_name" value="<?php echo set_value('edition_name', isset($edition_name) ? $edition_name : ''); ?>" />
                            </div>                           
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>