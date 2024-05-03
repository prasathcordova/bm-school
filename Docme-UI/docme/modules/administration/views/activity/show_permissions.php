<style>
.submenu
{
    vertical-align:sub;
}
</style>
<div id="result_table">
    <div>
        <br />
        <form name="userroles" id="userroles">
            <div class="col-lg-12 center" style="padding-top: 0px;">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <?php 
                        $arr = array();
                        foreach ($apppages as $key => $item) {
                            $arr[$item['appmenuid']]['menuuniqueid'] = $item['appmenuid'];
                            $arr[$item['appmenuid']]['mainmenu_name'] = $item['menuname'];
                            $arr[$item['appmenuid']]['apppages'][$item['apppagesuniqueid']]['apppagesuniqueid'] = $item['apppagesuniqueid'];
                            $arr[$item['appmenuid']]['apppages'][$item['apppagesuniqueid']]['pagename'] = $item['pagename'];
                            $arr[$item['appmenuid']]['apppages'][$item['apppagesuniqueid']]['operations'][$item['operationuniqueid']]['operationuniqueid'] = $item['operationuniqueid'];
                            $arr[$item['appmenuid']]['apppages'][$item['apppagesuniqueid']]['operations'][$item['operationuniqueid']]['operation'] = $item['operation'];
                            $arr[$item['appmenuid']]['apppages'][$item['apppagesuniqueid']]['operations'][$item['operationuniqueid']]['icontext'] = $item['icontext'];
                        }
                         ?>
                        <?php if (isset($apppages) && count($apppages) > 0) {
                        ?>
                            <?php
                            $pagenamearray = array();
                            $menunamearray = array();
                            foreach ($arr as $apppage) {
                                $menuname = ucwords($apppage['mainmenu_name']);
                                $menu_id = $apppage['menuuniqueid'];
                                $colspan = 10;
                            ?>
                                    <tr>
                                        <td colspan="<?php echo $colspan; ?>" style="background-color: #23C6C8; font-size: 16px; color: #fff; "><label style="font-weight: normal;"><input type="checkbox" class="selectall_<?php echo $apppage['menuuniqueid']; ?>" onclick="select_all_checkbox('<?php echo $apppage['menuuniqueid']; ?>')" value=""> &nbsp; <?php echo $menuname; ?></label><span class="glyphicon glyphicon-circle-arrow-down" data-toggle="tooltip" title="Toggle panel" style="float: right; cursor: pointer; padding-top: 5px;" onclick="accordian('<?php echo $apppage['menuuniqueid']; ?>')"></span></td>
                                    </tr>
                                <?php
                                    foreach($apppage['apppages'] as $key => $apppagesArr){
                                        $pagename = $apppagesArr['pagename'];
                                ?>
                                    <tr>
                                        <td colspan="<?php echo $colspan; ?>" style="background-color: #e7e8e8; font-size: 14px;" class="accordian accordian_<?php echo $apppage['menuuniqueid']; ?>"><label style="font-weight: normal;"><input type="checkbox" class="subpage_<?php echo $apppage['menuuniqueid']; ?> subpage2_<?php echo $apppagesArr['apppagesuniqueid']; ?>" onclick="select_all_subaction('<?php echo $apppagesArr['apppagesuniqueid']; ?>', '<?php echo $apppage['menuuniqueid']; ?>')" value=""> &nbsp; <?php echo $pagename; ?></label></td>
                                    </tr>
                                        <?php
                                            foreach($apppagesArr['operations'] as $operations){
                                                $pageoperationicon = $operations['icontext'];
                                                $pageoperation = ucwords($operations['operation']);
                                                $pageactionvalue = $apppagesArr['apppagesuniqueid'] . "," . $operations['operationuniqueid'];
                                                $brcss = ($apppagesArr['apppagesuniqueid'] == 534) ? '<br/>' : '';
                                               /* if (isset($assigned_roles) && !empty($assigned_roles)) {
                                                    foreach ($assigned_roles as $selected) {
                                                        $checkedvalue[] = $selected['apppagesuniqueid'] . "," . $selected['operationuniqid'];
                                                    }
                                                ?>
                                                    <td style="border: none;" class="accordian accordian_<?php echo $apppage['menuuniqueid']; ?>">
                                                        <label style="font-weight: normal;">
                                                            <input type="checkbox" class="i-checks subaction_<?php echo $apppage['menuuniqueid']; ?> page_action_<?php echo $apppagesArr['apppagesuniqueid']; ?> page_action2_<?php echo $operations['operationuniqid']; ?>" onclick="select_subpage('<?php echo $apppagesArr['apppagesuniqueid']; ?>', '<?php echo $apppage['menuuniqueid']; ?>', '<?php echo $operations['operationuniqid']; ?>')" name="operationuniqid[]" value="<?php echo $pageactionvalue; ?>" <?php if (in_array($pageactionvalue, $checkedvalue)) echo 'checked="checked"'; ?>>&nbsp; <?php echo $pageoperationicon . ' ' . $pageoperation; ?>                         
                                                        </label>
                                                    </td>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            check_supages_checkbox('<?php echo $apppagesArr['apppagesuniqueid']; ?>', '<?php echo $apppage['menuuniqueid']; ?>')
                                                        });
                                                    </script>
                                                <? }else{*/?>
                                                <td style=" border: none; white-space: nowrap;font-size:11px;float:left;display:block;" class="accordian accordian_<?php echo $apppage['menuuniqueid']; ?>">
                                                    <label style="font-weight: 400; float:left;">
                                                    <input type="checkbox" class="submenu subaction_<?php echo $apppage['menuuniqueid']; ?> page_action_<?php echo $apppagesArr['apppagesuniqueid']; ?> page_action2_<?php echo $operations['operationuniqueid']; ?>" onclick="select_subpage('<?php echo $apppagesArr['apppagesuniqueid']; ?>', '<?php echo $apppage['menuuniqueid']; ?>', '<?php echo $operations['operationuniqueid']; ?>')" name="operationuniqid[]>" value="<?php echo $pageactionvalue; ?>">&nbsp;
                                                    <?php echo $pageoperationicon . $brcss . ' ' . $pageoperation; //  . ' (' . $pageactionvalue . ')'     
                                                    ?>
                                                    </label>
                                                </td>
                                            <?php //}  }
                                        ?>
                                <?php
                            }
                            }
                            }
                        }
                        ?>
                    </table>
                </div><!-- /.box-body -->

            </div>
            <div class="form-group row">
                <label for="savebutton" class="col-md-2"></label>
                <div class="col-md-7">
                    <br />
                    <input type="hidden" name="loadsave" id="loadsave" value="1" />
                    <input type="hidden" name="roleid" id="roleid" value="<?php echo $roleid; ?>" />
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    function submit_data() {
        $('form').submit();
    }
    $('#userroles').on('submit', function(e) {
        e.preventDefault();

        ops_url = "<?php echo base_url(); ?>" + "Rolespermissions/showpermission";
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $(this).serialize(),
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    reset_permission_reload($('#roleid').val());
                    swal('Success', 'Role permission added successfully.', 'success');
                } else {
                    swal('', 'Please check data or try again later', 'info');
                    return false;
                }

            }
        });

    });

    function reset_permission_reload(roleid) {
        var ops_url = baseurl + 'user/set-role-permission';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "roleid": roleid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#on_edit').html('');
                    $('#on_edit').html(data.view);

                } else {
                    alert('No data loaded');
                }
            }
        });

    }

    function select_all_checkbox(menuuniqueid) {

        if ($(".selectall_" + menuuniqueid).is(":checked")) { // check select status
            $('.subpage_' + menuuniqueid + ',.subaction_' + menuuniqueid).each(function() { //loop through each checkbox
                this.checked = true; //select all checkboxes with class "checkbox1"              
            });
        } else {
            $('.subpage_' + menuuniqueid + ',.subaction_' + menuuniqueid).each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });
        }

    }

    // check and uncheck subpages checkbox
    function select_all_subaction(apppagesuniqueid, menuuniqueid) {
        if ($(".subpage2_" + apppagesuniqueid).is(":checked")) { // check select status
            $('.page_action_' + apppagesuniqueid).each(function() { //loop through each checkbox
                this.checked = true; //select all checkboxes with class "checkbox1"              
            });
        } else {
            $('.page_action_' + apppagesuniqueid).each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });
            $('.selectall_' + menuuniqueid).attr('checked', false);
        }

        check_mainmenu_checkbox(menuuniqueid);
    }

    function select_subpage(apppagesuniqueid, menuuniqueid, operationuniqid) {
        if (!$(".page_action2_" + operationuniqid).is(":checked")) { // check select status
            $('.subpage2_' + apppagesuniqueid).attr('checked', false);
            $('.selectall_' + menuuniqueid).attr('checked', false);
        } else {

            check_supages_checkbox(apppagesuniqueid, menuuniqueid);
        }

    }

    // default check app pages checkboxes
    function check_supages_checkbox(apppagesuniqueid, menuuniqueid) {
        var action_count = $('.page_action_' + apppagesuniqueid).not(':checked').length;
        if (action_count <= 0) {
            $('.subpage2_' + apppagesuniqueid).prop('checked', true);
        }

        check_mainmenu_checkbox(menuuniqueid);
    }

    // default check menu checkboxes
    function check_mainmenu_checkbox(menuuniqueid) {
        var subpage_count = $('.subpage_' + menuuniqueid).not(':checked').length;
        if (subpage_count <= 0) {
            $('.selectall_' + menuuniqueid).prop('checked', true);
        }
    }

    // toggle menu's
    function accordian(menuuniqueid) {
        $('.accordian_' + menuuniqueid).toggle();
    }

    function load_rolepermission(roleid) {
        if (roleid == -1) {
            $('#createchecklistcategory').html("");
            return;
        }

        var ops_url = baseurl + "permission/set-permission-list";
        $.ajax({
            url: ops_url,
            async: false,
            type: "POST",
            data: {
                "roleid": roleid,
                "loadsave": 0
            },
            dataType: "html",
            success: function(data) {
                $('#createchecklistcategory').html(data);
                $('#save_div').show()

            }
        })
    }

    function save_role_permission() {
        var ops_url = baseurl + "permission/set-permission-list";
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#userroles').serialize(),
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    swal({
                        title: 'Success',
                        text: 'Roles Updated Successfully',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }, function(isConfirm) {
                        window.location.href = baseurl + "permission/set-permission";
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    activate_toast(data.message, 'Error', 'error');
                } else {
                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }
</script>