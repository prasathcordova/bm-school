<?php
$profile_image = "";
if (isset($emp_data[0]['profile_image']) && !empty($emp_data[0]['profile_image'])) {

    $profile_image = "data:image/png;base64," . $emp_data[0]['profile_image'];
} else {
    if (isset($emp_data['profile_image_alternate']) && !empty($emp_data['profile_image_alternate'])) {
        $profile_image = $emp_data['profile_image_alternate'];
    } else {
        $profile_image = base_url('assets/img/a0.jpg');
    }
}
?>


<?php
if (isset($emp_data) && !empty($emp_data)) {
    foreach ($emp_data as $emp) {
        //        print_r($emp);die;
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
                        <!--<i class="fa fa-info-circle"></i>-->
                        <?php echo $emp['Emp_Name'] ?> <small style="float: right;"> <?php echo $emp['Designation'] ?></small>
                        <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $emp['Emp_id'] ?>">
                    </div>
                    <div class="panel-body">
                        <div class=" input-group" style="padding-bottom: 5%;">
                            <input type="text" placeholder="Enter Item Code/Name/BarCode" class="input form-control" id="searchitem" name="searchitem">

                            <span class="input-group-btn">
                                <button type="button" class="btn btn btn-primary" onclick="search_item();"> <i class="fa fa-search"></i></button>
                                <input type="hidden" class="input form-control" id="store_idd" name="store_idd" value="<?php echo $store_idd ?>">
                            </span>
                        </div>

                        <div class="ScrollStyle">
                            <div class="wrapper wrapper-content animated fadeInRight" id="item-data-container">
                                <?php
                                if (isset($item_data) && !empty($item_data)) {
                                    //                            print_r($item_data);die;
                                    foreach ($item_data as $item) {
                                ?>

                                        <div class="col-lg-4">
                                            <div class="ibox float-e-margins">
                                                <?php // $price = (isset($item['rate']) && !empty($item['rate']) && $item['rate'] != NULL) ? $item['rate'] : $item['selling_price'] 
                                                ?>
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                    <a href="javascript:void(0);"> <span class="label label-info pull-right" onclick="add_list('<?php echo $item['item_code'] ?>', '<?php echo $item['item_name'] ?>', '<?php echo $item['itemtype_name'] ?>', '', '<?php echo $item['itemsid'] ?>');">Ready for delivery</span></a>
                                                    <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                                    <?php // echo $item['item_code'] 
                                                    ?>Bill no : xxx<br>
                                                    <?php // echo $item['barcode'] 
                                                    ?>
                                                </div>
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                    <?php // echo $item['item_name'] 
                                                    ?>Bill date : 29/12/2017</div>


                                                <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                    <span class="label label-warning pull-left">Amount <?php echo CURRENCY  ?> xx
                                                        <?php // echo (isset($item['rate']) && !empty($item['rate']) && $item['rate'] != NULL) ? $item['rate'] : $item['selling_price'] 
                                                        ?>
                                                    </span>
                                                    <!--                                <h5 class="no-margins">60</h5>
                                                                                    <small>Stock</small>-->
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
                        <a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 27px !important; float: right; color: #ffffff; padding-right: 0px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
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
                                    <?php
                                    //                                        if (isset($country_data) && !empty($country_data) && is_array($country_data)) {
                                    //                                            foreach ($country_data as $country) {
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--        <div class="row" >
            <div class="col-md-8" ></div>
            <div class="col-md-4" >
                <b> Total Quantity</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_qty" value="" />
                </div>
            </div> 
            <div class="col-md-4" >
                <b> Sub Total</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="sub_total" value="" />
                </div>
            </div> 
            <div class="col-md-4" >
                <b> Discount</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="discount" id="discount" value="0" />
                </div>
            </div> 
            <div class="col-md-4" >
                <b><?php echo TAXNAME ?></b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="tax" value="5%" />
                </div>
            </div>
            <div class="col-md-4" >
                <b>Total</b>
                <div class="form-group">
                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="net_value" value="" />
                </div>
            </div>
        </div>-->
    </div>
</div>

<input type="hidden" name="itemdata" id="itemdata" value="" />




<script>
    function submit_data() {

        var itemdata_raw = $('#itemdata').val();
        var itemdata = JSON.parse(itemdata_raw);
        var itemid = '';
        var priceid = '';
        var final_item = [];
        var data_counter = 0;
        $.each(itemdata, function(i, v) {
            itemid = '#item_' + v;

            var data_stat = $(itemid).data('submit');
            if (data_stat == 0) {
                swal('', 'Quantity not specified in some field', 'info');
                return false;
            }
        });
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
        var emp_id = $('#emp_id').val();
        var total_qty = $('#total_qty').val();
        var sub_total = $('#sub_total').val();
        var net_value = $('#net_value').val();

        //        alert(final_item_string);
        var ops_url = baseurl + 'substore/save-specimen_issue/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "emp_id": emp_id,
                "final_item_string": final_item_string,
                "data_counter": data_counter,
                "total_qty": total_qty,
                "sub_total": sub_total,
                "net_value": net_value
            },
            success: function(result_statt) {
                try {
                    var data = JSON.parse(result_statt);
                    //var data = jQuery.parseJSON(JSON.stringify(result));
                    //console.log(data);
                    if (data.status == 1) {
                        swal('Success', 'Item specimen placed successfully', 'success');
                        load_specimenpacking();
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

    function add_list(item_code, item_name, itemtype_name, price, item_id) {


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
                '<input type="textbox" class="form-control" name ="qty" id="item_' + item_id + '" data-submit="0" />',
                '<input type="textbox" disabled size="4" class="form-control" name ="price" id="price_' + item_id + '" value= ' + price + ' />',
                '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ',' + price + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a> \n\  <span id="confirmed_' + item_id + '" style="display:none;" class="label label-warning pull-left" >confirmed</span>',
                '<a href="javascript:void(0);"><span id="discard_' + item_id + '" class="label label-warning pull-left" onclick="deletedisplay(' + item_id + ', ' + price + ');" ><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>'

            ]).draw();
        }
        $('#searchitem').focus();

    }

    function valuedisplay(item_id, price) {
        var confirmid = '#confirm_' + item_id;
        var confirmedid = '#confirmed_' + item_id;
        var itemid = '#item_' + item_id;
        //        var priceid = '#price_' + item_id;
        var discardid = '#discard_' + item_id;
        var value = $(itemid).val()
        var price = price;

        if (value.length == 0) {
            swal('', 'Enter required quantity', 'info');
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

        $(confirmid).hide();
        $(confirmedid).show();
        var net_value = $("#sub_total").val();
        var sum = $("#total_qty").val();
        if (sum == '' && net_value == '') {
            sum = parseInt(value);
            net_value = parseInt(price) * parseInt(value);
        } else {
            sum = parseInt(sum) + parseInt(value);
            net_value = parseInt(net_value) + (parseInt(price) * parseInt(value));
        }
        $("#total_qty").val(sum);
        $("#sub_total").val(net_value);
        $(itemid).attr('readonly', true);
        //        $(priceid).attr('readonly', true);
        $(discardid).show();

        var net_val_after_discount = 0;
        var discount_amount = 0;
        if (parseInt(discount_amount)) {
            net_val_after_discount = net_value - parseInt(discount_amount)
        } else {
            net_val_after_discount = net_value;
        }

        var net_val_after_tax = 0;


        var tax_amt = 5;
        var tax_price = (net_val_after_discount * 5) / 100;
        //        alert(tax_price);return;

        if (parseInt(tax_amt)) {
            net_val_after_tax = net_val_after_discount + tax_price;
        } else {
            net_val_after_tax = net_val_after_discount;
        }

        var reminder = net_val_after_tax % 1;

        var rounded_total = 0;
        if ((reminder)) {

            rounded_total = net_val_after_tax + (1 - reminder);
        } else {
            rounded_total = net_val_after_tax;
        }

        $('#net_value').val(rounded_total);



        //        $('#net_value').val(net_val_after_tax);

        $(itemid).data('submit', 1);
        swal('', 'Item added.', 'success');
        var next_div = "#" + $('#item_64').parents('tr').find('.form-control').attr('id');
        $(next_div).focus();
    }


    function deletedisplay(item_id, price) {
        var discardid = '#discard_' + item_id;
        var disid = '#discard_' + item_id;

        var itemid = '#item_' + item_id;


        var net_value = $("#sub_total").val();
        var sum = $("#total_qty").val();
        var rounded_total = 0;
        if (net_value == 0 && sum == 0) {
            $("#total_qty").val(sum);
            $("#sub_total").val(net_value);
            $('#net_value').val(rounded_total);
        } else {
            var value = $(itemid).val();
            var price = price;

            sum = parseInt(sum) - parseInt(value);
            net_value = parseInt(net_value) - (parseInt(price) * parseInt(value));

            $("#total_qty").val(sum);
            $("#sub_total").val(net_value);

            //update final amount


            var net_val_after_discount = 0;
            var discount_amount = 0;
            if (parseInt(discount_amount)) {
                net_val_after_discount = net_value - parseInt(discount_amount)
            } else {
                net_val_after_discount = net_value;
            }




            var net_val_after_tax = 0;
            var tax_amt = 5;
            var tax_price = (net_val_after_discount * 5) / 100;
            //        alert(tax_price);return;

            if (parseInt(tax_amt)) {
                net_val_after_tax = net_val_after_discount + tax_price;
            } else {
                net_val_after_tax = net_val_after_discount;
            }

            var reminder = net_val_after_tax % 1;


            if ((reminder)) {
                rounded_total = net_val_after_tax + (1 - reminder);
            } else {
                rounded_total = net_val_after_tax;
            }
            //alert(rounded_total);
            $('#net_value').val(rounded_total);

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

    function search_item() {
        var search_item = $("#searchitem").val();
        var store_id = $("#store_idd").val();

        var ops_url = baseurl + 'substore/search-item';
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
        responsive: true,
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
</body>

</html>