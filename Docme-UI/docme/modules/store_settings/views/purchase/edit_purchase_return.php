<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                        <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $supplier_id ?>" />
                        <input type="hidden" name="return_id" id="return_id" value="<?php echo $return_id ?>" />
                    </h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Save order details" onclick="save_edit_return();"> <i style="font-size: 35px !important;  float: right;color: #23C6C5;" class="material-icons">save</i></a> </span>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row ">
                                <div class="ibox-content" id="data_loader">
                                    <div class="sk-spinner sk-spinner-wave">
                                        <div class="sk-rect1"></div>
                                        <div class="sk-rect2"></div>
                                        <div class="sk-rect3"></div>
                                        <div class="sk-rect4"></div>
                                        <div class="sk-rect5"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div id="curd-content" style="display: none;"></div>
                                        </div>

                                        <div class="clearfix"> </div>
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
                                                    <input id="remarks" name="remarks" placeholder="Remarks" type="text" class="form-control  input-sm">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label> Total Return Quantity :</label>
                                                    <input id="total_qty" name="total_qty" placeholder=" Total Return Quantity " type="text" class="form-control  input-sm" value="<?php echo $return_data['master_data']['total_qty']; ?>" disabled style="background-color: #ffffff;">
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                    <label>Return Amount :</label>
                                                    <input id="sub_total" name="sub_total" placeholder="Return Amount  " type="text" class="form-control  input-sm" value="<?php echo $return_data['master_data']['total_value']; ?>" disabled style="background-color: #ffffff;">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
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
                                                            //                                                                                dev_export($item_data);die;
                                                            if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
                                                                $i = 0;
                                                                foreach ($item_data as $item) {
                                                            ?>
                                                                    <div class="col-lg-4 col-rt-pa-none">
                                                                        <div class="purchase-list">
                                                                            <div class="widget style1 " class="learn-more">
                                                                                <b> Item Code : <?php echo $item['item_code']; ?><a href="javascript:void(0);" onclick="select_item('<?php echo $item['itemsid']; ?>', '<?php echo $item['itemtype_name']; ?>', '<?php echo $item['item_code']; ?>', '<?php echo $item['selling_price']; ?>', '<?php echo $item['barcode']; ?>',<?php echo isset($item['stock']) ? $item['stock'] : 0; ?>);" data-toggle="tooltip" data-placement="right" title="Move <?php echo $item['item_name']; ?> to selected items" data-original-title="<?php echo $item['item_name']; ?>" id="select"><i class="fa fa-paper-plane" style="font-size: 24px; color: #45aaaa; margin: 2%; float: right;"></i></a></b>
                                                                                <b> Item Type : <?php echo $item['itemtype_name']; ?></b>
                                                                                <b> Barcode : <?php echo $item['barcode']; ?></b>
                                                                                <b> Stock : <?php echo isset($item['stock']) ? $item['stock'] : 0; ?></b>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                    if ($i == 2) {
                                                                        echo '<div class="clearfix"></div>';
                                                                        $i = 0;
                                                                    } else {
                                                                        $i++;
                                                                    }
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
                                                    <div class="table">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_selected">

                                                            <thead>
                                                                <tr>
                                                                    <th>Item Code</th>
                                                                    <th>Barcode</th>
                                                                    <th>Item Type</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price/Qty</th>
                                                                    <th>Task</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                //                                                                                                                            dev_export($return_data);die;
                                                                if (isset($return_data['detail_data']) && !empty($return_data['detail_data'])) {
                                                                    foreach ($return_data['detail_data'] as $items) {
                                                                        $temp[] = $items['itemid'];
                                                                ?>
                                                                        <tr>
                                                                            <td><?php echo $items['item_code'] ?></td>
                                                                            <td><?php echo $items['barcode'] ?></td>
                                                                            <td><?php echo $items['itemtype_name'] ?></td>
                                                                            <td><input type="textbox" size="3" class="form-control" name="qty" readonly="" id="item_<?php echo $items['itemid'] ?>" data-submit="1" value="<?php echo $items['quantity'] ?>" /></td>
                                                                            <td><input type="textbox" size="3" class="form-control" name="price" readonly="" id="price_<?php echo $items['itemid'] ?>" value="<?php echo $items['order_price_per_qty'] ?>" /></td>
                                                                            <td><a href="javascript:void(0);" onclick="deletedisplay('<?php echo $items['itemid'] ?>')" data-toggle="tooltip" data-placement="right" title="Discard item" data-original-title="" id="discard_<?php echo $items['itemid'] ?>"><i class="fa fa-times" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a></td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="itemdata" id="itemdata" value="<?php echo json_encode($temp); ?>" />
    <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $supplier_id; ?>" />

</div>




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
    var list_switchery = [];
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
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        }


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
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        }


    });
    $(document).ready(function() {
        activateSwitchery();

    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#23C6C8',
                secondaryColor: '#F8AC59',
                size: 'small'
            });
            list_switchery.push(switchery);
        });
    }

    $(".select2_demo_1").select2({
        "theme": "bootstrap",
        width: "100%",
        placeholder: "Select Item type"
    });
    $(".select2_demo_2").select2({
        "theme": "bootstrap",
        width: "100%",
        placeholder: "Select publisher"
    });
    $(".select2_demo_3").select2({
        "theme": "bootstrap",
        "width": "100%",
        width: "100%",
        placeholder: "Select category"
    });
    $(".select2_demo_4").select2({
        "theme": "bootstrap",
        "width": "100%",
        width: "100%",
        placeholder: "Select category"
    });
    $(".select2_demo_5").select2({
        "theme": "bootstrap",
        "width": "100%",
        width: "100%",
        placeholder: "Select publisher"
    });
    $(".select2_demo_6").select2({
        "theme": "bootstrap",
        "width": "100%",
        width: "100%",
        placeholder: "Select Item type"
    });
    $(".select2_demo_7").select2({
        "theme": "bootstrap",
        "width": "100%",
        width: "100%",
        placeholder: "Select a state"
    });

    function select_item(item_id, itemtype_name, item_code, selling_price, barcode, stock) {




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
                '<input type="textbox" size="3" maxLength="6" data-stock="' + stock + '" class="form-control" name ="qty" id="item_' + item_id + '" data-submit="0" />',
                '<input type="textbox" size="3" maxLength="6"  class="form-control" name ="price" id="price_' + item_id + '"  />',
                '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a> <a href="javascript:void(0);" onclick="deletedisplay(' + item_id + ')"   data-toggle="tooltip" data-placement="right" style="" title="Discard item" data-original-title="" id="discard_' + item_id + '" ><i class="fa fa-times" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
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
        var stock_data = $(itemid).data('stock');
        if (value > stock_data) {
            swal('', 'Quantity is greater than available stock', 'info');
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

        var net_val_after_discount = 0;
        var disc = $('#discount').val();
        if (parseFloat(disc)) {
            net_val_after_discount = net_value - parseFloat(disc)
        } else {
            net_val_after_discount = net_value;
        }

        var net_val_after_tax = 0;
        var tax_amt = $('#tax').val();

        if (parseFloat(tax_amt)) {
            net_val_after_tax = net_val_after_discount + tax_amt;
        } else {
            net_val_after_tax = net_val_after_discount;
        }

        $('#net_value').val(net_val_after_tax);
        $(itemid).data('submit', "1");
        $(itemid).attr('data-submit', 1);
        swal('', 'Item added !', 'success');
    }


    function deletedisplay(item_id) {
        var discardid = '#discard_' + item_id;
        var disid = '#discard_' + item_id;

        var itemid = '#item_' + item_id;
        var priceid = '#price_' + item_id;
        var is_submit = $(itemid).data('submit');
        if (is_submit == 0) {

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


            var table1 = $('#tbl_selected').DataTable();
            var row = table1.row($(disid).parents('tr'))
            var rowNode = row.node();
            row.remove().draw();
        } else {
            var net_value = $("#sub_total").val();
            var sum = $("#total_qty").val();

            var value = $(itemid).val()
            var price = $(priceid).val()

            sum = parseFloat(sum) - parseFloat(value);
            net_value = parseFloat(net_value) - (parseFloat(price) * parseFloat(value));

            $("#total_qty").val(sum);
            $("#sub_total").val(net_value);

            //update final amount


            var net_val_after_discount = 0;
            var disc = $('#discount').val();
            if (parseFloat(disc)) {
                net_val_after_discount = net_value - parseFloat(disc)
            } else {
                net_val_after_discount = net_value;
            }

            var net_val_after_tax = 0;
            var tax_amt = $('#tax').val();

            if (parseFloat(tax_amt)) {
                net_val_after_tax = net_val_after_discount + tax_amt;
            } else {
                net_val_after_tax = net_val_after_discount;
            }

            $('#net_value').val(net_val_after_tax);



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
        var supplier_id = $('#supplier_id').val();
        var ops_url = baseurl + 'purchase/return-search/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "search_query": search_query,
                "supplier_id": supplier_id
            },
            success: function(result) {
                $('.ScrollStyle').html('');
                $('.ScrollStyle').html(result);
                $('#search_item').focus();
            }
        });
    }

    function save_edit_return() {
        var date_return = moment(new Date($("#date").val())).format('YYYY-MM-DD');
        //       var date_return = moment($("#date").datepicker("getDate")).format('YYYY-MM-DD');;
        if (!(date_return) || date_return == 'Invalid date') {
            swal('', 'Date input is invalid.Enter valid date to proceed.');
            return false;
        }
        var itemdata_raw = $('#itemdata').val();
        //        alert(itemdata_raw);
        var itemdata = JSON.parse(itemdata_raw);
        var itemid = '';
        var priceid = '';
        var final_item = [];
        var data_counter = 0;
        var table = $('#tbl_selected').DataTable();
        $.each(itemdata, function(i, v) {
            itemid = '#item_' + v;
            priceid = '#price_' + v;
            var item_qty = table.$(itemid).val();
            var item_price = table.$(priceid).val();
            var data_stat = table.$(itemid).data('submit');
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
        var return_id = $('#return_id').val();
        var supplier_id = $('#supplier_id').val();
        var total_qty = $('#total_qty').val();
        var sub_total = $('#sub_total').val();
        var remarks = $.trim($('#remarks').val());
        if (remarks.length < 5) {
            swal('', 'Remarks field is mandatory while editing purchase return and must have atleast five characters.', 'info');
            return false;
        }

        var ops_url = baseurl + 'purchase/purchase-return-edit-save/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "return_id": return_id,
                "final_item_string": final_item_string,
                "data_counter": data_counter,
                "supplier_id": supplier_id,
                "total_qty": total_qty,
                "sub_total": sub_total,
                "date_return": date_return,
                "remarks": btoa(remarks)
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        swal('Success!!', 'Return Order edited successfully', 'success');
                        purchase_return();
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while editing Return order. Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                            return false;
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while editing Return order. Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                            return false;
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRUIJSNER10002', 'info');
                }
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
    $('#date').datepicker('setDate', 'now');
</script>