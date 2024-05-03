<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--style="box-shadow: none;"-->
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "Blacklist/Release" ?></h5>
                </div>
                <div class="ibox-content" id="reconcile_loader">

                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div id="advanced_search" class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover margin bottom" id="available_students_for_release">
                                    <thead>
                                        <tr>
                                            <th width="20%">Student Name</th>
                                            <th width="10%">Admission No.</th>
                                            <th width="30%">Batch</th>
                                            <th width="10%">Bounced</th>
                                            <th width="10%">Release</th>
                                            <th width="15%">Current <br>Active Bounces</th>
                                            <th width="5%" class="text-center">Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($black_listed_students) && !empty($black_listed_students)) {

                                            foreach ($black_listed_students as $students) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $students['student_name'] ?></td>
                                                    <td><?php echo $students['Admn_No'] ?></td>
                                                    <td><?php echo $students['Batch_Name'] ?></td>
                                                    <td class="text-center"><?php echo $students['bounce_count'] ?></td>
                                                    <td class="text-center"><?php echo $students['released_count'] ?></td>
                                                    <td class="text-center"><?php echo $students['active_bounce_count'] ?></td>
                                                    <td class="text-center"><a href="javascript:void(0)" onclick="release_student('<?php echo $students['student_id'] ?>','<?php echo $students['student_name'] ?>', this);" title="Release Student"><i class="fa fa-paper-plane"></i></a></td>
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

                    <div class="row" id="student-data-container"></div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var table2 = $('#available_students_for_release').dataTable({
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
    });

    function release_student(id, student_name, element) {
        swal({
                title: "Release from blacklist",
                text: "Are you sure you want to release the student " + student_name + ' from blacklist?',
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Release",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(state) {
                if (state) {
                    swal({
                        title: "Release from blacklist",
                        text: "Enter the remark for releasing the student from blacklist.The remark is mandatory.",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "Release",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        type: "input",
                        inputPlaceholder: "Remark is mandatory with more than two characters"
                    }, function(isConfirm) {
                        if (isConfirm) {

                            if (isConfirm.length > 2) {
                                var release_state = release_student_from_blacklist(id, isConfirm);
                                if (release_state.status == 1) {
                                    swal("", "The student, " + student_name + " is released from blacklist.", "success");
                                    load_cheque_reconciliation();
                                    return false;
                                } else {
                                    swal("Blacklist Release Failed", "The student," + student_name + " is failed to release from blacklit. Please contact administrator for further assistance", "info");
                                    return false;
                                }
                            } else {
                                $('.sweet-alert input[type=text]').attr('placeholder', 'Remarks should contain more than 2 characters').val('').css('font-weight', 'bold').focus();
                            }
                        } else {
                            $('.sweet-alert input[type=text]').attr('placeholder', 'Enter Remark').val('').css('font-weight', 'bold').focus();
                        }

                    });

                    // function (isConfirm) {
                    //     if (isConfirm && isConfirm.length > 2) {
                    //         var release_state = release_student_from_blacklist(id, isConfirm);
                    //         if (release_state.status == 1) {
                    //             swal("", "The student, " + student_name + " is released from blacklist.", "success");
                    //             load_cheque_reconciliation();
                    //             return false;
                    //         } else {
                    //             swal("Blacklist Release Failed", "The student," + student_name + " is failed to release from blacklit. Please contact administrator for further assistance", "info");
                    //             return false;
                    //         }
                    //     } else {
                    //         swal("", "Enter remarks and try again", "info");
                    //     }

                    // });
                } else {
                    return false;
                }

            });
    }

    function release_student_from_blacklist(id, remarks) {
        var status = 0;
        var data;
        var ops_url = baseurl + 'fees/release-blacklisted-student';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": id,
                "remarks": remarks
            },
            success: function(result) {
                data = JSON.parse(result)
                if (data.status == 1) {
                    status = 1;
                } else {
                    status = 0;
                }
            }
        });
        if (status == 1) {
            return data
        } else {
            return false;
        }
    }
</script>