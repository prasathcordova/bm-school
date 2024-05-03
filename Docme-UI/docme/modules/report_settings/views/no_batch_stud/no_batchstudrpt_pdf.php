<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/header') ?>
    <br>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td colspan="2" style="text-align:left">&nbsp;Academic Year : <?php echo $acd_year_id; ?></td>
                <td style="text-align:right"> Date : <?php echo date("d-m-Y"); ?>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($details_data) && !empty($details_data)) {
                $total_student = 0;
                $cc = 0;?>
                <tr class="header" >
                        <td style="width:5%;" >Sl.No</td>
                        <td style="width:35%;">&nbsp;Admission No.</td>
                        <td >&nbsp;Student Name</td>
                    </tr>
                    
               <?php foreach ($details_data as $classname => $rptdata) {
                   
                    ?>
                    <tr class="bodyarea">
                        <td colspan="3" class="t-left" style="font-weight:bold;">Class : <?php echo $classname ?></td>
                    </tr>
                    
                    <?php foreach ($rptdata as $rdata) { ?>
                        <tr class="bodyarea">
                            <td><?php echo ++$cc; ?></td>
                            <td class="t-center"><?php echo $rdata['Admn_No'] ?></td>
                            <td class="t-center"><?php echo $rdata['student_name'] ?></td>
                        </tr>
                <?php
                            $total_student++;
                        }
                    }
                    ?>
                <tr class="header">
                    <td class="col2"> </td>
                    <td class="col3"> </td>
                    <td class="col4 colU">
                        <div>
                            <h3> Total Students : <?php echo $total_student; ?></h3>
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