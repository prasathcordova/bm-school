<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="Rptgender_loader">
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
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('acd_year', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php
                                                        if (form_error('gender')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Gender</label><span class="mandatory"> *</span><br />

                                    <select name="gender" id="gender" class="form-control " style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <!--<option  value="A">ALL</option>-->
                                        <option value="M">MALE</option>
                                        <option value="F">FEMALE</option>

                                    </select>
                                    <?php echo form_error('gender', '<div class="form-error">', '</div>'); ?>
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
                                        <input type="text" style="background-color:#FFFFFF" data-date-startdate="2017-12-05" readonly="" class="form-control" name="reportdate" id="reportdate" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID'] ?>')"> Report</a>
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
    $('#gender').select2({
        'theme': 'bootstrap'
    });


    function submit_data(Acd_ID) {
        $('#Rptgender_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var gender = $('#gender').val();
        var datecheck = $('#reportdate').val();
        var chkfrm = $('#checkbox1').prop('checked');
        //        alert (chkfrm);return;
        if (chkfrm == true) {
            var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
        } else {
            var startdate = '';
            var enddate = '';
        }

        if (chkfrm == true) {
            if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
                $('#Rptgender_loader').removeClass('sk-loading');
                swal('', 'Select a valid date range', 'info');
                return false;
            }
        }

        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptgender_loader').removeClass('sk-loading');
            return;
        }
        if (gender == -1) {
            swal('', 'Gender is required.', 'info');
            $('#Rptgender_loader').removeClass('sk-loading');
            return;
        }
        if (chkfrm == true) {
            if (datecheck == '') {
                swal('', 'Select a date range', 'info');
                $('#Rptgender_loader').removeClass('sk-loading');
                return;
            }
        }

        var ops_url = baseurl + 'report/stud-genderwisepdf';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "gender": gender,
                "frmdt": startdate,
                "todt": enddate
            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#Rptgender_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#Rptgender_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#Rptgender_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#Rptgender_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    function canceldata() {
        $('#acd_year').select2('val', -1);
        $('#gender').select2('val', -1);
        $('#todt').attr('disabled', true);
        $('#reportdate').attr('disabled', true);
        $('#checkbox1').prop('checked', false);
        $('#checkbox2').prop('checked', false);
        $('#reportdate').val('');
        $('#todt').val('');
    }
</script>