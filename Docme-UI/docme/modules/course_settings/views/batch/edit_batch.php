<div class="ibox-title">
    <h5><?php echo $title; ?></h5>
    <div class="ibox-tools" id="edit_type">
        <span><a href="javascript:void(0);" onclick="close_add_batch();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>

</div>
<div class="ibox-content">
    <div class="row">
        <?php
        //dev_export($batch_data);
        echo form_open('batch/edit-batch', array('id' => 'batch_save', 'role' => 'form'));
        ?>
        <div class="row clearfix">
            <div class="col-md-4">
                <div class="form-group <?php
                                        if (form_error('acdyr_select')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <label class="control-label">Academic Year</label><span class="mandatory"> *</span>
                    <!--<select class="form-control select" data-live-search="true" data-style="btn-home-basic " >-->
                    <input type="hidden" name="load" value="0" />

                    <input type="hidden" name="BatchID" value="<?php echo set_value('BatchID', isset($BatchID) ? $BatchID : '');  ?>" id="BatchID" />
                    <select id="acdyr_select" name="acdyr_select" class="form-control select capitalize" data-live-search="true">
                        <!--<option  <?php echo set_select('acdyr_select', '-1'); ?> disabled>Select</option>-->
                        <option value="-1" selected>Select</option>
                        <?php
                        $acdyr_selected = isset($batch_data['Acd_Year']) ? $batch_data['Acd_Year'] : '';
                        if (isset($acdyr_data) && !empty($acdyr_data)) {
                            foreach ($acdyr_data as $acd) {
                                if (isset($acdyr_selected) && !empty($acdyr_selected) && $acdyr_selected == $acd['Acd_ID']) {
                                    echo '<option selected value = "' . $acd['Acd_ID'] . '" >' . $acd['Description'] . "</option>";
                                } else {
                                    echo '<option value = "' . $acd['Acd_ID'] . '" >' . $acd['Description'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('acdyr_select', '<div class="control-label">', '</div>'); ?>
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group <?php
                                        if (form_error('class_select')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <label class="control-label">Class</label><span class="mandatory"> *</span>
                    <!--<select class="form-control select" data-live-search="true" data-style="btn-home-basic " >-->
                    <input type="hidden" name="load" value="0" />

                    <select id="class_select" name="class_select" class="form-control select capitalize" data-live-search="true">
                        <!--<option  <?php echo set_select('acdyr_select', '-1'); ?> disabled>Select</option>-->
                        <option value="-1" selected>Select</option>
                        <?php
                        $class_selected = isset($batch_data['Class_id']) ? $batch_data['Class_id'] : '';
                        if (isset($class_data) && !empty($class_data)) {
                            foreach ($class_data as $class) {
                                if (isset($class_selected) && !empty($class_selected) && $class_selected == $class['Course_Det_ID']) {
                                    echo '<option selected value = "' . $class['Course_Det_ID'] . '" >' . $class['Description'] . "</option>";
                                } else {
                                    echo '<option value = "' . $class['Course_Det_ID'] . '" >' . $class['Description'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('class_select', '<div class="control-label">', '</div>'); ?>
                </div>

            </div>

            <div class="col-md-4">
                <div class="form-group <?php
                                        if (form_error('stream_select')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <label class="control-label">Stream</label><span class="mandatory"> *</span>
                    <!--<select class="form-control select" data-live-search="true" data-style="btn-home-basic " >-->
                    <input type="hidden" name="load" value="0" />

                    <select id="stream_select" name="stream_select" class="form-control select capitalize" data-live-search="true">
                        <!--<option  <?php echo set_select('stream_select', '-1'); ?> disabled>Select</option>-->
                        <option value="-1" selected>Select</option>
                        <?php
                        $stream_selected = isset($batch_data['Stream_ID']) ? $batch_data['Stream_ID'] : '';
                        //                            dev_export($stream_selected);die;
                        if (isset($stream_data) && !empty($stream_data)) {
                            foreach ($stream_data as $stream) {
                                if (isset($stream_selected) && !empty($stream_selected) && $stream_selected == $stream['stream_id']) {
                                    echo '<option selected value = "' . $stream['stream_id'] . '" >' . $stream['description'] . "</option>";
                                } else {
                                    echo '<option value = "' . $stream['stream_id'] . '" >' . $stream['description'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('stream_select', '<div class="control-label">', '</div>'); ?>
                </div>

            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-4">
                <div class="form-group <?php
                                        if (form_error('session_select')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <label class="control-label">Session</label><span class="mandatory"> *</span>
                    <!--<select class="form-control select" data-live-search="true" data-style="btn-home-basic " >-->
                    <input type="hidden" name="load" value="0" />

                    <select id="session_select" name="session_select" class="form-control select capitalize" data-live-search="true">
                        <!--<option  <?php echo set_select('stream_select', '-1'); ?> disabled>Select</option>-->
                        <option value="-1" selected>Select</option>
                        <?php
                        $session_selected = isset($batch_data['Session_ID']) ? $batch_data['Session_ID'] : '';
                        if (isset($session_data) && !empty($session_data)) {
                            foreach ($session_data as $session) {
                                if (isset($session_selected) && !empty($session_selected) && $session_selected == $session['Session_ID']) {
                                    echo '<option selected value = "' . $session['Session_ID'] . '" >' . $session['Description'] . "</option>";
                                } else {
                                    echo '<option value = "' . $session['Session_ID'] . '" >' . $session['Description'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('stream_select', '<div class="control-label">', '</div>'); ?>
                </div>

            </div>

            <div class="col-md-4">
                <div class="form-group <?php
                                        if (form_error('medium_select')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <label class="control-label">Medium</label><span class="mandatory"> *</span>
                    <!--<select class="form-control select" data-live-search="true" data-style="btn-home-basic " >-->
                    <input type="hidden" name="load" value="0" />

                    <select id="medium_select" name="medium_select" class="form-control select capitalize" data-live-search="true">
                        <!--<option  <?php echo set_select('medium_select', '-1'); ?> disabled>Select</option>-->
                        <option value="-1" selected>Select</option>
                        <?php
                        $medium_selected = isset($batch_data['Medium_ID']) ? $batch_data['Medium_ID'] : '';
                        if (isset($medium_data) && !empty($medium_data)) {
                            foreach ($medium_data as $med) {
                                if (isset($medium_selected) && !empty($medium_selected) && $medium_selected == $med['Medium_ID']) {
                                    echo '<option selected value = "' . $med['Medium_ID'] . '" >' . $med['Description'] . "</option>";
                                } else {
                                    echo '<option value = "' . $med['Medium_ID'] . '" >' . $med['Description'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php echo form_error('medium_select', '<div class="control-label">', '</div>'); ?>
                </div>

            </div>

            <div class="col-md-4">
                <b>Division</b><span class="mandatory"> *</span>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('division')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" class="form-control text-uppercase" maxlength="6" name="division" id="division" value="<?php echo trim($batch_data['Division']); ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden">
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('Batch_Name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="text" name="Batch_Name" id="Batch_Name" value="<?php echo set_value('Batch_Name', isset($Batch_Name) ? $Batch_Name : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-4">
                <b>Strength</b>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('strength')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" class="form-control text-uppercase" name="strength" id="strength" value="<?php echo set_value('strength', isset($strength) ? $strength : ''); ?>" readonly="" />
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <b>Boys</b><span class="mandatory"> *</span>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('Boys')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" class="form-control text-uppercase allownumericwithdecimal" onchange=" valuedisplay()" name="Boys" id="Boys" value="<?php echo set_value('Boys', isset($Boys) ? $Boys : ''); ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <b>Girls</b><span class="mandatory"> *</span>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('Girls')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" class="form-control text-uppercase allownumericwithdecimal" onchange=" valuedisplay()" name="Girls" id="Girls" value="<?php echo set_value('Girls', isset($Girls) ? $Girls : ''); ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label>Short Code</label><span class="mandatory"> *</span>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('batch_code')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" class="form-control text-uppercase alphanumeric" maxlength="10" name="batch_code" id="batch_code" value="<?php echo set_value('batch_code', isset($batch_data['batch_code']) ? trim($batch_data['batch_code']) : ''); ?>" />
                    </div>
                </div>
            </div>
        </div>


        <?php echo form_close(); ?>
    </div>
</div>



<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which == 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }

    });

    function valuedisplay() {
        var a = $("#Boys").val();
        var b = $("#Girls").val();
        if (a == '') {
            var a = 0
        }
        if (b == '') {
            var b = 0
        }
        var sum = parseInt(a) + parseInt(b);
        $("#strength").val(sum);
    }

    function toggle_edit_panel() {
        if ($('#country_add').is(":visible") == true) {
            $("#country_add").slideUp("slow", function() {
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