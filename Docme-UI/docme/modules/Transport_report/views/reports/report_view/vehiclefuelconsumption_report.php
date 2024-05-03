<html>

<head>

</head>


<body>
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
                <td align="center">
                    <h3>SlNo</h3>
                </td>
                <td align="center">
                    <h3>Vehicle Num</h3>
                </td>
                <td align="center">
                    <h3>Fuel Type</h3>
                </td>
                <td align="center">
                    <h3>Distance<br />Covered(Kms)</h3>
                </td>
                <td align="center">
                    <h3>Fuel Quantity<br />(in litres)</h3>
                </td>
                <td align="center">
                    <h3>Amount(&#8377;)</h3>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($report_data) && !empty($report_data)) {
                $i = 1;
                $totkm = 0;
                $totqty = 0;
                $totprice = 0;
                foreach ($report_data as $vehicle_log) {
            ?>
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td align="center"><?php echo $vehicle_log['vehicleNum']; ?></td>
                        <td align="center"><?php echo $vehicle_log['fuelTypeName']; ?></td>
                        <td align="right"><?php echo my_money_format($vehicle_log['fuelFillKilometer']); ?></td>
                        <td align="right"><?php echo my_money_format($vehicle_log['fuelquantity']); ?></td>
                        <td align="right"><?php echo my_money_format($vehicle_log['fuelprice']); ?></td>
                    </tr>
                <?php
                    $i++;
                    $totkm +=  $vehicle_log['fuelFillKilometer'];
                    $totqty +=  $vehicle_log['fuelquantity'];
                    $totprice  += $vehicle_log['fuelprice'];
                } ?>
                <tr>
                    <td colspan="4" align="center">
                        <h3>Total(&#8377;)</h3>
                    </td>
                    <!-- <td align="right">
                    <h3><?php echo  my_money_format($totkm); ?>
                </td> -->
                    <td align="right">
                        <h3><?php echo  my_money_format($totqty); ?>
                    </td>
                    <td align="right">
                        <h3><?php echo  my_money_format($totprice); ?>
                    </td>
                </tr>
            <?php } else {
                echo '<h5>No Report Found</h5>';
            }
            ?>

        </tbody>
    </table>
</body>

</html>