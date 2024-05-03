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
                $acd = $row['Acd_year'];
            }
            echo ' <tr class="header"><td colspan="3" style="text-align:left;" >&nbsp;Academic Year :    ' . $acd . ' </td>'
                . '<td colspan="3" style="text-align:right;">Date :    ' . date("d-m-Y") . ' &nbsp;</td></tr>';
        } ?>
        <tr class="header">
            <td width="5%">Sl.No.</td>
            <td width="20%">Admission No.</td>
            <td width="35%">Name</td>
            <td width="20%">Class</td>
            <td width="10%">Division</td>
            <td width="10%">Priority</td>
        </tr>
        <?php if (isset($details_data) && !empty($details_data)) {
            $parentID = '';
            $index = 1;
            foreach ($details_data as $data) {
                if ($parentID != $data['Parent_ID']) {
                    ?>
                    <tr class="bodyarea">
                        <td colspan="6" class="t-left">
                            <h4>Father's Name: &nbsp;&nbsp; <?php echo strtoupper($data['Father']); ?></h4>
                        </td>
                    </tr>
                <?php
                            $parentID = $data['Parent_ID'];
                        }
                        ?>
                <tr class="bodyarea">
                    <td><?php echo $index; ?></td>
                    <td><?php echo $data['Admn_No']; ?></td>
                    <td class="t-left"><?php echo $data['student_name']; ?></td>
                    <td><?php echo $data['Description']; ?></td>
                    <td><?php echo isset($data['Division']) && !empty($data['Division']) ? $data['Division'] : 'NIL'; ?></td>
                    <td><?php echo $data['Priority']; ?></td>
                </tr>
            <?php
                    $index++;
                }
                ?>

        <?php   } else {  ?>
            <tr>
                <td colspan="3" align="center"> No Data Available </td>
            </tr>
        <?php  }
        ?>
    </table>

</body>

</html>