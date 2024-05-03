<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="Rptsexage_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="body">
                        <?php
                        echo form_open('report/stud-agesexwisepdf');
                        ?>
                        <input type="hidden" name="save_flag" id="save_flag" value="1" />
                        <div class="row clearfix">
                            <div class="col-lg-6">
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
                                                //                                                dev_export($acdyr_data);die;
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
                            <div class="col-lg-6">
                                <div class="form-group <?php
                                                        if (form_error('class_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Class</label><span class="mandatory"> *</span><br />

                                    <select name="class_select" id="class_select" class="form-control " style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <option value="3000">ALL</option>
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
                            <div class="col-lg-3">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">
                                        &nbsp;Select a Period</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6" id="form_data">
                                <div class="form-group" id="data_1">
                                    <label for="checkbox1">
                                        &nbsp;Report Date:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" name="reportdate" id="reportdate" value="" readonly="" disabled="true" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID'] ?>');"> Report</a>
                                <a class="btn btn-danger btn-sm" onclick="canceldata();"> Cancel</a>
                            </div>
                        </div>
                        <a href="#" style="display:none" id="testpdf"></a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $('#checkbox1').change(function() {
        if ($('#checkbox1').is(":checked")) {
            $('#reportdate').attr('disabled', false);
        } else {
            $('#reportdate').attr('disabled', true);
            $('#reportdate').val('');
        }
    });

    $('#reportdate').daterangepicker({
        "autoApply": true,
        format: 'DD-MM-YYYY',
        "alwaysShowCalendars": true
    });
    $('#reportdate').attr('disabled', true);
    //            .datepicker({
    //        format: "dd/mm/yyyy",
    //        todayBtn: "linked",
    //        keyboardNavigation: false,
    //        forceParse: false,
    //        calendarWeeks: true,
    //        autoclose: true
    //    });


    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#class_select').select2({
        'theme': 'bootstrap'
    });



    function submit_data(Acd_ID) {
        $('#Rptsexage_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var class_ID = $('#class_select').val();
        var datecheck = $('#reportdate').val();
        var fromDate = '';
        var toDate = '';
        var chkfrm = $('#checkbox1').prop('checked');
        //        if (chkfrm == true) {
        //            var frmdt = moment($('#frmdt').val()).format('YYYY-MM-DD');
        //        } else {
        //            var frmdt = '';
        //        }

        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptsexage_loader').removeClass('sk-loading');
            return;
        }
        if (class_ID == -1) {
            swal('', 'Class is required.', 'info');
            $('#Rptsexage_loader').removeClass('sk-loading');
            return;
        }

        if (chkfrm == true) {
            if (datecheck == '') {
                swal('', 'Select a date range', 'info');
                return;
            }
            fromDate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
            toDate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
            if (!(moment(fromDate).isValid() && moment(toDate).isValid())) {
                $('#Rptsexage_loader').removeClass('sk-loading');
                swal('', 'Select a valid date range', 'info');
                return false;
            }

        }

        var ops_url = baseurl + 'report/stud-agesexwisepdf';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "class_id": class_ID,
                "frmdt": fromDate,
                "todt": toDate
            },
            // success: function (data) {
            //     window.open(data, '_blank');
            // }
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#Rptsexage_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#Rptsexage_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#Rptsexage_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
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

    function canceldata() {
        $('#acd_year').select2('val', -1);
        $('#reportdate').attr('disabled', true);
        $('#checkbox1').prop('checked', false);
        $('#reportdate').val('');
    }
</script>