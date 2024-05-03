<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5><i class="fa fa-search" style="padding-right:10px;"></i>Search Result</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php
                    $fflag = 0;
                    $display = 1;
                    //dev_export($details_data);
                    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                        $breaker = 0;
                        foreach ($details_data as $student) {
                            $display = 1;
                            if (isset($student['is_cheque']) && isset($student['is_chq_recon']) && isset($student['chq_recon_status'])) {
                                if ($student['is_cheque'] == 1) {
                                    $display = 1;
                                    if ($student['is_chq_recon'] == 1 && $student['chq_recon_status'] == 0) {
                                        // echo "SALAH zxc";
                                        $display = 0;
                                    } else {
                                        $display = 1;
                                    }
                                }
                            } else {
                                $display = 1;
                            }
                            // if (isset($student['created_on']) && date('d/m/Y', strtotime($student['created_on'])) == date('d/m/Y') && $display == 1) {
                            //     $display = 1;
                            //     
                            // } else {
                            //     $display = 0;
                            // }
                            if ($display == 1) {
                                $fflag++;
                    ?>
                                <div class="col-lg-4">
                                    <div class="contact-box center-version">
                                        <a href="javascript:void(0);" style="height:290px !important;">
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
                                            <br>
                                            <?php if (isset($student['father_name'])) { ?>
                                                <div class="font-bold" style="margin-bottom: 5px;"><b>Father : </b><?php echo $student['father_name'] ?></div>
                                            <?php } ?>
                                            <div class="font-bold" style="margin-bottom: 5px;"><b>Admission No. : </b><?php echo $student['Admn_No'] ?></div>
                                            <div class="font-bold" style="margin-bottom: 5px;"><b>Class : </b><?php echo $student['classname'] ?></div>
                                            <div class="font-bold font12" style="margin-bottom: 5px;"><b>Batch : </b><?php echo $student['batchname'] ?></div>

                                            <?php if (!empty($student['voucher_code'])) { ?>
                                                <hr style="margin: 5px;">
                                                <input type="hidden" value="<?php echo $student['id']; ?>" id="voucher_id_<?php echo $fflag; ?>">
                                                <input type="hidden" value="<?php echo $student['voucher_code']; ?>" id="voucher_code">
                                                <div class="font-bold" style="font-size:15px;"><b>Voucher : </b><?php echo $student['voucher_code'] ?></div>
                                                <div class="font-bold font12"><b>Amount : </b><?php echo my_money_format($student['voucher_amount']); ?></div>
                                            <?php } ?>
                                        </a>

                                        <div class="contact-box-footer">
                                            <?php echo $stud_status; ?>
                                            <div class="m-t-xs btn-group">
                                                <a href="javascript:void(0);" title="Cancel Fee Voucher of  <?php echo $student['student_name'] ?> " onclick="cancellation_detail('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>', '<?php echo $fflag ?>')" class="btn btn-md btn-info"><i class="fa fa-trash-o" style="font-size: 15px;"></i> Cancel Fee Voucher</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        <?php
                            }
                        }
                    } else {
                        $fflag = 0;
                    }
                    if ($fflag == 0) {
                        ?>
                        <div class="col-lg-12">
                            <div class="contact-box text-center">
                                No Voucher available today for cancel
                            </div>
                        </div>
                    <?php
                        // echo 'flag : ' . $fflag;
                        // echo 'display : ' . $display;
                    }
                    ?>
                </div>
            </div>
        </div>
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

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#search_student').hide();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


    });


    function cancellation_detail(studentid, studentname, fflag) {
        var voucher_id = $('#voucher_id_' + fflag).val();
        var ops_url = baseurl + 'fees/show-fee-voucher-cancel';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": studentid,
                "student_name": studentname,
                "voucher_id": voucher_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }
</script>