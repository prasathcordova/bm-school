<div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
    <div class="row">
        <?php
        if (isset($user_data) && !empty($user_data) && is_array($user_data)) {
            $breaker = 0;
            foreach ($user_data as $staff) {
                ?>
                <div class="col-lg-3">
                    <div class="contact-box center-version">                                                        
                        <a href="javascript:void(0);">
                            <?php
                            $profile_image = "";
                            if (isset($staff['profile_image']) && !empty($staff['profile_image'])) {

                                $profile_image = "data:image/jpeg;base64," . $staff['profile_image'];
                            } else {
                                if (isset($staff['profile_image_alternate']) && !empty($staff['profile_image_alternate'])) {
                                    $profile_image = $staff['profile_image_alternate'];
                                } else {
                                    $profile_image = base_url('assets/img/a0.jpg');
                                }
                            }
                            ?>
                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs pro-name"><strong><?php echo $staff['Emp_Name'] ?></strong></h3>



                        </a>
                        <table class="table table-hover" style="margin-bottom: 0;">
                            <tbody>
                                <tr>
                                    <td class="project-status" style="text-align: center;">
                                        <span class="label label-primary">Designation:<?php echo $staff['Designation'] ?></span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="contact-box-footer" style="padding: 5px 5px;">
                            <div class="m-t-xs btn-group">
                                <a href="javascript:void(0);" title="Deliver items to <?php echo $staff['Emp_Name'] ?>" onclick="delivery_faculty('<?php echo $staff['Emp_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i>Delivery</a>        
                            </div>
                        </div>

                    </div>
                </div>
                <?php
                if ($breaker == 3) {
                    echo '<div class="clearfix"></div>';
                    $breaker = 0;
                } else {
                    $breaker ++;
                }
            }
        }
        ?>
    </div>
</div>