 <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
 <link href="<?php echo base_url('assets/theme/css/plugins/steps/step.styles.css'); ?>" rel="stylesheet">
 <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
 <!--<script src="<?php // echo base_url('assets/theme/plugins/validate/jquery.validate.js');                                                                                                    
                    ?>"></script>-->



 <!--<script src="<?php // echo base_url('assets/theme/js/plugins/validate/jquery.validate.min.js')                                                                               
                    ?>"></script>-->
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
                             <!--<form id="form" action="#" class="">-->
                             <h1>Terms and conditions</h1>
                             <fieldset>
                                 <form action="#" role="form" id="personal_details">
                                     <div class="col-lg-12">
                                         <div class="panel panel-info">
                                             <!--                                            <div class="panel-heading">
                                                                                            <i class="fa fa-info-circle"></i> Info Panel
                                                                                        </div>-->
                                             <div class="panel-body" style="height:250px">
                                                 <p>Type terms and condition here... </p>



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
                                         <!--<div class="panel panel-info">-->
                                         <h4> List of Direct purchase which are not approved.</h4>

                                         <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_purchase">
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
                                                    //                                            dev_export($purchase_data);die;
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
                                             <!--<b> &nbsp;If you click next all this orders  will be made inactive  </b>-->
                                             <div class="checkbox checkbox-success">
                                                 <input id="accept_check1" name="accept_check1" type="checkbox">
                                                 <label for="accept_check1">
                                                     &nbsp; Remove all the purchase orders
                                                 </label>
                                             </div>
                                         </div>


                                         <!--</div>-->
                                     </div>




                                 </form>

                             </fieldset>

                             <h1>Allotment list</h1>
                             <fieldset>
                                 <form action="#" role="form" id="AllotmentList">
                                     <div class="col-lg-12">
                                         <!--<div class="panel panel-info">-->
                                         <h4> Stock allotment which are not recived.</h4>

                                         <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_allotment">
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
                                                    //                                            dev_export($purchase_data);die;
                                                    if (isset($stockAllot_data) && !empty($stockAllot_data) && is_array($stockAllot_data)) {
                                                        foreach ($stockAllot_data as $stockAllot) {

                                                            if ($stockAllot['is_received'] == 0) {
                                                                //                                                                    
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
                                             <b> &nbsp;If you click next all this allotments will be made inactive  </b>
                                             <div class="checkbox checkbox-success">
                                                 <input id="accept_check2" name="accept_check2" type="checkbox">
                                                 <label for="accept_check2">
                                                     &nbsp;I accept the above condition !
                                                 </label>
                                             </div>
                                         </div>


                                         <!--</div>-->
                                     </div>




                                 </form>

                             </fieldset>


                             <h1>Current stock lists</h1>
                             <fieldset>
                                 <form action="#" role="form" id="current_stock">
                                     <div class="col-lg-12">
                                         <!--<div class="panel panel-info">-->
                                         <!--<h4> Stock list</h4>-->

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


                                         <!--</div>-->
                                     </div>




                                 </form>

                             </fieldset>

                             <h1>Stock</h1>
                             <fieldset>
                                 <form action="#" role="form" id="stock">
                                     <div class="ibox-content">
                                         <div class="row">
                                             <div class="col-lg-12">
                                                 <div id="curd-content" style="display: none;"></div>
                                             </div>
                                             <div class="col-lg-12">
                                                 <div class="table-responsive">
                                                     <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_stock">
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
                                                                                if ($itemtype['mainstore_rate'] == null) {
                                                                                    echo $itemtype['selling_price'];
                                                                                } else {
                                                                                    echo $itemtype['mainstore_rate'];
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




                             <h1> Opening Stock</h1>
                             <fieldset>
                                 <form action="#" role="form" id="stock">
                                     <div class="ibox-content">
                                         <div class="row">
                                             <div class="col-lg-12">
                                                 <div id="curd-content" style="display: none;"></div>
                                             </div>
                                             <h2>Opening Stock Item List</h2>
                                             <div class="col-lg-12">
                                                 <div class="ibox">
                                                     <div class="ibox-content">
                                                         <b>ALL THE ALLOTMENTS ARE MADE INACTIVE.</b><br>
                                                         <b>ALL THE SUBSTORE STOCKS ARE MADE EMPTY.</b><br>
                                                         <b>MAIN STORE STOCKS IS UPDATED BASED ON OPENING STOCK ENTRIES.</b><br>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-lg-12">
                                                 <?php
                                                    if (isset($item_list) && !empty($item_list) && is_array($item_list)) {
                                                        foreach ($item_list as $itemtype) {
                                                            //                                                                    
                                                    ?>
                                                         <div class="col-lg-4">
                                                             <div class="contact-box">
                                                                 <a href="profile.html">
                                                                     <div class="col-sm-12">
                                                                         <h3><strong><?php echo $itemtype['item_name']; ?></strong></h3>
                                                                         <p><?php echo $itemtype['itemtype_name']; ?> , <?php echo $itemtype['edition_name']; ?> Ed.</p>
                                                                         <address>
                                                                             <strong> Stock &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo isset($itemtype['mainstore_stock']) ? $itemtype['mainstore_stock'] : 0 ?></strong><br>
                                                                             <strong> Opening Stock : </strong><br>
                                                                             <strong> Selling price &nbsp;&nbsp;&nbsp; : <?php
                                                                                                                            if ($itemtype['mainstore_rate'] == null) {
                                                                                                                                echo $itemtype['selling_price'];
                                                                                                                            } else {
                                                                                                                                echo $itemtype['mainstore_rate'];
                                                                                                                            }
                                                                                                                            ?> </strong>
                                                                         </address>
                                                                     </div>
                                                                     <div class="clearfix"></div>
                                                                 </a>
                                                             </div>
                                                         </div>
                                                 <?php
                                                        }
                                                    }
                                                    ?>
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

         //        scrollX : true,
         //     scrollY : true,
         //     "fnInitComplete":function(){ $('.dataTables_scrollBody').slimScroll({
         //               axis: 'x',
         //                  width:'10px'
         //          }); },

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
         //        "fnDrawCallback": function (ele) {
         //            activateSwitchery();
         //            $('.dataTables_scrollBody').slimScroll('destroy').slimScroll({
         //                axis: 'x',
         //                width:'10px'
         //            });
         //        }


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
             $('.js-switch').map(function() {
                 if ($(this).is(":visible") == true) {
                     var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                     elems.forEach(function(html) {
                         var switchery = new Switchery(html, {
                             color: '#a9318a',
                             size: 'small'
                         });
                     });
                 }
             })
         }


     });


     $('#tbl_stock').dataTable({

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
         //        "fnDrawCallback": function (ele) {
         //            activateSwitchery();
         //            $('.dataTables_scrollBody').slimScroll('destroy').slimScroll({
         //                axis: 'x',
         //                width:'10px'
         //            });
         //        }


     });

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

                     swal('', 'purchase will be made inactive', 'success');
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
             } else if (newIndex == 5) {
                 var form = $('#stock');
                 var stockdata = [];
                 var flag = 0;
                 var table = $('#tbl_stock').dataTable();
                 table.$('input').each(function() {
                     var id = $(this).val();
                     //            alert(id);
                     if (id != '') {
                         if (!($.isNumeric(id))) {
                             swal('', 'Enter valid Quantity.', 'info');
                             flag = 2;
                             return false;
                         }
                         var itemstock = $(this).val();
                         var item_id = $(this).attr('data-id');
                         //                alert(itemstock);
                         //                alert(item_id);
                         if (itemstock > 0) {
                             stockdata.push({
                                 item_id: item_id,
                                 stock_qty: itemstock
                             });
                             flag = 1;
                         }

                     }
                 });
                 if (flag == 1 && flag != 2) {
                     var formatted_stockdata = JSON.stringify(stockdata)
                     //                    alert(formatted_stockdata);
                     var itemdata = btoa(formatted_stockdata);
                     //                    alert(itemdata);
                     save_openingStock_details(formatted_stockdata);
                     return true;
                 } else
                 if (flag == 1 && flag == 2) {
                     swal('', 'Enter valid  Quantity.', 'info');
                     return false;
                 } else {
                     swal('', 'Enter valid  Quantity.', 'info');
                     return false;
                 }
             }

         },
         onStepChanged: function(event, currentIndex, priorIndex) {
             // Suppress (skip) "Warning" step if the user is old enough.
             //                if (currentIndex === 2)
             //                {
             //                    $(this).steps("next");
             //                }

             // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
             //                if (currentIndex === 2 && priorIndex === 3)
             //                {
             //                    $(this).steps("previous");
             //                }




         },
         onFinishing: function(event, currentIndex) {
             //            $(".form-control").keypress(function (e) {
             //                //if the letter is not digit then display error and don't type anything
             //                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
             //                    //display error message
             //                    $("#errmsg").html("Digits Only").show().fadeOut("slow");
             //                    return false;
             //                }
             //            });


             $('.form-control').each(function() {
                 var a = $(this).val();
                 //                if (a.length == 0) {
                 //                    swal('', 'Some field in opening stock is empty or invalid.', 'info');
                 //                    return false;
                 //                } else {
                 swal('success', 'Opening stock completed successfully.', 'success');
                 return true;

                 //                }
             });





             //            swal('success', 'Opening stock completed successfully.', 'success');
             //            return true;

             //            $('input').each(function () {
             //                var a = $(this).val();
             //                if (a == 0) {
             //                    swal('', 'Some fields in opening stock is empty or invalid.', 'info');
             //                    return false;
             //                } else {
             //                    swal('success', 'Opening stock completed successfully.', 'success');
             //                }
             //
             //
             //            });


             //            $('input').each(function () {
             //                if (!$(this).val()) {
             //                    swal('', 'Some fields in opening stock is empty or invalid.', 'info');
             //                    return false;
             //                } else {
             //                    swal('success', 'Opening stock completed successfully.', 'success');
             //                }
             //            });

             //            if (save_facilities_details() == 0) {
             //
             //            } else {
             ////                alert('321')
             //                swal({
             //                    title: 'Success',
             //                    text: 'Registration Completed Successfully!!',
             //                    type: 'success',
             //                    showCancelButton: false,
             //                    confirmButtonColor: '#3085d6',
             //                    cancelButtonColor: '#d33',
             //                    confirmButtonText: 'OK',
             //                    closeOnConfirm: false
             //                }, function (isConfirm) {
             //                    swal({
             //                        title: '',
             //                        text: 'Do you want to view the created student profile or create a new registration!!',
             //                        type: 'info',
             //                        showCancelButton: true,
             //                        confirmButtonColor: '#3085d6',
             //                        cancelButtonColor: '#d33',
             //                        cancelButtonText: 'New Registration',
             //                        confirmButtonText: 'View Profile',
             //                        closeOnConfirm: true
             //                    }, function (isConfirm) {
             //                        if (isConfirm) {
             //                            var studentid = $('#studentid').val();
             //                            //profile_detail(studentid);
             //                            var batchid = $('#batchid').val();
             //                            var ops_url = baseurl + 'profilestudent/show-studentprofile/';
             //                            $.ajax({
             //                                type: "POST",
             //                                cache: false,
             //                                async: false,
             //                                url: ops_url,
             //                                data: {"load": 1, "studentid": studentid, "batchid": batchid},
             //                                success: function (data) {
             //                                    $('#profile-detail-content').html('');
             //                                    $('#profile-detail-content').show();
             //                                    $('#profile-detail-content').html(data);
             //                                    $('.registration-view').hide();
             //                                    $('html, body').animate({
             //                                        scrollTop: $("#profile-detail-content").offset().top
             //                                    }, 1000);
             //                                }
             //                            });
             //                        } else {
             //                            window.location.href = baseurl + "registration/add-registration";
             //                        }
             //
             //                    });
             //                });
             //                return true;
             //            }
             //                var form = $(this);

             // Disable validation on fields that are disabled.
             // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
             //                form.validate().settings.ignore = ":disabled";

             // Start validation; Prevent form submission if false
             //                return form.valid();
         },
         onFinished: function(event, currentIndex) {
             //                var form = $(this);

             // Submit form input
             //                form.submit();
         }
     });



     //      






     function save_openingStock_details(formatted_stockdata) {
         //       alert(itemdata);
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
                     swal({
                         title: 'Success',
                         text: 'opening stock added successfully',
                         type: 'success',
                         showCancelButton: false,
                         confirmButtonColor: '#3085d6',
                         cancelButtonColor: '#d33',
                         confirmButtonText: 'OK'
                     }, function(isConfirm) {})
                 } else if (data.status == 2) {
                     swal('', data.message, 'info');
                 }

             },
             error: function() {
                 //               
             }
         });


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
     function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
                 $('#profile_image').attr('src', e.target.result);
                 $('#profile_image_data').val(e.target.result);
                 //                var str = $('#profile_image_data').val();
                 //                var res = str.replace("data:image/jpeg;base64,", '');
                 //                $('#profile_image_data').val(res);
             };
             reader.readAsDataURL(input.files[0]);
         }
     }

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
         //        alert(value);
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