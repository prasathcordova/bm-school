<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="Rptlongabsntee_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="body">
                        <?php
                        echo form_open('report/show-longabsenteepdf');
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
                                    <select id="acd_year" class="form-control " style="width:100%;" onchange="change_acdyr();">
                                        <option selected value="-1">Select</option>

                                        <?php
                                        if (isset($acdyr_data) && !empty($acdyr_data)) {
                                            foreach ($acdyr_data as $acdyr) {
                                                //    dev_export($acdyr_data);die;
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

                                    <select name="class_select" id="class_select" class="form-control " style="width:100%;" onchange="change_class();">

                                        <option selected value="-1">Select</option>
                                        <option value="1000">ALL</option>
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
                                <div class="form-group <?php
                                                        if (form_error('batch_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Batch</label><span class="mandatory"> *</span><br />
                                    <select name="batch_select" id="batch_select" class="form-control " style="width:100%;">
                                        <option selected value="-1">Select</option>
                                        <option value="1000">ALL</option>
                                        <?php
                                        if (isset($batch_data) && !empty($batch_data)) {
                                            foreach ($batch_data as $batch) {
                                                echo '<option value ="' . $batch['BatchID'] . '">' . $batch['Batch_Name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('batch_select', '<div class="form-error">', '</div>'); ?>
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
                            <div class="col-lg-12 col-md-12 col-xs-12" id="form_data">
                                <div class="form-group" id="data_1">
                                    <label for="reportdate">
                                        &nbsp;Report Date*:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" style="background-color:#FFFFFF" data-date-startdate="2017-12-05" readonly="" class="form-control" name="reportdate" id="reportdate" value="" disabled="true" />

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID'] ?>', 1);"> Report</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID'] ?>', 2);"> Export to Excel</a>
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
    $('#reportdate').val('');

    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#batch_select').select2({
        'theme': 'bootstrap'
    });
    $('#class_select').select2({
        'theme': 'bootstrap'
    });


    function submit_data(Acd_ID, rpt_type) {
        $('#Rptlongabsntee_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var class_ID = $('#class_select').val();
        var batch_ID = $('#batch_select').val();
        var startdate = '';
        var enddate = '';
        var chkfrm = $('#checkbox1').prop('checked');

        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptlongabsntee_loader').removeClass('sk-loading');
            return;
        }
        if (class_ID == -1) {
            swal('', 'Class is required.', 'info');
            $('#Rptlongabsntee_loader').removeClass('sk-loading');
            return;
        }
        if (batch_ID == -1) {
            swal('', 'Batch is required.', 'info');
            $('#Rptlongabsntee_loader').removeClass('sk-loading');
            return;
        }


        if (chkfrm == true) {
            startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
            enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
            if ($('#reportdate').val().trim().length == 0) {
                swal('', 'Select a date range', 'info');
                $('#Rptlongabsntee_loader').removeClass('sk-loading');
                return false;
            }
            if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
                $('#Rptlongabsntee_loader').removeClass('sk-loading');
                swal('', 'Select a valid date range', 'info');
                return false;
            }
        }
        var data = {};
        if (chkfrm == true) {
            data = {
                "load": 1,
                "acd_year": Acd_ID,
                "class_select": class_ID,
                "batch_select": batch_ID,
                "frmdt": startdate,
                "todt": enddate,
                "rpt_type": rpt_type
            };
        } else {
            data = {
                "load": 1,
                "acd_year": Acd_ID,
                "class_select": class_ID,
                "batch_select": batch_ID,
                "rpt_type": rpt_type
            };
        }

        var ops_url = baseurl + 'report/stud-longabsenteepdf';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: data,
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#Rptlongabsntee_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#Rptlongabsntee_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#Rptlongabsntee_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#Rptlongabsntee_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }


    function canceldata() {
        var ops_url = baseurl + 'report/show-longabsenteepdf';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }

    function change_acdyr() {
        $('#class_select').val(-1);
        $('#class_select').trigger('change');
        // $('#batch_select').val(-1);
        // $('#batch_select').trigger('change');  
    }

    function change_class() {
        var class_id = $('#class_select').val();
        var acd_id = $('#acd_year').val();
        var data = {};
        if (class_id == 1000) {
            data = {
                load: 1,
                "acd_year": acd_id
            }
        } else {
            data = {
                "acd_year": acd_id,
                'class_select': class_id
            };
        }
        var ops_url = baseurl + 'report/get-batch-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: data,
            success: function(result) {
                $('#batch_select').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batch_data = data.data;
                    $('#batch_select').empty().trigger("change");
                    $('#batch_select').append("<option value='-1' selected >Select</option>");
                    if (class_id == 1000) {
                        $('#batch_select').append('<option value="1000">ALL</option>');
                    }
                    $.each(batch_data, function(i, v) {

                        $('#batch_select').append("<option value='" + v.BatchID + "' >" + v.Batch_Name + "</option>");
                    });
                    $('#batch_select').trigger('change');
                } else {
                    $('#batch_select').empty().trigger("change");
                }
            }
        });

    }
</script>