<?php
$profile_image = "";
if (!empty(get_student_image($details_data[0]['student_id']))) {
    $profile_image = get_student_image($details_data[0]['student_id']);
} else {
    $profile_image = base_url('assets/img/a0.jpg');
}

?>
<!-- <div class="ibox"> -->
<!-- <div class="ibox-content" id="data_loader"> -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info" style="min-height:400px">
            <div class="panel-heading" style='min-height:75px;width:100%;'>
                <div class="col-md-9" style="text-align: left;margin-bottom:10px">
                    <img src="<?php echo $profile_image; ?>" class="img-circle" alt="profile" style="width: 45px;height: 45px;">
                    <?php echo  $details_data[0]['student_name'] ?>
                </div>
                <div class="col-md-3" style="text-align: left;">
                    <small> <?php echo  $details_data[0]['Batch_Name'] ?>
                        <br> Admin No : <?php echo  $details_data[0]['Admn_No'] ?>
                    </small>
                    <div>
                        <?php if ($this->session->userdata('is_parent') == 1) { ?>
                            <a style="color:#fff;" href='<?php echo base_url() ?>' title="Home"><i class="fa fa-home"></i></a>
                            <a class="back_button" style="color:#fff;margin-left:15px;display:none" href='<?php echo base_url() ?>payment-uniform/<?php echo base64_encode($details_data[0]['Admn_No']) . "/" . $details_data[0]['Inst_ID'] ?>' title="Back"><i class="fa fa-angle-double-left"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <input type="hidden" id="student_id" name="student_id" value="<?php echo  $details_data[0]['student_id'] ?>">
            </div>
            <div class="panel-body" id="data-container">
                <!-- <div> -->
                <div class="row" id="item-data-container">
                    <?php
                    if (isset($pack_list) && !empty($pack_list) && is_array($pack_list)) {
                        foreach ($pack_list as $packlist) {
                    ?>

                            <div class="col-lg-3">
                                <a href="javascript:void(0)" onclick="select_items('<?php echo $packlist['id']; ?>', '<?php echo $packlist['barcode']; ?>');">
                                    <div class="ibox float-e-margins shadow">
                                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                            <?php echo $packlist['barcode']; ?>


                                            <span class="label label-info pull-right">Show Pack Details </span>


                                        </div>
                                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                            <label>OH packing</label>
                                        </div>

                                        <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                            <span class="label label-warning pull-left"><?php echo CURRENCY ?> <?php echo $packlist['final_total']; ?></span>
                                            <span class="label label-info pull-left" style="margin-left:5px">
                                                <?php
                                                if ($packlist['is_payment_done'] == 1 && $packlist['delivery_status'] == 1) {
                                                    echo 'Order Dispatched';
                                                } elseif ($packlist['is_payment_done'] == 0 && $packlist['is_partial_payment'] == 1) {
                                                    echo 'Partially Paid at School';
                                                } elseif (strlen($packlist['delivery_status']) == 0) {
                                                    echo 'Available';
                                                } elseif ($packlist['delivery_status'] == 0) {
                                                    echo 'Order Placed';
                                                } elseif ($packlist['delivery_status'] == 2) {
                                                    echo 'Delivered';
                                                } elseif ($packlist['delivery_status'] == 3) {
                                                    echo 'Partially Delivered';
                                                } elseif ($packlist['delivery_status'] == 4) {
                                                    echo 'Delivery Returned';
                                                }
                                                ?>
                                            </span>

                                            <div class="stat-percent font-bold text-info" data-toggle="tooltip" title="Total Billed Quantity"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i><?php echo 1; //$packlist['total_qty']; 
                                                                                                                                                                                                                                ?></div>

                                        </div>
                                    </div>
                                </a>
                            </div>


                        <?php
                        }
                    } else { ?>
                        <div class="col-lg-12">
                            No Packing found for Payment.
                        </div>
                    <?php } ?>

                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div id="student-data-container"></div>
    </div>
</div>

<!-- </div> -->
<!-- </div> -->




<script>
    function select_items(id, barcode) {
        var student_id = $("#student_id").val();
        var ops_url = baseurl + 'uniform/pack-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "packid": id,
                "barcode": barcode,
                "student_id": student_id
            },
            success: function(result) {
                //                var data = JSON.parse(result)
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('.back_button').show();
                    $('#data-container').html('');
                    $('#data-container').html(data.view);
                } else {
                    alert('No data loaded');
                }
            }
        });
    }





    $(document).ready(function() {

        $('.ScrollStyle').slimscroll({
            height: '150px'
        })
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>