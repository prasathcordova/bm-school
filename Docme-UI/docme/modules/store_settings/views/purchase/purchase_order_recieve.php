
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> 
                    </h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);"  onclick="();" > <i style="font-size: 35px !important;  float: right;color: #23C6C5;" class="material-icons">close</i></a> </span>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                   
                        <div class="col-lg-12">
                            <div class="row " >
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
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="row" >
                                                    <!--<div class="col-md-8" ></div>-->
                                                    <div class="col-md-4" >
                                                        <b> Total Purchase Approved Quantity</b>
                                                        <div class="form-group">

                                                            <input disabled="" type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="total_qty" id="total_qty" value="<?php echo isset($purchase_data['master_data']['total_qty'])?$purchase_data['master_data']['total_qty']:0; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b> Sub Total</b>
                                                        <div class="form-group">

                                                            <input disabled type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="sub_total" id="sub_total" value="<?php echo isset($purchase_data['master_data']['total_value'])?$purchase_data['master_data']['total_value']:0; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b> Discount</b>
                                                        <div class="form-group">

                                                            <input disabled type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="discount" id="discount" value="<?php echo isset($purchase_data['master_data']['total_value'])?$purchase_data['master_data']['total_value']:0; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b>Tax</b>
                                                        <div class="form-group">

                                                            <input disabled type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="tax" id="tax" value="<?php echo isset($purchase_data['master_data']['total_value'])?$purchase_data['master_data']['total_value']:0; ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <b>Total</b>
                                                        <div class="form-group">

                                                            <input disabled type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="net_value" id="net_value" value="<?php echo isset($purchase_data['master_data']['total_value'])?$purchase_data['master_data']['total_value']:0; ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <b>Remark</b>
                                                        <div class="form-group">

                                                            <input disabled type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="remark" id="remark" value="<?php echo isset($purchase_data['master_data']['total_value'])?$purchase_data['master_data']['total_value']:0; ?>" />

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                       
                                        <div class="clearfix"> </div>



                                        <div class="col-lg-12">
                                            <div class="ibox">
                                                <div class="ibox-title"> 
                                                    <h4>Selected Items</h4>
                                                </div>
                                                <div class="ibox-content"> 
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_selected" >

                                                            <thead>
                                                                <tr>
                                                                    <th>Item Code</th>
                                                                    <th>Barcode</th>             
                                                                    <th>Item Type</th>             
                                                                    <th>Quantity</th>             
                                                                    <th>Price/Qty</th>       
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>CAJH</td>
                                                                    <td>ITM00012015000132</td>
                                                                    <td>NOTE BOOKS</td>
                                                                    <td>10</td>
                                                                    <td>45</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cer</td>
                                                                    <td>ITM00012016000064</td>
                                                                    <td>NOTE BOOKS</td>
                                                                    <td>10</td>
                                                                    <td>45</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cerhj</td>
                                                                    <td>ITM00012016000118</td>
                                                                    <td>NOTE BOOKS</td>
                                                                    <td>10</td>
                                                                    <td>45</td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
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




    <style>
        .ibox-new-2{padding:15px !important;}

        .form-group-new input{border-radius:3px; border:none;}

        div.dataTables_wrapper {
            width: 800px;
            margin: 0 auto;
        }
        .ScrollStyle
        {
            max-height: 150px;
            overflow-y: scroll;
        }

    </style>

    <script type="text/javascript">


        var list_switchery = [];

        $('#tbl_selected').dataTable({

            columnDefs: [
                {"width": "10%", className: "capitalize", "targets": 0},
                {"width": "20%", className: "capitalize", "targets": 1},
                {"width": "20%", className: "capitalize", "targets": 2},
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






    </script>

