<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="color:#1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="panel-body  panel-body-new">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php echo $sub_title; ?>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group <?php
                                                                if (form_error('stream_id')) {
                                                                    echo 'has-error';
                                                                }
                                                                ?>">
                                            <label>Stream</label><span class="mandatory"> *</span><br />

                                            <select name="stream_id" id="stream_id" class="form-control " style="width:100%;" onchange="changed_class();">
                                                <option selected value="-1">Select</option>
                                                <?php
                                                if (isset($stream_data) && !empty($stream_data)) {
                                                    foreach ($stream_data as $stream) {
                                                        if (isset($stream['stream_id']) && !empty($stream['stream_id']) && 1 == $stream['stream_id']) {
                                                            echo '<option selected value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo form_error('stream_id', '<div class="form-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group <?php
                                                                if (form_error('class_id')) {
                                                                    echo 'has-error';
                                                                }
                                                                ?>">
                                            <label>Class</label><span class="mandatory"> *</span><br />
                                            <select name="class_id" id="class_id" class="form-control " style="width:100%;">
                                                <!--<select name="class_id" id="class_id"  class="form-control " style="width:100%;" >-->

                                                <option selected value="-1">Select</option>
                                                <option value="ALL">ALL</option>
                                                <?php
                                                if (isset($class_data_for_registration) && !empty($class_data_for_registration)) {
                                                    foreach ($class_data_for_registration as $class_for_dive) {

                                                        echo '<option value="' . $class_for_dive['Course_Det_ID'] . '" data-masterid="' . $class_for_dive['Course_Master_ID'] . '"  >' . $class_for_dive['Description'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo form_error('class_id', '<div class="form-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm " onclick="submit_data();"> Report</a>
                                        <!--<a class="btn btn-danger btn-sm" onclick="canceldata();"> Cancel</a>-->
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="student-data-container"></div>

                        </div>
                    </div>


                    <a href="#" style="display:none" id="testpdf"></a>


                </div>
            </div>
        </div>
    </div>
</div>
<div id="report_content"></div>

<style>
    .panel-body-new {
        padding: 0 !important;
    }
</style>

<script type='text/javascript'>
    $("#close_button").hide();
    var input = document.getElementById("searchname");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("search_name_btn").click();
        }

    });
    var input = document.getElementById("sname");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("btn_id_2").click();
        }

    });

    $('#academic_year').select2({
        'theme': 'bootstrap'
    });
    $('#stream_id').select2({
        'theme': 'bootstrap'
    });
    $('#class_id').select2({
        'theme': 'bootstrap'
    });
    $('#batch_id').select2({
        'theme': 'bootstrap'
    });


    /*function changed_class() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
//        var class_data = JSON.stringify(class_id);
        var ops_url = baseurl + 'Transport_report/Transport_report_controller/batchlist_stud_classwise_rpt/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"stream_id": stream_id, "academic_year": academic_year, "session_id": session_id, "class_id": class_id},
            success: function (result) {
                $('#batch_id').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batchdata = data.data;
                    $('#batch_id').empty().trigger("change");
                    var bit = 0;
                    $.each(batchdata, function (i, v) {
                        bit = bit + 1;
                        $('#batch_id').append("<option value='" + v.BatchID + "' bitdata-data ='" + bit + "' >" + v.Batch_Name + "</option>");
                    });
                    $('#batch_id').trigger('change');
                } else {
                    $('#batch_id').empty().trigger("change");
                }
            }
        });
    }*/

    function submit_data() {
        var stream_id = $('#stream_id').val();
        var class_id = $('#class_id').val();
        if (stream_id == -1) {
            swal('', 'Stream is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var ops_url = baseurl + 'transport/stud-classwise-report';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "class_id": class_id,
                "stream_id": stream_id
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#report_param_loader').removeClass('sk-loading');
                        window.open(data.link, '_blank');
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            $('#report_param_loader').removeClass('sk-loading');
                            return false;
                        } else {
                            $('#report_param_loader').removeClass('sk-loading');
                            swal('', 'An error occurred while creating report. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            $('#report_param_loader').removeClass('sk-loading');
                            return false;
                        } else {
                            $('#report_param_loader').removeClass('sk-loading');
                            swal('', 'An error occurred while creating report. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            $('#report_param_loader').removeClass('sk-loading');
                            return false;
                        } else {
                            $('#report_param_loader').removeClass('sk-loading');
                            swal('', 'An error occurred while creating report. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    $('#report_param_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }
</script>