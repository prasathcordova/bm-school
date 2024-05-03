<html>

<head>
    <style>
        .border-data {
            border-bottom: 1px;
            border-bottom-color: black;
            border-top: 1px;
            border-bottom-color: black;
            border-left: 1px;
            border-bottom-color: black;
            border-right: 1px;
            border-bottom-color: black;
        }

        tr:nth-child(odd)
        /*{ background-color:#FFFFFF; }*/
        tr:nth-child(even)

        /*{ background-color:#f3f3f3; }*/
        .table2 {
            font-size: 15px;
            font-weight: bold;
            font-color: #2d4154;
        }

        hr {
            margin-top: 5px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #eee;
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

    <table class="table2 tableH" cellpadding="1" style="font-family:Tahoma;" style="font-size: 15px; margin-top: 10px;width:100%;">
        <thead>
            <tr>
                <td style="font-size:12px;" colspan="6">Date Range : <?php echo date('d-m-Y', strtotime($startdate)) ?> to <?php echo date('d-m-Y', strtotime($enddate)) ?> </td>
            </tr>
            <tr>
                <td style="font-size:12px;" colspan="6">Report Type : <?php echo $title; ?> </td>
            </tr>
            <tr class="header">
                <td class="col1" bgcolor="#2D4154" align="center" style="font-family:Tahoma ">
                    <font color="#FCFEFC">
                        <h3>SlNo</h3>
                </td>
                <td class="col2" bgcolor="#2D4154" align="center" style="font-family:Tahoma">
                    <font color="#FCFEFC">
                        <h3>Admn. No</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Student Name</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Voucher</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Amount</h3>
                </td>
                <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;">
                    <font color="#FCFEFC">
                        <h3>Type</h3>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $bsp_total = 0;
            $cash_total = 0;
            $cheque_total = 0;
            $card_total = 0;
            $online_total = 0;
            $dbt_total = 0;
            $grand_total = 0;
            $i = 1;
            if (isset($report_data) && !empty($report_data)) {

                foreach ($report_data as $key => $data) {
            ?>
                    <tr>
                        <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $i; ?></td>
                        <td align="left" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['admn_no']; ?></td>
                        <td align="left" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['student_name']; ?></td>
                        <td align="left" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['billing_code']; ?></td>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['final_total']; ?></td>
                        <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['code']; ?></td>
                    </tr>
            <?php
                    $i++;

                    if ($data['code'] == 'C' && $data['TYPES'] == 'OT') {
                        $cash_total = $cash_total + $data['final_total'];
                        $grand_total = $grand_total + $data['final_total'];
                    } else if ($data['code'] == 'R') {
                        $card_total = $card_total + $data['final_total'];
                        $grand_total = $grand_total + $data['final_total'];
                    } else if ($data['code'] == 'Q') {
                        $cheque_total = $cheque_total + $data['final_total'];
                        $grand_total = $grand_total + $data['final_total'];
                    } else if ($data['code'] == 'O') {
                        $online_total = $online_total + $data['final_total'];
                        $grand_total = $grand_total + $data['final_total'];
                    } else if ($data['code'] == 'D') {
                        $dbt_total = $dbt_total + $data['final_total'];
                        $grand_total = $grand_total + $data['final_total'];
                    } else if ($data['TYPES'] == 'RTN') {
                        $bsp_total = $bsp_total + $data['final_total'];
                        //                            $grand_total = $grand_total + $data['final_total'];
                    }
                }
            }


            ?>
            <tr>
                <td colspan="2" style="padding-top:25px;padding-left: 10px;border: 0;border-bottom:  1px solid #eee;">Cash Total</td>
                <td style="padding-top:25px;border: 0;border-bottom:  1px solid #eee;"><?php echo $cash_total; ?></td>
                <td style="padding-top:25px;border: 0;border-bottom:  1px solid #eee;">Gross Total</td>
                <td style="padding-top:25px;border: 0;border-bottom:  1px solid #eee;" align="right"><?php echo $grand_total; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:10px;padding-left: 10px;border: 0;border-bottom:  1px solid #eee;">Cheque Total</td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;"><?php echo $cheque_total; ?></td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;">Less Payback</td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;" align="right"><?php echo $bsp_total; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:10px;padding-left: 10px;border: 0;border-bottom:  1px solid #eee;">Card Total</td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;"><?php echo $card_total; ?></td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;">Net Total</td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;" align="right"><?php echo $grand_total - $bsp_total; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:10px;padding-left: 10px;border: 0;border-bottom:  1px solid #eee;">Online Payments</td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;"><?php echo $online_total; ?></td>
                <td style="padding-top:10px;"></td>
                <td style="padding-top:10px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:10px;padding-left: 10px;border: 0;border-bottom:  1px solid #eee;">DBT Total</td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;"><?php echo $dbt_total; ?></td>
                <td style="padding-top:10px;"></td>
                <td style="padding-top:10px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:10px;padding-left: 10px;border: 0;border-bottom:  1px solid #eee;">Payback Total</td>
                <td style="padding-top:10px;border: 0;border-bottom:  1px solid #eee;"><?php echo $bsp_total; ?></td>
                <td style="padding-top:10px;"></td>
                <td style="padding-top:10px;"></td>
            </tr>
        </tbody>
    </table>


</body>

</html>