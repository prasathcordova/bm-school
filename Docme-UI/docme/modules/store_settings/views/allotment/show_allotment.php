
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="font-size: 15px"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new allotment" data-placement="left"  onclick="add_new_allotment_substore();"><i class="fa fa-plus"></i>ADD NEW ALLOTMENT</a>
                    </div>
                </div>

                <div class="ibox-content" id="data_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                        <div class="clearfix"> </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_category" >

                                    <thead>
                                        <tr>
                                            <th> ID</th>
                                            <th>Description</th>
                                            <th>SubStore</th>
                                            <th>Total Item</th>                                
                                            <th>Net Value</th>                                
                                            <th>Task</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//                                                                                dev_export($stockAllot_data);die;
                                        if (isset($stockAllot_data) && !empty($stockAllot_data) && is_array($stockAllot_data)) {
                                            foreach ($stockAllot_data as $stockAllot) {
                                                ?>
                                                <tr>
                                                    <td> <?php echo $stockAllot['masterid']; ?></td>
                                                    <td> <?php echo base64_decode($stockAllot['description']); ?></td>
                                                    <td> <?php echo $stockAllot['store_name']; ?></td>
                                                    <td> <?php echo $stockAllot['net_quantity']; ?></td>
                                                    <td> <?php echo $stockAllot['net_price']; ?></td>
                                                    <td>
                                                        <?php if ($stockAllot['isapproved'] == NULL) { ?>
                                                        <a href="javascript:void(0);" onclick="edit_allotment('<?php echo $stockAllot['masterid'];  ?>', '<?php $stockAllot['description'];  ?>', '<?php echo $stockAllot['storeid'];  ?>', '<?php echo $stockAllot['net_quantity'];  ?>', '<?php echo $stockAllot['net_price'];  ?>');"  data-toggle="tooltip" data-placement="right" title="Edit Allotment <?php // echo $category['cate_name'];  ?>" data-original-title="<?php // echo $category['cate_name'];  ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>                                                       
                                                        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="discard_allotment('<?php echo $stockAllot['masterid']; ?>')"  data-toggle="tooltip" data-placement="right" title="Delete Allotment" data-original-title=""  ><i class="fa fa-times" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>                                                       
                                                        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="approve_allotment('<?php echo $stockAllot['masterid'];  ?>');"  data-toggle="tooltip" data-placement="right" title="Approve Allotment<?php // echo $category['cate_name'];  ?>" data-original-title="<?php // echo $category['cate_name'];  ?>"  ><i class="fa fa-send-o" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>      <?php } else { ?>                                                 
                                                        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="view_allotment('<?php echo $stockAllot['masterid'];  ?>');"  data-toggle="tooltip" data-placement="right" title="View Approved Allotment" data-original-title="<?php // echo $category['cate_name'];  ?>"  ><i class="fa fa-file" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>   <?php } ?> 
                                                    </td>
                                                </tr>
                                                <?php
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


<script type="text/javascript">
    var list_switchery = [];
    $('#tbl_category').dataTable({

        columnDefs: [
            {"width": "10%", className: "capitalize", "targets": 0},
            {"width": "30%", className: "capitalize", "targets": 1},
            {"width": "20%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3},
            {"width": "10%", className: "capitalize", "targets": 4},
            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Report'}
        ],
        "fnDrawCallback": function (ele) {
            activateSwitchery();
        }


    });
   

//NEW SCRIPT
    function add_new_allotment_substore() {
        var ops_url = baseurl + 'allotment/add-allotment_substore/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html('');
                $('#data-view').html(result);

            }
        });
    }
//

//NEW SCRIPT
    function edit_allotment() {
        var ops_url = baseurl + 'allotment/edit-allotment/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html('');
                $('#data-view').html(result);

            }
        });
    }
    
    
    
    function view_allotment(allotment_id) {
        var ops_url = baseurl + 'allotment/view-allotment/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "allotment_id": allotment_id},
            success: function (result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html(data.view);
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while viewing Allotment. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while viewing Allotment . Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while viewing Allotment. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }
    
    
    
    
    
//    function view_allotment() {
//        var ops_url = baseurl + 'allotment/view-allotment/';
//        $.ajax({
//            type: "POST",
//            cache: false,
//            async: false,
//            url: ops_url,
//            data: {"load": 1},
//            success: function (result) {
//                $('#data-view').html('');
//                $('#data-view').html(result);
//
//            }
//        });
//    }
    function approve_allotment(allotment_id) {
        var ops_url = baseurl + 'allotment/approve-allotment/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1,"allotment_id":allotment_id},
            success: function (result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html(data.view);
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating allotment. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating allotment. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating allotment. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }

            }
        });
    }
    
    
    function discard_allotment(allotment_id) {
        var ops_url = baseurl + 'allotment/allotment-delete/';
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover the Allotment with Allotment ID : " + allotment_id,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes,Remove Allotment",
            closeOnConfirm: false
        }, function (isconfirm) {
            if (isconfirm) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {"load": 1, "allotment_id": allotment_id},
                    success: function (result) {
                        try {
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                swal('Success', 'Allotment order with ID : ' + allotment_id + ' is removed successfully', 'success');
                                load_allotment();
                            } else if (data.status == 2) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing allotment. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                                }
                            } else if (data.status == 3) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing allotment. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                                }
                            } else {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing allotment. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                                }
                            }
                        } catch (e) {
                            swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                            return false;
                        }
                    }
                });
            }
        });
    }



</script>