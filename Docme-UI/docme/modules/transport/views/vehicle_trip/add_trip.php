<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;color: #1c84c6;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_panel();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
                <?php
                echo form_open('', array('id' => 'trip_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6">                    
                        <b>Trip</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('trip')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" maxlength="10" class="form-control" name="trip" id="trip" value="<?php echo set_value('trip', isset($trip) ? $trip : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                     
                        <b>Description</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('description')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" maxlength="10" class="form-control" name="description" id="description" value="<?php echo set_value('description', isset($description) ? $description : ''); ?>" />
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
                $('#search-feecode').show()
            });
        }
    }

    function clear_controls() {
        $('#trip').val('');
        $('#description').val('');       
    }

</script>