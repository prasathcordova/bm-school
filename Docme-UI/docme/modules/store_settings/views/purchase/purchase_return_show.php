
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom: solid 2px #eee;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new purchase return order" data-placement="left"href="javascript:void(0)" onclick="add_return_request();"><i class="fa fa-plus"></i> NEW PURCHSAE RETURN</a>
                    </div>
                </div>
                <div class="ibox-content" id="faculty_loader">
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
                        <div class="col-lg-12">                          
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_purchase_list">
                                <thead>
                                    <tr>
                                        <th>Return Code</th>
                                        <th>Date</th>
                                        <th>Store Name</th>
                                        <th>Return Item Count</th>
                                        <th>Net Value</th>
                                        <th>Status</th>                            
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($purchase_return) && !empty($purchase_return)) {
                                        foreach ($purchase_return as $return) {
                                            ?>
                                            <tr>
                                                <td><?php echo $return['purchase_return_code']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($return['purchase_return_date'])); ?></td>
                                                <td><?php echo $return['store_name']; ?></td>
                                                <td><?php echo $return['item_count']; ?></td>
                                                <td><?php echo $return['final_order_value']; ?></td>
                                                <td data-search="<?php echo $return['status_description']; ?>" data-order="<?php echo $return['status_description']; ?>">
                                                    <?php
                                                    if ($return['status_id'] == 5) {
                                                        echo '<span class="label label-warning">' . $return['status_description'] . '</span>';
                                                    } else if ($return['status_id'] == 12) {
                                                        echo '<span class="label label-success">' . $return['status_description'] . '</span>';
                                                    } else {
                                                        echo '<span class="label label-info">' . $return['status_description'] . '</span>';
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <?php if ($return['status_id'] == 5 ) { ?>
                                                        <a href="javascript:void(0)" onclick="edit_return('<?php echo $return['id']; ?>', '<?php echo $return['purchase_return_code'] ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $return['purchase_return_code']; ?>" data-original-title=""  ><i class="fa fa-pencil" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                        <a href="javascript:void(0)" onclick="delete_return('<?php echo $return['id']; ?>', '<?php echo $return['purchase_return_code'] ?>');"  data-toggle="tooltip" data-placement="right" title="Remove <?php echo $return['purchase_return_code']; ?>" data-original-title=""  ><i class="fa fa-times" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                        <a href="javascript:void(0)" onclick="approve_return('<?php echo $return['id']; ?>');"  data-toggle="tooltip" data-placement="right" title="Approve <?php echo $return['purchase_return_code']; ?>" data-original-title=""  ><i class="fa fa-send-o" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>      
                                                    <?php } else if ($return['status_id'] == 19 || $return['status_id'] == 6) {
                                                        ?>
                                                        <a href="javascript:void(0)" onclick="view_return('<?php echo $return['id']; ?>');"  data-toggle="tooltip" data-placement="right" title="View <?php echo $return['purchase_return_code']; ?>" data-original-title=""  ><i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                    <?php } else if ($return['status_id'] == 20){ ?>                                                        
                                                        <a href="javascript:void(0)" onclick="edit_return('<?php echo $return['id']; ?>', '<?php echo $return['purchase_return_code'] ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $return['purchase_return_code']; ?>" data-original-title=""  ><i class="fa fa-pencil" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                        <a href="javascript:void(0)" onclick="approve_return('<?php echo $return['id']; ?>');"  data-toggle="tooltip" data-placement="right" title="Approve <?php echo $return['purchase_return_code']; ?>" data-original-title=""  ><i class="fa fa-send-o" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>      
                                                    <?php }
                                                    ?>


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
<input type="hidden" name="itemdata" id="itemdata" value="" />
<script type="text/javascript">

    $('#table_purchase_list').dataTable({

        columnDefs: [
            {"width": "10%", className: "capitalize", "targets": 0},
            {"width": "10%", className: "capitalize", "targets": 1},
            {"width": "15%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3},
            {"width": "18%", className: "capitalize", "targets": 4},
            {"width": "15%", className: "capitalize", "targets": 5, "orderable": false},
            {"width": "15%", className: "capitalize", "targets": 6, "orderable": false}
        ],

        iDisplayLength: 10,

    });

    function add_return_request() {
        var ops_url = baseurl + 'purchase/purchase-return_sup/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function edit_return() {
        var ops_url = baseurl + 'purchase/purchase-return-edit/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
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
                            swal('', 'An error occurred while editing purchase return order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while editing purchase return order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while editing purchase return order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }

            }
        });
    }

    function approve_return(return_id) {
        var ops_url = baseurl + 'purchase/purchase-returnapproval/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "return_id": return_id},
            success: function (result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html(data.view);
                        $('#tbl_selected').dataTable({
                            columnDefs: [
                                {"width": "10%", className: "capitalize", "targets": 0},
                                {"width": "20%", className: "capitalize", "targets": 1},
                                {"width": "20%", className: "capitalize", "targets": 2},
                                {"width": "10%", className: "capitalize", "targets": 3},
                                {"width": "10%", className: "capitalize", "targets": 4},
                                {"width": "10%", className: "capitalize", "targets": 5}
                            ],
                            responsive: true,
                            iDisplayLength: 10,
                        });
                        $('#tbl_comment_system').dataTable({
                            columnDefs: [
                               {"width": "10%", className:  "capitalize", "targets": 0},
                                {"width": "20%", className: "capitalize", "targets": 1},
                                {"width": "30%", className: "capitalize", "targets": 2},
                                {"width": "30%", className: "capitalize", "targets": 3},
                            ],
                            responsive: true,
                            iDisplayLength: 10,
                            "language": {
                                "emptyTable": "No comments available for this purchase return order"
                            }
                        });
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while displaying purchase return order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while displaying purchase return order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while displaying purchase return order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }

            }
        });
    }

    function purchase_return_approve() {
        var return_id = $('#return_id').val();
        if (!(return_id)) {
            swal('', 'Return data is required.', 'info');
            return false;
        }
        var comments = btoa($('#approval_c').val());
        if ($('#approval_c').val().length < 5) {
            swal('', 'Comment is mandatory and must be greter than 5 characters. Please fill in comments');
            return false;
        }

        var status = $('input[name=radioInline]:checked').val();
        var po_number = $('#return_order').val();        
        var ops_url = baseurl + 'purchase/approve-save-return-order/';
        swal({
            title: "Are you sure?",
            text: "You want to " + status + " the return order with order id : " + po_number + " ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#23C6C8',
            confirmButtonText: 'Yes!',
            cancelButtonText: "No!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {"return_id": return_id, "comments": comments, "status": status},
                    success: function (result) {
                        try {
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                if (status == 'Approve') {
                                    swal('Success!!', 'Purchase return approved successfully', 'success');
                                } else if (status == 'Reject') {
                                    swal('Success!!', 'Purchase return rejected successfully', 'success');
                                } else if (status == 'Review') {
                                    swal('Success!!', 'Purchase return reviewed successfully', 'success');
                                }
                                purchase_return();
                            } else if (data.status == 2) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while modifying/approving purchase return order. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                    return false;
                                }
                            } else {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while modifying/approving purchase return order. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                    return false;
                                }
                            }
                        } catch (e) {
                            swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRUIJSNER10002', 'info');
                        }
                    }
                });
            }
        });
    }

    function view_return(returnid) {
        var ops_url = baseurl + 'purchase/purchase-returnview/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1,"return_id":returnid},
            success: function (result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html(data.view);
                         $('#tbl_selected').dataTable({
                            columnDefs: [
                                {"width": "10%", className: "capitalize", "targets": 0},
                                {"width": "20%", className: "capitalize", "targets": 1},
                                {"width": "20%", className: "capitalize", "targets": 2},
                                {"width": "10%", className: "capitalize", "targets": 3},
                                {"width": "10%", className: "capitalize", "targets": 4},
                                {"width": "10%", className: "capitalize", "targets": 5}
                            ],
                            responsive: true,
                            iDisplayLength: 10,
                        });
                        $('#tbl_comment_system').dataTable({
                            columnDefs: [
                                {"width": "10%", className: "capitalize", "targets": 0},
                                {"width": "20%", className: "capitalize", "targets": 1},
                                {"width": "30%", className: "capitalize", "targets": 2},
                                {"width": "30%", className: "capitalize", "targets": 3},
                            ],
                            responsive: true,
                            iDisplayLength: 10,

                            "language": {
                                "emptyTable": "No comments available for this purchase return order"
                            }
                        });
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating view for purchase return order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating view for purchase return order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating view for purchase return order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    function delete_return(returnid, return_code) {
        var ops_url = baseurl + 'purchase/purchase-returndelete/';
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover the purchase with purchase code : " + return_code,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes,Remove purchase",
            closeOnConfirm: false
        }, function (isconfirm) {
            if (isconfirm) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {"load": 1, "returnid": returnid},
                    success: function (result) {
                        try {
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                swal('Success', 'Purchase return with order number : ' + return_code + ' is removed successfully', 'success');
                                purchase_return();
                            } else if (data.status == 2) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing purchase return. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                                }
                            } else if (data.status == 3) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing purchase return. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                                }
                            } else {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing purchase return. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
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