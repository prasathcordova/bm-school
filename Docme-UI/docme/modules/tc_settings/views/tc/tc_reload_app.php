<div class="panel-body">
    <div class="row">
        <?php
        if (isset($app_details_data) && !empty($app_details_data) && is_array($app_details_data)) {
            $breaker = 0;
            foreach ($app_details_data as $student) {
                ?>
                <div class="col-lg-3">
                    <div class="contact-box center-version">

                        <a href="javascript:void(0);">
                            <?php
                                    //                                                                                       <?php
                                    $profile_image = "";
                                    if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                        $profile_image = "data:image/png;base64," . $student['profile_image'];
                                    } else {
                                        if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                            $profile_image = $student['profile_image_alternate'];
                                        } else {
                                            $profile_image = base_url('assets/img/a0.jpg');
                                        }
                                    }
                                    ?>

                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs"><strong><?php echo $student['name'] ?></strong></h3>
                        </a>
                        <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; ">
                            <tbody>
                                <tr>
                                    <td>
                                        Admission No.
                                    </td>
                                    <td>
                                        :<b> <?php echo $student['admn_no'] ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Batch Name
                                    </td>
                                    <td>
                                        :<b> <?php echo $student['batch_name'] ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Parent Name
                                    </td>
                                    <td>
                                        : <b> <?php echo $student['name_of_guardian_in_application'] ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Contact No
                                    </td>
                                    <td>
                                        : <b> <?php echo $student['mob'] ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        TC Applied Date
                                    </td>
                                    <td>
                                        : <b> <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                    </td>
                                </tr>



                            </tbody>
                        </table>
                        <div class="contact-box-footer">
                            <div class="m-t-md ">
                                <a class="btn btn-xs btn-info" onclick="tc_cancellation('<?php echo $student['student_id']; ?>', '<?php echo $student['name']; ?>');"> Cancel</a>
                                <a class="btn btn-xs btn-info" onclick="tc_preparation('<?php echo $student['student_id']; ?>');"> Prepare</a>
                                <!--<a class="btn btn-xs btn-info" onclick="tc_issue('<?php echo $student['student_id']; ?>');"> Issue</a>-->
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
            } else {
                ?>
            <div>
                <h3><strong> No data available </strong></h3>
            </div>
        <?php
        }
        ?>



    </div>
</div>