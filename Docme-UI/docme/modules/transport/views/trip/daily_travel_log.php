<script type="text/javascript" src="<?php echo base_url('assets/theme/plugins/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/theme/plugins/bootstrap-daterangepicker/daterangepicker.css') ?>" />

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="color:#1c84c6;"> <?php echo $sub_title; ?></h5>

                </div>
                <!-- <div class="ibox-content"> -->



                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-xs-4" id="form_data">
                            <div class="form-group" id="data_1">
                                <label for="logdate" style="color:#1c84c6;">
                                    &nbsp;Date</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control is-datepicker" name="logdate" id="logdate" placeholder="Date" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4" id="form_data">
                            <div class="form-group">
                                <label class="control-label" style="color:#1c84c6;">Trip:</label>
                                <select name="trip_select" id="trip_select" class="form-control " style="width:100%;">
                                    <option selected value="-1">Select</option>
                                    <?php
                                    if (isset($route_data) && !empty($route_data)) {
                                        foreach ($route_data as $route) {
                                            echo '<option value ="' . $route['id'] . '">' . $route['tripName'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12" align="left">
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm " onclick="submit_data();"> Get Log</a>
                            <!--<a class="btn btn-danger btn-sm" onclick="canceldata();"> Cancel</a>-->
                        </div>
                    </div>
                </div>





            </div>
        </div>
        <div class="col-lg-12">
            <div id="log_content"></div>
        </div>
    </div>


    <style>
        .panel-body-new {
            padding: 0 !important;
        }
    </style>
    <script type="text/javascript">
        $('#route_select').select2({
            'theme': 'bootstrap'
        });
        $('#trip_select').select2({
            'theme': 'bootstrap'
        });
        $('#pickppoint_select').select2({
            'theme': 'bootstrap'
        });

        $('#logdate').datepicker({
            format: 'dd-mm-yyyy',
            "endDate": moment().format('DD-MM-YYYY'),
            autoclose: true,
        });



        function submit_data() {

            var log_date_obj = moment($('#logdate').val(), 'DD-MM-YYYY');

            if (log_date_obj == 'Invalid date') {
                swal('', 'Date is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            var trip_id = $('#trip_select :selected').val();

            if (trip_id == -1) {
                swal('', 'Trip is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }

            var log_date = moment($('#logdate').datepicker('getDate')).format('YYYY-MM-DD');
            var ops_url = baseurl + 'transport/get-travel-log';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "tripid": trip_id,
                    "log_date": log_date
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#log_content').html(data.view);
                    } else {
                        swal('', 'No Data Found.', 'info');
                    }
                }
            });

        }
    </script>