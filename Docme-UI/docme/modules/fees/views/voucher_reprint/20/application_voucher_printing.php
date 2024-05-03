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

            /*         @page {
            margin:0 !important;
          }*/
        }

        .table {
            border-spacing: 0;
            border-collapse: collapse;
            font-family: Roboto;
            font-size: 11px;
        }

        .table-bordered {
            border: 1px solid #fff;
        }

        .table-bordered tbody tr td,
        .table-bordered tbody tr th,
        .table-bordered tfoot tr td,
        .table-bordered tfoot tr th,
        .table-bordered thead tr td,
        .table-bordered thead tr th,
        .table-bordered tr th,
        .table-bordered tr td {
            border: 1px solid #fff !important;
        }
    </style>
    <?php
    $inst_id = $this->session->userdata('inst_id');
    $inst_name = $this->session->userdata('Institution_Name');
    $inst_place = $this->session->userdata('Institution_Place');
    $inst_email = $this->session->userdata('Institution_Email');
    $inst_phone = $this->session->userdata('Institution_Phone');
    $inst_url = $this->session->userdata('Institution_Url');
    //print_r($chqjson);

    // $divname = explode('/', $student_details['Batch_Name']);
    // if (is_array($divname) and !empty($divname)) {
    // $division = $divname[1];
    // } else {
    // $division = '-';
    // }
    $vouchercode = isset($master_data[0]['cheque_reconciled_voucher']) && !empty($master_data[0]['cheque_reconciled_voucher']) ? $master_data[0]['cheque_reconciled_voucher'] : $voucher_code;
    ?>
    <div class="print_element">
        <div style="float:left;width: 158mm; height:120mm !important; padding-left:11mm; padding-right:11mm;background: #fff; ">
            <div style="float:left; height:25mm; padding-top:8mm; width:100%; font-size: 10px;font-weight: normal;font-family: Arial;">
                <table width="100%">
                    <tr>
                        <td align="center" style="vertical-align:middle;">
                            <img src="<?php echo base_url('assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:80px;float: left;" />
                            <h3 style="margin-bottom:0px;"><?php echo $inst_name ?></h3>
                            <h5 style="margin-top:0px; margin-bottom:0px;">&nbsp;</h5>
                            <p style="margin-top:0px;"><?php echo $inst_place ?> Ph: <?php echo $inst_phone ?></p>
                            <p style="margin-top:0px;text-align: right;font-size: 12px;font-weight: 600;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="float:left; height:15mm; margin-top:1mm; width:100%; background:white;">
                <table class="table" border="0" style="border: 1px solid #333; width:100%; font-size: 12px;font-weight: normal;font-family: Arial;">
                    <tr>
                        <td style="padding-bottom: 0px;width: 50%;" colspan="2" width="75%">Name: <?php echo $student_account[0]['ApplicantName'] ?></td>
                        <td style="padding-bottom: 0px;text-align: left;" width="25%">Date: <?php echo date('d-m-Y', strtotime($master_data[0]['created_on'])); ?></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0px;padding-bottom: 0px;" colspan="3">Address: <?php echo $student_account[0]['Address'] ?></td>
                    </tr>
                    <tr>
                        <td style="width:48%;">Parent: <?php echo $student_account[0]['ParentName'] ?></td>
                        <td style="width:23%;">Phone: <?php echo $student_account[0]['Phone_No'] ?></td>
                        <td style="width:29%; text-align:left;">Voucher No.: <?php echo $vouchercode; ?></td>
                    </tr>
                </table>
            </div>
            <div style="float:left; height:38mm; margin-top:2mm; width: 597px; background:white;">
                <table width="100%" style="border-spacing: 0; border-collapse: collapse; font-family: arial;font-size: 11px;width: 100%; border: 1px solid #333; border-bottom: none;">
                    <tr>
                        <td style="width: 47px; text-align:center;padding-top: 5px;padding-bottom: 5px;border-bottom: 1px solid #333;">SlNo</td>
                        <td style="width: 275px;border-left: 1px solid #333 !important;padding-left: 5px;border-bottom: 1px solid #333;">Particulars</td>
                        <td style="width: 75px;text-align:center;border-left: 1px solid #333 !important;border-bottom: 1px solid #333;">Amount</td>
                        <td style="width: 200px;border-left: 1px solid #333 !important;padding-left: 5px;border-bottom: 1px solid #333;">Remarks</td>
                    </tr>
                    <tbody>
                        <?php
                        $cc  = 0;
                        $rcount = 4;
                        $wallet_total = 0;
                        $transaction_total = 0;
                        $itr = 1;
                        if (isset($student_account) && !empty($student_account)) {
                            foreach ($student_account as $account) {
                        ?>
                                <tr>
                                    <td style="width: 48px;text-align:center;border-right: 1px solid #333 !important;border-bottom:0 !important;padding-top: 5px;padding-bottom: 5px;"><?php echo ++$cc; ?></td>
                                    <td style="width: 275px;border-right: 1px solid #333 !important;padding-left: 5px;border-bottom:0 !important;">
                                        <?php echo $account['transaction_desc']; ?>
                                    </td>
                                    <td style="width: 75px;text-align:right;border-right: 1px solid #333 !important;border-bottom:0 !important;"><?php echo my_money_format($account['transaction_amount']); ?>&nbsp;</td>
                                    <td style="width: 200px;border-right: 1px solid #333 !important;padding-left: 7px;border-bottom:0 !important;">&nbsp;</td>
                                </tr>
                                <?php
                                $transaction_total += $account['transaction_amount'];
                                if (isset($account['service_charge']) && $account['service_charge'] > 0) {
                                ?>
                                    <tr>
                                        <td style="width: 48px;text-align:center;border-right: 1px solid #333 !important;border-bottom:0 !important;padding-top: 5px;padding-bottom: 5px;"><?php echo ++$cc; ?></td>
                                        <td style="width: 275px;border-right: 1px solid #333 !important;padding-left: 5px;border-bottom:0 !important;">
                                            Service Charge
                                        </td>
                                        <td style="width: 75px;text-align:right;border-right: 1px solid #333 !important;border-bottom:0 !important;"><?php echo my_money_format($account['service_charge']); ?>&nbsp;</td>
                                        <td style="width: 200px;border-right: 1px solid #333 !important;padding-left: 7px;border-bottom:0 !important;">&nbsp;</td>
                                    </tr>
                                <?php
                                    $transaction_total += $account['service_charge'];
                                }
                                $rcount--;
                                if ($itr == 4) {
                                    break;
                                } else {
                                    $itr = $itr + 1;
                                }
                            }
                            if ($rcount != 0) {
                                for ($i = 1; $i <= $rcount; $i++) {
                                ?>
                                    <tr>
                                        <td style="border-right: 1px solid #333 !important;padding-top: 5px;padding-bottom: 5px;">&nbsp;</td>
                                        <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                        <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                        <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                    </tr>
                        <?php
                                    $rcount--;
                                }
                            }
                        }
                        $grand_total = $transaction_total;
                        ?>
                        <tr>
                            <td colspan="2" style="border: 1px solid #333 !important;padding-top: 2px;padding-bottom: 3px; text-align:right;">TOTAL &nbsp;</td>
                            <td id="" style="text-align:right;border: 1px solid #333 !important;">
                                <?php echo print_currency('#676a6c', '12'); ?> <?php echo my_money_format($grand_total); //$master_data[0]['voucher_amount']
                                                                                ?>
                                &nbsp;</td>
                            <td style="border: 1px solid #333 !important;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="float:left; height:33mm; width:100%; background:#fff;">
                <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">Received Rs.
                    <span style="border-bottom:1px dotted #ccc;text-transform: Capitalize;float: right;width: 86%;"><b><?php echo convert_number_to_indian_words($grand_total); ?></b> Only
                        <span class="pull-right" style="float: right;">Amt / <b><?php echo my_money_format($grand_total); ?></b></span>
                    </span>
                </div>
                <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">
                    <span style="float:left; width:24%;"><?php echo $trantype ?></span>
                    <span style="float:left; width:31%;border-bottom:1px dotted #ccc;text-align: left;font-weight: 600;"><?php echo (isset($pay_data[0]['payment_reference']) ? $pay_data[0]['payment_reference'] : ''); ?>&nbsp;</span>
                    <span style="float: left;width: 5%;">&nbsp;Dt</span>
                    <span style="float:left; width:28%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data[0]['payment_datetime']) ? date('d-m-Y',strtotime($pay_data[0]['payment_datetime'])) : ''); ?>&nbsp;</span>
                    <span style="float: right;width: 12%;text-align: right;">Drawn on</span>
                </div>
                <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">
                    <span style="float:left; width:70%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data[0]['ch_bankname']) ? $pay_data[0]['ch_bankname'] : '&nbsp;'); ?> - <?php echo (isset($pay_data[0]['ch_bank_branch']) ? $pay_data[0]['ch_bank_branch'] : ''); ?></span>
                    <span style="float: right;width: 30%;text-align: right;">Bank Subjected to realisation</span>
                </div>
                <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">Printed By:
                    <span style="float: right;width: 87%;">&nbsp; <b><?php echo $user_name; ?></b>
                        <span style="float:right;">
                            <small> <b>* All amounts are in INR</b></small>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //window.print();
        w = window.open();
        w.document.write($('.print_element').html());
        setTimeout(function() {
            w.print();
            w.close();
        }, 500);
    </script>