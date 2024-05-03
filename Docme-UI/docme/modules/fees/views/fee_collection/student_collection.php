<?php
// // PHP program to illustrate  
// // date_diff() function 

// // creates DateTime objects 
// $datetime1 = date_create('10-03-2020');
// $datetime2 = date_create('13-03-2020');

// // calculates the difference between DateTime objects 
// $interval = date_diff($datetime1, $datetime2);

// // printing result in days format 
// echo $interval->format('%R%a days');
// if ('01-06-2019' >= '01-07-2019') echo 'ABCD';
// else echo 'EFGH';

// $start    = (new DateTime('2019-08-01 00:00:00.000'))->modify('first day of this month');
// $end      = (new DateTime('2019-10-31 00:00:00.000'))->modify('first day of next month');
// $interval = DateInterval::createFromDateString('1 month');
// $period   = new DatePeriod($start, $interval, $end);

// foreach ($period as $dt) {
//     echo $dt->format("Y-m-d") . "<br>\n";
// }
?>

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
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <span style="float:right;">
                        <a href="javascript:" title="Student Account" onclick="get_account_details('<?php echo $student_data['student_id']; ?>', '<?php echo substr($student_data['student_name'], 0, 20) ?>')"><i class="fa fa-user" style="font-size: 20px; padding-right:10px;"></i></a>
                        <a href="javascript:" title="Reload Collection" id="reload_collection_detail" studentid="<?php echo $student_data['student_id']; ?>" studentname="<?php echo trim($student_data['student_name']); ?>"><i class="fa fa-refresh" style="font-size: 20px;"></i></a>
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
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div id="like_button_container"></div>
                                <div class="profile-image">
                                    <?php
                                    $profile_image = "";
                                    if (!empty(get_student_image($student_data['student_id']))) {
                                        $profile_image = get_student_image($student_data['student_id']);
                                    } else if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {
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
                                                Admission No. : <?php echo $student_data['Admn_No']; ?>
                                            </small><br>
                                            <small>
                                                Batch : <?php echo $student_data['Batch_Name']; ?>
                                            </small><br>
                                            <small>
                                                Class : <?php echo $student_data['Description']; ?>
                                            </small><small>
                                                <b>Nationality</b> : <?php echo ($student_data['Nationality'] = 'INDIAN' ? $student_data['Nationality'] : 'FOREIGN'); ?>
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
                                        <h1 class="m-xs" style="text-align:left; font-size: 25px !important;">
                                            <?php print_currency('white'); ?>
                                            <?php echo my_money_format($fee_summary); //($fee_summary); //);
                                            //echo number_format(($fee_summary), 4);
                                            ?>
                                            <?php //echo isset($fee_summary) && !empty($fee_summary) ? number_format(floor($fee_summary * 100) / 100, 2, '.', '') : 0; 
                                            ?></h1>

                                        <h3 class="font-bold no-margins" style="text-align:left;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            <!-- -->Payable Amount(Incl. of <?php echo print_tax_vat(); ?> / Penalty)
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

                                        <h3 class="font-bold no-margins" style="text-align:right;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            Docme Wallet&nbsp;
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
                                                    <input type="text" placeholder="Enter amount you wish to pay" class="form-control allownumericwithdecimal" name="amt_distribute" id="amt_distribute" onkeypress="return validateFloatKeyPress(this,event);" maxlength="10" style="height: 39px !important;text-align:right;">
                                                    <span class="input-group-btn"> <button style="background:hotpink !important;border-color: hotpink !important;height: 39px !important;padding-bottom: 0px;margin-bottom: 0px;border-bottom-width: 0px;border-top-width: 0px; cursor:pointer;" type="button" onclick="distribute_amount();" class="btn btn-primary">Distribute to Calculate <?php echo print_tax_vat(); ?>
                                                        </button> </span>
                                                </div>
                                                <span class="text-muted small">
                                                    * Fees Distributed will be reflected in the below table of fee heads. The fee details on pink colour are arrear.
                                                </span><br>
                                                <!--text-muted-->
                                                <span class="small text-danger">
                                                    ** <?php echo print_tax_vat(); ?> will be calculated after distributing the amount
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
                                                                        <i class="fa fa-money text-info"></i>
                                                                    </div>
                                                                    <h5 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="click_to_pay">Cash Payment</a>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapseOne" class="panel-collapse collapse in">
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label>Amount Total</label>
                                                                                <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                    <input type="text" style="background-color: #FFFFFF;text-align:right;" class="form-control" disabled="" name="pay_amount" id="pay_amount" value="<?php echo my_money_format(0); ?>" style="height: 39px !important;">
                                                                                    <span class="input-group-addon">
                                                                                        <?php print_currency('hotpink'); ?>
                                                                                    </span>
                                                                                </div>
                                                                                <hr>
                                                                                <table class="table table-bordered table-striped">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="text-right">Excess amount after distribution&nbsp;</td>
                                                                                            <td class="text-right"><?php print_currency('white', '12'); ?> <span id="amt_after_distribute" class="amt_after_distribute"><?php echo my_money_format(0); ?></span>&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="text-right" colspan="2">
                                                                                                <a class="btn btn-info btndisable" id="cash_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="pay_amount_data(1);">
                                                                                                    <i class="fa fa-money"></i> Make Payment
                                                                                                </a>&nbsp;
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <!-- <a class="btn btn-info btndisable" id="cash_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="pay_amount_data(1);">
                                                                                    <i class="fa fa-money"></i> Make Payment
                                                                                </a>
                                                                                <span style="float:right;">
                                                                                    <span class="label label-success float-right" style="background-color:hotpink;font-size: 12px;">Excess amount after distribution : <?php print_currency('white', '12'); ?> <span id="amt_after_distribute" class="amt_after_distribute"><?php echo my_money_format(0); ?></span> </span>
                                                                                </span> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <div class="pull-right">
                                                                        <i class="fa fa-money text-sucess"></i>
                                                                    </div>
                                                                    <h5 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="click_to_pay">Cheque Payment</a>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapse3" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <?php if ($black_list_data == 1) { ?>
                                                                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                                                    <span class="text-muted small">
                                                                                        The student, <?php echo $student_data['student_name']; ?> with admission number <?php echo $student_data['Admn_No']; ?> on batch <?php echo $student_data['Batch_Name']; ?>
                                                                                        is blacklisted as there is cheque bounce/s.
                                                                                        Hence cannot make payment through cheque.
                                                                                        Please contact accounts department to release from blacklist to continue the payment through cheque transaction.
                                                                                    </span>
                                                                                </div>
                                                                            <?php } else {
                                                                            ?>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Cheque Number</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control" maxlength="10" name="ChequeNumber" id="ChequeNumber" placeholder="Enter Cheque Number">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Cheque Date</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control" name="ChequeDate" readonly="" style="background-color:white;" id="ChequeDate" placeholder="Enter Cheque Date" value="<?php echo date('d/m/Y'); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Account Holder Name</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control alpha" name="NameofDrawer" maxlength="30" id="NameofDrawer" placeholder="Account Holder Name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Account Holder Address</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control" name="DrawerAddress" maxlength="100" id="DrawerAddress" placeholder="Account Holder Address">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Name of Bank</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <div>
                                                                                            <select class="select2_registration form-control" id="NameofBank" name="NameofBank" placeholder="Select a bank" style="width:100%;">
                                                                                                <?php
                                                                                                if (isset($bank_details) && !empty($bank_details)) {
                                                                                                    echo '<option selected value="-1">Select a bank</option>';
                                                                                                    foreach ($bank_details as $bank) {
                                                                                                        echo '<option bankname="' . $bank['bank_name'] . '" value="' . $bank['id'] . '">' . $bank['bank_name'] . ' ( ' . $bank['bank_abbr'] . ' )' . '</option>';
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Bank Branch</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control" name="BranchBank" maxlength="50" id="BranchBank" placeholder="Bank Branch">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                                <div class="form-group col-lg-12 col-md-12">

                                                                                    <label>Amount Total</label>
                                                                                    <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                        <input type="text" style="background-color: #FFFFFF;height: 39px !important;text-align:right;" class="form-control" disabled="" name="pay_amount1" id="pay_amount1" value="<?php echo my_money_format(0) ?>">
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
                                                                                                <td class="text-right"><span id="amt_after_distribute" class="amt_after_distribute"><?php echo my_money_format(0) ?></span>&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="text-right" colspan="2">
                                                                                                    <a class="btn btn-info" id="cheque_pay_btn" style="margin-left:0px;" href="javascript:void(0)" onclick="cheque_validation(2);">
                                                                                                        <i class="fa fa-money"></i> Make Payment
                                                                                                    </a>&nbsp;
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!-- <a class="btn btn-info" id="cheque_pay_btn" style="margin-left:0px;" href="javascript:void(0)" onclick="cheque_validation(2);">
                                                                                        <i class="fa fa-money"></i> Make Payment

                                                                                    </a>
                                                                                    <span style="float:right;">
                                                                                        <span class="label label-success label-md float-right" style="background-color:hotpink;font-size: 12px;">Excess amount after distribution : <?php print_currency('white', '12'); ?> <span id="amt_after_distribute" class="amt_after_distribute"><?php echo my_money_format(0) ?></span> </span>
                                                                                    </span> -->
                                                                                </div>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <div class="pull-right">
                                                                        <i class="fa fa-cc-amex text-success"></i>
                                                                        <i class="fa fa-cc-mastercard text-warning"></i>
                                                                        <i class="fa fa-cc-discover text-danger"></i>
                                                                    </div>
                                                                    <h5 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="click_to_pay" clicked="forcard">Card Payment</a>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapseTwo" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <form role="form" id="payment-form">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group has-success">
                                                                                            <label>Card Number</label>&nbsp;<span class="text-danger">*</span>
                                                                                            <input type="text" id="CardNumber" name="CardNumber" class="form-control" data-mask="XXXX-XXXX-XXXX-9999" placeholder="Enter Card Number">

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group has-success">
                                                                                            <label>Name as on Card</label>&nbsp;<span class="text-danger">*</span>
                                                                                            <input type="text" class="form-control" name="NameOfCard" id="NameOfCard" placeholder="Enter Name as on Card">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <label>Service Charge <?php echo $card_service_charge; ?>%</label>
                                                                                        <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                            <input type="text" style="background-color: #FFFFFF;height: 39px !important; text-align:right;" class="form-control" disabled="" name="card_service_charge" id="card_service_charge" placeholder="Service Charge">
                                                                                            <span class="input-group-addon">
                                                                                                <?php print_currency('hotpink'); ?>
                                                                                            </span>
                                                                                            <input type="hidden" name="card_service_charge_percent" disabled="" id="card_service_charge_percent" value="<?php echo $card_service_charge; ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <label>Amount Total</label>
                                                                                        <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                            <input type="text" style="background-color: #FFFFFF;height: 39px !important;text-align:right;" class="form-control" disabled="" name="pay_amount2" id="pay_amount2" value="<?php echo my_money_format(0) ?>">
                                                                                            <span class="input-group-addon">
                                                                                                <?php print_currency('hotpink'); ?>
                                                                                            </span>
                                                                                        </div>
                                                                                        <hr>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>
                                                                                    <div class="col-md-12">
                                                                                        <table class="table table-bordered table-striped">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="text-right">Excess amount after distribution&nbsp;</td>
                                                                                                    <td class="text-right" id="amt_after_distribute_card"><?php echo my_money_format(0); ?>&nbsp;</td>
                                                                                                    <td class="text-right" id="surcharge_for_excess_amount_html">Service Charge : <?php echo my_money_format(0); ?>&nbsp;</td>
                                                                                                    <input type="hidden" name="excess_amount_by_card" id="excess_amount_by_card" value="0" />
                                                                                                    <input type="hidden" name="surcharge_for_excess_amount" id="surcharge_for_excess_amount" value="0" />
                                                                                                </tr>
                                                                                                <!-- <tr>
                                                                                                    <td class="text-right">Service Charge&nbsp;</td>
                                                                                                    <td class="text-right" id="card_service_charge_html"><?php echo my_money_format(0); ?>&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="text-right">Card Total&nbsp;</td>
                                                                                                    <td class="text-right" id="card_amount_pay_html"><?php echo my_money_format(0); ?>&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="text-right">Round Off&nbsp;</td>
                                                                                                    <td class="text-right" id="card_round_off_html"><?php echo my_money_format(0); ?>&nbsp;</td>
                                                                                                </tr>
                                                                                                <tr style="font-size: 20px;">
                                                                                                    <td class="text-right">TOTAL&nbsp;</td>
                                                                                                    <td class="text-right" id="card_total_html"><?php echo my_money_format(0); ?>&nbsp;</td>
                                                                                                </tr> -->
                                                                                                <tr>
                                                                                                    <td class="text-right" colspan="3">
                                                                                                        <a class="btn btn-info" id="card_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="card_validation(3);">
                                                                                                            <i class="fa fa-money"></i> Make Payment


                                                                                                        </a>&nbsp;
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>

                                                                                        <!-- <span style="float:right;">
                                                                                            <!--<a class="label label-danger" href="javascript:" onclick="reload_collection_detail(<?php echo $student_data['student_id']; ?>, <?php echo $student_data['student_name']; ?>);">Refresh</a>--
                                                                                            <span class="float-right" style="font-size: 12px;">Excess amount after distribution : <?php print_currency('white', '12'); ?> <span id="amt_after_distribute_card">0</span> </span>
                                                                                            
                                                                                        </span> -->
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <div class="pull-right">
                                                                        <i class="fa fa-money text-info"></i>
                                                                    </div>
                                                                    <h5 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="click_to_pay">Docme - Wallet</a>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapseThree" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <form role="form" id="payment-form">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Wallet Amount</label>
                                                                                            <?php
                                                                                            $wallet_available_amt = ($e_wallet - $wallet_withdraw_request_amount);
                                                                                            ?>
                                                                                            <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                                <input type="text" style="background-color: #FFFFFF;height: 39px !important; text-align:right;" class="form-control" readonly="" disabled="" name="wallet_pending_amount" id="wallet_pending_amount" placeholder="" value="<?php echo ($wallet_available_amt > 0 ? ($wallet_available_amt) : my_money_format(0)); ?>">
                                                                                                <span class="input-group-addon">
                                                                                                    <?php print_currency('hotpink'); ?>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Paying Amount</label>
                                                                                            <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                                <input type="text" style="background-color: #FFFFFF;height: 39px !important; text-align:right;" class="form-control" readonly="" disabled="" name="pay_amount3" id="pay_amount3" placeholder="Enter pay amount" value="<?php echo my_money_format(0); ?>">
                                                                                                <span class="input-group-addon">
                                                                                                    <?php print_currency('hotpink'); ?>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="clearfix"></div>
                                                                                    <div class="col-md-12">
                                                                                        <?php if ($wallet_withdraw_request_amount > 0) { ?>
                                                                                            <a href="javascript:" class="label label-xs label-success pull-right" onclick="view_wallet_history()" title="Wallet Details"><i class="fa fa-eye"></i> Wallet Details</a>
                                                                                            <table class="table table-bordered table-striped wallet_history hide">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Wallet Amount</th>
                                                                                                        <th>Withdraw Request Pending</th>
                                                                                                        <th>Available Wallet Amount for Payment</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><?php echo my_money_format($e_wallet); ?></td>
                                                                                                        <td><?php echo my_money_format($wallet_withdraw_request_amount); ?></td>
                                                                                                        <!-- <td><?php echo my_money_format($e_wallet - $wallet_withdraw_request_amount); ?></td> -->
                                                                                                        <td><?php echo ($wallet_available_amt > 0 ? my_money_format($wallet_available_amt) : my_money_format(0)); ?></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <hr>
                                                                                        <table class="table table-bordered table-striped">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="text-right" colspan="2">
                                                                                                        <a class="btn btn-info" id="card_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="pay_amount_data(4);">
                                                                                                            <i class="fa fa-money"></i> Make Payment
                                                                                                        </a>&nbsp;
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <!-- <a class="btn btn-info" id="card_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="pay_amount_data(4);">
                                                                                            <i class="fa fa-money"></i> Make Payment
                                                                                        </a> -->
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <div class="pull-right">
                                                                        <i class="fa fa-university text-sucess"></i>
                                                                    </div>
                                                                    <h5 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="click_to_pay">Direct Bank Transfer</a>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapse5" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <small class="text-danger">* When Direct Bank Transfer selects, the penalty (if any) calculations according to the payment date selected here.</small>
                                                                                <hr />
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>Reference Number</label>&nbsp;<span class="text-danger">*</span>
                                                                                    <input type="text" class="form-control alphanumeric" maxlength="17" name="reference_number" id="reference_number" placeholder="Enter Reference Number">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label>Payment Date</label>&nbsp;<span class="text-danger">*</span>
                                                                                    <input type="text" class="form-control refdate" name="ReferenceDate" readonly="" style="background-color:white;" id="ReferenceDate" placeholder="Enter Reference Date" value="<?php echo date('d/m/Y'); ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                            <!-- <div class="form-group col-lg-12 col-md-12">
                                                                                <label>Amount Total</label>
                                                                                <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                    <input type="text" style="background-color: #FFFFFF;height: 39px !important;text-align:right;" class="form-control" disabled="" name="pay_amount4" id="pay_amount4" value="<?php echo my_money_format(0) ?>">
                                                                                    <span class="input-group-addon">
                                                                                        <?php print_currency('hotpink'); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div> -->

                                                                            <div class="clearfix"></div>
                                                                            <div class="col-xs-12">
                                                                                <div class="text-right">
                                                                                    <a class="btn btn-info" id="dbt_pay_btn" style="margin-left:0px;" href="javascript:void(0)" onclick="re_calculate_payments('<?php echo $student_data['student_id']; ?>','<?php echo trim($student_data['student_name']); ?>');">
                                                                                        <i class="fa fa-calculator"></i> Re Calculate Amount
                                                                                    </a>&nbsp;
                                                                                </div>
                                                                                <!-- <table class="table table-bordered table-striped">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td class="text-right">Excess amount after distribution&nbsp;</td>
                                                                                            <td class="text-right"><?php print_currency('white', '12'); ?> <span id="amt_after_distribute" class="amt_after_distribute"><?php echo my_money_format(0) ?></span>&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="text-right" colspan="2">
                                                                                                <a class="btn btn-info" id="dbt_pay_btn" style="margin-left:0px;" href="javascript:void(0)" onclick="dbt_validation(5);">
                                                                                                    <i class="fa fa-money"></i> Make Payment
                                                                                                </a>&nbsp;
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table> -->
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
                                                    * Other Fees (if any) will collect first and so displayed at top of the table.
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
                                                            // dev_export($club_fee_data);
                                                            $penalty = 0;
                                                            $instlmnt1 = 0;
                                                            $termname1 = '';
                                                            $penalty_check_array = array();
                                                            $row_array = array();
                                                            if (isset($fee_data) && !empty($fee_data)) {
                                                                foreach ($fee_data as $fees) {
                                                                    $penalty = 0;
                                                                    // echo $fees['FEEID'];
                                                                    // echo $fees['PENALTY_PAID'];
                                                                    //added this condition for is there penalty details added for this feecode - NOV 06, 2019
                                                                    // dev_export($penalty_details);
                                                                    if (!isset($penalty_check_array[$fees['FEEID'] . '_' . $fees['DEM_MONTH']])) {
                                                                        if (isset($penalty_details) && !empty($penalty_details) && isset($penalty_details[$fees['FEEID']])) {
                                                                            // dev_export($penalty_details[$fees['FEEID']]);
                                                                            $currentdate = date_create(date('d-m-Y'));
                                                                            $demanddate = date_create(date('d-m-Y', strtotime($fees['ARREAR_DATE'])));
                                                                            $effect_date = date_create(date('d-m-Y', strtotime($penalty_details[$fees['FEEID']]['effectdate'])));
                                                                            $interval = date_diff($currentdate, $demanddate);
                                                                            $days = $interval->format('%R%a');
                                                                            // echo $days; // . '-' . $fees['FEEID'] . '/';
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
                                                                                // $penalty = (($penalty - $fees['NON_RECONCILED_PENALTY']) > 0 ? ($penalty - $fees['NON_RECONCILED_PENALTY']) : 0);
                                                                                $penalty_check_array[$fees['FEEID'] . '_' . $fees['DEM_MONTH']] = $fees['FEEID'];
                                                                                // array_push($penalty_check_array[$fees['DEMAND_DATE']], $fees['FEEID']);
                                                                            }
                                                                        } else {
                                                                            $penalty = 0;
                                                                        }
                                                                    }
                                                                    // echo $fees['FEEID'] . ' : ' . $fees['PENALTY_PAID'] . '<br>';
                                                                    // dev_export($penalty_check_array);
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
                                                                    if ($exmptnamt_pending > 0 || $not_recon_amt > 0 || $not_recon_with_penalty > 0) $bgcolor = "background-color:#c9c9c9";
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
                                                                                                <td class="text-right"><?php echo my_money_format(($not_recon_with_penalty > 0) ? $not_recon_with_penalty : '0'); ?></td>
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

                            <!-- SIBLINGS LIST -->
                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                                        <h5>Siblings of <span><?php echo $student_data['student_name']; ?></span></h5>
                                    </div>
                                    <div class="ibox-content no-padding table-responsive" id="pay_loader">
                                        <table class="table table-bordered table-striped" width="100%" style="margin-bottom: 0px;">
                                            <?php if (is_array($sibilings_data) && !empty($sibilings_data)) {
                                                $ccc = 0; ?>
                                                <!-- <tr class="bodyarea">
                                                                    <td colspan="7" class="t-left">
                                                                        <h4>Father's Name: &nbsp;&nbsp; asdf</h4>
                                                                    </td>
                                                                </tr> -->
                                                <tr class="header">
                                                    <th width="5%" class="text-center">Sl.No.</th>
                                                    <th width="15%">Admission No.</th>
                                                    <th width="30%">Name</th>
                                                    <th width="17%">Class</th>
                                                    <th width="10%" class="text-center">Priority</th>
                                                    <th width="18%" class="text-center">Status</th>
                                                    <th width="5%" class="text-center">Action</th>
                                                </tr>
                                                <?php foreach ($sibilings_data as $siblings) { ?>
                                                    <tr class="bodyarea">
                                                        <td class="text-center"><?php echo ++$ccc ?></td>
                                                        <td><?php echo $siblings['Admn_No'] ?></td>
                                                        <td class="t-left"><?php echo $siblings['student_name'] ?></td>
                                                        <td><?php echo $siblings['Description'] ?> - <?php echo $siblings['Division'] ?></td>
                                                        <td class="text-center"><?php echo $siblings['Priority'] ?></td>
                                                        <td class="text-center"><?php echo $siblings['stud_status'] ?></td>
                                                        <td class="text-center">
                                                            <a href="javascript:" title="Collect Fees for <?php echo $siblings['student_name'] ?>" id="collect_siblings_fee" onclick="collection_detail('<?php echo $siblings['student_id']; ?>', '<?php echo $siblings['student_name'] ?>')" studentid="<?php echo $siblings['student_id']; ?>" studentname="<?php echo trim($siblings['student_name']); ?>"><i class="fa fa-paper-plane"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr class="bodyarea">
                                                    <td colspan="7" class="text-center">
                                                        No Siblings for <?php echo $student_data['student_name']; ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
<div id="student-print-container"></div>

<script type="text/javascript">
    // function myFunc(e) {//$('#amt_distribute')
    function view_wallet_history() {
        $('.wallet_history').toggleClass('hide');
    }

    // $('body').on('keypress', '#amt_distribute', function() {
    //     var val = $('#amt_distribute').val();
    //     var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
    //     var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
    //     if (re.test(val)) {
    //         //do something here

    //     } else {
    //         val = re1.exec(val);
    //         if (val) {
    //             this.value = val[0];
    //         } else {
    //             this.value = "";
    //         }
    //     }
    // });
    //}
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

    $('#NameofBank').select2({
        'theme': 'bootstrap'
    });
    $('#ChequeDate').datepicker({
        format: 'dd/mm/yyyy',
        // startDate: '-80d',
        autoclose: true
        // endDate: '<?php echo date('D/M/Y'); ?>'
    });
    $('.refdate').datepicker({
        format: 'dd/mm/yyyy',
        // startDate: '-80d',
        autoclose: true,
        endDate: '<?php echo date('D/M/Y'); ?>'
    });

    $(function() {
        $('#NameofDrawer').keydown(function(er) {
            if (er.altKey || er.ctrlKey) {
                er.preventDefault();
            } else {
                var key = er.keyCode;
                if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 65 && key <= 90) || key == 126 || key == 45 || key == 109 || key == 189 || key == 57 || key == 48)) {
                    er.preventDefault();
                }
            }
        });
        $('#DrawerAddress').keydown(function(er) {
            if (er.altKey || er.ctrlKey) {
                er.preventDefault();
            } else {
                var key = er.keyCode;
                if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 65 && key <= 90) || key == 126 || key == 45 || key == 109 || key == 189 || key == 57 || key == 48)) {
                    er.preventDefault();
                }
            }
        });
        $('#BranchBank').keydown(function(er) {
            if (er.altKey || er.ctrlKey) {
                er.preventDefault();
            } else {
                var key = er.keyCode;
                if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 65 && key <= 90) || key == 126 || key == 45 || key == 109 || key == 189 || key == 57 || key == 48)) {
                    er.preventDefault();
                }
            }
        });

        $('body').on('click', '#reload_collection_detail', function() {
            var studentid = $(this).attr('studentid');
            var studentname = $(this).attr('studentname');
            reload_collection_detail(studentid, studentname);
        });
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
        if (paytab != 'paytab' && rounddistamount['roundoffamt'] != 0) {
            if (rounddistamount['roundedamount'] < amt_pay_raw) amt_pay_raw = ((rounddistamount['roundedamount'] * 1) + (1 * 1));
            else amt_pay_raw = rounddistamount['roundedamount'];
            swal('', 'Amount rounded to ' + amt_pay_raw, 'info');
        }

        amt_pay_raw = amt_pay_raw; //rounddistamount['roundedamount'];
        $('#amt_distribute').val(amt_pay_raw);
        // $('#amt_distribute').val(rounddistamount['roundedamount']);
        //Check Enterd amount is Valid or not : SALAH - nov8, 2109
        //--comment this out for removing the conflict with above round off condition - jan25, 2020
        // var amt_for_check = parseFloat(((total_payable_amount * 1) - (amt_pay_raw * 1))).toFixed(2);
        // if (amt_for_check > 0 && amt_for_check < 1) {
        //     var text_to_display = 'Payable Amount : ' + total_payable_amount + '\nDistributed Amount : ' + amt_pay_raw + '\n Balance : ' + amt_for_check;
        //     swal('Please Check Amount', text_to_display + '\nFraction Amount less than 1 Not permitted', 'error');
        //     return false;
        // }

        var float = /^\s*(\+)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
        if (!(float.test(amt_pay_raw))) {
            swal('', 'Enter a valid amount to process', 'error');
            return false;
        }
        var amt_pay = parseFloat(amt_pay_raw).toFixed(2);
        if (!($('#amt_distribute').val() >= 1)) {
            swal('', 'Enter amount >= 1', 'info');
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

    //CLICK TO PAYMENT TABs
    $('body').on('click', '.click_to_pay', function() {
        $('#collapseTwo').removeClass('open');

        if ($(this).attr('clicked') == 'forcard') {
            if ($('#collapseTwo').hasClass('in')) {
                $('#collapseTwo').removeClass('open');
            } else {
                $('#collapseTwo').addClass('open');
            }

        }
        if (!($('#amt_distribute').val() > 0)) {
            return false;
        } else {
            distribute_amount('paytab');
        }

    });

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

    //pay_amount_data(2)
    function cheque_validation(paytype) {
        //Basic cheque validation starts
        $('#pay_loader').addClass('sk-loading');
        var regx = /^[A-Za-z0-9 _.-]+$/;
        if (!(regx.test($('#ChequeNumber').val()) && $('#ChequeNumber').val().length <= 10 && $('#ChequeNumber').val().length > 4)) {
            $('#ChequeNumber').focus();
            swal('', 'Enter valid cheque number for payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var ChequeNumber = $('#ChequeNumber').val();

        if (moment($('#ChequeDate').val(), 'DD-MM-YYYY').isValid() == false) {
            swal('', 'Cheque date is required for cheque payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var ChequeDate = moment($('#ChequeDate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');

        var regx_alpha = /^[A-Za-z _.-]+$/;
        if (!(regx_alpha.test($('#NameofDrawer').val()) && $('#NameofDrawer').val().length <= 100 && $('#NameofDrawer').val().length > 4)) {
            $('#NameofDrawer').focus();
            swal('', 'Enter valid account holder name for payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var NameofDrawer = $('#NameofDrawer').val();

        if (!(regx_alpha.test($('#DrawerAddress').val()) && $('#DrawerAddress').val().length <= 100 && $('#DrawerAddress').val().length > 4)) {
            $('#DrawerAddress').focus();
            swal('', 'Enter valid account holder address for payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var DrawerAddress = $('#DrawerAddress').val();

        if ($('#NameofBank').val() == -1) {
            swal('', 'Enter valid account holder bank name for payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var NameofBank = $('#NameofBank').val();

        if (!(regx_alpha.test($('#BranchBank').val()) && $('#BranchBank').val().length <= 100 && $('#BranchBank').val().length > 4)) {
            $('#BranchBank').focus();
            swal('', 'Enter valid account holder bank branch name for payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var BranchBank = $('#BranchBank').val();
        //Basic Validation Ends
        pay_amount_data(paytype);
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
        }
        if ($('#reference_number').val().length > 17) {
            $('#reference_number').focus();
            swal('', 'Enter Valid Reference Number.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var reference_number = $('#reference_number').val();

        if (moment($('.refdate').val(), 'DD-MM-YYYY').isValid() == false) {
            swal('', 'Payment Date required for DBT payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var referenceDate = moment($('.refdate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
        //Basic Validation Ends
        pay_amount_data(paytype);
    }

    function re_calculate_payments(studentid, studentname) {
        //Basic DBT validation starts
        $('#pay_loader').addClass('sk-loading');
        var amount_distributed = $('#amt_distribute').val();

        var regx = /^[A-Za-z0-9 _.-]+$/;
        if (!(regx.test($('#reference_number').val()) && $('#reference_number').val().length <= 10 && $('#reference_number').val().length > 4)) {
            $('#reference_number').focus();
            swal('', 'Enter Reference Number.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var reference_number = $('#reference_number').val();

        if (moment($('.refdate').val(), 'DD-MM-YYYY').isValid() == false) {
            swal('', 'Payment Date required for DBT payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var referenceDate = moment($('.refdate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
        //Basic Validation Ends
        var searchby = $('#searchby').val();
        var search_elements = $('#search_elements').val();
        var ops_url = baseurl + 'fees/show-fee-collection';
        var transaction_ID = $('#transaction_ID').val();
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
                "search_elements": search_elements,
                "pay_type": "dbt",
                "reference_date": referenceDate,
                "reference_number": reference_number,
                "amount_distributed": amount_distributed,
                "transaction_ID": transaction_ID
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
                        $('#pay_loader').removeClass('sk-loading');
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function card_validation(paytype) {
        $('#pay_loader').addClass('sk-loading');
        var NameOfCard = $('#NameOfCard').val();
        //      var CardNumber = $("#CardNumber").val();
        var CardNumber = $("#CardNumber").val().substring(15, 19);
        var alphanumeric = /^[a-zA-Z\s]+$/;
        if (CardNumber.length == 0) {
            $('#CardNumber').focus();
            swal('', 'Enter Card Number !', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (!(Math.floor(CardNumber) == CardNumber && $.isNumeric(CardNumber))) {
            $('#CardNumber').focus();
            swal('', ' Enter valid Card Number !', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (CardNumber.length != 4) {
            $('#CardNumber').focus();
            swal('', ' Enter valid last 4 digit Card Number !', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        CardNumber = $("#CardNumber").val();

        if (NameOfCard.length == 0) {
            $('#NameOfCard').focus();
            swal('', 'Enter Name as on Card !', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (!alphanumeric.test(NameOfCard)) {
            $('#NameOfCard').focus();
            swal('', 'Name as on Card consist only alphabets !', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        //Basic Validation Ends
        pay_amount_data(paytype);
    }

    function pay_amount_data(paytype) {
        var distr_ops = $('#amt_distribute_ops').val();
        if (distr_ops == '0') {
            swal('', 'Please click distribute to process payment.', 'info');
            return false;
        }
        if (distribute_amount() == true) {
            if (parseFloat($('#excess_amount').val()) > 0) {
                if (paytype == 4) {
                    swal({
                        title: 'Excess Amount',
                        //text: 'Should the Excess Amount to be transfered to \nDocme Wallet ?',
                        text: 'Only the payable amount will deduct from \nDocMe wallet upon selecting Yes?',
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
                            if (paytype == 4) {
                                wallet_payment();
                            }
                        } else {
                            swal('', 'There is an Excess Amount. Please check the amount entered to pay fee and try again', 'warning');
                            $('#pay_loader').removeClass('sk-loading');
                            return false;
                        }
                    });
                } else {
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
                            if (paytype == 1) {
                                cash_pay(1);
                            } else if (paytype == 2) {
                                cheque_pay(1);
                            } else if (paytype == 3) {
                                var service_charge = $('#card_service_charge').val();
                                var surcharge_for_excess_amount = $('#surcharge_for_excess_amount').val();
                                card_pay(service_charge, surcharge_for_excess_amount, 1);
                            } else if (paytype == 4) {
                                wallet_payment();
                            } else if (paytype == 5) {
                                dbt_pay(1);
                            }
                        } else {
                            swal('', 'There is an Excess Amount. Please check the amount entered to pay fee and try again', 'warning');
                            $('#pay_loader').removeClass('sk-loading');
                            return false;
                        }
                    });
                }

            } else {
                if (paytype == 1) {
                    cash_pay(2);
                } else if (paytype == 2) {
                    cheque_pay(2);
                } else if (paytype == 3) {
                    var service_charge = $('#card_service_charge').val();
                    var surcharge_for_excess_amount = $('#surcharge_for_excess_amount').val();
                    card_pay(service_charge, surcharge_for_excess_amount, 2);
                } else if (paytype == 4) {
                    wallet_payment();
                } else if (paytype == 5) {
                    dbt_pay(2);
                }
            }

        } else {
            swal('', 'Please check the amount and try again', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
    }

    //PAY BY CASH
    function cash_pay(is_excess) {
        // $('#pay_loader').addClass('sk-loading');
        distribute_amount(); //Its called again for prevenyting change values from userside via browser developer option
        //var amt_pay_raw = $('#amt_distribute').val();
        var amt_pay_raw = $('#totamt').val();
        //alert(amt_pay_raw);

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
        var nonrealized = 0;
        var is_paid_full = 0;
        var is_paid_partial = 1;
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
            row_penalty = parseFloat($(idname).data('penalty'));
            //alert(amt_pay);

            if (pending_payment_without_tax > 0) {
                if ((((amt_pay * 1) - (value * 1)).toFixed(2)) >= 0) {
                    //$(idname).html(value);
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
                        //$(idname).html(amt_pay);
                        var fee_vat_percent = parseFloat($(idname).data('transactionvatpercent'));
                        var fee_paid = ((100 * (amt_pay - row_penalty)) / (100 + fee_vat_percent));
                        var vat_paid = (fee_paid * fee_vat_percent / 100);
                        var voucher_amt = (fee_paid * 1) + (vat_paid * 1) + (row_penalty * 1);
                        // alert(voucher_amt);
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
                            paid_amt_without_tax: (voucher_amt <= row_penalty ? 0 : parseFloat((fee_paid * 1)).toFixed(2)), //parseFloat(fee_paid * 1).toFixed(2), // - (($(idname).data('penalty')) * 1),  - (row_penalty * 1)
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
                // total_penalty = (total_penalty * 1) + (($(idname).data('penalty')) * 1);
            } else {
                j = j + 1;
            }


        }
        var excess_amt = $('#excess_amount').val();

        if (pay_data.length == 0) {
            swal('', 'Atleast one fees has to be paid or if this is a wallet only transaction use Docme Wallet Transaction to add money to wallet', 'info');
            return false;
        }

        if (total_vat_amount_paid == 0) {
            total_vat_amount_paid = -1;
        }
        // console.log(JSON.stringify(pay_data));
        // return false;

        // alert(total_vat_amount_paid);
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/pay-fee-by-cash';
        var roundoffamt = $('#roundoffamt').val();
        var transaction_ID = $('#transaction_ID').val();
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //amt_pay_raw
            data: {
                "studentid": student_id,
                "pay_data": JSON.stringify(pay_data),
                "amount_paid": amt_pay_raw,
                "round_off": $('#roundoffamt').val(),
                "total_penalty": total_penalty,
                "total_voucher_amount": total_voucher_amount,
                "total_vat_amount_paid": total_vat_amount_paid,
                "is_excess": is_excess,
                "excess_amt": excess_amt,
                "transaction_ID": transaction_ID
            },
            success: function(result) {

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
                    var wallet_voucher_id = data.wallet_voucher_id;
                    var totamt_disply_in_voucher = (amt_pay_raw * 1) + (roundoffamt * 1) + (excess_amt * 1);
                    swal('', 'Payment of ' + totamt_disply_in_voucher + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ". And Excess amount is credited to Docme Wallet with voucher number : " + wallet_voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'fee'); //PRINT VOUCHER
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

    }

    //PAY BY CHEQUE
    function cheque_pay(is_excess) {
        $('#pay_loader').addClass('sk-loading');

        var ChequeNumber = $('#ChequeNumber').val();
        var ChequeDate = moment($('#ChequeDate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
        var NameofDrawer = $('#NameofDrawer').val();
        var DrawerAddress = $('#DrawerAddress').val();
        var NameofBank = $('#NameofBank').val();
        var BranchBank = $('#BranchBank').val();

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
                            paid_amt_without_tax: (voucher_amt <= row_penalty ? 0 : parseFloat((fee_paid * 1)).toFixed(2)), //parseFloat(fee_paid * 1).toFixed(2), // - (($(idname).data('penalty')) * 1),  - (row_penalty * 1)
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
        var ops_url = baseurl + 'fees/pay-fee-by-cheque';
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
                "ChequeNumber": ChequeNumber,
                "ChequeDate": ChequeDate,
                "NameofDrawer": NameofDrawer,
                "DrawerAddress": DrawerAddress,
                "NameofBank": NameofBank,
                "BranchBank": BranchBank,
                "transaction_ID": transaction_ID
            },
            success: function(result) {
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
                        $('#pay_loader').removeClass('sk-loading');
                        reload_collection_detail(student_id, student_name)
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

    //PAY BY CARD
    function card_pay(service_charge, surcharge_for_excess_amount, is_excess) {

        $('#pay_loader').addClass('sk-loading');
        var NameOfCard = $('#NameOfCard').val();
        var CardNumber = $("#CardNumber").val();//.substring(15, 19);

        distribute_amount(); //Its called again for prevenyting change values from userside via browser developer option
        //var amt_pay_raw = $('#amt_distribute').val(); //$('#pay_amount2').val(card_pay);
        //var amt_pay_raw = $('#totamt').val();
        var amt_pay_raw = $('#totamt').val();
        //var amt_pay_raw = $('#pay_amount2').val();  // Including Card Service Charge
        var amt_pay = parseFloat(amt_pay_raw);
        //alert(amt_pay); 
        //exit;
        var j = 0;
        var limit = $('#iter_count').val();
        var idname = '';
        var value = 0;
        var table = $('#tbl_fee_allocation_data'); //.DataTable();
        var pay_data = [];
        var total_voucher_amount = 0
        var total_vat_amount_paid = 0
        var pending_payment_without_tax = 0
        var desc = "";
        var nonrealized = 0;
        var is_paid_full = 0;
        var is_paid_partial = 1;
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
                            paid_amt_without_tax: (voucher_amt <= row_penalty ? 0 : parseFloat((fee_paid * 1)).toFixed(2)), //parseFloat(fee_paid * 1).toFixed(2), // - (($(idname).data('penalty')) * 1),  - (row_penalty * 1)
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
                // total_penalty = (total_penalty * 1) + (($(idname).data('penalty')) * 1);
            } else {
                j = j + 1;
            }
        }

        if (pay_data.length == 0) {
            swal('', 'Atleast one fees has to be paid or if this is a wallet only transaction use Docme Wallet Transaction to add money to wallet', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var excess_amt = $('#excess_amount_by_card').val();

        if (total_vat_amount_paid == 0) {
            total_vat_amount_paid = -1;
        }

        // console.log(JSON.stringify(pay_data));
        // return false;

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/pay-fee-by-card';
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
                "round_off": roundoffamt,
                "total_penalty": total_penalty,
                "total_voucher_amount": total_voucher_amount,
                "total_vat_amount_paid": total_vat_amount_paid,
                "is_excess": is_excess,
                "excess_amt": excess_amt,
                "service_charge": service_charge,
                "surcharge_for_excess_amount": surcharge_for_excess_amount,
                "name_on_card": NameOfCard,
                "card_number": CardNumber,
                "transaction_ID": transaction_ID
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {

                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    var totamt_disply_in_voucher = (amt_pay_raw * 1) + (roundoffamt * 1) + (excess_amt * 1) + (service_charge * 1); //+ (total_penalty * 1); + (surcharge_for_excess_amount * 1)
                    swal('', 'Payment of ' + totamt_disply_in_voucher + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'fee'); //PRINT VOUCHER
                    reload_collection_detail(student_id, student_name);

                } else if (data.status == 11) {
                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    var wallet_voucher = data.wallet_voucher;
                    var totamt_disply_in_voucher = (amt_pay_raw * 1) + (roundoffamt * 1) + (excess_amt * 1) + (service_charge * 1); // + (total_penalty * 1); //+ (surcharge_for_excess_amount * 1)
                    swal('', 'Payment of ' + totamt_disply_in_voucher + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ". And Excess amount is credited to Docme Wallet with voucher number : " + wallet_voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'fee'); //PRINT VOUCHER
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
                $('#pay_loader').removeClass('sk-loading');
            }
        });
    }

    //WALLET PAYMENT
    function wallet_payment() {
        distribute_amount(); //Its called again for prevenyting change values from userside via browser developer option
        //$('#pay_loader').addClass('sk-loading');
        //var amt_pay_raw = $('#amt_distribute').val();
        var amt_pay_raw = $('#totamt').val();
        var amt_pay = parseFloat(amt_pay_raw);
        var amt_pay_intial = amt_pay;
        if (amt_pay == 0 || amt_pay < 0) {
            $('#pay_loader').removeClass('sk-loading');
            swal('', 'Please check the payable amount to proceed.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }

        var wallet_available_amount_raw = $('#wallet_pending_amount').val();
        var wallet_available_amount = parseFloat(wallet_available_amount_raw);
        if (wallet_available_amount == 0) { //|| amt_pay > wallet_available_amount
            swal('', 'There is no sufficient balance on wallet.Select any other payment option.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (amt_pay <= wallet_available_amount) {
            amt_pay_raw = amt_pay; //wallet_available_amount - 
            amt_pay = parseFloat(amt_pay_raw);
            pay_by_wallet(amt_pay_raw);
        }

        if (amt_pay > wallet_available_amount) {
            amt_pay_raw = wallet_available_amount;
            amt_pay = parseFloat(amt_pay_raw);
            //amt_pay_intial = amt_pay;
            //swal('', 'Wallet amount is less than Distributed amount. So fee will paid with Wallet Balance', 'info');
            //return true;

            swal({
                title: 'Wallet Amount',
                text: 'Wallet amount is less than Distributed amount. So fee will paid with Wallet Balance.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#23c6c8',
                cancelButtonColor: '#000',
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    pay_by_wallet(amt_pay_raw);
                } else {
                    $('#pay_loader').removeClass('sk-loading');
                    swal('', 'There is no sufficient balance on wallet.Select any other payment option.', 'info');
                    $('#pay_loader').removeClass('sk-loading');
                    return false;
                }
            });
        }

    }

    //PAY BY WALLET
    function pay_by_wallet(amt_pay_raw) {
        amt_pay = parseFloat(amt_pay_raw);
        //SALAH CHANGED
        var j = 0;
        var limit = $('#iter_count').val();
        var idname = '';
        var value = 0;
        var table = $('#tbl_fee_allocation_data'); //.DataTable();
        var pay_data = [];
        var total_voucher_amount = 0
        var total_vat_amount_paid = 0
        var pending_payment_without_tax = 0
        var desc = "";
        var nonrealized = 0;
        var is_paid_full = 0;
        var is_paid_partial = 1;
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
                            paid_amt_without_tax: (voucher_amt <= row_penalty ? 0 : parseFloat((fee_paid * 1)).toFixed(2)), //parseFloat(fee_paid * 1).toFixed(2), // - (($(idname).data('penalty')) * 1),  - (row_penalty * 1)
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
                // total_penalty = (total_penalty * 1) + (($(idname).data('penalty')) * 1);
            } else {
                j = j + 1;
            }
        }

        //        if (amt_pay_intial > total_voucher_amount) {
        //            swal('', 'Total pay amount cannot be greater than total pending amount while pay using wallet pay mode. Kindly revise payment and try again', 'info');
        //            return false;
        //        }

        if (total_vat_amount_paid == 0) {
            total_vat_amount_paid = -1;
        }

        if (pay_data.length == 0) {
            swal('', 'Select atleast one fee for payment. Otherwise use Wallet pay screen for adding amount to wallet.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/pay-fee-by-wallet ';
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
                "transaction_ID": transaction_ID
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    var totamt_disply_in_voucher = (amt_pay_raw * 1) + (roundoffamt * 1);
                    swal('', 'Payment of ' + amt_pay_raw + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'fee'); //PRINT VOUCHER
                    reload_collection_detail(student_id, student_name);
                } else if (data.status == 11) {
                    var voucher = data.voucher_no;
                    var wallet_voucher = data.wallet_voucher;
                    swal('', 'Payment of ' + amt_pay_raw + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ". And Excess amount is credited to Docme Wallet with voucher number : " + wallet_voucher + ".", 'success');
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
        //SALAH CHANGED
    }

    //RELOAD COLLECTION PAGE
    function reload_collection_detail(studentid, studentname) {
        var searchby = $('#searchby').val();
        var search_elements = $('#search_elements').val();
        var ops_url = baseurl + 'fees/show-fee-collection';
        var transaction_ID = $('#transaction_ID').val();
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
                "search_elements": search_elements,
                "transaction_ID": transaction_ID
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
                        $('#pay_loader').removeClass('sk-loading');
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        $('#pay_loader').removeClass('sk-loading');
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
            swal('', 'Enter atleast three numbers.', 'info');
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