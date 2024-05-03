<html>
<?php
$total = 0;
$sino = 1;
$gTotal = 0;
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
        <?php
        $sino = 1;
        if (isset($details_data) && !empty($details_data)) {
            //  dev_export($details_data);die;
            foreach ($details_data as $row) {
                $acd = $row['academic_year'];
                $date = date("d-m-Y");
            }
            echo '  <tr class="header"><td style="text-align:left;width:60%;border-right:none">&nbsp;Academic Year : ' . $acd . '&nbsp; </td>'
                . '<td  style="text-align:right;width:40%;border-left:none">Date : ' . $date . '&nbsp; </td></tr>';
        } ?>
    </table>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header bodyarea">
                <td style="width:5%;">Sl.No</td>
                <td style="width:10%;">Academic Year</td>
                <td style="width:15%;">Class </td>
                <td style="width:30%;">Batch Name</td>
                <td style="width:10%;">Strength</td>
                <td style="width:10%;">Boys</td>
                <td style="width:10%;">Girls</td>
                <td style="width:10%;">Status</td>
            </tr>
            <!--<hr>-->
        </thead>
    </table>
    <table class="table table-bordered" width="100%">
        <thead>
        </thead>
        <tbody>
            <?php
            if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                //  dev_export($class_data).'</pre>';
                foreach ($details_data as $class) {
            ?>
                    <tr class="bodyarea">
                        <td style="width:5%;"> <?php echo $sino; ?></td>
                        <td style="width:10%;"> <?php echo $class['academic_year']; ?></td>
                        <td style="width:15%;"> <?php echo $class['Class']; ?></td>
                        <td style="width:30%;"> <?php echo $class['Batch_Name']; ?></td>
                        <td style="width:10%;"> <?php echo $class['strength']; ?></td>
                        <td style="width:10%;"> <?php echo $class['Boys']; ?></td>
                        <td style="width:10%;"> <?php echo $class['Girls']; ?></td>
                        <td style="width:10%;"> <?php if ($class['isactive'] == 1) echo 'Active';
                                                else echo 'In-Active'; ?></td>
                    </tr>
            <?php
                    $sino++;
                }
            }
            ?>
        </tbody>
    </table>

</body>

</html>