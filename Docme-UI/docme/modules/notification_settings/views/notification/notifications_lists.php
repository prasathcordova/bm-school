<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Notification" data-placement="left" href="javascript:void(0)" onclick="add_new_notifications();"><i class="fa fa-plus"></i>Create Template</a>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_notificationshow">

                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Template Name</th>
                                            <th>Template Type</th>
                                            <th>Email/SMS Content</th>
                                            <!--  <th>Isrequired</th> -->
                                            <th>Status</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //  R.id as notification_id,R.inst_id,R.name,R.need,R.sms_message,R.sms_status
                                        if (isset($notification_data) && !empty($notification_data) && isset($notification_data['data'][0])) {
                                            $i = 1;
                                            foreach ($notification_data['data'] as $documents) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $i; ?></td>
                                                    <td> <?php echo $documents['name']; ?></td>
                                                    <td>
                                                        <?php if ($documents['sms_status'] == 1) {
                                                            $message_td = "SMS";
                                                        } else if ($documents['email_status'] == 1) {
                                                            $message_td = "EMAIL";
                                                        } else {
                                                            $message_td = "";
                                                        }
                                                        ?>
                                                        <?php echo $message_td; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($documents['sms_status'] == 1) {
                                                            $message = $documents['sms_message'];
                                                        } else if ($documents['email_status'] == 1) {
                                                            $message = $documents['email_message'];
                                                        } else {
                                                            $message = "";
                                                        }
                                                        ?>
                                                        <?php echo $message; ?>
                                                    </td>
                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <div class="switch">
                                                            <div class="onoffswitch">

                                                                <?php if ($documents['isactive'] == 1) {

                                                                    if ($documents['sms_status'] == 1) {
                                                                        $smsoremail = 1;
                                                                    } else if ($documents['email_status'] == 1) {
                                                                        $smsoremail = 2;
                                                                    }
                                                                    $checked = "checked";
                                                                } else {
                                                                    if ($documents['sms_status'] == 1) {
                                                                        $smsoremail = 1;
                                                                    } else if ($documents['email_status'] == 1) {
                                                                        $smsoremail = 2;
                                                                    }
                                                                    $checked = '';
                                                                }
                                                                ?>
                                                                <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" onchange="change_status('<?php echo $documents['notification_id']; ?>','<?php echo $smsoremail; ?>',  this)" id="<?php echo $documents['notification_id']; ?>">
                                                                <label class="onoffswitch-label" for="<?php echo $documents['notification_id']; ?>">
                                                                    <span class="onoffswitch-inner"></span>
                                                                    <span class="onoffswitch-switch"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-xs btn-info pull-right" href="javascript:void(0);" onclick="edit_notification('<?php echo $documents['notification_id']; ?>');" data-toggle="tooltip" title="Edit <?php echo $documents['name']; ?>"><i class="fa fa-edit"></i> Edit</a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var list_switchery = [];

    $('#tbl_notificationshow tbody').on('click', function(e) {
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


    function change_status(notification_id, emailorsms, element) {
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
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "notification_id": notification_id,
                "emailorsms": emailorsms,
                "sms_status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Notification Updated', 'Notification Status Deactivated Successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Notification Updated', 'Notification Status Activated Successfully.', 'success');
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
                    } else if (data.status == -1) {
                        swal('Notification Updated', 'Notification Status Deactivated Successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
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

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'notification/add-notification';
        var notification_name = $('#notification_name').val();
        if (notification_name == '') {
            swal('', 'Template Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((notification_name.length > '30') || (notification_name.length < '3')) {
            swal('', 'Template Name should contain 3 to 30 Characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#notification_name").val())) {
            swal('', 'Template Name can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if ($("#sms_status").val() == "sms_message") {

            var sms_message = $('#sms_message').val();
            if (sms_message == '') {
                swal('', 'SMS Content is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if ((sms_message.length > '160') || (sms_message.length < '10')) {
                swal('', 'SMS Message should contain 10 to 160 characters.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        }
        if ($("#email_status").val() == "email_message") {
            var email_message = $('#email_message').val();
            if (email_message == '') {
                swal('', 'Email Content is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if ((email_message.length > '350') || (email_message.length < '10')) {
                swal('', 'Email Message should contain 10 to 350 characters.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: $('#notification_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $('#notification_save').html('');
                    $('#notification_save').html(data.view);
                    load_notifications_list();
                    $('#add_type').show();
                    swal('Success', 'Notification Template, ' + notification_name + ' created successfully.',
                        'success');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#faculty_loader').removeClass('sk-loading');

                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator.', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }

    function update_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'notification/edit-notification';
        var notification_name = $('#notification_name').val();
        if (notification_name == '') {
            swal('', 'Template Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((notification_name.length > '30') || (notification_name.length < '3')) {
            swal('', 'Template Name should contain 3 to 30 characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#notification_name").val())) {
            swal('', 'Template Name can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if ($("#sms_status").val() == "sms_message") {

            var sms_message = $('#sms_message').val();
            if (sms_message == '') {
                swal('', 'SMS Message is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if ((sms_message.length > '160') || (sms_message.length < '10')) {
                swal('', 'SMS Message should contain 10 to 160 characters.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        }
        if ($("#email_status").val() == "email_message") {
            var email_message = $('#email_message').val();
            if (email_message == '') {
                swal('', 'Email Message is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if ((email_message.length > '350') || (email_message.length < '10')) {
                swal('', 'Email Message should contain 10 to 350 characters.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: $('#notification_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $('#notification_save').html('');
                    $('#notification_save').html(data.view);
                    load_notifications_list();
                    $('#add_type').show();
                    swal('Success', notification_name + ' Notification, ' + ' updated.',
                        'success');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#faculty_loader').removeClass('sk-loading');

                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator.', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
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

    //NEW SCRIPT
    function add_new_notifications() {
        var ops_url = baseurl + 'notification/add-notification';
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
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function edit_notification(notification_id) {
        var ops_url = baseurl + 'notification/edit-notification';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "notification_id": notification_id
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>