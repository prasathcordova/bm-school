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
                                    <!-- <div class="col-lg-4 col-md-4 col-xs-4" id="form_data">
                                        <div class="form-group">
                                            <label class="control-label" style="color:#1c84c6;">Trip:</label>
                                            <select name="trip_select" id="trip_select" class="form-control " style="width:100%;">

                                                <option selected value="-1">Select</option>
                                                <option value="1000">ALL</option>
                                                <?php
                                                // if (isset($route_data) && !empty($route_data)) {
                                                //     foreach ($route_data as $route) {
                                                //         echo '<option value ="' . $route['id'] . '">' . $route['tripName'] . '</option>';
                                                //     }
                                                // }
                                                ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm " onclick="submit_data();"> Report</a>
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

    <style>
        .panel-body-new {
            padding: 0 !important;
        }
    </style>
    <script type="text/javascript">
        $('#vehicle_select').select2({
            'theme': 'bootstrap'
        });


        function submit_data() {

            var vehicle_id = $('#vehicle_select').val();
            //var trip_id = $('#trip_select :selected').val();

            // if (trip_id == -1) {
            //     swal('', 'Trip is required.', 'info');
            //     $('#faculty_loader').removeClass('sk-loading');
            //     return false;
            // }

            if (vehicle_id == -1) {
                swal('', 'Vehicle is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }

            var ops_url = baseurl + 'transport-report/vehicle-trip-report';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "vehicle_id": vehicle_id,
                    //"trip_id": trip_id
                },
                success: function(result) {

                    try {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            window.open(data.link, '_blank');
                        } else if (data.status == 2) {
                            if (data.message) {
                                swal('', data.message, 'info');
                                return false;
                            } else {
                                swal('', 'An error occurred while report. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                            }
                        } else if (data.status == 3) {
                            if (data.message) {
                                swal('', data.message, 'info');
                                return false;
                            } else {
                                swal('', 'An error occurred while report. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                            }
                        } else {
                            if (data.message) {
                                swal('', data.message, 'info');
                                return false;
                            } else {
                                swal('', 'An error occurred while report. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                            }
                        }
                    } catch (e) {
                        swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                        return false;
                    }


                }
            });
        }
    </script>