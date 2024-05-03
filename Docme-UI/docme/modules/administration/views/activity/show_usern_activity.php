<div class="table-responsive">
    <table class="table table-striped table-hover">

        <tbody>
        <thead>
            <tr>
                <th class="client-avatar">Img</th>
                <th>User Name</th>
                <th>Department</td>
                <th colspan="2">Email</th>
<!--                <th> <?php // echo $user['EMail'];      ?></td>-->
                <th>Status</th>
            </tr>
        </thead>

            <?php
            if (isset($user_data) && !empty($user_data)) {
                $i = 0;

                foreach ($user_data as $user) {
                    if ($i == 0) {
                        echo '<input type="hidden" name="user_intial_load" id="user_intial_load" value="' . $user['Emp_id'] . '" />';
                        $i++;
                    }
                    $profile_image = "";
                    if (isset($user['profile_image']) && !empty($user['profile_image'])) {
                        $profile_image = "data:image/jpeg;base64," . $user['profile_image'];
                    } else {
                        if (isset($user['profile_image_alternate']) && !empty($user['profile_image_alternate'])) {
                            $profile_image = $user['profile_image_alternate'];
                        } else {
                            $profile_image = base_url('assets/img/a0.jpg');
                        }
                    }
                    ?>

                    <tr>
                    <td class="client-avatar"><img alt="image" src="<?php echo $profile_image ?>"> </td>
                    <td><a onclick="user_data_load('<?php echo $user['Emp_id'] ?>')" class="client-link"><?php echo $user['Emp_Name'] ?></a></td>
                    <td> <?php echo $user['DepName'] ?></td>
                    <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                    <td> <?php echo $user['EMail']; ?></td>
                    <td class="client-status"><span class="label label-primary">Active</span></td>
                </tr>
                <?php
            }
            if ($i == 0) {
                echo '<input type="hidden" name="user_intial_load" id="user_intial_load" value="0" />';
            }
        }
        ?>                                                
        </tbody>
    </table>


</div>