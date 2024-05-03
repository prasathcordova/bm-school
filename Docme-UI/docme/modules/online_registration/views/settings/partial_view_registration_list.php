<div class="ibox-title" style="border-bottom-color:#23C6C8!important">
    <h5 style="color: #1c84c6;">Temporary Registration List</h5>
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
            <div class="col-lg-12 col-md-12 col-xs-12" style="text-align: right">
                <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="allocate_payment();" title="Allocate Payment"><i class="fa fa-credit-card"></i> Allocate Payment</a>
                <!--<a class="btn btn-danger btn-sm" onclick="canceldata();"> Cancel</a>-->
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12" style="text-align: left">
                <br />
                <b>** While doing allocation emails will be send to each parent's communication email id.</b>
                <br /><br />
            </div>
            <div class="col-lg-12">
                <table id="registration_fees_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <th>Temp.Admn No.</th>
                            <th>Student Name</th>
                            <th>Parent Name</th>
                            <th>Registration Fees</th>
                            <th>Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $breaker = 0;
                        if (isset($class_fee_data) && !empty($class_fee_data)) {
                            foreach ($class_fee_data as $data) {
                        ?>
                                <tr>
                                    <td><?php echo $data['TempAdmn_No']; ?></td>
                                    <td><?php echo $data['fname'] . ' ' . $data['lname']; ?></td>
                                    <td><?php echo $data['parentName'] ?></td>
                                    <td align="right">&#8377 <?php echo $data['registration_fees'] ?></td>
                                    <td>
                                        <div class="col-sm-6 i-checks">
                                            <label>
                                                <input type="checkbox" class="temp_registration" value="<?php echo $data['TempReg_ID'] ?>">
                                            </label>
                                        </div>
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
<script type="text/javascript">
    var table = $('#registration_fees_tbl').dataTable({
        // columnDefs: [{
        //     "width": "100%",
        //     "targets": 0
        // }, ],
        responsive: false,
        //iDisplayLength: 10,
        "order": [
            [0, "desc"],
        ],
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
            },
        ],
    });

    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    function allocate_payment() {
        var checked_temp_ids = '';
        $(".temp_registration:checked").each(function() {
            if (checked_temp_ids == '')
                checked_temp_ids = $(this).val();
            else
                checked_temp_ids = checked_temp_ids + "," + $(this).val()
            //checked_temp_ids = checked_temp_ids.slice(0, -1);
        });

        if (checked_temp_ids == '') {
            swal('', 'Choose atleast one student.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        swal({
                title: "",
                text: "Payment Allocation cannot be undone , Are you sure to continue?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
            },
            function(isconfirm) {
                if (isconfirm) {
                    var ops_url = baseurl + 'registration/allocate-registration-payments/';
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "load": 1,
                            "checked_temp_ids": checked_temp_ids,
                        },
                        success: function(result) {
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                get_data();
                                // load_payment_allocation()
                            } else {
                                swal('', 'Payment allocation failed,Please try again.', 'error');
                            }
                        }
                    });
                }
            }
        );


    }
</script>