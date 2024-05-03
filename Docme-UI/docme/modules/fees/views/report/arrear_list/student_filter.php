<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="report_param_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="body">

                        <div class="row" id="">
                            <div class="col-md-12">
                                <!-- <div class="panel panel-info">
                                <div class="panel-heading">
                                    <i class="fa fa-info-circle" style="padding-right:10px;"></i>Arrear Report
                                    <a href="javascript:void(0)" onclick="load_fee_student();" id="close_button" data-toggle="tooltip" title="Close" style="float: right; color: #B22222;"><i class="fa fa-close"></i></a>
                                </div>
                                <div class="panel-body"> -->

                                <h3 id="advanced_search_h">Student Search
                                    <hr>
                                </h3>

                                <div id="advanced_search" class="row">
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group ">
                                            <label>Academic Year :</label>
                                            <select onchange="changed_class();" class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%" onchange="load_batch_data();" disabled>
                                                <?php
                                                if (isset($acdyr_data) && !empty($acdyr_data)) {
                                                    foreach ($acdyr_data as $acd) {

                                                        if (isset($acd['Acd_ID']) && !empty($acd['Acd_ID']) && $this->session->userdata('acd_year') == $acd['Acd_ID']) {
                                                            echo '<option selected value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                        }
                                                        //                                                            echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <div class="form-group <?php
                                                                if (form_error('stream_id')) {
                                                                    echo 'has-error';
                                                                }
                                                                ?>">
                                            <label>Stream</label><span class="mandatory"> *</span><br />

                                            <select name="stream_id" id="stream_id" class="form-control " style="width:100%;" onchange="changed_class();">

                                                <!-- <option selected value="-1">Select</option> -->
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

                                            <select name="class_id" id="class_id" class="form-control " style="width:100%;" onchange="changed_class();">
                                                <!--<select name="class_id" id="class_id"  class="form-control " style="width:100%;" >-->
                                                <option selected value="-1">All Class</option>
                                                <!-- <option selected value="-1">Select</option> -->
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
                                    <div class="col-lg-6 col-xs-12 col-md-12">
                                        <b>Batch</b>
                                        <div class="form-group">
                                            <div>
                                                <select class="select2_registration form-control" id="batch_id" name="batch_id">
                                                    <option selected value="-1">All Batches</option>
                                                    <?php
                                                    // if (isset($batch_data) && !empty($batch_data)) {
                                                    //     echo '<option selected value="-1">All Selected</option>';
                                                    //     foreach ($batch_data as $batch) {
                                                    //         echo '<option value="' . $batch['BatchID'] . '">' . $batch['Batch_Name'] . '</option>';
                                                    //     }
                                                    // }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-12">

                                            <div class="form-group">
                                                <div class="form-line">
                                                    <div class="input-group"> <span class="input-group-btn">
                                                            <button id="btn_id_2" type="button" class="btn btn-primary" onclick="export_report_for_arrear_list();"><i class="fa fa-upload"></i> &nbsp;Export Report
                                                            </button> </span></div>
                                                </div>
                                            </div>

                                        </div> -->
                                    <div class="col-lg-12 col-md-12 col-xs-12" align="left">
                                        <!-- <a href="javascript:void(0);" class="btn btn-info btn-md" onclick="export_report_for_arrear_list();"><i class="fa fa-file-pdf-o"></i> GET REPORT</a> -->
                                        <a href="javascript:void(0);" class="btn btn-info btn-md" onclick="submit_data(1);"><i class="fa fa-file-pdf-o"></i> GET REPORT</a>
                                        <a href="javascript:void(0);" class="btn btn-warning btn-md" onclick="submit_data(2);" style="cursor:pointer;"><i class="fa fa-file-excel-o"></i> Export to Excel</a> 
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="student-data-container"></div>

                            <!-- </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("#close_button").hide();

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



    function changed_class() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        if (class_id == -1) {
            $('#batch_id').empty().trigger("change");
            var bit = 0;
            $('#batch_id').append("<option value='-1' selected>All Batches</option>");
            $('#batch_id').trigger('change');
        } else {
            //        var class_data = JSON.stringify(class_id);
            var ops_url = baseurl + 'fees/preload/get-batchdetails-for-arrear-report/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "stream_id": stream_id,
                    "academic_year": academic_year,
                    "session_id": session_id,
                    "class_id": class_id
                },
                success: function(result) {
                    $('#batch_id').empty().trigger("change");
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        var batchdata = data.data;
                        $('#batch_id').empty().trigger("change");
                        var bit = 0;
                        $('#batch_id').append("<option value='-1'>All Batches</option>");
                        $.each(batchdata, function(i, v) {
                            bit = bit + 1;
                            $('#batch_id').append("<option value='" + v.BatchID + "' bitdata-data ='" + bit + "' >" + v.Batch_Name + "</option>");
                        });
                        $('#batch_id').trigger('change');
                    } else {
                        $('#batch_id').empty().trigger("change");
                    }
                }
            });
        }
    }

    function submit_data(rpt_type = 1) {
        // alert($('#batch_id').val().trim().length);
        // if ($('#batch_id').val().trim().length > 2) {
        $('#report_param_loader').addClass('sk-loading');

        var class_id = $('#class_id').val();
        var batch_id = $('#batch_id').val().trim();
        var academic_year = $('#academic_year').val();
        var batch_name = $('#batch_id :selected').text().trim();
        var ops_url = baseurl + 'fees/report/get-report-for-arrear-list-with-batch/';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "class_id": class_id,
                "batch_id": batch_id,
                "batch_name": batch_name,
                "academic_year": academic_year,
                "type": 2,
                "rpt_type": rpt_type

            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 3) {
                        if (datas.message) {
                            swal('', datas.message, 'info');
                            $('#report_param_loader').removeClass('sk-loading');
                            return false;
                        } else {
                            $('#report_param_loader').removeClass('sk-loading');
                            swal('', 'No Reports Available', 'info')
                        }
                    } else if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#report_param_loader').removeClass('sk-loading');
                    }
                } catch (e) {
                    $('#report_param_loader').removeClass('sk-loading');
                    //'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001'
                    swal('', e.message, 'info');
                    return false;
                }
            }
        });
        // } else {
        //     swal('', 'Please check the input are valid', 'info');
        //     return false;
        // }
    }

    function export_report_for_arrear_list() {

        if ($('#batch_id').val().trim().length > 2) {
            $('#report_param_loader').addClass('sk-loading');

            var batch_id = $('#batch_id').val().trim();
            var batch_name = $('#batch_id :selected').text().trim();
            var ops_url = baseurl + 'fees/report/get-report-for-arrear-list-with-batch/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "batch_id": batch_id,
                    "batch_name": batch_name
                },
                success: function(result) {
                    //                         $('#report_content').html(result);
                    //                         return false
                    try {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            $('#report_param_loader').removeClass('sk-loading');
                            var $a = $("<a>");
                            $a.attr("href", data.link);
                            $("body").append($a);
                            $a.attr("download", "arrear_students_list.xlsx");
                            $a[0].click();
                            $a.remove();
                        } else if (data.status == 2) {
                            if (data.message) {
                                swal('', data.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                            }
                        } else if (data.status == 3) {
                            if (data.message) {
                                swal('', data.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                            }
                        } else {
                            if (data.message) {
                                swal('', data.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                            }
                        }
                    } catch (e) {
                        $('#report_param_loader').removeClass('sk-loading');
                        swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                        return false;
                    }


                }
            });
        } else {
            //swal('', 'Please check the input are valid', 'info');
            swal('', 'Select Class', 'warning');
            return false;
        }
    }
</script>