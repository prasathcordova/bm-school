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
        <thead>
            <tr class="header">
                <td class="col1" align="center">
                    <h3>SlNo</h3>
                </td>
                <td class="col2" align="center">
                    <h3>Vehicle Num</h3>
                </td>
                <td class="col3" align="center">
                    <h3>Fuel Type</h3>
                </td>
                <td class="col3" align="center">
                    <h3>Fuel Date</h3>
                </td>
                <td class="col3" align="center">
                    <h3>Fuel Price (&#8377;)<br />(Per Litre)</h3>
                </td>
                <td class="col3" align="center">
                    <h3>Fuel Quantity<br />(Litres)</h3>
                </td>


                <!--<td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Discount</h3></td>-->
                <!--<td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Total</h3></td>-->
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($report_data) && !empty($report_data)) {
                $i = 1;
                $fuelPriceTot = 0;
                $fuelQtyTot = 0;
                foreach ($report_data as $vehicle_log) {
                    $newDate = date("d-m-Y", strtotime($vehicle_log['fuelDate']));
            ?>
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td align="left"><?php echo $vehicle_log['vehicleNum']; ?></td>
                        <td align="center"><?php echo $vehicle_log['fuelType']; ?></td>
                        <td align="center"><?php echo $newDate; ?></td>
                        <td align="right"><?php echo my_money_format($vehicle_log['fuelPrice']); ?></td>
                        <td align="right"><?php echo my_money_format($vehicle_log['fuelQty']); ?></td>

                    </tr>
                <?php
                    $i++;
                    $fuelQtyTot += $vehicle_log['fuelQty'];
                    //$fuelPriceTot += $vehicle_log['fuelPrice'];
                } ?>
                <tr>
                    <td colspan="5" align="center">
                        <h3>Total </h3>
                    </td>
                    <!-- <td align="right">
                        <h3><?php //echo my_money_format($fuelPriceTot); 
                            ?>
                    </td> -->
                    <td align="right">
                        <h3><?php echo my_money_format($fuelQtyTot); ?>
                    </td>

                </tr>
            <?php  } else {
                echo '<h5>No Report Found</h5>';
            } ?>


        </tbody>
    </table>
</body>

</html>