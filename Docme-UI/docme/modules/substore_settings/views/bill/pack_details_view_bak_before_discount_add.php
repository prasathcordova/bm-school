<?php
$qtys = 0;
$sub_total = 0;
$total_amt = 0;
$taxpercent = 0;
$reminder = 0;
$roundoff = 0;
$final_amount = 0;
$discount = 0;
$discount_rate = 0;
$actual_discount = 0;
$discout_type = 0;
$value_change = 0;
$total1 = 0;
$reminder1 = 0;
$roundoff1 = 0;
$final_amount1 = 0;
$ohtype = 0;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Pack Details

            </div>
            <div class="panel-body">

                <div class="notes" style="padding-bottom:10px;padding-left: 10px;padding-top: 10px;background-color: lightblue;margin-bottom: 10px;font-family: Tahoma;">
                    <b>Notes : </b>&nbsp;&nbsp;&nbsp;&nbsp;
                    'F' for Fixed vat and 'P' for Rate(%) vat &nbsp;&nbsp;&nbsp;&nbsp;

                    <br>
                </div>

                <div class="table m-t scroll_content" style="height: 100px !important;">

                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th>Items Name</th>
                                <th>Rate(<?php echo CURRENCY  ?>)</th>
                                <th>Quantity</th>
                                <th>Sub Total(<?php echo CURRENCY  ?>)</th>
                                <th><?php echo TAXNAME  ?>(F/P)</th>
                                <th><?php echo TAXNAME  ?> Amount(<?php echo CURRENCY  ?>)</th>
                                <th>Total(<?php echo CURRENCY  ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($details_data) && !empty($details_data)) {

                                if (isset($details_data[0]['discount_type']) && !empty($details_data[0]['discount_type'])) {
                                    $discout_type = $details_data[0]['discount_type'];
                                    $discount = $details_data[0]['discount'];
                                    $discount_rate = $details_data[0]['discount_percent'];
                                    $ohtype = 1;
                                }



                                foreach ($details_data as $items) {
                            ?>
                                    <tr>
                                        <td>
                                            <div><strong><?php echo $items['item_name']; ?> </div></strong>
                                        </td>
                                        <td><?php echo $items['Rate']; ?></td>
                                        <td><?php echo $items['qty']; ?></td>
                                        <td><?php echo $items['sub_total']; ?></td>
                                        <td>
                                            <?php
                                            if ($items['tax_type'] == 'P') {
                                                echo $items['tax_percent'];
                                                echo ' (P)';
                                            } else {
                                                echo $items['tax_percent'];
                                                echo ' (F)';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($items['tax_type'] == 'P') {
                                                echo $taxxx = $items['sub_total'] * $items['tax_percent'] / 100;
                                            } else {
                                                echo $taxxx = $items['tax_percent'] * $items['qty'];
                                            }
                                            ?>
                                        </td>

                                        <td><?php echo $items['sub_total'] + ($taxxx); ?></td>
                                    </tr>
                            <?php
                                    $qtys++;
                                    if ($items['tax_type'] == 'P') {
                                        $taxxx = $items['sub_total'] * $items['tax_percent'] / 100;
                                    } else {
                                        $taxxx = $items['tax_percent'] * $items['qty'];
                                    }

                                    $sub_total = $sub_total + $items['sub_total'];
                                    $total_amt = $total_amt + $items['sub_total'] + ($taxxx);
                                    $taxpercent = $taxpercent + $taxxx;
                                }
                            }

                            //                            Rahul discount from OH
                            if ($discout_type == 'R') {
                                $total_amount = $total_amt - (($total_amt * $discount_rate) / 100);
                                $actual_discount = ($total_amt * $discount_rate) / 100;
                            } else
                            if ($discout_type == 'F') {
                                $total_amount = $total_amt - $discount;
                                $actual_discount = $discount;
                            } else {
                                $total_amount = $total_amt;
                                $actual_discount = 0;
                            }

                            if (isset($details_data[0]['discount_amount']) && !empty($details_data[0]['discount_amount'] && $ohtype == 0)) {
                                $discount = $details_data[0]['discount_amount'];
                                $total_amt = $total_amt - $discount;
                                $total_amount = $total_amt;
                            }

                            //                            dev_export($ohtype);
                            //                            dev_export($actual_discount);
                            //                            dev_export($discount);die;


                            //                            $total1 = intval($total_amt);
                            //                            $reminder1 = $total_amt - $total1;
                            //                            if ($reminder1) {
                            //                                $roundoff1 = 1 - $reminder1;
                            //                            } else {
                            //                                $roundoff1 = 0;
                            //                            }
                            //                            $final_amount = $total_amount + $roundoff1;
                            //                            
                            //                            
                            $total = intval($total_amount);
                            $reminder = $total_amount - $total;
                            if ($reminder) {
                                $roundoff = 1 - $reminder;
                            } else {
                                $roundoff = 0;
                            }
                            $final_amount = $total_amount + $roundoff;
                            //                            dev_export($final_amount);die;
                            //
                            //                            $total = intval($total_amount);
                            //                            $reminder = $total_amount - $total;
                            //                            if ($reminder) {
                            //                                $roundoff = 1 - $reminder;
                            //                            } else {
                            //                                $roundoff = 0;
                            //                            }
                            //                            $final_amount = $total_amt + $roundoff;
                            ?>
                        </tbody>
                    </table>
                </div> <br>
                <input type="hidden" id="value_change_total" value="<?php echo $final_amount; ?>">
                <table class="table invoice-total" id="invoice_tbl">
                    <tbody>
                        <tr>
                            <td><strong>Total Items:</strong></td>
                            <td>
                                <p id="tbl_total_qty"></p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Sub Total :(<?php echo CURRENCY  ?>)</strong></td>
                            <td>
                                <p id="tbl_subtotal"></p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo TAXNAME  ?> :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id="">
                                <p id="tbl_tax"></p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Discount :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id="">
                                <p id="tbl_discount"></p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total :(<?php echo CURRENCY  ?>)</strong></td>
                            <td id="">
                                <p id="tbl_total" style="font-weight: bold;"></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--</div>-->
                <?php if ($details_data[0]['is_payment_done'] == null) { ?>
                    <div class="col-md-6" id="check_dis" style="margin-top: -197px;">
                        <label class="form-check-label col-sm-12 " style="font-weight:normal;">
                            <b>Discount</b>(-)
                            <input class="form-check-input" style="margin:0 0 0 15px;" type="radio" name="gridRadios" id="dis_rate" value="0" checked>
                            Rate(%)
                            <input class="form-check-input" style="margin:0 0 0 15px;" type="radio" name="gridRadios" id="dis_fixed" value="1" checked>
                            Fixed
                        </label>
                        <div class=" input-group">
                            <input type="text" value="<?php echo $actual_discount ?>" class="form-control" id="discount" placeholder="">
                            <p style="display:inline-block; padding: 0 0 0 5px"></p>
                            <span class="input-group-btn">
                                <button style="margin-bottom: 18px;" id="button_id" type="button" class="btn btn btn-primary" onclick="change_valuedisplay();">Go</button>
                            </span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-md-6" id="check_dis" style="margin-top: -197px;">
                        <label class="form-check-label col-sm-12 " style="font-weight:normal;">
                            <b>Discount Amount</b>(-)
                        </label>
                        <div class=" input-group">
                            <input type="text" class="form-control" disabled="" style="background-color: white" id="discount" placeholder="" value="<?php echo $details_data[0]['discount_amount']; ?>  ">
                            <p style="display:inline-block; padding: 0 0 0 5px"></p>
                            <span class="input-group-btn">
                                <button style="margin-bottom: 18px;" disabled="" type="button" class="btn btn btn-primary" onclick="change_valuedisplay();">Go</button>
                            </span>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-6" id="check_dis" style="margin-top: -113px;">

                </div>

                <div class="row" style="display:none;">
                    <div class="col-md-6">
                        <b> Total Quantity </b>
                        <div class="form-group">
                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="total_qty" id="total_qty" value="<?php echo $qtys; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b> Sub Total</b>
                        <div class="form-group">
                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="sub_total" id="sub_total" value="<?php echo $sub_total; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b><?php echo TAXNAME ?></b>
                        <div class="form-group">
                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="vat" id="vat" value="<?php echo $taxpercent; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-top: 15px;">
                        <b>Total</b>
                        <div class="form-group">
                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="total" id="total" value="<?php echo $final_amount; ?>" />

                        </div>
                    </div>
                </div>

                <input type="hidden" name="total_value" id="total_value" value="<?php echo $final_amount; ?>" />
                <input type="hidden" name="total_value_before_round_off" id="total_value_before_round_off" value="<?php echo $total_amt; ?>" />
                <input type="hidden" name="roundoff" id="roundoff" value="<?php echo $roundoff; ?>" />
                <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $sub_total; ?>" />
                <input type="hidden" name="vat" id="vat" value="<?php
                                                                echo $details_data[0]['total_tax'];;
                                                                ?>" />
                <!--<input type="hidden" name="discount_data" id="discount_data" value="<?php
                                                                                        echo $details_data[0]['total_tax'];;
                                                                                        ?>" />-->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php if ($details_data[0]['is_payment_done'] == null) { ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> Transaction Types
                </div>



                <div class="panel-body">

                    <!--<div class="ibox-content">-->
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
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">

                                    <div class="row">


                                        <div class="form-group " style="padding-left: 30px;padding-right: 30px;">
                                            <label>Amount Total</label>
                                            <input type="text" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="pay_amount" id="pay_amount" value="<?php echo CURRENCY  ?> <?php echo $final_amount; ?>" />

                                        </div>

                                        <hr />

                                        <a class="btn btn-info" style="margin-left:30px;" href="javascript:void(0);" onclick="cash_pay();">
                                            <i class="fa fa-money">

                                                Make a payment!
                                            </i>
                                        </a>

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
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Cheque Number</label>
                                                <input type="text" class="form-control" name="ChequeNumber" id="ChequeNumber" placeholder="Enter Cheque Number" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Cheque Date</label>
                                                <input type="text" class="form-control" name="ChequeDate" id="ChequeDate" placeholder="Enter Cheque Date" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Name of Drawer</label>
                                                <input type="text" class="form-control" name="NameofDrawer" id="NameofDrawer" placeholder="Enter Drawer Name" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Drawer Address</label>
                                                <input type="text" class="form-control" name="DrawerAddress" id="DrawerAddress" placeholder="Enter Drawer Address" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Name of Bank</label>
                                                <input type="text" class="form-control" name="NameofDrawee" id="NameofDrawee" placeholder="Enter Drawee Name" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Bank Branch</label>
                                                <input type="text" class="form-control" name="DraweeAddress" id="DraweeAddress" placeholder="Enter Drawee Address" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Amount Total</label>
                                        <input type="text" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="pay_amount1" id="pay_amount1" value="<?php echo CURRENCY  ?> <?php echo $final_amount; ?>" />

                                    </div>

                                    <div class="col-xs-12">
                                        <div class="row">
                                            <a class="btn btn-info" style="margin-left:30px;" href="javascript:void(0)" onclick="cheque_pay();">
                                                <i class="fa fa-money">
                                                    Make a payment!
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
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div class="panel-body">

                                    <div class="row">

                                        <div class="col-md-12">

                                            <form role="form" id="payment-form">


                                                <div class="col-md-6">
                                                    <div class="form-group has-success">
                                                        <label>CARD NUMBER</label>
                                                        <input type="number" class="form-control" name="CardNumber" maxlength="16" id="CardNumber" placeholder="Enter Card Number" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group has-success">
                                                        <label>NAME AS ON CARD</label>
                                                        <input type="text" class="form-control" name="NameOfCard" id="NameOfCard" placeholder="Enter name as on card" />
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label>Amount Total</label>
                                                    <input type="text" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="pay_amount2" id="pay_amount2" value="<?php echo CURRENCY  ?> <?php echo $final_amount; ?>" />

                                                </div>

                                                <div class="row">

                                                    <a class="btn btn-info" style="margin-left:30px;" href="javascript:void(0);" onclick="card_pay();">
                                                        <i class="fa fa-money">

                                                            Make a payment!
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


                    <hr />

                </div>

            </div>


        <?php } ?>



    </div>

</div>


<div class="col-lg-12">
    <div id="student-data-container"></div>
</div>


<input type="hidden" name="itemdata" id="itemdata" value="" />
<input type="hidden" id="std_id" name="std_id" value="<?php echo $std_id ?>">
<input type="hidden" id="pack_id" name="pack_id" value="<?php echo $pack_id ?>">




<script>
    var input = document.getElementById("discount");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id").click();
        }
    });


    //     $('#discount').val();

    $('#tbl_subtotal').empty();
    $('#tbl_subtotal').append('<?php echo $sub_total; ?> ');
    $('#tbl_tax').empty();
    $('#tbl_tax').append('<?php echo $details_data[0]['total_tax']; ?> ');
    $('#tbl_discount').empty();
    $('#tbl_discount').append($('#discount').val() + ' ');
    $('#tbl_total').empty();
    $('#tbl_total').append('<?php echo $final_amount; ?> ');
    $('#tbl_total_qty').empty();
    $('#tbl_total_qty').append('<?php echo $qtys; ?>');

    $('.scroll_content').slimscroll({
        height: '140px',
        color: '#f8ac59'

    })
    $(document).ready(function() {
        $("#discount").keydown(function(event) {
            if (event.shiftKey) {
                event.preventDefault();
            }


            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 110) {} else {
                if (event.keyCode < 95) {
                    if (event.keyCode < 48 || event.keyCode > 57) {
                        event.preventDefault();
                    }
                } else {
                    if (event.keyCode < 96 || event.keyCode > 105) {
                        event.preventDefault();
                    }
                }
            }
        });


        $('.ScrollStyle').slimscroll({
            height: '150px'
        })
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    var table = $('#tbl_class_item').dataTable({
        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "15%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "15%",
                className: "capitalize",
                "targets": 4
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 5
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 6
            }
            //            {"width": "10%", className: "capitalize", "targets": 4},
            //            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        //        responsive: true,
        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],
    });

    function cash_pay() {
        $('#save_billing').prop('disabled', true);
        var payment_mode = 1;
        var subtotal = $('#sub_total').val();
        var vat = $('#vat').val();
        var total = $('#total').val();
        var net_val = $("#total_value").val();
        var discount_p = $('#discount').val();
        var std_id = $('#std_id').val();
        //        alert(std_id);
        var pack_id = $('#pack_id').val();
        var roundoff = $('#roundoff').val();
        var total_before_roundoff = $('#total_value_before_round_off').val();
        if (total == net_val) {
            var is_discount = 0;
            var discount_percent = $('#discount').val();
            var discount_amount = $('#discount').val();
        } else {
            var is_discount = 1;
            var discount_amount = 0;
            var discount_percent = 0;
            if ($("#dis_rate").prop("checked")) {
                discount_amount = parseFloat((parseFloat(subtotal) + parseFloat(vat)) * discount_p / 100);
                discount_percent = $('#discount').val();

            } else if ($("#dis_fixed").prop("checked")) {
                discount_amount = $('#discount').val();
                discount_percent = 0;
            }
        }
        if (vat == 0) {
            var is_tax = 0;
        } else {
            var is_tax = 1;
        }

        var cash_billing = new Object();
        cash_billing.payment_mode_id = payment_mode;
        cash_billing.sub_total = subtotal;
        cash_billing.is_discount = is_discount;
        cash_billing.discount_percent = discount_percent;
        cash_billing.discount_amount = discount_amount;
        cash_billing.is_tax = is_tax;
        cash_billing.tax_amount = vat;
        cash_billing.total_amount = total_before_roundoff;
        cash_billing.round_off = roundoff;
        cash_billing.final_amount = total;
        cash_billing.is_ecash = 0;
        cash_billing.ecash_id = 0;
        cash_billing.ecash_amount = 0;
        cash_billing.final_payment_amount = total;
        cash_billing.is_payment_done = 1;
        var otherflag = 0;
        var cashbilldata = JSON.stringify(cash_billing);
        //        alert(cashbilldata);
        var ops_url = baseurl + 'substore-bill-pay/pay-cash-amount';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pack_id": pack_id,
                "std_id": std_id,
                "cashbilldata": cashbilldata
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    if (data.bill_link) {
                        window.open(data.bill_link, '_blank');
                    }
                    bill_test();
                } else {
                    otherflag = 0;
                }
            },
            error: function() {
                console.log(cash_billing);
                otherflag = 0;
            }
        });
        return otherflag;
    }

    function cheque_pay() {
        var payment_mode = 2;
        var subtotal = $('#sub_total').val();
        var vat = $('#vat').val();
        var total = $('#total').val();
        var net_val = $("#total_value").val();
        var discount_p = $('#discount').val();
        var roundoff = $('#roundoff').val();
        var total_before_roundoff = $('#total_value_before_round_off').val();
        if (total == net_val) {
            var is_discount = 0;
            var discount_percent = $('#discount').val();
            var discount_amount = $('#discount').val();
        } else {
            var is_discount = 1;
            var discount_amount = 0;
            var discount_percent = 0;
            if ($("#dis_rate").prop("checked")) {
                discount_amount = parseFloat((parseFloat(subtotal) + parseFloat(vat)) * discount_p / 100);
                discount_percent = $('#discount').val();

            } else if ($("#dis_fixed").prop("checked")) {
                discount_amount = $('#discount').val();
                discount_percent = 0;
            }
        }
        if (vat == 0) {
            var is_tax = 0;
        } else {
            var is_tax = 1;
        }
        var ChequeNumber = $('#ChequeNumber').val();
        var ChequeDate = $('#ChequeDate').val();
        var NameofDrawer = $('#NameofDrawer').val();
        var DrawerAddress = $('#DrawerAddress').val();
        var NameofDrawee = $('#NameofDrawee').val();
        var DraweeAddress = $('#DraweeAddress').val();
        var std_id = $('#std_id').val();
        var pack_id = $('#pack_id').val();
        if (ChequeNumber.length == 0) {
            swal('', 'Enter Cheque Number ', 'info');
            return false;
        }
        if (ChequeDate.length == 0) {
            swal('', 'Enter Cheque Date ', 'info');
            return false;
        }
        if (NameofDrawer.length == 0) {
            swal('', 'Enter Name of Drawer ', 'info');
            return false;
        }
        if (DrawerAddress.length == 0) {
            swal('', 'Enter Drawer Address ', 'info');
            return false;
        }
        if (NameofDrawee.length == 0) {
            swal('', 'Enter Name of Drawee ', 'info');
            return false;
        }
        if (DraweeAddress.length == 0) {
            swal('', 'Enter Drawee Address ', 'info');
            return false;
        }


        var cash_billing = new Object();
        cash_billing.payment_mode_id = payment_mode;
        cash_billing.sub_total = subtotal;
        cash_billing.is_discount = is_discount;
        cash_billing.discount_percent = discount_percent;
        cash_billing.discount_amount = discount_amount;
        cash_billing.is_tax = is_tax;
        cash_billing.tax_amount = vat;
        cash_billing.total_amount = total_before_roundoff;
        cash_billing.round_off = roundoff;
        cash_billing.final_amount = total;
        cash_billing.is_ecash = 0;
        cash_billing.ecash_id = 0;
        cash_billing.ecash_amount = 0;
        cash_billing.final_payment_amount = total;
        cash_billing.is_payment_done = 1;
        cash_billing.cheque_number = ChequeNumber;
        cash_billing.cheque_date = ChequeDate;
        cash_billing.name_of_drawee = NameofDrawee;
        cash_billing.drawee_address = DraweeAddress;
        var otherflag = 0;
        var cashbilldata = JSON.stringify(cash_billing);
        //        alert(cashbilldata);
        var ops_url = baseurl + 'substore-bill-pay/pay-cheque-amount';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pack_id": pack_id,
                "std_id": std_id,
                "cashbilldata": cashbilldata
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    if (data.bill_link) {
                        window.open(data.bill_link, '_blank');
                    }
                    bill_test();
                } else {
                    otherflag = 0;
                }
            },
            error: function() {
                console.log(cash_billing);
                otherflag = 0;
            }
        });
        return otherflag;
    }

    function card_pay() {
        $('#save_billing').prop('disabled', true);
        var payment_mode = 3;
        var subtotal = $('#sub_total').val();
        var vat = $('#vat').val();
        var total = $('#total').val();
        var net_val = $("#total_value").val();
        var discount_p = $('#discount').val();
        var roundoff = $('#roundoff').val();
        var total_before_roundoff = $('#total_value_before_round_off').val();
        if (total == net_val) {
            var is_discount = 0;
            var discount_percent = $('#discount').val();
            var discount_amount = $('#discount').val();
        } else {
            var is_discount = 1;
            var discount_amount = 0;
            var discount_percent = 0;
            if ($("#dis_rate").prop("checked")) {
                discount_amount = parseFloat((parseFloat(subtotal) + parseFloat(vat)) * discount_p / 100);
                discount_percent = $('#discount').val();

            } else if ($("#dis_fixed").prop("checked")) {
                discount_amount = $('#discount').val();
                discount_percent = 0;
            }
        }
        if (vat == 0) {
            var is_tax = 0;
        } else {
            var is_tax = 1;
        }
        var std_id = $('#std_id').val();
        var pack_id = $('#pack_id').val();
        //        alert(total);
        //        var discount = $('#discount').prop('checked');
        //        if (transport == true) {
        //            var istransport = 1;
        //        } else {
        //            var istransport = 0;
        //        }
        var CardNumber = $('#CardNumber').val();
        var NameOfCard = $('#NameOfCard').val();
        if (CardNumber.length == 0) {
            swal('', 'Enter Card Number ', 'info');
            return false;
        }
        if (!(Math.floor(CardNumber) == CardNumber && $.isNumeric(CardNumber))) {
            swal('', ' Enter valid Card Number ', 'info');
            return false;
        }
        if (CardNumber.length != 16) {
            swal('', ' Enter valid Card Number(16 digit code) ', 'info');
            return false;
        }


        if (NameOfCard.length == 0) {
            swal('', 'Enter Card Name ', 'info');
            return false;
        }

        var cash_billing = new Object();
        cash_billing.payment_mode_id = payment_mode;
        cash_billing.sub_total = subtotal;
        cash_billing.is_discount = is_discount;
        cash_billing.discount_percent = discount_percent;
        cash_billing.discount_amount = discount_amount;
        cash_billing.is_tax = is_tax;
        cash_billing.tax_amount = vat;
        cash_billing.total_amount = total_before_roundoff;
        cash_billing.round_off = roundoff;
        cash_billing.final_amount = total;
        cash_billing.is_ecash = 0;
        cash_billing.ecash_id = 0;
        cash_billing.ecash_amount = 0;
        cash_billing.final_payment_amount = total;
        cash_billing.is_payment_done = 1;
        cash_billing.card_number = CardNumber;
        cash_billing.name_on_card = NameOfCard;
        var otherflag = 0;
        var cashbilldata = JSON.stringify(cash_billing);
        var ops_url = baseurl + 'substore-bill-pay/pay-cheque-amount';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pack_id": pack_id,
                "std_id": std_id,
                "cashbilldata": cashbilldata
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', data.message, 'success');
                    if (data.bill_link) {
                        window.open(data.bill_link, '_blank');
                    }
                    bill_test();
                } else {
                    otherflag = 0;
                }
            },
            error: function() {
                console.log(cash_billing);
                otherflag = 0;
            }
        });
        return otherflag;
    }


    function change_valuedisplay() {
        //            alert("item_id");return
        var subtotal = $('#subtotal').val();
        var tax_vat = $('#vat').val();

        var net_val_after_tax = parseFloat(subtotal) + parseFloat(tax_vat);
        var disc_type = $('input[name=gridRadios]:checked', '#check_dis').val();

        var discount_amount = 0;
        var discount = $("#discount").val();
        var RE = /^\d*\.?\d*$/;
        if (!RE.test(discount)) {
            swal('', "Enter a valid floating number", 'info');
            return true;
        }

        if (disc_type == 1) {
            discount_amount = discount;

            if (parseFloat(discount) > parseFloat(net_val_after_tax)) {
                swal('', "Enter a value less than total amount", 'info');
                return true;
            }
        } else {
            if (discount > 100) {
                swal('', "Enter a value less than 100%", 'info');
                return true;
            }
            discount_amount = (parseFloat(net_val_after_tax) * parseFloat(discount)) / 100;
            //            alert(discount_amount);
        }
        var net_val_after_discount = 0;
        if (parseFloat(discount_amount)) {
            net_val_after_discount = net_val_after_tax - parseFloat(discount_amount)
        } else {
            net_val_after_discount = net_val_after_tax;
        }
        $('#total_value_before_round_off').val(net_val_after_discount);



        var rounded_total = 0;

        var reminder = net_val_after_discount % 1;

        var roundoff = (1 - reminder);
        if (roundoff == 1) {
            roundoff = 0;
        }

        $("#roundoff").val(roundoff);

        //alert(roundoff);

        if ((reminder)) {

            rounded_total = net_val_after_discount + roundoff;
        } else {
            rounded_total = net_val_after_discount;
        }
        if (rounded_total < 0) {
            rounded_total = 0;
        }
        //alert(rounded_total);
        $('#total').val(rounded_total);
        $('#pay_amount').val('<?php echo CURRENCY  ?> ' + rounded_total);
        $('#pay_amount1').val('<?php echo CURRENCY  ?> ' + rounded_total);
        $('#pay_amount2').val('<?php echo CURRENCY  ?> ' + rounded_total);

        $('#tbl_discount').empty();
        $('#tbl_discount').append(parseFloat(discount_amount).toFixed(2) + ' ');
        $('#tbl_total').empty();
        $('#tbl_total').append(rounded_total + ' ');

    }
</script>