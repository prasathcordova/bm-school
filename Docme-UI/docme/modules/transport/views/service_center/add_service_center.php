<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('', array('id' => 'servicecenter_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Name *</b>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('service_center_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" maxlength="50" class="form-control" name="service_center_name" id="service_center_name" value="<?php echo set_value('service_center_name', isset($vehicletype) ? $vehicletype : ''); ?>" placeholder="Name" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Location *</b>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('location')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" maxlength="50" class="form-control" name="location" id="location" value="<?php echo set_value('location', isset($description) ? $description : ''); ?>" placeholder="Location" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Email Id *</b>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('email')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="email" placeholder="Email Id" class="form-control" required aria-required="true" name="email" id="email" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Contact Number *</b>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('cnum')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" maxlength="12" class="form-control numeric" name="cnum" id="cnum" value="<?php echo set_value('cnum', isset($description) ? $description : ''); ?>" placeholder="Contact Number" style="text-align: left" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }

    function clear_controls() {
        $('#service_center_name').val('');
        $('#location').val('');
        $('#email').val('');
        $('#cnum').val('');
    }
</script>