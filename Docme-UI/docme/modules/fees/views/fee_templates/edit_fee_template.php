<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 5px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_edit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>

                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('', array('id' => 'fee_template_edit_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <input type="hidden" name="template_id" id="template_id" value="<?php echo $id; ?>" />
                <input type="hidden" name="template_name_actual" id="template_name_actual" value="<?php echo $template_name; ?>" />
                <input type="hidden" name="is_student_linked" id="is_student_linked" value="<?php echo $is_student_linked; ?>" />
                <input type="hidden" name="title_data" id="title_data" value="<?php echo $title; ?>" />
                <!--<div class="row clearfix" > Commented By SALAHUDHEEN May 29, 2019 -->
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo 'Template Name'; ?></label>
                            <!-- Mandatory Added by SALAHUDHEEN May 29-->
                            <span class="mandatory"> *</span>
                            <div class="form-line <?php
                                                    if (form_error('template_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <!--                                    maxlength="10" -->
                                <input type="text" tabindex="1" class="form-control" maxlength="40" name="template_name" id="template_name" value="<?php echo set_value('template_name', isset($template_name) ? $template_name : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo 'Template Description'; ?></label>
                            <!-- Mandatory Added by SALAHUDHEEN May 29-->
                            <span class="mandatory"> *</span>
                            <div class="form-line <?php
                                                    if (form_error('template_desc')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" tabindex="3" class="form-control " maxlength="60" name="template_desc" id="template_desc" value="<?php echo set_value('template_desc', isset($template_desc) ? $template_desc : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <?php //dev_export($template_class_data);
                    ?>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label>Class linked with the template</label><span class="mandatory"> *</span><br />
                            <div>
                                <select class="select2" data-placeholder="Class" multiple id="class_selector" name="class_selector" tabindex="4">
                                    <option value="">Select</option>
                                    <?php
                                    $current_class_array = array();
                                    if (isset($class_data) && !empty($class_data)) {
                                        foreach ($class_data as $class_value) {
                                            if (isset($template_class_data) && !empty($template_class_data)) {
                                                $flag = 0;
                                                foreach ($template_class_data as $value) { //$is_student_linked
                                                    //if ($class_value['Course_Det_ID'] == $value['linked_class_detail_id']) {
                                                    if ($class_value['Course_Det_ID'] == $value['linked_class_detail_id']) {
                                                        $current_class_array[] = $value['linked_class_detail_id'];
                                                        $flag = 1;
                                                        if ($value['is_student_linked'] == 1) $lock = 'locked="locked"';
                                                        else $lock = '';
                                    ?>
                                                        <option Selected <?php echo $lock; ?> value="<?php echo $class_value['Course_Det_ID']; ?>"><?php echo $class_value['Description']; ?></option>'

                                                    <?php
                                                    }
                                                }
                                                if ($flag == 0) {
                                                    ?>
                                                    <option value="<?php echo $class_value['Course_Det_ID']; ?>"><?php echo $class_value['Description']; ?></option>'
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="<?php echo $class_value['Course_Det_ID']; ?>"><?php echo $class_value['Description']; ?></option>'
                                    <?php
                                            }
                                        }
                                    }

                                    ?>
                                </select>
                                <input type="hidden" value="<?php echo implode(',', $current_class_array); ?>" name="current_classes" id="current_classes">
                                <?php //dev_export($current_class_array);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!--</div> Commented By SALAHUDHEEN May 29, 2019 -->
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
            });
        }
    }
    $('#class_selector').select2({
        'theme': 'bootstrap'
    });

    $(function() {
        $('.select2').select2({
                tags: true,
                placeholder: 'Select an option',
                templateSelection: function(tag, container) {
                    // here we are finding option element of tag and
                    // if it has property 'locked' we will add class 'locked-tag' 
                    // to be able to style element in select
                    var $option = $('.select2 option[value="' + tag.id + '"]');
                    if ($option.attr('locked')) {
                        $(container).addClass('locked-tag');
                        tag.locked = true;
                    }
                    return tag.text;
                },
            })
            .on('select2:unselecting', function(e) {
                // before removing tag we check option element of tag and 
                // if it has property 'locked' we will create error to prevent all select2 functionality
                if ($(e.params.args.data.element).attr('locked')) {
                    swal('', 'This Class cannot be removed as it is linked with students', 'info');
                    //e.select2.pleaseStop();
                    return false;
                }
            });
    });

    function clear_controls() {
        $('#template_name').val('');
        $('#template_desc').val('');
        $('#class_selector ').val('-1').trigger('change');
    }
</script>
<style>
    /* remove X from locked tag */
    .locked-tag .select2-selection__choice__remove {
        display: none !important;
    }

    /* I suggest to hide  all selected tags from drop down list */
    .select2-results__option[aria-selected="true"] {
        display: none;
    }

    .select2 {
        width: 100% !important;
    }
</style>