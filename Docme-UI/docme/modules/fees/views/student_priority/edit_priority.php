<div class="ibox-title">
        <h5><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></h5>
        <div class="clearfix"></div>
            <div class="ibox-tools" id="edit_type" >
                <span><a href="javascript:void(0);"  onclick="close_add_country();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
            </div>

        </div>
           <div class="ibox-content">
                <div class="row">
                                    <?php
                        echo form_open('country/edit-country', array('id' => 'country_save', 'role' => 'form'));
                        ?>
                        <div class="col-md-6">
                            <b>Priority</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                if (form_error('fee_code')) {
                                    echo 'has-error';
                                }
                                ?> "> 
                                    <input type="hidden" value="<?php // echo set_value('country_id', isset($country_id) ? $country_id : ''); ?>" id="country_id" name="country_id" />
                                    <input type="text" class="form-control"  name="fee_code" id="fee_code" value="<?php // echo set_value('country_name', isset($country_name) ? $country_name : ''); ?>" />
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
                                   
                                    <input type="text" class="form-control text-uppercase"  name="description" id="description" value="<?php // echo set_value('country_abbr', isset($country_abbr) ? $country_abbr : ''); ?>" />
                                </div>                           
                            </div>
                        </div>
                         
                     
                    
                     
                        
                        <?php echo form_close(); ?>
                    </div>
                </div>
           
        

    <script type="text/javascript">


        function toggle_edit_panel() {
            if ($('#country_add').is(":visible") == true) {
                $("#country_add").slideUp("slow", function () {
                    $("#country_add").hide();
                });
            }
        }

        function clear_controls() {
            $('#country_name').val('');
            $('#country_abbr').val('');
            //$('#currency_select').selectpicker('deselectAll');
        }

    </script>