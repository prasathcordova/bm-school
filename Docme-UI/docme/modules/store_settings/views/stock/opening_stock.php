 <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
 <link href="<?php echo base_url('assets/theme/css/plugins/steps/step.styles.css'); ?>" rel="stylesheet">
 <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/theme/plugins/validate/jquery.validate.js') ?>"></script>

 <div class="wrapper wrapper-content animated fadeInRight registration-view" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
     <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
         <div class="col-lg-12">
             <div class="ibox float-e-margins">
                 <div class="ibox-title">
                     <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> </h5>
                 </div>
                 <div class="ibox-content">
                     <div class="row">
                         <div class="col-lg-12">
                             <div id="curd-content" style="display: none;"></div>
                         </div>
                         <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 wizard-big" id="wizard">
                             <h1>Terms and conditions</h1>
                             <fieldset>
                                 <form action="#" role="form" id="personal_details">
                                     <div class="col-lg-12">
                                         <div class="panel panel-info">
                                             <div class="panel-body" style="height:250px">
                                                 <p>Opening stock is the quantity of items that are in Store at the beginning of a particular period of time.

                                                     Once Opening Stock is entered DocMe Store Module will only consider the Opening Stock entry date as start date for all calculations of Stock and Reports From Date will be set accordingly.

                                                     Transfer Pending, Purchase Request pending will get cancelled once Opening Stock entry is done.

                                                     Once the Opening Stock Date is saved , Previous Dates of all Calendar controls used in DocMe Store Module will be disabled.</p>
                                             </div>

                                         </div>
                                     </div>
                                     <!--I accept all the terms and conditions-->
                                     <div class="col-lg-12">
                                         <div class="checkbox checkbox-success">
                                             <input id="accept_check" name="accept_check" type="checkbox">
                                             <label for="accept_check">
                                                 &nbsp;I accept all the terms and conditions
                                             </label>
                                         </div>
                                     </div>
                                 </form>
                             </fieldset>


                             <h1>Direct Purchase list</h1>
                             <fieldset>
                                 <form action="#" role="form" id="academic_profile">
                                     <div class="col-lg-12">
                                         <h4> List of Direct purchase which are not approved.</h4>
                                         <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_purchase" style="width:100%;">
                                             <thead>
                                                 <tr>
                                                     <th>Purchase code</th>
                                                     <th>Supplier Name </th>
                                                     <th>Amount</th>
                                                     <th>Item count</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php
                                                    if (isset($purchase_data) && !empty($purchase_data) && is_array($purchase_data)) {
                                                        foreach ($purchase_data as $purchase) {

                                                            if ($purchase['is_approved'] == 0 && $purchase['type_id'] == 1) {
                                                                //                                                                    
                                                    ?>
                                                             <tr>
                                                                 <td> <?php echo $purchase['purchase_code']; ?></td>
                                                                 <td> <?php echo $purchase['supplier_name']; ?></td>
                                                                 <td> <?php echo $purchase['final_order_value']; ?></td>
                                                                 <td> <?php echo $purchase['item_count']; ?></td>
                                                             </tr>
                                                 <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                             </tbody>
                                         </table>
                                         <div class="col-lg-12">
                                             <div class="checkbox checkbox-success">
                                                 <input id="accept_check1" name="accept_check1" type="checkbox">
                                                 <label for="accept_check1">
                                                     &nbsp; Remove all the purchase orders
                                                 </label>
                                             </div>
                                         </div>
                                     </div>
                                 </form>
                             </fieldset>

                             <h1>Allotment list</h1>
                             <fieldset>
                                 <form action="#" role="form" id="AllotmentList">
                                     <div class="col-lg-12">
                                         <h4> Stock allotment which are not received.</h4>
                                         <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_allotment" style="width:100%;">
                                             <thead>
                                                 <tr>
                                                     <th>Allotment ID</th>
                                                     <th>Substore </th>
                                                     <th>Description</th>
                                                     <th>Quantity </th>
                                                     <th>Price </th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php
                                                    if (isset($stockAllot_data) && !empty($stockAllot_data) && is_array($stockAllot_data)) {
                                                        foreach ($stockAllot_data as $stockAllot) {
                                                            if ($stockAllot['is_received'] == 0) { //                                                                    
                                                    ?>
                                                             <tr>
                                                                 <td> <?php echo $stockAllot['masterid']; ?></td>
                                                                 <td> <?php echo $stockAllot['store_name']; ?></td>
                                                                 <td> <?php echo $stockAllot['description']; ?></td>
                                                                 <td> <?php echo $stockAllot['net_quantity']; ?></td>
                                                                 <td> <?php echo $stockAllot['net_price']; ?></td>
                                                             </tr>
                                                 <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                             </tbody>
                                         </table>
                                         <div class="col-lg-12">
                                             <b> &nbsp;If you click next all these allotments will be made inactive  </b>
                                             <div class="checkbox checkbox-success">
                                                 <input id="accept_check2" name="accept_check2" type="checkbox">
                                                 <label for="accept_check2">
                                                     &nbsp;I accept the above condition !
                                                 </label>
                                             </div>
                                         </div>
                                     </div>
                                 </form>
                             </fieldset>


                             <h1>Current stock list</h1>
                             <fieldset>
                                 <form action="#" role="form" id="current_stock">
                                     <div class="col-lg-12">
                                         <div class="col-lg-12">
                                             <div class="form-group"><label class="col-sm-2 control-label" style="float : left;">STORE</label>
                                                 <div class="col-sm-6">
                                                     <select class="form-control select2_demo_1" name="store" id="store" onchange="onchange_action()">
                                                         <option value="" selected="selected">SELECT STORE</option>
                                                         <option value="0"> ALL STORES</option>
                                                         <?php
                                                            if (isset($store_data) && !empty($store_data)) {
                                                                foreach ($store_data as $store) {
                                                                    echo '<option value="' . $store['store_id'] . '">' . $store['store_name'] . '(Code:' . $store['store_code'] . ')</option>';
                                                                }
                                                            }
                                                            ?>
                                                     </select>
                                                 </div>
                                             </div>
                                         </div>
                                         <br>
                                         <br>
                                         <br>
                                         <div class="col-lg-12" id="stock_list">
                                             <br>
                                             <b>Select store and verify </b>
                                             <p>Stock must be empty in all the substores for you to continue </p>

                                         </div>

                                         <br>
                                         <br>
                                         <br>

                                         <div class="col-lg-12">
                                             <div class="checkbox checkbox-success">
                                                 <input id="accept_check3" name="accept_check3" type="checkbox">
                                                 <label for="accept_check3">
                                                     &nbsp; All the substores is empty 
                                                 </label>
                                             </div>
                                         </div>
                                     </div>
                                 </form>
                             </fieldset>

                             <h1>Opening Stock</h1>
                             <fieldset>
                                 <form action="#" role="form" id="stock">
                                     <div class="ibox-content">
                                         <div class="row">
                                             <div class="col-lg-12">
                                                 <div id="curd-content" style="display: none;"></div>
                                             </div>
                                             <div class="col-lg-12">
                                                 <div class="table-responsive">
                                                     <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_stock" style="width:100%;">
                                                         <thead>
                                                             <tr>
                                                                 <th>Item Type</th>
                                                                 <th>Item Name </th>
                                                                 <th> Edition</th>
                                                                 <th>Stock</th>
                                                                 <th>Selling Price </th>
                                                                 <th>Opening Stock</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                                             <?php
                                                                //                                                                                                                    dev_export($item_list);die;
                                                                if (isset($item_list) && !empty($item_list) && is_array($item_list)) {
                                                                    foreach ($item_list as $itemtype) {
                                                                        //                                                                    
                                                                ?>
                                                                     <tr>
                                                                         <td> <?php echo $itemtype['itemtype_name']; ?></td>
                                                                         <td> <?php echo $itemtype['item_name']; ?></td>
                                                                         <td> <?php echo $itemtype['edition_name']; ?></td>
                                                                         <td> <?php echo isset($itemtype['mainstore_stock']) ? $itemtype['mainstore_stock'] : 0 ?></td>
                                                                         <td> <?php
                                                                                if ($itemtype['rate'] == null) {
                                                                                    echo $itemtype['selling_price'];
                                                                                } else {
                                                                                    echo $itemtype['rate'];
                                                                                }
                                                                                ?></td>
                                                                         <td><input type="textbox" size="3" class="form-control" value="0" name="qty" id="" data-id="<?php echo $itemtype['item_id']; ?>" /></td>
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
                                 </form>
                             </fieldset>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </div>


 <script type="text/javascript">
     $("#wizard").steps({
         headerTag: "h1",
         bodyTag: "fieldset",
         transitionEffect: "slideLeft",
         onStepChanging: function(event, currentIndex, newIndex) {
             // Always allow going backward even if the current step contains invalid fields!
             if (currentIndex > newIndex) {
                 return true;
             }
             // Forbid suppressing "Warning" step if the user is to young
             //                if (newIndex === 3)
             //                {
             //                    return false;
             //                }
             // Clean up if user went backward before
             if (currentIndex < newIndex) {
                 // To remove error styles
                 $(".body:eq(" + newIndex + ") label.error", form).remove();
                 $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
             }
             // Disable validation on fields that are disabled or hidden.
             //                form.validate().settings.ignore = ":disabled,:hidden";

             $('.registration-content').slimScroll({
                 position: 'right',
                 height: '350px',
                 railVisible: true,
                 alwaysVisible: false
             });

             if (newIndex == 1) {
                 var form = $('#personal_details');
                 $('#personal_details').validate({
                     rules: {},
                     messages: {}
                 });
                 if (form.valid()) {
                     if ($('#accept_check').prop('checked') == false) {
                         swal('', 'Accept terms and condition to continue.', 'info');
                         return false;
                     }
                     return true;
                 } else {
                     swal('', 'Enter all the mandatory fields.', 'info');
                     return false;
                 }
             } else if (newIndex == 2) {
                 var form = $('#academic_profile');
                 $('#academic_profile').validate({
                     rules: {},
                     messages: {}
                 });
                 if (form.valid()) {
                     if ($('#accept_check1').prop('checked') == false) {
                         return true;
                     }
                     swal('', 'All purchase will be made inactive', 'success');
                     return true;
                 } else {
                     swal('', 'Enter all the mandatory fields.', 'info');
                     return false;
                 }

             } else if (newIndex == 3) {
                 var form = $('#AllotmentList');
                 $('#AllotmentList').validate({

                     rules: {},
                     messages: {}
                 });
                 if (form.valid()) {
                     if ($('#accept_check2').prop('checked') == false) {
                         swal('', 'Accept terms and condition to continue.', 'info');
                         return false;
                     }
                     return true;
                 } else {
                     swal('', 'Enter all the mandatory fields.', 'info');
                     return false;
                 }
             } else if (newIndex == 4) {
                 var form = $('#current_stock');
                 $('#current_stock').validate({
                     rules: {},
                     messages: {}
                 });
                 if (form.valid()) {
                     if ($('#accept_check3').prop('checked') == false) {
                         swal('', 'Accept terms and condition to continue.', 'info');
                         return false;
                     }
                     return true;
                 } else {
                     swal('', 'Enter all the mandatory fields.', 'info');
                     return false;
                 }
             }
         },
         onStepChanged: function(event, currentIndex, priorIndex) {

         },
         onFinishing: function(event, currentIndex) {
             var form = $('#stock');
             var stockdata = [];
             var flag = 0;
             var table = $('#tbl_stock').dataTable();
             table.$('input').each(function() {
                 var id = $(this).val();
                 if (id != '') {
                     if (!($.isNumeric(id))) {
                         swal('', 'Enter valid Quantity.', 'info');
                         flag = 2;
                         return false;
                     }
                     var itemstock = $(this).val();
                     var item_id = $(this).attr('data-id');
                     if (itemstock >= 0) {
                         stockdata.push({
                             item_id: item_id,
                             stock_qty: itemstock
                         });
                         flag = 1;
                     } else {
                         swal('', 'Enter valid Quantity.', 'info');
                         flag = 2;
                         return false;
                     }
                 }
             });
             if (flag == 1 && flag != 2) {
                 var formatted_stockdata = JSON.stringify(stockdata)
                 var status = 0;
                 swal({
                     title: "Are you sure ?",
                     text: "On confirmation opening stock will be placed",
                     type: "warning",
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: "Confirm,Stock will be reset.",
                     closeOnConfirm: false,
                 }, function(isConfirm) {
                     if (isConfirm) {
                         status = save_openingStock_details(formatted_stockdata);
                         if (status == 1) {
                             swal({
                                 title: "",
                                 text: "Do you want to view current stock position?",
                                 type: "success",
                                 showCancelButton: true,
                                 confirmButtonText: "Yes",
                                 cancelButtonText: "No, Back to home",
                                 confirmButtonColor: '#3085d6',
                                 cancelButtonColor: '#d33',
                                 closeOnConfirm: true,
                                 //                        closeOnCancel: false
                             }, function(isConfirm) {
                                 if (isConfirm) {

                                 } else {
                                     load_opening_stock();
                                 }
                             });
                         } else {
                             return false;
                         }
                     }
                 });

             }
         },
         onFinished: function(event, currentIndex) {

         }
     });

     $('#tbl_stock').dataTable({
         iDisplayLength: 10,
     });

     $('#tbl_allotment').dataTable({

         columnDefs: [{
                 "width": "20%",
                 className: "capitalize",
                 "targets": 0
             },
             {
                 "width": "25%",
                 className: "capitalize",
                 "targets": 1
             },
             {
                 "width": "25%",
                 className: "capitalize",
                 "targets": 2
             },
             {
                 "width": "15%",
                 className: "capitalize",
                 "targets": 3
             },
             {
                 "width": "15%",
                 className: "capitalize",
                 "targets": 4,
                 "orderable": false
             }
         ],
         responsive: true,
         iDisplayLength: 10,
     });

     $('#tbl_purchase').dataTable({
         columnDefs: [{
                 "width": "10%",
                 className: "capitalize",
                 "targets": 0
             },
             {
                 "width": "10%",
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
             }
         ],
         responsive: true,
     });

     function save_openingStock_details(formatted_stockdata) {
         var status_flag = 0;
         var item_stock_details = new Object();
         item_stock_details.formatted_stockdata = formatted_stockdata;
         if ($('#accept_check1').prop('checked') == false) {
             var purchase_status = 2;
         } else {
             var purchase_status = 1;
         }
         var ops_url = baseurl + 'openingstock/save-openingStock';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "stockdata": formatted_stockdata,
                 "purchase_status": purchase_status
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     status_flag = 1;
                 } else if (data.status == 2) {
                     status_flag = 0;
                     swal('', data.message, 'info');
                 }

             },
             error: function() {
                 status_flag = 0;
             }
         });
         return status_flag;

     }
     //    function save_openingStock_details_purchase() {
     //        var form = $('#academic_profile');
     //        $('#academic_profile').validate({
     //
     //            rules: {},
     //            messages: {}
     //        });
     //        if (form.valid()) {
     //            if ($('#accept_check1').prop('checked') == false) {
     //                var purchase_details = 0;
     ////                save_openingStock_details(purchase_details);
     ////                        alert(purchase_details);
     //                return true;
     //
     //            }
     //            var purchase_details = 1;
     ////            save_openingStock_details(purchase_details);
     ////                    alert(purchase_details);
     //            swal('', 'purchase will be made inactive ', 'success');
     //            return true;
     //
     //        } else {
     //            swal('', 'Enter all the mandatory fields.', 'info');
     //            return false;
     //        }
     //    }

     function save_purchase_details() {
         return 1
     }



     $(".select2_demo_1").select2({
         "theme": "bootstrap",
         width: "100%",
         placeholder: "Select store"
     });


     function onchange_action() {
         var e = document.getElementsByName("store")[0];
         var value = e.value;
         var ops_url = baseurl + 'stock/current_stock_list/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "value": value
             },
             success: function(result) {
                 $('#stock_list').html('');
                 $('#stock_list').html(result);
             }
         });
     }
 </script>

 <style>
     .pagination li {
         list-style: none;
         display: inline-block !important;
     }
 </style>