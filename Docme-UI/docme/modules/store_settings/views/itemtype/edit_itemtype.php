<div class="ibox-title">
        <h5><?php echo $title; ?></h5>
            <div class="ibox-tools" id="edit_type" >
                <span><a href="javascript:void(0);"  onclick="close_add_itemtype();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
            </div>

        </div>
           <div class="ibox-content">
                <div class="row">
                                    <?php
                        echo form_open('itemtype/edit-itemtype', array('id' => 'itemtype_save', 'role' => 'form'));
                        ?>
                        <div class="col-md-6">
                            <b>Item Type Name</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                if (form_error('itemtype_name')) {
                                    echo 'has-error';
                                }
                                ?> "> 
                                    <input type="hidden" value="<?php echo set_value('itemtype_id', isset($itemtype_id) ? $itemtype_id : ''); ?>" id="itemtype_id" name="itemtype_id" />
                                    <input type="text" class="form-control text-uppercase"  name="itemtype_name" id="itemtype_name" value="<?php echo set_value('itemtype_name', isset($itemtype_name) ? $itemtype_name : ''); ?>" />
                                </div>                           
                            </div>
                        </div>
                         <div class="col-md-6">
                            <b>Item Type Code</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                if (form_error('itemtype_code')) {
                                    echo 'has-error';
                                }
                                ?> "> 
                                   
                                    <input type="text" class="form-control text-uppercase"  name="itemtype_code" id="itemtype_code" value="<?php echo set_value('itemtype_code', isset($itemtype_code) ? $itemtype_code : ''); ?>" />
                                </div>                           
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
           
        

    <script type="text/javascript">


        function toggle_edit_panel() {
            if ($('#itemtype_add').is(":visible") == true) {
                $("#itemtype_add").slideUp("slow", function () {
                    $("#itemtype_add").hide();
                });
            }
        }

        function clear_controls() {
            $('#itemtype_name').val('');
            $('#itemtype_code').val('');
            //$('#currency_select').selectpicker('deselectAll');
        }

    </script>