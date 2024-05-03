<div class="col-lg-12">
    <div class="row">
        <?php
        if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
            $breaker = 0;
            foreach ($details_data as $student) {
        ?>
                <div class="col-lg-4">
                    <div class="contact-box center-version">
                        <!--<span class="label label-warning pull-right">Official</span>-->
                        <a href="javascript:void(0);" style="height:250px !important;">
                            <?php
                            $profile_image = "";
                            if (!empty(get_student_image($student['student_id']))) {
                                $profile_image = get_student_image($student['student_id']);
                            } else
                            if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                $profile_image = "data:image/jpeg;base64," . $student['profile_image'];
                            } else {
                                if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                    $profile_image = $student['profile_image_alternate'];
                                } else {
                                    $profile_image = base_url('assets/img/a0.jpg');
                                }
                            }
                            if (trim($student['StatusFlag']) == 'L') {
                                $stud_status = '<div class="font-bold font12 text-danger"><b>Long Absentee</b></div>';
                            } else {
                                $stud_status = '<div class="font-bold font12 text-danger"><b>&nbsp;</b></div>';
                            }
                            ?>
                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs"><strong><?php echo $student['student_name'] ?></strong></h3>

                            <div class="font-bold"><b>Admission No. : </b><?php echo $student['Admn_No'] ?></div>
                            <div class="font-bold"><b>Class : </b><?php echo $student['classname'] ?></div>
                            <div class="font-bold"><b>Batch : </b><?php echo $student['batchname'] ?></div>

                        </a>

                        <div class="contact-box-footer">
                            <?php echo $stud_status; ?>
                            <div class="m-t-xs">
                                <div class="row">
                                 <a href="javascript:void(0);" title="Get Individual DCB Report - <?php echo $student['student_name'] ?> " onclick="submit_data('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>',1)" class="btn btn-info btn-md"><i class="fa fa-file-pdf-o"></i> GET Pdf</a>
                                 <a href="javascript:void(0);" title="Get Individual DCB Report - <?php echo $student['student_name'] ?> " onclick="submit_data('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>',2)" class="btn btn-warning btn-md"><i class="fa fa-file-excel-o"></i> Get Excel</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
                //                if ($breaker == 3) {
                //                    echo '<div class="clearfix"></div>';
                //                    $breaker = 0;
                //                } else {
                //                    $breaker ++;
                //                }
            }
        } else {
            ?>
            <div class="col-lg-12">
                <div class="contact-box text-center">
                    No Data Found
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
    $(document).ready(function() {

        $(".select2_demo_1").select2({
            "theme": "bootstrap",
            "width": "100%"

        });
        $(".select2_demo_2").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_demo_3").select2({
            "theme": "bootstrap",
            "width": "100%"
        });



        $('#search_student').hide();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


    });



    /* function submit_data(studentid, studentname) {
        $('#report_param_loader').addClass('sk-loading');
        var ops_url = baseurl + 'fees/report/get-individual-dcb-report/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "studentname": studentname,
                "studentid": studentid,
                "type": 1
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#report_param_loader').removeClass('sk-loading');
                        var $a = $("<a>");
                        $a.attr("href", data.link);
                        $("body").append($a);
                        $a.attr("download", "individual_dcb_report.xlsx");
                        $a[0].click();
                        $a.remove();
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            $('#report_param_loader').removeClass('sk-loading');
                            return false;
                        } else {
                            $('#report_param_loader').removeClass('sk-loading');
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            $('#report_param_loader').removeClass('sk-loading');
                            return false;
                        } else {
                            $('#report_param_loader').removeClass('sk-loading');
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            $('#report_param_loader').removeClass('sk-loading');
                            return false;
                        } else {
                            $('#report_param_loader').removeClass('sk-loading');
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    $('#report_param_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }


            }
        });

    }
 */
    function submit_data(studentid, studentname,rpt_type = 1) {
        $('#report_param_loader').addClass('sk-loading');
        var ops_url = baseurl + 'fees/report/get-individual-dcb-report/';
        $.ajax({
            type: "POST",
            cache: false,
            url: ops_url,
            data: {
                "studentname": studentname,
                "studentid": studentid,
                "type": 2,
                "rpt_type": rpt_type
            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 3) {
                        if (datas.message) {
                            swal('', datas.message, 'info');
                            $('#report_param_loader').removeClass('sk-loading');
                            return false;
                        } else {
                            $('#report_param_loader').removeClass('sk-loading');
                            swal('', 'No Reports Available', 'info')
                        }
                    } else if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#report_param_loader').removeClass('sk-loading');
                    }
                } catch (e) {
                    $('#report_param_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });

    }
</script>