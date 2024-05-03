<div class="row">
    <?php
    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
        $breaker = 0;
        foreach ($details_data as $student) {
    ?>
            <div class="col-lg-4">
                <div class="contact-box center-version">
                    <a href="javascript:void(0);">
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
                        <h3 class="m-b-xs pro-name"><strong><?php echo $student['student_name'] ?></strong></h3>

                        <div class="font-bold">Admission num:<?php echo $student['Admn_No'] ?></div>

                    </a>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td class="project-status">
                                    <span class="label label-primary"><?php echo $student['stud_status']; ?></span>
                                </td>
                            </tr>
                            <!--                                                            <tr>
                                <td class="project-completion" onclick="edit_profile(<?php // echo $student['student_id'];  
                                                                                        ?>)" >
                                    <small>Completion with:  <?php // echo ((isset($student['reg_percent']) && !empty($student['reg_percent'])) ? $student['reg_percent'] : '0')  
                                                                ?>  %</small>
                            <?php // $percent = $student['reg_percent']; 
                            ?>
                                    <div class='progress progress-mini'>
                                        <div style=' width: <?php // echo $percent . '%';  
                                                            ?>' class='progress-bar'></div>
                                    </div>
                                </td>
                            </tr>-->
                        </tbody>
                    </table>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a href="javascript:void(0);" onclick="uniform_loose_packing('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Select</a>
                            <!--<a href="javascript:void(0);" onclick="send_personal_email('<?php // echo $student['student_id'];  
                                                                                            ?>', '<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>')" class="btn btn-xs btn-white "><i class="fa fa-envelope"></i> Email</a>-->
                            <!--<a href="javascript:void(0);" onclick="fees_detail('<?php // echo $student['student_id'];  
                                                                                    ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Fee Details</a>-->
                        </div>
                    </div>

                </div>
            </div>
    <?php
            if ($breaker == 2) {
                echo '<div class="clearfix"></div>';
                $breaker = 0;
            } else {
                $breaker++;
            }
        }
    }
    ?>
</div>