<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <!-- <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a New Pickup Point" data-placement="left" href="javascript:void(0)" onclick="add_new_pickuppoint();">ADD NEW Pickup POINT</a>
                    </div> -->
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table id="pickuppoints_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Pickup Point</th>
                                            <th>Pickup Location</th>
                                            <th>Trip</th>
                                            <th>Start Date </th>
                                            <th>One Side Fees </th>
                                            <th>Two Side Fees </th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $breaker = 0;
                                        if (isset($pickup_point_fees_data) && !empty($pickup_point_fees_data)) {
                                            foreach ($pickup_point_fees_data as $data) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $data['pickpointName']; ?></td>
                                                    <td><?php echo $data['pickuppointLocation']; ?></td>
                                                    <td><?php echo $data['trips']; ?></td>
                                                    <td><?php echo ($data['createdOn'] == '') ? 'NA' : date('d-m-Y', strtotime($data['createdOn'])) ?></td>
                                                    <td align="right"><?php echo my_money_format($data['amtPay']) ?></td>
                                                    <td align="right"><?php echo my_money_format($data['amtPay_2']) ?></td>
                                                    <td><a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="update_pickuppoint_fees('<?php echo $data['id']; ?>', '<?php echo $data['pickpointName']; ?>');" data-toggle="tooltip" data-placement="right" title="Update <?php echo $data['pickpointName']; ?>-Fees" data-original-title="<?php echo $data['pickpointName']; ?>"> <i class="fa fa-edit"></i>Update</a></td>
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
    var table = $('#pickuppoints_tbl').dataTable({
        "columns": [
            null,
            null,
            {
                "width": "15%"
            },
            {
                "width": "15%"
            },
            null,
            null,
            null
        ],
        // columnDefs: [{
        //     "width": "100%",
        //     "targets": 0
        // }, ],
        responsive: false,
        //iDisplayLength: 10,
        "ordering": false,
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


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });


    $(".pick_status").change(function() {
        setTimeout(change_status(this), 100);
    });

    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
            });
        }

    }

    function update_pickuppoint_fees(id, pickpointName) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/update-pickuppoint-fees/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "pickpoint_id": id,
                "pickpointName": pickpointName,
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    // $('#month_span_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                    // $('#payment_mode_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                    // $('#feetype_select').select2({
                    //     'theme': 'bootstrap'
                    // });
                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this fee type', 'info');
                    return false;
                }
            }
        });
    }
</script>