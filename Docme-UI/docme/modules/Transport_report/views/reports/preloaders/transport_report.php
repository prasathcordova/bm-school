<script type="text/javascript" src="<?php echo base_url('assets/theme/plugins/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/theme/plugins/bootstrap-daterangepicker/daterangepicker.css') ?>" />

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="color:#1c84c6;"> <?php echo $sub_title; ?></h5>

                </div>
                <div class="ibox-content">
                    <div class="panel-body panel-body-new">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php echo $sub_title; ?>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6" id="form_data">
                                        <div class="form-group" id="data_1">
                                            <label for="reportdate" style="color:#1c84c6;">
                                                &nbsp;Report Date</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control is-datepicker" name="reportdate" id="reportdate" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6" id="form_data">
                                        <div class="form-group">
                                            <label class="control-label" style="color:#1c84c6;">Vehicle:</label>
                                            <select name="vehicle_select" id="vehicle_select" class="form-control " style="width:100%;">

                                                <option selected value="-1">Select</option>
                                                <option value="ALL">ALL</option>
                                                <?php
                                                if (isset($vehicle_data) && !empty($vehicle_data)) {
                                                    foreach ($vehicle_data as $vehicle) {
                                                        echo '<option value ="' . $vehicle['id'] . '">' . $vehicle['vehicleNum'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data();"> Report</a>
                                        <!--<a class="btn btn-danger btn-sm" onclick="canceldata();"> Cancel</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div id="report_content"></div>
    <input type="hidden" id="report_lock_date" value="<?php echo (isset($report_lock_start_date) && !empty($report_lock_start_date) ? date('m-d-Y', strtotime($report_lock_start_date)) : '2017-01-01'); ?>" />
    <input type="hidden" id="report_lock_enddate" value="<?php echo (isset($report_lock_end_date) && !empty($report_lock_end_date) ? date('m-d-Y', strtotime($report_lock_end_date)) : '2017-01-01'); ?>" />
    <style>
        .panel-body-new {
            padding: 0 !important;
        }
    </style>
    <script type="text/javascript">
        var date = moment(new Date()).format('MM-DD-YYYY');
        $('#reportdate').daterangepicker({
            "startDate": moment().format('DD-MM-YYYY'),
            "endDate": moment().format('DD-MM-YYYY'),
            "autoApply": true,
            "alwaysShowCalendars": true,
            "minDate": moment(moment().format('DD-MM-YYYY'), 'DD-MM-YYYY').subtract(2, 'years').format('DD-MM-YYYY'),
            "maxDate": moment(date, 'MM-DD-YYYY').subtract(0, 'days').format('DD-MM-YYYY'),
            locale: {
                format: 'DD-MM-YYYY'
            }

        });
        $('#vehicle_select').select2({
            'theme': 'bootstrap'
        });
        $('#store').select2({
            'theme': 'bootstrap'
        });

        function submit_data() {
            var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');
            var vehicle_id = $('#vehicle_select').val();

            if (vehicle_id == -1) {
                swal('', 'Vehicle is required.', 'info');
                return false;
            }

            if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
                swal('', 'Select a valid date range', 'info');
                return false;
            }

            if (moment(startdate).isValid() && moment(enddate).isValid()) {
                var reportstartdate = moment(startdate).format('YYYY-MM-DD');
                var reportenddate = moment(enddate).format('YYYY-MM-DD');
                var ops_url = baseurl + 'transport-report/fuellog-report';
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "startdate": reportstartdate,
                        "enddate": reportenddate,
                        "vehicle_id": vehicle_id
                    },
                    success: function(result) {
                        try {
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                window.open(data.link, '_blank');
                                /* var winPrint = window.open('', '', 'left=0,top=0,width=1024,height=700,toolbar=0,scrollbars=0,status=0');
                                 winPrint.document.write(data.link);
                                 winPrint.document.close();
                                 winPrint.focus();*/
                            } else if (data.status == 2) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                                }
                            } else if (data.status == 3) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                                }
                            } else {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                                }
                            }
                        } catch (e) {
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