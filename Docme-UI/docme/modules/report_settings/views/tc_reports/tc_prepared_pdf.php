<html>
<?php
$total = 0;
$sino = 1;
$gTotal = 0;
$isFirst = TRUE;
?>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/header') ?>
    <br>
    <table class="table table-bordered" width="100%">
        <?php
        if (isset($details_data) && !empty($details_data)) {
            foreach ($details_data as $row) {
                $acd = $row['acdyr'];
                $date = date("d-m-Y");
            }
            echo '  <tr class="header"><td class="col2" colspan="4" style="text-align:left;">&nbsp;Academic Year : ' . $acd . ' </td>'
                . '<td class="col5" colspan="4" style="text-align:right;">Date : ' . $date . '&nbsp; </td></tr>';
        } ?>
        <thead>
            <tr class="header">
                <td width="5%">Sl.No.</td>
                <td width="10%">Class</td>
                <td width="25%">Batch</td>
                <td width="10%">Admission No.</td>
                <td width="20%">Student Name</td>
                <td width="8%">Applied Date</td>
                <td width="15%">Reason for leaving</td>
                <td width="8%">Status</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $rptdata) {
            ?>
                    <tr class="bodyarea">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rptdata['class_name'] ?></td>
                        <td class="t-center"><?php echo $rptdata['batch_name'] ?></td>
                        <td><?php echo $rptdata['Admn_No'] ?></td>
                        <td class="t-center"><?php echo $rptdata['student_name'] ?></td>
                        <td><?php echo date('d-m-Y', strtotime($rptdata['applied_date'])) ?></td>
                        <td class="t-center"><?php echo $rptdata['reason_for_leaveving'] ?></td>
                        <td><?php echo $rptdata['app_status'] ?></td>
                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>

</body>

</html>