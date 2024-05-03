<html>
<?php
$total = 0;
$total_la = 0;
$sino = 1;
$gTotal = 0;
$gTotal_la = 0;
$isFirst = TRUE;
?>

<head>


    <style>
        /* tr:nth-child(odd) {
            background-color: #FFFFFF;
        }

        tr:nth-child(even) {
            background-color: #f0f3f7;
        }

        /* .table2 {
            font-size: 14px;
            font-weight: bold;
            font-color: #E91E63;
        } */

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
            width: 30%;
        }

        table.table2 td.col3 {
            text-align: right;
            width: 15%;
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
            border-top: 0.1px solid #4CAF50;
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

        body {
            font-family: 'Times New Roman';
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
    <?php
    echo $this->load->view('report/header');
    ?>
    <table class="table table-bordered" width="100%">
        <thead>
            <?php
            if (isset($details_data) && !empty($details_data)) {
                //                     dev_export($details_data);die;
                foreach ($details_data as $row) {
                    $acd = $row['Description'];
                    $date = date("d-m-Y");
                }
                echo '  <tr class="header">
                        <td colspan="2" style="width:60%;text-align:left" >&nbsp;Academic Year :   ' . $acd . ' </td>'
                    . '<td colspan="3" style="text-align:right;">Date : ' . $date . '&nbsp; </td>
                    </tr>';
            } ?>
            <tr class="header bodyarea">
                <td style="width:5%;">Sl.No</td>
                <td style="width:55%;">Batch</td>
                <td>Active Strength</td>
                <td>Long Absentees</td>
                <td>Total Strength</td>
            </tr>
            <!--<hr>-->
        </thead>
        <tbody>
            <?php
            $classid = "";
            $sino = 1;
            if (isset($details_data) && !empty($details_data)) {
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
                $nbatch_la = 0;
                $counter = 0;
                if (isset($arr['NotBatch']) && !empty($arr['NotBatch'])) {
                    foreach ($arr['NotBatch'] as $row) {
                        $nbatch += $row['Strength'];
                        $nbatch_la += $row['long_abs_count'];
                        if ($counter == count($arr['NotBatch']) - 1) {
            ?>
                            <tr class="bodyarea">
                                <td style="width:5%;"><?php echo $sino; ?>.</td>
                                <td style="width:55%;"><?php echo $row['Batch']; ?></td>
                                <td style="text-align:center"><?php echo $nbatch - $nbatch_la; ?></td>
                                <td style="text-align:center"><?php echo $nbatch_la; ?></td>
                                <td style="text-align:center"><?php echo $nbatch; ?></td>
                            </tr>
                            <tr class="header bodyarea">
                                <td> </td>
                                <td>Total </td>
                                <td style="text-align:center">
                                    <div>
                                        <h5><?php echo $nbatch - $nbatch_la; ?></h5>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <div>
                                        <h5><?php echo $nbatch_la; ?></h5>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <div>
                                        <h5><?php echo $nbatch; ?></h5>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $gTotal += $nbatch;
                            $gTotal_la += $nbatch_la;
                            $sino++;
                        }
                        $counter++;
                    }
                }

                foreach ($arr['Batch'] as $row) {
                    if ($classid != $row['Class']) {
                        if ($isFirst) {
                            $isFirst = FALSE;
                        } else { ?>
                            <tr class="bodyarea">
                                <td> </td>
                                <td>Total </td>
                                <td style="text-align:center">
                                    <div>
                                        <h5><?php echo $total - $total_la; ?></h5>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <div>
                                        <h5><?php echo $total_la; ?></h5>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                    <div>
                                        <h5><?php echo $total; ?></h5>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                        $classid = $row['Class'];
                        $gTotal += $total;
                        $gTotal_la += $total_la;
                        $total = 0;
                        $total_la = 0;
                        ?>
                        <tr class="header bodyarea">
                            <td colspan="5" style="text-align:left">
                                <h4>&nbsp;Class : <?php echo $row['Class']; ?></h4>
                            </td>
                        </tr>
                    <?php
                    }
                    $total += $row['Strength'];
                    $total_la += $row['long_abs_count'];
                    ?>
                    <tr class="bodyarea">
                        <td style="width:5%;"><?php echo $sino; ?>.</td>
                        <td style="width:55%;"><?php echo $row['Batch']; ?></td>
                        <td style="text-align:center"><?php echo $row['Strength'] - $row['long_abs_count']; ?></td>
                        <td style="text-align:center"><?php echo $row['long_abs_count']; ?></td>
                        <td style="text-align:center"><?php echo $row['Strength']; ?></td>
                    </tr>
                <?php
                    $sino++;
                } ?>
                <tr class="bodyarea">
                    <td> </td>
                    <td>Total </td>
                    <td style="text-align:center">
                        <div>
                            <h5><?php echo $total - $total_la; ?></h5>
                        </div>
                    </td>
                    <td style="text-align:center">
                        <div>
                            <h5><?php echo $total_la; ?></h5>
                        </div>
                    </td>
                    <td style="text-align:center">
                        <div>
                            <h5><?php echo $total; ?></h5>
                        </div>
                    </td>
                </tr>
                <tr class="bodyarea">
                    <td> </td>
                    <td style="font-size:13px">
                        <div>
                            <h5>Grand Total</h5>
                        </div>
                    </td>
                    <td style="font-size:13px">
                        <div>
                            <h5><?php echo ($gTotal + $total) - ($gTotal_la + $total_la); ?></h5>
                        </div>
                    </td>
                    <td style="font-size:13px">
                        <div>
                            <h5><?php echo ($gTotal_la + $total_la); ?></h5>
                        </div>
                    </td>
                    <td style="font-size:13px">
                        <div>
                            <h5><?php echo ($gTotal + $total); ?></h5>
                        </div>
                    </td>
                </tr>



            <?php   } else {  ?>
                <tr class="bodyarea">
                    <td colspan="5" style="text-align:center"> No Data Available </td>
                </tr>
            <?php  }
            ?>
        </tbody>
    </table>

</body>

</html>