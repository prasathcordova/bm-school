<html>

<head>
    <title style="color:hotpink"><?php echo $title; ?></title>
</head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            $grand_total_amount = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $key1 => $feedata) {
            ?>

                    <tr class="bodyarea">
                        <th colspan="<?php echo (count($feecode_array) + 3) ?>" class="t-left" style="padding:7px 0px 7px 5px;">Batch : <?php echo $key1 ?></th>
                    </tr>

                    <?php
                    $batch_total_amount = 0;
                    foreach ($feedata as $key2 => $classdata) {
                    ?>
                        
                            <tr class="header">
                                <td style="width:10% !important; text-align:left;" colspan="2">&nbsp;Admission No. : <?php echo $classdata['student_details']['Admn_No'] ?></td>
                                <td style="width:15% !important; text-align:left;" colspan="<?php echo (count($feecode_array) + 1) ?>">&nbsp;Student Name : <?php echo $classdata['student_details']['student_name'] ?></td>
                            </tr>
                            <tr class="header">
                                <td style="width:10% !important; text-align:left;" colspan="2">&nbsp;Voucher : <?php echo $classdata['student_details']['voucher_code'] ?></td>
                                <td style="width:10% !important; text-align:left;" colspan="<?php echo (count($feecode_array) + 1) ?>">&nbsp;Date : <?php echo date('d-m-Y', strtotime($classdata['student_details']['voucher_date'])) ?></td>
                            </tr>
                            <tr class="header">
                                <td style="width:5% !important;">Sl.No.</td>
                                <td style="width:10% !important;">Month</td>
                                <?php
                                $widthremain = 40;
                                $tdcount = 6;
                                foreach ($feecode_array as $key => $value) {
                                ?>
                                    <td style="text-align:right; width:<?php echo ($widthremain / (count($feecode_array))); ?>% !important"><?php echo $value['shortcode']; ?>&nbsp;</td>
                                <?php
                                    $tdcount++;
                                }
                                ?>
                                <td style="width:16% !important;text-align:right; ">Total&nbsp;</td>
                            </tr>
                        
                        <?php
                        $ic  = 1;
                        $student_total = 0;
                        foreach ($classdata['fee_details'] as $dem_date => $rpt_data) {
                        ?>
                            <tr class="bodyarea">
                                <td><?php echo $ic++ ?></td>
                                <td><?php echo date('M-Y', strtotime($dem_date)) ?></td>
                                <?php
                                $row_total_amt = 0;
                                foreach ($feecode_array as $kkey => $vvalue) {
                                    // if ($key2 == $kkey) {
                                    //     $cash = (isset($rpt_data['paid_amount']) ? $rpt_data['paid_amount'] : 0);
                                    // $row_total_amt = $row_total_amt + $cash;
                                    if (isset($rpt_data[$kkey])) $cash = $rpt_data[$kkey];
                                    else $cash = 0;
                                    $row_total_amt = $row_total_amt + $cash;
                                    // } else {
                                    //     $cash = 0;
                                    // }
                                ?>
                                    <td class="t-right"><?php echo my_money_format($cash) ?>&nbsp;</td>
                                <?php
                                }
                                $batch_total_amount += $row_total_amt;
                                $student_total += $row_total_amt;
                                ?>
                                <td class="t-right"><?php echo my_money_format($row_total_amt); ?>&nbsp;</td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr class="bodyarea">
                            <td class="t-right" colspan="<?php echo count($feecode_array) + 2 ?>">Student Total&nbsp;</td>
                            <td class="t-right"><b><?php echo my_money_format($student_total); ?></b>&nbsp;</td>
                        </tr>
                        <tr class="linetr">
                            <td colspan="<?php echo count($feecode_array) + 3 ?>"></td>
                        </tr>
                    <?php
                    }
                    $grand_total_amount += $batch_total_amount;
                    ?>
                    <tr class="bodyarea">
                        <td class="t-right" colspan="<?php echo count($feecode_array) + 2 ?>">Batch Total&nbsp;</td>
                        <td class="t-right"><b><?php echo my_money_format($batch_total_amount); ?></b>&nbsp;</td>
                    </tr>
                    <tr class="linetr">
                        <td colspan="<?php echo count($feecode_array) + 3 ?>"></td>
                    </tr>
            <?php
                }
            }
            ?>
            <tr class="bodyarea">
                <td class="t-right" colspan="<?php echo count($feecode_array) + 2 ?>"><b>Grand Total</b>&nbsp;</td>
                <td class="t-right"><b><?php echo my_money_format($grand_total_amount); ?></b>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <pagebreak />
    <br>
    <h3>Fee Code Descriptions</h3>
    <div style="float:left; width:24%; margin-right:1%;">
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($feecode_array as $key => $value) {
                ?>
                    <tr class="bodyarea">
                        <td class="t-right"> <?php echo $value['shortcode']; ?>&nbsp;</td>
                        <td class="t-left">&nbsp; <?php echo $value['description']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>