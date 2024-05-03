
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="font-size: 15px"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new allotment" data-placement="left"  onclick="add_new_allotment();"><i class="fa fa-plus"></i>ADD NEW ALLOTMENT</a>
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
                                                    <td> <?php echo $stockAllot['stock_allotID']; ?></td>
                                                    <td> <?php echo $stockAllot['description']; ?></td>
                                                    <td> <?php echo $stockAllot['store_name']; ?></td>
                                                    <td> <?php echo $stockAllot['total_item']; ?></td>
                                                    <td> <?php echo $stockAllot['net_value']; ?></td>
                                                    <td>
                                                        <?php if ($stockAllot['is_approved'] == NULL) { ?>
                                                        <a href="javascript:void(0);" onclick="edit_allotment('<?php echo $stockAllot['stock_allotID'];  ?>', '<?php $stockAllot['description'];  ?>', '<?php echo $stockAllot['substore_id'];  ?>', '<?php echo $stockAllot['total_item'];  ?>', '<?php echo $stockAllot['net_value'];  ?>');"  data-toggle="tooltip" data-placement="right" title="Edit Allotment <?php // echo $category['cate_name'];  ?>" data-original-title="<?php // echo $category['cate_name'];  ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>                                                       
                                                        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="discard_allotment('<?php echo $stockAllot['stock_allotID']; ?>')"  data-toggle="tooltip" data-placement="right" title="Delete Allotment" data-original-title=""  ><i class="fa fa-times" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>                                                       
                                                        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="approve_allotment('<?php // echo $category['cate_id'];  ?>', '<?php // echo $category['cate_name'];  ?>', '<?php // echo $category['cate_description'];  ?>');"  data-toggle="tooltip" data-placement="right" title="Approve Allotment<?php // echo $category['cate_name'];  ?>" data-original-title="<?php // echo $category['cate_name'];  ?>"  ><i class="fa fa-send-o" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>      <?php } else { ?>                                                 
                                                        &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="view_allotment('<?php // echo $category['cate_id'];  ?>', '<?php // echo $category['cate_name'];  ?>', '<?php // echo $category['cate_description'];  ?>');"  data-toggle="tooltip" data-placement="right" title="View Approved Allotment" data-original-title="<?php // echo $category['cate_name'];  ?>"  ><i class="fa fa-file" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>   <?php } ?> 
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
    function add_new_allotment() {
        var ops_url = baseurl + 'allotment/add-allotment/';
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
    function view_allotment() {
        var ops_url = baseurl + 'allotment/view-allotment/';
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
    function approve_allotment() {
        var ops_url = baseurl + 'allotment/approve-allotment/';
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
    function discard_allotment() {
         
                    swal({
                        title: '',
                        text: 'Do you want to delete allotment!!',
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Delete',
                        confirmButtonText: 'Cancel',
                        closeOnConfirm: true
                    }, function (isConfirm) {
                        if (isConfirm) {
                            
//                            load_allotment();
                        }else{
                             swal('success', 'Allotment deleted successfully .', 'success');
                             return true
//                            load_allotment();
                        }
                    })
                    return true;
        
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
    }



</script>