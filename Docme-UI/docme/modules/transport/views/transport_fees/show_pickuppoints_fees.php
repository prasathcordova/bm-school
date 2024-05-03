<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12" style="z-index: 9999;">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Trip" data-placement="left" href="javascript:void(0)" onclick="add_trip_route_pickuppoints();">Save Details</a>
                        <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                    </div>
                </div>
                <input type="hidden" name="fees_entity" id="fees_entity" value="<?php echo isset($feessetdata) && !empty($feessetdata) ? $feessetdata : ''; ?>" />
                <input type="hidden" name="routeid" id="routeid" value="<?php echo isset($routeid) && !empty($routeid) ? $routeid : ''; ?>" />
                <input type="hidden" name="routeName" id="routeName" value="<?php echo isset($routeName) && !empty($routeName) ? $routeName : ''; ?>" />

                <div class="ibox-content" id="trip_route_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="col-md-8">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Pickup Points</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-12" style="z-index:9999;">
                                            <div id="curd-content" style="display: none;"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_trip">
                                                    <thead>
                                                        <tr>
                                                            <th>Pickup Point Name</th>
                                                            <th>Pickup Point Fees</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (isset($vehicle_pickuppoints_data) && !empty($vehicle_pickuppoints_data) && is_array($vehicle_pickuppoints_data)) {
                                                            foreach ($vehicle_pickuppoints_data as $pickuppoints_data) {
                                                        ?>
                                                                <tr>
                                                                    <td> <?php echo $pickuppoints_data['pickpointName']; ?></td>
                                                                    <td>
                                                                        <div class="form-line">
                                                                            <input type="text" value="<?php echo $pickuppoints_data['fees']; ?>" id="<?php echo $pickuppoints_data['id']; ?>_pickpoint" data-confirmid="<?php echo $pickuppoints_data['id']; ?>" class="form-control pickup_point_data" onkeypress="return numericf(event);">
                                                                        </div>

                                                                    </td>

                                                                    <td>
                                                                        <div class="i-checks" style="padding-top:10px!important;"><label>
                                                                                <input data-toggle="tooltip" data-placement="right" class="data_part" data-pickuppointid="<?php echo $pickuppoints_data['id']; ?>" data-pickuppointname="<?php echo $pickuppoints_data['pickpointName'] ?>" id="<?php echo $pickuppoints_data['id']; ?>" type="checkbox" value="">
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Trip Route Mapping Details</h5>
                                </div>
                                <div>
                                    <div class="ibox-content profile-content">
                                        <h4 style="color: #23C6C8!important;"><strong><?php echo isset($trip_name) ? $trip_name : "NO TRIP PROVIDED" ?></strong></h4>
                                        <p><small>Trip <strong>Start Time</strong> <i class="fa fa-clock-o" style="color: #1c84c6;"></i> <?php echo isset($trip_starttime) ? $trip_starttime : "NO START TIME PROVIDED" ?></small><small> Trip <strong>End Time</strong> <i class="fa fa-clock-o" style="color: #1c84c6;"></i> <?php echo isset($trip_endtime) ? $trip_endtime : "NO END TIME PROVIDED" ?></small></p>
                                        <div class="m-t text-right">

                                            <a href="javascript:void(0)" class="btn btn-xs btn-primary pull-left" style="width:100%;">ROUTE <i class="fa fa-long-arrow-right"></i>
                                                <?php echo isset($route_name) ? $route_name : "NO TRIP PROVIDED" ?>
                                            </a>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="clearfix"></div>
                                        <p><small>ROUTE <strong>SOURCE</strong> <i class="fa fa-map-marker" style="color: red;"></i> <?php echo isset($route_src) ? $route_src : "NO SOURCE PROVIDED" ?></small></p>
                                        <p><small>ROUTE <strong>DESTINATION</strong> <i class="fa fa-map-marker" style="color: red;"></i> <?php echo isset($route_dest) ? $route_dest : "NO DESTINATION PROVIDED" ?></small></p>

                                        <div class="float-right">
                                            <small>Note</small>
                                        </div>
                                        <p>
                                            <span class="text-muted small">
                                                *The User have to check the required pickup points from the left side panel for mapping
                                                a Trip with the Route along with its Pickup Points.
                                            </span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="z-index:9999;">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var table = $('#tbl_trip').dataTable({

        columnDefs: [{
                "width": "35%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "35%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "30%",
                className: "capitalize",
                "targets": 2
            },
        ],
        responsive: false,
        stateSave: false,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                text: 'SELECT ALL',
                action: function(e, dt, node, config) {

                    $('.data_part').iCheck('check');
                    $('.data_part').iCheck('update');

                }
            },
            {
                text: 'DESELECT ALL',
                action: function(e, dt, node, config) {

                    $('.data_part').iCheck('uncheck');
                    $('.data_part').iCheck('update');

                }
            },
        ],
        "fnDrawCallback": function(ele) {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            $('.clockpicker').clockpicker();
        }

    });

    function numericf(event) {
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!/^[0-9\.]+$/.test(key)) {
            return false;
        }
        return true;
    }

    function add_trip_route_pickuppoints() {
        $('#trip_route_loader').addClass('sk-loading');


        var fees_entity = $('#fees_entity').val();
        var route_id = $('#routeid').val();
        var route_name = $('#routeName').val();

        var temp_data = [];
        var err_flag = 0;
        var err_points = [];
        var table = $('#tbl_trip').DataTable();
        table.$('.data_part').each(function() {
            if ($(this).is(':checked') == true) {
                var pick_id = $(this).data('pickuppointid');
                var txt_id = "#" + pick_id + "_pickpoint";
                var txt_val = $(txt_id).val();
                var pick_name = $(this).data('pickuppointname');
                if (txt_val.length == 0 || txt_val.length < 1) {
                    err_flag = 1;
                    err_points.push(pick_name);
                } else {
                    temp_data.push({
                        "pickuppointid": pick_id,
                        "pick_fees": txt_val
                    });
                }
            }
        });
        if (err_flag == 1) {
            swal('', 'Please add  Fees for all selected stops.  The error detected stops is/are ' + err_points.join(), 'info');
            $('#trip_route_loader').removeClass('sk-loading');
            return false;
        }
        var pickuppoint_data = JSON.stringify(temp_data);

        if (pickuppoint_data.length < 3) {

            swal('', 'Atleast One Stop should be selected for assigning Fees.', 'info');
            $('#trip_route_loader').removeClass('sk-loading');
            return false;
        }

        var ops_url = baseurl + 'transport/save-pickuppointfees/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "fees_entity": fees_entity,
                "routeid": route_id,
                "pick_fee_data": pickuppoint_data
            },

            success: function(result) {
                $('#trip_route_loader').removeClass('sk-loading');
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    //                    load_trip_form();
                    swal('Success', 'Fees assigned for the selected  pickuppoints against the Route , ' + route_name + ' successfully.', 'success');
                    $('#trip_route_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#trip_route_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#trip_route_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#trip_route_loader').removeClass('sk-loading');
                }
            }
        });
        $('#trip_route_loader').removeClass('sk-loading');
    }



    function refresh_add_panel() {
        $('#country_name').val('');
        $('#country_name').parent().removeAttr('class', 'has-error');
        $('#country_nation').val('');
        $('#country_nation').parent().removeAttr('class', 'has-error');
        $('#country_abbr').val('');
        $('#country_abbr').parent().removeAttr('class', 'has-error');
        $('#currency_select').select2('val', -1);
    }


    function close_add_country() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });
    }

    //NEW SCRIPT
    function add_new_trip() {
        var ops_url = baseurl + 'transport/create-new-trip/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }

        });
    }
    $(document).ready(function() {

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('.clockpicker').clockpicker();
        $('#search_student').hide();
    });

    function goto_previous() {
        var ops_url = baseurl + 'transport/show-vehicle-route-fees/';
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