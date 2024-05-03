<?php
$acdstartdate = $_SESSION['acd_year_start'];
$acdenddate = $_SESSION['acd_year_end'];
$concessiontype = (isset($concession_type) ? $concession_type : 1);
?>
<div class=" animated fadeInDown" id="tbl_id" style="">
    <!--<div class="col-sm-12">-->
    <div class="ibox ">
        <div class="ibox-title">
            <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
            <div class="ibox-tools">
                <a href="javascript:void(0)" onclick="load_student_priority_concession()"> <i style="font-size: 22px !important;  float: right;color: #23C6C5;" class="fa fa-backward" data-toggle="tooltip" title="Back"></i></a>
            </div>
        </div>
        <div class="ibox-content" id="student_code_loader">
            <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>
            <div class="row clearfix">

                <div class="col-lg-6">
                    <div class="form-group <?php
                                            if (form_error('priority_id')) {
                                                echo 'has-error';
                                            } ?>">
                        <select name="priority_select" id="priority_select" class="form-control" onchange="view_students();" style="width:100%;">
                            <option selected value="-1">Select Priority</option>
                            <?php
                            if (isset($priority_data) && !empty($priority_data)) {
                                foreach ($priority_data as $priority) {
                            ?>
                                    <option value="<?php echo $priority['priority_number']; ?>" <?php echo set_select('priority_select',  $priority['priority_number'], isset($priority_number) && $priority_number == $priority['priority_number'] ? TRUE : FALSE) ?>>Priority - <?php echo $priority['priority_number']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('priority_id', '<div class="form-error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <select name="concession_type" id="concession_type" class="form-control" onchange="view_students();" style="width:100%;">
                            <option value="1" <?php if ($concessiontype == 1) echo "selected=selected"; ?>>Family Concession</option>
                            <!-- <option value="2" <?php if ($concessiontype == 2) echo "selected=selected"; ?>>Staff Concession</option> -->
                        </select>
                        <?php echo form_error('priority_id', '<div class="form-error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTables-example" id="tbl_student" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width="3%">#</th>
                                    <th width="37%">Student Name</th>
                                    <th width="20%">Admission No.</th>
                                    <th width="20%">Batch</th>
                                    <th width="17%">Class</th>
                                    <th width="3%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //print_r($priority_students);
                                $c = 1;
                                if (isset($priority_students) && !empty($priority_students) && is_array($priority_students)) {
                                    foreach ($priority_students as $student) {
                                ?>
                                        <tr>
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $student['StudentName']; ?></td>
                                            <td><?php echo $student['Admn_no']; ?></td>
                                            <td><?php echo $student['Batch']; ?></td>
                                            <td><?php echo $student['Class']; ?></td>
                                            <td><?php echo $student['StatusFlag']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center font-bold">No Students With This Priority</td>
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
    $(document).ready(function() {


        $('#datepicker').datepicker({
            minViewMode: 1,
            autoclose: true,
            format: "MM - yyyy",
            startDate: '<?php echo date('M/Y', strtotime($acdstartdate)); ?>',
            endDate: '<?php echo date('M/Y', strtotime($acdenddate)); ?>'

        });


        //     
        //$('#datepicker').datepicker({
        //    format: "mm/yyyy",
        //    startView: "year", 
        //    minViewMode: "months"
        //})

        $("#close_table").click(function() {

            $("#tbl_id").slideUp();
        });
        var table = $('#tbl_student').dataTable({

            responsive: false,
            bPaginate: true,
            stateSave: false,
            showNEntries: false,
            lengthChange: true,
            iDisplayLength: 100,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [],
            "aaSorting": [],
            "fnDrawCallback": function(ele) {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            }

        });
    });

    $('#priority_select,#concession_type').select2({
        'theme': 'bootstrap'
    });

    function view_students() {
        var ops_url = baseurl + 'fees/get_priority_students/';
        var priority_number = $('#priority_select :selected').val();
        var concession_type = $('#concession_type :selected').val();

        if (priority_number == -1) {
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "priority_number": priority_number,
                "concession_type": concession_type
            },
            success: function(result) {
                $('#data-view').html(result);
                $(window).scrollTop(0);
            }
        });
    }
</script>