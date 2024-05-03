<div class=" animated fadeInDown" id="tbl_id" style="">
    <div class="table-responsive">
        <div>
            <table class="table table-hover dataTables-example" id="tbl_student" style="width:100%;">


                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Admission Number</th>
                        <th>Kit No</th>
                        <th>Task</th>
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
                                        <input title="Select to remove openhouse" data-open_house_id="<?php echo $student['open_house_id'] ?>" data-template_id="<?php echo $student['template_id'] ?>" data-sale_pack_id="<?php echo $student['sale_pack_id'] ?>" data-student_id="<?php echo $student['student_id'] ?>" class="student_selector" type="checkbox" />
                                    <?php
                                    } else {
                                    ?>
                                        <div title="Cannot remove,openhouse already billed" class="label label-warning"> Billed</div>
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
    $('.student_selector').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });


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

        bPaginate: false,
        stateSave: true,

        iDisplayLength: 100,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                text: 'SELECT ALL',
                action: function(e, dt, node, config) {

                    $('.student_selector').iCheck('check');
                    $('.student_selector').iCheck('update');

                }
            },
            {
                text: 'DESELECT ALL',
                action: function(e, dt, node, config) {

                    $('.student_selector').iCheck('uncheck');
                    $('.student_selector').iCheck('update');

                }
            }


        ],
        "fnDrawCallback": function(ele) {
            $('.student_selector').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }

    });
</script>