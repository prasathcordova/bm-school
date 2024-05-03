<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container" style="padding-top:0px !important;">

                        <div class="row" id="data-view-feecode">
                            <div class="ibox-content" id="item_list_detail">
                                <div class="row" id="">

                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                STUDENTS ALLOCATED WITH PERIODIC FEE TEMPLATE <?php echo strtoupper($template_name); ?>
                                                <a class="pull-right" href="javascript:void(0)" title="Back" onclick="load_fee_student_allotment_list();"> <i class="fa fa-backward"></i></a>
                                            </div>
                                            <div class="panel-body">
                                                <div class=" animated fadeInDown" id="tbl_id">
                                                    <h3>Student List</h3>
                                                    <div class="table-responsive">
                                                        <div class="">
                                                            <table class="table table-hover dataTables-example" id="tbl_student" style="width:100%;">
                                                                <thead>
                                                                    <tr>

                                                                        <th>Student Name</th>
                                                                        <th>Admission Number</th>
                                                                        <th>Class</th>
                                                                        <th>Batch</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if (isset($student_data) && !empty($student_data) && is_array($student_data)) {
                                                                        $student_id = 0;
                                                                        $flag = 1;
                                                                        foreach ($student_data as $student) {

                                                                            if ($student_id == $student['student_id']) {
                                                                                $flag = $flag + 1;
                                                                            } else {
                                                                                $flag = 1;
                                                                            }
                                                                            $student_id = $student['student_id'];
                                                                    ?>

                                                                            <tr>
                                                                                <td>
                                                                                    <b title="Student Name">
                                                                                        <?php echo $student['student_name']; ?>
                                                                                    </b>
                                                                                </td>
                                                                                <td>

                                                                                    <p title="Student Admission Number">
                                                                                        <?php echo $student['Admn_No']; ?>
                                                                                    </p>
                                                                                </td>
                                                                                <td data-toggle="tooltip" title="Class"><?php echo $student['class_description']; ?></td>
                                                                                <td>
                                                                                    <div title="Batch" class="label label-warning"> <?php echo $student['Batch_Name']; ?></div>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var table = $('#tbl_student').dataTable({

        columnDefs: [{
                "width": "40%",
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
            }, //, "orderable": false
            {
                "width": "20%",
                className: "capitalize",
                "targets": 3
            } //, "orderable": false
        ],
        "aaSorting": [],

        bPaginate: true,
        //        stateSave: true,
        "lengthMenu": [
            [250, 500, 750, -1],
            [250, 500, 750, "All"]
        ],
        pageLength: 250,
               dom: '<"html5buttons"B>lTfgitp',
               buttons: [
        
               ],


    });
</script>