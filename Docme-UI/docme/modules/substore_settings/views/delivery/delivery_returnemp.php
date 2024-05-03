 <div class="ibox-content">
     <span><a href="javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
     <div class="">
         <!--<div class="ibox-content">-->





         <!--<div id="emp_details" class="animated fadeInDown">-->
         <div class="row row-bor" style="background:#F3F3F4;padding-bottom:15px;">
             <!--<a href="javascript:void(0);" onclick="emp_close();" class="pull-right"> <i class="material-icons close" style="color:#E91E63; font-size:30px;opacity: 10;" data-toggle="tooltip" title="Close">close</i></a>-->
             <div class="col-lg-3 col-md-3 col-sm-12">
                 <div class="m-b-lg"> <img src="<?php echo base_url('assets/img/a0.jpg'); ?>" class="img-circle circle-border" alt="profile"></div>

             </div>

             <div class="col-lg-4 col-md-4 col-sm-12">
                 <table class="table m-b-xs" style="margin:35px 0 0 0">
                     <tbody>
                         <tr>
                             <td><strong>Employee Name :</strong></td>
                             <td>vxzwegjur</td>
                         </tr>
                         <tr>
                             <td><strong>Employee Code : </strong></td>
                             <td>254412</td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <div class="col-lg-4 col-md-4 col-sm-12">
                 <table class="table m-b-xs" style="margin:35px 0 0 0">
                     <tbody>
                         <tr>
                             <td><strong>Designation :</strong></td>
                             <td>Teacher</td>
                         </tr>
                         <!--                        <tr>
                            <td><strong>Batch : </strong></td>
                            <td>VI/A/CBS/FN/ENG/2009-10</td>
                        </tr>-->
                     </tbody>
                 </table>
             </div>

         </div>
     </div>
 </div>



 <div class="row m-t-lg">
     <div class="col-lg-8">
         <div class="tabs-container ">

             <div class="tabs-left scroll_content">
                 <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab-6"> PCK-PCK58997</a></li>
                     <li class=""><a data-toggle="tab" href="#tab-7">PCK-55697</a></li>
                 </ul>
                 <div class="tab-content">
                     <div id="tab-6" class="tab-pane active ">
                         <div class="panel-body ">
                             <div class="table-responsive m-t">
                                 <table class="table invoice-table">
                                     <thead>
                                         <tr>
                                             <th>Item List</th>
                                             <th>Rate</th>
                                             <th>Quantity</th>
                                             <th>Amount</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>
                                                 <div><strong>English Text</strong></div>
                                             </td>
                                             <td><?php echo CURRENCY  ?> 30.00</td>
                                             <td>2</td>
                                             <td><?php echo CURRENCY  ?> 60</td>
                                             <td> <a href="javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a></td>
                                             <!--<td><?php echo CURRENCY  ?> 31,98</td>-->
                                         </tr>
                                         <tr>
                                             <td>
                                                 <div><strong>Arab Text</strong></div>
                                             </td>
                                             <td><?php echo CURRENCY  ?> 50.00</td>
                                             <td>2</td>
                                             <td><?php echo CURRENCY  ?> 100</td>
                                             <td> <a href="javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a></td>
                                             <!--<td><?php echo CURRENCY  ?> 31,98</td>-->
                                         </tr>
                                         <tr>
                                             <td>
                                                 <div><strong>Chemistry Text</strong></div>
                                             </td>
                                             <td><?php echo CURRENCY  ?> 26.00</td>
                                             <td>2</td>
                                             <td><?php echo CURRENCY  ?> 52</td>
                                             <!--<td><?php echo CURRENCY  ?> 31,98</td>-->
                                             <td> <a href="javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a></td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <div><strong>Pen</strong></div>
                                             </td>
                                             <td><?php echo CURRENCY  ?> 10.00</td>
                                             <td>2</td>
                                             <td><?php echo CURRENCY  ?> 20.00</td>
                                             <td> <a href="javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a></td>
                                             <!--<td><?php echo CURRENCY  ?> 31,98</td>-->
                                         </tr>


                                     </tbody>
                                 </table>
                             </div><!-- /table-responsive -->
                             <table class="table invoice-total">
                                 <tbody>
                                     <tr>
                                         <td><strong>Sub Total :</strong></td>
                                         <td><?php echo CURRENCY  ?> 232.00</td>
                                     </tr>
                                     <tr>
                                         <td><strong><?php echo TAXNAME  ?> :</strong></td>
                                         <td><?php echo CURRENCY  ?> 235.98</td>
                                     </tr>
                                     <!--                                 <tr>
                                    <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i>Bill </a>
                                <input type="text" class="form-control " placeholder="Enter Discount if any" name="discount" id="discount" value="" />
                                    
                                </tr>-->
                                     <tr>
                                         <td><strong>Discount :</strong></td>
                                         <td> <input type="text" class="form-control " placeholder="0" name="discount" id="discount" value="" style="width:80px;" /></td>
                                     </tr>
                                     <tr>
                                         <td><strong>Round OFF :</strong></td>
                                         <td><?php echo CURRENCY  ?> 233</td>
                                     </tr>

                                     <tr>
                                         <td><strong>TOTAL :</strong></td>
                                         <td><?php echo CURRENCY  ?> 233</td>
                                     </tr>


                                 </tbody>

                             </table>
                             <div class="col-lg-4">
                                 <!--                    <div class="title-action">
                       
                        <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-money"></i> Pay Bill </a>
                    </div>-->
                             </div>

                         </div>
                     </div>
                     <div id="tab-7" class="tab-pane">
                         <div class="panel-body">
                             <strong>NEXT BILL</strong>
                             <div class="table-responsive m-t">
                                 <table class="table invoice-table">
                                     <thead>
                                         <tr>
                                             <th>Item List</th>
                                             <th>Quantity</th>
                                             <th>Unit Price</th>
                                             <th><?php echo TAXNAME ?></th>
                                             <th>Total Price</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>
                                                 <div><strong>Physics Text</strong></div>
                                             </td>
                                             <td>1</td>
                                             <td><?php echo CURRENCY  ?> 26.00</td>
                                             <td><?php echo CURRENCY  ?> 5.98</td>
                                             <td><?php echo CURRENCY  ?> 31,98</td>
                                             <!--<td> <a href="javascript:void(0);" onclick="edit_community('<?php //echo $community['community_id']; 
                                                                                                                ?>', '<?php // echo $community['community_name']; 
                                                                                                                        ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php //echo $community['community_name']; 
                                                                                                                                                                                            ?>" data-original-title="<?php //echo $community['community_name']; 
                                                                                                                                                                                                                        ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a></td>-->
                                             <td> <a href="javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a></td>

                                         </tr>
                                         <tr>
                                             <td>
                                                 <div><strong>Chemistry Text</strong></div>
                                             </td>
                                             <td>2</td>
                                             <td><?php echo CURRENCY  ?> 80.00</td>
                                             <td><?php echo CURRENCY  ?> 36.80</td>
                                             <td><?php echo CURRENCY  ?> 196.80</td>
                                             <td> <a href=javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a></td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <div><strong>Pen</strong></div>
                                             </td>
                                             <td>3</td>
                                             <td> <?php echo CURRENCY  ?> 42.00</td>
                                             <td><?php echo CURRENCY  ?> 19.20</td>
                                             <td><?php echo CURRENCY  ?> 10.20</td>
                                             <td> <a href="javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a></td>
                                         </tr>

                                     </tbody>
                                 </table>
                             </div><!-- /table-responsive -->

                         </div>
                     </div>
                 </div>

             </div>

         </div>
     </div>
     <div class="col-md-4">

         <div class="ibox">
             <div class="ibox-title">
                 <h5>Delivery Return</h5>
             </div>

             <div class="ibox-content" style="padding-left:10px;">
                 <div class="panel-group payments-method" id="accordion" style="width: 225px;">
                     <div class="panel panel-default">



                         <div class="panel panel-default">
                             <div class="panel-heading" style="width:105%;">
                                 <div class="pull-right">
                                     <i class="fa fa-truck text-success"></i>
                                     <!--                                            <i class="fa fa-cc-mastercard text-warning"></i>
                                            <i class="fa fa-cc-discover text-danger"></i>-->
                                 </div>
                                 <h5 class="panel-title">
                                     <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">BSR-PCK58997</a>
                                 </h5>
                             </div>
                             <div id="collapseTwo" class="panel-collapse collapse in">
                                 <div class="panel-body">

                                     <div class="row">
                                         <!--                                                <div class="col-md-4">
                                                    <h2>Summary</h2>
                                                    <strong>Product:</strong>: Name of product <br/>
                                                    <strong>Price:</strong>: <span class="text-navy">$452.90</span>

                                                    <p class="m-t">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                        nisi ut aliquip ex ea commodo consequat.

                                                    </p>
                                                    <p>
                                                        Duis aute irure dolor
                                                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                                        nulla pariatur. Excepteur sint occaecat cupidatat.
                                                    </p>
                                                </div>-->
                                         <div class="col-md-12">

                                             <form role="form" id="payment-form">
                                                 <!--                                                        <div class="row">
                                                            <div class="col-xs-">
                                                                <div class="form-group">
                                                                    <label style="margin-left:30px;">CARD NUMBER</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" name="Number" placeholder="Valid Card Number" required />
                                                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                 <!--                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-8">
                                                                <div class="form-group">
                                                                    <label>EXPIRATION DATE</label>
                                                                    <input type="text" class="form-control" name="Expiry" placeholder="MM / YY"  required/>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-5 col-md-5 pull-left">
                                                                <div class="form-group">
                                                                    <label>CV CODE</label>
                                                                    <input type="text" class="form-control" name="CVC" placeholder="CVC"  required/>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                 <!--                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="form-group has-success">
                                                                    <label>Reason </label>
                                                                    <input type="text" class="form-control" name="nameCard" placeholder="Enter Reason For Return"/>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                 <div class="row">
                                                     <div class="col-xs-12">
                                                         <div class="form-group has-success">
                                                             <textarea class="form-control" placeholder="Enter Reason For Return" maxlength="250" style="max-width: 192px;"></textarea>
                                                         </div>
                                                     </div>
                                                 </div>

                                                 <!--                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="form-group has-success">
                                                                    <label>NAME OF CARD</label>
                                                                    <input type="text" class="form-control" name="nameCard" placeholder="Enter Name Of Card"/>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                 <div class="row">
                                                     <div class="col-xs-12">
                                                         <button class="btn btn-primary" type="submit">Confirm</button>
                                                     </div>
                                                 </div>
                                             </form>

                                         </div>

                                     </div>






                                 </div>
                             </div>
                         </div>
                     </div>


                     <hr />
                     <!--                            <span class="text-muted small">
                                *For United States, France and Germany applicable sales tax will be applied
                            </span>-->
                     <!--                            <div class="m-t-sm">
                                <div class="btn-group">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> Pay Bill</a>
                                <a href="#" class="btn btn-white btn-sm"> Cancel</a>
                                </div>
                            </div>-->
                 </div>
             </div>
         </div>
         <script type="text/javascript">
             $(document).ready(function() {

                 // Add slimscroll to element
                 $('.scroll_content').slimscroll({
                     height: '580px',
                     color: '#f8ac59'
                 })

             });

             $(".select2_demo_1").select2({
                 "theme": "bootstrap",
                 width: "100%",
                 placeholder: "Select  staff"
             });
         </script>