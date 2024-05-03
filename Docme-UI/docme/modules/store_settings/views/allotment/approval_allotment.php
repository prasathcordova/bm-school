
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> 
                    </h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);"  onclick="save_review_allotment();" > <i style="font-size: 35px !important;  float: right;color: #23C6C5;" class="material-icons">save</i></a> </span>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <!--                        <div style="padding-left : 10px;">
                                                <h5>SUPPLIER : <?php // echo $supplier_name            ?></h5>
                                                </div>-->

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
                                                        <b> Total Quantity</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="total_qty" id="total_qty" value="<?php echo isset($allot_data['master_data']['net_quantity']) ? ($allot_data['master_data']['net_quantity']) : '0'; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b> Sub Total</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="sub_total" id="sub_total" value="<?php echo isset($allot_data['master_data']['net_price']) ? ($allot_data['master_data']['net_price']) : '0'; ?>" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b> Discount</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="discount" id="discount" value="0" />

                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4" >
                                                        <b>Tax</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="tax" id="tax" value="0" />

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <b>Total</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase" disabled name="net_value" id="net_value" value="<?php echo isset($allot_data['master_data']['net_price']) ? ($allot_data['master_data']['net_price']) : '0'; ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <b>Remark</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase"  name="remark" id="remark" value="emergency order" />

                                                        </div>
                                                    </div>


                                                    <div class="col-md-12" >
                                                        <b>Approval comments</b>
                                                        <div class="form-group">

                                                            <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase"  name="approval_c" id="approval_c" value="" />

                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                    <div class="col-md-12" >
                                                        <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="inlineRadio1" value="Approve" name="radioInline" checked="">
                                                            <label for="inlineRadio1"> Approve </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <input type="radio" id="inlineRadio2" value="Reject" name="radioInline">
                                                            <label for="inlineRadio2"> Reject </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <input type="radio" id="inlineRadio3" value="Review" name="radioInline">
                                                            <label for="inlineRadio3"> Review </label>
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
                                                                    <th>Item Name</th>
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
                                                                            <td><?php echo isset($items['barcode']) ? $items['barcode'] : ""; ?></td>
                                                                            <td><?php echo isset($items['itemtype_name']) ? $items['itemtype_name'] : ""; ?></td>
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
                            </body>
                            </html>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="itemdata" id="itemdata" value="" />
    <input type="hidden" name="allotment_id" id="allotment_id" value="<?php echo isset($allotment_id) ? $allotment_id : ''; ?>" />




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



        function save_review_allotment() {
            var allotment_id = $('#allotment_id').val();
            if (!(allotment_id)) {
                swal('', 'Allotment data is required.', 'info');
                return false;
            }
            var comments = btoa($('#approval_c').val());
            if ($('#approval_c').val().length < 5) {
                swal('', 'Comment is mandatory and require atleast 5 characters. Please fill in comments');
                return false;
            }

            var status = $('input[name=radioInline]:checked').val();
            var po_number = $('#allotment_id').val();
//            var purchase_type_id = $('#purchase_type_id').val();
            var ops_url = baseurl + 'allotment/approve-save-allotment/';
            swal({
                title: "Are you sure?",
                text: "Do you want to " + status + " the order with Allotment id : " + po_number + " ?",
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
                        data: {"allotment_id": allotment_id, "comments": comments, "status": status},
                        success: function (result) {
                            try {
                                var data = JSON.parse(result);
                                if (data.status == 1) {
                                    if (status == 'Approve') {
                                        swal('Success!!', 'Allotment approved successfully', 'success');
                                    } else if (status == 'Reject') {
                                        swal('Success!!', 'Allotment rejected successfully', 'success');
                                    } else if (status == 'Review') {
                                        swal('Success!!', 'Allotment reviewed successfully', 'success');
                                    }

                                     load_allotment();
                                } else if (data.status == 2) {
                                    if (data.message) {
                                        swal('', data.message, 'info');
                                        return false;
                                    } else {
                                        swal('', 'An error occurred while modifying Allotment. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                        return false;
                                    }
                                } else {
                                    if (data.message) {
                                        swal('', data.message, 'info');
                                        return false;
                                    } else {
                                        swal('', 'An error occurred while creating Allotment. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
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

