<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0)" onclick="close_add_currency();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="submit_data('<?php echo $studentID; ?>');"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('sponserd_stud/add_sponser', array('id' => 'sponsers_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Sponsor Name</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('sponser_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control" placeholder="Enter sponsor name" name="sponser_name" id="sponser_name" value="<?php echo set_value('currency_name', isset($currency_name) ? $currency_name : '');  ?>" maxlength="30" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Sponsor Address</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('sponser_add')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control" placeholder="Enter Sponsor Address" name="sponser_add" id="sponser_add" value="<?php echo set_value('currency_abbr', isset($currency_abbr) ? $currency_abbr : '');  ?>" maxlength="15" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Sponsor Email</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('sponser_email')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control" placeholder="Enter Sponsor Email" name="sponser_email" id="sponser_email" value="<?php echo set_value('sponser_email', isset($sponser_email) ? $sponser_email : '');  ?>" maxlength="50" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Sponsor Mobile Number</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('sponser_mob_no')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control" placeholder="Enter Sponsor Mobile Number" name="sponser_mobile" id="sponser_mobile" value="<?php echo set_value('sponser_mobile', isset($sponser_mobile) ? $sponser_mobile : '');  ?>" maxlength="10" onkeypress="return typeNumberOnly(event)" />
                                <input type="hidden" id="student_id" value="<?php echo $studentID; ?>">
                            </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>