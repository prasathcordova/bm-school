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
        Report Type &nbsp;: Uniform Store Sale report Item Wise Summary <br />
    </p>

    <table class="table2 tableH" cellpadding="1" style="font-family:Tahoma;font-size: 15px; margin-top: 10px;width:100%;page-break-before: auto;">
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
                        <h3>Sub-Total</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Discount</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>VAT</h3>
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
            $report_total_tax = 0;
            $report_discount = 0;
            $report_round_off = 0;
            $report_type = '';
            $i = 1;
            // dev_export($report_data);
            // die;
            if (isset($report_data) && !empty($report_data)) {
                foreach ($report_data as $key => $data) {
                    $total_quantity = 0;
                    $total_price = 0;
                    $total_tax = 0;
                    $total_discount = 0;
            ?>
                    <tr>
                        <td colspan="8" style="padding-top:15px;font-family:Tahoma ;font-weight: bold;border-bottom: 1px solid #ccc; "><?php echo $key; ?></td>
                    </tr>

                    <?php
                    if (isset($data) && !empty($data)) {
                        //                            dev_export($data);die;
                        foreach ($data as $items) {
                    ?>
                            <tr>
                                <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $i; ?></td>
                                <td align="left" width="20%" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['item_name']; ?></td>
                                <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['edition_name']; ?></td>
                                <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['qty']; ?></td>
                                <?php if ($type == 3) { //OH Packing 
                                ?>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">-</td>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">-</td>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">-</td>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; ">-</td>

                                <?php } else { ?>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['total_amount']; ?></td>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['discounts']; ?></td>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo round($items['vat_amount'], 2, PHP_ROUND_HALF_UP); ?></td>
                                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo round($items['final_amount'], 2, PHP_ROUND_HALF_UP); ?></td>
                                <?php } ?>

                            </tr>
                    <?php
                            $i++;
                            $total_quantity = $total_quantity + $items['qty'];
                            $report_total_quantity = $report_total_quantity + $items['qty'];
                            if ($type != 3) {
                                $total_price = $total_price + $items['final_amount'];
                                $total_tax = $total_tax + $items['vat_amount'];
                                $total_discount = $total_discount + $items['discounts'];
                                $report_total_price = $report_total_price + $items['final_amount'];
                                $report_total_tax = $report_total_tax + $items['vat_amount'];
                                $report_discount = $report_discount + $items['discounts'];

                                if ($report_round_off == 0 && $items['report_type'] == 'OTHERS') {
                                    $report_round_off = $items['round_off'];
                                }
                            } else {
                                $report_round_off = $items['round_off'];
                                $report_total_price = $items['total_bill_amount'];
                                $report_total_tax = $items['total_tax'];
                                $report_discount = $items['total_discount'];
                            }


                            $report_type = $items['report_type'];
                        }
                        if ($report_type == 'SPECIMEN') {
                            //                                $report_discount = $report_total_price + $report_total_tax;
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $key; ?> Total ( Qty ) : </td>
                        <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo my_money_format($total_quantity); ?></td>
                    </tr>
                    <?php if ($type != 3) { ?>
                        <tr>
                            <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $key; ?> Total ( <?php echo TAXNAME ?> ) : </td>
                            <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo my_money_format($total_tax); ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $key; ?> Total ( Discount ) : </td>
                            <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo my_money_format($total_discount); ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $key; ?> Total ( Price ) : </td>
                            <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo my_money_format(round($total_price, 2, PHP_ROUND_HALF_UP), ""); ?></td>
                        </tr>
                    <?php } ?>
                <?php }
                ?>
                <tr>
                    <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total ( Quantity ) : </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format($report_total_quantity); ?></td>

                </tr>
                <tr>
                    <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total ( Sub Total ): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format($report_total_price); ?></td>
                </tr>
                <tr>
                    <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total ( <?php echo TAXNAME  ?> ): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format($report_total_tax); ?></td>
                </tr>
                <tr>
                    <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total ( Discount ): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format($report_discount); ?></td>
                </tr>
                <tr>
                    <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total ( Round Off ): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format($report_round_off); ?></td>
                </tr>
                <tr>
                    <td colspan="5" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total (Price): </td>
                    <td colspan="3" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo my_money_format(round($report_total_price + $report_round_off, 0, PHP_ROUND_HALF_UP), ""); ?></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</body>

</html>