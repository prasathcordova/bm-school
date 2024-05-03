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

<?php
if (isset($details_data) && !empty($details_data)) {
    foreach ($details_data as $student) {
        //        print_r($emp);die;
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

                        <?php echo $student['student_name'] ?> <small style="float: right;"> <?php //echo $student['Designation'] 
                                                                                                ?></small>
                        <small style="float: right;"> <?php echo $student['Batch_Name'] ?>
                            <br> Status : <?php echo $student['stud_status'] ?>
                            <br> Admin No : <?php echo $student['Admn_No'] ?></small>

                        <input type="hidden" id="std_id" name="std_id" value="<?php echo $student['student_id'] ?>">
                    </div>
                    <div class="panel-body">
                        <div class=" input-group" style="padding-bottom: 5%;">
                            <input type="text" placeholder="Enter Packing ID" class="input form-control" id="searchpack" name="searchpack">

                            <span class="input-group-btn">
                                <button type="button" id="search_name_btn" class="btn btn btn-primary" onclick="search_item();"> <i class="fa fa-search"></i></button>
                                <input type="hidden" class="input form-control" id="store_idd" name="store_idd" value="<?php // echo $store_idd              
                                                                                                                        ?>">
                            </span>
                        </div>

                        <div class="ScrollStyle">
                            <div class="row row-new" id="item-data-container">
                                <?php


                                if (isset($pack_list) && !empty($pack_list) && is_array($pack_list)) {

                                    foreach ($pack_list as $packlist) {
                                ?>
                                        <div class="col-lg-4">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                    <?php echo $packlist['barcode']; ?>

                                                    <?php if ($packlist['is_payment_done'] == null && $packlist['is_partial_payment'] == null && $packlist['is_return'] != 1) { ?>
                                                        <a href="javascript:void(0)" onclick="select_items('<?php echo $packlist['id']; ?>', '<?php echo $packlist['barcode']; ?>');">
                                                            <span class="label label-info pull-right">Show Pack Details </span>
                                                        </a>
                                                    <?php } else if ($packlist['is_payment_done'] == 1 &&  $packlist['is_return'] != 1) { ?>
                                                        <a href="javascript:void(0)" onclick="select_bill('<?php echo $packlist['billmasterid']; ?>', '<?php echo $packlist['billing_code']; ?>');">
                                                            <span class="label pull-right">Payment Done </span>
                                                        </a>
                                                    <?php } else if ($packlist['is_return'] == 1) { ?>
                                                        <a href="javascript:void(0)" onclick="select_bill('<?php echo $packlist['billmasterid']; ?>', '<?php echo $packlist['billing_code']; ?>');">
                                                            <span class="label label-warning pull-right">Delivery Returned </span>
                                                        </a>

                                                    <?php } else { ?>
                                                        <a href="javascript:void(0)" onclick="select_items('<?php echo $packlist['id']; ?>', '<?php echo $packlist['barcode']; ?>');">
                                                            <span class="label label-warning pull-right">Partially Paid </span>
                                                        </a>
                                                    <?php } ?>



                                                </div>
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 50px;">
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
                                                    <?php if ($packlist['is_payment_done'] == '') { ?>
                                                        <?php if ($packlist['del_payment_type'] == 1) { ?>
                                                            <span class="label" style="margin-left:0px;margin-top:5px"> Order Placed Online - Cash on Delivery</span>
                                                        <?php } ?>
                                                        <?php if ($packlist['del_payment_type'] == 2) { ?>
                                                            <span class="label" style="margin-left:0px;margin-top:5px"> Order Placed Online - Paid Online</span>
                                                        <?php } ?>
                                                        </span>
                                                    <?php } ?>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div id="student-data-container"></div>
            </div>
        </div>

    </div>
</div>




<script>
    var input = document.getElementById("searchpack");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("search_name_btn").click();
        }
    });

    function select_bill(billid, billcode) {
        var std_id = $("#std_id").val();
        var ops_url = baseurl + 'substore/bill-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "billid": billid,
                "std_id": std_id,
                "billcode": billcode
            },
            success: function(result) {
                //                var data = JSON.parse(result)
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function select_items(id, barcode, del_payment_type) {
        var std_id = $("#std_id").val();
        var ops_url = baseurl + 'substore/pack-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "packid": id,
                "std_id": std_id,
                "barcode": barcode,
                "del_payment_type": del_payment_type
            },
            success: function(result) {
                //                var data = JSON.parse(result)
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                } else {
                    alert('No data loaded');
                }
            }
        });
    }



    function search_item() {
        $('#student-data-container').html('');
        var searchpack = $("#searchpack").val();
        var std_id = $("#std_id").val();
        var ops_url = baseurl + 'substore/search-pack';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchpack": searchpack,
                "std_id": std_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#item-data-container').html('');
                    $('#student-data-container').html('');
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
                "width": "20%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 4
            },
            //            {"width": "10%", className: "capitalize", "targets": 4},
            //            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        //        responsive: true,
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



    //     function select_itemsss(id) {alert(id)       ;
    //        var ops_url = baseurl + 'substore/pack-details';
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