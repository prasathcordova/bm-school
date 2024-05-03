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
                        <!--<i class="fa fa-info-circle"></i>-->
                        <?php echo $student['student_name'] ?> <small style="float: right;"> <?php //echo $student['Designation'] 
                                                                                                ?></small>
                        <input type="hidden" id="std_id" name="std_id" value="<?php echo $student['student_id'] ?>">
                    </div>
                    <div class="panel-body">
                        <div class=" input-group" style="padding-bottom: 5%;">
                            <input type="text" placeholder="Enter Packing Id" class="input form-control" id="searchpack" name="searchpack">

                            <span class="input-group-btn">
                                <button type="button" class="btn btn btn-primary" onclick="uniform_search_item();"> <i class="fa fa-search"></i></button>
                                <input type="hidden" class="input form-control" id="store_idd" name="store_idd" value="<?php // echo $store_idd     
                                                                                                                        ?>">
                            </span>
                        </div>

                        <div class="ScrollStyle">
                            <div class="row row-new" id="item-data-container">
                                <?php
                                //                                        dev_export($stockAllot_data);
                                //                                        die;
                                if (isset($pack_list) && !empty($pack_list) && is_array($pack_list)) {
                                    foreach ($pack_list as $packlist) {
                                        if ($packlist['is_payment_done'] == null) {
                                ?>
                                            <div class="col-lg-4">
                                                <div class="ibox float-e-margins">
                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                        <?php echo $packlist['barcode']; ?>
                                                        <!--onclick="bill_test();">-->
                                                        <!--<a href="javascript:void(0);" onclick="select_item('<?php // echo $packlist['id'];     
                                                                                                                ?>);"  data-toggle="tooltip" data-placement="right" title="Move <?php //echo $packlist['item_name'];     
                                                                                                                                                                                ?> to selected items" data-original-title="<?php // echo $packlist['item_name'];     
                                                                                                                                                                                                                                                                ?>" id="select" > <span class="label label-info pull-right">Show Pack Details </span>-->
                                                        <a href="javascript:void(0)" onclick="uniform_select_items('<?php echo $packlist['id']; ?>');" <span class="label label-info pull-right">Show Pack Details </span>
                                                        </a>
                                                        <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                                        <?php // echo $packlist['id']; 
                                                        ?>
                                                    </div>
                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                        Loose Packing </div>


                                                    <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                        <span class="label label-warning pull-left"><?php echo CURRENCY  ?> <?php echo $packlist['final_total']; ?></span>
                                                        <!--                                <h5 class="no-margins">60</h5>
                                                                                        <small>Stock</small>-->
                                                        <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i><?php echo $packlist['total_qty']; ?></div>

                                                    </div>
                                                </div>
                                            </div>

                                <?php
                                        }
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
    function uniform_select_items(id) {
        var std_id = $("#std_id").val();
        var ops_url = baseurl + 'uniform/substore/pack-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "packid": id,
                "std_id": std_id
            },
            success: function(result) {
                //                var data = JSON.parse(result)
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                    //                    var animation = "fadeInDown";
                    //                    $("#student-data-container").show();
                    //                    $('#student-data-container').addClass('animated');
                    //                    $('#student-data-container').addClass(animation);
                    //                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }



    function uniform_search_item() {
        var searchpack = $("#searchpack").val();
        var std_id = $("#std_id").val();
        var ops_url = baseurl + 'uniform/substore/search-pack';
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