<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 10px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="font-size: 15px"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <input type="hidden" value="<?php echo $store_id ?>" id="store_id">
                    <!--<div class="ibox-tools">-->
                    <span><a href="javascript:void(0);" onclick="submit_allotment();" data-toggle="tooltip" title="Save new stock allotment"> <i style="font-size: 30px !important; float: right; color: #23C6C8; padding-right: 10px;" class="material-icons">save</i></a> </span>
                    <!--</div>-->
                </div>

                <div class="ibox-content" id="data_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <b> Description *</b>
                            <div class="form-group">
                                <input type="text" maxlength="150" class="form-control text-uppercase" name="description" id="description" value="" />

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <b> Total Quantity</b>
                            <div class="form-group">

                                <input type="text" readonly="true" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_items" value="0" />
                                <input type="hidden" readonly="true" disabled name="net_value" id="net_value" value="0" />

                            </div>
                        </div>
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
                                                $flag = 1;
                                                if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
                                                    foreach ($item_data as $item) {
                                                ?>

                                                        <div class="col-lg-4" style="padding-left: 17px;padding-top: 2px;">
                                                            <div class="ibox float-e-margins">

                                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                    <a title="Add  <?php echo $item['item_name'] ?> to list ">
                                                                        <span class="label label-info pull-right" onclick="select_item('<?php echo $item['itemsid']; ?>', '<?php echo $item['item_name']; ?>', '<?php echo $item['itemtype_name']; ?>', '<?php echo $item['item_code']; ?>', '<?php echo $item['barcode']; ?>', '<?php echo $item['selling_price']; ?>', '<?php echo $item['rate']; ?>', '<?php echo $item['stock']; ?>');">Add to list</span></a>



                                                                    <?php echo $item['barcode']; ?>
                                                                </div>
                                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                    <div>Item Type : <?php echo $item['itemtype_name']; ?></div>
                                                                    <div>Item Name : <?php echo $item['item_name']; ?></div>
                                                                    <div>Item Code : <?php echo $item['item_code']; ?></div>

                                                                </div>


                                                                <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                                    <span class="label label-warning pull-left"><?php echo CURRENCY  ?> <?php echo (isset($item['rate']) && !empty($item['rate'])) ? $item['rate'] : $item['selling_price']; ?></span>

                                                                    <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;">stock</i><?php echo $item['stock']; ?></div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                        if ($flag == 3) {
                                                            echo '<div class="clearfix"></div>';
                                                            $flag = 1;
                                                        } else {
                                                            $flag++;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <!--<h2>Selected Items</h2>-->
                                    <h5 style="font-size: 15px">Selected Items</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="notes" style="padding-bottom:10px;padding-left: 10px;padding-top: 10px;margin-bottom: 10px;font-family: Tahoma;">
                                        *Notes:<br />
                                        <span class="text-muted small">
                                            1. User should verify each item by clicking 'Tick' mark. Only verified item will be saved.<br />
                                            2. Once verified, user can discard the item from list by clicking 'X' button or save the list by clicking save button.
                                        </span>
                                    </div>
                                    <div class="table">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_selected">

                                            <thead>
                                                <tr>
                                                    <th> Item Code</th>
                                                    <th>Item Name</th>
                                                    <th>Item Type</th>
                                                    <th>Barcode</th>
                                                    <th>Available Stock</th>
                                                    <th>Quantity</th>
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
        max-height: 300px;
        overflow-y: scroll;
    }
</style>

<script type="text/javascript">
    function activate_toast_message(message, title, type) {
        toastr.clear();
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "preventDuplicates": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": 200,
            "hideDuration": 200,
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr[type](message, title);

    }

    function submit_allotment() {

        var store_id = $("#store_id").val();
        var total_items = $("#total_items").val();
        var description = $("#description").val();
        var net_value = $("#net_value").val();
        if (total_items == '' && net_value == '') {
            swal('', 'No item has been confirmed', 'info');
            return false;
        }
        if (description == '') {
            swal('', 'Description is needed', 'info');
            return false;
        }
        var flag1 = 0;
        var itemdata = [];
        var error_flag = 0;
        var error_data = [];
        var not_approve_flag = 0;
        var table = $('#tbl_selected').DataTable();
        table.$('.stock-allotment').each(function(i, v) {
            var data = [];
            var itemcode = $(v).data('itemcode');
            var itemid = $(v).data('itemid');
            var itemname = $(v).data('itemname');
            var barcode = $(v).data('barcode');
            var selling_price = $(v).data('selling_price');
            var data_stat = $(v).data('submit');
            if (data_stat == 1) {

                //            var selling_price = $(v).data('selling_price');
                //            var selling_price = 0;
                var rate = $(v).data('rate');
                if (rate == '') {
                    var price = selling_price;
                } else {
                    var price = rate;
                }
                //            alert(price);
                var isadded = $(v).data('isadded');
                if (isadded == 1) {
                    flag1 = 1;
                }
                var quantity = $(v).val();
                if (quantity == '') {
                    error_flag = 1
                    error_data.push(itemname);
                } else if ((quantity.length > 6) || (quantity.length == 0)) {
                    error_flag = 1
                    error_data.push(itemname);
                }

                //                var alphanumers = /^[0-9]+$/;
                var alphanumers = /^\d*(\.\d{1})?\d{0,1}$/;
                if (!alphanumers.test(quantity) && error_data.indexOf(itemname) < 0) {
                    error_flag = 1
                    error_data.push(itemname);
                }

                if (quantity <= 0) {
                    swal('', 'Enter valid quantity', 'info');
                    return false;
                }


                if (error_flag == 0) {
                    data['itemid'] = itemid;
                    data['itemcode'] = itemcode;
                    data['itemname'] = itemname;
                    data['quantity'] = quantity
                    //            data['selling_price'] = selling_price
                    //            data['rate'] = rate
                    data['price'] = price
                    itemdata.push({
                        "itemid": itemid,
                        "quantity": quantity,
                        "price": price,
                        "isadded": isadded
                    });
                }
            } else {
                not_approve_flag = 1;
            }
        });
        if (error_flag == 1) {
            swal('', 'Enter valid data for the following items, ' + error_data.join(), 'info');
            return false;
        }

        if (flag1 == 0) {
            swal('', 'Atleast one verified item needed to perform stock allotment. Please check item list.', 'info');
            return false;
        }

        if (itemdata.length == 0 || itemdata.length < 0) {
            swal('', 'Atleast one verified item needed to perform stock allotment. Please check item list.', 'info');
            return false;
        }
        if (not_approve_flag == 1) {
            swal('', 'Please check all items on list are verified. If any unverified items in list, then verify the items or remove the items from list', 'info');
            return false;
        }
        var formatted_itemdata = JSON.stringify(itemdata)
        var ops_url = baseurl + 'allotment/save-allotment_sub_out';
        swal({
            title: '',
            text: 'Do you want to continue? Stock will be transferred to Main Store if OK is clicked.',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Go back',
            confirmButtonText: 'OK',
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "itemdata": formatted_itemdata,
                        "total_items": total_items,
                        "net_value": net_value,
                        "description": description,
                        "store_id": store_id
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            swal({
                                title: 'Transfer Request to Main Store',
                                text: 'Transfer request has been accepted and transfered to Main Store',
                                type: 'success'
                            });
                            stock_allotment_Outword();
                        } else {
                            swal('', 'Stock allocation failed', 'info');
                        }
                    }
                });
            }
        });
    }






    $('#tbl_selected').dataTable({

        columnDefs: [{
                "width": "15%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "25%",
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
                "targets": 4,
                "orderable": false
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 5,
                "orderable": false
            }
        ],
        responsive: false,
        iDisplayLength: 10,
    });

    function select_item(item_id, item_name, itemtype_name, item_code, barcode, selling_price, rate, stock) {
        //alert(selling_price);
        var flag = 0;
        if (rate == '') {
            var price = selling_price;
        } else {
            var price = rate;
        }
        var cur_itemdata = $('#itemdata').val();
        if (cur_itemdata.length == 0) {
            var itemdata_obj = [];
            itemdata_obj.push(item_id);
            var jsonitem = JSON.stringify(itemdata_obj)
            //            console.log(jsonitem);
            $('#itemdata').val(jsonitem);
        } else {
            //            var cur_itemdata = $('#itemdata').val();
            var cur_item_obj = JSON.parse(cur_itemdata);
            //            console.log(cur_item_obj);
            $.each(cur_item_obj, function(i, v) {
                if (v == item_id) {
                    flag = 1;
                }

            });
        }
        //        console.log(flag);
        if (flag == 1) {
            swal('', 'Item already exist in selected list ', 'info');
            return false;
        } else {
            var item_id = item_id;
            var dTable = $('#tbl_selected').DataTable();
            var cur_itemdata = $('#itemdata').val();
            var cur_item_obj = JSON.parse(cur_itemdata);
            cur_item_obj.push(item_id);
            //            console.log(cur_item_obj);
            var jsonitem = JSON.stringify(cur_item_obj)
            $('#itemdata').val(jsonitem);
            dTable.row.add([
                item_code,
                item_name,
                itemtype_name,
                barcode,
                stock,
                '<input style="width:100%;" maxLength="6" class="stock-allotment total_items" type="textbox" data-isadded="0" data-itemid="' + item_id + '" data-itemcode="' + item_code + '" data-itemname="' + item_name + '" data-barcode="' + barcode + '"data-selling_price="' + selling_price + '"data-rate="' + rate + '"   size="3" data-submit="0" name ="qty" id="item_' + item_id + '"  />',
                '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ',' + price + ',' + stock + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a><a href="javascript:void(0);" onclick="deletedisplay(' + item_id + ')"   data-toggle="tooltip" data-placement="right" style="" title="Discard item" data-original-title="" id="discard_' + item_id + '" ><i class="fa fa-times" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
                //                '<a href="javascript:void(0);" onclick=""  data-toggle="tooltip" data-placement="right" title="Discard item" data-original-title="" id="discard" ><i class="fa fa-cross" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
            ]).draw();
            activate_toast_message('Item :' + item_name + ' added to list successfully', '', 'success');
        }
        $('#search_item').focus();
    }

    function valuedisplay(item_id, price, stock) {
        //    alert(price);
        if (!stock) {
            stock = 0;
        }
        var confirmid = '#confirm_' + item_id;
        var itemid = '#item_' + item_id;
        var discardid = '#discard_' + item_id;
        var value = $(itemid).val();
        if (!parseFloat(value)) {
            swal('', 'Enter valid stock quantity', 'info');
            return false;
        }
        if (parseFloat(value) > stock) {
            swal('', 'Enter stock quantity less than or equal to available stock', 'info');
            return false;
        }
        if (parseFloat(value) < 0) {
            swal('', 'Enter a valid stock quantity', 'info');
            return false;
        }
        //        if (/^[+]?\d+(\.\d+)?$/.test(value) == false) {
        //            swal('', 'Enter valid quantity', 'info');
        //            return false;
        //        }
        //        if (/^[+]?\d+(\.\d+)?$/.test(price) == false) {
        //            swal('', 'Enter valid price', 'info');
        //            return false;
        //        }
        var numbers = /^\d*(\.\d{1})?\d{0,1}$/;
        if (!numbers.test(value)) {
            swal('', 'Enter valid quantity', 'info');
            return false;
        }
        $(itemid).data('isadded', 1);
        $(confirmid).hide();
        $(discardid).show();
        var net_value = $("#net_value").val();
        var sum = $("#total_items").val();
        if (sum == '' && net_value == '') {
            sum = parseFloat(value);
            net_value = price * parseFloat(value);
        } else {
            sum = parseFloat(sum) + parseFloat(value);
            net_value = parseFloat(net_value) + (price * parseFloat(value));
        }
        $("#total_items").val(sum);
        $("#net_value").val(net_value);
        //        alert(net_value);
        $(itemid).data('submit', "1");
        $(itemid).prop('readonly', true)
        $(itemid).attr('data-submit', 1);
    }

    $('#search_item').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            search_item();
            $('#search_item').focus();
        }

    });

    function deletedisplay(item_id) {
        var discardid = '#discard_' + item_id;
        var disid = '#discard_' + item_id;
        var itemid = '#item_' + item_id;
        var is_submit = $(itemid).data('submit');
        if (is_submit == 0) {
            var cur_itemdata = $('#itemdata').val();
            if (cur_itemdata.length == 0) {
                var itemdata_obj = [];
                itemdata_obj.push(item_id);
                var jsonitem = JSON.stringify(itemdata_obj)
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
            if (parseFloat($("#total_items").val())) {
                var sum = $("#total_items").val();
            } else {
                var sum = 0;
            }

            if (parseFloat($(itemid).val())) {
                var value = $(itemid).val()
            } else {
                var value = 0
            }




            sum = parseInt(sum) - parseInt(value);
            $("#total_items").val(sum);
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

    function search_item() {
        var search_query = $('#search_item').val();
        var store_id = $("#store_id").val();
        var ops_url = baseurl + 'allotment/allotment-search_sub/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "search_query": search_query,
                "store_id": store_id
            },
            success: function(result) {
                //                alert(result);
                $('.ScrollStyle').html('');
                $('.ScrollStyle').html(result);
                $('#search_item').focus();
            }
        });
    }
</script>