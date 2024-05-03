<style>
    #ss {
        color: hotpink;

    }
</style>

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
                        <a class="btn btn-block btn-primary compose-mail">Report</a>
                        <div class="space-25"></div>
                        <?php if (check_permission(559, 1210, 115) || check_permission(559, 1211, 115)) { ?>
                            <h5>GENERAL REPORTS</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0;">
                            <!--<li><a href="javascript:void(0);" onclick="load_familyfilter();"> <i class="fa fa-circle text-primary"></i>Vehicle List Report</a></li>-->
                            <?php if (check_permission(559, 1210, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportfuellog();" title="Fuel Log Report"> <i class="fa fa-circle text-danger"></i><span>Fuel Log Report</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(559, 1211, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_report_fuelconsumption();" title="Fuel Consumption Report"> <i class="fa fa-circle text-danger"></i><span>Fuel Consumption Report</span></a></li>
                            <?php } ?>
                            <!-- <li><a href="javascript:void(0);" onclick="load_reportincidents();"> <i class="fa fa-circle text-primary"></i><span >Incident Report</span></a></li> -->
                            <!-- <li><a href="javascript:void(0);" onclick="load_reportservice();"> <i class="fa fa-circle text-default"></i><span >Service/Maintenance Report</span> </a></li>                            -->
                            <!-- <li><a href="javascript:void(0);" onclick="load_reportspares();"> <i class="fa fa-circle text-info"></i><span >Spare Parts Report</span></a></li> -->
                            <!--<li><a href="javascript:void(0);" onclick="load_reportacessories();"> <i class="fa fa-circle text-warning"></i><span >Accessories Report</span></a></li>-->

                            <!--<li><a href="javascript:void(0);" onclick="load_reportlongabsentee();"> <i class="fa fa-circle text-danger"></i>Fuel Consumption Summary Report</a></li>-->


                        </ul>
                        <!-- <h5>EXPENDITURE REPORTS</h5> -->

                        <!-- <ul class="category-list" style="padding: 0"> -->
                        <!-- <li style="color:#1c84c6"><a href="javascript:void(0);" onclick="load_vehicle_costwise();"><i class="fa fa-circle text-info"></i><span >Vehicle Cost Wise Report</span></a></li> -->
                        <!-- <li><a href="javascript:void(0);" onclick="under_construction();"> <i class="fa fa-circle text-primary"></i><span >Vehicle Expenditure Details Report</span></a></li> -->
                        <!-- <li><a href="javascript:void(0);" onclick="under_construction();"> <i class="fa fa-circle text-default"></i><span >Vehicle Expenditure Summary Report</span></a></li> -->
                        <!-- <li><a href="javascript:void(0);" onclick="under_construction();"> <i class="fa fa-circle text-danger"></i><span >Income Report</span></a></li> -->

                        <!-- </ul> -->
                        <?php if (
                            check_permission(559, 1212, 115) || check_permission(559, 1213, 115) || check_permission(559, 1214, 115) || check_permission(559, 1215, 115)
                            || check_permission(559, 1216, 115) || check_permission(559, 1217, 115) || check_permission(559, 1218, 115)
                        ) { ?>
                            <h5>TRIP REPORTS</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">

                            <!-- <li><a href="javascript:void(0);" onclick="load_routewisereport();"> <i class="fa fa-circle text-danger"></i><span >Route wise Report</span> </a></li> -->
                            <?php if (check_permission(559, 1212, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_tripwisereport();" title="Trip Report"> <i class="fa fa-circle text-danger"></i><span>Trip Report</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(559, 1213, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="loadpick_report();" title="Trip-Pickup Point Report"> <i class="fa fa-circle text-danger"></i><span>Trip-Pickup Point Report</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(559, 1214, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="loadpick_fees_report();" title="Pickup Point-Fees Report"> <i class="fa fa-circle text-danger"></i><span>Pickup Point-Fees Report</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(559, 1215, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_studclasswise_rept();" title="Class-Transport Report"> <i class="fa fa-circle text-navy"></i><span>Class-Transport Report</span> </a></li>
                                <!-- <li><a href="javascript:void(0);" onclick="load_report();"> <i class="fa fa-circle text-primary"></i><span >Class wise Summary Report</span> </a></li> -->
                            <?php } ?>
                            <?php if (check_permission(559, 1216, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_trip_student_rept();" title="Trip-Student Report"> <i class="fa fa-circle text-warning"></i><span>Trip-Student Report</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(559, 1217, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_pickupwise_student_rept();" title="Pickup/Drop Point-Student"> <i class="fa fa-circle text-warning"></i><span>Pickup/Drop Point-Studen...</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(559, 1218, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_vehicle_trip_rept();" title="Vehicle-Trip Report"> <i class="fa fa-circle text-warning"></i><span>Vehicle-Trip Report</span> </a></li>
                            <?php } ?>
                        </ul>
                        <?php if (check_permission(559, 1219, 115) || check_permission(559, 1220, 115) || check_permission(559, 1221, 115) || check_permission(559, 1222, 115)) { ?>
                            <h5>Maintenance Reports</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <!-- <li><a href="javascript:void(0);" onclick="load_trip_pickup_point();"> <i class="fa fa-circle text-navy" style="color:hotpink"></i><span >Vehicle Accessories Report</span> </a></li> -->
                            <?php if (check_permission(559, 1219, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="vehicle_Incidents_report();" title="Vehicle Incidents Report"> <i class="fa fa-circle text-navy"></i><span>Vehicle Incident Report</span></a></li>
                            <?php } ?>
                            <?php if (check_permission(559, 1220, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="vehicle_costwise_report();" title="Vehicle Costwise Report"> <i class="fa fa-circle text-navy"></i><span>Vehicle Costwise Report</span></a></li>
                            <?php } ?>
                            <!-- <li><a href="javascript:void(0);" onclick="vehicle_expenditure_report()"> <i class="fa fa-circle text-danger"></i><span >Vehicle Expenditure Report</span> </a></li> -->
                            <!-- <li><a href="javascript:void(0);" onclick="vehicle_expenditure_summary_report();"> <i class="fa fa-circle text-info"></i><span >Vehicle Expenditure Summary Report</span> </a></li> -->
                            <?php if (check_permission(559, 1221, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="vehicle_maintenance_report();" title="Vehicle Maintenance Report"> <i class="fa fa-circle text-info"></i><span>Vehicle Maintenance Report</span> </a></li>
                            <?php } ?>
                            <?php if (check_permission(559, 1222, 115)) { ?>
                                <li><a href="javascript:void(0);" onclick="vehicle_maintenance_summary_report();" title="Vehicle Maintenance Summary Report"> <i class="fa fa-circle text-default"></i><span>Vehicle Maintenance Summa...</span></a></li>
                            <?php } ?>
                            <!-- <li><a href="javascript:void(0);" onclick="load_vehicletriproutepick_emp();"> <i class="fa fa-circle text-default"></i><span >Vehicle SpareParts Report</span></a></li> -->
                        </ul>
                        <!--<li><a href="javascript:void(0);" onclick="load_reportfamilywise();"> <i class="fa fa-circle text-default"></i> Familywise Details</a></li>-->

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


<script>
    function vehicle_Incidents_report() {
        var ops_url = baseurl + 'transport/show-vehicleincidents-report';

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
                scrollUp();
            }
        });
    }

    function vehicle_costwise_report() {
        var ops_url = baseurl + 'transport/show-costwise-report';

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
                scrollUp();
            }
        });
    }

    function vehicle_expenditure_report() {
        var ops_url = baseurl + 'transport/show-expenditure-report';

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
                scrollUp();
            }
        });
    }

    function vehicle_expenditure_summary_report() {
        var ops_url = baseurl + 'transport/show-expenditure-summary-report';

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
                scrollUp();
            }
        });
    }

    function vehicle_maintenance_report() {
        var ops_url = baseurl + 'transport/show-maintenance-report';

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
                scrollUp();
            }
        });
    }

    function vehicle_maintenance_summary_report() {
        var ops_url = baseurl + 'transport/show-maintenance-summary-report';

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
                scrollUp();
            }
        });
    }

    function load_reportfuellog() {
        var ops_url = baseurl + 'transport/show-fuellog-report';

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
                scrollUp();
            }
        });
    }


    function load_report_fuelconsumption() {
        var ops_url = baseurl + 'transport/show-fuelconsumption-report';

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
                scrollUp();
            }
        });
    }

    function load_tripwisereport() {
        var ops_url = baseurl + 'transport/show-vehicle-route-tripwise-reprt';

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
                scrollUp();
            }
        });
    }

    function loadpick_report() {
        var ops_url = baseurl + 'transport/show-vehicle-route-pickpointwise-reprt';

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
                scrollUp();
            }
        });
    }

    function loadpick_fees_report() {
        var ops_url = baseurl + 'transport/show-pickpoint-fees-reprt';

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
                scrollUp();
            }
        });
    }

    function load_studclasswise_rept() {

        var ops_url = baseurl + 'transport/show-studclasswise-rept';

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
                scrollUp();
            }
        });
    }


    function load_trip_student_rept() {
        var ops_url = baseurl + 'transport/show-tripwise-student-rept';

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
                scrollUp();
            }
        });
    }

    function load_pickupwise_student_rept() {
        var ops_url = baseurl + 'transport/show-pickupwise-student-rept';

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
                scrollUp();
            }
        });
    }

    function load_vehicle_trip_rept() {
        var ops_url = baseurl + 'transport/show-vehicle-trip-rept';

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
                scrollUp();
            }
        });
    }

    function scrollUp() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    }
    // ####################################################################################
</script>