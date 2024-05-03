<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a New Pickup Point" data-placement="left" href="javascript:void(0)" onclick="add_new_pickuppoint();"><i class="fa fa-plus"></i>ADD PICKUP POINT</a>
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
                                <table id="pickuppoints_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Pickup Point Name</th>
                                            <th>Description</th>
                                            <th>Created Date </th>
                                            <th>Status</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $breaker = 0;
                                        if (isset($vehicle_pickuppoints_data) && !empty($vehicle_pickuppoints_data)) {
                                            foreach ($vehicle_pickuppoints_data as $pickuppoints) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $pickuppoints['pickpointName']; ?></td>
                                                    <td><?php echo $pickuppoints['pickuppointDescription']; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($pickuppoints['createdOn'])) ?></td>
                                                    <td data-toggle="tooltip" title="Click for Enable/Disable">
                                                        <div class="switch">
                                                            <div class="onoffswitch">
                                                                <?php if ($pickuppoints['isActive'] == 1) { ?>
                                                                    <input type="checkbox" checked class="onoffswitch-checkbox pick_status" data-pickid="<?php echo $pickuppoints['id']; ?>" id="pick_<?php echo $pickuppoints['id']; ?>">
                                                                    <label class="onoffswitch-label" for="pick_<?php echo $pickuppoints['id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                <?php
                                                                } else { ?>
                                                                    <input type="checkbox" class="onoffswitch-checkbox pick_status" data-pickid="<?php echo $pickuppoints['id']; ?>" id="pick_<?php echo $pickuppoints['id']; ?>">
                                                                    <label class="onoffswitch-label" for="pick_<?php echo $pickuppoints['id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                <?php
                                                                } ?>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td><a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="edit_pickuppoint('<?php echo $pickuppoints['id']; ?>', '<?php echo $pickuppoints['pickpointName']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $pickuppoints['pickpointName']; ?>" data-original-title="<?php echo $pickuppoints['pickpointName']; ?>"> <i class="fa fa-edit"></i>Update</a></td>
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


<script type="text/javascript">
    var table = $('#pickuppoints_tbl').dataTable({
        // columnDefs: [{
        //     "width": "100%",
        //     "targets": 0
        // }, ],
        responsive: false,
        //iDisplayLength: 10,
        "ordering": false,
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
    });


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    $(document).on("change", ".pick_status", function() {
        //$(".pick_status").change(function() {
        setTimeout(change_status(this), 100);
    });

    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
            });
        }

    }


    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var pickid = $(id).data('pickid');
        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'transport/statuschange-pickuppoint/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pickid": pickid,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Pickup Point Updated', 'Pickup Point deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Pickup Point Updated', 'Pickup Point activated successfully.', 'success');
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
                            load_pickpoint_on_show();
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
                                load_feetype_on_show();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Pickup Point status updation failed.',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_pickpoint_on_show();
                            });
                        }

                    }
                }
            }
        });
    }

    function load_pickpoint_on_show() {
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
            }
        });

    }

    function edit_pickuppoint(id, pickpointName) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-pickuppoint';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pickuppoint_id": id,
                "pickuppoint_name": pickpointName,
                'title_data': title_data
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    // $('#month_span_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                    // $('#payment_mode_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                    // $('#feetype_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this fee type', 'info');
                    return false;
                }
            }
        });
    }



    //NEW SCRIPT
    function add_new_pickuppoint() {
        var ops_url = baseurl + 'transport/add-pickuppoint';
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
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    // $('#month_span_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                    // $('#payment_mode_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                    // $('#feetype_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                } else {
                    swal('', 'No data available associated with this fee type', 'info');
                    return false;
                }
            }
        });
    }
</script>