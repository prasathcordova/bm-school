<script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> </h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 35px !important;  float: right;color: #23C6C5;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
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
                                            <div class="ibox purchase-sec">
                                                <div class="ibox-title">
                                                    <h4>Items List</h4>
                                                </div>
                                                <div class="scroll_content">
                                                    <div class=" input-group">
                                                        <input type="hidden" id="store_id" value="<?php echo $store_id ?>">
                                                        <input type="text" id="search_item" placeholder="Search Item By Code/Name/Barcode" class="input form-control">
                                                        <span class="input-group-btn">
                                                            <button type="button" id="button_id" class="btn btn btn-primary" onclick="search_item();"> <i class="fa fa-search"></i></button>
                                                        </span>
                                                    </div>
                                                    <div class="ScrollStyle">
                                                        <div class="row row-new" id="search-content">
                                                            <?php
                                                            if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
                                                                foreach ($item_data as $item) {
                                                                    $i = 0;
                                                            ?>
                                                                    <div class="col-lg-4" style="padding-left: 17px;padding-top: 2px;">
                                                                        <div class="ibox float-e-margins">
                                                                            <?php $price = (isset($item['rate']) && !empty($item['rate']) && $item['rate'] != NULL) ? $item['rate'] : $item['selling_price'] ?>
                                                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 50px;">
                                                                                <a title="Add  <?php echo $item['item_name'] ?> to list "><span class="label label-info pull-right" onclick="add_list('<?php echo $item['item_code'] ?>', '<?php echo $item['barcode'] ?>', '<?php echo $item['itemtype_name'] ?>', '<?php echo $price ?>', '<?php echo $item['itemsid'] ?>', '<?php echo $item['tax_type'] ?>', '<?php echo $item['tax_value'] ?>');">Add to list</span></a>
                                                                                <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->

                                                                                <?php echo $item['item_code']; ?><br />
                                                                                <?php echo $item['barcode']; ?>
                                                                            </div>
                                                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                                <?php echo $item['item_name']; ?></div>


                                                                            <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                                                <span class="label label-warning pull-left" title="Amount"><?php echo CURRENCY  ?> <?php echo (isset($item['rate']) && !empty($item['rate'])) ? $item['rate'] : $item['selling_price']; ?></span>
                                                                                <!--                                <h5 class="no-margins">60</h5>
                                                                                                                <small>Stock</small>-->
                                                                                <div title="Available stock" class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;">stock</i><?php echo $item['stock']; ?></div>

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
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_selected">
                                                            <thead>
                                                                <tr>
                                                                    <th>Item Code</th>
                                                                    <th>Barcode</th>
                                                                    <th>Item Type</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price/Qty</th>
                                                                    <th>Confirm</th>
                                                                    <th>Remove</th>
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


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Total Quantity</label>
                                                <div class="col-sm-12">
                                                    <!--<input type="email" class="form-control disabled" id="inputEmail3"  placeholder="">-->
                                                    <input type="text" id="total_qty" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="description" id="sub_total" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Sub Total</label>
                                                <div class="col-sm-12">
                                                    <!--<input type="email" class="form-control disabled" id="inputEmail3"  placeholder="">-->
                                                    <input type="text" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="description" id="sub_total" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label"><?php echo TAXNAME  ?></label>
                                                <div class="col-sm-12">
                                                    <input type="text" value="0" disabled="" style="background-color: #FFFFFF;" class="form-control" id="vat" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Discount</label>
                                                <div class="col-sm-12">
                                                    <input type="text" value="0" disabled="" style="background-color: #FFFFFF;" class="form-control" id="discount" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="check_dis" style="display:none;">
                                            <label class="form-check-label col-sm-12 " style="font-weight:normal;">
                                                <b>Discount</b>(-)
                                                <input class="form-check-input" style="margin:0 0 0 15px;" type="radio" name="gridRadios" id="dis_rate" value="0" checked>
                                                Rate(%)
                                                <input class="form-check-input" style="margin:0 0 0 15px;" type="radio" name="gridRadios" id="dis_fixed" value="1" checked>
                                                Fixed
                                            </label>
                                            <div class=" input-group">
                                                <!--<input type="text" value="0" class="form-control" id="discount" placeholder=""><p style="display:inline-block; padding: 0 0 0 5px"></p>-->
                                                <span class="input-group-btn">
                                                    <button style="margin-bottom: 18px;" type="button" class="btn btn btn-primary" onclick="change_valuedisplay();">Go</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label f class="col-sm-12 col-form-label">Round Off(+/-)</label>
                                                <div class="col-sm-12">
                                                    <input type="text" style="background-color: #FFFFFF;" class="form-control digits" id="roundoff" placeholder="Round Off(+/-)" onchange="round_off_change()">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-12 col-form-label">Final Total</label>
                                                <div class="col-sm-12">
                                                    <input type="text" style="background-color: #FFFFFF;" disabled class="form-control" id="finaltotal" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </body>

                        </html>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="itemdata" id="itemdata" value="" />
<input type="hidden" name="value_after_tax" id="value_after_tax" value="0" />
<input type="hidden" name="template_id" id="template_id" value="<?php echo $template_id ?>" />




<style>
    .ibox-new-2 {
        padding: 15px !important;
    }

    .form-group-new input {
        border-radius: 3px;
        border: none;
    }

    div.dataTables_wrapper {
        /*//width: 800px;*/
        margin: 0 auto;
    }
</style>

<script type="text/javascript">
    var input = document.getElementById("search_item");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id").click();
            add_to_list();
        }
    });

    function add_to_list() {
        if ($('#flag_value').val() == 1) {
            var item_code_id = $('#item_code_id').val();
            var barcode_id = $('#barcode_id').val();
            var itemtype_name_id = $('#itemtype_name_id').val();
            var price_id = $('#price_id').val();
            var itemsid_id = $('#itemsid_id').val();
            var tax_type_id = $('#tax_type_id').val();
            var tax_value_id = $('#tax_value_id').val();
            add_list(item_code_id, barcode_id, itemtype_name_id, price_id, itemsid_id, tax_type_id, tax_value_id);


        }
    }
    $(document).ready(function() {

        $("#discount").keydown(function(event) {
            if (event.shiftKey) {
                event.preventDefault();
            }

            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 110) {} else {
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
    });

    $('.ScrollStyle').slimscroll({
        height: '150px'
    })

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    function round_off_change() {

        var roundoff = $('#roundoff').val();
        if (roundoff == '') {
            roundoff = 0;
            $('#roundoff').val(0);
        }
        var subtotal = $('#sub_total').val();
        var vat = $('#vat').val();
        var discount = $('#discount').val();
        var vat = $('#vat').val();
        var final_total = parseFloat(roundoff) + parseFloat(subtotal) + parseFloat(vat) - parseFloat(discount);
        $('#finaltotal').val(final_total);
    }


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
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 6,
                "orderable": false
            }
        ],
        responsive: false,
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
        "fnDrawCallback": function(ele) {}


    });

    function search_item() {
        var search = $("#search_item").val();
        var store_id = $("#store_id").val();

        var ops_url = baseurl + 'substore/search-ohstoredata/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "search": search,
                "store_id": store_id
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $("#search-content").html('');
                    $("#search-content").html(data.view);


                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');
                    //                    activate_toast("Connection Error", 'Error', 'error');
                }
            }
        });

    }



    function add_list(item_code, barcode, itemtype_name, price, item_id, tax_type, tax_value) {


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
        if (flag == 0) {
            swal('', 'Item added', 'success');
        }


        if (flag == 1) {
            swal('', 'Item already exist in selected list ', 'info');
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
                '<input type="textbox" class="form-control numericDecimal" name ="qty" id="item_' + item_id + '" data-submit="0" />',
                '<input type="textbox" size="4" class="form-control numericDecimal" disabled data-taxtype = "' + tax_type + '" data-taxamount = "' + tax_value + '" name ="price" id="price_' + item_id + '" value= ' + price + ' />',
                '<a href="javascript:void(0)" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ',' + price + ' ,\'' + tax_type + '\',' + tax_value + '  )"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a> \n\  <span id="confirmed_' + item_id + '" style="display:none;" class="label label-warning pull-left" >CONFIRMED</span>',
                '<a href="javascript:void(0)" data-toggle="tooltip" title = "Remove this item from list"><span id="discard_' + item_id + '" class="label label-warning pull-left" onclick="deletedisplay(' + item_id + ',' + price + ' ,\'' + tax_type + '\',' + tax_value + '  );" ><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>'

            ]).draw();
        }


        $('#searchitem').focus();

    }

    function valuedisplay(item_id, price, tax_type, tax_value) {

        //        alert(item_id);
        var confirmid = '#confirm_' + item_id;
        var confirmedid = '#confirmed_' + item_id;
        var itemid = '#item_' + item_id;
        var priceid = '#price_' + item_id;
        var discardid = '#discard_' + item_id;
        var value = $(itemid).val()


        var price = price;
        //var price = $(priceid).val()

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
        //        if ((value) % 1) {
        //            swal('', 'Enter valid quantity', 'info');
        //            return false;
        //        }

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
        $(priceid).attr('readonly', true);
        $(discardid).show();

        //        var tax_amt = 0
        if (tax_type == 'P') {
            var tax_amt = (parseFloat(tax_value) * parseFloat((parseFloat(price) * parseFloat(value)))) / 100;
        } else {
            var tax_amt = parseFloat(tax_value) * parseFloat(value);
        }
        //        alert(tax_amt);
        //         var taxamount = (( parseFloat(price) *  parseFloat(value)) * tax_amt)/100;


        var taxxx = $("#vat").val();
        //        var taxxx = 0;
        taxxx = parseFloat(taxxx) + parseFloat(tax_amt);
        taxxx = taxxx.toFixed(2);
        $("#vat").val(taxxx);




        var tax_price = taxxx;

        //        if (parseFloat(tax_amt)) {
        var net_val_after_tax = parseFloat(net_value) + parseFloat(taxxx);

        //        } else {
        //            var net_val_after_tax = net_value;
        //        }
        //hidden value if change in discount
        $("#value_after_tax").val(net_val_after_tax);


        var disc_type = $('input[name=gridRadios]:checked', '#check_dis').val();

        var discount = $("#discount").val();
        if (disc_type == 1) {
            var discount_amount = discount;
        } else {
            var discount_amount = (parseFloat(net_val_after_tax) * parseFloat(discount)) / 100;
        }



        if (parseFloat(discount_amount)) {
            var net_val_after_discount = parseFloat(net_val_after_tax) - parseFloat(discount_amount)
        } else {
            var net_val_after_discount = parseFloat(net_val_after_tax);
        }


        var value_after_discount = net_val_after_discount;

        net_val_after_discount = net_val_after_discount.toFixed();

        var reminder = parseFloat(net_val_after_discount) - parseFloat(value_after_discount);


        $("#roundoff").val(parseFloat(reminder.toFixed(2)));

        $('#finaltotal').val(parseFloat(net_val_after_discount));


        $(itemid).data('submit', 1);
        swal('', 'Item added.', 'success');
        var next_div = "#" + $('#item_64').parents('tr').find('.form-control').attr('id');
        $(next_div).focus();
    }

    function deletedisplay(item_id, price, tax_type, tax_value) {
        var discardid = '#discard_' + item_id;
        var disid = '#discard_' + item_id;

        var itemid = '#item_' + item_id;

        var data_status = $(itemid).data('submit');

        if (data_status == 1) {
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

                sum = parseFloat(sum) - parseFloat(value);
                net_value = parseFloat(net_value) - (parseFloat(price) * parseFloat(value));
                sum = sum.toFixed(2);
                net_value = net_value.toFixed(2);
                $("#total_qty").val(sum);
                $("#sub_total").val(net_value);
                //                alert(tax_type);
                //                var tax_amt = 0
                if (tax_type == 'P') {
                    var tax_amt = (parseFloat(tax_value) * parseFloat((parseFloat(price) * parseFloat(value)))) / 100;
                } else {
                    var tax_amt = parseFloat(tax_value) * parseFloat(value);
                }
                //                alert(tax_amt);
                var taxxx = $("#vat").val();
                //        var taxxx = 0;
                taxxx = parseFloat(taxxx) - parseFloat(tax_amt);
                taxxx = taxxx.toFixed(2);
                $("#vat").val(taxxx);

                if (net_value == 0 && sum == 0) {
                    $("#vat").val(0);
                }


                //                $("#vat").val(tax_amt);


                var tax_price = taxxx;

                //                if (parseFloat(tax_price)) {
                var net_val_after_tax = parseFloat(net_value) + parseFloat(taxxx);
                //                } else {
                //                var net_val_after_tax = net_value * parseFloat(value);
                //            }
                //hidden value if change in discount
                $("#value_after_tax").val(net_val_after_tax);


                var disc_type = $('input[name=gridRadios]:checked', '#check_dis').val();
                var discount_amount = 0;
                var discount = $("#discount").val();
                if (disc_type == 1) {
                    discount_amount = discount;
                } else {
                    discount_amount = (parseFloat(net_val_after_tax) * parseFloat(discount)) / 100;
                }


                if (parseFloat(discount_amount)) {
                    var net_val_after_discount = parseFloat(net_val_after_tax) - parseFloat(discount_amount)
                } else {
                    var net_val_after_discount = parseFloat(net_val_after_tax);
                }


                var value_after_discount = net_val_after_discount;

                net_val_after_discount = net_val_after_discount.toFixed();

                var reminder = parseFloat(net_val_after_discount) - parseFloat(value_after_discount);


                $("#roundoff").val(parseFloat(reminder.toFixed(2)));

                $('#finaltotal').val(parseFloat(net_val_after_discount));




                $(itemid).data('submit', 0);
                swal('', 'Item removed ', 'success');


            }
        }



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



    function change_valuedisplay() {

        var net_val_after_tax = $("#value_after_tax").val();
        var disc_type = $('input[name=gridRadios]:checked', '#check_dis').val();

        var discount_amount = 0;
        var discount = $("#discount").val();
        var RE = /^\d*\.?\d*$/;
        if (!RE.test(discount)) {
            swal('', "Enter a valid floating number", 'info');
            return true;
        }
        if (disc_type == 1) {
            discount_amount = parseFloat(discount);
            if (discount > net_val_after_tax) {
                swal('', 'Enter the discount amount less that subtotal + vat  ', 'info');
                return false;
            }
        } else {
            if (discount > 100) {
                swal('', 'Enter the discount rate less than 100 % ', 'info');
                return false;
            }
            discount_amount = (parseFloat(net_val_after_tax) * parseFloat(discount)) / 100;
        }



        if (parseFloat(discount_amount)) {
            var net_val_after_discount = parseFloat(net_val_after_tax) - parseFloat(discount_amount)
        } else {
            var net_val_after_discount = parseFloat(net_val_after_tax);
        }


        var value_after_discount = net_val_after_discount;

        net_val_after_discount = net_val_after_discount.toFixed();

        var reminder = parseFloat(net_val_after_discount) - parseFloat(value_after_discount);


        $("#roundoff").val(parseFloat(reminder.toFixed(2)));

        $('#finaltotal').val(parseFloat(net_val_after_discount));

    }


    function submit_data() {
        var template_id = $('#template_id').val();
        var total_qty = $('#total_qty').val();
        var sub_total = $('#sub_total').val();
        var discount = $('#discount').val();
        var roundoff = $('#roundoff').val();
        var finaltotal = $('#finaltotal').val();
        var vat = $('#vat').val();


        var disc_type = $('input[name=gridRadios]:checked', '#check_dis').val();


        if (disc_type == 1) {
            var discount_type = 'F';
        } else {
            var discount_type = 'R';
        }




        var itemdata_raw = $('#itemdata').val();
        if (($('#itemdata').val()).length < 3) {
            swal('', 'Atleast add one item to the list', 'info');
            return false;
        }
        var itemdata = JSON.parse(itemdata_raw);
        var itemid = '';
        var priceid = '';
        var final_item = [];
        var data_counter = 0;
        var set_flag = 0;
        $.each(itemdata, function(i, v) {
            itemid = '#item_' + v;

            var data_stat = $(itemid).data('submit');
            if (data_stat == 0) {

                set_flag = 1;
            }
        });
        if (set_flag == 1) {
            swal('', 'Confirm the items in the list or remove item', 'info');
            return false;
        }
        var table = $('#tbl_selected').DataTable();
        $.each(itemdata, function(i, v) {
            itemid = '#item_' + v;
            priceid = '#price_' + v;
            var item_qty = table.$(itemid).val();
            var item_price = table.$(priceid).val();
            var taxtype = table.$(priceid).data('taxtype');
            var taxvalue = table.$(priceid).data('taxamount');

            var data_stat = table.$(itemid).data('submit');
            if (data_stat == 1) {
                final_item.push({
                    item_id: v,
                    qty: item_qty,
                    price: item_price,
                    taxtype: taxtype,
                    taxvalue: taxvalue
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
        var ops_url = baseurl + 'substore/save-oh_item/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "template_id": template_id,
                "total_qty": total_qty,
                "sub_total": sub_total,
                "discount": discount,
                "vat": vat,
                "final_item_string": final_item_string,
                "roundoff": roundoff,
                "finaltotal": finaltotal,
                "discount_type": discount_type
            },
            success: function(result_statt) {
                try {
                    var data = JSON.parse(result_statt);
                    //var data = jQuery.parseJSON(JSON.stringify(result));
                    //console.log(data);
                    if (data.status == 1) {
                        swal('Success', 'OH Item added successfully', 'success');
                        load_ohitempacking();
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while adding items to template. Please try again later or contact administrator with error code : PODTAER10003', 'info');
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
</script>