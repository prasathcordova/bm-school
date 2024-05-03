<html>

<head>
    <title style="color:hotpink"><?php echo $title; ?></title>
</head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td style="width:3% !important;">Sl.No</td>
                <td style="width:7% !important;">Month</td>
                <?php
                $widthremain = 82;
                $tdcount = 3;
                foreach ($feecode_data as $fcodes_header) {
                    if ($fcodes_header['editable'] == 1) {
                ?>
                        <td width="<?php echo ($widthremain / (count($feecode_data))); ?>%" style="text-align:right;"><?php echo $fcodes_header['fee_shortcode']; ?>&nbsp;</td>
                <?php
                        $tdcount++;
                    }
                }
                ?>
                <td style="width:8% !important;text-align:right; ">Total&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            $total_array = array();
            // test data
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $ddate => $rpt_data) {
                    echo '<tr class="bodyarea">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . date('M/Y', strtotime('01-' . $ddate)) . '</td>';
                    $row_total_amt = 0;
                    $row_total_amtt = 0;
                    foreach ($feecode_data as $fcodes_header) {
                        if ($fcodes_header['editable'] == 1) {
                            $cash = (isset($rpt_data[$fcodes_header['feeCode']]) ? $rpt_data[$fcodes_header['feeCode']] : 0);
                            echo '<td style="text-align:right;">' . my_money_format($cash) . '&nbsp;</td>';
                            $row_total_amt = $row_total_amt + $cash;
                            if (!isset($total_array[$fcodes_header['feeCode']]['total']))
                                $total_array[$fcodes_header['feeCode']]['total'] =  $cash;
                            else
                                $total_array[$fcodes_header['feeCode']]['total'] +=  $cash;
                        }
                    }
                    echo '<td class="t-right">' . my_money_format($row_total_amt) . '&nbsp;</td>';
                    echo '</tr>';
                    $i++;
                }
            ?>
                <tr class="bodyarea">
                    <td colspan="2" class="t-right">
                        <span style="font-size: 15px; font-weight:bold;">Total</span>&nbsp;
                    </td>
                    <?php
                    foreach ($feecode_data as $fcodes_header4) {
                        if ($fcodes_header4['editable'] == 1) {
                            $cash_t = (isset($total_array[$fcodes_header4['feeCode']]['total']) ? $total_array[$fcodes_header4['feeCode']]['total'] : 0);
                            echo '<td style="text-align:right;font-size: 15px; font-weight:bold;">' . my_money_format($cash_t) . '&nbsp;</td>';
                            $row_total_amtt = $row_total_amtt + $cash_t;
                        }
                    }
                    echo '<td style="text-align:right;font-size: 15px; font-weight:bold;">' . my_money_format($row_total_amtt) . '&nbsp;</td>';
                    ?>
                </tr>
            <?php
            }
            // test data
            ?>
        </tbody>
    </table>
    <pagebreak />
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <h3>OTHER (OTH)</h3>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td style="width:3% !important;">Sl.No</td>
                <td style="width:7% !important;">Month</td>
                <?php
                $widthremain = 82;
                $tdcount = 3;
                foreach ($non_demandable_feecodes as $fcodes_header1) {
                    if ($fcodes_header1['editable'] == 1) {
                ?>
                        <td style="text-align:right; width:<?php echo ($widthremain / (count($non_demandable_feecodes))); ?>% !important;"><?php echo $fcodes_header1['fee_shortcode']; ?>&nbsp;</td>
                <?php
                        $tdcount++;
                    }
                }
                ?>
                <td style="width:8% !important;text-align:right; ">Total&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            // test data
            $total_array = array();
            if (isset($nd_report) && !empty($nd_report)) {
                foreach ($nd_report as $ddate => $rpt_data) {
                    echo '<tr class="bodyarea">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . date('M/Y', strtotime('01-' . $ddate)) . '</td>';
                    $row_total_amt = 0;
                    $row_total_amtt = 0;
                    foreach ($non_demandable_feecodes as $fcodes_header2) {
                        if ($fcodes_header2['editable'] == 1) {
                            $cash = (isset($rpt_data[$fcodes_header2['feeCode']]) ? $rpt_data[$fcodes_header2['feeCode']] : 0);
                            echo '<td style="text-align:right;">' . my_money_format($cash) . '&nbsp;</td>';
                            $row_total_amt = $row_total_amt + $cash;
                            if (!isset($total_array[$fcodes_header2['feeCode']]['total']))
                                $total_array[$fcodes_header2['feeCode']]['total'] =  $cash;
                            else
                                $total_array[$fcodes_header2['feeCode']]['total'] +=  $cash;
                        }
                    }
                    echo '<td class="t-right">' . my_money_format($row_total_amt) . '&nbsp;</td>';
                    echo '</tr>';
                    $i++;
                }
            ?>
                <tr class="bodyarea">
                    <td colspan="2" class="t-right">
                        <span style="font-size: 15px; font-weight:bold;">Total</span>&nbsp;
                    </td>
                    <?php
                    foreach ($non_demandable_feecodes as $fcodes_header4) {
                        if ($fcodes_header4['editable'] == 1) {
                            $cash_t = (isset($total_array[$fcodes_header4['feeCode']]['total']) ? $total_array[$fcodes_header4['feeCode']]['total'] : 0);
                            echo '<td style="text-align:right;font-size: 15px; font-weight:bold;">' . my_money_format($cash_t) . '&nbsp;</td>';
                            $row_total_amtt = $row_total_amtt + $cash_t;
                        }
                    }
                    echo '<td style="text-align:right;font-size: 15px; font-weight:bold;">' . my_money_format($row_total_amtt) . '&nbsp;</td>';
                    ?>
                </tr>
            <?php
            }
            // test data
            ?>
        </tbody>
    </table>
    <pagebreak />
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <div style="float:left; width:24%; margin-right:1%;">
        <h3>Fee Code Descriptions</h3>
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($feecode_data as $fcodes_header) {
                    if ($fcodes_header['editable'] == 1) {
                ?>
                        <tr class="bodyarea">
                            <td class="t-right"> <?php echo $fcodes_header['fee_shortcode']; ?>&nbsp;</td>
                            <td class="t-left">&nbsp; <?php echo $fcodes_header['description']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div style="float:left; width:24%; margin-left:1%;">
        <h3>Other Fee Codes (OTH)</h3>
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($non_demandable_feecodes as $fcodes_header3) {
                    if ($fcodes_header3['editable'] == 1) {
                ?>
                        <tr class="bodyarea">
                            <td class="t-right"> <?php echo $fcodes_header3['fee_shortcode']; ?>&nbsp;</td>
                            <td class="t-left">&nbsp; <?php echo $fcodes_header3['description']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>