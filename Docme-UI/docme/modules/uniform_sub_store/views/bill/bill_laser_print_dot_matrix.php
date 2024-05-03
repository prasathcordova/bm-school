<style>
    @media print {
        .print_element {
            page-break-after: always;
        }

        body {
            visibility: hidden;
        }

        .print_element {
            visibility: visible;
            position: absolute;
            top: 0;
        }
    }

    .newtable {
        border-collapse: collapse;
    }

    .newtable th {
        border: 2px solid #6d6868;
    }

    .newtable tr:first-child th {
        border-top: 0;
    }

    .newtable tr th:first-child {
        border-left: 0;
    }

    .newtable tr:last-child th {
        border-bottom: 0;
    }

    .newtable tr th:last-child {
        border-right: 0;
    }

    .watermark {
        margin-top: 2px;
        border: 2px solid #6d6868;
        border-radius: 20px;
        /* background-image: url('../../assets/dashboard_logos/watermark.png');
        background-repeat: no-repeat;
        background-position: center;
        background-size: auto; */
    }
</style>
<?php $newflag1 = 0; ?>
<div class="print_element" style="width:184.6mm;height:122.6mm;">
    <table width="100%" style="border: 2px solid #6d6868;border-radius: 20px;">
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
    <table width="100%" cellpadding="5" style="border: 2px solid #6d6868;border-radius: 20px;margin-top:3px;">
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
    <div style="height:80mm;" class="watermark">
        <table width="100%" cellpadding="5" class="newtable">
            <tbody>
                <tr>
                    <th style="font-size: 10px;text-align:center" width="50%"><strong>Description </strong><?php //echo $student_account[0]['ApplicantName'] 
                                                                                                            ?></th>
                    <th style="text-align: center; font-size: 10px;" width="10%"><strong>Rate</strong> <?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                        ?></th>
                    <th style="text-align: center; font-size: 10px;" width="10%"><strong>Quantity </strong><?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                            ?></th>
                    <th style="text-align: center; font-size: 10px;" width="10%"><strong>Amount </strong><?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                            ?></th>
                </tr>
                <!-- <tr>
                    <td style="font-size: 10px;border-right: 2px solid #6d6868;"><strong>[ <?php echo GSTNO ?>] <?php //echo isset($details_data['master_data']['kit_name']) ? ' [ KIT NAME : ' . $details_data['master_data']['kit_name'] . ' ] ' : ''; 
                                                                                                                ?> </strong></td>
                    <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"></td>
                    <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"></td>
                    <td style="text-align: right; font-size: 10px;" width="10%"></td>

                </tr> -->

                <?php
                $itr = 1;
                $end_counter = $itr + 8; //ends in 8
                $page_total = 0;
                if (isset($details_data) && !empty($details_data)) {
                    if ($details_data['master_data']['kit_name'] == '') {
                        foreach ($details_data['data'] as $items) {
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
                                <td style="text-align: right; font-size: 10px;" width="10%"><?php echo $items['final_total']; ?></td>


                                <!-- <td style="font-size: 10px;border-right: 2px solid #6d6868;" width="50%"><?php echo $items['item_name'] . '( ' . TAXNAME . '@' . $items['tax_percent'] . '% , Disc: ' . round($items['discount_amount'], 2, PHP_ROUND_HALF_UP) . ')'; ?></td>
                            <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"><?php echo $items['price']; ?></td>
                            <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"><?php echo $items['qty']; ?></td>
                            <td style="text-align: right; font-size: 10px;" width="10%"><?php echo $items['final_total']; ?></td> -->
                            </tr>
                        <?php
                            if ($itr == 9) { //end when the itration is 10
                                break;
                            } else {
                                $itr = $itr + 1; //else increment by one
                            }
                        }
                    } else {

                        ?>
                        <tr>
                            <td style="font-size: 10px;border-right: 2px solid #6d6868;" width="50%">
                                <?php
                                echo $details_data['master_data']['kit_name']
                                ?>
                            </td>
                            <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"><?php echo my_money_format($details_data['master_data']['final_total']); ?></td>
                            <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%">1.00</td>
                            <td style="text-align: right; font-size: 10px;" width="10%"><?php echo my_money_format($details_data['master_data']['final_total']); ?></td>

                        </tr>
                        <?php
                        for ($i = 0; $i <= 7; $i++) { ?>
                            <tr>
                                <td style="font-size: 10px;border-right: 2px solid #6d6868;" width="50%">&nbsp;</td>
                                <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%">&nbsp;</td>
                                <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%">&nbsp;</td>
                                <td style="text-align: right; font-size: 10px;" width="10%">&nbsp;</td>
                            </tr>
                        <?php  } ?>
                        <?php }

                    if (count($details_data['data']) <= ($end_counter - 9)) { //the condition is true when 1 or 2 items
                        // echo "<br/><br/>";
                        //echo $this->load->view('bill_summary_laser_print', array('details_data' => $details_data, 'flag' => 0), TRUE);
                    } else {
                        if (count($details_data['data']) == ($itr - 1)) {
                            $newflag1 = 1;
                            $addtdcounter = ($end_counter - $itr);
                            for ($i = 0; $i <= $addtdcounter; $i++) { ?>
                                <tr>
                                    <td style="font-size: 10px;border-right: 2px solid #6d6868;" width="50%">&nbsp;</td>
                                    <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%">&nbsp;</td>
                                    <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%">&nbsp;</td>
                                    <td style="text-align: right; font-size: 10px;" width="10%">&nbsp;</td>
                                </tr>

                        <?php  }
                        }
                    }
                }
                if ($details_data['master_data']['kit_name'] == '') {
                    if ($newflag1 == 1) { ?>
                        <tr>
                            <td style="font-size: 12px;text-align: left;border-right: 2px solid #6d6868;">&nbsp;</td>
                            <td style="font-size: 12px;text-align: right;border-top:2px solid #6d6868;border-right:2px solid #6d6868;" colspan="2"><strong>Total</strong></td>
                            <td style="text-align: right; font-size: 10px;border-top:2px solid #6d6868;" width="10%"><?php echo my_money_format($details_data['master_data']['final_total']); ?></td>
                        </tr>
                        <tr style="border-top: 2px solid #6d6868; border-bottom: 2px solid #6d6868;">
                            <td style="font-size: 12px;border-right: 2px solid #6d6868;text-align: left;">
                                <strong>Paid by <?php echo $details_data['master_data']['payment_mode'] ?></strong>
                                <?php if ($details_data['master_data']['balance_amount_to_pay'] > 0) { ?>
                                    <span style="margin-left: 175px;"><i>Balance Amount to Pay : <?php echo my_money_format($details_data['master_data']['balance_amount_to_pay']); ?></i></span>
                                <?php } ?>

                            </td>
                            <td style="font-size: 12px;border-right: 2px solid #6d6868;text-align: right;" colspan="2"><strong>Paid Amount</strong></td>
                            <td style="text-align: right; font-size: 10px;" width="10%"><?php echo my_money_format($details_data['master_data']['paid_amount']); ?></td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;text-align: left;border-top: 2px solid #6d6868;"><strong>Collected By:&nbsp;<?php echo $this->session->userdata('user_name'); ?></strong><br /></td>
                            <td style="text-align: left; font-size: 10px;border-top: 2px solid #6d6868;" colspan="3"><strong>Signature:<strong><br /></td>
                        </tr>
                    <?php } else { ?>
                        <tr style="border-top: 2px solid #6d6868; border-bottom: 2px solid #6d6868;">
                            <td style="font-size: 12px;border-right: 2px solid #6d6868;text-align: right;" colspan="3"><strong>TOTAL</strong>
                            <td style="text-align: right; font-size: 10px;" width="10%"><?php echo my_money_format($page_total); ?></td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;text-align: left;border-top: 2px solid #6d6868;"><strong>Collected By:&nbsp;<?php echo $this->session->userdata('user_name'); ?></strong><br /></td>
                            <td style="text-align: left; font-size: 10px;border-top: 2px solid #6d6868;" colspan="3"><strong>Signature:<strong><br /></td>
                        </tr>
                    <?php } ?>
                <?php } else {
                    $newflag1 = 0;
                ?>
                    <tr>
                        <td style="font-size: 12px;text-align: left;border-right: 2px solid #6d6868;">&nbsp;</td>
                        <td style="font-size: 12px;text-align: right;border-top:2px solid #6d6868;border-right:2px solid #6d6868;" colspan="2"><strong>Total</strong></td>
                        <td style="text-align: right; font-size: 10px;border-top:2px solid #6d6868;" width="10%"><?php echo my_money_format($details_data['master_data']['final_total']); ?></td>
                    </tr>

                    <tr style="border-top: 2px solid #6d6868; border-bottom: 2px solid #6d6868;">
                        <td style="font-size: 12px;border-right: 2px solid #6d6868;text-align: left;">
                            <strong>Paid by <?php echo $details_data['master_data']['payment_mode'] ?></strong>
                            <?php if ($details_data['master_data']['balance_amount_to_pay'] > 0) { ?>
                                <span style="margin-left: 150px;"><i>Balance Amount to Pay : <?php echo my_money_format($details_data['master_data']['balance_amount_to_pay']); ?></i></span>
                            <?php } ?>

                        </td>
                        <td style="font-size: 12px;text-align: right;border-right: 2px solid #6d6868;" colspan="2"><strong>Paid Amount</strong></td>
                        <td style="text-align: right; font-size: 10px;" width="10%"><?php echo my_money_format($details_data['master_data']['paid_amount']); ?></td>
                    </tr>
                    <tr>
                        <td style="font-size: 10px;text-align: left;border-top: 2px solid #6d6868;"><strong>Collected By:&nbsp;<?php echo $this->session->userdata('user_name'); ?></strong><br /></td>
                        <td style="text-align: left; font-size: 10px;border-top: 2px solid #6d6868;" colspan="3"><strong>Signature:<strong><br /></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php
    if ($itr == 9 && count($details_data['data']) > $itr) {
        echo "<br/>";
        echo $this->load->view('bill_laser_print_dot_matrix_nxt_page', array('bill_data' => $details_data, 'start_counter' => $itr), TRUE);
    } else if ($newflag1  == 1) {
        //echo $this->load->view('bill_summary_laser_print', array('details_data' => $details_data, 'flag' => 1), TRUE);
    }

    ?>
</div>
<script type="text/javascript">
    window.print();
</script>