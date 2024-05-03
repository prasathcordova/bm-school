<html>

<head>

    <!-- <title style="color:hotpink"><?php echo $title; ?></title> -->
</head>


<body style="background: #fff !important;">

    <?php
    echo $this->load->view('reports/report_view/header');
    ?>

    <table class="table table-bordered" width="100%" cellpadding="5">
        <thead>
            <tr class="header">
                <td class="col1" align="center">
                    <h3>SlNo</h3>
                </td>
                <td class="col2" align="center">
                    <h3>Trip Name</h3>
                </td>
                <td class="col3" align="center">
                    <h3>Pickup Time Range</h3>
                </td>
                <td class="col4" align="center">
                    <h3>Drop Time Range</h3>
                </td>
                <!--<td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Discount</h3></td>-->
                <!--<td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Total</h3></td>-->
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($report_data) && !empty($report_data)) {
                $i = 1;
                foreach ($report_data as $trip) {
            ?>
                    <!-- <tr><td  align="left"  ><?php echo $trip['tripName']; ?></td></tr> -->
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td align="center"><?php echo $trip['tripName']; ?></td>
                        <td align="center"><?php echo date('h:i A',  strtotime($trip['pickStartTime'])); ?> - <?php echo date('h:i A',  strtotime($trip['pickEndTime'])); ?></td>
                        <td align="center"><?php echo date('h:i A',  strtotime($trip['dropStartTime'])); ?> - <?php echo date('h:i A',  strtotime($trip['dropEndTime'])); ?></td>
                    </tr>
            <?php
                    $i++;
                }
            } else {
                echo '<h5>No Report Found</h5>';
            } ?>

        </tbody>
    </table>
</body>

</html>