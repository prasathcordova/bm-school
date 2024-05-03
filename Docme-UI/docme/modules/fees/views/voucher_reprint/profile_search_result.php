<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5><i class="fa fa-search" style="padding-right:10px;"></i>Search Result</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php
                    // dev_export($details_data); //voucher_code voucher_code
                    //substr($voucher['voucher_code'], 0, 3) == 'APR'
                    $vcount = 0;
                    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                        foreach ($details_data as $student) {
                            $display = 1;
                            if (isset($student['is_cheque']) && isset($student['is_chq_recon']) && isset($student['chq_recon_status'])) {
                                if ($student['is_cheque'] == 1) {
                                    $display = 1;
                                    if ($student['is_chq_recon'] == 1 && $student['chq_recon_status'] == 0) {
                                        $display = 0;
                                        $fflag = 0;
                                    } else {
                                        $display = 1;
                                    }
                                }
                            } else {
                                $display = 1;
                            }
                            if ($display == 1) {
                    ?>
                                <div class="col-lg-4">
                                    <div class="contact-box center-version">
                                        <a href="javascript:void(0);" style="height:320px !important;">
                                            <?php
                                            $profile_image = "";
                                            if ((isset($student['paytype']) && ($student['paytype'] == 'REGFEE')) || (isset($student['voucher_code']) && substr($student['voucher_code'], 0, 3) == 'APR') ) {
                                                $profile_image = base_url('assets/img/a0.jpg');
                                            }else{
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
                                            }                                            
                                            if (trim($student['StatusFlag']) == 'L') {
                                                $stud_status = '<div class="font-bold font12 text-danger"><b>Long Absentee</b></div>';
                                            } else {
                                                $stud_status = '<div class="font-bold font12 text-danger"><b>&nbsp;</b></div>';
                                            }
                                            ?>
                                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                            <h3 class="m-b-xs" title="<?php echo $student['student_name']; ?>"><strong><?php echo substr($student['student_name'], 0, 20); ?></strong></h3>
                                            <br>
                                            <?php if (isset($student['voucher_code']) && substr($student['voucher_code'], 0, 3) == 'APR') {
                                                $vcode = substr($student['voucher_code'], 0, 3);
                                                //if ($vcode == 'APR') { 
                                            ?>
                                                <div class="font-bold"><b>Student No : </b><?php echo $student['Admn_No'] ?></div>
                                            <?php } else {
                                                if (isset($student['paytype']) && ($student['paytype'] == 'REGFEE')) {
                                                    $vcode = 'REGFEE';
                                                } else {
                                                    $vcode = '';
                                                }
                                            ?>
                                                <?php if (isset($student['father_name'])) { ?>
                                                    <div class="font-bold" style="margin-bottom: 5px;"><b>Father : </b><?php echo $student['father_name'] ?></div>
                                                <?php } ?>
                                                <div class="font-bold" style="margin-bottom: 5px;"><b>Admission No. : </b><?php echo $student['Admn_No'] ?></div>
                                                <div class="font-bold" style="margin-bottom: 5px;"><b>Class : </b><?php echo $student['classname'] ?></div>
                                                <div class="font-bold font12" style="margin-bottom: 5px;"><b>Batch : </b><?php echo $student['batchname'] ?></div>
                                            <?php } ?>
                                            <?php if (!empty($student['voucher_code'])) { ?>
                                                <hr style="margin: 5px;">
                                                <input type="hidden" value="<?php echo $student['id']; ?>" id="voucher_id<?php echo $vcount; ?>">
                                                <input type="hidden" value="<?php echo $student['voucher_code']; ?>" id="voucher_code<?php echo $vcount; ?>">
                                                <div class="font-bold" style="font-size:15px;"><b>Voucher : </b><?php echo $student['voucher_code'] ?></div>
                                                <!-- + (isset($student['service_charge']) ? $student['service_charge'] : 0)-->
                                                <div class="font-bold font12"><b>Amount : </b><?php echo my_money_format($student['voucher_amount'] + ($student['is_wallet_payment_only'] == 1 ? $student['service_charge'] : 0)); ?></div>
                                            <?php } ?>

                                        </a>

                                        <div class="contact-box-footer">
                                            <?php echo $stud_status; ?>
                                            <div class="m-t-xs btn-group">
                                                <a href="javascript:void(0);" title="View Fee Voucher of <?php echo $student['student_name'] ?> " onclick="voucher_detail('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>','<?php echo $vcode ?>','<?php echo $student['Admn_No'] ?>','<?php echo $vcount; ?>')" class="btn btn-md btn-info"><i class="fa fa-file-text" style="font-size: 15px;"></i> View Voucher</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        <?php
                                $vcount++;
                            }
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


    function voucher_detail(studentid, studentname, voucher_type, admn_no, vcount) {
        var voucher_id = $('#voucher_id' + vcount).val();
        var voucher_code = $('#voucher_code' + vcount).val();
        var ops_url = baseurl + 'fees/show_fee_voucher_for_reprint';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": studentid,
                "student_name": studentname,
                "voucher_id": voucher_id,
                "voucher_code": voucher_code,
                "voucher_type": voucher_type,
                "admn_no": admn_no
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