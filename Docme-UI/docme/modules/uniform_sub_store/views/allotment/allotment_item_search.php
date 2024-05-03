<div class="row row-new">
    <?php
    $flag = 1;
    if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
        foreach ($item_data as $item) {
    ?>

            <div class="col-lg-4" style="padding-left: 17px;padding-top: 2px;">
                <div class="ibox float-e-margins">

                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                        <a title="Add  <?php echo $item['item_name'] ?> to list ">
                            <span class="label label-info pull-right" onclick="uniform_select_item('<?php echo $item['itemsid']; ?>', '<?php echo $item['item_name']; ?>', '<?php echo $item['itemtype_name']; ?>', '<?php echo $item['item_code']; ?>', '<?php echo $item['barcode']; ?>', '<?php echo $item['selling_price']; ?>', '<?php echo $item['rate']; ?>', '<?php echo $item['stock']; ?>');">Add to list</span></a>



                        <?php echo $item['barcode']; ?>
                    </div>
                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                        <div>Item Type : <?php echo $item['itemtype_name']; ?></div>
                        <div>Item Name : <?php echo $item['item_name']; ?></div>
                        <div>Item Code : <?php echo $item['item_code']; ?></div>

                    </div>


                    <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                        <span class="label label-warning pull-left"><?php echo CURRENCY  ?> <?php echo (isset($item['rate']) && !empty($item['rate'])) ? $item['rate'] : $item['selling_price']; ?></span>

                        <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;">stock</i><?php echo $item['stock']; ?></div>

                    </div>
                </div>
            </div>
    <?php
            if ($flag == 3) {
                echo '<div class="clearfix"></div>';
                $flag = 1;
            } else {
                $flag++;
            }
        }
    }
    ?>
</div>