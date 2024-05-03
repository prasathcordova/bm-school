<?php
if ($flag == 1) {
?>
    <br />
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
                        <th style="font-size: 10px;text-align:center" width="50%"><strong>Description </strong><?php //echo $student_account[0]['ApplicantName'] 
                                                                                                                ?></th>
                        <th style="text-align: center; font-size: 10px;" width="10%"><strong>Rate</strong> <?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                            ?></th>
                        <th style="text-align: center; font-size: 10px;" width="10%"><strong>Quantity </strong><?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                                ?></th>
                        <th style="text-align: center; font-size: 10px;" width="10%"><strong>Amount </strong><?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                                ?></th>
                    </tr>
                <?php } ?>
                <tr style="text-align : left">
                    <td style="border-right: 2px solid #6d6868;" width="50%">
                        <table style="font-size: 12px;">
                            <tr>
                                <td colspan="3"><strong>-------------------------------------------------------</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>Bill Summary</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Payment Mode</strong></td>
                                <td>:</td>
                                <td> <?php echo $details_data['master_data']['payment_mode'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Sub Total</strong></td>
                                <td>:</td>
                                <td><?php echo CURRENCY  ?> <?php echo $details_data['master_data']['sub_total'] + $details_data['master_data']['round_off']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo TAXNAME  ?></td>
                                <td>:</td>
                                <td><?php echo CURRENCY  ?> <?php echo $details_data['master_data']['tax_amount']; ?></td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td>:</td>
                                <td><?php echo CURRENCY  ?> <?php echo $details_data['master_data']['discount_amount']; ?></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>:</td>
                                <td><?php echo CURRENCY  ?> <?php echo $details_data['master_data']['final_total']; ?></td>
                            </tr>
                            <tr>
                                <td>Paid Amount</td>
                                <td>:</td>
                                <td><?php echo CURRENCY  ?> <?php echo $details_data['master_data']['paid_amount']; ?></td>
                            </tr>
                            <?php if ($details_data['master_data']['balance_amount_to_pay'] > 0) { ?>
                                <tr>
                                    <td>Balance Amount to Pay</td>
                                    <td>:</td>
                                    <td><?php echo CURRENCY  ?> <?php echo $details_data['master_data']['balance_amount_to_pay']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"></td>
                    <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"></td>
                    <td style="text-align: right; font-size: 10px;" width="10%"></td>

                </tr>

                <?php
                if ($flag == 1) {
                ?>
                    <?php for ($i = 0; $i < 2; $i++) { ?>
                        <tr>
                            <td style="font-size: 10px;border-right: 2px solid #6d6868;" width="50%"></td>
                            <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"></td>
                            <td style="text-align: right; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"></td>
                            <td style="text-align: right; font-size: 10px;" width="10%"></td>
                        </tr>
                    <?php  } ?>
                    <tr style="border-top: 2px solid #6d6868; border-bottom: 2px solid #6d6868;">
                        <td style="font-size: 12px;text-align: right;"><strong>TOTAL</strong><?php //echo $student_account[0]['ApplicantName'] 
                                                                                                ?></td>
                        <td style="text-align: left; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"><?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                                    ?></td>
                        <td style="text-align: left; font-size: 10px;border-right: 2px solid #6d6868;" width="10%"><?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                                                    ?></td>
                        <td style="text-align: left; font-size: 10px;" width="10%"><?php //echo date('d-m-Y', strtotime($master_data[0]['created_on'])); 
                                                                                    ?></td>
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
<?php } ?>