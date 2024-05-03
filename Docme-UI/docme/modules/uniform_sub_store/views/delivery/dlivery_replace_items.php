<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i>   Item Replacement (Item Replaced with same item type and price)
                <a href="javascript:void(0)" onclick="uniform_close_replace();" data-toggle="tooltip" title="Close" style="float: right; color: #B22222;"><i class="fa fa-close"></i></a>

            </div>
            <div class="panel-body">
                <div class="title-action" style="text-align: right;padding-top: 0px; padding-bottom: 10px;">
                    <?php // echo $details_data[0]['is_delivery_cosed']; ?>
                    <?php // if ($details_data[0]['is_delivery_cosed'] == 0) { ?>
                    <!--<a href="javascript:void(0)" onclick="submit_data('<?php // echo $details_data[0]['id'];  ?>' , '<?php // echo $details_data[0]['delivery_number'];  ?>')"  target="_blank" class="btn btn-primary"> Confirm Delivery </a>-->
                    <?php // } ?>
                </div>
                <input type="hidden" class="input form-control" id="pack_id" name="pack_id" value="<?php echo $pack_id ?>">
                <input type="hidden" class="input form-control" id="re_item_id" name="re_item_id" value="<?php echo $item_id ?>">
                <input type="hidden" class="input form-control" id="price" name="price" value="<?php echo $price ?>">
                <input type="hidden" class="input form-control" id="qty" name="qty" value="<?php echo $qty ?>">
                <input type="hidden" class="input form-control" id="delivery_id" name="delivery_id" value="<?php echo $delivery_id ?>">
                <input type="hidden" class="input form-control" id="del_detail_id" name="del_detail_id" value="<?php echo $del_detail_id ?>">
                <?php if ($details_data == NULL) { ?>
                <p> No available items in similar itemtype for replacement ! </p>
                <?php } else { ?>
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_replace_item" style="width:100%;" >
                        <thead>
                            <tr>                             
                                <th>Items Name</th>                              
                                <th>Items Type</th>                                
                                <th>Price</th>                               
                                <th>Task</th>                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($details_data) && !empty($details_data)) {
                                foreach ($details_data as $items) {
//                                    if($items['rate'] == NULL ||$items['rate'] == $items['selling_price'] ){
                                    $price = (isset($items['rate']) && !empty($items['rate']) && $items['rate'] != NULL) ? $items['rate'] : $items['selling_price']
                                    ?>
                                    <tr>
                                        <td><?php echo $items['item_name']; ?></td>
                                        <td><?php echo $items['itemtype_name']; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><a href="javascript:void(0)" onclick="uniform_replaced_item('<?php echo $items['item_id'] ?>')" data-toggle="tooltip" title="Replace Item"><i class="fa fa-exchange"></i></a></td>
                                    </tr>
                                    <?php
//                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div> 
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('.ScrollStyle').slimscroll({
            height: '150px'
        })
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    var table = $('#tbl_replace_item').dataTable({

        columnDefs: [
            {"width": "20%", className: "capitalize", "targets": 0},
            {"width": "20%", className: "capitalize", "targets": 1},
            {"width": "20%", className: "capitalize", "targets": 2},
            {"width": "20%", className: "capitalize", "targets": 3},
//            {"width": "20%", className: "capitalize", "targets": 4},
//            {"width": "10%", className: "capitalize", "targets": 4},
//            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv', exportOptions: {
                    columns: [0, 1, 2, 3]
                }},
            {extend: 'excel', title: 'Report', exportOptions: {
                    columns: [0, 1, 2, 3]
                }}
        ],

    });


    function uniform_replaced_item(item_id) {
//        alert(item_id);
        var pack_id = $('#pack_id').val();
        var price = $('#price').val();
        var qty = $('#qty').val();
        var re_item_id = $('#re_item_id').val();
        var delivery_id = $('#delivery_id').val();
        var del_detail_id = $('#del_detail_id').val();
//        alert(delivery_id);
        var ops_url = baseurl + 'uniform/delivery/replace-item';
        swal({
            title: "Are you sure?",
            text: "Do you want to replace the Item ?",
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
                    data: {"pack_id": pack_id, "re_item_id": re_item_id, "item_id": item_id, "price": price, "qty": qty,"del_detail_id":del_detail_id},
                    success: function (result) {
                        try {
                            var data = JSON.parse(result);

                            if (data.status == 1) {
                                swal('Success!!', 'Item replaced successfully', 'success');
                                uniform_select_items_delivery(delivery_id);
                                $("#item-replace-container").hide();

//                                    delivery_student();
                            } else if (data.status == 2) {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while replacing item. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                    return false;
                                }
                            } else {
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    return false;
                                } else {
                                    swal('', 'An error occurred while replacing item. Please try again later or contact administrator with error code : PAPRDTAER10003', 'info');
                                    return false;
                                }
                            }
                        } catch (e) {
                            console.log(result_s);
                            swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRUIJSNER10002', 'info');
                        }
                    }
                });
            }
        });
    }
    
    function uniform_close_replace(){
        $('#add_type').show();
        $("#item-replace-container").slideUp("slow", function () {
            $("#item-replace-container").hide();
        });
    }
    function uniform_select_items_delivery(id) {
        var ops_url = baseurl + 'uniform/substore/delivery-pack-details';
        $('#add_type').show();
        $("#item-replace-container").slideUp("slow", function () {
            $("#item-replace-container").hide();
        });
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "packid": id},
            success: function (result) {
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
</script>
