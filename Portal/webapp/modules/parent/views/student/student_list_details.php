<?php

if (null !== ($this->session->userdata('payment_status_message')) && $this->session->userdata('payment_status_message') == 1) {

?>
    <script type="text/javascript">
        activate_toast_login('Fee payment success. Please check Online Payment History tab for more information!!', 'Payment Success', 'success', 500);
    </script>
<?php
    $this->session->unset_userdata('payment_status_message');
} else if (null !== ($this->session->userdata('payment_status_message')) && $this->session->userdata('payment_status_message') == 2) {
?>
    <script type="text/javascript">
        activate_toast_login_for_error('Payment failed please check the payment info for more details', 'Payment Failed!!', 'error', 500);
    </script>
<?php
    $this->session->unset_userdata('payment_status_message');
}
?>
<style>
    dt {
        padding-bottom: 10px;
        font-weight: 700;
    }
</style>

<?php
//                dev_export($feedback_id);die;
//                                        $profile_image = base_url('assets/images/a0.jpg');
//                                        $profile_image = base_url('assets/images/iphone.jpg');
$profile_image = base_url('assets/images/a0.jpg');
$collegelogo_image = base_url('assets/images/100_logo.png');
?>
<div class="ibox">
    <div class="ibox-content" Style="padding:0;padding-top:30px;">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?php
                // dev_export($sdetails_data);
                // die;
                if (isset($sdetails_data) && !empty($sdetails_data)) {
                    foreach ($sdetails_data as $students) {
                        // dev_export($students);
                ?>
                        <?php
                        $profile_image = "";
                        if (!empty(get_student_image($students['student_id']))) {
                            $profile_image = get_student_image($students['student_id']);
                        } else {
                            $profile_image = base_url('assets/img/a0.jpg');
                        }
                        ?>
                        <?php
                        $str = $students['class'];
                        $exdata = explode("-", $str);

                        $str = $students['Batch_Name'];
                        $exdata_batch = explode("/", $str);
                        ?>

                        <div class="col-lg-6" style="text-align: center;">
                            <div class="contact-box">
                                <!-- <a href="javascript:void(0)"> -->

                                <div class="col-md-4">
                                    <div class="text-center" style="margin-top: 25px;">
                                        <!--img-responsive-->
                                        <img alt="image" class="img-circle img-md" src="<?php echo $profile_image; ?>" />
                                        <div class="m-t-xs font-bold"> </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <strong><?php echo $students['Student_Name']; ?></strong>
                                    <p>Admission Number : <?php echo $students['Reg_No']; ?></p>
                                    <p>Class : <?php echo isset($students['class']) ? $students['class'] : 'NA'; ?></p>
                                    <p>Batch : <strong><?php echo isset($students['Batch_Name']) ? $students['Batch_Name'] : 'NA'; ?></strong></p>
                                    <p>
                                        <a class="btn btn-info " style="margin-bottom:5px;" href="javascript:void(0)" onclick="load_student('<?php echo $students['student_id'] ?>')"> Fees</a>
                                        <a class="btn btn-info " style="margin-bottom:5px;" href="payment-bookstore/<?php echo base64_encode($students['Reg_No']) . "/" . $students['Inst_ID'] ?>"> Book Store</a>
                                        <a class="btn btn-info " style="margin-bottom:5px;" href="payment-uniform/<?php echo base64_encode($students['Reg_No']) . "/" . $students['Inst_ID'] ?>"> Uniform Store</a>
                                    </p>
                                </div>
                                <div class="clearfix"></div>


                                <!-- </a> -->
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
            </div>

        </div>
    </div>
</div>
<script>
    function load_student(student_id) {
        var ops_url = baseurl + 'parent-portal/show_student/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-content').html(data.view);
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    return false;
                } else {
                    swal('', 'An error occured while fetching data. Please try again later or contact administrator with error code : DPRDTAER10005', 'info');
                    return false;
                }


            }
        });
    }

    function load_bookstore_payment(student_id) {
        var ops_url = baseurl + 'parent-portal/show_bookstore_payment/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-content').html(data.view);
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    return false;
                } else {
                    swal('', 'An error occured while fetching data. Please try again later or contact administrator with error code : DPRDTAER10005', 'info');
                    return false;
                }


            }
        });
    }
</script>