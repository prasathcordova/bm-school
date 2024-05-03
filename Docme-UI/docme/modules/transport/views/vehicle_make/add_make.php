<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('', array('id' => 'vehiclemake_save', 'role' => 'form'));
                ?>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Vehicle Make <span class="mandatory">*</span></b>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('vehiclemake')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" placeholder="Vehicle Make" maxlength="50" class="form-control alphanumeric" name="vehiclemake" id="vehiclemake" value="<?php echo set_value('vehiclemake', isset($vehiclemake) ? $vehiclemake : ''); ?>" />
                            </div>
                        </div>

                    </div>
                </div>
                <?php echo form_close(); ?>
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
        $('#vehiclemake').val('');

    }
</script>