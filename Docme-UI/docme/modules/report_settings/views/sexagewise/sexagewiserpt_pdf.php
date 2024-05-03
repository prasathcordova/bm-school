<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/header') ?>
    <br>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td colspan="2" style="text-align:left;">&nbsp;Academic Year: <?php echo $acd_year_id; ?></td>
                <td style="text-align:right;"> Date : <?php echo date("d-m-Y"); ?>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php
            //                    dev_export($details_data);die;
            if (isset($details_data) && !empty($details_data)) {
                $sepr = 0;
                $total_student = 0;
                $counter = 0;
                $grand_total = 0;
                foreach ($details_data as $classname => $rptdata) {
                    $boys_total = 0;
                    $girls_total = 0;
                    ?>
                    <tr class="header">
                        <td colspan="3" style="text-align:left;font-size: 11px;">&nbsp;Class : <?php echo $classname ?></td>
                    </tr>
                    <tr class="header bodyarea" >
                        <td style="font-size: 11px;">Age</td>
                        <td style="font-size: 11px;">Male(Count)</td>
                        <td style="font-size: 11px;">Female(Count)</td>
                    </tr>
                    <?php foreach ($rptdata as $rdata) { ?>
                        <tr class="bodyarea">
                            <td><?php echo $rdata['Age'] ?></td>
                            <td style="text-align: center"><?php echo $rdata['male'] ?></td>
                            <td style="text-align: center"><?php echo $rdata['female'] ?></td>
                        </tr>
                    <?php
                                $boys_total += $rdata['male'];
                                $girls_total += $rdata['female'];
                            }
                            $total_student = ($boys_total + $girls_total);
                            $grand_total += $total_student;
                            ?>

                    <tr class="bodyarea">
                        <td style="font-size: 11px;"><b>Total</b></td>
                        <td><b><?php echo $boys_total; ?></b></td>
                        <td><b><?php echo $girls_total; ?></b></td>
                    </tr>
                    <tr class="bodyarea">
                        <td colspan="2" style="font-size: 11px;text-align: center"><b>Class Total&nbsp;</b></td>                       
                        <td style="font-size: 12px;"><b><?php echo $total_student; ?></b></td>
                    </tr>
                <?php
                    }
                    ?>             
                <tr class="header">
                    <td class="col2"> </td>
                    <td class="col3"> </td>
                    <td class="col4 colU">
                        <div>
                            <h3> Grand Total : <?php echo $grand_total; ?></h3>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</body>

</html>