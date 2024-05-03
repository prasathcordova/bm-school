<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5>FEE EXEMPTION</h5>
                    <span style="float:right;">
                        <a href="javascript:" title="Reload" onclick="reload_exemption_detail(<?php echo $student_data['student_id']; ?>, '<?php echo trim($student_data['student_name']); ?>');"><i class="fa fa-refresh" style="font-size: 20px;"></i></a>
                        <input type="hidden" name="excess_amount" id="excess_amount" value="0" />
                    </span>
                </div>
                <div class="ibox-content" id="pay_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="like_button_container"></div>
                                <div class="profile-image">
                                    <?php
                                    $profile_image = "";
                                    if (!empty(get_student_image($student_data['student_id']))) {
                                        $profile_image = get_student_image($student_data['student_id']);
                                    } else
                                    if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {

                                        $profile_image = "data:image/jpeg;base64," . $student_data['profile_image'];
                                    } else {
                                        if (isset($student_data['profile_image_alternate']) && !empty($student_data['profile_image_alternate'])) {
                                            $profile_image = $student_data['profile_image_alternate'];
                                        } else {
                                            $profile_image = base_url('assets/img/a0.jpg');
                                        }
                                    }
                                    ?>
                                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="margin-top: 0px;border-top-width: 0px;" />
                                </div>
                                <div class="profile-info">
                                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_data['student_id']; ?>" />
                                    <input type="hidden" name="student_name" id="student_name" value="<?php echo $student_data['student_name']; ?>" />
                                    <input type="hidden" id="student_admn_no" value="<?php echo $student_data['Admn_No']; ?>">
                                    <input type="hidden" id="student_batch" value="<?php echo $student_data['Batch_Name']; ?>">
                                    <input type="hidden" id="student_class" value="<?php echo $student_data['Description']; ?>">
                                    <input type="hidden" id="inst_id" value="<?php echo $this->session->userdata('inst_id'); ?>">
                                    <input type="hidden" id="today_date" value="<?php echo date('Y-m-d H:m:s.i'); ?>">
                                    <input type="hidden" name="transaction_ID" id="transaction_ID" value="<?php echo $transaction_ID; ?>" />


                                    <div class="">
                                        <div>

                                            <h4><?php echo $student_data['student_name']; ?></h4>
                                            <small>
                                                Admission No. : <?php echo $student_data['Admn_No']; ?>
                                            </small><br>
                                            <small>
                                                Batch : <?php echo $student_data['Batch_Name']; ?>
                                            </small><br>
                                            <small>
                                                Class : <?php echo $student_data['Description']; ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-top:5px; float: right;">
                                <div class="widget lazur-bg no-padding" style="margin-top:0px;">
                                    <div class="p-m" style="padding:3px !important; display: inline-block">
                                        <h1 class="m-xs" style="text-align:center">
                                            <?php print_currency('white'); ?>
                                            <?php echo my_money_format($fee_summary); //- $pending_vat
                                            ?>
                                        </h1>

                                        <h3 class="font-bold no-margins" style="text-align:center;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            <!-- (Incl. of <?php echo print_tax_vat(); ?>)-->Payable Amount
                                            <input type="hidden" name="total_payable_amount" id="total_payable_amount" value="<?php echo $fee_summary; //- $pending_vat 
                                                                                                                                ?>" />
                                            <input type="hidden" name="total_payable_amount_rounded" id="total_payable_amount_rounded" value="<?php echo $fee_summary; // - $pending_vat, 2) 
                                                                                                                                                ?>" />
                                        </h3>
                                    </div>
                                    <div class="p-m" style="padding:3px !important; display: inline-block;float: right;">
                                        <h1 class="m-xs" style="text-align:center">
                                            <!--                                            <i class="fa fa-inr" aria-hidden="true" style="color:#FFF "></i>  -->
                                            <?php print_currency('white'); ?>
                                            <?php echo isset($e_wallet) && !empty($e_wallet) ? my_money_format($e_wallet) : my_money_format(0); ?>
                                        </h1>

                                        <h3 class="font-bold no-margins" style="text-align:center;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            Docme Wallet
                                            <input type="hidden" name="total_e_wallet_amount" id="total_e_wallet_amount" value="<?php echo $e_wallet; ?>" />
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .dataTables_wrapper {
                                    padding-bottom: 0px !important;
                                    padding-top: 10px !important;
                                }
                            </style>

                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div id="small-chat" style="bottom:0px !important; top:134px !important; right: -16px !important;">
                                    <!-- Changed by SALAHUDHEN May 29, 2019 title ='Move to Payment options' to title="Move to Payment Listing"-->
                                    <a class="open-small-chat" href="#history_panel" data-toggle="tooltip" title="Move to Payment Listing">
                                        <i class="fa fa-arrow-down"></i>

                                    </a>
                                </div>
                                <div class="ibox-content" style=" padding-right: 1%;" id="fees_summary">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
                                            <select name="feecode_id" id="feecode_id" class="form-control " style="width:100%;" onchange="change_view(<?php echo $student_data['student_id']; ?>, '<?php echo trim($student_data['student_name']); ?>');">
                                                <option selected value="-1">All Fee Code</option>
                                                <?php
                                                if (isset($feecodes_available) && !empty($feecodes_available)) { //feeid_sel
                                                    foreach ($feecodes_available as $feecode) {
                                                        if (in_array($feecode['feeCode'], $demandedfeecodes)) {
                                                            //if ($feecode['feeCode'] != 'F101') { //F101 for Registration Fee 
                                                ?>
                                                            <option value="<?php echo $feecode['id']; ?>" <?php if ($feeid_sel == $feecode['id']) echo "selected=selected"; ?>><?php echo $feecode['description']; ?></option>
                                                <?php }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6">
                                            <div class="input-group m-b" style="margin-bottom: 0px;">
                                                <span class="input-group-addon">
                                                    <!--                                                    <i class="fa fa-inr" aria-hidden="true" style="color:hotpink;font-size: 15px; "></i> -->
                                                    <?php print_currency('hotpink'); ?>
                                                </span>
                                                <input type="text" placeholder="Enter amount to Exempt" class="form-control digits text-right disabledragpaste" maxlength="10" name="amt_distribute" id="amt_distribute" style="height: 39px !important;">
                                                <span class="input-group-btn"> <button style="background:hotpink !important;border-color: hotpink !important;height: 39px !important;padding-bottom: 0px;margin-bottom: 0px;border-bottom-width: 0px;border-top-width: 0px;" type="button" onclick="distribute_amount();" class="btn btn-primary">Distribute to exempt
                                                    </button> </span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="clearfix"></div>
                                        <div class="col-lg-12" id="history_panel" style="margin-top: 10px;">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="tbl_fee_allocation_data" style="padding-bottom: 0px !important;padding-top: 0px !important;width: 100%">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th>Date</th> -->
                                                            <th width="15%;">Month</th>
                                                            <th>Fee Description </th>
                                                            <th>Demanded Amount</th>
                                                            <!--<th>Amt With VAT already</th>-->
                                                            <th>Amount Paid</th>
                                                            <!-- <th>Concession</th> -->
                                                            <!-- <th>Amt. to be realized</th> Payable Amt.-->
                                                            <th>Balance Amount</th>
                                                            <th>Distributed Amount</th>
                                                            <!--Amount Wish to pay-->
                                                            <!-- <th>Dist.Amt + <?php echo print_tax_vat(); ?></th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        //dev_export($fee_data);
                                                        if (isset($fee_data) && !empty($fee_data)) {
                                                            foreach ($fee_data as $fees) {
                                                                if ($feeid_sel == -1 || $feeid_sel == $fees['FEEID']) {
                                                                    $transactionamt = ($fees['TRANSACTION_AMOUNT']); //($fees['VAT'] * $fees['TRANSACTION_AMOUNT'] / 100) + 
                                                                    $pendingpayment = ($fees['PENDING_PAYMENT']); // + ($fees['VAT'] * $fees['PENDING_PAYMENT'] / 100)
                                                                    $totalpaid = (($fees['TOTAL_PAID_AMOUNT'])); // + ($fees['VAT'] * $fees['TOTAL_PAID_AMOUNT'] / 100)));
                                                                    $exmptnamt = (($fees['EXEMPTION_AMOUNT'])); // + ($fees['VAT'] * $fees['EXEMPTION_AMOUNT'] / 100)
                                                                    $exmptnamt_pending = (($fees['EXEMPTION_PENDING'])); // + ($fees['VAT'] * $fees['EXEMPTION_AMOUNT'] / 100)
                                                                    $consnamt = (($fees['CONCESSION_AMOUNT'])); // + ($fees['VAT'] * $fees['CONCESSION_AMOUNT'] / 100)
                                                                    $gtotalpaid = $totalpaid + $fees['TOTAL_NON_RECONCILED_AMOUNT'] + $consnamt + $exmptnamt + $exmptnamt_pending;
                                                        ?>
                                                                    <tr <?php if ($fees['IS_ARREAR'] == 1) { ?>style="color:hotpink;" <?php } ?>>
                                                                        <td><?php echo date('M-Y', strtotime($fees['DEMAND_DATE'])); ?></td>
                                                                        <td><span title="<?php echo $fees['TRANSACTION_DESC_TOOLTIP']; ?>"><?php echo $fees['TRANSACTION_DESC']; ?></span></td>
                                                                        <td class="text-right"><?php echo my_money_format($fees['TRANSACTION_AMOUNT']); ?></td>
                                                                        <?php $total_pending_amt = ($transactionamt - $gtotalpaid); ?>
                                                                        <td class="text-right"><?php echo my_money_format($totalpaid > 0 ? $totalpaid : 0); ?></td>
                                                                        <td class="text-right">
                                                                            <?php echo my_money_format($total_pending_amt); ?>
                                                                            &nbsp;<span style="cursor: pointer;" onclick="view_payment(<?php echo $i; ?>,this);" title="View Pay Details"><i class="fa fa-eye"></i></span>
                                                                        </td>
                                                                        <td class="data_collector text-right" data-iterator="<?php echo $i; ?>" id="itr_<?php echo $i; ?>" data-transactionid="<?php echo $fees['ID']; ?>" data-demanddate="<?php echo $fees['DEMAND_DATE'] ?>" data-transactionamount="<?php echo $fees['TRANSACTION_AMOUNT'] ?>" data-pendingpayment="<?php echo $total_pending_amt ?>" data-transactionvatpercent="<?php echo $fees['VAT'] ?>" data-transactionvatamt="<?php echo round(($fees['VAT'] * $pendingpayment / 100), 4) ?>" data-transactionamtwithvat="<?php echo $total_pending_amt; ?>" data-description="<?php echo str_replace("demanded", "paid", $fees['TRANSACTION_DESC']); ?>" data-nonrealized="<?php echo round($fees['TOTAL_NON_RECONCILED_AMOUNT'], 4); ?>" data-termid="<?php echo $fees['TERM_ID']; ?>" data-termfee_demand_det_id="<?php echo $fees['termfee_demand_det_id']; ?>">
                                                                            <?php echo my_money_format(0); ?>
                                                                        </td>
                                                                        <!-- <td class="data_collector text-right" data-iterator="<?php echo $i; ?>" id="awt_<?php echo $i; ?>">
                                                                        <?php echo my_money_format(0); ?>
                                                                    </td> -->
                                                                    </tr>
                                                                    <!-- View Payment Details : Starts -->
                                                                    <tr class="notesa hide" id="pay<?php echo $i; ?>">
                                                                        <td colspan="8">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <h5><?php echo $fees['TRANSACTION_DESC_TOOLTIP']; ?>
                                                                                        <span class="pull-right" style="cursor: pointer;" onclick="close_pay(<?php echo $i; ?>)" title="Close Pay Details"><i class="fa fa-times"></i></span>
                                                                                    </h5>

                                                                                    <hr style="margin: 7px 0 4px 0;">
                                                                                    <table class="table table-bordered table-striped" style="margin-bottom: 0px;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <!-- <th style="width:16%;text-align:right;">Demanded&nbsp;</th> -->
                                                                                                <!-- <th style="width:13%;text-align:right;">Total Paid&nbsp;</th> -->
                                                                                                <th style="width:19%;text-align:right;">Amt. to be realized&nbsp;</th>
                                                                                                <!-- <th style="width:15%;text-align:right;">Concession&nbsp;</th> -->
                                                                                                <th style="width:16%;text-align:right;">Exemption&nbsp;</th>
                                                                                                <th style="width:16%;text-align:right;">Exemption Pending&nbsp;</th>
                                                                                                <!-- <th style="width:16%;text-align:right;">Pending&nbsp;</th> -->
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- <td class="text-right"><?php echo my_money_format($fees['TRANSACTION_AMOUNT']); ?></td> -->
                                                                                                <!-- <td class="text-right"><?php echo my_money_format($totalpaid); ?></td> -->
                                                                                                <td class="text-right"><?php echo my_money_format(($fees['TOTAL_NON_RECONCILED_AMOUNT'] > 0) ? $fees['TOTAL_NON_RECONCILED_AMOUNT'] : '0'); ?></td>
                                                                                                <!-- <td class="text-right"><?php echo my_money_format(($fees['CONCESSION_AMOUNT'] > 0) ? $fees['CONCESSION_AMOUNT'] : '0'); ?></td> -->
                                                                                                <td class="text-right"><?php echo my_money_format(($exmptnamt > 0) ? $exmptnamt : '0'); ?></td>
                                                                                                <td class="text-right"><?php echo my_money_format(($exmptnamt_pending > 0) ? $exmptnamt_pending : '0'); ?></td>
                                                                                                <!-- <td class="text-right"><b><?php echo $total_pending_amt; ?></b></td> -->
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- View Payment Details : Ends -->
                                                        <?php
                                                                    $i = $i + 1;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td class="text-right" colspan="5">Distributed Amount</td>
                                                            <td class="text-right" colspan="1">
                                                                <?php echo print_currency('hotpink', '13') ?> <span class="totdistamt"><?php echo my_money_format(0); ?></span>
                                                            </td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td class="text-right" colspan="5">Round Off</td>
                                                            <td class="text-right" colspan="1">
                                                                <?php echo print_currency('hotpink', '13') ?> <span class="roundoffamt">0.00</span>
                                                            </td>
                                                        </tr> -->
                                                        <!-- <tr>
                                                            <td class="text-right" colspan="5">Total Amount</td>
                                                            <td class="text-right" colspan="1">
                                                                <?php echo print_currency('hotpink', '13') ?> <span class="totalamttopay">0.00</span>
                                                            </td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                                <!-- <span class="pull-right label label-info" style="position: absolute;right: 15px;bottom: 40px;font-size: 13px;">Total Amount <?php echo print_currency('white', '13') ?> : <span class="totalamttopay">0.00</span></span> -->
                                                <input type="hidden" name="totdistamt" id="totdistamt" />
                                                <input type="hidden" name="roundoffamt" id="roundoffamt" />
                                                <input type="hidden" name="totamt" id="totamt" />

                                            </div>
                                            <input type="hidden" name="iter_count" id="iter_count" value="<?php echo $i; ?>" />
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                            <hr>
                                            <label>Reason For Fee Exemption</label>
                                            <div class="input-group m-b" style="margin-bottom: 0px;">
                                                <input type="text" placeholder="Reason for fee exemption" class="form-control alphanumeric" maxlength="250" name="reason_exempt" id="reason_exempt" style="height: 39px !important;">
                                                <span class="input-group-btn"> <button style="height: 39px !important; cursor: pointer;" type="button" onclick="exempt_fee();" class="btn btn-primary">Exempt Fee
                                                    </button> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="student-print-container"></div>

<script type="text/javascript">
    $('#feecode_id').select2({
        'theme': 'bootstrap'
    });

    function view_payment(ab, el) {
        $('#pay' + ab).toggleClass('hide');

        if ($('#pay' + ab).hasClass('hide')) {
            $(el).attr('title', "View Pay Details");
        } else {
            $(el).attr('title', 'Close Pay Details');
        }
    }

    function close_pay(ab) {
        $('#pay' + ab).addClass('hide');
    }
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('#amt_distribute').change(function() {
        $('#amt_distribute_ops').val('0');
    });

    function do_distribution(amt_pay_raw) {
        //alert(amt_pay_raw);
        var float = /^\s*(\+)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
        if (!(float.test(amt_pay_raw))) {
            swal('', 'Enter a valid amount to process', 'info');
            return false;
        }
        var amt_pay = parseFloat(amt_pay_raw).toFixed(2);
        if (!($('#amt_distribute').val() > 1)) { // Changed 0 as 1
            swal('', 'Enter amount > 1', 'info');
            return false;
        }
        var j = 0;
        var limit = $('#iter_count').val();
        var idname = '';
        var iidname = '';
        var value = 0;
        var totamt = 0;
        $('.data_collector').html('0')
        var table = $('#tbl_fee_allocation_data'); //.DataTable();
        var payableamt = $('#total_payable_amount_rounded').val();
        var exsamount = (amt_pay - payableamt).toFixed(2); // Find Excess Amount
        if ((exsamount) > 0) {
            $('.amt_after_distribute').html(exsamount);
            $('#excess_amount').val((exsamount));
        } else {
            $('.amt_after_distribute').html('0');
            $('#excess_amount').val('0');
        }

        while (j < limit) {
            idname = "#itr_" + j + "";
            iidname = "#awt_" + j + "";
            value = parseFloat($(idname).data('transactionamtwithvat'));
            var vatamt = parseFloat($(idname).data('transactionvatamt'));
            var vatpercent = parseFloat($(idname).data('transactionvatpercent'));
            var vatofdistamt = (vatpercent * amt_pay / 100);
            var totdisamtplusvat = (1 * amt_pay) + (1 * (vatofdistamt));
            var demand_amt = (amt_pay * 100) / (100 + vatpercent); // to find amount without vat from inclusive vat amount
            var vaaat = ((demand_amt * vatpercent) / 100);
            var tot_demand_amt_for_col = demand_amt + vaaat;

            if ((amt_pay - value) >= 0) {
                $(idname).html(value.toFixed(2)); // - vatamt
                $(iidname).html((value).toFixed(2));
                amt_pay = parseFloat(amt_pay - value).toFixed(2);
                totamt = parseFloat((totamt * 1) + (value * 1)).toFixed(2);
                j = j + 1;
            } else {
                var abcd = amt_pay;
                $(idname).html(parseFloat(abcd).toFixed(2));
                //$(idname).html(amt_pay.toFixed(4)); //changed as top line due console error of tofixed()- unknown function -OCT 14, 2019// - vaaat
                $(iidname).html(parseFloat(tot_demand_amt_for_col).toFixed(2));
                amt_pay = parseFloat(amt_pay - (tot_demand_amt_for_col)).toFixed(2);
                totamt = parseFloat((totamt * 1) + ((tot_demand_amt_for_col) * 1)).toFixed(2);
                j = limit + 1;
            }
        }
        //if (amt_pay > 0) {
        // if (($('#total_payable_amount').val().tofixed(2) - ) > 0) {
        //     $('.amt_after_distribute').html(amt_pay);
        //     $('#excess_amount').val((amt_pay));
        // } else {
        //     $('.amt_after_distribute').html('0');
        //     $('#excess_amount').val('0');
        // }
        //alert(totamt);
        var totamt_pay = totamt;
        var totdistamt = totamt;
        //***
        var num = totamt_pay.toString(); //If it's not already a String
        num = num.slice(0, (num.indexOf(".")) + 5); //With 3 exposing the hundredths place
        Number(num); //If you need it back as a Number
        //* */
        totamt = parseFloat(totamt).toFixed(2);
        var roundoffamt = ((totamt * 1) - (num * 1)).toFixed(2);
        //$('.totalamttopay').html(totamt);
        $('.totdistamt').html(totamt); //num
        //$('.roundoffamt').html(roundoffamt);

        //$('#totdistamt').val(totamt);
        $('#totamt').val(totdistamt);
        //$('#roundoffamt').val(roundoffamt);

        //SALAHUDHEEN
        $('#amt_distribute_ops').val('1');

        // var card_excess = amt_pay - sercharge;
        // if (card_excess > 0) {
        //     $('#amt_after_distribute_card').html((card_excess));
        //     $('#excess_amount_by_card').val((card_excess));
        // } else {
        //     $('#amt_after_distribute_card').html('0');
        //     $('#excess_amount_by_card').val('0');
        // }
    }

    function distribute_amount() {
        var total_payable_amount = $('#total_payable_amount').val();
        var amt_pay_raw = $('#amt_distribute').val();
        if ((amt_pay_raw * 1) > (total_payable_amount * 1)) {
            swal({
                title: 'Exemption Amount',
                text: 'Distributed amount greater than Payable amount. Set Payable amount as Distribution amount?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#23c6c8',
                cancelButtonColor: '#000',
                confirmButtonText: 'YES',
                cancelButtonText: 'NO',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    if (total_payable_amount == 0) total_payable_amount = '0.00';
                    $('#amt_distribute').val(parseFloat(total_payable_amount).toFixed(2));
                    do_distribution(total_payable_amount);
                    return true;
                } else {
                    var studentid = $('#student_id').val();
                    var studentname = $('#student_name').val();
                    reload_exemption_detail(studentid, studentname);
                }
            });
        } else {
            do_distribution(amt_pay_raw);
            return true;
        }
    }

    function pay_amount_data(paytype) {
        var distr_ops = $('#amt_distribute_ops').val();
        if (distr_ops == '0') {
            swal('', 'Please click distribute to process payment.', 'info');
            return false;
        }
        if (distribute_amount() == true) {
            if (parseFloat($('#excess_amount').val()) > 0) {
                swal({
                    title: 'Excess Amount',
                    text: 'Should the excess amount to be transfered to e-Wallet ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        if (paytype == 1) {
                            cash_pay(1);
                        } else if (paytype == 2) {
                            cheque_pay(1);
                        } else if (paytype == 3) {
                            var service_charge = $('#card_service_charge').val();
                            card_pay(service_charge, 1);
                        } else if (paytype == 4) {
                            wallet_payment();
                        }
                    } else {
                        swal('', 'There is an excess amount. Please check the amount enterd to pay fee and try again', 'info');
                        return false;
                    }
                });
            } else {
                if (paytype == 1) {
                    cash_pay(2);
                } else if (paytype == 2) {
                    cheque_pay(2);
                } else if (paytype == 3) {
                    var service_charge = $('#card_service_charge').val();
                    card_pay(service_charge, 2);
                } else if (paytype == 4) {
                    wallet_payment();
                }
            }

        } else {
            swal('', 'Please check the amount and try again', 'info');
            return false;
        }
    }

    function exempt_fee() {
        if (($('#amt_distribute').val() == "")) {
            swal('', 'Enter Amount to Exempt', 'error');
            return false;
        }
        $('#pay_loader').addClass('sk-loading');
        distribute_amount(); //Its called again for prevenyting change values from userside via browser developer option
        var amt_pay_raw = $('#totamt').val();
        var amt_pay = parseFloat(amt_pay_raw);

        var j = 0;
        var limit = $('#iter_count').val();
        var idname = '';
        var value = 0;
        var table = $('#tbl_fee_allocation_data'); //.DataTable();

        var reason_exempt = $('#reason_exempt').val();
        var pay_data = [];

        var student_name = $('#student_name').val();
        var student_admn_no = $('#student_admn_no').val();
        var student_batch = $('#student_batch').val();
        var student_class = $('#student_class').val();
        var inst_id = $('#inst_id').val();
        var today = $('#today_date').val();

        var total_voucher_amount = 0
        var total_vat_amount_paid = 0
        var total_wallet_amount = 0
        var pending_payment_without_tax = 0
        var desc = "";
        while (j < limit) {
            idname = "#itr_" + j + "";
            value = parseFloat($(idname).data('transactionamtwithvat'));
            pending_payment_without_tax = parseFloat($(idname).data('pendingpayment'));
            desc = $(idname).data('description');
            // console.log(parseFloat($(idname).data('transactionvatamt')).toFixed(2));
            if (pending_payment_without_tax > 0) {
                if ((amt_pay - value) >= 0) {
                    $(idname).html(value);
                    j = j + 1;
                    amt_pay = (amt_pay * 1) - (value * 1);
                    var paidtaxamt = parseFloat($(idname).data('transactionvatamt'));
                    pay_data.push({
                        transaction_id: $(idname).data('transactionid'),
                        demanddate: $(idname).data('demanddate'),
                        transactionamount: $(idname).data('transactionamount'),
                        paidamount: parseFloat(value),
                        description: desc,
                        termid: $(idname).data('termid'),
                        termfee_demand_det_id: $(idname).data('termfee_demand_det_id')
                    });
                    total_voucher_amount = (total_voucher_amount * 1) + (value * 1);
                    total_vat_amount_paid = (total_vat_amount_paid * 1) + (paidtaxamt * 1);

                } else {
                    if (amt_pay > 0) {
                        $(idname).html(amt_pay);
                        var fee_vat_percent = parseFloat($(idname).data('transactionvatpercent'));
                        var fee_paid = ((100 * amt_pay) / (100 + fee_vat_percent));
                        var vat_paid = (fee_paid * fee_vat_percent / 100);
                        var voucher_amt = (fee_paid * 1) + (vat_paid * 1);
                        pay_data.push({
                            transaction_id: $(idname).data('transactionid'),
                            demanddate: $(idname).data('demanddate'),
                            transactionamount: $(idname).data('transactionamount'),
                            paidamount: parseFloat(amt_pay),
                            description: "Partial Exemption on " + desc,
                            termid: $(idname).data('termid'),
                            termfee_demand_det_id: $(idname).data('termfee_demand_det_id')
                        });

                        total_voucher_amount = (total_voucher_amount * 1) + (voucher_amt * 1);
                        total_vat_amount_paid = (total_vat_amount_paid * 1) + (vat_paid * 1);
                        j = limit + 1;
                        amt_pay = (amt_pay * 1) - (value * 1);
                    } else {
                        j = limit + 1;
                    }
                }
            } else {
                j = j + 1;
            }
        }


        if (pay_data.length == 0) {
            if (($('#amt_distribute').val() == "")) {
                swal('', 'Enter Amount to Exempt', 'error');
                return false;
            } else {
                $('#pay_loader').removeClass('sk-loading');
                swal('', 'Atleast one fees has to be selected', 'warning');
                return false;
            }

        }
        if (reason_exempt.length == 0) {
            $('#reason_exempt').focus();
            $('#pay_loader').removeClass('sk-loading');
            swal('', 'Enter the Reason', 'warning');
            return false;
        }

        // console.log(JSON.stringify(pay_data));
        // return false;

        if (total_vat_amount_paid == 0) {
            total_vat_amount_paid = -1;
        }

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var transaction_ID = $('#transaction_ID').val();
        var ops_url = baseurl + 'fees/save_exemption_for_approval';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "studentid": student_id,
                "exemption_data": JSON.stringify(pay_data),
                "amount_paid": amt_pay_raw, //amt_pay_raw,
                "round_off": $('#roundoffamt').val(),
                "total_voucher_amount": total_voucher_amount,
                "total_vat_amount_paid": total_vat_amount_paid,
                "reason_exempt": reason_exempt,
                "transaction_ID": transaction_ID
            },
            success: function(result) {

                var data = JSON.parse(result);
                if (data.status == 1) { //(totamt).toFixed(4)
                    // swal('', 'Exemption of ' + amt_pay_raw + " /- for the student " + student_name + " is Submitted for Approval", 'success');
                    swal('', 'Exemption of ' + parseFloat(amt_pay_raw).toFixed(4) + " /- for the student " + student_name + " is submitted for approval", 'success');
                    reload_exemption_detail(student_id, student_name);
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info'); //
                        $('#pay_loader').removeClass('sk-loading');
                        reload_exemption_detail(student_id, student_name)
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        $('#pay_loader').removeClass('sk-loading');
                        return false;
                    }
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        $('#pay_loader').removeClass('sk-loading');
                        reload_collection_detail(student_id, student_name)
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        $('#pay_loader').removeClass('sk-loading');
                        return false;
                    }
                }

            }
        });
        //$('#pay_loader').removeClass('sk-loading');
    }

    function change_view(studentid, studentname) {
        var feeid = $('#feecode_id').val();
        var ops_url = baseurl + 'fees/student_exemption';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname,
                "feeid": feeid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function reload_exemption_detail(studentid, studentname) {
        var feeid = $('#feecode_id').val();
        var ops_url = baseurl + 'fees/student_exemption';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname,
                "feeid": feeid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }
</script>