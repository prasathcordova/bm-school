<!--This page created by Elavarasan S @ 16-05-2019 2:00-->
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
            // dev_export($subject_data);die;
            ?>
        </ol>        
    </div>    
</div>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content" id="tc-content">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="row">                        
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <i class="fa fa-info-circle"></i> TC Information
                                </div>
                                <div class="panel-body">
                                    <div class="wrapper wrapper-content animated fadeInRight">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="tabs-container">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a data-toggle="tab" href="#tab-1"> TC Applied List</a></li>
                                                        <li class=""><a data-toggle="tab" href="#tab-2">TC Prepared & Issued List</a></li>
<!--                                                        create two tab by vinoth @ 21-05-2019 14:27 -->
                                                        <li class=""><a data-toggle="tab" href="#tab-3">TC Issue Cancel</a></li>
                                                        <li class=""><a data-toggle="tab" href="#tab-4">TC Re-print</a></li>
                                                        <!--<li class=""><a data-toggle="tab" href="#tab-3">TC Issued</a></li>-->
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div id="tab-1" class="tab-pane active">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <?php
                                                                    if (isset($app_details_data) && !empty($app_details_data) && is_array($app_details_data)) {
                                                                        $breaker = 0;

                                                                        foreach ($app_details_data as $student) {
                                                                            ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="contact-box center-version">

                                                                                    <a href="javascript:void(0);" style="padding-bottom: 0;">
                                                                                        <?php
                                                                                        $profile_image = "";
                                                                                        if(!empty(get_student_image($student['student_id']))) {
                                                                                            $profile_image = get_student_image($student['student_id']);
                                                                                        } else if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                                                            $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                                                        } else {
                                                                                            if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                                                                $profile_image = $student['profile_image_alternate'];
                                                                                            } else {
                                                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                                                            }
                                                                                        }
                                                                                        ?>

                                                                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                                                        <h3 class="m-b-xs" style="height:48px;overflow: hidden;"><strong><?php echo $student['name'] ?></strong></h3>
                                                                                    </a>
                                                                                    <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; ">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Admission No. 
                                                                                                </td>
                                                                                                <td>
                                                                                                    :<b>  <?php echo $student['admn_no'] ?></b>      
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Batch Name  
                                                                                                </td>
                                                                                                <td>
                                                                                                    :<b> <?php echo $student['batch_name'] ?></b>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Parent Name 
                                                                                                </td>
                                                                                                <td>
                                                                                                    : <b>  <?php echo $student['name_of_guardian_in_application'] ?></b>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Contact No 
                                                                                                </td>
                                                                                                <td>
                                                                                                    : <b> <?php echo $student['mob'] ?></b>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    TC Applied Date 
                                                                                                </td>
                                                                                                <td>
                                                                                                    : <b>  <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                                                </td>
                                                                                            </tr>



                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="contact-box-footer">
                                                                                        <div class="m-t-md ">
                                                                                            <a class="btn btn-xs btn-info" onclick="tc_cancellation('<?php echo $student['student_id']; ?>', '<?php echo $student['name']; ?>');" title="Cancel"> Cancel</a>                                                
                                                                                            <a class="btn btn-xs btn-info"  onclick="tc_preparation('<?php echo $student['student_id']; ?>');" title="Prepare & Issue"> Prepare & Issue</a>
                                                                                            <!--<a class="btn btn-xs btn-info" onclick="tc_issue('<?php echo $student['student_id']; ?>');"> Issue</a>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <?php
                                                                            if ($breaker == 2) {
                                                                                echo '<div class="clearfix"></div>';
                                                                                $breaker = 0;
                                                                            } else {
                                                                                $breaker ++;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        ?> 
                                                                        <div>
                                                                            <h3><strong> No data available.</strong></h3> </div>
                                                                        <?php
                                                                    }
                                                                    ?>



                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="tab-2" class="tab-pane">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <?php
                                                                    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                                        $breaker = 0;
                                                                        $count = 0;
                                                                        foreach ($details_data as $student) {
                                                                            if(!isset($student["issued_by"])) {
                                                                            ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="contact-box center-version">

                                                                                    <a href="javascript:void(0);" style="padding-bottom: 0;">
                                                                                        <?php
                                                                                        $profile_image = "";
                                                                                        if(!empty(get_student_image($student['student_id']))) {
                                                                                            $profile_image = get_student_image($student['student_id']);
                                                                                        } else if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                                                            $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                                                        } else {
                                                                                            if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                                                                $profile_image = $student['profile_image_alternate'];
                                                                                            } else {
                                                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                                                        <h3 class="m-b-xs" style="height:48px;overflow: hidden;"><strong><?php echo $student['name'] ?></strong></h3>



                                                                                    </a>
                                                                                    <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; margin: 0; ">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Admission No. 
                                                                                                </td>
                                                                                                <td>
                                                                                                    :<b>  <?php echo $student['admn_no'] ?></b>      
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Batch Name  
                                                                                                </td>
                                                                                                <td>
                                                                                                    :<b> <?php echo $student['batch_name'] ?></b>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    TC Applied Date 
                                                                                                </td>
                                                                                                <td>
                                                                                                    : <b>  <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">
                                                                                                    <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                                        <label class="control-label">Receiving Person Name</label><span class="mandatory" > *</span>
                                                                                                        <input  class="form-control received_by" maxlength="30" minlength="3" placeholder="Receiving Person Name" data-toggle="tooltip" title="Enter TC received person name" value="" />
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">
                                                                                                    <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                                        <label class="control-label">Issuing Person Name</label><span class="mandatory" > *</span>
                                                                                                        <input  class="form-control issued_by" maxlength="30" minlength="3" placeholder="Issuing Person Name" data-toggle="tooltip" title="Enter TC issued person name" value="" />
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="contact-box-footer">
                                                                                        <div class="m-t-md ">
                                                                                            <a class="btn btn-xs btn-info" onclick="tc_issue('<?php echo $student['student_id']; ?>', event);" title="Print"> Print</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            if ($breaker == 2) {
                                                                                echo '<div class="clearfix"></div>';
                                                                                $breaker = 0;
                                                                            } else {
                                                                                $breaker ++;
                                                                            }
                                                                            $count++;
                                                                            }
                                                                        }
                                                                        if($count == 0) {
                                                                            ?>
                                                                             <h3><strong> No data available.</strong></h3>   
                                                                        <?php    
                                                                        }
                                                                    } else {
                                                                        ?> 
                                                                        <div>
                                                                            <h3><strong> No data available.</strong></h3> </div>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </div>
                                                        </div>
<!--                                                        create tab-3,tab-4 content by vinoth k @ 21-05-2019 14:30-->
                                                        <div id="tab-3" class="tab-pane">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <?php
                                                                    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                                        $breaker = 0;
                                                                        foreach ($details_data as $student) {
                                                                            ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="contact-box center-version">

                                                                                    <a href="javascript:void(0);" style="padding-bottom: 0;">
                                                                                        <?php
                                                                                        $profile_image = "";
                                                                                        if(!empty(get_student_image($student['student_id']))) {
                                                                                            $profile_image = get_student_image($student['student_id']);
                                                                                        } else if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                                                            $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                                                        } else {
                                                                                            if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                                                                $profile_image = $student['profile_image_alternate'];
                                                                                            } else {
                                                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                                                        <h3 class="m-b-xs" style="height:48px;overflow: hidden;"><strong><?php echo $student['name'] ?></strong></h3> 

                                                                                    </a>
                                                                                    <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; margin: 0; ">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Admission No. 
                                                                                                </td>
                                                                                                <td>
                                                                                                    :<b>  <?php echo $student['admn_no'] ?></b>      
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Batch Name  
                                                                                                </td>
                                                                                                <td>
                                                                                                    :<b> <?php echo $student['batch_name'] ?></b>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    TC Applied Date 
                                                                                                </td>
                                                                                                <td>
                                                                                                    : <b>  <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="contact-box-footer">
                                                                                        <div class="m-t-md ">
                                                                                          
                                                                                            <a class="btn btn-xs btn-info"  onclick="tc_prep_cancel('<?php echo $student['student_id']; ?>', '<?php echo $student['name']; ?>');" title="Cancel"> Cancel</a>
                                                                                        
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <?php
                                                                            if ($breaker == 2) {
                                                                                echo '<div class="clearfix"></div>';
                                                                                $breaker = 0;
                                                                            } else {
                                                                                $breaker ++;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        ?> 
                                                                        <div>
                                                                            <h3><strong> No data available.</strong></h3> </div>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="tab-4" class="tab-pane">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <?php
                                                                    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                                        $breaker = 0;
                                                                        $count = 0;
                                                                        foreach ($details_data as $student) {
                                                                            if(isset($student["issued_by"]) && !empty($student["issued_by"])) {
                                                                            ?>
                                                                            <div class="col-lg-4">
                                                                                <div class="contact-box center-version">

                                                                                    <a href="javascript:void(0);" style="padding-bottom: 0;">
                                                                                        <?php
                                                                                        $profile_image = "";
                                                                                        if(!empty(get_student_image($student['student_id']))) {
                                                                                            $profile_image = get_student_image($student['student_id']);
                                                                                        } else if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                                                            $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                                                        } else {
                                                                                            if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                                                                $profile_image = $student['profile_image_alternate'];
                                                                                            } else {
                                                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                                                        <h3 class="m-b-xs" style="height:48px;overflow: hidden;"><strong><?php echo $student['name'] ?></strong></h3>

                                                                                    </a>
                                                                                    <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; margin: 0; ">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Admission No. 
                                                                                                </td>
                                                                                                <td>
                                                                                                    :<b>  <?php echo $student['admn_no'] ?></b>      
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    Batch Name  
                                                                                                </td>
                                                                                                <td>
                                                                                                    :<b> <?php echo $student['batch_name'] ?></b>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    TC Applied Date 
                                                                                                </td>
                                                                                                <td>
                                                                                                    : <b>  <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">
                                                                                                    <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                                        <label class="control-label">Receiving Person Name</label><span class="mandatory" > *</span>
                                                                                                        <input  class="form-control received_by" maxlength="200" minlength="3" data-toggle="tooltip" disabled=" "title="TC received person name" value="<?php echo $student["recieved_by"]; ?>" />
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">
                                                                                                    <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                                        <label class="control-label">Issuing Person Name</label><span class="mandatory" > *</span>
                                                                                                        <input  class="form-control issued_by" maxlength="200" minlength="3" data-toggle="tooltip" disabled="" title="TC issued person name" value="<?php echo $student["issued_by"]; ?>" />
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="contact-box-footer">
                                                                                        <div class="m-t-md ">
                                                                                            <a class="btn btn-xs btn-info"  onclick="tc_reprint('<?php echo $student['student_id']; ?>', '<?php echo $student["recieved_by"]; ?>', '<?php echo $student["issued_by"]; ?>');" title="Re-Print"> Re-Print</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <?php
                                                                            $count++;
                                                                            if ($breaker == 2) {
                                                                                echo '<div class="clearfix"></div>';
                                                                                $breaker = 0;
                                                                            } else {
                                                                                $breaker ++;
                                                                            }
                                                                            }
                                                                        }
                                                                        if($count == 0) {
                                                                            ?>
                                                                            <div>
                                                                                <h3><strong> No data available.</strong></h3> 
                                                                            </div>
                                                                    <?php
                                                                        }
                                                                    } else {
                                                                        ?> 
                                                                        <div>
                                                                            <h3><strong> No data available.</strong></h3> 
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
<!--                                                <div class="row">
                                                    <?php
                                                    if (isset($app_details_data) && !empty($app_details_data) && is_array($app_details_data)) {
                                                        $breaker = 0;

                                                        foreach ($app_details_data as $student) {
                                                            ?>
                                                            <div class="col-lg-4">
                                                                <div class="contact-box center-version">

                                                                    <a href="javascript:void(0);">
                                                                        <?php
                                                                        $profile_image = "";
                                                                        if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                                            $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                                        } else {
                                                                            if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                                                $profile_image = $student['profile_image_alternate'];
                                                                            } else {
                                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                                            }
                                                                        }
                                                                        ?>

                                                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                                        <h3 class="m-b-xs"><strong><?php echo $student['name'] ?></strong></h3>
                                                                    </a>
                                                                    <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; ">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    Admission No. 
                                                                                </td>
                                                                                <td>
                                                                                    :<b>  <?php echo $student['admn_no'] ?></b>      
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    Batch Name  
                                                                                </td>
                                                                                <td>
                                                                                    :<b> <?php echo $student['batch_name'] ?></b>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    Parent Name 
                                                                                </td>
                                                                                <td>
                                                                                    : <b>  <?php echo $student['name_of_guardian_in_application'] ?></b>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    Contact No 
                                                                                </td>
                                                                                <td>
                                                                                    : <b> <?php echo $student['mob'] ?></b>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    TC Applied Date 
                                                                                </td>
                                                                                <td>
                                                                                    : <b>  <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                                </td>
                                                                            </tr>



                                                                        </tbody>
                                                                    </table>
                                                                    <div class="contact-box-footer">
                                                                        <div class="m-t-md ">
                                                                            <a class="btn btn-xs btn-info" onclick="tc_cancellation('<?php echo $student['student_id']; ?>', '<?php echo $student['name']; ?>');"> Cancel</a>                                                
                                                                            <a class="btn btn-xs btn-info"  onclick="tc_preparation('<?php echo $student['student_id']; ?>');"> Prepare & Issue</a>
                                                                            <a class="btn btn-xs btn-info" onclick="tc_issue('<?php echo $student['student_id']; ?>');"> Issue</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <?php
                                                            if ($breaker == 2) {
                                                                echo '<div class="clearfix"></div>';
                                                                $breaker = 0;
                                                            } else {
                                                                $breaker ++;
                                                            }
                                                        }
                                                    } else if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                        $breaker = 0;
                                                        foreach ($details_data as $student) {
                                                            ?>
                                                            <div class="col-lg-4">
                                                                <div class="contact-box center-version">

                                                                    <a href="javascript:void(0);">
                                                                        <?php
                                                                        $profile_image = "";
                                                                        if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                                            $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                                        } else {
                                                                            if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                                                $profile_image = $student['profile_image_alternate'];
                                                                            } else {
                                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                                        <h3 class="m-b-xs"><strong><?php echo $student['name'] ?></strong></h3>



                                                                    </a>
                                                                    <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; margin: 0; ">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    Admission No. 
                                                                                </td>
                                                                                <td>
                                                                                    :<b>  <?php echo $student['admn_no'] ?></b>      
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    Batch Name  
                                                                                </td>
                                                                                <td>
                                                                                    :<b> <?php echo $student['batch_name'] ?></b>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    TC Applied Date 
                                                                                </td>
                                                                                <td>
                                                                                    : <b>  <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                        <label class="control-label">Receiving Person Name</label><span class="mandatory" > *</span>
                                                                                        <input  class="form-control received_by" maxlength="200" minlength="3" data-toggle="tooltip" title="Enter TC received person name" value="" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                        <label class="control-label">Issuing Person Name</label><span class="mandatory" > *</span>
                                                                                        <input  class="form-control issued_by" maxlength="200" minlength="3" data-toggle="tooltip" title="Enter TC issued person name" value="" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="contact-box-footer">
                                                                        <div class="m-t-md ">

                                                                            <a class="btn btn-xs btn-info"  onclick="tc_issue('<?php echo $student['student_id']; ?>', event);"> Print</a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <?php
                                                            if ($breaker == 2) {
                                                                echo '<div class="clearfix"></div>';
                                                                $breaker = 0;
                                                            } else {
                                                                $breaker ++;
                                                            }
                                                        }
                                                    } else {
                                                        ?> 
                                                        <div>
                                                            <h3><strong> No data available.</strong></h3> </div>
                                                        <?php
                                                    }
                                                    ?>





                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      


<script>

    function tc_preparation(student_id) {
        var cur_acdyear = $("#cur_acdyear").val();
        var cur_batchid = $("#cur_batchid").val();
        var ops_url = baseurl + 'tc/tc-preparation/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //            data: {"load": 1, "studentid": student_id},
            data: {"student_id": student_id, "cur_batchid": cur_batchid, "cur_acdyear": cur_acdyear},
            success: function (data) {
                $('#tc-content').html('');
                $('#tc-content').html(data);
                
            }
        });
    }
    function tc_cancellation(student_id, name) {
        var cur_acdyear = $("#cur_acdyear").val();
        var cur_batchid = $("#cur_batchid").val();
        var ops_url = baseurl + 'tc/tc-cancel/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //            data: {"load": 1, "studentid": student_id},
            data: {"student_id": student_id, "name": name, "cur_acdyear": cur_acdyear, "cur_batchid": cur_batchid},
            success: function (result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', 'TC cancelled successfully', 'success');
                    $('#content').html(atob(data.view));
                    //Pass batch id to view and then to function, then actvate below code with batchid variable        
                    //load_students_after_filter('406')
                    reload();
                    return true;
                }
            }
        });
    }
    function tc_issue(student_id, e) {
        //modified by vinoth k @15-05-2019 4:05
        var tc_receved_by = $(e.target).parents('div.contact-box-footer')
                                        .siblings('table').children('tbody').children('tr')
                                        .children('td').children('div.form-group').children('input.received_by');
        var tc_issued_by = $(e.target).parents('div.contact-box-footer')
                                        .siblings('table').children('tbody').children('tr')
                                        .children('td').children('div.form-group').children('input.issued_by');
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (tc_receved_by.val().trim().length == 0) {
            swal('', 'Received person name is required.', 'info');
            return false;
        }
        if (!alphanumers.test(tc_receved_by.val())) {
            swal('', 'Received person name can have only alphabets', 'info');
            return false;
        }
        if (tc_issued_by.val().trim().length == 0) {
            swal('', 'Issued person name is required.', 'info');
            return false;
        }
        if (!alphanumers.test(tc_issued_by.val())) {
            swal('', 'Issued person name can have only alphabets', 'info');
            return false;
        }

        var cur_acdyear = $("#cur_acdyear").val();
        var cur_batchid = $("#cur_batchid").val();
        $('#tc-content').addClass('sk-loading')
        var ops_url = baseurl + 'tc/tc-issuing/';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {"load": 1, "student_id": student_id, "cur_acdyear": cur_acdyear, "cur_batchid": cur_batchid, "tc_receved_by": tc_receved_by.val(), "tc_issued_by": tc_issued_by.val()},
            success: function (result) {
                $('#tc-content').removeClass('sk-loading')
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        window.open(data.link, '_blank');
                        tc_receved_by.val('');
                        tc_issued_by.val('');
                        reload();
                    } else {
                        swal('', 'An error encountered while exporting TC. Please try again later', 'info');
                        return false;
                    }

                } catch (e) {
                    swal('', 'An error encountered while exporting TC. Please try again later', 'info');
                    return false;
                }


            }
        });
    }
    
    function reload() {
        var ops_url = baseurl + 'tc/search-admission-no';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"admn_no": '<?php echo $searchdata; ?>'},
            success: function (result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);

                }
            }
        });
    }
    
    //function create by vinoth k @ 21-05-2019 14:03
    function tc_reprint(student_id,rname,iname) {
        var cur_acdyear = $("#cur_acdyear").val();
        var cur_batchid = $("#cur_batchid").val();
        $('#tc-content').addClass('sk-loading')
        var ops_url = baseurl + 'tc/tc-issuing/';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {"load": 1, "student_id": student_id, "cur_acdyear": cur_acdyear, "cur_batchid": cur_batchid, "tc_receved_by": rname, "tc_issued_by": iname},
            success: function (result) {
                $('#tc-content').removeClass('sk-loading')
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        window.open(data.link, '_blank');
                    } else {
                        swal('', 'An error encountered while exporting TC. Please try again later', 'info');
                        return false;
                    }

                } catch (e) {
                    swal('', 'An error encountered while exporting TC. Please try again later', 'info');
                    return false;
                }
            }
        });
    }
      //function create by vinoth k @20-05-2019 12:27
    function tc_prep_cancel(student_id, name) {
        var cur_acdyear = $("#cur_acdyear").val();
        var cur_batchid = $("#cur_batchid").val();
         var ops_url = baseurl + 'tc/tc-cancel/';
        var data = {"student_id": student_id, "name": name, "cur_acdyear": cur_acdyear, "cur_batchid": cur_batchid, "flag": 'A'};
        swal({
            title: '',
            text: 'Confirmation for TC Cancel',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Turn to Official',
            cancelButtonText: 'Turn to TC Applied',
            allowEscapeKey: false
        }, function (isConfirm) {
            if(isConfirm) {
                data = {"student_id": student_id, "name": name, "cur_acdyear": cur_acdyear, "cur_batchid": cur_batchid, "flag": 'O'};
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    //            data: {"load": 1, "studentid": student_id},
                    data: data,
                    success: function (result) {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            swal('Success', 'TC cancelled successfully', 'success');
                            $('#content').html(atob(data.view));
                            //Pass batch id to view and then to function, then actvate below code with batchid variable        
                            //load_students_after_filter('406')
                            reload();
                            return true;
                        }
                    }
                });
            } 
            if(!isConfirm){
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    //            data: {"load": 1, "studentid": student_id},
                    data: data,
                    success: function (result) {
                        var data = JSON.parse(result);
                        if (data.status == 1) {
                            swal('Success', 'TC cancelled successfully', 'success');
                            $('#content').html(atob(data.view));
                            //Pass batch id to view and then to function, then actvate below code with batchid variable        
                            //load_students_after_filter('406')
                            reload();
                            return true;
                        }
                    }
                });
            }
        });
    }

</script>