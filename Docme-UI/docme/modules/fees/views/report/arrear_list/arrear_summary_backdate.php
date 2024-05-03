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
                        echo form_open('report/stud-agewisepdf');
                        ?>
                        <input type="hidden" name="save_flag" id="save_flag" value="1" />
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-xs-12" id="form_data">
                                <div class="form-group" id="data_1">
                                    <label for="reportdate">
                                        &nbsp;Report Date:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" data-date-startdate="2017-12-05" autocomplete="off" class="form-control" name="reportdate" id="reportdate" value="<?php echo date('d/m/Y'); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12" align="">
                                <!--<a href="javascript:void(0);" class="btn btn-warning btn-md" onclick="submit_data();" style="cursor:pointer;"><i class="fa fa-file-excel-o"></i> Excel</a>-->
                                <a href="javascript:void(0);" class="btn btn-info btn-md" onclick="submit_data(1);"><i class="fa fa-file-pdf-o"></i> GET REPORT</a>
                                <a href="javascript:void(0);" class="btn btn-warning btn-md" onclick="submit_data(2);" style="cursor:pointer;"><i class="fa fa-file-excel-o"></i> Export to Excel</a> 
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
    $('#reportdate').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        //startDate: '<?php echo date('D/M/Y'); ?>',
        endDate: '<?php echo date('D/M/Y'); ?>'


    });

    // $('#reportdate').datepicker({
    //     todayBtn: "linked",
    //     keyboardNavigation: false,
    //     forceParse: false,
    //     calendarWeeks: true,
    //     autoclose: true,
    //     format: 'dd/mm/yyyy',
    //     startdate: '-1d'
    // });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    function submit_data(rpt_type = 1) {

        // var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
        // var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');

        // if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
        //     swal('', 'Select a valid date range', 'info');
        //     return false;
        // }
        var ddate = $('#reportdate').val();
        var arrayb = ddate.split("/");
        var repdate = arrayb[2] + '-' + arrayb[1] + '-' + arrayb[0]; // Formatted for dd/mm/yyyy
        var frmdt = moment(repdate).format('YYYY-MM-DD');
        if (!(moment(frmdt).isValid())) {
            swal('', 'Select a valid date range', 'info');
            return false;
        }

        //if (moment(startdate).isValid() && moment(enddate).isValid()) {
        if (moment(frmdt).isValid()) {
            $('#report_param_loader').addClass('sk-loading');
            // var reportstartdate = startdate;
            // var reportenddate = enddate;
            var reportstartdate = frmdt;
            var ops_url = baseurl + 'fees/report/get_arrear_summary';
            $.ajax({
                type: "POST",
                cache: false,
                // async: false,
                url: ops_url,
                data: {
                    "startdate": reportstartdate,
                    "type": 2,
                    "backdate": 1,
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
                        swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                        return false;
                    }
                }
            });
        } else {
            swal('', 'Please check the input are valid', 'info');
            return false;
        }
    }
</script>