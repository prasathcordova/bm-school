<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!-- Change by Salahudheen May 29, 2019 Title Changed in below <a> tag -->
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add New Fee Type" data-placement="left" href="javascript:void(0)" onclick="add_new_fee_type();"><i class="fa fa-plus"></i>ADD FEE TYPE</a>
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
                                <table id="fee_type_tbl" style="width:100%">
                                    <?php
                                    $breaker = 0;
                                    if (isset($fee_type_data) && !empty($fee_type_data)) {
                                        foreach ($fee_type_data as $fee_type) {
                                            if ($fee_type['editable'] == 1) {
                                    ?>
                                                <tr>
                                                    <td>
                                                        <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                            <div>
                                                                <div class="chat-activity-list">
                                                                    <div class="chat-element">
                                                                        <div class="media-body ">
                                                                            <p style="text-transform: uppercase;">
                                                                                <strong>Fee Type :</strong>
                                                                                <?php echo $fee_type['feeTypeName']; ?>
                                                                            </p>
                                                                            <small class="text-muted" style="font-size: 13px;">Created On : <?php echo date('d-M-Y', strtotime($fee_type['createdOn'])) ?></small>
                                                                            <a href="javascript:void(0);" onclick="edit_fee_type('<?php echo $fee_type['id']; ?>', '<?php echo $fee_type['feeTypeName']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $fee_type['feeTypeName']; ?>" data-original-title="<?php echo $fee_type['feeTypeName']; ?>">
                                                                                <span class="pull-right label label-primary" style="font-size: 12px;margin-left: 10px;margin-top: 1px;"><i class="fa fa-edit"></i> Edit
                                                                                </span>
                                                                            </a>
                                                                            <div class="switch  pull-right">
                                                                                <div class="onoffswitch">
                                                                                    <?php if ($fee_type['isActive'] == 1) {
                                                                                        $chkd = 'checked';
                                                                                    } else {
                                                                                        $chkd = '';
                                                                                    } ?>
                                                                                    <input type="checkbox" <?php echo $chkd; ?> class="onoffswitch-checkbox fee_type_status" data-feetypeid="<?php echo $fee_type['id']; ?>" id="fee_type_<?php echo $fee_type['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="fee_type_<?php echo $fee_type['id']; ?>" title="Change Status of <?php echo $fee_type['feeTypeName']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
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
    $(window).keydown(function(event) {
        if ((event.keyCode == 13)) {
            event.preventDefault();
            return false;
        }
    });
    var table = $('#fee_type_tbl').dataTable({
        columnDefs: [{
            "width": "100%",
            "targets": 0
        }, ],
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });


    //$(".fee_type_status").change(function() {
    $(document).on("change", ".fee_type_status", function() {
        setTimeout(change_status(this), 100);
    });




    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var fee_type_id = $(id).data('feetypeid');

        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'fees/statuschange-feetype/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "fee_type_id": fee_type_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Fee Type updated', 'Fee Type Status deactivated Successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Fee Type updated', 'Fee Type Status activated Successfully.', 'success');
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
                                text: 'Fee Type Status Updation Failed',
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

    function load_feetype_on_show() {
        var ops_url = baseurl + 'fees/show-feetype/';
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

        var ops_url = baseurl + 'fees/save-new-feetype/';
        var fee_type_name_new = $('#fee_type_name').val();

        if (fee_type_name_new == '') {
            swal('', 'Fee Type is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((fee_type_name_new.length > '20') || (fee_type_name_new.length < '2')) {
            swal('', 'Fee Type should contain letters or numbers 2 to 20', 'info'); // Changed by SALAHUDHEEN as 2 to 20
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#fee_type_name").val())) {
            swal('', 'Fee Type can have only alphabets or numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#feetype_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_feetype_on_show();
                    swal('Success', 'New Fee Type, ' + fee_type_name_new + ' created successfully.', 'success');
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
        var fee_type_name_new = $('#feeTypeName').val();
        var ops_url = baseurl + 'fees/save-edit-feetype/';

        var fee_type_name_new = $('#feeTypeName').val();

        if (fee_type_name_new == '') {
            swal('', 'Fee Type is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((fee_type_name_new.length > '20') || (fee_type_name_new.length < '2')) {
            swal('', 'Fee Type should contain letters or numbers 2 to 20', 'info'); // Changed by SALAHUDHEEN as 2 to 20
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#feeTypeName").val())) {
            swal('', 'Fee Type can have only alphabets or numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#fee_type_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_feetype_on_show();
                    swal('Success', 'Fee Type, ' + fee_type_name_new + ' updated successfully.', 'success');
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


    function edit_fee_type(fee_type_id, type_name) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'fees/edit-feetype/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "fee_type_id": fee_type_id,
                "type_name": type_name,
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
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this Fee Type', 'info');
                    return false;
                }
            }
        });
    }



    //NEW SCRIPT
    function add_new_fee_type() {
        var ops_url = baseurl + 'fees/add-feetype';
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
                    swal('', 'No data available associated with this Fee Type', 'info');
                    return false;
                }
            }
        });
    }
</script>