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
                    <!--<div class="ibox-content">-->
                    <div class="body">
                        <?php
                        echo form_open('report/stud-nationwisepdf');
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
                            <div class="col-lg-6">
                                <div class="form-group <?php
                                                        if (form_error('country_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Nationality</label><span class="mandatory"> *</span><br />

                                    <select name="country_select" id="country_select" class="form-control" style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($country_data) && !empty($country_data)) {
                                            foreach ($country_data as $country) {
                                                if (isset($country_selected) && !empty($country_selected) && $country_selected == $country['country_id']) {
                                                    echo '<option selected value = "' . $country['country_id']  . '" >' . $country['country_nation'] . "</option>";
                                                } else {
                                                    echo '<option value = "' . $country['country_id'] . '" >' . $country['country_nation']  . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('country_select', '<div class="form-error">', '</div>'); ?>
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
                                        &nbsp;Report Date:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" style="background-color:#FFFFFF" readonly="" class="form-control" name="reportdate" id="reportdate" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID']  ?>','<?php echo $country['country_nation']  ?>');"> Report</a>
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
        "alwaysShowCalendars": true
    });
    $('#reportdate').attr('disabled', true);
    $('#reportdate').val('');

    $('#checkbox1').change(function() {
        if ($('#checkbox1').is(":checked")) {
            $('#reportdate').attr('disabled', false);
            //          $('#todt').attr('disabled', false);
        } else {
            $('#reportdate').attr('disabled', true);
            $('#reportdate').val('');
            //          $('#todt').attr('disabled', true);
            //          $('#todt').val('');
        }
    });



    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#country_select').select2({
        'theme': 'bootstrap'
    });



    function submit_data(Acd_ID) {
        $('#Rptnation_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var nation_ID = $('#country_select').val();
        var country_ID = $('#country_select option:selected').text();
        var chkfrm = $('#checkbox1').prop('checked');
        if (chkfrm == true) {
            var frmdt = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var todt = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
        } else {
            var frmdt = '';
            var todt = '';
        }

        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptnation_loader').removeClass('sk-loading');
            return;
        }
        if (nation_ID == -1) {
            swal('', 'Nationality is required.', 'info');
            $('#Rptnation_loader').removeClass('sk-loading');
            return;
        }

        if (chkfrm == true) {
            if ($('#reportdate').val() == '') {
                $('#Rptnation_loader').removeClass('sk-loading');
                //$('#frmdt').attr('disabled', true);
                swal('', 'Select any date range !', 'info');
                return false;
            }


            if (!(moment(frmdt).isValid() && moment(todt).isValid())) {
                $('#Rptnation_loader').removeClass('sk-loading');
                swal('', 'Select a valid date range', 'info');
                return false;
            }
        }


        var ops_url = baseurl + 'report/stud-nationwisepdf';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "country_select": country_ID,
                "frmdt": frmdt,
                "todt": todt
            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
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

    function canceldata() {
        $('#acd_year').select2('val', -1);
        $('#country_select').select2('val', -1);
        $('#todt').attr('disabled', true);
        $('#reportdate').attr('disabled', true);
        $('#checkbox1').prop('checked', false);
        $('#checkbox2').prop('checked', false);
        $('#reportdate').val('');
        $('#todt').val('');
    }
</script>