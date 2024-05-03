<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="Rptnation_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-6" id="form_data">
                                <!-- <div class="form-group" id="data_1">
                                    <label for="reportdate">
                                        &nbsp;Report Date:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" data-date-startdate="2017-12-05" autocomplete="off" class="form-control" name="reportdate" id="reportdate" value="<?php echo date('d-m-Y') . " - " . date('d-m-Y'); ?>" />
                                    </div>
                                </div> -->
                                <div class="form-group <?php
                                                        if (form_error('acdyr_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Academic Year</label><span class="mandatory"> *</span><br />
                                    <!--<input type="hidden" value="<?php // echo set_value('Acd_ID', isset($Acd_ID) ? $Acd_ID : '');     
                                                                    ?>" id="Acd_ID" name="Acd_ID" />-->
                                    <select id="acd_year" class="form-control " style="width:100%;">
                                        <option selected value="-1">Select</option>

                                        <?php
                                        if (isset($acdyr_data) && !empty($acdyr_data)) {
                                            foreach ($acdyr_data as $acdyr) {
                                                // dev_export($acdyr_data);die;
                                                if (isset($acdyr_selected) && !empty($acdyr_selected) && $acdyr_selected == $acdyr['Acd_ID']) {
                                                    echo '<option selected value = "' . $acdyr['Acd_ID'] . '" >' . $acdyr['Description'] . "</option>";
                                                } else {
                                                    echo '<option value = "' . $acdyr['Acd_ID'] . '" >' . $acdyr['Description'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('acd_year', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php
                                                        if (form_error('class_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Class</label><span class="mandatory"> *</span><br />

                                    <select name="class_select" id="class_select" class="form-control " style="width:100%;">

                                        <!-- <option selected value="-1">Select</option> -->
                                        <option selected value="-1">ALL CLASSES</option>
                                        <?php
                                        if (isset($class_data) && !empty($class_data)) {
                                            foreach ($class_data as $class) {
                                                echo '<option value ="' . $class['Course_Det_ID'] . '">' . $class['Description'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('class_select', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data_for_detained_report(1);"> Report</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data_for_detained_report(2);"> Export to Excel</a>

                            </div>
                        </div>
                        <a href="#" style="display:none" id="testpdf"></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $('#reportdate').daterangepicker({
        //        "startDate": moment().format('MM-DD-YYYY'),
        //        "endDate": moment().format('MM-DD-YYYY'),
        "autoApply": true,
        "alwaysShowCalendars": true,
        format: 'DD-MM-YYYY',

    });

    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#class_select').select2({
        'theme': 'bootstrap'
    });

    function submit_data_for_detained_report(rpt_type) {
        $('#Rptnation_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var class_ID = $('#class_select').val();

        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptnation_loader').removeClass('sk-loading');
            return;
        }
        // if (class_ID == -1) {
        //     swal('', 'Class is required.', 'info');
        //     return;
        // }
        var ops_url = baseurl + 'report/get-detained-report';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "class_id": class_ID,
                "rpt_type": rpt_type
                // "new_admission": new_admission,
            },
            success: function(data) {
                console.log(data);
                try {
                    var datas = JSON.parse(data);
                    console.log(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#Rptnation_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#Rptnation_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#Rptnation_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#Rptnation_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    // function submit_data_for_detained_report() {
    //     if ($('#reportdate').val() == '') {
    //         swal('', 'Select Report Date', 'info');
    //         return false;
    //     }
    //     var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
    //     var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');

    //     if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
    //         swal('', 'Select a valid date range', 'info');
    //         return false;
    //     }
    //     if (moment(startdate).isValid() && moment(enddate).isValid()) {
    //         var ops_url = baseurl + 'report/get-detained-report/';
    //         $.ajax({
    //             type: "POST",
    //             cache: false,
    //             async: false,
    //             url: ops_url,
    //             data: {
    //                 "load": 1,
    //                 "startdate": startdate,
    //                 "enddate": enddate
    //             },
    //             success: function(data) {
    //                 try {
    //                     var datas = JSON.parse(data);
    //                     if (datas.status == 1) {
    //                         window.open(datas.message, '_blank');
    //                         $('#report_param_loader').removeClass('sk-loading');
    //                     } else {
    //                         if (datas.status == 3) {
    //                             if (datas.message) {
    //                                 swal('', datas.message, 'info');
    //                                 $('#report_param_loader').removeClass('sk-loading');
    //                                 return false;
    //                             } else {
    //                                 $('#report_param_loader').removeClass('sk-loading');
    //                                 swal('', 'No Reports Available', 'info')
    //                             }
    //                         }
    //                     }
    //                 } catch (e) {
    //                     $('#report_param_loader').removeClass('sk-loading');
    //                     swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
    //                     return false;
    //                 }
    //             }
    //         });
    //     } else {
    //         swal('', 'Please check the input are valid', 'info');
    //         return false;
    //     }
    // }
</script>