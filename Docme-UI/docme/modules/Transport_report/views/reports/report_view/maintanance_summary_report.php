<html>

<head>

    <!-- <title style="color:hotpink"><?php echo $title; ?></title> -->
</head>


<body style="background: #fff !important;">

    <?php
    echo $this->load->view('reports/report_view/header');
    // echo json_encode($report_data);
    // echo $report_data[0]['vehicleNum'];

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
            if (isset($report_data) && !empty($report_data)) { ?>
                <tr>
                    <td>Vehicle Registration Number</td>
                    <td colspan="3"><b class="text-uppercase"><?php echo strtoupper($report_data[0]['vehicleNum']); ?></b></td>
                </tr>
                <?php
                $summary_total = 0;
                foreach ($report_data as $data) { ?>
                    <tr>
                        <td colspan="4"><b><?php echo date('d-m-Y', strtotime($data['INVOICE_DATE'])) ?></b></b></td>
                    </tr>
                    <tr>
                        <td>Service Center</td>
                        <td colspan="3"><b class="text-uppercase"><?php echo strtoupper($data['ServiceCenter']); ?></b></td>
                    </tr>
                    <tr>
                        <td>Service Type</td>
                        <td colspan="3"><b class="text-uppercase"><?php echo strtoupper($data['serviceType']); ?></b></td>
                    </tr>
                    <tr>
                        <td>Odometer Reading (at the time of service booking)</td>
                        <td colspan="3"><b class="text-uppercase"><?php echo $data['kmreading']; ?> km</b></td>
                    </tr>
                    <!---->

                    <tr>
                        <th width="30%">Parts Type</th>
                        <th width="30%">Name</th>
                        <th width="20%">Quantity</th>
                        <th width="20%">Amount(&#8377;)</th>
                    </tr>

                    <?php if (!empty($data['sparparts_details']) && sizeof(json_decode($data['sparparts_details'])) != 0) { ?>
                        <?php
                        $i = 1;
                        //foreach ($data['sparparts_details'] as $spare) {
                        $json_arr_data =  json_decode($data['sparparts_details'], true);
                        foreach ($json_arr_data as $d) { ?>
                            <tr>
                                <?php if ($i == 1) { ?>
                                    <td rowspan="<?php echo sizeof($json_arr_data) ?>"> Spare Parts </td>
                                <?php
                                    $i++;
                                } ?>
                                <td> <?php echo $d['sparepart_name']; ?> </td>
                                <td style="text-align: right"> <?php echo $d['sparepart_quantity']; ?> </td>
                                <td style="text-align: right"> <?php echo my_money_format($d['sparepart_amount']); ?> </td>
                            </tr>
                        <?php        }
                        //}

                        ?>
                    <?php } else { ?>
                        <tr>

                            <td> Spare Parts </td>
                            <td colspan="3" style="text-align: center"> No Spare Parts </td>

                        </tr>
                    <?php } ?>
                    <?php if (!empty($data['acesories_details']) && sizeof(json_decode($data['acesories_details'])) != 0) { ?>
                        <?php
                        $i = 1;
                        //foreach ($data['acesories_details'] as $part) {
                        $json_arr_data =  json_decode($data['acesories_details'], true);
                        foreach ($json_arr_data as $d) { ?>
                            <tr>
                                <?php if ($i == 1) { ?>
                                    <td rowspan="<?php echo sizeof($json_arr_data) ?>"> Accessories </td>
                                <?php
                                    $i++;
                                } ?>
                                <td> <?php echo $d['acc_name']; ?> </td>
                                <td style="text-align: right"> <?php echo $d['acc_quantity']; ?> </td>
                                <td style="text-align: right"> <?php echo my_money_format($d['acc_amount']); ?> </td>
                            </tr>
                        <?php        }
                        //}

                        ?>
                    <?php } else { ?>
                        <tr>

                            <td> Accessories </td>
                            <td colspan="3" style="text-align: center"> No Accessoriess </td>

                        </tr>
                    <?php } ?>
                    <?php if (!empty($data['miscellaneous_details']) && sizeof(json_decode($data['miscellaneous_details'])) != 0) { ?>
                        <?php
                        $i = 1;
                        //foreach ($data['miscellaneous_details'] as $part) {
                        $json_arr_data =  json_decode($data['miscellaneous_details'], true);
                        foreach ($json_arr_data as $d) { ?>
                            <tr>
                                <?php if ($i == 1) { ?>
                                    <td rowspan="<?php echo sizeof($json_arr_data) ?>"> Miscellaneous Parts </td>
                                <?php
                                    $i++;
                                } ?>
                                <td> <?php echo $d['particular_name']; ?> </td>
                                <td style="text-align: right"> <?php echo $d['miscellaneous_quantity']; ?> </td>
                                <td style="text-align: right"> <?php echo my_money_format($d['miscellaneous_amount']); ?> </td>
                            </tr>
                        <?php        }
                        // }

                        ?>
                    <?php } else { ?>
                        <tr>

                            <td> Miscellaneous Parts </td>
                            <td colspan="3" style="text-align: center"> No Miscellaneous Parts </td>

                        </tr>
                    <?php } ?>

                    <!---->

                    <tr>
                        <td>Labour Charge (&#8377;)</td>
                        <td colspan="3" class="text-uppercase" style="text-align: right"><?php if (isset($data['labourCharge']) && !empty($data['labourCharge'])) {
                                                                                                echo my_money_format($data['labourCharge']);
                                                                                            } ?></td>
                    </tr>
                    <tr>
                        <td>Other Charge (&#8377;)</td>
                        <td colspan="3" class="text-uppercase" style="text-align: right"><?php if (isset($data['otherDetails']) && !empty($data['otherDetails'])) {
                                                                                                echo my_money_format($data['otherDetails']);
                                                                                            } ?></td>
                    </tr>
                    <tr>
                        <td>Total Amount (&#8377;)</td>
                        <td colspan="3" style="text-align: right"><b class="text-uppercase"><?php if (isset($data['amountTotal']) && !empty($data['amountTotal'])) {
                                                                                                $summary_total += $data['amountTotal'];
                                                                                                echo my_money_format($data['amountTotal']);
                                                                                            } ?></b></td>
                    </tr>
            <?php        }
            }
            ?>
            <tr>
                <td><b>Summary Total (&#8377;)</b></td>
                <td colspan="3" style="text-align: right"><b class="text-uppercase"><?php echo my_money_format($summary_total); ?></b></td>
            </tr>
        </tbody>
    </table>
    <!-- <?php echo json_encode($report_data); ?> -->
</body>

</html>