<div class="row row-new">
    <?php // if ($pack_list[0]['order_type_id'] != 3 || ( $pack_list[0]['is_delivery_cosed'] == 1 && $pack_list[0]['order_type_id'] == 3)) { 
    ?>
    <?php
    if (isset($pack_list) && !empty($pack_list) && is_array($pack_list)) {
        foreach ($pack_list as $packlist) {
            //                if ($packlist['order_type_id'] != 3 || ( $packlist['is_delivery_cosed'] == 1 && $packlist['order_type_id'] == 3)) {
            if ($packlist['is_delivery_cosed'] == 1 || ($packlist['is_pending'] == 1 && $packlist['is_delivery_cosed'] == 0)) {
    ?>
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                            <?php // dev_export($packlist);die; 
                            ?>
                            <?php echo $packlist['delivery_number']; ?>
                            <?php if ($packlist['is_return'] != 1) { ?>
                                <a href="javascript:void(0)" onclick="uniform_select_items('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right" style="background-color: #0070A0;">For Delivery Return</span>
                                </a>
                            <?php } else if ($packlist['is_partial_payment'] == 1 && $packlist['is_payment_done'] == 0 && $packlist['is_return'] != 1) { ?>
                                <a href="javascript:void(0)" onclick="uniform_select_items('<?php echo $packlist['id']; ?>');"><span class="label label-danger pull-right">Partial Paymet</span> </a>
                            <?php } else { ?>
                                <a href="javascript:void(0)" onclick="uniform_select_items('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right">Delivery Returned </span>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                            <?php
                            if ($packlist['order_type_id'] == 1) {
                                echo 'Loose Packing';
                            } elseif ($packlist['order_type_id'] == 3) {
                                echo 'OH Packing';
                            } else {
                                echo 'Specimen Packing';
                            }
                            ?>

                            <br>
                        </div>

                        <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                            <span class="label label-warning pull-left"><?php echo CURRENCY  ?> <?php echo $packlist['final_pay_amount']; ?></span>
                            <div class="stat-percent font-bold text-info"><?php echo $packlist['billing_code']; ?></div>

                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>
    <?php // } 
    ?>
</div>