<?php
if (isset($pack_list) && !empty($pack_list) && is_array($pack_list)) {
    foreach ($pack_list as $packlist) {
?>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                    <?php
                    echo $packlist['barcode'];
                    if ($packlist['is_payment_done'] == null) {
                    ?>
                        <a href="javascript:void(0)" onclick="select_items('<?php echo $packlist['id']; ?>', '<?php echo $packlist['barcode']; ?>');">
                            <span class="label label-info pull-right">Show Pack Details </span>
                        </a>
                    <?php } else { ?>
                        <a href="javascript:void(0)" onclick="select_bill('<?php echo $packlist['billmasterid']; ?>', '<?php echo $packlist['billing_code']; ?>');">
                            <span class="label pull-right">Payment Done </span>
                        </a>
                    <?php } ?>
                </div>
                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                    <?php if ($packlist['order_type_id'] == 1) { ?>
                        Loose Packing
                    <?php } else { ?>
                        OH packing
                    <?php } ?>
                    <br />
                    <?php
                    if ($packlist['is_payment_done'] == 1) {
                        echo $packlist['billing_code'];
                    }
                    ?>
                </div>
                <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                    <span class="label label-warning pull-left"><?php echo CURRENCY  ?> <?php echo $packlist['final_total']; ?></span>
                    <div class="stat-percent font-bold text-info" data-toggle="tooltip" title="Total Billed Quantity"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i><?php echo $packlist['total_qty']; ?></div>
                </div>
            </div>
        </div>
<?php
    }
}
?>