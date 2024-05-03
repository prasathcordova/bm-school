
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
                    <div class="row" style="padding: 20px;">

                        <div class="col-md-2">
                        </div>
                        <div class="col-md-12 col-lg-12" >
                            <b> Description</b>
                            <div class="form-group">

                                <input type="text" class="form-control text-uppercase"  name="description" id="description" value="" />

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                        <div class="clearfix"> </div>
                        <div class="col-lg-4">

                            <div class="ibox purchase-sec">
                                <div class="ibox-title"> 
                                    <h4>Items List</h4>
                                </div>
                                <div class="scroll_content">
                                    <div class=" input-group">
                                        <input type="text" placeholder="Search Item Code / Item " class="input form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                    <div class="ScrollStyle">
                                        <div class="row row-new">
                                                <?php
//                                                                                dev_export($item_data);die;
                                                if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
                                                    foreach ($item_data as $item) {
                                                        ?>
                                                    <div class="col-lg-12 col-rt-pa-none">
                                                        <div class="purchase-list">
                                                            <div class="widget style1 "  class="learn-more" >
                                                                <b> Item Code : <?php echo $item['item_code']; ?><a href="javascript:void(0);" onclick="select_item('<?php echo $item['itemsid']; ?>', '<?php echo $item['itemtype_name']; ?>', '<?php echo $item['item_code']; ?>', '<?php echo $item['selling_price']; ?>', '<?php echo $item['rate']; ?>', '<?php echo $item['barcode']; ?>');"  data-toggle="tooltip" data-placement="right" title="Move <?php echo $item['item_name']; ?> to selected items" data-original-title="<?php echo $item['item_name']; ?>" id="select" ><i class="fa fa-paper-plane" style="font-size: 24px; color: #45aaaa; margin: 2%; float: right;"></i></a></b>                                                       
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


                        <div class="col-lg-8">
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
                    <div class="row" >
                        <div class="col-md-8" ></div>
                        <div class="col-md-2" >
                            <b> Total Items</b>
                            <div class="form-group">

                                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_items" value="" />

                            </div>
                        </div> 
                        <div class="col-md-2" >
                            <b>Total Amount</b>
                            <div class="form-group">

                                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="net_value" value="" />

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
        max-height: 500px;
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
            data['selling_price'] = selling_price
            data['rate'] = rate
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



    $('#tbl_select').dataTable({

//        columnDefs: [
//            {"width": "20%", className: "capitalize", "targets": 0},
//            {"width": "25%", className: "capitalize", "targets": 1},
//            {"width": "35%", className: "capitalize", "targets": 2},
//            {"width": "20%", className: "capitalize", "targets": 3, "orderable": false}
//        ],


//        scrollX : true,
//     scrollY : true,
//     "fnInitComplete":function(){ $('.dataTables_scrollBody').slimScroll({
//               axis: 'x',
//                  width:'10px'
//          }); },

//        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Report'}
        ],
//        "fnDrawCallback": function (ele) {
//            activateSwitchery();
//            $('.dataTables_scrollBody').slimScroll('destroy').slimScroll({
//                axis: 'x',
//                width:'10px'
//            });
//        }


    });

    $('#tbl_selected').dataTable({

//        columnDefs: [
//            {"width": "20%", className: "capitalize", "targets": 0},
//            {"width": "30%", className: "capitalize", "targets": 1},
//            {"width": "30%", className: "capitalize", "targets": 2},
//            {"width": "10%", className: "capitalize", "targets": 3},
//            {"width": "10%", className: "capitalize", "targets": 4, "orderable": false}
//        ],
//        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Report'}
        ],
//        "fnDrawCallback": function (ele) {
//            activateSwitchery();
//        }


    });


    $(".select2_demo_1").select2({"theme": "bootstrap",
        width: "100%", placeholder: "Select Item type"});
    $(".select2_demo_2").select2({"theme": "bootstrap",
        width: "100%", placeholder: "Select publisher"});
    $(".select2_demo_3").select2({"theme": "bootstrap",
        "width": "100%", width: "100%", placeholder: "Select category"});
    $(".select2_demo_4").select2({"theme": "bootstrap",
        "width": "100%", width: "100%", placeholder: "Select category"});
    $(".select2_demo_5").select2({"theme": "bootstrap",
        "width": "100%", width: "100%", placeholder: "Select publisher"});
    $(".select2_demo_6").select2({"theme": "bootstrap",
        "width": "100%", width: "100%", placeholder: "Select Item type"});
    $(".select2_demo_7").select2({"theme": "bootstrap",
        "width": "100%", width: "100%", placeholder: "Select a state"});

    function select_item(item_id, item_name, item_code, selling_price, rate, barcode) {
//alert(rate);

        if (rate == '') {
            var price = selling_price;

        } else {
            var price = rate;
        }
        var flag = 0;
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
            var selling_price = selling_price;
            var rate = rate;
//           console.log(rate);
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
                '<input  class="stock-allotment" type="textbox" data-isadded="0" data-itemid="' + item_id + '" data-itemcode="' + item_code + '" data-itemname="' + item_name + '" data-barcode="' + barcode + '" data-selling_price="' + selling_price + '"data-rate="' + rate + '"  size="3" class="form-control" name ="qty" id="item_' + item_id + '"  />',
                '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ',' + price + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
//                '<a href="javascript:void(0);" onclick=""  data-toggle="tooltip" data-placement="right" title="Discard item" data-original-title="" id="discard" ><i class="fa fa-cross" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
            ]).draw();
        }

    }
    function valuedisplay(item_id, price) {
 
        var confirmid = '#confirm_' + item_id;
        var itemid = '#item_' + item_id;
        var value = $(itemid).val()
       $(itemid).data('isadded', 1);        
        $(confirmid).hide();
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
    }


</script>