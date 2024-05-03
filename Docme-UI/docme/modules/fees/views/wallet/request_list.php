<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom: solid 2px #eee;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id; ?>" />
                    <input type="hidden" name="student_name" id="student_name" value="<?php echo $student_name; ?>" />

                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new withdraw request" data-placement="left" href="javascript:void(0)" onclick="load_withdraw_request();"><i class="fa fa-plus"></i> NEW WITHDRAW REQUEST</a>
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
                        <div class="col-md-6">
                            <div class="profile-image">
                                <?php
                                $profile_image = "";
                                if (!empty(get_student_image($student_data['student_id']))) {
                                    $profile_image = get_student_image($student_data['student_id']);
                                } else
                                if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {

                                    $profile_image = "data:image/jpeg;base64," . $student_data['profile_image'];
                                } else {
                                    if (isset($student_data['profile_image_alternate']) && !empty($student_data['profile_image_alternate'])) {
                                        $profile_image = $student_data['profile_image_alternate'];
                                    } else {
                                        $profile_image = base_url('assets/img/a0.jpg');
                                    }
                                }


                                ?>
                                <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="margin-top: 0px;border-top-width: 0px;" />
                            </div>
                            <div class="profile-info">
                                <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_data['student_id']; ?>" />
                                <input type="hidden" name="student_name" id="student_name" value="<?php echo $student_data['student_name']; ?>" />


                                <div class="">
                                    <div>
                                        <h4><?php echo $student_data['student_name']; ?></h4>
                                        <small>
                                            Admission No. : <?php echo $student_data['Admn_No']; ?>
                                        </small><br>
                                        <small>
                                            Batch : <?php echo $student_data['Batch_Name']; ?>
                                        </small><br>
                                        <small>
                                            Class : <?php echo $student_data['Description']; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Added by SALAHUDHEEN May 29, 2019 : START-->
                        <div class="col-md-6 col-sm-12" style="padding-top:5px; float: right;">
                            <div class="widget lazur-bg no-padding" style="margin-top:0px;">
                                <div class="p-m" style="padding:3px !important; display: inline-block">
                                    <h1 class="m-xs" style="text-align:center"><span class="fa fa-inr" aria-hidden="true" style="color:#FFF "></span> <?php echo isset($e_wallet) && !empty($e_wallet) ? my_money_format($e_wallet) : 0; ?></h1>

                                    <h3 class="font-bold no-margins" style="text-align:center;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                        Docme Wallet
                                        <input type="hidden" name="total_e_wallet_amount" id="total_e_wallet_amount" value="<?php echo $e_wallet; ?>" />
                                    </h3>
                                </div>

                            </div>
                        </div>
                        <!-- Added by SALAHUDHEEN May 29, 2019 : END-->
                        <div class="clearfix"></div>
                        <div class="col-lg-12">
                            <!--<div class="table-responsive">-->
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_payback_list">
                                <thead>
                                    <tr>
                                        <th>Request Date</th>
                                        <th>Comment</th>
                                        <th>Withdraw Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($withdraw_request_data) && !empty($withdraw_request_data)) {
                                        foreach ($withdraw_request_data as $withdraw_data) {
                                    ?>
                                            <tr>
                                                <td><?php echo date('d-m-Y', strtotime($withdraw_data['requested_date'])); ?></td>
                                                <td><?php echo $withdraw_data['reason'] ?></td>
                                                <td align="right"><?php echo my_money_format($withdraw_data['amount']) ?></td>
                                                <td data-search="<?php echo $withdraw_data['status_desc']; ?>" data-order="<?php echo $withdraw_data['status_desc']; ?>">
                                                    <?php
                                                    if ($withdraw_data['status_id'] == 1) {
                                                        echo '<span class="label label-info">' . $withdraw_data['status_desc'] . '</span>';
                                                    } else if ($withdraw_data['status_id'] == 2) {
                                                        echo '<span class="label label-success">' . $withdraw_data['status_desc'] . '</span>';
                                                    } else if ($withdraw_data['status_id'] == 3) {
                                                        echo '<span class="label label-warning">' . $withdraw_data['status_desc'] . '</span>';
                                                    } else {
                                                        echo '<span class="label label-info">' . $withdraw_data['status_desc'] . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if ($withdraw_data['status_id'] == 1) { ?>
                                                        <!--<a href="javascript:void(0);" onclick="edit_withdraw('<?php echo $withdraw_data['id']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit withdraw" data-original-title=""  ><i class="fa fa-pencil" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>-->
                                                        <a href="javascript:void(0);" onclick="approve_withdraw('<?php echo $withdraw_data['id']; ?>');" data-toggle="tooltip" data-placement="right" title="Approve withdraw" data-original-title=""><i class="fa fa-send-o" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>
                                                    <?php } else if ($withdraw_data['status_id'] == 2) { ?>
                                                        <a href="javascript:void(0);" onclick="encash_withdrawal('<?php echo $withdraw_data['id']; ?>');" data-toggle="tooltip" data-placement="right" title="View withdraw" data-original-title=""><i class="fa fa-money" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>

                                                    <?php } else if ($withdraw_data['status_id'] == 3) { ?>
                                                        <a href="javascript:void(0);" onclick="view_withdraw('<?php echo $withdraw_data['id']; ?>');" data-toggle="tooltip" data-placement="right" title="View withdraw" data-original-title=""><i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>

                                                    <?php } else if ($withdraw_data['status_id'] == 4 || $withdraw_data['status_id'] == 5) { ?>
                                                        <a href="javascript:void(0);" onclick="view_withdraw('<?php echo $withdraw_data['id']; ?>');" data-toggle="tooltip" data-placement="right" title="View withdraw" data-original-title=""><i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>
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

    function load_withdraw_request() {
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/create-new-request-to-withdraw/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id,
                "student_name": student_name
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    $(window).scrollTop(0);
                } else {
                    swal('', 'An error encountered. Please contact administrator for further assistance.', 'info');
                    return false;
                }

            }
        });
    }

    function approve_withdraw(masterid) {
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/show-approve-withdraw-request/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id,
                "student_name": student_name,
                "masterid": masterid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    $(window).scrollTop(0);
                } else {
                    swal('', 'An error encountered. Please contact administrator for further assistance.', 'info');
                    return false;
                }

            }
        });
    }

    function view_withdraw(masterid) {
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/view-withdraw-request/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id,
                "student_name": student_name,
                "masterid": masterid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    $(window).scrollTop(0);
                } else {
                    swal('', 'An error encountered. Please contact administrator for further assistance.', 'info');
                    return false;
                }

            }
        });
    }

    function encash_withdrawal(masterid) {
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/show-encashment-for-withdraw/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id,
                "student_name": student_name,
                "masterid": masterid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    $(window).scrollTop(0);
                } else {
                    swal('', 'An error encountered. Please contact administrator for further assistance.', 'info');
                    return false;
                }

            }
        });
    }
</script>