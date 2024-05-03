
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 10px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="font-size: 15px"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> - <?php echo $store_name ?></h5>
                    <input type="hidden" value="<?php echo $store_id ?>" id="store_id">
                    <!--<div class="ibox-tools">-->
                    <span><a href="javascript:void(0);"  onclick="submit_allotment();" > <i style="font-size: 30px !important; float: right; color: #23C6C8; padding-right: 10px;" class="material-icons">save</i></a> </span>
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
                        <div class="col-md-6 col-lg-6" >
                            <b> Description</b>
                            <div class="form-group">
                                <input type="text" class="form-control text-uppercase"  name="description" id="description" value="" />

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6" >
                            <b> Total Quantity</b>
                            <div class="form-group">

                                <input type="text" readonly="true" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_items" value="0" />
                                <input type="hidden" readonly="true"  disabled name="net_value" id="net_value" value="0" />

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
                                                if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
                                                    foreach ($item_data as $item) {
                                                        ?>
                                                        <div class="col-lg-4 col-rt-pa-none">
                                                            <div class="purchase-list">
                                                                <div class="widget style1 "  class="learn-more" >
                                                                    <b> Item Code : <?php echo $item['item_code']; ?><a href="javascript:void(0);" onclick="select_item('<?php echo $item['itemsid']; ?>', '<?php echo $item['itemtype_name']; ?>', '<?php echo $item['item_code']; ?>', '<?php echo $item['barcode']; ?>', '<?php echo $item['selling_price']; ?>', '<?php echo $item['rate']; ?>');"  data-toggle="tooltip" data-placement="right" title="Move <?php echo $item['item_name']; ?> to selected items" data-original-title="<?php echo $item['item_name']; ?>" id="select" ><i class="fa fa-paper-plane" style="font-size: 24px; color: #45aaaa; margin: 2%; float: right;"></i></a></b>                                                       
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


                        </div>


                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title"> 
                                    <!--<h2>Selected Items</h2>-->
                                    <h5 style="font-size: 15px">Selected Items</h5>
                                </div>
                                <div class="ibox-content"> 
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_selected" >

                                            <thead>
                                                <tr>
                                                    <th> Item Code</th>
                                                    <th>Item Name</th>
                                                    <th>Barcode</th>             
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
    .ibox-new-2{padding:15px !important;}

    .form-group-new input{border-radius:3px; border:none;}

    div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }
    .ScrollStyle
    {
        max-height: 300px;
        overflow-y: scroll;
    }

</style>

<script type="text/javascript">
    function submit_allotment() {
        var store_id = $("#store_id").val();
        var total_items = $("#total_items").val();
        var description = $("#description").val();
        var net_value = $("#net_value").val();
        if (total_items == '' && net_value == '') {
            swal('', 'No item has been confirmed..!!', 'info');
            return false;
        }
        if (description == '') {
            swal('', 'Description is needed!!', 'info');
            return false;
        }
        var itemdata = [];
        $('.stock-allotment').each(function (i, v) {
            var data = [];
            var itemcode = $(v).data('itemcode');
            var itemid = $(v).data('itemid');
            var itemname = $(v).data('itemname');
            var barcode = $(v).data('barcode');
            var selling_price = $(v).data('selling_price');

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
            var quantity = $(v).val();
            data['itemid'] = itemid;
            data['itemcode'] = itemcode;
            data['itemname'] = itemname;
            data['quantity'] = quantity
//            data['selling_price'] = selling_price
//            data['rate'] = rate
            data['price'] = price
            itemdata.push({"itemid": itemid, "quantity": quantity, "price": price, "isadded": isadded});

        });
        var formatted_itemdata = JSON.stringify(itemdata)
        var ops_url = baseurl + 'allotment/save-allotment';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "itemdata": formatted_itemdata, "total_items": total_items, "net_value": net_value, "description": description, "store_id": store_id},
            success: function (result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'Stock alloted successfully', 'success');
                    load_allotment();
                } else {
                    swal('', 'Stock allocation failed', 'info');
                }
            }
        });

    }



    $('#tbl_selected').dataTable({

        columnDefs: [
            {"width": "20%", className: "capitalize", "targets": 0},
            {"width": "30%", className: "capitalize", "targets": 1},
            {"width": "30%", className: "capitalize", "targets": 2},
            {"width": "15%", className: "capitalize", "targets": 3},
            {"width": "5%", className: "capitalize", "targets": 4, "orderable": false}
        ],
//        responsive: true,
        iDisplayLength: 10,

    });



    function select_item(item_id, item_name, item_code, barcode, selling_price, rate) {
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
            $.each(cur_item_obj, function (i, v) {
                if (v == item_id) {
                    flag = 1;
                }

            });

        }
//        console.log(flag);
        if (flag == 1) {
            swal('', 'Item already exist in selected list !', 'info');
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
                barcode,
                '<input style="width:100%;" class="stock-allotment total_items" type="textbox" data-isadded="0" data-itemid="' + item_id + '" data-itemcode="' + item_code + '" data-itemname="' + item_name + '" data-barcode="' + barcode + '"data-selling_price="' + selling_price + '"data-rate="' + rate + '"   size="3"  name ="qty" id="item_' + item_id + '"  />',
                '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ',' + price + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a><a href="javascript:void(0);" onclick="deletedisplay(' + item_id + ')"   data-toggle="tooltip" data-placement="right" style="display: none" title="Discard item" data-original-title="" id="discard_' + item_id + '" ><i class="fa fa-times" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
//                '<a href="javascript:void(0);" onclick=""  data-toggle="tooltip" data-placement="right" title="Discard item" data-original-title="" id="discard" ><i class="fa fa-cross" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
            ]).draw();
        }
        $('#search_item').focus();
    }
    function valuedisplay(item_id,price) {
//    alert(price);

        var confirmid = '#confirm_' + item_id;
        var itemid = '#item_' + item_id;
        var discardid = '#discard_' + item_id;
        var value = $(itemid).val()
        $(itemid).data('isadded', 1);
        $(confirmid).hide();
        $(discardid).show();
        var net_value = $("#net_value").val();
        var sum = $("#total_items").val();
        if (sum == '' && net_value == '') {
            sum = parseInt(value);
            net_value = price * parseInt(value);
        } else {
            sum = parseInt(sum) + parseInt(value);
            net_value = parseInt(net_value) + (price * parseInt(value));
        }
        $("#total_items").val(sum);
        $("#net_value").val(net_value);
//        alert(net_value);
        $(itemid).prop('readonly', true)
    }

    $('#search_item').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            search_item();
            $('#search_item').focus();
        }

    });

    function deletedisplay(item_id) {
        var discardid = '#discard_' + item_id;
        var disid = '#discard_' + item_id;
        var itemid = '#item_' + item_id;

        var sum = $("#total_items").val();

        var value = $(itemid).val()


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
            $.each(cur_item_obj, function (i, v) {
                if (v != item_id) {
                    cur_item_obj_new.push(v);
                }
            });
            var cur_j_item = JSON.stringify(cur_item_obj_new);
            $('#itemdata').val(cur_j_item);
        }

    }

    function search_item() {
        var search_query = $('#search_item').val();
        var ops_url = baseurl + 'allotment/allotment-search/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "search_query": search_query},
            success: function (result) {
//                alert(result);
                $('.ScrollStyle').html('');
                $('.ScrollStyle').html(result);
                $('#search_item').focus();
            }
        });
    }

</script>