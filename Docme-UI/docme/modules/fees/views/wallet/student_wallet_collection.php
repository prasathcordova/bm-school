<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools">
                        <a style="color: #fff;" href="javascript:void(0);" title="Withdraw amount from Docme wallet of student, <?php echo $student_data['student_name'] ?> " onclick="withdrawal_details('<?php echo $student_data['student_id']; ?>', '<?php echo $student_data['student_name'] ?>')" class="btn btn-md btn-warning text-white"><i class="fa fa-money"></i> Withdrawal</a>
                        <a style="color: #fff;" href="javascript:void(0);" title="Docme Wallet Statement of <?php echo $student_data['student_name'] ?> " onclick="deposit_details('<?php echo $student_data['student_id']; ?>', '<?php echo $student_data['student_name'] ?>','statement')" class="btn btn-md btn-danger"><i class="fa fa-file-text"></i> Statement</a>
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
                            <div class="col-md-6 col-xs-12 col-sm-12">
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
                            <div class="col-md-6  col-xs-12 col-sm-12" style="padding-top:5px; float: right;">
                                <div class="widget lazur-bg no-padding" style="margin-top:0px;">
                                    <div class="p-m" style="padding:3px !important; display: inline-block">
                                        <h1 class="m-xs" style="text-align:center"><span class="fa fa-inr" aria-hidden="true" style="color:#FFF "></span> <?php echo isset($e_wallet) && !empty($e_wallet) ? my_money_format($e_wallet) : 0; ?></h1>

                                        <h3 class="font-bold no-margins" style="text-align:center;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                            Docme Wallet
                                            <input type="hidden" name="total_e_wallet_amount" id="total_e_wallet_amount" value="<?php echo $e_wallet; ?>" />
                                            <input type="hidden" name="total_min_wallet_amount" id="total_min_wallet_amount" value="<?php echo $min_wallet; ?>" />
                                        </h3>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="ibox-content" style=" padding-right: 1%;" id="fees_summary">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                            <div class="input-group m-b" style="margin-bottom: 0px;">
                                                <input type="text" placeholder="Enter amount wish to pay" class="form-control digits" maxlength="8" name="amt_distribute" id="amt_distribute" style="height: 39px !important; text-align:right;" value="<?php echo round($min_wallet, 2); ?>">
                                                <span class="input-group-addon">
                                                    <?php print_currency('hotpink'); ?>
                                                </span>
                                                <span class="input-group-btn"> <button style="background:hotpink !important;border-color: hotpink !important;height: 39px !important;padding-bottom: 0px;margin-bottom: 0px;border-bottom-width: 0px;border-top-width: 0px;" type="button" onclick="distribute_amount();" class="btn btn-primary">Pay
                                                    </button> </span>
                                            </div>
                                        </div>


                                        <div class="clearfix"></div>

                                        <div class="col-lg-12" id="pay_panel" style="padding-top: 10px;">
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
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Cash Payment</a>
                                                                </h5>
                                                            </div>
                                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label>Amount Total</label>
                                                                            <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                <input type="text" style="background-color: #FFFFFF; text-align:right; height:39px !important;" class="form-control" disabled="" name="pay_amount" id="pay_amount" value="Rs 0.00">
                                                                                <span class="input-group-addon">
                                                                                    <?php print_currency('hotpink'); ?>
                                                                                </span>
                                                                            </div>
                                                                            <hr>
                                                                            <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="pay_amount_data(1);">
                                                                                <i class="fa fa-money">
                                                                                    Make Payment
                                                                                </i>
                                                                            </a>
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
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Cheque Payment</a>
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
                                                                                    <input type="text" class="form-control" maxlength="100" name="DrawerAddress" id="DrawerAddress" placeholder="Account Holder Address">
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
                                                                                                    echo '<option value="' . $bank['id'] . '">' . $bank['bank_name'] . ' ( ' . $bank['bank_abbr'] . ' )' . '</option>';
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
                                                                                    <input type="text" class="form-control alpha" name="BranchBank" maxlength="25" id="BranchBank" placeholder="Bank Branch">
                                                                                </div>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <label>Amount Total</label>
                                                                                <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                                    <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" disabled="" name="pay_amount1" id="pay_amount1" value="Rs 0.00">
                                                                                    <span class="input-group-addon">
                                                                                        <?php print_currency('hotpink'); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                            <div class="col-md-12">
                                                                                <hr>
                                                                                <a class="btn btn-info" id="cheque_pay_btn" href="javascript:void(0)" onclick="pay_amount_data(2);">
                                                                                    <i class="fa fa-money">
                                                                                        Make Payment
                                                                                    </i>
                                                                                </a>
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
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Card Payment</a>
                                                                </h5>
                                                            </div>
                                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <form role="form" id="payment-form">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Card Number</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" id="CardNumber" name="CardNumber" class="form-control" data-mask="XXXX-XXXX-XXXX-9999" placeholder="Enter Card Number">

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Name as on Card</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control alpha" maxlength="20" name="NameOfCard" id="NameOfCard" placeholder="Enter name as on card">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label>Service Charge <?php echo $card_service_charge; ?>%</label>
                                                                                    <small><small><span class="text-gray pull-right">Decimal figures will be rounded off</span></small></small>
                                                                                    <div class="input-group m-b">
                                                                                        <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" name="card_service_charge" disabled="" id="card_service_charge" placeholder="Card service charge" />
                                                                                        <span class="input-group-addon">
                                                                                            <?php print_currency('hotpink'); ?>
                                                                                        </span>
                                                                                        <input type="hidden" name="card_service_charge_percent" disabled="" id="card_service_charge_percent" value="<?php echo $card_service_charge; ?>" />

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label>Amount credited to Wallet</label>
                                                                                    <div class="input-group m-b">
                                                                                        <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" name="amt_credited_to_wallet" disabled="" id="amt_credited_to_wallet" placeholder="Amount credited to wallet" value="" />
                                                                                        <span class="input-group-addon">
                                                                                            <?php print_currency('hotpink'); ?>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <label>Amount Total</label>
                                                                                    <div class="input-group m-b">
                                                                                        <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" disabled="" name="pay_amount2" id="pay_amount2" value="Rs 0.00">
                                                                                        <span class="input-group-addon">
                                                                                            <?php print_currency('hotpink'); ?>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                                <div class="col-md-12">
                                                                                    <!--margin-left:30px;-->
                                                                                    <a class="btn btn-info" id="card_pay_btn" href="javascript:void(0);" onclick="pay_amount_data(3);">
                                                                                        <i class="fa fa-money">
                                                                                            Make Payment
                                                                                        </i>
                                                                                    </a>
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
                                                                        <div class="col-md-6 col-lg-6">
                                                                            <div class="form-group">
                                                                                <label>Reference Number</label>&nbsp;<span class="text-danger">*</span>
                                                                                <input type="text" class="form-control alphanumeric" maxlength="17" name="reference_number" id="reference_number" placeholder="Enter Reference Number" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-lg-6">
                                                                            <div class="form-group">
                                                                                <label>Payment Date</label>&nbsp;<span class="text-danger">*</span>
                                                                                <input type="text" class="form-control dbt_refdate" name="ReferenceDate" style="background-color:white;" id="ReferenceDate" placeholder="Enter Payment Date" value="">
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
                                                                                    <!-- <tr>
                                                                                        <td class="text-right">Excess amount after distribution&nbsp;</td>
                                                                                        <td class="text-right"><?php print_currency('white', '12'); ?> <span id="amt_after_distribute" class="amt_after_distribute"><?php echo my_money_format(0) ?></span>&nbsp;</td>
                                                                                    </tr> -->
                                                                                    <tr>
                                                                                        <td class="text-right" colspan="2">
                                                                                            <a class="btn btn-info" id="dbt_pay_btn" style="margin-left:0px;" href="javascript:void(0)" onclick="pay_amount_data(5);">
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
                                                        <hr>
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
<input type="hidden" name="minimum_wallet_amt" id="minimum_wallet_amt" value="<?php echo (($min_wallet > 1) ? $min_wallet : 1); ?>" />
<div id="student-print-container"></div>
<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('#NameofBank').select2({
        'theme': 'bootstrap'
    });
    $('#ChequeDate').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-80d',
        autoclose: true
    });

$('.dbt_refdate').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-80d',
    autoclose: true,
    endDate: '<?php echo date('d/m/Y'); ?>'
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
    });

    $('#amt_distribute').change(function() {
        $('#amt_distribute_ops').val('0');
    });


    function distribute_amount() {
        var total_min_wallet_amount = $('#total_min_wallet_amount').val();
        var amt_pay_raw = $('#amt_distribute').val();
        var amt_pay = parseFloat(amt_pay_raw).toFixed(2);
        // if(amt_pay < parseFloat(total_min_wallet_amount).toFixed(2)){
        //     swal('', 'Minimum amount to pay : '+parseFloat(total_min_wallet_amount).toFixed(2), 'info');
        //     return false;
        // }
        // else{
        if (!(parseFloat($('#amt_distribute').val()) > 0)) {
            swal('', 'Enter a valid amount to process', 'info');
            return false;
        }
        var serpercent = parseFloat($('#card_service_charge_percent').val());
        var sercharge = ((serpercent * parseFloat($('#amt_distribute').val())) / 100);
        var roundsercharge = getRoundOffAmount(sercharge);
        sercharge = roundsercharge['roundedamount'];
        if (serpercent == 0) {
            sercharge = 0;
        } else {
            if (sercharge == 0) {
                sercharge = 1;
            }
        }
        // alert(sercharge);
        var card_pay = parseFloat(parseFloat($('#amt_distribute').val())).toFixed(2); // + sercharge
        $('#card_service_charge').val(sercharge);
        $('#pay_amount').val('Rs. ' + amt_pay_raw);
        $('#pay_amount1').val('Rs. ' + amt_pay_raw);
        $('#pay_amount2').val('Rs. ' + ((amt_pay_raw * 1) + (sercharge * 1)));
        $('#pay_amount4').val('Rs. ' + amt_pay_raw);
        $('#amt_credited_to_wallet').val(card_pay);
        $('#amt_distribute_ops').val('1');
        return true;
        // }
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

    function pay_amount_data(paytype) {

        var distr_ops = $('#amt_distribute_ops').val();
        if (distr_ops == '0') {
            $('#amt_distribute').focus();
            swal('', 'Please click Pay to process payment.', 'info');
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
                            cheque_pay();
                        } else if (paytype == 3) {
                            var service_charge = $('#card_service_charge').val();
                            card_pay(service_charge);
                        } else if (paytype == 5) {
                            dbt_pay();
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
                    cheque_pay();
                } else if (paytype == 3) {
                    var service_charge = $('#card_service_charge').val();
                    card_pay(service_charge);
                }else if (paytype == 5) {
                    dbt_pay();
                }
            }

        } else {
            swal('', 'Please check the amount and try again', 'info');
            return false;
        }
    }

    function cash_pay(is_excess) {
        var amt_pay_raw = $('#amt_distribute').val();
        var minimum_wallet_amt = $('#minimum_wallet_amt').val();
        if (parseFloat(amt_pay_raw) < parseFloat(minimum_wallet_amt)) {
            swal('', 'Enter the minimum amount need to deposit to Docme Wallet. Note the minimum amount for a deposit is ' + parseFloat(minimum_wallet_amt).toFixed(2), 'info');
            return false;
        }

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/pay-wallet-by-cash';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "studentid": student_id,
                "is_excess": "1",
                "excess_amt": amt_pay_raw
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var wallet_voucher = data.wallet_voucher;
                    var wallet_voucher_id = data.wallet_voucher_id;
                    swal('', 'Payment of Rs.' + amt_pay_raw + " for the student " + student_name + " is completed successfully and credited to Docme Wallet with voucher number : " + wallet_voucher + ".", 'success');
                    print_voucher(wallet_voucher_id, wallet_voucher); //PRINT VOUCHER
                    reload_collection_detail(student_id, student_name);
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        reload_collection_detail(student_id, student_name)
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        return false;
                    }
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

    function cheque_pay() {
        var regx = /^[A-Za-z0-9 _.-]+$/;
        if (!(regx.test($('#ChequeNumber').val()))) { //&& $('#ChequeNumber').val().length <= 10 && $('#ChequeNumber').val().length > 4
            swal('', 'Enter valid cheque number for payment', 'info');
            return false;
        }
        if (($('#ChequeNumber').val().length == 0)) {
            swal('', 'Cheque Number Required', 'info');
            return false;
        }
        var ChequeNumber = $('#ChequeNumber').val();

        if (moment($('#ChequeDate').val(), 'DD-MM-YYYY').isValid() == false) {
            swal('', 'Cheque date is required for cheque payment', 'info');
            return false
        }
        var ChequeDate = moment($('#ChequeDate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');

        var regx_alpha = /^[A-Za-z _.-]+$/;
        if (!(regx_alpha.test($('#NameofDrawer').val()))) {
            swal('', 'Enter valid account holder name for payment', 'info');
            return false;
        }
        if (($('#NameofDrawer').val().length == 0)) {
            swal('', 'Name of Drawer Required', 'info');
            return false;
        }
        var NameofDrawer = $('#NameofDrawer').val();

        if (!(regx_alpha.test($('#DrawerAddress').val()))) { //&& $('#DrawerAddress').val().length <= 100 && $('#DrawerAddress').val().length > 4
            swal('', 'Enter valid account holder address for payment', 'info');
            return false;
        }
        if (($('#DrawerAddress').val().length == 0)) {
            swal('', 'Drawer Address Required', 'info');
            return false;
        }
        var DrawerAddress = $('#DrawerAddress').val();

        if ($('#NameofBank').val() == -1) {
            swal('', 'Enter valid account holder bank name for payment', 'info');
            return false;
        }
        var NameofBank = $('#NameofBank').val();

        if (!(regx_alpha.test($('#BranchBank').val()))) { // && $('#BranchBank').val().length <= 100 && $('#BranchBank').val().length > 4
            swal('', 'Enter valid account holder bank branch name for payment', 'info');
            return false;
        }
        if (($('#BranchBank').val().length == 0)) {
            swal('', 'Bank Branch Required', 'info');
            return false;
        }
        var BranchBank = $('#BranchBank').val();



        var amt_pay_raw = $('#amt_distribute').val();
        var minimum_wallet_amt = $('#minimum_wallet_amt').val();
        if (parseFloat(amt_pay_raw) < parseFloat(minimum_wallet_amt)) {
            swal('', 'Enter the minimum amount need to deposit to Docme Wallet. Note the minimum amount for a deposit is ' + parseFloat(minimum_wallet_amt).toFixed(2), 'info');
            return false;
        }

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/pay-wallet-by-cheque';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "studentid": student_id,
                "is_excess": "1",
                "excess_amt": amt_pay_raw,
                "ch_number": ChequeNumber,
                "ch_date": ChequeDate,
                "ch_account_holder_name": NameofDrawer,
                "ch_address": DrawerAddress,
                "ch_bank_id": NameofBank,
                "branch_name": BranchBank
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var wallet_voucher = data.wallet_voucher;
                    var wallet_voucher_id = data.wallet_voucher_id;
                    swal('', 'Payment of Rs.' + amt_pay_raw + " for the student " + student_name + " is completed successfully and credited to Docme Wallet with voucher number : " + wallet_voucher + ".", 'success');
                    print_voucher(wallet_voucher_id, wallet_voucher); //PRINT VOUCHER
                    reload_collection_detail(student_id, student_name);
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        reload_collection_detail(student_id, student_name)
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        return false;
                    }
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

    function card_pay(service_charge) {

        var amt_pay_raw = $('#amt_distribute').val();
        var minimum_wallet_amt = $('#minimum_wallet_amt').val();
        if (parseFloat(amt_pay_raw) < parseFloat(minimum_wallet_amt)) {
            swal('', 'Enter the minimum amount need to deposit to Docme Wallet. Note the minimum amount for a deposit is ' + parseFloat(minimum_wallet_amt).toFixed(2), 'info');
            return false;
        }
        var card_number = $('#CardNumber').val();
        var name_on_card = $('#NameOfCard').val();
        var service_charge = parseFloat(service_charge).toFixed(2);
        var card_pay = parseFloat(parseFloat($('#amt_distribute').val())).toFixed(2); // - service_charge
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/pay-wallet-by-card';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "studentid": student_id,
                "is_excess": "1",
                "excess_amt": card_pay,
                "service_charge": service_charge,
                "card_number": card_number,
                "name_on_card": name_on_card
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var wallet_voucher = data.wallet_voucher;
                    var wallet_voucher_id = data.wallet_voucher_id;
                    var deposited_amount = parseFloat(amt_pay_raw) + parseFloat(service_charge);
                    swal('', 'Payment of Rs.' + deposited_amount + " for the student " + student_name + " is completed successfully and credited to Docme Wallet with voucher number : " + wallet_voucher + ".", 'success');
                    print_voucher(wallet_voucher_id, wallet_voucher); //PRINT VOUCHER
                    reload_collection_detail(student_id, student_name);
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        reload_collection_detail(student_id, student_name)
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        return false;
                    }
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
    function dbt_pay() {

        var amt_pay_raw = $('#amt_distribute').val();
        var minimum_wallet_amt = $('#minimum_wallet_amt').val();
        if (parseFloat(amt_pay_raw) < parseFloat(minimum_wallet_amt)) {
            swal('', 'Enter the minimum amount need to deposit to Docme Wallet. Note the minimum amount for a deposit is ' + parseFloat(minimum_wallet_amt).toFixed(2), 'info');
            return false;
        }
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

        if (moment($('.dbt_refdate').val(), 'DD-MM-YYYY').isValid() == false) {
            swal('', 'Payment Date required for DBT payment', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var referenceDate = moment($('.dbt_refdate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
        var dbt_pay = parseFloat(parseFloat($('#amt_distribute').val())).toFixed(2); // - service_charge
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/pay-wallet-by-dbt';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "studentid": student_id,
                "is_excess": "1",
                "excess_amt": dbt_pay,
                "reference_number": reference_number,
                "referenceDate": referenceDate
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var wallet_voucher = data.wallet_voucher;
                    var wallet_voucher_id = data.wallet_voucher_id;
                    var deposited_amount = parseFloat(amt_pay_raw);
                    swal('', 'Payment of Rs.' + deposited_amount + " for the student " + student_name + " is completed successfully and credited to Docme Wallet with voucher number : " + wallet_voucher + ".", 'success');
                    print_voucher(wallet_voucher_id, wallet_voucher); //PRINT VOUCHER
                    reload_collection_detail(student_id, student_name);
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        reload_collection_detail(student_id, student_name)
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        return false;
                    }
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



    function reload_collection_detail(studentid, studentname) {
        var ops_url = baseurl + 'fees/show-wallet-collection';
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

    function print_voucher(voucher_id, voucher_code) {
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
                "issue": "print"
            }, //, "ptype" : ptype
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
</script>