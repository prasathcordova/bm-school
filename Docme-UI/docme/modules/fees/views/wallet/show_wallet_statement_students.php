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
                    <div class="ibox-tools">
                        <a href="javascript:void(0);" title="Deposit amount to Docme Wallet of student, <?php echo $student_data['student_name'] ?> " onclick="deposit_details('<?php echo $student_data['student_id']; ?>', '<?php echo $student_data['student_name'] ?>')" class=""><i class="fa fa-university" style="color:#26c6c8; font-size:26px;opacity: 10;"></i></a>
                        <a style="margin-left: 10px;" href="javascript:void(0);" title="Withdraw amount from Docme wallet of student, <?php echo $student_data['student_name'] ?> " onclick="withdrawal_details('<?php echo $student_data['student_id']; ?>', '<?php echo $student_data['student_name'] ?>')" class=""><i class="fa fa-money" style="color:#f8ac59; font-size:26px;opacity: 10;"></i></a>
                        <a style="margin-left: 10px;" href="javascript:void(0)" onclick="reload_collection_detail(<?php echo $student_data['student_id']; ?>,'<?php echo $student_data['student_name']; ?>','statement');" id="refresh_data" class="pull-right"> <i class="fa fa-refresh" style="color:#E91E63; font-size:26px;opacity: 10;" data-toggle="tooltip" title="Refresh data"></i></a>
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
                                <div class="widget lazur-bg no-padding" style="margin-top:0px">
                                    <div class="p-m" style="padding:3px !important; display: inline-block; width: 100%">
                                        <h1 class="m-xs" style="text-align:right;"><?php echo print_currency('#fff'); ?> <?php echo isset($e_wallet) && !empty($e_wallet) ? my_money_format($e_wallet) : 0; ?></h1>

                                        <h3 class="font-bold no-margins" style="text-align:right;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px; padding-right: 10px;">
                                            Docme Wallet Balance
                                            <input type="hidden" name="total_e_wallet_amount" id="total_e_wallet_amount" value="<?php echo $e_wallet; ?>" />
                                        </h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row" style="" id="fees_summary">
                            <!--style="border-top: 1px solid #e7eaec !important;"-->
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="m-t-xs text-left"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered margin bottom" id="available_students">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Voucher No.</th>
                                                <th class="text-right">Credit</th>
                                                <th class="text-right">Debit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_credit = 0;
                                            $total_debit = 0;
                                            $wallet_balance = 0;
                                            if (isset($wallet_statement) && !empty($wallet_statement) && is_array($wallet_statement)) {
                                                //dev_export($wallet_statement); //die;
                                                foreach ($wallet_statement as $student) {
                                                    if ($student['TRANSACT_TYPE'] == 'WALLET AMOUNT DEBIT' || $student['TRANSACT_TYPE'] == 'WALLET AMOUNT WITHDRAWAL AUTHORIZED') {
                                                        $creditamount = 0;
                                                        $debitamount = $student['transaction_amount'];
                                                    } else {
                                                        $creditamount = $student['transaction_amount'];
                                                        $debitamount = 0;
                                                    }
                                            ?>
                                                    <tr>
                                                        <td><?php echo date('d-M-Y', strtotime($student['TRANSACTION_DATE'])); ?></td>
                                                        <td><?php echo $student['voucher_number']; ?> - <?php echo $student['TRANSACT_TYPE']; ?></td>
                                                        <td class="text-right"><?php echo ($creditamount != my_money_format(0) ? my_money_format($creditamount) : ''); ?></td>
                                                        <td class="text-right"><?php echo ($debitamount != my_money_format(0) ? my_money_format($debitamount) : ''); ?></td>
                                                    </tr>
                                            <?php
                                                    $total_credit += $creditamount;
                                                    $total_debit += $debitamount;
                                                }
                                            }
                                            $wallet_balance = $total_credit - $total_debit;
                                            ?>

                                            <tr>
                                                <td colspan="2" class="text-right">Total</td>
                                                <td class="text-right"><?php echo my_money_format($total_credit); ?></td>
                                                <td class="text-right"><?php echo my_money_format($total_debit); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right">Wallet Balance</td>
                                                <td colspan="2" class="text-right"><?php echo print_currency('#676a6c'); ?> <?php echo my_money_format($wallet_balance); ?></td>
                                            </tr>
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
</div>
</div>
<input type="hidden" name="minimum_wallet_amt" id="minimum_wallet_amt" value="1" />
<div id="student-print-container"></div>

<script>
    $(document).ready(function() {


        $('#search_student').hide();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


    });

    function refresh_student_data() {
        $("#close_button").show();
        var searchname = $('#sname').val();
        var class_id = $('#class_id').val();
        var batch_id = $('#batch_id').val();
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var batch_name = $('#batch_id :selected').text();
        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            return false;
        }
        var ops_url = baseurl + 'fees/onetimecol/advancesearch-studentname-for-collection';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //            data: {"load": 1, "searchname": searchname},
            data: {
                "load": 1,
                "stream_id": stream_id,
                "batch_id": batch_id,
                "searchname": searchname,
                "class_id": class_id,
                "academic_year": academic_year,
                "batch_name": batch_name
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);

                } else {
                    alert('No data loaded');
                }
            }
        });
    }


    function save_payment_by_wallet(studentid, studentname) {
        var ops_url = baseurl + 'fees/onetimecol/save-payment-by-wallet-for-students';
        $('#pay_loader').addClass('sk-loading');
        var batch_id = $('#batch_id').val();
        var student_data = [];
        var table = $('#available_students').dataTable();
        var amount_flag = 1;
        var error_students = [];
        table.$('input[type=checkbox]').each(function() {
            if (this.checked) {
                var student_id = $(this).data('student_id');
                var pending_amt = $(this).data('pendingpayment');
                var wallet_amt = $(this).data('walletbalance');
                var student_name = $(this).data('studentname');
                var admissionnumber = $(this).data('admissionnumber');

                if (wallet_amt == 0 || pending_amt == 0) {
                    amount_flag = 2;
                    //error_students.push(student_name)
                    error_students.push(admissionnumber)
                } else {
                    student_data.push({
                        student_id: student_id,
                        student_name: student_name,
                        pending_amt: pending_amt,
                        wallet_amt: wallet_amt
                    });
                }
            }
        });

        if (amount_flag == 2) {
            var error_format_students = error_students.join(', ');
            $('#pay_loader').removeClass('sk-loading');
            swal('', 'Please check the following students if wallet balance or pending payment is zero,\n' + error_format_students, 'info');
            return false;
        }

        var formatted_student_data = JSON.stringify(student_data);
        if (formatted_student_data.length == 2 || formatted_student_data.length < 2) {
            swal('', 'Select atleast one student.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "load": 1,
                "student_data": formatted_student_data,
                "batch_id": batch_id
            },
            success: function(result) {
                $('#pay_loader').removeClass('sk-loading');
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'All adjustments completed successfully.', 'success');
                    reload_collection_detail();
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was aan error regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function reload_collection_detail(studentid, studentname, $type = "") {
        var ops_url = baseurl + 'fees/show-wallet-collection';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname,
                "type": $type
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