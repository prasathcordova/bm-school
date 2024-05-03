
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 10px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="font-size: 15px"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <!--<div class="ibox-tools">-->
                   <!--<span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C8; padding-right: 10px;" class="material-icons">save</i></a> </span>-->
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
                    <!--                    <div class="row" style="padding: 20px;">
                    
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-12 col-lg-12" >
                                                <b> Description</b>
                                                <div class="form-group">
                    
                                                    <input type="text" class="form-control text-uppercase"  name="description" id="description" value="" />
                    
                                                </div>
                                            </div>
                                        </div>-->


                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                        <div class="clearfix"> </div>

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
                                                    <th>Price/Qty</th>                          
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($allot_data['item_data']) && !empty($allot_data['item_data'])) {
                                                    foreach ($allot_data['item_data'] as $items) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo isset($items['item_code']) ? $items['item_code'] : ""; ?></td>
                                                            <td><?php echo isset($items['itemtype_name']) ? $items['itemtype_name'] : ""; ?></td>
                                                            <td><?php echo isset($items['barcode']) ? $items['barcode'] : ""; ?></td>
                                                            <td><?php echo isset($items['quantity']) ? $items['quantity'] : ""; ?></td>
                                                            <td><?php echo isset($items['price_per_qty']) ? $items['price_per_qty'] : ""; ?></td>
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
                        <!--<div class="clearfix"></div>-->
                        <div class="row" style="padding-right: 30px;" >
                            <div class="col-md-8" ></div>
                            <div class="col-md-2" >
                                <b> Total Items</b>
                                <div class="form-group">

                                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_items" value="<?php echo isset($allot_data['master_data']['net_quantity']) ? ($allot_data['master_data']['net_quantity']) : '0'; ?>" />

                                </div>
                            </div> 
                            <div class="col-md-2" >
                                <b>Total Amount</b>
                                <div class="form-group">

                                    <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="description" id="net_value" value="<?php echo isset($allot_data['master_data']['net_price']) ? ($allot_data['master_data']['net_price']) : '0'; ?>" />

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title"> 
                                    <h4>Comment History</h4>
                                </div>
                                <div class="ibox-content"> 
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_comment_system" >
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Commented By</th>                                                                                             
                                                    <th>Comment</th>                  
                                                    <th>Status</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($allot_data['comment_data']) && !empty($allot_data['comment_data'])) {
                                                    foreach ($allot_data['comment_data'] as $comments) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo isset($comments['createdon']) ? date('d-m-Y', strtotime($comments['createdon'])) : ""; ?></td>
                                                            <td><?php echo isset($comments['Emp_Name']) ? $comments['Emp_Name'] : ""; ?></td>
                                                            <td><?php echo isset($comments['comment']) ? base64_decode($comments['comment']) : ""; ?></td>                                                                            
                                                            <td><?php echo isset($comments['status_description']) ? $comments['status_description'] : ""; ?></td>
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
<input type="hidden" name="itemdata" id="itemdata" value="" />

<script type="text/javascript">
    var list_switchery = [];
    $('#tbl_select').dataTable({

        columnDefs: [
            {"width": "20%", className: "capitalize", "targets": 0},
            {"width": "25%", className: "capitalize", "targets": 1},
            {"width": "35%", className: "capitalize", "targets": 2},
            {"width": "20%", className: "capitalize", "targets": 3, "orderable": false}
        ],

        scrollX: true,
        scrollY: true,
        "fnInitComplete": function () {
            $('.dataTables_scrollBody').slimScroll({
                axis: 'x',
                width: '10px'
            });
        },

//        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Report'}
        ],
        "fnDrawCallback": function (ele) {
            activateSwitchery();
            $('.dataTables_scrollBody').slimScroll('destroy').slimScroll({
                axis: 'x',
                width: '10px'
            });
        }


    });

    $('#tbl_selected').dataTable({

        columnDefs: [
            {"width": "20%", className: "capitalize", "targets": 0},
            {"width": "30%", className: "capitalize", "targets": 1},
            {"width": "30%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3},
            {"width": "10%", className: "capitalize", "targets": 4, "orderable": false}
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Report'}
        ],
        "fnDrawCallback": function (ele) {
            activateSwitchery();
        }


    });
    $(document).ready(function () {
        activateSwitchery();

    });

    $('#tbl_comment_system').dataTable({
        columnDefs: [
            {"width": "10%", className: "capitalize", "targets": 0},
            {"width": "20%", className: "capitalize", "targets": 1},
            {"width": "20%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3},
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Allotment comment'}
        ],
        "language": {
            "emptyTable": "No comments available for this Allotment"
        }
    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#23C6C8', secondaryColor: '#F8AC59', size: 'small'});
            list_switchery.push(switchery);
        });
    }

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

    function select_item(item_id, item_name, item_code, selling_price, barcode) {

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
            console.log(cur_item_obj);
            $.each(cur_item_obj, function (i, v) {
                if (v == item_id) {
                    flag = 1;
                }

            });

        }
        console.log(flag);
        if (flag == 1) {
            swal('', 'Item already exist in selected list !', 'info');
            return false;
        } else {
            var item_id = item_id;
            var selling_price = selling_price;
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
                '<input type="textbox" size="3" class="form-control" name ="qty" id="item_' + item_id + '"  />',
                '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ',' + selling_price + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
//                '<a href="javascript:void(0);" onclick=""  data-toggle="tooltip" data-placement="right" title="Discard item" data-original-title="" id="discard" ><i class="fa fa-cross" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
            ]).draw();
        }

    }
    function valuedisplay(item_id, selling_price) {
        var selling_price = selling_price;
        var confirmid = '#confirm_' + item_id;
        var itemid = '#item_' + item_id;
        var value = $(itemid).val()
        $(confirmid).hide();
        var net_value = $("#net_value").val();
        var sum = $("#total_items").val();
        if (sum == '' && net_value == '') {
            sum = parseInt(value);
            net_value = selling_price * parseInt(value);
        } else {
            sum = parseInt(sum) + parseInt(value);
            net_value = parseInt(net_value) + (selling_price * parseInt(value));
        }
        $("#total_items").val(sum);
        $("#net_value").val(net_value);
    }


</script>