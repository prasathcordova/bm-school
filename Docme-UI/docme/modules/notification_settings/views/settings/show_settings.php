<style>
    .select2-container {
    z-index: 99999;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            ?>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0);">Notification
                            Management</a>
                        <div class="space-25"></div>
                        <?php if (
                            check_permission(561, 1224, 114) || check_permission(561, 1225, 114) || check_permission(561, 1226, 114)
                        ) { ?>
                            <h5>Notification Settings</h5>
                            <ul class="category-list" style="padding: 0">

                                <?php if (check_permission(561, 1224, 114)) { ?>
                                    <li title="Notification Settings"><a href="javascript:void(0)" onclick="load_notifications_list();"> <i class="fa fa-circle text-warning"></i>
                                            Notification Settings </a></li>
                                <?php } ?>



                            </ul>
                        <?php } ?>
                        <?php if (
                            check_permission(561, 1224, 114) || check_permission(561, 1225, 114) || check_permission(561, 1226, 114)
                        ) { ?>
                            <h5>Send Notifications </h5>
                            <ul class="category-list" style="padding: 0">

                                <?php if (check_permission(561, 1224, 114)) { ?>
                                    <li title="Arrear Alert"><a href="javascript:void(0)" onclick="load_arrear_filter_account();"> <i class="fa fa-circle text-info"></i>
                                            Arrear Alert </a></li>
                                <?php } ?>



                            </ul>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="" id="data-view">


            </div>
        </div>
    </div>
</div>


<script>
    load_notifications_list();

    function load_notifications_list() {
        $("#faculty_loader").addClass("sk-loading");

        var ops_url = baseurl + 'notification/show-notifications-list';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
                $("#faculty_loader").removeClass("sk-loading");
                $('#tbl_notificationshow').DataTable({
                    columnDefs: [{
                            // "width": "10%",
                            className: "capitalize",
                            "targets": 0
                        },
                        {
                            // "width": "10%",
                            className: "capitalize",
                            "targets": 1
                        },
                        {
                            // "width": "5%",
                            className: "capitalize",
                            "targets": 2
                        },
                        {
                            // "width": "5%",
                            className: "capitalize",
                            "targets": 3
                        },

                    ],
                    responsive: true,
                    iDisplayLength: 10,
                    "ordering": false,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'Report'
                        }
                    ],
                    "fnDrawCallback": function(ele) {
                        activateSwitchery();
                    }
                });
            }
        });

    }

    function load_arrear_filter_account() {
        $("#faculty_loader").addClass("sk-loading");
        var ops_url = baseurl + 'notification/show-filter-student-notification';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
                $("#faculty_loader").removeClass("sk-loading");
            }
        });
    }

    function load_arrear_list() {
        $("#faculty_loader").addClass("sk-loading");
        var ops_url = baseurl + 'notification/load-arrear-list';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
                $("#faculty_loader").removeClass("sk-loading");
                oTable = $('#tbl_arrearlistshow').DataTable({
                    columnDefs: [{
                            // "width": "10%",
                            className: "capitalize",
                            "targets": 0
                        },
                        {
                            // "width": "10%",
                            className: "capitalize",
                            "targets": 1
                        },
                        {
                            // "width": "5%",
                            className: "capitalize",
                            "targets": 2
                        },
                        {
                            // "width": "5%",
                            className: "capitalize",
                            "targets": 3
                        },
                        {
                            // "width": "5%",
                            className: "capitalize",
                            "targets": 4
                        }

                    ],
                    responsive: true,
                    iDisplayLength: 10,
                    "ordering": false,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'Report'
                        }
                    ],
                    "fnDrawCallback": function(ele) {
                        activateSwitchery();
                    }
                });
            }
        });
    }
    $(document).on("change","input[type=radio][name=radioInline]",function(e){
	   	e.preventDefault();
           $('#select_temp_notif').prop("disabled", true);
        // $('input[type=radio][name=radioInline]').change(function() {
        if (this.value == '1') {
            notification_type = this.value;
            
        } else if (this.value == '2') {
            notification_type = this.value;
            
        }
        var ops_url = baseurl + 'notification/notification-list-byid';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "notification_type": notification_type
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    var classdata = data.message;
                   $('#select_temp_notif').empty().trigger("change");
                        $('#select_temp_notif').append("<option value='-1' selected>Select Template</option>");
                        $.each(classdata, function(i, v) {
                            $('#select_temp_notif').append("<option value='" + v.notification_id + "' >" +  v.name + "</option>");
                        });
                 //   $('#myModalinterview1').modal('hide');
                 $('#class_id').trigger('change');
                    $('#faculty_loader').removeClass('sk-loading');
                    $('#select_temp_notif').prop("disabled", false);
                }  else {
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                }
            }
        });
    });
    

    
    
</script>