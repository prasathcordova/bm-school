<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type" style="top: -9px;left:-19px">
                        <div class="input-group" style="float: right">
                            <input type="text" placeholder="Search Registration No" id="search_user_data" name="search_user_data" class="form-control" style="width: 205px;
    float: right;">
                            <!-- <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary" onclick="load_search_user_data();"> <i class="fa fa-search"></i> Search</button>
                            </span> -->
                        </div>
                        <!--<a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Fee Type" data-placement="left"href="javascript:void(0)" onclick="add_new_vehicle_make();"><i class="fa fa-plus"></i>ADD VEHICLE MAKE</a>-->
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
                    <!--<div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">-->
                    <div class="wrapper wrapper-content animated fadeInRight" id="data-view">

                        <div class="row arraydata">
                            <?php
                            if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
                                $breaker = 0;
                                foreach ($vehicle_data as $busdata) {
                            ?>
                                    <div class="col-lg-4">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;color: #1c84c6;">
                                                <span class="regnum"><b><?php echo $busdata['vehicleNum']; ?></b></span>
                                                <!-- <?php echo 'Route: TVM-KLM'; ?><br> -->
                                                <div class="ibox-tools pull-right" style="padding: 8px ">
                                                    <span class="label label-danger pull-left" title="<?php echo $busdata['vehicleTypeName'] ?>">
                                                        Type:<?php echo strlen($busdata['vehicleTypeName']) > 5 ? substr($busdata['vehicleTypeName'], 0, 5) . '...' : $busdata['vehicleTypeName']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;">
                                                <span class="pull-left">School Vehicle No&nbsp;:&nbsp;<b><?php echo $busdata['schoolNum']; ?></b></span><br>
                                                <span class="pull-left">Registration No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<b><?php echo $busdata['vehicleNum']; ?></b></span>
                                            </div>
                                            <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                <!-- <span class="label label-danger pull-left">Type:<?php echo $busdata['vehicleTypeName']; ?>
                                                </span> -->
                                                <a>
                                                    <div class="stat-percent font-bold text-info pull-left" onclick="add_service('<?php echo $busdata['id']; ?>', '<?php echo $busdata['vehicleNum']; ?>');" title="View Details"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>View Details</div>
                                                </a>

                                            </div>
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
                                    No vehicles added.
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


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });


    $(".fee_type_status").change(function() {
        setTimeout(change_status(this), 100);
    });


    function add_service(id, vehicleNum) {
        var bus_id = id;
        var vehiclenum = vehicleNum;
        var ops_url = baseurl + 'transport/load-serviceadd-page/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": bus_id,
                "vehiclenum": vehiclenum
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                } else {
                    swal('', 'The vehicle - ' + vehiclenum + '  is already out for service. Please complete the Invoice Entry for Next Service.', 'info');
                    return false;
                }
            }
        });

    }
</script>