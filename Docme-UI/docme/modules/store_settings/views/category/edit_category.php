<div class="ibox-title">
        <h5><?php echo $title; ?></h5>
            <div class="ibox-tools" id="edit_type" >
                <span><a href="javascript:void(0);"  onclick="close_add_category();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
            </div>

        </div>
           <div class="ibox-content">
                <div class="row">
                                    <?php
                        echo form_open('category/edit-category', array('id' => 'category_save', 'role' => 'form'));
                        ?>
                        <div class="col-md-6">
                            <b>Name</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                if (form_error('cate_name')) {
                                    echo 'has-error';
                                }
                                ?> "> 
                                    <input type="hidden" value="<?php echo set_value('cate_id', isset($cate_id) ? $cate_id : ''); ?>" id="cate_id" name="cate_id" />
                                    <input type="text" class="form-control text-uppercase"  name="cate_name" id="cate_name" value="<?php echo set_value('cate_name', isset($cate_name) ? $cate_name : ''); ?>" />
                                </div>                           
                            </div>
                        </div>
                         <div class="col-md-6">
                            <b>Description</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                if (form_error('cate_description')) {
                                    echo 'has-error';
                                }
                                ?> "> 
                                   
                                    <input type="text" class="form-control text-uppercase"  name="cate_description" id="cate_description" value="<?php echo set_value('cate_description', isset($cate_description) ? $cate_description : ''); ?>" />
                                </div>                           
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
           
        

    <script type="text/javascript">


        function toggle_edit_panel() {
            if ($('#category_add').is(":visible") == true) {
                $("#category_add").slideUp("slow", function () {
                    $("#category_add").hide();
                });
            }
        }

        function clear_controls() {
            $('#category_name').val('');
            $('#category_code').val('');
            //$('#currency_select').selectpicker('deselectAll');
        }

    </script>