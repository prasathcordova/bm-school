<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            ?>
        </ol>
    </div>
</div>


<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0);">Transport Settings</a>
                        <div class="space-25"></div>
                        <?php if (check_permission(558, 1196, 115)) { ?>
                            <h5>Passenger Settings</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <!--<li><a href="javascript:void(0)" onclick="allot_student();"> <i class="fa fa-circle text-danger"></i> Vehicles <span class="label label-warning pull-right" id="currency_count"><?php // echo $count_data[0]['Currency'];  
                                                                                                                                                                                                                ?>12</span> </a></li>-->
                            <!--<li><a href="javascript:void(0)" onclick="load_vehicles();"> <i class="fa fa-circle text-danger"></i> Vehicles  </a></li>-->
                            <?php if (check_permission(558, 1196, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="allotment_student_passenger();" title="Student Transport Details"> <i class="fa fa-circle text-info"></i><span>Student Transport Details</span></a></li>
                            <?php } ?>
                            <!--<li><a href="javascript:void(0)" onclick="allotment_employee_passenger();"> <i class="fa fa-circle text-danger"></i><span >Passenger Employee</span></a></li>-->
                            <!--<li><a href="javascript:void(0)" onclick="allotment_guest_passenger();"> <i class="fa fa-circle text-primary"></i><span >Passenger Guest</span></a></li>-->
                            <!--                            <li><a href="javascript:void(0)" onclick="allotment_student_vehicle();"> <i class="fa fa-circle text-primary"></i> Student Allotment  </a></li>
                            <li><a href="javascript:void(0)" onclick="allotment_staff_vehicle();"> <i class="fa fa-circle text-primary"></i> Staff Allotment  </a></li>
                            <li><a href="javascript:void(0)" onclick="load_profession();"> <i class="fa fa-circle text-info"></i> Guest Allotment <span class="label label-info pull-right" id="profession_count"><?php // echo $count_data[0]['Profession'];  
                                                                                                                                                                                                                    ?>56</span> </a></li>
                            <li><a href="javascript:void(0)" onclick="allotment_guest_vehicle();"> <i class="fa fa-circle text-info"></i> Guest Allotment  </a></li>
                            <li><a href="javascript:void(0)" onclick="load_student_deallot_route();"> <i class="fa fa-circle text-primary"></i> Student De-Allotment  </a></li>
                            <li><a href="javascript:void(0)" onclick="load_staff_deallot_route();"> <i class="fa fa-circle text-primary"></i> Staff De-Allotment  </a></li>
                            <li><a href="javascript:void(0)" onclick="load_profession();"> <i class="fa fa-circle text-info"></i> Guest Allotment <span class="label label-info pull-right" id="profession_count"><?php // echo $count_data[0]['Profession'];  
                                                                                                                                                                                                                    ?>56</span> </a></li>
                            <li><a href="javascript:void(0)" onclick="load_guest_deallot_route();"> <i class="fa fa-circle text-info"></i> Guest De-Allotment  </a></li>-->

                        </ul>
                        <?php if (check_permission(558, 1190, 115) || check_permission(558, 1191, 115)) { ?>
                            <h5>Vehicle Settings</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">



                            <!--<li><a href="javascript:void(0)" onclick="load_vehicle_type();"><i class="fa fa-circle text-danger"></i><span >Vehicle Type </span></a></li>-->

                            <!--<li><a href="javascript:void(0)" onclick="load_vehicle_make();"><i class="fa fa-circle text-primary"></i><span >Vehicle Make</span></a></li>-->
                            <!--<li><a href="javascript:void(0)" onclick="load_vehicle_model();"><i class="fa fa-circle text-info"></i><span >Vehicle Model</span></a></li>-->
                            <!--<li><a href="javascript:void(0)" onclick="load_vehicle_insurance();"><i class="fa fa-circle text-info" style="color: hotpink !important;"></i><span >Vehicle Insurance</span></a></li>-->
                            <!--<li><a href="javascript:void(0)" onclick="load_fueltype();"> <i class="fa fa-circle text-primary"></i> Fuel Type  </a></li>-->
                            <!--<li><a href="javascript:void(0)" onclick="load_modelyr();"> <i class="fa fa-circle text-primary"></i><span >Vehicle Model Year</span></a></li>-->
                            <?php if (check_permission(558, 1190, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_basic_settings();" title="Basic Settings"><i class="fa fa-circle text-danger"></i><span>Basic Settings </span></a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1191, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_vehicle_registration_details();" title="Vehicle Registration"> <i class="fa fa-circle text-warning"></i><span>Vehicle Registration</span></a></li>
                            <?php } ?>
                        </ul>
                        <?php if (
                            check_permission(558, 1192, 115) || check_permission(558, 1193, 115) || check_permission(558, 1194, 115)
                            || check_permission(558, 1195, 115)
                        ) { ?>
                            <h5>Trip Settings</h5>
                        <?php  } ?>
                        <ul class="category-list" style="padding: 0">
                            <!--<li><a href="javascript:void(0)" onclick="load_route();"> <i class="fa fa-circle text-info"style="color: hotpink !important;"></i><span >Route Management</span> </a></li>-->
                            <!--<li><a href="javascript:void(0)" onclick="load_route();"> <i class="fa fa-circle text-info"style="color: hotpink !important;"></i> Route <span class="label label-danger pull-right" id="caste_count"><?php // echo $count_data[0]['Caste'];  
                                                                                                                                                                                                                                        ?>34</span> </a></li>-->
                            <?php if (check_permission(558, 1192, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_pickuppoint();" title="Pickup Point"> <i class="fa fa-circle text-danger"></i><span>Pickup Point</span> </a></li>
                                <!--<li><a href="javascript:void(0)" onclick="load_pickuppoint();"> <i class="fa fa-circle text-danger"></i> Pickup Point <span class="label label-warning pull-right" id="community_count"><?php // echo $count_data[0]['Community'];  
                                                                                                                                                                                                                            ?>33</span> </a></li>-->
                                <!--<li><a href="javascript:void(0)" onclick="load_fee_demand();"> <i class="fa fa-circle text-warning"></i> Pick point to Trip <span class="label label-info pull-right" id="community_count"><?php // echo $count_data[0]['Community'];  
                                                                                                                                                                                                                                ?>12</span> </a></li>-->
                                <!--<li><a href="javascript:void(0)" onclick="route_pickuppoint_mapping_list();"> <i class="fa fa-circle text-warning"></i><span >Pickup Point Route Mapping</span></a></li>-->
                            <?php } ?>
                            <?php if (check_permission(558, 1193, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="trip_show();" title="Trip"> <i class="fa fa-circle text-primary"></i><span>Trip</span></a></li>
                                <!--<li><a href="javascript:void(0)" onclick="trip_route_map();"> <i class="fa fa-circle text-info"></i><span >Trip Route Mapping</span></a></li>-->
                            <?php } ?>
                            <?php if (check_permission(558, 1194, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="trip_vehicle_map();" title="Trip Vehicle Mapping"> <i class="fa fa-circle text-primary"></i><span>Trip Vehicle Mapping</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1195, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_pickupoint_fees();" title="Pickup Point-Fees"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i><span>Pickup Point-Fees</span></a></li>
                            <?php } ?>
                            <!-- <li><a href="javascript:void(0)" onclick="route_trip();"> <i class="fa fa-circle text-primary"></i> Route to Trip  </a></li> -->
                            <!--<li><a href="javascript:void(0)" onclick="round_trip_mapping();"> <i class="fa fa-circle text-primary"></i> Round Trip Mapping  </a></li>-->

                            <!--<li><a href="javascript:void(0)" onclick="bus_trip_mapping();"> <i class="fa fa-circle text-info"></i> Vehicle Trip Mapping  </a></li>-->
                            <!--<li><a href="javascript:void(0)" onclick="route_pickuppoint_mapping_list();"> <i class="fa fa-circle text-info"></i> Route-Pickup Point map list <span class="label label-success pull-right" id="community_count"><?php // echo $count_data[0]['Community'];  
                                                                                                                                                                                                                                                    ?>67</span> </a></li>-->


                        </ul>

                        <?php if (
                            check_permission(558, 1197, 115) || check_permission(558, 1198, 115) || check_permission(558, 1199, 115)
                            || check_permission(558, 1200, 115) || check_permission(558, 1201, 115) || check_permission(558, 1202, 115)
                        ) { ?>
                            <h5>Service and Maintenance</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">

                            <?php if (check_permission(558, 1197, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_incidents_list();" title="Vehicle Incident"> <i class="fa fa-circle text-info"></i><span>Vehicle Incident</span> </a></li>
                            <?php } ?>
                            <!-- <li><a href="javascript:void(0)" onclick="load_incidents();"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i> Vehicle Incidents  <span class="label label-danger pull-right" id="account_code"></span> </a></li>
                             <li><a href="javascript:void(0)" onclick="under_construction();"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i> Vehicle Incidents  <span class="label label-danger pull-right" id="account_code"> </a></li> -->
                            <!-- <li><a href="javascript:void(0)" onclick="load_fee_type();"> <i class="fa fa-circle text-warning"></i> Vehicle Service Booking <span class="label label-info pull-right" id="city_count"></span>  </a></li>                                  -->
                            <?php if (check_permission(558, 1198, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="show_service_vehicle_list();" title="Vehicle Service Booking"> <i class="fa fa-circle text-warning"></i><span>Vehicle Service Booking</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1200, 115)) { ?>
                                <!-- <li><a href="javascript:void(0)" onclick="show_servicebooking();"> <i class="fa fa-circle text-warning"></i><span >Vehicle Service Booking History</span></a></li>                                          -->
                                <!-- <li><a href="javascript:void(0)" onclick="create_servicebooking();"> <i class="fa fa-circle text-warning"></i> Vehicle Service Booking   </a></li>                                    -->
                                <li><a href="javascript:void(0)" onclick="show_invoice();" title="Service Invoice"> <i class="fa fa-circle text-warning" style="color:hotpink;"></i><span> Service Invoice</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1199, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="show_service_vehicle_history();" title="Vehicle Service History"> <i class="fa fa-circle text-warning"></i><span>Vehicle Service History</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1201, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="show_invoice_vehicles();" title="Invoice History"> <i class="fa fa-circle text-warning" style="color:hotpink;"></i><span> Invoice History</span></a></li>
                            <?php } ?>
                            <!-- <li><a href="javascript:void(0)" onclick="under_construction();"> <i class="fa fa-circle text-danger"></i> Vehicle Service Details  <span class="label label-danger pull-right" id="account_code"></span> </a></li> -->

                            <!-- <li><a href="javascript:void(0)" onclick="under_construction();"> <i class="fa fa-circle text-success"></i> Vehicle Delivery <span class="label label-info pull-right"style="color: white !important; background-color: hotpink;" id="city_count"></span>  </a></li>                                         -->
                            <?php if (check_permission(558, 1202, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_vehicle_fuel_log();" title="Fuel Log"> <i class="fa fa-circle text-success"></i><span> Fuel Log</span> </a></li>
                            <?php } ?>
                        </ul>
                        <?php if (
                            check_permission(558, 1203, 115) || check_permission(558, 1204, 115) || check_permission(558, 1205, 115)
                            || check_permission(558, 1206, 115) || check_permission(558, 1207, 115)
                        ) { ?>

                            <h5>Other Settings</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <!-- <li><a href="javascript:void(0)" onclick="allot_student();"> <i class="fa fa-circle text-danger"></i> Fuel Price <span class="label label-warning pull-right" id="currency_count"></span> </a></li> -->
                            <!-- <li><a href="javascript:void(0)" onclick="load_vehicle_registration();"> <i class="fa fa-circle text-success"></i> Vehicle Registration <span class="label label-success pull-right" id="city_count"></span>  </a></li>                                    -->
                            <?php if (check_permission(558, 1203, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_qrpage();" title="QR Code Generate"> <i class="fa fa-circle text-info"></i><span>QR Code Generator</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1204, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_servicecenter();" title="Service Center"> <i class="fa fa-circle text-info"></i><span>Service Center</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1205, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_servicetype();" title="Service Type"> <i class="fa fa-circle text-info"></i><span>Service Type</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1206, 115)) { ?>
                                <!-- <li><a href="javascript:void(0)" onclick="load_staff_list();"> <i class="fa fa-circle text-info"></i><span >Vehicle Staff</span> </a></li> -->
                                <!-- <li><a href="javascript:void(0)" onclick="load_servicecenter();"> <i class="fa fa-circle text-info"></i> Service center <span class="label label-info pull-right" id="profession_count"></span> </a></li> -->
                                <li><a href="javascript:void(0)" onclick="load_vehicle_spare();" title="Spare Part"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i><span title="Spare Part">Spare Parts</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1207, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_conductor();" title="Conductor"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i><span title="Conductor">Conductor</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1208, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_driver();" title="Driver"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i><span title="Driver">Driver</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(558, 1207, 115)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_daily_travel_log();" title="Daily Travel Data"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i><span>Daily Travel Log</span> </a></li>
                            <?php } ?>
                            <!-- <li><a href="javascript:void(0)" onclick="load_spareparts_vehicles();"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i><span >Spare Parts Allocation</span>  </a></li> -->
                            <!-- <li><a href="javascript:void(0)" onclick="load_vehicle_acessories();"> <i class="fa fa-circle text-info" style="color: hotpink !important;"></i><span >Accessories</span>  </a></li> -->
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="" id="data-view">


            </div>
        </div>
    </div>
</div>

<!-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyBkDLA8MD77ueEwwxMgxadTBtzjgU0fJE0"></script> -->
<link href="<?php echo base_url('assets/theme/css/plugins/clockpicker/clockpicker.css'); ?>" rel="stylesheet">
<!-- Clock picker -->
<script src="<?php echo base_url('assets/theme/js/plugins/clockpicker/clockpicker.js'); ?>"></script>

<script>
    function gs_count() {
        var ops_url = baseurl + 'settings/show-count/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var count_data = data.data[0];
                    $("#country_count").text(count_data['Country']);
                    $("#state_count").text(count_data['States']);
                    $("#city_count").text(count_data['City']);
                    $("#religion_count").text(count_data['Religion']);
                    $("#caste_count").text(count_data['Caste']);
                    $("#community_count").text(count_data['Community']);
                    $("#currency_count").text(count_data['Currency']);
                    $("#language_count").text(count_data['Languages']);
                    $("#profession_count").text(count_data['Profession']);
                    //                    $.each(count_data, function (i, v) {
                    //                        $("#publisher_count").text('+v.publisher_count+');
                    //                    });
                }
            }
        });
    }


    //   load_accountcode();
    allotment_student_passenger();

    function under_construction() {
        swal('', 'This functionality is under construction.', 'info');
        return false;
    }

    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function() {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Refresh");
            }, 2000);
        }
    }

    function load_basic_settings() {
        var ops_url = baseurl + 'transport/basic-sett/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_fees() {
        var ops_url = baseurl + 'fees/create-feescode/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_vehicle_type() {
        var ops_url = baseurl + 'transport/create-vehicletype/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_vehicle_make() {
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_vehicle_model() {
        var ops_url = baseurl + 'transport/create-vehiclemodel/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_vehicle_insurance() {
        var ops_url = baseurl + 'transport/create-vehicleinsurance/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_trip() {
        var ops_url = baseurl + 'transport/show-vehicle-trip/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_route() {
        var ops_url = baseurl + 'transport/show-vehicle-route/';
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
                $(window).scrollTop(0);

            }
        });

    }

    function load_vehiclefees_route() {
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
                $(window).scrollTop(0);

            }
        });

    }

    function load_fueltype() {
        var ops_url = baseurl + 'transport/show-vehicle-fueltype/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_modelyr() {
        var ops_url = baseurl + 'transport/show-vehicle-modelyear/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_pickuppoint() {
        var ops_url = baseurl + 'transport/show-vehicle-pickuppoint/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_pickupoint_fees() {
        var ops_url = baseurl + 'transport/show-pickupoint-fees/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function route_trip() {
        var ops_url = baseurl + 'transport/mapping-route-trip/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function trip_show() {
        var ops_url = baseurl + 'transport/trip-show/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function trip_route_map() {
        var ops_url = baseurl + 'transport/tripsroutemap-show/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function trip_vehicle_map() {
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
                $(window).scrollTop(0);
            }
        });

    }

    function round_trip_mapping() {
        var ops_url = baseurl + 'transport/mapping-roundtrip/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_student_deallot_route() {
        var ops_url = baseurl + 'transport/deallot-student-route/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_staff_deallot_route() {
        var ops_url = baseurl + 'transport/deallot-staff-route/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_guest_deallot_route() {
        var ops_url = baseurl + 'transport/deallot-guest-route/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function bus_trip_mapping() {
        var ops_url = baseurl + 'transport/mapping-bus-trip/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function route_pickuppoint_mapping_list() {
        var ops_url = baseurl + 'transport/route-pickuppoint-list/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_qrpage() {
        var ops_url = baseurl + 'transport/show-vehicle-qrpage/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_servicecenter() {
        var ops_url = baseurl + 'transport/show-vehicle-servicecenter/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_servicetype() {
        var ops_url = baseurl + 'transport/show-vehicle-servicetype/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_vehicle_registration() {
        var ops_url = baseurl + 'transport/create-new-vehicle-registration/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_vehicle_registration_details() {
        var ops_url = baseurl + 'transport/show-new-vehicle-registration/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_incidents() {
        var ops_url = baseurl + 'transport/create-new-vehicle-incidents/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_incidents_list() {
        var ops_url = baseurl + 'transport/show-new-vehicle-incidents/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_vehicle_fuel_log() {
        var ops_url = baseurl + 'transport/show-vehicle-fuel/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_staff_list() {
        var ops_url = baseurl + 'transport/show-new-vehicle-staff/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_vehicle_spare() {
        var ops_url = baseurl + 'transport/show-vehicle-spares/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_conductor() {
        var ops_url = baseurl + 'transport/show-conductor/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_driver() {
        var ops_url = baseurl + 'transport/show-driver/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_spareparts_vehicles() {
        var ops_url = baseurl + 'transport/show-spareparts-vehiclez/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_vehicle_acessories() {
        var ops_url = baseurl + 'transport/show-vehicle-acessories/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function allotment_student_vehicle() {
        var ops_url = baseurl + 'transport/allotment-student/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function allotment_student_passenger() {
        var ops_url = baseurl + 'transport/passenger-student/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function allotment_employee_passenger() {
        var ops_url = baseurl + 'transport/passenger-employee/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function allotment_guest_passenger() {
        var ops_url = baseurl + 'transport/passenger-guest/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function allotment_staff_vehicle() {
        var ops_url = baseurl + 'transport/allotment-staff/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function allotment_guest_vehicle() {
        var ops_url = baseurl + 'transport/allotment-guest/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_vehicles() {
        var ops_url = baseurl + 'transport/load-vehicles-profile/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function show_service_vehicle_list() {
        var ops_url = baseurl + 'transport/show-vehicle-servicebooking/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function show_service_vehicle_history() {
        var ops_url = baseurl + 'transport/show-vehicle-servicebooking-history/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function show_servicebooking() {
        var ops_url = baseurl + 'transport/show-allvehicle-service/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function show_invoice() {
        var ops_url = baseurl + 'transport/show-vehicle-service-invoice/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function show_invoice_vehicles() {
        var ops_url = baseurl + 'transport/show-allvehicle-invoice/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function create_invoice() {
        var ops_url = baseurl + 'transport/create-new-vehicle-invoice-delivery/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function allot_student() {
        var ops_url = baseurl + 'transport/allotment_for_student/';
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

    function load_fee_type() {
        var ops_url = baseurl + 'fees/create-feetype/';
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

    function load_daily_travel_log() {
        var ops_url = baseurl + 'transport/daily-travel-log/';
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
                $(window).scrollTop(0);
            }
        });
    }
</script>