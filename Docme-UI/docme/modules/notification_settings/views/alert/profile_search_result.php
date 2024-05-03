<hr />
<div class="col-lg-12">
    <div class="row">
        <!--  <h3><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h3> -->
        <div class="ibox-tools" id="add_type">
            <a href="javascript:void(0)" class="btn btn-primary btn-xs modal_schdate" data-toggle="modal"> <i class="fa fa-paper-plane"></i>Send To All</a>
            <!--      <a href="javascript:void(0)" onclick="sms_send_to_all();" class="btn btn-primary btn-xs modal_schdate" data-toggle="modal"> <i class="fa fa-paper-plane"></i>SMS Send To All</a> -->
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div id="curd-content" style="display: none;"></div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_arrearlistshow">

                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Student Name</th>
                            <th>Admission No.</th>
                            <th>Message</th>
                            <th>Class</th>
                            <th>Pending Amount</th>
                            <th>Sent Month</th>
                            <th><input type="checkbox" class="checkall" /> Check All</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($details_data) && !empty($details_data) && isset($details_data[0])) {
                            $i = 1;
                            foreach ($details_data as $documents) {
                        ?>
                                <tr>
                                    <td> <?php echo $i; ?></td>
                                    <td> <?php echo $documents['student_name']; ?></td>
                                    <td> <?php echo $documents['Admn_No']; ?></td>
                                    <td>
                                        <?php if ($documents['message_details']) { ?>
                                            <?php echo $documents['message_details']; ?>
                                        <?php } else {
                                            echo "-";
                                        } ?>
                                    </td>
                                    <td> <?php echo $documents['class_name']; ?></td>
                                    <td> <?php echo my_money_format($documents['PENDING_PAYMENT']); ?></td>
                                    <td>
                                        <?php if ($documents['month_year']) { ?>
                                            <?php echo $documents['month_year']; ?>
                                        <?php } else {
                                            echo "-";
                                        } ?>
                                    </td>

                                    <td>
                                        <?php if ($documents['message_status'] == 1) {
                                            $msf = ($documents['message_for'] == 1) ? "SMS" : "EMAIL";

                                        ?>
                                            <dd class="mb-1"><span class="label label-primary">
                                                    <?php echo $msf . " sent on " . date('d-M-Y', strtotime($documents['created_on']));   ?></span></dd>
                                        <?php } else if ($documents['message_status'] == 2) { ?>

                                            Sending Failed </br>
                                            <a href="javascript:void(0)" onclick="sms_data_resend('<?php echo $documents['notification_id']; ?>');" class="btn btn-sm btn-warning"> <i class="fa fa-reply" data-toggle="tooltip" title="Resend"></i>Resend</a>

                                        <?php } else { ?>
                                            <input type="checkbox" name="checked_item[]" class="dt_checkbox" value="<?php echo $documents['STUDENT_ID']; ?>" />
                                        <?php } ?>
                                    </td>


                                </tr>
                            <?php
                                $i++;
                            }
                        } else { ?>
                            <tr>
                                <td colspan="8" class="text-center">No Data Found</td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div id="myModalinterview1" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Send Notification</h4>
                            <small class="font-bold"></small>
                        </div>

                        <div class="modal-body">

                            <form id="schedule_form" name="schedule_form" method="post" action="">
                                <div class="form-group row">
                                    <label>Notification For *</label>
                                    <input class="form-check-input radio-danger" type="radio" id="inlineRadio1" value="1" name="radioInline">
                                    <label class="form-check-label" for="inlineRadio1"> SMS </label>
                                    <input class="form-check-input radio-danger" type="radio" id="inlineRadio2" value="2" name="radioInline">
                                    <label class="form-check-label" for="inlineRadio2"> Email </label>
                                    <div>
                                        <span class="text-danger" id="error-not" style="display:none;">Please Select Notification For</span>
                                    </div>
                                </div>
                                <div class="form-group row" id="errorclass">
                                    <label>Select Notification Template *</label>
                                    <select class="select2_registration form-control" id="select_temp_notif" name="select_temp_notif" disabled style="width: 100%">
                                        <option selected value="-1">Select Template</option>
                                        <?php
                                        if (isset($notification_data) && !empty($notification_data)) {
                                            foreach ($notification_data['data'] as $documents) {
                                                echo '<option value="' . $documents['notification_id'] . '" >' . $documents['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger" id="error-msg" style="display:none;">Please Select Template</span>
                                </div>


                                <div id="selected_datas"></div>


                            </form>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <a href="#" onclick="sms_send_to_all()" class="btn btn-sm btn-primary float-right m-t-n-xs"> <i class="fa fa-paper-plane" data-toggle="tooltip" title="Save"></i>Send To All </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    oTable = $('#tbl_arrearlistshow').DataTable({
        columnDefs: [{
                // "width": "10%",
                className: "capitalize",
                "targets": 0
            },
            {
                // "width": "10%",
                className: "capitalize",
                "targets": 1
            },
            {
                // "width": "5%",
                className: "capitalize",
                "targets": 2
            },
            {
                // "width": "5%",
                className: "capitalize",
                "targets": 3
            },
            {
                // "width": "5%",
                className: "capitalize",
                "targets": 4
            }

        ],
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv'
            },
            {
                extend: 'excel',
                title: 'Report'
            }
        ],
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        }
    });
    $('#select_temp_notif').select2({
        'theme': 'bootstrap'
    });
    $(".modal_schdate").click(function(e) {
        if ($("#tbl_arrearlistshow input:checkbox:checked").length == 0) {
            swal("Please check at least one box");
            return false;
        }
        $('#myModalinterview1').modal('show'); // #myModal (id of modal box)

    });

    var list_switchery = [];
    $(".checkall").click(function() {
        var rows = oTable.rows({
            'search': 'applied'
        }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);

    });

    $('#tbl_arrearlistshow tbody').on('change', 'input[type="checkbox"]', function() {
        // If checkbox is not checked
        if (!this.checked) {
            var el = $('.checkall').get(0);
            // If "Select all" control is checked and has 'indeterminate' property
            if (el && el.checked && ('indeterminate' in el)) {
                // Set visual state of "Select all" control 
                // as 'indeterminate'
                el.indeterminate = true;
            }
        }
    });

    $('#tbl_arrearlistshow tbody').on('click', function(e) {
        activateSwitchery();
    });
    $(document).ready(function() {
        activateSwitchery();
    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#23C6C8',
                secondaryColor: '#F8AC59',
                size: 'small'
            });
            list_switchery.push(switchery);
        });
    }

    function change_status(notification_id, element) {
        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'notification/notification-change-status';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "load": 1,
                "notification_id": notification_id,
                "sms_status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Document Updated', 'Notification Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Document Updated', 'Notification Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                } else {
                    $('#faculty_loader').removeClass('sk-loading');
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
                            // window.location.href = baseurl + "course/show-course";
                            //  $('#curd-content').show();

                        });
                    }
                }
            }
        });
    }

    function refresh_add_panel() {

        $('#notification_name').val('');
        $('#sms_status').val(1);
        $('#email_status').val(0);
        $('#sms_message').val('');
        $('#email_message').val('');

    }

    function sms_data_resend(notification_alert_id) {
        swal({
            title: 'Message Resend',
            text: "Are you sure to resend the message?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Resend',
            closeOnCancel: true,
            closeOnConfirm: false
        }, function(isConfirm) {
            if (!isConfirm) return;
            isConfirm = false;
            $('#faculty_loader').addClass('sk-loading');
            var ops_url = baseurl + 'notification/notification-resend';
            $.ajax({
                type: "POST",
                cache: false,
                async: true,
                url: ops_url,
                data: {
                    "load": 1,
                    "notification_alert_id": notification_alert_id
                },
                success: function(result) {
                    var data = $.parseJSON(result);
                    if (data.status == 1) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            closeOnConfirm: true
                        }, function(isConfirm) {
                            if (!isConfirm) return;
                            function_name = $('#function_name_for_reload').val();
                            window[function_name]();
                            $('#faculty_loader').removeClass('sk-loading');

                        });

                        return false;
                    }

                }
            });

        });


    }

    $('input[type=radio][name=radioInline]').change(function() {
        if (this.value == '1') {
            $('#select_temp_notif').prop("disabled", true);
        } else if (this.value == '2') {
            $('#select_temp_notif').prop("disabled", false);
        }
    });

    function sms_send_to_all() {
        var select_temp_notif = $("#select_temp_notif").val()
        var notification_type = $('input[name="radioInline"]:checked').val();
        if ($("#tbl_arrearlistshow input:checkbox:checked").length > 0) {
            var seleted_field = [];
            $("#selected_datas").html('');

            var rows = oTable.rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]:checked', rows).each(function(i) {
                seleted_field[i] = $(this).val();
                $("#selected_datas").append('<input type="hidden" name="checked_data[]" class="send_sms_check" value="' + $(this).val() + '" checked="checked" >');
            });
        } else {
            swal("Select atleast one student");
            return false;
        }
        if (notification_type == null) {
            $('#errorclass').addClass('has-error');
            $('#error-not').addClass('text-danger');
            $('#error-not').show();
            return false;
        } else {
            $('#errorclass').removeClass('has-error');
            $('#error-not').removeClass('text-danger');
            $('#error-not').hide();
        }
        if (select_temp_notif == -1) {
            $('#errorclass').addClass('has-error');
            $('#error-msg').addClass('text-danger');
            $('#error-msg').show();
            return false;
        } else {
            $('#errorclass').removeClass('has-error');
            $('#error-msg').removeClass('text-danger');
            $('#error-msg').hide();
        }

        var ops_url = baseurl + 'notification/notification-send-all';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "checked_temp_ids": seleted_field,
                "notification_id": select_temp_notif,
                "notification_type": notification_type
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $('#myModalinterview1').modal('hide');
                    //  swal('', 'SMS Sent Successfully', 'success');
                    swal({
                        title: '',
                        text: data.message,
                        type: 'info',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }, function(isConfirm) {
                        function_name = $('#function_name_for_reload').val();
                        window[function_name]();

                    });

                    $('#faculty_loader').removeClass('sk-loading');
                    return true;
                } else if (data.status == 2) {
                    swal({
                        title: '',
                        text: data.message,
                        type: 'info',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }, function(isConfirm) {
                        function_name = $('#function_name_for_reload').val();
                        window[function_name]();

                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                } else {

                    swal({
                        title: '',
                        text: data.message,
                        type: 'danger',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }, function(isConfirm) {
                        function_name = $('#function_name_for_reload').val();
                        window[function_name]();

                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                }
            }
        });
    }

    function close_add_document() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }
</script>