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
        Report Type &nbsp;: Bookstore Sale report Item Wise-<?php echo $type_name ?> <br />
    </p>

    <table class="table2 tableH" cellpadding="1" style="font-family:Tahoma;" style="font-size: 15px; margin-top: 10px;width:100%;">
        <thead>
            <tr class="header">
                <td class="col1" bgcolor="#2D4154" align="center" style="font-family:Tahoma ">
                    <font color="#FCFEFC">
                        <h3>SlNo</h3>
                </td>
                <td class="col2" bgcolor="#2D4154" align="center" style="font-family:Tahoma">
                    <font color="#FCFEFC">
                        <h3>Item Name</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Edition</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Quantity</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Sub-Total</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3><?php echo TAXNAME  ?></h3>
                </td>
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
            $report_sub_total = 0;
            $report_total_tax = 0;
            $report_discount = 0;
            $report_round_off = 0;
            $report_type = '';

            if (isset($report_data) && !empty($report_data)) {
                $i = 1;
                foreach ($report_data as $key => $data) {
            ?>
                    <tr>
                        <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $i; ?></td>
                        <td align="left" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['item_name']; ?></td>
                        <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['edition_name']; ?></td>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['qty']; ?></td>
                        <?php if ($type == 3) { ?>
                            <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">-</td>
                            <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">-</td>
                            <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">-</td>

                        <?php } else { ?>
                            <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['total_amount']; ?></td>
                            <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['vat_amount']; ?></td>
                            <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['final_amount']; ?></td>
                        <?php } ?>

                    </tr>
                    <?php
                    $i++;
                    $report_total_quantity = $report_total_quantity + $data['qty'];
                    if ($type != 3) {
                        $report_sub_total = $report_sub_total + $data['total_amount'];
                        $report_total_price = $report_total_price + $data['final_amount'];
                        $report_total_tax = $report_total_tax + $data['vat_amount'];
                        $report_discount = $report_discount + $data['discounts'];

                        if ($report_round_off == 0 && $data['report_type'] == 'OTHERS') {
                            $report_round_off = $data['round_off'];
                        }
                    } else {
                        $report_sub_total = $data['total_bill_amount'];
                        $report_round_off = $data['round_off'];
                        $report_total_price = $data['total_bill_amount'];
                        $report_total_tax = $data['total_tax'];
                        $report_discount = $data['total_discount'];
                    }



                    if ($report_round_off == 0 && $data['report_type'] == 'OTHERS') {
                        $report_round_off = $data['round_off'];
                    }
                    $report_type = $data['report_type'];
                    ?>

                <?php }
                if (strtoupper($report_type) == 'SPECIMEN') {
                    $report_discount = $report_sub_total + $report_total_tax;
                }
                ?>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Quantity) : </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo round($report_total_quantity, 2, PHP_ROUND_HALF_UP); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Sub Total): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_sub_total, 2, PHP_ROUND_HALF_UP), ''); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Discount): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_discount, 2, PHP_ROUND_HALF_UP), ''); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (<?php echo TAXNAME  ?>): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_total_tax, 2, PHP_ROUND_HALF_UP), ''); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Round Off): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_round_off, 2, PHP_ROUND_HALF_UP)); ?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total : </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round(($report_total_price + $report_round_off), 0, PHP_ROUND_HALF_UP), ''); ?></td>
                </tr>



            <?php }
            ?>
        </tbody>
    </table>
</body>

</html>