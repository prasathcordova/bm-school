<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="ibox-tools" id="edit_type" >
        <span><a href="javascript:void(0);"  onclick="close_add_class();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);"  onclick="submit_edit_save_data();" > <i style="font-size: 30px !important; float: right; color: #4CAF50; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>

</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('class/edit-class', array('id' => 'class_save', 'role' => 'form'));
        ?>

        <div class="col-md-6">
            <b>Class Code</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('Course_det_code')) {
                    echo 'has-error';
                }
                ?> "> 
                    <input type="hidden" value="<?php echo set_value('course_det_id', isset($course_det_id) ? $course_det_id : ''); ?>" id="course_det_id" name="course_det_id" />

                    <input type="text" class="form-control text-uppercase"  name="Course_det_code" id="Course_det_code" value="<?php echo set_value('Course_det_code', isset($Course_det_code) ? $Course_det_code : ''); ?>" />
                </div>                           
            </div>
        </div>
        <div class="col-md-6">
            <b>Class Description</b>
            <div class="form-group">
                <div class="form-line <?php
                if (form_error('Description')) {
                    echo 'has-error';
                }
                ?> "> 

                    <input type="text" class="form-control text-uppercase"  name="Description" id="Description" value="<?php echo set_value('Description', isset($Description) ? $Description : ''); ?>" />
                </div>                           
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group <?php
            if (form_error('course_select')) {
                echo 'has-error';
            }
            ?>">

                <label>Course</label><span class="mandatory" > *</span><br/>
                <input type="hidden" name="load" value="0"/>
                <select name="course_select" id="course_select"  class="form-control capitalize" style="width:100%;" data-live-search="true">                                
                    <?php echo set_select('course_select', '-1'); ?> 
                    <option value="-1" selected>Select</option>

                    <?php
                    $course_selected = isset($class_data['Course_Type_ID']) ? $class_data['Course_Type_ID'] : '';
                    if (isset($course_data) && !empty($course_data)) {
                        foreach ($course_data as $course) {
                            if (isset($course_selected) && !empty($course_selected) && $course_selected == $course['Course_Type_ID']) {
                                echo '<option selected value = "' . $course['Course_Master_ID'] . '" >' . $course['Course_Name'] . "</option>";
                            } else {
                                echo '<option value = "' . $course['Course_Master_ID'] . '" >' . $course['Course_Name'] . "</option>";
                            }
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



<script type="text/javascript">


    function toggle_edit_panel() {
        if ($('#class_add').is(":visible") == true) {
            $("#class_add").slideUp("slow", function () {
                $("#class_add").hide();
            });
        }
    }

    function clear_controls() {
        $('#class_code').val('');
        $('#class_description').val('');
        //$('#currency_select').selectpicker('deselectAll');
    }

</script>