<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/header') ?>
    <br>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td colspan="2" style="text-align:left" class="t-left">&nbsp;Academic Year : <?php echo $acd_year_id; ?></td>
                <td style="text-align:right">&nbsp; Date : <?php echo date("d-m-Y"); ?>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($details_data) && !empty($details_data)) {
                $slno = 0;
                $grand_total =  0;
                foreach ($details_data as $profession => $rptdata) { ?>
                    <tr class="header">
                        <td colspan="3" style="text-align:center" class="t-left">&nbsp;Profession: <?php echo $profession; ?></td>
                    </tr>
                    <tr class="header">
                            <td style="width:5%;">Sl.No</td>
                            <td style="width:55%;">Batch</td>
                            <td>Strength</td>
                        </tr>
                    <?php
                            foreach ($rptdata as $classname => $rdata) {
                                ?>
                        <tr class="header">
                            <td colspan="3" style="text-align:left" class="t-left">Class: <?php echo $classname; ?></td>
                        </tr>
                        
                        <?php
                                    foreach ($rdata as $rdetails) {
                                        ?>
                            <tr class="bodyarea">
                                <td><?php echo ++$slno; ?></td>
                                <td><?php echo $rdetails['Batch'] ?></td>
                                <td><?php echo $rdetails['Strength'] ?></td>
                            </tr>
                <?php
                                $grand_total += $rdetails['Strength'];
                            }
                        }
                    } ?>               
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