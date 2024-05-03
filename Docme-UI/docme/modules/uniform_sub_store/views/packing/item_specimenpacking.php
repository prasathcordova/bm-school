<?php
$profile_image = "";
if (isset($emp['profile_image']) && !empty($emp['profile_image'])) {

    $profile_image = "data:image/png;base64," . $emp['profile_image'];
} else {
    if (isset($emp['profile_image_alternate']) && !empty($emp['profile_image_alternate'])) {
        $profile_image = $emp['profile_image_alternate'];
    } else {
        $profile_image = base_url('assets/img/a0.jpg');
    }
}
?>



<div class="ibox">
    <div class="ibox-content" id="data_loader">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <img src="<?php echo $profile_image; ?>" class="img-circle circle-border" alt="profile" style="width: 40px;">

                        <?php echo $emp['Emp_Name'] ?> <small style="float: right;"> <?php echo $emp['Designation'] ?></small>
                        <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $emp['Emp_id'] ?>">
                    </div>
                    <div class="panel-body">
                        <div class=" input-group" style="padding-bottom: 5%;">
                            <input type="text" placeholder="Enter Item Code/Name/BarCode" class="input form-control" id="searchitem" name="searchitem">

                            <span class="input-group-btn">
                                <button type="button" id="search_name_btn" class="btn btn btn-primary" onclick="uniform_search_item();"> <i class="fa fa-search"></i></button>
                                <input type="hidden" class="input form-control" id="store_idd" name="store_idd" value="<?php echo $store_idd ?>">
                            </span>
                        </div>

                        <div class="ScrollStyle">
                            <div class="wrapper wrapper-content animated fadeInRight" id="item-data-container">
                                <?php
                                if (isset($item_data) && !empty($item_data)) {

                                    foreach ($item_data as $item) {
                                ?>

                                        <div class="col-lg-4">
                                            <div class="ibox float-e-margins">
                                                <?php $price = (isset($item['rate']) && !empty($item['rate']) && $item['rate'] != NULL) ? $item['rate'] : $item['selling_price'] ?>
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                    <a href="javascript:void(0);" title="Add  <?php echo $item['item_name'] ?> to list "><span class="label label-info pull-right" onclick="uniform_add_list('<?php echo $item['item_code'] ?>', '<?php echo $item['item_name'] ?>', '<?php echo $item['itemtype_name'] ?>', '<?php echo $price ?>', '<?php echo $item['itemsid'] ?>', '<?php echo $item['tax_type'] ?>', '<?php echo $item['tax_value'] ?>');">Add to list</span></a>

                                                    <?php echo $item['item_code'] ?><br>
                                                    <?php echo $item['barcode'] ?>
                                                </div>
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                    <?php echo $item['item_name'] ?></div>


                                                <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                    <span class="label label-warning pull-left"><?php echo CURRENCY  ?>
                                                        <?php echo (isset($item['rate']) && !empty($item['rate']) && $item['rate'] != NULL) ? $item['rate'] : $item['selling_price'] ?>
                                                    </span>
                                                    <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;">Stock</i><?php echo $item['stock'] ?></div>

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
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Items Selected
                        <a href="javascript:void(0);" id="save_emppacking" onclick="uniform_submit_data();"> <i style="font-size: 27px !important; float: right; color: #ffffff; padding-right: 0px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a>
                    </div>
                    <div class="panel-body">

                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_class_item">
                            <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <!--<th>Bar Code </th>-->
                                    <th>Item Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Confirm</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4">
                <b> Total Quantity</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_qty" value="" />
                </div>
            </div>
            <div class="col-md-4">
                <b> Sub Total</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="sub_total" value="" />
                </div>
            </div>

            <div class="col-md-4">
                <b><?php echo TAXNAME  ?>(Note:For specimen packing <?php echo TAXNAME  ?> will be 0)</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="tax" value="0" />
                </div>
            </div>
            <div class="col-md-4">
                <b>Roundoff</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="roundoff" id="roundoff" value="0" />
                </div>
            </div>
            <div class="col-md-4">
                <b>Discount amount</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="net_value" value="" />
                </div>
            </div>
            <div class="col-md-4">
                <b>Final Total</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="" value="0" />
                </div>
            </div>
            <input type="hidden" class="input form-control" id="tax_price" name="tax_price" value="0">
            <input type="hidden" class="input form-control" id="reminder" name="reminder" value="0">

        </div>
    </div>
</div>

<input type="hidden" name="itemdata" id="itemdata" value="" />




<script>
    var input = document.getElementById("searchitem");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("search_name_btn").click();
            uniform_add_to_list();
        }

    });

    function uniform_add_to_list() {
        if ($('#flag_value').val() == 1) {
            var item_code_id = $('#item_code_id').val();
            var item_name_id = $('#item_name_id').val();
            var itemtype_name_id = $('#itemtype_name_id').val();
            var price_id = $('#price_id').val();
            var itemsid_id = $('#itemsid_id').val();
            var tax_type_id = $('#tax_type_id').val();
            var tax_value_id = $('#tax_value_id').val();
            uniform_add_list(item_code_id, item_name_id, itemtype_name_id, price_id, itemsid_id, tax_type_id, tax_value_id);


        }
    }


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

    function uniform_submit_data() {
        $('#save_emppacking').prop('disabled', true);
        var itemdata_raw = $('#itemdata').val();
        if (itemdata_raw.length < 3) {
            swal('', 'Add atleast one item for packing', 'info');
            return false;
        }
        var itemdata = JSON.parse(itemdata_raw);
        var itemid = '';
        var priceid = '';
        var final_item = [];
        var data_counter = 0;
        var set_flag = 0
        var table = $('#tbl_class_item').DataTable();
        $.each(itemdata, function(i, v) {
            itemid = '#item_' + v;

            var data_stat = table.$(itemid).data('submit');
            if (data_stat == 0) {
                set_flag = 1;
            }
        });
        if (set_flag == 1) {
            swal('', 'Quantity not specified in some field', 'info');
            return false;
        }
        var flag = 0
        $.each(itemdata, function(i, v) {
            itemid = '#item_' + v;
            priceid = '#price_' + v;
            var item_qty = table.$(itemid).val();
            var item_price = table.$(priceid).val();
            var data_stat = table.$(itemid).data('submit');
            if (item_qty > 9999) {
                flag = 1;
            }
            if (data_stat == 1) {
                final_item.push({
                    item_id: v,
                    qty: item_qty,
                    price: item_price
                });
                data_counter = data_counter + 1;
            }
        });
        if (flag == 1) {
            swal('', 'Please check quantity entered. Quantity cant be greater than 4 digits', 'info');
            return false;
        }
        var final_item_string = JSON.stringify(final_item);
        var emp_id = $('#emp_id').val();
        var total_qty = $('#total_qty').val();
        var sub_total = $('#sub_total').val();
        var net_value = $('#net_value').val();

        //        var tax_price = $('#tax_price').val();
        var tax_price = 0;
        var roundoff = $('#roundoff').val();


        var ops_url = baseurl + 'uniform/substore/save-specimen_issue/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "roundoff": roundoff,
                "emp_id": emp_id,
                "final_item_string": final_item_string,
                "data_counter": data_counter,
                "total_qty": total_qty,
                "sub_total": sub_total,
                "net_value": net_value,
                "tax_price": tax_price
            },
            success: function(result_statt) {
                try {
                    var data = JSON.parse(result_statt);
                    if (data.status == 1) {
                        swal({
                            title: "Success",
                            text: "Item specimen placed successfully with Bill No : " + data.bill_no,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: "OK",
                            closeOnConfirm: true,
                        }, function(isConfirm) {

                            uniform_load_specimenpacking();

                        });
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : PODTAER10003', 'info');
                            return false;
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                            return false;
                        }
                    }
                } catch (e) {
                    console.log(result);
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : POUIJSNER10002', 'info');
                }
            }
        });


    }

    function uniform_add_list(item_code, item_name, itemtype_name, price, item_id, tax_type, tax_value) {

        tax_value = 0;

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
            activate_toast_message('Item :' + item_name + ' added to list successfully', '', 'success');
            var item_id = item_id;
            var dTable = $('#tbl_class_item').DataTable();
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
                item_name,
                itemtype_name,
                '<input type="number" min="1" max="9999" class="form-control" name ="qty" id="item_' + item_id + '" data-submit="0" />',
                '<input type="textbox" disabled size="4" class="form-control" name ="price" id="price_' + item_id + '" value= ' + price + ' />',
                '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="uniform_valuedisplay(' + item_id + ',' + price + ',\'' + tax_type + '\',' + tax_value + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a> \n\  <span id="confirmed_' + item_id + '" style="display:none;" class="label label-warning pull-left" >confirmed</span>',
                '<a href="javascript:void(0)" data-toggle="tooltip" title="Remove Item From List"><span id="discard_' + item_id + '" class="label label-warning pull-left" onclick="uniform_deletedisplay(' + item_id + ',' + price + ',\'' + tax_type + '\',' + tax_value + ');" ><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>'

            ]).draw();
        }
        $('#searchitem').focus();

    }

    function uniform_valuedisplay(item_id, price, tax_type, tax_value) {


        tax_value = 0;
        var confirmid = '#confirm_' + item_id;
        var confirmedid = '#confirmed_' + item_id;
        var itemid = '#item_' + item_id;

        var discardid = '#discard_' + item_id;
        var value = $(itemid).val()
        var price = price;

        //        if (value % 1 === 0) {
        //
        //        } else {
        //            swal('', 'Enter integer stock quantity', 'info');
        //            return false;
        //        }
        if (value.length == 0) {
            swal('', 'Enter a valid quantity', 'info');
            return false;
        }
        if (!parseFloat(value)) {
            swal('', 'Enter valid stock quantity', 'info');
            return false;
        }
        if (parseFloat(value) < 0) {
            swal('', 'Enter a valid stock quantity', 'info');
            return false;
        }
        if (/^[+]?\d+(\.\d+)?$/.test(value) == false) {
            swal('', 'Enter valid quantity', 'info');
            return false;
        }
        var decimal = (value.toString().split(".")[1]);

        if ((value % 1)) {
            var decimal = (value.toString().split(".")[1]);
            if (decimal.length > 2) {
                swal('', 'Quantity restricted to 2 decimal points', 'info');
                return false;
            }
        }

        $(confirmid).hide();
        $(confirmedid).show();
        var net_value = $("#sub_total").val();
        var sum = $("#total_qty").val();

        if (sum == '' && net_value == '') {
            sum = parseFloat(value);
            net_value = parseFloat(price) * parseFloat(value);
        } else {
            sum = parseFloat(sum) + parseFloat(value);
            net_value = parseFloat(net_value) + (parseFloat(price) * parseFloat(value));

        }
        sum = sum.toFixed(2);
        net_value = net_value.toFixed(2);

        $("#total_qty").val(sum);
        $("#sub_total").val(net_value);
        $(itemid).attr('readonly', true);

        $(discardid).show();


        if (tax_type == 'P') {
            var tax_amt = (parseFloat(tax_value) * parseFloat((parseFloat(price) * parseFloat(value)))) / 100;
        } else {
            var tax_amt = parseFloat(tax_value) * parseFloat(value);
        }
        tax_amt = parseFloat(tax_amt.toFixed(2));
        var tax_price = $("#tax").val();
        tax_price = parseFloat(tax_price) + parseFloat(tax_amt);
        tax_price = parseFloat(tax_price.toFixed(2));
        $("#tax").val(tax_price);

        var net_val_after_tax = parseFloat(net_value) + parseFloat(tax_price);


        var value_after_cal_tax = parseFloat(net_val_after_tax.toFixed(2));
        var rounded_total = parseFloat(net_val_after_tax.toFixed());

        var round_off = parseFloat(rounded_total) - parseFloat(value_after_cal_tax);
        round_off = round_off.toFixed(2);

        $('#net_value').val(rounded_total);
        $('#reminder').val(1 - round_off);
        $('#tax_price').val(tax_price);
        $('#roundoff').val(round_off);

        $(itemid).data('submit', 1);
        swal('', 'Item added.', 'success');
        var next_div = "#" + $('#item_64').parents('tr').find('.form-control').attr('id');
        $(next_div).focus();
    }


    function uniform_deletedisplay(item_id, price, tax_type, tax_value) {
        tax_value = 0;
        var discardid = '#discard_' + item_id;
        var disid = '#discard_' + item_id;
        var itemid = '#item_' + item_id;
        var net_value = $("#sub_total").val();
        var sum = $("#total_qty").val();
        var rounded_total = 0;
        if ($(itemid).data('submit') == 1) {
            if (net_value == 0 && sum == 0) {
                $("#total_qty").val(sum);
                $("#sub_total").val(net_value);
                $('#net_value').val(rounded_total);
            } else {
                var value = $(itemid).val();
                var price = price;

                sum = parseFloat(sum) - parseFloat(value);
                net_value = parseFloat(net_value) - (parseFloat(price) * parseFloat(value));

                sum = sum.toFixed(2);
                net_value = net_value.toFixed(2);

                $("#total_qty").val(sum);
                $("#sub_total").val(net_value);

                if (tax_type == 'P') {
                    var tax_amt = (parseFloat(tax_value) * parseFloat((parseFloat(price) * parseFloat(value)))) / 100;
                } else {
                    var tax_amt = parseFloat(tax_value) * parseFloat(value);
                }
                tax_amt = parseFloat(tax_amt.toFixed(2));
                var tax_price = $("#tax").val();
                tax_price = parseFloat(tax_price) - parseFloat(tax_amt);
                tax_price = parseFloat(tax_price.toFixed(2));
                $("#tax").val(tax_price);

                var net_val_after_tax = parseFloat(net_value) + parseFloat(tax_price);
                var value_after_cal_tax = parseFloat(net_val_after_tax.toFixed(2));
                var rounded_total = parseFloat(net_val_after_tax.toFixed());

                var round_off = parseFloat(rounded_total) - parseFloat(value_after_cal_tax);
                round_off = round_off.toFixed(2);

                $('#net_value').val(rounded_total);
                $('#reminder').val(1 - round_off);
                $('#tax_price').val(tax_price);
                $('#roundoff').val(round_off);

            }
        }

        //remove from table
        var table1 = $('#tbl_class_item').DataTable();
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

    function uniform_search_item() {
        var search_item = $("#searchitem").val();
        var store_id = $("#store_idd").val();

        var ops_url = baseurl + 'uniform/substore/search-item';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "search_item": search_item,
                "store_id": store_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#item-data-container').html('');
                    $('#item-data-container').html(data.view);
                    var animation = "fadeInDown";
                    $("#item-data-container").show();
                    $('#item-data-container').addClass('animated');
                    $('#item-data-container').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });


    }


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
                "width": "20%",
                className: "capitalize",
                "targets": 5,
                "orderable": false
            }
        ],

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
</script>