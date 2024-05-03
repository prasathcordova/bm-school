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
            echo '  <tr class="header"><td class="col2" style="width:60%;text-align:left">&nbsp;Academic Year : ' . $acd . ' </td>'
                . '<td class="col5" style="text-align:right;">Date :  ' . $date . '&nbsp;  </td></tr>';
        } ?>
    </table>
        <table class="table table-bordered" width="100%">
        <thead>
            <!--bgcolor="#ABB2B9"-->
            <tr class="header">
                <td style="width:5%;">Sl.No</td>
                <td style="width:55%;">Batch</td>
                <td>Strength</td>
            </tr>

        </thead>
        <?php
        if (isset($details_data) && !empty($details_data)) {
            foreach ($details_data as $row) {
                $Nation = $row['Nationality'];
            }
            echo '  <tr class="header" font-color="#E91E63"><td colspan="3"> <h4>Nationality : &nbsp;   ' . $Nation . ' </h4></td></tr>';
            ?>
            <tbody>
                <?php
                    $classid = "";
                    //                if(isset($details_data) && !empty($details_data)) {

                    $arr = array();
                    foreach ($details_data as $key => $item) {
                        if ($item['BatchID'] == '') {
                            $arr['NotBatch'][$key] = $item;
                        } else {
                            $arr['Batch'][$key] = $item;
                        }
                    }
                    ksort($arr, SORT_NUMERIC);
                    $nbatch = 0;
                    $counter = 0;
                    if (isset($arr['NotBatch'])) {
                        foreach ($arr['NotBatch'] as $row) {
                            $nbatch += $row['Strength'];
                            if ($counter == count($arr['NotBatch']) - 1) {
                                ?>
                            <tr class="bodyarea">
                                <td class="col1"><?php echo $sino; ?>.</td>
                                <td class="col2"><?php echo $row['Batch']; ?></td>
                                <td class="col3"><?php echo $nbatch; ?></td>
                            </tr>
                            <tr class="header">
                                <td class="col1"> </td>
                                <td class="col2"> </td>
                                <td class="col3 colU">
                                    <div>
                                        <h5>Total : <?php echo $nbatch; ?></h5>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                            $gTotal += $nbatch;
                                            $sino++;
                                        }
                                        $counter++;
                                    }
                                }
                                if (isset($arr['Batch'])) {
                                    foreach ($arr['Batch'] as $row) {
                                        if ($classid != $row['Class']) {
                                            if ($isFirst)
                                                $isFirst = FALSE;
                                            else { ?>
                                <tr class="bodyarea">
                                    <td class="col1"> </td>
                                    <td class="col2"> </td>
                                    <td class="col3 colU">
                                        <div font weight="bold" font-color="#e8f6f3">
                                            <h5>Total : <?php echo $total; ?></h5>
                                        </div>
                                    </td>
                                </tr>

                            <?php }
                                            $classid = $row['Class'];
                                            $gTotal += $total;
                                            $total = 0;
                                            ?>
                            <tr class="header">
                                <td colspan="3" style="text-align:left">
                                    <h4>&nbsp;Class : <?php echo $row['Class']; ?></h4>
                                </td>
                            </tr>
                        <?php
                                    }
                                    $total += $row['Strength'];
                                    ?>
                        <tr class="bodyarea">
                            <td class="col1"><?php echo $sino; ?>.</td>
                            <td class="col2"><?php echo $row['Batch']; ?></td>
                            <td class="col3"><?php echo $row['Strength']; ?></td>
                        </tr>
                    <?php $sino++;
                            }
                            ?>

                    <tr class="header">
                        <td class="col1"> </td>
                        <td class="col2"> </td>
                        <td class="col3 colU">
                            <div font-color="#e9f7ef">
                                <h5>Total : <?php echo $total; ?></h5>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="header" font-weight="bold">
                    <td class="col1"> </td>
                    <td class="col2"> </td>
                    <td class="col3 colU">
                        <div font-color="#e9f7ef" style="font-size: 13px">
                            <h5>Grand Total : <?php echo ($gTotal + $total); ?></h5>
                        </div>
                    </td>
                </tr>

            <?php   } else {  ?>
                <tr class="bodyarea">
                    <td colspan="3" align="center"> No Data Available </td>
                </tr>
            <?php  }
            ?>
            </tbody>
    </table>
</body>

</html>