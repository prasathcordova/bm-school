<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type" style="top: -9px;left:-19px">
                        <div class="input-group" style="float: right">
                            <input type="text" placeholder="Search Vehicle Number" id="search_user_data" name="search_user_data" class="form-control" style="width: 205px;
    float: right;">

                        </div>
                    </div>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="data-view">
                        <div class="row arraydata">

                            <?php
                            if (isset($trip_data) && !empty($trip_data) && is_array($trip_data)) {
                                $breaker = 0;
                                foreach ($trip_data as $tripdata) {
                            ?>
                                    <div class="col-lg-4">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                <span class="label label-info pull-right">Active</span>
                                                <!-- <span style="color: #1c84c6;"><?php //echo $tripdata['tripName']; 
                                                                                    ?></span> -->
                                                <span style="color: #1c84c6;" title="<?php echo $tripdata['vehicleNum'] != '' ?  $tripdata['tripName'] . '-' . $tripdata['vehicleNum'] : $tripdata['tripName']; ?>">
                                                    <?php echo $tripdata['vehicleNum'] != '' ? strlen($tripdata['tripName'] . '-' . $tripdata['vehicleNum']) > 15 ? substr($tripdata['tripName'] . '-' . $tripdata['vehicleNum'], 0, 20) . '...' : $tripdata['tripName'] . '-' . $tripdata['vehicleNum'] : $tripdata['tripName']; ?>
                                                </span> <br>
                                            </div>
                                            <input type="hidden" name="routename" id="routename" value="<?php // echo isset($tripdata['routeName']) && !empty($tripdata['routeName']) ? $tripdata['routeName'] : ''; 
                                                                                                        ?>" />
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                <small>Vehicle </small>:<br />
                                                <span class="" style="color: #1c84c6;"><?php echo $tripdata['vehicleNum'] != '' ?  $tripdata['vehicleNum'] : '<span style="color:red">NOT MAPPED</span>'; ?></span><br /><br />
                                                <small>Pickup</small>:<br />
                                                <span class="" style="color: #1c84c6;"><small>Start Time : <b class="text-uppercase"><?php echo isset($tripdata['pickStartTime']) ? date('h:i a', strtotime('10-10-2010 ' .  $tripdata['pickStartTime'])) : 'NIL'; ?></b> <br />End Time :<b class="text-uppercase"><?php echo isset($tripdata['pickEndTime']) ? date('h:i a', strtotime('10-10-2010 ' .  $tripdata['pickEndTime'])) : 'NIL'; ?></b> &nbsp;</small></span><br />
                                                <br /><small>Drop</small>:<br />
                                                <span class="" style="color: #1c84c6;"><small>Start Time : <b class="text-uppercase"><?php echo isset($tripdata['dropStartTime']) ? date('h:i a', strtotime('10-10-2010 ' .  $tripdata['dropStartTime'])) : 'NIL'; ?></b> <br />End Time :<b class="text-uppercase"><?php echo isset($tripdata['dropEndTime']) ? date('h:i a', strtotime('10-10-2010 ' .  $tripdata['dropEndTime'])) : 'NIL'; ?></b> &nbsp;</small></span>
                                            </div>
                                            <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                <!--<span class="stat-percent font-bold text-info pull-left"><a data-toggle="tooltip" title="Click to view details,<?php echo $tripdata['tripName']; ?> " href="javascript:void(0)" onclick="view_trip(<?php echo $tripdata['id']; ?>);" style="color: #23c6c8;" ><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;">Click to View Details</i></a>-->
                                                <div class="stat-percent font-bold text-info pull-left">
                                                    <a data-toggle="tooltip" title="Click to view details,<?php echo $tripdata['tripName']; ?> " href="javascript:void(0)" onclick="view_trip(<?php echo $tripdata['id']; ?>);" style="color: #23c6c8;"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>View Details</a>
                                                </div>
                                                <div class="stat-percent font-bold text-info" style="margin-bottom: 8px;">
                                                    <a data-toggle="tooltip" title="Click for mapping a vehicle to Trip - <?php echo $tripdata['tripName']; ?> " href="javascript:void(0)" onclick="add_vehicle(<?php echo $tripdata['id']; ?>);" style="color: #23c6c8;"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>Map Vehicle</a>
                                                </div>

                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                <?php
                                    if ($breaker == 2) {
                                        // echo '<div class="clearfix"></div>';
                                        $breaker = 0;
                                    } else {
                                        $breaker++;
                                    }
                                }
                            } else { ?>
                                <div class="col-lg-4">
                                    No Trips Added
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#search_user_data").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var filter = $(this).val(),
            count = 0;
        $(".arraydata .ibox").each(function() {

            var current = $('.ibox').attr('data-name');
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).parent().fadeOut();
            } else {
                $(this).parent().show();
                count++;
            }
        });
    });

    var table = $('#vehicle_make_tbl').dataTable({
        columnDefs: [{
            "width": "100%",
            "targets": 0
        }, ],
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
    });


    function load_vehiclemake_on_show() {
        var ops_url = baseurl + 'transport/create-vehiclemake/';
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

    function add_vehicle(id) {
        var trip_id = id;
        var ops_url = baseurl + 'transport/load-vehicle-map-page/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": trip_id
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });

    }

    function show_vehicle(id) {
        var trip_id = id;
        var ops_url = baseurl + 'transport/trip-vehicle-mapping-show/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": trip_id
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });

    }

    function view_trip(id) {
        var route_id = id;
        var ops_url = baseurl + 'transport/load-trip-maplistdetails-page/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": route_id
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });

    }
</script>