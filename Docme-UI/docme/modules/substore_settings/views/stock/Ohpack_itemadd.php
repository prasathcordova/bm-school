<script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php //echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" 
                        ?> <?php //echo $supplier_name 
                            ?>
                        <h5> OH Item Adding to IT 01
                            <input type="hidden" name="supplier_id" id="supplier_id" value="<?php // echo $supplier_id 
                                                                                            ?>" />
                        </h5>
                        <div class="ibox-tools" id="add_type">
                            <span><a href="javascript:void(0);" onclick="();"> <i style="font-size: 35px !important;  float: right;color: #23C6C5;" class="material-icons">save</i></a> </span>
                        </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <!--                        <div style="padding-left : 10px;">
                        <h5>SUPPLIER : <?php // echo $supplier_name 
                                        ?></h5>
                        </div>-->

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
                                                        <input type="text" placeholder="Enter Item Code/Name/" class="input form-control">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i></button>
                                                        </span>
                                                    </div>
                                                    <div class="ScrollStyle">
                                                        <div class="row row-new">

                                                            <div class="col-lg-4">
                                                                <div class="ibox float-e-margins">
                                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                        <span class="label label-info pull-right">Add to list</span>
                                                                        <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                                                        Item Code:XXXX
                                                                    </div>
                                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                        Physics Text</div>


                                                                    <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                                        <span class="label label-warning pull-left"><?php echo CURRENCY  ?> $87</span>
                                                                        <!--                                <h5 class="no-margins">60</h5>
                                <small>Stock</small>-->
                                                                        <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>20</div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="ibox float-e-margins">
                                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                        <span class="label label-info pull-right">Add to list</span>
                                                                        <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                                                        Item Code:XXXX
                                                                    </div>
                                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                        Physics Text</div>


                                                                    <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                                        <span class="label label-warning pull-left"><?php echo CURRENCY  ?> $87</span>
                                                                        <!--                                <h5 class="no-margins">60</h5>
                                <small>Stock</small>-->
                                                                        <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>20</div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="ibox float-e-margins">
                                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                        <span class="label label-info pull-right">Add to list</span>
                                                                        <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                                                        Item Code:XXXX
                                                                    </div>
                                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                        Physics Text</div>


                                                                    <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                                        <span class="label label-warning pull-left"><?php echo CURRENCY  ?> $87</span>
                                                                        <!--                                <h5 class="no-margins">60</h5>
                                <small>Stock</small>-->
                                                                        <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>20</div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="ibox float-e-margins">
                                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                        <span class="label label-info pull-right">Add to list</span>
                                                                        <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                                                        Item Code:XXXX
                                                                    </div>
                                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                        Physics Text</div>


                                                                    <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                                        <span class="label label-warning pull-left"><?php echo CURRENCY  ?> $87</span>
                                                                        <!--                                <h5 class="no-margins">60</h5>
                                <small>Stock</small>-->
                                                                        <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>20</div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--                  <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                
                                <h5>Physics Text</h5>
                                <span class="label label-warning pull-right">Select</span>
                                <span class="label label-primary pull-right"><i class="fa fa-paper-plane" style="font-size: 18px;  margin: 2%; margin-bottom: 5%; float: right;"></i></span>
                                <span class="label label-info pull-right"><i class="fa fa-paper-plane-o" style="font-size: 24px;" aria-hidden="true"></i></span>
                                <div class="i-checks pull-right" ><label> <input type="checkbox" value="option1" name="a"></label></div>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins">Physics Text</h3>
                                  <span class="label label-info ">Price:$87</span>
                                <div class="stat-percent font-bold text-info">Price:DHS 20 </div>
                                <div class="stat-percent font-bold text-info">Item Code:XXXX </div>
                                 <span class="label label-info pull-right">Price:$87</span>
                                <small>code</small>
                            </div>
                        </div>
                    </div>-->
                                                            <?php
                                                            //                                                            }
                                                            //                                                        }
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
                                                <label for="inputEmail3" class="col-sm-12 col-form-label">Total</label>
                                                <div class="col-sm-12">
                                                    <!--<input type="email" class="form-control disabled" id="inputEmail3"  placeholder="">-->
                                                    <input type="text" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="description" id="total_qty" value="" />
                                                </div>
                                            </div>


                                            <div class="row">
                                                <label class="form-check-label col-sm-12 " style="font-weight:normal;">
                                                    <b>Discount</b>(-)
                                                    <input class="form-check-input" style="margin:0 0 0 15px;" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                    Rate(%)
                                                    <input class="form-check-input" style="margin:0 0 0 15px;" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                    Fixed
                                                </label>
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control"" id=" inputEmail3" placeholder="">
                                                    <p style="display:inline-block; padding: 0 0 0 5px"></p>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-12 col-form-label"><?php echo TAXNAME  ?></label>
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control" id="inputEmail3" placeholder="">
                                                </div>
                                            </div>


                                        </div>


                                        <div class="col-md-6">

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-12 col-form-label">Net Total</label>
                                                <div class="col-sm-12">
                                                    <input type="text" style="background-color:#FFFFFF" class="form-control text-uppercase" disabled name="description" id="total_qty" value="" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-12 col-form-label">Round Off</label>
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control" id="inputEmail3" placeholder="">
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




    <style>
        .ibox-new-2 {
            padding: 15px !important;
        }

        .form-group-new input {
            border-radius: 3px;
            border: none;
        }

        div.dataTables_wrapper {

            margin: 0 auto;
        }
    </style>

    <script type="text/javascript">
        $('.ScrollStyle').slimscroll({
            height: '150px'
        })

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });


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

        function select_item(item_id, itemtype_name, item_code, selling_price, barcode) {

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
                $.each(cur_item_obj, function(i, v) {
                    if (v == item_id) {
                        flag = 1;
                    }

                });

            }
            console.log(flag);
            if (flag == 1) {
                swal('', 'Item already exist in selected list ', 'info');
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
                    barcode,
                    itemtype_name,
                    '<input type="textbox" size="3" class="form-control" name ="qty" id="item_' + item_id + '"  />',
                    '<input type="textbox" size="3" class="form-control" name ="price" id="price_' + item_id + '"  />',
                    '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Confirm item" data-original-title="" id="confirm_' + item_id + '" onclick="valuedisplay(' + item_id + ')"><i class="fa fa-check" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a> <a href="javascript:void(0);" onclick="deletedisplay(' + item_id + ')"   data-toggle="tooltip" data-placement="right" style="display: none" title="Discard item" data-original-title="" id="discard_' + item_id + '" ><i class="fa fa-times" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>'
                ]).draw();
            }

        }

        function valuedisplay(item_id) {
            var confirmid = '#confirm_' + item_id;
            //        var discardid = '#discard_' + item_id;
            var itemid = '#item_' + item_id;
            var priceid = '#price_' + item_id;
            var value = $(itemid).val()
            var price = $(priceid).val()

            if (value.length == 0) {
                swal('', 'Enter required quantity', 'info');
                return false;
            }
            if (price.length == 0) {
                swal('', 'Enter price/Qty of the selected item', 'info');
                return false;
            }
            $(confirmid).hide();
            //        $(discardid).show();
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
            swal('', 'Item added.', 'success');
        }


        function deletedisplay(item_id) {

            //            var myTable = $('#tbl_selected').DataTable();
            var discardid = '#discard_' + item_id;
            $('#tbl_selected').row(discardid).delete();

        }
    </script>