<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="Rptclass_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="body">
                        <?php
                        echo form_open('report/stud-classdivisnwisepdf');
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
                                        } ?>
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

                                    <select name="class_select" id="class_select" class="form-control " style="width:100%;" onchange="change_class()">

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
                            <div class="col-md-6">
                                <div class="form-group <?php
                                                        if (form_error('class_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Division</label><span class="mandatory"> *</span><br />
                                    <select name="division_select" id="division_select" class="form-control " style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <!--                                            <option value="4000">ALL</option>-->
                                        <?php
                                        //                                            if (isset($class_data) && !empty($class_data)) {
                                        //                                                foreach ($class_data as $class) {
                                        //                                                    echo '<option value ="' . $class['Course_Det_ID'] . '">' . $class['Division'] . '</option>';
                                        //                                                }
                                        //                                            }
                                        ?>
                                    </select>
                                    <?php echo form_error('class_select', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3" id="form_data">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">
                                        &nbsp;Select a period:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12" id="form_data">
                                <div class="form-group" id="data_1">
                                    <label for="reportdate">
                                        &nbsp;Report Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" name="reportdate" id="reportdate" value="" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID']  ?>','<?php echo $class['Description'] ?>',1);"> Report</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID']  ?>','<?php echo $class['Description'] ?>',2);"> Export to Excel</a>
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
    $('#reportdate').daterangepicker({
        "autoApply": true,
        format: 'DD-MM-YYYY',
        "alwaysShowCalendars": true,
    });
    $('#checkbox1').change(function() {
        if ($('#checkbox1').is(":checked")) {
            $('#reportdate').attr('disabled', false);
        } else {
            $('#reportdate').attr('disabled', true);
            $('#reportdate').val('');
        }
    });


    $('#data_1 .input-group.date').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        endDate: '+0d',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });


    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#class_select').select2({
        'theme': 'bootstrap'
    });
    $('#division_select').select2({
        'theme': 'bootstrap'
    });


    function submit_data(Acd_ID, desc, rpt_type = 1) {
        $('#Rptclass_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var classdet_ID = $('#class_select').val();
        // var frmdt1 = $('#reportdate').val();
        var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var class_ID = $('#class_select option:selected').text();
        var div_ID = $('#division_select').val();

        var chkfrm = $('#checkbox1').prop('checked');
        if (chkfrm == true) {
            var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
            // var frmdt = moment($('#reportdate').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
        } else {
            // var frmdt = '';
            var startdate = '';
            var enddate = '';
        }

        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptclass_loader').removeClass('sk-loading');
            return;
        }
        if (classdet_ID == -1) {
            swal('', 'Class is required.', 'info');
            $('#Rptclass_loader').removeClass('sk-loading');
            return;
        }
        if (div_ID == -1) {
            swal('', 'Division  is required.', 'info');
            $('#Rptclass_loader').removeClass('sk-loading');
            return;
        }

        if (chkfrm == true) {
            if (startdate == '' && enddate == '') {
                swal('', 'Select date', 'info');
                return;
            }
        }

        var ops_url = baseurl + 'report/stud-classdivisnwisepdf';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "class_select": class_ID,
                "div_id": div_ID,
                "startdate": startdate,
                "enddate": enddate,
                "rpt_type": rpt_type
                // "frmdt": frmdt
            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#Rptclass_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#Rptclass_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#Rptclass_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#Rptclass_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    function canceldata() {
        $('#acd_year').select2('val', -1);
        $('#class_select').select2('val', -1);
        $('#reportdate').attr('disabled', true);
        $('#checkbox1').prop('checked', false);
        $('#reportdate').val('');
    }

    function change_class() {
        var class_id = $('#class_select').val();
        var acd_id = $('#acd_year').val();
        var data = {};
        if (class_id == 3000) {
            data = {
                load: 1
            }
        } else {
            data = {
                "acd_year": acd_id,
                'class_select': class_id
            };
        }
        var ops_url = baseurl + 'report/get-division-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: data,
            success: function(result) {
                $('#division_select').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batch_data = data.data;
                    $('#division_select').empty().trigger("change");
                    $('#division_select').append("<option value='-1' >Select</option>");
                    if (class_id == 3000) {
                        $('#division_select').append('<option value="3000">ALL</option>');
                    } else if (class_id !== 3000) {
                        $.each(batch_data, function(i, v) {

                            $('#division_select').append("<option value='" + v.BatchID + "' >" + v.Division + "</option>");
                        });
                    }
                    $('#division_select').trigger('change');
                } else {
                    $('#division_select').empty().trigger("change");
                }
            }
        });
    }
</script>