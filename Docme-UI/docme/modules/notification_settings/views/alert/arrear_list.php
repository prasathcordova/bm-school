<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" class="btn btn-primary btn-xs modal_schdate" data-toggle="modal" title="Select Template"> <i class="fa fa-paper-plane"></i>Select Template</a>
                        <!--      <a href="javascript:void(0)" onclick="sms_send_to_all();" class="btn btn-primary btn-xs modal_schdate" data-toggle="modal"> <i class="fa fa-paper-plane"></i>SMS Send To All</a> -->
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
                                            <th>SMS Message</th>
                                            <th>Class</th>
                                            <th>Pending Amount</th>
                                            <th>Sent Month</th>
                                            <th><input type="checkbox" class="checkall" /> Check All</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($arrear_data) && !empty($arrear_data) && isset($arrear_data['data'][0])) {
                                            $i = 1;
                                            foreach ($arrear_data['data'] as $documents) {
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
                                                        <?php if ($documents['message_status'] == 1) { ?>
                                                            <dd class="mb-1"><span class="label label-primary"><?php echo "SMS sent on " . $documents['created_on_sms'];   ?></span></dd>
                                                        <?php } else if ($documents['message_status'] == 2) { ?>
                                                            <a href="javascript:void(0)" onclick="sms_data_resend('<?php /*  echo $documents['notification_alert_id']; */ ?>');" class="btn btn-sm btn-primary float-right m-t-n-xs" title="Resend"> <i class="material-icons" data-toggle="tooltip"></i>Resend</a>

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
                                                <td colspan="4" class="text-center">No Data Found</td>
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
                                                    <input class="form-check-input radio-danger" type="radio" id="inlineRadio1" value="option1" name="radioInline">
                                                    <label class="form-check-label" for="inlineRadio1"> SMS </label>
                                                    <input class="form-check-input radio-danger" type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                                    <label class="form-check-label" for="inlineRadio2"> Email </label>
                                                </div>
                                                <div class="form-group row">
                                                    <label>Select Notification Template *</label>
                                                    <select class="select2_registration form-control" id="select_temp_notif" name="select_temp_notif" style="width: 100%">
                                                        <option selected value="-1">Select Template</option>
                                                        <?php
                                                        if (isset($notification_data) && !empty($notification_data)) {
                                                            foreach ($notification_data['data'] as $documents) {
                                                                echo '<option value="' . $documents['notification_id'] . '" >' . $documents['name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>


                                                <div id="selected_datas"></div>


                                            </form>


                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <a href="javascript:void(0)" id="#send_sms_all" class="btn btn-sm btn-primary float-right m-t-n-xs" title="Send To All"> <i class="material-icons" data-toggle="tooltip"></i>Send To All </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<script type="text/javascript">
    $('#select_temp_notif').select2({
        'theme': 'bootstrap'
    });
    $(".modal_schdate").click(function(e) {
        console.log($("#tbl_arrearlistshow input:checkbox:checked").length);
        if ($("#tbl_arrearlistshow input:checkbox:checked").length > 0) {
            e.preventDefault();
            var seleted_field = [];
            $("#selected_datas").html('');
            $("#tbl_arrearlistshow input:checkbox:checked").each(function(i) {
                seleted_field[i] = $(this).val();
                $("#selected_datas").append('<input type="hidden" name="checked_data[]" class="send_sms_check" value="' + $(this).val() + '" checked="checked" >');

            });
        } else {
            swal('', "Please select at least one student from the list", 'error');
            //$('#export_report_pdf').val(0);
            return false;
        }
        /* $('#stud_id').val("");
        $('#sch_date').val("");
        $('#stud_name').val("");
        $('#sch_time').val("");
        stud_id = $(this).attr("data-temp_id")
        name = $(this).attr("data-name")
        schid = $(this).attr("data-schid")
        schdate = $(this).attr("data-schdate")
        schtime = $(this).attr("data-schtime")
        $('#stud_id').val(stud_id);
        $('#stud_name').val(name);
        $('#sch_date').val(schdate);
        $('#sch_time').val(schtime);
        $('#schid').val(schid); */
        $('#myModalinterview1').modal('show'); // #myModal (id of modal box)

    });
    $(document).on('click', '#send_sms_all', function(e) {
        var staff_name = $("#checked_item").val()
        // $('#selected_datas').val(staff_assign);
        if ($("#tbl_arrearlistshow input:checkbox:checked").length > 0) {
            e.preventDefault();
            var seleted_field = [];
            $("#selected_datas").html('');
            $('input[name^="checked_item"]:checked').each(function(i) {
                seleted_field[i] = $(this).val();
                $("#selected_datas").append('<input type="hidden" name="checked_item[]" class="staff_assign_check" value="' + $(this).val() + '" checked="checked" >');

            });
        } else {
            alert("Please check at least one box");
            //$('#export_report_pdf').val(0);
            return false;
        }
        if (staff_name == -1) {
            swal('', 'Please Select Staff', 'info');
            return false;
        }
        assign_staff(seleted_field, staff_name);
        //  $('#form_orders').submit();
    });
    var list_switchery = [];
    $(".checkall").click(function() {
        // Get all rows with search applied
        var rows = oTable.rows({
            'search': 'applied'
        }).nodes();
        // Check/uncheck checkboxes for all rows in the table
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
                        swal('Notification Updated', 'Notification Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Notification Updated', 'Notification Status Activated Successfully', 'success');
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
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'notification/notification-resend';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "notification_alert_id": notification_alert_id
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('', data.message, 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    return true;
                } else {
                    swal('', data.message, 'danger');
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                }
            }
        });
    }

    function sms_send_to_all() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'notification/notification-send-all';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#notification_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('', data.message, 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    return true;
                } else {
                    swal('', data.message, 'danger');
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