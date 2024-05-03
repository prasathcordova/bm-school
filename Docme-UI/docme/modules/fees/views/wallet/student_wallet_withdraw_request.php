<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
        <span style="visibility:hidden" name="inst_currency" id="inst_currency"><?php echo $this->session->userdata('Currency_abbr'); ?></span>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="show_withdraw_request_list();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Save withdraw request" data-placement="left" href="javascript:void(0)" onclick="save_withdraw_request();"><i class="fa fa-floppy-o"></i> SAVE WITHDRAW REQUEST</a>
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
                                            <div class="form-group">
                                                <label>Amount To Withdraw</label> <span class="mandatory text-danger"> *</span>
                                                <div class="form-line <?php
                                                                        if (form_error('amount_with_draw')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" maxlength="8" class="form-control digits text-right" placeholder="Amount To Withdraw" name="amount_with_draw" id="amount_with_draw" value="<?php echo set_value('amount_with_draw', isset($amount_with_draw) ? my_money_format($amount_with_draw) : ''); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Reason To Withdraw</label> <span class="mandatory text-danger"> *</span>
                                                <div class="form-line <?php
                                                                        if (form_error('reason')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" maxlength="50" placeholder="Reason To Withdraw" class="form-control" name="reason" id="reason" value="<?php echo set_value('reason', isset($reason) ? $reason : ''); ?>" />
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
</div>
<input type="hidden" name="minimum_wallet_amt" id="minimum_wallet_amt" value="10" />
<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });


    function save_withdraw_request() {
        var currency = $('#inst_currency').html();
        var amt_pay_raw = $('#amount_with_draw').val();
        var reason = $('#reason').val();
        var minimum_wallet_amt = $('#total_e_wallet_amount').val();
        if (parseFloat(amt_pay_raw) > parseFloat(minimum_wallet_amt)) {
            swal('', 'Please check the amount.The maximum amount that can be withdrawn is ' + currency + ' ' + parseFloat(minimum_wallet_amt), 'info');
            return false;
        }
        if (parseFloat(amt_pay_raw) < 1) {
            $('#amount_with_draw').focus();
            swal('', 'Minimum Amount for withdrawal is 1', 'info');
            return false;
        }
        if (amt_pay_raw.length == 0) {
            $('#amount_with_draw').focus();
            swal('', 'Enter Amount To Withdraw', 'info');
            return false;
        }
        if (reason.length == 0) {
            $('#reason').focus();
            swal('', 'Enter Reason To Withdraw', 'info');
            return false;
        }

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/save-withdraw-request';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "transaction_amount": amt_pay_raw,
                "student_name": student_name,
                "reason": reason
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'Request placed for withdraw of amount ' + amt_pay_raw + " for the student " + student_name + " is completed successfully.", 'success');
                    show_withdraw_request_list();
                } else if (data.status == 2) {
                    if (data.message) {
                        var str = data.message;
                        var res = str.split('*');
                        swal('', res[0] + '\n' + res[1] + '\n' + res[2], 'info');
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