<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
        <input type="hidden" value='<?php echo json_encode($search_elements); ?>' id="search_elements">
        <input type="hidden" value="<?php echo $searchby; ?>" id="searchby">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $inst_id = $this->session->userdata('inst_id');
                    $student_img = base_url('assets/img/a0.jpg');
                    //$sear_array = $search_elements;
                    //print_r($sear_array);
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> - Direct Bank Transfer</h5>
                    <span style="float:right;">
                        <a href="javascript:" title="Student Account" onclick="get_account_details('<?php echo $student_data['student_id']; ?>', '<?php echo substr($student_data['student_name'], 0, 20) ?>')"><i class="fa fa-user" style="font-size: 20px; padding-right:10px;"></i></a>
                        <!-- <a href="javascript:void(0)" onclick="<?php echo $searchby; ?>();" id="close_button" data-toggle="tooltip" title="Back to Filter" style="color: #B22222;font-size: 20px; "><i class="fa fa-backward"></i></a> -->
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
                            <div class="col-md-6 col-sm-12 col-xs-12">
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
                                    <input type="hidden" name="transaction_ID" id="transaction_ID" value="<?php echo $transaction_ID; ?>" />

                                    <div class="">
                                        <div>

                                            <h4><?php echo $student_data['student_name']; ?></h4>
                                            <small>
                                                Admission No : <?php echo $student_data['Admn_No']; ?>
                                            </small><br>
                                            <small>
                                                Batch : <?php echo $student_data['Batch_Name']; ?>
                                            </small><br>
                                            <small>
                                                Class : <?php echo $student_data['Description']; ?>
                                            </small><br>
                                            <small>
                                                <b>Priority</b> : <?php echo $student_data['Priority']; ?>
                                            </small>&nbsp;
                                            <small>
                                                <b>Status</b> : <?php echo $student_data['stud_status']; ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" style="padding-top:5px; float: right;">
                                <div class="widget lazur-bg no-padding" style="margin-top:0px;">
                                    <div class="p-m" style="padding:3px !important; display: inline-block">
                                        <h1 class="m-xs" style="text-align:center; font-size: 25px !important;">
                                            <?php print_currency('white'); ?>
                                            <?php echo my_money_format($fee_summary); //($fee_summary); //);
                                            //echo number_format(($fee_summary), 4);
                                            ?>
                                            <?php //echo isset($fee_summary) && !empty($fee_summary) ? number_format(floor($fee_summary * 100) / 100, 2, '.', '') : 0; 
                                            ?></h1>

                                        <h3 class="font-bold no-margins" style="text-align:center;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            <!-- -->Payable Amount(Incl. of <?php echo print_tax_vat(); ?>)
                                            <input type="hidden" name="total_payable_amount" id="total_payable_amount" value="<?php echo $fee_summary; ?>" />
                                            <input type="hidden" name="total_payable_amount_rounded" id="total_payable_amount_rounded" value="<?php echo $fee_summary; ?>" /><!-- round($fee_summary,4)-->
                                        </h3>
                                    </div>
                                    <div class="p-m" style="padding:3px !important; float: right;">
                                        <!--display: inline-block; -->
                                        <h1 class="m-xs" style="text-align:center; font-size: 25px !important;">
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

                            <?php if ($fee_summary > 0) { ?>
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div id="small-chat" style="bottom:0px !important; top:134px !important; right: -16px !important;">
                                        <!-- Changed by SALAHUDHEN May 29, 2019 title ='Move to Payment options' to title="Move to Payment Listing"-->
                                        <a class="open-small-chat" href="#history_panel" data-toggle="tooltip" title="Move to Payment Listing">
                                            <i class="fa fa-arrow-down"></i>

                                        </a>
                                    </div>
                                    <div class="ibox-content" style=" padding: 15px 0px 20px 7px;" id="fees_summary">
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                                <div class="input-group m-b" style="margin-bottom: 0px;">
                                                    <span class="input-group-addon">
                                                        <!-- <i class="fa fa-inr" aria-hidden="true" style="color:hotpink;font-size: 15px; "></i> -->
                                                        <?php print_currency('hotpink'); ?>
                                                    </span>
                                                    <input type="text" placeholder="Enter amount wish to pay" class="form-control allownumericwithdecimal" name="amt_distribute" id="amt_distribute" value="<?php echo $amount_distributed ?>" onkeypress="return validateFloatKeyPress(this,event);" maxlength="10" style="height: 39px !important;text-align:right;">
                                                    <script>
                                                        distribute_amount();
                                                    </script>
                                                    <span class="input-group-btn"> <button style="background:hotpink !important;border-color: hotpink !important;height: 39px !important;padding-bottom: 0px;margin-bottom: 0px;border-bottom-width: 0px;border-top-width: 0px; cursor:pointer;" type="button" onclick="distribute_amount();" class="btn btn-primary">Distribute to Calculate <?php echo print_tax_vat(); ?>
                                                        </button> </span>
                                                </div>
                                                <span class="text-muted small">
                                                    * Fees Distributed will be reflected in the below table of fee head's. The fee details on pink colour are arrear.
                                                </span><br>
                                                <!--text-muted-->
                                                <span class="small text-danger">
                                                    ** <?php echo print_tax_vat(); ?> will be calculated after distribute the amount
                                                </span>
                                            </div>


                                            <div class="clearfix"></div>

                                            <div class="col-lg-12" id="pay_panel">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-info-circle"></i> Transaction Types
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="panel-group payments-method" id="accordion">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <div class="pull-right">
                                                                        <i class="fa fa-university text-sucess"></i>
                                                                    </div>
                                                                    <h5 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="click_to_pay">Direct Bank Transfer</a>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapse5" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <small class="text-danger">The penalty (if any) calculations according to the payment date selected here.</small><br>
                                                                                <small class="text-info">For getting other payment options, cancel this payment and distribute again.</small>
                                                                                <hr />
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>Reference Number</label>&nbsp;<span class="text-danger">*</span>
                                                                                    <input type="text" class="form-control alphanumeric" readonly maxlength="17" name="reference_number" id="reference_number" placeholder="Enter Reference Number" value="<?php echo $reference_number ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>Payment Date</label>&nbsp;<span class="text-danger">*</span>
                                                                                    <input type="text" class="form-control dbt_refdate" name="ReferenceDate" readonly="" style="background-color:white;" id="ReferenceDate" placeholder="Enter Reference Date" value="<?php echo date('d/m/Y', strtotime($reference_date)); ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                            <div class="form-group col-lg-12 col-md-12">

                                                                                <label>Amount Total</label>
                                                                                <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                    <input type="text" style="background-color: #FFFFFF;height: 39px !important;text-align:right;" class="form-control" disabled="" name="pay_amount4" id="pay_amount4" value="<?php echo my_money_format(0) ?>">
                                                                                    <span class="input-group-addon">
                                                                                        <?php print_currency('hotpink'); ?>
                                                                                    </span>
                                                                                </div>
                                                                                <!-- <hr> -->
                                                                            </div>

                                                                            <div class="clearfix"></div>
                                                                            <div class="col-xs-12">
                                                                                <table class="table table-bordered table-striped">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="text-right">Excess amount after distribution&nbsp;</td>
                                                                                            <td class="text-right"><?php print_currency('white', '12'); ?> <span id="amt_after_distribute" class="amt_after_distribute"><?php echo my_money_format(0) ?></span>&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="text-right" colspan="2">
                                                                                                <a class="btn btn-danger" href="javascript:" title="Back to Fee Collection" onclick="reload_collection_detail('<?php echo $student_data['student_id']; ?>','<?php echo trim($student_data['student_name']); ?>');">
                                                                                                    <i class="fa fa-times"></i> Cancel Payment
                                                                                                </a>
                                                                                                <a class="btn btn-info" id="dbt_pay_btn" style="margin-left:0px;" href="javascript:void(0)" onclick="dbt_validation(5);">
                                                                                                    <i class="fa fa-money"></i> Make Payment
                                                                                                </a>&nbsp;
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <!-- <a class="btn btn-info" id="dbt_pay_btn" style="margin-left:0px;" href="javascript:void(0)" onclick="dbt_validation(5);">
                                                                                    <i class="fa fa-money"></i> Make Payment
                                                                                </a>
                                                                                <span style="float:right;">
                                                                                    <span class="label label-success label-md float-right" style="background-color:hotpink;font-size: 12px;">Excess amount after distribution : <?php print_currency('white', '12'); ?> <span id="amt_after_distribute" class="amt_after_distribute"><?php echo my_money_format(0) ?></span> </span>
                                                                                </span> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <hr> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="small-chat" style="right: -16px !important;">
                                                    <!--Changed by SALAHUDHEN May 29, 2019 title ='Move to Fees Details & distribution' to title="Move to Payment Distribution"-->
                                                    <a class="open-small-chat" href="#wrapper" data-toggle="tooltip" title="Move to Payment Distribution">
                                                        <i class="fa fa-arrow-up"></i>

                                                    </a>
                                                </div>
                                            </div>
                                            <!-- dataTables-example  table-hover-->
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12" id="history_panel">
                                                <span class="text-muted small">
                                                    * Other Fees (if any) will collect first and so displayed at top of table.
                                                </span><br>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="tbl_fee_allocation_data" style="padding-bottom: 0px !important;padding-top: 0px !important;width: 100%">
                                                        <thead>
                                                            <tr>
                                                                <th width="10%">Month</th>
                                                                <!--<th>Month</th>-->
                                                                <th width="14%">Fee Description </th>
                                                                <th width="14%" class="text-right">Demanded</th>
                                                                <th width="8%"><?php echo print_tax_vat(); ?> %</th>
                                                                <!-- <th><?php echo print_tax_vat(); ?></th> -->
                                                                <!--<th>Amt With VAT --already</th>-->
                                                                <!-- <th>Amount paid</th> -->
                                                                <!-- <th>Concession</th> -->
                                                                <!-- <th>Amt. to be realized</th> Payable Amt.-->
                                                                <th width="9%" class="text-right">Penalty</th>
                                                                <th width="15%" class="text-right">Balance</th>
                                                                <th width="15%" class="text-right">Distributed Amount</th>
                                                                <!--Amount Wish to pay-->
                                                                <th width="15%" class="text-right">Dist.Amt + <?php echo print_tax_vat(); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i = 0;
                                                            // dev_export($fee_data);
                                                            $penalty = 0;
                                                            $penalty_check_array = array();
                                                            if (isset($fee_data) && !empty($fee_data)) {
                                                                foreach ($fee_data as $fees) {
                                                                    $penalty = 0;
                                                                    // echo $fees['PENALTY_PAID'];
                                                                    //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                                                                    if (!isset($penalty_check_array[$fees['FEEID'] . '_' . $fees['DEM_MONTH']])) {
                                                                        if (isset($penalty_details) && !empty($penalty_details) && isset($penalty_details[$fees['FEEID']])) {
                                                                            // dev_export($penalty_details[$fees['FEEID']]);
                                                                            $currentdate = date_create(date('d-m-Y'));
                                                                            $demanddate = date_create(date('d-m-Y', strtotime($fees['ARREAR_DATE'])));
                                                                            $effect_date = date_create(date('d-m-Y', strtotime($penalty_details[$fees['FEEID']]['effectdate'])));
                                                                            $interval = date_diff($currentdate, $demanddate);
                                                                            $days = $interval->format('%R%a');
                                                                            //echo $days; // . '-' . $fees['FEEID'] . '/';
                                                                            $days_difference = abs($days); //FEEID
                                                                            $symbol = substr($days, 0, 1);
                                                                            if ($symbol == '+' && $days_difference != 0) {
                                                                                $penalty = 0;
                                                                            } else {
                                                                                // if ($demanddate <= $effect_date) {
                                                                                //if ($penalty_details[$fees['FEEID']]['penalty_type'] == 'S') { //for slab penalty calculation
                                                                                foreach ($penalty_details[$fees['FEEID']]['details'] as $pda) {
                                                                                    if ($days_difference >= $pda['FromDays']) {
                                                                                        $penalty = $pda['amount'];
                                                                                        break;
                                                                                    } else {
                                                                                        $penalty = 0;
                                                                                        continue;
                                                                                    }
                                                                                }
                                                                                //} else { //for fixed penalty calculation
                                                                                //$penalty = $penalty_details[$fees['FEEID']]['details'][0]['amount'];
                                                                                //}
                                                                                //}
                                                                                $penalty = (($penalty - $fees['PENALTY_PAID']) > 0 ? ($penalty - $fees['PENALTY_PAID']) : 0);
                                                                                $penalty = (($penalty - $fees['NON_RECONCILED_PENALTY']) > 0 ? ($penalty - $fees['NON_RECONCILED_PENALTY']) : 0);
                                                                                $penalty_check_array[$fees['FEEID'] . '_' . $fees['DEM_MONTH']] = $fees['FEEID'];
                                                                                // array_push($penalty_check_array[$fees['DEM_MONTH']], $fees['FEEID']);
                                                                            }
                                                                        } else {
                                                                            $penalty = 0;
                                                                        }
                                                                    }
                                                                    // dev_export($penalty_check_array);
                                                                    //echo $penalty;
                                                                    $exmptnamt = $fees['EXEMPTION_AMOUNT']; // + ($fees['VAT'] * $fees['EXEMPTION_AMOUNT'] / 100)
                                                                    $exmptnamt_pending = $fees['EXEMPTION_PENDING_AMOUNT']; // + ($fees['VAT'] * $fees['EXEMPTION_AMOUNT'] / 100)
                                                                    $not_recon_amt = $fees['TOTAL_NON_RECONCILED_AMOUNT'];
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
                                                            ?>
                                                                    <tr <?php echo 'style="' . $txtcolor . ';' . $bgcolor . ';"'; ?>>
                                                                        <td><?php echo date('M-Y', strtotime($fees['DEMAND_DATE'])); ?></td>
                                                                        <td><span title="<?php echo $fees['TRANSACTION_DESC_TOOLTIP']; ?>"><?php echo $fees['TRANSACTION_DESC']; ?></span></td>
                                                                        <td class="text-right"><?php echo my_money_format($fees['TRANSACTION_AMOUNT']); ?></td>
                                                                        <td class="text-center"><?php echo $fees['VAT'] . " %"; ?></td>
                                                                        <?php  ?>
                                                                        <!-- <td class="text-right"><?php echo ($totalpaid > 0 ? my_money_format($totalpaid) : my_money_format(0)); ?></td> -->
                                                                        <td class="text-right"><?php echo my_money_format($penalty); ?></td>
                                                                        <td class="text-right">
                                                                            <?php echo my_money_format($total_pending_amt); ?>
                                                                            <?php if ($bgcolor != '') { ?>&nbsp;<span style="cursor: pointer;" onclick="view_payment('<?php echo $i; ?>',this);" title="View Pay Details"><i class="fa fa-eye"></i></span><?php } ?>
                                                                        </td>
                                                                        <td class="data_collector text-right" data-iterator="<?php echo $i; ?>" id="itr_<?php echo $i; ?>" data-transactionid="<?php echo $fees['ID']; ?>" data-demanddate="<?php echo $fees['DEMAND_DATE'] ?>" data-transactionamount="<?php echo $fees['TRANSACTION_AMOUNT'] ?>" data-pendingpayment="<?php echo $total_pending_amt ?>" data-transactionvatpercent="<?php echo $fees['VAT'] ?>" data-transactionvatamt="<?php echo round($vatamount, 4) ?>" data-transactionamtwithvat="<?php echo $total_pending_amt; ?>" data-description="<?php echo str_replace("demanded", "paid", $fees['TRANSACTION_DESC']) . ' ' . date('M-Y', strtotime($fees['DEMAND_DATE'])); ?>" data-nonrealized="<?php echo round($fees['TOTAL_NON_RECONCILED_AMOUNT'], 4); ?>" data-penalty="<?php echo $penalty; ?>">
                                                                            <?php echo my_money_format(0); ?>
                                                                        </td>
                                                                        <td class="data_collector text-right" data-iterator="<?php echo $i; ?>" id="awt_<?php echo $i; ?>">
                                                                            <?php echo my_money_format(0); ?>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- View Payment Details : Starts -->
                                                                    <tr class="notesa hide" id="pay<?php echo $i; ?>">
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
                                                                                                <!-- <th style="width:12%;text-align:right;">Concession&nbsp;</th> -->
                                                                                                <th style="width:14%;text-align:right;">Exemption Pending&nbsp;</th>
                                                                                                <!-- <th style="width:14%;text-align:right;">Demanded&nbsp;</th>
                                                                                                <th style="width:8%;text-align:right;"><?php echo print_tax_vat(); ?>&nbsp;</th>
                                                                                                <th style="width:14%;text-align:right;">Penalty&nbsp;</th>
                                                                                                <th style="width:12%;text-align:right;">Total Paid&nbsp;</th> -->
                                                                                                <th style="width:19%;text-align:right;">Amt. to be realized&nbsp;</th>
                                                                                                <!-- <th style="width:14%;text-align:right;">Pending&nbsp;</th> -->
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- <td class="text-right"><?php echo my_money_format(($consnamt > 0) ? $consnamt : '0'); ?></td> -->
                                                                                                <td class="text-right"><?php echo my_money_format(($exmptnamt_pending > 0) ? $exmptnamt_pending : '0'); ?></td>
                                                                                                <!-- <td class="text-right"><?php echo my_money_format($transactionamt); ?></td>
                                                                                                <td class="text-right"><?php echo my_money_format(($fees['VAT'] * $transactionamt / 100)); ?></td>
                                                                                                <td class="text-right"><?php echo my_money_format($penalty); ?></td>
                                                                                                <td class="text-right"><?php echo my_money_format($totalpaid); ?></td> -->
                                                                                                <td class="text-right"><?php echo my_money_format(($fees['TOTAL_NON_RECONCILED_AMOUNT'] > 0) ? $fees['TOTAL_NON_RECONCILED_AMOUNT'] : '0'); ?></td>
                                                                                                <!-- <td class="text-right"><b><?php echo my_money_format($total_pending_amt); ?></b></td> -->
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
                                                            ?>
                                                            <tr>
                                                                <td class="text-right" colspan="6">Adjusted Amount</td>
                                                                <td class="text-right" colspan="2">
                                                                    <?php echo print_currency('hotpink', '13') ?> <span class="totdistamt"><?php echo my_money_format(0); ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="6">Excess Amount</td>
                                                                <td class="text-right" colspan="2">
                                                                    <?php echo print_currency('hotpink', '13') ?> <span class="excess_amount_html"><?php echo my_money_format(0); ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="6">Service Charge</td>
                                                                <td class="text-right" colspan="2">
                                                                    <?php echo print_currency('hotpink', '13') ?> <span class="surcharge_amount_html"><?php echo my_money_format(0); ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="6">Gross Total</td>
                                                                <td class="text-right" colspan="2">
                                                                    <?php echo print_currency('hotpink', '13') ?> <span class="gross_amttopay_html"><?php echo my_money_format(0); ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right text-success" colspan="6">Round Off</td>
                                                                <td class="text-right" colspan="2">
                                                                    <?php echo print_currency('hotpink', '13') ?> <span class="roundoff_amount_html"><?php echo my_money_format(0); ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr style="font-size: 20px;">
                                                                <td class="text-right text-success" colspan="6">Gross Total Amount To Pay</td>
                                                                <td class="text-right" colspan="2">
                                                                    <?php echo print_currency('hotpink', '20') ?> <span class="totalamttopay"><?php echo my_money_format(0); ?></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- <span class="pull-right label label-info" style="position: absolute;right: 15px;bottom: 40px;font-size: 13px;">
                                                        Total Amount <?php echo print_currency('white', '13') ?> : <span class="totalamttopay"><?php echo my_money_format(0); ?></span>
                                                    </span> -->
                                                    <input type="hidden" name="totdistamt" id="totdistamt" />
                                                    <input type="hidden" name="roundoffamt" id="roundoffamt" />
                                                    <input type="hidden" name="card_roundoffamt" id="card_roundoffamt" />
                                                    <input type="hidden" name="totamt" id="totamt" />

                                                </div>
                                                <input type="hidden" name="iter_count" id="iter_count" value="<?php echo $i; ?>" />
                                            </div>

                                            <div class="clearfix"></div>

                                        </div>
                                    </div>
                                </div>

                            <?php } else {
                            ?>
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <hr>
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content text-center" id="pay_loader">
                                            <p>No fee demanded / No pending payment / Full fee exemption pending</p>
                                            <a class="btn btn-info btn-md" onclick="get_account_details('<?php echo $student_data['student_id']; ?>', '<?php echo substr($student_data['student_name'], 0, 20) ?>')"><i class="fa fa-user"></i> Student Account</a>
                                            <a class="btn btn-danger btn-md" onclick="load_fee_student();"><i class="fa fa-backward"></i> Back to Filter</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="student-print-container"></div>

<script type="text/javascript">
    // function myFunc(e) {//$('#amt_distribute')
    function view_wallet_history() {
        $('.wallet_history').toggleClass('hide');
    }
    /*** */
    //onkeypress = "return validateFloatKeyPress(this,event);" //Add to the textbox
    function validateFloatKeyPress(el, evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        var number = el.value.split('.');
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        //just one dot
        if (number.length > 1 && charCode == 46) {
            return false;
        }
        //get the carat position
        var caratPos = getSelectionStart(el);
        var dotPos = el.value.indexOf(".");
        if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
            return false;
        }
        return true;
    }

    function getSelectionStart(o) {
        if (o.createTextRange) {
            var r = document.selection.createRange().duplicate()
            r.moveEnd('character', o.value.length)
            if (r.text == '') return o.value.length
            return o.value.lastIndexOf(r.text)
        } else return o.selectionStart
    }
    /*** */

    $('.dbt_refdate').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '<?php echo date('d/m/Y', strtotime($reference_date)); ?>',
        autoclose: true,
        endDate: '<?php echo date('d/m/Y', strtotime($reference_date)); ?>'
    });

    //VIEW PAYMENT DETAILS WHEN CLICK on EYE
    function view_payment(ab, el) {
        // $('.notesa').addClass('hide');
        // $('#pay' + ab).removeClass('hide');
        $('#pay' + ab).toggleClass('hide');

        if ($('#pay' + ab).hasClass('hide')) {
            $(el).attr('title', "View Pay Details");
        } else {
            $(el).attr('title', 'Close Pay Details');
        }
    }

    //CLOSE PAYMENT DETAILS
    function close_pay(ab) {
        $('#pay' + ab).addClass('hide');
    }

    //ALLOW ONLY DECIMAL
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('#amt_distribute').change(function() {
        $('#amt_distribute_ops').val('0');
    });

    //DISTRIBUTE FUNCTION
    function distribute_amount(paytab = "") {
        var total_payable_amount = $('#total_payable_amount').val();
        var amt_pay_raw = $('#amt_distribute').val();
        var rounddistamount = getRoundOffAmount(amt_pay_raw);
        // alert(rounddistamount['roundoffamt']);
        if (paytab != 'paytab' && rounddistamount['roundoffamt'] != 0)
            swal('', 'Amount rounded to ' + rounddistamount['roundedamount'], 'info');
        amt_pay_raw = rounddistamount['roundedamount'];
        $('#amt_distribute').val(rounddistamount['roundedamount']);

        var float = /^\s*(\+)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
        if (!(float.test(amt_pay_raw))) {
            swal('', 'Please enter a valid amount to process', 'error');
            return false;
        }
        var amt_pay = parseFloat(amt_pay_raw).toFixed(2);
        if (!($('#amt_distribute').val() >= 1)) {
            swal('', 'Please enter amount >= 1', 'info');
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
        var exsamount = 0;

        var penalty = 0;
        while (j < limit) {
            idname = "#itr_" + j + "";
            iidname = "#awt_" + j + "";
            penalty += parseFloat($(idname).data('penalty')).toFixed(2);
            var penaltyamount = parseFloat($(idname).data('penalty'));
            value = parseFloat($(idname).data('transactionamtwithvat'));
            var vatamt = parseFloat($(idname).data('transactionvatamt'));
            var vatpercent = parseFloat($(idname).data('transactionvatpercent'));
            var vatofdistamt = (vatpercent * amt_pay / 100);
            var totdisamtplusvat = (1 * amt_pay) + (1 * (vatofdistamt));
            var demand_amt = ((amt_pay - penaltyamount) * 100) / (100 + vatpercent); // to find amount without vat from inclusive vat amount
            var vaaat = parseFloat((demand_amt * vatpercent) / 100);
            var tot_demand_amt_for_col = demand_amt + vaaat;

            if ((amt_pay - value) >= 0) {
                $(idname).html((value - vatamt).toFixed(2));
                $(iidname).html((value).toFixed(2));
                amt_pay = parseFloat(amt_pay - value).toFixed(2);
                totamt = parseFloat((totamt * 1) + (value * 1)).toFixed(2);
                j = j + 1;
            } else {
                if (amt_pay <= penaltyamount) {
                    $(idname).html(amt_pay);
                    $(iidname).html(amt_pay);
                    totamt = parseFloat((totamt * 1) + (amt_pay * 1)).toFixed(2);
                    amt_pay = parseFloat(amt_pay - (amt_pay)).toFixed(2);
                } else {
                    $(idname).html(parseFloat(amt_pay - vaaat).toFixed(2));
                    $(iidname).html(parseFloat(tot_demand_amt_for_col + penaltyamount).toFixed(2));
                    amt_pay = parseFloat(amt_pay - (tot_demand_amt_for_col + penaltyamount)).toFixed(2);
                    totamt = parseFloat((totamt * 1) + ((tot_demand_amt_for_col + penaltyamount) * 1)).toFixed(2);
                }

                j = limit + 1;
            }

        }
        if ($('#collapseTwo').hasClass('open')) {
            var serpercent = ($('#card_service_charge_percent').val());
            var sercharge = (((serpercent * ($('#amt_distribute').val())) / 100));
            $('.surcharge_amount_html').html(sercharge.toFixed(2));
        } else {
            var sercharge = 0;
            $('.surcharge_amount_html').html(sercharge);
        }
        // alert(totamt);

        amt_pay = parseFloat(amt_pay).toFixed(2);
        if (amt_pay > 0) {
            //if ($('#total_payable_amount').val() > 0) {
            $('.amt_after_distribute').html(amt_pay);
            $('.excess_amount_html').html(amt_pay);
            $('#excess_amount').val((amt_pay));
            exsamount = amt_pay;
        } else {
            $('.amt_after_distribute').html(0);
            $('.excess_amount_html').html(0);
            $('#excess_amount').val((0));
            exsamount = 0;
        }
        //}
        //alert(totamt);
        var totamt_pay = totamt;
        var totdistamt = totamt;

        //** With Roundoff Function*/
        totamt = parseFloat(totamt).toFixed(2);

        var gros_amount_to_pay = (totamt * 1) + (exsamount * 1) + (sercharge * 1);
        $('.gross_amttopay_html').html(gros_amount_to_pay.toFixed(2));
        var round_details = getRoundOffAmount(gros_amount_to_pay);
        $('.totalamttopay').html(round_details['roundedamount']);
        $('.surcharge_amount_html').html(sercharge.toFixed(2));
        $('.totdistamt').html(totamt);
        $('.roundoff_amount_html').html(round_details['roundoffamt']);

        $('#totdistamt').val(round_details['roundedamount']);
        $('#totamt').val(totamt);
        $('#roundoffamt').val(round_details['roundoffamt']);

        totamt = round_details['roundedamount'];
        var card_pay = ((totamt_pay * 1) + (sercharge * 1)).toFixed(2);
        $('#card_service_charge').val(sercharge.toFixed(2));

        $('#pay_amount').val((totamt - exsamount).toFixed(2)); //Pay by Cash
        $('#pay_amount1').val((totamt - exsamount).toFixed(2)); // Pay by Cheque
        $('#pay_amount2').val((gros_amount_to_pay).toFixed(2)); //card_pay Pay by Card
        $('#pay_amount3').val((totamt - exsamount).toFixed(2)); // + (exsamount * 1) Pay  by Wallet
        $('#pay_amount4').val((totamt - exsamount).toFixed(2)); // + (exsamount * 1) Pay  by Wallet
        //SALAHUDHEEN surcharge_for_excess_amount
        $('#amt_distribute_ops').val('1');

        /**
         * 
            var serpercent = ($('#card_service_charge_percent').val());
            var sercharge = (((serpercent * ($('#amt_distribute').val())) / 100));
         */
        var card_excess = amt_pay; // - sercharge;
        var ser_percent = ($('#card_service_charge_percent').val());
        var ser_chg_for_excess_amt = parseFloat(((ser_percent * (card_excess)) / 100)).toFixed(2);

        if (card_excess > 0) {
            var cardexcess_amt = parseFloat(card_excess).toFixed(2);
            $('#amt_after_distribute_card').html(cardexcess_amt);
            $('#surcharge_for_excess_amount_html').html('Service Charge : ' + ser_chg_for_excess_amt);
            $('#excess_amount_by_card').val(cardexcess_amt);
            $('#surcharge_for_excess_amount').val(ser_chg_for_excess_amt);
        } else {
            $('#amt_after_distribute_card').html('0');
            $('#surcharge_for_excess_amount_html').html('0');
            $('#excess_amount_by_card').val('0');
            $('#surcharge_for_excess_amount').val('0');
        }
        return true;
    }

    //GET ROUNDOFF AMOUNT
    function getRoundOffAmount(amount_to_round_off) {
        var num = amount_to_round_off.toString(); //If it's not already a String
        num = num.slice(0, (num.indexOf(".")) + 5); //With 3 exposing the hundredths place
        Number(num); //If you need it back as a Number

        var roundedamount = getRoundoff(amount_to_round_off, '<?php echo $this->session->userdata('Institution_Address'); ?>');
        var roundoffamt = (roundedamount - amount_to_round_off).toFixed(2);
        return {
            "roundedamount": roundedamount,
            "roundoffamt": roundoffamt,
            "distributedamount": num
        };
    }

    //pay_amount_data(5)
    function dbt_validation(paytype) {
        //Basic DBT validation starts
        $('#pay_loader').addClass('sk-loading');
        var regx = /^[A-Za-z0-9 _.-]+$/;
        if (!(regx.test($('#reference_number').val()))) {
            $('#reference_number').focus();
            swal('', 'Enter Valid Reference Number.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }if ($('#reference_number').val().length == 0) {
            $('#reference_number').focus();
            swal('', 'Enter Reference Number.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }if ($('#reference_number').val().length > 17) {
            $('#reference_number').focus();
            swal('', 'Enter Valid Reference Number.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var reference_number = $('#reference_number').val();

        if (moment($('.dbt_refdate').val(), 'DD-MM-YYYY').isValid() == false) {
            swal('', 'Payment Date required for DBT payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var referenceDate = moment($('.dbt_refdate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
        //Basic Validation Ends
        pay_amount_data(paytype);
    }

    function pay_amount_data(paytype) {
        var distr_ops = $('#amt_distribute_ops').val();
        if (distr_ops == '0') {
            swal('', 'Please click distribute to process payment.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (distribute_amount() == true) {
            if (parseFloat($('#excess_amount').val()) > 0) {
                swal({
                    title: 'Excess Amount',
                    //text: 'Should the Excess Amount to be transfered to \nDocme Wallet ?',
                    text: 'Are you sure the excess amount will be transferred to \nDocMe wallet upon selecting Yes?',
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
                        if (paytype == 5) {
                            dbt_pay(1);
                        }
                    } else {
                        swal('', 'There is an Excess Amount. Please check the amount entered to pay fee and try again', 'warning');
                        $('#pay_loader').removeClass('sk-loading');
                        return false;
                    }
                });
            } else {
                if (paytype == 5) {
                    dbt_pay(2);
                }
            }

        } else {
            swal('', 'Please check the amount and try again', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
    }


    //PAY BY DBT
    function dbt_pay(is_excess) {
        $('#pay_loader').addClass('sk-loading');

        var reference_number = $('#reference_number').val();
        var referenceDate = moment($('.dbt_refdate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');

        distribute_amount(); //Its called again for prevenyting change values from userside via browser developer option
        //var amt_pay_raw = $('#amt_distribute').val();
        //var amt_pay_raw = $('#amt_distribute').val();
        var amt_pay_raw = $('#totamt').val();

        var amt_pay = parseFloat(amt_pay_raw);
        var j = 0;
        var limit = $('#iter_count').val();
        var idname = '';
        var value = 0;
        var table = $('#tbl_fee_allocation_data'); //.DataTable();
        var pay_data = [];
        var total_voucher_amount = 0
        var total_vat_amount_paid = 0
        var total_wallet_amount = 0
        var pending_payment_without_tax = 0
        var desc = "";
        var total_penalty = 0;
        var row_penalty = 0;
        while (j < limit) {
            //alert(amt_pay);
            idname = "#itr_" + j + "";
            value = parseFloat($(idname).data('transactionamtwithvat'));
            pending_payment_without_tax = parseFloat($(idname).data('pendingpayment'));

            desc = $(idname).data('description');
            nonrealized = parseFloat($(idname).data('nonrealized'));
            row_penalty = $(idname).data('penalty');
            if (pending_payment_without_tax > 0) {
                if ((((amt_pay * 1) - (value * 1)).toFixed(2)) >= 0) {
                    $(idname).html(value);
                    j = j + 1;
                    if (nonrealized > 0) {
                        is_paid_full = 0;
                        is_paid_partial = 1;
                    } else {
                        is_paid_full = 1;
                        is_paid_partial = 0;
                    }
                    amt_pay = ((amt_pay * 1) - (value * 1)).toFixed(2);
                    var paidtaxamt = parseFloat($(idname).data('transactionvatamt'));
                    pay_data.push({
                        transaction_id: $(idname).data('transactionid'),
                        demanddate: $(idname).data('demanddate'),
                        transactionamount: $(idname).data('transactionamount'),
                        transactionvatpercent: $(idname).data('transactionvatpercent'),
                        transactionvatamt: $(idname).data('transactionvatamt'),
                        transactionamtwithvat: $(idname).data('transactionamtwithvat'),
                        is_paid_full: is_paid_full,
                        is_partial_paid: is_paid_partial,
                        paidamount: parseFloat(value).toFixed(2),
                        paid_amt_without_tax: parseFloat((pending_payment_without_tax * 1) - (paidtaxamt * 1) - (row_penalty * 1)).toFixed(2), // - (($(idname).data('penalty')) * 1),
                        paidtax: parseFloat(paidtaxamt).toFixed(2),
                        penalty: $(idname).data('penalty'),
                        description: desc,
                        penalty_only: 0 //1-penalty only, 0-fee+penalty 
                    });
                    total_voucher_amount = parseFloat((total_voucher_amount * 1) + (value * 1)).toFixed(2);
                    total_vat_amount_paid = parseFloat((total_vat_amount_paid * 1) + (paidtaxamt * 1)).toFixed(2);
                    total_penalty = parseFloat((total_penalty * 1) + (($(idname).data('penalty')) * 1)).toFixed(2);

                } else {
                    if (amt_pay > 0) {
                        $(idname).html(amt_pay);
                        var fee_vat_percent = parseFloat($(idname).data('transactionvatpercent'));
                        var fee_paid = ((100 * (amt_pay - row_penalty)) / (100 + fee_vat_percent));
                        var vat_paid = (fee_paid * fee_vat_percent / 100);
                        var voucher_amt = (fee_paid * 1) + (vat_paid * 1) + (row_penalty * 1);
                        //var check_fee_paid = parseFloat(fee_paid * 1) - (($(idname).data('penalty')) * 1);
                        //if(check_fee_paid <= 0){var feepaid = parseFloat(fee_paid * 1);}
                        pay_data.push({
                            transaction_id: $(idname).data('transactionid'),
                            demanddate: $(idname).data('demanddate'),
                            transactionamount: $(idname).data('transactionamount'),
                            transactionvatpercent: $(idname).data('transactionvatpercent'),
                            transactionvatamt: $(idname).data('transactionvatamt'),
                            transactionamtwithvat: $(idname).data('transactionamtwithvat'),
                            is_paid_full: 0,
                            is_partial_paid: 1,
                            paidamount: parseFloat(voucher_amt).toFixed(2),
                            paidtax: (voucher_amt <= row_penalty ? 0 : parseFloat(vat_paid).toFixed(2)), // parseFloat(vat_paid).toFixed(2),
                            // paid_amt_without_tax: (voucher_amt <= row_penalty ? 0 : parseFloat((fee_paid * 1) - (row_penalty * 1)).toFixed(2)), //parseFloat(fee_paid * 1).toFixed(2), // - (($(idname).data('penalty')) * 1),
                            paid_amt_without_tax: (voucher_amt <= row_penalty ? 0 : parseFloat((fee_paid * 1)).toFixed(2)),
                            penalty: (voucher_amt <= row_penalty ? voucher_amt : row_penalty),
                            description: (voucher_amt <= row_penalty ? desc : "Partial payment on " + desc),
                            penalty_only: (voucher_amt <= row_penalty ? 1 : 0) //1-penalty only, 0-fee+penalty 
                        });

                        total_voucher_amount = parseFloat((total_voucher_amount * 1) + (voucher_amt * 1)).toFixed(2);
                        total_vat_amount_paid = parseFloat((total_vat_amount_paid * 1) + (vat_paid * 1)).toFixed(2);
                        total_penalty = parseFloat((total_penalty * 1) + (((voucher_amt <= row_penalty ? voucher_amt : row_penalty)) * 1)).toFixed(2);
                        j = limit + 1;
                        amt_pay = (amt_pay * 1) - (value * 1);
                    } else {
                        j = limit + 1;
                    }
                }
                //total_penalty = (total_penalty * 1) + (($(idname).data('penalty')) * 1);
            } else {
                j = j + 1;
            }
        }


        if (pay_data.length == 0) {
            swal('', 'Atleast one fees has to be paid or if this is a wallet only transaction use Docme Wallet Transaction to add money to wallet', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var excess_amt = $('#excess_amount').val();

        if (total_vat_amount_paid == 0) {
            total_vat_amount_paid = -1;
        }
        // console.log(JSON.stringify(pay_data));
        // return false;
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/pay_fee_by_dbt';
        var roundoffamt = $('#roundoffamt').val();
        var transaction_ID = $('#transaction_ID').val();
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "studentid": student_id,
                "pay_data": JSON.stringify(pay_data),
                "amount_paid": amt_pay_raw, //amt_pay_raw,
                "round_off": $('#roundoffamt').val(),
                "total_penalty": total_penalty,
                "total_voucher_amount": total_voucher_amount,
                "total_vat_amount_paid": total_vat_amount_paid,
                "is_excess": is_excess,
                "excess_amt": excess_amt,
                "reference_number": reference_number,
                "referenceDate": referenceDate,
                "transaction_ID": transaction_ID
            },
            success: function(result) {
                $('#pay_loader').addClass('sk-loading');
                var data = JSON.parse(result);
                if (data.status == 1) {

                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    var totamt_disply_in_voucher = (amt_pay_raw * 1) + (roundoffamt * 1) + (excess_amt * 1);
                    swal('', 'Payment of ' + totamt_disply_in_voucher + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'fee'); //PRINT VOUCHER
                    reload_collection_detail(student_id, student_name);
                } else if (data.status == 11) {
                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    var wallet_voucher = data.wallet_voucher;
                    var totamt_disply_in_voucher = (amt_pay_raw * 1) + (roundoffamt * 1) + (excess_amt * 1);
                    swal('', 'Payment of ' + totamt_disply_in_voucher + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ". And Excess amount is credited to Docme Wallet with voucher number : " + wallet_voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'fee'); //, JSON.stringify(cheqarray)PRINT VOUCHER
                    reload_collection_detail(student_id, student_name);
                } else if (data.status == 111) {
                    var wallet_voucher = data.wallet_voucher;
                    swal('', 'Payment of ' + amt_pay_raw + " /- for the student " + student_name + " is completed successfully with Docme Wallet voucher number : " + wallet_voucher + ".", 'success');
                    reload_collection_detail(student_id, student_name);
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        $('#pay_loader').removeClass('sk-loading');
                        reload_collection_detail(student_id, student_name)
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        $('#pay_loader').removeClass('sk-loading');
                        return false;
                    }
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        $('#pay_loader').removeClass('sk-loading');
                        return false;
                    }
                }
                $('#pay_loader').removeClass('sk-loading');
            }
        });
    }

    //RELOAD COLLECTION PAGE
    function reload_collection_detail(studentid, studentname) {
        var searchby = $('#searchby').val();
        var search_elements = $('#search_elements').val();
        var ops_url = baseurl + 'fees/show-fee-collection';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname,
                "searchby": searchby,
                "search_elements": search_elements
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

    //PRINT VOUCHER
    function print_voucher(voucher_id, voucher_code, ptype) {
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
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
                "issue": "print",
                "ptype": ptype
            },
            success: function(result) {
                $('#voucher_data_loader').removeClass('sk-loading');
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-print-container').html('');
                    $('#student-print-container').html(data.view);
                } else {
                    alert('No data loaded');
                }

                //select_items(voucher_id,voucher_code);
            }
        });

    }

    //GO TO STUDENT ACCOUNT PAGE
    function get_account_details(studentid, studentname) {
        var ops_url = baseurl + 'account/show-account';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname
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

    function search_name() {
        var search_elements = $('#search_elements').val();
        var obj = JSON.parse(search_elements);
        var searchname = obj.admn_no;
        if (searchname.length < 3) {
            swal('', 'Please enter atleast three numbers.', 'info');
            return false;
        } else {
            $("#close_button").show();
            var ops_url = baseurl + 'fees/search-studentname-for-collection';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "searchname": searchname
                },
                success: function(result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#student-data-container').html('');
                        $('#student-data-container').html(data.view);

                        $('#advanced_search_h').html('');
                        $('#advanced_search').html('');
                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }
    }

    function searchadvance_filtername() {

        var search_elements = $('#search_elements').val();
        alert(search_elements);
        var obj = JSON.parse(search_elements);

        var stream_id = obj.stream_id;
        var searchname = obj.searchname;
        var class_id = obj.class_id;
        var batch_id = obj.batch_id;
        var academic_year = obj.curent_acdyr;
        if (stream_id == -1) {
            swal('', 'Stream required.', 'info');
            return false;
        } else if (class_id == -1) {
            swal('', 'Class required.', 'info');
            return false;
        } else {
            $("#close_button").show();
            var ops_url = baseurl + 'fees/advancesearch-studentname-for-collection';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "stream_id": stream_id,
                    "batch_id": batch_id,
                    "searchname": searchname,
                    "class_id": class_id,
                    "academic_year": academic_year
                },
                success: function(result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#student-data-container').html('');
                        $('#student-data-container').html(data.view);
                        var animation = "fadeInDown";
                        $("#student-data-container").show();
                        $('#student-data-container').addClass('animated');
                        $('#student-data-container').addClass(animation);
                        $('#admission_div').html('');
                        $('#admission_div_h').html('');

                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }
    }
</script>