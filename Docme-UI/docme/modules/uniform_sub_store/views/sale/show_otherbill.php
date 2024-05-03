 <script src="<?php echo base_url('assets/theme/js/plugins/steps/jquery.steps.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/theme/js/plugins/dataTables/datatables.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>
 <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
 <link href="<?php echo base_url('assets/theme/css/plugins/steps/step.styles.css'); ?>" rel="stylesheet">
 <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
 <!--<script src="<?php // echo base_url('assets/theme/plugins/validate/jquery.validate.js');                                                         
                    ?>"></script>-->



 <!--<script src="<?php // echo base_url('assets/theme/js/plugins/validate/jquery.validate.min.js')                                    
                    ?>"></script>-->
 <script src="<?php echo base_url('assets/theme/plugins/validate/jquery.validate.js') ?>"></script>



 <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
     <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
         <div class="col-lg-12">
             <div class="ibox float-e-margins">
                 <div class="ibox-title">
                     <h5>Sales-Issue (Student)</h5>
                     <div class="ibox-tools" id="add_type">
                         <span><a href="javascript:void(0);" onclick="();"> <i style="font-size: 35px !important;  float: right;color: #23c6c8;" class="material-icons">save</i></a> </span>

                     </div>
                 </div>
                 <div class="ibox-content">
                     <div class="row">
                         <div class="ibox">
                             <div class="ibox-content">

                                 <div class="row">
                                     <div class="col-lg-3 col-md-3 col-sm-12">
                                         <div class="m-b-lg"> <img src="http://10.10.5.172:90/docme/Docme-UI/assets/img/a4.jpg" class="img-circle circle-border" alt="profile"></div>
                                     </div>

                                     <div class="col-lg-4 col-md-4 col-sm-12">
                                         <table class="table small m-b-xs">
                                             <tbody>
                                                 <tr>
                                                     <td><strong>Student Name :</strong></td>
                                                     <td>Chandrajith</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>Admission Number : </strong></td>
                                                     <td>099</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>Class : </strong></td>
                                                     <td>8</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>Batch Code : </strong></td>
                                                     <td>9999</td>
                                                 </tr>



                                             </tbody>
                                         </table>
                                     </div>


                                     <div class="col-lg-5 col-md-5 col-sm-12">
                                         <table class="table small m-b-xs table-hig">
                                             <tbody>
                                                 <tr>
                                                     <td><strong>Order Type : </strong></td>
                                                     <td>normal</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>Order Date: </strong></td>
                                                     <td>01-05-2010</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>Order Price: </strong></td>
                                                     <td>2000</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>Current Status : </strong></td>
                                                     <td>active</td>
                                                 </tr>

                                             </tbody>
                                         </table>

                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>



                     <!--Wizard starts here-->
                     <div class="ibox-content">

                         <form id="form" action="#" class="wizard-big">
                             <!--                                        <h1>Allotted Items</h1>
                                        <fieldset>
                                            <h2>Item Information</h2>



                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example"  >

                                                    <thead>
                                                        <tr>
                                                            <th>Item code</th>
                                                            <th>Item name</th>                                
                                                            <th>Bar code</th>                                
                                                            <th>Available Qty</th>                              
                                                            <th>Qty Required</th>                              
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td><?php echo "fd" ?></td>
                                                            <td><?php echo "fd" ?></td>
                                                            <td><?php echo "70" ?></td>
                                                            <td><?php echo "70" ?></td>
                                                            <td><input type="textbox" size="3" class="form-control" value="0" name ="qty"   id=""  /></td>




                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>



                                        </fieldset>-->
                             <h1>Billing Summary</h1>
                             <fieldset>
                                 <h2>Item details</h2>
                                 <div class="table-responsive">
                                     <!--<table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_sale" >-->
                                     <table class="table table-striped table-bordered table-hover dataTables-example">
                                         <thead>
                                             <tr>
                                                 <th>Item code</th>
                                                 <th>Item name</th>
                                                 <th>Barcode</th>
                                                 <th>Quantity</th>
                                                 <th>Unit price</th>
                                                 <th>Price</th>
                                             </tr>
                                         </thead>
                                         <tbody>

                                             <tr>
                                                 <td><?php echo "fd" ?></td>
                                                 <td><?php echo "fd" ?></td>
                                                 <td><?php echo "70" ?></td>
                                                 <td><?php echo "40" ?></td>
                                                 <td><?php echo "40" ?></td>
                                                 <td><?php echo "40" ?></td>




                                             </tr>

                                         </tbody>
                                     </table>
                                 </div>
                             </fieldset>

                             <h1>Bill</h1>
                             <fieldset>
                                 <div class="row">


                                     <div class="col-lg-4 col-md-4 col-sm-12">
                                         <table class="table small m-b-xs">
                                             <tbody>
                                                 <tr>
                                                     <td><strong>Total billed item :</strong></td>
                                                     <td>xxx</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>Total Qty : </strong></td>
                                                     <td>99</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>sub Total : </strong></td>
                                                     <td>8</td>
                                                 </tr>




                                             </tbody>
                                         </table>
                                     </div>


                                     <div class="col-lg-5 col-md-5 col-sm-12">
                                         <table class="table small m-b-xs table-hig">
                                             <tbody>
                                                 <tr>
                                                     <td><strong>Discount : </strong></td>
                                                     <td>26</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong><?php echo TAXNAME ?>: </strong></td>
                                                     <td>562</td>
                                                 </tr>
                                                 <tr>
                                                     <td><strong>Final Total: </strong></td>
                                                     <td>2000</td>
                                                 </tr>


                                             </tbody>
                                         </table>

                                     </div>
                                 </div>
                                 <h2>Item details</h2>

                                 <div class="table-responsive">
                                     <!--<table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_sale" >-->
                                     <table class="table table-striped table-bordered table-hover dataTables-example">
                                         <thead>
                                             <tr>
                                                 <th>Item code</th>
                                                 <th>Item name</th>
                                                 <th>Barcode</th>
                                                 <th>Quantity</th>
                                                 <th>Unit price</th>
                                                 <th>Price</th>
                                             </tr>
                                         </thead>
                                         <tbody>

                                             <tr>
                                                 <td><?php echo "fd" ?></td>
                                                 <td><?php echo "fd" ?></td>
                                                 <td><?php echo "70" ?></td>
                                                 <td><?php echo "40" ?></td>
                                                 <td><?php echo "40" ?></td>
                                                 <td><?php echo "40" ?></td>




                                             </tr>

                                         </tbody>
                                     </table>

                             </fieldset>

                             <!--                                <h1>Finish</h1>
                                                                        <fieldset>
                                                                            <h2>Terms and Conditions</h2>
                                                                            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                                                                        </fieldset>-->
                         </form>
                     </div>



                 </div>
             </div>



         </div>
     </div>
 </div>
 </div>
 </div>




 <style>
     .scroll_content-new {
         padding: 15px;
     }

     .transfer-list {
         margin: 0 0 15px 0;
     }

     .cont-padd {
         padding: 15px 0;
     }
 </style>
 <!-- Chosen -->
 <script src="js/plugins/chosen/chosen.jquery.js"></script>

 <script type="text/javascript">
     $('.scroll_content-new').slimscroll({
         height: '420px'
     })
 </script>

 <script>
     $(document).ready(function() {
         $("#wizard").steps();
         $("#form").steps({
             bodyTag: "fieldset",
             labels: {
                 next: "Bill",
                 finish: "Finish",
             },
             onStepChanging: function(event, currentIndex, newIndex) {
                 // Always allow going backward even if the current step contains invalid fields!
                 if (currentIndex > newIndex) {
                     return true;
                 }

                 // Forbid suppressing "Warning" step if the user is to young
                 if (newIndex === 3 && Number($("#age").val()) < 18) {
                     return false;
                 }

                 var form = $(this);

                 // Clean up if user went backward before
                 if (currentIndex < newIndex) {
                     // To remove error styles
                     $(".body:eq(" + newIndex + ") label.error", form).remove();
                     $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                 }

                 // Disable validation on fields that are disabled or hidden.
                 form.validate().settings.ignore = ":disabled,:hidden";

                 // Start validation; Prevent going forward if false
                 return form.valid();
             },
             onStepChanged: function(event, currentIndex, priorIndex) {
                 // Suppress (skip) "Warning" step if the user is old enough.
                 if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                     $(this).steps("next");
                 }

                 // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                 if (currentIndex === 2 && priorIndex === 3) {
                     $(this).steps("previous");
                 }
             },
             onFinishing: function(event, currentIndex) {
                 var form = $(this);

                 // Disable validation on fields that are disabled.
                 // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                 form.validate().settings.ignore = ":disabled";

                 // Start validation; Prevent form submission if false
                 return form.valid();
             },
             onFinished: function(event, currentIndex) {
                 var form = $(this);

                 // Submit form input
                 form.submit();
             }
         }).validate({
             errorPlacement: function(error, element) {
                 element.before(error);
             },
             rules: {
                 confirm: {
                     equalTo: "#password"
                 }
             }
         });
     });


     $(document).ready(function() {
         $('.dataTables-example').DataTable({
             pageLength: 25,
             responsive: true,
             //                dom: '<"html5buttons"B>lTfgitp',
             //                buttons: [
             //                    {extend: 'copy'},
             //                    {extend: 'csv'},
             //                    {extend: 'excel', title: 'ExampleFile'},
             //                    {extend: 'pdf', title: 'ExampleFile'},
             //                    {extend: 'print',
             //                        customize: function (win) {
             //                            $(win.document.body).addClass('white-bg');
             //                            $(win.document.body).css('font-size', '10px');
             //
             //                            $(win.document.body).find('table')
             //                                    .addClass('compact')
             //                                    .css('font-size', 'inherit');
             //                        }
             //                    }
             //                ]

         });

     });
 </script>

 <script>
     $(document).ready(function() {
         $('.i-checks').iCheck({
             checkboxClass: 'icheckbox_square-green',
             radioClass: 'iradio_square-green',
         });
     });
 </script>

 <style>
     /*
            Common
        */

     .wizard,
     .tabcontrol {
         display: block;
         width: 100%;
         /*overflow: hidden;*/
     }

     .wizard a,
     .tabcontrol a {
         outline: 0;
     }

     .wizard ul,
     .tabcontrol ul {
         list-style: none !important;
         padding: 0;
         margin: 0;
     }

     .wizard ul>li,
     .tabcontrol ul>li {
         display: block;
         padding: 0;
     }

     /* Accessibility */
     .wizard>.steps .current-info,
     .tabcontrol>.steps .current-info {
         position: absolute;
         left: -999em;
     }

     .wizard>.content>.title,
     .tabcontrol>.content>.title {
         position: absolute;
         left: -999em;
     }



     /*
            Wizard
        */

     .wizard>.steps {
         position: relative;
         display: block;
         width: 100%;
     }

     .wizard.vertical>.steps {
         display: inline;
         float: left;
         width: 30%;
     }

     .wizard>.steps>ul>li {
         width: 25%;
     }

     .wizard>.steps>ul>li,
     .wizard>.actions>ul>li {
         float: left;
     }

     .wizard.vertical>.steps>ul>li {
         float: none;
         width: 100%;
     }

     .wizard>.steps a,
     .wizard>.steps a:hover,
     .wizard>.steps a:active {
         display: block;
         width: auto;
         margin: 0 0.5em 0.5em;
         padding: 8px;
         text-decoration: none;

         -webkit-border-radius: 5px;
         -moz-border-radius: 5px;
         border-radius: 5px;
     }

     .wizard>.steps .disabled a,
     .wizard>.steps .disabled a:hover,
     .wizard>.steps .disabled a:active {
         background: #23C6C8;
         color: #FFF;
         cursor: default;
     }

     .wizard>.steps .current a,
     .wizard>.steps .current a:hover,
     .wizard>.steps .current a:active {
         background: #23C6C8;
         color: #fff;
         cursor: default;
     }

     .wizard>.steps .done a,
     .wizard>.steps .done a:hover,
     .wizard>.steps .done a:active {
         background: #23C6C8;
         color: #fff;
     }

     .wizard>.steps .error a,
     .wizard>.steps .error a:hover,
     .wizard>.steps .error a:active {
         background: #ED5565;
         color: #fff;
     }

     .wizard>.content {
         background: #eee;
         display: block;
         margin: 5px 5px 10px 5px;
         min-height: 120px;
         overflow: hidden;
         position: relative;
         width: auto;

         -webkit-border-radius: 5px;
         -moz-border-radius: 5px;
         border-radius: 5px;
     }

     .wizard-big.wizard>.content {
         min-height: 320px;
     }

     .wizard.vertical>.content {
         display: inline;
         float: left;
         margin: 0 2.5% 0.5em 2.5%;
         width: 65%;
     }

     .wizard>.content>.body {
         /*position: absolute;*/
         width: 100%;
         padding: 15px;
     }

     .wizard>.content>.body ul {
         list-style: disc !important;
     }

     .wizard>.content>.body ul>li {
         display: inline-block;
     }

     .wizard>.content>.body>iframe {
         border: 0 none;
         width: 100%;
         height: 100%;
     }

     .wizard>.content>.body input {
         /*display: block;*/
         border: 1px solid #ccc;
     }

     .wizard>.content>.body input[type="checkbox"] {
         display: inline-block;
     }

     .wizard>.content>.body input.error {
         background: rgb(251, 227, 228);
         border: 1px solid #fbc2c4;
         color: #8a1f11;
     }

     .wizard>.content>.body label {
         display: inline-block;
         margin-bottom: 0.5em;
     }

     .wizard>.content>.body label.error {
         color: #8a1f11;
         display: inline-block;
         margin-left: 1.5em;
     }

     .wizard>.actions {
         position: relative;
         display: block;
         text-align: right;
         width: 100%;
     }

     .wizard.vertical>.actions {
         display: inline;
         float: right;
         margin: 0 2.5%;
         width: 95%;
     }

     .wizard>.actions>ul {
         display: inline-block;
         text-align: right;
     }

     .wizard>.actions>ul>li {
         margin: 0 0.5em;
     }

     .wizard.vertical>.actions>ul>li {
         margin: 0 0 0 1em;
     }

     .wizard>.actions a,
     .wizard>.actions a:hover,
     .wizard>.actions a:active {
         background: #23C6C8;
         color: #fff;
         display: block;
         padding: 0.5em 1em;
         text-decoration: none;

         -webkit-border-radius: 5px;
         -moz-border-radius: 5px;
         border-radius: 5px;
     }

     .wizard>.actions .disabled a,
     .wizard>.actions .disabled a:hover,
     .wizard>.actions .disabled a:active {
         background: #eee;
         color: #aaa;
     }

     .wizard>.loading {}

     .wizard>.loading .spinner {}



     /*
            Tabcontrol
        */

     .tabcontrol>.steps {
         position: relative;
         display: block;
         width: 100%;
     }

     .tabcontrol>.steps>ul {
         position: relative;
         margin: 6px 0 0 0;
         top: 1px;
         z-index: 1;
     }

     .tabcontrol>.steps>ul>li {
         float: left;
         margin: 5px 2px 0 0;
         padding: 1px;

         -webkit-border-top-left-radius: 5px;
         -webkit-border-top-right-radius: 5px;
         -moz-border-radius-topleft: 5px;
         -moz-border-radius-topright: 5px;
         border-top-left-radius: 5px;
         border-top-right-radius: 5px;
     }

     .tabcontrol>.steps>ul>li:hover {
         background: #edecec;
         border: 1px solid #bbb;
         padding: 0;
     }

     .tabcontrol>.steps>ul>li.current {
         background: #fff;
         border: 1px solid #bbb;
         border-bottom: 0 none;
         padding: 0 0 1px 0;
         margin-top: 0;
     }

     .tabcontrol>.steps>ul>li>a {
         color: #5f5f5f;
         display: inline-block;
         border: 0 none;
         margin: 0;
         padding: 10px 30px;
         text-decoration: none;
     }

     .tabcontrol>.steps>ul>li>a:hover {
         text-decoration: none;
     }

     .tabcontrol>.steps>ul>li.current>a {
         padding: 15px 30px 10px 30px;
     }

     .tabcontrol>.content {
         position: relative;
         display: inline-block;
         width: 100%;
         height: 35em;
         overflow: hidden;
         border-top: 1px solid #bbb;
         padding-top: 20px;
     }

     .tabcontrol>.content>.body {
         float: left;
         position: absolute;
         width: 95%;
         height: 95%;
         padding: 2.5%;
     }

     .tabcontrol>.content>.body ul {
         list-style: disc !important;
     }

     .tabcontrol>.content>.body ul>li {
         display: list-item;
     }
 </style>