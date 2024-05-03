<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Fee Type" data-placement="left" href="javascript:void(0)" onclick="add_new_trip();"><i class="fa fa-plus"></i>ADD NEW TRIP</a>
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
                                <table id="insurance_tbl" style="width:100%">
                                    <?php
                                    $breaker = 0;
                                    if (isset($vehicle_trip_data) && !empty($vehicle_trip_data)) {
                                        foreach ($vehicle_trip_data as $trip) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element">
                                                                    <div class="media-body ">
                                                                        <p>
                                                                            <a href="javascript:void(0);" onclick="edit_trip('<?php echo $trip['id']; ?>', '<?php echo $trip['tripName']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $trip['tripName']; ?>" data-original-title="<?php echo $trip['tripName']; ?>"> <small class="pull-right text-navy">Edit</small></a>
                                                                            <strong>Trip Name :</strong>
                                                                            <?php echo $trip['tripName']; ?>
                                                                        </p>
                                                                        <p>

                                                                            <strong>Description :</strong>
                                                                            <?php echo $trip['tripDescription']; ?>
                                                                        </p>
                                                                        <small class="text-muted">created On : &nbsp;&nbsp;&nbsp;<?php echo  date('d-m-Y', strtotime($trip['createdOn'])) ?></small>

                                                                        <div class="switch  pull-right">
                                                                            <div class="onoffswitch">
                                                                                <?php if ($trip['isActive'] == 1) { ?>
                                                                                    <input type="checkbox" checked class="onoffswitch-checkbox trip_status" data-tripid="<?php echo $trip['id']; ?>" id="trip_<?php echo $trip['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="trip_<?php echo $trip['id']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                <?php } else { ?>
                                                                                    <input type="checkbox" class="onoffswitch-checkbox trip_status" data-tripid="<?php echo $trip['id']; ?>" id="trip_<?php echo $trip['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="trip_<?php echo $trip['id']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                    <?php
                                        }
                                    }
                                    ?>
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
    var table = $('#insurance_tbl').dataTable({
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

        var ops_url = baseurl + 'transport/statuschange-trip/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "trip_id": tripid,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Trip updated', 'Trip deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Trip updated', 'Trip activated successfully.', 'success');
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
                            load_insurance_on_show();
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
                                load_insurance_on_show();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Trip status updation failed.',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_trip_on_show();
                            });
                        }

                    }
                }
            }
        });
    }

    function load_trip_on_show() {
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
            }
        });

    }

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'transport/addsave-trip/';
        var trip = $('#trip').val();
        var description = $('#description').val();
        if (trip == '') {
            swal('', 'Trip is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((trip.length > '10') || (trip.length < '2')) {
            swal('', 'Trip should contain letters or numbers 2 to 10.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#trip").val())) {
            swal('', 'Trip can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if (description == '') {
            swal('', 'Trip Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length > '10') || (description.length < '2')) {
            swal('', 'Trip description should contain letters or numbers 2 to 10.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#description").val())) {
            swal('', 'Trip description can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#trip_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_trip_on_show();

                    swal('Success', 'Trip, ' + trip + ' created successfully.', 'success');
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



    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var trip = $('#trip').val();
        var ops_url = baseurl + 'transport/editsave-trip';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#trip_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Trip, ' + trip + ' modified successfully.', 'success');
                    load_trip_on_show();
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
                } else if (data.status == 4) {
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

    function edit_trip(id, tripName) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-trip/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "trip_id": id,
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
                    swal('', 'No data available associated with this Vehicle Type', 'info');
                    return false;
                }
            }
        });
    }




    //NEW SCRIPT
    function add_new_trip() {
        var ops_url = baseurl + 'transport/add-new-trip';
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
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    swal('', 'No data loaded', 'info');
                    return false;
                }
            }
        });
    }
</script>