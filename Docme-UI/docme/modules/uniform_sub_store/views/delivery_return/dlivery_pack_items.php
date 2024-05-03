<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Return Details - <?php if ($details_data[0]['type'] == 1) {
                                                                        echo $details_data[0]['billing_code'];  ?>
                    <span id="type" class="label label-info pull-right">LOOSE PACKING</span> <?php } ?>
            </div>
            <div class="panel-body">
                <div class="title-action" style="text-align: right;padding-top: 0px; padding-bottom: 10px;">


                    <?php if ($details_data[0]['type'] == 3) { ?>
                        <a href="javascript:void(0)" id="OH_return" onclick="uniform_submit_data_OH('<?php echo $details_data[0]['id']; ?>', '<?php echo $details_data[0]['delivery_number']; ?>')" class="btn btn-primary"> Confirm OH Return </a>
                    <?php } else { ?>
                        <a href="javascript:void(0)" id="submit_return" onclick="uniform_submit_data('<?php echo $details_data[0]['id']; ?>', '<?php echo $details_data[0]['delivery_number']; ?>')" class="btn btn-primary"> Confirm Delivery Return </a>
                    <?php } ?>
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
                                                                                                                                                                                            ?> value="<?php echo $details_data[0]['reason'] ?>" <?php
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
                            ?>
                            <?php
                            if (isset($details_data) && !empty($details_data)) {

                                //                                
                                foreach ($details_data as $items) {
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

                                    $qtys = $qtys + $items['quantity'];
                                    $sub_total_after_discount = $sub_total_after_discount + $items['sub_total_after_discount'];
                                }
                            }
                                ?>

                                <?php
                                $sub_total = $details_data[0]['bill_subtotal'];
                                $taxx = $details_data[0]['bill_tax_amount'];
                                $total_amt = $details_data[0]['bill_total_amt'];
                                $final_amount = $details_data[0]['bill_finaltotal'];
                                $roundoff = $details_data[0]['bill_roundoff'];
                                $discount = $details_data[0]['bill_discount'];
                                $max_pay_back_amount = $details_data[0]['final_pay_amount'];
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

<div id="saving_values" style="">
    <h3>Return Items Summary</h3>


    <div class="row">
        <div class="col-md-4">
            <b> Total Quantity</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_qty" value="0" />
            </div>
        </div>
        <div class="col-md-4">
            <b> Sub Total</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="sub_total" id="sub_total" value="0" />
            </div>
        </div>
        <div class="col-md-4">
            <b> Discount</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="" id="discount" value="0" />
            </div>
        </div>
        <div class="col-md-4">
            <b> Sub Total After Discount</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="" id="sub_aftr_discount" value="0" />
            </div>
        </div>

        <div class="col-md-4">
            <b><?php echo TAXNAME ?></b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="tax" id="tax" value="0" />
            </div>
        </div>
        <div class="col-md-4">
            <b>Total</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="net_value" id="net_value" value="0" />
            </div>
        </div>
        <div class="col-md-4">
            <b>Payback Amount</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="pay_back_amount" id="pay_back_amount" value="0" />
            </div>
        </div>
    </div>
</div>
<!--<div class="" id="incoming_values" >
    <h3>Delivered Items Summary</h3>-->

<div class="" id="incoming_values" style="display : none">
    <h3>Delivered Items Summary</h3>

    <div class="row">
        <div class="col-md-4">
            <b> Total Quantity</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="" id="qty1" value="<?php echo $qtys ?>" />
            </div>
        </div>
        <div class="col-md-4">
            <b> Discount</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="" id="disc1" value="<?php echo $discount ?>" />
            </div>
        </div>
        <div class="col-md-4">
            <b> Sub Total</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="" id="sub1" value="<?php echo $sub_total ?>" />
            </div>
        </div>
        <div class="col-md-4">
            <b> Sub Total After Discount</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="" id="sub_aftr_dis1" value="<?php echo $sub_total_after_discount ?>" />
            </div>
        </div>

        <div class="col-md-4">
            <b><?php echo TAXNAME ?></b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="" id="vat1" value="<?php echo $taxx ?>" />
            </div>
        </div>
        <div class="col-md-4">
            <b>Total</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="" id="net1" value="<?php echo $final_amount ?>" />
            </div>
        </div>
    </div>
</div>


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
                                    <td class="text-center"><?php echo $qtys; ?></td>

                                </tr>
                                <tr>

                                    <td><b>Sub Total</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $sub_total; ?></td>

                                </tr>
                                <tr>

                                    <td> <b>Discount</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $discount; ?></td>

                                </tr>

                                <tr>

                                    <td> <b></b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"></td>

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
                                    <td class="text-center"><?php echo $sub_total_after_discount; ?></td>

                                </tr>
                                <tr>
                                    <td> <b><?php echo TAXNAME  ?></b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $taxx; ?></td>

                                </tr>

                                <tr>

                                    <td> <b>Round Off</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $roundoff; ?></td>

                                </tr>

                                <tr>

                                    <td> <b>Total</b>
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center small"></td>
                                    <td class="text-center"><?php echo $final_amount; ?></td>

                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<input type="hidden" name="flag_id" id="flag_id" value="<?php echo $flag ?>" />
<input type="hidden" name="max_pay_back_amount" id="max_pay_back_amount" value="<?php echo $max_pay_back_amount ?>" />
<input type="hidden" name="return_roundoff" id="return_roundoff" value="0" />
<input type="hidden" name="total_before_roundoff" id="total_before_roundoff" value="0" />




<script>
    <?php if ($flag == 0) { ?>
        $('#submit_return').hide();
        $('#OH_return').hide();
        $('#reason').attr("disabled", "disabled");
    <?php }
    ?>

    <?php if ($details_data[0]['type'] == 3) { ?>
        $('#saving_values').show();
        $('#total_qty').val($('#qty1').val());
        $('#sub_total').val($('#sub1').val());
        $('#discount').val($('#disc1').val());
        $('#sub_aftr_discount').val($('#sub_aftr_dis1').val());
        $('#tax').val($('#vat1').val());
        $('#net_value').val($('#net1').val());
    <?php
    } else {
    ?>
        $('#saving_values').hide();
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



    function uniform_return_item(del_detail_id, item_id, price, type_id, qty, delivery_qty, available_qty, tax_percent, tax_type) {

        $('#saving_values').show();
        var return_qty_id = '#return_qty_' + item_id + '_' + del_detail_id;
        var return_id = '#return_id' + item_id + '_' + del_detail_id;
        var confirm_id = '#confirm_id' + item_id + '_' + del_detail_id;
        //        alert(confirm_id);
        var return_qty = parseFloat($(return_qty_id).val());
        var return_value = $(return_qty_id).val();
        if (return_qty.length == 0) {
            swal('', 'Enter return quantity', 'info');
            return false;
        }

        if (return_qty % 1) {
            var decimal = (return_qty.toString().split(".")[1]);
            if (decimal.length > 2) {
                swal('', 'Quantity restricted to 2 decimal points', 'info');
                return false;
            }
        }
        if (return_value.length == 0) {
            swal('', 'Enter valid quantity', 'info');
            return false;
        }

        if (return_qty > delivery_qty) {
            swal('', 'Return quantity must be less than or equal to delivered quantity', 'info');
            return false;
        }
        if (return_qty <= 0) {
            swal('', 'Return quantity must be a positive integer less than or equal to delivered quantity', 'info');
            return false;
        }
        var pack_id = $('#pack_id').val();
        var delivery_id = $('#delivery_id').val();



        var flag = 0;
        var cur_itemdata = $('#itemdata').val();
        if (!(cur_itemdata.length == 0)) {
            var cur_item_obj = JSON.parse(cur_itemdata);
            $.each(cur_item_obj, function(i, v) {
                if (v == item_id) {
                    flag = 1;
                }
            });
        }
        if (flag == 1) {
            swal('', 'Item already exist in selected list ', 'info');
            return false;
        } else {
            var item_id = item_id;
            var dTable = $('#tbl_item').DataTable();
            var cur_itemdata = $('#itemdata').val();
            if (cur_itemdata.length > 0) {
                var cur_item_obj = JSON.parse(cur_itemdata);
            } else {
                var cur_item_obj = [];
            }

            var r_tax = 0;
            if (tax_type == 'P') {
                var r_tax = ((parseFloat(price) * parseFloat(return_qty)) * tax_percent) / 100;
            } else {
                var r_tax = tax_percent * return_qty;
            }

            if (r_tax) {
                r_tax = r_tax;
            } else {
                r_tax = 0;
            }


            cur_item_obj.push({
                item_id: item_id,
                price: price,
                available_qty: delivery_qty,
                return_qty: return_qty,
                item_tax: r_tax
            });
            var jsonitem = JSON.stringify(cur_item_obj)

            $('#itemdata').val(jsonitem);

            r_tax = 0;

            var del_subtotal = $('#sub_total').val();
            del_subtotal = parseFloat(del_subtotal) + (parseFloat(price) * parseFloat(return_qty))
            del_subtotal = del_subtotal.toFixed(2);
            $('#sub_total').val(del_subtotal);
            $('#sub_aftr_discount').val(del_subtotal);

            var total_qty = $('#total_qty').val();
            total_qty = parseFloat(total_qty) + parseFloat(return_qty);
            total_qty = total_qty.toFixed(2);
            $('#total_qty').val(total_qty);

            var del_total = $('#net_value').val();

            var taxxx = $('#tax').val();




            if (tax_type == 'P') {
                var r_tax = ((parseFloat(price) * parseFloat(return_qty)) * parseFloat(tax_percent)) / 100;
            } else {
                var r_tax = tax_percent * return_qty;
            }

            if (r_tax) {
                r_tax = r_tax;
            } else {
                r_tax = 0;
            }
            $(return_qty_id).attr('readonly', 'true');


            var taxxx = parseFloat(taxxx) + parseFloat(r_tax);
            taxxx = parseFloat(taxxx.toFixed(2));
            del_total = parseFloat(del_subtotal) + parseFloat(taxxx);


            $('#tax').val(taxxx);


            var net_val_after_tax = parseFloat(del_total);
            var value_after_cal_tax = parseFloat(net_val_after_tax.toFixed(2));
            var rounded_total = parseFloat(net_val_after_tax.toFixed());

            var round_off = parseFloat(rounded_total) - parseFloat(value_after_cal_tax);
            round_off = round_off.toFixed(2);
            var max_pay_back_amount = parseFloat($('#max_pay_back_amount').val());
            var pay_back_amount;
            if (rounded_total > max_pay_back_amount) {
                pay_back_amount = max_pay_back_amount;
            } else {
                pay_back_amount = rounded_total;
            }

            $("#roundoff").val(round_off);
            $("#return_roundoff").val(round_off);
            $('#net_value').val(rounded_total);
            $('#pay_back_amount').val(pay_back_amount);
            $('#total_before_roundoff').val(value_after_cal_tax);
        }

        $(return_id).hide();
        $(confirm_id).show();

    }



    function uniform_submit_data(delivery_id, delivery_number) {
        $('#submit_return').prop('disabled', true);

        var cur_itemdata = $('#itemdata').val();
        if (cur_itemdata.length == 0) {
            swal('', 'Please add atleast one item ', 'info');
            return false;
        }
        var sub_total = $('#sub_total').val();
        var student_id = $('#student_id').val();
        var tax = $('#tax').val();
        var net_value = $('#net_value').val();
        var pay_back_amount = $('#pay_back_amount').val();
        var total_before_roundoff = $('#total_before_roundoff').val();
        var return_roundoff = $('#return_roundoff').val();

        var reason = $('#reason').val();
        if ($('#reason').val().trim().length == 0) {
            swal('', 'Enter valid reason for returning ', 'info');
            return false;
        }

        var ops_url = baseurl + 'uniform/delivery/deliveryReturn-save/';
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
                        "delivery_data": cur_itemdata,
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
                                    swal('', 'An error occurred while saving delivery return. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                    return false;
                                }
                            } else {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while saving delivery return. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
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

    function uniform_submit_data_OH(delivery_id, delivery_number) {
        $('#OH_return').prop('disabled', true);
        var cur_itemdata = $('#itemdata').val();
        var sub_total = $('#sub_total').val();
        var student_id = $('#student_id').val();
        var tax = $('#tax').val();
        var net_value = $('#net_value').val();

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
                        "reason": reason
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