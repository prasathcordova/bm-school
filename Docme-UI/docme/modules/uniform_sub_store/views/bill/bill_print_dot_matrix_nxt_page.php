<?php
$details_data = $bill_data;
?>
<table border="0" style="width: 120mm;font-size: 9px;padding-top: 30mm;font-family: sans-serif;">
    <tr>
        <td style="padding-bottom: 10px;font-size: 12px;padding-left:34px;">&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo $details_data['student_data']['Admn_No'] ?></td>
        <td style=" padding-left: 30px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo $details_data['student_data']['Acdyear'] ?></td>
        <td style="    padding-left: 59px;font-size: 12px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<?php echo date('d-m-Y', strtotime($details_data['master_data']['billing_date'])); ?></td>
    </tr>
    <tr>
        <td style="padding-bottom:5px;" colspan="3">
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
<?php
$itr = 0;
?>
<table class="" style="width:120mm;" border="0" style="padding-left: -5px;">

    <tbody>

        <?php
        $counter = 0;
        $end_counter = $start_counter + 8;
        if (isset($details_data) && !empty($details_data)) {
            foreach ($details_data['data'] as $items) {
                if ($counter > $start_counter && $counter <= $end_counter) {
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
                    </tr>
        <?php
                    $counter = $counter + 1;
                } else if ($counter > $end_counter) {
                    break;
                } else {
                    $counter = $counter + 1;
                }
            }
        }
        ?>
    </tbody>
</table>

<?php
if ($counter >= ($start_counter + 8)) {
    echo $this->load->view('bill_print_dot_matrix_nxt_page', array('bill_data' => $details_data, 'start_counter' => $end_counter), TRUE);
}
?>