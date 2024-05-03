<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Vehicle" data-placement="left" href="javascript:void(0)" onclick="add_new_vehicle();"><i class="fa fa-plus"></i>ADD NEW VEHICLE</a>
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_vehicle">

                                        <thead>
                                            <tr>
                                                <th>Vehicle Registration Number</th>
                                                <th>Vehicle Number (Provided By School)</th>
                                                <th>Chassis Number </th>
                                                <!-- <th>Engine Number</th> -->
                                                <th>Trips</th>
                                                <th>Status</th>
                                                <th>Task</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
                                                foreach ($vehicle_data as $vehicledata) {
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $vehicledata['vehicleNum']; ?></td>
                                                        <td> <?php echo $vehicledata['schoolNum']; ?></td>
                                                        <td> <?php echo $vehicledata['chaisisNum']; ?></td>
                                                        <!-- <td> <?php echo $vehicledata['EngineNum']; ?></td> -->
                                                        <td> <?php echo $vehicledata['trips']; ?></td>


                                                        <td data-toggle="tooltip" title="Click for Enable/Disable">
                                                            <div class="switch">
                                                                <div class="onoffswitch">
                                                                    <?php if ($vehicledata['trips'] != '-') {
                                                                        $disabled = "disabled";
                                                                    } else {
                                                                        $disabled = '';
                                                                    } ?>
                                                                    <?php if ($vehicledata['isActive'] == 1) {
                                                                        $checked = "checked";
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                                    <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" onchange="change_status('<?php echo $vehicledata['id'] ?>','<?php echo $vehicledata['vehicleNum']; ?>', this,'<?php echo $disabled ?>')" id="vehicle_<?php echo $vehicledata['id']; ?>">
                                                                    <label class="onoffswitch-label" for="vehicle_<?php echo $vehicledata['id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_vehicle_registration('<?php echo $vehicledata['id']; ?>', '<?php echo $vehicledata['vehicleNum']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $vehicledata['vehicleNum']; ?>" data-original-title="<?php echo $vehicledata['vehicleNum']; ?>"><i class="fa fa-edit"></i>Update</a></a>
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
        </div>
    </div>
</div>
<script type="text/javascript">
    var list_switchery = [];
    var table = $('#tbl_vehicle').dataTable({
        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 4,
                "orderable": false
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 5,
                "orderable": false
            }
        ],
        responsive: false,
        stateSave: false,
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
        ]
    });



    function edit_vehicle_registration(vehicleId, vehicleNum) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/vehicle-reg-edit/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicleId": vehicleId,
                "vehicleNum": vehicleNum,
                'title_data': title_data
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    //$('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();

                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this Vehicle', 'info');
                    return false;
                }
            }
        });
    }

    function change_status(id, vehicleNum, element, active_trip) {
        $('#faculty_loader').addClass('sk-loading');
        if (active_trip == 'disabled') {
            swal('', 'Vehicle ' + vehicleNum + ' cannot be deactivated as mapped in trips.', 'error');
            $(element).prop("checked", true);
            $('#faculty_loader').removeClass('sk-loading');
            //load_vehicledata_list();
            return false;
        }
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'transport/vehiclereg/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicleid": id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);

                if (data.status == 1) {
                    if (status == -1) {
                        swal('Vehicle Updated', 'Vehicle ' + vehicleNum + ' deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Vehicle Updated', 'Vehicle ' + vehicleNum + ' activated successfully.', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                    load_vehicledata_list();
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
                            load_vehicledata_list();
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
                                load_vehicledata_list();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Vehicle status updation failed.',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_vehicledata_list();
                            });
                        }

                    }
                }
            }
        });
    }

    function load_vehicledata_list() {
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
            }
        });

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
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
            });
        }


    }

    //NEW SCRIPT
    function add_new_vehicle() {
        var ops_url = baseurl + 'transport/create-new-vehicle-registration/';

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
</script>