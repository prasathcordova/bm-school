<div class="wrapper wrapper-content animated fadeInRight registration-view" style="padding-top: 75px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox">
                <!-- <div class="ibox-title" style="text-align :center"> -->
                <!-- <h2>Payment Details</h2> -->
                <!-- </div> -->
                <div class="ibox-content" id="registration_loader">
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-4" style="text-align:center">
                            <h2>Payment Details</h2>
                            <table class="table table-hover" style="text-align:left">
                                <tbody>
                                    <tr>
                                        <td>Registration No.</td>
                                        <td>: <b><?php echo $detail['TempAdmn_No'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Student Name</td>
                                        <td>: <b><?php echo $detail['fname'] . ' ' . $detail['mname'] . ' ' . $detail['lname'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Class</td>
                                        <td>: <b><?php echo $detail['Description'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Parent Name</td>
                                        <td>: <b><?php echo $detail['parentName'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Registration Fees</td>
                                        <td>: <b>&#8377 <?php echo $detail['registration_fees'] ?>/-</b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <a data-toggle="modal" class="btn btn-primary" onclick="proceedtopayment(<?php echo $detail['TempReg_ID'] ?>)">Proceed to Payment</a>
                            </div>

                        </div>
                    </div>
                    <br /><br />
                    <div class="col-lg-12" style="text-align:center;font-style:italic">
                        Note : Registration is completed only on successful payment, Payment can be initiated by clicking link in the acknowldegement email in case of payment failure.
                    </div>
                    <br /><br />
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function proceedtopayment(temp_reg_id) {
        var ops_url = baseurl + 'registration/online-payment-proceed';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "temp_reg_id": temp_reg_id,
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    //console.log(data.link);
                    window.location = data.link
                } else {
                    swal('', 'Please try again later', 'info');
                }
            }
        });
    }
</script>