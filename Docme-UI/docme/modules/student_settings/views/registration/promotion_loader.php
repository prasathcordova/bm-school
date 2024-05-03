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

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <input name="cur_class" type="hidden" id="cur_class" value="<?php echo $cur_class ?>" />
                    <input name="cur_batch" type="hidden" id="cur_batch" value="<?php echo $cur_batch ?>" />
                    <input name="cur_acdyear" type="hidden" id="cur_acdyear" value="<?php echo $cur_acd_id ?>" />
                    <input name="cur_batchname" type="hidden" id="cur_batchname" value="<?php echo $cur_batchname ?>" />
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <?php if (check_permission(506, 1101, 102)) { ?>
                                <li class="active"><?php if ($is_course_complete == 0 || $is_course_complete == 1) { ?><a data-toggle="tab" href="#tab-1"> Promotion</a> <?php } ?></li>
                            <?php } ?>
                            <?php if (check_permission(506, 1102, 102)) { ?>
                                <li class=""><a data-toggle="tab" href="#tab-2">Detained</a></li>
                            <?php } ?>
                            <li class=""><?php if ($is_course_complete == 1 || $is_course_complete == 2) { ?> <a data-toggle="tab" href="#tab-3">Course Completed</a> <?php } ?></li>
                        </ul>
                        <div class="tab-content">
                            <?php if ($is_course_complete == 0 || $is_course_complete == 1) { ?>
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <h5 class=" text-danger pull-left"><?php
                                                                                    if (isset($acd_year) && !empty($acd_year)) {
                                                                                    } else {
                                                                                        echo "Academic year not created";
                                                                                    }
                                                                                    ?></h5>
                                                <span><a href="javascript:void(0);" onclick="submit_promotion();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                                                <div class="clearfix"></div>
                                                <div class="col-lg-6 col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="customer">To Academic Year :</label>
                                                        <select disabled="" class="select2_acdyear form-control input-sm " style="width:100%" name="acdyear" id="promoted_year">
                                                            <option value="-1" selected="">Academic year not created</option>
                                                            <?php
                                                            foreach ($acd_year as $acdyear) {
                                                                echo '<option selected value="' . $acdyear['Acd_ID'] . '">' . $acdyear['Description'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="customer">To Class :</label>
                                                        <?php
                                                        if ($class_count == 1 || $class_count == 0) {
                                                            echo ' <select disabled class="select2_demo_1 form-control" id="promoted_class">';

                                                            if (isset($promoted_class) && !empty($promoted_class)) {
                                                                foreach ($promoted_class as $pclass) {
                                                                    echo '<option  value ="' . $pclass['Course_Det_ID'] . '" >' . $pclass['Description'] . '</option>';
                                                                }
                                                            }
                                                            echo ' </select>';
                                                        }
                                                        if ($class_count > 1) {
                                                            echo ' <select class="select2_demo_1 form-control" onchange="load_promoted_batch();"    id="promoted_class">';
                                                            if (isset($promoted_class) && !empty($promoted_class)) {
                                                                foreach ($promoted_class as $pclass) {
                                                                    echo '<option  value ="' . $pclass['Course_Det_ID'] . '" >' . $pclass['Description'] . '</option>';
                                                                }
                                                            }
                                                            echo ' </select>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="customer">To Batch :</label>
                                                        <?php if($class_count == 0) {
                                                                    $disabled = 'disabled';
                                                        }else{
                                                            $disabled = '';
                                                        }?>
                                                        <select class="select2_demo_1 form-control" id="promoted_batch" <?php echo $disabled;?>>
                                                            <option value="-1" selected="">Select</option>
                                                            <?php
                                                            if (isset($promoted_batch) && !empty($promoted_batch) && isset($acd_year) && !empty($acd_year)) {
                                                                foreach ($promoted_batch as $p_batch) {

                                                                    echo '<option value ="' . $p_batch['BatchID'] . '" >' . $p_batch['Batch_Name'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--                                        </div>
                                                                                    <div class="row">-->
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading" style="font-size: 15px;">Students List (<?php echo $cur_batchname ?>)
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Click here to move students to promote list" onclick="select_students_to_promote();">
                                                            <span class="glyphicon glyphicon-menu-right span-icon-2"></span>
                                                            <span class="glyphicon glyphicon-menu-right"></span>
                                                        </a>
                                                        <?php if (isset($acd_year) && !empty($acd_year)) { ?>
                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Select All/ Deselect All" onclick="select_all_promotion();" data-selectorspro="1" id="select_all_de_select_pro">
                                                                <i class="material-icons">select_all</i>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="scrollerdata" id="to_promote">
                                                            <?php
                                                            if (isset($details_data) && !empty($details_data)) {
                                                                foreach ($details_data as $details) {
                                                            ?>
                                                                    <?php
                                                                    $profile_image = "";
                                                                    if (!empty(get_student_image($details['student_id']))) {
                                                                        $profile_image = get_student_image($details['student_id']);
                                                                    } else if (isset($details['profile_image']) && !empty($details['profile_image'])) {

                                                                        $profile_image = "data:image/png;base64," . $details['profile_image'];
                                                                    } else {
                                                                        if (isset($details['profile_image_alternate']) && !empty($details['profile_image_alternate'])) {
                                                                            $profile_image = $details['profile_image_alternate'];
                                                                        } else {
                                                                            $profile_image = base_url('assets/img/a0.jpg');
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <div class="ibox-new student-block" id="student_<?php echo $details['student_id'] ?>">
                                                                        <div class="stu-photo">
                                                                            <img id="image_student_<?php echo $details['student_id']; ?>" src="<?php echo $profile_image; ?>" />
                                                                        </div>
                                                                        <div class="stu-details">
                                                                            <P>Name : <b><?php echo $details['student_name'] ?></b></p>
                                                                            <P>Admission No. : <b><?php echo $details['Admn_No'] ?></b></p>
                                                                        </div>
                                                                        <div class="i-checks student-list" id="check_<?php echo $details['student_id'] ?>" data-toggle="tooltip" data-placement="top" title="Select students"><label> <input type="checkbox" id="st<?php echo $details['student_id']; ?>" <?php echo isset($acd_year) && !empty($acd_year) ? '' : 'disabled=""'; ?> class="st_check" value="" data-image="<?php echo $profile_image; ?>" data-name="<?php echo $details['student_name'] ?>" data-studentid="<?php echo $details['student_id']; ?>" data-adminno="<?php echo $details['Admn_No'] ?>"> <i></i></label></div>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">Promoted list
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove Students from list" onclick="deselect_students_to_promote();">
                                                            <span class="glyphicon glyphicon-menu-left span-icon-2"></span>
                                                            <span class="glyphicon glyphicon-menu-left"></span>
                                                        </a>
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Select All/ Deselect All" onclick="deselect_all_promotion();" data-selectors2pro="1" id="select_all_de_select2pro">
                                                            <i class="material-icons">select_all</i></i>
                                                        </a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="scrollerdata" id="promoted_student">





                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <h5 class=" text-danger pull-left"><?php
                                                                                if (isset($acd_year) && !empty($acd_year)) {
                                                                                } else {
                                                                                    echo "Academic year not created";
                                                                                }
                                                                                ?></h5>
                                            <span><a href="javascript:void(0);" onclick="submit_detained();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-6 col-xs-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="customer">To Academic Year :</label>
                                                    <select disabled="" class="select2_acdyear form-control input-sm " style="width:100%" name="acdyear" id="detained_year">
                                                        <option value="-1" selected="">Academic year not created</option>
                                                        <?php

                                                        foreach ($acd_year as $acdyear) {
                                                            echo '<option selected value="' . $acdyear['Acd_ID'] . '">' . $acdyear['Description'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-xs-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="customer">To Class :</label>
                                                    <select disabled="" class="select2_demo_1 form-control" id="detained_class">
                                                        <?php
                                                        if (isset($class_data) && !empty($class_data) && is_array($class_data)) {
                                                            foreach ($class_data as $class) {
                                                                if (isset($class['Course_Det_ID']) && !empty($class['Course_Det_ID']) && $detained_class == $class['Course_Det_ID']) {
                                                                    echo '<option selected value="' . $class['Course_Det_ID'] . '">' . $class['Description'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-xs-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="customer">To Batch :</label>
                                                    <select class="select2_demo_1 form-control" id="detained_batch">
                                                        <option value="-1" selected="">Select</option>
                                                        <?php
                                                        if (isset($batch_data) && !empty($batch_data) && isset($acd_year) && !empty($acd_year)) {
                                                            foreach ($batch_data as $value) {

                                                                echo '<option value ="' . $value['BatchID'] . '" >' . $value['Batch_Name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-6 col-xs-6">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">Students List (<?php echo $cur_batchname ?>)
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Select students" onclick="fromdetained_select_student_list();">
                                                        <span class="glyphicon glyphicon-menu-right span-icon-2"></span>
                                                        <span class="glyphicon glyphicon-menu-right"></span>
                                                    </a>
                                                    <?php if (isset($acd_year) && !empty($acd_year)) { ?>
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Select All / Deselect All" onclick=" select_all_detained();" data-selectorsdetain="1" id="select_all_de_selectdetain">
                                                            <i class="material-icons">select_all</i>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="scrollerdata" id="from_detained">
                                                        <?php
                                                        if (isset($details_data) && !empty($details_data)) {
                                                            foreach ($details_data as $details) {
                                                        ?>
                                                                <?php
                                                                $profile_image = "";
                                                                if (!empty(get_student_image($details['student_id']))) {
                                                                    $profile_image = get_student_image($details['student_id']);
                                                                } else if (isset($details['profile_image']) && !empty($details['profile_image'])) {

                                                                    $profile_image = "data:image/png;base64," . $details['profile_image'];
                                                                } else {
                                                                    if (isset($details['profile_image_alternate']) && !empty($details['profile_image_alternate'])) {
                                                                        $profile_image = $details['profile_image_alternate'];
                                                                    } else {
                                                                        $profile_image = base_url('assets/img/a0.jpg');
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="ibox-new student-block-fromdetained" id="fds_<?php echo $details['student_id'] ?>">
                                                                    <div class="stu-photo">
                                                                        <img id="fromdetained_image_post_student_<?php echo $details['student_id']; ?>" src="<?php echo $profile_image; ?>" />
                                                                    </div>
                                                                    <div class="stu-details">
                                                                        <P>Name : <b><?php echo $details['student_name'] ?></b></p>
                                                                        <P>Admission No. : <b><?php echo $details['Admn_No'] ?></b></p>
                                                                    </div>
                                                                    <div class="i-checks fromdetained-student-list" id="fromdetained_check_<?php echo $details['student_id'] ?>" data-toggle="tooltip" data-placement="top" title="Select students"><label> <input type="checkbox" id="fromdetained_st<?php echo $details['student_id']; ?>" class="fromdetained_st_check" <?php echo isset($acd_year) && !empty($acd_year) ? '' : 'disabled=""'; ?> value="" data-fromdetained_image="<?php echo $profile_image; ?>" data-fromdetained_name="<?php echo $details['student_name'] ?>" data-fromdetained_studentid="<?php echo $details['student_id']; ?>" data-fromdetained_admnno="<?php echo $details['Admn_No'] ?>"> <i></i></label></div>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-sm-6 col-xs-6">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">Detained List
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Select students" onclick="todetained_deselect_student_list();">
                                                        <span class="glyphicon glyphicon-menu-left span-icon-2"></span>
                                                        <span class="glyphicon glyphicon-menu-left"></span>
                                                    </a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Select All/ Deselect All" onclick="deselect_all_detained();" data-selectors2detain="1" id="select_all_de_select2detain">
                                                        <i class="material-icons">select_all</i></i>
                                                    </a>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="scrollerdata" id="todetained">



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($is_course_complete == 1 || $is_course_complete == 2) { ?>
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">
                                            <span><a href="javascript:void(0);" onclick="submit_coursecomplete();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 15px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                                        </div><br>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">Students List (<?php echo $cur_batchname ?>)
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Select students" onclick="select_students_to_coursecomplete();">
                                                            <span class="glyphicon glyphicon-menu-right span-icon-2"></span>
                                                            <span class="glyphicon glyphicon-menu-right"></span>
                                                        </a>
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Select All/ Deselect All" onclick="select_all_cc();" data-selectorscomplete="1" id="select_all_de_select_complete">
                                                            <i class="material-icons">select_all</i>
                                                        </a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="scrollerdata" id="from_cc">
                                                            <?php
                                                            if (isset($details_data) && !empty($details_data)) {
                                                                foreach ($details_data as $details) {
                                                            ?>
                                                                    <?php
                                                                    $profile_image = "";
                                                                    if (!empty(get_student_image($details['student_id']))) {
                                                                        $profile_image = get_student_image($details['student_id']);
                                                                    } else if (isset($details['profile_image']) && !empty($details['profile_image'])) {

                                                                        $profile_image = "data:image/png;base64," . $details['profile_image'];
                                                                    } else {
                                                                        if (isset($details['profile_image_alternate']) && !empty($details['profile_image_alternate'])) {
                                                                            $profile_image = $details['profile_image_alternate'];
                                                                        } else {
                                                                            $profile_image = base_url('assets/img/a0.jpg');
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <div class="ibox-new fcc_student-block" id="fcc_student_<?php echo $details['student_id'] ?>">
                                                                        <div class="stu-photo">
                                                                            <img id="fcc_image_student_<?php echo $details['student_id']; ?>" src="<?php echo $profile_image; ?>" />
                                                                        </div>
                                                                        <div class="stu-details">
                                                                            <P>Name : <b><?php echo $details['student_name'] ?></b></p>
                                                                            <P>Admission No. : <b><?php echo $details['Admn_No'] ?></b></p>
                                                                        </div>
                                                                        <div class="i-checks fcc_student-list" id="fcc_check_<?php echo $details['student_id'] ?>" data-toggle="tooltip" data-placement="top" title="Select students"><label> <input type="checkbox" id="fcc_st<?php echo $details['student_id']; ?>" class="fcc_st_check" value="" data-fccimage="<?php echo $profile_image; ?>" data-fccname="<?php echo $details['student_name'] ?>" data-fccstudentid="<?php echo $details['student_id']; ?>" data-fccadminno="<?php echo $details['Admn_No'] ?>"> <i></i></label></div>
                                                                    </div>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">Course Completed List
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Select students" onclick="deselect_students_to_coursecomplete();">
                                                            <span class="glyphicon glyphicon-menu-left span-icon-2"></span>
                                                            <span class="glyphicon glyphicon-menu-left"></span>
                                                        </a>
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Select All/ Deselect All" onclick="deselect_all_cc();" data-selectors2complete="1" id="select_all_de_select2complete">
                                                            <i class="material-icons">select_all</i></i>
                                                        </a>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="scrollerdata" id="to_cc">


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .ui-state-highlight {
        background: #dbf6f6
    }

    .ibox-title {
        border-bottom: solid 2px #F3F3F4 !important
    }

    .panel-info>.panel-heading {
        font-size: 16px;
    }

    .panel-info>.panel-heading a {
        float: right;
        color: #fff;
        margin: 0 0 0 20px;
        position: relative;
    }


    .span-icon-2 {
        position: absolute;
        right: 9px;
        top: 2px;
    }


    .panel-info>.panel-heading a i {
        font-size: 22px;
    }

    .panel-info>.panel-heading a:hover {
        opacity: 0.8;
    }

    .ibox-new {
        background: #fff;
        min-height: 55px;
        border: solid 1px #EAEAEA;
        margin-bottom: 15px;
    }

    .stu-photo {
        display: inline-block;
        width: 55px;
        float: left;
        background: #14B6B8;
    }

    .stu-details {
        display: inline-block;
        padding: 8px 10px;
    }

    .stu-details p {
        margin: 0;
    }

    .stu-photo img {
        width: 100%;
    }

    .i-checks {
        float: right;
        padding: 0 10px;
        line-height: 50px;
    }
</style>
<script>
    $("#promoted_year").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $("#detained_year").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $("#detained_batch").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $("#promoted_batch").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $("#promoted_class").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $("#detained_class").select2({
        "theme": "bootstrap",
        "width": "100%"
    });

    function load_promoted_batch() {
        var acdid = $('#cur_acdyear').val()
        var classid = $('#promoted_class').val()

        var ops_url = baseurl + 'registration/promoted-batch';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acdid": acdid,
                "classid": classid
            },
            success: function(result) {
                $("#promoted_batch").empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batch_data = data.batch_data;
                    $.each(batch_data, function(i, v) {
                        $("#promoted_batch").append("<option value='" + v.BatchID + "' >" + v.Batch_Name + "</option>");
                    });
                    $("#promoted_batch").trigger('change');
                } else {
                    $("#promoted_batch").empty().trigger("change");
                }
            }
        });
    }




    $('.scrollerdata').slimscroll({
        height: '350px'
    });
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });


    function submit_coursecomplete() {
        var cur_class = $("#cur_class").val();
        var cur_batch = $("#cur_batch").val();
        var cur_acdyear = $("#cur_acdyear").val();
        var cur_batchname = $("#cur_batchname").val();
        var promotion = new Object();
        var promo_data = new Array();

        $('.tcc_st_check').each(function(i, v) {
            var student_id = $(v).data('tccstudentid');
            //            promotion.student_id = student_id;
            promo_data.push(student_id);
        });
        var promotion_data = JSON.stringify(promo_data);
        //        alert(promotion_data.length);Return;    
        if (promotion_data.length < 3) {
            swal('Info', 'Select atleast one student for course completeion.', 'info');
            RETURN;
        }

        swal({
            title: '',
            text: 'Do you want to proceed course complete for selected students ?',
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Proceed',
            cancelButtonText: 'Cancel',
            closeOnConfirm: false
        }, function(isconfirm) {
            if (isconfirm) {
                var ops_url = baseurl + 'registration/save-promotion';
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "type": 3,
                        "promotion_data": promotion_data,
                        "class_id": 1,
                        "batchid": 1,
                        "acd_year": 1,
                        "cur_class": cur_class,
                        "cur_batch": cur_batch,
                        "cur_acdyear": cur_acdyear,
                        "cur_batchname": cur_batchname
                    },
                    success: function(result) {
                        var data = JSON.parse(result)
                        if (data.status == 1) {
                            swal('Course Complete', 'Students course completion process completed successfully.', 'success');
                            $('#promotion-content').html(data.view);
                        } else {
                            swal('Info', 'Students Updation Failed.', 'info');
                        }

                    }
                });
            }
        });
    }

    function submit_detained() {
        var acd_year = $("#detained_year").val();
        //        alert (acd_year.length);return
        if (acd_year == -1) {
            swal('Info', 'Academic year not created.', 'info');
            RETURN;
        }


        var class_id = $("#detained_class").val();
        var batchid = $("#detained_batch").val();
        var cur_class = $("#cur_class").val();
        var cur_batch = $("#cur_batch").val();
        var cur_acdyear = $("#cur_acdyear").val();
        var cur_batchname = $("#cur_batchname").val();
        //        alert(cur_batchname);return;
        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            return;
        }
        if (batchid == -1) {
            swal('', 'Batch is required.', 'info');
            return;
        }
        var promotion = new Object();
        var promo_data = new Array();

        $('.todetained_st_check').each(function(i, v) {
            var student_id = $(v).data('todetained_student_id');
            //            alert(student_id);return;
            //            promotion.student_id = student_id;
            promo_data.push(student_id);
        });
        var promotion_data = JSON.stringify(promo_data);
        if (promotion_data.length < 3) {
            swal('Info', 'Select atleast one student for detaining.', 'info');
            RETURN;
        }
        swal({
            title: '',
            text: 'Do you want to detain selected students to ' + $("#detained_class").text() + ' ?',
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Detain',
            cancelButtonText: 'Cancel',
            closeOnConfirm: false
        }, function(isconfirm) {
            if (isconfirm) {
                var ops_url = baseurl + 'registration/save-promotion';
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "type": 2,
                        "promotion_data": promotion_data,
                        "class_id": class_id,
                        "batchid": batchid,
                        "acd_year": acd_year,
                        "cur_class": cur_class,
                        "cur_batch": cur_batch,
                        "cur_acdyear": cur_acdyear,
                        "cur_batchname": cur_batchname
                    },
                    success: function(result) {
                        var data = JSON.parse(result)
                        if (data.status == 1) {
                            swal('Detained', 'Students successfully detained to ' + $("#detained_class").text() + ' ( Batch: ' + $("#detained_batch :selected").text() + ' )', 'success');
                            $('#promotion-content').html(data.view);
                        } else {
                            swal('Info', 'Students Updation Failed.', 'info');
                        }

                    }
                });
            }
        });
    }

    function submit_promotion() {
        var acd_year = $("#promoted_year").val();
        if (acd_year == -1) {
            swal('Info', 'Academic year not created.', 'info');
            RETURN;
        }
        var class_id = $("#promoted_class").val();
        var class_name = $("#promoted_class option:selected").text();
        var batchid = $("#promoted_batch").val();
        var cur_class = $("#cur_class").val();
        var cur_batch = $("#cur_batch").val();
        var cur_acdyear = $("#cur_acdyear").val();
        var cur_batchname = $("#cur_batchname").val();

        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            return;
        }
        if (batchid == -1) {
            swal('', 'Batch is required.', 'info');
            return;
        }
        var promotion = new Object();
        var promo_data = new Array();
        //        var test = [];
        //alert('hui');return
        $('.st_check_promoted').each(function(i, v) {
            //            alert('hufsgsi');return
            var student_id = $(v).data('studentpromotedid');
            //            alert(student_id);return;

            //            promotion.student_id = student_id;
            promo_data.push(student_id);
        });
        var promotion_data = JSON.stringify(promo_data);

        if (promotion_data.length < 3) {
            swal('Info', 'Select atleast one student for promoting.', 'info');
            RETURN;
        }

        swal({
            title: '',
            text: 'Do you want to promote selected students to ' + class_name + ' ?',
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Promote',
            cancelButtonText: 'Cancel',
            closeOnConfirm: false
        }, function(isconfirm) {
            if (isconfirm) {
                var ops_url = baseurl + 'registration/save-promotion';
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "type": 1,
                        "promotion_data": promotion_data,
                        "class_id": class_id,
                        "batchid": batchid,
                        "acd_year": acd_year,
                        "cur_class": cur_class,
                        "cur_batch": cur_batch,
                        "cur_acdyear": cur_acdyear,
                        "cur_batchname": cur_batchname
                    },
                    success: function(result) {
                        var data = JSON.parse(result)
                        if (data.status == 1) {
                            swal('Promoted', 'Students successfully promoted to ' + class_name + ' ( Batch: ' + $("#promoted_batch :selected").text() + ' )', 'success');
                            $('#promotion-content').html(data.view);
                        } else {
                            swal('Info', 'Students Updation Failed.', 'info');
                        }

                    }
                });
            }
        });
    }

    function deselect_students_to_coursecomplete() {

        $('#faculty_loader').addClass('sk-loading');
        setTimeout(function() {

            $('.tcc_st_check').each(function(i, v) {
                if ($(v).prop('checked') == true) {
                    var student_id = $(v).data('tccstudentid');
                    var student_name = $(v).data('tccname');
                    var admnno = $(v).data('tccadminno');
                    var st_image = $(v).data('tccimage');
                    var htmlto = '<div class="ibox-new fcc_student-block" id="fcc_student_' + student_id + '"><div class="stu-photo"><img id="fcc_image_student_' + student_id + '" src=""/></div><div class="stu-details"><P>Name : <b>' + student_name + '</b></p><P>Admission No. : <b>' + admnno + '</b></p></div><div class="i-checks fcc_student-list"  id="fcc_check_"' + student_id + ' data-toggle="tooltip" data-placement="top" title="Select students"><label><input type="checkbox" id="fcc_st"' + student_id + ' class="fcc_st_check" value=""  data-fccimage="' + st_image + '"  data-fccname="' + student_name + '" data-fccstudentid="' + student_id + '"   data-fccadminno="' + admnno + '" > <i></i></label></div></div>'
                    var imagestudid = '#fcc_image_student_' + student_id;
                    $('#from_cc').append(htmlto);
                    var block1 = '#tcc_student_' + student_id;
                    $(imagestudid).attr('src', $(v).data('tccimage'))
                    $(block1).remove();

                }
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
            $('#select_all_de_select2complete').data('selectors2complete', '1');
            $('#faculty_loader').removeClass('sk-loading');
        }, 100);


    }

    function select_students_to_coursecomplete() {
        $('.fcc_st_check').each(function(i, v) {
            console.log($(v).prop('checked'))
            if ($(v).prop('checked') == true) {
                var student_id = $(v).data('fccstudentid');
                var student_name = $(v).data('fccname');
                var admnno = $(v).data('fccadminno');
                var st_image = $(v).data('fccimage');
                //                alert(student_id);
                var htmlto = '<div class="ibox-new tcc_student-block" id="tcc_student_' + student_id + '"><div class="stu-photo"><img id="tcc_image_post_student_' + student_id + '" src=""/></div><div class="stu-details"><P>Name : <b>' + student_name + '</b></p><P>Admission No. : <b>' + admnno + '</b></p></div><div class="i-checks tcc_student-list"  data-toggle="tooltip" data-placement="top" title="De select students from course completion"><label><input type="checkbox" id="tcc_st"' + student_id + ' class="tcc_st_check" value=""  data-tccimage="' + st_image + '"  data-tccname="' + student_name + '" data-tccstudentid="' + student_id + '"   data-tccadminno="' + admnno + '" > <i></i></label></div></div>'
                var imagestudid = '#tcc_image_post_student_' + student_id;
                $('#to_cc').append(htmlto);
                var block1 = '#fcc_student_' + student_id;
                $(imagestudid).attr('src', $(v).data('fccimage'))
                $(block1).remove();

            }
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            $('#select_all_de_select_complete').data('selectorscomplete', '1');
        })
    }

    function fromdetained_select_student_list() {

        $('#faculty_loader').addClass('sk-loading');
        var checked_flag = 1;
        setTimeout(function() {

            $('.fromdetained_st_check').each(function(i, v) {
                if ($(v).prop('checked') == true) {
                    checked_flag = 2;
                    var student_id = $(v).data('fromdetained_studentid');
                    var student_name = $(v).data('fromdetained_name');
                    var admnno = $(v).data('fromdetained_admnno');
                    var st_image = $(v).data('fromdetained_image');
                    var htmlto = '<div class="ibox-new student-block-todetained" id="todetained_student_' + student_id + '"><div class="stu-photo"><img id="todetained_image_post_student_' + student_id + '" src=""/></div><div class="stu-details"><P>Name : <b>' + student_name + '</b></p><P>Admission No. : <b>' + admnno + '</b></p></div><div class="i-checks todetained-student-list"  data-toggle="tooltip" data-placement="top" title="De select students from detained list"><label><input type="checkbox" id="todetained_st_"' + student_id + ' class="todetained_st_check" value=""  data-todetaiend_image="' + st_image + '"  data-todetained_name="' + student_name + '" data-todetained_student_id="' + student_id + '"   data-todetained_admnno="' + admnno + '" > <i></i></label></div></div>'
                    var imagestudid = '#todetained_image_post_student_' + student_id;
                    $('#todetained').append(htmlto);
                    var block1 = '#fds_' + student_id;
                    $(imagestudid).attr('src', $(v).data('fromdetained_image'))
                    $(block1).remove();
                }
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                $('#select_all_de_selectdetain').data('selectorsdetain', '1');
            });

            $('#faculty_loader').removeClass('sk-loading');
            if (checked_flag == 1) {
                $('#faculty_loader').removeClass('sk-loading');
                swal('', 'Select students for detaining.', 'info');
                return false;
            }
        }, 100);
    }

    function todetained_deselect_student_list() {

        $('#faculty_loader').addClass('sk-loading');
        setTimeout(function() {

            $('.todetained_st_check').each(function(i, v) {
                if ($(v).prop('checked') == true) {
                    var student_id = $(v).data('todetained_student_id');
                    var student_name = $(v).data('todetained_name');
                    var admnno = $(v).data('todetained_admnno');
                    var st_image = $(v).data('todetaiend_image');
                    var htmlto = '<div class="ibox-new student-block-fromdetained" id="fds_' + student_id + '"> <div class="stu-photo"><img id="fromdetained_image_post_student_' + student_id + '" src=""/></div><div class="stu-details"><P>Name : <b>' + student_name + '</b></p><P>Admission No. : <b>' + admnno + '</b></p></div><div class="i-checks fromdetained-student-list" id="fromdetained_check_' + student_id + '" data-toggle="tooltip" data-placement="top" title="Select students"><label> <input type="checkbox" id="fromdetained_st' + student_id + '" class="fromdetained_st_check" value="" data-fromdetained_image="' + st_image + '"  data-fromdetained_name="' + student_name + '" data-fromdetained_studentid="' + student_id + '"   data-fromdetained_admnno="' + admnno + '" > <i></i></label></div> </div>'
                    var imagestudid = '#fromdetained_image_post_student_' + student_id;
                    $('#from_detained').append(htmlto);
                    var block1 = '#todetained_student_' + student_id;
                    $(imagestudid).attr('src', $(v).data('todetaiend_image'))
                    $(block1).remove();
                }
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                $('#select_all_de_select2detain').data('selectors2detain', '1');
            });

            $('#faculty_loader').removeClass('sk-loading');
        }, 100);

    }

    function select_students_to_promote() {

        $('#faculty_loader').addClass('sk-loading');
        var checked_flag = 1;
        setTimeout(function() {
            $('.st_check').each(function(i, v) {

                if ($(v).prop('checked') == true) {
                    checked_flag = 2;
                    var student_id = $(v).data('studentid');
                    var student_name = $(v).data('name');
                    var admnno = $(v).data('adminno');
                    var st_image = $(v).data('image');
                    var htmlto = '<div class="ibox-new student-block-promoted" id="promoted_student_' + student_id + '"><div class="stu-photo"><img id="image_post_student_' + student_id + '" src=""/></div><div class="stu-details"><P>Name : <b>' + student_name + '</b></p><P>Admission No. : <b>' + admnno + '</b></p></div><div class="i-checks student-list-promoted"  data-toggle="tooltip" data-placement="top" title="Deselect students from promotion"><label><input type="checkbox" id="st_promoted_"' + student_id + ' class="st_check_promoted" value=""  data-promotedimage="' + st_image + '"  data-promotedname="' + student_name + '" data-studentpromotedid="' + student_id + '"   data-promotedadminno="' + admnno + '" > <i></i></label></div></div>'
                    var imagestudid = '#image_post_student_' + student_id;
                    $('#promoted_student').append(htmlto);
                    var block1 = '#student_' + student_id;
                    $(imagestudid).attr('src', $(v).data('image'))
                    $(block1).remove();

                }
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                $('#select_all_de_select_pro').data('selectorspro', '1');
            })

            $('#faculty_loader').removeClass('sk-loading');
            if (checked_flag == 1) {
                $('#faculty_loader').removeClass('sk-loading');
                swal('', 'Select students for promoting.', 'info');
                return false;
            }
        }, 100);


    }

    function deselect_students_to_promote() {
        $('#faculty_loader').addClass('sk-loading');
        setTimeout(function() {
            $('.st_check_promoted').each(function(i, v) {

                if ($(v).prop('checked') == true) {
                    var student_id = $(v).data('studentpromotedid');
                    var student_name = $(v).data('promotedname');
                    var admnno = $(v).data('promotedadminno');
                    var st_image = $(v).data('promotedimage');
                    var htmlto = '<div class="ibox-new student-block" id="student_' + student_id + '"><div class="stu-photo"><img id="image_student_' + student_id + '" src=""/></div><div class="stu-details"><P>Name : <b>' + student_name + '</b></p><P>Admission No. : <b>' + admnno + '</b></p></div><div class="i-checks student-list"  data-toggle="tooltip" data-placement="top" title="Select students"><label><input type="checkbox" id="st" class="st_check" value=""  data-image="' + st_image + '" data-name="' + student_name + '" data-studentid="' + student_id + '"   data-adminno="' + admnno + '" > <i></i></label></div></div>'
                    var imagestudid = '#image_student_' + student_id;
                    $('#to_promote').append(htmlto);
                    var block1 = '#promoted_student_' + student_id;
                    $(imagestudid).attr('src', $(v).data('promotedimage'))
                    $(block1).remove();

                }
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                $('#select_all_de_select2pro').data('selectors2pro', '1');
            });

            $('#faculty_loader').removeClass('sk-loading');
        }, 100);


    }


    function select_all_promotion() {
        if ($('#select_all_de_select_pro').data('selectorspro') == 1) {
            $('#select_all_de_select_pro').data('selectorspro', '0')
            $('.st_check').prop('checked', true);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        } else {
            $('#select_all_de_select_pro').data('selectorspro', '1')
            $('.st_check').prop('checked', false);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    }

    function deselect_all_promotion() {
        if ($('#select_all_de_select2pro').data('selectors2pro') == 1) {
            $('#select_all_de_select2pro').data('selectors2pro', '0')
            $('.st_check_promoted').prop('checked', true);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        } else {
            $('#select_all_de_select2pro').data('selectors2pro', '1');
            $('.st_check_promoted').prop('checked', false);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    }

    function select_all_detained() {
        if ($('#select_all_de_selectdetain').data('selectorsdetain') == 1) {
            $('#select_all_de_selectdetain').data('selectorsdetain', '0')
            $('.fromdetained_st_check').prop('checked', true);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        } else {
            $('#select_all_de_selectdetain').data('selectorsdetain', '1')
            $('.fromdetained_st_check').prop('checked', false);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    }

    function deselect_all_detained() {
        if ($('#select_all_de_select2detain').data('selectors2detain') == 1) {
            $('#select_all_de_select2detain').data('selectors2detain', '0')
            $('.todetained_st_check').prop('checked', true);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        } else {
            $('#select_all_de_select2detain').data('selectors2detain', '1')
            $('.todetained_st_check').prop('checked', false);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    }

    function select_all_cc() {
        if ($('#select_all_de_select_complete').data('selectorscomplete') == 1) {
            $('#select_all_de_select_complete').data('selectorscomplete', '0')
            $('.fcc_st_check').prop('checked', true);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        } else {
            $('#select_all_de_select_complete').data('selectorscomplete', '1')
            $('.fcc_st_check').prop('checked', false);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    }

    function deselect_all_cc() {
        if ($('#select_all_de_select2complete').data('selectors2complete') == 1) {
            $('#select_all_de_select2complete').data('selectors2complete', '0')
            $('.fcc_st_check').prop('checked', true);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        } else {
            $('#select_all_de_select2complete').data('selectors2complete', '1')
            $('.fcc_st_check').prop('checked', false);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    }
</script>