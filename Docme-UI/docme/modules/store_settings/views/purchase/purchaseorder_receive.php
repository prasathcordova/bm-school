<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Save purchase receive" onclick="save_receive_order();"> <i style="font-size: 35px !important;  float: right;color: #23c6c8;" class="material-icons">save</i></a> </span>
                    </div>
                </div>
                <div class="ibox-content ibox-content-new">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Purchase Details</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">Items Receivables</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-3">Order Summary</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    Purchase Details
                                                </div>
                                                <div class="ibox-content">
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                            <label>Purchase Order No:</label>
                                                            <input id="pono" name="pono" placeholder="Order No " readonly="" type="text" class="form-control " value="<?php echo isset($purchase_data['master_data']['purchase_code']) ? $purchase_data['master_data']['purchase_code'] : 0; ?>" />
                                                        </div>
                                                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                            <label> Order Date:</label>
                                                            <input id="podate" name="podate" placeholder="Order Date " readonly="" type="text" class="form-control " value="<?php echo isset($purchase_data['master_data']['purchase_order_date']) ? date('d-m-Y', strtotime($purchase_data['master_data']['purchase_order_date'])) : 'No data available'; ?>" />
                                                        </div>
                                                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                            <label> Supplier :</label>
                                                            <input id="supplier_name" name="supplier_name" placeholder="Supplier Name" data-toggle="tooltip" title="<?php echo isset($purchase_data['master_data']['supplier_data']) ? $purchase_data['master_data']['supplier_data'] : 'No data available'; ?>" readonly="" type="text" class="form-control " value="<?php echo isset($purchase_data['master_data']['supplier_data']) ? $purchase_data['master_data']['supplier_data'] : 'No data available'; ?>" />
                                                        </div>
                                                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                            <label> Supplier Invoice No :</label>
                                                            <input id="suo_invoice" name="suo_invoice" type="text" class="form-control " value="" />
                                                        </div>
                                                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                            <label> Supplier Invoice Date:</label>
                                                            <input id="suo_invoice_date" name="suo_invoice_date" data-disabledata="2" type="text" class="form-control " readonly style="background-color: #fff;" value="" />
                                                        </div>
                                                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                            <label> Delivery Note No:</label>
                                                            <input id="suo_del_note_no" name="suo_del_note_no" type="text" class="form-control " value="">
                                                        </div>

                                                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                            <label> Close Purchase Order</label>
                                                            <div class="i-checks"><label> <input type="checkbox" id="close_order" value=""></label></div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_purchase_invoice_details" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Invoice No</th>
                                                                        <th>Invoice Date</th>
                                                                        <th>Delivery Note</th>
                                                                        <th>Received Qty</th>
                                                                        <th>Received On</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if (isset($purchase_data['invoice_details']) && !empty($purchase_data['invoice_details'])) {
                                                                        foreach ($purchase_data['invoice_details'] as $invoice) {
                                                                    ?>
                                                                            <tr>
                                                                                <td><?php echo $invoice['invoice_rcvd'] ?></td>
                                                                                <td><?php echo $invoice['invoice_date'] ?></td>
                                                                                <td><?php echo $invoice['delivery_note'] ?></td>
                                                                                <td><?php echo $invoice['total_rcv_qty'] ?></td>
                                                                                <td><?php echo date('d-m-Y', strtotime($invoice['createdon'])); ?></td>

                                                                            </tr>

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

                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    Items Pending
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="ibox-content">
                                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_purchase_items_details" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Item Name</th>
                                                                        <th>Item Code</th>
                                                                        <th>Item Barcode</th>
                                                                        <th>Order Qty</th>
                                                                        <th>Received Qty</th>
                                                                        <th>Pending Qty</th>
                                                                        <th>Delivered Qty</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if (isset($purchase_data['item_data']) && !empty($purchase_data['item_data'])) {
                                                                        foreach ($purchase_data['item_data'] as $items) {
                                                                            $pending = 0;
                                                                            $rcved_items = 0;
                                                                            $flag = 0;
                                                                            if (isset($purchase_data['received_data']) && !empty($purchase_data['received_data'])) {
                                                                                foreach ($purchase_data['received_data'] as $rcvd_item) {
                                                                                    if ($rcvd_item['itemid'] == $items['itemid']) {
                                                                                        $pending = $rcvd_item['pending_to_receive_qty'];
                                                                                        $rcved_items = $rcvd_item['rcvd_qty'];
                                                                                        $flag = 1;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                            if ($flag == 0) {
                                                                                $pending = $items['quantity'];
                                                                            }
                                                                    ?>
                                                                            <tr>
                                                                                <td><?php echo $items['item_name'] ?></td>
                                                                                <td><?php echo $items['item_code'] ?></td>
                                                                                <td><?php echo $items['barcode'] ?></td>
                                                                                <td><?php echo $items['quantity'] ?></td>
                                                                                <td><?php echo $rcved_items; ?></td>
                                                                                <td><?php echo $pending; ?></td>
                                                                                <td>
                                                                                    <?php if ($pending == 0 || $pending < 0) { ?>
                                                                                        <input id="item_<?php echo $items['itemid']; ?>" data-itemname="<?php echo $items['item_name'] ?>" value="0" readonly="" name="item_<?php echo $items['itemid']; ?>" data-receive="0" data-pending="0" data-itemid="<?php echo $items['itemid'] ?>" data-orderqty="<?php echo $items['quantity'] ?>" data-rcvdqty="<?php echo $rcved_items; ?>" placeholder="Item received completely" type="text" class="form-control  item_data " />
                                                                                    <?php } else { ?>
                                                                                        <input id="item_<?php echo $items['itemid']; ?>" data-itemname="<?php echo $items['item_name'] ?>" value="0" name="item_<?php echo $items['itemid']; ?>" data-pending="<?php echo $pending; ?>" data-receive="1" data-itemid="<?php echo $items['itemid'] ?>" data-orderqty="<?php echo $items['quantity'] ?>" data-rcvdqty="<?php echo $rcved_items; ?>" placeholder="Received Items" type="text" class="form-control  item_data " />
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>

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
                                    </div>

                                    <div id="tab-3" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    Order Summary
                                                </div>
                                                <div class="ibox-content">
                                                    <div class="row">
                                                        <div class="form-group col-lg-4 col-xs-12 col-md-4">
                                                            <label> Total Order Quantity :</label>
                                                            <input id="surname" name="surname" disabled="" placeholder=" Total Quantity " type="text" class="form-control   " value="<?php echo isset($purchase_data['master_data']['total_qty']) ? $purchase_data['master_data']['total_qty'] : 'No data available' ?>" />
                                                        </div>
                                                        <div class="form-group col-lg-4 col-xs-12 col-md-4">
                                                            <label> Total Ordered Items count :</label>
                                                            <input id="surname" name="surname" disabled="" placeholder=" Total Quantity " type="text" class="form-control   " value="<?php echo isset($purchase_data['master_data']['item_count']) ? $purchase_data['master_data']['item_count'] : 'No data available' ?>" />
                                                        </div>
                                                        <div class="form-group col-lg-4 col-xs-12 col-md-4">
                                                            <label> Total Order Value :</label>
                                                            <input id="surname" name="surname" disabled="" placeholder=" Total Quantity " type="text" class="form-control   " value="<?php echo isset($purchase_data['master_data']['total_value']) ? $purchase_data['master_data']['total_value'] : 'No data available' ?>" />
                                                        </div>
                                                        <div class="form-group col-lg-4 col-xs-12 col-md-4">
                                                            <label> <?php echo TAXNAME  ?> :</label>
                                                            <input id="surname" name="surname" disabled="" placeholder=" Total Quantity " type="text" class="form-control   " value="<?php echo isset($purchase_data['master_data']['tax_value']) ? $purchase_data['master_data']['tax_value'] : 'No data available' ?>" />
                                                        </div>
                                                        <div class="form-group col-lg-4 col-xs-12 col-md-4">
                                                            <label> Discount :</label>
                                                            <input id="surname" name="surname" disabled="" placeholder=" Total Quantity " type="text" class="form-control   " value="<?php echo isset($purchase_data['master_data']['discount_value']) ? $purchase_data['master_data']['discount_value'] : 'No data available' ?>" />
                                                        </div>
                                                        <div class="form-group col-lg-4 col-xs-12 col-md-4">
                                                            <label> Final Amount :</label>
                                                            <input id="surname" name="surname" disabled="" placeholder=" Total Quantity " type="text" class="form-control   " value="<?php echo isset($purchase_data['master_data']['final_order_value']) ? $purchase_data['master_data']['final_order_value'] : 'No data available' ?>" />
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
<input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $purchase_id; ?>" />
<input type="hidden" name="approved_date" id="approved_date" value="<?php echo $approved_date; ?>" />

<style>
    .scroll_content-new {
        padding: 15px;
    }

    .transfer-list {
        margin: 0 0 15px 0;
    }

    .ibox-new {
        margin-top: 20px !important;
    }

    .ibox-content-new {
        min-height: 457px;
    }

    .panel-body {
        min-height: 373px;
    }
</style>

<script type="text/javascript">
    $(".item_data").keydown(function(event) {
        if (event.shiftKey) {
            event.preventDefault();
        }

        if (event.keyCode == 46 || event.keyCode == 8) {} else {
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

    $(".select2_demo_1").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $('#table_purchase_items_details').dataTable({
        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "15%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "15%",
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
                "width": "20%",
                className: "capitalize",
                "targets": 5,
                "orderable": false
            },
        ],
        iDisplayLength: 10,
    });
    $('#table_purchase_invoice_details').dataTable({
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
        ],
        iDisplayLength: 10,
    });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    function save_receive_order() {
        var purchase_id = $('#purchase_id').val();
        var invoice_no = '';
        var invoice_dt = '';
        var del_note_no = $('#suo_del_note_no').val();
        var purchase_id = $('#purchase_id').val();
        var total_rcv_qty = 0;
        if (!purchase_id) {
            swal('', 'Purchase details are requried', 'info');
            return false;
        }
        invoice_no = $('#suo_invoice').val().trim();
        invoice_dt = moment($("#suo_invoice_date").datepicker("getDate")).format('YYYY-MM-DD');
        if (invoice_no.length == 0) {
            swal('', 'Supplier invoice number is required.', 'info');
            return false;
        }
        if (!(moment($("#suo_invoice_date").datepicker("getDate")).isValid())) {
            swal('', 'Supplier invoice date is required.', 'info');
            return false;
        }

        if ($('#suo_invoice_date').data('disabledata') == '2') {

            if (invoice_dt && invoice_dt != 'Invalid date') {
                if (!invoice_no) {
                    swal('', 'Supplier invoice number is required.', 'info');
                    return false;
                }
            }
        } else {
            invoice_no = '';
            invoice_dt = '';
        }




        if (!del_note_no) {
            swal('', 'Delivery note number is required.', 'info');
            return false;
        }
        //        var del_note_dt = $('#suo_del_note_dt').val();
        var close_order = $('#close_order').prop('checked');
        var item_data = [];
        var item_error = [];
        var table = $('#table_purchase_items_details').DataTable();
        $.each(table.$('.item_data'), function(i, v) {
            var itemid = $(this).data('itemid')
            var status_readonly = $(this).data('receive');
            if (status_readonly) {
                var status_qty = $(this).val();
                if (status_qty) {
                    if (parseFloat(status_qty)) {
                        var qty = parseFloat(status_qty);
                        var pending_qty = $(this).data('pending');
                        if (qty <= pending_qty) {
                            item_data.push({
                                item: itemid,
                                item_qty: qty
                            })
                            total_rcv_qty = total_rcv_qty + qty;
                        } else {
                            var itemname = $(this).data('itemname');
                            item_error.push(itemname)
                        }
                    }
                }
            }
        });
        if (item_error.length > 0) {
            swal('', 'please check the quantity entered on the following items, ' + item_error.join(', '), 'info');
            return false;
        }
        if (item_data.length == 0 && close_order == false) {
            swal('', 'Select atleast input one purchase quantity to save', 'info');
            return false;
        }
        if (close_order) {
            swal({
                title: "Are you sure?",
                text: "You want to close purchase. No quantity can be entered to this purchse order after closing !",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, close purchase!",
                closeOnConfirm: false
            }, function(isstatus) {
                if (isstatus) {
                    close_order = 1;
                    save_receive(purchase_id, invoice_no, invoice_dt, del_note_no, close_order, item_data, total_rcv_qty)
                } else {
                    close_order = 0;
                    save_receive(purchase_id, invoice_no, invoice_dt, del_note_no, close_order, item_data, total_rcv_qty)
                }
            });
        } else {
            close_order = 0;
            save_receive(purchase_id, invoice_no, invoice_dt, del_note_no, close_order, item_data, total_rcv_qty)

        }


    }

    function save_receive(purchase_id, invoice_no, invoice_dt, del_note_no, close_order, item_data, total_rcv_qty) {
        var item_data_raw = JSON.stringify(item_data);
        var ops_url = baseurl + 'purchase/purchase-orderrecieve-save/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "purchase_id": purchase_id,
                "invoice_no": invoice_no,
                "invoice_dt": invoice_dt,
                "del_note_no": del_note_no,
                "close_order": close_order,
                "item_data": item_data_raw,
                "total_rcv_qty": total_rcv_qty
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        swal('Success', 'Purchase Items Received and added to stock successfully', 'success');
                        load_purchase();
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while receiving purchase order. Please try again later or contact administrator with error code : PRVTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while receiving purchase order. Please try again later or contact administrator with error code : PRVDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while receiving purchase order. Please try again later or contact administrator with error code : PRVDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : PRVAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }
</script>