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
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0);">Admission Settings</a>
                        <div class="space-25"></div>
                        <?php if (
                            check_permission(561, 1224, 114) || check_permission(561, 1225, 114) || check_permission(561, 1226, 114)
                        ) { ?>
                            <h5>Admission Settings</h5>
                            <ul class="category-list" style="padding: 0">

                                <?php if (check_permission(561, 1224, 114)) { ?>
                                    <li title="Documents Settings"><a href="javascript:void(0)" onclick="load_needed_documents();"> <i class="fa fa-circle text-warning"></i> Documents Settings </a></li>
                                <?php } ?>
                                <?php if (check_permission(561, 1224, 114)) { ?>
                                    <li title="Assign Staff"><a href="javascript:void(0)" onclick="load_staff_settings();"> <i class="fa fa-circle text-primary"></i> Assign Staff </a></li>
                                <?php } ?>
                                <?php if (check_permission(561, 1224, 114)) { ?>
                                    <li title="Interview Schedule"><a href="javascript:void(0)" onclick="load_interview_schedule();"> <i class="fa fa-circle text-danger"></i> Interview Schedule </a></li>
                                <?php } ?>
                                
                                
                            </ul>
                        <?php } ?>
                        <?php /*if (
                            check_permission(561, 1224, 114) || check_permission(561, 1225, 114) || check_permission(561, 1226, 114)
                        ) { ?>
                            <h5>Interview schedule</h5>
                            <ul class="category-list" style="padding: 0">

                                
                                
                            </ul>
                        <?php }*/ ?> 
                       
                        
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
    load_needed_documents();

    function load_needed_documents() {
        $("#faculty_loader").addClass("sk-loading");

        var ops_url = baseurl + 'online-registration/load-needed-documents';
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
    function load_staff_settings() {
        $("#faculty_loader").addClass("sk-loading");
        var ops_url = baseurl + 'online-registration/load-staff-settings';
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
    function load_interview_schedule() {
        $("#faculty_loader").addClass("sk-loading");
        var ops_url = baseurl + 'online-registration/load-interview-schedule';
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

    
</script>