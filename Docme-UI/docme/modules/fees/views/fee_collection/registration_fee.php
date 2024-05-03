<!-- SALAHUDHEEn SEPTEMBER : REGISTRATION / PROSPECTUS FEE From Students -->
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
                    <span style="float:right;">
                        <a href="javascript:" title="Reload" onclick="registration_fee()"><i class="fa fa-refresh" style="font-size: 20px;"></i></a>
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Student Name</label><span class="mandatory"> *</span>
                                    <div class="form-line <?php
                                                            if (form_error('student_name')) {
                                                                echo 'has-error';
                                                            }
                                                            ?> ">
                                        <input type="text" class="form-control alpha max50" placeholder="Enter Student Name" name="student_name" id="student_name" value="<?php echo set_value('student_name', isset($student_name) ? $student_name : ''); ?>" />
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
                                        <input type="text" class="form-control alpha max50" placeholder="Enter Parent Name" name="parent_name" id="parent_name" value="<?php echo set_value('parent_name', isset($parent_name) ? $parent_name : ''); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone Number</label><span class="mandatory"> *</span>
                                    <div class="form-line <?php
                                                            if (form_error('phone_number')) {
                                                                echo 'has-error';
                                                            }
                                                            ?> ">
                                        <input type="text" class="form-control numeric" placeholder="Enter Phone Number" maxlength="12" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number', isset($phone_number) ? $phone_number : ''); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Address</label><span class="mandatory"> *</span>
                                    <div class="form-line <?php
                                                            if (form_error('address')) {
                                                                echo 'has-error';
                                                            }
                                                            ?> ">
                                        <textarea class="form-control" maxlength="100" placeholder="Enter Address" name="address" id="address" rows="5" style="resize: none;"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                <hr>
                                <div class="input-group m-b" style="margin-bottom: 0px;">
                                    <input type="text" placeholder="Enter Amount to pay" class="form-control digits" name="amt_distribute" id="amt_distribute" maxlength="10" style="height: 39px !important;text-align:right;">
                                    <span class="input-group-addon"><?php print_currency('hotpink'); ?> </span>
                                    <span class="input-group-btn"> <button style="background:hotpink !important;border-color: hotpink !important;height: 39px !important;padding-bottom: 0px;margin-bottom: 0px;border-bottom-width: 0px;border-top-width: 0px;" type="button" onclick="application_fee_validation();" class="btn btn-primary">Pay
                                        </button> </span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="ibox-content no-padding" style=" padding-top: 1% !important;" id="fees_summary">
                                    <div class="row clearfix">

                                        <div class="clearfix"></div>

                                        <div class="col-lg-12" id="pay_panel">
                                            <div class="panel">
                                                <div class="panel-body no-padding">
                                                    <div class="panel-group payments-method" id="accordion" style="margin-bottom:0px;">
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

    function application_fee_validation() {
        var student_name = $('#student_name').val();
        var parent_name = $('#parent_name').val();
        var address = $('#address').val();
        var phone_number = $('#phone_number').val();

        //Basic validation starts
        $('#pay_loader').addClass('sk-loading');
        if (student_name.length <= 0) {
            $('#student_name').focus();
            swal('', 'Enter Student Name', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (student_name.length < 3) {
            $('#student_name').focus();
            swal('', 'Student name should have atleast three characters.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (parent_name.length <= 0) {
            $('#parent_name').focus();
            swal('', 'Enter Name of Parent', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (parent_name.length < 3) {
            $('#parent_name').focus();
            swal('', 'Parent name should have atleast three characters.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (phone_number.length <= 0) {
            $('#phone_number').focus();
            swal('', 'Enter Phone Number', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (phone_number.length < 10) {
            $('#phone_number').focus();
            swal('', 'Phone Number should have atleast 10 numbers', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (address.length <= 0) {
            $('#address').focus();
            swal('', 'Enter Address', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (address.length < 3) {
            $('#parent_name').focus();
            swal('', 'Address should have atleast three characters.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var regx = /^[A-Za-z0-9 _.-]+$/;
        if (!(regx.test($('#student_name').val()))) {
            $('#student_name').focus();
            //swal('', 'Enter valid Student Name', 'info');
            swal('', 'Only alphabets and space allowed for Student Name', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        if (!(regx.test($('#parent_name').val()))) {
            $('#parent_name').focus();
            //swal('', 'Enter valid Name of Parent', 'info');
            swal('', 'Only alphabets and space allowed for Name of Parent', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        // if (!(regx.test($('#address').val()))) {
        //     $('#address').focus();
        //     // swal('', 'Enter valid Address', 'info');
        //     swal('', 'Only alphabets and space allowed for Address', 'info');
        //     $('#pay_loader').removeClass('sk-loading');
        //     return false;
        // }
        $('#pay_loader').removeClass('sk-loading');
        //Basic Validation Ends
        distribute_amount();
    }

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
        // var serpercent = parseFloat($('#card_service_charge_percent').val());
        // var sercharge = parseFloat(((serpercent * amt_pay) / 100));

        // var card_pay = parseFloat((amt_pay * 1) + parseFloat(sercharge * 1)).toFixed(2);
        // $('#card_service_charge').val(sercharge);
        // $('#pay_amount').val(amt_pay); //Pay by Cash
        // $('#pay_amount2').val(card_pay); // Pay by Card

        // $('#amt_distribute_ops').val('1');
        // return true;
        var serpercent = parseFloat($('#card_service_charge_percent').val());
        var sercharge = ((serpercent * parseFloat(amt_pay)) / 100);
        var roundsercharge = getRoundOffAmount(sercharge);
        sercharge = roundsercharge['roundedamount'];
        if(serpercent == 0){
            sercharge = 0;
        }
        else{
            if (sercharge == 0 ) {
            sercharge = 1;
        }
        }
        // alert(sercharge);
        var card_pay = parseFloat((amt_pay * 1) + parseFloat(sercharge * 1)).toFixed(2);
        $('#card_service_charge').val(sercharge);
        $('#pay_amount').val(amt_pay);
        $('#pay_amount2').val(card_pay);
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

        //var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var parent_name = $('#parent_name').val();
        var address = $('#address').val();
        var phone_number = $('#phone_number').val();
        var fee_id = $('#fee_id').val();
        var ops_url = baseurl + 'fees/pay_registration_fee';
        var datatosave = [];
        datatosave = {
            "amount_paid": amt_pay_raw,
            "service_charge": 0,
            "student_name": student_name,
            "parent_name": parent_name,
            "address": address,
            "phone_number": phone_number,
            "trantype": 'C'
                //,"fee_id": fee_id
                ,
            "card_number": '0',
            "card_name": 'nocard'
        };
        //alert(JSON.stringify(datatosave));
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
                    print_voucher(voucher_id, voucher, 'regfee'); //PRINT VOUCHER
                    registration_fee();
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info');

                        registration_fee()
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


        //var amt_pay_raw = $('#amt_distribute').val(); //$('#pay_amount2').val(card_pay);
        //var amt_pay_raw = $('#totamt').val();
        //var amt_pay_raw = $('#totamt').val();
        var amt_pay_raw = $('#pay_amount2').val(); // Including Card Service Charge
        var amt_pay = parseFloat(amt_pay_raw);
        //alert(amt_pay); 
        //exit;

        var student_id = $('#student_id').val();
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
            "student_name": student_name,
            "parent_name": parent_name,
            "address": address,
            "phone_number": phone_number,
            "trantype": 'R',
            //"fee_id": fee_id,
            "card_number": card_number,
            "card_name": card_name
        };
        //alert(JSON.stringify(datatosave));

        var ops_url = baseurl + 'fees/pay_registration_fee';
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
                    print_voucher(voucher_id, voucher, 'regfee'); //PRINT VOUCHER
                    registration_fee();

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
</script>