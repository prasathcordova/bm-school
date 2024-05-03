<div class="ibox" id="faculty-delivery">
    <?php
    $profile_image = "";
    if (isset($faculty['profile_image']) && !empty($faculty['profile_image'])) {
        $profile_image = "data:image/png;base64," . $faculty['profile_image'];
    } else {
        if (isset($faculty['profile_image_alternate']) && !empty($faculty['profile_image_alternate'])) {
            $profile_image = $faculty['profile_image_alternate'];
        } else {
            $profile_image = base_url('assets/img/a0.jpg');
        }
    }
    ?>



    <div class="ibox-content" id="data_loader">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <img src="<?php echo $profile_image; ?>" class="img-circle circle-border" alt="profile" style="width: 40px;">
                        <?php echo $faculty['Emp_Name'] ?>
                        <small style="float: right;">Employee Code : <?php echo $faculty['Emp_code'] ?>
                            <br>Designation : <?php echo $faculty['Designation'] ?></small>


                        <input type="hidden" id="emp_id" value="<?php echo $faculty['Emp_id'] ?>">


                    </div>
                    <div class="panel-body">
                        <div class=" input-group" style="padding-bottom: 5%;">
                            <input type="text" placeholder="Enter Voucher Number" class="input form-control" id="searchitem" name="searchitem">
                            <span class="input-group-btn">
                                <button type="button" id="button_id" class="btn btn btn-primary" onclick="uniform_search_faculty_voucher();"> <i class="fa fa-search"></i></button>
                                <input type="hidden" class="input form-control" id="store_idd" name="store_idd" value="<?php // echo $store_idd                    
                                                                                                                        ?>">
                            </span>
                        </div>
                        <div class="ScrollStyle">
                            <div class="row row-new" id="item-data-box">
                                <?php
                                if (isset($pack_list) && !empty($pack_list) && is_array($pack_list)) {
                                    foreach ($pack_list as $packlist) {
                                ?>
                                        <div class="col-lg-4">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                    <?php echo $packlist['delivery_number']; ?>
                                                    <?php if ($packlist['is_delivery_cosed'] == 1) { ?>
                                                        <a href="javascript:void(0)" onclick="uniform_select_items('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right" style="background-color: #0070A0;">Delivered </span>
                                                        </a>
                                                    <?php } else if ($packlist['is_pending'] == 1) { ?>
                                                        <a href="javascript:void(0)" onclick="uniform_select_items('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right">Pending </span>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="javascript:void(0)" onclick="uniform_select_items('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right">For Delivery </span>
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
        var emp_id = $("#emp_id").val();

        var ops_url = baseurl + 'uniform/substore/delivery-pack-details';
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
                "emp_id": emp_id
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




    function uniform_search_faculty_voucher() {
        $('#item-replace-container').html('');
        $('#item-data-container').html('');
        var searchvoucher = $("#searchitem").val();
        var emp_id = $("#emp_id").val();

        var ops_url = baseurl + 'uniform/sales/faculty-voucher-delivery';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchvoucher": searchvoucher,
                "emp_id": emp_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#item-data-box').html('');
                    $('#item-data-box').html(data.view);
                    var animation = "fadeInDown";
                    $("#item-data-box").show();
                    $('#item-data-box').addClass('animated');
                    $('#item-data-box').addClass(animation);
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
                "width": "10%",
                className: "capitalize",
                "targets": 3
            },
        ],
        responsive: false,
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
</script>