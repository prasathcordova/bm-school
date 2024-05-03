<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php $vouchercode = $master_data[0]['voucher_code']; ?>
                <i class="fa fa-file-text-o"></i> Voucher Details - <?php echo $vouchercode; ?>
                <input type="hidden" name="vvtype" id ="vvtype" value="<?php echo $vvtype?>">
                <span id="voucher_print" style="float: right;">
                    <a data-toggle="tooltip" title="Print Voucher : <?php echo $voucher_code; ?>" href="javascript:void(0);" onclick="re_print_voucher(<?php echo $voucher_id; ?>, '<?php echo $voucher_code; ?>','reprint');return false;">
                        <i class="fa fa-print" style="font-size: 22px;color: white; padding-right: 15px;"></i>
                    </a>
                </span>
                <span id="voucher_mail" style="float: right;">
                    <a data-toggle="tooltip" title="Email Voucher : <?php echo $voucher_code; ?>" href="javascript:void(0);" onclick="re_print_voucher(<?php echo $voucher_id; ?>, '<?php echo $voucher_code; ?>','sendmail');return false;">
                        <i class="fa fa-inbox" style="font-size: 22px;color: white; padding-right: 15px;"></i>
                    </a>
                </span>
                <?php // }
                // $divname = explode('/', $student_details['Batch_Name']);
                // if (is_array($divname) and !empty($divname)) {
                //     $division = $divname[1];
                // } else {
                //     $division = '-';
                // }
                $division = $student_details['Batch_Name'];
                ?>

            </div>
            <div class="panel-body printing-area">
                <!--height: 150px !important;-->

                <div class="" style="">
                    <table class="table invoice-table" style="width: 100%;font-size: 13px;font-weight: normal;">
                        <thead>
                            <tr>
                                <th width="50%">Description</th>
                                <th width="25%" style="text-align: right;">Month</th>
                                <th width="25%" style="text-align: right;">Amount</th>
                                <!--<th>Remarks</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $wallet_total = 0;
                            $transaction_total = 0;
                            $servicecharge = 0;
                            //dev_export($student_account);
                            if (isset($student_account) && !empty($student_account)) {
                                foreach ($student_account as $account) {
                            ?>
                                    <tr>
                                        <td><?php echo $account['transaction_desc']; ?></td>
                                        <td><?php if (isset($account['demandmonth'])) {
                                                echo date('M Y', strtotime($account['demandmonth']));
                                            } else {
                                                echo '-';
                                            } ?></td>
                                        <td><?php echo my_money_format($account['transaction_amount']); ?></td>
                                        <!--<td></td>-->

                                    </tr>
                                    <?php
                                    $transaction_total += $account['transaction_amount'];

                                    if (isset($account['service_charge']) && $account['service_charge'] > 0) {
                                        $servicecharge = $account['service_charge'];
                                    ?>
                                        <tr>
                                            <td>Service Charge</td>
                                            <td>-</td>
                                            <td><?php echo my_money_format($servicecharge); ?></td>
                                            <!--<td></td>-->

                                        </tr>
                            <?php
                                    }
                                }
                            }
                            $grand_total = $transaction_total + $wallet_total + $servicecharge;
                            ?>
                            <tr>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right;"><strong>Total </strong></td>
                                <td id="" style="text-align:right;">
                                    <p id="tbl_total" style="font-weight: bold; margin-bottom: 0;"> <?php echo print_currency('#676a6c', '12'); ?> <?php echo my_money_format($grand_total); //$master_data[0]['voucher_amount'] 
                                                                                                                                                    ?></p>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('.scroll_content').slimscroll({
        height: '250px',
        color: '#f8ac59'
    });
    //    function print_voucher(){
    //        w=window.open();
    //        w.document.write($('.printing-area').html());
    //        w.print();
    //        w.close();
    //    }
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }

    function re_print_voucher(voucher_id, voucher_code, issue = "reprint") {
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var mailtosend = $('#mailtosend').val();
        var vtype = voucher_code.substring(0, 3);
        var vvtype = $('#vvtype').val();
        if (vtype == 'APR') {
            var ptype = 'regfee';}
            else{
                if(vvtype == 'temp_regfee'){var ptype = 'temp_regfee';}
            }
        if (issue == 'confirmmail') {
            $('#voucher_data_loader').addClass('sk-loading');
            if (mailtosend.length == 0) {
                $('#mailtosend').focus();
                $('#voucher_data_loader').removeClass('sk-loading');
                swal('', 'To Email Required', 'warning');
                return false;
            }
            if (IsEmail(mailtosend) == false) {
                $('#mailtosend').focus();
                $('#voucher_data_loader').removeClass('sk-loading');
                swal('', 'Invalid Email', 'warning');
                return false;
            }

        }
        var ops_url = baseurl + 'fees/print_voucher_reprint/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "voucher_id": voucher_id,
                "voucher_code": voucher_code,
                "student_name": student_name,
                "student_id": student_id,
                "issue": issue,
                "mailtosend": mailtosend,
                "ptype": ptype
            },
            success: function(result) {
                $('#voucher_data_loader').removeClass('sk-loading');
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('.printing-area').html('');
                    $('.printing-area').html(data.view);
                    //$('#voucher_data_loader').addClass('sk-loading');

                } else if (data.status == 3) {
                    select_items(voucher_id, voucher_code, vtype);
                } else {
                    alert('No data loaded');
                }
                if (issue == 'reprint') {
                    if(ptype == 'temp_regfee'){
                        select_items(voucher_id, voucher_code, 'REGFEE');
                    }else{
                        select_items(voucher_id, voucher_code, vtype);
                    }                    
                }
                if (issue == 'confirmmail') {
                    swal('Mail Voucher','Mail sent successfully.','info');
                    $('#voucher_data_loader').removeClass('sk-loading');
                    if(ptype == 'temp_regfee'){
                        select_items(voucher_id, voucher_code, 'REGFEE');
                    }else{
                        select_items(voucher_id, voucher_code, vtype);
                    }
                }

            }
        });
        $('#voucher_data_loader').removeClass('sk-loading');
    }
</script>