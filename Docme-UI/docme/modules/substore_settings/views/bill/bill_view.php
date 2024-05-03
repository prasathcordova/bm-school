 <div class="ibox-content">
     <span><a href="javascript:void(0);" onclick="close_add_country();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
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
                             <td><strong>Student Name :</strong></td>
                             <td>Chandrajith</td>
                         </tr>
                         <tr>
                             <td><strong>Admission Num : </strong></td>
                             <td>00001/12</td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <div class="col-lg-4 col-md-4 col-sm-12">
                 <table class="table m-b-xs" style="margin:35px 0 0 0">
                     <tbody>
                         <tr>
                             <td><strong>Class :</strong></td>
                             <td>VI</td>
                         </tr>
                         <tr>
                             <td><strong>Batch : </strong></td>
                             <td>VI/A</td>
                         </tr>
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
                     <li class="active"><a data-toggle="tab" href="#tab-6"> BSR-KIT-58997</a></li>
                     <!--<li class=""><a data-toggle="tab" href="#tab-7">BSR-PTKN-55697</a></li>-->
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
                                             <!--<th>Total Price</th>-->
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
                                             <!--<td><?php echo CURRENCY  ?> 31,98</td>-->
                                         </tr>
                                         <tr>
                                             <td>
                                                 <div><strong>Arab Text</strong></div>
                                             </td>
                                             <td><?php echo CURRENCY  ?> 50.00</td>
                                             <td>2</td>
                                             <td><?php echo CURRENCY  ?> 100</td>
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
                                         </tr>
                                         <tr>
                                             <td>
                                                 <div><strong>Pen</strong></div>
                                             </td>
                                             <td><?php echo CURRENCY  ?> 10.00</td>
                                             <td>2</td>
                                             <td><?php echo CURRENCY  ?> 20.00</td>
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
                                         <td><strong><?php echo TAXNAME  ?>(%) :</strong></td>
                                         <td><?php echo CURRENCY  ?> 2</td>
                                     </tr>
                                     <tr>
                                         <td><strong>Discount(-) :</strong></td>
                                         <td> <?php echo CURRENCY  ?> 2</td>
                                     </tr>
                                     <tr>
                                         <td><strong>Round OFF :</strong></td>
                                         <td><?php echo CURRENCY  ?> 233</td>
                                     </tr>

                                     <tr>
                                         <td><strong>TOTAL :</strong></td>
                                         <td style="border-bottom: none;"><?php echo CURRENCY  ?> 233</td>
                                     </tr>

                                 </tbody>

                             </table>
                             <!--                             <div class="col-lg-4">
                    <div class="title-action">
                       
                       <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-money"></i> Pay Bill </a>
                    </div>
                </div>-->

                         </div>
                     </div>

                 </div>

             </div>

         </div>
     </div>
     <div class="col-md-4">

         <div class="ibox">
             <div class="ibox-title">
                 <h5>Bill Actions</h5>
             </div>

             <div class="ibox-content" style="padding-left:10px;">
                 <div class="panel-group payments-method" id="accordion" style="width: 225px;">
                     <div class="panel panel-default">
                         <div class="panel-heading" style="width:105%;">
                             <div class="pull-right">
                                 <i class="fa fa-money text-info"></i>
                             </div>
                             <h5 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Bill Reprint</a>
                             </h5>
                         </div>
                         <div id="collapseOne" class="panel-collapse collapse">
                             <div class="panel-body">

                                 <div class="row">


                                     <div class="row">
                                         <div class="col-xs-12">
                                             <div class="form-group">
                                                 <textarea class="form-control" placeholder="Enter Reason For Reprint" maxlength="250" style="max-width: 192px;"></textarea>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-xs-12">
                                             <div class="form-group ">
                                                 <input type="text" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="description" id="total_qty" value="User:Admin" />
                                             </div>
                                         </div>
                                     </div>


                                     <hr />

                                     <a class="btn btn-info" style="margin-left:30px;">
                                         <i class="fa fa-print">
                                             Confirm Reprint!
                                         </i>
                                     </a>

                                 </div>


                             </div>
                         </div>
                     </div>
                     <div class="panel panel-default">
                         <div class="panel-heading" style="width:105%;">
                             <div class="pull-right">
                                 <i class="fa fa-money text-sucess"></i>
                             </div>
                             <h5 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Bill Cancel</a>
                             </h5>
                         </div>
                         <div id="collapse3" class="panel-collapse collapse">
                             <div class="panel-body">
                                 <div class="row">
                                     <div class="col-xs-12">
                                         <div class="form-group has-success">
                                             <textarea class="form-control" placeholder="Enter Reason For Cancel" maxlength="250" style="max-width: 192px;"></textarea>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-xs-12">
                                         <div class="form-group ">
                                             <input type="text" style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled name="description" id="total_qty" value="User:Admin" />
                                         </div>
                                     </div>
                                 </div>





                                 <div class="col-xs-">
                                     <div class="form-group">

                                     </div>
                                     <div class="row">
                                         <div class="col-xs-12">
                                             <button class="btn btn-primary" type="submit">Confirm Cancel</button>
                                         </div>
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

         //    $(".select2_demo_1").select2({"theme": "bootstrap", width: "100%", placeholder: "Select  staff"});
     </script>