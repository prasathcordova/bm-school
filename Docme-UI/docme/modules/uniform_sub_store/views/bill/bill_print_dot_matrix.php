<html>

<head>
    <style>
        @media print {
            .print_element {
                page-break-after: always;
            }
        }
    </style>
    <title>Bill - <?php echo $details_data['master_data']['billing_code']; ?> Dtd : <?php echo date('d-m-Y', strtotime($details_data['master_data']['billing_date'])); ?></title>
</head>

<body>

    <table border="0" style="width: 120mm;font-size: 9px;padding-top: 10.0mm;font-family: sans-serif;">
        <tr>
            <td style="padding-bottom: 8px;font-size: 12px;padding-left:34px;">&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo $details_data['student_data']['Admn_No'] ?></td>
            <td style=" padding-left: 30px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo $details_data['student_data']['Acdyear'] ?></td>
            <td style="    padding-left: 59px;font-size: 12px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo date('d-m-Y', strtotime($details_data['master_data']['billing_date'])); ?></td>
        </tr>
        <tr>
            <td style="padding-bottom:1px;" colspan="3">
                <table border="0" style="width:100%;font-size: 12px;font-family: sans-serif;">
                    <tr>
                        <td style="padding-left:30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $details_data['student_data']['Student_Name'] ?></td>
                    </tr>
                </table>
            </td>
            <!--<td>Division : B</td>-->
        </tr>
        <tr>
            <td style="padding-left:32px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo $details_data['student_data']['Class'] ?></td>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<?php echo $details_data['student_data']['Division'] ?></td>
            <td style="font-size:11px;padding-left: 18px;">&nbsp&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $details_data['master_data']['billing_code']; ?></td>
        </tr>
    </table>


    <br />



    <table class="" style="width:120mm;" border="0" style="padding-left: -5px;">

        <tbody>
            <tr>
                <td colspan="4" style="font-size: 11px;font-family: Arial;">[ <?php echo GSTNO ?>] <?php echo isset($details_data['master_data']['kit_name']) ? ' [ KIT NAME : ' . $details_data['master_data']['kit_name'] . ' ] ' : ''; ?> </td>
            </tr>
            <?php
            $itr = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data['data'] as $items) {
            ?>
                    <tr>
                        <td style="padding-top:2px;width:100mm;font-size: 11px;font-family: Arial;">
                            <?php
                            if ($details_data['master_data']['kit_name'] == '')
                                echo $items['item_name'] . '( ' . TAXNAME . '@' . $items['tax_percent'] . '% , Disc: ' . round($items['discount_amount'], 2, PHP_ROUND_HALF_UP) . ')';
                            else
                                echo $items['item_name'];
                            ?>
                        </td>
                        <td style="padding-top:2px;width:20mm;text-align: left;font-size: 12px;"><?php echo $details_data['master_data']['kit_name'] !=  '' ? '-' : $items['price']; ?></td>
                        <td style="padding-top:2px;width:20mm;text-align: left;font-size: 12px;"><?php echo $items['qty']; ?></td>

                        <td style="padding-top:2px;width:20mm;text-align: right;font-size: 12px;padding-right: 10px;"><?php echo $details_data['master_data']['kit_name'] !=  '' ? '-' : $items['final_total']; ?></td>


                        <!-- <td style="padding-top:2px;width:100mm;font-size: 11px;font-family: Arial;"><?php echo $items['item_name'] . '( ' . TAXNAME . '@' . $items['tax_percent'] . '% , Disc: ' . round($items['discount_amount'], 2, PHP_ROUND_HALF_UP) . ')'; ?> </td>
                        <td style="padding-top:2px;width:20mm;text-align: left;font-size: 12px;"><?php echo $items['price']; ?></td>
                        <td style="padding-top:2px;width:20mm;text-align: left;font-size: 12px;"><?php echo $items['qty']; ?></td>

                        <td style="padding-top:2px;width:20mm;text-align: right;font-size: 12px;padding-right: 10px;"><?php echo $items['final_total']; ?></td> -->
                    </tr>
            <?php
                    if ($itr >= 7) {
                        break;
                    } else {
                        $itr = $itr + 1;
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <?php
    if ($itr == 7) {
        echo $this->load->view('bill_print_dot_matrix_nxt_page', array('bill_data' => $details_data, 'start_counter' => $itr), TRUE);
    }
    if (count($details_data['data']) % 6 < 3) {
        echo $this->load->view('bill_summary_print', array('details_data' => $details_data, 'padding' => 2), TRUE);
    } else {
        echo $this->load->view('bill_summary_print', array('details_data' => $details_data, 'padding' => 75), TRUE);
    }
    ?>

</body>
<script type="text/javascript">
    window.print();
</script>

</html>