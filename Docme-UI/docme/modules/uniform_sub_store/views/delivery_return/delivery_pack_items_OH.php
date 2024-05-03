<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Return Details - <?php if ($details_data[0]['type'] == 3) {
                                                                        echo $details_data[0]['billing_code']; ?>
                    <span id="type" class="label label-info pull-right">OH PACKING</span> <?php } ?>
            </div>
            <div class="panel-body">
                <div class="title-action" style="text-align: right;padding-top: 0px; padding-bottom: 10px;">


                    <?php
                    if ($details_data[0]['is_return'] != 1) {
                        if ($details_data[0]['type'] == 3) { ?>
                            <a href="javascript:void(0)" id="OH_return" onclick="uniform_submit_data_OH('<?php echo $details_data[0]['id']; ?>', '<?php echo $details_data[0]['delivery_number']; ?>')" class="btn btn-primary"> Confirm OH Return </a>
                        <?php } else { ?>
                            <a href="javascript:void(0)" id="submit_return" onclick="uniform_submit_data('<?php echo $details_data[0]['id']; ?>', '<?php echo $details_data[0]['delivery_number']; ?>')" class="btn btn-primary"> Confirm Delivery Return </a>
                    <?php }
                    } ?>
                    <input type="hidden" class="input form-control" id="pack_id" name="pack_id" value="<?php echo $details_data[0]['pack_id'] ?>">
                    <input type="hidden" class="input form-control" id="delivery_id" name="delivery_id" value="<?php echo $delivery_id ?>">
                    <input type="hidden" class="input form-control" id="student_id" name="student_id" value="<?php echo $student_id ?>">
                    <?php // }  
                    ?>
                </div>
                <div class="row" style="padding-bottom:20px;">
                    <div class="col-md-8">
                        <b>Reason</b>
                        <div class="form-group">
                            <input type="text" style="background-color: #FFFFFF" class="form-control " placeholder="Enter the reason for returning item/items" name="reason" id="reason" <?php if ($details_data[0]['reason']) {
                                                                                                                                                                                            ?> value="<?php echo $details_data[0]['reason'] ?>" disabled="" <?php
                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                            ?> value="" <?php
                                                                                                                                                                                                                                                                    } ?> />
                        </div>
                    </div>
                </div>
                <div class="table">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_item">
                        <thead>
                            <tr>
                                <th>Items Name</th>
                                <th>Ordered Quantity</th>
                                <th>Pending Quantity</th>
                                <th>Returnable Quantity</th>
                                <th>Available Stock</th>
                                <th>Return Quantity</th>
                                <th>Confirm Item</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $qtys = 0;
                            $sub_total = 0;
                            $sub_total_after_discount = 0;
                            $total_amt = 0;
                            $taxpercent = 0;
                            $reminder = 0;
                            $roundoff = 0;
                            $final_amount = 0;
                            $taxx = 0;
                            $flag = 0;
                            $discount = 0;

                            $qtys_del = 0;
                            $sub_total_del = 0;
                            $sub_total_after_discount_del = 0;
                            $total_amt_del = 0;
                            $taxpercent_del = 0;
                            $reminder_del = 0;
                            $roundoff_del = 0;
                            $final_amount_del = 0;
                            $taxx_del = 0;
                            $flag_del = 0;
                            $discount_del = 0;

                            $qtys_order = 0;
                            $sub_total_order = 0;
                            $sub_total_after_discount_order = 0;
                            $total_amt_order = 0;
                            $taxpercent_order = 0;
                            $reminder_order = 0;
                            $roundoff_order = 0;
                            $final_amount_order = 0;
                            $taxx_order = 0;
                            $flag_order = 0;
                            $discount_order = 0;
                            ?>
                            <?php
                            if (isset($details_data) && !empty($details_data)) {
                                //dev_export($details_data);
                                // die;

                                foreach ($details_data as $items) {
                                    $bill_round_off = $items['bill_roundoff'];
                                    $bill_final_pay_amount = $items['final_pay_amount'];
                                    $price = (isset($items['rate']) && !empty($items['rate']) && $items['rate'] != NULL) ? $items['rate'] : $items['selling_price']
                            ?>

                                    <tr>
                                        <td><?php echo $items['item_name']; ?></td>
                                        <td><?php echo $items['quantity']; ?></td>
                                        <td><?php echo $items['pending_qty']; ?></td>
                                        <td><?php echo isset($items['returnable_qty']) && !empty($items['returnable_qty']) ? $items['returnable_qty'] : 0; ?></td>
                                        <td><?php echo $items['stock_qty']; ?></td>
                                        <?php if ($details_data[0]['type'] == 3) { ?>
                                            <td><input type="textbox" size="3" class="form-control" name="return_qty" disabled="" id="return_qty_<?php echo $items['item_id'] ?>" value="<?php
                                                                                                                                                                                            if ($items['type'] == 3) {
                                                                                                                                                                                                echo $items['delivery_qty'];
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>" /></td>
                                        <?php } else { ?>
                                            <td><input type="number" size="3" class="form-control" <?php if ($items['returnable_qty'] == 0) { ?> disabled="" <?php } ?> name="return_qty" id="return_qty_<?php echo $items['item_id'] ?>_<?php echo $items['del_detail_id'] ?>" value="<?php
                                                                                                                                                                                                                                                                                        if ($items['type'] == 3) {
                                                                                                                                                                                                                                                                                            echo $items['delivery_qty'];
                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                        ?>" /></td>
                                        <?php } ?>

                                        <td>
                                            <?php if ($items['type'] == 3) { ?>
                                                <span id="notask" class="label label-warning pull-left">No task for individual items</span>
                                            <?php } else { ?>
                                                <?php if ($items['is_delivered'] == 1) { ?>
                                                    <?php if ($items['returnable_qty'] != 0 || $items['returnable_qty'] > 0) { ?>
                                                        <a href="javascript:void(0)" onclick="uniform_return_item('<?php echo $items['del_detail_id'] ?>', '<?php echo $items['item_id'] ?>', '<?php echo $price ?>', '<?php echo $items['type_id'] ?>', '<?php echo $items['quantity'] ?>', '<?php echo $items['returnable_qty'] ?>', '<?php echo $items['stock_qty']; ?>', '<?php echo $items['tax_percent']; ?>', '<?php echo $items['tax_type']; ?>');" id="return_id<?php echo $items['item_id'] ?>_<?php echo $items['del_detail_id'] ?>" data-toggle="tooltip" title="Return Item"><i class="fa fa-check" style="font-size:20px;color: #24c6c8;"></i></a>
                                                        <span class="label label-warning pull-left" style="display: none" id="confirm_id<?php echo $items['item_id'] ?>_<?php echo $items['del_detail_id'] ?>">Return Quantity confirmed</span>
                                                    <?php } else { ?>
                                                        <span id="Delivered" class="label label-warning pull-left">Returned</span>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <span id="Not_Delivered" class="label label-warning pull-left">Not delivered</span>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                    <tr>
                                <?php
                                    if ($items['returnable_qty'] != 0) {
                                        $flag = 1;
                                    }
                                    $sub_totall = $items['returnable_qty'] * $price;
                                    $qtys = $qtys + $items['returnable_qty'];
                                    $sub_total = $sub_total + round(($items['returnable_qty'] * $price), 2, PHP_ROUND_HALF_UP);

                                    if ($items['returnable_qty']) {
                                        $discount = ROUND($discount + $items['discount_amount'], 2);
                                        $taxx = ROUND($taxx + $items['bd_tax_amount'], 2);
                                    }
                                    $sub_totall_del = $items['delivery_qty'] * $price;
                                    $qtys_del = $qtys_del + $items['delivery_qty'];
                                    $sub_total_del = $sub_total_del + round(($items['delivery_qty'] * $price), 2, PHP_ROUND_HALF_UP);

                                    if ($items['delivery_qty']) {
                                        $discount_del = ROUND($discount_del + $items['discount_amount'], 2);
                                        //$taxx_del = ROUND($taxx_del + $items['bd_tax_amount'], 2);
                                        $taxx_del = ROUND($taxx_del +  ($items['tax_percent'] / 100 * $sub_totall_del), 2);
                                    }

                                    $sub_totall_order = $items['quantity'] * $price;
                                    $qtys_order = $qtys_order + $items['quantity'];
                                    $sub_total_order = $sub_total_order + round(($items['quantity'] * $price), 2, PHP_ROUND_HALF_UP);

                                    if ($items['quantity']) {
                                        $discount_order = ROUND($discount_order + $items['discount_amount'], 2);
                                        $taxx_order = ROUND($taxx_order + $items['bd_tax_amount'], 2);
                                    }
                                }
                            }
                                ?>

                                <?php
                                $sub_total_after_discount = $sub_total - $discount;
                                //                                $sub_total = $details_data[0]['bill_subtotal'];
                                $taxx = round($taxx, 2);

                                $total_amt = $sub_total_after_discount + $taxx + $bill_round_off;
                                $final_amount = ROUND($total_amt);
                                $roundoff = round($final_amount - $total_amt, 2);
                                //delivff = round($final_amount - $total_amt, 2);
                                //delivery details
                                $sub_total_after_discount_del = $sub_total_del - $discount_del;
                                //                                $sub_total = $details_data[0]['bill_subtotal'];
                                $taxx_del = round($taxx_del, 2);


                                $total_amt_del = $sub_total_after_discount_del + $taxx_del;
                                $final_amount_del = ROUND($total_amt_del);
                                $roundoff_del = round($final_amount_del - $total_amt_del, 2);
                                //                                $discount = $details_data[0]['bill_discount'];

                                //Order or OH Kit Bill details
                                $sub_total_after_discount_order = $sub_total_order - $discount_order;
                                //                                $sub_total = $details_data[0]['bill_subtotal'];
                                $taxx_order = round($taxx_order, 2);

                                $total_amt_order = $sub_total_after_discount_order + $taxx_order + $bill_round_off;
                                $final_amount_order = ROUND($total_amt_order);
                                $roundoff_order = round($final_amount_order - $total_amt_order, 2) + $bill_round_off;

                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="itemdata" id="itemdata" value="" />
</div>
<div class="col-lg-12">
    <div id="student-data-container"></div>
</div>
<?php if ($details_data[0]['is_return'] != 1) { ?>
    <div id="saving_values" style="">
        <h3>Return Items Summary</h3>


        <div class="row">
            <div class="col-md-4">
                <b> Total Quantity</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_qty" value="<?php echo $qtys ?>" />
                </div>
            </div>
            <div class="col-md-4">
                <b> Payback Amount</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="bill_final_pay_amount" id="bill_final_pay_amount" value="<?php echo $bill_final_pay_amount ?>" />
                </div>
            </div>

        </div>
    </div>
<?php } ?>
<!--<div class="" id="incoming_values" >
    <h3>Delivered Items Summary</h3>-->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Delivered Items Summary

            </div>
            <div class="panel-body">
                <div class="title-action" style="text-align: right;padding-top: 0px; padding-bottom: 10px;">

                    <!--<div class="row">-->
                    <div class="col-lg-6">
                        <table class="table table-hover margin bottom">

                            <tbody>
                                <tr>
                                    <td><b>Total Quantity</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $qtys_del; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Sub Total</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <td> <b>Discount</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center">-</td>
                                </tr>
                                <?php if ($details_data[0]['is_return'] == 1) { ?>
                                    <tr>

                                        <td> <b>Payback Amount</b>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center small"></td>
                                        <td class="text-center"><?php echo $bill_final_pay_amount ?></td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-hover margin bottom">

                            <tbody>
                                <tr>
                                    <td> <b>Sub Total After Discount</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center">-</td>

                                </tr>
                                <tr>
                                    <td> <b><?php echo TAXNAME  ?></b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center">-</td>

                                </tr>

                                <tr>

                                    <td> <b>Total</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center">-</td>

                                </tr>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Billed Items Summary

            </div>
            <div class="panel-body">
                <div class="title-action" style="text-align: right;padding-top: 0px; padding-bottom: 10px;">





                    <!--<div class="row">-->
                    <div class="col-lg-6">
                        <table class="table table-hover margin bottom">

                            <tbody>
                                <tr>

                                    <td><b>Total Quantity</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $qtys_order; ?></td>

                                </tr>
                                <tr>

                                    <td><b>Sub Total</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $sub_total_order + $roundoff_order; ?></td>

                                </tr>
                                <tr>

                                    <td> <b>Discount</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $discount_order; ?></td>

                                </tr>
                                <tr>

                                    <td> <b>Paid Amount</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $bill_final_pay_amount ?></td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-hover margin bottom">

                            <tbody>
                                <tr>
                                    <td> <b>Sub Total After Discount</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $sub_total_after_discount_order + $roundoff_order; ?></td>

                                </tr>
                                <tr>
                                    <td> <b><?php echo TAXNAME  ?></b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $taxx_order; ?></td>

                                </tr>

                                <tr>

                                    <td> <b>Total</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $final_amount_order; ?></td>

                                </tr>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="" id="qty1" value="<?php echo $qtys ?>" />
<input type="hidden" name="" id="disc1" value="<?php echo $discount ?>" />
<input type="hidden" name="" id="sub_total" value="<?php echo $sub_total_order ?>" />
<input type="hidden" name="" id="total_before_roundoff" value="<?php echo $sub_total_after_discount_order ?>" />
<input type="hidden" name="" id="tax" value="<?php echo $taxx_order ?>" />
<input type="hidden" name="" id="return_roundoff" value="<?php echo $roundoff_order ?>" />
<input type="hidden" name="" id="net_value" value="<?php echo $final_amount_order ?>" />
<input type="hidden" name="" id="pay_back_amount" value="<?php echo $bill_final_pay_amount ?>" />
<input type="hidden" name="flag_id" id="flag_id" value="<?php echo $flag ?>" />




<script>
    <?php if ($flag == 0) { ?>
        //$('#submit_return').hide();
        //$('#OH_return').hide();
    <?php }
    ?>

    <?php if ($details_data[0]['type'] == 3) { ?>
        // $('#saving_values').show();
        // $('#total_qty').val($('#qty1').val());
        // $('#sub_total_disp').val(parseInt($('#sub1').val()) + parseInt($('#round1').val()));
        // $('#sub_total').val($('#sub1').val());
        // $('#discount').val($('#disc1').val());
        // $('#sub_aftr_discount_disp').val(parseInt($('#sub1').val()) + parseInt($('#round1').val()));
        // $('#sub_aftr_discount').val($('#sub_aftr_dis1').val());
        // $('#tax').val($('#vat1').val());
        // $('#round_off').val($('#round1').val());
        // $('#net_value').val($('#net1').val());
    <?php
    } else {
    ?>
        //$('#saving_values').hide();
    <?php
    }
    ?>



    $(document).ready(function() {

        $('.ScrollStyle').slimscroll({
            height: '150px'
        })
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    var table = $('#tbl_item').dataTable({
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
                "width": "20%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 4
            },
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






    function uniform_submit_data_OH(delivery_id, delivery_number) {
        $('#OH_return').prop('disabled', true);
        var cur_itemdata = $('#itemdata').val();
        var student_id = $('#student_id').val();
        var sub_total = $('#sub_total').val();
        var tax = $('#tax').val();
        var net_value = $('#net_value').val();
        var pay_back_amount = $('#pay_back_amount').val();
        var total_before_roundoff = $('#total_before_roundoff').val();
        var return_roundoff = $('#return_roundoff').val();

        var reason = $('#reason').val();
        if (reason.length == 0) {
            swal('', 'Enter reason for returning ', 'info');
            return false;
        }

        var ops_url = baseurl + 'uniform/delivery/deliveryOHReturn-save/';
        swal({
            title: "Are you sure?",
            text: "Do you want to return the quantities of Delivery : " + delivery_number + " ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#23C6C8',
            confirmButtonText: 'Yes',
            cancelButtonText: "No!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "delivery_id": delivery_id,
                        "student_id": student_id,
                        "sub_total": sub_total,
                        "tax": tax,
                        "net_value": net_value,
                        "pay_back_amount": pay_back_amount,
                        "reason": reason,
                        "return_roundoff": return_roundoff,
                        "total_before_roundoff": total_before_roundoff
                    },
                    success: function(result_s) {
                        try {
                            var data = JSON.parse(result_s);
                            if (data.status == 1) {
                                swal('Success', data.message, 'success');

                                //                                select_items(delivery_id);
                                uniform_deliveryreturn();
                                //                                    delivery_student();
                            } else if (data.status == 2) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while saving OH return. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                    return false;
                                }
                            } else {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while saving OH return. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                    return false;
                                }
                            }
                        } catch (e) {
                            console.log(result);
                            swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRUIJSNER10002', 'info');
                        }
                    }
                });
            }
        });
    }
</script>