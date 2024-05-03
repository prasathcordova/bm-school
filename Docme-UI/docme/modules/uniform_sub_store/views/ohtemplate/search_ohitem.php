<?php
$flag = 0;
if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
    $i = 0;
    foreach ($item_data as $item) {
        $flag = $flag + 1;
?>
        <div class="col-lg-4" style="padding-left: 17px;padding-top: 2px;">
            <div class="ibox float-e-margins">
                <?php $price = (isset($item['rate']) && !empty($item['rate']) && $item['rate'] != NULL) ? $item['rate'] : $item['selling_price'] ?>
                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 50px;">
                    <a title="Add  <?php echo $item['item_name'] ?> to list "><span class="label label-info pull-right" onclick="uniform_add_list('<?php echo $item['item_code'] ?>', '<?php echo $item['barcode'] ?>', '<?php echo $item['itemtype_name'] ?>', '<?php echo $price ?>', '<?php echo $item['itemsid'] ?>', '<?php echo $item['tax_type'] ?>', '<?php echo $item['tax_value'] ?>');">Add to list</span></a>
                    <?php echo $item['item_code']; ?><br />
                    <?php echo $item['barcode']; ?>
                </div>
                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                    <?php echo $item['item_name']; ?></div>


                <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                    <span class="label label-warning pull-left"><?php echo CURRENCY  ?> <?php echo (isset($item['rate']) && !empty($item['rate'])) ? $item['rate'] : $item['selling_price']; ?></span>
                    <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;">stock</i><?php echo $item['stock']; ?></div>

                </div>
            </div>
        </div>

        <input type="hidden" id="item_code_id" value="<?php echo $item['item_code'] ?>">
        <input type="hidden" id="barcode_id" value="<?php echo $item['barcode'] ?>">
        <input type="hidden" id="itemtype_name_id" value="<?php echo $item['itemtype_name'] ?>">
        <input type="hidden" id="price_id" value="<?php echo $price ?>">
        <input type="hidden" id="itemsid_id" value="<?php echo $item['itemsid'] ?>">
        <input type="hidden" id="tax_type_id" value="<?php echo $item['tax_type'] ?>">
        <input type="hidden" id="tax_value_id" value="<?php echo $item['tax_value'] ?>">

<?php
        if ($i == 2) {
            echo '<div class="clearfix"></div>';
            $i = 0;
        } else {
            $i++;
        }
    }
}
?>
<input type="hidden" id="flag_value" value="<?php echo $flag ?>">