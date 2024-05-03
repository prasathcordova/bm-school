<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $supplier_id ?>" />
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0)" onclick="save_purchase_return();"> <i style="font-size: 35px !important;  float: right;color: #23c6c8;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>

                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="form-group col-lg-6 col-xs-12 col-md-6">
                                    <div class="form-group" id="data_1">
                                        <label>Return Date</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control input-sm" name="date" readonly="" style="background-color:#FFF;" id="date" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label> Remarks :</label>
                                    <input id="remark" name="remark" placeholder="Remarks" type="text" class="form-control  input-sm">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label> Total Return Quantity :</label>
                                    <input id="total_qty" name="total_qty" placeholder=" Total Return Quantity " type="text" class="form-control  input-sm" vale="" disabled style="background-color: #ffffff;">
                                </div>
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label>Return Amount :</label>
                                    <input id="sub_total" name="sub_total" placeholder="Return Amount  " type="text" class="form-control  input-sm" value="" disabled style="background-color: #ffffff;">
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="curd-content" style="display: none;"></div>
                                </div>
                                <div class="clearfix"> </div>
                                <div class="col-lg-12">
                                    <div class="ibox purchase-sec">
                                        <div class="ibox-title">
                                            <h4>Items List</h4>
                                        </div>
                                        <div class="scroll_content">
                                            <div class=" input-group">
                                                <input type="text" placeholder="Search Item Code / Item name / Barcode" name="search_item" id="search_item" class="input form-control">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn btn-primary" onclick="search_item();"> <i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                            <div class="ScrollStyle">
                                                <div class="row row-new">
                                                    <?php
                                                    if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
                                                        foreach ($item_data as $item) {
                                                    ?>
                                                            <div class="col-lg-4 col-rt-pa-none">
                                                                <div class="purchase-list">
                                                                    <div class="widget style1 " class="learn-more">
                                                                        <b> Item Code : <?php echo $item['item_code']; ?><a href="javascript:void(0);" onclick="select_item('<?php echo $item['item_id']; ?>', '<?php echo $item['itemtype_name']; ?>', '<?php echo $item['item_code']; ?>', '<?php echo $item['selling_price']; ?>', '<?php echo $item['barcode']; ?>');" data-toggle="tooltip" data-placement="right" title="Move <?php echo $item['item_name']; ?> to selected items" data-original-title="<?php echo $item['item_name']; ?>" id="select"><i class="fa fa-paper-plane" style="font-size: 24px; color: #45aaaa; margin: 2%; float: right;"></i></a></b>
                                                                        <b> Item Type : <?php echo $item['itemtype_name']; ?></b>
                                                                        <b> Barcode : <?php echo $item['barcode']; ?></b>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h4>Selected Items</h4>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_selected">

                                                    <thead>
                                                        <tr>
                                                            <th> Item Code</th>
                                                            <th>Barcode</th>
                                                            <th>Item Type</th>
                                                            <th>Quantity</th>
                                                            <th>Price/Qty</th>
                                                            <th>Task</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
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
<input type="hidden" name="itemdata" id="itemdata" value="" />


<style>
    .ibox-new-2 {
        padding: 15px !important;
    }

    .form-group-new input {
        border-radius: 3px;
        border: none;
    }

    div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }

    .ScrollStyle {
        max-height: 150px;
        overflow-y: scroll;
    }
</style>

<script type="text/javascript">
    $('#date').datepicker('setDate', 'now');


    $('#tbl_select').dataTable({

        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "40%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "30%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3,
                "orderable": false
            }
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv'
            },
            {
                extend: 'excel',
                title: 'Report'
            }
        ],

    });

    $('#tbl_selected').dataTable({

        columnDefs: [{
                "width": "10%",
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
                "targets": 5,
                "orderable": false
            }
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv'
            },
            {
                extend: 'excel',
                title: 'Report'
            }
        ],

    });

    function select_item(item_id, itemtype_name, item_code, selling_price, barcode) {

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
            swal('', 'Item already exist in selected list !', 'info');
            return false;
        } else {
            var item_id = item_id;
            var dTable = $('#tbl_selected').DataTable();
            var cur_itemdata = $('#itemdata').val();
            if (cur_itemdata.length > 0) {
                var cur_item_obj = JSON.parse(cur_itemdata);
            } else {
                var cur_item_obj = [];
            }
            cur_item_obj.push(item_id);
            var jsonitem = JSON.stringify(cur_item_obj)
            $('#itemdata').val(jsonitem);

            dTable.row.add([
                item_code,
                barcode,
                itemtype_name,
                '<input type="textbox" size="3" class="form-control" name ="qty" id="item_' + item_id + '" data-submit="0" />',
                '<input type="textbox" size="3" class="form-control" name ="price" id="price_' + item_id + '"  />',
                '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a> <a href="javascript:void(0);" onclick="deletedisplay(' + item_id + ')"   data-toggle="tooltip" data-placement="right" style="display: none" title="Discard item" data-original-title="" id="discard_' + item_id + '" ><i class="fa fa-times" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
            ]).draw();
        }
        $('#search_item').focus();

    }

    function valuedisplay(item_id) {
        var confirmid = '#confirm_' + item_id;
        //        var discardid = '#discard_' + item_id;
        var itemid = '#item_' + item_id;
        var priceid = '#price_' + item_id;
        var discardid = '#discard_' + item_id;
        var value = $(itemid).val()
        var price = $(priceid).val()

        if (value.length == 0) {
            swal('', 'Enter required quantity!', 'info');
            return false;
        }
        if (price.length == 0) {
            swal('', 'Enter price/Qty of the selected item!', 'info');
            return false;
        }
        var numbers = /^\d*(\.\d{1})?\d{0,1}$/;
        if (numbers.test(value) == false) {
            swal('', 'Enter valid quantity', 'info');
            return false;
        }
        if (numbers.test(price) == false) {
            swal('', 'Enter valid price', 'info');
            return false;
        }

        if (price <= 0) {
            swal('', 'Enter valid price', 'info');
            return false;
        }
        if (value <= 0) {
            swal('', 'Enter valid quantity', 'info');
            return false;
        }
        $(confirmid).hide();
        //        $(discardid).show();
        var net_value = $("#sub_total").val();
        var sum = $("#total_qty").val();
        if (sum == '' && net_value == '') {
            sum = parseFloat(value);
            net_value = parseFloat(price) * parseFloat(value);
        } else {
            sum = parseFloat(sum) + parseFloat(value);
            net_value = parseFloat(net_value) + (parseFloat(price) * parseFloat(value));
        }
        $("#total_qty").val(sum);
        $("#sub_total").val(net_value);
        $(itemid).attr('readonly', true);
        $(priceid).attr('readonly', true);
        $(discardid).show();
        //
        //        var net_val_after_discount = 0;
        //        var disc = 0;
        //        if (parseFloat(disc)) {
        //            net_val_after_discount = net_value - parseFloat(disc)
        //        } else {
        //            net_val_after_discount = net_value;
        //        }
        //
        //        var net_val_after_tax = 0;
        //        var tax_amt = 0;
        //
        //        if (parseFloat(tax_amt)) {
        //            net_val_after_tax = net_val_after_discount + tax_amt;
        //        } else {
        //            net_val_after_tax = net_val_after_discount;
        //        }
        //
        //        $('#net_value').val(net_val_after_tax);

        $(itemid).data('submit', 1);
        swal('', 'Item added !', 'success');
    }


    function deletedisplay(item_id) {
        var discardid = '#discard_' + item_id;
        var disid = '#discard_' + item_id;

        var itemid = '#item_' + item_id;
        var priceid = '#price_' + item_id;

        var net_value = $("#sub_total").val();
        var sum = $("#total_qty").val();

        var value = $(itemid).val()
        var price = $(priceid).val()

        sum = parseFloat(sum) - parseFloat(value);
        net_value = parseFloat(net_value) - (parseFloat(price) * parseFloat(value));

        $("#total_qty").val(sum);
        $("#sub_total").val(net_value);

        //update final amount


        //        var net_val_after_discount = 0;
        //        var disc = $('#discount').val();
        //        if (parseFloat(disc)) {
        //            net_val_after_discount = net_value - parseFloat(disc)
        //        } else {
        //            net_val_after_discount = net_value;
        //        }
        //
        //        var net_val_after_tax = 0;
        //        var tax_amt = $('#tax').val();
        //
        //        if (parseFloat(tax_amt)) {
        //            net_val_after_tax = net_val_after_discount + tax_amt;
        //        } else {
        //            net_val_after_tax = net_val_after_discount;
        //        }
        //
        //        $('#net_value').val(net_val_after_tax);



        //remove from table
        var table1 = $('#tbl_selected').DataTable();
        var row = table1.row($(disid).parents('tr'))
        var rowNode = row.node();
        row.remove().draw();

        //delete from json list
        var cur_itemdata = $('#itemdata').val();
        if (cur_itemdata.length == 0) {
            var itemdata_obj = [];
            itemdata_obj.push(item_id);
            var jsonitem = JSON.stringify(itemdata_obj)
            //            console.log(jsonitem);
            $('#itemdata').val(jsonitem);
        } else {
            var cur_item_obj_new = [];
            var cur_item_obj = JSON.parse(cur_itemdata);
            console.log(cur_item_obj);
            $.each(cur_item_obj, function(i, v) {
                if (v != item_id) {
                    cur_item_obj_new.push(v);
                }
            });
            var cur_j_item = JSON.stringify(cur_item_obj_new);
            $('#itemdata').val(cur_j_item);
        }

    }

    $('#search_item').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            search_item();
            $('#search_item').focus();
        }

    });

    function search_item() {
        var search_query = $('#search_item').val();
        var ops_url = baseurl + 'purchase/direct-purchase-search/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "search_query": search_query
            },
            success: function(result) {
                $('.ScrollStyle').html('');
                $('.ScrollStyle').html(result);
                $('#search_item').focus();
            }
        });
    }
    $('#data_1 .input-group.date').datepicker({
        "theme": "bootstrap",
        width: "100%",
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    function save_purchase_return() {
        var date_return = moment(new Date($("#date").val())).format('YYYY-MM-DD');
        //       var date_return = moment($("#date").datepicker("getDate")).format('YYYY-MM-DD');;
        if (!(date_return) || date_return == 'Invalid date') {
            swal('', 'Date input is invalid.Enter valid date to proceed.');
            return false;
        }
        var itemdata_raw = $('#itemdata').val();
        if (itemdata_raw.length == 0) {
            swal('', 'Select atleast one item to proceed', 'info');
            return false;
        }
        var itemdata = JSON.parse(itemdata_raw);
        var itemid = '';
        var priceid = '';
        var final_item = [];
        var data_counter = 0;
        $.each(itemdata, function(i, v) {
            itemid = '#item_' + v;
            priceid = '#price_' + v;
            var item_qty = $(itemid).val();
            var item_price = $(priceid).val();
            var data_stat = $(itemid).data('submit');
            if (data_stat == 1) {
                final_item.push({
                    item_id: v,
                    qty: item_qty,
                    price: item_price
                });
                data_counter = data_counter + 1;
            }
        });
        var final_item_string = JSON.stringify(final_item);
        var supplier_id = $('#supplier_id').val();
        var total_qty = $('#total_qty').val();
        var sub_total = $('#sub_total').val();
        var remarks = $('#remark').val();
        if ($.trim($('#remark').val()).length == 0) {
            swal('', 'Remarks is mandatory. Please fill in remarks', 'info');
            return false;
        }

        var ops_url = baseurl + 'purchase/purchase-return-save/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "supplier_id": supplier_id,
                "final_item_string": final_item_string,
                "purchase_return_date": date_return,
                "data_counter": data_counter,
                "total_qty": total_qty,
                "sub_total": sub_total,
                "remarks": btoa(remarks)
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        if (data.return_id) {
                            swal('Success!!', 'Purchase return order with return order id : ' + data.return_id + ' placed successfully', 'success');
                        } else {
                            swal('Success!!', 'Purchase return order placed successfully', 'success');
                        }

                        purchase_return();
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase return order. Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                            return false;
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase return order. Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                            return false;
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : PRUIJSNER10002', 'info');
                }
            }
        });


    }
</script>