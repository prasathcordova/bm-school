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
    <?php
    if (isset($report_data) && !empty($report_data)) {
        //  $i = 0;

        //if ($i > 0) {
        // echo '<div style="page-break-before: always;"></div>';
        //}
        // $i++;
    ?>
        <table class="table2 tableH" cellpadding="1" style="font-family:Tahoma;" style="font-size: 15px; margin-top: 10px;width:100%;page-break-inside: always;" page-break-inside: always>
            <thead>
                <tr>
                    <td style="font-size:12px;" colspan="6">Date Range : <?php echo date('d-m-Y', strtotime($startdate)) ?> to <?php echo date('d-m-Y', strtotime($enddate)) ?> </td>
                </tr>
                <tr>
                    <td style="font-size:12px;" colspan="6">Report Type :<?php echo $title; ?> </td>
                </tr>
                <tr class="header">
                    <td class="col1" bgcolor="#2D4154" align="center" style="font-family:Tahoma;width:10% ">
                        <font color="#FCFEFC">
                            <h3>SlNo</h3>
                    </td>
                    <td class="col2" bgcolor="#2D4154" align="center" style="font-family:Tahoma;width:20%;">
                        <font color="#FCFEFC">
                            <h3>Username</h3>
                    </td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;width:10%;">
                        <font color="#FCFEFC">
                            <h3>Cash</h3>
                    </td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;width:10%;">
                        <font color="#FCFEFC">
                            <h3>Cheque</h3>
                    </td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;width:10%;">
                        <font color="#FCFEFC">
                            <h3>Card</h3>
                    </td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;width:10%;">
                        <font color="#FCFEFC">
                            <h3>Online Payment</h3>
                    </td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;width:10%;">
                        <font color="#FCFEFC">
                            <h3>DBT</h3>
                    </td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;width:20%;">
                        <font color="#FCFEFC">
                            <h3>Gross Total</h3>
                    </td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;width:20%;">
                        <font color="#FCFEFC">
                            <h3>Payback Total</h3>
                    </td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;width:20%;">
                        <font color="#FCFEFC">
                            <h3>Net Total</h3>
                    </td>

                </tr>
            </thead>
            <tbody>

                <!--tr >
                            <td colspan="6" style="padding-top:10px;padding-bottom: 5px;page-break-after: always">User Name : <?php echo $userdata['personal']['emp_name']; ?></td>
                        </tr-->
                <?php
                $cash_total = 0;
                $cheque_total = 0;
                $payback_total = 0;
                $card_total = 0;
                $online_total = 0;
                $dbt_total = 0;
                $gross_total = 0;
                $net_total = 0;
                $gross_gross_tot = 0;
                $net_net_total = 0;

                $i = 1;
                foreach ($report_data as $userdata) {
                ?>
                    <tr>
                        <td align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $i; ?></td>
                        <td align="left" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $userdata['name']; ?></td>
                        <?php if (isset($userdata['C'])) {
                            $c_total =  $userdata['C'];
                        } else {
                            $c_total = 0;
                        } ?>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;"><?php echo $c_total; ?></td>
                        <?php if (isset($userdata['Q'])) {
                            $q_total =  $userdata['Q'];
                        } else {
                            $q_total = 0;
                        } ?>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;"><?php echo $q_total; ?></td>
                        <?php if (isset($userdata['R'])) {
                            $r_total =  $userdata['R'];
                        } else {
                            $r_total = 0;
                        }
                        ?>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $r_total; ?></td>
                        <?php if (isset($userdata['O'])) {
                            $o_total =  $userdata['O'];
                        } else {
                            $o_total = 0;
                        } ?>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $o_total; ?></td>
                        <?php if (isset($userdata['D'])) {
                            $d_total =  $userdata['D'];
                        } else {
                            $d_total = 0;
                        } ?>
                        <?php $gross_total = $c_total + $q_total + $r_total + $o_total + $d_total; ?>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $d_total; ?></td>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $gross_total; ?></td>
                        <?php if (isset($userdata['P'])) {
                            $p_total =  $userdata['P'];
                        } else {
                            $p_total = 0;
                        }
                        $net_total =   $gross_total - $p_total;
                        $cash_total += $c_total;
                        $cheque_total += $q_total;
                        $card_total += $r_total;
                        $online_total += $o_total;
                        $dbt_total += $d_total;
                        $payback_total += $p_total;
                        $gross_gross_tot += $gross_total;
                        $net_net_total += $net_total;
                        ?>
                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $p_total; ?></td>

                        <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $net_total; ?></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
                <tr>
                    <td colspan=8> </td>
                </tr>
                <tr>
                    <td colspan=2 align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b>GRAND TOTAL </b></td>
                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b><?php echo $cash_total; ?></b></td>
                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b><?php echo $cheque_total; ?></b> </td>
                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b><?php echo $card_total; ?></b> </td>
                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b><?php echo $online_total; ?></b> </td>
                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b><?php echo $dbt_total; ?></b> </td>
                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b><?php echo $gross_gross_tot; ?></b> </td>
                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b><?php echo $payback_total; ?></b> </td>
                    <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><b><?php echo $net_net_total; ?> </b></td>
                </tr>

            </tbody>
        </table>
    <?php
    }
    ?>

</body>

</html>