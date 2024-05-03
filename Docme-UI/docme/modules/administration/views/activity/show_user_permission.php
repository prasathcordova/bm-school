<div class="col-sm-4">
    <?php echo $role_view; ?>
</div>
<div class="col-sm-8">
    <div class="ibox " style="height: 452px !important;">
        
        <div class="ibox-title float-e-margins">
            <h5 style="font-size: 20px;"><?php echo $sub_title; ?></h5>
            <div class="ibox-tools">
                        
            <a href="<?php echo base_url('user/show-activity'); ?>" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
            <a data-toggle="modal" class="btn btn-primary btn-xs" title="Save" data-placement="left" href="javascript:void(0)" onclick="submit_data();"><i class="fa fa-save"></i>Save</a>
            </div>   
        </div>
        <div class="ibox-content" >
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="permission_data">
                    <?php echo $permission_view_data; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
       $(document).ready(function () 
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
function select_all_checkbox(menuuniqueid) {

        if ($(".selectall_" + menuuniqueid).is(":checked")) { // check select status
            $('.subpage_' + menuuniqueid + ',.subaction_' + menuuniqueid).each(function () { //loop through each checkbox
                this.checked = true; //select all checkboxes with class "checkbox1"              
            });
        } else {
            $('.subpage_' + menuuniqueid + ',.subaction_' + menuuniqueid).each(function () { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });
        }

    }

    // check and uncheck subpages checkbox
    function select_all_subaction(apppagesuniqueid, menuuniqueid) {
        if ($(".subpage2_" + apppagesuniqueid).is(":checked")) { // check select status
            $('.page_action_' + apppagesuniqueid).each(function () { //loop through each checkbox
                this.checked = true; //select all checkboxes with class "checkbox1"              
            });
        } else {
            $('.page_action_' + apppagesuniqueid).each(function () { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });
            $('.selectall_' + menuuniqueid).attr('checked', false);
        }

        check_mainmenu_checkbox(menuuniqueid);
    }

    function select_subpage(apppagesuniqueid, menuuniqueid, operationuniqid)
    {
        if (!$(".page_action2_" + operationuniqid).is(":checked")) { // check select status
            $('.subpage2_' + apppagesuniqueid).attr('checked', false);
            $('.selectall_' + menuuniqueid).attr('checked', false);
        } else {

            check_supages_checkbox(apppagesuniqueid, menuuniqueid);
        }

    }

    // default check app pages checkboxes
    function check_supages_checkbox(apppagesuniqueid, menuuniqueid)
    {
        var action_count = $('.page_action_' + apppagesuniqueid).not(':checked').length;
        if (action_count <= 0)
        {
            $('.subpage2_' + apppagesuniqueid).prop('checked', true);
        }

        check_mainmenu_checkbox(menuuniqueid);
    }

    // default check menu checkboxes
    function check_mainmenu_checkbox(menuuniqueid)
    {
        var subpage_count = $('.subpage_' + menuuniqueid).not(':checked').length;
        if (subpage_count <= 0)
        {
            $('.selectall_' + menuuniqueid).prop('checked', true);
        }
    }

    // toggle menu's
    function accordian(menuuniqueid)
    {
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
            data: {"roleid": roleid, "loadsave": 0},
            dataType: "html",
            success: function (data) {
                $('#createchecklistcategory').html(data);
                $('#save_div').show()

            }
        })
    }

    function show_role_page(){

    }

</script>