<?php
$priority_img = base_url('assets/img/priority.jpg');
// $monthNum = 0;
// $monthName = date("m", mktime(0, 0, 0, $monthNum, 10));
// echo $monthName;
?>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <?php if ($is_applied_this_month != 1) { ?>
                            <a href="javascript:void(0)" onclick="apply_student_concession()" class="btn btn-warning btn-md" style="color: #fff;">
                                <i class="fa fa-money" data-toggle="tooltip" title="Apply Concession"></i>
                                Apply Concession
                            </a>
                        <?php } ?>
                        <a data-toggle="tooltip" data-placement="right" title="Reload Priorities" href="javascript:void(0)" onclick="load_priority();">
                            <i class="fa fa-refresh" style="color: darkmagenta; font-size: 22px;"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="wrapper wrapper-content animated fadeInRight tabs-container">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="javascript:void(0)" onclick="load_priority();">Student Concession Slab</a></li>
                            <!-- <li class=""><a data-toggle="tab" href="javascript:void(0)" onclick="load_staff_priority();">Staff Concession Slab</a></li> -->
                        </ul>
                        <div id="student-data-container">
                            <!-- <div class="row">
                                <?php
                                $breaker = 0;
                                ?>
                                <div class="col-lg-6">
                                    <div class="m-b-sm">
                                        <img alt="image" style="width:80px!important;" src="<?php echo $priority_img; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <a class="btn btn-danger btn-large pull-right" data-toggle="tooltip" data-placement="right" title="Staff Priorities" href="javascript:void(0)" onclick="load_staff_priority();">
                                        <i class="fa fa-check-circle"></i> Staff Concession Slab
                                    </a>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    if (isset($priority_data) && !empty($priority_data)) {
                                        foreach ($priority_data as $priority) {
                                            $p_feecode_raw = null;
                                            $p_feecode_raw = (isset($priority['FEECODES']) && !empty($priority['FEECODES'])) ? json_decode($priority['FEECODES'], TRUE) : NULL;
                                            if (!is_array($p_feecode_raw)) $p_feecode_raw  = array();
                                    ?>
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-title" style="border-bottom-color:#ffd300 !important; padding-bottom: 0px;">
                                                    <h5 style="color: darkmagenta; text-transform: capitalize;">Priority : <?php echo $priority['priority_number']; ?></h5>
                                                    <div class="ibox-tools" id="add_type">
                                                        <?php //if (count($p_feecode_raw) == 0) { 
                                                        ?>
                                                        <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Manage Fee Codes for the priority <?php echo $priority['priority_number']; ?>" href="javascript:void(0)" onclick="manage_feecodes('<?php echo $priority['id']; ?>', '<?php echo $priority['priority_number']; ?>');">
                                                            <i class="fa fa-check-circle"></i> Manage Fee Codes
                                                        </a>
                                                        <?php //} 
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="ibox-content no-padding" id="faculty_loader">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Fee Code</th>
                                                                <th>Description</th>
                                                                <th>Demand Type</th>
                                                                <th>Concession %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($p_feecode_raw) && !empty($p_feecode_raw)) {
                                                                foreach ($p_feecode_raw as $feecodes) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $feecodes['FCODE'][0]['feeCode']; ?></td>
                                                                        <td><?php echo $feecodes['FCODE'][0]['description']; ?></td>
                                                                        <td><?php echo $feecodes['FCODE'][0]['demandType'] == 1 ? 'Demandable' : 'Non Demandable' ?></td>
                                                                        <td><?php echo $feecodes['discount']; ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="4" class="text-center">No Fee Codes assigned till now.</td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
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

    function manage_feecodes(priority_id, priority_number) {
        var ops_url = baseurl + 'fees/manage-priority/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "priority_id": priority_id,
                "priority_number": priority_number
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    $(window).scrollTop(0);
                } else {
                    swal('', 'There is no data associated with this priority', 'info')
                    return false;
                }

            }
        });
    }

    function apply_student_concession() {
        var ops_url = baseurl + 'fees/apply_student_concession/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Student Concession', 'Concession Applied Successfully.', 'info')
                } else {
                    swal('Student Concession', data.message, 'warning')
                    return false;
                }

            }
        });
    }
</script>