<html>

<head>

    <!-- <title style="color:hotpink"><?php echo $title; ?></title> -->
</head>


<body style="background: #fff !important;">

    <?php
    echo $this->load->view('reports/report_view/header');
    ?>

    <table border="0" width="25%" cellpadding="2" style="font-size:11px;">
        <tr class="header">
            <td align="left">Date From</td>
            <td align="left">: <?php echo  date("d-m-Y", strtotime($startdate)); ?></td>
        </tr>
        <tr>
            <td align="left">Date To</td>
            <td align="left">: <?php echo date("d-m-Y", strtotime($enddate)); ?></td>
        </tr>
    </table>

    <table class="table table-bordered" width="100%" cellpadding="5">

        <tbody>

            <?php
            foreach ($report_data as $rpt_data) {
            ?>
                <tr>
                    <td>
                        <span>Vehicle No. </span><br>
                        <span>Fuel Type </span><br>
                        <span>Odometer Reading </span><br>
                        <span>Invoice No. </span>

                    </td>
                    <td colspan="3">
                        <span> <b><?php echo strtoupper($rpt_data['vehicleNum']); ?></b></span><br>
                        <span> <?php echo $rpt_data['fuelTypeName']; ?></span><br>
                        <span> <?php echo $rpt_data['kmreading']; ?> km</span><br>
                        <span> <?php echo $rpt_data['invoiceNum']; ?></span>
                    </td>
                </tr>

                <tr>
                    <th width="30%">Parts Type</th>
                    <th width="30%">Name</th>
                    <th width="20%">Quantity</th>
                    <th width="20%">Amount(&#8377;)</th>
                </tr>

                <?php if (!empty($rpt_data['sparparts_details']) && sizeof($rpt_data['sparparts_details']) != 0) { ?>
                    <?php
                    $i = 1;
                    foreach ($rpt_data['sparparts_details'] as $spare) {
                        $data =  json_decode($spare, true);
                        foreach ($data as $d) { ?>
                            <tr>
                                <?php if ($i == 1) { ?>
                                    <td rowspan="<?php echo sizeof($data) ?>"> Spare Parts </td>
                                <?php
                                    $i++;
                                } ?>
                                <td> <?php echo $d['sparepart_name']; ?> </td>
                                <td style="text-align: right"> <?php echo $d['sparepart_quantity']; ?> </td>
                                <td style="text-align: right"> <?php echo my_money_format($d['sparepart_amount']); ?> </td>
                            </tr>
                    <?php        }
                    }

                    ?>
                <?php } else { ?>
                    <tr>

                        <td> Spare Parts </td>
                        <td colspan="3" style="text-align: center"> No Spare Parts </td>

                    </tr>
                <?php } ?>
                <?php if (!empty($rpt_data['acesories_details']) && sizeof($rpt_data['acesories_details']) != 0) { ?>
                    <?php
                    $i = 1;
                    foreach ($rpt_data['acesories_details'] as $part) {
                        $data =  json_decode($part, true);
                        foreach ($data as $d) { ?>
                            <tr>
                                <?php if ($i == 1) { ?>
                                    <td rowspan="<?php echo sizeof($data) ?>"> Accessories </td>
                                <?php
                                    $i++;
                                } ?>
                                <td> <?php echo $d['acc_name']; ?> </td>
                                <td style="text-align: right"> <?php echo $d['acc_quantity']; ?> </td>
                                <td style="text-align: right"> <?php echo my_money_format($d['acc_amount']); ?> </td>
                            </tr>
                    <?php        }
                    }

                    ?>
                <?php } else { ?>
                    <tr>

                        <td> Accessories </td>
                        <td colspan="3" style="text-align: center"> No Accessoriess </td>

                    </tr>
                <?php } ?>
                <?php if (!empty($rpt_data['miscellaneous_details']) && sizeof($rpt_data['miscellaneous_details']) != 0) { ?>
                    <?php
                    $i = 1;
                    foreach ($rpt_data['miscellaneous_details'] as $part) {
                        $data =  json_decode($part, true);
                        foreach ($data as $d) { ?>
                            <tr>
                                <?php if ($i == 1) { ?>
                                    <td rowspan="<?php echo sizeof($data) ?>"> Miscellaneous Parts </td>
                                <?php
                                    $i++;
                                } ?>
                                <td> <?php echo $d['particular_name']; ?> </td>
                                <td style="text-align: right"> <?php echo $d['miscellaneous_quantity']; ?> </td>
                                <td style="text-align: right"> <?php echo my_money_format($d['miscellaneous_amount']); ?> </td>
                            </tr>
                    <?php        }
                    }

                    ?>
                <?php } else { ?>
                    <tr>

                        <td> Miscellaneous Parts </td>
                        <td colspan="3" style="text-align: center"> No Miscellaneous Parts </td>

                    </tr>
                <?php } ?>
                <tr>
                    <td>Labour Charges (&#8377;)</td>
                    <?php

                    $ini = 0;
                    foreach ($rpt_data['labourCharge'] as $key => $labur) {
                        $ini += $labur;
                    } ?>

                    <td colspan="3" style="text-align: right"> <?php echo my_money_format($ini); ?></td>
                </tr>
                <tr>
                    <td>Other Charges (&#8377;)</td>
                    <?php
                    $ini = 0;
                    foreach ($rpt_data['otherDetails'] as $key => $other) {
                        if (is_numeric($other) && is_numeric($ini)) {
                            $ini += $other;
                        }
                    } ?>

                    <td colspan="3" style="text-align: right"> <?php echo  my_money_format($ini); ?></td>
                </tr>
                <tr>
                    <td>Total Amount (&#8377;)</td>
                    <?php
                    $ini = 0;
                    foreach ($rpt_data['amountTotal'] as $key => $total) {
                        $ini += $total;
                    } ?>

                    <td colspan="3" style="text-align: right"> <?php echo  my_money_format($ini); ?></td>


                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>