<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="show_approve_request_list();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>

                    </div>
                </div>
                <div class="ibox-content" id="pay_loader">
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
                            <div class="col-md-6">
                                <div class="profile-image">
                                    <?php
                                    $profile_image = "";
                                    if (!empty(get_student_image($payback_data['student_id']))) {
                                        $profile_image = get_student_image($payback_data['student_id']);
                                    } else
                                    if (isset($payback_data['profile_image']) && !empty($payback_data['profile_image'])) {

                                        $profile_image = "data:image/jpeg;base64," . $payback_data['profile_image'];
                                    } else {
                                        if (isset($payback_data['profile_image_alternate']) && !empty($payback_data['profile_image_alternate'])) {
                                            $profile_image = $payback_data['profile_image_alternate'];
                                        } else {
                                            $profile_image = base_url('assets/img/a0.jpg');
                                        }
                                    }


                                    ?>
                                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="margin-top: 0px;border-top-width: 0px;" />
                                </div>
                                <div class="profile-info">
                                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $payback_data['student_id']; ?>" />
                                    <input type="hidden" name="student_name" id="student_name" value="<?php echo $payback_data['student_name']; ?>" />
                                    <input type="hidden" name="master_id" id="master_id" value="<?php echo $master_id; ?>" />


                                    <div class="">
                                        <div>
                                            <h4><?php echo $payback_data['student_name']; ?></h4>
                                            <small>
                                                Admission No. : <?php echo $payback_data['Admn_No']; ?>
                                            </small><br>
                                            <small>
                                                Batch : <?php echo $payback_data['Batch_Name']; ?>
                                            </small><br>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="ibox-content" style=" padding-right: 1%;" id="fees_summary">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <b>Total Payback Amount</b>
                                            <div class="form-group">
                                                <div class="form-line <?php
                                                                        if (form_error('total_amt_payback')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" maxlength="20" style="background-color: #FFFFFF" readonly="" class="form-control allownumericwithdecimal" name="total_amt_payback" id="total_amt_payback" value="<?php echo set_value('total_amt_payback', isset($payback_data['total_transaction_amount']) ? my_money_format($payback_data['total_transaction_amount']) : '0'); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Reason to Payback</b>
                                            <div class="form-group">
                                                <div class="form-line <?php
                                                                        if (form_error('reason')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" readonly="" style="background-color: #FFFFFF" readonly="" maxlength="200" class="form-control" name="reason" id="reason" value="<?php echo set_value('reason', isset($payback_data['reason']) ? $payback_data['reason'] : ''); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Status of Payback Request</b>
                                            <div class="form-group">
                                                <div class="form-line <?php
                                                                        if (form_error('status')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" readonly="" style="background-color: #FFFFFF" readonly="" maxlength="200" class="form-control" name="status" id="status" value="<?php echo set_value('reason', isset($payback_data['is_approved']) && $payback_data['is_approved'] == 1 ? 'Approved' : 'Rejected'); ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <b>Comments</b>
                                            <div class="form-group">

                                                <input type="text" readonly="" style="background-color: #FFFFFF" class="form-control text-uppercase" name="approval_c" id="approval_c" value="<?php echo set_value('approval_c', isset($payback_data['approve_comments']) ? $payback_data['approve_comments'] : 'NA'); ?>" />

                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-12">
                                            <!--<div class="table-responsive">-->
                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_payback_detail_list">
                                                <thead>
                                                    <tr>
                                                        <th>Fee Code</th>
                                                        <th>Fee Description</th>
                                                        <th>Details</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($payback_detail_data) && !empty($payback_detail_data)) {
                                                        foreach ($payback_detail_data as $payback) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $payback['FEECODE'] ?></td>
                                                                <td><?php echo $payback['FEE_CODE_DESC'] ?></td>
                                                                <td><?php echo $payback['ACCOUNT_DESC'] ?></td>
                                                                <td align="right"><?php echo my_money_format($payback['transaction_amount']) ?></td>

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
        </div>
    </div>
</div>
<input type="hidden" name="minimum_wallet_amt" id="minimum_wallet_amt" value="10" />
<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    var table = $('#table_payback_detail_list').dataTable({
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




    function show_approve_request_list() {

        var ops_url = baseurl + 'payback/show-payback-list';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {

                $('#data-view').html('');
                $('#data-view').html(result);
                $('html, body').animate({
                    scrollTop: 0
                }, 1000);


            }
        });
    }
</script>