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
            $acd = $row['Description'];
            $date = date("d-m-Y");
        }
        echo '  <tr class="header"><td colspan="3" style="text-align:left;padding:5px 0 5px 5px;">&nbsp;Academic Year : ' . $acd . '&nbsp; </td>'
            . '<td colspan="2" style="text-align:right;padding:5px 0 5px 5px;">&nbsp;Date : ' . $date . '&nbsp; </td></tr>';
    }
        ?>
        <thead>
            <tr class="header">
                <td width="5%">Sl.No.</td>
                <td width="20%">Admission No.</td>
                <td width="25%">Name</td>
                <td width="25%">Batch</td>
                <td width="25%">Promoted Batch</td>
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
                        <td><?php echo $rptdata['Admn_No'] ?></td>
                        <td class="t-center"><?php echo $rptdata['student_name'] ?></td>
                        <td class="t-center"><?php echo $rptdata['FROM_BATCH'] ?></td>
                        <td class="t-center"><?php echo $rptdata['TO_BATCH'] ?></td>
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