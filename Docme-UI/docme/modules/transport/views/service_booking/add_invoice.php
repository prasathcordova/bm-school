<style>
    .numericDecimal {
        text-align: right
    }
</style>

<?php

?>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!-- <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Vehicle" data-placement="left" href="javascript:void(0)" onclick="add_new_invoice();">ADD NEW INVOICE</a> -->
                        <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                    </div>
                </div>
                <input type="hidden" name="servicebookingid" id="servicebookingid" value="<?php echo isset($servicebooking_id) && !empty($servicebooking_id) ? $servicebooking_id : ''; ?>" />
                <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                <input type="hidden" name="vehiclenum" id="vehiclenum" value="<?php echo isset($vehicle_num) && !empty($vehicle_num) ? $vehicle_num : ''; ?>" />
                <input type="hidden" name="servicecenter_id" id="servicecenter_id" value="<?php echo isset($serviceCenterId) && !empty($serviceCenterId) ? $serviceCenterId : ''; ?>" />
                <input type="hidden" name="servicecenter" id="servicecenter" value="<?php echo isset($ServiceCenter) && !empty($ServiceCenter) ? $ServiceCenter : ''; ?>" />
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <!-- <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> -->
                                        <!-- <div class="well">
                                            <span>Vehicle NO : </span><b><?php echo $vehicle_num; ?></b>
                                            <span>Service Center : </span><b><?php echo $ServiceCenter; ?></b>
                                        </div> -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-condensed">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 40%">Vehicle No.</td>
                                                        <td style="width: 60%"> <b><?php echo $vehicle_num; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 40%">School No.</td>
                                                        <td style="width: 60%"><b><?php echo $schoolnum; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 40%">Service Center</td>
                                                        <td style="width: 60%"><b><?php echo $ServiceCenter; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 40%">Service Advisor Contact No.</td>
                                                        <td style="width: 60%"><b><?php echo $advisorcontno; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 40%">Odometer </td>
                                                        <td style="width: 60%"><b><?php echo $odometerread ? $odometerread : 'No details available'; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 40%">Date of Service</td>
                                                        <td style="width: 60%" id="DOS"><b><?php echo date("d-m-Y", strtotime($servicedate)); ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 40%">Expected Delivery Date</td>
                                                        <td style="width: 60%"><b><?php echo date("d-m-Y", strtotime($deliverydate)); ?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span> -->
                                        <span><a href="javascript:void(0);" onclick="save_servicecenterinvoice_details('<?php echo date('d-m-Y', strtotime($servicedate)); ?>','<?php echo date('d-m-Y', strtotime($deliverydate)); ?>');"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                                        <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                                        </h2>
                                    </div>
                                    <input type="hidden" name="servicebooking_id" id="servicebooking_id" value="<?php echo isset($servicebooking_id) && !empty($servicebooking_id) ? $servicebooking_id : ''; ?>" />
                                    <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                                    <input type="hidden" name="vehiclenum" id="vehiclenum" value="<?php echo isset($vehicle_num) && !empty($vehicle_num) ? $vehicle_num : ''; ?>" />
                                    <input type="hidden" name="servicecenter_id" id="servicecenter_id" value="<?php echo isset($serviceCenterId) && !empty($serviceCenterId) ? $serviceCenterId : ''; ?>" />
                                    <input type="hidden" name="servicecenter" id="servicecenter" value="<?php echo isset($ServiceCenter) && !empty($ServiceCenter) ? $ServiceCenter : ''; ?>" />
                                    <div class="body">


                                        <?php
                                        function getsparecontrol($sparedata)
                                        {
                                            $options = '';
                                            if (isset($sparedata) && !empty($sparedata)) {
                                                foreach ($sparedata as $spar) {
                                                    $options .= "<option value='" . $spar['partName'] . "'>" . $spar['partName'] . '</option>';
                                                }
                                            }
                                            return $options;
                                        }
                                        // echo getsparecontrol($sparedata);
                                        $breaker = 0;
                                        ?>
                                        <div class="col-lg-12">
                                            <div id="curd-content" style="display: none;"></div>
                                            <div class="ibox-content">
                                                <form method="post" id="myform">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <label class="form-label">Invoice No. *</label>
                                                                    <input type="text" class="form-control nofocusitem" name="invoice_num" id="invoice_num" autocomplete="off" placeholder="Invoice No." maxlength="10">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group date">
                                                                <div class="form-line">
                                                                    <label class="form-label">Invoice Date *</label>
                                                                    <input type="text" class="form-control" name="invoicedate" id="invoicedate" placeholder="Invoice Date" autocomplete="off" readonly style="background: #fff">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group date">
                                                                <div class="form-line">
                                                                    <label class="form-label">Delivery Date *</label>
                                                                    <input type="text" class="form-control" name="delivery_date" id="delivery_date" placeholder="Delivery Date" autocomplete="off" readonly style="background: #fff">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-sm-6">
                                                            <div class="form-group date">
                                                                <div class="form-line">
                                                                    <label class="form-label">Service Date *</label>
                                                                    <input type="text" class="form-control" name="service_date" id="service_date" placeholder="Service Date" autocomplete="off" readonly style="background: #fff">
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-sm-6">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <label class="form-label">Odometer Reading (at the time of delivery)*</label>
                                                                    <input type="text" class="form-control numeric" name="kmreading" id="kmreading" placeholder="Odometer Reading" autocomplete="off" style="text-align: left">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <label class="form-label">File Upload(optional)</label><br>
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <span class="btn btn-primary btn-xs btn-file" title="Select file"><span class="fileinput-new" style="top:0px!important">Select file</span>
                                                                            <span class="fileinput-exists">Change</span><input type="file" name="file" class="invoice_doc" id="file" /></span>&nbsp;
                                                                        <span class="fileinput-filename"></span>
                                                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;font-size:16px" title="close">x</a>
                                                                    </div>
                                                                    <!-- <input type="text" class="form-control" name="spares" id="spares" autocomplete="off"> -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <span class="sparpartcontrol">
                                                        </span>
                                                        <div class="col-sm-12">
                                                            <a href="javascript:void(0);" class="addsparpartcontrol" title="Add Spare Parts">
                                                                <span class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Add Spare Parts</span>
                                                            </a>
                                                        </div>
                                                        <span class="acessoriescontrol">

                                                        </span>
                                                        <div class="col-sm-12">
                                                            <a href="javascript:void(0);" class="addacessories" title="Add Accessories">
                                                                <span class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Add Accessories</span>
                                                            </a>
                                                        </div>
                                                        <span class="miscellaneouscontrol">

                                                        </span>
                                                        <div class="col-sm-12">
                                                            <a href="javascript:void(0);" class="miscellaneous" title="Add Miscellaneous">
                                                                <span class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Add Miscellaneous</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <label class="form-label">Labour Charge *</label>
                                                                    <input type="text" class="form-control numericDecimal labour_chrge" name="labour_chrge" id="labour_chrge" placeholder="Labour Charge" autocomplete="off" maxlength="10">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <label class="form-label">Other Charge</label>
                                                                    <input type="text" class="form-control numericDecimal other_charge" name="other_charge" id="other_charge" placeholder="Other Charge" autocomplete="off" maxlength="10">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <label class="form-label">Bill Total</label>
                                                                    <input type="text" class="form-control numericDecimal" name="amt_total" id="amt_total" autocomplete="off" readonly maxlength="6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="servicebookingid" id="servicebookingid" value="<?php echo isset($servicebooking_id) && !empty($servicebooking_id) ? $servicebooking_id : ''; ?>" />
                                                    <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                                                    <input type="hidden" name="vehiclenum" id="vehiclenum" value="<?php echo isset($vehicle_num) && !empty($vehicle_num) ? $vehicle_num : ''; ?>" />
                                                    <input type="hidden" name="servicecenter_id" id="servicecenter_id" value="<?php echo isset($serviceCenterId) && !empty($serviceCenterId) ? $serviceCenterId : ''; ?>" />
                                                    <input type="hidden" name="servicecenter" id="servicecenter" value="<?php echo isset($ServiceCenter) && !empty($ServiceCenter) ? $ServiceCenter : ''; ?>" />
                                                    <input type="hidden" name="invoiceuploadefile" id="invoiceuploadefile" />
                                                    <input type="hidden" name="service_date" id="service_date" value="<?php echo date("d-m-Y", strtotime($servicedate)); ?>" />
                                                </form>
                                            </div>
                                            <?php
                                            if ($breaker == 3) {
                                                echo '<div class="clearfix"></div>';
                                                $breaker = 0;
                                            } else {
                                                $breaker++;
                                            }
                                            //                                    }
                                            //                                }
                                            ?>
                                        </div>
                                        <!--</div>-->
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function() {
        // <?php if (isset($sparedata) && !empty($sparedata)) {
                foreach ($sparedata as $spare) {
                    echo '<option value ="' . $spare['partNumber'] . '" >' . $spare['partName'] . '</option>';
                }
            } ?>

        var maxfield = 20;
        var addbtn = $('.addsparpartcontrol');
        var acesrbtn = $('.addacessories');
        var miscellaneousbtn = $('.miscellaneous');
        var sparecntrcls = $('.sparpartcontrol');
        var apediv = $('.acessoriescontrol');
        var miscellancntrol = $('.miscellaneouscontrol');
        var i = 0;
        var fieldHTML = "<span class='spareindex'><div class='col-sm-4'><div class='form-group'><label class='form-label'>Select Spare Part</label><select class='form-control show-tick selectpicker select_sparepart' name='select_sparepart[]' id='select_sparepart[]' data-live-search='true'> <option selected value = '-1' > Select </option> <?php echo  getsparecontrol($sparedata); ?></select></div></div><div class='col-sm-2'><div class='form-group'><label class='form-label'>Quantity</label><input type = 'text' class = 'form-control numericDecimal spare_quantity' name = 'spare_quantity[]' id = 'spare_quantity[]' placeholder='Quantity' maxlength='3' autocomplete='off'/></div></div> <div class = 'col-sm-4'> <div class = 'form-group'> <label class ='form-label'> Amount </label><input type='text' class='form-control spare_amount numericDecimal' name='spare_amount[]' id='spare_amount[]' placeholder='Amount' maxlength='10' autocomplete='off'/></div></div><div class ='col-sm-2 text-center' style = 'margin-top:28px'><a style = 'float:right' href = 'javascript:void(0)' title = 'Remove' class = 'spare_remove_btn' > <i class = 'fa fa-times' > </i></a></div></span>";
        var acessoriefieldHTML = "<span class='accessoriesindex'><div class='col-sm-4'> <div class='form-group'><label class='form-label'>Accessories Name</label><input type='text' maxlength='30' class='form-control acessoriesname' name='acessoriesname[]' id='acessoriesname[]' placeholder='Accessories Name'/></div></div><div class='col-sm-2'><div class='form-group'><label class='form-label'>Quantity</label><input type='text' class='form-control numericDecimal acessori_quantity' name='acessori_quantity[]' id='acessori_quantity[]' placeholder='Quantity' maxlength='3' autocomplete='off'/></div></div><div class='col-sm-4'><div class='form-group'><label class='form-label'>Amount</label><input type='text' class='form-control acessori_amount numericDecimal' name='acessori_amount[]' id='acessori_amount[]' placeholder='Amount' maxlength='10' autocomplete='off'/></div></div><div class='col-sm-2 text-center' style='margin-top:28px'><a style='float:right' href='javascript:void(0)' title='Remove' class='acessori_remove_btn'><i class='fa fa-times'></i></a></div></span>";
        var miscellaneousHTML = "<span class='miscellaneousindex'><div class='col-sm-4'> <div class='form-group'><label class='form-label'>Particular</label><input type='text' maxlength='30' class='form-control particularname' name='particularname[]' id='particularname[]' placeholder='Particular'/></div></div><div class='col-sm-2'><div class='form-group'><label class='form-label'>Quantity</label><input type='text' class='form-control numericDecimal miscellaneous_quantity' name='miscellaneous_quantity[]' id='miscellaneous_quantity[]' placeholder='Quantity' maxlength='3' autocomplete='off'/></div></div><div class='col-sm-4'><div class='form-group'><label class='form-label'>Amount</label><input type='text' class='form-control miscellaneous_amount numericDecimal' name='miscellaneous_amount[]' id='miscellaneous_amount[]' placeholder='Amount' maxlength='10' autocomplete='off'/></div></div><div class='col-sm-2 text-center' style='margin-top:28px'><a style='float:right' href='javascript:void(0)' title='Remove' class='miscellaneous_remove_btn'><i class='fa fa-times'></i></a></div></span>";
        // var x = 1;
        $(addbtn).click(function() {
            $(sparecntrcls).append(fieldHTML);
            $('.selectpicker').select2({
                "theme": "bootstrap",
                "width": "100%"
            });
            $(".spare_amount").on("keyup", function() {
                var thisval = parseFloat($(this).val());
                var spar_sum = 0;
                var acc_sum = 0;
                var miscellan_sum = 0;
                var labourchrg = 0;
                var outherchrg = 0;
                $('.spare_amount').each(function(i, e) {
                    spar_sum += +$(this).val();
                });
                $('.acessori_amount').each(function(i, e) {
                    acc_sum += +$(this).val();
                });
                $('.miscellaneous_amount').each(function(i, e) {
                    miscellan_sum += +$(this).val();
                    // filter_input
                });

                var labourchrgeval = $('#labour_chrge').val();
                if (labourchrgeval == '') {
                    labourchrg = 0;
                } else {
                    labourchrg = parseFloat($('#labour_chrge').val());
                }

                var outherchrgeval = $('#other_charge').val();
                if (outherchrgeval == '') {
                    outherchrg = 0;
                } else {
                    outherchrg = parseFloat($('#other_charge').val());
                }
                var sparandaccsum = parseFloat(spar_sum) + parseFloat(acc_sum) + parseFloat(miscellan_sum) + parseFloat(outherchrg) + parseFloat(labourchrg);
                if (isNaN(sparandaccsum)) {
                    $('#amt_total').val(0);
                } else {
                    $('#amt_total').val(sparandaccsum.toFixed(2));
                }

            });
        });

        $(acesrbtn).click(function() {
            $(apediv).append(acessoriefieldHTML);
            $(".acessori_amount").on("keyup", function() {
                var thisval = parseFloat($(this).val());
                var spar_sum = 0;
                var acc_sum = 0;
                var miscellan_sum = 0;
                var labourchrg = 0;
                var outherchrg = 0;
                var outherchrgeval = $('#other_charge').val();
                if (outherchrgeval == '') {
                    outherchrg = 0;
                } else {
                    outherchrg = parseFloat($('#other_charge').val());
                }
                var labourchrgeval = $('#labour_chrge').val();
                if (labourchrgeval == '') {
                    labourchrg = 0;
                } else {
                    labourchrg = parseFloat($('#labour_chrge').val());
                }
                $('.spare_amount').each(function(i, e) {
                    spar_sum += +$(this).val();
                });
                $('.acessori_amount').each(function(i, e) {
                    acc_sum += +$(this).val();
                    // filter_input
                });
                $('.miscellaneous_amount').each(function(i, e) {
                    miscellan_sum += +$(this).val();
                    // filter_input
                });
                var acessoricsum = parseFloat(spar_sum) + parseFloat(acc_sum) + parseFloat(miscellan_sum) + parseFloat(outherchrg) + parseFloat(labourchrg);
                // console.log(parseInt(spar_sum) + parseInt(acc_sum));
                if (isNaN(acessoricsum)) {
                    $('#amt_total').val(0);
                } else {
                    $('#amt_total').val(acessoricsum.toFixed(2));
                }
            });
            // acessori_amount
            $('.selectpicker').select2({
                "theme": "bootstrap",
                "width": "100%"
            });
        });


        $(miscellaneousbtn).click(function() {
            $(miscellancntrol).append(miscellaneousHTML);
            $(".miscellaneous_amount").on("keyup", function() {
                var thisval = parseFloat($(this).val());
                var spar_sum = 0;
                var acc_sum = 0;
                var miscellan_sum = 0;
                var labourchrg = 0;
                var outherchrg = 0;
                var outherchrgeval = $('#other_charge').val();
                if (outherchrgeval == '') {
                    outherchrg = 0;
                } else {
                    outherchrg = parseFloat($('#other_charge').val());
                }
                var labourchrgeval = $('#labour_chrge').val();
                if (labourchrgeval == '') {
                    labourchrg = 0;
                } else {
                    labourchrg = parseFloat($('#labour_chrge').val());
                }
                $('.spare_amount').each(function(i, e) {
                    spar_sum += +$(this).val();
                });
                $('.acessori_amount').each(function(i, e) {
                    acc_sum += +$(this).val();
                    // filter_input
                });
                $('.miscellaneous_amount').each(function(i, e) {
                    miscellan_sum += +$(this).val();
                    // filter_input
                });
                var miscellaneoussum = parseFloat(spar_sum) + parseFloat(acc_sum) + parseFloat(miscellan_sum) + parseFloat(outherchrg) + parseFloat(labourchrg);
                if (isNaN(miscellaneoussum)) {
                    $('#amt_total').val(0);
                } else {
                    $('#amt_total').val(miscellaneoussum.toFixed(2));
                }
            });
            // acessori_amount
            $('.selectpicker').select2({
                "theme": "bootstrap",
                "width": "100%"
            });
        });



        $(document).on('click', '.spare_remove_btn', function(e) {
            e.preventDefault();
            var spar_sum = 0;
            var acc_sum = 0;
            var miscellan_sum = 0;
            var labourchrg = 0;
            var outherchrg = 0;
            $(this).parent('div').closest('span').remove();
            $('.spare_amount').each(function(i, e) {
                spar_sum += +$(this).val();
            });
            $('.acessori_amount').each(function(i, e) {
                acc_sum += +$(this).val();
            });

            $('.miscellaneous_amount').each(function(i, e) {
                miscellan_sum += +$(this).val();
                // filter_input
            });
            var outherchrgeval = $('#other_charge').val();
            if (outherchrgeval == '') {
                outherchrg = 0;
            } else {
                outherchrg = parseFloat($('#other_charge').val());
            }
            var labourchrgeval = $('#labour_chrge').val();
            if (labourchrgeval == '') {
                labourchrg = 0;
            } else {
                labourchrg = parseFloat($('#labour_chrge').val());
            }
            var sparandaccsum = parseFloat(spar_sum) + parseFloat(acc_sum) + parseFloat(miscellan_sum) + parseFloat(outherchrg) + parseFloat(labourchrg);
            // console.log(sparandaccsum + parseInt($('#other_charge').val()));
            if (isNaN(sparandaccsum)) {
                $('#amt_total').val(0);
            } else {
                $('#amt_total').val(sparandaccsum.toFixed(2));
            }

        });


        $(document).on('click', '.acessori_remove_btn', function(e) {
            e.preventDefault();
            var spar_sum = 0;
            var acc_sum = 0;
            var miscellan_sum = 0;
            var labourchrg = 0;
            var outherchrg = 0;
            $(this).parent('div').closest('span').remove();
            $('.spare_amount').each(function(i, e) {
                spar_sum += +$(this).val();
            });
            $('.acessori_amount').each(function(i, e) {
                acc_sum += +$(this).val();
            });
            $('.miscellaneous_amount').each(function(i, e) {
                miscellan_sum += +$(this).val();
                // filter_input
            });
            var outherchrgeval = $('#other_charge').val();
            if (outherchrgeval == '') {
                outherchrg = 0;
            } else {
                outherchrg = parseFloat($('#other_charge').val());
            }
            var labourchrgeval = $('#labour_chrge').val();
            if (labourchrgeval == '') {
                labourchrg = 0;
            } else {
                labourchrg = parseFloat($('#labour_chrge').val());
            }
            var accessoriesum = parseFloat(spar_sum) + parseFloat(acc_sum) + parseFloat(miscellan_sum) + parseFloat(outherchrg) + parseFloat(labourchrg);
            if (isNaN(accessoriesum)) {
                $('#amt_total').val(0);
            } else {
                $('#amt_total').val(accessoriesum.toFixed(2));
            }
        });

        $(document).on('click', '.miscellaneous_remove_btn', function(e) {
            e.preventDefault();
            var spar_sum = 0;
            var acc_sum = 0;
            var miscellan_sum = 0;
            var labourchrg = 0;
            var outherchrg = 0;
            $(this).parent('div').closest('span').remove();
            $('.spare_amount').each(function(i, e) {
                spar_sum += +$(this).val();
            });
            $('.acessori_amount').each(function(i, e) {
                acc_sum += +$(this).val();
            });
            $('.miscellaneous_amount').each(function(i, e) {
                miscellan_sum += +$(this).val();
                // filter_input
            });
            var outherchrgeval = $('#other_charge').val();
            if (outherchrgeval == '') {
                outherchrg = 0;
            } else {
                outherchrg = parseFloat($('#other_charge').val());
            }
            var labourchrgeval = $('#labour_chrge').val();
            if (labourchrgeval == '') {
                labourchrg = 0;
            } else {
                labourchrg = parseFloat($('#labour_chrge').val());
            }
            var miscellaneoussum = parseFloat(spar_sum) + parseFloat(acc_sum) + parseFloat(miscellan_sum) + parseFloat(outherchrg) + parseFloat(labourchrg);
            if (isNaN(miscellaneoussum)) {
                $('#amt_total').val(0);
            } else {
                $('#amt_total').val(miscellaneoussum.toFixed(2));
            }
        });

        $('.labour_chrge').on('keyup', function() {
            var labourchrgeval = parseFloat($(this).val());
            var sum = 0;
            var acc_sum = 0;
            var miscellan_sum = 0;
            var labourchrg = 0;
            var outherchrg = 0;
            var outherchrgeval = $('#other_charge').val();
            if (outherchrgeval == '') {
                outherchrg = 0;
            } else {
                outherchrg = parseFloat($('#other_charge').val());
            }
            var labourchrgeval = $('#labour_chrge').val();
            if (labourchrgeval == '') {
                labourchrg = 0;
            } else {
                labourchrg = parseFloat($('#labour_chrge').val());
            }
            $('.spare_amount').each(function(i, e) {
                sum += +$(this).val();
            });
            $('.acessori_amount').each(function(i, e) {
                acc_sum += +$(this).val();
            });
            $('.miscellaneous_amount').each(function(i, e) {
                miscellan_sum += +$(this).val();
                // filter_input
            });
            var labourchrgsum = parseFloat(sum) + parseFloat(acc_sum) + parseFloat(miscellan_sum) + labourchrg + parseFloat(outherchrg);
            if (isNaN(labourchrgsum)) {
                $('#amt_total').val(0);
            } else {
                $('#amt_total').val(labourchrgsum.toFixed(2));
            }

        });

        $('.other_charge').on('keyup', function() {
            var otherchrgval = parseFloat($(this).val());
            var sum = 0;
            var acc_sum = 0;
            var miscellan_sum = 0;
            var labourchrg = 0;
            var outherchrg = 0;
            var outherchrgeval = $('#other_charge').val();

            if (outherchrgeval == '') {
                outherchrg = 0;
            } else {
                outherchrg = parseFloat(otherchrgval);
            }

            var labourchrgeval = $('#labour_chrge').val();
            if (labourchrgeval == '') {
                labourchrg = 0;
            } else {
                labourchrg = parseFloat($('#labour_chrge').val());
            }
            $('.spare_amount').each(function() {
                sum += +$(this).val();
            });
            $('.acessori_amount').each(function(i, e) {
                acc_sum += +$(this).val();
            });
            $('.miscellaneous_amount').each(function(i, e) {
                miscellan_sum += +$(this).val();
                // filter_input
            });

            var otherchrgsum = parseFloat(sum) + parseFloat(acc_sum) + parseFloat(miscellan_sum) + parseFloat(labourchrg) + outherchrg;
            if (isNaN(otherchrgsum)) {
                $('#amt_total').val(0);
            } else {
                $('#amt_total').val(otherchrgsum.toFixed(2));
            }
        });



        $('.selectpicker').select2({
            "theme": "bootstrap",
            "width": "100%"
        });

        mindeliveryDate = $('#DOS').text();

        $('#invoicedate').datepicker({
            //todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            startDate: mindeliveryDate,
            endDate: '+0d',
            format: 'dd-mm-yyyy'
        });


        $('#delivery_date').datepicker({
            // minDate:mindeliveryDate,
            //todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            startDate: mindeliveryDate,
            endDate: '+7d',
            format: 'dd-mm-yyyy'
        });


    });



    function upload_file() {
        var file_data = $('#file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        var ops_url = baseurl + 'transport-report/file-upload';
        $.ajax({
            url: ops_url,
            dataType: 'text', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response) {
                console.log(response);
                if (response == 1) {
                    swal('', 'Max 2MB file is allowed for invoice file.', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                }
                $('#invoiceuploadefile').val(response); // display success response from the server
            },
            error: function(response) {
                // console.log(response);
                $('#msg').html(response); // display error response from the server
            }
        });
    }

    function refresh_add_panel() {
        $('#country_name').val('');
        $('#country_name').parent().removeAttr('class', 'select_spareparthas-error');
        $('#country_nation').val('');
        $('#country_nation').parent().removeAttr('class', 'has-error');
        $('#country_abbr').val('');
        $('#country_abbr').parent().removeAttr('class', 'has-error');
        $('#currency_select').select2('val', -1);
    }



    $(".select2_vehicle").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $(".select2_serviceattend").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $(".select2_servicecompleted").select2({
        "theme": "bootstrap",
        "width": "100%"
    });

    function load_vehicleservice_invoice_form() {
        var ops_url = baseurl + 'transport/show-vehicle-service-invoice/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }


    function save_servicecenterinvoice_details(service_data, delivery_date) {
        if ($('#file').prop('files')[0] != undefined) {
            upload_file();
        }

        // $('#faculty_loader').addClass('sk-loading');
        // var servicebooking_id = $('#servicebooking_id').val();
        var serv_date = moment(service_data, 'DD-MM-YYYY');
        var deliv_date = moment(delivery_date, 'DD-MM-YYYY');
        var invoice_date_obj = moment($('#invoicedate').val(), 'DD-MM-YYYY');
        var delivery_date_obj = moment($('#delivery_date').val(), 'DD-MM-YYYY');

        var vehicle_id = $('#vehicleid').val();
        var invoice_num = $('#invoice_num').val();
        var invoice_date = moment($('#invoicedate').datepicker('getDate')).format('YYYY-MM-DD');
        var delivery_date = moment($('#delivery_date').datepicker('getDate')).format('YYYY-MM-DD');
        var invoice_service_date = moment($('#service_date').datepicker('getDate')).format('YYYY-MM-DD');
        var km_reading = $('#kmreading').val();
        var vehicle_num = $('#vehiclenum').val();
        var servicecenterid = $('#servicecenter_id').val();
        var servicecenter_name = $('#servicecenter').val();
        var spares_name = $('.select_sparepart').val();
        var spare_quan = $('.spare_quantity').val();
        var spar_amnt = $('.spare_amount').val();
        var acessories_name = $('.acessoriesname').val();
        var acessories_quan = $('.acessori_quantity').val();
        var acessories_amnt = $('.acessori_amount').val();
        var other_chrge = $('#other_charge').val();
        var labour_chrge = $('#labour_chrge').val();
        var amt_total = $('#amt_total').val();
        // alert(delivery_date + '' + service_data);
        // return;
        if (invoice_num == '') {
            swal('', 'Invoice No is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ((invoice_num.length > 10) || (invoice_num.length < 3)) {
            swal('', 'Invoice No should be 3 to 10 characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (invoice_date == 'Invalid date') {
            swal('', 'Invoice Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (invoice_date_obj < serv_date) {
            swal('', 'Invoice date should be greater than or equal to Date of service.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (delivery_date == 'Invalid date') {
            swal('', 'Delivery Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (delivery_date_obj < serv_date) {
            swal('', 'Delivery date should be gretar than or equal to Date of service.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (invoice_service_date == '') {
            swal('', 'Service Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (km_reading == '') {
            swal('', 'Odometer Reading is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (labour_chrge == '') {
            swal('', 'Labour Charge is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        //else if (other_chrge == '') {
        //     swal('', 'Other Charge is required.', 'info');
        //     $('#faculty_loader').removeClass('sk-loading');
        //     return false;
        // } 
        if (spares_name == '-1') {
            swal('', 'Spare Part is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (spare_quan == '') {
            swal('', 'Quantity is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (spar_amnt == '') {
            swal('', 'Amount is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (acessories_name == '') {
            swal('', 'Accessories Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (acessories_quan == '') {
            swal('', 'Quantity is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (acessories_amnt == '') {
            swal('', 'Amount is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $('.select_sparepart').each(function() {
            var count = 1;
            if ($(this).val() == '-1') {
                swal('', 'Spare Part is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            count = count + 1;
        });
        $('.spare_quantity').each(function() {
            var count = 1;
            if ($(this).val() == '') {
                swal('', 'Quantity is  required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            count = count + 1;
        });
        $('.spare_amount').each(function() {
            var count = 1;
            if ($(this).val() == '') {
                swal('', 'Amount is  required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            count = count + 1;
        });

        $('.acessoriesname').each(function() {
            var count = 1;
            if ($(this).val() == '') {
                swal('', 'Accessories Name is  required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            count = count + 1;
        });

        $('.acessori_amount').each(function() {
            var count = 1;
            if ($(this).val() == '') {
                swal('', 'Amount is  required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            count = count + 1;
        });

        $('.acessori_quantity').each(function() {
            var count = 1;
            if ($(this).val() == '') {
                swal('', 'Quantity is  required', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            count = count + 1;
        });


        var serviceinvoice_vehicle = new Object();
        serviceinvoice_vehicle.servicebooking_id = servicebooking_id;
        serviceinvoice_vehicle.vehicleid = vehicle_id;
        serviceinvoice_vehicle.invoice_date = invoice_date;
        serviceinvoice_vehicle.delivery_date = delivery_date;
        serviceinvoice_vehicle.vehiclenum = vehicle_num;
        serviceinvoice_vehicle.servicecenterid = servicecenterid;
        serviceinvoice_vehicle.servicecentername = servicecenter_name;
        serviceinvoice_vehicle.invoicenum = invoice_num;
        serviceinvoice_vehicle.spares_name = spares_name;
        serviceinvoice_vehicle.spare_quan = spare_quan;
        serviceinvoice_vehicle.spar_amnt = spar_amnt;
        serviceinvoice_vehicle.acessories_name = acessories_name;
        serviceinvoice_vehicle.acessories_quan = acessories_quan;
        serviceinvoice_vehicle.acessories_amnt = acessories_amnt;
        serviceinvoice_vehicle.other_chrge = other_chrge;
        serviceinvoice_vehicle.labour_chrge = labour_chrge;
        serviceinvoice_vehicle.amt_total = amt_total;
        // serviceinvoice_vehicle.sparecontrolval = sparecontrolval;
        // serviceinvoice_vehicle.acessoriescontrolval = acessoriescontrolval;
        // var data = new FormData();
        // var form_data = $('#myform').serialize();
        // var file_data = $('input[name="file"]')[0].files;
        // data.append(form_data, file_data);
        // console.log($('#myform').serialize());
        // return;
        // var serviceinvoice_vehicle_data = JSON.stringify(serviceinvoice_vehicle);
        var ops_url = baseurl + 'transport/save-serviceinvoice-details/';
        setTimeout(function() {
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: $('#myform').serialize(),
                // data: {
                //     "load": 1,
                //     "service_invoice_vehicle_data": serviceinvoice_vehicle_data
                // },
                success: function(result) {
                    var data = JSON.parse(result);
                    $('#faculty_loader').removeClass('sk-loading');
                    if (data.status == 1) {
                        load_vehicleservice_invoice_form();
                        swal('Success', 'New Service Invoice For Vehicle, ' + vehicle_num + ' Saved successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        $("#curd-content").slideUp("slow", function() {
                            $("#curd-content").hide();
                            $('#add_type').show();
                        });
                    } else if (data.status == 2) {
                        $('#curd-content').html('');
                        $('#curd-content').html(data.view);
                        swal('', data.message, 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    } else if (data.status == 3) {
                        $('#curd-content').html('');
                        $('#curd-content').html(data.view);
                        swal('', data.message, 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    } else {
                        swal('', 'Connection Error. Please contact administrator', 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    }
                }
            });
        }, 1000);

    }

    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }

    function clear_controls() {
        $('#invoice_num').val('');
        $('#invoicedate').val('');
        $('#delivery_date').val('');
        $('#service_date').val('');
        $('.select_sparepart').each(function(i, e) {
            $(this).val('-1');
        });
        $('.spare_quantity').each(function(i, e) {
            console.log($(this).val(''));
        });
        $('.spare_amount').each(function() {
            $(this).val('');
        });
        $('.acessoriesname').each(function() {
            $(this).val('');
        });
        $('.acessori_quantity').each(function() {
            $(this).val('');
        });
        $('.acessori_amount').each(function(i, e) {
            $(this).val('');
        });
        $('#labour_chrge').val('');
        $('#other_charge').val('');
        $('#amt_total').val('');
        $('#kmreading').val('')
    }

    function goto_previous() {
        var ops_url = baseurl + 'transport/show-vehicle-service-invoice/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }
</script>