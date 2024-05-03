<div class="row row-new">
    <?php
    if (isset($pack_list) && !empty($pack_list) && is_array($pack_list)) {
        $i = 0;
        foreach ($pack_list as $packlist) {
    ?>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                        <?php echo $packlist['delivery_number']; ?>
                        <?php if ($packlist['is_delivery_cosed'] == 1) { ?>
                            <a href="javascript:void(0)" onclick="select_items_delivery('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right" style="background-color: #0070A0;">Delivered </span>
                            </a>
                        <?php } else if ($packlist['is_pending'] == 1) { ?>
                            <a href="javascript:void(0)" onclick="select_items_delivery('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right">Pending </span>
                            </a>
                        <?php } else { ?>
                            <a href="javascript:void(0)" onclick="select_items_delivery('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right">For Delivery </span>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                        <?php
                        if ($packlist['order_type_id'] == 1) {
                            echo 'Loose Packing';
                        } elseif ($packlist['order_type_id'] == 3) {
                            echo 'OH Packing';
                            if ($packlist['is_return'] == 1) {
                                echo ' (RETURNED)';
                            }
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
            if ($i == 2) {
                echo '<div class="clearfix"></div>';
                $i = 0;
            } else {
                $i++;
            }
        }
    }
    ?>
</div>

<script>
    function select_items_delivery(id) {
        //                alert('1231');return false;
        var student_id = $('#student_id').val();
        var ops_url = baseurl + 'substore/delivery-pack-details';
        $('#add_type').show();
        $("#item-replace-container").slideUp("slow", function() {
            $("#item-replace-container").hide();
        });
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "packid": id,
                "student_id": student_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#item-data-container').html('');
                    $('#item-data-container').html(data.view);
                    var animation = "fadeInDown";
                    $("#item-data-container").show();
                    $('#item-data-container').addClass('animated');
                    $('#item-data-container').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });

    }
</script>