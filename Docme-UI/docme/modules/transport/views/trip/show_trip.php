<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Trip" data-placement="left" href="javascript:void(0)" onclick="add_new_trip();"><i class="fa fa-plus"></i>ADD TRIP</a>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_trip">

                                    <thead>
                                        <tr>
                                            <th>Trip Name</th>
                                            <th>Trip Code</th>
                                            <th>Description</th>
                                            <th>Pickup <br />Time Range</th>
                                            <th>Drop <br />Time Range</th>
                                            <th>Status</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($trip_data) && !empty($trip_data) && is_array($trip_data)) {
                                            foreach ($trip_data as $tripdata) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $tripdata['tripName']; ?></td>
                                                    <td> <?php echo $tripdata['tripCode']; ?></td>
                                                    <td> <?php echo $tripdata['tripDescription']; ?></td>
                                                    <td class="text-uppercase">
                                                        <?php echo date('h:i a', strtotime($tripdata['pickStartTime'] . ':00 10/10/2019')); ?> -<br />
                                                        <?php echo date('h:i a', strtotime($tripdata['pickEndTime'] . ':00 10/10/2019')); ?>
                                                    </td>
                                                    <td class="text-uppercase">
                                                        <?php echo date('h:i a', strtotime($tripdata['dropStartTime'] . ':00 10/10/2019')); ?> -<br />
                                                        <?php echo date('h:i a', strtotime($tripdata['dropEndTime'] . ':00 10/10/2019')); ?>
                                                    </td>
                                                    <td data-toggle="tooltip" title="Click for Enable/Disable">
                                                        <div class="switch">
                                                            <div class="onoffswitch">
                                                                <?php if ($tripdata['isActive'] == 1) { ?>
                                                                    <input type="checkbox" checked class="onoffswitch-checkbox trip_status" data-tripid="<?php echo $tripdata['id']; ?>" id="trip_<?php echo $tripdata['id']; ?>">
                                                                    <label class="onoffswitch-label" for="trip_<?php echo $tripdata['id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                <?php
                                                                } else { ?>
                                                                    <input type="checkbox" class="onoffswitch-checkbox trip_status" data-tripid="<?php echo $tripdata['id']; ?>" id="trip_<?php echo $tripdata['id']; ?>">
                                                                    <label class="onoffswitch-label" for="trip_<?php echo $tripdata['id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                <?php
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="edit_trip('<?php echo $tripdata['id']; ?>', '<?php echo $tripdata['tripName']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $tripdata['tripName']; ?>" data-original-title="<?php echo $tripdata['tripName']; ?>"> <i class="fa fa-edit"></i>Update</a></td>
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
    var table = $('#tbl_trip').dataTable({

        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "30%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "15%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "15%",
                className: "capitalize",
                "targets": 3
            },
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
        ],

    });

    $(document).on("change", ".trip_status", function() {
        //$(".trip_status").change(function() {
        setTimeout(change_status(this), 100);
    });


    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var tripid = $(id).data('tripid');
        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'transport/changestatus-trip-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "tripid": tripid,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Trip Updated', 'Trip deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Trip Updated', 'Trip activated successfully.', 'success');
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

    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
            });
        }

    }

    //NEW SCRIPT
    function add_new_trip() {
        var ops_url = baseurl + 'transport/create-new-trip/';

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

    function edit_trip(tripId, tripName) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/trip-edit/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "tripId": tripId,
                "tripName": tripName,
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

                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this Trip', 'info');
                    return false;
                }
            }
        });
    }

    function load_trip_form() {
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
            }
        });

    }
</script>