<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <div class="input-group" style="float: left;margin-left:200px">
                            <input type="text" placeholder="Search Registration No" id="search_user_data" name="search_user_data" class="form-control" style="width: 205px">
                        </div>
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Map Vehicle" data-placement="left" href="javascript:void(0)" onclick="add_vehicle();"><i class="fa fa-edit"></i>Map Vehicle</a>
                        <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
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
                    <input type="hidden" name="tripid" id="tripid" value="<?php echo $trip_id; ?>" />
                    <input type="hidden" name="tripname" id="tripname" value="<?php echo $trip_name; ?>" />
                    <input type="hidden" name="starttime" id="starttime" value="<?php echo $trip_pickstarttime; ?>" />
                    <input type="hidden" name="endtime" id="endtime" value="<?php echo $trip_pickendtime; ?>" />
                    <div class="clearfix"></div>
                    <!--<div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">-->
                    <div class="wrapper wrapper-content animated fadeInRight" id="data-view">

                        <div class="row arraydata">
                            <?php
                            if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
                                $breaker = 0;
                                foreach ($vehicle_data as $busdata) {
                            ?>
                                    <?php if ($vechiclelinkid == $busdata['id']) { ?>
                                        <div class="col-lg-4">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;color: #1c84c6;">
                                                    <div class="i-checks pull-right"><label> <input type="radio" checked="true" data-routename="<?php // echo $busdata['id'];      
                                                                                                                                                ?>" data-vehiclenum="<?php echo $busdata['vehicleNum']; ?>" data-routedestination="<?php // echo $routedata['routeDestination'];      
                                                                                                                                                                                                                                    ?>" value="<?php echo $busdata['id']; ?>" name="vehicleselector"></label></div>

                                                    <span class="label label-danger pull-left" title="<?php echo $busdata['vehicleTypeName'] ?>">Type : <?php echo strlen($busdata['vehicleTypeName']) > 5 ? substr($busdata['vehicleTypeName'], 0, 5) . '...' : $busdata['vehicleTypeName']; ?>
                                                    </span>
                                                    <!-- <span class="label label-danger pull-left" style="background-color: hotpink">Vehicle Type : <?php echo $busdata['vehicleTypeName']; ?>
                                        </span> -->
                                                    <br>
                                                </div>
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 45px;">
                                                    <span class="">Registration Number &nbsp;<br /> <b><?php echo $busdata['vehicleNum']; ?></b> </div>
                                                <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">

                                                    <a>
                                                        <div class="stat-percent font-bold text-info" onclick="show_trip_history('<?php echo $busdata['id']; ?>', '<?php echo $busdata['vehicleNum']; ?>');"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"> </i>View Details</div>
                                                    </a>

                                                </div>
                                            </div>




                                        </div>
                                    <?php } else { ?>

                                        <div class="col-lg-4">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;color: #1c84c6;">
                                                    <div class="i-checks
                                                                                                                                                                                             pull-right"><label> <input type="radio" data-routename="<?php // echo $busdata['id'];      
                                                                                                                                                                                                                                                        ?>" data-vehiclenum="<?php echo $busdata['vehicleNum']; ?>" data-routedestination="<?php // echo $routedata['routeDestination'];      
                                                                                                                                                                                                                                                                                                                                            ?>" value="<?php echo $busdata['id']; ?>" name="vehicleselector"></label></div>
                                                    <span class="label label-danger pull-left" title="<?php echo $busdata['vehicleTypeName'] ?>">Type : <?php echo strlen($busdata['vehicleTypeName']) > 5 ? substr($busdata['vehicleTypeName'], 0, 5) . '...' : $busdata['vehicleTypeName']; ?>
                                                    </span>
                                                    <!-- <span class="label label-danger pull-left" style="background-color: hotpink">Vehicle Type: <?php echo $busdata['vehicleTypeName']; ?>
                                                    </span>  -->
                                                    <br>

                                                </div>
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 45px;">
                                                    <span class="">Registration Number &nbsp; <br /><b><?php echo $busdata['vehicleNum']; ?></b> </div>
                                                <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">

                                                    <a>
                                                        <div class="stat-percent font-bold text-info" onclick="show_trip_history('<?php echo $busdata['id']; ?>', '<?php echo $busdata['vehicleNum']; ?>');"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>View Details</div>
                                                    </a>

                                                </div>
                                            </div>




                                        </div>
                                    <?php } ?>
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
                                    No Vehicles Added
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
    $(document).ready(function() {
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

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });



    function add_vehicle() {
        if ($('input[name=vehicleselector]').is(':checked') == false) {
            swal('', 'Please select a Vehicle', 'info');
            return false;
        }
        if (parseInt($(".checked input[name=vehicleselector]").val()) > 0) {
            var vehicleid = $(".checked input[name=vehicleselector]").val();
            var vehiclenum = $('.checked input[name=vehicleselector]').data('vehiclenum');
        }
        var tripname = $('#tripname').val();
        var tripid = $('#tripid').val();
        var start_time = $('#starttime').val();
        var end_time = $('#endtime').val();
        var ops_url = baseurl + 'transport/trip-vehicle-mapping-add/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "trip_id": tripid,
                "trip_name": tripname,
                "vehilce_id": vehicleid,
                "vehicle_num": vehiclenum,
                "trip_starttime": start_time,
                "trip_endtime": end_time
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    if ('<?php echo $vechiclelinkid; ?>' == vehicleid) {
                        swal('Info .', 'Already Vehicle Linked with this Trip', 'info');
                    } else {
                        swal('Success', 'New Vehicle , ' + vehiclenum + ' to Trip ' + tripname + ' Linked successfully.', 'success');
                    }
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }
            }
        });
    }

    function show_trip_history(busid, busnum) {
        var trip_id = busid;
        var ops_url = baseurl + 'transport/trip-vehicle-mapping-show/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": trip_id,
                "trip_id": $('#tripid').val()
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }

    function goto_previous() {
        var ops_url = baseurl + 'transport/tripsvehiclemap-show/';
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