<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12" style="z-index: 9999;">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row">
                            <div class="col-lg-12" style="z-index:9999;">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <center>
                                            <a data-toggle="tooltip" title="Student Allotment" href="javascript:void(0)" onclick="show_student_filter();">
                                                <i class="fa fa-bus payment-icon-big text-info" style="font-size: 53px!important;"></i>
                                                <h2>
                                                    <div data-toggle="modal" class="btn btn-info btn-xs" data-placement="left">Student Allotment</div>
                                                </h2>
                                            </a>
                                        </center>
                                    </div>
                                    <div class="col-md-4">
                                        <center>
                                            <a data-toggle="tooltip" title="Allotted Students-Trip Wise" href="javascript:void(0)" onclick="list_student_allocation(1,0);">
                                                <i class="fa fa-bus payment-icon-big text-warning " style="color: hotpink;font-size: 53px!important;"></i>
                                                <h2>
                                                    <div data-toggle="modal" class="btn btn-warning btn-xs" style="border-color: hotpink; background-color: hotpink; color: white;" data-placement="center">Allotted Students<br />Trip Wise</div>
                                                </h2>
                                            </a>
                                        </center>
                                    </div>

                                    <div class="col-md-4">
                                        <center>
                                            <a data-toggle="tooltip" title="Allotted Students-Pickup Point Wise" href="javascript:void(0)" onclick="list_student_allocation(2,0);">
                                                <i class="fa fa-bus payment-icon-big text-warning " style="color: hotpink;font-size: 53px!important;"></i>
                                                <h2>
                                                    <div data-toggle="modal" class="btn btn-warning btn-xs" style="border-color: hotpink; background-color: hotpink; color: white;" data-placement="left">Allotted Students<br />Pickup Point Wise</div>
                                                </h2>
                                            </a>
                                        </center>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function same_pick_drop() {
            var ops_url = baseurl + 'transport/show-allotment-route-student/';
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

        function load_pickonly() {
            var ops_url = baseurl + 'transport/show-allotment-route-student-picknly/';
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

        function load_pickpoint_change() {
            var ops_url = baseurl + 'transport/show-alloted-student-pick-change-filter/';
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

        function load_droponly() {
            var ops_url = baseurl + 'transport/show-allotment-route-student-dropnly/';
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

        function load_dropchange() {
            var ops_url = baseurl + 'transport/show-alloted-student-drop-change-filter/';
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

        function load_trip_change() {
            var ops_url = baseurl + 'transport/show-alloted-student-trip-change-filter/';
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

        function load_droptrip_change() {
            var ops_url = baseurl + 'transport/show-alloted-student-droptrip-change-filter/';
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

        function loadalloteds_student() {
            var ops_url = baseurl + 'transport/show-alloted-student-deallocation-change-filter/';
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

        function show_student_filter() {
            var ops_url = baseurl + 'transport/show-student-filter/';
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

        function load_sameroute_change() {
            var ops_url = baseurl + 'transport/show-alloted-student-sameroute-change-filter/';
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

        function load_vehicles() {
            var ops_url = baseurl + 'transport/show-vehicle_list_passngr/';
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

        function load_trips() {
            var ops_url = baseurl + 'transport/show-trip-list_passngr/';
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

        function load_routes() {
            var ops_url = baseurl + 'transport/show-routes-list_passngr/';
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

        function load_diffroute_change() {
            var ops_url = baseurl + 'transport/show-alloted-student-diffroute-change-filter/';
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

        function load_student_allotment() {
            var ops_url = baseurl + 'transport/show-passenger-student-info/';
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

        function different_pick_drop() {
            var ops_url = baseurl + 'transport/show-allotment-route-student-pickdrop/';
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

        function list_student_allocation(type, attr) {
            var ops_url = baseurl + 'transport/show-student-allocation-list/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "type": type, //type=1 Tripwise , Type=2 Pickuppoint Wise
                    "attr": attr
                },
                success: function(result) {
                    $('#data-view').html(result);

                }
            });
        }
    </script>