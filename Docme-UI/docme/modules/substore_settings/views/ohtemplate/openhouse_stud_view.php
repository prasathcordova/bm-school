<div class=" animated fadeInDown" id="tbl_id" style="">
    <div class="table-responsive">
        <div class="">
            <table class="table table-hover dataTables-example" id="tbl_student" style="width:100%;">
                <thead>
                    <tr>

                        <th>Student Name</th>
                        <th>Admission Number</th>
                        <th>Kit No</th>
                        <th>Bill Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                        $student_id = 0;
                        $flag = 1;
                        foreach ($details_data as $student) {

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
                                <td data-toggle="tooltip" title="Kit Sl No"><?php echo $student['kit_slno']; ?></td>
                                <td>
                                    <?php if (empty($student['bill_id']) && $student['bill_id'] == 0) { ?>
                                        <div title="Openhouse not billed" class="label label-warning"> Unbilled</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div title="Openhouse already billed" class="label label-warning"> Billed</div>
                                        <!--<input title="Billed" disabled="" class="student_selector" type="checkbox" />-->
                                    <?php
                                    }
                                    ?>
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
<input id="save_button" type="hidden" value="1">
<input id="template_config_id" type="hidden" value="<?php echo $template_config_id ?>">
<input id="template_id" type="hidden" value="<?php echo $template_id ?>">


<script>
    var table = $('#tbl_student').dataTable({

        columnDefs: [{
                "width": "15%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "25%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 2,
                "orderable": false
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3,
                "orderable": false
            }
        ],

        bPaginate: true,
        stateSave: true,
        "lengthMenu": [
            [250, 500, 750, -1],
            [250, 500, 750, "All"]
        ],
        pageLength: 250,

        dom: '<"html5buttons"B>lTfgitp',
        buttons: [

        ],
        "fnDrawCallback": function(ele) {

        }

    });
</script>