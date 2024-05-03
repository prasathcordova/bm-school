<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 5px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('', array('id' => 'fee_template_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <!--<div class="row clearfix" > Commented By SALAHUDHEEN May 29, 2019 -->
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b><?php echo 'Template Name'; ?></b>
                        <!-- Mandatory Added by SALAHUDHEEN May 29-->
                        <span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('template_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <!--                                    maxlength="10"-->
                                <input type="text" tabindex="1" class="form-control" maxlength="40" placeholder="Enter Template Name" name="template_name" id="template_name" value="<?php echo set_value('template_name', isset($template_name) ? $template_name : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b><?php echo 'Template Description'; ?></b>
                        <!-- Mandatory Added by SALAHUDHEEN May 29-->
                        <span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('template_desc')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" tabindex="3" class="form-control" maxlength="60" placeholder="Enter Template Description" name="template_desc" id="template_desc" value="<?php echo set_value('template_desc', isset($template_desc) ? $template_desc : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label>Class linked with the template</label><span class="mandatory"> *</span><br />
                            <div class="form-line">
                                <select data-placeholder="Class" multiple id="class_selector" name="class_selector" tabindex="4" style="width:100% !important;">
                                    <option value="">Select</option>
                                    <?php
                                    if (isset($class_data) && !empty($class_data)) {
                                        foreach ($class_data as $class_value) {
                                            echo '<option value="' . $class_value['Course_Det_ID'] . '">' . $class_value['Description'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
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

    function clear_controls() {
        $('#template_name').val('');
        $('#template_desc').val('');
        $('#class_selector ').val('-1').trigger('change');
    }
</script>