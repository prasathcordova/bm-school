<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Vehicle Model Year" data-placement="left"href="javascript:void(0)" onclick="add_new_vehicle_modelyr();"><i class="fa fa-plus"></i>ADD VEHICLE MODEL YEAR</a>
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
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Vehicle Model Year" data-placement="left" href="javascript:void(0)" onclick="add_new_vehicle_modelyr();"><i class="fa fa-plus"></i> ADD VEHICLE MODEL YEAR</a>
                        </div>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table id="vehicle_modelyr_tbl" style="width:100%">
                                    <?php
                                    $breaker = 0;
                                    if (isset($vehicle_modelyr_data) && !empty($vehicle_modelyr_data)) {
                                        foreach ($vehicle_modelyr_data as $modelyr) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element">
                                                                    <div class="media-body ">
                                                                        <p style="margin-bottom:12px;">

                                                                            <strong>Vehicle Model Year :</strong>
                                                                            <span><?php echo $modelyr['vModel']; ?></span>
                                                                            <a class="btn btn-xs btn-info pull-right" href="javascript:void(0);" onclick="edit_vehicle_model_yr('<?php echo $modelyr['id']; ?>', '<?php echo $modelyr['vModel']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $modelyr['vModel']; ?>" data-original-title="<?php echo $modelyr['vModel']; ?>"> <i class="fa fa-edit"></i>Update</a>
                                                                        </p>
                                                                        <small class="text-muted">Created On : &nbsp;&nbsp;&nbsp;<span><?php echo date('d-m-Y', strtotime($modelyr['createdOn'])) ?></span></small>

                                                                        <div class="switch  pull-right">
                                                                            <div class="onoffswitch">
                                                                                <?php if ($modelyr['isActive'] == 1) { ?>
                                                                                    <input type="checkbox" checked class="onoffswitch-checkbox veh_modelyr_status" data-modelid="<?php echo $modelyr['id']; ?>" id="fee_model_<?php echo $modelyr['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="fee_model_<?php echo $modelyr['id']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                <?php } else { ?>
                                                                                    <input type="checkbox" class="onoffswitch-checkbox veh_modelyr_status" data-modelId="<?php echo $modelyr['id']; ?>" id="fee_model_<?php echo $modelyr['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="fee_model_<?php echo $modelyr['id']; ?>">
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
    var table = $('#vehicle_modelyr_tbl').dataTable({
        columnDefs: [{
            "wmodelIdth": "100%",
            "targets": 0
        }, ],
        responsive: false,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
        "ordering": false,
    });


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    $(document).on("change", ".veh_modelyr_status", function() {
        //$(".veh_modelyr_status").change(function() {
        setTimeout(change_status(this), 100);
    });




    function change_status(element) {
        var modelId = "#" + $(element).attr('id');
        var vehmodel_modelId = $(modelId).data('modelid');
        var status = -1;
        var status_type = $(modelId).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;

        var ops_url = baseurl + 'transport/statuschange-vehiclemodel_yr/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehmodel_modelId": vehmodel_modelId,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Vehicle Model Updated', 'Vehicle Model Year deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Vehicle Model Updated', 'Vehicle Model Year activated successfully.', 'success');
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

    function load_vehiclemodeldate_on_show() {
        var ops_url = baseurl + 'transport/show-vehicle-modelyear/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#veh_myr_content').html(result);
            }
        });

    }


    //NEW SCRIPT
    function add_new_vehicle_modelyr() {
        var ops_url = baseurl + 'transport/add-new-modelyr';
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

        var ops_url = baseurl + 'transport/addsave-vehiclemodelyr/';
        var vehicle_modelyr = $('#vehiclemodelyr').val();

        if (vehicle_modelyr == '') {
            swal('', 'Vehicle Model year is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((vehicle_modelyr.length > '4') || (vehicle_modelyr.length < '4')) {
            swal('', 'Vehicle Model year should be 4 digits .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[0-9]+$/;
        if (!alphanumers.test(vehicle_modelyr)) {
            swal('', 'Vehicle Model year can have only numbers .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#vehiclemodelyr_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_vehiclemodeldate_on_show();
                    swal('Success', 'Vehicle Model Year, ' + vehicle_modelyr + ' created successfully.', 'success');
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

    function edit_vehicle_model_yr(id, vModel) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-vehiclemodelyear/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "modelyr_id": id,
                "modelyrname": vModel,
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

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var vehicle_modelyr = $('#vehicle_model_yr').val();
        if (vehicle_modelyr == '') {
            swal('', 'Vehicle Model year is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((vehicle_modelyr.length > '4') || (vehicle_modelyr.length < '4')) {
            swal('', 'Vehicle Model year should contain 4 digits.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (isNaN(vehicle_modelyr)) {
            swal('', 'Vehicle Model year can have only numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'transport/editsave-model-year';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#vehicle_model_year_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Model Year, ' + vehicle_modelyr + ' updated successfully.', 'success');
                    load_vehiclemodeldate_on_show();
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