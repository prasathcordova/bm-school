<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                    <div class="ibox-tools" id="add_type">
                        <!-- <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a> -->
                        <!-- <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new driver" data-placement="left" href="javascript:void(0)" onclick="add_new_driver();"><i class="fa fa-plus"></i>ADD NEW DRIVER</a> -->
                    </div>
                </div>
                <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                <input type="hidden" name="vehicleNum" id="vehicleNum" value="<?php echo isset($vehicleNum) && !empty($vehicleNum) ? $vehicleNum : ''; ?>" />
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
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: block;"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_driver">

                                        <thead>
                                            <tr>
                                                <th>Vehicle No</th>
                                                <th>Driver Name</th>
                                                <!-- <th>Start Date</th> -->
                                                <!-- <th>End Date</th> -->
                                                <!-- <th>Status</th> -->
                                                <th>Task</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // echo json_encode($driver_data);
                                            if (isset($driver_data) && !empty($driver_data) && is_array($driver_data)) {
                                                foreach ($driver_data as $driver) {
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $driver['vehicleNum']; ?></td>
                                                        <td> <?php echo $driver['First_name'] . ' ' . $driver['Middle_name'] . ' ' . $driver['Last_name']; ?></td>
                                                        <td><a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="edit_driver('<?php echo $driver['id']; ?>','<?php echo $driver['vehicleNum']; ?>','<?php echo $driver['First_name']; ?>','<?php echo $driver['Middle_name']; ?>','<?php echo $driver['Last_name']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit"> <i class="fa fa-edit"></i>Update</a></td>

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
        </div>
    </div>
</div>
<script type="text/javascript">
    var list_switchery = [];
    //    var table = $('#tbl_parts').dataTable({
    var table = $('#tbl_driver').dataTable({
        columnDefs: [

            {
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "25%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "25%",
                className: "capitalize",
                "targets": 2
            }



        ],
        responsive: false,
        //        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        },

    });
    $('#tbl_vehicle tbody').on('click', function(e) {
        activateSwitchery()
    });

    $(document).ready(function() {
        activateSwitchery();

    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#23C6C8',
                secondaryColor: '#F8AC59',
                size: 'small'
            });
            //        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_country_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_country_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_country();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_country_add();">NEW COUNTRY</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }


    $(document).on("change", ".driver_status", function() {
        //$(".trip_status").change(function() {
        setTimeout(change_status(this), 100);
    });

    function change_status(element) {
        //        $('#faculty_loader').addClass('sk-loading');
        var id = "#" + $(element).attr('id');
        var Did = $(id).data('driverid');
        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = 0;
        var ops_url = baseurl + 'transport/change_driver_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "driver_map_id": Did,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == 0) {
                        swal('Data Updated', 'Deactivated successfully .', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Data Updated', 'Activated successfully .', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                } else {
                    if (data.status == 0) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function(isConfirm) {
                            //                            window.location.href = baseurl + "country/show-country";
                        });
                    } else {
                        if (data.status == 3) {
                            swal({
                                title: '',
                                text: data.message,
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "country/show-country";
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Country Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "country/show-country";
                            });
                        }

                    }
                }
            }
        });
    }

    function close_add_country() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_driver() {
        var ops_url = baseurl + 'transport/create-new-driver/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
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



    function edit_driver(did, veh_num, dfname, dmname, dlname) {
        var ops_url = baseurl + 'transport/edit-driver/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "veh_id": did,
                "veh_num": veh_num,
                'emp_name': dfname + '' + dmname + '' + dlname
            },
            success: function(result) {
                if (result) {
                    var data = JSON.parse(result);
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $(window).scrollTop(0);

                } else {
                    alert('No data loaded');
                }
            }

        });

    }

    function goto_previous() {
        var ops_url = baseurl + 'transport/Spareparts_controller/load_vehicle/';
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