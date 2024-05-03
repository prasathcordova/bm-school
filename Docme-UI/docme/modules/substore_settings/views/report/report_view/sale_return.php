<html>

<head>
    <style>
        tr:nth-child(odd)
        /*{ background-color:#FFFFFF; }*/
        tr:nth-child(even)

        /*{ background-color:#f3f3f3; }*/
        table2 {
            font-size: 15px;
            font-weight: bold;
            font-color: #2d4154;
        }

        tr {

            font-weight: bold;
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
    <p style="font-family:Tahoma;font-size: 12px;">Date Range &nbsp;: <?php echo date('d-m-Y', strtotime($startdate)) ?> to <?php echo date('d-m-Y', strtotime($enddate)) ?> <br />
        Report Type &nbsp;: Bookstore Sale Return Report-<?php echo $type_name ?> <br />
    </p>

    <table class="table2 tableH" cellpadding="1" style="font-family:Tahoma;" style="font-size: 15px; margin-top: 10px;width:100%;">
        <thead>
            <tr class="header">
                <td class="col1" bgcolor="#2D4154" align="center" style="font-family:Tahoma " width="5%">
                    <font color="#FCFEFC">
                        <h3>SlNo</h3>
                </td>
                <td class="col2" bgcolor="#2D4154" align="center" style="font-family:Tahoma" width="15%">
                    <font color="#FCFEFC">
                        <h3>Item Name</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;" width="10%">
                    <font color="#FCFEFC">
                        <h3>Edition</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;" width="10%">
                    <font color="#FCFEFC">
                        <h3>Quantity</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;" width="14%">
                    <font color="#FCFEFC">
                        <h3>Price</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;" width="14%">
                    <font color="#FCFEFC">
                        <h3>Disc.</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;" width="14%">
                    <font color="#FCFEFC">
                        <h3><?php echo TAXNAME  ?></h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;" width="14%">
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
            $report_total_roundoff = 0;
            $report_total_discount = 0;
            $report_pay_back_amount = 0;
            if (isset($report_data) && !empty($report_data)) {
                foreach ($report_data as $key => $data) {
                    $total_quantity = 0;
                    $total_price = 0;
                    $total_tax = 0;
                    $total_discount = 0;
                    $total_roundoff = 0;
                    $i = 1;
            ?>
                    <tr>
                        <td colspan="7" style="padding-top:15px;font-family:Tahoma ;border-bottom: 1px solid #ccc; "><?php echo date('d-m-Y', strtotime($key)); ?></td>
                    </tr>

                    <?php
                    if (isset($data) && !empty($data)) {

                        foreach ($data as $items) {
                            if ($items['return_qty'] > 0) {
                    ?>
                                <tr>
                                    <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="5%"><?php echo $i; ?></td>
                                    <td align="left" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="15%"><?php echo $items['item_name']; ?></td>
                                    <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="10%"><?php echo $items['edition_name']; ?></td>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="10%"><?php echo $items['return_qty']; ?></td>
                                    <?php if ($type == 3) { ?>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="14%">-</td>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="14%">-</td>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="14%">-</td>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="14%">-</td>

                                    <?php } else {  ?>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="14%"><?php echo $items['price_per_qty']; ?></td>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="14%"><?php echo round($items['discount_amt'], 2, PHP_ROUND_HALF_UP); ?></td>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="14%"><?php echo $items['tax']; ?></td>
                                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; " width="14%"><?php echo round($items['final_amt'], 2, PHP_ROUND_HALF_UP); ?></td>

                                    <?php } ?>
                                </tr>
                    <?php
                                $i++;
                                $total_quantity = $total_quantity + $items['return_qty'];
                                if ($type != 3) {
                                    $total_price = $total_price + $items['final_amt'];
                                    $total_tax = $total_tax + $items['tax'];
                                    $total_discount = $total_discount + $items['discount_amt'];

                                    $report_total_quantity = $report_total_quantity + $items['return_qty'];
                                    $report_total_price = $report_total_price + $items['final_amt'];
                                    $report_total_tax = $report_total_tax + $items['tax'];
                                    $report_total_discount = $report_total_discount + $items['discount_amt'];

                                    if ($report_total_roundoff <= 0) {
                                        $report_total_roundoff = $items['roundoff'];
                                    }
                                    $report_pay_back_amount = $items['total_payback_amount'];
                                } else {
                                    $report_sub_total =  $items['total_bill_amount'];
                                    $report_total_roundoff =  $items['round_off'];
                                    $report_total_price =  $items['total_bill_amount'];
                                    $report_total_tax =  $items['total_tax'];
                                    $report_discount =  $items['total_discount'];
                                    $report_pay_back_amount =  $items['total_payback_amount'];
                                }
                            }
                        }
                    }
                    ?>

                    <tr>
                        <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;border-top:2px solid;padding-top: 10px; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total Quantity : </td>
                        <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;border-top:2px solid;padding-top: 10px;  "><?php echo my_money_format(round($total_quantity, 2, PHP_ROUND_HALF_UP)); ?></td>
                    </tr>
                    <?php if ($type != 3) { ?>
                        <tr>
                            <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;border-top:2px solid;padding-top: 10px; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total Discount : </td>
                            <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;border-top:2px solid;padding-top: 10px;  "><?php echo my_money_format(round($total_discount, 2, PHP_ROUND_HALF_UP)); ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total <?php echo TAXNAME  ?> : </td>
                            <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  "><?php echo my_money_format(round($total_tax, 2, PHP_ROUND_HALF_UP)); ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">Day (<?php echo date('d-m-Y', strtotime($key)); ?>) Total Price : </td>
                            <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;  "><?php echo my_money_format(round($total_price, 2, PHP_ROUND_HALF_UP)); ?></td>
                        </tr>
                    <?php } ?>
                <?php }
                ?>
                <tr>
                    <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Quantity) : </td>
                    <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_total_quantity, 2, PHP_ROUND_HALF_UP)); ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Sub Total) : </td>
                    <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_total_price, 2, PHP_ROUND_HALF_UP)); ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Discount) : </td>
                    <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_total_discount, 2, PHP_ROUND_HALF_UP)); ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (<?php echo TAXNAME  ?>) : </td>
                    <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_total_tax, 2, PHP_ROUND_HALF_UP)); ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Roundoff) : </td>
                    <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round(round($report_total_roundoff, 2, PHP_ROUND_HALF_UP), 2, PHP_ROUND_HALF_UP)); ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Price) : </td>
                    <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_total_price + round($report_total_roundoff, 2, PHP_ROUND_HALF_UP), 2, PHP_ROUND_HALF_UP)); ?></td>
                </tr>
                <tr>
                    <td colspan="6" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Payback Amount) : </td>
                    <td colspan="2" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format($report_pay_back_amount); ?></td>
                </tr>

            <?php }
            ?>
        </tbody>
    </table>
</body>

</html>