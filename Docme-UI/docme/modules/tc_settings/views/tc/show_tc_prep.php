 <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
 <!-- Steps -->

 <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
 <!--<link href="<?php //echo base_url('assets/plugins/steps/jquery.steps.min.js');                                                            
                    ?>" rel="stylesheet">-->
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
 </div> <!-- style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;" -->
 <!-- style="margin-left: -29px !important; margin-right: -30px !important;" -->
 <div class="wrapper wrapper-content animated fadeInRight">
     <div class="row">


         <div class="col-lg-12" id="tc-content">



             <!-- <div class="sk-spinner sk-spinner-wave">
                 <div class="sk-rect1"></div>
                 <div class="sk-rect2"></div>
                 <div class="sk-rect3"></div>
                 <div class="sk-rect4"></div>
                 <div class="sk-rect5"></div>
             </div> -->
             <input type="hidden" id="cur_acdyear" value="<?php echo (isset($cur_acd_year) ? $cur_acd_year : 0); ?>">
             <input type="hidden" id="cur_batchid" value="<?php echo (isset($cur_batch_id) ? $cur_batch_id : 0); ?>">
             <div class="row">

                 <div class="col-lg-3">
                     <div class="ibox float-e-margins">
                         <div class="ibox-content mailbox-content" id="settings_loader">
                             <div class="sk-spinner sk-spinner-wave">
                                 <div class="sk-rect1"></div>
                                 <div class="sk-rect2"></div>
                                 <div class="sk-rect3"></div>
                                 <div class="sk-rect4"></div>
                                 <div class="sk-rect5"></div>
                             </div>
                             <div class="file-manager">
                                 <h5>TC Information</h5>
                                 <ul class="category-list" style="padding: 0">
                                     <?php if (check_permission(507, 1103, 102)) { ?>
                                         <li class="settings-active"><a title="TC Applied" href="javascript:void(0)" onclick="load_tcfunction('tcapplied',this);"> <i class="fa fa-circle text-info"></i> TC Applied </a></li>
                                     <?php }
                                        if (check_permission(507, 1104, 102)) { ?>
                                         <li><a title="TC Prepared &amp; Issued" href="javascript:void(0)" onclick="load_tcfunction('tcprepared',this);"> <i class="fa fa-circle text-warning"></i> TC Prepared &amp; Issued </a></li>
                                     <?php }
                                        if (check_permission(507, 1105, 102)) { ?>
                                         <li><a title="TC Issued Cancel" href="javascript:void(0)" onclick="load_tcfunction('tcissuecancel',this);"> <i class="fa fa-circle" style="color: red;"></i> TC Issued Cancel </a></li>
                                     <?php }
                                        if (check_permission(507, 1106, 102)) { ?>
                                         <li><a title="TC Reprint" href="javascript:void(0)" onclick="load_tcfunction('tcreprint',this);"> <i class="fa fa-circle text-primary"></i> TC Reprint </a></li>
                                     <?php } ?>
                                 </ul>
                                 <div class="clearfix"></div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-9">
                     <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
                         <div class="row" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
                             <div class="col-lg-12">
                                 <div class="ibox float-e-margins showfirst" id="tcapplied">
                                     <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                                         <h5>TC Applied</h5>
                                     </div>
                                     <div class="ibox-content">
                                         <div class="row">
                                             <?php
                                                if (isset($app_details_data) && !empty($app_details_data) && is_array($app_details_data)) {
                                                    $breaker = 0;
                                                    // dev_export($app_details_data);

                                                    foreach ($app_details_data as $student) { //acd_year
                                                        if (isset($student['batch_id'])) $curbatchid = $student['batch_id'];
                                                        if (isset($student['acd_year'])) $curacdyear = $student['acd_year'];
                                                ?>
                                                     <div class="col-lg-4 col-md-4">
                                                         <div class="contact-box center-version">

                                                             <a href="javascript:void(0);" style="padding-bottom: 0;">
                                                                 <?php
                                                                    $profile_image = "";
                                                                    if (!empty(get_student_image($student['student_id']))) {
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
                                                                 <h3 class="m-b-xs profile-name"><?php echo $student['name'] ?><br /><span style="font-size:10px;font-weight:normal"><?php echo $student['batch_name'] ?></span></h3>

                                                             </a>
                                                             <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; ">
                                                                 <tbody>
                                                                     <tr>
                                                                         <td width="40%">
                                                                             Admission No.
                                                                         </td>
                                                                         <td>
                                                                             :<b> <?php echo $student['admn_no'] ?></b>
                                                                         </td>
                                                                     </tr>
                                                                     <!-- <tr>
                                                                         <td>
                                                                             Batch Name
                                                                         </td>
                                                                         <td>
                                                                             :<b> <?php echo $student['batch_name'] ?></b>
                                                                         </td>
                                                                     </tr> -->
                                                                     <tr>
                                                                         <td>
                                                                             Parent Name
                                                                         </td>
                                                                         <td>
                                                                             : <b title="<?php echo $student['name_of_guardian_in_application']; ?>">
                                                                                 <?php if (strlen($student['name_of_guardian_in_application']) > 15) {
                                                                                        echo substr($student['name_of_guardian_in_application'], 0, 12) . "...";
                                                                                    } else {
                                                                                        echo $student['name_of_guardian_in_application'];
                                                                                    }  ?></b>
                                                                         </td>
                                                                     </tr>
                                                                     <tr>
                                                                         <td>
                                                                             Contact No.
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
                                                                             : <b> <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                         </td>
                                                                     </tr>
                                                                     <tr>
                                                                         <td>
                                                                             Fee Amount Pending
                                                                         </td>
                                                                         <td>
                                                                             : <b> <?php echo my_money_format($student['fee_summary'] > 0 ? $student['fee_summary'] : 0); ?> </b>
                                                                         </td>
                                                                     </tr>
                                                                     <tr>
                                                                         <td>
                                                                             Wallet Balance
                                                                         </td>
                                                                         <td>
                                                                             : <b> <?php echo my_money_format($student['fee_wallet'] > 0 ? $student['fee_wallet'] : 0); ?> </b>
                                                                         </td>
                                                                     </tr>



                                                                 </tbody>
                                                             </table>
                                                             <div class="contact-box-footer" style="padding: 15px 10px;">
                                                                 <div class="m-t-xs ">
                                                                     <a class="btn btn-sm btn-danger" onclick="tc_cancellation('<?php echo $student['student_id']; ?>', '<?php echo $student['name']; ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>');" title="Cancel TC Application"><i class="fa fa-times"></i> Cancel</a>
                                                                     <!-- <?php if ($student['fee_summary'] <= 0) { ?>
                                                                         <a class="btn btn-sm btn-info" onclick="tc_preparation('<?php echo $student['student_id']; ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>');" title="Prepare & Issue TC"><i class="fa fa-check"></i> Prepare & Issue</a>
                                                                     <?php } else { ?>
                                                                         <a class="btn btn-sm btn-info" onclick="tc_fee_pending('<?php echo $student['fee_summary']; ?>');" title="Prepare & Issue TC"><i class="fa fa-check"></i> Prepare & Issue</a>
                                                                     <?php } ?> -->

                                                                     <?php if ($student['fee_wallet'] > 0 || $student['fee_summary'] > 0) { ?>
                                                                         <a class="btn btn-sm btn-info" onclick="tc_fee_pending('<?php echo $student['fee_summary']; ?>','<?php echo $student['fee_wallet']; ?>');" title="Prepare & Issue TC"><i class="fa fa-check"></i> Prepare & Issue</a>
                                                                     <?php } else { ?>
                                                                         <a class="btn btn-sm btn-info" onclick="tc_preparation('<?php echo $student['student_id']; ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>');" title="Prepare & Issue TC"><i class="fa fa-check"></i> Prepare & Issue</a>
                                                                     <?php } ?>
                                                                     <!--<a class="btn btn-xs btn-info" onclick="tc_issue('<?php echo $student['student_id']; ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>');"> Issue</a>-->
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>


                                                 <?php
                                                        // if ($breaker == 2) {
                                                        //     echo '<div class="clearfix"></div>';
                                                        //     $breaker = 0;
                                                        // } else {
                                                        //     $breaker++;
                                                        // }
                                                    }
                                                } else {
                                                    ?>
                                                 <div class="col-lg-12 col-md-12">
                                                     <h3><strong> No data available.</strong></h3>
                                                 </div>
                                             <?php
                                                }
                                                ?>



                                         </div>
                                     </div>
                                 </div>
                                 <div class="ibox float-e-margins tcdiv" id="tcprepared">
                                     <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                                         <h5> TC Prepared &amp; Issued</h5>
                                     </div>
                                     <div class="ibox-content">
                                         <div class="row">
                                             <?php
                                                // dev_export($details_data);
                                                if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                    $breaker = 0;
                                                    $count = 0;
                                                    foreach ($details_data as $student) {
                                                        if (isset($student['batch_id'])) $curbatchid = $student['batch_id'];
                                                        if (isset($student['acd_year'])) $curacdyear = $student['acd_year'];
                                                ?>
                                                     <div class="col-lg-4 col-md-4">
                                                         <div class="contact-box center-version">

                                                             <a href="javascript:void(0);" style="padding-bottom: 0;">
                                                                 <?php
                                                                    $profile_image = "";
                                                                    if (!empty(get_student_image($student['student_id']))) {
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
                                                                 <h3 class="m-b-xs profile-name"><?php echo $student['name'] ?><br /><span style="font-size:10px;font-weight:normal"><?php echo $student['batch_name'] ?></span></h3>



                                                             </a>
                                                             <?php if (!isset($student["issued_by"])) {
                                                                    $disabled = '';
                                                                } else {
                                                                    $disabled = 'disabled';
                                                                } ?>
                                                             <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; margin: 0; ">
                                                                 <tbody>
                                                                     <tr>
                                                                         <td>
                                                                             Admission No.
                                                                         </td>
                                                                         <td>
                                                                             :<b> <?php echo $student['admn_no'] ?></b>
                                                                         </td>
                                                                     </tr>
                                                                     <!-- <tr>
                                                                         <td>
                                                                             Batch Name
                                                                         </td>
                                                                         <td>
                                                                             :<b> <?php echo $student['batch_name'] ?></b>
                                                                         </td>
                                                                     </tr> -->
                                                                     <tr>
                                                                         <td>
                                                                             TC Applied Date
                                                                         </td>
                                                                         <td>
                                                                             : <b> <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                         </td>
                                                                     </tr>
                                                                     <tr>

                                                                         <td colspan="2">

                                                                             <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                 <label class="control-label">Receiving Person Name</label><span class="mandatory"> *</span>
                                                                                 <input class="form-control received_by" maxlength="30" minlength="3" placeholder="Receiving Person Name" data-toggle="tooltip" title="Enter TC received person name" value="<?php if (isset($student["recieved_by"])) {
                                                                                                                                                                                                                                                                    echo $student["recieved_by"];
                                                                                                                                                                                                                                                                } ?>" <?php echo $disabled; ?> />
                                                                             </div>
                                                                         </td>
                                                                     </tr>
                                                                     <tr>
                                                                         <td colspan="2">
                                                                             <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                 <label class="control-label">Issuing Person Name</label><span class="mandatory"> *</span>
                                                                                 <input class="form-control issued_by" maxlength="30" minlength="3" placeholder="Issuing Person Name" data-toggle="tooltip" title="Enter TC issuing person name" value="<?php if (isset($student["issued_by"])) {
                                                                                                                                                                                                                                                            echo $student["issued_by"];
                                                                                                                                                                                                                                                        } ?>" <?php echo $disabled; ?> />
                                                                             </div>
                                                                         </td>
                                                                     </tr>
                                                                 </tbody>
                                                             </table>
                                                             <?php if (!isset($student["issued_by"])) { ?>
                                                                 <div class="contact-box-footer">
                                                                     <div class="m-t-md ">
                                                                         <a class="btn btn-md btn-info" onclick="tc_issue('<?php echo $student['student_id']; ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>', event);" title="Print" $disabled><i class="fa fa-print"></i> Print TC</a>
                                                                         <?php //}
                                                                            //else { 
                                                                            ?>
                                                                         <!-- <button class="btn btn-md btn-info" title="Print" disabled><i class="fa fa-print"></i> Print TC</button> -->
                                                                         <?php //}
                                                                            ?>

                                                                     </div>
                                                                 </div>
                                                             <?php } ?>
                                                         </div>
                                                     </div>
                                                     <?php
                                                        if ($breaker == 2) {
                                                            echo '<div class="clearfix"></div>';
                                                            $breaker = 0;
                                                        } else {
                                                            $breaker++;
                                                        }
                                                        $count++;
                                                        //}
                                                    }
                                                    if ($count == 0) {
                                                        ?>
                                                     <div class="col-lg-12 col-md-12">
                                                         <h3><strong> No data available.</strong></h3>
                                                     </div>
                                                 <?php
                                                    }
                                                } else {
                                                    ?>
                                                 <div class="col-lg-12 col-md-12">
                                                     <h3><strong> No data available.</strong></h3>
                                                 </div>
                                             <?php
                                                }
                                                ?>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="ibox float-e-margins tcdiv" id="tcissuecancel">
                                     <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                                         <h5> TC Issued Cancel</h5>
                                     </div>
                                     <div class="ibox-content">
                                         <div class="row">
                                             <?php
                                                if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                    $breaker = 0;
                                                    foreach ($details_data as $student) {
                                                        if (isset($student['batch_id'])) $curbatchid = $student['batch_id'];
                                                        if (isset($student['acd_year'])) $curacdyear = $student['acd_year'];
                                                ?>
                                                     <div class="col-lg-4 col-md-4">
                                                         <div class="contact-box center-version">

                                                             <a href="javascript:void(0);" style="padding-bottom: 0;">
                                                                 <?php
                                                                    $profile_image = "";
                                                                    if (!empty(get_student_image($student['student_id']))) {
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
                                                                 <h3 class="m-b-xs profile-name"><?php echo $student['name'] ?><br /><span style="font-size:10px;font-weight:normal"><?php echo $student['batch_name'] ?></span></h3>

                                                             </a>
                                                             <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; margin: 0; ">
                                                                 <tbody>
                                                                     <tr>
                                                                         <td>
                                                                             Admission No.
                                                                         </td>
                                                                         <td>
                                                                             :<b> <?php echo $student['admn_no'] ?></b>
                                                                         </td>
                                                                     </tr>
                                                                     <!-- <tr>
                                                                         <td>
                                                                             Batch Name
                                                                         </td>
                                                                         <td>
                                                                             :<b> <?php echo $student['batch_name'] ?></b>
                                                                         </td>
                                                                     </tr> -->
                                                                     <tr>
                                                                         <td>
                                                                             TC Applied Date
                                                                         </td>
                                                                         <td>
                                                                             : <b> <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                         </td>
                                                                     </tr>
                                                                 </tbody>
                                                             </table>
                                                             <div class="contact-box-footer" style="padding: 15px 10px;">
                                                                 <div class="m-t-xs">
                                                                     <!-- <a class="btn btn-xs btn-danger btn-block" onclick="turn_to_tc_official('<?php echo $student['student_id']; ?>', '<?php echo $student['name']; ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>');" title="Turn to Official"><i class="fa fa-times"></i>TC Cancel</a> -->
                                                                     <a class="btn btn-xs btn-info btn-block" onclick="tur_to_tc_applied('<?php echo $student['student_id']; ?>', '<?php echo $student['name']; ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>');" title="Turn to TC Applied"><i class="fa fa-times"></i>TC Preparation Cancel</a>
                                                                     <!-- <a class="btn btn-xs btn-info"  onclick="tc_prep_cancel('<?php echo $student['student_id']; ?>', '<?php echo $student['name']; ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>');" title="Cancel"> Cancel</a> Turn to TC Official  Turn to TC Applied-->
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>


                                                 <?php
                                                        if ($breaker == 2) {
                                                            echo '<div class="clearfix"></div>';
                                                            $breaker = 0;
                                                        } else {
                                                            $breaker++;
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                 <div class="col-lg-12 col-md-12">
                                                     <h3><strong> No data available.</strong></h3>
                                                 </div>
                                             <?php
                                                }
                                                ?>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="ibox float-e-margins tcdiv" id="tcreprint">
                                     <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                                         <h5> TC Reprint</h5>
                                     </div>
                                     <div class="ibox-content">
                                         <div class="row">
                                             <?php
                                                if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                    $breaker = 0;
                                                    foreach ($details_data as $student) {
                                                        if (isset($student['batch_id'])) $curbatchid = $student['batch_id'];
                                                        if (isset($student['acd_year'])) $curacdyear = $student['acd_year'];
                                                        if (isset($student["issued_by"]) && !empty($student["issued_by"])) {
                                                ?>
                                                         <div class="col-lg-4 col-md-4">
                                                             <div class="contact-box center-version">

                                                                 <a href="javascript:void(0);" style="padding-bottom: 0;">
                                                                     <?php
                                                                        $profile_image = "";
                                                                        if (!empty(get_student_image($student['student_id']))) {
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
                                                                     <h3 class="m-b-xs profile-name"><?php echo $student['name'] ?><br /><span style="font-size:10px;font-weight:normal"><?php echo $student['batch_name'] ?></span></h3>

                                                                 </a>
                                                                 <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; margin: 0; ">
                                                                     <tbody>
                                                                         <tr>
                                                                             <td>
                                                                                 Admission No.
                                                                             </td>
                                                                             <td>
                                                                                 :<b> <?php echo $student['admn_no'] ?></b>
                                                                             </td>
                                                                         </tr>
                                                                         <!-- <tr>
                                                                             <td>
                                                                                 Batch Name
                                                                             </td>
                                                                             <td>
                                                                                 :<b> <?php echo $student['batch_name'] ?></b>
                                                                             </td>
                                                                         </tr> -->
                                                                         <tr>
                                                                             <td>
                                                                                 TC Applied Date
                                                                             </td>
                                                                             <td>
                                                                                 : <b> <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                                             </td>
                                                                         </tr>
                                                                         <tr>
                                                                             <td colspan="2">
                                                                                 <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                     <label class="control-label">Receiving Person Name</label><span class="mandatory"> *</span>
                                                                                     <input class="form-control received_by" maxlength="200" minlength="3" data-toggle="tooltip" disabled=" " title="TC received person name" value="<?php echo $student["recieved_by"]; ?>" />
                                                                                 </div>
                                                                             </td>
                                                                         </tr>
                                                                         <tr>
                                                                             <td colspan="2">
                                                                                 <div class="form-group" style="margin-bottom: 0 !important;">
                                                                                     <label class="control-label">Issuing Person Name</label><span class="mandatory"> *</span>
                                                                                     <input class="form-control issued_by" maxlength="200" minlength="3" data-toggle="tooltip" disabled="" title="TC issuing person name" value="<?php echo $student["issued_by"]; ?>" />
                                                                                 </div>
                                                                             </td>
                                                                         </tr>
                                                                     </tbody>
                                                                 </table>
                                                                 <div class="contact-box-footer">
                                                                     <div class="m-t-md ">
                                                                         <a class="btn btn-md btn-info" onclick="tc_reprint('<?php echo $student['student_id']; ?>', '<?php echo $student['recieved_by'] ?>', '<?php echo $student['issued_by'] ?>','<?php echo $curacdyear; ?>','<?php echo $curbatchid; ?>');" title="Re-Print"><i class="fa fa-print"></i> Re-Print TC</a>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>


                                                 <?php
                                                            if ($breaker == 2) {
                                                                echo '<div class="clearfix"></div>';
                                                                $breaker = 0;
                                                            } else {
                                                                $breaker++;
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                 <div class="col-lg-12 col-md-12">
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
                     </div>


                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>

 <style>
     .showfirst {
         display: block;
     }

     .tcdiv {
         display: none;
     }
 </style>

 <script>
     function load_tcfunction(id, ele) {
         $('.category-list li').removeClass('settings-active');
         $('.tcdiv').hide('slow');
         $('.showfirst').hide('slow');
         $('#' + id).show('slow');
         $(ele).parent().addClass('settings-active');
     }

     function tc_fee_pending(fee_amount, fee_wallet) {
         if (fee_amount > 0)
             swal('Fee Pending', 'Please pay the pending amount : ' + fee_amount, 'warning')
         else if (fee_wallet > 0)
             swal('Wallet Balance', 'Please withdraw wallet amount : ' + parseFloat(fee_wallet).toFixed(2), 'warning')
     }

     function tc_preparation(student_id, curacdyear = "", curbatchid = "") {
         //  var cur_acdyear = $("#cur_acdyear").val();
         //  if (cur_acdyear == 0) cur_acdyear = curacdyear;
         //  var cur_batchid = $("#cur_batchid").val();
         //  if (cur_batchid == 0) cur_acdyear = curbatchid;
         var ops_url = baseurl + 'tc/tc-preparation/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             //            data: {"load": 1, "studentid": student_id},
             data: {
                 "student_id": student_id,
                 "cur_batchid": curbatchid,
                 "cur_acdyear": curacdyear
             },
             success: function(data) {
                 $('#tc-content').html('');
                 $('#tc-content').html(data);

             }
         });
     }

     //    modify function by vinoth @ 29-05-2019 21:03
     function tc_cancellation(student_id, name, curacdyear = "", curbatchid = "") {
         //  var cur_acdyear = $("#cur_acdyear").val();
         //  if (cur_acdyear == 0) cur_acdyear = curacdyear;
         //  var cur_batchid = $("#cur_batchid").val();
         //  if (cur_batchid == 0) cur_acdyear = curbatchid;
         swal({
             title: '',
             text: 'Are you sure you want to cancel the TC Application of the student ?',
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes',
             cancelButtonText: 'No',
             closeOnConfirm: false
         }, function(isconfirm) {
             if (isconfirm) {
                 var ops_url = baseurl + 'tc/tc-cancel/';
                 $.ajax({
                     type: "POST",
                     cache: false,
                     async: false,
                     url: ops_url,
                     //            data: {"load": 1, "studentid": student_id},
                     data: {
                         "student_id": student_id,
                         "name": name,
                         "cur_acdyear": curacdyear,
                         "cur_batchid": curbatchid
                     },
                     success: function(result) {
                         var data = JSON.parse(result);
                         if (data.status == 1) {
                             //                            swal('Success', 'TC cancelled successfully', 'success');
                             swal({
                                 title: '',
                                 text: 'TC Application cancelled successfully.',
                                 type: 'success',
                                 showCancelButton: false,
                                 confirmButtonColor: '#3085d6',
                                 cancelButtonColor: '#d33',
                                 confirmButtonText: 'OK',
                                 closeOnConfirm: true
                             }, function(confirm) {
                                 if (confirm) {
                                     var ops_url = baseurl + "tcprep/show-studenttcpreplist";
                                     $.ajax({
                                         url: ops_url,
                                         type: 'POST',
                                         cache: false,
                                         async: false,
                                         data: {
                                             "cur_acdyear": curacdyear,
                                             "cur_batchid": curbatchid
                                         },
                                         success: function(res) {
                                             var data2 = JSON.parse(res);
                                             if (data2.status == 1) {
                                                 $('#content').html('');
                                                 $('#content').html(atob(data.view));
                                             } else {

                                             }
                                         }
                                     });
                                 }
                             });
                             //                            $('#content').html(atob(data.view));
                             //                            //Pass batch id to view and then to function, then actvate below code with batchid variable        
                             //                            //load_students_after_filter('406')

                             return true;
                         }
                     }
                 });
             }
         });
     }

     function tc_issue(student_id, curacdyear = "", curbatchid = "", e) {
         //  var cur_acdyear = $("#cur_acdyear").val();
         //  if (cur_acdyear == 0) cur_acdyear = curacdyear;
         //  var cur_batchid = $("#cur_batchid").val();
         //  if (cur_batchid == 0) cur_acdyear = curbatchid;
         //modified by vinoth k @15-05-2019 4:05
         var tc_receved_by = $(e.target).parents('div.contact-box-footer')
             .siblings('table').children('tbody').children('tr')
             .children('td').children('div.form-group').children('input.received_by');
         var tc_issued_by = $(e.target).parents('div.contact-box-footer')
             .siblings('table').children('tbody').children('tr')
             .children('td').children('div.form-group').children('input.issued_by');
         var alphanumers = /^[a-zA-Z\s]+$/;
         if (tc_receved_by.val().trim().length == 0) {
             swal('', 'Receiving Person Name is required.', 'info');
             return false;
         }
         if (!alphanumers.test(tc_receved_by.val())) {
             swal('', 'Receiving Person Name can have only alphabets', 'info');
             return false;
         }
         if (tc_issued_by.val().trim().length == 0) {
             swal('', 'Issuing Person Name is required.', 'info');
             return false;
         }
         if (!alphanumers.test(tc_issued_by.val())) {
             swal('', 'Issuing Person Name can have only alphabets', 'info');
             return false;
         }
         //        write if condition by vinoth @ 28-05-2019 12:44
         if (tc_receved_by.val().length < 3) {
             swal('', 'Receiving person name should be minimum three characters.', 'info');
             return false;
         }
         if (tc_issued_by.val().length < 3) {
             swal('', 'Issuing person name should be minimum three characters.', 'info');
             return false;
         }

         //  var cur_acdyear = $("#cur_acdyear").val();
         //  var cur_batchid = $("#cur_batchid").val();
         $('#tc-content').addClass('sk-loading')
         var ops_url = baseurl + 'tc/tc-issuing/';
         $.ajax({
             type: "POST",
             cache: false,
             async: true,
             url: ops_url,
             data: {
                 "load": 1,
                 "student_id": student_id,
                 "cur_acdyear": curacdyear,
                 "cur_batchid": curbatchid,
                 "tc_receved_by": tc_receved_by.val(),
                 "tc_issued_by": tc_issued_by.val()
             },
             success: function(result) {
                 $('#tc-content').removeClass('sk-loading');
                 try {
                     var data = JSON.parse(result);
                     if (data.status == 1) {
                         window.open(data.link, '_blank');
                         tc_receved_by.val('');
                         tc_issued_by.val('');
                         $('#content').html(atob(data.view));
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

     //function create by vinoth k @ 21-05-2019 14:03
     function tc_reprint(student_id, rname, iname, curacdyear = "", curbatchid = "") {
         //  var cur_acdyear = $("#cur_acdyear").val();
         //  if (cur_acdyear == 0) cur_acdyear = curacdyear;
         //  var cur_batchid = $("#cur_batchid").val();
         //  if (cur_batchid == 0) cur_acdyear = curbatchid;
         $('#tc-content').addClass('sk-loading')
         var ops_url = baseurl + 'tc/tc-issuing/';
         $.ajax({
             type: "POST",
             cache: false,
             async: true,
             url: ops_url,
             data: {
                 "load": 1,
                 "student_id": student_id,
                 "cur_acdyear": curacdyear,
                 "cur_batchid": curbatchid,
                 "tc_receved_by": rname,
                 "tc_issued_by": iname,
                 "print_type": "reprint"
             },
             success: function(result) {
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

     function turn_to_tc_official(student_id, name, curacdyear = "", curbatchid = "") {
         //  var cur_acdyear = $("#cur_acdyear").val();
         //  if (cur_acdyear == 0) cur_acdyear = curacdyear;
         //  var cur_batchid = $("#cur_batchid").val();
         //  if (cur_batchid == 0) cur_acdyear = curbatchid;
         var ops_url = baseurl + 'tc/tc-cancel/';
         var data = {
             "student_id": student_id,
             "name": name,
             "cur_acdyear": curacdyear,
             "cur_batchid": curbatchid,
             "flag": 'o'
         };
         swal({
             title: 'TC Cancel',
             text: 'Are you sure to cancel the TC and Turn Student to Official Status?',
             type: 'info',
             confirmButtonColor: '#3085d6',
             confirmButtonText: 'YES',
             showCancelButton: true,
             cancelButtonText: 'NO',
             allowEscapeKey: false
         }, function(isConfirm) {
             if (isConfirm) {
                 $.ajax({
                     type: "POST",
                     cache: false,
                     async: false,
                     url: ops_url,
                     //            data: {"load": 1, "studentid": student_id},
                     data: data,
                     success: function(result) {
                         var data = JSON.parse(result);
                         if (data.status == 1) {
                             swal('Success', 'TC cancelled successfully', 'success');
                             $('#content').html(atob(data.view));
                             //Pass batch id to view and then to function, then actvate below code with batchid variable        
                             //load_students_after_filter('406')

                             return true;
                         }
                     }
                 });
             }
         });
     }

     function tur_to_tc_applied(student_id, name, curacdyear = "", curbatchid = "") {
         //  var cur_acdyear = $("#cur_acdyear").val();
         //  if (cur_acdyear == 0) cur_acdyear = curacdyear;
         //  var cur_batchid = $("#cur_batchid").val();
         //  if (cur_batchid == 0) cur_acdyear = curbatchid;
         var ops_url = baseurl + 'tc/tc-cancel/';
         var data = {
             "student_id": student_id,
             "name": name,
             "cur_acdyear": curacdyear,
             "cur_batchid": curbatchid,
             "flag": 'A'
         };
         swal({
             title: 'TC Cancel',
             text: 'Are you sure to cancel the TC issued?',
             type: 'info',
             confirmButtonColor: '#3085d6',
             confirmButtonText: 'YES',
             showCancelButton: true,
             cancelButtonText: 'NO',
             cancelButtonColor: '#d33d33',
             reverseButtons: false,
             allowEscapeKey: false

         }, function(isConfirm) {
             if (isConfirm) {
                 $.ajax({
                     type: "POST",
                     cache: false,
                     async: false,
                     url: ops_url,
                     //            data: {"load": 1, "studentid": student_id},
                     data: data,
                     success: function(result) {
                         var data = JSON.parse(result);
                         if (data.status == 1) {
                             swal('Success', 'TC cancelled successfully', 'success');
                             $('#content').html(atob(data.view));
                             //Pass batch id to view and then to function, then actvate below code with batchid variable        
                             //load_students_after_filter('406')

                             return true;
                         }
                     }
                 });
             }
         });
     }

     //function create by vinoth k @20-05-2019 12:27
     function tc_prep_cancel(student_id, name, curacdyear = "", curbatchid = "") {
         //  var cur_acdyear = $("#cur_acdyear").val();
         //  if (cur_acdyear == 0) cur_acdyear = curacdyear;
         //  var cur_batchid = $("#cur_batchid").val();
         //  if (cur_batchid == 0) cur_acdyear = curbatchid;
         var ops_url = baseurl + 'tc/tc-cancel/';
         var data = {
             "student_id": student_id,
             "name": name,
             "cur_acdyear": curacdyear,
             "cur_batchid": curbatchid,
             "flag": 'A'
         };
         swal({
             title: '',
             text: 'Confirmation for TC Issue Cancel',
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33d33',
             confirmButtonText: 'Turn to Official',
             cancelButtonText: 'Turn to TC Applied',
             allowEscapeKey: false

         }, function(isConfirm) {
             if (isConfirm) {
                 data = {
                     "student_id": student_id,
                     "name": name,
                     "cur_acdyear": curacdyear,
                     "cur_batchid": curbatchid,
                     "flag": 'O'
                 };
                 $.ajax({
                     type: "POST",
                     cache: false,
                     async: false,
                     url: ops_url,
                     //            data: {"load": 1, "studentid": student_id},
                     data: data,
                     success: function(result) {
                         var data = JSON.parse(result);
                         if (data.status == 1) {
                             swal('Success', 'TC cancelled successfully', 'success');
                             $('#content').html(atob(data.view));
                             //Pass batch id to view and then to function, then actvate below code with batchid variable        
                             //load_students_after_filter('406')

                             return true;
                         }
                     }
                 });
             }
             if (!isConfirm) {
                 $.ajax({
                     type: "POST",
                     cache: false,
                     async: false,
                     url: ops_url,
                     //            data: {"load": 1, "studentid": student_id},
                     data: data,
                     success: function(result) {
                         var data = JSON.parse(result);
                         if (data.status == 1) {
                             swal('Success', 'TC cancelled successfully', 'success');
                             $('#content').html(atob(data.view));
                             //Pass batch id to view and then to function, then actvate below code with batchid variable        
                             //load_students_after_filter('406')

                             return true;
                         }
                     }
                 });
             }
         });
     }



     function search_filter() {
         var ops_url = baseurl + 'tc/search-filter';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1
             },
             success: function(data) {
                 if (data) {
                     $('#curd-content').html(data);


                     var animation = "fadeInDown";
                     $("#curd-content").show();
                     $('#curd-content').addClass('animated');
                     $('#curd-content').addClass(animation);
                 } else {
                     alert('No data loaded');
                 }
             }
         });
     }
 </script>