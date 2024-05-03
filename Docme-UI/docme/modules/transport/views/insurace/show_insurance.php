<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color:#1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Insurance" data-placement="left"href="javascript:void(0)" onclick="add_new_insurance();"><i class="fa fa-plus"></i>ADD NEW INSURANCE</a>
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
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Insurance" data-placement="left" href="javascript:void(0)" onclick="add_new_insurance();"><i class="fa fa-plus"></i> ADD NEW INSURANCE</a>
                        </div>
                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table id="insurance_tbl" style="width:100%">
                                    <?php
                                    $breaker = 0;
                                    if (isset($vehicle_insurance_data) && !empty($vehicle_insurance_data)) {
                                        foreach ($vehicle_insurance_data as $insurance) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element">
                                                                    <div class="media-body ">
                                                                        <p style="margin-bottom:12px;">
                                                                            <strong>Insurance Company Name :</strong>
                                                                            <span><?php echo $insurance['insuranceName']; ?></span>
                                                                            <a class="btn btn-xs btn-info pull-right" href="javascript:void(0);" onclick="edit_insurance('<?php echo $insurance['id']; ?>', '<?php echo $insurance['insuranceName']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $insurance['insuranceName']; ?>" data-original-title="<?php echo $insurance['insuranceName']; ?>"> <i class="fa fa-edit"></i>Update</a>
                                                                        </p>
                                                                        <div class="switch  pull-right">
                                                                            <div class="onoffswitch">
                                                                                <?php if ($insurance['isActive'] == 1) { ?>
                                                                                    <input type="checkbox" checked class="onoffswitch-checkbox ins_status" data-insid="<?php echo $insurance['id']; ?>" id="ins_<?php echo $insurance['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="ins_<?php echo $insurance['id']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                <?php } else { ?>
                                                                                    <input type="checkbox" class="onoffswitch-checkbox ins_status" data-insid="<?php echo $insurance['id']; ?>" id="ins_<?php echo $insurance['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="ins_<?php echo $insurance['id']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                        <p>
                                                                            <strong>Description :</strong>
                                                                            <span><?php echo $insurance['insuranceDescription']; ?></span>
                                                                        </p>
                                                                        <small class="text-muted">Created On : &nbsp;&nbsp;&nbsp;<span><?php echo  date('d-m-Y', strtotime($insurance['createdOn'])) ?></span></small>



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
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
        iDisplayLength: 10,
        "ordering": false,
    });


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    $(document).on("change", ".ins_status", function() {
        //$(".ins_status").change(function() {
        setTimeout(change_status(this), 100);
    });

    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var vehins_id = $(id).data('insid');

        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;

        var ops_url = baseurl + 'transport/statuschange-insurance/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "insurance_id": vehins_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Insurance Updated', 'Insurance Company deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Insurance Updated', 'Insurance Company activated successfully.', 'success');
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
                                text: 'Insurance status updation failed.',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_insurance_on_show();
                            });
                        }

                    }
                }
            }
        });
    }




    function load_insurance_on_show() {
        var ops_url = baseurl + 'transport/create-vehicleinsurance/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                //                $('#data-view').html(result);
                $('#veh_ins_content').html(result);
            }
        });

    }



    //NEW SCRIPT
    function add_new_insurance() {
        var ops_url = baseurl + 'transport/add-new-insurance';
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
        var ops_url = baseurl + 'transport/addsaves-insurance/';
        var insurance_cmpny = $('#insurance_cmpny').val();
        var description = $('#description').val();
        if (insurance_cmpny == '') {
            swal('', 'Insurance Company Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((insurance_cmpny.length > '50') || (insurance_cmpny.length < '3')) {
            swal('', 'Insurance Company Name should contain letters or numbers 3 to 50.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#insurance_cmpny").val())) {
            swal('', 'Insurance Company Name can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if (description == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length > '100') || (description.length < '3')) {
            swal('', 'Description should contain letters or numbers 3 to 100.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#description").val())) {
            swal('', 'Description can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#insurance_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_insurance_on_show();
                    swal('Success', 'New Insurance Company, ' + insurance_cmpny + ' created successfully.', 'success');
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

    function edit_insurance(insurance_id, insuranceName) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-insurance/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "insurance_id": insurance_id,
                "insuranceName": insuranceName,
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
        var insurance_cmpny = $('#insurance').val();
        var description = $('#description').val();
        if (insurance_cmpny == '') {
            swal('', 'Insurance Company Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((insurance_cmpny.length > '50') || (insurance_cmpny.length < '3')) {
            swal('', 'Insurance Company Name should contain letters or numbers 3 to 50.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#insurance_cmpny").val())) {
            swal('', 'Insurance Company Name can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if (description == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length > '100') || (description.length < '3')) {
            swal('', 'Description should contain letters or numbers 3 to 100.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#description").val())) {
            swal('', 'Description can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'transport/editsave-insurance';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#insurance_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Insurance Company, ' + insurance_cmpny + ' Updated Successfully.', 'success');
                    load_insurance_on_show();
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
</script>