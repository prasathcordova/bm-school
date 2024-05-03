<html>

<head>

    <!-- <title style="color:hotpink"><?php echo $title; ?></title> -->
</head>


<body style="background: #fff !important;">

    <?php
    echo $this->load->view('reports/report_view/header');
    ?>

    <table class="table table-bordered" width="100%" cellpadding="4">
        <thead>
            <tr class="header">
                <!-- <td class="col1" align="center">
                <h3>SlNo</h3>
            </td> -->
                <!-- <td class="col1" align="center" width="20%">
                <h3>Trip Name</h3>
            </td> -->
                <td class="col2" align="center">
                    <h3>Pickup Point Name</h3>
                </td>
                <td class="col3" align="center">
                    <h3>Pickup Time</h3>
                </td>
                <td class="col3" align="center">
                    <h3>Drop Time</h3>
                </td>
                <!--<td class="col4" align="center" ><h3>Pickup End Time</h3></td>-->
                <!--<td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Discount</h3></td>-->
                <!--<td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Total</h3></td>-->
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($pickuppoint_data) && !empty($pickuppoint_data)) {
                $i = 1;
                foreach ($pickuppoint_data as $key => $pickup_data) {
                    $k = 1;
            ?>
                    <tr>
                        <td colspan="3" style="font-weight:bold">Trip Name : <?php echo $pickup_data['tripName'] . " <br/> Timings : " . date('h:i A',  strtotime($pickup_data['tripStart'])) . " - " . date('h:i A',  strtotime($pickup_data['tripEnd']))  ?></td>
                    </tr>
                    <!-- <tr><td colspan="3"> Trip Name : <?php //echo $pickup_data['tripName'] . " " . date('h:i A',  strtotime($pickup_data['tripStart'])) . " - " . date('h:i A',  strtotime($pickup_data['tripEnd']))  
                                                            ?></td> </tr> -->
                    <?php foreach ($pickup_data['pickpointName'] as $pickuppoint) { ?>
                        <tr>
                            <!-- <td><?php //echo $i 
                                        ?></td> -->
                            <?php if ($k == 1) { ?>
                                <!-- <td rowspan="<?php echo sizeof($pickup_data['pickpointName']) ?>"> <?php echo $pickup_data['tripName'] . " <br/> " . date('h:i A',  strtotime($pickup_data['tripStart'])) . " - " . date('h:i A',  strtotime($pickup_data['tripEnd']))  ?></td> -->
                            <?php } ?>
                            <td align="left"><?php echo $pickuppoint['pickpointName']; ?></td>
                            <td align="center"><?php echo $pickuppoint['pickuptime'] != '' ? date('h:i A',  strtotime($pickuppoint['pickuptime'])) : 'NA'; ?></td>
                            <td align="center"><?php echo $pickuppoint['pickuptime'] != '' ? date('h:i A',  strtotime($pickuppoint['droptime'])) : 'NA'; ?></td>
                        </tr>
                    <?php
                        $k++;
                        $i++;
                    } ?>
            <?php   }
            } else {
                echo '<h5>No Report Found</h5>';
            } ?>

        </tbody>
    </table>
</body>

</html>