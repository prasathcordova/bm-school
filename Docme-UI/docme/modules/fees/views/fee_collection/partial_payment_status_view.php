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
            <div class="col-lg-12">
                <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id; ?>">
                <table id="registration_fees_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <th>Temp.Admn No.</th>
                            <th>Student Name</th>
                            <th>Parent Name</th>
                            <th>Class</th>
                            <th>Registration Fees</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $breaker = 0;

                        if (isset($class_fee_data) && !empty($class_fee_data)) {
                            foreach ($class_fee_data as $data) {
                                if ($data['payment_status'] != 1) {
                        ?>
                                    <tr>
                                        <td><?php echo $data['TempAdmn_No']; ?></td>
                                        <td><?php echo $data['fname'] . ' ' . $data['lname']; ?></td>
                                        <td><?php echo $data['parentName'] ?></td>
                                        <td><?php echo $data['Description'] ?></td>
                                        <td align="right">&#8377 <?php echo $data['registration_fees'] ?></td>
                                        <td>
                                            <?php if ($data['payment_status'] == 2) { ?>
                                                Payment Failed
                                            <?php } else { ?>
                                                Pay At School
                                            <?php } ?>
                                        </td>
                                        <td align="center">
                                            <input type="hidden" name="temp_student_name_<?php echo $data['TempReg_ID'] ?>" id="temp_student_name_<?php echo $data['TempReg_ID'] ?>" value="<?php echo $data['fname'] . ' ' . $data['lname']; ?>">
                                            <input type="hidden" name="temp_parent_name_<?php echo $data['TempReg_ID'] ?>" id="temp_parent_name_<?php echo $data['TempReg_ID'] ?>" value="<?php echo $data['parentName']; ?>">
                                            <input type="hidden" name="temp_reg_fee_<?php echo $data['TempReg_ID'] ?>" id="temp_reg_fee_<?php echo $data['TempReg_ID'] ?>" value="<?php echo $data['registration_fees']; ?>">
                                            <a class="btn btn-primary btn-xs" style="cursor: pointer;" href="javascript:" onclick="do_payments(<?php echo $data['TempReg_ID'] ?>)"><i class="fa fa-money"></i> Collect</a>
                                        </td>
                                    </tr>
                        <?php
                                }
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
            [0, "desc"]
        ],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
        ],
    });

    function do_payments(temp_reg_id) {
        if (temp_reg_id == '') {
            swal('', 'Choose atleast one temporary registration.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var temp_student_name = $('#temp_student_name_' + temp_reg_id).val();
        var temp_parent_name = $('#temp_parent_name_' + temp_reg_id).val();
        var temp_reg_fee = $('#temp_reg_fee_' + temp_reg_id).val();
        var class_id = $('#class_id').val();
        var ops_url = baseurl + 'fees/temp_reg_fee_payment_methods/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "temp_reg_id": temp_reg_id,
                "temp_student_name": temp_student_name,
                "temp_parent_name": temp_parent_name,
                "temp_reg_fee": temp_reg_fee,
                "class_id": class_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('.registration-list').html(data.view);
                } else {
                    swal('', 'No Data Found.', 'success');
                }
            }
        });

    }
</script>