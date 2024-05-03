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

    <table class="table table-bordered" width="100%" cellpadding="6">
        <thead>
            <tr class="header">
                <th>Vehicle Number</th>
                <th>Trip Name</th>
                <th>Pickup Point</th>
                <th>Incident Place</th>
                <th>Action Taken</th>
                <th>Incident Time</th>
                <th>Penalty Amount &#8377</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($report_data) && !empty($report_data)) {
                $i = 1;
                $incidentDate = '';
                foreach ($report_data as $key => $rpt_data) {
                    if ($incidentDate != $rpt_data['incidentDate']) { ?>
                        <tr>
                            <td colspan="7" style="font-weight: bold">Incident Date : <?php echo date('d-m-Y', strtotime($rpt_data['incidentDate'])); ?></td>
                        </tr>
                    <?php
                        $incidentDate = $rpt_data['incidentDate'];
                    } ?>
                    <tr>
                        <td align="center"><?php echo $rpt_data['vehicleNum']; ?></td>
                        <td align="center"><?php echo $rpt_data['tripId']; ?></td>
                        <td align="center"><?php echo $rpt_data['lastPickupFromIncident']; ?></td>
                        <td align="center"><?php echo $rpt_data['placeOfIncident']; ?></td>
                        <td align="center"><?php echo $rpt_data['actionTaken']; ?></td>
                        <td align="center"><?php echo date('h: i A', strtotime($rpt_data['incidentTime'])); ?></td>
                        <td align="right"><?php echo $rpt_data['penaltyAmount']; ?></td>
                    </tr>

            <?php       }
            } ?>
        </tbody>
    </table>

</body>

</html>