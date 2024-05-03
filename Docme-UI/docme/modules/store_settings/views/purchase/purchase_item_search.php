<div class="row row-new">
    <?php
    if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
        foreach ($item_data as $item) {
            ?>
            <div class="col-lg-4 col-rt-pa-none">
                <div class="purchase-list">
                    <div class="widget style1 "  class="learn-more" >
                        <b> Item Code : <?php echo $item['item_code']; ?><a href="javascript:void(0);" onclick="select_item('<?php echo $item['item_id']; ?>', '<?php echo $item['itemtype_name']; ?>', '<?php echo $item['item_code']; ?>', '<?php echo $item['selling_price']; ?>', '<?php echo $item['barcode']; ?>');"  data-toggle="tooltip" data-placement="right" title="Move <?php echo $item['item_name']; ?> to selected items" data-original-title="<?php echo $item['item_name']; ?>" id="select" ><i class="fa fa-paper-plane" style="font-size: 24px; color: #45aaaa; margin: 2%; float: right;"></i></a></b>                                                       
                        <b> Item Type : <?php echo $item['itemtype_name']; ?></b>
                        <b> Barcode : <?php echo $item['barcode']; ?></b>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>