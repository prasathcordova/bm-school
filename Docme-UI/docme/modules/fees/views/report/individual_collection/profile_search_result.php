<div class="col-lg-12">
    <input type="checkbox" value="1" name="include_transfer" id="include_transfer" class="i-checks" />
    <span class="m-l-xs">Include Transfer</span>
    <hr>
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
                                <!--btn-group-->
                                <!--<a href="javascript:void(0);" title="Get Excel Report - <?php echo $student['student_name'] ?> " onclick="submit_data('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>')" class="btn btn-md btn-warning"><i class="fa fa-file-excel-o"></i> Excel</a>-->
                                <!-- <a href="javascript:void(0);" title="Get Pdf Report - <?php echo $student['student_name'] ?> " onclick="pdf_report('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>')" class="btn btn-block btn-info"><i class="fa fa-file-pdf-o"></i> GET REPORT</a>                                    -->
                               <div class="row">
                                <a href="javascript:void(0);" class="btn btn-info btn-md" onclick="pdf_report('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>',1);"><i class="fa fa-file-pdf-o"></i> GET PDF</a>
                                <a href="javascript:void(0);" class="btn btn-warning btn-md" onclick="pdf_report('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>',2);"><i class="fa fa-file-excel-o"></i> GET Excel</a>
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

        // $('#data_1 .input-group.date').datepicker({
        //     todayBtn: "linked",
        //     keyboardNavigation: false,
        //     forceParse: false,
        //     calendarWeeks: true,
        //     autoclose: true
        // });

        $('#search_student').hide();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


    });


    //    function get_account_details(studentid, studentname) {       
    //        var ops_url = baseurl + 'fees/report/get-individual-collection-report';
    //        $.ajax({
    //            type: "POST",
    //            cache: false,
    //            async: false,
    //            url: ops_url,
    //            data: {"load": 1, "studentid": studentid,  "studentname": studentname},
    //            success: function (result) {
    //                var data = JSON.parse(result);
    //                if (data.status == 1) {
    //                    $('#data-view').html('');
    //                    $('#data-view').html(data.view);
    //                    $('html, body').animate({
    //                        scrollTop: 0
    //                    }, 1000);
    //                } else {
    //                    if (data.message) {
    //                        swal('', data.message, 'info');
    //                        return false;
    //                    } else {
    //                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
    //                        return false;
    //                    }
    //                }
    //
    //            }
    //        });
    //    }


    /* function submit_data(studentid, studentname) {
        var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');

        if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
            swal('', 'Select a valid date range', 'info');
            return false;
        }

        if (moment(startdate).isValid() && moment(enddate).isValid()) {
            $('#report_param_loader').addClass('sk-loading');
            var reportstartdate = startdate;
            var reportenddate = enddate;
            var ops_url = baseurl + 'fees/report/get-individual-collection-report/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "startdate": reportstartdate,
                    "enddate": reportenddate,
                    "studentid": studentid,
                    "type": 1
                },
                success: function(result) {
                    //                         $('#report_content').html(result);
                    //                         return false
                    try {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            $('#report_param_loader').removeClass('sk-loading');
                            var $a = $("<a>");
                            $a.attr("href", data.link);
                            $("body").append($a);
                            $a.attr("download", "individual_collection_report.xlsx");
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
        } else {
            swal('', 'Please check the input are valid', 'info');
            return false;
        }
    } */

    function pdf_report(studentid, studentname,rpt_type = 1) {
        var include_transfer = $("input[name='include_transfer']:checked").val();
        if (include_transfer != 1) {
            include_transfer = -1;
        }
        // alert(include_transfer);
        // return false;
        var startdate = $('#reportdate').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var enddate = $('#reportdate').data('daterangepicker').endDate.format('YYYY-MM-DD');

        if (!(moment(startdate).isValid() && moment(enddate).isValid())) {
            swal('', 'Select a valid date range', 'info');
            return false;
        }

        if (moment(startdate).isValid() && moment(enddate).isValid()) {
            $('#report_param_loader').addClass('sk-loading');
            var reportstartdate = moment(startdate).format('YYYY-MM-DD');
            var reportenddate = moment(enddate).format('YYYY-MM-DD');
            var ops_url = baseurl + 'fees/report/get-individual-collection-report/';
            $.ajax({
                type: "POST",
                cache: false,
                // async: false,
                url: ops_url,
                data: {
                    "startdate": reportstartdate,
                    "enddate": reportenddate,
                    "studentid": studentid,
                    "include_transfer": include_transfer,
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
        } else {
            swal('', 'Please check the input are valid', 'info');
            return false;
        }
    }
</script>