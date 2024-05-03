
<?php
//dev_export($stock_data);die;
if ($stock_data == null) {
    ?>
    <div class="ibox">
        <div class="ibox-content">
<!--            <br>
            <br>-->
            <b>Stock  is empty in selected store </b>
        </div>
    </div>
    <?php
} else {
    ?>
    <h4> Stock list</h4>
    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_current_stock">
        <thead>
            <tr>
                <th>Store Name</th>
                <th>Item </th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>

            <?php
//                                          
            if (isset($stock_data) && !empty($stock_data) && is_array($stock_data)) {
                foreach ($stock_data as $stock) {

//                                                            if ($stock_data['is_received'] == 0) {
//                                                                    
                    ?>
                    <tr>
                        <td> <?php echo $stock['store_name']; ?></td>
                        <td> <?php echo $stock['item_name']; ?></td>
                        <td> <?php echo $stock['stock_qty']; ?></td>
                    </tr>
                    <?php
                }
            }
//                                                    }
            ?>
        </tbody>
    </table>
    <?php }
?>


<script>
    
     $('#tbl_current_stock').dataTable({

        columnDefs: [
            {"width": "10%", className: "capitalize", "targets": 0},
            {"width": "10%", className: "capitalize", "targets": 1},
            {"width": "10%", className: "capitalize", "targets": 2}
        ],
        responsive: true,

    });
</script>