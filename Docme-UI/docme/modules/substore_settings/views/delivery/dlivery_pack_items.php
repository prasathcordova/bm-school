<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Pack Details - <?php echo $details_data[0]['delivery_number']; ?>

                <?php if ($details_data[0]['is_delivery_cosed'] != 0) { ?>
                    <span style="float: right;padding-top: 0px;">
                        <a href="javascript:void(0);" style="padding-top: 0px;" id="print_delivery" data-toggle="tooltip" title="Print of <?php echo $details_data[0]['delivery_number']; ?> " onclick="print_data('<?php echo $details_data[0]['id']; ?>')" class="btn btn-primary"> <i class="fa fa-print" style="color: white;font-size: 16px;"></i> </a>
                    </span>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="title-action" style="text-align: right;padding-top: 0px; padding-bottom: 10px;">
                    <?php $set_flag = 0; ?>

                    <?php if ($details_data[0]['is_delivery_cosed'] == 0) { ?>
                        <?php if ($details_data[0]['type'] == 3) { ?>

                        <?php } ?>
                        <a href="javascript:void(0);" id="save_delivery" onclick="submit_data('<?php echo $details_data[0]['id']; ?>', '<?php echo $details_data[0]['delivery_number']; ?>')" class="btn btn-primary"> Confirm Delivery </a>
                        <input type="hidden" class="input form-control" id="pack_id" name="pack_id" value="<?php echo $details_data[0]['pack_id'] ?>">
                        <input type="hidden" class="input form-control" id="delivery_id" name="delivery_id" value="<?php echo $delivery_id ?>">
                        <input type="hidden" class="input form-control" id="student_id" name="student_id" value="<?php echo $student_id ?>">
                        <input type="hidden" class="input form-control" id="emp_id" name="emp_id" value="<?php echo $emp_id ?>">
                    <?php } ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_class_item">
                        <thead>
                            <tr>
                                <th>Items Name</th>
                                <th>Ordered Quantity</th>
                                <th>Pending Quantity</th>
                                <th>Delivered Quantity</th>
                                <th>Available Stock</th>
                                <th>Task</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($details_data) && !empty($details_data)) {

                                foreach ($details_data as $items) {
                                    $temp[] = $items['item_id'];
                                    $price = (isset($items['rate']) && !empty($items['rate']) && $items['rate'] != NULL) ? $items['rate'] : $items['selling_price']
                            ?>

                                    <tr>
                                        <td><?php echo $items['item_name']; ?></td>
                                        <td><?php echo $items['quantity']; ?></td>
                                        <td><?php echo $items['pending_qty']; ?>
                                            <input type="hidden" id="item_pend<?php echo $items['item_id'] ?>" value="<?php echo $items['pending_qty'] ?>">
                                        </td>
                                        <td><?php echo $items['delivery_qty']; ?></td>
                                        <td><?php echo $items['stock_qty']; ?>
                                            <input type="hidden" id="item_stock<?php echo $items['item_id'] ?>" value="<?php echo $items['stock_qty'] ?>">
                                        </td>
                                        <!--<td></td>-->
                                        <td>
                                            <?php if ($items['type'] == 1 || $items['type'] == 2) { ?>
                                                <?php if ($items['delivery_qty'] != $items['quantity']) { ?>

                                                    <?php if ($items['delivery_qty'] == 0) { ?>
                                                        <a href="javascript:void(0)" onclick="replace_item('<?php echo $items['del_detail_id'] ?>', '<?php echo $items['item_id'] ?>', '<?php echo $price ?>', '<?php echo $items['type_id'] ?>', '<?php echo $items['quantity'] ?>', '<?php echo $items['pending_qty']; ?>');" data-toggle="tooltip" title="Replace Item"><i class="fa fa-exchange"></i></a>
                                                    <?php } ?>



                                                    <?php if ($items['pending_qty'] != 0) { ?>
                                                        <span id="Delivered" class="label label-warning pull-left">Pending</span>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <span id="Delivered" class="label label-warning pull-left">Delivered</span>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($items['is_return'] == 0) { ?>
                                                    <?php if ($items['delivery_qty'] == 0) { ?>
                                                        <a href="javascript:void(0)" onclick="replace_item('<?php echo $items['del_detail_id'] ?>', '<?php echo $items['item_id'] ?>', '<?php echo $price ?>', '<?php echo $items['type_id'] ?>', '<?php echo $items['quantity'] ?>', '<?php echo $items['pending_qty']; ?>');" data-toggle="tooltip" title="Replace Item"><i class="fa fa-exchange"></i></a>
                                                        <?php if ($items['pending_qty'] != 0) { ?>
                                                            <span id="Delivered" class="label label-warning pull-left">Pending</span>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if ($items['pending_qty'] != 0) { ?>
                                                            <span id="Delivered" class="label label-warning pull-left">Pending</span>
                                                        <?php } else { ?>
                                                            <span id="Delivered" class="label label-warning pull-left">Delivered</span>
                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    echo '<span id="Delivered" title="OH returned,cannot deliver" class="label label-warning pull-left" >OH returned</span>';
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <?php
                                    if ($details_data[0]['is_delivery_cosed'] == 0) {

                                        if ($items['quantity'] - $items['delivery_qty'] != 0) {
                                            if ($items['stock_qty'] == 0) {
                                                if ($items['pending_qty'] != 0) {
                                                    $set_flag = 1;
                                                }
                                            }
                                        }
                                    }
                                    ?>


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
<div class="col-lg-12">
    <div id="student-data-container"></div>
</div>


<input type="hidden" name="itemdata" id="itemdata" value="" />
<input type="hidden" name="item_id" id="item_id" value="<?php echo json_encode($temp); ?>" />
<input type="hidden" name="set_flag" id="set_flag" value="<?php echo $set_flag ?>" />




<script>
    $(document).ready(function() {

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
        responsive: false,
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



    function replace_item(del_detail_id, item_id, price, type_id, qty, pending_qty) {
        if (pending_qty == 0) {
            var replace_qty = qty;
        } else {
            var replace_qty = pending_qty;
        }
        var pack_id = $('#pack_id').val();
        var delivery_id = $('#delivery_id').val();
        var ops_url = baseurl + 'substore/delivery-item-replace';


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "del_detail_id": del_detail_id,
                "item_id": item_id,
                "price": price,
                "type_id": type_id,
                "pack_id": pack_id,
                "qty": replace_qty,
                "delivery_id": delivery_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#item-replace-container').html('');
                    $('#item-replace-container').html(data.view);
                    var animation = "fadeInDown";
                    $("#item-replace-container").show();
                    $('#item-replace-container').addClass('animated');
                    $('#item-replace-container').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });

    }



    function submit_data(delivery_id, delivery_number) {

        var item_id = $('#item_id').val();
        var flag_set = 0
        var stock_flag = 0
        var cur_item_obj = JSON.parse(item_id);
        var set_flag = $('#set_flag').val();
        var table = $('#tbl_class_item').DataTable();
        $.each(cur_item_obj, function(i, v) {
            var item_stock = '#item_stock' + v;
            var item_pend = '#item_pend' + v;
            if ((table.$(item_stock).val() > 0) && (table.$(item_pend).val() > 0)) {
                flag_set = 1;
            }

        });
        $.each(cur_item_obj, function(i, v) {
            var item_stock_set = '#item_stock' + v;
            if ((table.$(item_stock_set).val())) {
                stock_flag = parseFloat(table.$(item_stock_set).val()) + parseFloat(stock_flag);
            }

        });
        if ((set_flag == 1) && (flag_set == 0)) {

            swal('', 'No items available to deliver..', 'info');
            return false;
        }
        if ((stock_flag == 0)) {
            swal('', 'No items available to deliver..', 'info');
            return false;

        }
        $('#save_delivery').prop('disabled', true);

        var studentid = $('#student_id').val();

        var emp_id = $('#emp_id').val();
        var ops_url = baseurl + 'delivery/delivery-save/';
        swal({
            title: "Are you sure?",
            text: "Do you want to save the Delivery : " + delivery_number + " ?",
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
                        "delivery_id": delivery_id
                    },
                    success: function(result_s) {
                        //try {
                        var data = JSON.parse(result_s);
                        if (data.status == 1) {
                            var studentid = $('#student_id').val();
                            if (studentid != 0) {
                                show_detail_delivery(studentid);
                                select_items_delivery(delivery_id);
                            }

                            if (emp_id != 0) {
                                delivery_faculty(emp_id);
                                select_items(delivery_id)
                            }
                            swal('Success', 'Delivery saved successfully for items having stock.Refer details for pending delivery', 'success');
                            if (data.delv_print_link) {
                                window.open(data.delv_print_link, '_blank');
                            }


                        } else if (data.status == 2) {
                            if (data.message) {
                                swal('', data.message, 'info');
                                return false;
                            } else {
                                swal('', 'An error occurred while saving delivery. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                return false;
                            }
                        } else {
                            if (data.message) {
                                swal('', data.message, 'info');
                                return false;
                            } else {
                                swal('', 'An error occurred while saving delivery. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                return false;
                            }
                        }
                        //} catch (e) {
                        //console.log(result_s);
                        // swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRUIJSNER10002', 'info');
                        // }
                    }
                });
            }
        });
    }

    function show_detail_delivery(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'sales/show-studentdelivery/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html('');
                        $('#data-view').html(data.view);
                        $('html, body').animate({
                            scrollTop: $("#data-view").offset().top
                        }, 1000);
                    }

                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    function print_data(delivery_id) {
        var ops_url = baseurl + 'delivery/delivery-note-print/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "delivery_id": delivery_id
            },
            success: function(result_s) {
                try {
                    var data = JSON.parse(result_s);
                    if (data.status == 1) {
                        if (data.delv_print_link) {
                            window.open(data.delv_print_link, '_blank');
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while printing delivery. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                            return false;
                        }
                    }
                } catch (e) {
                    console.log(result_s);
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DLVRUI10002', 'info');
                }
            }
        });
    }

    function replace_OH(template_config_id, template_id) {
        var pack_id = $('#pack_id').val();
        var delivery_id = $('#delivery_id').val();
        var ops_url = baseurl + 'delivery/delivery-OHtemplate-replace';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "template_config_id": template_config_id,
                "template_id": template_id,
                "pack_id": pack_id,
                "delivery_id": delivery_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#item-replace-container').html('');
                    $('#item-replace-container').html(data.view);
                    var animation = "fadeInDown";
                    $("#item-replace-container").show();
                    $('#item-replace-container').addClass('animated');
                    $('#item-replace-container').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });

    }
</script>