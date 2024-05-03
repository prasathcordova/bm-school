<html>

<head>
    <style>
        tr:nth-child(odd)
        /*{ background-color:#FFFFFF; }*/
        tr:nth-child(even)

        /*{ background-color:#f3f3f3; }*/
        table2 {
            font-size: 10px;
            font-weight: bold;
            font-color: #2d4154;
        }

        tr {

            font-size: 10px;
            height: 15px;
            vertical-align: middle;
            border-bottom: 1px;
            border-bottom-color: black;
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
        }

        tr.header>td {
            font-weight: bold;
            color: #2d4154;
            background-color: #2d4154;
            height: 18px;
            /*vertical-align: middle;*/
            font-family: Tahoma;
        }

        /*            table.tableH
                        {
                            border-top: 1px solid #641E16;
                            border-bottom: 1px solid #641E16;
                        }*/
        table.table2 td.col1 {
            /*width:20%;*/
            text-align: left;
        }

        table.table2 td.col2 {
            /*width:40%;*/
            text-align: left
        }

        table.table2 td.col3 {
            /*width:40%;*/
            text-align: right;
        }

        table.table2 td.colU {
            border-top: 0.1px solid #4CAF50;
        }

        p.line {
            font-size: 2px;
            font-weight: normal;
        }

        h4 {
            text-align: center;
        }
    </style>
    <title><?php echo $title; ?></title>
</head>


<body>
    <?php
    echo $header;
    ?>
    <p style="font-family:Tahoma;font-size: 12px;">Date Range &nbsp;: <?php echo date('d-m-Y', strtotime($startdate)) ?> to <?php echo date('d-m-Y', strtotime($enddate)) ?> <br />
        Report Type &nbsp;: Uniform Store Sale report <br />
    </p>

    <table class="table2 tableH" cellpadding="1" style="font-family:Tahoma; font-size: 12px; margin-top: 10px; width:100% !important;">
        <thead>
            <tr class="header">
                <td class="col1" bgcolor="#2D4154" align="center" style="font-family:Tahoma ">
                    <font color="#FCFEFC">
                        <h3>SlNo</h3>
                </td>
                <td class="col2" bgcolor="#2D4154" width="20%" align="center" style="font-family:Tahoma">
                    <font color="#FCFEFC">
                        <h3>Item Name</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Size</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Quantity</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Price</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3><?php echo TAXNAME  ?></h3>
                </td>
                <!--<td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Discount</h3></td>-->
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Total</h3>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $report_total_quantity = 0;
            $report_total_price = 0;
            $report_total_tax = 0;
            $discount = 0;
            $i = 1;
            $report_round_off = 0;
            $report_round_off_flag = 0;
            //dev_export($report_data);

            if (isset($report_data) && !empty($report_data)) {
                foreach ($report_data as $key => $data) {
                    $total_quantity = 0;
                    $total_price = 0;
                    $total_tax = 0;
                    $total_roundoff = 0;
                    $sub_discount = 0;
                    $day_total_round_off = 0;
            ?>
                    <tr>
                        <td colspan="7" style="padding-top:15px;font-family:Tahoma ;border-bottom: 1px solid #ccc; "><?php echo date('d-m-Y', strtotime($key)); ?></td>
                    </tr>

                    <?php
                    if (isset($data) && !empty($data)) {
                        foreach ($data as $key2 => $bill_details) {
                            $i = 1;
                            $bill_sub_total = 0;
                            $bill_discount = 0;
                            $bill_total_tax = 0;
                            $bill_final_amount = 0;
                            $bill_roundoff = 0;
                            $bill_type = 0;
                            $discount_flag = 0;
                            $roundoff_flag = 0;
                    ?>
                            <tr>
                                <td colspan="7" style="padding-top:15px;font-family:Tahoma ;border-bottom: 1px solid #ccc; ">VOUCHER NO : <?php echo $key2; ?> (BILLING TYPE : <?php echo $bill_details['master_data']['billing_type']; ?>)</td>
                            </tr>
                            <?php
                            if (isset($bill_details['item_data']) && !empty($bill_details['item_data'])) {
                                foreach ($bill_details['item_data'] as $items) {
                            ?>
                                    <tr>
                                        <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $i; ?></td>
                                        <td align="left" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['item_name']; ?></td>
                                        <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['edition_name']; ?></td>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['qty']; ?></td>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['price']; ?></td>

                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['vat_amount']; ?></td>

                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['final_total']; ?></td>
                                    </tr>
                            <?php
                                    $i++;
                                    //                                        dev_export($items);die;
                                    $bill_sub_total = $bill_sub_total + ($items['qty'] * $items['price']);
                                    $bill_total_tax = $bill_total_tax + $items['vat_amount'];
                                    $bill_final_amount = $bill_final_amount + $items['final_total'];
                                    if ($items['billing_type'] == 'SPECIMEN BILLING') {
                                        $bill_type = 1;
                                    }
                                    $total_quantity = $total_quantity + $items['qty'];
                                    $total_tax = $total_tax + $items['vat_amount'];
                                    $report_total_quantity = $report_total_quantity + $items['qty'];
                                    $report_total_tax = $report_total_tax + $items['vat_amount'];
                                    if ($bill_type == 1) {
                                        if ($bill_discount == 0) {
                                            $bill_discount = $items['bill_discount_amount'];
                                        }
                                        $sub_discount = $sub_discount + $items['final_total'];
                                        $discount = $discount + $items['final_total'];
                                    } else {
                                        $bill_discount = $bill_discount + ($items['item_discount_per_qty']);
                                        $sub_discount = $sub_discount + ($items['item_discount_per_qty']);
                                        $discount = $discount + ($items['item_discount_per_qty']);
                                    }
                                    //                                        if ($report_round_off != 0) {
                                    $report_round_off = $items['total_round_off'];
                                    //                                        }
                                    if ($roundoff_flag == 0) {
                                        $total_roundoff = $items['round_off'];
                                        $roundoff_flag = 1;
                                    }
                                }
                                $bill_final_amount = $bill_final_amount + $total_roundoff;
                                $total_price = $total_price + round(round($bill_final_amount, 2, PHP_ROUND_HALF_UP), 0, PHP_ROUND_HALF_UP);
                                $report_total_price = $report_total_price + round(round($bill_final_amount, 2, PHP_ROUND_HALF_UP), 0, PHP_ROUND_HALF_UP);
                            }
                            $day_total_round_off = $day_total_round_off + $total_roundoff;

                            ?>
                            <tr>
                                <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  ">Voucher Sub Total : </td>
                                <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  "><?php echo my_money_format(round($bill_sub_total, 2, PHP_ROUND_HALF_UP), ''); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  ">Voucher Total <?php echo TAXNAME ?> : </td>
                                <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  "><?php echo my_money_format(round($bill_total_tax, 2, PHP_ROUND_HALF_UP), ''); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  ">Voucher Discount : </td>
                                <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  text-align: right; "><?php echo my_money_format(round($bill_discount, 2, PHP_ROUND_HALF_UP), ''); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  ">Round Off : </td>
                                <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  text-align: right; "><?php echo round($total_roundoff, 2, PHP_ROUND_HALF_UP) ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  ">Voucher Grand Total : </td>
                                <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  text-align: right; "><?php echo my_money_format(round((round($bill_final_amount, 0, PHP_ROUND_HALF_UP))), ''); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  ">Voucher Amount : </td>
                                <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  text-align: right; "><?php echo my_money_format(round((round($items['paid_amount'], 0, PHP_ROUND_HALF_UP))), ''); ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                    <!-- <tr>
                        <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total - Quantity : </td>
                        <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo round($total_quantity, 2, PHP_ROUND_HALF_UP); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total - Discount(Excluding Specimen Discount) : </td>
                        <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo round($sub_discount, 2, PHP_ROUND_HALF_UP); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total - Total <?php echo TAXNAME ?> : </td>
                        <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo round($total_tax, 2, PHP_ROUND_HALF_UP); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total - Total Roundoff : </td>
                        <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo round($day_total_round_off, 2, PHP_ROUND_HALF_UP); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total - Bill Total : </td>
                        <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round(round(($total_price), 0, PHP_ROUND_HALF_UP), 2, PHP_ROUND_HALF_UP), ''); ?></td>
                    </tr> -->
                <?php }
                ?>
                <!-- <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Grand Total Discount(Excluding Specimen Discount) : </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; text-align: right; "><?php echo round($discount, 2, PHP_ROUND_HALF_UP); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Grand Total - Quantity : </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo round($report_total_quantity, 2, PHP_ROUND_HALF_UP); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Grand Total - <?php echo TAXNAME ?> : </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo round($report_total_tax, 2, PHP_ROUND_HALF_UP); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Grand Total - Roundoff : </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo round($report_round_off, 2, PHP_ROUND_HALF_UP); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Grand Total - Bill : </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_total_price, 0, PHP_ROUND_HALF_UP), ''); ?></td>
                </tr> -->
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php echo $footer ?>
</body>

</html>