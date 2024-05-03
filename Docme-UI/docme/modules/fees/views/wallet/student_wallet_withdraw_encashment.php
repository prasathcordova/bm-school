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
                            <input type="hidden" name="amt_to_pay" id="amt_to_pay" value="<?php echo set_value('amount_with_draw', isset($approve_data['amount']) ? $approve_data['amount'] : '0'); ?>" />
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
                                                    <input type="text" maxlength="20" style="background-color: #FFFFFF" readonly="" class="form-control allownumericwithdecimal" name="amount_with_draw" id="amount_with_draw" value="<?php echo set_value('amount_with_draw', isset($approve_data['amount']) ? $approve_data['amount'] : '0'); ?>" />
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
                                        <div class="clearfix"></div>
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="row clearfix">
                                                <div class="col-lg-12" id="pay_panel" style="padding-top: 10px;">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <i class="fa fa-info-circle"></i> Transaction Types
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="panel-group payments-method" id="accordion">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="pull-right">
                                                                            <i class="fa fa-money text-info"></i>
                                                                        </div>
                                                                        <h5 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Cash Payment</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapseOne" class="panel-collapse collapse in">
                                                                        <div class="panel-body">
                                                                            <div class="row">
                                                                                <div class="form-group " style="padding-left: 30px;padding-right: 30px;">
                                                                                    <label>Amount Total</label>
                                                                                    <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" disabled="" name="pay_amount" id="pay_amount" value="<?php echo set_value('amount_with_draw', isset($approve_data['amount']) ? $approve_data['amount'] : '0'); ?>">
                                                                                </div>
                                                                                <hr>
                                                                                <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="save_withdraw_cash();">
                                                                                    <i class="fa fa-money">
                                                                                        Make Payment
                                                                                    </i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="pull-right">
                                                                            <i class="fa fa-money text-sucess"></i>
                                                                        </div>
                                                                        <h5 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Cheque Payment</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapse3" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <div class="row">

                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Cheque Number</label>
                                                                                        <input type="text" class="form-control" maxlength="10" name="ChequeNumber" id="ChequeNumber" placeholder="Enter Cheque Number">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Cheque Date</label>
                                                                                        <input type="text" class="form-control" name="ChequeDate" readonly="" style="background-color:white;" id="ChequeDate" placeholder="Enter Cheque Date">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Name of Receiver</label>
                                                                                        <input type="text" class="form-control" name="issue_name" maxlength="100" id="issue_name" placeholder="Enter Name of Receiver">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Name of Bank (Of Cheque)</label>
                                                                                        <div>
                                                                                            <select class="select2_registration form-control" id="NameofBank" name="NameofBank" placeholder="Select a bank" style="width:100%;">
                                                                                                <?php
                                                                                                if (isset($bank_details) && !empty($bank_details)) {
                                                                                                    echo '<option selected value="-1">Select a bank</option>';
                                                                                                    foreach ($bank_details as $bank) {
                                                                                                        echo '<option value="' . $bank['id'] . '">' . $bank['bank_name'] . ' ( ' . $bank['bank_abbr'] . ' )' . '</option>';
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="clearfix"></div>
                                                                                <div class="col-lg-12 col-md-12">
                                                                                    <div class="form-group ">
                                                                                        <label>Amount Total</label>
                                                                                        <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" disabled="" name="pay_amount1" id="pay_amount1" value="<?php echo set_value('amount_with_draw', isset($approve_data['amount']) ? $approve_data['amount'] : '0'); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix"></div>

                                                                                <div class="col-xs-12">
                                                                                    <div class="row">
                                                                                        <a class="btn btn-info" id="cheque_pay_btn" style="margin-left:30px;" href="javascript:void(0)" onclick="save_withdraw_cheque();">
                                                                                            <i class="fa fa-money">
                                                                                                Make Payment
                                                                                            </i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr>
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
        </div>
    </div>
</div>
<div id="student-print-container"></div>

<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('#NameofBank').select2({
        'theme': 'bootstrap'
    });
    $('#ChequeDate').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-80d',
        autoclose: true
    });

    $(function() {
        $('#issue_name').keydown(function(er) {
            if (er.altKey || er.ctrlKey) {
                er.preventDefault();
            } else {
                var key = er.keyCode;
                if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 65 && key <= 90) || key == 126 || key == 45 || key == 109 || key == 189 || key == 57 || key == 48)) {
                    er.preventDefault();
                }
            }
        });


    });



    function save_withdraw_cash() {

        var master_id = $('#master_id').val();
        var amt_to_pay = $('#amt_to_pay').val();

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/save-encashment-for-withdraw-with-cash';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "student_name": student_name,
                "master_id": master_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    swal('', 'Cash payment of ' + amt_to_pay + '/- for withdrawal from wallet for the student ' + student_name + ' completed successfully with voucher number : ' + voucher + '.', 'success');
                    print_voucher(voucher_id, voucher, 'fee');
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

    function save_withdraw_cheque() {

        var master_id = $('#master_id').val();
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var amt_to_pay = $('#amt_to_pay').val();

        var regx = /^[A-Za-z0-9 _.-]+$/;
        if (!(regx.test($('#ChequeNumber').val()) && $('#ChequeNumber').val().length <= 10 && $('#ChequeNumber').val().length > 4)) {
            swal('', 'Enter valid cheque number for payment', 'info');
            return false;
        }
        var cheque_number = $('#ChequeNumber').val();

        if (moment($('#ChequeDate').val(), 'DD-MM-YYYY').isValid() == false) {
            swal('', 'Cheque date is required for cheque payment', 'info');
            return false
        }
        var cheque_date = moment($('#ChequeDate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');

        var regx_alpha = /^[A-Za-z _.-]+$/;
        if (!(regx_alpha.test($('#issue_name').val()) && $('#issue_name').val().length <= 100 && $('#issue_name').val().length > 4)) {
            swal('', 'Enter valid name for payment', 'info');
            return false;
        }
        var issued_name = $('#issue_name').val();


        if ($('#NameofBank').val() == -1) {
            swal('', 'Enter valid account holder bank name for payment', 'info');
            return false;
        }
        var bank_id = $('#NameofBank').val();




        var ops_url = baseurl + 'fees/save-encashment-for-withdraw-with-cheque';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "student_name": student_name,
                "master_id": master_id,
                "cheque_number": cheque_number,
                "cheque_date": cheque_date,
                "issued_name": issued_name,
                "bank_id": bank_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    swal('', 'Cheque payment ' + amt_to_pay + '/- aaa for withdrawal from wallet for the student ' + student_name + ' completed successfully with voucher number : ' + voucher + '.', 'success');
                    print_voucher(voucher_id, voucher, 'fee');
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

    function print_voucher(voucher_id, voucher_code, ptype) {
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/print_voucher_reprint/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "voucher_id": voucher_id,
                "voucher_code": voucher_code,
                "student_name": student_name,
                "student_id": student_id,
                "issue": "print",
                "ptype": ptype
            },
            success: function(result) {
                $('#voucher_data_loader').removeClass('sk-loading');
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-print-container').html('');
                    $('#student-print-container').html(data.view);
                } else {
                    alert('No data loaded');
                }

                //select_items(voucher_id,voucher_code);
            }
        });

    }
</script>