<style>
    table.ex2 {
        table-layout: absolute;
    }

    td {
        word-break: break-word;
    }

    th {
        word-break: break-word;
    }

    .invoice-total>tbody>tr>td:last-child {
        width: 35% !important
    }
</style>


<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Pack Details - <?php echo isset($barcode) && !empty($barcode) ? $barcode : ''; ?>
            </div>
            <div class="panel-body">
                <div class="notes" style="padding-bottom:16px;padding-left: 10px;padding-top: 10px;margin-bottom: 10px;">

                    <?php
                    $total_items = 0;
                    $total_sub_total = 0;
                    $total_vat_amount = 0;
                    $total_discount_amount = 0;
                    $grand_total = 0;
                    $total_roundoff = 0;
                    $item_data = array();
                    ?>
                    <div class="table m-t scroll_content">
                        <!--style="min-height: 200px !important;" -->
                        <table class="table ex2 invoice-table ">
                            <thead>
                                <tr>
                                    <th width='40%'>Kit Name</th>
                                    <th width='20%'>Quantity</th>
                                    <th width='40%'>Total(<?php echo CURRENCY  ?>)</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><strong><?php echo $pack_data['description']; ?></strong></td>
                                    <td>1.00</td>
                                    <td><?php echo my_money_format($pack_data['final_total']); ?></td>

                                </tr>
                                <tr style="border-top:none">
                                    <td style="border-top:none">&nbsp;</td>
                                    <td style="border-top:none">&nbsp;</td>
                                    <td style="border-top:none">&nbsp;</td>

                                </tr>
                                <tr>
                                    <td style="border-top:none">&nbsp;</td>
                                    <td style="border-top:none">&nbsp;</td>
                                    <td style="border-top:none">&nbsp;</td>

                                </tr>
                                <tr>
                                    <td style="border-top:none">&nbsp;</td>
                                    <td style="border-top:none">&nbsp;</td>
                                    <td style="border-top:none">&nbsp;</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <?php //dev_export($pack_data); 
                    ?>
                    <table class="table invoice-total" id="invoice_tbl">
                        <tbody>
                            <tr>
                                <td><strong>Total Items:</strong></td>
                                <td width="50%">
                                    <p id="tbl_total_items">1.00</p>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Sub Total :(<?php echo CURRENCY  ?>)</strong></td>
                                <td>
                                    <p id="tbl_subtotal"><?php echo my_money_format($pack_data['sub_total'] + $pack_data['roundoff']); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?php echo TAXNAME  ?> :(<?php echo CURRENCY  ?>)</strong></td>
                                <td id="">
                                    <p id="tbl_tax"><?php echo my_money_format($pack_data['vat_amount']); ?></p>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>Bill Total :(<?php echo CURRENCY  ?>)</strong></td>
                                <td id="">
                                    <p id="tbl_total" style="font-weight: bold;"><?php echo my_money_format($pack_data['final_total']); ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">

        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Order Details
            </div>
            <?php if ($details_data[0]['del_payment_type'] == '' && $details_data[0]['is_payment_done'] == '' && $details_data[0]['is_partial_payment'] == '') { ?>
                <div class="panel-body">
                    <div class="form-group ">
                        <label>Bill Total</label>
                        <input type="text" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="pay_amount" id="pay_amount" value="<?php echo my_money_format($pack_data['final_total']); ?>" />
                    </div>
                    <div class="form-group ">
                        <label>Mode of Payment</label>
                        <div>
                            <label class="checkbox-inline i-checks">
                                <input type="radio" name="payment_type" id="online_payment" class="payment_type" value="2" checked> <span>Online Payment</span>
                            </label>
                            <label class="checkbox-inline i-checks">
                                <input type="radio" name="payment_type" id="cod" class="payment_type" value="1"> <span>Cash On Delivery</span>
                            </label>

                        </div>
                    </div>
                    <div class="form-group ">
                        <label>Delivery Address *</label>
                        <?php
                        $address = '';
                        if ($student_details['Address1'] != '')
                            $address = $student_details['Address1'];
                        if ($student_details['Address2'] != '')
                            $address = $address . ',' . $student_details['Address2'];
                        if ($student_details['Address3'] != '')
                            $address =  $address . ',' . $student_details['Address3'];
                        if ($student_details['PO_No'] != '')
                            $address =  $address . ', Pin-' . $student_details['PO_No'];

                        ?>
                        <textarea class="form-control" id="delivery_address" rows="4"><?php echo $address ?> </textarea>
                    </div>
                    <div class=" form-group ">
                        <label>Mobile No *</label>
                        <input type=" text" maxlength="12" style="background-color: #FFFFFF;" class="form-control digits" name="mobile_no" id="mobile_no" value="<?php echo $student_details['MOBILE_NO_FATHER'] ?>" />
                    </div>
                    <div class=" form-group ">
                        <label>Email *</label>
                        <input type=" text" style="background-color: #FFFFFF;" class="form-control" name="email" id="email" value="<?php echo $student_details['FATHER_EMAIL'] ?>" />
                    </div>
                    <a class="btn btn-info" id="cash_pay_btn" href="javascript:void(0);" onclick="place_order();">
                        Place Order
                    </a>
                </div>
        </div>
    <?php } elseif (($details_data[0]['del_payment_type'] == '' && $details_data[0]['is_payment_done'] == 1) || ($details_data[0]['is_payment_done'] == 0 && $details_data[0]['is_partial_payment'] == 1)) { ?>
        <div class="panel-body">
            <?php if ($details_data[0]['is_partial_payment'] == 1) {
                    echo 'Partial Payment already done at school';
                } else {
                    echo 'Payment already done at school';
                } ?>

        </div>
    <?php } else { ?>
        <div class="panel-body">
            <div class="form-group ">
                <label>Reference No</label><br />
                <?php echo $details_data[0]['reference_no']; ?>
            </div>
            <div class="form-group ">
                <label>Bill Total</label><br />
                <?php echo CURRENCY . ' ' . my_money_format($pack_data['final_total']); ?>
            </div>
            <div class="form-group ">
                <label>Mode of Payment</label><br />
                <?php if ($details_data[0]['del_payment_type'] == 1) {
                    echo 'Cash on Delivery';
                } else {
                    echo 'Paid Online';
                } ?>
            </div>
            <div class="form-group ">
                <label>Payment Date</label><br />
                <?php echo date('d-m-Y', strtotime($details_data[0]['payment_date'])); ?>
            </div>
            <div class="form-group ">
                <label>Order Status</label><br />
                <?php
                if ($pack_data['is_payment_done'] == 1 && $pack_data['delivery_status'] == 1) {
                    echo 'Order Dispatched';
                } elseif (strlen($pack_data['delivery_status']) == 0) {
                    echo 'Available';
                } elseif ($pack_data['delivery_status'] == 0) {
                    echo 'Order Placed';
                } elseif ($pack_data['delivery_status'] == 2) {
                    echo 'Delivered';
                } elseif ($pack_data['delivery_status'] == 3) {
                    echo 'Partially Delivered';
                } elseif ($pack_data['delivery_status'] == 4) {
                    echo 'Delivery Returned';
                } ?>
            </div>
            <div class="form-group ">
                <label>Delivery Address</label><br />
                <?php echo $details_data[0]['delivery_address']; ?>
            </div>
            <div class="form-group ">
                <label>Mobile No</label><br />
                <?php echo $details_data[0]['mobile_no']; ?>
            </div>
        </div>

    <?php } ?>
    </div>

    <input type="hidden" id="std_id" name="std_id" value="<?php echo $std_id ?>">
    <input type="hidden" id="pack_id" name="pack_id" value="<?php echo $pack_id ?>">

    <script type="text/javascript">
        $(document).on("keypress", ".digits", function(e) {
            var dec_numbers = /[0-9]+?$/;
            if (!dec_numbers.test(e.key)) {
                return false;
            } else {
                return true;
            }
        });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        // $('.scroll_content').slimscroll({
        //     height: '250px',
        //     color: '#f8ac59',
        //     alwaysVisible: true
        // });

        //    moment($("#ChequeDate").datepicker("getDate")).format('YYYY-MM-DD');


        function place_order() {

            var pack_id = $('#pack_id').val();
            var std_id = $('#std_id').val();
            var delivery_address = $('#delivery_address').val();
            var mobile_no = $('#mobile_no').val();
            var email = $('#email').val();
            var payment_type = $('.payment_type:checked').val();

            if (payment_type == '') {
                swal('', "Mode of Payment is required.", 'info');
                return false;
            }
            if (delivery_address == '') {
                swal('', "Delivery Address is required.", 'info');
                return false;
            }

            if (mobile_no == '') {
                swal('', "Mobile no is required.", 'info');
                return false;
            }

            if (mobile_no.length < 10) {
                swal('', "Enter a valid mobile no.", 'info');
                return false;
            }

            if (email == '') {
                swal('', "Email is required.", 'info');
                return false;
            }

            var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/
            if (!pattern.test(email)) {
                swal('', "Enter a valid email.", 'info');
                return false;
            }
            var text;
            if (payment_type == 1) {
                text = 'Confirm to place the order with Cash on Delivery?';
            } else {
                text = 'Confirm to place the order with Online Payment?';
            }





            swal({
                title: 'Confirm',
                text: text,
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK',
                closeOnConfirm: false
            }, function(isConfirm) {
                if (isConfirm) {
                    var ops_url = baseurl + 'bookstore/place-order';
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "load": 1,
                            "pack_id": pack_id,
                            "student_id": std_id,
                            "delivery_address": delivery_address,
                            "payment_type": payment_type,
                            "mobile_no": mobile_no,
                            "email": email
                        },
                        success: function(result) {
                            var data = JSON.parse(result);
                            if (data.status == 1 && payment_type == 1) {
                                swal({
                                    title: 'Success',
                                    text: 'Order placed successfully.',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK',
                                    closeOnConfirm: false
                                }, function(isConfirm) {
                                    location.reload();
                                });
                                return true;

                            } else if (data.status == 1 && payment_type == 2) {
                                var redirect_link = data.link;
                                swal({
                                    title: '',
                                    text: 'You will be redirected to Payment Gateway .Proceed to pay online?',
                                    type: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK',
                                    closeOnConfirm: false
                                }, function(isConfirm) {
                                    if (isConfirm === true) {
                                        window.location.href = redirect_link
                                    }
                                });
                                return true;
                            } else {
                                swal('', "Something has gone wrong,Please try again", 'info');
                                return true;
                            }
                        },
                        error: function() {
                            //console.log(cash_billing);
                            otherflag = 0;
                        }
                    });
                } else {
                    return false;
                }

            });


            // $('#cash_pay_btn').prop('disabled', true);
            // return;
        }
    </script>