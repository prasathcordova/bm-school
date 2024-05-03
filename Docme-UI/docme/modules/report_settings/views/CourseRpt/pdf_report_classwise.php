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
            //dev_export($details_data);
            //die;
            //foreach ($details_data as $row) {                
            //  $acd = $row['Description'];
            $date = date("d-m-Y");
            // }
            echo '  <tr class="header">'
                . '<td width="50%" style="text-align:left;font-size:11px;border-right:none"><strong>&nbsp;Academic Year : ' . $acd_year . '&nbsp;</strong> </td>.'
                . '<td style="text-align:right;font-size:11px;border-left:none"><strong>Date : ' . $date . '&nbsp; </strong></td></tr>';
        } ?>
    </table>

    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header bodyarea">
                <td style="width:5%;">Sl.No</td>
                <td style="width:25%;">Class Description</td>
                <td style="width:35%;">Class Code</td>
                <td style="width:35%;">Course</td>
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
                //dev_export($class_data).'</pre>';
                foreach ($details_data as $class) {
            ?>
                    <tr class="bodyarea">
                        <td style="width:5%;"> <?php echo $sino; ?></td>
                        <td style="width:25%;"> <?php echo $class['Description']; ?></td>
                        <td style="width:35%;"> <?php echo $class['Course_det_code']; ?></td>
                        <td style="width:35%;"> <?php echo $class['Course_Name']; ?></td>

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