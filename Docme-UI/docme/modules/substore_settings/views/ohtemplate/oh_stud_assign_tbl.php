<div class=" animated fadeInDown" id="tbl_id" style="">
    <!--<div class="col-sm-12">-->
    <div class="ibox " >
        <div class="ibox-title">
            <h5>Student List</h5>
            <div class="ibox-tools">
                <a href="javascript:void(0)" id="close_table" class="pull-right"> <i class="material-icons close" style="color:#E91E63; font-size:30px;opacity: 10;" data-toggle="tooltip" title="Close">close</i></a>
                <span><a href="javascript:void(0)"  onclick="save_data()" > <i style="font-size: 30px !important;  float: right;color: #23C6C5;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
            </div>
        </div>
        <div class="ibox-content">

            <div class="table-responsive">
                <div class="scroll_content" >
                    <table class="table table-hover issue-tracker dataTables-example" id="tbl_student" style="width:100%;">


                    <thead>
                        <tr>
                                <!--<th>Profile Image</th>-->
                                
                            <th>Student Name</th>
                                <th>Admission No.</th>
                            <th>Batch</th> 
                            <th>Class</th>  
                            <th>Task</th>                                                 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($student_data) && !empty($student_data) && is_array($student_data)) {
                            foreach ($student_data as $student) {
                                ?>
                                <tr>
                                        <td >
                                            <b title="Student Name">
                                                <?php echo $student['student_name'] ?>
                                            </b>
                                        </td>
                                        <td>
                                            <p  title="Student Admission Number">
                                                <?php echo $student['Admn_No'] ?>
                                            </p>
                                        </td>
                                        <td  title="Batch Name" > <?php echo $student['Batch_Name'] ?></td>
                                        <td title="Class" > <?php echo $student['Class_Name'] ?></td>
                                    <td>
                                            <div class="i-checks pull-left" title="Select/Deselect  <?php echo $student['student_name'] ?>"><label> <input class="student_selector" data-toggle="tooltip" data-placement="right" data-batch_id="<?php echo $student['batch_id'] ?>" data-class_id="<?php echo $student['class_id'] ?>" data-student_id="<?php echo $student['student_id'] ?>" title="Confirm item" data-original-title="" id="<?php echo $student['student_id'] ?>" type="checkbox" value=""> <i></i> </label></div>
                                    </td>
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

<script>
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    $('.scroll_content').slimscroll({
        height: '500px',
        color: '#f8ac59'

    })
    $(document).ready(function () {
        $("#close_table").click(function () {

            $("#tbl_id").slideUp();
        });
        var table = $('#tbl_student').dataTable({

            columnDefs: [
                {"width": "30%", className: "capitalize", "targets": 0},
                {"width": "15%", className: "capitalize", "targets": 1},
                {"width": "25%", className: "capitalize", "targets": 2},
                {"width": "20%", className: "capitalize", "targets": 3, },
                {"width": "10%", className: "capitalize", "targets": 4, "orderable": false}
            ],
            responsive: true,
            bPaginate: false,
            stateSave: true,
            showNEntries: false,
            lengthChange: false,
//            iDisplayLength: 100,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {text: 'SELECT ALL',
                    action: function (e, dt, node, config) {
                      
                            $('.student_selector').iCheck('check');
                            $('.student_selector').iCheck('update');
                      
                    }},
                {text: 'DESELECT ALL',
                    action: function (e, dt, node, config) {
                        
                            $('.student_selector').iCheck('uncheck');
                            $('.student_selector').iCheck('update');
                      
                    }},
            ],
            "fnDrawCallback": function (ele) {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            }

        });
    });
</script>