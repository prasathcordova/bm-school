<div class="ibox-title">
        <h5><?php echo $title; ?></h5>
            <div class="ibox-tools" id="edit_type" >
                <span><a href="javascript:void(0);"  onclick="close_add_course();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
            </div>

        </div>
           <div class="ibox-content">
                <div class="row">
                                    <?php
                        echo form_open('course/edit-course', array('id' => 'course_save', 'role' => 'form'));
                        ?>
                    <div class="row">
                      <div class="col-md-6">
                            <div class="form-group <?php
                            if (form_error('category_select')) {
                                echo 'has-error';
                            }
                            ?>">
                                
                                <label>Category</label><span class="mandatory" > *</span><br/>
                                 <input type="hidden" name="load" value="0"/>
                                <input type="hidden" name="Course_Det_ID" value="<?php echo set_value('Course_Det_ID', isset($Course_Det_ID) ? $Course_Det_ID : '');  ?>" id="Course_Det_ID"/>

                                <select name="category_select" id="category_select"  class="form-control capitalize" style="width:100%;" data-live-search="true">                                
                                    <?php echo set_select('category_select', '-1'); ?> 
                                   <option value="-1" selected>Select</option>
                                    
                                   <?php
                            $category_selected = isset($category_select) ? $category_select : $course_data['Course_Type_ID'];
                            if (isset($category_data) && !empty($category_data)) {
                                foreach ($category_data as $category) {
                                    if (isset($category_selected) && !empty($category_selected) && $category_selected == $category['Course_Type_ID']) {
                                        echo '<option selected value = "' . $category['Course_Type_ID'] . '" >' . $category['Category'] . "</option>";
                                    } else {
                                        echo '<option value = "' . $category['Course_Type_ID'] . '" >' . $category['Category'] . "</option>";
                                    }
                                }
                            }
                            ?>
                                   
                                   
                                   
                                   
                                </select>
                                <?php echo form_error('category_select', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                    
                         <div class="col-md-6">
                            <b>Course Name</b>
                            <div class="form-group <?php
                                if (form_error('Description')) {
                                    echo 'has-error';
                                }
                                ?> "> 
                                  <input type="hidden" name="Course_Det_ID" value="<?php echo set_value('Course_Det_ID', isset($Course_Det_ID) ? $Course_Det_ID : '');  ?>" id="Course_Det_ID"/>

                                    <input type="text" class="form-control text-uppercase"  name="Description" id="Description" value="<?php echo set_value('Description', isset($Description) ? $Description : ''); ?>" />
                            </div>
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <b>Duration</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                if (form_error('Duration')) {
                                    echo 'has-error';
                                }
                                ?> ">
                                    <input type="text" class="form-control text-uppercase" name="Duration" id="Duration" value="<?php echo set_value('Duration', isset($Duration)?$Duration:'');  ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                        

                        
                        
                        <?php echo form_close(); ?>
                    </div>
                </div>
           
        

    <script type="text/javascript">


        function toggle_edit_panel() {
            if ($('#course_add').is(":visible") == true) {
                $("#course_add").slideUp("slow", function () {
                    $("#course_add").hide();
                });
            }
        }

        function clear_controls() {
            $('#country_name').val('');
            $('#country_abbr').val('');
            //$('#category_select').selectpicker('deselectAll');
        }

    </script>