<div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
    <script type="text/javascript">
        $('document').ready(function() {
            distribute_amount();
        });
    </script>

    <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>">
    <?php
    $student_img = base_url('assets/img/a0.jpg');
    ?>
    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
    <span style="float:right;">
        <input type="hidden" name="excess_amount" id="excess_amount" value="0" />
    </span>
</div>
<div class="ibox-content" id="pay_loader">
    <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
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
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="hidden" name="temp_reg_id" id="temp_reg_id" value="<?php echo $temp_reg_id; ?>">
                    <label>Student Name</label><span class="mandatory"> *</span>
                    <div class="form-line <?php
                                            if (form_error('student_name')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" readonly class="form-control alpha max50" placeholder="Enter Student Name" name="student_name" id="student_name" value="<?php echo $temp_student_name; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Name of Parent</label><span class="mandatory"> *</span>
                    <div class="form-line <?php
                                            if (form_error('parent_name')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" readonly class="form-control alpha max50" placeholder="Enter Parent Name" name="parent_name" id="parent_name" value="<?php echo $temp_parent_name; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                <hr>
                <label>Amount</label>
                <div class="input-group m-b" style="margin-bottom: 0px;">
                    <input type="text" placeholder="Enter Amount to pay" class="form-control digits" name="amt_distribute" id="amt_distribute" maxlength="10" readonly value="<?php echo $temp_reg_fee; ?>" style="height: 39px !important;text-align:right;">
                    <span class="input-group-addon"><?php print_currency('hotpink'); ?> </span>
                </div>
            </div>
            <?php if (!empty($temp_payment_data)) {
                $transaction_ref = $temp_payment_data['data_ref'];
                $transaction_date = $temp_payment_data['data_date'];

            ?>
                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                    <hr>
                    <h5>CHALLAN/DBT DETAILS</h5>
                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                    <label>Transaction Reference</label>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <input type="text" placeholder="Payment Reference" class="form-control" readonly value="<?php echo $transaction_ref; ?>" style="height: 39px !important;">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                    <label>Transaction Amount</label>
                    <div class="input-group" style="margin-bottom: 0px;">
                        <input type="text" placeholder="Payment Reference" class="form-control" readonly value="<?php echo $temp_payment_data['data_amt']; ?>" style="height: 39px !important;text-align:right;">
                        <span class="input-group-addon"><?php print_currency('hotpink'); ?> </span>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                    &nbsp;
                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                    <label>Transaction Date</label>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <input type="text" placeholder="Payment Reference" class="form-control " readonly value="<?php echo $transaction_date; ?>" style="height: 39px !important;">

                    </div>
                </div>
                <?php if ($temp_payment_data['data_file'] != '') { ?>
                    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-12">
                        <label>Transaction Reference File</label>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <a class="btn btn-primary btn-xs" style="cursor: pointer;" target="_blank" href="<?php echo base_url('reports/online-registration/file_uploads/' . $temp_payment_data['data_file']) ?>"><i class="fa fa-file"></i> View</a>
                        </div>
                    </div>

                <?php } ?>
                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                    <hr>
                </div>
            <?php } else {
                $transaction_ref = '';
                $transaction_date = '';
            } ?>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="ibox-content no-padding" style=" padding-top: 1% !important;" id="fees_summary">
                    <div class="row clearfix">

                        <div class="clearfix"></div>

                        <div class="col-lg-12" id="pay_panel">
                            <div class="panel">
                                <div class="panel-body no-padding">
                                    <div class="panel-group payments-method" id="accordion" style="margin-bottom:0px;">
                                        <?php if (empty($temp_payment_data)) { ?>
                                        <div class=" panel panel-default">
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
                                                                <input type="text" style="background-color: #FFFFFF; text-align: right;" class="form-control" disabled="" name="pay_amount" id="pay_amount" value="0.00" style="height: 39px !important;">
                                                                <span class="input-group-addon">
                                                                    <?php print_currency('hotpink'); ?>
                                                                </span>
                                                            </div>
                                                            <hr>
                                                            <a class="btn btn-info btndisable" id="cash_pay_btn" href="javascript:void(0);" onclick="pay_amount_data(1);">
                                                                <i class="fa fa-money"></i> Make Payment
                                                            </a>
                                                        </div>
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
                                                                    <div class="form-group has-success">
                                                                        <label>Card Number</label>
                                                                        <input type="text" id="CardNumber" name="CardNumber" class="form-control" data-mask="XXXX-XXXX-XXXX-9999" placeholder="Enter Card Number">

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group has-success">
                                                                        <label>Name as on Card</label>
                                                                        <input type="text" class="form-control" name="NameOfCard" id="NameOfCard" placeholder="Enter name as on card">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Service Charge <?php echo $card_service_charge; ?>%</label>
                                                                    <small><small><span class="text-gray pull-right">Decimal figures will be rounded off</span></small></small>
                                                                    <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                        <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" disabled="" name="card_service_charge" id="card_service_charge" placeholder="Card service charge" style="height: 39px !important;">
                                                                        <span class="input-group-addon">
                                                                            <?php print_currency('hotpink'); ?>
                                                                        </span>
                                                                        <input type="hidden" name="card_service_charge_percent" disabled="" id="card_service_charge_percent" value="<?php echo $card_service_charge; ?>" />
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Amount Total</label>
                                                                    <div class="input-group m-b" style="margin-bottom: 0px;">
                                                                        <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" disabled="" name="pay_amount2" id="pay_amount2" value=" 0.00" style="height: 39px !important;">
                                                                        <span class="input-group-addon">
                                                                            <?php print_currency('hotpink'); ?>
                                                                        </span>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="col-md-12">
                                                                    <a class="btn btn-info" id="card_pay_btn" href="javascript:void(0);" onclick="pay_amount_data(3);">
                                                                        <i class="fa fa-money"></i> Make Payment
                                                                    </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="pull-right">
                                                    <i class="fa fa-university text-sucess"></i>
                                                </div>
                                                <h5 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="click_to_pay">Direct Bank Transfer</a>
                                                </h5>
                                            </div>
                                            <div id="collapse5" class="panel-collapse collapse <?php echo !empty($temp_payment_data) ? 'in' : '' ?> ">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Reference Number</label>&nbsp;<span class="text-danger">*</span>
                                                                <input type="text" class="form-control alphanumeric" maxlength="17" name="reference_number" id="reference_number" placeholder="Enter Reference Number" value="<?php echo $transaction_ref ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Payment Date</label>&nbsp;<span class="text-danger">*</span>
                                                                <input type="text" class="form-control dbt_refdate" readonly name="ReferenceDate" style="background-color:white;" id="ReferenceDate" placeholder="Enter Payment Date" value="<?php echo $transaction_date ?>">
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
                                                            <a class="btn btn-info" id="dbt_pay_btn" style="margin-left:0px;" href="javascript:void(0)" onclick="pay_amount_data(5);">
                                                                <i class="fa fa-money"></i> Make Payment
                                                            </a>&nbsp;
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
<div id="student-print-container"></div>

<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('#amt_distribute').change(function() {
        $('#amt_distribute_ops').val('0');
    });

$('.dbt_refdate').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-80d',
    autoclose: true,
    endDate: '<?php echo date('d/m/Y'); ?>'
});

    function distribute_amount() {
        //application_fee_validation();
        var amt_pay_raw = $('#amt_distribute').val();
        var float = /^\s*(\+)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
        if (!(float.test(amt_pay_raw))) {
            $('#amt_distribute').focus();
            //swal('', 'Enter a valid amount to process', 'info');
            swal('', 'Please check the amount to process', 'info');
            return false;
        }
        var amt_pay = parseFloat(amt_pay_raw).toFixed(2);
        if (!(parseFloat($('#amt_distribute').val()) > 0)) {
            $('#amt_distribute').focus();
            //swal('', 'Enter a valid amount to process', 'info');
            swal('', 'Please check the amount to process', 'info');
            return false;
        }
        var serpercent = parseFloat($('#card_service_charge_percent').val());
        var sercharge = ((serpercent * parseFloat(amt_pay)) / 100);
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
        var card_pay = parseFloat((amt_pay * 1) + parseFloat(sercharge * 1)).toFixed(2);
        $('#card_service_charge').val(sercharge);
        $('#pay_amount').val(amt_pay);
        $('#pay_amount2').val(card_pay);
        $('#pay_amount4').val(amt_pay);
        $('#amt_distribute_ops').val('1');
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

    function pay_amount_data(paytype) {
        var distr_ops = $('#amt_distribute_ops').val();
        if (distr_ops == '0') {
            //swal('', 'Please click distribute to process payment.', 'info');
            $('#amt_distribute').focus();
            swal('', 'Please Distribute the amount first.', 'info');
            return false;
        }
        if (distribute_amount() == true) {

            if (paytype == 1) {
                cash_pay();
            } else if (paytype == 3) {
                var service_charge = $('#card_service_charge').val();
                card_pay(service_charge);
            } else if (paytype == 5) {
                dbt_pay();
            }

        } else {
            swal('', 'Please check the amount and try again', 'info');
            return false;
        }
    }

    function cash_pay() {
        //$('#pay_loader').addClass('sk-loading');
        //distribute_amount();
        //var amt_pay_raw = $('#amt_distribute').val();
        var amt_pay_raw = $('#pay_amount').val();

        var amt_pay = parseFloat(amt_pay_raw);
        var j = 0;
        var limit = $('#iter_count').val();
        var idname = '';
        var value = 0;
        var table = $('#tbl_fee_allocation_data').DataTable();
        var pay_data = [];
        var total_voucher_amount = 0
        var total_vat_amount_paid = 0
        var total_wallet_amount = 0
        var nonrealized = 0;
        var is_paid_full = 0;
        var is_paid_partial = 1;
        var pending_payment_without_tax = 0
        var desc = "";

        var temp_reg_id = $('#temp_reg_id').val();
        var student_name = $('#student_name').val();
        var parent_name = $('#parent_name').val();
        var address = $('#address').val();
        var phone_number = $('#phone_number').val();
        var fee_id = $('#fee_id').val();
        var ops_url = baseurl + 'fees/pay_temp_registration_fee';
        var datatosave = [];
        datatosave = {
            "amount_paid": amt_pay_raw,
            "service_charge": 0,
            "temp_reg_id": temp_reg_id,
            "trantype": 'C',
            "card_number": '0',
            "card_name": 'nocard'
        };
        // alert(JSON.stringify(datatosave));
        // return false;
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //amt_pay_raw
            data: datatosave,
            success: function(result) {

                var data = JSON.parse(result);
                if (data.status == 1) {
                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    swal('', 'Payment of ' + amt_pay_raw + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'temp_regfee'); //PRINT VOUCHER
                    temp_registration_fee();
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        temp_registration_fee()
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
        $('#pay_loader').removeClass('sk-loading');

    }

    function card_pay(service_charge, is_excess) {

        //$('#pay_loader').addClass('sk-loading');
        var NameOfCard = $('#NameOfCard').val();
        //      var CardNumber = $("#CardNumber").val();
        var CardNumber = $("#CardNumber").val().substring(15, 19);
        var alphanumeric = /^[a-zA-Z\s]+$/;
        if (CardNumber.length == 0) {
            swal('', 'Enter Card Number !', 'info');
            return false;
        }
        if (!(Math.floor(CardNumber) == CardNumber && $.isNumeric(CardNumber))) {
            swal('', ' Enter valid Card Number !', 'info');
            return false;
        }
        if (CardNumber.length != 4) {
            swal('', ' Enter valid last 4 digit Card Number !', 'info');
            return false;
        }
        CardNumber = $("#CardNumber").val();

        if (NameOfCard.length == 0) {
            swal('', 'Enter Card Name !', 'info');
            return false;
        }
        if (!alphanumeric.test(NameOfCard)) {
            swal('', 'Card Name consist only alphabets !', 'info');
            return false;
        }

        var amt_pay_raw = $('#pay_amount2').val(); // Including Card Service Charge
        var amt_pay = parseFloat(amt_pay_raw);

        var temp_reg_id = $('#temp_reg_id').val();
        var student_name = $('#student_name').val();
        var parent_name = $('#parent_name').val();
        var address = $('#address').val();
        var phone_number = $('#phone_number').val();
        var fee_id = $('#fee_id').val();
        var card_number = $('#CardNumber').val();
        var card_name = $('#NameOfCard').val();
        var datatosave = [];
        datatosave = {
            "amount_paid": amt_pay_raw,
            "service_charge": service_charge,
            "temp_reg_id": temp_reg_id,
            "trantype": 'R',
            "card_number": card_number,
            "card_name": card_name
        };
        // alert(JSON.stringify(datatosave));
        // return false;

        var ops_url = baseurl + 'fees/pay_temp_registration_fee';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: datatosave,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {

                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    swal('', 'Payment of ' + amt_pay_raw + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'temp_regfee'); //PRINT VOUCHER
                    temp_registration_fee();

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
        $('#pay_loader').removeClass('sk-loading');
    }
    
    function dbt_pay() {

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

        var amt_pay_raw = $('#pay_amount4').val(); // Including Card Service Charge
        var amt_pay = parseFloat(amt_pay_raw);

        var temp_reg_id = $('#temp_reg_id').val();
        var student_name = $('#student_name').val();
        var parent_name = $('#parent_name').val();
        var address = $('#address').val();
        var phone_number = $('#phone_number').val();
        var fee_id = $('#fee_id').val();
        var card_number = $('#CardNumber').val();
        var card_name = $('#NameOfCard').val();
        var datatosave = [];
        datatosave = {
            "amount_paid": amt_pay_raw,
            "service_charge": 0,
            "temp_reg_id": temp_reg_id,
            "trantype": 'D',
            "card_number": '0',
            "card_name": 'nocard',
            "reference_number": reference_number,
            "referenceDate": referenceDate
        };
        // alert(JSON.stringify(datatosave));
        // return false;

        var ops_url = baseurl + 'fees/pay_temp_registration_fee';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: datatosave,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {

                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    swal('', 'Payment of ' + amt_pay_raw + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'temp_regfee'); //PRINT VOUCHER
                    temp_registration_fee();

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
        $('#pay_loader').removeClass('sk-loading');
    }


    function print_voucher(voucher_id, voucher_code, ptype) {
        var student_id = $('#temp_reg_id').val();
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
</script>