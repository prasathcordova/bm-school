<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_add_batch();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('batch/add-batch', array('id' => 'batch_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="form-group <?php
                                                if (form_error('acdyr_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Academic Year</label><span class="mandatory"> *</span><br />

                            <select name="acdyr_select" id="acdyr_select" class="form-control " style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($acdyr_data) && !empty($acdyr_data)) {
                                    foreach ($acdyr_data as $acdyr) {
                                        echo '<option value ="' . $acdyr['Acd_ID'] . '">' . $acdyr['Description'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('acdyr_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group <?php
                                                if (form_error('class_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Class</label><span class="mandatory"> *</span><br />

                            <select name="class_select" id="class_select" class="form-control " style="width:100%;" onchange="add_batch_code()">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($class_data) && !empty($class_data)) {
                                    foreach ($class_data as $class) {
                                        echo '<option value ="' . $class['Course_Det_ID'] . '" data-classname="' . $class['Description'] . '">' . $class['Description'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('class_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php
                                                if (form_error('stream_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Stream</label><span class="mandatory"> *</span><br />

                            <select name="stream_select" id="stream_select" class="form-control " style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($stream_data) && !empty($stream_data)) {
                                    foreach ($stream_data as $stream) {
                                        echo '<option value ="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                        //                                        echo '<option value ="' . $stream['stream_id'] . '" data-streamselect="' . $stream['stream_code'] . '">' . $stream['description'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('stream_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="form-group <?php
                                                if (form_error('session_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Session</label><span class="mandatory"> *</span><br />

                            <select name="session_select" id="session_select" class="form-control " style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($session_data) && !empty($session_data)) {
                                    foreach ($session_data as $session) {
                                        echo '<option value ="' . $session['Session_ID'] . '">' . $session['Description'] . '</option>';
                                        //                                        echo '<option value ="' . $session['Session_ID'] . '" data-sessionselect="' . $session['Session_code'] . '">' . $session['Description'] . '</option>';
                                    }
                                }
                                ?>

                            </select>
                            <?php echo form_error('session_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php
                                                if (form_error('medium_select')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Medium</label><span class="mandatory"> *</span><br />

                            <select name="medium_select" id="medium_select" class="form-control " style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($medium_data) && !empty($medium_data)) {
                                    foreach ($medium_data as $medium) {
                                        echo '<option value ="' . $medium['Medium_ID'] . '">' . $medium['Description'] . '</option>';
                                        //                                         echo '<option value ="' . $medium['Session_ID'] . '" data-mediumselect="' . $medium['Medium_Code'] . '">' . $medium['Description'] . '</option>';
                                    }
                                }
                                ?>

                            </select>
                            <?php echo form_error('medium_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Division</label><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('division')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">

                                <input type="text" class="form-control text-uppercase alphaNoSpace" name="division" id="division" value="<?php echo set_value('division', isset($division) ? $division : ''); ?>" maxlength="3" />
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
                                <!--                                add maximum length attribute by vinoth @ 25-05-2019 14:39-->
                                <input type="text" class="form-control text-uppercase allownumericwithdecimal" onchange="valuedisplay()" name="Boys" id="Boys" value="<?php echo set_value('Boys', isset($Boys) ? $Boys : ''); ?>" maxlength="3" />
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
                                <!--                                add maximum length attribute by vinoth @ 25-05-2019 14:39-->
                                <input type="text" class="form-control text-uppercase allownumericwithdecimal" onchange="valuedisplay()" name="Girls" id="Girls" value="<?php echo set_value('Girls', isset($Girls) ? $Girls : ''); ?>" maxlength="3" />
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
                                <input type="text" class="form-control text-uppercase alphanumeric" maxlength="10" name="batch_code" id="batch_code" value="<?php echo set_value('batch_code', isset($batch_code) ? $batch_code : ''); ?>" />

                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $("#acdyr_select").select2({
        "theme": "bootstrap"
    });
    $("#class_select").select2({
        "theme": "bootstrap"
    });
    $("#stream_select").select2({
        "theme": "bootstrap"
    });
    $("#session_select").select2({
        "theme": "bootstrap"
    });
    $("#medium_select").select2({
        "theme": "bootstrap"
    });

    function add_batch_code() {
        //$('body').on('change', '#class_select', function() {
        //var option = $("#class_select").select2().find(":selected").data("classname");
        //var option = $('#class_select option:selected').attr('data-classname')
        //var option = $('option:selected', this).attr('classname');
        //alert(option);
        //});
    }

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

    //    function batch_join(){
    //        var classs = $("#class_select :selected").text();
    //        var divisn = $("#division").val().toUpperCase();
    //        var stream = $("#stream_select :selected").text();
    //        var session = $("#session_select :selected").text();
    //        var medium = $("#medium_select :selected").text();
    //        var acdyr = $("#acdyr_select :selected").text();
    //        var batch_name = classs + '/' + divisn+ '/' + stream + '/' + session + '/' + medium + '/' + acdyr;
    //        $("#Batch_Name").val(batch_name);
    //    }
</script>