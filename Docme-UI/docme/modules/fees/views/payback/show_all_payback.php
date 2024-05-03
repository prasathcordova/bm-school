<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom: solid 2px #eee;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new payback request" data-placement="left" href="javascript:void(0)" onclick="load_payback_request();"><i class="fa fa-plus"></i> NEW PAYBACK REQUEST</a>
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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="table_payback_list">
                                    <thead>
                                        <tr>
                                            <th>Admission No.</th>
                                            <th>Student Name</th>
                                            <!-- <th>Batch</th> -->
                                            <th>Request Date</th>
                                            <th>Remarks</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($payback_data) && !empty($payback_data)) {
                                            foreach ($payback_data as $payback) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $payback['Admn_No'] ?></td>
                                                    <td><?php echo $payback['student_name'] ?></td>
                                                    <!-- <td><?php echo $payback['Batch_Name'] ?></td> -->
                                                    <td><?php echo date('d-m-Y', strtotime($payback['payback_request_date'])); ?></td>
                                                    <td title="<?php echo $payback['comment']; ?>"><?php echo substr($payback['comment'], 0, 20); ?></td>
                                                    <td align="right"><?php echo my_money_format($payback['trans_amount']) ?></td>

                                                    <td data-search="<?php echo $payback['status_desc']; ?>" data-order="<?php echo $payback['status_desc']; ?>">
                                                        <?php
                                                        if ($payback['status_id'] == 1) {
                                                            $lbl = 'label-info';
                                                        } else if ($payback['status_id'] == 4) {
                                                            $lbl = 'label-warning';
                                                        } else if ($payback['status_id'] == 3) {
                                                            $lbl = 'label-success';
                                                        } else {
                                                            $lbl = 'label-info';
                                                        }
                                                        echo '<span class="label ' . $lbl . '">' . $payback['status_desc'] . '</span>';
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($payback['status_id'] == 1 || $payback['status_id'] == 2) { ?>

                                                            <!--<a href="javascript:void(0);" onclick="delete_payback('<?php echo $payback['master_id']; ?>');"  data-toggle="tooltip" data-placement="right" title="Remove Payback" data-original-title=""  ><i class="fa fa-times" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>-->
                                                            <a href="javascript:void(0);" onclick="approve_payback('<?php echo $payback['master_id']; ?>');" data-toggle="tooltip" data-placement="right" title="Approve Payback" data-original-title=""><i class="fa fa-send-o" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>

                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);" onclick="view_payback('<?php echo $payback['master_id']; ?>');" data-toggle="tooltip" data-placement="right" title="View Payback" data-original-title=""><i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>
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
</div>
<script type="text/javascript">
    var table = $('#table_payback_list').dataTable({
        responsive: false,
        stateSave: false,
        "lengthMenu": [
            [10, 100, 250, 500, -1],
            [10, 100, 250, 500, "All"]
        ],
        iDisplayLength: 10,
        "bFilter": true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],

    });

    function load_payback_request() {
        var ops_url = baseurl + 'payback/show-filter-student-payback/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
                $(window).scrollTop(0);
            }
        });
    }

    function approve_payback(master_id) {
        var ops_url = baseurl + 'payback/show-payback-approval/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "master_id": master_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    $(window).scrollTop(0);
                } else {
                    swal('', 'There is no data associated with this payback', 'info')
                    return false;
                }

            }
        });
    }

    function view_payback(master_id) {
        var ops_url = baseurl + 'payback/view-payback/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "master_id": master_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    $(window).scrollTop(0);
                } else {
                    swal('', 'There is no data associated with this payback', 'info')
                    return false;
                }

            }
        });
    }
</script>