<div class="row">
    <div class="col-lg-12">
        <!--<div class="ScrollStyle">-->
        <div class=" row-new">
            <?php
            $i = 0;
            if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                foreach ($details_data as $packlist) {
            ?>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">


                                <a href="javascript:void(0)" onclick="student_select_items('<?php echo $packlist['id']; ?>', '<?php echo $packlist['student_id']; ?>');">
                                    <span class="label label-info pull-right" style="background-color: #0070A0;">select </span>
                                </a>
                                <b><?php echo $packlist['student_name']; ?></b>

                            </div>

                            <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                <div><?php echo $packlist['delivery_number']; ?></div>
                                <span class="label label-warning pull-left"><?php echo CURRENCY  ?> <?php echo $packlist['final_pay_amount']; ?></span>
                                <div class="stat-percent font-bold text-info"><?php echo $packlist['billing_code']; ?></div>

                            </div>
                        </div>
                    </div>

            <?php
                    if ($i == 2) {
                        echo '<div class="clearfix"></div>';
                        $i = 0;
                    } else {
                        $i++;
                    }
                }
            }
            ?>
        </div>
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <div class="col-lg-12" id="item-replace-container">

        </div>
        <div class="col-lg-12" id="item-data-container">

        </div>
    </div>
</div>
<!--</div>-->
<!--</div>-->

<script>
    function student_select_items(packet_id, student_id) {
        bill_detail_delivery(student_id);
        select_items_delivery(packet_id);
    }

    function select_items_delivery(id) {
        var ops_url = baseurl + 'substore/delivery-pack-details';
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
                "packid": id
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

    function bill_detail_delivery(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'sales/show-studentdelivery/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html('');
                        $('#data-view').html(data.view);
                        $('html, body').animate({
                            scrollTop: $("#data-view").offset().top
                        }, 1000);
                    }

                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    function select_items(id) {
        var ops_url = baseurl + 'substore/delivery-pack-details';
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
                "packid": id
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




    function search_item() {
        var search_item = $("#searchitem").val();
        var store_id = $("#store_idd").val();

        var ops_url = baseurl + 'substore/search-item';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "search_item": search_item,
                "store_id": store_id
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
            height: '610px'
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
            //            {"width": "10%", className: "capitalize", "targets": 4},
            //            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
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
<style>
    ::placeholder {
        color: black;
        opacity: 1;
        /* Firefox */
    }

    :-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        color: black;
    }

    ::-ms-input-placeholder {
        /* Microsoft Edge */
        color: black;
    }
</style>
</body>

</html>