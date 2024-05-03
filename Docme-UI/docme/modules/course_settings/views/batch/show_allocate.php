<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!--<a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Batch" data-placement="left"href="javascript:void(0);" onclick="add_new_batch();"><i class="fa fa-plus"></i>CREATE BATCH</a>-->
                    </div>

                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>


                    <div class="row" id="content-batch">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <?php
                                if (isset($class_data) && !empty($class_data) && is_array($class_data)) {
                                    $breaker = 0;
                                    foreach ($class_data as $class) {
                                        //                                        dev_export($class);die;
                                ?>
                                        <div class="col-lg-3">
                                            <div class="contact-box center-version">
                                                <!--<span class="label label-warning pull-right">Official</span>-->
                                                <a href="javascript:void(0);">

                                                    <h4 class="m-b-xs"><strong><?php echo $class['Description'] ?></strong></h4>
                                                    <input type='hidden' id='classid' name='classid' value="<?php echo $class['Course_Det_ID'] ?>">
                                                </a>
                                                <div class="col-lg-12 col-xs-12 col-md-12">
                                                    <div class="form-group <?php
                                                                            if (form_error('acdyear_select')) {
                                                                                echo 'has-error';
                                                                            }
                                                                            ?>">
                                                        <label>Academic Year</label><span class="mandatory"> *</span><br />

                                                        <select class="select2_acdyear form-control input-sm " style="width:100%" name="acdyear" id="acdyear_<?php echo $class['Course_Det_ID']; ?>">
                                                            <option value="-1">Select</option>
                                                            <?php
                                                            if (isset($acdyear_data) && !empty($acdyear_data)) {
                                                                foreach ($acdyear_data as $acdyear) {
                                                                    if (isset($acdyear['Acd_ID']) && !empty($acdyear['Acd_ID']) && $this->session->userdata('acd_year') == $acdyear['Acd_ID']) {
                                                                        echo '<option selected value="' . $acdyear['Acd_ID'] . '">' . $acdyear['Description'] . '</option>';
                                                                    } else {
                                                                        echo '<option value ="' . $acdyear['Acd_ID'] . '" >' . $acdyear['Description'] . '</option>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <?php echo form_error('acdyear_select', '<div class="form-error">', '</div>'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 col-md-12">
                                                    <div class="form-group <?php
                                                                            if (form_error('stream_select')) {
                                                                                echo 'has-error';
                                                                            }
                                                                            ?>">
                                                        <label>Stream </label><span class="mandatory"> *</span><br />

                                                        <select name="stream" id="stream_<?php echo $class['Course_Det_ID']; ?>" class="form-control input-sm select2_stream" style="width:100%;">

                                                            <!-- <option value="-1">Select</option> -->
                                                            <?php
                                                            if (isset($stream_data) && !empty($stream_data)) {


                                                                foreach ($stream_data as $stream) {
                                                                    if (isset($stream['stream_id']) && !empty($stream['stream_id']) && 1 == $stream['stream_id']) {
                                                                        echo '<option selected value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                                                    } else {
                                                                        echo '<option value ="' . $stream['stream_id'] . '" >' . $stream['description'] . '</option>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <?php echo form_error('acdyear_select', '<div class="form-error">', '</div>'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 col-md-12">
                                                    <div class="form-group <?php
                                                                            if (form_error('stream_select')) {
                                                                                echo 'has-error';
                                                                            }
                                                                            ?>">
                                                        <label>Session</label><span class="mandatory"> *</span><br />
                                                        <select name="session" id="session_<?php echo $class['Course_Det_ID']; ?>" class="form-control input-sm select2_session" style="width:100%;">
                                                            <!--                                                            <option value="-1" selected=""></option>-->
                                                            <?php
                                                            if (isset($session_data) && !empty($session_data)) {
                                                                foreach ($session_data as $session) {
                                                                    if (isset($session['Session_ID']) && !empty($session['Session_ID']) && 1 == $session['Session_ID']) {
                                                                        echo '<option selected value="' . $session['Session_ID'] . '">' . $session['Session_code'] . '</option>';
                                                                    } else {
                                                                        echo '<option value ="' . $session['Session_ID'] . '" >' . $session['Session_code'] . '</option>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <?php echo form_error('session_select', '<div class="form-error">', '</div>'); ?>
                                                    </div>
                                                </div>
                                                <table class="table table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">
                                                                <div class="m-t-xs btn-group">
                                                                    <a href="javascript:void(0);" onclick="load_batchselect(<?php echo $class['Course_Det_ID']; ?>);" class="btn btn-xs btn-info">SELECT</a>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                <?php
                                        if ($breaker == 3) {
                                            echo '<div class="clearfix"></div>';
                                            $breaker = 0;
                                        } else {
                                            $breaker++;
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function load_batchselect(courseid) {
        var acdid = '#acdyear_' + courseid;
        var streamid = '#stream_' + courseid;
        var sessionid = '#session_' + courseid;

        var acdyear = $(acdid).val();
        var stream = $(streamid).val();
        var session = $(sessionid).val();

        if (acdyear == -1) {
            swal('', 'Academic Year is required.', 'info');
            return;
        }
        if (stream == -1) {
            swal('', 'Stream is required.', 'info');
            return;
        }
        if (session == -1) {
            swal('', 'Session is required.', 'info');
            return;
        }

        var ops_url = baseurl + 'course/batch-allocateselect/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "courseid": courseid,
                "acdyear": acdyear,
                "stream": stream,
                "session": session
            },
            success: function(result) {
                var data = JSON.parse(result)
                $('#data-view').html(data.view);
                $("#batch_select").select2({
                    placeholder: "Select a Batch",
                    "theme": "bootstrap"
                });
            }
        });
    }
</script>