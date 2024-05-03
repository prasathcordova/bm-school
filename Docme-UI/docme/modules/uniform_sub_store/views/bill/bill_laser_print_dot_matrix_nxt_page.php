<?php
$details_data = $bill_data;
$newflag = 0;
?>
<div style="width:184.6mm;height:122.6mm;">
    <table width="100%" border="0" style="border: 2px solid #6d6868;border-radius: 20px;margin-bottom:3px;">
        <tr>
            <td colspan="2" style="text-align:center;padding: 3px;">
                <img src="<?php echo base_url('assets/dashboard_logos/store.jpg'); ?>" alt="Globtech" style="width:120px;" />
            </td>
            <td style="padding-left: 5px;border-left: 2px solid #6d6868;">
                <p style="margin-top:0px; margin-bottom:0px;font-size: 11px;"> <?php echo STORE_ADDRESS ?></p><br /><br />
                <p style="margin-top:0px; margin-bottom:0px;font-size: 11px;">Receipt Voucher <?php echo isset($duplicate_label) ? $duplicate_label : '' ?></p>
                <!-- <p style="margin-top:0px;margin-bottom:0px;font-size: 9px;">Ajman - U.A.E.</p>
                <p style="margin-top:0px;margin-bottom:0px;font-size: 9px;">E-mail:technoalliancetrading@gmail.com</p> -->
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="5" style="border: 2px solid #6d6868;border-radius: 20px;">
        <tr>
            <td style="font-size: 10px;" width="45%"><strong>Admission No.: </strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $details_data['student_data']['Admn_No'] ?></td>
            <td style="text-align: left; font-size: 10px;" width="26%"><strong>Academic Year:</strong> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $details_data['student_data']['Acdyear'] ?></td>
            <td style="text-align: left; font-size: 10px;" width="29%"><strong>Date: </strong>&nbsp&nbsp&nbsp&nbsp;<?php echo date('d-m-Y', strtotime($details_data['master_data']['billing_date'])); ?></td>
        </tr>
        <tr>
            <td style="font-size: 10px;" colspan="3"><strong>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $details_data['student_data']['Student_Name'] ?></td>
        </tr>
        <tr>
            <td style="font-size: 10px;" width="45%"><strong>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $details_data['student_data']['Class'] ?></td>
            <td style="text-align: left; font-size: 10px;" width="26%"><strong>Division: </strong>&nbsp;&nbsp; &nbsp;&nbsp;<?php echo $details_data['student_data']['Division'] ?></td>
            <td style="text-align: left; font-size: 10px;" width="29%"><strong>Voucher No.: </strong>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $details_data['master_data']['billing_code']; ?></td>
        </tr>
    </table>
    <div style="height:70mm;" class="watermark">
        <table width="100%" cellpadding="5" class="newtable">
            <tbody>
                <tr>
                    <th style="font-size: 10px;text-align:center" width="50%"><strong>Description </strong></th>
                    <th style="text-align: center; font-size: 10px;" width="10%"><strong>Rate</strong> </th>
                    <th style="text-align: center; font-size: 10px;" width="10%"><strong>Quantity </strong></th>
                    <th style="text-align: center; font-size: 10px;" width="10%"><strong>Amount </strong></th>
                </tr>
                <?php
                $itr = 1;
                $a = 0;
                $counter = 1;
                $end_counter = $start_counter + 10;
                $page_total = 0;
                if (isset($details_data) && !empty($details_data)) {
                    foreach ($details_data['data'] as $items) {
                        if ($counter > $start_counter && $counter <= $end_counter) {
                ?>
                            <tr>
                                <td style="font-size: 10px;border-right: 2px solid #6d6868;" width="50%">
                                    <?php
                                    $page_total += $items['final_total'];
                                    echo $items['item_name'];
                                    ?>
                                </td>
                                <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"><?php echo $details_data['master_data']['kit_name'] !=  '' ? '-' : $items['price']; ?></td>
                                <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"><?php echo $items['qty']; ?></td>
                                <td style="text-align: right; font-size: 10px;" width="10%"><?php echo $details_data['master_data']['kit_name'] !=  '' ? '-' : $items['final_total']; ?></td>
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
                <?php
                if (count($details_data['data']) <= ($end_counter - 8)) { //9 and 10
                    echo $this->load->view('bill_summary_laser_print', array('details_data' => $details_data, 'flag' => 0), TRUE);
                } else {
                    $newflag = 1;
                    if (count($details_data['data']) >= ($counter - 1)) {
                        //$addtdcounter = ($end_counter - count($details_data['data'])) * 2;
                        $addtdcounter = ($end_counter - $counter);
                        for ($i = 0; $i < $addtdcounter; $i++) { ?>
                            <tr>
                                <td style="font-size: 10px;border-right: 2px solid #6d6868;" width="50%">&nbsp;</td>
                                <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%">&nbsp;</td>
                                <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%">&nbsp;</td>
                                <td style="text-align: right; font-size: 10px;" width="10%">&nbsp;</td>
                            </tr>

                <?php  }
                    }
                } ?>
                <tr style="border-top: 2px solid #6d6868; border-bottom: 2px solid #6d6868;">
                    <td style="font-size: 12px;border-right: 2px solid #6d6868;text-align: right;" colspan="3"><strong>Total</strong>
                    <td style="text-align: right; font-size: 10px;" width="10%"><?php echo my_money_format($page_total); ?></td>
                </tr>
                <tr>
                    <td style="font-size: 10px;text-align: left;border-top: 2px solid #6d6868;"><strong>Collected By:&nbsp;<?php echo $this->session->userdata('user_name'); ?></strong><br /><?php //echo $student_account[0]['ApplicantName'] 
                                                                                                                                                                                                ?></td>
                    <td style="text-align: left; font-size: 10px;border-top: 2px solid #6d6868;" colspan="3"><strong>Signature:<strong><br /><?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                                                                ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
if ($counter > ($start_counter + 9) && count($details_data['data']) > $counter) {
    echo "<br/>";
    echo $this->load->view('bill_laser_print_dot_matrix_nxt_page', array('bill_data' => $details_data, 'start_counter' => $end_counter), TRUE);
}
if ($newflag  == 1 && count($details_data['data']) <= $counter) {
    echo $this->load->view('bill_summary_laser_print', array('details_data' => $details_data, 'flag' => 1), TRUE);
}
?>