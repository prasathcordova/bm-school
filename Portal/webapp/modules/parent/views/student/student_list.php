<?php
if (null !== ($this->session->userdata('payment_status_message')) && $this->session->userdata('payment_status_message') == 1) {
?>
    <script type="text/javascript">
        activate_toast_login('Payment Success', 'Fee payment success. Please check Online Payment History tab for more information', 'success', 500);
    </script>
<?php
    $this->session->unset_userdata('payment_status_message');
} else if (null !== ($this->session->userdata('payment_status_message')) && $this->session->userdata('payment_status_message') == 2) {
?>
    <script type="text/javascript">
        activate_toast_login_for_error('Payment failed please check the payment info for more details', 'Payment Failed', 'error', 500);
    </script>
<?php
    $this->session->unset_userdata('payment_status_message');
}
?>
<style>
    dt {
        padding-bottom: 10px;
        font-weight: 700;
    }

    .nav-tabs>li a:hover,
    .nav-tabs>li a:focus {
        background: #FFF !important;
        /*Modified for tab color*/
        /*background: #23C6C5;*/

    }

    .p-m {
        padding: 15px
    }
</style>

<?php

if (!empty(get_student_image($sdetails_data[0]['student_id']))) {
    $profile_image = get_student_image($sdetails_data[0]['student_id']);
} else {
    $profile_image = base_url('assets/images/a5.jpg');
}
$collegelogo_image = base_url('assets/images/100_logo.png');
?>
<div class="ibox">
    <?php if ($this->session->userdata('is_parent') == 1) { ?>
        <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
            <h5>&nbsp;</h5>
            <span style="float:right;">
                <a href="<?php echo base_url(); ?>" title="Portal Home"><i class="fa fa-home" style="font-size: 20px; padding-right:10px;"></i></a>
            </span>
        </div>
    <?php } ?>

    <div class="ibox-content" id="loader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">

                <div class="col-lg-6">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Student Profile
                        </div>
                        <div class="panel-body no-padding">
                            <div class="contact-box" style="margin-bottom:0px;">
                                <input type="hidden" name="tatpiapg" id="tatpiapg" value="0">
                                <a href="javascript:void(0)">

                                    <div class="col-sm-4">
                                        <div class="text-center">
                                            <img alt="image" class="img-circle img-md img-responsive" src="<?php echo $profile_image; ?>" />
                                            <div class="m-t-xs font-bold"> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <strong style="color:#24537D;"><?php echo $sdetails_data[0]['Student_Name'] ?></strong>
                                        <p style="color:#24537D;">Admission Number : <?php echo isset($sdetails_data[0]['Reg_No']) ? $sdetails_data[0]['Reg_No'] : "No Register Number" ?></p>
                                        <p style="color:#24537D;">Batch : <?php echo isset($sdetails_data[0]['Batch_Name']) ? $sdetails_data[0]['Batch_Name'] : "No Batch" ?></p>
                                        <!-- <p style="color:#24537D;">Fee due date : <?php echo isset($details_data[0]['dem_date']) ? date('d-m-Y', strtotime($details_data[0]['dem_date'])) : date('10-m-Y') ?></p> -->

                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Fee Payment
                        </div>
                        <div class="panel-body no-padding">
                            <div class="widget lazur-bg no-padding" style="margin-top:0px;height: 120px; margin-bottom:0px;border-radius:0px;">
                                <div class="p-m">
                                    <h2 class="m-xs"><span style="color:#FFF "> <?php print_currency('white', '', $inst_id); ?> </span><strong><?php echo my_money_format(isset($sdetails_data[0]['total_payable_fees']) ? $sdetails_data[0]['total_payable_fees'] : 0.00); ?></strong> </h2>
                                    <input type="hidden" value="<?php echo isset($sdetails_data[0]['total_payable_fees_value']) ? $sdetails_data[0]['total_payable_fees_value'] : 0 ?>" id="final_total_payable_amt" name="final_total_payable_amt" />
                                    <input type="hidden" value="<?php echo $cur_acd_year_id ?>" id="cur_acd_year_id">
                                    <h3 class="font-bold no-margins" style="padding-top:20px !important; padding-bottom: 10px !important;">
                                        Total Payable Amount
                                    </h3>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="display:none">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Wallet Deposit
                        </div>
                        <div class="panel-body no-padding">
                            <div class="widget  no-padding" style="background-color: #1c84c6;margin-top:0px;height: 120px; margin-bottom:0px;border-radius:0px;">
                                <div class="p-m">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <h2 class="m-xs" class="pull-right">
                                                <span style="color:#FFF ">
                                                    <?php print_currency('white', '', $inst_id); ?>
                                                </span>

                                            </h2>
                                        </div>
                                        <div class="col-xs-10">
                                            <div class="pull-left">
                                                <strong>
                                                    <input type="text" style="width:90%;color:#000;background-color: #FFFFFF; text-align:right;" class="form-control" onkeypress="return isNumber(event)" maxlength="8" name="wallet_deposit_amount" id="wallet_deposit_amount" value="0">
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:5px">
                                        <div class="col-lg-12" style="text-align:center">
                                            <span class="label label-warning" onclick="add_money(5000)"><?php print_currency('', '', $inst_id); ?> 5000</span>
                                            <span class="label label-warning" onclick="add_money(10000)"><?php print_currency('', '', $inst_id); ?> 10000</span>
                                            <span class="label label-warning" onclick="add_money(20000)"><?php print_currency('', '', $inst_id); ?> 20000</span>

                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="col-lg-12" style="text-align:center">
                                            <a class="btn btn-danger" id="card_pay_btn" href="javascript:void(0);" onclick="pay_wallet_atom('<?php echo $sdetails_data[0]['Reg_No']; ?>')">
                                                <i class="fa fa-money"></i> Add to Wallet
                                            </a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="widget red-bg no-padding" style="margin-top:0px; color: #676a6c;">
                        <a class="btn btn-block btn-danger" href="javascript:" id="pay_wallet" name="pay_wallet" onclick="show_payment()"><i class="fa fa-money"></i> Wallet Deposit</a>
                        <div class="clearfix"></div>
                        <div class="row hidden" id="wallet_window">
                            <div class="col-lg-12">
                                <div class="panel panel-danger" style="margin-bottom: 0px;">
                                    <div class="panel-heading">
                                        <i class="fa fa-money"></i> Wallet Deposit
                                        <a href="javascript:void(0)" class="pull-right" id="hidewindow" onclick="close_wallet_window();" title="Close Wallet Window"> <i class="fa fa-times text-default"></i></a>
                                    </div>
                                    <div class="panel-body no-padding">
                                        <div class="col-md-12">
                                            <br>
                                            <p>The amount deposited will adjust to fees later</p>
                                            <label>Amount Total (INR)</label>
                                            <div class="form-group">
                                                <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" onkeypress="return isNumber(event)" maxlength="8" name="wallet_deposit_amount" id="wallet_deposit_amount" value="0">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12 text-center" style="margin-bottom: 10px;">
                                            --margin-left:30px;--
                                            <a class="btn btn-info" id="card_pay_btn" href="javascript:void(0);" onclick="pay_wallet_atom('<?php echo $sdetails_data[0]['Reg_No']; ?>')">
                                                <i class="fa fa-money">
                                                    Make Payment
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-1" data-toggle="tab" style="color:#23C6C5;">Fees</a></li>
                                    <li class=""><a href="#tab-2" data-toggle="tab" style="color:#23C6C5;">Payment History</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="feed-activity-list">
                                        <div class="col-lg-12" id="history_panel">
                                            <span class="text-muted small">
                                                * Other Fees (if any) will collect first and so displayed at top of table.
                                            </span><br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="tbl_fee_allocation_data" style="padding-bottom: 0px !important;padding-top: 0px !important;width: 100%">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th width="3%">&nbsp;</th>
                                                            <th width="10%">Month</th> -->
                                                            <th width="14%">Fee Description </th>
                                                            <!-- <th width="14%" class="text-right">Fee Amount</th> -->
                                                            <!-- <th width="8%"><?php echo print_tax_vat($inst_id); ?> %</th> -->
                                                            <!-- <th width="9%" class="text-right">Penalty</th> -->
                                                            <th width="12%" class="text-right">Balance</th>
                                                            <!-- <th width="15%" class="text-right">Distributed Amount</th>
                                                            <th width="15%" class="text-right">Dist.Amt + <?php echo print_tax_vat($inst_id); ?></th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        $ic = 0;
                                                        //dev_export($details_data);
                                                        $penalty = 0;
                                                        $penalty_check_array = array();
                                                        if (isset($details_data) && !empty($details_data)) {
                                                            foreach ($details_data as $demmonth => $feesadata) {
                                                                foreach ($feesadata as $fees) {
                                                        ?>

                                                                    <?php
                                                                    $penalty = 0;
                                                                    if (!isset($penalty_check_array[$fees['FEEID'] . '_' . $fees['DEM_MONTH']])) {
                                                                        if (isset($penalty_details) && !empty($penalty_details) && isset($penalty_details[$fees['FEEID']])) {
                                                                            // dev_export($penalty_details);
                                                                            $currentdate = date_create(date('d-m-Y'));
                                                                            $demanddate = date_create(date('d-m-Y', strtotime($fees['ARREAR_DATE'])));
                                                                            $effect_date = date_create(date('d-m-Y', strtotime($penalty_details[$fees['FEEID']]['effectdate'])));
                                                                            $interval = date_diff($currentdate, $demanddate);
                                                                            $days = $interval->format('%R%a');
                                                                            //echo $days;
                                                                            $days_difference = abs($days); //FEEID
                                                                            $symbol = substr($days, 0, 1);
                                                                            if ($symbol == '+') {
                                                                                $penalty = 0;
                                                                            } else {
                                                                                foreach ($penalty_details[$fees['FEEID']]['details'] as $pda) {
                                                                                    if ($days_difference >= $pda['FromDays']) {
                                                                                        $penalty = $pda['amount'];
                                                                                        break;
                                                                                    } else {
                                                                                        $penalty = 0;
                                                                                        continue;
                                                                                    }
                                                                                }
                                                                                $penalty = (($penalty - $fees['PENALTY_PAID']) > 0 ? ($penalty - $fees['PENALTY_PAID']) : 0);
                                                                                $penalty_check_array[$fees['FEEID'] . '_' . $fees['DEM_MONTH']] = $fees['FEEID'];
                                                                            }
                                                                        } else {
                                                                            $penalty = 0;
                                                                        }
                                                                    }

                                                                    //echo $penalty;
                                                                    $exmptnamt = $fees['EXEMPTION_AMOUNT']; // + ($fees['VAT'] * $fees['EXEMPTION_AMOUNT'] / 100)
                                                                    $exmptnamt_pending = $fees['EXEMPTION_PENDING_AMOUNT']; // + ($fees['VAT'] * $fees['EXEMPTION_AMOUNT'] / 100)
                                                                    $not_recon_amt = $fees['TOTAL_NON_RECONCILED_AMOUNT'];
                                                                    $not_recon_with_penalty = $fees['TOTAL_NON_RECONCILED_AMOUNT'] + $fees['NON_RECONCILED_PENALTY'];
                                                                    $consnamt = $fees['CONCESSION_AMOUNT']; // + ($fees['VAT'] * $fees['CONCESSION_AMOUNT'] / 100)
                                                                    $transactionamt = ($fees['TRANSACTION_AMOUNT'] - ($consnamt + $exmptnamt)); //($fees['VAT'] * $fees['TRANSACTION_AMOUNT'] / 100) + 
                                                                    $pendingpayment = ($fees['PENDING_PAYMENT']); // + ($fees['VAT'] * $fees['PENDING_PAYMENT'] / 100)
                                                                    $totalpaid = ($fees['TOTAL_PAID_AMOUNT'] + ($fees['VAT'] * $fees['TOTAL_PAID_AMOUNT'] / 100));
                                                                    $gtotalpaid = $totalpaid + $fees['TOTAL_NON_RECONCILED_AMOUNT'];
                                                                    $checkbal = (($transactionamt + ($fees['VAT'] * $transactionamt / 100)) - $gtotalpaid); // - $penalty;
                                                                    if ($checkbal <= 0) $penalty = 0;

                                                                    $total_pending_amt = (($transactionamt + ($fees['VAT'] * $transactionamt / 100)) - $gtotalpaid) + $penalty;
                                                                    $distamount = ((($total_pending_amt - $penalty) * 100) / (100 + $fees['VAT'])); //round(($fees['VAT'] * $pendingpayment / 100), 4);
                                                                    $vatamount = (($distamount * $fees['VAT']) / 100);
                                                                    //$amttopay = 
                                                                    if ($exmptnamt_pending > 0 || $not_recon_amt > 0) $bgcolor = "background-color:#c9c9c9";
                                                                    else $bgcolor = '';
                                                                    if ($fees['IS_ARREAR'] == 1) $txtcolor = "color:hotpink;";
                                                                    else $txtcolor = '';
                                                                    if ($total_pending_amt > 0) {
                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <input type="checkbox" disabled value="1" name="selectmonth" class="i-checks selectmonth" id="selectmonth_<?php echo ++$ic ?>" onchange1="change_distribute_amount('<?php echo $total_pending_amt; ?>')" pending_amount="<?php echo $total_pending_amt; ?>" />
                                                                                &nbsp;<b><?php echo date('M-Y', strtotime($demmonth)); ?></b>
                                                                            </td>
                                                                        </tr>
                                                                        <tr <?php echo 'style="' . $txtcolor . ';' . $bgcolor . ';"'; ?>>
                                                                            <!-- <td><?php echo date('M-Y', strtotime($fees['DEMAND_DATE'])); ?></td> -->
                                                                            <td><span title="<?php echo $fees['TRANSACTION_DESC_TOOLTIP']; ?>"><?php echo $fees['TRANSACTION_DESC']; ?></span></td>
                                                                            <!-- <td class="text-right"><?php echo my_money_format($fees['TRANSACTION_AMOUNT']); ?></td> -->
                                                                            <!-- <td class="text-center"><?php echo $fees['VAT'] . " %"; ?></td> -->
                                                                            <?php  ?>
                                                                            <!-- <td class="text-right"><?php echo ($totalpaid > 0 ? my_money_format($totalpaid) : my_money_format(0)); ?></td> -->
                                                                            <!-- <td class="text-right"><?php echo my_money_format($penalty); ?></td> -->
                                                                            <td class="text-right">
                                                                                <?php echo my_money_format($total_pending_amt); ?>
                                                                                <!-- <?php if ($bgcolor != '') { ?>&nbsp;<span style="cursor: pointer;" onclick="view_payment('<?php echo $i; ?>',this);" title="View Pay Details"><i class="fa fa-eye"></i></span><?php } ?> -->
                                                                            </td>
                                                                            <!-- <td class="data_collector text-right" data-iterator="<?php echo $i; ?>" id="itr_<?php echo $i; ?>" data-transactionid="<?php echo $fees['ID']; ?>" data-demanddate="<?php echo $fees['DEMAND_DATE'] ?>" data-transactionamount="<?php echo $fees['TRANSACTION_AMOUNT'] ?>" data-pendingpayment="<?php echo $total_pending_amt ?>" data-transactionvatpercent="<?php echo $fees['VAT'] ?>" data-transactionvatamt="<?php echo round($vatamount, 4) ?>" data-transactionamtwithvat="<?php echo $total_pending_amt; ?>" data-description="<?php echo str_replace("demanded", "paid", $fees['TRANSACTION_DESC']) . ' ' . date('M-Y', strtotime($fees['DEMAND_DATE'])); ?>" data-nonrealized="<?php echo round($fees['TOTAL_NON_RECONCILED_AMOUNT'], 4); ?>" data-penalty="<?php echo $penalty; ?>">
                                                                        <?php echo my_money_format(0); ?>
                                                                    </td>
                                                                    <td class="data_collector text-right" data-iterator="<?php echo $i; ?>" id="awt_<?php echo $i; ?>">
                                                                        <?php echo my_money_format(0); ?>
                                                                    </td> -->
                                                                        </tr>
                                                                        <!-- View Payment Details : Starts -->
                                                                        <!-- <tr class="notesa hide" id="pay<?php echo $i; ?>">
                                                                        <td colspan="8" style="background: #bcdada;">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <h5><?php echo $fees['TRANSACTION_DESC_TOOLTIP']; ?>
                                                                                        <span class="pull-right" style="cursor: pointer;" onclick="close_pay(<?php echo $i; ?>)" title="Close Pay Details"><i class="fa fa-times"></i></span>
                                                                                    </h5>

                                                                                    <hr style="margin: 7px 0 4px 0;">
                                                                                    <table class="table table-bordered table-striped" style="margin-bottom: 0px;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <th style="width:14%;text-align:right;">Exemption Pending&nbsp;</th>
                                                                                                <th style="width:19%;text-align:right;">Amt. to be realized&nbsp;</th>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-right"><?php echo my_money_format(($exmptnamt_pending > 0) ? $exmptnamt_pending : '0'); ?></td>
                                                                                                <td class="text-right"><?php echo my_money_format(($not_recon_with_penalty > 0) ? $not_recon_with_penalty : '0'); ?></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr> -->
                                                                        <!-- View Payment Details : Ends -->
                                                        <?php
                                                                        $i = $i + 1;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="2">
                                                                <input type="hidden" name="checkboxCount" id="checkboxCount" value="<?php echo $ic; ?>" />
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">Total Amount</td>
                                                            <td class="text-right">
                                                                <?php echo print_currency('hotpink', '13', $inst_id) ?> <span class="totdistamt"><?php echo my_money_format(0); ?></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">Excess Amount</td>
                                                            <td class="text-right">
                                                                <?php echo print_currency('hotpink', '13', $inst_id) ?> <span class="excess_amount_html"><?php echo my_money_format(0); ?></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">Service Charge</td>
                                                            <td class="text-right">
                                                                <?php echo print_currency('hotpink', '13', $inst_id) ?> <span class="surcharge_amount_html"><?php echo my_money_format(0); ?></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">Gross Total</td>
                                                            <td class="text-right">
                                                                <?php echo print_currency('hotpink', '13', $inst_id) ?> <span class="gross_amttopay_html"><?php echo my_money_format(0); ?></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right text-success">Round Off</td>
                                                            <td class="text-right">
                                                                <?php echo print_currency('hotpink', '13', $inst_id) ?> <span class="roundoff_amount_html"><?php echo my_money_format(0); ?></span>
                                                            </td>
                                                        </tr>
                                                        <tr style="font-size: 13px;">
                                                            <td class="text-right text-success">Net Total</td>
                                                            <td class="text-right">
                                                                <?php echo print_currency('hotpink', '13', $inst_id) ?> <b><span class="totalamttopay"><?php echo my_money_format(0); ?></span></b>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- <span class="pull-right label label-info" style="position: absolute;right: 15px;bottom: 40px;font-size: 13px;">
                                                        Total Amount <?php echo print_currency('white', '13', $inst_id) ?> : <span class="totalamttopay"><?php echo my_money_format(0); ?></span>
                                                    </span> -->
                                                <input type="hidden" name="totdistamt" id="totdistamt" />
                                                <input type="hidden" name="roundoffamt" id="roundoffamt" />
                                                <input type="hidden" name="card_roundoffamt" id="card_roundoffamt" />
                                                <input type="hidden" name="totamt" id="totamt" />

                                            </div>
                                            <input type="hidden" name="iter_count" id="iter_count" value="<?php echo $i; ?>" />
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-8"></div>
                                        <div class="col-lg-4" id="cluster_info" style="float: right;">
                                            <div class="ibox" style="margin-bottom:0px !important;">
                                                <div class="ibox-title">
                                                    <h5>E-Payment Summary</h5>
                                                </div>
                                                <div class="ibox-content" style="padding-right: 1%;" id="fees_summary">
                                                    <div class="row clearfix">
                                                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                                            <div class="input-group m-b">
                                                                <span class="input-group-addon" style="color:hotpink;font-size: 20px; "><?php print_currency('hotpink', '', $inst_id); ?> </span>
                                                                <input type="text" placeholder="Fee Amount" class="form-control" name="payable_fee" id="payable_fee" readonly value="">
                                                                <span class="input-group-btn"> <button style="background:hotpink !important;border-color: hotpink !important;" type="button" onclick="pay_atom('<?php echo $sdetails_data[0]['Reg_No']; ?>')" class="btn btn-primary">Pay
                                                                    </button> </span>
                                                            </div>
                                                            <span class="text-muted small">
                                                                *Fees Once paid will not be refunded. Fees paid will be updated within 24 hours.
                                                                <!-- Min. payable amount is <?php echo $this->session->userdata('min_pay_amt'); ?> -->
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-2">
                                    <h3>Online Payment Summary</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Transaction Date</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Method</th>
                                                    <!-- <th>Comments</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($payment_data) && !empty($payment_data)) {
                                                    foreach ($payment_data as $payments) {
                                                        $paytype = ($payments['paytype'] == 'WALLET' ? 'Wallet ' : 'Fee ');
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                if ($payments['paymentStatus'] == 'Ok') {
                                                                ?>
                                                                    <span class="label label-info"><i class="fa fa-check"></i><?php echo $paytype ?> Payment Success</span>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span class="label label-warning"><i class="fa fa-check"></i><?php echo $paytype ?> Payment Failed</span>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php echo date('d-m-Y h:i A', strtotime($payments['transaction_date'])); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo my_money_format($payments['feeAmount']); ?>
                                                            </td>
                                                            <td title="<?php echo $payments['bankName'] . " ( ID : " . $payments['atomTransactionId'] . " )"; ?>">
                                                                <?php
                                                                if ($payments['paymentChannel'] == 'NB') {
                                                                    echo 'Net Banking';
                                                                } else if ($payments['paymentChannel'] == 'CC') {
                                                                    echo 'Credit Card';
                                                                } else if ($payments['paymentChannel'] == 'NA' || $payments['paymentChannel'] == 'Cancel by User') {
                                                                    echo 'Transaction Cancelled';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" style="text-align: center">
                                                            No payment history available
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
<input type="hidden" name="student_id" id="student_id" value="<?php echo $sdetails_data[0]['student_id'] ?>" />
<style>
    .icheckbox_square-green.checked.disabled {
        background-position: -48px 0;
    }
</style>
<script>
    function load_student(student_id) {
        var ops_url = baseurl + 'parent-portal/show_student/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-content').html(data.view);
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    return false;
                } else {
                    swal('', 'An error occured while fetching data. Please try again later or contact administrator with error code : DPRDTAER10005', 'info');
                    return false;
                }


            }
        });
    }
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    $(document).ready(function() {
        // distribute_amount();
        $('#selectmonth_1').prop("disabled", false);
        $("#payable_fee").keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });
    var chk_amount = 0;
    $(".selectmonth").on('ifChanged', function() {
        var checkboxCount = $('#checkboxCount').val();
        if ($(this).prop('checked') == true) {
            // alert('asd2');
            chk_amount = ((chk_amount * 1) + ($(this).attr('pending_amount') * 1));
            // distribute_amount(chk_amount);
            var chk_val = $(this).attr('id');
            var chk_arr = chk_val.split('_');
            var chkid = ((chk_arr[1] * 1));
            // alert(chkid);
            $('.selectmonth').prop("disabled", true);
            $('.selectmonth').each(function() {
                var chk_val1 = $(this).attr('id');
                var chk_arr1 = chk_val1.split('_');
                if (chk_arr1[1] <= chkid) {
                    $('#selectmonth_' + chkid).prop("disabled", false);
                    $('#selectmonth_' + ((chkid * 1) + 1)).prop("disabled", false);
                }

            });
            distribute_amount(chk_amount);
        } else {
            chk_amount = ((chk_amount * 1) - ($(this).attr('pending_amount') * 1));
            var chk_val = $(this).attr('id');
            var chk_arr = chk_val.split('_');
            var chkid = ((chk_arr[1] * 1));
            // alert(chkid);
            var abcd = chkid;
            $('.selectmonth').prop("disabled", true);
            $('.selectmonth').each(function() {
                var chk_val1 = $(this).attr('id');
                var chk_arr1 = chk_val1.split('_');
                if (chk_arr1[1] <= abcd) {
                    $('#selectmonth_' + abcd).prop("disabled", false);
                    $('#selectmonth_' + ((abcd * 1) - 1)).prop("disabled", false);
                }

            });
            if (chkid == 1) $('#selectmonth_1').prop("disabled", false);
            distribute_amount(chk_amount);
        }
    });

    function show_payment() {
        $('#pay_wallet').hide();
        $('#wallet_window').removeClass('hidden');
    }

    function close_wallet_window() {
        $('#pay_wallet').show();
        $('#wallet_window').addClass('hidden');
    }
    //DISTRIBUTE FUNCTION
    function distribute_amount(amt_pay_raw_chk) {
        var total_payable_amount = $('#total_payable_amount').val();
        // var amt_pay_raw = $('#payable_fee').val();
        var amt_pay_raw = amt_pay_raw_chk;
        var amt_pay = parseFloat(amt_pay_raw).toFixed(2);

        var j = 0;
        var limit = $('#iter_count').val();
        var idname = '';
        var iidname = '';
        var value = 0;
        var totamt = 0;
        $('.data_collector').html('0')
        var table = $('#tbl_fee_allocation_data'); //.DataTable();
        var payableamt = $('#total_payable_amount_rounded').val();
        var exsamount = 0;

        var penalty = 0;
        amt_pay = parseFloat(amt_pay).toFixed(2);
        var totamt_pay = totamt;
        var totdistamt = totamt;

        //** With Roundoff Function*/
        totamt = parseFloat(amt_pay).toFixed(2);
        $('#payable_fee').val(totamt);
        $('#tatpiapg').val(totamt);

        var gros_amount_to_pay = (totamt * 1); // + (exsamount * 1) + (sercharge * 1);
        $('.gross_amttopay_html').html(gros_amount_to_pay.toFixed(2));
        $('.totalamttopay').html(gros_amount_to_pay.toFixed(2));
        $('.totdistamt').html(totamt);
        return true;
    }

    function pay_atom(admn_no) {

        var ops_url = baseurl + 'fees/pay-atom/';
        var total_amt = parseInt($('#final_total_payable_amt').val());
        // var paid_amt = parseInt($('#payable_fee').val());
        var paid_amt = parseInt($('#tatpiapg').val());

        var student_id = $('#student_id').val();
        var cur_acd_year_id = $('#cur_acd_year_id').val();

        var reg = /[\d\.]/g;
        if (!reg.test(($('#tatpiapg').val()))) {
            swal('', 'Enter valid data as payable fee', 'info');
            return false;
        }

        if (paid_amt == '') {
            swal('', 'Payment Amount should be greater than 0', 'info');
            return false;
        }
        if (paid_amt > total_amt) {
            swal('', 'Please pay amount less than or equal to the total payable amount', 'info');
            return false;
        }

        $('#loader').addClass('sk-loading');
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "admn_no": admn_no,
                "max_amount": total_amt,
                "paid_amt": paid_amt,
                "student_id": student_id,
                "cur_acd_year_id": cur_acd_year_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    window.location.href = data.link;
                    return true;
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    return false;
                } else {
                    swal('', 'An error occured while configure Criteria . Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                    return false;
                }


            }
        });
    }

    function add_money(value) {
        $('#wallet_deposit_amount').val(value)
    }

    function pay_wallet_atom(admn_no) {
        var ops_url = baseurl + 'fees/pay_wallet_atom/';
        var paid_amt = parseInt($('#wallet_deposit_amount').val());

        var student_id = $('#student_id').val();
        var cur_acd_year_id = $('#cur_acd_year_id').val();

        var reg = /[\d\.]/g;
        if (!reg.test(($('#wallet_deposit_amount').val()))) {
            swal('', 'Enter valid amount', 'info');
            return false;
        }

        if (paid_amt < 1) {
            swal('', 'Wallet Money should be atleast 1', 'info');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "admn_no": admn_no,
                "paid_amt": paid_amt,
                "student_id": student_id,
                "cur_acd_year_id": cur_acd_year_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    window.location.href = data.link;
                    return true;
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    return false;
                } else {
                    swal('', 'An error occured while configure Criteria . Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                    return false;
                }


            }
        });
    }
</script>