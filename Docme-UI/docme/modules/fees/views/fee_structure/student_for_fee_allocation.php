<?php
$acdstartdate = $_SESSION['acd_year_start'];
$acdenddate = $_SESSION['acd_year_end'];
?>
<div class=" animated fadeInDown" id="tbl_id">
    <!--<div class="col-sm-12">-->
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Student List</h5>
            <div class="ibox-tools">
                <a href="javascript:void(0)" id="close_table" class="pull-right"> <i class="material-icons close" style="color:#E91E63; font-size:30px;opacity: 10;" data-toggle="tooltip" title="Close">close</i></a>
                <span><a href="javascript:void(0)" onclick="allocate_fee_to_student()"> <i style="font-size: 30px !important;  float: right;color: #23C6C5;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b>Fee Activation Month</b>
                    <div class="form-group">
                        <div class="form-line <?php
                                                if (form_error('datepicker')) {
                                                    echo 'has-error';
                                                }
                                                ?> ">
                            <input type="text" class="form-control" id="datepicker" readonly="" style="border-color: #23C6C8;background-color: #FFFFFF;" />
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">



                    <div class="table-responsive">
                        <div class="scroll_content">
                            <table class="table table-hover issue-tracker dataTables-example" id="tbl_student" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th width="20%">Student Name</th>
                                        <th width="20%">Admission No.</th>
                                        <th width="20%">Batch</th>
                                        <th width="10%">Class</th>
                                        <th width="20%">Wallet Balance</th>
                                        <th width="10%">Task</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // dev_export($student_data);
                                    if (isset($student_data) && !empty($student_data) && is_array($student_data)) {
                                        //echo ($student_data[0]['already_in_list']);
                                        $already_list = explode(",", $student_data[0]['already_in_list']);
                                        if (!is_array($already_list)) $already_list = array($already_list);
                                        //print_r($already_list);

                                        foreach ($student_data as $student) {
                                            if (in_array($student['student_id'], $already_list)) {
                                                $chk = 'disabled';
                                                $bgc = 'style = background:#f1f1f1';
                                                $rowtitle = '';
                                            } else {
                                                $chk = '';
                                                $bgc = '';
                                                $rowtitle = '';
                                            }
                                            if (trim($student['StatusFlag']) == 'L') {
                                                $chk = 'disabled';
                                                $bgc = 'style = background:#f1f1f1'; //'style = background:#f5a9ac';
                                                $rowtitle = $student['student_name'] . ' is Long Absentee';
                                            }

                                            $walletbalance = $student['WALLET_BALANCE'];
                                            $wallet_wdraw_request_amt = $student['WALLET_WITHDRAW_REQUEST_AMOUNT'];
                                            $wallet_available = $walletbalance - $wallet_wdraw_request_amt;
                                            $wallet_for_adj = ($wallet_available > 0 ? $wallet_available : 0);
                                    ?>
                                            <tr <?php echo $bgc; ?> title="<?php echo $rowtitle; ?>">
                                                <td title="<?php echo $rowtitle; ?>">
                                                    <b title="Student Name">
                                                        <?php echo $student['student_name']  ?>
                                                    </b>
                                                </td>
                                                <td title="<?php echo $rowtitle; ?>">
                                                    <p title="Student Admission Number">
                                                        <?php echo $student['Admn_No'] ?>
                                                    </p>
                                                </td>
                                                <td title="<?php echo $rowtitle; ?>"> <span title="Batch Name"><?php echo $student['Batch_Name'] ?></span></td>
                                                <td title="<?php echo $rowtitle; ?>"> <span title="Class"><?php echo $student['Class_Name'] ?></span></td>
                                                <td title="<?php echo $rowtitle; ?>" style="text-align:right;"> <span title="Wallet Balance"><?php echo my_money_format($wallet_for_adj); ?></span></td>
                                                <td title="<?php echo $rowtitle; ?>">
                                                    <div class="i-checks pull-left" title="Select/Deselect  <?php echo $student['student_name'] ?>"><label> <input class="student_selector" data-toggle="tooltip" data-placement="right" data-batch_id="<?php echo $student['batch_id'] ?>" data-class_id="<?php echo $student['class_id'] ?>" data-student_id="<?php echo $student['student_id'] ?>" data-studentname="<?php echo $student['student_name']; ?>" data-admissionnumber="<?php echo $student['Admn_No']; ?>" data-walletbalance="<?php echo $wallet_for_adj; ?>" data-pendingpayment="<?php echo $student['PENDING_PAYMENT']; ?>" title="Confirm item" data-original-title="" id="<?php echo $student['student_id'] ?>" type="checkbox" value="" <?php echo $chk; ?>> <i></i> </label></div>
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

            columnDefs: [{
                    "width": "30%",
                    className: "capitalize",
                    "targets": 0
                },
                {
                    "width": "15%",
                    className: "capitalize",
                    "targets": 1
                },
                {
                    "width": "25%",
                    className: "capitalize",
                    "targets": 2
                },
                {
                    "width": "20%",
                    className: "capitalize",
                    "targets": 3,
                },
                {
                    "width": "10%",
                    className: "capitalize",
                    "targets": 4,
                    "orderable": false
                }
            ],
            responsive: false,
            bPaginate: false,
            stateSave: false,
            showNEntries: false,
            lengthChange: false,
            //            iDisplayLength: 100,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    text: 'SELECT ALL',
                    action: function(e, dt, node, config) {

                        $('.student_selector').not(":disabled").iCheck('check');
                        $('.student_selector').iCheck('update');

                    }
                },
                {
                    text: 'DESELECT ALL',
                    action: function(e, dt, node, config) {

                        $('.student_selector').iCheck('uncheck');
                        $('.student_selector').iCheck('update');

                    }
                },
            ],
            "fnDrawCallback": function(ele) {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            }

        });
    });
</script>