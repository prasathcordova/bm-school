
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> 
                    </h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0)"  onclick="save_review_purchase();" > <i style="font-size: 35px !important;  float: right;color: #23C6C5;" class="material-icons">save</i></a> </span>
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
                                                    <div class="col-md-12" >
                                                        <b>Supplier</b>
                                                        <div class="form-group">
                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="total_qty" id="supplier_name" value="<?php echo isset($purchase_data['master_data']['supplier_data']) ? ($purchase_data['master_data']['supplier_data']) : 'No supplier available'; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b> Total Quantity</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="total_qty" id="total_qty" value="<?php echo isset($purchase_data['master_data']['total_qty']) ? ($purchase_data['master_data']['total_qty']) : '0'; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b> Sub Total</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="sub_total" id="sub_total" value="<?php echo isset($purchase_data['master_data']['total_value']) ? ($purchase_data['master_data']['total_value']) : '0'; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b> Discount</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="discount" id="discount" value="<?php echo isset($purchase_data['master_data']['discount_value']) ? ($purchase_data['master_data']['discount_value']) : '0'; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b>Tax</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="tax" id="tax" value="<?php echo isset($purchase_data['master_data']['tax_value']) ? ($purchase_data['master_data']['tax_value']) : '0'; ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <b>Total</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="net_value" id="net_value" value="<?php echo isset($purchase_data['master_data']['final_order_value']) ? ($purchase_data['master_data']['final_order_value']) : '0'; ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <b>Intial Remark</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="remark" id="remark" value="<?php echo isset($purchase_data['master_data']['remarks']) ? (base64_decode($purchase_data['master_data']['remarks'])) : '0'; ?>"   />

                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                    <div class="col-md-12" style="padding-bottom:10px;padding-top: 10px;" >
                                                        <div class="radio radio-info radio-inline ">
                                                            <input type="radio" id="inlineRadio1" value="Approve" name="radioInline" checked="" class="approve-radio">
                                                            <label for="inlineRadio1"> Approve </label>
                                                        </div>
                                                        <div class="radio radio-danger radio-inline">
                                                            <input type="radio" id="inlineRadio2" value="Reject" name="radioInline" class="approve-radio">
                                                            <label for="inlineRadio2"> Reject </label>
                                                        </div>
                                                        <div class="radio radio-warning radio-inline">
                                                            <input type="radio" id="inlineRadio3" value="Review" name="radioInline" class="approve-radio">
                                                            <label for="inlineRadio3"> Review </label>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix" ></div>


                                                    <div class="col-md-12" >
                                                        <b>Comments</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase"  name="approval_c" id="approval_c" value="" />

                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>




                                        <div class="clearfix"> </div>



                                        <div class="col-lg-12">
                                            <div class="ibox">
                                                <div class="ibox-title"> 
                                                    <h4>Approved Items</h4>
                                                </div>
                                                <div class="ibox-content"> 
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_selected" >

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
                                                                <?php
                                                                if (isset($purchase_data['item_data']) && !empty($purchase_data['item_data'])) {
                                                                    foreach ($purchase_data['item_data'] as $items) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo isset($items['item_code']) ? $items['item_code'] : ""; ?></td>
                                                                            <td><?php echo isset($items['barcode']) ? $items['barcode'] : ""; ?></td>
                                                                            <td><?php echo isset($items['itemtype_name']) ? $items['itemtype_name'] : ""; ?></td>
                                                                            <td><?php echo isset($items['quantity']) ? $items['quantity'] : ""; ?></td>
                                                                            <td><?php echo isset($items['purchase_price']) ? $items['purchase_price'] : ""; ?></td>
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
                                                                if (isset($purchase_data['comment_data']) && !empty($purchase_data['comment_data'])) {
                                                                    foreach ($purchase_data['comment_data'] as $comments) {
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
            </div>
        </div>
    </div>
    <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo isset($purchase_id) ? $purchase_id : ''; ?>" />
    <input type="hidden" name="purchase_order" id="purchase_order" value="<?php echo isset($purchase_order) ? $purchase_order : ''; ?>" />
    <input type="hidden" name="purchase_type_id" id="purchase_type_id" value="<?php echo isset($purchase_type_id) ? $purchase_type_id : ''; ?>" />
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
                {extend: 'excel', title: 'Purchase comment'}
            ],
            "language": {
                "emptyTable": "No comments available for this purchase"
            }
        });
        function save_review_purchase() {
            var purchase_id = $('#purchase_id').val();
            if(!(purchase_id)) {
                swal('','Purchase data is required.','info');
                return false;
            }             
            var comments = btoa($('#approval_c').val());
            if($('#approval_c').val().length < 5) {
                swal('','Comment is mandatory and require atleast 5 characters. Please fill in comments');
                return false;
            }
            
            var status = $('input[name=radioInline]:checked').val();
            var po_number = $('#purchase_order').val();
            var purchase_type_id = $('#purchase_type_id').val();
            var ops_url = baseurl + 'purchase/approve-save-purchase-order/';
            swal({
                title: "Are you sure?",
                text: "You want to " + status + " the order with order id : " + po_number + " ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#23C6C8',
                confirmButtonText: 'Yes!',
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {"purchase_id": purchase_id, "comments": comments, "status": status,"purchase_type_id":purchase_type_id},
                        success: function (result) {
                            try {
                                var data = JSON.parse(result);
                                if (data.status == 1) {
                                    if(status == 'Approve') {
                                        swal('Success!!', 'Order approved successfully', 'success');
                                    } else if(status == 'Reject') {
                                        swal('Success!!', 'Order rejected successfully', 'success');
                                    } else if(status == 'Review') {
                                        swal('Success!!', 'Order reviewed successfully', 'success');
                                    }
                                    
                                    load_purchase();
                                } else if (data.status == 2) {
                                    if (data.message) {
                                        swal('', data.message, 'info');
                                        return false;
                                    } else {
                                        swal('', 'An error occurred while modifying purchase order. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                        return false;
                                    }
                                } else {
                                    if (data.message) {
                                        swal('', data.message, 'info');
                                        return false;
                                    } else {
                                        swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                        return false;
                                    }
                                }
                            } catch (e) {
                                swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRUIJSNER10002', 'info');
                            }
                        }
                    });
                }
            });
        }

    </script>

