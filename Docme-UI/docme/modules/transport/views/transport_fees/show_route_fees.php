<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">                        
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
                        <div class="row">

                            <?php
                            if (isset($vehicle_route_data) && !empty($vehicle_route_data) && is_array($vehicle_route_data)) {
                                $breaker = 0;
                                foreach ($vehicle_route_data as $routedata) {
                                    ?>
                                    <div class="col-lg-6">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                <!--<a><span class="pull-right">Click here to view Fees</span></a>-->                                                      
                                                <?php echo $routedata['routeName']; ?><br>
                                            </div>
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                <span class="">From &nbsp; <b><?php echo $routedata['routeSource']; ?></b> &nbsp; To  &nbsp;<b><?php echo $routedata['routeDestination']; ?></b> &nbsp;</span></div>
                                            <div class="ibox-content" >
        <!--                                                <span class="label label-warning pull-left">Routes                                                       
                                                </span>                                                 -->
                                                <a data-toggle="tooltip" title="Click for set fees [Pickup points- Students],<?php echo $routedata['routeName']; ?> Route " href="javascript:void(0)" onclick="show_pickuppoints_students('<?php echo $routedata['id']; ?>', '<?php echo $routedata['routeName']; ?>');"><span class="label label-navy" style="background-color:hotpink; color: white; margin-right: 15px">Fees Student</a> 
                                                </span> 
                                                <a data-toggle="tooltip" title="Click for set fees [Pickup points- Employees],<?php echo $routedata['routeName']; ?> Route "  href="javascript:void(0)" onclick="show_pickuppoints_employees('<?php echo $routedata['id']; ?>', '<?php echo $routedata['routeName']; ?>');"><span class="label label-primary ">Fees Employee                                                       
                                                    </span></a>
                                                <a data-toggle="tooltip" title="Click for set fees [Pickup points- Guests],<?php echo $routedata['routeName']; ?> Route "  href="javascript:void(0)" onclick="show_pickuppoints_guest('<?php echo $routedata['id']; ?>', '<?php echo $routedata['routeName']; ?>');">
                                                    <span class="label label-danger" style="background-color:hotpink; color: white; margin-left:24px">Fees Guest                                                       
                                                    </span>
                                                </a>                                                   

                <!--<div class="stat-percent font-bold text-info"> <a data-toggle="tooltip" title="Click for Pickup points,<?php echo $routedata['routeName']; ?> " href="javascript:void(0)" onclick="show_pickuppoints(<?php echo $routedata['id']; ?>);" style="color: #23c6c8;" ><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;">Student</i></a></div>-->

                                            </div>
                                        </div> 
                                    </div>
                                    <?php
                                    if ($breaker == 1) {
                                        echo '<div class="clearfix"></div>';
                                        $breaker = 0;
                                    } else {
                                        $breaker ++;
                                    }
                                }
                            }
                            ?>
                        </div>                    
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table = $('#vehicle_make_tbl').dataTable({
        columnDefs: [
            {"width": "100%", "targets": 0},
        ],
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
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }
//    function show_pickuppoints(id) {
//        var route_id = id;
//        var ops_url = baseurl + 'transport/load-pickuppoint-page/';
//        $.ajax({
//            type: "POST",
//            cache: false,
//            async: false,
//            url: ops_url,
//            data: {"load": 1, "id": route_id},
//            success: function (result) {
//                $('#data-view').html(result);
//            }
//        });
//
//    }
    function show_pickuppoints_students(id, routeName) {
        var route_id = id;
        var ops_url = baseurl + 'transport/load-pickuppoint-page/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "id": route_id, "feesset": 1, "routeName": routeName},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }
    function show_pickuppoints_employees(id, routeName) {
        var route_id = id;
        var ops_url = baseurl + 'transport/load-pickuppoint-page/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "id": route_id, "feesset": 2, "routeName": routeName},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }
    function show_pickuppoints_guest(id, routeName) {
        var route_id = id;
        var ops_url = baseurl + 'transport/load-pickuppoint-page/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "id": route_id, "feesset": 3, "routeName": routeName},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }


</script>