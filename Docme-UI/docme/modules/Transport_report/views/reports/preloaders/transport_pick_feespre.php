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

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12" align="center">
                                    <br />
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm " onclick="submit_data();"> Report</a>
                                    <br />
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
        $('#route_select').select2({
            'theme': 'bootstrap'
        });
        $('#trip_select').select2({
            'theme': 'bootstrap'
        });
        $('#pickppoint_select').select2({
            'theme': 'bootstrap'
        });

        function changed_route() {
            var route_id = $('#route_select').val();
            var ops_url = baseurl + 'transport/get-trip-rpt-stuf/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "routeid": route_id
                },
                success: function(result) {
                    $('#trip_select').empty().trigger("change");
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        var trip_data = data.data;
                        $('#trip_select').append("<option value='-1' >Select</option>");
                        $.each(trip_data, function(i, v) {
                            $('#trip_select').append("<option value='" + v.id + "' >" + v.tripName + "</option>");
                        });
                        $('#trip_select').trigger('change');
                    } else {
                        $('#trip_select').empty().trigger("change");
                        $('#trip_select').append("<option value='-1' selected >Select</option>");
                        $('#trip_select').trigger('change');
                    }
                }
            });
        }

        function changed_trip() {
            var trip_id = $('#trip_select').val();
            //var route_id = $('#route_select').val();
            if (trip_id == 1000) {
                $('#pickppoint_select').append("<option value='2000'>ALL</option>");
                return false;
            }
            var ops_url = baseurl + 'transport/get-stops-rpt-stuf/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "tripid": trip_id
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        var stops_data = data.data;
                        $('#pickppoint_select').empty().trigger("change");
                        $('#pickppoint_select').append("<option value='-1'>Select</option>");
                        $('#pickppoint_select').append("<option value='2000' selected >ALL</option>");
                        $.each(stops_data, function(i, v) {

                            $('#pickppoint_select').append("<option value='" + v.id + "' >" + v.pickpointName + "</option>");
                        });
                        $('#pickppoint_select').trigger('change');
                    } else {
                        $('#pickppoint_select').empty().trigger("change");
                        $('#pickppoint_select').append("<option value='-1' selected >Select</option>");
                        $('#pickppoint_select').trigger('change');
                    }
                }
            });
        }

        function submit_data() {

            //var route_id = $('#route_select').val();
            // var routedata = $('#route_select :selected').text();
            // var trip_id = $('#trip_select :selected').val();
            // var tripdata = $('#trip_select :selected').text();
            // var dropstop_id = $('#pickppoint_select :selected').val();
            // var dropstopdata = $('#pickppoint_select :selected').text();
            //            if (route_id == -1) {
            //                swal('', 'Route is required.', 'info');
            //                $('#faculty_loader').removeClass('sk-loading');
            //                return false;
            //            }
            // if (trip_id == -1) {
            //     swal('', 'Trip is required.', 'info');
            //     $('#faculty_loader').removeClass('sk-loading');
            //     return false;
            // }
            // if (dropstop_id == -1) {
            //     swal('', 'Drop Point is required.', 'info');
            //     $('#faculty_loader').removeClass('sk-loading');
            //     return false;
            // }
            var ops_url = baseurl + 'transport-report/pickstopz-fee-rpt';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    // "tripid": trip_id,
                    // "tripdata": tripdata,
                    // "dropstopid": dropstop_id,
                    // "dropstopdata": dropstopdata
                },
                success: function(result) {
                    //window.open(data, '_blank');
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