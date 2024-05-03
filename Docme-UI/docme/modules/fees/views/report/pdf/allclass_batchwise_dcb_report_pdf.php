<html>

<head>
    <title>Batch Wise DCB Report for all classes and all batches</title>
</head>
<?php
$g_total_demand = 0;
$g_total_concession = 0;
$g_total_excemption = 0;
$g_total_net_due = 0;
$g_total_advance = 0;
$g_total_regular = 0;
$g_total_balance = 0;
$g_total_arrear = 0;
?>
<style>
    .table {
        border-spacing: 0;
        border-collapse: collapse;
        font-family: Roboto;
        font-size: 11px;
        /* page-break-inside: avoid; */
    }

    .table-bordered {
        border: 1px solid #b1b1b1;
    }

    .table-bordered tbody tr td,
    .table-bordered tbody tr th,
    .table-bordered tfoot tr td,
    .table-bordered tfoot tr th,
    .table-bordered thead tr td,
    .table-bordered thead tr th,
    .table-bordered tr th,
    .table-bordered tr td {
        border: 1px solid #b1b1b1 !important;
    }

    tr.header th {
        padding: 5px 5px;
        font-weight: bold;
    }

    .table-bordered tr.header td,
    .table-bordered tr.footer td {
        vertical-align: middle;
        text-align: center;
        padding: 5px 0;
        font-weight: bold;
    }

    .table-bordered tr.bodyarea td {
        vertical-align: middle;
        text-align: center;
        padding: 7px 0 7px 3px;
        font-size: 10px;
    }

    .table-bordered tr.linetr td {
        padding: 2px 0;
    }

    .table-top tr.header td {
        text-align: left;
        padding: 7px 0;
    }

    .table-top tr.header td span {
        font-weight: bold;
        font-size: 12px;
    }

    .table-top {
        margin-bottom: 15px;
    }

    .table-bordered tr.bodyarea td.t-right,
    .table-bordered tr.footer td.t-right {
        text-align: right !important;
    }

    .table-bordered tr.bodyarea td.t-left,
    .table-bordered tr.footer td.t-left {
        text-align: left !important;
    }

    .pad-bot-0 {
        padding-bottom: 0px !important;
    }

    .headerdiv {
        text-align: center;
        padding-bottom: 5px;
        display: block;
        font-family: Arial;
        border-bottom: 1px solid #000;
        margin-bottom: 10px;
    }

    .footerdiv {
        border-top: #000 1px solid;
        font-size: 9px;
        font-weight: bold;
        font-family: Arial;
    }

    .t-right {
        text-align: right !important;
    }

    .t-left {
        text-align: left !important;
    }

    .t-center {
        text-align: center !important;
    }

    @page {
        size: auto;
        margin: 10mm;
        margin-top: 60mm;
        margin-bottom: 20mm;
    }
</style>

<body style="background: #fff !important;">
    <?php
    $inst_id = $this->session->userdata('inst_id');
    $inst_name = $this->session->userdata('Institution_Name');
    $inst_place = $this->session->userdata('Institution_Place');
    $inst_email = $this->session->userdata('Institution_Email');
    $inst_phone = $this->session->userdata('Institution_Phone');
    $inst_url = $this->session->userdata('Institution_Url');
    ?>
    <br />
    <table width="100%" cellpadding="2" cellspacing="0" border="0" align="left" style="font-family:Times New Roman">
        <tr>
            <td width="20%" rowspan='4' align="center">
                <img src="<?php echo base_url('/assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:100px;" />
            </td>
            <td width="60%" align="center">
                <p style="font-size:19px;">
                    <?php echo $inst_name ?></p>
            </td>
            <td width="20%" rowspan='4' align="right"></td>
        </tr>
        <tr>
            <td align="center" style="font-size:14px;"><?php echo $inst_place ?></td>
        </tr>
        <tr>
            <td align="center" style="font-size:9px;">Email: <?php echo $inst_email ?>,<br> Web: <?php echo $inst_url ?> </td>
        </tr>
        <tr>
            <td align="center" style="font-size:9px;"> Ph: <?php echo $inst_phone ?></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <p style="text-align: center;margin:0px; font-weight:bold;"><?php echo isset($title) & !empty($title) ? $title : 'NO TITLE'; ?> </p>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left" colspan="2">
                <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5>
            </td>
            <td align="right">
                <span style="margin-top:10px;">
                    <small>* All amounts are in INR</small>
                </span>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
    <?php
    $rowcount = count($details_data);
    $cc = 0;
    foreach ($details_data as $report_data) {
    ?>
        <table class="table table-bordered" width="100%" style="font-size: 10px;">
            <?php $date = date("d-m-Y"); ?>
            <tr class="header">
                <?php
                $student_status = '';
                if (trim($report_data['student_data']['StatusFlag']) == 'L') $student_status = ' - <span style="text-wight:bold; color:#EF5352">Long Absentee&nbsp;</span>';
                elseif (trim($report_data['student_data']['StatusFlag']) == 'O') $student_status = ' - <span style="text-wight:bold;">Official&nbsp;</span>';
                ?>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Student Name</span> : <?php echo $report_data['student_data']['student_name']; ?><?php echo $student_status ?></td>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Admission Number</span> : <?php echo $report_data['student_data']['Admn_No']; ?></td>
            </tr>
            <tr class="header">
                <td style="text-align:left;" colspan="5"><span>&nbsp;Batch</span> : <?php echo $report_data['student_data']['batch_name']; ?></td>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Date</span> : <?php echo $date; ?></td>
            </tr>
            <tr class="linetr">
                <td colspan="10"></td>
            </tr>
            <thead>
                <tr class="header">
                    <td rowspan="2" width="10%">Fee Details</td>
                    <td rowspan="2" width="10%">Demanded Fees</td>
                    <td colspan="2" width="20%">Adjustments</td>
                    <td rowspan="2" width="8%">Net Due</td>
                    <td colspan="2" width="20%">Receipts</td>
                    <td rowspan="2" width="8%">Balance</td>
                    <td rowspan="2" width="8%">Arrear</td>
                    <td rowspan="2" width="16%">Remarks</td>
                </tr>
                <tr class="header">
                    <td>Concession</td>
                    <td>Exemption</td>
                    <td>Advance</td>
                    <td>Regular</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($report_data['report_data'] as $month => $report_lvl1) {
                ?>
                    <tr class="bodyarea">
                        <td colspan="10" class="t-left"><b>Month : </b><?php echo date('M Y', strtotime($month)); ?></td>
                    </tr>
                    <?php
                    foreach ($report_lvl1['feecode'] as $fdata) {
                    ?>
                        <tr class="bodyarea">
                            <td class="t-left"><?php echo $fdata['feecode_desc']; ?></td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['demand']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['concession']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['excemption']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['net_due']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['advance']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['regular']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['balance']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['arrear']); ?>&nbsp;</td>
                            <td style="text-align:right;">&nbsp;&nbsp;</td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php
                    $i++;
                }
                ?>
                <!--<tr class="linetr"><td colspan="10"></td></tr>-->
                <tr class="footer">
                    <td class="t-right">Total &nbsp;&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_demand']);
                                                    $g_total_demand += $report_data['summary']['total_demand']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_concession']);
                                                    $g_total_concession += $report_data['summary']['total_concession']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_excemption']);
                                                    $g_total_excemption += $report_data['summary']['total_excemption']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_net_due']);
                                                    $g_total_net_due += $report_data['summary']['total_net_due']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_advance']);
                                                    $g_total_advance += $report_data['summary']['total_advance']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_regular']);
                                                    $g_total_regular += $report_data['summary']['total_regular']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_balance']);
                                                    $g_total_balance += $report_data['summary']['total_balance']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_arrear']);
                                                    $g_total_arrear += $report_data['summary']['total_arrear']; ?>&nbsp;</td>
                    <td style="text-align:right;">&nbsp;&nbsp;</td>
                </tr>
                <tr class="linetr">
                    <td colspan="10">&nbsp;&nbsp;</td>
                </tr>
                <?php
                ++$cc;
                if ($cc == $rowcount) {
                ?>
                    <tr class="footer">
                        <td class="t-right">Grand Total &nbsp;&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_demand); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_concession); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_excemption); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_net_due); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_advance); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_regular); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_balance); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_arrear); ?>&nbsp;</td>
                        <td style="text-align:right;">&nbsp;&nbsp;</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
    <div style="border-top:#000 1px solid;font-size:9px;font-weight:bold">
        <div style="margin-bottom:0px">
            <div style="float:left;width:25%;text-align:left">Print by : <?php echo $user_name ?></div>
            <div style="float:left;width:50%;text-align:center"><?php echo ' '; //'{PAGENO}' 
                                                                ?></div>
            <div style="float:right;width:20%;text-align:right"><?php echo date('d-m-Y - h:i:s') ?></div>
        </div>
        <h5 style="margin-top:0px;color: #888;overflow:visible;"><?php echo $bread_crumps ?></h5>
    </div>
</body>

</html>