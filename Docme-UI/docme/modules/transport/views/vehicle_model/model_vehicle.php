<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color:#1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new vehicle model" data-placement="left"href="javascript:void(0)" onclick="add_new_vehicle_model();"><i class="fa fa-plus"></i>ADD VEHICLE MODEL</a>
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
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new vehicle model" data-placement="left" href="javascript:void(0)" onclick="add_new_vehicle_model();"><i class="fa fa-plus"></i> ADD VEHICLE MODEL</a>
                        </div>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table id="vehicle_model_tbl" style="width:100%">
                                    <?php
                                    $breaker = 0;

                                    if (isset($vehicle_model_data) && !empty($vehicle_model_data)) {
                                        foreach ($vehicle_model_data as $vehicle_model) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element">
                                                                    <div class="media-body ">
                                                                        <p style="margin-bottom:12px;">
                                                                            <strong>Vehicle Model :</strong>
                                                                            <span><?php echo $vehicle_model['model_name']; ?></span>
                                                                            <a class="btn btn-xs btn-info pull-right" href="javascript:void(0);" onclick="edit_vehicle_model('<?php echo $vehicle_model['id']; ?>', '<?php echo $vehicle_model['model_name']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $vehicle_model['model_name']; ?>" data-original-title="<?php echo $vehicle_model['model_name']; ?>"> <i class="fa fa-edit"></i> Update</a>
                                                                        </p>
                                                                        <small class="text-muted">Created On : &nbsp;&nbsp;&nbsp;<span><?php echo date('d-m-Y', strtotime($vehicle_model['createdOn'])) ?></span></small>

                                                                        <div class="switch  pull-right">
                                                                            <div class="onoffswitch">
                                                                                <?php if ($vehicle_model['isActive'] == 1) { ?>
                                                                                    <input type="checkbox" checked class="onoffswitch-checkbox veh_model_status" data-modelid="<?php echo $vehicle_model['id']; ?>" id="fee_model_<?php echo $vehicle_model['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="fee_model_<?php echo $vehicle_model['id']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                <?php } else { ?>
                                                                                    <input type="checkbox" class="onoffswitch-checkbox veh_model_status" data-modelid="<?php echo $vehicle_model['id']; ?>" id="fee_model_<?php echo $vehicle_model['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="fee_model_<?php echo $vehicle_model['id']; ?>">
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
    var table = $('#vehicle_model_tbl').dataTable({
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

    $(document).on("change", ".veh_model_status", function() {
        //$(".veh_model_status").change(function() {
        setTimeout(change_status(this), 100);
    });




    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var vehmodel_id = $(id).data('modelid');
        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;

        var ops_url = baseurl + 'transport/statuschange-vehiclemodel/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehmodel_id": vehmodel_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Vehicle Model Updated', 'Vehicle Model deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Vehicle Model Updated', 'Vehicle Model activated successfully.', 'success');
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
                            load_feetype_on_show();
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
                                text: 'Vehicle Model status updation failed.',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_feetype_on_show();
                            });
                        }

                    }
                }
            }
        });
    }

    function load_vehiclemodel_on_show() {
        var ops_url = baseurl + 'transport/create-vehiclemodel/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#veh_model_content').html(result);
            }
        });

    }



    //NEW SCRIPT
    function add_new_vehicle_model() {
        var ops_url = baseurl + 'transport/add-new-model';
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

        var ops_url = baseurl + 'transport/addsave-vehiclemodel/';
        var vehicle_model = $('#vehiclemodel').val();

        if (vehicle_model == '') {
            swal('', 'Vehicle Model is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((vehicle_model.length > '25') || (vehicle_model.length < '3')) {
            swal('', 'Vehicle Model should contain letters or numbers 3 to 25 .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#vehiclemodel").val())) {
            swal('', 'Vehicle Model can have only alphabets or numbers .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#vehiclemodel_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_vehiclemodel_on_show();
                    swal('Success', 'New Vehicle Model, ' + vehicle_model + ' created successfully.', 'success');
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

    function edit_vehicle_model(vehicle_model_id, vehiclemodelName) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-vehiclemodel/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicle_model_id": vehicle_model_id,
                "vehicle_model_name": vehiclemodelName,
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
                    swal('', 'No data available associated with this Vehicle Model', 'info');
                    return false;
                }
            }
        });
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'transport/editsave-vehiclemodel';
        var vehicle_model = $('#vehicle_model').val();
        if (vehicle_model == '') {
            swal('', 'Vehicle Model is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((vehicle_model.length > '25') || (vehicle_model.length < '3')) {
            swal('', 'Vehicle Model should contain letters or numbers 3 to 25 .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#vehicle_model").val())) {
            swal('', 'Vehicle Model can have only alphabets or numbers .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#vehicle_model_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Vehicle Model, ' + vehicle_model + ' updated successfully.', 'success');
                    //                      swal('Success', 'New Vehicle Model,  updated successfully.', 'success');
                    load_vehiclemodel_on_show();
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
</script>