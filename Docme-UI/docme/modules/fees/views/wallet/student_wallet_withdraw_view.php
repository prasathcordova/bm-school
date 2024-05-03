<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="show_withdraw_request_list();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>

                    </div>
                </div>
                <div class="ibox-content" id="pay_loader">
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
                            <div class="col-md-6">
                                <div class="profile-image">
                                    <?php
                                    $profile_image = "";
                                    if (!empty(get_student_image($student_data['student_id']))) {
                                        $profile_image = get_student_image($student_data['student_id']);
                                    } else
                                    if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {

                                        $profile_image = "data:image/jpeg;base64," . $student_data['profile_image'];
                                    } else {
                                        if (isset($student_data['profile_image_alternate']) && !empty($student_data['profile_image_alternate'])) {
                                            $profile_image = $student_data['profile_image_alternate'];
                                        } else {
                                            $profile_image = base_url('assets/img/a0.jpg');
                                        }
                                    }


                                    ?>
                                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="margin-top: 0px;border-top-width: 0px;" />
                                </div>
                                <div class="profile-info">
                                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_data['student_id']; ?>" />
                                    <input type="hidden" name="student_name" id="student_name" value="<?php echo $student_data['student_name']; ?>" />
                                    <input type="hidden" name="master_id" id="master_id" value="<?php echo $master_id; ?>" />


                                    <div class="">
                                        <div>
                                            <h4><?php echo $student_data['student_name']; ?></h4>
                                            <small>
                                                Admission No. : <?php echo $student_data['Admn_No']; ?>
                                            </small><br>
                                            <small>
                                                Batch : <?php echo $student_data['Batch_Name']; ?>
                                            </small><br>
                                            <small>
                                                Class : <?php echo $student_data['Description']; ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-top:5px; float: right;">
                                <div class="widget lazur-bg no-padding" style="margin-top:0px;">
                                    <div class="p-m" style="padding:3px !important; display: inline-block">
                                        <h1 class="m-xs" style="text-align:center"><span class="fa fa-inr" aria-hidden="true" style="color:#FFF "></span> <?php echo isset($e_wallet) && !empty($e_wallet) ? my_money_format($e_wallet) : 0; ?></h1>

                                        <h3 class="font-bold no-margins" style="text-align:center;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            Docme Wallet
                                            <input type="hidden" name="total_e_wallet_amount" id="total_e_wallet_amount" value="<?php echo $e_wallet; ?>" />
                                        </h3>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="ibox-content" style=" padding-right: 1%;" id="fees_summary">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <b>Amount to Withdraw</b>
                                            <div class="form-group">
                                                <div class="form-line <?php
                                                                        if (form_error('amount_with_draw')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" maxlength="20" style="background-color: #FFFFFF" readonly="" class="form-control decimalCheck" name="amount_with_draw" id="amount_with_draw" value="<?php echo set_value('amount_with_draw', isset($approve_data['amount']) ? my_money_format($approve_data['amount']) : '0'); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Reason to Withdraw</b>
                                            <div class="form-group">
                                                <div class="form-line <?php
                                                                        if (form_error('reason')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" style="background-color: #FFFFFF" readonly="" maxlength="200" class="form-control" name="reason" id="reason" value="<?php echo set_value('reason', isset($approve_data['reason']) ? $approve_data['reason'] : ''); ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <b>Approve Status </b>
                                            <div class="form-group">
                                                <?php
                                                $status_comment = '';
                                                if ((isset($approve_data['is_approved']) && $approve_data['is_approved'] == 1)) {
                                                    $status_comment = 'APPROVED WITHDRAWAL';
                                                } else {
                                                    if ((isset($approve_data['is_rejected']) && $approve_data['is_rejected'] == 1)) {
                                                        $status_comment = 'WITHDRAW REQUEST REJECTED';
                                                    } else {
                                                        $status_comment = 'STATUS NOT AVAILABLE';
                                                    }
                                                }
                                                ?>
                                                <input type="text" style="background-color: #FFFFFF" class="form-control " readonly name="approval_c" id="approval_c" value="<?php echo set_value('approval_c', $status_comment); ?>" />

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <b>Comments</b>
                                            <div class="form-group">

                                                <input type="text" style="background-color: #FFFFFF" class="form-control" readonly name="approve_remarks" id="approve_remarks" value="<?php echo set_value('approve_remarks', ((isset($approve_data['is_approved']) && $approve_data['is_approved'] == 1) ? $approve_data['approve_remarks'] : ((isset($approve_data['is_rejected']) && $approve_data['is_rejected'] == 1) ? $approve_data['reject_remarks'] : $approve_data['reason']))) ?>" />

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <b>Withdraw Status</b>
                                            <div class="form-group">

                                                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" readonly name="status_desc" id="status_desc" value="<?php echo set_value('status_desc', isset($approve_data['status_desc']) ? $approve_data['status_desc'] : ''); ?>" />

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
<input type="hidden" name="minimum_wallet_amt" id="minimum_wallet_amt" value="10" />
<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });


    function save_withdraw_approve() {
        var status = $('input[name=radioInline]:checked').val();
        var master_id = $('#master_id').val();
        var comments = btoa($('#approval_c').val());
        if ($('#approval_c').val().length < 5) {
            swal('', 'Comment is mandatory and require atleast 5 characters. Please fill in comments');
            return false;
        }

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/save-approve-withdraw-request';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "student_name": student_name,
                "remarks": comments,
                "master_id": master_id,
                "approve_type": status
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    if (status == 'Approve') {
                        swal('', 'Request approved for the student ' + student_name + '.', 'success');
                    } else {
                        swal('', 'Request rejected for the student ' + student_name + '.', 'success');
                    }
                    show_withdraw_request_list();
                } else if (data.status == 2) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        return false;
                    }
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was error regarding the selected student. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function show_withdraw_request_list() {
        var studentid = $('#student_id').val();
        var studentname = $('#student_name').val();
        var ops_url = baseurl + 'fees/show-wallet-collection-to-withdraw';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }
</script>