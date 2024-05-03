<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="Rptreligion_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="body">
                        <?php
                        echo form_open('report/stud-religionwisepdf');
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
                                                        if (form_error('religion_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Religion</label><span class="mandatory"> *</span><br />

                                    <select name="religion_select" id="religion_select" class="form-control" style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($relegion_data) && !empty($relegion_data)) {
                                            foreach ($relegion_data as $religion) {
                                                if (isset($religion_selected) && !empty($religion_selected) && $religion_selected == $religion['religion_id']) {
                                                    echo '<option selected value = "' . $religion['religion_id'] . '" >' . $religion['religion_name'] . "</option>";
                                                } else {
                                                    echo '<option value = "' . $religion['religion_id'] . '" >' . $religion['religion_name'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('religion_select', '<div class="form-error">', '</div>'); ?>
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
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID'] ?>', '<?php echo $religion['religion_name'] ?>');"> Report</a>
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
    $('#reportdate').attr('disabled', true);
    $('#reportdate').val('');

    $('#checkbox1').change(function() {
        if ($('#checkbox1').is(":checked")) {
            $('#reportdate').attr('disabled', false);
            $('#reportdate').attr('disabled', false);
        } else {
            $('#reportdate').attr('disabled', true);
            $('#reportdate').val('');

        }
    });

    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#religion_select').select2({
        'theme': 'bootstrap'
    });

    //    $('#checkbox1, #checkbox2').on('click', function (){
    //        $(this).val(this.checked ? 1 : 0);
    //    });

    function submit_data(Acd_ID) {
        $('#Rptreligion_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var religion_data = $('#religion_select').val();

        var religion_ID = $('#religion_select option:selected').text();
        var chkfrm = $('#checkbox1').prop('checked');
        if (chkfrm == true) {
            var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
            //alert(startdate);
        } else {
            var startdate = '';
            var enddate = '';
        }

        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptreligion_loader').removeClass('sk-loading');
            return;
        }
        if (religion_data == -1) {
            swal('', 'Religion is required.', 'info');
            $('#Rptreligion_loader').removeClass('sk-loading');
            return;
        }

        if (chkfrm == true) {
            if ($('#reportdate').val() == '') {
                $('#Rptnation_loader').removeClass('sk-loading');
                //$('#frmdt').attr('disabled', true);
                swal('', 'Select any date range !', 'info');
                return false;
            }
            if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
                $('#Rptreligion_loader').removeClass('sk-loading');
                swal('', 'Select a valid date range', 'info');
                return false;
            }
        }


        var ops_url = baseurl + 'report/stud-religionwisepdf';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "religion_select": religion_ID,
                "frmdt": startdate,
                "todt": enddate
            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#Rptreligion_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#Rptreligion_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#Rptreligion_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#Rptreligion_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }


    function canceldata() {
        var ops_url = baseurl + 'report/show-religionwisepdf';
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
</script>