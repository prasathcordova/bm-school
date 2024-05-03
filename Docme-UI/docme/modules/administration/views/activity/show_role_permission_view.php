<div class="ibox " style="height: 452px !important;">
    <div class="ibox-content" style="height: 100% !important;">
        <div class="tab-content" id="role_data_content">
            <div id="role_display_<?php echo $role['role_id']; ?>" class="tab-pane active" >
                <div class="row row m-b-lg">
                    <div class="ibox-content">
                        <div>   <h3><?php echo $role['role_name']; ?></h3><span>  <small><?php echo $role['role_description']; ?></small></span></div>

                        <?php if (isset($module_list) && !empty($module_list)) { ?>

                            <?php foreach ($module_list as $modules) { ?>
                                <ul class="todo-list m-t">
                                    <li>
                                        <input type="checkbox" value="" name="" class="i-checks" checked disabled=""/>
                                        <span class="m-l-xs"><?php echo $modules['menuname'] ?></span>
                                        <small class="label label-primary"></small>
                                    </li>                        
                                </ul>
                            <?php }
                        }
                        ?>                    

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#roleedit').hide();
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    });

 function role_data_close(roleid) {
        var ops_url = baseurl + 'user/show-role-data-detail';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "roleid": roleid},
            success: function (result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#on_edit').html(data.view);
                    $('.permission-list').slimscroll({
                        height: '100%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }
</script> 
