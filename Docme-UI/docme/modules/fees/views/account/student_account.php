<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link href="<?php echo base_url("assets/theme/css/widget_style.css"); ?>" rel="stylesheet">
<!--Morris -->
<link href="<?php echo base_url('assets/theme/css/plugins/morris/morris-0.4.3.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url("assets/theme/js/countUp.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/theme/js/plugins/morris/raphael-2.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/morris/morris.min.js'); ?>"></script>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <span style="float:right;">

                    </span>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:" title="Fee Collection" onclick="get_collection_detail('<?php echo $student_data['student_id']; ?>', '<?php echo substr($student_data['student_name'], 0, 20) ?>')"><i class="fa fa-money" style="font-size: 20px; padding-right:10px;color:#23c6c8;"></i></a>
                        <a data-toggle="modal" data-toggle="tooltip" title="Refresh Account Details of student,<?php echo $student_data['student_name']; ?> " data-placement="left" href="javascript:void(0)" onclick="refresh_student_account('<?php echo $student_data['student_id']; ?>','<?php echo $student_data['student_name']; ?>');"><i class="fa fa-refresh" style="font-size:20px;color:#23c6c8;font-weight: 1;"></i></a>
                    </div>
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
                            <div class="col-md-5 col-sm-12 col-xs-12">
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


                                    <div class="">
                                        <div>
                                            <h4><?php echo $student_data['student_name']; ?></h4>
                                            <small>
                                                <b>Admission No.</b> : <?php echo $student_data['Admn_No']; ?>
                                            </small><br>
                                            <small>
                                                <b>Batch</b> : <?php echo $student_data['Batch_Name']; ?>
                                            </small><br>
                                            <small>
                                                <b>Class</b> : <?php echo $student_data['Description']; ?>
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
                            <div class="col-md-7 col-sm-12 col-xs-12" style="padding-top:5px; float: right;">
                                <div class="widget lazur-bg no-padding" style="margin-top:0px;">
                                    <div class="p-m" style="padding:3px !important; display: inline-block">
                                        <h1 class="m-xs" style="text-align:left"><span class="fa fa-inr" aria-hidden="true" style="color:#FFF; font-size: 25px !important;"></span>
                                            <?php
                                            $tot_amt_to_pay = ($total_payable_amount + $total_penalty + $total_arrear_amount_prev + $totalpenalty_prev);
                                            ?>
                                            <?php echo isset($tot_amt_to_pay) && !empty($tot_amt_to_pay) ? my_money_format($tot_amt_to_pay) : my_money_format(0); ?>
                                        </h1>
                                        <!--$total_pending_payment + $total_penalty + $total_arrear_amount_prev + $totalpenalty_prev-->

                                        <h3 class="font-bold no-margins" style="text-align:center;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            Payable Amount(Incl. of <?php echo print_tax_vat(); ?> / Penalty)

                                        </h3>
                                    </div>
                                    <div class="p-m" style="padding:3px !important; float: right;">
                                        <!-- display: inline-block; -->
                                        <h1 class="m-xs" style="text-align:center"><span class="fa fa-inr" aria-hidden="true" style="color:#FFF; font-size: 25px !important;"></span> <?php echo isset($total_arrear_amount) && !empty($total_arrear_amount) ? my_money_format($total_arrear_amount) : my_money_format(0); ?></h1>

                                        <h3 class="font-bold no-margins" style="text-align:right;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            Total Arrear
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <dl>
                                <dt>Payment Status:</dt>
                                <dd>
                                    <div class="progress progress-striped active m-b-sm">
                                        <?php
                                        $disperc = 'style="width: ' . $display_percent . '%;color: #000; font-weight: bold;"';
                                        ?>
                                        <div <?php echo $disperc; ?> class="progress-bar"><?php echo round($display_percent, 2, PHP_ROUND_HALF_UP); ?>%</div>
                                    </div>
                                    <!-- <small>Fee payment completed with <strong><?php echo $display_percent; ?>%</strong>. Total Demanded Amount : <?php echo my_money_format($total_demand_amt); ?>, Concession/Exemption: <?php echo my_money_format($tot_exp_conc_amount); ?>.
                                        <br> Total Paid Amount: <?php echo my_money_format($total_demand_paid_amount); ?>, Pending payment: <?php echo my_money_format($total_pending_payment); ?>
                                    </small> -->
                                    <small>Total Demanded Amount : <?php echo my_money_format($total_demand_amt); ?>, Concession/Exemption: <?php echo my_money_format($tot_exp_conc_amount); ?>, Penalty Pending: <?php echo my_money_format($total_penalty); ?>,
                                        Total Paid Amount: <?php echo my_money_format($total_demand_paid_amount + $penalty_amount); ?>, Pending payment: <?php echo my_money_format($total_pending_payment + $total_penalty); ?>
                                    </small>
                                </dd>
                            </dl>
                        </div>
                        <div class="clearfix"></div>
                        <input type="hidden" name="cash" id="cash" value="<?php echo $cash_transaction; ?>" />
                        <input type="hidden" name="card" id="card" value="<?php echo $card_transaction; ?>" />
                        <input type="hidden" name="roundoff_amount" id="roundoff_amount" value="<?php echo $roundoff_amount; ?>" />
                        <input type="hidden" name="card_surcharge" id="card_surcharge" value="<?php echo $card_surcharge; ?>" />
                        <input type="hidden" name="cheque_recon" id="cheque_recon" value="<?php echo $cheque_reconcile_transaction; ?>" />
                        <input type="hidden" name="cheque_non_recon" id="cheque_non_recon" value="<?php echo $total_non_realized_amt; ?>" />
                        <!--($cheque_non_reconcile_transaction + (($wallet_unclear_balance > 0 ? $wallet_unclear_balance : 0)))-->
                        <input type="hidden" name="online" id="online" value="<?php echo $online_transaction; ?>" />
                        <input type="hidden" name="dbt_pay" id="dbt_pay" value="<?php echo $dbt_transaction; ?>" />
                        <input type="hidden" name="wallet" id="wallet" value="<?php echo $wallet_transaction; ?>" />
                        <input type="hidden" name="wallet_withdraw_encashed" id="wallet_withdraw_encashed" value="<?php echo $wallet_encash_data; ?>" />
                        <input type="hidden" name="wallet_withdraw_non_encashed" id="wallet_withdraw_non_encashed" value="<?php echo $wallet_not_encash_data; ?>" />
                        <input type="hidden" name="wallet_withdraw_total" id="wallet_withdraw_total" value="<?php echo $wallet_total_encash_data; ?>" />

                        <div class="col-lg-12">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <h3 class="text-center">Mode of Transaction</h3>

                                    <div id="morris-donut-chart"></div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-indigo hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">attach_money</i>
                                        </div>
                                        <div class="content">
                                            <!-- DOCME  -->
                                            <div class="text">WALLET BALANCE</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $wallet_clear_balance ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($wallet_clear_balance) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-pink hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">money_off</i>
                                        </div>
                                        <div class="content">
                                            <!-- DOCME  -->
                                            <div class="text">WALLET UN CLR BALANCE</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $wallet_unclear_balance; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($wallet_unclear_balance); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-blue hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">account_balance_wallet</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">REALIZED COLLECTION</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $total_realized_amt; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($total_realized_amt); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-hotpink hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">local_atm</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">NON REALIZED COLLECTION - FEE</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $total_non_realized_amt; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($cheque_non_reconcile_transaction); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-teal hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">DEMANDABLE AMOUNT</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $demandable_with_vat; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($demandable_with_vat); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-red hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-eur"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">NON DEMANDABLE AMOUNT</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $non_demandable_with_vat; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($non_demandable_with_vat); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-orange hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-gbp"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">TOTAL PAYABLE AMOUNT</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $total_payable_amount; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($total_payable_amount + $total_penalty + $total_arrear_amount_prev + $totalpenalty_prev); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-green hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-jpy"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">TOTAL PAID AMOUNT</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $total_demand_paid_amount; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($penalty_amount + $PAID_DATA); ?></div><!-- + $PAID_DATA  $total_demand_paid_amount + -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-lime hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-wrench"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">Service Charge</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $card_surcharge; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($card_surcharge); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-purple hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-won"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">PENALTY</div>
                                            <div class="number"><?php echo my_money_format($penalty_amount); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-blue hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-try"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">PAYBACK AMOUNT</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $payback_amount; ?>" data-speed="1000" data-fresh-interval="20"></div> --
                                            <div class="number"><?php echo my_money_format($payback_amount); ?></div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-blue-grey hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-rub"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">APPROVED WITHDRAW AMOUNT</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $wallet_total_encash_data; ?>" data-speed="1000" data-fresh-interval="20"></div> --
                                            <div class="number"><?php echo my_money_format($wallet_total_encash_data); ?></div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-brown hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-btc"></i>
                                        </div>
                                        <div class="content">
                                            <!-- <div class="text">WITHDRAW ENCASHED(CASH/CHEQUE)</div> -->
                                            <div class="text">PAYBACK AMOUNT</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $wallet_encash_data; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($wallet_encash_data); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-purple hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-won"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">PENDING ENCASHMENT</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $wallet_not_encash_data; ?>" data-speed="1000" data-fresh-interval="20"></div> --
                                            <div class="number"><?php echo my_money_format($wallet_not_encash_data); ?></div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-indigo hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-gbp"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">FEE EXEMPTION</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $exemption_amount; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($exemption_amount); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-amber hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-eur"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">FEE CONCESSION</div>
                                            <!-- <div class="number count-to" data-from="0" data-to="<?php echo $concession_amount; ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                                            <div class="number"><?php echo my_money_format($concession_amount); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-cyan hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text"><?php echo print_tax_vat(); ?></div>
                                            <div class="number"><?php echo my_money_format($total_vat_amount); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="small text-danger">
                            * The fee details on pink colour are arrear.
                        </span>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="tabs-container">
                                        <ul class="nav nav-tabs">
                                            <li><a class="nav-link active" id="tab1_header" data-toggle="tab" href="#tab-1">Demand Statement</a></li>
                                            <li><a class="nav-link" data-toggle="tab" id="tab2_header" href="#tab-2">Payment Statement</a></li>
                                            <li><a class="nav-link" data-toggle="tab" id="tab3_header" href="#tab-3">Docme Wallet Statement</a></li>
                                            <li><a class="nav-link" data-toggle="tab" id="tab4_header" href="#tab-4">Previous Year Arrear</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="tab-1" class="tab-pane active">
                                                <?php //dev_export($demand_statement);
                                                ?>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading">
                                                                Fee demanded for the student, <?php echo $student_data['student_name']; ?> for this academic year
                                                            </div>
                                                            <div class="panel-body table-responsive">
                                                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_fee_demand_statement" style="padding-bottom: 0px !important;padding-top: 10px !important;width: 98%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="10%">Date</th>
                                                                            <!-- <th>Demanded Fee Type</th> -->
                                                                            <th width="10%">Transaction Description</th>
                                                                            <th width="10%">Transaction Amount</th>
                                                                            <!-- <th><?php echo print_tax_vat(); ?> Amount</th> -->
                                                                            <!-- <th>Is Arrear</th> -->
                                                                            <!-- <th>Penalty</th> -->
                                                                            <th width="10%">Paid Status</th>
                                                                            <th width="10%" class="text-center">Partial Paid <small>(if any)</small></th>
                                                                            <th width="10%">Concession</th>
                                                                            <th width="10%">Exemption</th>
                                                                            <th width="10%">Exemption Pending</th>
                                                                            <th width="10%">Reconc. Pending</th>
                                                                            <th width="10%">Pending Amount</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        // dev_export($demand_statement);
                                                                        $penalty = 0;
                                                                        $penalty_check_array = array();
                                                                        if (isset($demand_statement) && !empty($demand_statement)) {
                                                                            foreach ($demand_statement as $demand) {
                                                                                $descarray = explode('demanded', $demand['transaction_desc']);
                                                                                $paystatus = $demand['PAY_STATUS'];
                                                                                $pend_amt = $demand['TOTAL_PAID_AMT'] + $demand['CONCESSION_AMOUNT'] + $demand['EXEMPTION_AMOUNT'];
                                                                                if ($demand['PENDING_PAYMENT'] <= 0) $paystatus = 'PAID';
                                                                                else if ($demand['PENDING_PAYMENT'] > 0 && ($demand['TRANSACTION_AMOUNT'] > $demand['TOTAL_PAID_AMT']) && $demand['TOTAL_PAID_AMT'] != 0) $paystatus = 'PARTIAL PAID';
                                                                                else if ($demand['EXEMPTION_PENDING_AMOUNT'] > 0) $paystatus = 'PAYMENT PENDING';
                                                                                else if ($demand['TOTAL_NON_RECONCILED_AMOUNT'] > 0) $paystatus = 'PAYMENT PENDING';
                                                                                else $paystatus = $demand['PAY_STATUS'];
                                                                                $partial_paid_amt = $demand['PARTIAL_PAID_AMOUNT'];
                                                                                if ($demand['PENDING_PAYMENT'] > 0 && ($demand['TRANSACTION_AMOUNT'] > $demand['TOTAL_PAID_AMT'])) $partial_paid_amt = $demand['TOTAL_PAID_AMT'];
                                                                                // if ($demand['PENDING_PAYMENT'] > 0)
                                                                                //     $partial_paid_amt = $demand['PARTIAL_PAID_AMOUNT'] + $demand['PENALTY_PAID'];
                                                                                // if ($demand['PENALTY_PAID'] > 0 && $demand['PENDING_PAYMENT'] > 0) $partial_paid_amt = $partial_paid_amt + $demand['PENALTY_PAID'];
                                                                        ?>
                                                                                <tr <?php if ($demand['IS_ARREAR'] == 'YES') { ?>style="color:hotpink;" <?php } ?>>
                                                                                    <td><?php echo date('M-Y', strtotime($demand['demand_date'])); ?></td>
                                                                                    <!-- <td><?php echo $demand['fee_demand_type'] ?></td> -->
                                                                                    <td title="<?php echo $demand['transaction_desc'] ?>"><?php echo $descarray[0] ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['TRANSACTION_AMOUNT']) ?></td>
                                                                                    <!-- <td class="text-right"><?php echo my_money_format($demand['VAT_AMOUNT']) ?></td> -->
                                                                                    <!-- <td><?php echo $demand['IS_ARREAR'] ?></td> -->
                                                                                    <!-- <td class="text-right"><?php echo my_money_format(($penalty)); ?></td>$penalty  + $demand['NRC_PENALTY_PAID'] -->
                                                                                    <td><?php echo $paystatus ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($partial_paid_amt) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['CONCESSION_AMOUNT']) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['EXEMPTION_AMOUNT']) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['EXEMPTION_PENDING_AMOUNT']) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['TOTAL_NON_RECONCILED_AMOUNT']) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format(($demand['PENDING_PAYMENT'])) ?></td>
                                                                                </tr>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-2" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="panel panel-warning">
                                                            <div class="panel-heading">
                                                                Payment done for the student, <?php echo $student_data['student_name']; ?> for this academic year
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_payment_statement" style="padding-bottom: 0px !important;padding-top: 10px !important;width: 98%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Date</th>
                                                                            <th>Payment Mode</th>
                                                                            <th>Transaction Description</th>
                                                                            <th>Transaction Amount</th>
                                                                            <th>Payment Status</th>
                                                                            <th>Remarks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if (isset($payment_statement) && !empty($payment_statement)) {
                                                                            foreach ($payment_statement as $payment) {
                                                                                if ($payment['active_payment'] == 1) {
                                                                        ?>
                                                                                    <tr>
                                                                                        <td><?php echo date('d-m-Y', strtotime($payment['TRANS_DATE'])); ?></td>
                                                                                        <td><?php echo $payment['MODE_OF_PAYMENT'] ?></td>
                                                                                        <td><?php echo $payment['transaction_desc'] ?></td>
                                                                                        <td class="text-right"><?php echo  my_money_format($payment['transaction_amount']) ?></td>
                                                                                        <td><?php echo $payment['payment_status'] ?></td>
                                                                                        <td><?php echo $payment['remarks'] ?></td>
                                                                                    </tr>
                                                                        <?php
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-3" class="tab-pane">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="panel panel-success">
                                                            <div class="panel-heading">
                                                                Docme Wallet transactions done for the student, <?php echo $student_data['student_name']; ?> for this academic year
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_wallet_statement" style="padding-bottom: 0px !important;padding-top: 10px !important;width: 98%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Date</th>
                                                                            <th>Transaction Type</th>
                                                                            <th>Payment Mode</th>
                                                                            <th>Transaction Description</th>
                                                                            <th>Transaction Amount</th>
                                                                            <th>Payment Status</th>
                                                                            <th>Remarks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if (isset($wallet_statement) && !empty($wallet_statement)) {
                                                                            foreach ($wallet_statement as $wallet) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td><?php echo date('d-m-Y', strtotime($wallet['TRANS_DATE'])); ?></td>
                                                                                    <td><?php echo $wallet['type_desc'] ?></td>
                                                                                    <td><?php echo $wallet['MODE_OF_PAYMENT'] ?></td>
                                                                                    <td><?php echo $wallet['description'] ?></td>
                                                                                    <td class="text-right"><?php echo  my_money_format($wallet['transaction_amount']) ?></td>
                                                                                    <td><?php echo $wallet['payment_status'] ?></td>
                                                                                    <td><?php echo $wallet['remarks'] ?></td>
                                                                                </tr>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="tab-4" class="tab-pane">
                                                <?php //dev_export($demand_statement);
                                                ?>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading">
                                                                Previous year arrear for the student, <?php echo $student_data['student_name']; ?>
                                                            </div>
                                                            <div class="panel-body table-responsive">
                                                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_fee_demand_statement_prev" style="padding-bottom: 0px !important;padding-top: 10px !important;width: 98%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="10%">Date</th>
                                                                            <!-- <th>Demanded Fee Type</th> -->
                                                                            <th width="10%">Transaction Description</th>
                                                                            <th width="10%">Transaction Amount</th>
                                                                            <!-- <th><?php echo print_tax_vat(); ?> Amount</th> -->
                                                                            <!-- <th>Is Arrear</th> -->
                                                                            <!-- <th>Penalty</th> -->
                                                                            <th width="10%">Paid Status</th>
                                                                            <th width="10%" class="text-center">Partial Paid <small>(if any)</small></th>
                                                                            <th width="10%">Concession</th>
                                                                            <th width="10%">Exemption</th>
                                                                            <th width="10%">Exemption Pending</th>
                                                                            <th width="10%">Reconc. Pending</th>
                                                                            <th width="10%">Pending Amount</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        // dev_export($demand_statement);
                                                                        $penalty = 0;
                                                                        $penalty_check_array = array();
                                                                        if (isset($demand_statement_prev) && !empty($demand_statement_prev)) {
                                                                            foreach ($demand_statement_prev as $demand) {
                                                                                $descarray = explode('demanded', $demand['transaction_desc']);
                                                                                $paystatus = $demand['PAY_STATUS'];
                                                                                if ($demand['PENDING_PAYMENT'] <= 0) $paystatus = 'PAID';
                                                                                // else if ($demand['PENDING_PAYMENT'] > 0) $paystatus = 'PARTIAL PAID asd';
                                                                                else if ($demand['EXEMPTION_PENDING_AMOUNT'] > 0) $paystatus = 'PAYMENT PENDING';
                                                                                else if ($demand['TOTAL_NON_RECONCILED_AMOUNT'] > 0) $paystatus = 'PAYMENT PENDING';
                                                                                else $paystatus = $demand['PAY_STATUS'];


                                                                                $partial_paid_amt = $demand['PARTIAL_PAID_AMOUNT'];
                                                                                if ($partial_paid_amt == 0) {
                                                                                    if ($demand['PENDING_PAYMENT'] > 0) {
                                                                                        $partial_paid_amt =  $demand['TOTAL_PAID_AMT'];
                                                                                    }
                                                                                }
                                                                                // if ($demand['PENDING_PAYMENT'] > 0)
                                                                                //     $partial_paid_amt = $demand['PARTIAL_PAID_AMOUNT'] + $demand['PENALTY_PAID'];
                                                                                // if ($demand['PENALTY_PAID'] > 0 && $demand['PENDING_PAYMENT'] > 0) $partial_paid_amt = $partial_paid_amt + $demand['PENALTY_PAID'];
                                                                        ?>
                                                                                <tr <?php if ($demand['IS_ARREAR'] == 'YES') { ?>style="color:hotpink;" <?php } ?>>
                                                                                    <td><?php echo date('M-Y', strtotime($demand['demand_date'])); ?></td>
                                                                                    <!-- <td><?php echo $demand['fee_demand_type'] ?></td> -->
                                                                                    <td title="<?php echo $demand['transaction_desc'] ?>"><?php echo $descarray[0] ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['TRANSACTION_AMOUNT']) ?></td>
                                                                                    <!-- <td class="text-right"><?php echo my_money_format($demand['VAT_AMOUNT']) ?></td> -->
                                                                                    <!-- <td><?php echo $demand['IS_ARREAR'] ?></td> -->
                                                                                    <!-- <td class="text-right"><?php echo my_money_format(($penalty)); ?></td>$penalty  + $demand['NRC_PENALTY_PAID'] -->
                                                                                    <td><?php echo $paystatus ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($partial_paid_amt) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['CONCESSION_AMOUNT']) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['EXEMPTION_AMOUNT']) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['EXEMPTION_PENDING_AMOUNT']) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format($demand['TOTAL_NON_RECONCILED_AMOUNT']) ?></td>
                                                                                    <td class="text-right"><?php echo my_money_format(($demand['PENDING_PAYMENT'])) ?></td>
                                                                                </tr>
                                                                        <?php
                                                                            }
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .info-box .content {
        padding: 0px 10px !important;
    }
</style>

<script type="text/javascript">
    $(function() {
        var countUp_elem = $('.count-to');
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '<i class="fa fa-inr" style="font-size:14px;"></i> '
        };
        //Syntax :  CountUp(id,startvalue.endvalue,decimal_points,Duration,Array of Options)            
        countUp_elem.each(function(index) {
            var counter_val = $(this).data('to');
            var countUp = new CountUp(countUp_elem[index], 0, counter_val, 2, 2, options);
            countUp.start();
        });
    });
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
                label: "Cash ",
                value: $('#cash').val()
            },
            {
                label: "Card ",
                value: $('#card').val()
            },
            {
                label: "Cheque \nReconciled ",
                value: $('#cheque_recon').val()
            },
            {
                label: "Cheque Non \nReconciled ",
                value: $('#cheque_non_recon').val()
            },
            {
                label: "Round Off",
                value: $('#roundoff_amount').val()
            },
            {
                label: "Service Charges",
                value: $('#card_surcharge').val()
            },
            {
                label: "Transfer ", //previously Wallet :changed 21-10-2019
                value: $('#wallet').val()
            },
            {
                label: "Online ",
                value: $('#online').val()
            },
            {
                label: "DBT ",
                value: $('#dbt_pay').val()
            }
        ],
        resize: true,
        colors: ['#F44336', '#4caf50', '#4596f2', '#ff69b4', '#54cdb4', '#cddc39', '#f6c108', '#FF9800', '#1ab377'],
    });
    $('#tab1_header').click();

    var table = $('#tbl_fee_demand_statement').dataTable({
        responsive: false,
        stateSave: false,
        "lengthMenu": [
            [10, 100, 250, 500, -1],
            [10, 100, 250, 500, "All"]
        ],
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });
    var table = $('#tbl_fee_demand_statement_prev').dataTable({
        responsive: false,
        stateSave: false,
        "lengthMenu": [
            [10, 100, 250, 500, -1],
            [10, 100, 250, 500, "All"]
        ],
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });
    var table = $('#tbl_payment_statement').dataTable({
        responsive: false,
        stateSave: false,
        "lengthMenu": [
            [10, 100, 250, 500, -1],
            [10, 100, 250, 500, "All"]
        ],
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });
    var table = $('#tbl_wallet_statement').dataTable({
        responsive: false,
        stateSave: false,
        "lengthMenu": [
            [10, 100, 250, 500, -1],
            [10, 100, 250, 500, "All"]
        ],
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });


    function refresh_student_account(studentid, studentname) {
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

    function get_collection_detail(studentid, studentname) {
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
</script>