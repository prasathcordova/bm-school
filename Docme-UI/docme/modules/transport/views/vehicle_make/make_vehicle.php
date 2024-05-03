<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new vehicle make" data-placement="left"href="javascript:void(0)" onclick="add_new_vehicle_make();"><i class="fa fa-plus"></i>ADD VEHICLE MAKE</a>
                    </div>
                </div>-->
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row m-b-sm">
                        <div class="col-lg-12 text-right m-r-sm" id="add_type">
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new vehicle make" data-placement="left" href="javascript:void(0)" onclick="add_new_vehicle_make();"><i class="fa fa-plus"></i> ADD VEHICLE MAKE</a>
                        </div>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table id="vehicle_make_tbl" style="width:100%">
                                    <?php
                                    $breaker = 0;
                                    if (isset($vehicle_make_data) && !empty($vehicle_make_data)) {
                                        foreach ($vehicle_make_data as $vehicle_make) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element">
                                                                    <div class="media-body">
                                                                        <p style="margin-bottom:12px;">
                                                                            <strong>Vehicle Make :</strong>
                                                                            <span><?php echo $vehicle_make['makeName']; ?></span>
                                                                            <a class="btn btn-xs btn-info pull-right" href="javascript:void(0);" onclick="edit_vehicle_make('<?php echo $vehicle_make['id']; ?>', '<?php echo $vehicle_make['makeName']; ?>');" data-toggle="tooltip" title="Edit <?php echo $vehicle_make['makeName']; ?>" data-original-title="<?php echo $vehicle_make['makeName']; ?>"><i class="fa fa-edit"></i> Update</a>
                                                                        </p>
                                                                        <small class="text-muted">Created On : &nbsp;&nbsp;&nbsp;<span><?php echo date('d-m-Y', strtotime($vehicle_make['createdOn'])) ?></span></small>

                                                                        <div class="switch  pull-right">
                                                                            <div class="onoffswitch">
                                                                                <?php if ($vehicle_make['isActive'] == 1) { ?>
                                                                                    <input type="checkbox" checked class="onoffswitch-checkbox vehi_mke_status" data-vehmake="<?php echo $vehicle_make['id']; ?>" id="vehi_mke_<?php echo $vehicle_make['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="vehi_mke_<?php echo $vehicle_make['id']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                <?php } else { ?>
                                                                                    <input type="checkbox" class="onoffswitch-checkbox vehi_mke_status" data-vehmake="<?php echo $vehicle_make['id']; ?>" id="vehi_mke_<?php echo $vehicle_make['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="vehi_mke_<?php echo $vehicle_make['id']; ?>">
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
    var table = $('#vehicle_make_tbl').dataTable({
        columnDefs: [{
            "width": "100%",
            "targets": 0
        }, ],
        responsive: false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
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


    function load_vehiclemake_on_show() {
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
                $('#veh_make_content').html(result);
            }
        });

    }

    //NEW SCRIPT
    function add_new_vehicle_make() {
        var ops_url = baseurl + 'transport/add-new-make';
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

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'transport/add-save-new-make/';
        var vehicle_make = $('#vehiclemake').val();
        if (vehicle_make == '') {
            swal('', 'Vehicle Make is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((vehicle_make.length > '50') || (vehicle_make.length < '3')) {
            swal('', 'Vehicle Make should contain letters or numbers 3 to 50 .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#vehiclemake").val())) {
            swal('', 'Vehicle Make  can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#vehiclemake_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {

                    swal('Success', 'New Vehicle Make, ' + vehicle_make.toUpperCase() + ' created successfully', 'success');
                    load_vehiclemake_on_show();
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    //$('#curd-content').html('');
                    //$('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    // $('#curd-content').html('');
                    // $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }

    function edit_vehicle_make(vehicle_make_id, vehiclemakeName) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-vehiclemake/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicle_make_id": vehicle_make_id,
                "vehiclemakeName": vehiclemakeName,
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
                    swal('', 'No data available associated with this Vehicle Make', 'info');
                    return false;
                }
            }
        });
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var vehicle_make = $('#vehicle_make').val();
        if (vehicle_make == '') {
            swal('', 'Vehicle Make is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((vehicle_make.length > '50') || (vehicle_make.length < '3')) {
            swal('', 'Vehicle Make should contain letters or numbers 3 to 50 .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#vehicle_make").val())) {
            swal('', 'Vehicle Make can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'transport/editsave-vehiclemake';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#vehicle_make_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Vehicle Make, ' + vehicle_make.toUpperCase() + ' updated successfully.', 'success');
                    load_vehiclemake_on_show();
                } else if (data.status == 2) {
                    //$('#curd-content').html('');
                    //$('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    //$('#curd-content').html('');
                    //$('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 4) {
                    //$('#curd-content').html('');
                    //$('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }
            }
        });
    }
    $(document).on("change", ".vehi_mke_status", function() {
        //$(".vehi_mke_status").change(function() {
        setTimeout(change_status(this), 100);
    });



    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var make_id = $(id).data('vehmake');
        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'transport/statuschange-vehiclemake/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "make_id": make_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Vehicle Make Updated', 'Vehicle Make deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Vehicle Make Updated', 'Vehicle Make activated successfully.', 'success');
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
                            load_vehicletype_on_show();
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
                                load_vehicletype_on_show();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Vehicle Make status updation failed.',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_vehicletype_on_show();
                            });
                        }

                    }
                }
            }
        });
    }
</script>