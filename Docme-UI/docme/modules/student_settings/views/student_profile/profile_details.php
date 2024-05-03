<style>
    td {
        word-break: break-word;
    }

    .widget-head-color-box {
        border-radius: 5px 5px 5px 5px;
        margin-top: 0px;
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
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">
                <div class="profile-image">
                    <?php
                    $profile_image = "";
                    if (!empty(get_student_image($student_data['student_id']))) {
                        $profile_image = get_student_image($student_data['student_id']);
                    } else if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {
                        $profile_image = "data:image/png;base64," . $student_data['profile_image'];
                    } else {
                        if (isset($student_data['profile_image_alternate']) && !empty($student_data['profile_image_alternate'])) {
                            $profile_image = $student_data['profile_image_alternate'];
                        } else {
                            $profile_image = base_url('assets/img/a0.jpg');
                        }
                    }
                    // dev_export($parent_address);
                    ?>


                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins" title="<?php echo $student_data['student_name']; ?>">

                                <?php echo isset($student_data['student_name']) && !empty($student_data['student_name']) ? $student_data['student_name'] : 'NO NAME'; ?>
                                <input type="hidden" id="stud_name" name="stud_name" value=" <?php echo isset($student_data['student_name']) && !empty($student_data['student_name']) ? $student_data['student_name'] : 'NO NAME'; ?>" />
                            </h2>
                            <h4 id="batch_name_display"><?php echo isset($student_data['Batch_Name']) && !empty($student_data['Batch_Name']) ? $student_data['Batch_Name'] : 'BATCH NOT ALLOTTED'; ?></h4>
                            <input type="hidden" id="batch_name" name="batch_name" value="<?php echo isset($student_data['Batch_Name']) && !empty($student_data['Batch_Name']) ? $student_data['Batch_Name'] : 'BATCH NOT ALLOTTED'; ?>" />
                            <small style="word-break:break-all;">
                                <?php
                                if ($student_data['IDMark1'] == NULL || $student_data['IDMark2'] == NULL) {
                                    echo " Please Contact the Authority to Add Your Identification Marks!";
                                } else {
                                ?>
                                    <strong>Identification Marks </strong>
                                    <br>

                                    <span class="text-lowercase">
                                        1.&nbsp;
                                        <?php
                                        echo $student_data['IDMark1'];
                                        // echo substr($student_data['IDMark1'], 0, 20);
                                        ?>
                                    </span>
                                    <br>

                                    <span class="text-lowercase">
                                        2.&nbsp;
                                        <?php
                                        echo $student_data['IDMark2'];
                                        ?>
                                    </span>
                                <?php
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-3">
                <table class="table small m-b-xs">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Admission No.</strong>
                            </td>
                            <td>
                                <?php
                                echo $student_data['Admn_NO']; ?>
                                <input type="hidden" id="adm_no" name="adm_no" value="<?php echo $student_data['Admn_NO']; ?>" />
                                <input type="hidden" id="student_id" name="student_id" value="<?php echo $student_data['student_id']; ?>" />
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>Admitted Academic Year</strong>
                            </td>
                            <td>
                                <?php echo $student_data['acdyr']; ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Class Name</strong>
                            </td>
                            <td>
                                <?php echo isset($student_data['Description']) && !empty($student_data['Description']) ? $student_data['Description'] : 'No Class Available'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Priority</strong>
                            </td>
                            <td>
                                <?php echo isset($student_data['Priority']) ? $student_data['Priority'] : 'Priority data is not availaable'; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <small><strong>Pending Fees to Pay</strong></small>
                <h2 class="no-margins" id="fee_summary_div"><?php echo isset($fee_summary) && !empty($fee_summary) ? my_money_format($fee_summary) : 0; ?></h2>
                <!--<div id="sparkline1"></div>-->
            </div>


        </div>
        <div class="row">

            <div class="col-lg-4">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><b>About</b></h5>
                    </div>
                    <div class="ibox-content" style="overflow:hidden">

                        <?php //dev_export($student_data);
                        //die; 
                        ?>
                        <h3><?php echo $student_data['student_name']; ?></h3>
                        <div class="space-25"></div>
                        <ul class="folder-list m-b-md" style="padding: 0">
                            <p class="small font-bold">
                                <span><i class="fa fa-circle text-navy"></i> <?php echo $student_data['stud_status']; ?></span>
                            </p>
                            <?php
                            $inst_id = $this->session->userdata('inst_id');
                            if (in_array($inst_id, [1, 2, 3, 4, 9])) {
                                $uuid_name = 'Emirates ID';
                            } else {
                                $uuid_name = 'Aadhar Number';
                            }

                            if ($student_data['country_id'] != 2) {
                                $uuid_name = 'Unique ID';
                            }
                            ?>
                            <li><span style="font-weight:bold"> Admission Date :</span> <?php echo date('d-m-Y', strtotime($student_data['admission_date'])); ?> </li>
                            <li><span style="font-weight:bold"> Date of Birth :</span> <?php echo date('d-m-Y', strtotime($student_data['DOB'])); ?> </li>
                            <li><span style="font-weight:bold"> Mother Tongue :</span> <?php echo $student_data['MotherTounge']; ?> </li>
                            <li><span style="font-weight:bold"> Religion : </span><?php echo $student_data['Religion']; ?></li>
                            <li><span style="font-weight:bold"> Caste :</span> <?php echo $student_data['Caste']; ?></li>
                            <li><span style="font-weight:bold"> Nationality :</span> <?php echo $student_data['Nationality']; ?></li>
                            <li><span style="font-weight:bold"> State :</span> <?php echo $student_data['state_name']; ?></li>
                            <li><span style="font-weight:bold"> Gender : </span><?php if ($student_data['Sex'] == 'F') echo 'Female';
                                                                                else  echo 'Male'; ?></li>
                            <li><span style="font-weight:bold"> Place :</span> <?php echo $student_data['city_name']; ?></li>
                            <li><span style="font-weight:bold"> Pickup Point :</span> <?php echo $student_data['pickpointName']; ?></li>
                            <li class="uuid_overflow"><span style="font-weight:bold"> <?php echo $uuid_name; ?> : </span> <?php echo $student_data['Adhar_No']; ?></li>
                            <li><span style="font-weight:bold"> Birth Country :</span> <span class="text-uppercase"><?php echo $student_data['Birth_Country']; ?></span></li>
                            <li><span style="font-weight:bold"> Birth Place :</span> <span class="text-uppercase"><?php echo $student_data['Birth_place']; ?></span></li>
                            <li><span style="font-weight:bold"> Blood Group :</span> <span class="text-uppercase"><?php echo $student_data['BloodGroup'] == -1 || empty($student_data['BloodGroup']) ? '' : $student_data['BloodGroup']; ?></span></li>
                        </ul>



                    </div>
                </div>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><b>Student Family Details</b></h5>
                    </div>
                    <div class="ibox-content ">
                        <p class="small">
                            <?php //  $inst_name = $this->session->userdata('Institution_Name');
                            ?>
                            List of siblings studying in <?php echo $this->session->userdata('Institution_Name'); ?>
                        </p>
                        <div class="user-friends">
                            <?php
                            if (isset($sibilings_data) && !empty($sibilings_data) && is_array($sibilings_data)) {
                                //                                echo dev_export($sibilings_data) . '</pre>';
                                foreach ($sibilings_data as $sibiling) {
                            ?>
                                    <?php
                                    $sibiling_image = "";
                                    if (isset($sibiling['profile_image']) && !empty($sibiling['profile_image'])) {

                                        //$sibiling_image = "data:image/png;base64," . $sibiling['profile_image'];
                                        $sibiling_image = $sibiling['profile_image'];
                                    } else {
                                        $sibiling_image = base_url('assets/img/a0.jpg');
                                    }
                                    ?>

                                    <a href="javascript:void(0);" onclick="profile_detail('<?php echo $sibiling['student_id']; ?>');" data-toggle="tooltip" title="<?php echo $sibiling['student_name'] . " ( " . $sibiling['stud_status'] . " ) "; ?>"><img alt="image" class="img-circle" src="<?php echo $sibiling_image; ?>"></a>


                            <?php
                                }
                            }
                            ?>

                        </div>

                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><b> Document Details</b></h5>
                    </div>
                    <div class="ibox-content ">

                        <a href="javascript:void(0);" data-toggle="tooltip" title="Manage Documents" onclick="documents_detail('<?php echo $student_data['student_id']; ?>', '<?php echo $batchid; ?>')" class="btn btn-sm btn-info">Manage Documents</a>
                    </div>
                </div>


                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><b>Other Personal Details</b></h5>
                    </div>
                    <div class="ibox-content ">
                        <ul class="list-unstyled file-list">
                            <li><i class="fa fa-slack"></i> <span style="font-weight:bold"> Passport Number:</span> <span class="text-uppercase"><?php echo $passport_data['PassportNo'] != '' ? $passport_data['PassportNo'] : 'NA'; ?></span></li>
                            <li><i class="fa fa-calendar"></i> <span style="font-weight:bold">Passport Issue Date:</span> <?php echo (isset($passport_data['pass_issue_date']) && !empty($passport_data['pass_issue_date']) && trim($passport_data['pass_issue_date']) != '1900-01-01' && trim($passport_data['pass_issue_date']) != '01/01/1900')  ? date('d-M-Y', strtotime($passport_data['pass_issue_date'])) : 'NA'; ?></li>
                            <li><i class="fa fa-calendar"></i> <span style="font-weight:bold"> Passport Expiry Date: </span><?php echo (isset($passport_data['pass_expiry_date']) && !empty($passport_data['pass_expiry_date']) && trim($passport_data['pass_expiry_date']) != '1900-01-01') ? date('d-M-Y', strtotime($passport_data['pass_expiry_date'])) : 'NA'; ?></li>

                            <!--<li><i class="fa fa-calendar-times-o"></i> Passport Expiry Date: <?php echo isset($passport_data['pass_expiry_date']) && !empty($passport_data['pass_expiry_date'] && date('d-M-Y', strtotime($passport_data['pass_expiry_date'])) > getdate()) ? date('d-M-Y', strtotime($passport_data['pass_expiry_date'])) : 'NA'; ?> </li>-->
                            <li><i class="fa fa-map-marker"></i> <span style="font-weight:bold">&nbsp;Passport Issue Location: </span><span class="text-uppercase"><?php echo $passport_data['Pass_Issue_location'] != '' ? $passport_data['Pass_Issue_location'] : 'NA'; ?></span></li>
                            <li><i class="fa fa-id-badge"></i><span style="font-weight:bold"> Visa Number:</span> <span class="text-uppercase"><?php echo $passport_data['Visa_No'] != '' ? $passport_data['Visa_No'] : 'NA'; ?></span></li>
                            <li><i class="fa fa-calendar"></i><span style="font-weight:bold"> Visa Issue Date: </span><?php echo (isset($passport_data['visa_issue_date']) && !empty($passport_data['visa_issue_date']) && trim($passport_data['visa_issue_date']) != '1900-01-01') ? date('d-M-Y', strtotime($passport_data['visa_issue_date'])) : 'NA'; ?></li>
                            <li><i class="fa fa-calendar"></i> <span style="font-weight:bold">Visa Expiry Date:</span> <?php echo (isset($passport_data['visa_expiry_date']) && !empty($passport_data['visa_expiry_date']) && trim($passport_data['visa_expiry_date']) != '1900-01-01') ? date('d-M-Y', strtotime($passport_data['visa_expiry_date'])) : 'NA'; ?></li>

                            <!--<li><i class="fa fa-calendar-times-o"></i> Visa Expiry Date:  <?php echo isset($passport_data['visa_expiry_date']) && !empty($passport_data['visa_expiry_date'] && date('d-M-Y', strtotime($passport_data['visa_expiry_date'])) > getdate()) ? date('d-M-Y', strtotime($passport_data['visa_expiry_date'])) : 'NA'; ?></li>-->
                            <li><i class="fa fa-map-marker"></i><span style="font-weight:bold"> &nbsp;Visa Issue Location: </span> <span class="text-uppercase"><?php echo $passport_data['Visa_Issue_location'] != '' ? $passport_data['Visa_Issue_location'] : 'NA'; ?></span></li>
                            <!--                            <li><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</li>
                            <li><i class="fa fa-file"></i> 10_08_2015.docx</li>-->
                        </ul>
                    </div>
                </div>

            </div>



            <div class="col-lg-4">
                <?php if (
                    $this->session->userdata('emailid') == 'principal@oxfordtvm.com' ||
                    $this->session->userdata('emailid') == 'principal@oxfordkollam.com' ||
                    $this->session->userdata('emailid') == 'principal@oxfordcalicut.com'
                ) { ?>
                    <div class="ibox float-e-margins" style="background-color: #fff !important">
                        <div class="ibox-title">
                            <h5><b>Set Base Fee - Educore Access</b></h5>
                        </div>
                        <div class="ibox-content" id="wallet_loader">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                            <?php if (($DEMANDED_OR_NOT) == 0) { ?>
                                <div class="form-group">
                                    <label>Fee Not Demanded</label>
                                </div>
                            <?php } else if (($FIST_TERM_FEE + $PREV_ARREAR) <= 0) { ?>
                                <div class="form-group">
                                    <label>First Installment Fee : Paid</label>
                                </div>
                            <?php } else if (($PAID_OR_NOT) == 1) { ?>
                                <div class="form-group">
                                    <label>Principal sanctioned Amount : Paid</label>
                                </div>
                            <?php } else if (($FIST_TERM_FEE + $PREV_ARREAR) > 0 && $E_WALLET >= ($FIST_TERM_FEE + $PREV_ARREAR)) { ?>
                                <div class="form-group">
                                    <label>Prev. Arrear : <?php echo my_money_format(($PREV_ARREAR)); ?></label><br>
                                    <label>First Installment Fee Amount : <?php echo my_money_format(($FIST_TERM_FEE)); ?></label><br>
                                    <label>Docme Wallet Balance : <?php echo my_money_format($E_WALLET); ?></label>
                                </div>
                            <?php } else { ?>
                                <div class="form-group">
                                    <label>Prev. Arrear : <?php echo my_money_format(($PREV_ARREAR)); ?></label><br>
                                    <label>First Installment Fee Amount : <?php echo my_money_format(($FIST_TERM_FEE)); ?></label><br>
                                    <label>Docme Wallet Balance : <?php echo my_money_format($E_WALLET); ?></label><br>
                                    <label>Already Set Min. Amt. : <?php echo my_money_format($min_wallet); ?></label>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <label>Min. Amt. to Pay in Wallet</label>
                                    <input type="text" tabindex="1" class="form-control digits" maxlength="8" id="amount_limit" placeholder="Min. Amt. to Pay in Wallet" value="<?php echo round($min_wallet, 2); ?>">
                                </div>
                                <div class="form-group">
                                    <label>To Email</label>
                                    <!-- <?php //dev_export($parent_email);
                                            ?> -->
                                    <input type="hidden" id="father_id" name="father_id" value="<?php echo $parent_address[0]['father_id'] ?>">
                                    <input type="hidden" id="email_from_db" name="email_from_db" value="<?php echo $parent_address[0]['Email'] ?>">
                                    <input type="text" tabindex="1" class="form-control" maxlength="50" value="<?php echo $parent_address[0]['Email'] ?>" id="set_email" placeholder="Enter email address">
                                    <small>
                                        Payment link will be sent to registered email.
                                    </small>
                                </div>
                                <a href="javascript:" class="btn btn-primary btn-block" title="Set Amount" onclick="set_min_wallet_amount();">Set Amount</a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (in_array(trim($student_data['StatusFlag']), array('O', 'U', 'L'))) {  ?>
                    <div class="ibox float-e-margins" style="background-color: #fff !important">
                        <div class="ibox-title">
                            <h5><b>Private Message</b></h5>
                        </div>
                        <div class="ibox-content ">
                            <input type="hidden" name="to_email" id="to_email" value="<?php echo $parent_address[0]['Email'] ?>">

                            <p class="small">

                                Send private message to <span class="text-uppercase"><?php echo $parent_email[0]['Parent_Name'] ?></span>
                            </p>
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" tabindex="1" class="form-control alphanumeric" maxlength="30" laceholder="Message Subject" value="" id="subject" placeholder="Message Subject">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea tabindex="2" class="form-control alphanumeric" maxlength="160" style="resize:none;" placeholder="Your Message" rows="3" value="" id="message"></textarea>
                            </div>
                            <button class="btn btn-primary btn-block" title="Send" onclick="submit_email_data();">Send</button>
                        </div>
                    </div>
                <?php } ?>

                <!--edit Admission No.-->
                <!--div class="ibox float-e-margins" id="batch_change">
                    <div class="ibox-title" style="margin-bottom: 2px;">
                        <h5><b>EDIT Admission No.</b></h5>
                        <span><a href="javascript:void(0);" onclick="enable_edit_admno();" title="Edit"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Edit">edit</i></a> </span>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" type="text" id="edit_admno" onkeypress="return typeNumberOnly(event);" name="edit_admno" value="<?php echo explode('/', $student_data['Admn_NO'])[0]; ?>" maxlength="5" disabled="disabled">
                                <span class="input-group-addon" id="admn_suffix">
                                    <?php echo '/' . explode('/', $student_data['Admn_NO'])[1]; ?>
                                </span>
                            </div>
                            <?php echo form_error('batch_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                        <button class="btn btn-primary" id="update_admno" title="Update" onclick="edit_admno_function('<?php echo $student_data['student_id']; ?>', '<?php echo $student_cur_year; ?>');" disabled="" >Update</button>                        

                    </div>
                </div-->
                <?php if (in_array(trim($student_data['StatusFlag']), array('O', 'U', 'L'))) {  ?>
                    <div class="ibox float-e-margins" id="batch_change">
                        <div class="ibox-title">
                            <h5><b>Batch Change</b></h5>
                            <span><a href="javascript:void(0);" onclick="enable_batch_change();" title="Edit"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Edit">edit</i></a> </span>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group <?php
                                                    if (form_error('batch_select')) {
                                                        echo 'has-error';
                                                    }
                                                    ?>">
                                <select name="c" id="batch_select_student" class="form-control " style="width:100%;" disabled="disabled">
                                    <?php echo set_select('batch_select', '-1'); ?>
                                    <option selected value="-1">Select a batch</option>
                                    <?php
                                    $batch_selected = isset($batch_select) ? $batch_select : '';
                                    if (isset($batch_data) && !empty($batch_data)) {
                                        foreach ($batch_data as $batch) {
                                            if (isset($batch_selected) && !empty($batch_selected) && $batch_selected == $batch['BatchID']) {
                                                echo '<option selected value = "' . $batch['BatchID'] . '" >' . $batch['Batch_Name'] . "</option>";
                                            } else {
                                                echo '<option value = "' . $batch['BatchID'] . '" >' . $batch['Batch_Name'] . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('batch_select', '<div class="form-error">', '</div>'); ?>
                            </div>
                            <button class="btn btn-primary " id="batch_update_btn" onclick="batch_change_function('<?php echo $student_data['student_id']; ?>', '<?php echo $student_cur_year; ?>');" disabled="" title="Update">Update</button>

                        </div>
                    </div>
                <?php } ?>

                <?php if (in_array(trim($student_data['StatusFlag']), array('O', 'U', 'L'))) {  ?>
                    <?php
                    if ($student_data['Batch_Name'] != NULL) {
                    ?>
                        <?php if (trim($student_data['StatusFlag']) == 'L') {
                            $messageSt = 'Long Absentee Issued'; ?>
                            <div class="widget-head-color-box yellow-bg p-lg text-center">
                                <div class="m-b-md">
                                    <h2 class="font-bold no-margins">
                                        <i class="fa fa-warning fa-1x"></i> TC Application
                                    </h2>
                                    <small><?php echo $messageSt; ?></small>
                                </div>
                            </div>
                        <?php  } elseif ($student_data1[0]['tcstatus'] == 'A') {
                            $messageSt = 'Student Applied TC'; ?>
                            <div class="widget-head-color-box yellow-bg p-lg text-center">
                                <div class="m-b-md">
                                    <h2 class="font-bold no-margins">
                                        <i class="fa fa-warning fa-1x"></i> TC Application
                                    </h2>
                                    <small><?php echo $messageSt; ?></small>
                                </div>

                            </div>
                        <?php } elseif ($student_data['Cur_AcadYr'] != $this->session->userdata('acd_year')) {
                            $messageSt = 'Student not in Current Academic Year'; ?>
                            <div class="widget-head-color-box yellow-bg p-lg text-center">
                                <div class="m-b-md">
                                    <h2 class="font-bold no-margins">
                                        <i class="fa fa-warning fa-1x"></i> TC Application
                                    </h2>
                                    <small><?php echo $messageSt; ?></small>
                                </div>

                            </div>
                        <?php } else { ?>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><b>TC Application</b></h5>
                                </div>
                                <div class="ibox-content" id="tc_loader">
                                    <div class="sk-spinner sk-spinner-wave">
                                        <div class="sk-rect1"></div>
                                        <div class="sk-rect2"></div>
                                        <div class="sk-rect3"></div>
                                        <div class="sk-rect4"></div>
                                        <div class="sk-rect5"></div>
                                    </div>
                                    <div class="form-group" id="data_1">
                                        <label>Expected date of leaving:</label>
                                        <div class="input-group date">
                                            <!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">-->
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control nofocusitem" name="leaving_date" readonly="" style="background-color:#FFFFFF" id="leaving_date" value="<?php echo date('d/m/Y'); ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Reason for leaving :</label>
                                        <textarea class="form-control" maxlength="50" placeholder="Reason for leaving" id="tc_reason" name="tc_reason" rows="3" style="resize:none"></textarea>
                                    </div>
                                    <!--'<?php // dev_export( $student_data);                dev_export($batch_select); die;             
                                            ?>'-->
                                    <a href="javascript:" class="btn btn-sm btn-primary m-r-sm" id="tc_apply" title="Apply For TC" onclick="tc_apply('<?php echo $student_data['student_id']; ?>', '<?php echo $student_data['student_name']; ?>', '<?php echo $student_data['Admn_NO']; ?>', '<?php echo $student_data['Class_ID']; ?>', '<?php echo $student_data['Batch_Name']; ?>', '<?php echo $student_data['Cur_AcadYr']; ?>', '<?php echo $student_data['admission_date']; ?>', '<?php echo $batch_select ?>', '<?php echo $fee_summary ?>', '<?php echo $exm_pending ?>');"><i class="fa fa-check"></i> Apply For TC</a>
                                    <!-- <button class="btn btn-primary btn-sm" title="Show Fees" onclick="fees_detail('<?php echo $studentid; ?>')">Show Fees</button> -->
                                </div>
                            </div>
                    <?php }
                    }
                } else { ?>
                    <div class="widget-head-color-box yellow-bg p-lg text-center">
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                <i class="fa fa-warning fa-1x"></i> TC Prepared and Issued
                            </h2>
                        </div>
                    </div>
                <?php } ?>
                <?php
                //if ($student_data['Batch_Name'] != NULL) { //academic_history
                ?>

                <!-- <div class="ibox float-e-margins">
                        <div class="ibox-title" style="margin-bottom: 2px;">
                            <h5><b>TC Application</b></h5>
                        </div>

                        <div class="ibox-content" id="tc_loader">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                            <div class="form-group" id="data_1">
                                <label>Expected date of leaving:</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="leaving_date" readonly="" style="background-color:#FFFFFF" id="leaving_date" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Reason for leaving :</label>
                                <textarea class="form-control" placeholder="Reason for leaving..." id="tc_reason" name="tc_reason" rows="3"></textarea>
                            </div>
                            <button class="btn btn-sm btn-primary m-r-sm" title="Submit" onclick="tc_apply('<?php echo $student_data['student_id']; ?>', '<?php echo $student_data['student_name']; ?>', '<?php echo $student_data['Admn_NO']; ?>', '<?php echo $student_data['Class_ID']; ?>', '<?php echo $student_data['Batch_Name']; ?>', '<?php echo $student_data['Cur_AcadYr']; ?>', '<?php echo $student_data['admin_date']; ?>', '<?php echo $batch_select ?>');">Submit</button>
                            <button class="btn btn-primary btn-sm" title="Show Fees" onclick="fees_detail('<?php echo $studentid; ?>')">Show Fees</button>
                        </div>
                    </div> -->
                <?php //} 
                ?>
            </div>
            <div class="col-lg-4">


                <div class="ibox collapsed float-e-margins" style="background-color: #fff !important">
                    <div class="ibox-title">
                        <h5><b>Father's Detail</b></h5>

                    </div>

                    <div class="panel-body" style="margin-bottom: -17px;">
                        <?php
                        if ($parent_address[0]['Father'] != NULL || $parent_address[0]['F_profession'] != NULL || $parent_address[0]['f_adhar'] != NULL) {
                        ?>
                            <li style="list-style-type: none" class="text-uppercase"><strong><?php echo $parent_address[0]['Father']; ?> </strong></li>
                            <li style="list-style-type: none"><?php echo $parent_address[0]['F_profession']; ?></a></li>
                            <li style="list-style-type: none"><b><?php echo $uuid_name ?> :</b> <?php echo $parent_address[0]['f_adhar']; ?></li>
                        <?php
                        } else {
                            echo " No details available ";
                        }
                        ?>
                    </div>

                    <?php
                    if ($parent_address[0]['F_C_address1'] != NULL || $parent_address[0]['F_C_address2'] != NULL || $parent_address[0]['F_C_address3'] != NULL || $parent_address[0]['F_C_ZIP_CODE'] != NULL || $parent_address[0]['F_C_Phone1'] != NULL || $parent_address[0]['Email'] != NULL || $parent_address[0]['F_C_Phone3'] != NULL) {
                    ?>
                        <div class="panel-body" style="background-color: #fff !important">
                            <h5 style="padding-bottom: 0px;">Communication Address</h5>
                            <table class="table table-stripped small m-t-md">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['F_C_address1'] != NULL || $parent_address[0]['F_C_address2'] != NULL || $parent_address[0]['F_C_address3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['F_C_address1']; ?>
                                                <?php echo $parent_address[0]['F_C_address2']; ?>
                                                <?php echo $parent_address[0]['F_C_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['F_C_ZIP_CODE'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['F_C_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['F_C_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['F_C_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['Email'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['Email']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['F_C_Phone3'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile: <?php echo $parent_address[0]['F_C_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <?php
                    if ($parent_address[0]['F_H_address1'] != NULL || $parent_address[0]['F_H_address2'] != NULL || $parent_address[0]['F_H_address3'] != NULL || $parent_address[0]['F_H_ZIP_CODE'] != NULL || $parent_address[0]['F_H_Phone1'] != NULL || $parent_address[0]['HEmail'] != NULL || $parent_address[0]['F_H_Phone3'] != NULL) {
                    ?>
                        <h5 style="background-color: #fff !important; margin-bottom: 0px; margin-top: 0px;margin-left: 13px">Permanent Address
                            <div class="ibox-tools" style="margin-bottom:  0px; margin-top: -14px;margin-right: 16px;">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" data-toggle="tooltip" title="maximize/minimize"></i>
                                </a>
                            </div>
                            <h4 style="background-color: #fff !important; margin-bottom: 0px; margin-top: 0px"> &nbsp;</h4>
                        </h5>



                        <div class="ibox-content">

                            <table class="table table-stripped small m-t-md" style="    margin-top: -10px;">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['F_H_address1'] != NULL || $parent_address[0]['F_H_address2'] != NULL || $parent_address[0]['F_H_address3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['F_H_address1']; ?>
                                                <?php echo $parent_address[0]['F_H_address2']; ?>
                                                <?php echo $parent_address[0]['F_H_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($parent_address[0]['F_H_ZIP_CODE'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['F_H_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($parent_address[0]['F_H_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['F_H_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($parent_address[0]['HEmail'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['HEmail']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($parent_address[0]['F_H_Phone3'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile: <?php echo $parent_address[0]['F_H_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                    <?php
                    if ($parent_address[0]['F_O_address1'] != NULL || $parent_address[0]['F_O_address2'] != NULL || $parent_address[0]['F_O_address3'] != NULL || $parent_address[0]['F_O_ZIP_CODE'] != NULL || $parent_address[0]['F_O_Phone1'] != NULL || $parent_address[0]['OEmail'] != NULL || $parent_address[0]['F_O_Phone3'] != NULL) {
                    ?>
                        <h5 style="background-color: #fff !important; margin-bottom: 0px; margin-top: 0px;margin-left: 13px">Office Address

                        </h5>
                        <h5>&nbsp;</h5>
                        <div class="ibox-content" style="margin-top: 0px">
                            <!--<h5>Office Address</h5>-->
                            <table class="table table-stripped small m-t-md" style=" margin-top: -29px;">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['F_O_address1'] != NULL || $parent_address[0]['F_O_address2'] != NULL || $parent_address[0]['F_O_address3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['F_O_address1']; ?>
                                                <?php echo $parent_address[0]['F_O_address2']; ?>
                                                <?php echo $parent_address[0]['F_O_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['F_O_ZIP_CODE'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['F_O_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['F_O_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['F_O_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['OEmail'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['OEmail']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['F_O_Phone3'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile:<?php echo $parent_address[0]['F_O_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <div class="ibox collapsed float-e-margins" style="background-color: #fff !important">
                    <div class="ibox-title">
                        <h5> <b>Mother's Detail</b></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up" data-toggle="tooltip" title="maximize/minimize"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content" style="margin-bottom: -17px;">
                        <?php
                        if ($parent_address[0]['Mother'] != NULL || $parent_address[0]['M_profession'] != NULL || $parent_address[0]['m_adhar'] != NULL) {
                        ?>
                            <li style="list-style-type: none" class="text-uppercase"><strong><?php echo $parent_address[0]['Mother']; ?></strong> </li>
                            <li style="list-style-type: none"><?php echo $parent_address[0]['M_profession']; ?></a></li>
                            <li style="list-style-type: none"><b><?php echo $uuid_name ?> :</b><?php echo $parent_address[0]['m_adhar']; ?></li>
                        <?php
                        } else {
                            echo " No available details. ";
                        }
                        ?>
                    </div>
                    <?php
                    if ($parent_address[0]['M_C_address1'] != NULL || $parent_address[0]['M_C_address2'] != NULL || $parent_address[0]['M_C_address3'] != NULL || $parent_address[0]['M_H_ZIP_CODE'] != NULL || $parent_address[0]['M_C_Phone1'] != NULL || $parent_address[0]['M_C_Email'] != NULL || $parent_address[0]['M_C_Phone3'] != NULL) {
                    ?>
                        <div class="ibox-content" style="background-color: #fff !important">
                            <h5 style="padding-bottom: 12px;">Communication Address</h5>
                            <table class="table table-stripped small m-t-md" style="    margin-top: -10px;">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['M_C_address1'] != NULL || $parent_address[0]['M_C_address2'] != NULL || $parent_address[0]['M_C_address3'] != NULL) {
                                    ?>
                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['M_C_address1']; ?>
                                                <?php echo $parent_address[0]['M_C_address2']; ?>
                                                <?php echo $parent_address[0]['M_C_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_H_ZIP_CODE'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['M_H_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_C_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['M_C_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_C_Email'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['M_C_Email']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_C_Phone3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile: <?php echo $parent_address[0]['M_C_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                    <?php
                    if ($parent_address[0]['M_H_address1'] != NULL || $parent_address[0]['M_H_address2'] != NULL || $parent_address[0]['M_H_address3'] != NULL || $parent_address[0]['M_H_ZIP_CODE'] != NULL || $parent_address[0]['M_H_Phone1'] != NULL || $parent_address[0]['M_H_Email'] != NULL || $parent_address[0]['M_H_Phone3'] != NULL) {
                    ?>
                        <div class="ibox-content" style="margin-top: -17px;">
                            <h5>Permanent Address</h5>
                            <table class="table table-stripped small m-t-md" style="    margin-top: -3px;">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['M_H_address1'] != NULL || $parent_address[0]['M_H_address2'] != NULL || $parent_address[0]['M_H_address3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['M_H_address1']; ?>
                                                <?php echo $parent_address[0]['M_H_address2']; ?>
                                                <?php echo $parent_address[0]['M_H_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_H_ZIP_CODE'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['M_H_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_H_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['M_H_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_H_Email'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['M_H_Email']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_H_Phone3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile: <?php echo $parent_address[0]['M_H_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                    <?php
                    if ($parent_address[0]['M_O_address1'] != NULL || $parent_address[0]['M_O_address2'] != NULL || $parent_address[0]['M_O_address3'] != NULL || $parent_address[0]['M_O_ZIP_CODE'] != NULL || $parent_address[0]['M_O_Phone1'] != NULL || $parent_address[0]['M_O_Email'] != NULL || $parent_address[0]['M_O_Phone3'] != NULL) {
                    ?>
                        <div class="ibox-content" style="    margin-top: -17px;">
                            <h5>Office Address</h5>
                            <table class="table table-stripped small m-t-md" style="    margin-top: 0px;">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['M_O_address1'] != NULL || $parent_address[0]['M_O_address2'] != NULL || $parent_address[0]['M_O_address3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['M_O_address1']; ?>
                                                <?php echo $parent_address[0]['M_O_address2']; ?>
                                                <?php echo $parent_address[0]['M_O_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_O_ZIP_CODE'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['M_O_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_O_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['M_O_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_O_Email'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['M_O_Email']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['M_O_Phone3'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile: <?php echo $parent_address[0]['M_O_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                </div>
                <div class="ibox collapsed float-e-margins" style="background-color: #fff !important">
                    <div class="ibox-title">
                        <h5> <b>Guardian's Detail</b></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up" data-toggle="tooltip" title="maximize/minimize"></i>
                            </a>
                        </div>
                    </div>


                    <div class="ibox-content">
                        <?php
                        if ($parent_address[0]['Guardian'] != NULL || $parent_address[0]['G_profession'] != NULL || $parent_address[0]['g_adhar'] != NULL) {
                        ?>
                            <li style="list-style-type: none" class="text-uppercase"><strong><?php echo $parent_address[0]['Guardian']; ?></strong> </li>
                            <li style="list-style-type: none"><small><?php echo $parent_address[0]['G_profession']; ?></small></a></li>
                            <li style="list-style-type: none"><b><?php echo $uuid_name ?> :</b><?php echo $parent_address[0]['g_adhar']; ?></li>
                        <?php
                        } else {
                            echo "No available details. ";
                        }
                        ?>
                    </div>
                    <?php
                    if ($parent_address[0]['G_C_address1'] != NULL || $parent_address[0]['G_C_address2'] != NULL || $parent_address[0]['G_C_address3'] != NULL || $parent_address[0]['G_C_ZIP_CODE'] != NULL || $parent_address[0]['G_C_Phone1'] != NULL || $parent_address[0]['G_C_Email'] != NULL || $parent_address[0]['G_C_Phone3'] != NULL) {
                    ?>
                        <div class="ibox-content" style="background-color: #fff !important; margin-bottom: -17px;">
                            <h5 style="padding-bottom: 0px;">Communication Address</h5>
                            <table class="table table-stripped small m-t-md" style="    margin-top: 0px;">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['G_C_address1'] != NULL || $parent_address[0]['G_C_address2'] != NULL || $parent_address[0]['G_C_address3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['G_C_address1']; ?>
                                                <?php echo $parent_address[0]['G_C_address2']; ?>
                                                <?php echo $parent_address[0]['G_C_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_C_ZIP_CODE'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['G_C_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_C_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['G_C_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_C_Email'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['G_C_Email']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_C_Phone3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile: <?php echo $parent_address[0]['G_C_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <?php
                    if ($parent_address[0]['G_H_address1'] != NULL || $parent_address[0]['G_H_address2'] != NULL || $parent_address[0]['G_H_address3'] != NULL || $parent_address[0]['G_H_ZIP_CODE'] != NULL || $parent_address[0]['G_H_Phone1'] != NULL || $parent_address[0]['G_H_Email'] != NULL || $parent_address[0]['G_H_Phone3'] != NULL) {
                    ?>
                        <div class="ibox-content " style="padding-top: 0px;">
                            <h5>Permanent Address</h5>
                            <table class="table table-stripped small m-t-md" style="    margin-top: 0px;">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['G_H_address1'] != NULL || $parent_address[0]['G_H_address2'] != NULL || $parent_address[0]['G_H_address3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['G_H_address1']; ?>
                                                <?php echo $parent_address[0]['G_H_address2']; ?>
                                                <?php echo $parent_address[0]['G_H_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_H_ZIP_CODE'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['G_H_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_H_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['G_H_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_H_Email'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['G_H_Email']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_H_Phone3'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile: <?php echo $parent_address[0]['G_H_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <?php
                    if ($parent_address[0]['G_O_address1'] != NULL || $parent_address[0]['G_O_address2'] != NULL || $parent_address[0]['G_O_address3'] != NULL || $parent_address[0]['G_O_ZIP_CODE'] != NULL || $parent_address[0]['G_O_Phone1'] != NULL || $parent_address[0]['G_O_Email'] != NULL || $parent_address[0]['G_O_Phone3'] != NULL) {
                    ?>
                        <div class="ibox-content" style="    margin-top: -17px;">
                            <h5>Office Address</h5>
                            <table class="table table-stripped small m-t-md" style="    margin-top: 0px;">
                                <tbody>
                                    <?php
                                    if ($parent_address[0]['G_O_address1'] != NULL || $parent_address[0]['G_O_address2'] != NULL || $parent_address[0]['G_O_address3'] != NULL) {
                                    ?>

                                        <tr>
                                            <td class="no-borders">
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td class="no-borders text-uppercase">
                                                <?php echo $parent_address[0]['G_O_address1']; ?>
                                                <?php echo $parent_address[0]['G_O_address2']; ?>
                                                <?php echo $parent_address[0]['G_O_address3']; ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_O_ZIP_CODE'] != NULL) {
                                    ?>

                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Zip Code: <?php echo $parent_address[0]['G_O_ZIP_CODE']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_O_Phone1'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Phone: <?php echo $parent_address[0]['G_O_Phone1']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_O_Email'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Email: <?php echo $parent_address[0]['G_O_Email']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if ($parent_address[0]['G_O_Phone3'] != NULL) {
                                    ?>
                                        <tr>
                                            <td>
                                                <i class="fa fa-circle text-navy"></i>
                                            </td>
                                            <td>
                                                Mobile: <?php echo $parent_address[0]['G_O_Phone3']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                </div>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <?php if (trim($student_data['StatusFlag']) != 'L' && trim($student_data['StatusFlag']) != 'TP') { ?>
                            <a href="javascript:void(0);" title="Assign as Long Absentee" studtcstatus="<?php echo $tcstatus; ?>" id="tcstatuscheck" onclick="fees_detail('<?php echo $studentid; ?>');"> <span class="label label-warning pull-right" style="background-color:#23C6C8;font-size: 12px;">Assign as Long Absentee</span></a>
                        <?php } ?>
                        <!--<span class="label label-warning pull-right">Fee Details</span>-->
                        <h5><b> History <?php //echo 'A' . trim($student_data['StatusFlag']) . 'B' 
                                        ?> </b></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="scrollerdata">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Modified On</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($student_data1) && !empty($student_data1)) {
                                        // dev_export($student_data1);die;
                                        foreach ($student_data1 as $status) {
                                    ?>
                                            <tr>

                                                <td><?php if ($status['status'] == 'L') {
                                                        echo 'Marked as Long absentee';
                                                    } else if ($status['status'] == 'LR') {
                                                        echo 'Released from Long absentee';
                                                    } else {
                                                        echo $status['Description'];
                                                    } ?></td>
                                                <td><?php echo $status['Entry_Date'] . " " . $status['Entry_Time']; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="ibox float-e-margins" id="batch_change">
                    <div class="ibox-title">
                        <h5><b>ACADEMIC HISTORY</b></h5>
                    </div>
                    <div class="ibox-content no-padding">
                        <?php //dev_export($academic_history); 
                        ?>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Year</th>
                                <th>Class</th>
                                <th>Batch</th>
                            </tr>
                            <tr class="text-success bold">
                                <td><?php echo $student_data['acdyr'] ?></td>
                                <td><?php echo $student_data['Description'] ?></td>
                                <td><?php echo $student_data['Batch_Name'] ?></td>
                            </tr>
                            <?php
                            if (!empty($academic_history)) {
                                foreach ($academic_history as $ah) {
                            ?>
                                    <tr>
                                        <td><?php echo $ah['academic_year'] ?></td>
                                        <td><?php echo $ah['class'] ?></td>
                                        <td><?php echo $ah['batch'] ?></td>
                                    </tr>
                            <?php
                                }
                            } ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="batchid" id="batchid" value="<?php echo $batchid; ?>" />
<!-- MENU -->
<script src="<?php echo base_url('assets/theme/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>


<!-- Custom and plugin javascript -->
<script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>


<script>
    $('.scrollerdata').slimscroll({
        height: '225px'
    });
    //                            $('#leaving_date').datepicker('setDate', 'now');
    $(document).ready(function() {


        $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 48], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#1ab394',
            fillColor: "transparent"
        });
        $('#leaving_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            startDate: "<?php echo date('d-m-Y', strtotime($student_data['admission_date'] . '+1 day')) ?>",
            format: 'd/mm/yyyy'
        });
    });
    $('#batch_select_student').select2({
        "theme": "bootstrap"
    });

    function typeNumberOnly(eve) {
        var e = (eve.which) ? eve.which : eve.keyCode;
        if (e != 8 && e != 0 && (e < 48 || e > 57)) {
            return false;
        }
    }

    function myDateFormatter(applytc_date) {
        var d = new Date(applytc_date);
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = year + "-" + month + "-" + day;

        return date;
    };

    function tc_apply(student_id, student_name, Admn_NO, Class_ID, Batch_Name, Cur_AcadYr, admin_date, batchid, fee_summary, exm_pending) {
        $('#tc_apply').attr("disabled", true);
        $('#tc_loader').addClass('sk-loading');
        var studentid = student_id;
        var batchid = batchid;
        var studentname = student_name;
        var AdmnNO = Admn_NO;
        var ClassID = Class_ID;
        var BatchName = Batch_Name;
        var CurAcadYr = Cur_AcadYr;
        var tc_reason = $('#tc_reason').val();
        //(moment($("#leaving_date").datepicker("getDate")).isValid() == true) ?
        // var applytc_date =  moment($("#leaving_date").datepicker("getDate")).format('YYYY-MM-DD');
        var applytc_dateval = $("#leaving_date").val().split("/");
        var applytc_datefn = new Date(applytc_dateval[2], applytc_dateval[1] - 1, applytc_dateval[0]);
        var applytc_date = myDateFormatter(applytc_datefn);
        var tc_saving = new Object();
        var admin_date = admin_date;
        //$("#applytc_date").datepicker.regional[""].dateFormat = 'dd/mm/yy';
        //$("#applytc_date").datepicker("setDate", new Date());
        if (fee_summary > 0) {
            // exm_pending = parseFloat(exm_pending).toFixed(2);
            if (exm_pending > 0)
                swal('Cannot Apply TC', 'Exemption Pending ' + exm_pending + ' for this student.', 'info');
            else
                swal('Cannot Apply TC', 'Pending amount ' + fee_summary + ' shall be cleared before applying TC.', 'info');
            $('#tc_apply').attr("disabled", false);
            $('#tc_loader').removeClass('sk-loading');
            $('#tc_reason').val('');
            return false;
        }

        if (applytc_date == '') {
            swal('', 'Expected date of leaving is required.', 'info');
            $('#tc_loader').removeClass('sk-loading');
            $('#tc_apply').attr("disabled", false);
            $('#tc_loader').removeClass('sk-loading');
            return false;
        }

        if (tc_reason == '') {
            swal('', 'Reason for leaving is required.', 'info');
            $('#tc_loader').removeClass('sk-loading');
            $('#tc_apply').attr("disabled", false);
            $('#tc_loader').removeClass('sk-loading');
            return false;
        }

        var flag = 0;

        var ops_url = baseurl + 'tc/validate-tc';
        $.ajax({
            type: "POST",
            cache: false,
            url: ops_url,
            async: true,
            data: {
                admission_date: function() {
                    return admin_date;
                },
                todate: applytc_date
            },
            success: function(result) {
                $('#tc_loader').removeClass('sk-loading');
                var data = $.parseJSON(result)
                flag = data.status;
                if (flag == 2) {
                    swal('', 'TC can be applied only one day after registration.', 'info');
                    $('#tc_reason').val('');
                    $('#tc_apply').attr("disabled", false);
                    return false;
                } else {
                    tc_saving.student_id = studentid;
                    tc_saving.batchid = batchid;
                    tc_saving.student_name = studentname;
                    tc_saving.Admn_NO = AdmnNO;
                    tc_saving.Class_ID = ClassID;
                    tc_saving.Batch_Name = BatchName;
                    tc_saving.Cur_AcadYr = CurAcadYr;
                    tc_saving.tc_reason = tc_reason;
                    tc_saving.applytc_date = applytc_date;
                    var studentdata = JSON.stringify(tc_saving);
                    var ops_url = baseurl + 'tc/apply-tc';
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "load": 1,
                            "studentdata": studentdata,
                            "student_id": studentid,
                            "batchid": batchid
                        },
                        success: function(result) {
                            $('#tc_loader').removeClass('sk-loading');
                            var data = $.parseJSON(result)
                            if (data.status == 1) {
                                var feesummary = parseFloat(data.feesummary).toFixed(4);
                                swal('', 'TC Applied successfully.', 'success');
                                profile_detail(studentid);
                                //create cleare date after tc apply by vinoth @28-05-2019 11:21
                                // $('#tc_reason').val('');
                                // $('#fee_summary_div').html(feesummary);
                                // $('#tc_apply').attr("disabled", true);
                                // $('#tc_apply').hide();
                                // $('#tc_loader').html('TC Already applied!');
                                // //$("#leaving_date").val('');
                            } else {
                                $('#tc_reason').val('');
                                //$("#leaving_date").val('');
                                if (data.message) {
                                    swal('', data.message, 'info');
                                    $('#tc_loader').removeClass('sk-loading');
                                    $('#tc_apply').attr("disabled", false);
                                    return false;
                                } else {
                                    swal('', 'An error encountered while saving TC Application. Please try again later or contact administrator.');
                                    return false;
                                }
                            }

                        }
                    });
                }
            },
            error: function() {
                $('#tc_loader').removeClass('sk-loading');
            }

        });
        $('#tc_loader').removeClass('sk-loading');


    }
    // function tc_apply(student_id, student_name, Admn_NO, Class_ID, Batch_Name, Cur_AcadYr, admin_date, batchid) {
    //     $('#tc_loader').addClass('sk-loading');
    //     var studentid = student_id;
    //     var batchid = batchid;
    //     var studentname = student_name;
    //     var AdmnNO = Admn_NO;
    //     var ClassID = Class_ID;
    //     var BatchName = Batch_Name;
    //     var CurAcadYr = Cur_AcadYr;
    //     var tc_reason = $('#tc_reason').val();
    //     var applytc_date = (moment($("#leaving_date").datepicker("getDate")).isValid() == true) ? moment($("#leaving_date").datepicker("getDate")).format('YYYY-MM-DD') : '';
    //     var tc_saving = new Object();
    //     var admin_date = admin_date;
    //     // $("#applytc_date").datepicker.regional[""].dateFormat = 'dd/mm/yy';
    //     // $("#applytc_date").datepicker("setDate", new Date());


    //     if (applytc_date == '') {
    //         swal('', 'TC application date is required.', 'info');
    //         $('#tc_loader').removeClass('sk-loading');
    //         return false;
    //     }

    //     if (tc_reason == '') {
    //         swal('', 'TC application reason is required.', 'info');
    //         $('#tc_loader').removeClass('sk-loading');
    //         return false;
    //     }

    //     var flag = 0;

    //     var ops_url = baseurl + 'tc/validate-tc';
    //     $.ajax({
    //         type: "POST",
    //         cache: false,
    //         url: ops_url,
    //         async: false,
    //         data: {admission_date: function () {
    //                 return admin_date;
    //             },
    //             todate: applytc_date
    //         },
    //         success: function (result) {
    //             $('#tc_loader').removeClass('sk-loading');
    //             var data = $.parseJSON(result)
    //             flag = data.status;
    //             if (flag == 2) {
    //                 swal('', 'TC can be applied only one day after registration.', 'info');
    //                 return false;
    //             } else {
    //                 tc_saving.student_id = studentid;
    //                 tc_saving.batchid = batchid;
    //                 tc_saving.student_name = studentname;
    //                 tc_saving.Admn_NO = AdmnNO;
    //                 tc_saving.Class_ID = ClassID;
    //                 tc_saving.Batch_Name = BatchName;
    //                 tc_saving.Cur_AcadYr = CurAcadYr;
    //                 tc_saving.tc_reason = tc_reason;
    //                 tc_saving.applytc_date = applytc_date;
    //                 var studentdata = JSON.stringify(tc_saving);
    //                 var ops_url = baseurl + 'tc/apply-tc';
    //                 $.ajax({
    //                     type: "POST",
    //                     cache: false,
    //                     async: false,
    //                     url: ops_url,
    //                     data: {"load": 1, "studentdata": studentdata},
    //                     success: function (result) {
    //                         $('#tc_loader').removeClass('sk-loading');
    //                         var data = $.parseJSON(result)
    //                         if (data.status == 1) {
    //                             swal('', 'TC Applied successfully', 'success');
    //                             // create cleare date after tc apply by vinoth @28-05-2019 11:21
    //                            $('#tc_reason').val('');
    //                            $("#leaving_date").val('');
    //                         } else {
    //                             $('#tc_reason').val('');
    //                             $("#leaving_date").val('');
    //                             if (data.message) {
    //                                 swal('', data.message, 'info');
    //                                 return false;
    //                             } else {
    //                                 swal('', 'An error encountered while saving TC Application. Please try again later or contact administrator.');
    //                                 return false;
    //                             }
    //                         }

    //                     }
    //                 });
    //             }
    //         },
    //         error: function () {
    //             $('#tc_loader').removeClass('sk-loading');
    //         }

    //     });


    // }
    //function name change by vinoth @ 23-05-2019 12:47
    function enable_batch_change() {
        document.getElementById("batch_select_student").disabled = false;
        document.getElementById("batch_update_btn").disabled = false;
    }
    //                            function create by vinoth @ 23-05-2019 12:47
    function enable_edit_admno() {
        document.getElementById("edit_admno").disabled = false;
        document.getElementById("update_admno").disabled = false;
    }
    $('#batch_select').select2({
        'theme': 'bootstrap'
    });

    function batch_change_function(student_id, Cur_AcadYr) {
        var BatchID = $('#batch_select_student :selected').val();
        if (BatchID < 1) {
            swal('', 'Select a batch for allocation', 'info');
            return false;
        }

        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'batch/change-batch';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "BatchID": BatchID,
                "student_id": student_id,
                "Cur_AcadYr": Cur_AcadYr
            },
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#faculty_loader').removeClass('sk-loading');
                    $('#batch_name_display').html($('#batch_select_student :selected').text());
                    //                                            $('#batch_select_student: selected').text('');
                    $("#batch_select_student").attr("disabled", "true");
                    $("#batch_update_btn").attr("disabled", "true");
                    swal('', 'Batch changed successfully.', 'success');
                    profile_detail(student_id);

                } else {
                    if (data.message) {
                        $('#faculty_loader').removeClass('sk-loading');
                        $('#batch_name_display').html($('#batch_select_student :selected').text());
                        $("#batch_select_student").attr("disabled", "true");
                        $("#batch_update_btn").attr("disabled", "true");
                        swal('', data.message, 'info');
                        // return false;
                    } else {
                        $('#faculty_loader').removeClass('sk-loading');
                        swal('', 'An error encountered while changing Batch. Please try again later or contact administrator.');
                        return false;
                    }
                }

            }
        });
    }

    //                            function create by vinoth @ 23-05-2019 12:52
    function edit_admno_function(student_id, Cur_AcadYr) {
        var admn_no = $('#edit_admno').val();
        if (admn_no == '') {
            swal('', 'Enter Admission No.', 'info');
            return false;
        }
        if (admn_no.length < 5) {
            swal('', 'Admission No. must have 5 digits', 'info');
            return false;
        }
        admn_no += $('#admn_suffix').text().trim();

        var ops_url = baseurl + 'admno/change-admno';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "admn_no": admn_no,
                "student_id": student_id,
                "Cur_AcadYr": Cur_AcadYr
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $("#edit_admno").attr("disabled", "true");
                    $("#update_admno").attr("disabled", "true");
                    swal('', 'Admission No. Updated Successfully.', 'success');
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'An error encountered while changing Admission No. Please try again later or contact administrator.');
                        return false;
                    }
                    batch_name
                }

            }
        });
    }

    function profile_detail(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'profilestudent/show-studentprofile/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(data) {
                $('#content').html('');
                $('#content').show();
                $('#content').html(data);
                $('.registration-view').hide();
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }

    function documents_detail(student_id, batch_id) {
        var ops_url = baseurl + 'documents/show-documents/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "batch_id": batch_id
            },
            success: function(result) {
                //                                        var data = $.parseJSON(result)
                //                                        $('#data-view').html(data.view);
                $('#content').html('');
                $('#content').html(result);
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }

    function submit_email_data() {
        $('#faculty_loader').addClass('sk-loading');
        var to_email = $('#to_email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();
        var stud_name = $('#stud_name').val();
        var Admn_No = $('#adm_no').val();
        var batch_name = $('#batch_name').val();

        if (to_email == "") {
            swal('', 'To Mail Needed', 'info');
            return false;
        }
        if (subject == "") {
            swal('', 'Subject is required.', 'info');
            return false;
        }
        if (message == "") {
            swal('', 'Message is required.', 'info');
            return false;
        }
        //        var body = $($(".summernote").summernote("code")).text();

        var ops_url = baseurl + 'registration/send-mail';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "to_email": to_email,
                "subject": subject,
                "email_body": message,
                "stud_name": stud_name,
                "admn_no": Admn_No,
                "batch": batch_name
            },
            success: function(result) {
                console.log(result);
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'Private message sent successfully', 'success');
                    $('#subject').val('');
                    $('#message').val('');
                } else {
                    swal('', 'There is an issue with sending private message. Please contact administrator');
                    return false;
                }


            }
        });
    }

    function set_min_wallet_amount() {
        $('#wallet_loader').addClass('sk-loading');
        var had_email = $('#had_email').val();
        var amount_limit = $('#amount_limit').val();
        if (amount_limit == "") {
            $('#wallet_loader').removeClass('sk-loading');
            swal('', 'Min. Amt. to pay in Wallet is required.', 'info');
            return false;
        }
        if (amount_limit == 0) {
            $('#wallet_loader').removeClass('sk-loading');
            swal('', 'Min. Amt. to pay in Wallet is required.', 'info');
            return false;
        }

        var email_from_db = $('#email_from_db').val();
        var to_email = $('#set_email').val();
        if (to_email == "") {
            $('#wallet_loader').removeClass('sk-loading');
            swal('', 'To Email is required', 'info');
            return false;
        }

        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/
        if (!pattern.test(to_email)) {
            $('#wallet_loader').removeClass('sk-loading');
            swal('', "Enter a valid email.", 'info');
            return false;
        }
        var father_id = $('#father_id').val();
        var student_id = $('#student_id').val();
        var stud_name = $('#stud_name').val();
        var Admn_No = $('#adm_no').val();
        var batch_name = $('#batch_name').val();

        var ops_url = baseurl + 'fees/set_min_wallet_amount';

        var update_email = 0;
        var data_ok = 0;
        if (email_from_db != to_email) {
            swal({
                title: 'Email Id',
                text: 'The email will be updated in the profile and may use for future purpose.If ok select yes else change email id in profile.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#wallet_loader').addClass('sk-loading');
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: true,
                        url: ops_url,
                        data: {
                            "to_email": to_email,
                            "amount_limit": amount_limit,
                            "student_id": student_id,
                            "stud_name": stud_name,
                            "admn_no": Admn_No,
                            "batch": batch_name,
                            "update_email": 1,
                            "father_id": father_id
                        },
                        success: function(result) {
                            console.log(result);
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                $('#wallet_loader').removeClass('sk-loading');
                                swal('', 'Amount set successfully.', 'success');
                                $('#amount_limit').val('');
                                profile_detail(student_id);
                            } else {
                                $('#wallet_loader').removeClass('sk-loading');
                                swal('', 'There is an error occured. Please contact administrator');
                                return false;
                            }
                        }
                    });
                } else {
                    $('#wallet_loader').removeClass('sk-loading');
                    var update_email = 0;
                    var data_ok = 0;
                    swal('Email Id', 'Please update the email address in student profile', 'warning');
                    return false;
                }
            });
        } else {
            $.ajax({
                type: "POST",
                cache: false,
                async: true,
                url: ops_url,
                data: {
                    "to_email": to_email,
                    "amount_limit": amount_limit,
                    "student_id": student_id,
                    "stud_name": stud_name,
                    "admn_no": Admn_No,
                    "batch": batch_name,
                    "update_email": 0,
                    "father_id": father_id
                },
                success: function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#wallet_loader').removeClass('sk-loading');
                        swal('', 'Amount set successfully.', 'success');
                        $('#amount_limit').val('');
                        profile_detail(student_id);
                    } else {
                        $('#wallet_loader').removeClass('sk-loading');
                        swal('', 'There is an error occured. Please contact administrator');
                        return false;
                    }
                }
            });
        }

    }

    function fees_detail(studentid) {
        var studtcstatus = $('#tcstatuscheck').attr('studtcstatus');
        if (studtcstatus == 'A') {
            swal('', 'TC Applied. Cancel TC application to mark the student as long Absentee.', 'info');
            return false;
        } else {
            var batchid = $('#batchid').val();
            var courseid = '<?php echo $student_data['Class_ID'] ?>';
            var ops_url = baseurl + 'longabsentee/long-fees/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "studentid": studentid,
                    "batchid": batchid,
                    "courseid": courseid
                },
                success: function(data) {
                    $('#content').html('');
                    $('#content').html(data);
                    $('html, body').animate({
                        scrollTop: $("#content").offset().top
                    }, 1000);
                }
            });
        }
    }

    function load_students_after_filter_on_breadcrumb(batch_id, acdyear, courseid) {

        var ops_url = baseurl + 'profile/show-profile';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "batchid": batch_id,
                "acd_year": acdyear,
                "courseid": courseid
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                } else {

                }
            },
            error: function() {}
        });
    }
</script>