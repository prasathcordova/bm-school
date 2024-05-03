<?php

/**
 * Description of student_delivery
 *
 * @author chandrajith
 */ ?>
<?php
$profile_image = "";
if (isset($details_data[0]['profile_image']) && !empty($details_data[0]['profile_image'])) {

    $profile_image = "data:image/png;base64," . $details_data[0]['profile_image'];
} else {
    if (isset($details_data['profile_image_alternate']) && !empty($details_data['profile_image_alternate'])) {
        $profile_image = $details_data['profile_image_alternate'];
    } else {
        $profile_image = base_url('assets/img/a0.jpg');
    }
}
?>
<div class="ibox">
    <div class="ibox-content" id="data_loader">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <img src="<?php echo $profile_image; ?>" class="img-circle circle-border" alt="profile" style="width: 40px;">
                        <?php echo $student['student_name'] ?>
                        <small style="float: right;"> <?php echo $student['Batch_Name'] ?>
                            <br> Status : <?php echo $student['stud_status'] ?>
                            <br> Admin No : <?php echo $student['Admn_No'] ?></small>

                    </div>
                    <div class="panel-body">
                        <div class=" input-group" style="padding-bottom: 5%;">
                            <input type="text" placeholder="Enter Voucher Number" class="input form-control" id="searchitem" name="searchitem">
                            <span class="input-group-btn">
                                <button type="button" id="button_id" class="btn btn btn-primary" onclick="uniform_search_item('<?php echo $student_id; ?>');"> <i class="fa fa-search"></i></button>
                                <input type="hidden" class="input form-control" id="student_id" name="student_id" value="<?php echo $student_id; ?>">
                            </span>
                        </div>
                        <div class="ScrollStyle" id="student-delivery-rtn-data">
                            <div class="row row-new">
                                <?php // if ($pack_list[0]['is_delivery_cosed'] == 1) { 
                                ?>
                                <?php
                                if (isset($pack_list) && !empty($pack_list) && is_array($pack_list)) {
                                    foreach ($pack_list as $packlist) {
                                ?>
                                        <div class="col-lg-4">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                    <?php // dev_export($packlist);die; 
                                                    ?>
                                                    <?php echo $packlist['delivery_number']; ?>
                                                    <?php if ($packlist['is_return'] != 1 && $packlist['is_partial_payment'] == 0  && $packlist['is_payment_done'] == 1) { ?>
                                                        <a href="javascript:void(0)" onclick="uniform_select_items('<?php echo $packlist['id']; ?>');"><span class="label label-info pull-right" style="background-color: #0070A0;">For Delivery Return</span>
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
                                ?>
                                <?php // } 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" id="item-replace-container">

            </div>
            <div class="col-lg-12" id="item-data-container">

            </div>
        </div>
    </div>
</div>

<script>
    var input = document.getElementById("searchitem");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id").click();
        }
    });

    function uniform_select_items(id) {
        var student_id = $("#student_id").val();

        var ops_url = baseurl + 'uniform/substore/deliveryReturn-pack-details';
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




    function uniform_search_item(student_id) {
        $('#item-replace-container').html('');
        $('#item-data-container').html('');
        var search_item = $("#searchitem").val();
        //        var store_id = $("#store_idd").val();

        var ops_url = baseurl + 'uniform/sales/searchstud-voucher-deliveryretn';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchvoucher": search_item,
                "student_id": student_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-delivery-rtn-data').html('');
                    $('#student-delivery-rtn-data').html(data.view);
                    var animation = "fadeInDown";
                    $("#student-delivery-rtn-data").show();
                    $('#student-delivery-rtn-data').addClass('animated');
                    $('#student-delivery-rtn-data').addClass(animation);
                    //                    $('#add_type').hide();
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

    var table = $('#tbl_class_item').dataTable({

        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3
            },
            //            {"width": "10%", className: "capitalize", "targets": 4},
            //            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],

    });



    //     function uniform_select_itemsss(id) {alert(id)       ;
    //        var ops_url = baseurl + 'uniform/substore/pack-details';
    //        $.ajax({
    //            type: "POST",
    //            cache: false,
    //            async: false,
    //            url: ops_url,
    //            data: {"load": 1, "packid": id},
    //            success: function (result) {
    //                var data = JSON.parse(result)
    //                if (data.status == 1) {
    //                    $('#item-data-container').html('');
    //                    $('#item-data-container').html(data.view);
    //                    var animation = "fadeInDown";
    //                    $("#item-data-container").show();
    //                    $('#item-data-container').addClass('animated');
    //                    $('#item-data-container').addClass(animation);
    //                    $('#add_type').hide();
    //                } else {
    //                    alert('No data loaded');
    //                }
    //            }
    //        });
    //
    //
    //    }
</script>
</body>

</html>