<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">      
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Vehicle Type" data-placement="left"href="javascript:void(0)" onclick="add_new_vehicle_type();"><i class="fa fa-plus"></i>ADD VEHICLE TYPE</a>
                    </div>
                </div>-->
                <input type="hidden" value="1" name="scroll_page" id="scroll_page" />
                <input type="hidden" value="" name="search_key" id="search_key" />
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="curd-content" style="display: none;"></div>
                    <div class="row m-b-sm">
                        <div class="col-lg-12 text-right m-r-sm" id="add_type">
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Vehicle Type" data-placement="left" href="javascript:void(0)" onclick="add_new_vehicle_type();"><i class="fa fa-plus"></i> ADD VEHICLE TYPE</a>
                        </div>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">

                            </div>
                            <div class="col-lg-12">
                                <table id="vehicle_type_tbl" style="width:100%">
                                    <tbody>
                                        <?php
                                        $breaker = 0;
                                        if (isset($vehicle_type_data) && !empty($vehicle_type_data)) {
                                            foreach ($vehicle_type_data as $vehicle_type) {
                                        ?>

                                                <tr>
                                                    <td>
                                                        <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                            <div>
                                                                <div class="chat-activity-list">
                                                                    <div class="chat-element">
                                                                        <div class="media-body ">
                                                                            <p style="margin-bottom:12px;">
                                                                                <strong>Vehicle Type :</strong>
                                                                                <span><?php echo $vehicle_type['vehicleTypeName']; ?></span>
                                                                                <a class="btn btn-xs btn-info pull-right" href="javascript:void(0);" onclick="edit_vehicle_type('<?php echo $vehicle_type['id']; ?>', '<?php echo $vehicle_type['vehicleTypeName']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $vehicle_type['vehicleTypeName']; ?>" data-original-title="<?php echo $vehicle_type['vehicleTypeName']; ?>"> <i class="fa fa-edit"></i>Update</a>
                                                                            </p>
                                                                            <div class="switch  pull-right">
                                                                                <div class="onoffswitch">
                                                                                    <?php if ($vehicle_type['isActive'] == 1) { ?>
                                                                                        <input type="checkbox" checked class="onoffswitch-checkbox acnt_code" data-vhktype="<?php echo $vehicle_type['id']; ?>" id="account_code_<?php echo $vehicle_type['id']; ?>">
                                                                                        <label class="onoffswitch-label" for="account_code_<?php echo $vehicle_type['id']; ?>">
                                                                                            <span class="onoffswitch-inner"></span>
                                                                                            <span class="onoffswitch-switch"></span>
                                                                                        </label>
                                                                                    <?php } else { ?>
                                                                                        <input type="checkbox" class="onoffswitch-checkbox acnt_code" data-vhktype="<?php echo $vehicle_type['id']; ?>" id="account_code_<?php echo $vehicle_type['id']; ?>">
                                                                                        <label class="onoffswitch-label" for="account_code_<?php echo $vehicle_type['id']; ?>">
                                                                                            <span class="onoffswitch-inner"></span>
                                                                                            <span class="onoffswitch-switch"></span>
                                                                                        </label>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <p>
                                                                                <strong>Description : </strong>
                                                                                <span><?php echo $vehicle_type['vehicleDescriptionName']; ?></span>
                                                                            </p>
                                                                            <small class="text-muted">Created On :&nbsp;&nbsp;&nbsp;<span><?php echo date('d-m-Y', strtotime($vehicle_type['createdOn'])) ?></span></small>

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
    $('#vehicle_type_tbl').dataTable({

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
    $(document).on("change", ".acnt_code", function() {
        //$(".acnt_code").change(function() {
        setTimeout(change_status(this), 100);
    });



    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var type_id = $(id).data('vhktype');

        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'transport/statuschange-vehicletype/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "type_id": type_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Vehicle Type Updated', 'Vehicle Type deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Vehicle Type Updated', 'Vehicle Type activated successfully.', 'success');
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
                                text: 'Vehicle Type status updation failed.',
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

    function load_vehicletype_on_show() {
        var ops_url = baseurl + 'transport/create-vehicletype/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#veh_type_content').html(result);
            }
        });

    }


    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'transport/addsave-vehicletype/';
        var vehicle_type = $('#vehicletype').val();
        var description = $('#description').val();
        if (vehicle_type == '') {
            swal('', 'Vehicle Type is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((vehicle_type.length > '30') || (vehicle_type.length < '3')) {
            swal('', 'Vehicle Type should contain letters or numbers 3 to 30.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        // var alphanumers = /^[a-zA-Z\s]+$/;
        // if (!alphanumers.test($("#vehicletype").val())) {
        //     swal('', 'Vehicle Type can have only alphabets.', 'info');
        //     $('#faculty_loader').removeClass('sk-loading');
        //     return false;
        // }

        if (description == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length > '50') || (description.length < '3')) {
            swal('', 'Description should contain letters or numbers 3 to 50 .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#description").val())) {
            swal('', 'Description can have only alphabets or numbers .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#vehicletype_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_vehicletype_on_show();

                    swal('Success', 'Vehicle Type, ' + vehicle_type + ' created successfully.', 'success');
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

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var vehicle_type = $('#vehicle_type').val();
        var description = $('#description').val();
        if (vehicle_type == '') {
            swal('', 'Vehicle Type is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((vehicle_type.length > '30') || (vehicle_type.length < '3')) {
            swal('', 'Vehicle Type should contain letters or numbers 3 to 30.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        // var alphanumers = /^[a-zA-Z\s]+$/;
        // if (!alphanumers.test($("#vehicle_type").val())) {
        //     swal('', 'Vehicle Type can have only alphabets.', 'info');
        //     $('#faculty_loader').removeClass('sk-loading');
        //     return false;
        // }


        if (description == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length > '50') || (description.length < '3')) {
            swal('', 'Description should contain letters or numbers 3 to 50 .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#description").val())) {
            swal('', 'Description can have only alphabets or numbers .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'transport/editsave-vehicletype';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#vehicle_type_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Vehicle Type, ' + vehicle_type + ' updated successfully.', 'success');
                    load_vehicletype_on_show();
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


    function edit_vehicle_type(vehicle_type_id, vehicleTypeName) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-vehicletype/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicle_type_id": vehicle_type_id,
                "vehicleTypeName": vehicleTypeName,
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
    function add_new_vehicle_type() {
        var ops_url = baseurl + 'transport/add-vehicletype';
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