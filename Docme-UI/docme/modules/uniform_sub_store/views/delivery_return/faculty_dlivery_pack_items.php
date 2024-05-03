<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Return Details - <?php if ($details_data[0]['type'] == 2) {
                                                                        echo $details_data[0]['billing_code'];  ?>
                    <span id="type" class="label label-info pull-right">SPECIMEN PACKING</span> <?php } ?>

            </div>
            <div class="panel-body">
                <div class="title-action" style="text-align: right;padding-top: 0px; padding-bottom: 10px;">
                    <?php // echo $details_data[0]['is_delivery_cosed']; 
                    ?>
                    <?php // if ($details_data[0]['is_delivery_cosed'] == 0) { 
                    ?>
                    <a href="javascript:void(0)" id="submit_id" onclick="uniform_submit_data('<?php echo $details_data[0]['id']; ?>', '<?php echo $details_data[0]['delivery_number']; ?>')" class="btn btn-primary"> Confirm Delivery Return </a>
                    <input type="hidden" class="input form-control" id="pack_id" name="pack_id" value="<?php echo $details_data[0]['pack_id'] ?>">
                    <input type="hidden" class="input form-control" id="delivery_id" name="delivery_id" value="<?php echo $delivery_id ?>">
                    <input type="hidden" class="input form-control" id="emp_id" name="emp_id" value="<?php echo $emp_id ?>">
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
                                <th>Delivered Quantity</th>
                                <th>Available Stock</th>
                                <th>Return Quantity</th>
                                <th>Confirm Item</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $qtys = 0;
                            $sub_total = 0;
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
                                foreach ($details_data as $items) {
                                    $price = (isset($items['rate']) && !empty($items['rate']) && $items['rate'] != NULL) ? $items['rate'] : $items['selling_price']
                            ?>

                                    <tr>
                                        <td><?php echo $items['item_name']; ?></td>
                                        <td><?php echo $items['quantity']; ?></td>
                                        <td><?php echo $items['pending_qty']; ?></td>
                                        <td><?php echo isset($items['returnable_qty']) && !empty($items['returnable_qty']) ? $items['returnable_qty'] : 0;
                                            ?></td>
                                        <td><?php echo $items['stock_qty']; ?></td>
                                        <td><input type="number" style="background-color: white" size="3" <?php if ($items['returnable_qty'] == 0) { ?> disabled="" <?php } ?> class="form-control" name="return_qty" id="return_qty_<?php echo $items['item_id'] ?>" /></td>
                                        <!--<td></td>-->
                                        <td>
                                            <?php if ($items['is_delivered'] == 1) { ?>
                                                <?php
                                                if ($items['delivery_qty'] != 0 || $items['returnable_qty'] > 0) {
                                                    if ($items['returnable_qty'] == 0) {
                                                        echo '<span id = "Delivered" class = "label label-warning pull-left" >Returned</span>';
                                                    } else {
                                                ?>
                                                        <a href="javascript:void(0)" onclick="uniform_return_item('<?php echo $items['item_id'] ?>', '<?php echo $price ?>', '<?php echo $items['type_id'] ?>', '<?php echo $items['quantity'] ?>', '<?php echo $items['returnable_qty'] ?>', '<?php echo $items['stock_qty']; ?>', '<?php echo $items['tax_percent']; ?>', '<?php echo $items['tax_type']; ?>');" id="return_id<?php echo $items['item_id'] ?>" data-toggle="tooltip" title="Return Item"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>
                                                        <span class="label label-warning pull-left" style="display: none" id="confirm_id<?php echo $items['item_id'] ?>">Return Quantity confirmed</span>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <span id="Delivered" class="label label-warning pull-left">Returned</span>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <span id="Not_Delivered" class="label label-warning pull-left">Not delivered</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            <?php
                                    if ($items['returnable_qty'] != 0) {
                                        $flag = 1;
                                    }
                                    if ($items['delivery_qty'] != 0) {

                                        if ($items['delivery_qty'] == $items['quantity']) {

                                            $qtys = $qtys + $items['quantity'];

                                            if ($items['tax_type'] == 'P') {
                                                $taxpercent = (($items['quantity'] * $price) * $items['tax_percent']) / 100;
                                            } else {
                                                $taxpercent = $items['quantity'] * $items['tax_percent'];
                                            }

                                            $taxx = $taxx + $taxpercent;

                                            $sub_total = $sub_total + ($items['quantity'] * $price);
                                            //                                    $taxpercent = $taxpercent + $items['tax_percent'];
                                            $total_amt = $sub_total + $taxx;
                                        } else {

                                            $qtys = $qtys + ($items['delivery_qty']);

                                            if ($items['tax_type'] == 'P') {
                                                $taxpercent = ((($items['delivery_qty']) * $price) * $items['tax_percent']) / 100;
                                            } else {
                                                $taxpercent = ($items['delivery_qty']) * $items['tax_percent'];
                                            }

                                            $taxx = $taxx + $taxpercent;

                                            $sub_total = $sub_total + (($items['delivery_qty']) * $price);

                                            $total_amt = $sub_total + $taxx;
                                        }
                                    }
                                }
                            }
                            ?>

                            <?php
                            $taxx = round($taxx, 2);

                            $final_amount = round($total_amt);
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
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="total_qty" id="total_qty" value="0" />
            </div>
        </div>
        <div class="col-md-4">
            <b> Sub Total</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="sub_total" id="sub_total" value="0" />
            </div>
        </div>
        <!--                <div class="col-md-4" >
                            <b> Discount</b>
                            <div class="form-group">
                                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="discount" id="discount" value="0" />
                            </div>
                        </div> -->
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
    </div>
</div>
<div id="incoming_values" style="">
    <h3>Delivered Items Summary</h3>
    <div class="row">

        <div class="col-md-4">
            <b> Total Quantity</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="total_qty" id="" value="<?php echo $qtys ?>" />
            </div>
        </div>
        <div class="col-md-4">
            <b> Sub Total</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="sub_total" id="" value="<?php echo $sub_total ?>" />
            </div>
        </div>
        <!--                <div class="col-md-4" >
                            <b> Discount</b>
                            <div class="form-group">
                                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="discount" id="discount" value="0" />
                            </div>
                        </div> -->
        <div class="col-md-4">
            <b><?php echo TAXNAME ?></b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="tax" id="" value="<?php echo $taxx ?>" />
            </div>
        </div>
        <div class="col-md-4">
            <b>Total</b>
            <div class="form-group">
                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="net_value" id="" value="<?php echo $final_amount ?>" />
            </div>
        </div>
    </div>
</div>


<!--<input type="hidden" name="itemdata" id="itemdata" value="" />-->

<input type="hidden" name="return_roundoff" id="return_roundoff" value="0" />
<input type="hidden" name="total_before_roundoff" id="total_before_roundoff" value="0" />




<script>
    <?php if ($flag == 0) { ?>
        $('#submit_id').hide();
        $('#reason').attr("disabled", "disabled");
    <?php }
    ?>
    $('#saving_values').hide();
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
                "width": "10%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 4
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 5
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 6,
                "orderable": false
            }
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



    function uniform_return_item(item_id, price, type_id, qty, delivery_qty, available_qty, tax_percent, tax_type) {
        $('#saving_values').show();
        var return_qty_id = '#return_qty_' + item_id;
        var return_id = '#return_id' + item_id;
        var confirm_id = '#confirm_id' + item_id;
        //        alert(confirm_id);
        var return_qty = parseFloat($(return_qty_id).val());
        var return_value = $(return_qty_id).val();
        if (return_qty.length == 0) {
            swal('', 'Enter return quantity', 'info');
            return false;
        }

        if (/^[+]?\d+(\.\d+)?$/.test(return_qty) == false) {
            swal('', 'Enter valid quantity', 'info');
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

        if (return_qty <= 0) {
            swal('', 'Return quantity must be postive integer less than or equal to delivered quantity', 'info');
            return false;
        }
        if (return_qty > delivery_qty) {
            swal('', 'Return quantity must be less than or equal to delivered quantity', 'info');
            return false;
        }
        var pack_id = $('#pack_id').val();
        var delivery_id = $('#delivery_id').val();
        var total_qty = $('#total_qty').val();

        total_qty = parseFloat(total_qty) + parseFloat(return_qty);
        total_qty = total_qty.toFixed(2);
        $('#total_qty').val(total_qty);

        var r_tax = 0;
        if (tax_type == 'P') {
            var r_tax = ((parseFloat(price) * parseFloat(return_qty)) * tax_percent) / 100;
        } else {
            var r_tax = parseFloat(tax_percent) * parseFloat(return_qty);
        }

        if (r_tax) {
            r_tax = parseFloat(r_tax);
        } else {
            r_tax = 0;
        }


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
            cur_item_obj.push({
                item_id: item_id,
                price: price,
                available_qty: delivery_qty,
                return_qty: return_qty,
                item_tax: r_tax
            });
            var jsonitem = JSON.stringify(cur_item_obj)
            //            alert(jsonitem);
            $('#itemdata').val(jsonitem);



            var del_subtotal = $('#sub_total').val();
            del_subtotal = parseFloat(del_subtotal) + (parseFloat(price) * parseFloat(return_qty))
            del_subtotal = del_subtotal.toFixed(2);
            $('#sub_total').val(del_subtotal);

            var del_total = $('#net_value').val();

            var taxxx = $('#tax').val();




            if (tax_type == 'P') {
                var r_tax = ((parseFloat(price) * parseFloat(return_qty)) * tax_percent) / 100;
            } else {
                var r_tax = parseFloat(tax_percent) * parseFloat(return_qty);
            }

            if (r_tax) {
                r_tax = r_tax;
            } else {
                r_tax = 0;
            }
            r_tax = parseFloat(r_tax.toFixed(2));

            var taxxx = parseFloat(taxxx) + parseFloat(r_tax);
            taxxx = parseFloat(taxxx.toFixed(2));
            $('#tax').val(taxxx);

            del_total = parseFloat(del_subtotal) + taxxx;


            var value_after_cal_tax = parseFloat(del_total.toFixed(2));
            var rounded_total = parseFloat(del_total.toFixed());

            var round_off = parseFloat(rounded_total) - parseFloat(value_after_cal_tax);
            round_off = round_off.toFixed(2);

            $('#net_value').val(rounded_total);
            $('#reminder').val(round_off);

            $("#roundoff").val(round_off);

            $("#return_roundoff").val(round_off);

            $('#total_before_roundoff').val(value_after_cal_tax);

            $(return_qty_id).attr('readonly', 'true');
            //alert(roundoff);


            $('#net_value').val(rounded_total);


        }

        $(return_id).hide();
        $(confirm_id).show();

    }



    function uniform_submit_data(delivery_id, delivery_number) {
        $('#submit_id').prop('disabled', true);
        var cur_itemdata = $('#itemdata').val();
        var total_before_roundoff = $('#total_before_roundoff').val();
        var return_roundoff = $('#return_roundoff').val();
        if (cur_itemdata.length == 0) {
            swal('', 'Please add atleast one item ', 'info');
            return false;
        }
        var sub_total = $('#sub_total').val();
        var emp_id = $('#emp_id').val();
        var tax = $('#tax').val();
        var net_value = $('#net_value').val();

        var reason = $('#reason').val();
        if (reason.length == 0) {
            swal('', 'Enter reason for returning ', 'info');
            return false;
        }

        var ops_url = baseurl + 'uniform/delivery/faculty_deliveryReturn-save/';
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
                        "emp_id": emp_id,
                        "sub_total": sub_total,
                        "tax": tax,
                        "net_value": net_value,
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
                                uniform_specimen_return();
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
</script>