<?php
$priority_img = base_url('assets/img/priority.jpg');
?>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="tooltip" data-placement="right" title="Reload Priorities" href="javascript:void(0)" onclick="load_student_priority_concession();">
                            <i class="fa fa-refresh" style="color: darkmagenta; font-size: 22px;"></i>
                        </a>

                    </div>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <?php
                            $breaker = 0;
                            ?>
                            <?php
                            if (isset($priority_data) && !empty($priority_data)) {
                                foreach ($priority_data as $priority) {
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title" style="border-bottom-color:#ffd300 !important; padding-bottom: 0px;">
                                                <h5 style="color: darkmagenta; text-transform: capitalize;">Priority : <?php echo $priority['priority_number']; ?></h5>
                                            </div>
                                            <div class="ibox-content no-padding" id="faculty_loader">
                                                <table class="table table-striped table-bordered" style="width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <a class="btn btn-primary btn-block" data-toggle="tooltip" data-placement="right" title="View Students - priority <?php echo $priority['priority_number']; ?>" href="javascript:void(0)" onclick="view_students(<?php echo $priority['id']; ?>, <?php echo $priority['priority_number']; ?>);" style="cursor: pointer;">
                                                                    <i class="fa fa-check-circle"></i> View Students
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#account_code_tbl').dataTable({

        columnDefs: [{
            "width": "100%",
            "targets": 0
        }, ],
        responsive: false,
        iDisplayLength: 100,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });

    function view_students(priority_id, priority_number) {
        var ops_url = baseurl + 'fees/get_priority_students/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "priority_id": priority_id,
                "priority_number": priority_number,
                "concession_type": 1
            },
            success: function(result) {
                $('#data-view').html(result);
                $(window).scrollTop(0);
            }
        });
    }
</script>