<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_add_course();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            
             <div class="body"> 
                <?php 
                echo form_open('course/add-course', array('id' => 'course_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    
                    <div class="col-md-6">
                        <div class="form-group <?php
                        if (form_error('category_select')) {
                            echo 'has-error';
                        }
                        ?>">
                            <label>Category</label><span class="mandatory" > *</span><br/>

                            <select name="category_select" id="category_select"  class="form-control " style="width:100%;" >                                

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($category_data) && !empty($category_data)) {
                                    foreach ($category_data as $category) {
                                        echo '<option value ="' . $category['Course_Type_ID'] . '">' . $category['Category'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('category_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Course Name</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('Description')) {
                                echo 'has-error';
                            } 
                            ?> "> 
                                <input type="text" class="form-control text-uppercase"  name="Description" id="Description" value="<?php echo set_value('Description', isset($Description)?$Description:'');  ?>" />
                            </div>                           
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

                        <?php echo form_close(); ?>
                    </div>
                </div>
            
            
        </div>

    </div>
</div>