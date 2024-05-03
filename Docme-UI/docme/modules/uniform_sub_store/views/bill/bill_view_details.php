<div class="row">
    <?php
    $bill_cancel = 1;
    if (!empty($payment_data)) { ?>
        <div class="col-lg-12">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> Payment Details
                </div>
                <div class="panel-body">
                    <div class="row" style="padding:20px; display:none " id="voucher_cancel">
                        <div class="col-md-8">
                            <b>Reason</b>
                            <div class="form-group">
                                <input type="text" maxlength="50" style="background-color: #FFFFFF" class="form-control " placeholder="Enter the reason for Voucher cancel" name="voucher_reason" id="voucher_reason" value="" />
                            </div>
                        </div>
                        <input type="hidden" id="payment_id" value="0">
                        <input type="hidden" id="bill_id" value="0">
                        <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px; margin-top:18px; " href="javascript:void(0);" onclick="submit_voucher_cancel();">
                            <i class="fa fa-trash-o"> </i> Cancel Voucher
                        </a>
                    </div>
                    <table class="table ex2 invoice-table " style="width:99%">
                        <thead>
                            <tr>
                                <th>Voucher No</th>
                                <th>Voucher Amount</th>
                                <th>Voucher Date</th>
                                <th>Task</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($payment_data as $data) {
                            ?>
                                <tr>
                                    <td><?php echo $data['payment_billing_code'] ?></td>
                                    <td><?php echo my_money_format($data['paid_amount']) ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($data['payment_date'])) ?></td>
                                    <td>
                                        <?php if (date('Ymd', strtotime($data['payment_date'])) === date('Ymd') && $i > 1 && $i  == sizeof($payment_data)) { ?>
                                            <a data-toggle="tooltip" title="Cancel Bill : <?php echo $data['payment_billing_code']; ?>" onclick="cancel_voucher(<?php echo $data['id']; ?>,<?php echo $data['billing_master_id']; ?>);"><i class="fa fa-trash-o"></i></a> &nbsp;&nbsp;
                                        <?php } ?>
                                        <a data-toggle="tooltip" title="Print Bill : <?php echo $data['payment_billing_code']; ?>" target="_blank" href="<?php echo base_url() ?>uniform/substore/bill-print-duplicate/<?php echo $data['payment_billing_code'] ?>"><i class="fa fa-file-pdf-o"></i></a>
                                    </td>
                                </tr>
                            <?php
                                if ($i > 1) {
                                    $bill_cancel = 0;
                                }
                                $i++;
                            } ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    <?php }
    ?>
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Bill Details <?php //echo isset($billcode) && !empty($billcode) ? $billcode : ''; 
                                                                ?>
                <?php
                if (check_permission(533, 1008, 0)) {
                ?>
                    <!-- <span id="print_bill" style="float: right;"><a data-toggle="tooltip" title="Print Bill : <?php echo $billcode; ?>" target="_blank" href="<?php echo base_url() ?>substore/bill-print-duplicate/<?php echo $billcode ?>"><i class="fa fa-file-pdf-o" style="font-size: 22px;color: white;"></i></a></span> -->
                    <!-- <span id="print_bill" style="float: right;"><a data-toggle="tooltip" title="Print Bill : <?php echo $billcode; ?>" href="javascript:void(0)" onclick="print_bill('<?php echo $billcode; ?>');"><i class="fa fa-file-pdf-o" style="font-size: 22px;color: white;"></i></a></span> -->
                    <!--<span id="demo_print_bill" style="float: right;padding-right:16px;"><a data-toggle="tooltip" title="Demo Print Bill : <?php echo $billcode; ?>" href="javascript:void(0)" onclick="print_bill_demo('<?php echo $billcode; ?>');" ><i class="fa fa-print" style="font-size: 22px;color: white;"></i></a></span>-->

                <?php
                }
                ?>
                <?php

                //                dev_export($_SESSION);die;
                if (check_permission(533, 1007, 0) || (null !== ($this->session->userdata('emailid')) && !empty($this->session->userdata('emailid')) && $this->session->userdata('emailid') == 'aju.docme@acetvm.com')) {
                ?>
                    <?php if ($details_data['master_data']['payment_mode_id'] != 6 && $bill_cancel == 1) { ?>
                        <?php if (date('Ymd', strtotime($details_data['master_data']['billing_date'])) === date('Ymd') || (null !== ($this->session->userdata('emailid')) && !empty($this->session->userdata('emailid')) && $this->session->userdata('emailid') == 'aju.docme@acetvm.com')) { ?>
                            <span id="bill_cancel" style="float: right;"><a data-toggle="tooltip" title="Bill Cancel : <?php echo $billcode; ?>" href="javascript:void(0)" onclick="cancel_bill('<?php echo $billcode; ?>');"><i class="fa fa-trash-o" style="font-size: 22px;color: white; padding-right: 15px;"></i></a></span>
                    <?php }
                    }
                    ?>
                <?php
                }
                ?>
            </div>



            <div class="panel-body">
                <div class="row" style="padding:20px; display: none;" id="bill_cancel_id">
                    <div class="col-md-8">
                        <b>Reason</b>
                        <div class="form-group">
                            <input type="text" maxlength="50" style="background-color: #FFFFFF" class="form-control " placeholder="Enter the reason for Bill cancel" name="reason" id="reason" value="" />
                        </div>
                    </div>
                    <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px; margin-top:18px; " href="javascript:void(0);" onclick="submit_uniform_bill_cancel('<?php echo $billid; ?>');">
                        <i class="fa fa-trash-o"></i> Cancel Bill
                    </a>
                </div>


                <div class="table m-t scroll_content" style="height: 250px !important;">
                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th>Items Name</th>
                                <th>Rate(<?php echo CURRENCY  ?>)</th>
                                <th>Quantity</th>
                                <th>Sub-Total (<?php echo CURRENCY  ?>)</th>
                                <th>Discount</th>
                                <th>Disc.Amt</th>
                                <th>After Discount</th>
                                <th><?php echo TAXNAME  ?></th>
                                <th><?php echo TAXNAME  ?> Amt.(<?php echo CURRENCY  ?>)</th>
                                <th>Total(<?php echo CURRENCY  ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($details_data) && !empty($details_data)) {
                                $total_items = count($details_data['data']);
                                foreach ($details_data['data'] as $items) {
                            ?>
                                    <?php if ($details_data['master_data']['kit_name'] == '') { ?>
                                        <tr>
                                            <td><strong><?php echo $items['item_name']; ?></strong></td>
                                            <td>
                                                <?php echo $items['price']; ?>

                                            </td>
                                            <td>
                                                <?php echo $items['qty']; ?>

                                            </td>
                                            <td>
                                                <?php echo $items['sub_total']; ?>

                                            </td>
                                            <td>
                                                <?php echo $items['discount_value'] ?> (<?php echo $items['discount_type']; ?>)
                                            </td>
                                            <td>
                                                <?php echo $items['discount_amount']; ?>

                                            </td>
                                            <td>
                                                <?php echo $items['sub_total_after_discount']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($items['tax_type'] == 'P') {
                                                    echo $items['tax_percent'];
                                                    echo ' %';
                                                } else {
                                                    echo $items['tax_percent'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $items['tax_amount'] ?>
                                            </td>
                                            <td>
                                                <?php echo $items['final_total']; ?>
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td><strong><?php echo $items['item_name']; ?></strong></td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                <?php echo $items['qty']; ?>

                                            </td>
                                            <td>
                                                -

                                            </td>
                                            <td>
                                                -

                                            </td>
                                            <td>
                                                -

                                            </td>
                                            <td>
                                                -

                                            </td>
                                            <td>
                                                -

                                            </td>
                                            <td>
                                                -

                                            </td>
                                            <td>
                                                -

                                            </td>
                                        </tr>
                                    <?php } ?>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <table class="table invoice-total" id="invoice_tbl">
                    <tbody>
                        <tr>
                            <td><strong>Total Items:</strong></td>
                            <td>
                                <p id="tbl_total_items"><?php echo $total_items; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Sub Total :(<?php echo CURRENCY  ?>)</strong></td>
                            <?php if ($details_data['master_data']['kit_name'] == '') { ?>
                                <td>
                                    <p id="tbl_subtotal"><?php echo my_money_format($details_data['master_data']['sub_total']); ?></p>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <p id="tbl_subtotal"><?php echo my_money_format($details_data['master_data']['sub_total'] + $details_data['master_data']['round_off']); ?></p>
                                </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td><strong>Total Discount Amount :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id="">
                                <p id="tbl_discount"><?php echo my_money_format($details_data['master_data']['discount_amount']); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Sub Total After Discount :(<?php echo CURRENCY  ?>)</strong></td>
                            <?php if ($details_data['master_data']['kit_name'] == '') { ?>
                                <td>
                                    <p id=""><?php echo my_money_format($details_data['master_data']['sub_total'] - $details_data['master_data']['discount_amount']); ?></p>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <p id=""><?php echo my_money_format($details_data['master_data']['sub_total'] + $details_data['master_data']['round_off'] - $details_data['master_data']['discount_amount']); ?></p>
                                </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td><strong><?php echo TAXNAME  ?> :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id="">
                                <p id="tbl_tax"><?php echo my_money_format($details_data['master_data']['tax_amount']); ?></p>
                            </td>
                        </tr>
                        <?php if ($details_data['master_data']['kit_name'] == '') { ?>
                            <tr>
                                <td><strong>Round Off (+ / -) :(<?php echo CURRENCY  ?>)</strong></td>
                                <td id="">
                                    <p id="tbl_round_off"><?php echo round($details_data['master_data']['round_off'], 2); ?> </p>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td><strong>Grand Total :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id="">
                                <p id="tbl_total" style="font-weight: bold;"><?php echo my_money_format($details_data['master_data']['final_total']); ?></p>
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

    function print_bill(billid) {
        var link = baseurl + 'uniform/bill-print-download/' + billid;
        window.open(link, '_blank');
    }

    function print_bill_demo(billid) {
        var link = baseurl + 'uniform/bill-print-other/' + billid;
        window.open(link, '_blank');
    }

    function cancel_bill(billid) {
        $("#bill_cancel_id").show();
    }

    function cancel_voucher(payment_id, bill_id) {
        $("#voucher_reason").val('');
        $("#voucher_cancel").show();
        $("#payment_id").val(payment_id);
        $("#bill_id").val(bill_id);
    }

    function submit_voucher_cancel() {
        var payment_id = $("#payment_id").val();
        var bill_id = $("#bill_id").val();
        var reason = $('#voucher_reason').val();
        if (reason == '') {
            swal('', ' Enter Reason for cancelling the voucher', 'info');
            return false;
        }

        var ops_url = baseurl + 'uniform/substore-voucher-cancel/voucher-cancel';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "billid": bill_id,
                "payment_id": payment_id,
                "reason": reason
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    uniform_bill_test();
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                }
            },
            error: function() {
                console.log(bill_id);
            }
        });
        return;
    }

    function submit_uniform_bill_cancel(billid) {
        var reason = $('#reason').val();
        if (reason == '') {
            swal('', ' Enter Reason for cancelling the Bill', 'info');
            return false;
        }
        var ops_url = baseurl + 'uniform/substore-bill-cancel/bill-cancel';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "billid": billid,
                "reason": reason
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    uniform_bill_test();
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                }
            },
            error: function() {
                console.log(billid);
            }
        });
        return;
    }
</script>