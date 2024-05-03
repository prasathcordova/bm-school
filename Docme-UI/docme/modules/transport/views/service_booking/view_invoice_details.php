<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="goto_previous('<?php echo $invoice_data->vehicleId ?>','<?php echo $invoice_data->vehicleNum ?>');" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                    </div>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="data-view">
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <!-- <?php echo json_encode($invoice_data); ?> -->
                                <table class="table table-bordered table-condensed">
                                    <!-- <tr>
                                        <td colspan="2">
                                            <h3 style="margin-top: 10px; margin-bottom: 10px;">About <b class="text-uppercase"><?php echo $vehicle_data[0]['tripName']; ?></b></h3>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td width='40%'>Vehicle Number</td>
                                        <td width='60%'><b class="text-uppercase"><?php echo $invoice_data->vehicleNum ? $invoice_data->vehicleNum : "NIL"; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Service Center Name</td>
                                        <td width='60%'><b class="text-uppercase"><?php echo $invoice_data->ServiceCenter ? $invoice_data->ServiceCenter : "NIL"; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Invoice Number</td>
                                        <td width='60%'>
                                            <b class="text-uppercase">
                                                <?php echo $invoice_data->invoiceNum ? $invoice_data->invoiceNum : "NIL"; ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Invoice Date</td>
                                        <td width='60%'>
                                            <b class="text-uppercase">
                                                <?php echo date('d-m-Y', strtotime($invoice_data->INVOICE_DATE))  ? date('d-m-Y', strtotime($invoice_data->INVOICE_DATE)) : "NIL"; ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Delivery Date</td>
                                        <td width='60%'>
                                            <b class="text-uppercase">
                                                <?php echo date('d-m-y', strtotime($invoice_data->DELIVERY_DATE)) ? date('d-m-Y', strtotime($invoice_data->DELIVERY_DATE)) : "NIL"; ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Customer Name</td>
                                        <td width='60%'>
                                            <b class="text-uppercase">
                                                <?php echo $invoice_data->customerName ? $invoice_data->customerName : "NIL"; ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Spare Part Details</td>
                                        <td width='60%' style="text-align: center">
                                            <?php
                                            if (sizeof(json_decode($invoice_data->sparparts_details, true)) == 0) { ?>
                                                <b><?php echo 'No Spare Parts '; ?></b>
                                            <?php    } else {
                                            ?>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50%;">Spare Part</th>
                                                            <th style="text-align: center">Quantity</th>
                                                            <th style="text-align: right">Amount <b><i class="fa fa-inr"></i></b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $spare_data = json_decode($invoice_data->sparparts_details, true);
                                                        foreach ($spare_data as $spare) { ?>
                                                            <tr>
                                                                <td style="text-align: left"><?php echo $spare['sparepart_name']; ?></td>
                                                                <td style="text-align: center"><?php echo $spare['sparepart_quantity']; ?></td>
                                                                <td style="text-align: right"><?php echo my_money_format($spare['sparepart_amount']); ?></td>
                                                            </tr>
                                                        <?php }  ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Accessories Details</td>
                                        <td width='60%' style="text-align: center">
                                            <?php
                                            if (sizeof(json_decode($invoice_data->acesories_details, true)) == 0) { ?>
                                                <b> <?php echo 'No Accessories'; ?></b>
                                            <?php     } else { ?>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50%;">Accessory</th>
                                                            <th style="text-align: center">Quantity</th>
                                                            <th style="text-align: right">Amount <b><i class="fa fa-inr"></i></b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $acesorie_data = json_decode($invoice_data->acesories_details, true);
                                                        foreach ($acesorie_data as $acesori) { ?>
                                                            <tr>
                                                                <td style="text-align: left"><?php echo $acesori['acc_name']; ?></td>
                                                                <td style="text-align: center"><?php echo $acesori['acc_quantity']; ?></td>
                                                                <td style="text-align: right"><?php echo my_money_format($acesori['acc_amount']); ?></td>
                                                            </tr>
                                                        <?php }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>


                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Miscellaneous Details</td>
                                        <td width='60%' style="text-align: center">
                                            <?php
                                            if (sizeof(json_decode($invoice_data->miscellaneous_details, true)) == 0) { ?>
                                                <b> <?php echo 'No Items'; ?></b>
                                            <?php     } else { ?>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50%;">Particular</th>
                                                            <th style="text-align: center">Quantity</th>
                                                            <th style="text-align: right">Amount <b><i class="fa fa-inr"></i></b></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $miscelan_data = json_decode($invoice_data->miscellaneous_details, true);
                                                        foreach ($miscelan_data as $miscel) { ?>
                                                            <tr>
                                                                <td style="text-align: left"><?php echo $miscel['particular_name']; ?></td>
                                                                <td style="text-align: center"><?php echo $miscel['miscellaneous_quantity']; ?></td>
                                                                <td style="text-align: right"><?php echo my_money_format($miscel['miscellaneous_amount']); ?></td>
                                                            </tr>
                                                        <?php }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>


                                        </td>
                                    </tr>

                                    <tr>
                                        <td width='40%'>Labour Charge <b><i class="fa fa-inr"></i></b></td>
                                        <td width='60%' style="text-align: right">
                                            <span class="text-uppercase">
                                                <?php echo $invoice_data->labourCharge ? my_money_format($invoice_data->labourCharge) : "NIL"; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Other Charge <b><i class="fa fa-inr"></i></b></td>
                                        <td width='60%' style="text-align: right">
                                            <span class="text-uppercase">
                                                <?php echo $invoice_data->otherDetails ? my_money_format($invoice_data->otherDetails) : "NIL"; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Total Amount <b><i class="fa fa-inr"></i></b></td>
                                        <td width='60%' style="text-align: right">
                                            <b class="text-uppercase">
                                                <?php echo $invoice_data->amountTotal ? my_money_format($invoice_data->amountTotal) : "NIL"; ?> </b>
                                        </td>
                                    </tr>



                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function goto_previous(id, num) {
        var ops_url = baseurl + 'transport/load-vehicle-invoice-history/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": id,
                "vehiclenum": num
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }
</script>