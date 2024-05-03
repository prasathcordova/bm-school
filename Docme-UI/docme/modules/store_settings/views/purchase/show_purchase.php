
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom: solid 2px #eee;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new purchase order" data-placement="left"href="javascript:void(0)" onclick="load_purchaseorder();"><i class="fa fa-plus"></i> NEW PURCHSAE ORDER</a>
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new direct purchase order" data-placement="left"href="javascript:void(0)" onclick="load_directpurchase();"><i class="fa fa-plus"></i> NEW DIRECT PURCHASE ORDER</a>
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
                            <!--<div class="table-responsive">-->
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_purchase_list">
                                <thead>
                                    <tr>
                                        <th>Purchase ID</th>
                                        <th >Order Date</th>
                                        <th >Purchase Type</th>
                                        <th >Supplier Name</th>
                                        <th >Order Value</th>
                                        <th >Status</th>                            
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($purchase_data) && !empty($purchase_data)) {
                                        foreach ($purchase_data as $purchase) {
                                            ?>
                                            <tr>
                                                <td><?php echo $purchase['purchase_code'] ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($purchase['purchase_order_date'])); ?></td>
                                                <td><?php echo $purchase['type_name'] ?></td>
                                                <td><?php echo $purchase['supplier_name'] ?></td>
                                                <td><?php echo $purchase['final_order_value'] ?></td>
                                                <td data-search="<?php echo $purchase['Status_description']; ?>" data-order="<?php echo $purchase['Status_description']; ?>"><?php
                                                    if ($purchase['status_code'] == 1) {
                                                        echo '<span class="label label-warning">' . $purchase['Status_description'] . '</span>';
                                                    } else if ($purchase['status_code'] == 2) {
                                                        echo '<span class="label label-success">' . $purchase['Status_description'] . '</span>';
                                                    } else if ($purchase['status_code'] == 11) {
                                                        echo '<span class="label label-success">' . $purchase['Status_description'] . '</span>';
                                                    } else if ($purchase['status_code'] == 15) {
                                                        echo '<span class="label label-info">' . $purchase['Status_description'] . '</span>';
                                                    } else {
                                                        echo '<span class="label label-info">' . $purchase['Status_description'] . '</span>';
                                                    }
                                                    ?></td>
                                                <td>
                                                    <?php if ($purchase['purchase_status'] == 1) { ?>
                                                        <?php if ($purchase['is_approved'] == NULL && ($purchase['status_code'] == 1 || $purchase['status_code'] == 17)) { ?>
                                                            <a href="javascript:void(0);" onclick="edit_purchase('<?php echo $purchase['purchase_id']; ?>', '<?php echo $purchase['type_name'] ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $purchase['purchase_code']; ?>" data-original-title=""  ><i class="fa fa-pencil" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                            <a href="javascript:void(0);" onclick="delete_purchase('<?php echo $purchase['purchase_id']; ?>', '<?php echo $purchase['purchase_code'] ?>');"  data-toggle="tooltip" data-placement="right" title="Remove <?php echo $purchase['purchase_code']; ?>" data-original-title=""  ><i class="fa fa-times" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                            <a href="javascript:void(0);" onclick="approve_purchase('<?php echo $purchase['purchase_id']; ?>');"  data-toggle="tooltip" data-placement="right" title="Approve <?php echo $purchase['purchase_code']; ?>" data-original-title=""  ><i class="fa fa-send-o" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                        <?php } else if ($purchase['status_code'] == 2 || $purchase['status_code'] == 11) { ?>
                                                            <a href="javascript:void(0);" onclick="view_purchase('<?php echo $purchase['purchase_id']; ?>');"  data-toggle="tooltip" data-placement="right" title="View <?php echo $purchase['purchase_code']; ?>" data-original-title=""  ><i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                            <a href="javascript:void(0);" onclick="purchaseorder_recieve('<?php echo $purchase['purchase_id']; ?>');"  data-toggle="tooltip" data-placement="right" title="Recieve Purchase Order <?php echo $purchase['purchase_code']; ?>" data-original-title=""  ><i class="fa fa-file-text-o" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                        <?php } else if ($purchase['status_code'] == 15 || $purchase['status_code'] == 16) { ?>
                                                            <a href="javascript:void(0);" onclick="view_purchase('<?php echo $purchase['purchase_id']; ?>');"  data-toggle="tooltip" data-placement="right" title="View <?php echo $purchase['purchase_code']; ?>" data-original-title=""  ><i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);" onclick="view_purchase('<?php echo $purchase['purchase_id']; ?>');"  data-toggle="tooltip" data-placement="right" title="View <?php echo $purchase['purchase_code']; ?>" data-original-title=""  ><i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <a href="javascript:void(0);" onclick="view_purchase('<?php echo $purchase['purchase_id']; ?>');"  data-toggle="tooltip" data-placement="right" title="View <?php echo $purchase['purchase_code']; ?>" data-original-title=""  ><i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                        <?php } ?>
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
<script type="text/javascript">






    function toggle_publisher_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_publisher_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_publisher();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_publisher_add();">NEW PUBLISHER</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }



    function refresh_add_panel() {
        $('#name').val('');
        $('#name').parent().removeAttr('class', 'has-error');
        $('#code').val('');
        $('#code').parent().removeAttr('class', 'has-error');
        $('#address1').val('');
        $('#address1').parent().removeAttr('class', 'has-error');
        $('#address2').val('');
        $('#address2').parent().removeAttr('class', 'has-error');
        $('#address3').val('');
        $('#address3').parent().removeAttr('class', 'has-error');
        $('#contact').val('');
        $('#contact').parent().removeAttr('class', 'has-error');
        $('#email').val('');
        $('#email').parent().removeAttr('class', 'has-error');
    }

    function close_add_publisher() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }
    function load_directpurchase() {
        var ops_url = baseurl + 'purchase/direct-purchase_sup/';
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

    function load_purchaseorder() {
        var ops_url = baseurl + 'purchase/purchaseorder-purchase_sup/';
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

    function approve_purchase(purchase_id) {
        var ops_url = baseurl + 'purchase/direct-purchase_approve/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "purchase_id": purchase_id},
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
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }

            }
        });
    }
    function view_purchase(purchase_id) {
        var ops_url = baseurl + 'purchase/purchase_view/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "purchase_id": purchase_id},
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
                            swal('', 'An error occurred while viewing purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while viewing purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while viewing purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    function edit_purchase(purchase_id) {
        var ops_url = baseurl + 'purchase/purchase-edit/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "purchase_id": purchase_id},
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
                            swal('', 'An error occurred while editing purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while editing purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while editing purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });

    }

    function delete_purchase(purchase_id, purchase_code) {
        var ops_url = baseurl + 'purchase/purchase-delete/';
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover the purchase with purchase code : " + purchase_code,
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
                    data: {"load": 1, "purchase_id": purchase_id},
                    success: function (result) {
                        try {
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                swal('Success', 'Purchase order with order number : ' + purchase_code + ' is removed successfully', 'success');
                                load_purchase();
                            } else if (data.status == 2) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                                }
                            } else if (data.status == 3) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                                }
                            } else {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while removing purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
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

    function purchaseorder_recieve(purchase_id) {
        var ops_url = baseurl + 'purchase/purchase-orderrecieve/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "purchase_id": purchase_id},
            success: function (result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html(data.view);
                        if ($('#suo_invoice_date').data('disabledata') == '2') {
                            $('#suo_invoice_date').datepicker({
                                format: 'dd-mm-yyyy',
                                endDate: '-1d',
                                maxDate: '0',
                                todayBtn: "linked",
                                autoclose: true,
                            });
                        }

                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }

            }
        });
    }

</script>