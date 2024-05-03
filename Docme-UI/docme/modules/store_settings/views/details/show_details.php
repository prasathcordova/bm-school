
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;paddding-bottom:0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <span style="padding-right: 9px;"><a href="javascript:void(0);" class="btn btn-primary btn-xs" onclick="add_new_item();" ><i class="fa fa-plus"></i> NEW ITEM</a> </span>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_item_details" >

                                    <thead>
                                        <tr>                                            
                                            <th>Item Type </th>
                                            <th>Item Name </th>
                                            <th>Item Code </th>
                                            <th>publisher</th>
                                            <th>Category</th>
                                            <th>Edition</th>
                                            <th>Status</th>
                                            <th>Task</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($item_data) && !empty($item_data)) {
                                            ?>
                                            <?php foreach ($item_data as $item) {
                                                ?>
                                                <tr>                                            
                                                    <td><?php echo $item['itemtype_name'] ?></td>
                                                    <td><?php echo $item['item_name']; ?></td>
                                                    <td><?php echo $item['item_code']; ?></td>
                                                    <td><?php echo $item['pub_name']; ?></td>
                                                    <td><?php echo $item['cate_name']; ?></td>
                                                    <td><?php echo $item['edition_name']; ?></td>
                                                    <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <?php if ($item['isactive'] == 1) { ?>                                                    
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $item['item_id'] ?>', this)" checked  id="t1" />                                                       


                                                        <?php } else {
                                                            ?>
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $item['item_id'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_item_details('<?php echo $item['item_id'] ?>', '<?php echo $item['item_name'] ?>', '<?php echo $item['item_code'] ?>', '<?php echo $item['item_description'] ?>', '<?php echo $item['purchase_price'] ?>', '<?php echo $item['selling_price'] ?>', '<?php echo $item['cate_name'] ?>', '<?php echo $item['itemtype_name'] ?>', '<?php echo $item['edition_name'] ?>', '<?php echo $item['pub_name'] ?>');"><i style="font-size: 22px !important; color: #23C6C5;" class="material-icons">edit</i></a>                                                       
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
    var list_switchery_item_details = [];
    function activateSwitchery_show_details() {
        for (var i = 0; i < list_switchery_item_details.length; i++) {
            list_switchery_item_details[i].destroy();
            list_switchery_item_details[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#23C6C8', secondaryColor: '#F8AC59', size: 'small'});
            list_switchery_item_details.push(switchery);
        });
    }
    $('#tbl_item_details').dataTable({

        columnDefs: [
            {"width": " 15%", className: "capitalize", "targets": 0},
            {"width": "15%", className: "capitalize", "targets": 1},
            {"width": "15%", className: "capitalize", "targets": 2},
            {"width": "15%", className: "capitalize", "targets": 3},
            {"width": "15%", className: "capitalize", "targets": 4},
            {"width": "20%", className: "capitalize", "targets": 5},
            {"width": "10%", className: "capitalize", "targets": 6, "orderable": false},
            {"width": "10%", className: "capitalize", "targets": 7, "orderable": false}
        ],
        responsive: true,
        "fnDrawCallback": function (ele) {
            activateSwitchery_show_details();
        }


    });
    function refresh_add_panel() {
        $('#state_name').val('');
        $('#state_name').parent().removeAttr('class', 'has-error');

    }

    function close_add_details() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

    function add_new_item() {
        var ops_url = baseurl + 'details/add-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
                if (data) {
                    var animation = "fadeInDown";
                    $('#data-view').addClass(animation);
                    $('#data-view').html('');
                    $('#data-view').html(data);

                    $('#publisher').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#itemtype').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#itemedition').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#stock_category').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });
                    activateSwitchery();


                } else {
                    alert('No data loaded');
                }
            }
        });
    }


    function edit_item_details(item_id, item_name, item_code, item_description, purchase_price, selling_price, cate_name, itemtype_name, edition_name, pub_name) {
        var ops_url = baseurl + 'details/edit-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "item_id": item_id, "item_name": item_name, "item_code": item_code, "item_description": item_description, "purchase_price": purchase_price, "selling_price": selling_price, "cate_name": cate_name, "itemtype_name": itemtype_name, "edition_name": edition_name, "pub_name": pub_name},
            success: function (result) {
                var data = JSON.parse(result);
//                console.log(data);
                if (data.status) {
                    var animation = "fadeInDown";
                    $('#data-view').addClass(animation);
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    show_barcode(data.barcode);

                    $('#publisher').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#itemtype').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#itemedition').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#stock_category').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });
                    activateSwitchery();


                } else {
                    alert('No data loaded');
                }
            }
        });
    }
    function show_barcode(barcode) {
        JsBarcode("#barcodedata", barcode, {
            width: 1,
            height: 40,
            displayValue: true,
            font: "Roboto",
            textAlign: "center",
            textPosition: "bottom",
            background: "#fff"
        });

    }



    function change_status(item_id, element) {
//        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'details/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "item_id": item_id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Item Updated', 'Item Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Item Updated', 'Item Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            gs_count();
                            return true;
                        }
                    }
                } else {
                    if (data.status == 0) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function (isConfirm) {
//                            window.location.href = baseurl + "country/show-country";
                            load_country();
                        });
                    } else {
                        if (data.status == 3) {
                            swal({
                                title: '',
                                text: data.message,
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
//                                window.location.href = baseurl + "country/show-country";
                                load_country();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Country Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
//                                window.location.href = baseurl + "country/show-country";
                                load_country();
                            });
                        }

                    }
                }
            }
        });
    }





</script>


