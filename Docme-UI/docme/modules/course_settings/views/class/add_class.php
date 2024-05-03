<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_add_class();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
                <?php
                echo form_open('class/add-class', array('id' => 'class_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">


                    <div class="col-md-6">
                        <b>Class Code</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('class_code')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" name="class_code" id="class_code" value="<?php echo set_value('Course_det_code', isset($Course_det_code) ? $Course_det_code : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Class Description</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('class_description')) {
                                echo 'has-error';
                            }
                            ?> ">
                                <input type="text" class="form-control text-uppercase" name="class_description" id="class_description" value="<?php echo set_value('description', isset($Description) ? $Description : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php
                        if (form_error('course_select')) {
                            echo 'has-error';
                        }
                        ?>">
                            <label>Course</label><span class="mandatory" > *</span><br/>

                            <select name="course_select" id="course_select"  class="form-control " style="width:100%;" >                                

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($class_course) && !empty($class_course)) {
                                    foreach ($class_course as $course_class) {
                                        echo '<option value ="' . $course_class['Course_Master_ID'] . '">' . $course_class['Course_Name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('course_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>


                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>