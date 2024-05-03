<div id="search-tab" style="    padding-bottom: 20px;    padding-top: 20px;">
    <div class="input-group">
        <input type="text" placeholder="Search available role name " id="search_user_role_data" name="search_user_data" class="input form-control">
        <span class="input-group-btn">
            <button type="button" class="btn btn btn-primary" onclick="load_search_role_data();"> <i class="fa fa-search"></i> Search</button>
        </span>
    </div>
</div>
<div class="full-height-scrollbar">

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Description</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($role_data) && !empty($role_data) && is_array($role_data)) {
                    $i = 0;
                    foreach ($role_data as $role) {
                        if ($i == 0) {
                            echo '<input type="hidden" name="role_intial_load" id="role_intial_load" value="' . $role['role_id'] . '" />';
                            $i++;
                        }
                        ?>
                        <tr>
                            <td><a href="javascript:void(0);" onclick="role_data_load('<?php echo $role['role_id']; ?>');" class="client-link"><?php echo $role['role_name']; ?></a></td>
                            <td><?php echo $role['role_description']; ?></td>
                            <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                <?php if ($role['isactive'] == 1) { ?>                                                    
                                    <span class=" label label-primary">Active</span>
                                <?php } else {
                                    ?>                                                                                                      
                                    <span class="label label-warning">Disabled</span>
                                <?php }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    if ($i == 0) {
                        echo '<input type="hidden" name="role_intial_load" id="role_intial_load" value="0" />';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    
$(document).ready(function () {



        $('.full-height-scroll').slimscroll({
            height: '100%'
        });

     });
    </script>