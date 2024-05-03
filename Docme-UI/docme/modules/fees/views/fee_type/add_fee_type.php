<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_panel();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
                <?php
                echo form_open('', array('id' => 'feetype_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Fee Type</b>
                        <!-- Added by SALAHUDHEEN May 29-->
                        <span class="mandatory" > *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('fee_type_name')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control" placeholder="Enter Fee Type" name="fee_type_name" maxlength="20" id="fee_type_name" value="<?php echo set_value('fee_type_name', isset($fee_type_name) ? $fee_type_name : ''); ?>" />
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
            $("#curd-content").slideUp("slow", function () {
                $("#curd-content").hide();
                $('#add_type').show();
            });
        }
    }

    function clear_controls() {
        $('#fee_type_name').val('');
    }
</script>
