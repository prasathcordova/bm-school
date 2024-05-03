<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Voucher Details - <?php echo isset($voucher_code) && !empty($voucher_code) ? $voucher_code : ''; ?>


                <?php // if (date('Ymd', strtotime($details_data['master_data']['billing_date'])) === date('Ymd')) { 
                // dev_export($master_data);
                ?>
                <span id="voucher_cancel" style="float: right;"><a data-toggle="tooltip" title="Voucher Cancel : <?php echo $voucher_code; ?>" href="javascript:void(0)" onclick="cancel_voucher();"><i class="fa fa-trash-o" style="font-size: 22px;color: white; padding-right: 15px;"></i></a></span>
                <?php // }
                ?>

            </div>



            <div class="panel-body">
                <div class="row" style="padding:20px; display: none;" id="bill_cancel_id">
                    <!-- <input type="hiddens" id="mixedpayment" value="<?php echo $master_data[0]['is_mixed_payment']; ?>">
                    <input type="hiddens" id="wal_voucher_code" value="<?php echo $master_data[0]['wallet_voucher_code']; ?>"> -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Reason</label> <span class="mandatory text-danger"> *</span>
                            <input type="text" style="background-color: #FFFFFF" class="form-control " placeholder="Enter the reason for Voucher cancel" name="reason" id="reason" value="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px; margin-top:18px; " href="javascript:void(0);" onclick="submit_voucher_cancel('<?php echo $voucher_id; ?>');">
                            <i class="fa fa-trash-o">
                                Cancel Voucher !
                            </i>
                        </a>
                    </div>
                    <?php if (($master_data[0]['is_mixed_payment'] == 1)) {  //&& (substr($voucher_code, 0, 3) == 'CRV')
                    ?>
                        <div class="col-md-12">
                            <p>There is a related voucher <b><?php echo $master_data[0]['wallet_voucher_code']; ?>.</b> If you cancel this voucher, that voucher also be cancelled.
                                <?php if (substr($voucher_code, 0, 3) == 'CRV') { ?>
                                    <b><?php echo $master_data[0]['wallet_voucher_code']; ?></b> not available for reconciliation after cancelling this voucher.</p>
                        <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <!--height: 150px !important;-->
                <div class="table m-t">
                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th>Transaction Description</th>
                                <th>Month</th>
                                <th>Transaction Amount ( <?php echo print_currency('black', 13); ?> )</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $wallet_total = 0;
                            $transaction_total = 0;
                            if (isset($student_account) && !empty($student_account)) {
                                foreach ($student_account as $account) {
                            ?>
                                    <tr>
                                        <td><?php echo $account['transaction_desc']; ?></td>
                                        <td><?php echo (isset($account['demandmonth']) ? date('M Y', strtotime($account['demandmonth'])) : '-'); ?></td>
                                        <td><?php echo my_money_format($account['transaction_amount']); ?></td>

                                    </tr>
                                <?php
                                    $transaction_total += $account['transaction_amount'];
                                }
                            }
                            if (isset($wallet_account) && !empty($wallet_account)) {
                                foreach ($wallet_account as $wallet) {
                                ?>
                                    <tr>
                                        <td><?php echo $wallet['transaction_desc']; ?></td>
                                        <td><?php echo my_money_format($wallet['transaction_amount']); ?></td>

                                    </tr>
                            <?php
                                    $wallet_total += $wallet['transaction_amount'];
                                }
                            }
                            $grand_total = $transaction_total + $wallet_total;
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <table class="table invoice-total" id="invoice_tbl">
                    <tbody>
                        <!--                        <tr>
                            <td><strong>Total  Items:</strong></td>
                            <td ><p id="tbl_total_items"><?php echo $total_items; ?></p></td>
                        </tr>
                        <tr>
                            <td><strong>Sub Total :(<?php echo CURRENCY  ?>)</strong></td>
                            <td><p id="tbl_subtotal"><?php echo my_money_format($details_data['master_data']['sub_total']); ?></p> </td>
                        </tr>
                        <tr>
                            <td><strong>Total Discount Amount :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id=""><p id="tbl_discount"><?php echo my_money_format($details_data['master_data']['discount_amount']); ?></p> </td>
                        </tr>
                        <tr>
                            <td><strong>Sub Total After Discount :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id=""><p id="tbl_subtotal_after_discount"><?php echo my_money_format($details_data['master_data']['sub_total'] - $details_data['master_data']['discount_amount']); ?></p> </td>
                        </tr>
                        <tr>
                            <td><strong>VAT :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id=""> <p id="tbl_tax"><?php echo my_money_format($details_data['master_data']['tax_amount']); ?></p></td>
                        </tr>

                        <tr>
                            <td><strong>Round Off (+ / -) :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id=""><p id="tbl_round_off"><?php echo round($details_data['master_data']['round_off'], 2); ?> </p></td>
                        </tr>-->
                        <tr>
                            <td><strong>Grand Total : <?php echo print_currency('#676a6c', '15'); ?></strong></td>
                            <td id="">
                                <p id="tbl_total" style="font-weight: bold;"><?php echo my_money_format($grand_total); //$master_data[0]['voucher_amount'] 
                                                                                ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $('.scroll_content').slimscroll({
        height: '250px',
        color: '#f8ac59'
    });

    function cancel_voucher() {
        $("#bill_cancel_id").show();
    }

    function submit_voucher_cancel(voucher_id) {
        var mixedpayment = $('#mixedpayment').val();
        var wal_voucher_code = $('#wal_voucher_code').val();
        // if (mixedpayment == 1) {
        //     swal('Mixed Payment', 'You should cancel the related voucher ' + wal_voucher_code + ' also.', 'success');
        // }

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        $('#voucher_data_loader').addClass('sk-loading');
        var reason = $('#reason').val();
        var ops_url = baseurl + 'fees/save-cancel-voucher';
        /** */
        swal({
                title: "Voucher Cancel",
                text: "Are you sure to cancel the voucher?",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "load": 1,
                            "voucher_id": voucher_id,
                            "reason": reason,
                            "student_id": student_id
                        },
                        success: function(result) {
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                swal('Success', data.message, 'success');
                                $('#voucher_data_loader').removeClass('sk-loading');
                                cancellation_detail(student_id, student_name);
                            } else if (data.status == 2) {
                                if (data.message) {
                                    $('#voucher_data_loader').removeClass('sk-loading');
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    $('#voucher_data_loader').removeClass('sk-loading');
                                    swal('', 'An error encountered. Please contact administrator for further support.', 'info');
                                    return false;
                                }

                            }
                        },
                        error: function() {
                            $('#voucher_data_loader').removeClass('sk-loading');
                            swal('', 'An error encountered. Please contact administrator for further support.', 'info');
                            return false;
                        }
                    });
                } else {
                    $('#voucher_data_loader').removeClass('sk-loading');
                    swal('', 'Voucher not cancelled', 'info');
                    return false;
                }

            });
        /** */

        $('#voucher_data_loader').removeClass('sk-loading');
        return;
    }

    function cancellation_detail(studentid, studentname) {
        var ops_url = baseurl + 'fees/show-fee-voucher-cancel';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": studentid,
                "student_name": studentname
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