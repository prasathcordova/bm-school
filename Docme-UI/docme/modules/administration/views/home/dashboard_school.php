<style>
    .overlay {
        background-color: #cbcdd1;
        opacity: 0.6;
        width: 96%;
        height: 93%;
        position: absolute;
        top: 0;
        left: 15px;
        z-index: 3;
        text-align: center;
        padding: 35%;
        font-size: 20px;
        color: black;
    }
</style>

<div class="wrapper wrapper-content">
    <div class="row">
        <!--            <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Today</span>
                                <h5>Incomplete Registration</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo (isset($stud_pending_reg[0]['stud_reg_count']) && !empty($stud_pending_reg[0]['stud_reg_count'])) ? $stud_pending_reg[0]['stud_reg_count'] : '0'; ?></h1>
                                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                <small>Total views</small>
                            </div>
                        </div>
                    </div>-->
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content" style="height: 135px;">
                    <h5 class="m-b-md">CURRENT ACADEMIC YEAR</h5>
                    <h2 class="text-navy">
                        <?php echo (isset($acd_year_desc) && !empty($acd_year_desc)) ? $acd_year_desc : '0'; ?>
                    </h2>
                    <small>
                        Start Date : <?php echo date('d-m-Y', strtotime($this->session->userdata('acd_year_start'))) ?> <br />
                        End Date : <?php echo date('d-m-Y', strtotime($this->session->userdata('acd_year_end'))) ?>
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content" style="height: 135px;">
                    <h5 class="m-b-md">CLASSES</h5>
                    <h2 class="text-navy">
                        <?php echo (isset($course_count) && !empty($course_count)) ? $course_count : '0'; ?>
                    </h2>
                    <small>Active Classes available for registrations in current academic year</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content" style="height: 135px;">
                    <h5 class="m-b-md">BATCHES</h5>
                    <h2 class="text-navy">
                        <?php echo (isset($batch_count) && !empty($batch_count)) ? $batch_count : '0'; ?>
                    </h2>
                    <small>Active batches available for students in current academic year</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content" style="height: 135px;">
                    <h5 class="m-b-md">ONLINE REGISTRATIONS</h5>
                    <h2 class="text-navy">
                        <?php echo (isset($online_reg_count) && !empty($online_reg_count)) ? $online_reg_count : '0'; ?>
                    </h2>
                    <small>Online registrations in current academic year</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content" style="height: 135px;">
                    <h5 class="m-b-md">OFFICIAL STUDENTS</h5>
                    <h2 class="text-navy">
                        <?php echo (isset($student_count[0]['students_count']) && !empty($student_count[0]['students_count'])) ? $student_count[0]['students_count'] : '0'; ?>
                    </h2>
                    <small>Official Students in current academic year includes Batch not allocated students also</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content" style="height: 135px;">
                    <h5 class="m-b-md">LONG ABSENTEES</h5>
                    <h2 class="text-navy">
                        <?php echo (isset($student_count[0]['longabsent_count']) && !empty($student_count[0]['longabsent_count'])) ? $student_count[0]['longabsent_count'] : '0'; ?>
                    </h2>
                    <small>Long Absentee students in current academic year </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content" style="height: 135px;">
                    <h5 class="m-b-md">TC ISSUED</h5>
                    <h2 class="text-navy">
                        <?php echo (isset($student_count[0]['tc_issued_count']) && !empty($student_count[0]['tc_issued_count'])) ? $student_count[0]['tc_issued_count'] : '0'; ?>
                    </h2>
                    <small>TC issued students in current academic year </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content" style="height: 135px;">
                    <h5 class="m-b-md">BATCH NOT ALLOCATED STUDENTS</h5>
                    <h2 class="text-navy">
                        <?php echo (isset($batch_not_allocated_students_count) && !empty($batch_not_allocated_students_count)) ? $batch_not_allocated_students_count : '0'; ?>
                    </h2>
                    <small>Batch not allocated students in current academic year</small>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-8" id="fee_data">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Class Wise Strength</h5>
                </div>
                <div class="ibox-content">
                    <div id="morris-bar-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Strength</h5>
                </div>
                <div class="ibox-content">
                    <div id="morris-donut-chart"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Batch not Allocated Students</h5>
                </div>
                <div class="ibox-content dash_table" style="height:425px;" id="bnl_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_bnl">

                            <thead>
                                <tr>
                                    <th>Admission No.</td>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Task</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($batch_not_allocated_students as $student_data) {
                                ?>
                                    <tr>
                                        <td> <?php echo $student_data['Admn_No']; ?></td>
                                        <td> <?php echo $student_data['student_name']; ?></td>
                                        <td> <?php echo $student_data['Class_Name']; ?></td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="profile_detail('<?php echo $student_data['student_id']; ?>');" data-toggle="tooltip" data-placement="right" title="Update Batch for <?php echo $student_data['student_name']; ?>" data-original-title="<?php echo $student_data['student_name']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Registration not Completed Students</h5>
                </div>
                <div class="ibox-content dash_table" style="height:425px;" id="reg_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_regs">

                        <thead>
                            <tr>
                                <th>Admission No.</td>
                                <th>Student Name</th>
                                <th>Aadhar No. / Unique Identity</th>
                                <th>Task</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($partial_registered_students as $student_data) {
                            ?>
                                <tr>
                                    <td> <?php echo $student_data['Admn_No']; ?></td>
                                    <td> <?php echo $student_data['student_name']; ?></td>
                                    <td> <?php echo $student_data['Adhar_No']; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="edit_profile('<?php echo $student_data['student_id']; ?>');" data-toggle="tooltip" data-placement="right" title="Update Registration for  <?php echo $student_data['student_name']; ?>" data-original-title="<?php echo $student_data['student_name']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" id="fee_data">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>CLASS WISE FEE DEMANDED DETAILS</h5>
                </div>
                <div class="ibox-content">
                    <div id="morris-bar-chart-fee-details"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.dash_table').slimScroll({
        height: '425px',
        railOpacity: 0.6,
        railWidth: '1px',
    });
    $(document).ready(function() {
        Morris.Donut({
            element: 'morris-donut-chart',
            data: [{
                    label: "Students in Roll",
                    value: <?php echo (isset($student_count[0]['students_count']) && !empty($student_count[0]['students_count'])) ? $student_count[0]['students_count'] - $batch_not_allocated_students_count : '0'; ?>
                },
                {
                    label: "Long Absentees",
                    value: <?php echo (isset($student_count[0]['longabsent_count']) && !empty($student_count[0]['longabsent_count'])) ? $student_count[0]['longabsent_count'] : '0'; ?>
                },
                {
                    label: "Batch not Allocated",
                    value: <?php echo $batch_not_allocated_students_count ?>
                }
            ],
            resize: true,
            colors: ['#1ab394', '#f78205', '#e60721'],
        });

        Morris.Bar({
            element: 'morris-bar-chart',
            data: <?php echo $class_wise_strength_json ?>,
            xkey: 'c',
            ykeys: ['a', 'l'],
            labels: ['Official', 'Long Absentee'],
            hideHover: 'auto',
            resize: true,
            barColors: ['#1ab394', '#f78205'],
            yLabelFormat: function(y) {
                return y.toFixed(0);
            }
        });
        <?php if (!empty($class_wise_fee_demand_details)) { ?>
            Morris.Bar({
                element: 'morris-bar-chart-fee-details',
                data: <?php echo $class_wise_fee_demand_details ?>,
                xkey: 'Class_Name',
                ykeys: ['fee_amount'],
                labels: ['Demanded Amount'],
                hideHover: 'auto',
                //resize: true,
                barSize: 35,
                barColors: ['#0c45ad'],
            });
        <?php } ?>

        $('#tbl_bnl').dataTable({
            "lengthMenu": [5, 10, 25],
            "pageLength": 5
        });
        $('#tbl_regs').dataTable({
            "lengthMenu": [5, 10, 25],
            "pageLength": 5
        });

    });



    function edit_profile(studentid) {
        $('#reg_loader').addClass('sk-loading');
        var ops_url = baseurl + 'registration/edit-profile';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid
            },
            success: function(result) {
                var data = JSON.parse(result)
                //                  alert(data.status);return;
                if (data.status == 1) {
                    //                     da alert('hi');return;

                    $('#content').html('');
                    $('#content').html(data.view);
                    var animation = "fadeInDown";
                    $("#content").show();
                    $('#content').addClass('animated');
                    $('#content').addClass(animation);
                    //                    $('#country_select').trigger('change')
                    //                    $('#add_type').hide();
                } else {
                    $('#reg_loader').removeClass('sk-loading');
                    alert('No data loaded');
                }
            }
        });
    }

    function profile_detail(studentid) {
        $('#bnl_loader').addClass('sk-loading');
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'profilestudent/show-studentprofile/';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(data) {
                $('#content').html('');
                $('#content').html(data);
                $('html, body').animate({
                    scrollTop: $("#content").offset().top - 50
                }, 1000);
            }
        });
    }
</script>