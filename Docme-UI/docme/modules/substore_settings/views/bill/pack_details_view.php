<style>
    table.ex2 {
        table-layout: absolute;
    }

    td {
        word-break: break-word;
    }

    th {
        word-break: break-word;
    }
</style>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Pack Details - <?php echo isset($barcode) && !empty($barcode) ? $barcode : ''; ?>
            </div>
            <div class="panel-body">
                <?php //dev_export($pack_data);
                //die; 
                ?>
                <div class="notes" style="padding-right:0px;margin-bottom: 10px; font-size:12px">
                    *Notes:
                    <span class="text-muted small">
                        'F' for Fixed discount and 'P' for Rate(%) discount.
                    </span>
                    <br>
                    <?php
                    $total_items = 0;
                    $total_sub_total = 0;
                    $total_vat_amount = 0;
                    $total_discount_amount = 0;
                    $grand_total = 0;
                    $total_roundoff = 0;
                    $item_data = array();
                    ?>
                    <div class="table m-t scroll_content" style="height: 250px !important;">
                        <table class="table ex2 invoice-table " style="width:99%">
                            <thead>
                                <tr>
                                    <th>Items Name</th>
                                    <th>Rate(<?php echo CURRENCY  ?>)</th>
                                    <th>Quantity</th>
                                    <th>Sub-Total (<?php echo CURRENCY  ?>)</th>
                                    <th>Discount</th>
                                    <th>Disc.Amt</th>
                                    <th>Sub After Discount</th>
                                    <th><?php echo TAXNAME  ?></th>
                                    <th><?php echo TAXNAME  ?> Amt.(<?php echo CURRENCY  ?>)</th>
                                    <th>Total(<?php echo CURRENCY  ?>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($details_data) && !empty($details_data)) {
                                    foreach ($details_data as $items) {
                                        $discount = 0;
                                        $vat_amt = 0;
                                ?>
                                        <?php if ($pack_data['order_type_id'] == 3) { ?>

                                            <tr>
                                                <td><strong><?php echo $items['item_name']; ?></strong></td>
                                                <td>
                                                    <?php echo '-' ?>
                                                    <input type="hidden" name="item_rate_<?php echo $items['item_id']; ?>" id="item_rate_<?php echo $items['item_id']; ?>" value="<?php echo $items['Rate']; ?>" />
                                                </td>
                                                <td>
                                                    <?php echo $items['qty']; ?>
                                                    <input type="hidden" name="item_qty_<?php echo $items['item_id']; ?>" id="item_qty_<?php echo $items['item_id']; ?>" value="<?php echo $items['qty']; ?>" />
                                                </td>
                                                <td>
                                                    <?php echo '-' ?>
                                                    <input type="hidden" name="sub_total_<?php echo $items['item_id']; ?>" id="sub_total_<?php echo $items['item_id']; ?>" value="<?php echo $items['sub_total']; ?>" />
                                                </td>
                                                <td>
                                                    <div style="display:none">
                                                        <input class="form-check-input" disabled="" style="margin:0 0 0 5px;" type="radio" name="gridRadios_<?php echo $items['item_id']; ?>" id="dis_rate_<?php echo $items['item_id']; ?>" value="1" checked>
                                                        Rate(%)
                                                        <input class="form-check-input" disabled="" style="margin:0 0 0 5px;" type="radio" name="gridRadios_<?php echo $items['item_id']; ?>" id="dis_fixed_<?php echo $items['item_id']; ?>" value="2">
                                                        Fixed
                                                        <br />
                                                        <div class=" input-group" style="width: 100px;">
                                                            <input type="text" readonly="" class="form-control" maxlength="6" data-submit="0" data-vatpercent="<?php echo $items['tax_percent']; ?>" style="background-color: white;" id="discount_<?php echo $items['item_id']; ?>" placeholder="" value="<?php echo isset($items['oh_discount']) ? $items['oh_discount'] : 0; ?>  ">
                                                            <p style="display:inline-block; padding: 0 0 0 5px"></p>
                                                            <span class="input-group-btn" style="padding-bottom: 18px;">
                                                                <button disabled="" id="discount_btn_<?php echo $items['item_id']; ?>" type="button" class="btn btn btn-primary" onclick="apply_discount('<?php echo $items['item_id']; ?>', '<?php echo $items['sub_total']; ?>', '<?php echo $items['tax_percent']; ?>');">Go</button>
                                                                <button disabled="" id="discount_btn_<?php echo $items['item_id']; ?>" type="button" class="btn btn btn-primary" onclick="remove_discount('<?php echo $items['item_id']; ?>', '<?php echo $items['sub_total']; ?>', '<?php echo $items['tax_percent']; ?>');"><i class="fa fa-trash"></i></button>
                                                            </span>
                                                            <input type="hidden" name="discount_amt_<?php echo $items['item_id']; ?>" id="discount_amt_<?php echo $items['item_id']; ?>" value="<?php echo ((isset($items['oh_discount']) ? $items['oh_discount'] : 0) * $items['sub_total']) / 100 ?>" />

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>

                                                    -
                                                    <?php
                                                    //                                                $discount = isset($items['discount']) ? $items['discount'] : 0;
                                                    $discount = ((isset($items['oh_discount']) ? $items['oh_discount'] : (isset($items['discount']) ? $items['discount'] : 0)) * $items['sub_total']) / 100;
                                                    $discount = ROUND($discount, 2);
                                                    ?>
                                                </td>
                                                <td>
                                                    -
                                                    <input type="hidden" id="sub_total_after_discount_value_<?php echo $items['item_id']; ?>" name="sub_total_after_discount_value_<?php echo $items['item_id']; ?>" value="<?php echo round($items['sub_total'] - $discount, 2, PHP_ROUND_HALF_UP); ?>" />
                                                </td>
                                                <td>
                                                    -
                                                </td>
                                                <td>
                                                    -
                                                    <input type="hidden" name="vat_<?php echo $items['item_id']; ?>" id="vat_<?php echo $items['item_id']; ?>" value="<?php echo $vat_amt; ?>" />
                                                </td>
                                                <td>
                                                    -
                                                    <input type="hidden" name="total_<?php echo $items['item_id']; ?>" id="total_<?php echo $items['item_id']; ?>" value="<?php echo round(round($items['sub_total'] - $discount, 2, PHP_ROUND_HALF_UP) + ($vat_amt), 2, PHP_ROUND_HALF_UP); ?>" />
                                                </td>
                                            </tr>

                                        <?php } else { ?>

                                            <tr>
                                                <td><strong><?php echo $items['item_name']; ?></strong></td>
                                                <td>
                                                    <?php echo my_money_format($items['Rate']); ?>
                                                    <input type="hidden" name="item_rate_<?php echo $items['item_id']; ?>" id="item_rate_<?php echo $items['item_id']; ?>" value="<?php echo $items['Rate']; ?>" />
                                                </td>
                                                <td>
                                                    <?php echo $items['qty']; ?>
                                                    <input type="hidden" name="item_qty_<?php echo $items['item_id']; ?>" id="item_qty_<?php echo $items['item_id']; ?>" value="<?php echo $items['qty']; ?>" />
                                                </td>
                                                <td>
                                                    <?php echo my_money_format($items['sub_total']); ?>
                                                    <input type="hidden" name="sub_total_<?php echo $items['item_id']; ?>" id="sub_total_<?php echo $items['item_id']; ?>" value="<?php echo $items['sub_total']; ?>" />
                                                </td>
                                                <td>
                                                    -
                                                    <div style="display:none">
                                                        <input class="form-check-input" disabled="" style="margin:0 0 0 5px;" type="radio" name="gridRadios_<?php echo $items['item_id']; ?>" id="dis_rate_<?php echo $items['item_id']; ?>" value="1" checked>
                                                        Rate(%)
                                                        <input class="form-check-input" disabled="" style="margin:0 0 0 5px;" type="radio" name="gridRadios_<?php echo $items['item_id']; ?>" id="dis_fixed_<?php echo $items['item_id']; ?>" value="2">
                                                        Fixed
                                                        <br />
                                                        <div class=" input-group" style="width: 100px;">
                                                            <input type="text" readonly="" class="form-control" maxlength="6" data-submit="0" data-vatpercent="<?php echo $items['tax_percent']; ?>" style="background-color: white;" id="discount_<?php echo $items['item_id']; ?>" placeholder="" value="<?php echo isset($items['oh_discount']) ? $items['oh_discount'] : 0; ?>  ">
                                                            <p style="display:inline-block; padding: 0 0 0 5px"></p>
                                                            <span class="input-group-btn" style="padding-bottom: 18px;">
                                                                <button disabled="" id="discount_btn_<?php echo $items['item_id']; ?>" type="button" class="btn btn btn-primary" onclick="apply_discount('<?php echo $items['item_id']; ?>', '<?php echo $items['sub_total']; ?>', '<?php echo $items['tax_percent']; ?>');">Go</button>
                                                                <button disabled="" id="discount_btn_<?php echo $items['item_id']; ?>" type="button" class="btn btn btn-primary" onclick="remove_discount('<?php echo $items['item_id']; ?>', '<?php echo $items['sub_total']; ?>', '<?php echo $items['tax_percent']; ?>');"><i class="fa fa-trash"></i></button>
                                                            </span>
                                                            <input type="hidden" name="discount_amt_<?php echo $items['item_id']; ?>" id="discount_amt_<?php echo $items['item_id']; ?>" value="<?php echo ((isset($items['oh_discount']) ? $items['oh_discount'] : 0) * $items['sub_total']) / 100 ?>" />

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>

                                                    <span id="discount_amt_display_<?php echo $items['item_id']; ?>"><?php echo ROUND(((isset($items['oh_discount']) ? $items['oh_discount'] : 0) * $items['sub_total']) / 100, 2) ?></span>
                                                    <?php
                                                    //                                                $discount = isset($items['discount']) ? $items['discount'] : 0;
                                                    $discount = ((isset($items['oh_discount']) ? $items['oh_discount'] : (isset($items['discount']) ? $items['discount'] : 0)) * $items['sub_total']) / 100;
                                                    $discount = ROUND($discount, 2);
                                                    ?>
                                                </td>
                                                <td>
                                                    <span id="sub_total_after_discount_<?php echo $items['item_id']; ?>"><?php echo my_money_format(round($items['sub_total'] - $discount, 2, PHP_ROUND_HALF_UP)); ?></span>
                                                    <input type="hidden" id="sub_total_after_discount_value_<?php echo $items['item_id']; ?>" name="sub_total_after_discount_value_<?php echo $items['item_id']; ?>" value="<?php echo round($items['sub_total'] - $discount, 2, PHP_ROUND_HALF_UP); ?>" />
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
                                                    <span id="current_vat_amt_<?php echo $items['item_id']; ?>">
                                                        <?php
                                                        if ($items['tax_type'] == 'P') {
                                                            echo $vat_amt = my_money_format(round(($items['sub_total'] - $discount) * $items['tax_percent'] / 100, 2, PHP_ROUND_HALF_UP));
                                                        } else {
                                                            echo $vat_amt = my_money_format(round($items['tax_percent'] * $items['qty'], 2, PHP_ROUND_HALF_UP));
                                                        }
                                                        ?>
                                                    </span>
                                                    <input type="hidden" name="vat_<?php echo $items['item_id']; ?>" id="vat_<?php echo $items['item_id']; ?>" value="<?php echo $vat_amt; ?>" />
                                                </td>
                                                <td>
                                                    <span id="cur_total_<?php echo $items['item_id']; ?>">
                                                        <?php echo my_money_format(round(round($items['sub_total'] - $discount, 2, PHP_ROUND_HALF_UP) + ($vat_amt), 2, PHP_ROUND_HALF_UP)); ?>
                                                    </span>
                                                    <input type="hidden" name="total_<?php echo $items['item_id']; ?>" id="total_<?php echo $items['item_id']; ?>" value="<?php echo round(round($items['sub_total'] - $discount, 2, PHP_ROUND_HALF_UP) + ($vat_amt), 2, PHP_ROUND_HALF_UP); ?>" />
                                                </td>
                                            </tr>

                                        <?php } ?>

                                <?php
                                        $total_items = $total_items + 1;
                                        $total_vat_amount = $total_vat_amount + $vat_amt;
                                        $total_sub_total = $total_sub_total + round($items['sub_total'], 2, PHP_ROUND_HALF_UP);
                                        $total_discount_amount = $total_discount_amount + $discount;
                                        $total_before_roundoff = round($total_sub_total + $total_vat_amount - $total_discount_amount, 2, PHP_ROUND_HALF_UP);
                                        $grand_total = round($total_sub_total + $total_vat_amount - $total_discount_amount, 0, PHP_ROUND_HALF_UP);
                                        $total_roundoff = $grand_total - ($total_sub_total + $total_vat_amount - $total_discount_amount);
                                        $total_roundoff = round($total_roundoff, 2);
                                        $item_data[] = $items['item_id'];
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <?php
                    if ($pack_data['order_type_id'] == 3) {

                        $pack_round_off = $pack_data['roundoff'];
                        $grand_total = $grand_total + $pack_round_off;
                        $total_roundoff = $pack_round_off;
                    }
                    ?>
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
                                <td>
                                    <?php if ($pack_data['order_type_id'] == 3) { ?>
                                        <p id="tbl_subtotal"><?php echo my_money_format($total_sub_total + $total_roundoff); ?></p>
                                    <?php } else { ?>
                                        <p id="tbl_subtotal"><?php echo my_money_format($total_sub_total); ?></p>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Total Discount Amount :(<?php echo CURRENCY  ?>)</strong></td>
                                <td id="">
                                    <p id="tbl_discount"><?php echo my_money_format($total_discount_amount); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Gross Total After Discount :(<?php echo CURRENCY  ?>)</strong></td>
                                <td>
                                    <?php if ($pack_data['order_type_id'] == 3) { ?>
                                        <p id="tbl_subtotal_after_discount"><?php echo my_money_format($total_sub_total + $total_roundoff - $total_discount_amount); ?></p>
                                    <?php } else { ?>
                                        <p id="tbl_subtotal_after_discount"><?php echo my_money_format($total_sub_total - $total_discount_amount); ?></p>
                                    <?php } ?>

                                </td>
                            </tr>
                            <tr>
                                <td><strong><?php echo TAXNAME  ?> :(<?php echo CURRENCY  ?>)</strong></td>
                                <td id="">
                                    <p id="tbl_tax"><?php echo my_money_format($total_vat_amount); ?></p>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Round Off (+ / -) :(<?php echo CURRENCY  ?>)</strong></td>
                                <td id="">
                                    <p id="tbl_round_off"><?php echo $pack_data['order_type_id'] == 3 ? '0.00' : ($total_roundoff); ?> </p>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Bill Total :(<?php echo CURRENCY  ?>)</strong></td>
                                <td id="">
                                    <p id="tbl_total" style="font-weight: bold;"><?php echo my_money_format($grand_total); ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    $max_payment_amount = $grand_total;
    if ($pack_data['is_partial_payment'] == 1) {
        $max_payment_amount = $pack_data['final_total'] - $pack_data['final_pay_amount'];
    ?>
        <?php
        if (!empty($payment_data)) { ?>
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Payment Details - <?php echo isset($barcode) && !empty($barcode) ? $barcode : ''; ?>
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
                            <input type="hidden" id="count" value="0">
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
                                foreach ($payment_data as $data) { ?>
                                    <tr>
                                        <td><?php echo $data['payment_billing_code'] ?></td>
                                        <td><?php echo my_money_format($data['paid_amount']) ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($data['payment_date'])) ?></td>
                                        <td>
                                            <?php if (date('Ymd', strtotime($data['payment_date'])) === date('Ymd') &&  $i == sizeof($payment_data)) { ?>
                                                <a data-toggle="tooltip" title="Cancel Bill : <?php echo $data['payment_billing_code']; ?>" onclick="cancel_voucher(<?php echo $data['id']; ?>,<?php echo $data['billing_master_id']; ?>,<?php echo $i ?>);"><i class="fa fa-trash-o"></i></a> &nbsp;&nbsp;
                                            <?php } ?>
                                            <a data-toggle="tooltip" title="Print Bill : <?php echo $data['payment_billing_code']; ?>" target="_blank" href="<?php echo base_url() ?>substore/bill-print-duplicate/<?php echo $data['payment_billing_code'] ?>"><i class="fa fa-file-pdf-o"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                } ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        <?php }
        ?>

    <?php } ?>

    <input type="hidden" name="total_items" id="total_items" value="<?php echo $total_items; ?>" />
    <input type="hidden" name="total_sub_total" id="total_sub_total" value="<?php echo $total_sub_total; ?>" />
    <input type="hidden" name="total_vat_amount" id="total_vat_amount" value="<?php echo $total_vat_amount; ?>" />
    <input type="hidden" name="total_discount_amount" id="total_discount_amount" value="<?php echo $total_discount_amount; ?>" />
    <input type="hidden" name="total_amount_before_roundoff" id="total_amount_before_roundoff" value="<?php echo $total_before_roundoff; ?>" />
    <input type="hidden" name="total_roundoff" id="total_roundoff" value="<?php echo $total_roundoff; ?>" />
    <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $grand_total; ?>" />
    <input type="hidden" name="max_payment_amount" id="max_payment_amount" value="<?php echo $max_payment_amount; ?>" />
    <?php if ($details_data[0]['is_payment_done'] == null && $del_payment_type == 0) {
        if ($pack_data['order_type_id'] != 3) {
            $payment_field_readonly = 'readonly=readonly';
        } else {
            $payment_field_readonly = '';
        }
    ?>
        <!-- <div class="row"> -->
        <div class="col-lg-12">
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
                                        <div class="col-md-12">
                                            <form role="form" id="payment-form-cheque">
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>Amount Total</label>
                                                        <input type="text" style="background-color: #FFFFFF;" maxlength="6" class="form-control digits" name="pay_amount" id="pay_amount" <?php echo $payment_field_readonly ?> value="<?php echo $max_payment_amount; ?>" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="cash_pay();">
                                                        <i class="fa fa-money"></i> Make Payment
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
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
                                        <div class="col-md-12">
                                            <form role="form" id="payment-form-cheque">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Cheque Number</label>
                                                        <input type="text" class="form-control" maxlength="10" name="ChequeNumber" id="ChequeNumber" placeholder="Cheque Number" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Cheque Date</label>
                                                        <input type="text" class="form-control" name="ChequeDate" readonly="" style="background-color:white;" id="ChequeDate" placeholder="Cheque Date" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Name of Drawer</label>
                                                        <input type="text" class="form-control" name="NameofDrawer" maxlength="100" id="NameofDrawer" placeholder="Name of Drawer" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Drawer Address</label>
                                                        <input type="text" class="form-control" name="DrawerAddress" id="DrawerAddress" placeholder="Drawer Address" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Name of Bank</label>
                                                        <input type="text" class="form-control" name="NameofBank" maxlength="30" id="NameofBank" placeholder="Name of Bank" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Bank Branch</label>
                                                        <input type="text" class="form-control" name="BranchBank" maxlength="25" id="BranchBank" placeholder="Bank Branch" />
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group ">
                                                        <label>Amount Total</label>
                                                        <input type="text" style="background-color: #FFFFFF;" maxlength="6" class="form-control digits" name="pay_amount1" id="pay_amount1" <?php echo $payment_field_readonly ?> value="<?php echo $max_payment_amount; ?>" />
                                                    </div>
                                                </div>
                                                <!-- </div> -->

                                                <!-- <div class="col-xs-12"> -->
                                                <div class="row">
                                                    <a class="btn btn-info" id="cheque_pay_btn" style="margin-left:30px;" href="javascript:void(0)" onclick="cheque_pay();">
                                                        <i class="fa fa-money"></i> Make Payment
                                                    </a>
                                                </div>
                                                <!-- </div> -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <i class="fa fa-cc-amex text-success"></i>
                                    <i class="fa fa-cc-mastercard text-warning"></i>
                                    <i class="fa fa-cc-discover text-danger"></i>
                                </div>
                                <h5 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Card Payment</a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form role="form" id="payment-form-card">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Card Number</label>
                                                        <input type="text" id="CardNumber" name="CardNumber" class="form-control" data-mask="XXXX-XXXX-XXXX-9999" placeholder="Card Number">
                                                        <!--                                                            <input type="number" class="form-control" name="CardNumber" maxlength="16" id="CardNumber" placeholder="Enter Card Number"/>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name as on Card</label>
                                                        <input type="text" class="form-control" name="NameOfCard" id="NameOfCard" placeholder="Name as on Card" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>Amount Total</label>
                                                        <input type="text" style="background-color: #FFFFFF;" maxlength="6" class="form-control digits" name="pay_amount2" id="pay_amount2" <?php echo $payment_field_readonly ?> value="<?php echo $max_payment_amount; ?>" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <a class="btn btn-info" id="card_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="card_pay();">
                                                        <i class="fa fa-money"></i> Make Payment
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <i class="fa fa-bank text-info"></i>
                                </div>
                                <h5 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Direct Bank Transfer</a>
                                </h5>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form role="form" id="payment-form-card">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Payment Reference</label>
                                                        <input type="text" class="form-control alphanumeric" maxlength="10" name="payment_reference" id="payment_reference" placeholder="Payment Reference" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Payment Date</label>
                                                        <input type="text" class="form-control" readonly maxlength="10" name="dbt_date" id="dbt_date" placeholder="Payment Date" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label>Amount Total</label>
                                                        <input type="text" style="background-color: #FFFFFF;" maxlength="6" class="form-control digits" name="pay_amount3" id="pay_amount3" <?php echo $payment_field_readonly ?> value="<?php echo $max_payment_amount; ?>" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <a class="btn btn-info" id="dbt_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="dbt_pay();">
                                                        <i class="fa fa-money"></i> Make Payment
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
        <!-- </div> -->
    <?php } ?>
</div>
<input type="hidden" id="std_id" name="std_id" value="<?php echo $std_id ?>">
<input type="hidden" id="pack_id" name="pack_id" value="<?php echo $pack_id ?>">
<input type="hidden" id="itemdata_holder" name="itemdata_holder" value="<?php echo json_encode($item_data); ?>">

<script type="text/javascript">
    $('.scroll_content').slimscroll({
        height: '250px',
        color: '#f8ac59',
        alwaysVisible: true
    });
    $(document).ready(function() {
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        $(function() {
            $("#ChequeNumber").bind("keypress", function(e) {
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
                $(".error").css("display", ret ? "none" : "inline");
                return ret;
            });
            $("#ChequeNumber").bind("paste", function(e) {
                return false;
            });
            $("#ChequeNumber").bind("drop", function(e) {
                return false;
            });
        });
    });
    $('#ChequeDate').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $('#dbt_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        endDate: '0',
        format: "dd-mm-yyyy"
    });
    //    moment($("#ChequeDate").datepicker("getDate")).format('YYYY-MM-DD');
    function apply_discount(item_id, sub_total, vat) {
        var disc_type_name_raw = "input[name=gridRadios_" + item_id + "]:checked";
        var selected_disc_type = $(disc_type_name_raw).val();

        var discount_id = '#discount_' + item_id;

        var test_discount_val = $(discount_id).val().trim();

        var RE = /^\d*\.?\d*$/;
        if (!RE.test(test_discount_val)) {
            swal('', "Enter a valid discount value", 'info');
            return true;
        }

        var discount_value = parseFloat($(discount_id).val().trim()).toFixed(2);


        var discount_amt = 0;

        var sub_total_value = parseFloat(sub_total).toFixed(2);

        if (selected_disc_type == 1) {
            if (parseFloat(discount_value) > 100) {
                swal('', 'Discount cannot be greater than 100%');
                return false;
            }
            discount_amt = parseFloat(parseFloat(sub_total_value * discount_value / 100).toFixed(2));
        } else {

            if (parseFloat(discount_value) > parseFloat(sub_total)) {
                swal('', 'Discount cannot be greater than sub total');
                return false;
            }
            discount_amt = parseFloat(parseFloat(discount_value).toFixed(2));
        }

        var indv_discount = discount_amt;
        $(discount_id).val(discount_value);

        var new_sub_total = sub_total - discount_amt;
        var new_tax = parseFloat(parseFloat(new_sub_total * vat / 100).toFixed(2));
        var new_total = parseFloat(parseFloat(new_sub_total).toFixed(2)) + parseFloat(parseFloat(new_tax).toFixed(2));



        var prev_total_sub_total = parseFloat(parseFloat($('#total_sub_total').val()).toFixed(2));
        var prev_total_vat_amount = parseFloat(parseFloat($('#total_vat_amount').val()).toFixed(2));
        var prev_total_discount_amount = parseFloat(parseFloat($('#total_discount_amount').val()).toFixed(2));
        var prev_grand_total_b4roundoff = parseFloat(parseFloat($('#total_amount_before_roundoff').val()).toFixed(2));
        var roundoff = parseFloat($('#total_roundoff').val());
        var prev_grand_total = prev_grand_total_b4roundoff;

        //alert(prev_grand_total);



        var cur_vat_amt = parseFloat(parseFloat($('#vat_' + item_id).val()).toFixed(2));
        var cur_discount_amt = parseFloat(parseFloat($('#discount_indv_' + item_id).val()).toFixed(2));
        var cur_total_amt = parseFloat(parseFloat($('#total_' + item_id).val()).toFixed(2));





        var vat_amt_before_transfer = prev_total_vat_amount - cur_vat_amt;
        var discount_before_transfer = prev_total_discount_amount - cur_discount_amt;
        var total_before_transfer = prev_grand_total - cur_total_amt;


        var new_discount_amt = discount_before_transfer + discount_amt;
        var new_vat_amt = vat_amt_before_transfer + new_tax;
        var new_total_final_b4_roundoff = total_before_transfer + new_total;
        var roundoff = parseInt(new_total_final_b4_roundoff) - new_total_final_b4_roundoff;
        //alert(new_total_final_b4_roundoff);
        //alert(roundoff);
        roundoff = parseFloat(parseFloat(roundoff).toFixed(2));




        $('#discount_indv_' + item_id).val(indv_discount);

        $('#sub_total_after_discount_' + item_id).html(new_sub_total);
        $('#sub_total_after_discount_value_' + item_id).val(new_sub_total);
        $('#discount_amt_display_' + item_id).html(indv_discount);
        $('#current_vat_amt_' + item_id).html(new_tax);
        $('#vat_' + item_id).val(new_tax);
        $('#total_' + item_id).val(new_total);
        $('#cur_total_' + item_id).html(new_total);

        $('#tbl_discount').html(new_discount_amt);
        $('#tbl_subtotal_after_discount').html((prev_total_sub_total - new_discount_amt));
        $('#tbl_tax').html(new_vat_amt);
        $('#tbl_round_off').html(roundoff);
        $('#tbl_total').html(parseFloat(new_total_final_b4_roundoff).toFixed(0));

        $('#total_vat_amount').val(new_vat_amt);
        $('#total_discount_amount').val(new_discount_amt);
        $('#total_roundoff').val(roundoff);
        $('#total_amount_before_roundoff').val(parseFloat(new_total_final_b4_roundoff).toFixed(2));
        $('#grand_total').val(parseFloat(parseFloat(new_total_final_b4_roundoff).toFixed(0)));

        $('#discount_' + item_id).attr('disabled', true);
        $('#dis_rate_' + item_id).prop('disabled', true);
        $('#dis_fixed_' + item_id).prop('disabled', true);

        $('#pay_amount').val(parseFloat(parseFloat(new_total_final_b4_roundoff).toFixed(0)));
        $('#pay_amount1').val(parseFloat(parseFloat(new_total_final_b4_roundoff).toFixed(0)));
        $('#pay_amount2').val(parseFloat(parseFloat(new_total_final_b4_roundoff).toFixed(0)));

        $('#discount_' + item_id).data('submit', 1);


    }

    function remove_discount(item_id, sub_total, vat) {
        var disc_type_name_raw = "input[name=gridRadios_" + item_id + "]:checked";
        var selected_disc_type = $(disc_type_name_raw).val();

        var discount_id = '#discount_' + item_id;

        $(discount_id).val('0.00');

        var test_discount_val = $(discount_id).val().trim();

        var RE = /^\d*\.?\d*$/;
        if (!RE.test(test_discount_val)) {
            swal('', "Enter a valid discount value", 'info');
            return true;
        }

        var discount_value = parseFloat($(discount_id).val().trim()).toFixed(2);


        var discount_amt = 0;

        var sub_total_value = parseFloat(sub_total).toFixed(2);

        if (selected_disc_type == 1) {
            if (discount_value > 100) {
                swal('', 'Discount cannot be greater than 100%', 'info');
                return false;
            }
            discount_amt = parseFloat(parseFloat(sub_total_value * discount_value / 100).toFixed(2));
        } else {
            if (discount_value > sub_total) {
                swal('', 'Discount cannot be greater than sub total', 'info');
                return false;
            }
            discount_amt = parseFloat(parseFloat(discount_value).toFixed(2));
        }

        var indv_discount = discount_amt;
        $(discount_id).val(discount_value);

        var new_sub_total = sub_total - discount_amt;
        var new_tax = parseFloat(parseFloat(new_sub_total * vat / 100).toFixed(2));
        var new_total = parseFloat(parseFloat(new_sub_total).toFixed(2)) + parseFloat(parseFloat(new_tax).toFixed(2));



        var prev_total_sub_total = parseFloat(parseFloat($('#total_sub_total').val()).toFixed(2));
        var prev_total_vat_amount = parseFloat(parseFloat($('#total_vat_amount').val()).toFixed(2));
        var prev_total_discount_amount = parseFloat(parseFloat($('#total_discount_amount').val()).toFixed(2));
        var prev_grand_total_b4roundoff = parseFloat(parseFloat($('#total_amount_before_roundoff').val()).toFixed(2));
        var roundoff = parseFloat($('#total_roundoff').val());
        var prev_grand_total = prev_grand_total_b4roundoff;






        var cur_vat_amt = parseFloat(parseFloat($('#vat_' + item_id).val()).toFixed(2));
        var cur_discount_amt = parseFloat(parseFloat($('#discount_indv_' + item_id).val()).toFixed(2));
        var cur_total_amt = parseFloat(parseFloat($('#total_' + item_id).val()).toFixed(2));





        var vat_amt_before_transfer = prev_total_vat_amount - cur_vat_amt;
        var discount_before_transfer = prev_total_discount_amount - cur_discount_amt;
        var total_before_transfer = prev_grand_total - cur_total_amt;


        var new_discount_amt = discount_before_transfer + discount_amt;
        var new_vat_amt = vat_amt_before_transfer + new_tax;
        var new_total_final_b4_roundoff = total_before_transfer + new_total;
        var roundoff = parseInt(new_total_final_b4_roundoff) - new_total_final_b4_roundoff;
        roundoff = parseFloat(parseFloat(roundoff).toFixed(2));




        $('#discount_indv_' + item_id).val(indv_discount);

        $('#sub_total_after_discount_' + item_id).html(new_sub_total);
        $('#sub_total_after_discount_value_' + item_id).val(new_sub_total);
        $('#discount_amt_display_' + item_id).html(indv_discount);
        $('#current_vat_amt_' + item_id).html(new_tax);
        $('#vat_' + item_id).val(new_tax);
        $('#total_' + item_id).val(new_total);
        $('#cur_total_' + item_id).html(new_total);

        $('#tbl_discount').html(new_discount_amt);
        $('#tbl_subtotal_after_discount').html((prev_total_sub_total - new_discount_amt));
        $('#tbl_tax').html(new_vat_amt);
        $('#tbl_round_off').html(roundoff);
        $('#tbl_total').html(parseFloat(new_total_final_b4_roundoff).toFixed(0));

        $('#total_vat_amount').val(new_vat_amt);
        $('#total_discount_amount').val(new_discount_amt);
        $('#total_roundoff').val(roundoff);
        $('#total_amount_before_roundoff').val(parseFloat(new_total_final_b4_roundoff).toFixed(2));
        $('#grand_total').val(parseFloat(parseFloat(new_total_final_b4_roundoff).toFixed(0)));

        $('#discount_' + item_id).attr('disabled', false);
        $('#dis_rate_' + item_id).prop('disabled', false);
        $('#dis_fixed_' + item_id).prop('disabled', false);

        $('#pay_amount').val(parseFloat(parseFloat(new_total_final_b4_roundoff).toFixed(0)));
        $('#pay_amount1').val(parseFloat(parseFloat(new_total_final_b4_roundoff).toFixed(0)));
        $('#pay_amount2').val(parseFloat(parseFloat(new_total_final_b4_roundoff).toFixed(0)));

        $('#discount_' + item_id).data('submit', 0);
    }

    function cash_pay() {
        $('#cash_pay_btn').prop('disabled', true);
        var payment_mode = 1;
        var final_sub_total = $('#total_sub_total').val();
        var final_discount = $('#total_discount_amount').val();
        var final_vat = $('#total_vat_amount').val();
        var final_total_before_round_off = $('#total_amount_before_roundoff').val();
        var final_round_off = $('#total_roundoff').val();
        var grand_total = $('#grand_total').val();
        var max_payment_amount = parseInt($('#max_payment_amount').val());
        var pay_amount = $('#pay_amount').val();

        if (pay_amount <= 0) {
            swal('', 'Payment Amount should be greater than 0', 'info');
            return false;
        }
        if (pay_amount > max_payment_amount) {
            swal('', 'Payment Amount should be less than or equal to ' + max_payment_amount, 'info');
            return false;
        }

        var item_data_raw = $('#itemdata_holder').val();
        var item_data = JSON.parse(item_data_raw);
        var individual_discount = [];
        var is_discount = 0;
        $.each(item_data, function(i, v) {
            var temp_submit = $('#discount_' + v).data('submit');
            var discount_type = 'P';
            var discount_value = $('#discount_' + v).val();
            var discount_amt = $('#discount_amt_' + v).val();

            var sub_total = $('#sub_total_' + v).val();

            var sub_total_after_discount = $('#sub_total_after_discount_value_' + v).val();
            var vat_percent = $('#discount_' + v).data('vatpercent');

            var vat_for_sub_total = $('#vat_' + v).val();
            var final_total = $('#total_' + v).val();
            var quantity = $('#item_qty_' + v).val();
            var rate = $('#item_rate_' + v).val();
            if (temp_submit == 1) {
                is_discount = 1;
                var disc_type_name_raw = "input[name=gridRadios_" + v + "]:checked";
                var selected_disc_type = $(disc_type_name_raw).val();
                if (selected_disc_type == 1) {
                    discount_type = 'P';
                } else {
                    discount_type = 'F';
                }
                individual_discount.push({
                    "itemid": v,
                    "quantity": quantity,
                    "rate": rate,
                    "sub_total": sub_total,
                    "discount_type": discount_type,
                    "discount_value": discount_value,
                    "discount_amt": discount_amt,
                    "sub_total_after_discount": sub_total_after_discount,
                    "vat_type": "P",
                    "vat_percent": vat_percent,
                    "vat_after_discount": vat_for_sub_total,
                    "final_total": final_total
                });
            } else {
                individual_discount.push({
                    "itemid": v,
                    "quantity": quantity,
                    "rate": rate,
                    "sub_total": sub_total,
                    "discount_type": discount_type,
                    "discount_value": discount_value,
                    "discount_amt": discount_amt,
                    "sub_total_after_discount": sub_total_after_discount,
                    "vat_type": "P",
                    "vat_percent": vat_percent,
                    "vat_after_discount": vat_for_sub_total,
                    "final_total": final_total
                });
            }
        });

        var pack_id = $('#pack_id').val();
        var std_id = $('#std_id').val();

        if (final_vat == 0) {
            var is_tax = 0;
        } else {
            var is_tax = 1;
        }

        var cash_billing = new Object();
        cash_billing.payment_mode_id = payment_mode;
        cash_billing.sub_total = final_sub_total;
        cash_billing.is_discount = is_discount;
        cash_billing.discount_percent = 0;
        cash_billing.discount_amount = final_discount;
        cash_billing.is_tax = is_tax;
        cash_billing.tax_amount = final_vat;
        cash_billing.total_amount = final_total_before_round_off;
        cash_billing.round_off = final_round_off;
        cash_billing.final_amount = grand_total;
        cash_billing.is_ecash = 0;
        cash_billing.ecash_id = 0;
        cash_billing.ecash_amount = 0;
        cash_billing.final_payment_amount = pay_amount;
        cash_billing.is_payment_done = 1;

        var cashbilldata = JSON.stringify(cash_billing);
        var item_data = JSON.stringify(individual_discount);

        var ops_url = baseurl + 'substore-bill-pay/pay-cash-amount';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pack_id": pack_id,
                "std_id": std_id,
                "cashbilldata": cashbilldata,
                "item_data": item_data
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    $('#cash_pay_btn').prop('disabled', true);
                    //                    if (data.bill_link) {
                    //                        window.open(data.bill_link, '_blank');
                    //                    }
                    if (data.bill_code) {
                        var link = baseurl + 'substore/bill-print-other/' + data.bill_code;
                        window.open(link, '_blank');
                    }
                    bill_test();
                    $('#cash_pay_btn').prop('disabled', true);
                } else {
                    otherflag = 0;
                }
            },
            error: function() {
                console.log(cash_billing);
                otherflag = 0;
            }
        });
        $('#cash_pay_btn').prop('disabled', true);
        return;
    }



    function cheque_pay() {
        $('#cheque_pay_btn').prop('disabled', true);
        var ChequeNumber = $('#ChequeNumber').val();
        //        var ChequeDate = $('#ChequeDate').val();
        var ChequeDate = moment($("#ChequeDate").datepicker("getDate")).format('MM-DD-YYYY');
        var NameofDrawer = $('#NameofDrawer').val();
        var DrawerAddress = $('#DrawerAddress').val();
        var bank_name = $('#NameofBank').val();
        var branch_name = $('#BranchBank').val();
        var std_id = $('#std_id').val();
        var pack_id = $('#pack_id').val();
        if (ChequeNumber.length == 0) {
            swal('', 'Enter Cheque Number ', 'info');
            return false;
        }
        if (ChequeDate.length == 0) {
            swal('', 'Enter Cheque Date ', 'info');
            return false;
        }
        if (ChequeDate == 'Invalid date') {
            swal('', 'Enter Cheque Date ', 'info');
            return false;
        }
        if (NameofDrawer.length == 0) {
            swal('', 'Enter Name of Drawer ', 'info');
            return false;
        }
        if (DrawerAddress.length == 0) {
            swal('', 'Enter Drawer Address ', 'info');
            return false;
        }
        if (bank_name.length == 0) {
            swal('', 'Enter Name of Bank ', 'info');
            return false;
        }
        if (branch_name.length == 0) {
            swal('', 'Enter Branch of Bank ', 'info');
            return false;
        }


        var payment_mode = 2;
        var final_sub_total = $('#total_sub_total').val();
        var final_discount = $('#total_discount_amount').val();
        var final_vat = $('#total_vat_amount').val();
        var final_total_before_round_off = $('#total_amount_before_roundoff').val();
        var final_round_off = $('#total_roundoff').val();
        var grand_total = $('#grand_total').val();
        var max_payment_amount = parseInt($('#max_payment_amount').val());
        var pay_amount = $('#pay_amount1').val();

        if (pay_amount <= 0) {
            swal('', 'Payment Amount should be greater than 0', 'info');
            return false;
        }
        if (pay_amount > max_payment_amount) {
            swal('', 'Payment Amount should be less than or equal to ' + max_payment_amount, 'info');
            return false;
        }

        var item_data_raw = $('#itemdata_holder').val();
        var item_data = JSON.parse(item_data_raw);
        var individual_discount = [];
        var is_discount = 0;
        $.each(item_data, function(i, v) {
            var temp_submit = $('#discount_' + v).data('submit');
            var discount_type = 'P';
            var discount_value = $('#discount_' + v).val();
            var discount_amt = $('#discount_amt_' + v).val();

            var sub_total = $('#sub_total_' + v).val();

            var sub_total_after_discount = $('#sub_total_after_discount_value_' + v).val();
            var vat_percent = $('#discount_' + v).data('vatpercent');

            var vat_for_sub_total = $('#vat_' + v).val();
            var final_total = $('#total_' + v).val();
            var quantity = $('#item_qty_' + v).val();
            var rate = $('#item_rate_' + v).val();
            if (temp_submit == 1) {
                is_discount = 1;
                var disc_type_name_raw = "input[name=gridRadios_" + v + "]:checked";
                var selected_disc_type = $(disc_type_name_raw).val();
                if (selected_disc_type == 1) {
                    discount_type = 'P';
                } else {
                    discount_type = 'F';
                }

                individual_discount.push({
                    "itemid": v,
                    "quantity": quantity,
                    "rate": rate,
                    "sub_total": sub_total,
                    "discount_type": discount_type,
                    "discount_value": discount_value,
                    "discount_amt": discount_amt,
                    "sub_total_after_discount": sub_total_after_discount,
                    "vat_type": "P",
                    "vat_percent": vat_percent,
                    "vat_after_discount": vat_for_sub_total,
                    "final_total": final_total
                });
            } else {
                individual_discount.push({
                    "itemid": v,
                    "quantity": quantity,
                    "rate": rate,
                    "sub_total": sub_total,
                    "discount_type": discount_type,
                    "discount_value": discount_value,
                    "discount_amt": discount_amt,
                    "sub_total_after_discount": sub_total_after_discount,
                    "vat_type": "P",
                    "vat_percent": vat_percent,
                    "vat_after_discount": vat_for_sub_total,
                    "final_total": final_total
                });
            }
        });


        if (final_vat == 0) {
            var is_tax = 0;
        } else {
            var is_tax = 1;
        }


        var cash_billing = new Object();
        cash_billing.payment_mode_id = payment_mode;
        cash_billing.sub_total = final_sub_total;
        cash_billing.is_discount = is_discount;
        cash_billing.discount_percent = 0;
        cash_billing.discount_amount = final_discount;
        cash_billing.is_tax = is_tax;
        cash_billing.tax_amount = final_vat;
        cash_billing.total_amount = final_total_before_round_off;
        cash_billing.round_off = final_round_off;
        cash_billing.final_amount = grand_total;
        cash_billing.is_ecash = 0;
        cash_billing.ecash_id = 0;
        cash_billing.ecash_amount = 0;
        cash_billing.final_payment_amount = pay_amount;
        cash_billing.is_payment_done = 1;
        cash_billing.cheque_number = ChequeNumber;
        cash_billing.cheque_date = ChequeDate;
        cash_billing.name_of_drawee = NameofDrawer;
        cash_billing.drawee_address = DrawerAddress;
        cash_billing.bank_name = bank_name;
        cash_billing.branch_name = branch_name;
        var otherflag = 0;

        var cashbilldata = JSON.stringify(cash_billing);
        var item_data = JSON.stringify(individual_discount);

        var ops_url = baseurl + 'substore-bill-pay/pay-cheque-amount';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pack_id": pack_id,
                "std_id": std_id,
                "cashbilldata": cashbilldata,
                "item_data": item_data
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    //                    if (data.bill_link) {
                    //                        window.open(data.bill_link, '_blank');
                    //                    }
                    if (data.bill_code) {
                        var link = baseurl + 'substore/bill-print-other/' + data.bill_code;
                        window.open(link, '_blank');
                    }
                    bill_test();
                } else {
                    otherflag = 0;
                }
            },
            error: function() {
                console.log(cash_billing);
                otherflag = 0;
            }
        });
        $('#cheque_pay_btn').prop('disabled', false);
        return;
    }

    function card_pay() {
        $('#card_pay_btn').prop('disabled', true);
        var payment_mode = 3;
        var final_sub_total = $('#total_sub_total').val();
        var final_discount = $('#total_discount_amount').val();
        var final_vat = $('#total_vat_amount').val();
        var final_total_before_round_off = $('#total_amount_before_roundoff').val();
        var final_round_off = $('#total_roundoff').val();
        var grand_total = $('#grand_total').val();
        var max_payment_amount = parseInt($('#max_payment_amount').val());
        var pay_amount = $('#pay_amount2').val();

        if (pay_amount <= 0) {
            swal('', 'Payment Amount should be greater than 0', 'info');
            return false;
        }
        if (pay_amount > max_payment_amount) {
            swal('', 'Payment Amount should be less than or equal to ' + max_payment_amount, 'info');
            return false;
        }

        var NameOfCard = $('#NameOfCard').val();
        var CardNumber = $("#CardNumber").val().substring(15, 19)
        var alphanumeric = /^[a-zA-Z\s]+$/;
        if (CardNumber.length == 0) {
            swal('', 'Enter Card Number ', 'info');
            return false;
        }
        if (!(Math.floor(CardNumber) == CardNumber && $.isNumeric(CardNumber))) {
            swal('', ' Enter valid Card Number ', 'info');
            return false;
        }
        if (CardNumber.length != 4) {
            swal('', ' Enter valid last 4 digit Card Number ', 'info');
            return false;
        }


        if (NameOfCard.length == 0) {
            swal('', 'Enter Card Name ', 'info');
            return false;
        }
        if (!alphanumeric.test(NameOfCard)) {
            swal('', 'Card Name consist only alphabets ', 'info');
            return false;
        }

        var item_data_raw = $('#itemdata_holder').val();
        var item_data = JSON.parse(item_data_raw);
        var individual_discount = [];
        var is_discount = 0;
        $.each(item_data, function(i, v) {
            var temp_submit = $('#discount_' + v).data('submit');
            var discount_type = 'P';
            var discount_value = $('#discount_' + v).val();
            var discount_amt = $('#discount_amt_' + v).val();

            var sub_total = $('#sub_total_' + v).val();

            var sub_total_after_discount = $('#sub_total_after_discount_value_' + v).val();
            var vat_percent = $('#discount_' + v).data('vatpercent');

            var vat_for_sub_total = $('#vat_' + v).val();
            var final_total = $('#total_' + v).val();
            var quantity = $('#item_qty_' + v).val();
            var rate = $('#item_rate_' + v).val();
            if (temp_submit == 1) {
                is_discount = 1;
                var disc_type_name_raw = "input[name=gridRadios_" + v + "]:checked";
                var selected_disc_type = $(disc_type_name_raw).val();
                if (selected_disc_type == 1) {
                    discount_type = 'P';
                } else {
                    discount_type = 'F';
                }

                individual_discount.push({
                    "itemid": v,
                    "quantity": quantity,
                    "rate": rate,
                    "sub_total": sub_total,
                    "discount_type": discount_type,
                    "discount_value": discount_value,
                    "discount_amt": discount_amt,
                    "sub_total_after_discount": sub_total_after_discount,
                    "vat_type": "P",
                    "vat_percent": vat_percent,
                    "vat_after_discount": vat_for_sub_total,
                    "final_total": final_total
                });
            } else {
                individual_discount.push({
                    "itemid": v,
                    "quantity": quantity,
                    "rate": rate,
                    "sub_total": sub_total,
                    "discount_type": discount_type,
                    "discount_value": discount_value,
                    "discount_amt": discount_amt,
                    "sub_total_after_discount": sub_total_after_discount,
                    "vat_type": "P",
                    "vat_percent": vat_percent,
                    "vat_after_discount": vat_for_sub_total,
                    "final_total": final_total
                });
            }
        });

        var pack_id = $('#pack_id').val();
        var std_id = $('#std_id').val();

        if (final_vat == 0) {
            var is_tax = 0;
        } else {
            var is_tax = 1;
        }

        //            var CardNumber = $('#CardNumber').val();


        var cash_billing = new Object();
        cash_billing.payment_mode_id = payment_mode;
        cash_billing.sub_total = final_sub_total;
        cash_billing.is_discount = is_discount;
        cash_billing.discount_percent = 0;
        cash_billing.discount_amount = final_discount;
        cash_billing.is_tax = is_tax;
        cash_billing.tax_amount = final_vat;
        cash_billing.total_amount = final_total_before_round_off;
        cash_billing.round_off = final_round_off;
        cash_billing.final_amount = grand_total;
        cash_billing.is_ecash = 0;
        cash_billing.ecash_id = 0;
        cash_billing.ecash_amount = 0;
        cash_billing.final_payment_amount = pay_amount;
        cash_billing.is_payment_done = 1;
        cash_billing.card_number = CardNumber;
        cash_billing.name_on_card = NameOfCard;
        var otherflag = 0;
        var cashbilldata = JSON.stringify(cash_billing);
        var item_data = JSON.stringify(individual_discount);

        var ops_url = baseurl + 'substore-bill-pay/pay-cheque-amount';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pack_id": pack_id,
                "std_id": std_id,
                "cashbilldata": cashbilldata,
                "item_data": item_data
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    //                    if (data.bill_link) {
                    //                        window.open(data.bill_link, '_blank');
                    //                    }
                    if (data.bill_code) {
                        var link = baseurl + 'substore/bill-print-other/' + data.bill_code;
                        window.open(link, '_blank');
                    }
                    bill_test();
                } else {
                    otherflag = 0;
                }
            },
            error: function() {
                console.log(cash_billing);
                otherflag = 0;
            }
        });
        $('#card_pay_btn').prop('disabled', false);
        return;
    }

    function dbt_pay() {
        $('#dbt_pay_btn').prop('disabled', true);
        var payment_mode = 7;
        var final_sub_total = $('#total_sub_total').val();
        var final_discount = $('#total_discount_amount').val();
        var final_vat = $('#total_vat_amount').val();
        var final_total_before_round_off = $('#total_amount_before_roundoff').val();
        var final_round_off = $('#total_roundoff').val();
        var grand_total = $('#grand_total').val();
        var max_payment_amount = parseInt($('#max_payment_amount').val());
        var pay_amount = $('#pay_amount3').val();

        if (pay_amount <= 0) {
            swal('', 'Payment Amount should be greater than 0', 'info');
            return false;
        }
        if (pay_amount > max_payment_amount) {
            swal('', 'Payment Amount should be less than or equal to ' + max_payment_amount, 'info');
            return false;
        }

        var payment_reference = $('#payment_reference').val();
        var payment_date = moment($("#dbt_date").datepicker("getDate")).format('MM-DD-YYYY');

        if (payment_reference.length == 0) {
            swal('', 'Enter Payment Reference', 'info');
            return false;
        }
        if (payment_date == 'Invalid date') {
            swal('', 'Enter valid Payment Date ', 'info');
            return false;
        }

        var item_data_raw = $('#itemdata_holder').val();
        var item_data = JSON.parse(item_data_raw);
        var individual_discount = [];
        var is_discount = 0;
        $.each(item_data, function(i, v) {
            var temp_submit = $('#discount_' + v).data('submit');
            var discount_type = 'P';
            var discount_value = $('#discount_' + v).val();
            var discount_amt = $('#discount_amt_' + v).val();

            var sub_total = $('#sub_total_' + v).val();

            var sub_total_after_discount = $('#sub_total_after_discount_value_' + v).val();
            var vat_percent = $('#discount_' + v).data('vatpercent');

            var vat_for_sub_total = $('#vat_' + v).val();
            var final_total = $('#total_' + v).val();
            var quantity = $('#item_qty_' + v).val();
            var rate = $('#item_rate_' + v).val();
            if (temp_submit == 1) {
                is_discount = 1;
                var disc_type_name_raw = "input[name=gridRadios_" + v + "]:checked";
                var selected_disc_type = $(disc_type_name_raw).val();
                if (selected_disc_type == 1) {
                    discount_type = 'P';
                } else {
                    discount_type = 'F';
                }
                individual_discount.push({
                    "itemid": v,
                    "quantity": quantity,
                    "rate": rate,
                    "sub_total": sub_total,
                    "discount_type": discount_type,
                    "discount_value": discount_value,
                    "discount_amt": discount_amt,
                    "sub_total_after_discount": sub_total_after_discount,
                    "vat_type": "P",
                    "vat_percent": vat_percent,
                    "vat_after_discount": vat_for_sub_total,
                    "final_total": final_total
                });
            } else {
                individual_discount.push({
                    "itemid": v,
                    "quantity": quantity,
                    "rate": rate,
                    "sub_total": sub_total,
                    "discount_type": discount_type,
                    "discount_value": discount_value,
                    "discount_amt": discount_amt,
                    "sub_total_after_discount": sub_total_after_discount,
                    "vat_type": "P",
                    "vat_percent": vat_percent,
                    "vat_after_discount": vat_for_sub_total,
                    "final_total": final_total
                });
            }
        });

        var pack_id = $('#pack_id').val();
        var std_id = $('#std_id').val();

        if (final_vat == 0) {
            var is_tax = 0;
        } else {
            var is_tax = 1;
        }



        var cash_billing = new Object();
        cash_billing.payment_mode_id = payment_mode;
        cash_billing.sub_total = final_sub_total;
        cash_billing.is_discount = is_discount;
        cash_billing.discount_percent = 0;
        cash_billing.discount_amount = final_discount;
        cash_billing.is_tax = is_tax;
        cash_billing.tax_amount = final_vat;
        cash_billing.total_amount = final_total_before_round_off;
        cash_billing.round_off = final_round_off;
        cash_billing.final_amount = grand_total;
        cash_billing.is_ecash = 0;
        cash_billing.ecash_id = 0;
        cash_billing.ecash_amount = 0;
        cash_billing.final_payment_amount = pay_amount;
        cash_billing.is_payment_done = 1;
        cash_billing.cheque_number = payment_reference;
        cash_billing.cheque_date = payment_date;

        var cashbilldata = JSON.stringify(cash_billing);
        var item_data = JSON.stringify(individual_discount);

        var ops_url = baseurl + 'substore-bill-pay/pay-cheque-amount';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pack_id": pack_id,
                "std_id": std_id,
                "cashbilldata": cashbilldata,
                "item_data": item_data
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    $('#dbt_pay_btn').prop('disabled', true);
                    //                    if (data.bill_link) {
                    //                        window.open(data.bill_link, '_blank');
                    //                    }
                    if (data.bill_code) {
                        var link = baseurl + 'substore/bill-print-other/' + data.bill_code;
                        window.open(link, '_blank');
                    }
                    bill_test();
                    $('#dbt_pay_btn').prop('disabled', true);
                } else {
                    otherflag = 0;
                }
            },
            error: function() {
                console.log(cash_billing);
                otherflag = 0;
            }
        });
        $('#dbt_pay_btn').prop('disabled', true);
        return;
    }

    function cancel_voucher(payment_id, bill_id, count) {
        $("#voucher_reason").val('');
        $("#voucher_cancel").show();
        $("#payment_id").val(payment_id);
        $("#bill_id").val(bill_id);
        $("#count").val(count);
    }

    function submit_voucher_cancel() {
        var payment_id = $("#payment_id").val();
        var bill_id = $("#bill_id").val();
        var count = $("#count").val();
        var reason = $('#voucher_reason').val();
        if (reason == '') {
            swal('', ' Enter Reason for cancelling the voucher', 'info');
            return false;
        }
        if (count == 1) {
            var ops_url = baseurl + 'substore-bill-cancel/bill-cancel';
        } else {
            var ops_url = baseurl + 'substore-voucher-cancel/voucher-cancel';
        }


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
                    bill_test();
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
</script>