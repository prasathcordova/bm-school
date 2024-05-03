<div class="row">
    <div class="col-lg-12">
        <!--<div class="panel panel-info">-->

        <!--<div class="panel-body">-->

        <?php
        if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
            $breaker = 0;
            foreach ($details_data as $student) {
        ?>
                <div class="col-lg-3">
                    <div class="contact-box center-version">
                        <a href="javascript:void(0);" style="height: 215px !important;">
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
                            ?>
                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs"><strong><?php echo $student['student_name'] ?></strong></h3>
                            <div class="font-bold"><?php echo $student['Admn_No'] ?></div>
                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a href="javascript:void(0);" title="Deliver items to <?php echo $student['student_name'] ?>" onclick="uniform_bill_detail_delivery('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Delivery</a>
                            </div>
                        </div>

                    </div>
                </div>
        <?php
                if ($breaker == 3) {
                    echo '<div class="clearfix"></div>';
                    $breaker = 0;
                } else {
                    $breaker++;
                }
            }
        }
        ?>
    </div>
</div>


<script>
    function uniform_bill_detail_delivery(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'uniform/sales/show-studentdelivery/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html('');
                        $('#data-view').html(data.view);
                        $('html, body').animate({
                            scrollTop: $("#data-view").offset().top
                        }, 1000);
                    }

                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }
</script>