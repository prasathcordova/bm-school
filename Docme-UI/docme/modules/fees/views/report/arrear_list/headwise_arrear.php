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
                        <?php
                        //dev_export($feecodes_available);
                        echo form_open('report/stud-agewisepdf');
                        ?>
                        <input type="hidden" name="save_flag" id="save_flag" value="1" />
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-xs-12" id="form_data">
                                <div class="form-group" id="data_1">
                                    <label for="reportdate">
                                        &nbsp;Report Date:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" data-date-startdate="2017-12-05" autocomplete="off" class="form-control" name="reportdate" id="reportdate" value="<?php echo date('d/m/Y'); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12" id="form_data">
                                <div class="form-group" id="data_1">
                                    <label for="reportdate">
                                        &nbsp;Fee Head</label>
                                    <select name="feecode_id" id="feecode_id" class="form-control " style="width:100%;">
                                        <option selected value="-1">ALL FEE CODES</option>
                                        <?php
                                        if (isset($feecodes_available) && !empty($feecodes_available)) { //feeid_sel
                                            foreach ($feecodes_available as $feecode) {
                                                if ($feecode['editable'] == 1) {
                                        ?>
                                                    <option value="<?php echo $feecode['id']; ?>"><?php echo $feecode['description']; ?></option>
                                        <?php }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12" align="left">
                                <a href="javascript:void(0);" class="btn btn-info btn-md" onclick="submit_data(1);"><i class="fa fa-file-pdf-o"></i> GET REPORT</a>
                                <a href="javascript:void(0);" class="btn btn-warning btn-md" onclick="submit_data(2);" style="cursor:pointer;"><i class="fa fa-file-excel-o"></i> Export to Excel</a> 
                                <!-- <a href="javascript:void(0);" class="btn btn-primary btn-md" onclick="pdf_report(1);"><i class="fa fa-file-excel-o"></i> Excel Report</a> -->
                            </div>

                        </div>
                    </div>

                    <a href="#" style="display:none" id="testpdf"></a>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="report_content"></div>
<input type="hidden" id="report_lock_date" value="<?php echo (isset($report_lock_date) && !empty($report_lock_date) ? date('m-d-Y', strtotime($report_lock_date)) : '2017-01-01'); ?>" />
<style>
    .panel-body-new {
        padding: 0 !important;
    }
</style>

<script type='text/javascript'>
    $('#feecode_id').select2({
        'theme': 'bootstrap'
    });
    console.log(moment($('#report_lock_date').val(), 'YYYY-MM-DD').subtract(0, 'days').format('DD-MM-YYYY'));
    // $('#reportdate').daterangepicker({
    //     "autoApply": true,
    //     "alwaysShowCalendars": true,
    //     format: 'DD/MM/YYYY'

    // });
    $('#reportdate').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        endDate: '<?php echo date('D/M/Y'); ?>'
    });

    function submit_data(rpt_type = 1) {
        // var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
        // var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var feecode_id = $('#feecode_id').val();

        // if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
        //     swal('', 'Select a valid date range', 'info');
        //     return false;
        // }
        var ddate = $('#reportdate').val();
        var arrayb = ddate.split("/");
        var repdate = arrayb[2] + '-' + arrayb[1] + '-' + arrayb[0]; // Formatted for dd/mm/yyyy
        var frmdt = moment(repdate).format('YYYY-MM-DD');
        if (!(moment(frmdt).isValid())) {
            swal('', 'Select a valid date', 'info');
            return false;
        }

        // if (moment(startdate).isValid() && moment(enddate).isValid()) {
        if (moment(frmdt).isValid()) {
            $('#report_param_loader').addClass('sk-loading');
            var reportstartdate = frmdt;
            var reportenddate = frmdt;
            var ops_url = baseurl + 'fees/report/get_head_wise_arrear';
            $.ajax({
                type: "POST",
                cache: false,
                // async: false,
                url: ops_url,
                data: {
                    "startdate": reportstartdate,
                    "enddate": reportenddate,
                    "feecode_id": feecode_id,
                   // "type": $type,
                    "rpt_type": rpt_type

                },
                success: function(data) {
                    var datas = JSON.parse(data);
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
            $('#report_param_loader').removeClass('sk-loading');
        } else {
            swal('', 'Please check the input are valid', 'info');
            return false;
        }
    }

    /* function submit_data() {
        var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');

        if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
            swal('', 'Select a valid date range', 'info');
            return false;
        }

        if (moment(startdate).isValid() && moment(enddate).isValid()) {
            $('#report_param_loader').addClass('sk-loading');
            var reportstartdate = startdate;
            var reportenddate = enddate;
            var ops_url = baseurl + 'fees/report/get-headwise-collection-details';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "startdate": reportstartdate,
                    "enddate": reportenddate
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
                            $a.attr("download", "headwise_collection.xlsx");
                            $a[0].click();
                            $a.remove();
                        } else if (data.status == 2) {
                            if (data.message) {
                                swal('', data.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'An error occurred while creating reports. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                            }
                        } else if (data.status == 3) {
                            if (data.message) {
                                swal('', data.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'An error occurred while creating reports. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                            }
                        } else {
                            if (data.message) {
                                swal('', data.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'An error occurred while creating reports. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
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
            swal('', 'Please check the input are valid', 'info');
            return false;
        }
    } */
</script>