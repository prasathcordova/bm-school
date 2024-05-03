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

    <table class="table table-bordered" width="100%" cellpadding="5">

        <tbody>
            <tr>
                <td width="40%">Vehicle Number</td>
                <td width="60%"><b class="text-uppercase"><?php echo $report_data[0]['vehicleNum']; ?></b></td>
            </tr>
            <tr>
                <td width="40%">Service Center</td>
                <td width="60%"><b class="text-uppercase"><?php echo $report_data[0]['ServiceCenter']; ?></b></td>
            </tr>
            <tr>
                <td width="40%">Spareparts Details</td>
                <td width="60%">
                    <?php
                    if (is_null($report_data[0]['sparparts_details'])) { ?>
                        <b><?php echo 'No Details'; ?></b>
                    <?php    } else {
                    ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Spare Part</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $spare_data = json_decode($report_data[0]['sparparts_details'], true);
                                foreach ($spare_data as $spare) { ?>
                                    <tr>
                                        <td><?php echo $spare['sparepart_name']; ?></td>
                                        <td><?php echo $spare['sparepart_quantity']; ?></td>
                                        <td><?php echo $spare['sparepart_amount']; ?></td>
                                    </tr>
                                <?php }  ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td width='40%'>Acesories Details</td>
                <td width='60%'>
                    <?php
                    if (is_null($report_data[0]['acesories_details'])) { ?>
                        <b> <?php echo 'No Details'; ?></b>
                    <?php     } else { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Acesories Name</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $acesorie_data = json_decode($report_data[0]['acesories_details'], true);
                                foreach ($acesorie_data as $acesori) { ?>
                                    <tr>
                                        <td><?php echo $acesori['acc_name']; ?></td>
                                        <td><?php echo $acesori['acc_quantity']; ?></td>
                                        <td><?php echo $acesori['acc_amount']; ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    <?php } ?>

                    <b class="text-uppercase">
                        <!-- <?php echo $invoice_data->sparparts_details ? $invoice_data->sparparts_details : "NIL"; ?>- -->
                    </b>
                </td>
            </tr>
            <tr>
                <td width="40%">Labour Charge</td>
                <td width="60%"><b class="text-uppercase"><?php echo $report_data[0]['labourCharge']; ?></b></td>
            </tr>
            <tr>
                <td width="40%">Other Charge</td>
                <td width="60%"><b class="text-uppercase"><?php echo $report_data[0]['otherDetails']; ?></b></td>
            </tr>
            <tr>
                <td width="40%">Total Amount</td>
                <td width="60%"><b class="text-uppercase"><?php echo $report_data[0]['amountTotal']; ?></b></td>
            </tr>
        </tbody>
    </table>
    <!-- <?php echo json_encode($report_data); ?> -->
</body>

</html>