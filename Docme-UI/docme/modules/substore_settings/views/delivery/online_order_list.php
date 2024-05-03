<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>


                <div class="ibox-content" id="faculty_loader">

                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div id="item-data-container">
                        <div class="tabs-container">
                            <?php
                            echo form_open('details/add-item', array('id' => 'item_save', 'role' => 'form'));
                            ?>
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1"> Online Payment </a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2"> Cash On Delivery</a></li>
                                <!--                            <li class=""><a data-toggle="tab" href="#tab-3"> Barcode</a></li>-->
                                <!--<li class=""><a data-toggle="tab" href="#tab-4"> Images</a></li>-->
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="curd-content" style="display: none;"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="ibox-title">
                                            <h5>Online Payment</h5>
                                        </div>
                                        <br />
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_online_payment">

                                                <thead>
                                                    <tr>
                                                        <th>Packing No</th>
                                                        <th>Admission No</th>
                                                        <th>Student Name</th>
                                                        <th>Mobile No</th>
                                                        <th>Order Date</th>
                                                        <th>Delivery Address</th>
                                                        <th>Reference No</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //$online_order_data = [];
                                                    if (!empty($online_order_data)) {
                                                        foreach ($online_order_data as $data) {
                                                            if ($data['payment_type'] == 2) {
                                                    ?>
                                                                <tr>
                                                                    <td> <?php echo  $data['barcode']; ?></td>
                                                                    <td> <?php echo  $data['Admn_No']; ?></td>
                                                                    <td> <?php echo  $data['student_name']; ?></td>
                                                                    <td> <?php echo  $data['mobile_no']; ?></td>
                                                                    <td> <?php echo  date('d-m-Y', strtotime($data['payment_date'])); ?></td>
                                                                    <td>
                                                                        <?php print str_replace(',', '<br/>', $data['delivery_address'])
                                                                        ?>
                                                                    </td>
                                                                    <td> <?php echo  $data['reference_no']; ?></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="select_items_delivery(<?php echo $data['pack_id'] ?>,<?php echo $data['student_id'] ?>)"><i class="fa fa-edit"></i>Delivery Note</a>
                                                                    </td>
                                                                </tr>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="curd-content" style="display: none;"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="ibox-title">
                                            <h5>Cash On Delivery</h5>
                                        </div>
                                        <br />
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_cod" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Packing No</th>
                                                        <th>Admission No</th>
                                                        <th>Student Name</th>
                                                        <th>Mobile No</th>
                                                        <th>Order Date</th>
                                                        <th>Delivery Address</th>
                                                        <th>Reference No</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($online_order_data)) {
                                                        foreach ($online_order_data as $data_c) {
                                                            if ($data_c['payment_type'] == 1) {
                                                    ?>
                                                                <tr>
                                                                    <td> <?php echo  $data_c['barcode']; ?></td>
                                                                    <td> <?php echo  $data_c['Admn_No']; ?></td>
                                                                    <td> <?php echo  $data_c['student_name']; ?></td>
                                                                    <td> <?php echo  $data_c['mobile_no']; ?></td>
                                                                    <td> <?php echo  date('d-m-Y', strtotime($data_c['created_date'])); ?></td>
                                                                    <td>
                                                                        <?php print str_replace(',', '<br/>', $data_c['delivery_address']); ?>
                                                                    </td>
                                                                    <td> <?php echo  $data_c['reference_no']; ?></td>
                                                                    <td>
                                                                        <?php if ($data_c['payment_status'] == 1 &&  ($data_c['payment_details'] != '' || $data_c['payment_details'] != NULL)) { ?>
                                                                            <a target="_blank" href="<?php echo base_url() ?>substore/bill-print-duplicate/<?php echo $data_c['payment_details'] ?>" class=" btn btn-xs btn-info"><i class="fa fa-edit"></i>Print Bill</a>
                                                                            <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="select_items_delivery(<?php echo $data_c['pack_id'] ?>,<?php echo $data_c['student_id'] ?>)"><i class="fa fa-edit"></i>Delivey Note</a>
                                                                        <?php } else { ?>
                                                                            <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="generate_bill(<?php echo $data_c['pack_id'] ?>,<?php echo $data_c['student_id'] ?>)"><i class="fa fa-edit"></i>Generate Bill</a>
                                                                        <?php } ?>

                                                                    </td>
                                                                </tr>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var list_switchery = [];
    $('#tbl_online_payment').dataTable({
        responsive: true,
        "bSort": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }
        ],



    });

    $('#tbl_cod').dataTable({
        responsive: true,
        "bSort": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }
        ],

    });

    function select_items_delivery(id, student_id) {
        var ops_url = baseurl + 'substore/online-delivery-pack-details';
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
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                } else {
                    alert('No data loaded');
                }
            }
        });

    }

    function generate_bill(pack_id, student_id) {

        var ops_url = baseurl + 'substore/online-order-cod-process';
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
                "pack_id": pack_id,
                "student_id": student_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.billcode) {
                    //var link = baseurl + 'substore/bill-print-download/' + billid;

                    var link = baseurl + 'substore/bill-print-other/' + data.billcode;
                    window.open(link, '_blank');
                    swal({
                        title: 'Success',
                        text: 'Bill generated.Proceed to generate Delivery Note',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true
                    }, function(isConfirm) {
                        //window.location.href = baseurl + "online-registration/return-view";
                        select_items_delivery(pack_id, student_id);
                    });

                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>