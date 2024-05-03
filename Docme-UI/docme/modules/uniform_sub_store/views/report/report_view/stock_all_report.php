

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
            Report Type &nbsp;: Uniform Store Stock detail report for <?php echo $store_name; ?> <br/>        
        </p>        
        <table  class="table2 tableH" cellpadding="1" width="100%" style="font-family:Tahoma;" style="font-size: 15px; margin-top: 10px;" >
            <thead>
                <tr class="header">
                    <td class="col1" bgcolor="#2D4154" width="2px" align="center" style="font-family:Tahoma "><font color="#FCFEFC" ><h3>SlNo</h3></td>
                    <td class="col2" bgcolor="#2D4154" width="2px" align="center" style="font-family:Tahoma"><font color="#FCFEFC" ><h3>Item Name</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>Size</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(A+)<br/>Opening Stock</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(B+)<br/>Purchase Qty</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(C+)<br/>Sale Ret Qty</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(D+)<br/>Transfer In</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(E+)<br/>Spec Ret</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(F-)<br/>Purchase Return</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(G-)<br/>Sale Qty</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(H-)<br/>Transfer Out</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(I-)<br/>Spec Qty</h3></td>
                    <td class="col3" bgcolor="#2D4154" width="10%" align="center" style="font-family:Tahoma ;"><font color="#FCFEFC" ><h3>(J)<br/>Closing Stock</h3></td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($report_data) && !empty($report_data)) {
                    $i = 1;
                    foreach ($report_data as $data) {
//                        dev_export($data);die;
                        ?>
                <tr style="border-bottom: 1px solid #ccc; ">
                            <td width="2px"  align="center" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $i; ?></td>
                            <td width="2px" align="left"  style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['item_data']['item_name'])?$data['item_data']['item_name']:''; ?></td>
                            <td align="center"  style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo $data['item_data']['edition_name']; ?></td>
                            <td  align="right"  style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['stock_data']['opening_balance'])?$data['stock_data']['opening_balance']:0; ?></td>
                            <td align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['stock_data']['purchase'])?$data['stock_data']['purchase']:0; ?></td>
                            <td  align="right"  style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['stock_data']['sale_return'])?$data['stock_data']['sale_return']:0; ?></td>
                            <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['stock_data']['transfer_in'])?$data['stock_data']['transfer_in']:0; ?></td>
                            <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['stock_data']['spec_return'])?$data['stock_data']['spec_return']:0; ?></td>
                            <td  align="right" style="border-bottom: 1px solid #ccc; font-family:Tahoma ;"><?php echo isset($data['stock_data']['purchase_return'])?$data['stock_data']['purchase_return']:0; ?></td>
                            <td  align="right" style="border-bottom: 1px solid #ccc; font-family:Tahoma ;"><?php echo isset($data['stock_data']['sale'])?$data['stock_data']['sale']:0; ?></td>
                            <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['stock_data']['transfer_out'])?$data['stock_data']['transfer_out']:0; ?></td>
                            <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['stock_data']['spec_issue'])?$data['stock_data']['spec_issue']:0; ?></td>
                            <td  align="right" style="border-bottom: 1px solid #ccc;font-family:Tahoma ; "><?php echo isset($data['stock_data']['closing_stock'])?$data['stock_data']['closing_stock']:0; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>        
    </body>

</html>
