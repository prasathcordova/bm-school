

<html> 
    <head>
        <style>   
            tr:nth-child(odd)		
            /*{ background-color:#FFFFFF; }*/
            tr:nth-child(even)		
            /*{ background-color:#f3f3f3; }*/
            table2{
                font-size: 15px;
                font-weight: bold;
                font-color: #2d4154;
            }
            tr{

                font-weight: bold;
                height: 15px;
                vertical-align: middle;
                border-bottom: 1px;border-bottom-color: black; 
                border-top: 0px; 
                border-left: 0px; 
                border-right: 0px;
            }
            tr.header > td 
            {
                font-weight: bold;
                color: #2d4154;
                background-color: #2d4154;
                height: 18px;
                /*vertical-align: middle;*/
                font-family: Tahoma;
            }
            /*            table.tableH
                        {
                            border-top: 1px solid #641E16;
                            border-bottom: 1px solid #641E16;
                        }*/
            table.table2 td.col1
            {
                /*width:20%;*/
                text-align: left;
            }
            table.table2 td.col2
            {
                /*width:40%;*/
                text-align: left
            }
            table.table2 td.col3
            {
                /*width:40%;*/
                text-align: right;        
            }
            table.table2 td.colU
            {
                border-top: 0.1px solid #4CAF50;
            }

            p.line
            {
                font-size: 2px;
                font-weight: normal;
            }
            h4 {
                text-align: center;
            }

        </style>
        <title><?php echo $title; ?></title>
    </head>


    <body>
        <p style="font-family:Tahoma;font-size: 12px;">Date Range &nbsp;: <?php echo date('d-m-Y', strtotime($startdate)) ?> to <?php echo date('d-m-Y', strtotime($enddate)) ?> <br/>
            Report Type &nbsp;: <?php echo $title; ?> <br/>        
        </p>

        <table  class="table2 tableH" cellpadding="1"  style="font-family:Tahoma;" style="font-size: 15px; margin-top: 10px;width:100%;" >
            <thead>
                <tr class="header">
                    <td class="col1" bgcolor="#2D4154"  align="center" style="font-family:Tahoma "><font color="#FCFEFC" ><h3>SlNo</h3></td>
                    <td class="col2" bgcolor="#2D4154" align="center" style="font-family:Tahoma"><font color="#FCFEFC" ><h3>Item Name</h3></td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Edition</h3></td>
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Billed Qty</h3></td>                    
                    <td class="col3" bgcolor="#2D4154" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Pending Qty</h3></td>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $report_total_quantity = 0;
                $report_total_pending = 0;
                $report_total_tax = 0;
                $i = 1;
//                dev_export($report_data);die;
                if (isset($report_data) && !empty($report_data)) {
                    foreach ($report_data as $key => $data) {
                        $total_quantity = 0;
                        $total_pending = 0;
                        $total_tax = 0;
                        ?>
                        <tr>
                            <td colspan="5"  style="padding-top:15px;font-family:Tahoma ;font-weight: bold;border-bottom: 1px solid #ccc; "><?php echo $key; ?></td>
                        </tr>

                        <?php
                        if (isset($data) && !empty($data)) {
//                            dev_export($data);die;
                            foreach ($data as $items) {
                                ?>
                                <tr>
                                    <td   align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $i; ?></td>
                                    <td   align="left"  style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['item_name']; ?></td>
                                    <td   align="center"  style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['edition_name']; ?></td>                                 
                                    <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['billed_qty']; ?></td>
                                    <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $items['billed_not_delivered_qty']; ?></td>
                                    
                                </tr>
                                <?php
                                $i++;
                                $total_quantity = $total_quantity + $items['billed_qty'];
                                $total_pending = $total_pending + $items['billed_not_delivered_qty'];                                

                                $report_total_quantity = $report_total_quantity + $items['billed_qty'];
                                $report_total_pending = $report_total_pending + $items['billed_not_delivered_qty'];
                                
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Sub Total( Billed Qty ) : </td>
                            <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo $total_quantity; ?></td>                            
                        </tr>
                        <tr>
                            <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; ">Sub Total( Pending Qty ) : </td>                            
                            <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo $total_pending; ?></td>
                        </tr>
                    <?php }
                    ?>
                    <tr>
                        <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total( Billed Qty ) : </td>
                        <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo $report_total_quantity; ?></td>                                                                        
                    </tr>
                    <tr>
                        <td colspan="4" align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ;font-weight: bold; ">Grand Total( Pending Qty ) : </td>                        
                        <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; font-weight: bold; "><?php echo $report_total_pending; ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </body>

</html>
