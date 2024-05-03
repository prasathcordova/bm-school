<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0)" onclick="close_add_profession();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" data-toggle="tooltip" data-placement="right" title="Save" class="material-icons">save</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" data-toggle="tooltip" data-placement="right" title="Refresh" class="material-icons ">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('profession/add-profession', array('id' => 'profession_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Profession Name</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('profession_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="30" placeholder="Enter Profession Name" name="profession_name" id="profession_name" value="<?php echo set_value('profession_name', isset($profession_name) ? $profession_name : '');  ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Profession Code</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('profession_code')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" maxlength="15" placeholder="Enter Profession code" name="profession_code" id="profession_code" value="<?php echo set_value('profession_code', isset($profession_code) ? $profession_code : '');  ?>" />
                            </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $('#profession_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>