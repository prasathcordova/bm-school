<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!-- Change by Salahudheen May 29, 2019 Title Changed in below <a> tag -->
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add New Account Code" data-placement="left" href="javascript:void(0)" onclick="add_new_account_code();"><i class="fa fa-plus"></i>ADD ACCOUNT CODE</a>
                    </div>
                </div>
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">

                            </div>
                            <div class="col-lg-12">
                                <table id="account_code_tbl" style="width:100%">
                                    <?php
                                    if (isset($account_code_data) && !empty($account_code_data)) {
                                        foreach ($account_code_data as $account_code) {

                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element">
                                                                    <div class="media-body ">
                                                                        <strong>Account Code :</strong>
                                                                        <?php echo $account_code['accountCode']; ?>
                                                                        <p class="m-b-xs">
                                                                            <strong>Description : </strong>
                                                                            <span style="text-transform: uppercase;"><?php echo $account_code['accountDescription']; ?></span>
                                                                        </p>
                                                                        <small class="text-muted" style="font-size: 13px;">Created On : <?php echo date('d-M-Y', strtotime($account_code['createdOn'])) ?></small>
                                                                        <?php if ($account_code['editable'] == 1) { ?>
                                                                            <a href="javascript:void(0);" onclick="edit_account_code('<?php echo $account_code['id']; ?>', '<?php echo $account_code['accountCode']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $account_code['accountCode']; ?>" data-original-title="<?php echo $account_code['accountCode']; ?>">
                                                                                <span class="pull-right label label-primary" style="font-size: 12px;margin-left: 10px;margin-top: 1px;"><i class="fa fa-edit"></i> Edit
                                                                                </span>
                                                                            </a>
                                                                            <div class="switch  pull-right">
                                                                                <div class="onoffswitch">
                                                                                    <?php if ($account_code['isActive'] == 1) {
                                                                                        $chkd = 'checked';
                                                                                    } else {
                                                                                        $chkd = '';
                                                                                    } ?>
                                                                                    <input type="checkbox" <?php echo $chkd; ?> class="onoffswitch-checkbox acnt_code" data-actcode="<?php echo $account_code['id']; ?>" id="account_code_<?php echo $account_code['id']; ?>">
                                                                                    <label class="onoffswitch-label" for="account_code_<?php echo $account_code['id']; ?>" title="Change Status of  <?php echo $account_code['accountCode']; ?>">
                                                                                        <span class="onoffswitch-inner"></span>
                                                                                        <span class="onoffswitch-switch"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
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
    $('#account_code_tbl').dataTable({

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

    $(document).on("change", ".acnt_code", function() {
        setTimeout(change_status(this), 100);
    });



    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var account_id = $(id).data('actcode');

        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'fees/statuschange-accountcode/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "account_id": account_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Account Code updated', 'Account Code Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Account Code updated', 'Account Code Status Activated Successfully', 'success');
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
                            load_accountcode_on_show();
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
                                load_accountcode_on_show();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Account Code Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_accountcode_on_show();
                            });
                        }

                    }
                }
            }
        });
    }

    function load_accountcode_on_show() {
        var ops_url = baseurl + 'fees/create-accountcode/';
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

        var ops_url = baseurl + 'fees/addsave-accountcode/';
        var account_code1 = $('#account_code1').val();
        var description = $('#description').val();

        if (account_code1 == '') {
            swal('', 'Account Code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((account_code1.length > '10') || (account_code1.length < '3')) {
            swal('', 'Account Code should contain letters or numbers 3 to 10', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#account_code1").val())) {
            swal('', 'Account Code can have only alphabets or numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if (description == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length > '20') || (description.length < '3')) {
            swal('', 'Description should contain letters or numbers 3 to 20.', 'info');
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
            data: $('#accountcode_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_accountcode_on_show();
                    swal('Success', 'New Account Code, ' + account_code1 + ' created successfully.', 'success');
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
        var account_code1 = $('#account_codes').val();
        var ops_url = baseurl + 'fees/save-edit-accountcode/';


        var description = $('#description').val();

        if (account_code1 == '') {
            swal('', 'Account Code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((account_code1.length > '10') || (account_code1.length < '3')) {
            swal('', 'Account Code should contain letters or numbers 3 to 10', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#account_codes").val())) {
            swal('', 'Account Code can have only alphabets or numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if (description == '') {
            swal('', 'Account Code description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length > '20') || (description.length < '3')) {
            swal('', 'Account Code description should contain letters or numbers 3 to 20', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#description").val())) {
            swal('', 'Account Code description can have only alphabets or numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#account_code_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Account Code, ' + account_code1 + ' updated successfully.', 'success');
                    load_accountcode_on_show();
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


    function edit_account_code(account_code_id, code_name) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'fees/edit-accountcode/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "account_code_id": account_code_id,
                "code_name": code_name,
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
                    swal('', 'No data available associated with this Account Code', 'info');
                    return false;
                }
            }
        });
    }



    //NEW SCRIPT
    function add_new_account_code() {
        var ops_url = baseurl + 'fees/add-accountcode';
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