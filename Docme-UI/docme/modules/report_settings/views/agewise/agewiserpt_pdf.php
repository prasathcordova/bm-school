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
       // $cls = 0;        

        if (isset($details_data) && !empty($details_data)) {
            usort($details_data, function ($item1, $item2) {
                return $item1['Batch'] <=> $item2['Batch'];
            });
            foreach ($details_data as $row) {
                $acd = $row['Description'];
                if($cls == '1000'){
                    $class = 'ALL';
                }else{
                    $class =$row['Class'];
                }
                $date = date("d-m-Y");
                $age = $row['Age'];
            }
            echo '  <tr class="header"><td colspan="2" class="col2" style="text-align:left;" >&nbsp;Academic Year :  ' . $acd . ' &nbsp;</td>'
                . '<td class="col5" style="text-align:right;">Date :  ' . $date . '&nbsp; </td></tr>';
           
        } ?>
        <thead>
            <tr class="header">
            <font weight="bold" font-size="60px">
                    <td class="col1" style="width:5%;">
                            <h3>Sl.No</h3>
                    </td>
                    <td class="col2" style="width:25%;">
                            <h3>Admission No.</h3>
                    </td>
                    <td class="col3">
                            <h3>Name</h3>
                    </td>                
            </tr>
            <!--<hr>-->
        </thead>
        <tbody>

            <?php
            $prev_val = "";
            $sino = 1;
            if (isset($details_data) && !empty($details_data)) {
                echo '  <tr  class="header" bgcolor="#FFFFFF">'
                . '<td colspan="3"  style="font-size:13px"  bgcolor="#FFFFFF"> Age : ' . $age . ' &nbsp;</td>></tr>';
                foreach ($details_data as $row) {
                    if ($prev_val == $row['Batch']) { ?>

                        <tr class="bodyarea">
                            <td class="col1" style="text-align:center;"><?php echo $sino; ?></td>
                            <td class="col2" style="text-align:center;"><?php echo $row['admn_no']; ?></td>
                            <td class="col3" style="text-align:left;"><?php echo $row['student_name']; ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr class="header">
                            <td colspan="2" style="text-align:left;">
                                <h4>
                                    &nbsp;Class : <?php echo $row['Class']; ?>
                                </h4>

                            </td>
                            <td colspan="1" style="text-align:left;">
                                <h4>
                                    &nbsp;Batch : <?php echo $row['Batch']; ?></h4>
                            </td>
                        </tr>
                        <tr class="bodyarea">
                            <td class="col1" style="text-align:center;"><?php echo $sino; ?></td>
                            <td class="col2" style="text-align:center;"><?php echo $row['admn_no']; ?></td>
                            <td class="col3" style="text-align:left;"><?php echo $row['student_name']; ?></td>
                        </tr>

                <?php
                            $prev_val = $row['Batch'];
                        }
                        $sino++;
                    }
                } else {  ?>
                <tr class="bodyarea">
                    <td colspan="3" align="center"> No Data Available </td>
                </tr>
            <?php  }
            ?>
        </tbody>
    </table>
</body>

</html>