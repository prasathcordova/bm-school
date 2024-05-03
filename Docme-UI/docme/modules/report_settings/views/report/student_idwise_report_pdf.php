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
        <thead>
            <tr class="bodyarea">
                <td colspan="6" class="t-left">
                    <h4>Academic Year : <?php echo $acd_year_id; ?></h4>
                </td>
                <td colspan="3" class="t-right"><strong> Date : <?php echo date("d-m-Y"); ?> </strong> &nbsp;</td>
            </tr>
            <tr class="header">
                <td width="5%">Sl.No</td>
                <td width="8%">Admission No</td>
                <td width="12%" style="text-align:left;">&nbsp;Student Name</td>
                <!-- <td width="5%" style="text-align:left;">&nbsp;Class</td>
                            <td width="10%" style="text-align:left;">&nbsp;Batch</td> -->
                <td width="15%" style="text-align:left;">&nbsp;Pickup Details</td>
                <td width="15%" style="text-align:left;">&nbsp;Drop Details</td>
                <!-- <td width="10%" style="text-align:left;">&nbsp;Pick/Drop Point</td> -->
                <td width="18%" style="text-align:left;">&nbsp;Address</td>
                <td width="15%" style="text-align:left;">&nbsp;Parent name</td>
                <td width="12%">Contact No</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($details_data) && !empty($details_data)) {
                $sno = 0;
                $grand_total = 0;
                foreach ($details_data as $classname => $classdetails) {
            ?>
                    <tr class="bodyarea">
                        <td colspan="9" class="t-left">
                            <h4>Class : <?php echo $classname; ?></h4>
                        </td>
                    </tr>
                    <?php
                    $class_total = 0;
                    foreach ($classdetails as $batchname => $batchdetails) {
                    ?>
                        <tr class="bodyarea">
                            <td colspan="9" class="t-left"><b> Batch : <?php echo $batchname; ?></b></td>
                        </tr>

                        <?php $batch_total = 0;
                        foreach ($batchdetails as $bdetails) {
                        ?>
                            <tr class="bodyarea">
                                <td><?php echo ++$sno; ?></td>
                                <td><?php echo $bdetails['Admn_no']; ?></td>
                                <td class="t-left"><?php echo $bdetails['student_name']; ?></td>
                                <!-- <td class="t-left"><?php echo $bdetails['Class']; ?></td>
                                <td class="t-left"><?php echo $bdetails['Batch']; ?></td> -->
                                <td class="t-left">
                                    Pickup Point -<?php echo $bdetails['pickpoint'] == '' ? 'NA' : $bdetails['pickpoint']; ?><br />
                                    Trip - <?php echo $bdetails['tripNumber'] == '' ? 'NA' : $bdetails['tripNumber']; ?><br />
                                    Bus No - <?php echo $bdetails['busNumber'] == '' ? 'NA' : $bdetails['busNumber']; ?>
                                </td>
                                <td class="t-left">
                                    Drop Point -<?php echo $bdetails['droppoint'] == '' ? 'NA' : $bdetails['droppoint']; ?><br />
                                    Trip- <?php echo $bdetails['drop_tripNumber'] == '' ? 'NA' : $bdetails['drop_tripNumber']; ?><br />
                                    Bus No - <?php echo $bdetails['drop_busNumber'] == '' ? 'NA' : $bdetails['drop_busNumber']; ?>
                                </td>
                                <td class="t-left"><?php echo $bdetails['Address']; ?></td>
                                <td class="t-left"><?php echo $bdetails['Parent_Name']; ?></td>
                                <td><?php echo $bdetails['Phone']; ?></td>
                            </tr>
                        <?php
                            $batch_total++;
                            $class_total++;
                            $grand_total++;
                        }
                        ?>
                        <tr class="bodyarea">
                            <td colspan="9" class="t-right">
                                <h4>Batch Total : <?php echo $batch_total; ?>&nbsp;</h4>
                            </td>
                        </tr>
                    <?php

                    }
                    ?>
                    <tr class="bodyarea">
                        <td colspan="9" class="t-right">
                            <h3>Class Total : <?php echo $class_total; ?>&nbsp;</h3>
                        </td>
                    </tr>
                <?php
                } ?>
                <tr class="bodyarea">
                    <td colspan="9" class="t-right">
                        <h2>Grand Total : <?php echo $grand_total; ?>&nbsp;</h2>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</body>

</html>