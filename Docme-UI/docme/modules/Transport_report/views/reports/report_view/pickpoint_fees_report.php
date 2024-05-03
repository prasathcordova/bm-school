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
            <tr>
                <th>Pickup Point</th>
                <th>Pickup Location</th>
                <th>Trip</th>
                <th>Start Date </th>
                <th>One Side Fees (&#8377;)</th>
                <th>Two Side Fees (&#8377;)</th>

            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($report_data) && !empty($report_data)) {
                $i = 1;
                foreach ($report_data as $key => $data) { ?>
                    <tr>
                        <td><?php echo $data['pickpointName']; ?></td>
                        <td><?php echo $data['pickuppointLocation']; ?></td>
                        <td><?php echo $data['trips']; ?></td>
                        <td><?php echo ($data['createdOn'] == '') ? 'NA' : date('d-m-Y', strtotime($data['createdOn'])) ?></td>
                        <td align="right"><?php echo my_money_format($data['amtPay']) ?></td>
                        <td align="right"><?php echo my_money_format($data['amtPay_2']) ?></td>

                    </tr>
            <?php   }
            } else {
                echo '<h5>No Report Found</h5>';
            } ?>


        </tbody>
    </table>
</body>

</html>