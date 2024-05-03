<html>

<head>

    <style>
        /*tr:nth-child(odd)		
            { background-color:#FFFFFF; }
            tr:nth-child(even)		
            { background-color:#e8f6f3; }*/
        table2 {
            font-size: 14px;
            font-weight: bold;
            font-color: #E91E63;
        }

        table2.table-bordered {
            border: 1px solid #b1b1b1;
        }

        tr {

            font-weight: bold;
            height: 15px;
            vertical-align: middle;
        }

        tr.header>td {
            font-weight: bold;
            color: #4CAF50;
            height: 15px;
        }

        table.table2 td.col2 {
            text-align: left;
            width: 25%;
        }

        table.table2 td.col3 {
            text-align: right;
            width: 25%;
        }

        table.table2 td.col4 {
            text-align: right;
            width: 25%;
        }

        table.table2 td.col1 {
            width: 15%;
            text-align: left;
        }

        table.table2 td.col5 {
            width: 25%;
            text-align: right;
        }

        table.table2 td.colU {
            border-top: 0.1px solid #0000;
        }

        .table-bordered tr.bodyarea td {
            vertical-align: middle;
            text-align: center;
            padding: 7px 0 7px 3px;
            font-size: 10px;
        }

        p.line {
            font-size: 2px;
            font-weight: normal;
        }

        h4 {
            text-align: center;
        }

        @page {
            size: auto;
            margin: 5mm;
            margin-top: 40mm;
            odd-header-name: html_myHeader1;
            even-header-name: html_myHeader1;
            odd-footer-name: html_myFooter1;
            even-footer-name: html_myFooter1;
        }
    </style>
</head>

<body>
    <?php echo $this->load->view('report/header') ?>
    <br>
    <?php
    if (isset($details_data) && !empty($details_data)) {
        foreach ($details_data as $row) {
            $acd = $row['Description'];
            $date = date("d-m-Y");
        }
    }
    ?>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td colspan="2" style="text-align:left">&nbsp;Academic Year:<?php echo $acd ?></td>
                <td colspan="5" class="col5" style="text-align:right;">Date : <?php echo $date  ?></td>
            </tr>
            <tr class="header">
                <td style="width:5%;">Sl.No</td>
                <td style="width:30%;">Class</td>
                <td style="width:10%;">Male</td>
                <td style="width:10%;">Female</td>
                <td style="width:12%;">Active Strength</td>
                <td style="width:12%;">Long Absentee</td>
                <td style="width:12%;">Total Strength</td>
            </tr>
            <!-- <tr class="header" style="background-color:#f0f3f7">
            <font weight="bold" font-size="60px">
            <td class="col1" style="width:5%;"><h>Sl.No.</h3></td>
            <td class="col2"><h3>Class</h3></td>
            <td class="col3"><h3>Male</h3></td>
            <td class="col4"><h3>Female</h3></td>
            <td class="col5" ><h3>Strength</h3></td>
        </tr> -->
        </thead>
        <tbody>
            <?php
            //                    dev_export($details_data);die;
            if (isset($details_data) && !empty($details_data)) {
                $sepr = 0;
                $boys_total = 0;
                $girls_total = 0;
                $total_student = 0;
                $total_la = 0;
                $counter = 0;
                $grand_total = 0;
                $sino = 1;
                foreach ($details_data as $rptdata) {
                    if ($sepr != $rptdata['Class_ID']) {
            ?>
                        <tr class="bodyarea">
                            <td style="text-align: center"><?php echo $sino; ?></td>
                            <td style="text-align: center;font-size:11px">&nbsp;<?php echo $rptdata['Class'] ?></td>
                            <td style="text-align: center"><?php echo $rptdata['male'] ?></td>
                            <td style="text-align: center"><?php echo $rptdata['female'] ?></td>
                            <td style="text-align: center"><?php echo ($rptdata['male'] + $rptdata['female']) - $rptdata['long_absentee'] ?></td>
                            <td style="text-align: center"><?php echo $rptdata['long_absentee'] ?></td>
                            <td style="text-align: center; font-weight: bold;"><?php echo $rptdata['male'] + $rptdata['female']; ?></td>
                        </tr>
                        <?php
                        $boys_total +=  $rptdata['male'];
                        $girls_total +=  $rptdata['female'];
                        $total_student = $boys_total + $girls_total;
                        $total_la += $rptdata['long_absentee'];
                        $grand_total += $rptdata['male'] + $rptdata['female'];

                        $sepr = $rptdata['Class_ID'];
                        //$grand_total += $total_student;
                        if ($counter == count($details_data) - 1) {
                        ?>
                            <!--                        <tr>
                            <td colspan="2">Class Total</td>
                            <td colspan="2" style="text-align: right; font-weight: bold;"><?php echo $total_student; ?></td>
                        </tr>-->
                        <?php
                        }
                    } else {
                        ?>

                        <?php
                        $boys_total +=  $rptdata['male'];
                        $girls_total +=  $rptdata['female'];
                        $total_student = $rptdata['male'] + $rptdata['female'];
                        $grand_total += $rptdata['male'] + $rptdata['female'];
                        $total_la += $rptdata['long_absentee'];
                        $sepr = $rptdata['Class_ID'];
                        //$grand_total += $total_student;
                        ?>
                        <tr class="bodyarea">>
                            <td style="text-align: center"><?php echo $sino; ?></td>
                            <td style="text-align: center; font-size:11px">&nbsp;<?php echo $rptdata['Class'] ?></td>
                            <td style="text-align: center"><?php echo  $rptdata['male']; ?></td>
                            <td style="text-align: center"><?php echo $rptdata['female']; ?></td>
                            <td style="text-align: center"><?php echo ($rptdata['male'] + $rptdata['female']) - $rptdata['long_absentee'] ?></td>
                            <td style="text-align: center"><?php echo $rptdata['long_absentee'] ?></td>
                            <td style="text-align: center; font-weight: bold;"><?php echo $total_student; ?></td>
                        </tr>
                <?php

                    }
                    $sino++;
                } ?>
                <tr class="header bodyarea">
                    <td colspan="2" style="text-align: right;font-size:12px"> Grand Total &nbsp; </td>
                    <td><?php echo $boys_total ?></td>
                    <td><?php echo $girls_total ?></td>
                    <td><?php echo $grand_total - $total_la ?></td>
                    <td><?php echo $total_la ?></td>
                    <td class="col5 colU">
                        <div>
                            <h3> <?php echo $grand_total; ?></h3>
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