
<link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet"> 

<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
<link href="<?php //echo base_url('assets/plugins/steps/jquery.steps.min.js');                                                                                    ?>" rel="stylesheet">
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
            //                                                                           dev_export($subject_data);die;
            ?>
        </ol>        
    </div>    
</div>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                                            <!--<h5><?php //echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED"                                                        ?></h5>-->
<!--                                            <span class="input-group-btn"  >
                                                <button type="button" class="btn btn-primary btn-outline" > Promotion</button>      
                                                <button type="button" class="btn btn-primary btn-outline" > Detained </button>      
                                                <button type="button" class="btn btn-primary btn-outline    " > Reappeared</button>      
                        
                                            </span>  
                                            <div data-toggle="buttons-checkbox" class="btn-group">
                                                <button class="btn btn-primary " type="button"> Promotion</button>
                                                <button class="btn btn-primary" type="button"> Detained</button>
                                                <button class="btn btn-primary " type="button">Reappeared</button>
                        
                                            </div>-->
                    <div class="  btn-group" style="margin-left: 20px">
                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Action <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Promotion</a></li>
                            <li><a href="#">Detained</a></li>
                            <li><a href="#">Reappeared</a></li>
                            <li><a href="#">Course Completed    </a></li>

                        </ul>
                    </div> 

                </div>
                <div class="ibox-content ">

                    <div class="row col-lg-5" >
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">From Academic Year :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">From Class :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">From Batch :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row col-lg-5">
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">To Academic Year :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">To Class :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="customer">To Batch :</label>
                                <select class="select2_demo_1 form-control">
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                    <option value="1">2016-17</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row  demo">
                        <div class="col-lg-6">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>In Progress</h3>
                                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                                    <ul id="draggable" style="min-height:250px; list-style: none;" >
                                        <li><img src="<?php echo base_url('assets/img/a8.jpg'); ?>" class="img-circle circle-border" alt="profile" width="60px" height="60px" style="margin-top: 15px;">
                                            <span class="border-left" style="border-left-color: #00c6c7"> &nbsp; Name: Mohammed Yoosuf &nbsp;</span>
                                            <div class="border-left"  style="border-left-color: #00c6c7; margin-left: 63px; margin-top: -31px !important" > &nbsp; Admission No.: 13/254 &nbsp;</div>

                                        </li>
                                        <li><img src="<?php echo base_url('assets/img/a4.jpg'); ?>" class="img-circle circle-border" alt="profile" width="60px" height="60px" style="margin-top: 15px;">
                                            <span class="border-left" style="border-left-color: #00c6c7"> &nbsp; Name: Mohammed Yoosuf &nbsp;</span>
                                            <div class="border-left"  style="border-left-color: #00c6c7; margin-left: 63px; margin-top: -31px !important" > &nbsp; Admission No.: 13/254 &nbsp;</div>

                                        </li>
                                        <li><img src="<?php echo base_url('assets/img/a1.jpg'); ?>" class="img-circle circle-border" alt="profile" width="60px" height="60px" style="margin-top: 15px;">
                                            <span class="border-left" style="border-left-color: #00c6c7"> &nbsp; Name: Mohammed Yoosuf &nbsp;</span>
                                            <div class="border-left"  style="border-left-color: #00c6c7; margin-left: 63px; margin-top: -31px !important" > &nbsp; Admission No.: 13/254 &nbsp;</div>
                                        </li>
                                        <li><img src="<?php echo base_url('assets/img/a2.jpg'); ?>" class="img-circle circle-border" alt="profile" width="60px" height="60px" style="margin-top: 15px;">
                                            <span class="border-left" style="border-left-color: #00c6c7"> &nbsp; Name: Mohammed Yoosuf &nbsp;</span>
                                            <div class="border-left"  style="border-left-color: #00c6c7; margin-left: 63px; margin-top: -31px !important" > &nbsp; Admission No.: 13/254 &nbsp;</div>
                                        </li>
                                        <li><img src="<?php echo base_url('assets/img/a3.jpg'); ?>" class="img-circle circle-border" alt="profile" width="60px" height="60px" style="margin-top: 15px;">
                                            <span class="border-left" style="border-left-color: #00c6c7"> &nbsp; Name: Mohammed Yoosuf &nbsp;</span>
                                            <div class="border-left"  style="border-left-color: #00c6c7; margin-left: 63px; margin-top: -31px !important" > &nbsp; Admission No.: 13/254 &nbsp;</div>
                                        </li>
                                        <li><img src="<?php echo base_url('assets/img/a6.jpg'); ?>" class="img-circle circle-border" alt="profile" width="60px" height="60px" style="margin-top: 15px;">
                                            <span class="border-left" style="border-left-color: #00c6c7"> &nbsp; Name: Mohammed Yoosuf &nbsp;</span>
                                            <div class="border-left"  style="border-left-color: #00c6c7; margin-left: 63px; margin-top: -31px !important" > &nbsp; Admission No.: 13/254 &nbsp;</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ibox">


                                <div class="ibox-content">
                                    <span> <i style="font-size: 30px !important; float: right; color: #23c6c8; padding-right: 0.5px;" class="material-icons" data-toggle="tooltip" title="Save">save</i> </span>
                                    <h3>In Progress</h3>
                                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>

                                    <!--<h3>In Progress</h3>-->
<!--                                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>-->
                                    <ul id="droppable" style="min-height:250px; list-style: none" >
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .ui-state-highlight { 
        background: #dbf6f6}
</style>
<script>

    $(document).ready(function () {
        var selectedClass = 'ui-state-highlight',
                clickDelay = 600,
                // click time (milliseconds)
                lastClick, diffClick; // timestamps

        $("#draggable li")
                // Script to deferentiate a click from a mousedown for drag event
                .bind('mousedown mouseup', function (e) {
                    if (e.type == "mousedown") {
                        lastClick = e.timeStamp; // get mousedown time
                    } else {
                        diffClick = e.timeStamp - lastClick;
                        if (diffClick < clickDelay) {
                            // add selected class to group draggable objects
                            $(this).toggleClass(selectedClass);
                        }
                    }
                })
                .draggable({
                    revertDuration: 10,
                    // grouped items animate separately, so leave this number low
                    containment: '.demo',
                    start: function (e, ui) {
                        ui.helper.addClass(selectedClass);
                    },
                    stop: function (e, ui) {
                        // reset group positions
                        $('.' + selectedClass).css({
                            top: 0,
                            left: 0
                        });
                    },
                    drag: function (e, ui) {
                        // set selected group position to main dragged object
                        // this works because the position is relative to the starting position
                        $('.' + selectedClass).css({
                            top: ui.position.top,
                            left: ui.position.left
                        });
                    }
                });

        $("#droppable, #draggable").sortable().droppable({
            drop: function (e, ui) {
                $('.' + selectedClass).appendTo($(this)).add(ui.draggable) // ui.draggable is appended by the script, so add it after
                        .removeClass(selectedClass).css({
                    top: 0,
                    left: 0
                });
            }
        });

        $(".select2_demo_1").select2({
            "theme": "bootstrap",
            "width": "100%"

        });

    });
</script>