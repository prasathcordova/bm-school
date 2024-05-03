 <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
 <link href="<?php echo base_url('assets/theme/css/plugins/steps/step.styles.css'); ?>" rel="stylesheet">
 <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
 <!--<script src="<?php // echo base_url('assets/theme/plugins/validate/jquery.validate.js');                                                                                                                 
                    ?>"></script>-->



 <!--<script src="<?php // echo base_url('assets/theme/js/plugins/validate/jquery.validate.min.js')                                                                                            
                    ?>"></script>-->
 <script src="<?php echo base_url('assets/theme/plugins/validate/jquery.validate.js') ?>"></script>



 <div id="profile-detail-content" style="display:none;"></div>
 <div class="row wrapper border-bottom white-bg page-heading registration-view">
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
 <style type="text/css">
     .form-control:focus {
         outline: auto;
         outline-color: #23c6c8;
     }

     .wizard a,
     .tabcontrol a {
         border: 2px solid transparent;
     }

     .wizard a:focus,
     .tabcontrol a:focus {
         outline: 0;
         /*outline-color: #23c6c8;*/
         border: 2px solid;
         border-color: #3F51B5;
     }
 </style>
 <div class="wrapper wrapper-content animated fadeInRight registration-view" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
     <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
         <div class="col-lg-12">
             <div class="ibox float-e-margins">
                 <div class="ibox-title">
                     <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                 </div>
                 <div class="ibox-content">
                     <div class="row">
                         <div class="col-lg-12">
                             <?php
                                if ($this->session->userdata('Age_Limit') != '0') {
                                ?>
                                 <input type="hidden" id="agelimit" data-val="<?php echo $this->session->userdata('Age_count'); ?>" value="<?php echo $this->session->userdata('Age_Limit'); ?>" />
                             <?php
                                } else {
                                ?>
                                 <input type="hidden" id="agelimit" data-val="0" value="0" />
                             <?php
                                }
                                ?>
                             <div id="curd-content" style="display: none;"></div>
                         </div>
                         <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 wizard-big" id="wizard">
                             <h1>PERSONAL DETAILS</h1>
                             <fieldset>
                                 <form action="#" role="form" id="personal_details">

                                     <div class="row ">
                                         <?php // dev_export($profile_details).'</pre>'; 
                                            ?>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group">
                                                 <label class="control-label" for="unique_identity"><?php if ($uuid_unit_limit == 12) { ?> Aadhar Number <?php } else { ?> Emirates ID <?php } ?></label>
                                                 <?php
                                                    if ((isset($profile_details['Adhar_No']) && !empty($profile_details['Adhar_No']) && strlen($profile_details['Adhar_No']) == $uuid_unit_limit)) {
                                                    ?>
                                                     <input type="text" id="unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="unique_identity" value="<?php echo $profile_details['Adhar_No']; ?>" placeholder="Enter <?php
                                                                                                                                                                                                                                        if ($uuid_unit_limit == 12) {
                                                                                                                                                                                                                                            echo 'Aadhar Number';
                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                            echo 'Emirates ID';
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        ?> " class="form-control" onkeypress="return typeNumberOnly(event)" onkeyup="checkEmirateAvailable()">
                                                 <?php } else { ?>
                                                     <input type="text" id="unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="unique_identity" value="<?php echo $profile_details['Adhar_No']; ?>" placeholder="Enter <?php
                                                                                                                                                                                                                                        if ($uuid_unit_limit == 12) {
                                                                                                                                                                                                                                            echo 'Aadhar Number';
                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                            echo 'Emirates ID';
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        ?> " class="form-control" onkeypress="return typeNumberOnly(event)" onkeyup="checkEmirateAvailable()">
                                                 <?php }
                                                    ?>

                                             </div>
                                             <div id="id_spot_check"></div>
                                         </div>
                                         <div class="col-lg-8">
                                             <div class="panel panel-info">
                                                 <div class="panel-body">
                                                     <p><?php
                                                        if ($uuid_unit_limit == 12) {
                                                            echo 'Aadhar Number';
                                                        } else {
                                                            echo 'Emirates ID';
                                                        }
                                                        ?> is a unique identification number to uniquely identify individuals. Use this option to
                                                         check whether the student is already registered or not.
                                                         <!--                                                            If the student is already registered with a different status then the student status will be updated except for a long absentee student.
                                                                                                                    For the long absent student, the  status need to be changed with the admission number provided. All other students this page will make the student 
                                                                                                                    as an active student in roll but the admission number won't be changed.                                                        -->
                                                     </p>
                                                 </div>

                                             </div>
                                         </div>
                                         <div class="clearfix"></div>
                                         <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                             <hr />
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="ibox-content text-center">
                                                 <label class="control-label" for="browse" style="float:right;" title="Change the image"><span class="label label-warning pull-right" for="browse">CHANGE</span></label>
                                                 <input type="file" id="browse" name="browse" style="display: none" onchange="readURL(this);">
                                                 <div class="m-b-sm">
                                                     <?php
                                                        $profile_image = "";
                                                        if (!empty(get_student_image($profile_details['student_id']))) {
                                                            $profile_image = get_student_image($profile_details['student_id']);
                                                        } else
                                                        if (isset($profile_details['profile_image']) && !empty($profile_details['profile_image'])) {

                                                            $profile_image = "data:image/jpeg;base64," . $profile_details['profile_image'];
                                                        } else {
                                                            if (isset($profile_details['profile_image_alternate']) && !empty($profile_details['profile_image_alternate'])) {
                                                                $profile_image = $profile_details['profile_image_alternate'];
                                                            } else {
                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                            }
                                                        }
                                                        ?>
                                                     <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>" onclick="" id="profile_image" style="width: 128px;    height: 128px;">
                                                     <input type="hidden" name="profile_image_data" id="profile_image_data" />
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-lg-8">
                                             <div class="panel panel-info">
                                                 <div class="panel-body">
                                                     <p>Info regarding registration</p>

                                                 </div>

                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <input type="hidden" value="<?php echo $profile_details['student_id']; ?>" name="studentid" id="studentid" />
                                     <div class="row ">
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group">
                                                 <label class="control-label" for="firstname">First Name </label><span class="mandatory"> *</span>
                                                 <input type="text" id="firstname" name="firstname" value="<?php echo $profile_details['First_Name']; ?>" placeholder="Enter First Name" class="form-control" required="" autofocus="">
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group">
                                                 <label class="control-label" for="middlename">Middle Name </label>
                                                 <input type="text" id="middlename" name="middlename" value="<?php echo $profile_details['Middle_Name']; ?>" placeholder="Enter Middle Name" class="form-control">
                                             </div>
                                         </div>

                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group">
                                                 <label class="control-label" required for="lastname">Last Name </label><span class="mandatory"> *</span>
                                                 <input type="text" id="lastname" name="lastname" value="<?php echo $profile_details['Last_Name']; ?>" placeholder="Enter Last Name" class="form-control" required="">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="row">
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group ">
                                                 <label>Gender </label><span class="mandatory"> *</span>
                                                 <select class="select2_demo_1 form-control" id="gender" name="gender">
                                                     <?php
                                                        if (isset($profile_details) && !empty($profile_details)) {
                                                            if ($profile_details['Sex'] == 'F') {
                                                                echo '<option selected="" value ="F" >Female</option>';
                                                                echo '<option  value ="M" >Male</option>';
                                                            } else if ($profile_details['Sex'] == 'M') {
                                                                echo '<option selected="" value ="M" >Male</option>';
                                                                echo '<option  value ="F" >Female</option>';
                                                            } else {
                                                                echo '<option selected="" value="-1">Select</option>';
                                                                echo '<option  value ="M" >Male</option>';
                                                                echo '<option  value ="F" >Female</option>';
                                                            }
                                                        }
                                                        ?>

                                                 </select>
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group " id="data_1">
                                                 <label>Date of Birth </label><span class="mandatory"> *</span>
                                                 <div class="input-group date" style="width:100%;">
                                                     <?php
                                                        $originalDate = $profile_details['DOB'];
                                                        $student_dob = date("d-m-Y", strtotime($originalDate));
                                                        ?>
                                                     <input value="<?php echo $student_dob; ?>" type="text" placeholder="Enter Date of Birth" onchange="age_changer();" readonly="" style="background-color:#fff;" class="form-control" id="dob_date" name="dob_date">
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group">
                                                 <label class="control-label" for="status">Age </label>
                                                 <input type="text" id="age" name="age" readonly="" data-val="<?php echo $profile_details['Age']; ?>" placeholder="Age" class="form-control">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="row">
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group <?php
                                                                    if (form_error('country_select')) {
                                                                        echo 'has-error';
                                                                    }
                                                                    ?>">
                                                 <label>Country</label><span class="mandatory"> *</span>
                                                 <select name="country_select" id="country_select" required="" class="form-control select2_registration" style="width:100%;" onchange="changed_country();">

                                                     <?php
                                                        if (isset($country_data) && !empty($country_data)) {
                                                            foreach ($country_data as $country) {
                                                                if (isset($profile_details['Nationality']) && !empty($profile_details['Nationality']) && $profile_details['Nationality'] == $country['country_id']) {
                                                                    echo '<option value ="' . $country['country_id'] . '" selected data-nationality="' . $country['country_nation'] . '">' . $country['country_name'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $country['country_id'] . '" data-nationality="' . $country['country_nation'] . '">' . $country['country_name'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                                 <?php echo form_error('country_select', '<div class="form-error">', '</div>'); ?>
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group">
                                                 <label class="control-label" for="nationality">Nationality </label><span class="mandatory"> *</span>
                                                 <input type="text " disabled="" required="" placeholder="Nationality" id="nationality" name="nationality" value="<?php echo $profile_details['NationalityName']; ?>" placeholder="Nationality" class="form-control required">
                                             </div>
                                         </div>

                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group <?php
                                                                    if (form_error('state_select')) {
                                                                        echo 'has-error';
                                                                    }
                                                                    ?>">
                                                 <label>State</label><span class="mandatory"> *</span>
                                                 <select name="state_select" id="state_select" class="form-control select2_registration" style="width:100%;" onchange="changed_state();">
                                                     <option value="-1" selected="">Select</option>
                                                     <?php
                                                        if (isset($state_data) && !empty($state_data)) {
                                                            foreach ($state_data as $state) {
                                                                if (isset($profile_details['state']) && !empty($profile_details['state']) && $profile_details['state'] == $state['state_id']) {
                                                                    echo '<option value ="' . $state['state_id'] . '" selected >' . $state['state_name'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $state['state_id'] . '" >' . $state['state_name'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                                 <?php echo form_error('state_select', '<div class="form-error">', '</div>'); ?>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="row">
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group <?php
                                                                    if (form_error('district_select')) {
                                                                        echo 'has-error';
                                                                    }
                                                                    ?>">
                                                 <label>District</label><span class="mandatory"> *</span><br />

                                                 <select name="district_select" id="district_select" required="" class="form-control select2_registration " style="width:100%;">
                                                     <option value="-1" selected="">Select</option>
                                                     <?php
                                                        if (isset($city_data) && !empty($city_data)) {
                                                            foreach ($city_data as $district) {
                                                                if (isset($profile_details['district']) && !empty($profile_details['district']) && $profile_details['district'] == $district['city_id']) {
                                                                    echo '<option value ="' . $district['city_id'] . '" selected >' . $district['city_name'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $district['city_id'] . '" >' . $district['city_name'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                                 <?php echo form_error('district_select', '<div class="form-error">', '</div>'); ?>
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group <?php
                                                                    if (form_error('mother_tongue')) {
                                                                        echo 'has-error';
                                                                    }
                                                                    ?>">
                                                 <label>Mother Tongue</label><span class="mandatory"> *</span>
                                                 <select name="mother_tongue" id="mother_tongue" required="" class="form-control select2_registration" style="width:100%;">
                                                     <option selected value="-1">Select</option>
                                                     <?php
                                                        if (isset($language_data) && !empty($language_data)) {
                                                            foreach ($language_data as $language) {
                                                                if (isset($profile_details['MotherTongue']) && !empty($profile_details['MotherTongue']) && $profile_details['MotherTongue'] == $language['language_id']) {
                                                                    echo '<option value ="' . $language['language_id'] . '" selected >' . $language['language_name'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                                 <?php echo form_error('mother_tongue', '<div class="form-error">', '</div>'); ?>
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group <?php
                                                                    if (form_error('language_select')) {
                                                                    }
                                                                    ?>">
                                                 <label>Known Languages</label><span class="mandatory"> *</span>
                                                 <select class="select2_demo_2 form-control" name="language_select" id="language_select" multiple="multiple">
                                                     <?php
                                                        if (isset($language_data) && !empty($language_data)) {
                                                            foreach ($language_data as $language) {
                                                                if (isset($formatted_language) && !empty($formatted_language) && in_array($language['language_id'], $formatted_language)) {
                                                                    echo '<option selected value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $language['language_id'] . '" >' . $language['language_name'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>

                                                 </select>
                                                 <?php echo form_error('language_select', '<div class="form-error">', '</div>'); ?>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="row">
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group <?php
                                                                    if (form_error('religion_select')) {
                                                                        echo 'has-error';
                                                                    }
                                                                    ?>">
                                                 <label>Religion</label><span class="mandatory"> *</span>
                                                 <select name="religion_select" id="religion_select" class="form-control select2_registration" style="width:100%;" onchange="changed_religion();">
                                                     <option selected value="-1">Select</option>
                                                     <?php
                                                        if (isset($relegion) && !empty($relegion)) {
                                                            foreach ($relegion as $religion) {
                                                                if (isset($profile_details['Religion']) && !empty($profile_details['Religion']) && $profile_details['Religion'] == $religion['religion_id']) {
                                                                    echo '<option value ="' . $religion['religion_id'] . '" selected >' . $religion['religion_name'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $religion['religion_id'] . '" >' . $religion['religion_name'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                                 <?php echo form_error('religion_select', '<div class="form-error">', '</div>'); ?>
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group <?php
                                                                    if (form_error('caste_select')) {
                                                                        echo 'has-error';
                                                                    }
                                                                    ?>">
                                                 <label>Caste</label><span class="mandatory"> *</span>
                                                 <select name="caste_select" id="caste_select" class="form-control select2_registration" style="width:100%;" onchange="caste_change();">
                                                     <option selected value="-1">Select</option>
                                                     <?php
                                                        if (isset($caste_data) && !empty($caste_data)) {
                                                            foreach ($caste_data as $caste) {
                                                                if (isset($profile_details['Caste']) && !empty($profile_details['Caste']) && $profile_details['Caste'] == $caste['caste_id']) {
                                                                    echo '<option value ="' . $caste['caste_id'] . '" data-communityselect="' . $caste['community_id'] . '" selected>' . $caste['caste_name'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $caste['caste_id'] . '" data-communityselect="' . $caste['community_id'] . '">' . $caste['caste_name'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                                 <?php echo form_error('caste_select', '<div class="form-error">', '</div>'); ?>
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group <?php
                                                                    if (form_error('community_select')) {
                                                                        echo 'has-error';
                                                                    }
                                                                    ?>">
                                                 <label>Community</label><span class="mandatory"> *</span>
                                                 <select name="community_select" id="community_select" class="form-control select2_registration" style="width:100%;">
                                                     <option selected value="-1">Select</option>
                                                     <?php
                                                        if (isset($community_data) && !empty($community_data)) {
                                                            foreach ($community_data as $community) {
                                                                if (isset($profile_details['Community']) && !empty($profile_details['Community']) && $profile_details['Community'] == $community['community_id']) {
                                                                    echo '<option value ="' . $community['community_id'] . '" selected >' . $community['community_name'] . '</option>';
                                                                } else {
                                                                    echo '<option value ="' . $community['community_id'] . '" >' . $community['community_name'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                                 <?php echo form_error('community_select', '<div class="form-error">', '</div>'); ?>
                                             </div>
                                         </div>


                                     </div>
                                     <div class="clearfix"></div>
                                 </form>
                             </fieldset>

                             <h1>ACADEMIC AND REGISTRATION</h1>
                             <fieldset>
                                 <form action="#" id="academic_profile">
                                     <div class="row">
                                         <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group">
                                                 <label>Admission No. :</label>
                                                 <input placeholder="Auto" readonly="" <?php
                                                                                        if ($profile_details['adminno'] != 'NA') {
                                                                                            echo "value='" . $profile_details['adminno'] . "'";
                                                                                        }
                                                                                        ?> type="text" class="form-control " id="admn_no" name="admission_no">
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group" id="data_1">
                                                 <label class="font-noraml"> Admissions Date </label><span class="mandatory"> *</span>
                                                 <div class="input-group" style="width:100%">
                                                     <!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
                                                     <input class="form-control" id="admission_date" name="admission_date" readonly="" value="<?php echo $profile_details['Admission_Date']; ?>" disabled="true">
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-lg-4 col-xs-12 col-md-12">
                                             <div class="form-group ">
                                                 <label>Current Academic Year </label><span class="mandatory"> *</span>
                                                 <select disabled="true" class="<?php if ($profile_details['Cur_Batch'] == 0) {
                                                                                    echo 'select2_registration';
                                                                                } ?> form-control" id="academic_year" name="academic_year" style="width: 100%">
                                                     <?php
                                                        if (isset($acdyr_data) && !empty($acdyr_data)) {
                                                            foreach ($acdyr_data as $acd) {

                                                                if (isset($profile_details['Cur_AcadYr']) && !empty($profile_details['Cur_AcadYr']) && $profile_details['Cur_AcadYr'] == $acd['Acd_ID']) {
                                                                    echo '<option selected value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                             <div class="form-group ">
                                                 <label>Current Stream</label><span class="mandatory"> *</span>
                                                 <select <?php if ($profile_details['Cur_Batch'] != 0) {
                                                                echo 'disabled=""';
                                                            } ?> class="<?php if ($profile_details['Cur_Batch'] == 0) {
                                                                            echo 'select2_registration';
                                                                        } ?> form-control" id="stream_id" name="stream_id">
                                                     <?php
                                                        if (isset($stream_data) && !empty($stream_data)) {
                                                            foreach ($stream_data as $stream) {
                                                                if (isset($stream['stream_id']) && !empty($stream['stream_id']) && $profile_details['Cur_Stream'] == $stream['stream_id']) {
                                                                    echo '<option selected value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                             <div class="form-group ">
                                                 <input type="hidden" id="selectedclass" name="selectedclass" <?php
                                                                                                                if (isset($class_data_for_registration) && !empty($class_data_for_registration)) {
                                                                                                                    foreach ($class_data_for_registration as $class_for_dive) {
                                                                                                                        if (isset($profile_details['Cur_Class']) && !empty($profile_details['Cur_Class']) && $profile_details['Cur_Class'] == $class_for_dive['Course_Det_ID']) {
                                                                                                                            echo "value='" . $class_for_dive['Course_Det_ID'] . "'";
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                                ?> />
                                                 <label> Current Class </label><span class="mandatory"> *</span>
                                                 <select <?php if ($profile_details['Cur_Batch'] != 0) {
                                                                echo 'disabled=""';
                                                            } ?> class="<?php if ($profile_details['Cur_Batch'] == 0) {
                                                                            echo 'select2_registration';
                                                                        } ?> form-control" id="class_details" name="class_details">
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                             <label>Birth Country </label><span class="mandatory"> *</span>
                                             <!--<input  placeholder="Enter Birth Country" value="<?php echo $profile_details['Birth_Country']; ?>" type="text" class="form-control  " id="birth_country" maxlength="30" name="birth_country" />-->
                                             <select name="birth_country" id="birth_country" required="" class="form-control select2_registration" style="width:100%;">
                                                 <option selected value="-1">Select</option>
                                                 <?php
                                                    if (isset($country_data) && !empty($country_data)) {
                                                        foreach ($country_data as $country) {
                                                            if (isset($country['country_name']) && !empty($country['country_name']) && $profile_details['Birth_Country'] == $country['country_name']) {
                                                                echo '<option selected value ="' . $country['country_name'] . '" >' . $country['country_name'] . '</option>';
                                                            } else {
                                                                echo '<option value ="' . $country['country_name'] . '" >' . $country['country_name'] . '</option>';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                             </select>
                                         </div>
                                         <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                             <label>Birth Place </label><span class="mandatory"> *</span>
                                             <input placeholder="Enter Birth Place" type="text" value="<?php echo $profile_details['Birth_place']; ?>" class="form-control " id="birth_place" maxlength="30" name="birth_place" />
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                             <label>Identification Mark 1</label><span class="mandatory"> *</span>
                                             <input placeholder="Enter Identification Mark 1" maxlength="200" value="<?php echo $profile_details['IDMark1']; ?>" type="text" class="form-control" id="id_mark1" name="id_mark_1" />
                                         </div>
                                         <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                             <label>Identification Mark 2 </label><span class="mandatory"> *</span>
                                             <input placeholder="Enter Identification Mark 2" maxlength="200" value="<?php echo $profile_details['IDMark2']; ?>" type="text" class="form-control  " id="id_mark_2" name="id_mark_2" />
                                         </div>
                                     </div>

                                 </form>
                             </fieldset>

                             <h1>PARENT</h1>
                             <fieldset>
                                 <div class="row" id="search_student">
                                 </div>

                                 <form action="#" id="parent_details">
                                     <?php
                                        if ((isset($profile_details['father_id']) && !empty($profile_details['father_id'])) || (isset($profile_details['mother_id']) && !empty($profile_details['mother_id'])) || (isset($profile_details['guardian_id']) && !empty($profile_details['guardian_id']))) {
                                        ?> <input type="hidden" id="is_parent_update" name="is_parent_update" value="1" />
                                     <?php } else { ?>
                                         <input type="hidden" id="is_parent_update" name="is_parent_update" value="0" />
                                     <?php } ?>
                                     <input type="hidden" id="father_id" name="father_id" value="<?php echo (isset($profile_details['father_id']) && !empty($profile_details['father_id'])) ? $profile_details['father_id'] : '0'; ?>" />
                                     <input type="hidden" id="mother_id" name="mother_id" value="<?php echo (isset($profile_details['mother_id']) && !empty($profile_details['mother_id'])) ? $profile_details['mother_id'] : '0'; ?>" />
                                     <input type="hidden" id="guardian_id" name="guardian_id" value="<?php echo (isset($profile_details['guardian_id']) && !empty($profile_details['guardian_id'])) ? $profile_details['guardian_id'] : '0'; ?>" />
                                     <div class="panel-body">
                                         <div class="panel-group" id="accordion">
                                             <div class="panel panel-primary">
                                                 <div class="panel-heading">
                                                     <h5 class="panel-title">
                                                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-unsorted"><label>&nbsp;&nbsp; FATHER DETAILS</label></i></a>
                                                     </h5>
                                                     <input type="hidden" id="sibling_student_data_id" name="sibling_student_data_id" value="0" />
                                                 </div>
                                                 <div id="collapseOne" class="panel-collapse collapse in">
                                                     <div class="panel-body">
                                                         <div class="row">
                                                             <div class="form-group col-lg-5 col-xs-12 col-md-12">
                                                                 <label>Father Name </label><span class="mandatory"> *</span>
                                                                 <input id="fname" name="fname" placeholder="Enter Father Name" value="<?php echo $profile_details['Father']; ?>" type="text" class="form-control text-uppercase">
                                                             </div>
                                                             <div class="col-lg-5 col-xs-12 col-md-12">
                                                                 <div class="form-group <?php
                                                                                        if (form_error('fprofession')) {
                                                                                            echo 'has-error';
                                                                                        }
                                                                                        ?>">
                                                                     <label>Profession</label><span class="mandatory"> *</span><br />

                                                                     <select name="fprofession" id="fprofession" class="form-control select2_registration " style="width:100%;">

                                                                         <option selected value="-1">Select</option>
                                                                         <?php
                                                                            if (isset($profession_data) && !empty($profession_data)) {
                                                                                foreach ($profession_data as $profession) {
                                                                                    if (isset($profile_details['F_profession_id']) && !empty($profile_details['F_profession_id']) && $profile_details['F_profession_id'] == $profession['profession_id']) {
                                                                                        echo '<option value ="' . $profession['profession_id'] . '" selected >' . $profession['profession_name'] . '</option>';
                                                                                    } else {
                                                                                        echo '<option value ="' . $profession['profession_id'] . '" >' . $profession['profession_name'] . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                     </select>
                                                                     <?php echo form_error('fprofession', '<div class="form-error">', '</div>'); ?>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-4 col-xs-12 col-md-12">
                                                                 <div class="form-group">
                                                                     <label class="control-label" for="f_unique_identity"><?php
                                                                                                                            if ($uuid_unit_limit == 12) {
                                                                                                                                echo 'Aadhar Number';
                                                                                                                            } else {
                                                                                                                                echo 'Emirates ID';
                                                                                                                            }
                                                                                                                            ?> </label><span class="mandatory"> *</span>
                                                                     <div class="input-group" style="display:flex !important;">
                                                                         <!--maxlength set by vinothkumar k @ 09-05-2019 12:00 -->
                                                                         <input type="text" id="f_unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="f_unique_identity" value="<?php echo $profile_details['f_adhar']; ?>" placeholder="Enter <?php
                                                                                                                                                                                                                                                                if ($uuid_unit_limit == 12) {
                                                                                                                                                                                                                                                                    echo 'Aadhar Number';
                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                    echo 'Emirates ID';
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                ?> " class="form-control" required="" onkeypress="return typeNumberOnly(event)" onkeyup="f_checkEmirateAvailable()">
                                                                     </div>
                                                                 </div>
                                                                 <div id="f_id_spot_check"></div>
                                                             </div>
                                                             <div class="form-group col-lg-2 col-xs-12 col-md-12 " style="margin-top:3%;">
                                                                 <a href="javascript:void(0);" onclick="new_search();"> <i class="fa fa-user btn btn-primary btn-sm">&nbsp;<strong>Parent Search</strong></i></label> </a>
                                                             </div>
                                                         </div>
                                                         <div class="panel-group" id="faccordion">
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#faccordion" href="#ddd"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Communication Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="ddd" class="panel-collapse collapse in">
                                                                     <div class="panel-body">
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label><span class="mandatory"> *</span>
                                                                                 <input id="fadd1" name="fadd1" maxlength="300" value="<?php echo $profile_details['F_C_address1']; ?>" placeholder="Enter   Address Line 1" type="text" class="form-control text-uppercase">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label><span class="mandatory"> *</span>
                                                                                 <input id="fadd2" name="fadd2" maxlength="300" value="<?php echo $profile_details['F_C_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="fadd3" name="fadd3" maxlength="300" value="<?php echo $profile_details['F_C_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label><span class="mandatory"> *</span>
                                                                                 <input id="fzip" name="fzip" value="<?php echo $profile_details['F_C_ZIP_CODE']; ?>" maxlength="7" placeholder="Enter Zip Code" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label><span class="mandatory"> *</span>
                                                                                 <input id="fphone" name="fphone" maxlength="12" value="<?php echo $profile_details['F_C_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label><span class="mandatory"> *</span>
                                                                                 <input id="fmobile" name="fmobile" maxlength="12" minlength="9" value="<?php echo $profile_details['F_C_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label><span class="mandatory"> *</span>
                                                                                 <input id="fmail" name="fmail" value="<?php echo $profile_details['Email']; ?>" placeholder="Enter  Email ID " type="text" class="form-control  ">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#faccordion" href="#fff"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Official Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="fff" class="panel-collapse collapse in">
                                                                     <div class="panel-body">
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label>
                                                                                 <input id="foadd1" name="foadd1" maxlength="300" value="<?php echo $profile_details['F_O_address1']; ?>" placeholder="Enter  Address Line 1" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label>
                                                                                 <input id="foadd2" name="foadd2" maxlength="300" value="<?php echo $profile_details['F_O_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="foadd3" name="foadd3" maxlength="300" value="<?php echo $profile_details['F_O_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label>
                                                                                 <input id="fozip" name="fozip" value="<?php echo $profile_details['F_O_ZIP_CODE']; ?>" placeholder="Enter Zip Code" maxlength="7" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label>
                                                                                 <input id="fophone" maxlength="12" name="fophone" value="<?php echo $profile_details['F_O_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label>
                                                                                 <input id="fomobile" name="fomobile" maxlength="12" minlength="9" value="<?php echo $profile_details['F_O_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label>
                                                                                 <input id="fomail" name="fomail" value="<?php echo $profile_details['OEmail']; ?>" placeholder="Enter  Email ID " type="text" class="form-control  ">
                                                                             </div>
                                                                         </div>

                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#faccordion" href="#ooo"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Permanent Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="ooo" class="panel-collapse collapse in">
                                                                     <div class="panel-body">
                                                                         <div class="checkbox checkbox-success">
                                                                             <input id="father_check" name="father_check" type="checkbox">
                                                                             <label for="father_check">
                                                                                 &nbsp;Same as communication address
                                                                             </label>
                                                                         </div>
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label><span class="mandatory"> *</span>
                                                                                 <input id="fcadd1" name="fcadd1" maxlength="300" value="<?php echo $profile_details['F_H_address1']; ?>" placeholder="Enter  Address Line 1" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label><span class="mandatory"> *</span>
                                                                                 <input id="fcadd2" name="fcadd2" maxlength="300" value="<?php echo $profile_details['F_H_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="fcadd3" name="fcadd3" maxlength="300" value="<?php echo $profile_details['F_H_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label><span class="mandatory"> *</span>
                                                                                 <input id="fczip" name="fczip" value="<?php echo $profile_details['F_H_ZIP_CODE']; ?>" placeholder="Enter Zip Code" maxlength="7" type="text" class="form-control " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label><span class="mandatory"> *</span>
                                                                                 <input id="fcphone" name="fcphone" maxlength="12" value="<?php echo $profile_details['F_H_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label><span class="mandatory"> *</span>
                                                                                 <input id="fcmobile" name="fcmobile" maxlength="12" minlength="9" value="<?php echo $profile_details['F_H_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label><span class="mandatory"> *</span>
                                                                                 <input id="fcmail" name="fcmail" value="<?php echo $profile_details['HEmail']; ?>" placeholder="Enter  Email ID " type="text" class="form-control ">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="panel panel-success">
                                                 <div class="panel-heading">
                                                     <h4 class="panel-title">
                                                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;MOTHER DETAILS</label></i></a>
                                                     </h4>
                                                 </div>
                                                 <div id="collapseTwo" class="panel-collapse collapse in">
                                                     <div class="panel-body">
                                                         <div class="row">
                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                 <label> Mother Name </label><span class="mandatory"> *</span>
                                                                 <input id="mname" name="mname" value="<?php echo $profile_details['Mother']; ?>" placeholder="Enter Mother Name" type="text" class="form-control text-uppercase">
                                                             </div>
                                                             <div class="col-lg-6 col-xs-12 col-md-12">
                                                                 <div class="form-group <?php
                                                                                        if (form_error('mprofession')) {
                                                                                            echo 'has-error';
                                                                                        }
                                                                                        ?>">
                                                                     <label>Profession</label><span class="mandatory"> *</span><br />

                                                                     <select name="mprofession" id="mprofession" class="form-control select2_registration " style="width:100%;">

                                                                         <option selected value="-1">Select</option>
                                                                         <?php
                                                                            if (isset($mprofession_data) && !empty($mprofession_data)) {
                                                                                foreach ($mprofession_data as $mprofession) {
                                                                                    if (isset($profile_details['M_profession_id']) && !empty($profile_details['M_profession_id']) && $profile_details['M_profession_id'] == $mprofession['profession_id']) {
                                                                                        echo '<option value ="' . $mprofession['profession_id'] . '" selected >' . $mprofession['profession_name'] . '</option>';
                                                                                    } else {
                                                                                        echo '<option value ="' . $mprofession['profession_id'] . '" >' . $mprofession['profession_name'] . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                     </select>
                                                                     <?php echo form_error('mprofession', '<div class="form-error">', '</div>'); ?>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-4 col-xs-12 col-md-12">
                                                                 <div class="form-group">
                                                                     <label class="control-label" for="m_unique_identity"><?php
                                                                                                                            if ($uuid_unit_limit == 12) {
                                                                                                                                echo 'Aadhar Number';
                                                                                                                            } else {
                                                                                                                                echo 'Emirates ID';
                                                                                                                            }
                                                                                                                            ?> </label><span class="mandatory"> *</span>
                                                                     <div class="input-group" style="display:flex !important;">
                                                                         <!--maxlength set by vinothkumar k @ 09-05-2019 12:00 -->
                                                                         <input type="text" id="m_unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="m_unique_identity" value="<?php echo $profile_details['m_adhar']; ?>" placeholder="Enter <?php
                                                                                                                                                                                                                                                                if ($uuid_unit_limit == 12) {
                                                                                                                                                                                                                                                                    echo 'Aadhar Number';
                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                    echo 'Emirates ID';
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                ?> " class="form-control" required="" onkeypress="return typeNumberOnly(event)" onkeyup="m_checkEmirateAvailable()"> </div>
                                                                 </div>
                                                                 <div id="m_id_spot_check"></div>
                                                             </div>
                                                         </div>
                                                         <div class="panel-group" id="maccordion">
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#maccordion" href="#qqq"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Communication Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="qqq" class="panel-collapse collapse in">
                                                                     <div class="panel-body">
                                                                         <div class="checkbox checkbox-success">
                                                                             <input id="mthr_com_check" name="mthr_com_check" type="checkbox">
                                                                             <label for="mthr_com_check">
                                                                                 &nbsp;Same as Father's address
                                                                             </label>
                                                                         </div>
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label><span class="mandatory"> *</span>
                                                                                 <input id="madd1" name="madd1" maxlength="300" value="<?php echo $profile_details['M_C_address1']; ?>" placeholder="Enter  Address Line 1" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label><span class="mandatory"> *</span>
                                                                                 <input id="madd2" name="madd2" maxlength="300" value="<?php echo $profile_details['M_C_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="madd3" name="madd3" maxlength="300" value="<?php echo $profile_details['M_C_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label><span class="mandatory"> *</span>
                                                                                 <input id="mzip" name="mzip" value="<?php echo $profile_details['M_C_ZIP_CODE']; ?>" placeholder="Enter Zip Code" maxlength="7" type="text" class="form-control " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label><span class="mandatory"> *</span>
                                                                                 <input id="mphone" name="mphone" maxlength="12" value="<?php echo $profile_details['M_C_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label><span class="mandatory"> *</span>
                                                                                 <input id="mmobile" name="mmobile" maxlength="12" minlength="9" value="<?php echo $profile_details['M_C_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label><span class="mandatory"> *</span>
                                                                                 <input id="mmail" name="mmail" value="<?php echo $profile_details['M_C_Email']; ?>" placeholder="Enter  Email ID " type="text" class="form-control ">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#maccordion" href="#www"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Official Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="www" class="panel-collapse collapse in">
                                                                     <div class="panel-body">
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label>
                                                                                 <input id="moadd1" name="moadd1" maxlength="300" value="<?php echo $profile_details['M_O_address1']; ?>" placeholder="Enter  Address Line 1" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label>
                                                                                 <input id="moadd2" name="moadd2" maxlength="300" value="<?php echo $profile_details['M_O_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="moadd3" name="moadd3" maxlength="300" value="<?php echo $profile_details['M_O_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label>
                                                                                 <input id="mozip" name="mozip" value="<?php echo $profile_details['M_O_ZIP_CODE']; ?>" placeholder="Enter Zip Code" maxlength="7" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label>
                                                                                 <input id="mophone" name="mophone" maxlength="12" value="<?php echo $profile_details['M_O_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label>
                                                                                 <input id="momobile" name="momobile" maxlength="12" minlength="9" value="<?php echo $profile_details['M_O_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label>
                                                                                 <input id="momail" name="momail" value="<?php echo $profile_details['M_O_Email']; ?>" placeholder="Enter  Email ID " type="text" class="form-control  ">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#maccordion" href="#eee"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Permanent Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="eee" class="panel-collapse collapse in">
                                                                     <div class="panel-body">
                                                                         <div class="checkbox checkbox-success">
                                                                             <input id="mother_check" name="mother_check" type="checkbox">
                                                                             <label for="mother_check">
                                                                                 &nbsp;Same as communication address
                                                                             </label>
                                                                         </div>
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label><span class="mandatory"> *</span>
                                                                                 <input id="mcadd1" name="mcadd1" maxlength="300" value="<?php echo $profile_details['M_H_address1']; ?>" placeholder="Enter  Address Line 1" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label><span class="mandatory"> *</span>
                                                                                 <input id="mcadd2" name="mcadd2" maxlength="300" value="<?php echo $profile_details['M_H_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="mcadd3" name="mcadd3" maxlength="300" value="<?php echo $profile_details['M_H_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label><span class="mandatory"> *</span>
                                                                                 <input id="mczip" name="mczip" value="<?php echo $profile_details['M_H_ZIP_CODE']; ?>" placeholder="Enter Zip Code" maxlength="7" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label><span class="mandatory"> *</span>
                                                                                 <input id="mcphone" name="mcphone" maxlength="12" value="<?php echo $profile_details['M_H_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label><span class="mandatory"> *</span>
                                                                                 <input id="mcmobile" name="mcmobile" maxlength="12" minlength="9" value="<?php echo $profile_details['M_H_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control" onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label><span class="mandatory"> *</span>
                                                                                 <input id="mcmail" name="mcmail" value="<?php echo $profile_details['M_H_Email']; ?>" placeholder="Enter  Email ID " type="text" class="form-control  ">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="panel panel-warning">
                                                 <div class="panel-heading">
                                                     <h4 class="panel-title">
                                                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;GUARDIAN DETAILS</label></i></a>
                                                     </h4>
                                                 </div>
                                                 <div id="collapseThree" class="panel-collapse collapse in">
                                                     <div class="panel-body">
                                                         <div class="row">
                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                 <label> Name </label>
                                                                 <input id="gname" name="gname" value="<?php echo $profile_details['Guardian']; ?>" placeholder="Enter  Name" type="text" class="form-control  ">
                                                             </div>
                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                 <label>Profession </label><br>
                                                                 <select name="gprofession" id="gprofession" class="form-control select2_registration " style="width:100%;">

                                                                     <option selected value="-1">Select</option>
                                                                     <?php
                                                                        if (isset($gprofession_data) && !empty($gprofession_data)) {
                                                                            foreach ($gprofession_data as $gprofession) {
                                                                                if (isset($profile_details['G_profession_id']) && !empty($profile_details['G_profession_id']) && $profile_details['G_profession_id'] == $gprofession['profession_id']) {
                                                                                    echo '<option value ="' . $gprofession['profession_id'] . '" selected >' . $gprofession['profession_name'] . '</option>';
                                                                                } else {
                                                                                    echo '<option value ="' . $gprofession['profession_id'] . '" >' . $gprofession['profession_name'] . '</option>';
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                 </select>
                                                             </div>
                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                 <label>Gender </label><br>
                                                                 <select class="select2_demo_3 form-control" name="ggender" id="ggender">
                                                                     <?php
                                                                        if (isset($profile_details) && !empty($profile_details)) {
                                                                            if ($profile_details['Gender'] == 'F') {
                                                                                echo '<option selected="" value ="F" >Female</option>';
                                                                                echo '<option  value ="M" >Male</option>';
                                                                            } else if ($profile_details['Gender'] == 'M') {
                                                                                echo '<option selected="" value ="M" >Male</option>';
                                                                                echo '<option  value ="F" >Female</option>';
                                                                            } else {
                                                                                echo '<option selected="" value="-1">Select</option>';
                                                                                echo '<option  value ="M" >Male</option>';
                                                                                echo '<option  value ="F" >Female</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                 </select>
                                                             </div>
                                                             <div class="col-lg-6 col-xs-12 col-md-12">
                                                                 <div class="form-group">
                                                                     <label class="control-label" for="g_unique_identity"><?php
                                                                                                                            if ($uuid_unit_limit == 12) {
                                                                                                                                echo 'Aadhar Number';
                                                                                                                            } else {
                                                                                                                                echo 'Emirates ID';
                                                                                                                            }
                                                                                                                            ?> </label><span class="mandatory"> *</span>
                                                                     <div class="input-group" style="display:flex !important;">
                                                                         <!--maxlength set by vinothkumar k @ 09-05-2019 12:00 -->
                                                                         <input type="text" id="g_unique_identity" maxlength="<?php echo $uuid_unit_limit; ?>" name="g_unique_identity" value="<?php echo $profile_details['g_adhar']; ?>" placeholder="Enter <?php
                                                                                                                                                                                                                                                                if ($uuid_unit_limit == 12) {
                                                                                                                                                                                                                                                                    echo 'Aadhar Number';
                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                    echo 'Emirates ID';
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                ?> " class="form-control" onkeypress="return typeNumberOnly(event)" onkeyup="g_checkEmirateAvailable()">
                                                                     </div>
                                                                 </div>
                                                                 <div id="g_id_spot_check"></div>
                                                             </div>
                                                         </div>
                                                         <div class="panel-group" id="gaccordion">
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#gaccordion" href="#ttt"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Communication Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="ttt" class="panel-collapse collapse in">
                                                                     <div class="panel-body">
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label>
                                                                                 <input id="gadd1" name="gadd1" maxlength="300" value="<?php echo $profile_details['G_C_address1']; ?>" placeholder="Enter  Address Line 1" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label>
                                                                                 <input id="gadd2" name="gadd2" maxlength="300" value="<?php echo $profile_details['G_C_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="gadd3" name="gadd3" maxlength="300" value="<?php echo $profile_details['G_C_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label>
                                                                                 <input id="gzip" name="gzip" value="<?php echo $profile_details['G_C_ZIP_CODE']; ?>" placeholder="Enter Zip Code" maxlength="7" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label>
                                                                                 <input id="gphone" name="gphone" maxlength="12" value="<?php echo $profile_details['G_C_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label>
                                                                                 <input id="gmobile" name="gmobile" maxlength="12" minlength="9" value="<?php echo $profile_details['G_C_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label>
                                                                                 <input id="gmail" name="gmail" value="<?php echo $profile_details['G_C_Email']; ?>" placeholder="Enter  Email ID " type="text" class="form-control  ">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#gaccordion" href="#mmm"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Official Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="mmm" class="panel-collapse collapse in">
                                                                     <div class="panel-body">
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label>
                                                                                 <input id="goadd1" name="goadd1" maxlength="300" value="<?php echo $profile_details['G_O_address1']; ?>" placeholder="Enter  Address Line 1" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label>
                                                                                 <input id="goadd2" name="goadd2" maxlength="300" value="<?php echo $profile_details['G_O_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="goadd3" name="goadd3" maxlength="300" value="<?php echo $profile_details['G_O_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label>
                                                                                 <input id="gozip" name="gozip" value="<?php echo $profile_details['G_O_ZIP_CODE']; ?>" maxlength="7" placeholder="Enter Zip Code" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label>
                                                                                 <input id="gophone" name="gophone" maxlength="12" value="<?php echo $profile_details['G_O_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label>
                                                                                 <input id="gomobile" name="gomobile" maxlength="12" minlength="9" value="<?php echo $profile_details['G_O_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label>
                                                                                 <input id="gomail" name="gomail" value="<?php echo $profile_details['G_O_Email']; ?>" placeholder="Enter  Email ID " type="text" class="form-control  ">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="panel panel-default">
                                                                 <div class="panel-heading">
                                                                     <h5 class="panel-title">
                                                                         <a data-toggle="collapse" data-parent="#gaccordion" href="#111"><i class="fa fa-unsorted"><label>&nbsp;&nbsp;Permanent Address</label></i></a>
                                                                     </h5>
                                                                 </div>
                                                                 <div id="111" class="panel-collapse collapse in">
                                                                     <div class="panel-body">

                                                                         <div class="checkbox checkbox-success">
                                                                             <input id="guardian_check" name="guardian_check" type="checkbox">
                                                                             <label for="guardian_check">
                                                                                 &nbsp;Same as communication address </label>
                                                                         </div>
                                                                         <div class="row">
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 1 </label>
                                                                                 <input id="gcadd1" name="gcadd1" maxlength="300" value="<?php echo $profile_details['G_H_address1']; ?>" placeholder="Enter  Address Line 1" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Address Line 2 </label>
                                                                                 <input id="gcadd2" name="gcadd2" maxlength="300" value="<?php echo $profile_details['G_H_address2']; ?>" placeholder="Enter  Address Line 2" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label> Address Line 3 </label>
                                                                                 <input id="gcadd3" name="gcadd3" maxlength="300" value="<?php echo $profile_details['G_H_address3']; ?>" placeholder="Enter  Address Line 3" type="text" class="form-control  ">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Zip Code </label>
                                                                                 <input id="gczip" name="gczip" value="<?php echo $profile_details['G_H_ZIP_CODE']; ?>" maxlength="7" placeholder="Enter Zip Code" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Phone Number </label>
                                                                                 <input id="gcphone" name="gcphone" maxlength="12" value="<?php echo $profile_details['G_H_Phone1']; ?>" placeholder="Enter Phone Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Mobile Number </label>
                                                                                 <input id="gcmobile" name="gcmobile" maxlength="12" minlength="9" value="<?php echo $profile_details['G_H_Phone3']; ?>" placeholder="Enter  Mobile Number" type="text" class="form-control  " onkeypress="return typeNumberOnly(event)">
                                                                             </div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="clearfix"></div>
                                                                             <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                                                                 <label>Email ID </label>
                                                                                 <input id="gcmail" name="gcmail" value="<?php echo $profile_details['G_H_Email']; ?>" placeholder="Enter  Email ID " type="text" class="form-control  ">
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="panel panel-default">
                                                 <div class="panel-heading">
                                                     <h4 class="panel-title">
                                                         <i class="fa fa-unsorted"><label>&nbsp;&nbsp;AVAIL FOR STAFF CONCESSION</label></i>
                                                     </h4>
                                                 </div>
                                                 <div class="panel-body">
                                                     <div class="row">
                                                         <input type="hidden" name="empid" id="empid" value="<?php echo $profile_details['emp_id'] ?>">
                                                         <!-- <input id="fname" name="fname" placeholder="Enter Father Name" type="text" class="form-control">
                                                 <input id="mname" name="mname" placeholder="Enter Mother Name" type="text" class="form-control"> -->
                                                         <div class="form-group col-lg-3 col-xs-12 col-md-12">
                                                             <label>Who Worked in this institution? </label><br>
                                                             <?php //dev_export($profile_details);
                                                                ?>
                                                             <select class="select2_demo_3 form-control" name="who_worked" id="who_worked">
                                                                 <option value="-1" <?php if (!isset($profile_details['who_worked']) or $profile_details['who_worked'] == -1) echo 'selected=selected'; ?>>None</option>
                                                                 <option value="1" <?php if ($profile_details['who_worked'] == 1) echo 'selected=selected'; ?>>Father</option>
                                                                 <option value="2" <?php if ($profile_details['who_worked'] == 2) echo 'selected=selected'; ?>>Mother</option>
                                                             </select>
                                                         </div>
                                                         <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                                             <label>Institution </label><br>
                                                             <?php //dev_export($institution_list_data); 
                                                                ?>
                                                             <select name="emp_inst_id" id="emp_inst_id" class="form-control select2_registration" onchange="getEmployees(this)" style="width:100%;">

                                                                 <option selected value="-1">Select</option>
                                                                 <?php
                                                                    if (isset($institution_list_data) && !empty($institution_list_data)) {
                                                                        foreach ($institution_list_data as $inst_data) {
                                                                            if ($inst_data['inst_id'] == $profile_details['emp_inst_id']) $inst_sel = 'selected=selected';
                                                                            else $inst_sel = '';

                                                                            echo '<option value ="' . $inst_data['inst_id'] . '" ' . $inst_sel . ' >' . $inst_data['inst_name'] . ' - ' . $inst_data['inst_place'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                             </select>
                                                         </div>
                                                         <div class="form-group col-lg-5 col-xs-12 col-md-12">
                                                             <label>Select Employee </label><br>
                                                             <select class="select2_demo_3 form-control" name="emp_id" id="emp_id">

                                                             </select>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </form>
                             </fieldset>

                             <h1>OTHER DETAILS</h1>
                             <fieldset>
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="panel panel-info">
                                             <div class="panel-heading">
                                                 <i class="fa fa-info-circle"></i> Passport Details
                                             </div>
                                             <div class="panel-body">
                                                 <form action="#" id="other_details-passport">
                                                     <div class="row">
                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <label>Passport Number </label>
                                                                 <input id="passno" value="<?php echo $profile_details['PassportNo']; ?>" placeholder="Enter Passport Number" name="passno" type="text" class="form-control ">
                                                             </div>
                                                         </div>

                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <label>Place of Issue </label>
                                                                 <input id="pissue_place" maxlength="25" value="<?php echo $profile_details['Pass_issue_location']; ?>" name="pissue_place" type="text" placeholder="Enter Place of Issue" class="form-control ">
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="clearfix"></div>
                                                     <div class="row">
                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group" id="data_1">
                                                                 <label class="font-noraml"> Date of Issue</label>
                                                                 <div class="input-group date">
                                                                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?php echo isset($profile_details['pass_issue_dt']) && !empty($profile_details['pass_issue_dt']) ? date('d-m-Y', strtotime($profile_details['pass_issue_dt'])) : ''; ?>" placeholder=" Passport Issue Date" id="pass_issue_date" name="pass_issue_date" class="form-control" readonly="" style="background-color:#fff">
                                                                 </div>
                                                             </div>
                                                         </div>

                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group" id="pdata_2">
                                                                 <label class="font-noraml"> Date Of Expiry </label>
                                                                 <div class="input-group date">
                                                                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?php echo isset($profile_details['pass_expiry_dt']) && !empty($profile_details['pass_expiry_dt']) ? date('d-m-Y', strtotime($profile_details['pass_expiry_dt'])) : ''; ?>" placeholder="  Passport Expiry Date" id="pass_expiry_date" name="pass_expiry_date" class="form-control" readonly="" style="background-color:#fff">
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="clearfix"></div>
                                                     <div class="row">
                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <label>Description </label>
                                                                 <input id="pdesc" maxlength="50" name="pdesc" value="<?php echo $profile_details['pass_desc']; ?>" type="text" placeholder="Enter Description" class="form-control ">
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="clearfix"></div>
                                                 </form>
                                             </div>

                                         </div>
                                     </div>
                                     <div class="col-lg-12">
                                         <div class="panel panel-info">
                                             <div class="panel-heading">
                                                 <i class="fa fa-info-circle"></i> Visa Details
                                             </div>
                                             <div class="panel-body">
                                                 <form action="#" id="other_details-visa">
                                                     <div class="row">
                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <label>Visa Number </label>
                                                                 <input id="visano" value="<?php echo $profile_details['VisaNo']; ?>" placeholder="Enter Visa Number" name="visano" type="text" class="form-control ">
                                                             </div>
                                                         </div>

                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <label>Place of Issue </label>
                                                                 <input id="vissue_place" maxlength="25" value="<?php echo $profile_details['Visa_issue_location']; ?>" name="vissue_place" type="text" placeholder=" Place of Issue" class="form-control ">
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="clearfix"></div>
                                                     <div class="row">
                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group" id="data_1">
                                                                 <label class="font-noraml"> Date Of Issue</label>
                                                                 <div class="input-group date">
                                                                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?php echo isset($profile_details['visa_issue_dt']) && !empty($profile_details['visa_issue_dt']) ? date('d-m-Y', strtotime($profile_details['visa_issue_dt'])) : '';  ?>" id="visa_issue_date" name="visa_issue_date" placeholder=" Visa Issue Date" class="form-control" readonly="" style="background-color:#fff">
                                                                 </div>
                                                             </div>
                                                         </div>

                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group" id="vdata_2">
                                                                 <label class="font-noraml"> Date of Expiry </label>
                                                                 <div class="input-group date">
                                                                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?php echo (isset($profile_details['Visa_Expiry_Dt']) && !empty($profile_details['Visa_Expiry_Dt'])) ? date('d-m-Y', strtotime($profile_details['Visa_Expiry_Dt'])) : ''; ?>" id="visa_expiry_date" name="visa_expiry_date" placeholder="Visa Expiry Date" class="form-control" readonly="" style="background-color:#fff">
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="clearfix"></div>
                                                     <div class="row">
                                                         <div class="col-lg-6 col-xs-12 col-md-12">
                                                             <div class="form-group">
                                                                 <label>Description </label>
                                                                 <input id="vdesc" maxlength="50" value="<?php echo $profile_details['visa_description']; ?>" name="vdesc" type="text" placeholder="Enter Description" class="form-control ">
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="clearfix"></div>
                                                 </form>
                                             </div>

                                         </div>
                                     </div>
                                 </div>
                             </fieldset>

                             <h1>FACILITIES</h1>
                             <fieldset>


                                 <div class="row ">
                                     <div class="col-lg-5">
                                         <div class="ibox-content">


                                             <ul class="todo-list ">

                                                 <li style="list-style-type:none">
                                                     <?php if (($profile_details['istransport']) == 1) { ?>
                                                         <input checked="" type="checkbox" value="" name="trans_port" id="trans_port" class="i-checks" />
                                                     <?php } else { ?>
                                                         <input type="checkbox" value="" name="trans_port" id="trans_port" class="i-checks" />
                                                     <?php } ?>
                                                     <span class="m-l-xs">Whether using School Transport ?</span>
                                                     <small class="pull-right m-r-md label label-success" style="margin-top: 4px;"><i class="fa fa-bus"></i></small>
                                                 </li>
                                                 <br>
                                                 <li style="list-style-type:none">
                                                     <?php if (($profile_details['ismess']) == 1) { ?>
                                                         <input checked="" type="checkbox" value="" name="mess" id="mess" class="i-checks" />
                                                     <?php } else { ?>
                                                         <input type="checkbox" value="" name="mess" id="mess" class="i-checks" />
                                                     <?php } ?>
                                                     <span class="m-l-xs">Whether using School Mess ?</span>
                                                     <small class="pull-right m-r-md label label-info" style="margin-top: 4px;"><i class="fa fa-cutlery"></i></small>
                                                 </li>
                                                 <br>
                                             </ul>
                                             <ul class="todo-list ">
                                                 <li style="list-style-type:none">
                                                     <?php if (($profile_details['ishostel']) == 1) { ?>
                                                         <input checked="" type="checkbox" value="" name="hostel" id="hostel" class="i-checks" />
                                                     <?php } else { ?>
                                                         <input type="checkbox" value="" name="hostel" id="hostel" class="i-checks" />
                                                     <?php } ?>
                                                     <span class="m-l-xs">Whether using School Hostel ?</span>
                                                     <small class="pull-right m-r-md label label-warning" style="margin-top: 4px;"><i class="fa fa-bed"></i></small>
                                                 </li>
                                                 <br>
                                                 <li style="list-style-type:none">
                                                     <?php if (($profile_details['isonline_service']) == 1) { ?>
                                                         <input checked="" type="checkbox" value="" name="o_service" id="o_service" class="i-checks" />
                                                     <?php } else { ?>
                                                         <input type="checkbox" value="" name="o_service" id="o_service" class="i-checks" />
                                                     <?php } ?>
                                                     <span class="m-l-xs">Whether using Online Services ?</span>
                                                     <small class="pull-right m-r-md label label-danger" style="margin-top: 4px;"><i class="fa fa-internet-explorer"></i> </small>
                                                 </li>
                                                 <br>
                                             </ul>
                                         </div>
                                     </div>
                                 </div>
                             </fieldset>


                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </div>
 <input type="hidden" name="admission_number_new" id="admission_number_new" value="" />
 <input type="hidden" name="uuid_unit_limit" id="uuid_unit_limit" value="<?php echo $uuid_unit_limit; ?>" />
 <input type="hidden" name="uuid_unit_limit_name" id="uuid_unit_limit_name" value="<?php echo $uuid_unit_limit == 12 ? 'Aadhar Number' : 'Emirates ID'; ?>" />
 <script>
     $('#emp_inst_id').trigger("change");

     function getEmployees(ele) {
         //alert($(ele).val());
         var empid = $('#empid').val();
         var inst_id = $(ele).val();
         var who_worked = $('#who_worked').val();
         var fname = $('#fname').val();
         var mname = $('#mname').val();
         var ops_url = baseurl + 'registration/get_employee_list_from_wfm/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "inst_id": inst_id,
                 "fname": fname,
                 "mname": mname
             },
             success: function(result) {
                 $('#emp_id').empty().trigger("change");
                 var data = JSON.parse(result);
                 var sel = '';
                 if (data.status == 1) {
                     var state_data = data.data;
                     $.each(state_data, function(i, v) {
                         if (empid == v.Emp_id) {
                             sel = 'selected=selected;'
                         } else {
                             sel = '';
                         }
                         $('#emp_id').append("<option value='" + v.Emp_id + "' " + sel + " >" + v.Emp_code + " - " + v.First_name + " " + v.Middle_name + " " + v.Last_name + "</option>");
                     });
                     $('#emp_id').trigger('change');
                 } else {
                     $('#emp_id').empty().trigger("change");
                     $('#emp_id').append("<option value='-1' selected >Select EMPLOYEE</option>");
                     $('#emp_id').trigger('change');
                 }
             }
         });
     }
     //Address fill functionality Ends here
     //Code written by Elavarasan S @ May,9 2019 2:42
     $.validator.addMethod("synchronousRemote", function(value, element, param) {
         if (this.optional(element)) {
             return "dependency-mismatch";
         }

         var previous = this.previousValue(element);
         if (!this.settings.messages[element.name]) {
             this.settings.messages[element.name] = {};
         }
         previous.originalMessage = this.settings.messages[element.name].remote;
         this.settings.messages[element.name].remote = previous.message;

         param = typeof param === "string" && {
             url: param
         } || param;

         if (previous.old === value) {
             return previous.valid;
         }

         previous.old = value;
         var validator = this;
         this.startRequest(element);
         var data = {};
         data['dropdown'] = value;
         data['name'] = element.name;
         var valid = "pending";
         $.ajax($.extend(true, {
             url: param,
             async: false,
             mode: "abort",
             port: "validate" + element.name,
             dataType: "json",
             data: data,
             success: function(response) {
                 validator.settings.messages[element.name].remote = previous.originalMessage;
                 valid = response === true || response === "true";
                 if (valid) {
                     var submitted = validator.formSubmitted;
                     validator.prepareElement(element);
                     validator.formSubmitted = submitted;
                     validator.successList.push(element);
                     delete validator.invalid[element.name];
                     validator.showErrors();
                 } else {
                     var errors = {};
                     var message = response || validator.defaultMessage(element, "remote");
                     errors[element.name] = previous.message = $.isFunction(message) ? message(value) : message;
                     validator.invalid[element.name] = true;
                     validator.showErrors(errors);
                 }
                 previous.valid = valid;
                 validator.stopRequest(element, valid);
             }
         }, param));
         return valid;
     }, "Select any field.");
     // Function written by Elavarasan S @ 10-05-2019 09:03
     function typeNumberOnly(eve) {
         var e = (eve.which) ? eve.which : eve.keyCode;
         if (e != 8 && e != 0 && (e < 48 || e > 57)) {
             return false;
         }
     }

     function changed_country() {
         var nationality = $("#country_select :selected").data('nationality');
         var country_id = $('#country_select').val();
         $('#nationality').val(nationality);
         $('#state_select').empty().trigger("change");
         var ops_url = baseurl + 'registration/get-state-details/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "country_id": country_id
             },
             success: function(result) {
                 $('#state_select').empty().trigger("change");
                 //                $('#district_select').empty().trigger("change");
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var state_data = data.data;
                     $('#state_select').append("<option value='-1' selected >Select</option>");
                     $.each(state_data, function(i, v) {
                         $('#state_select').append("<option value='" + v.state_id + "' >" + v.state_name + "</option>");
                     });
                     $('#state_select').trigger('change');
                 } else {
                     $('#state_select').empty().trigger("change");
                     $('#state_select').append("<option value='-1' selected >Select</option>");
                     $('#state_select').trigger('change');
                 }
             }
         });
     }

     function changed_state() {
         var state_id = $('#state_select').val();
         $('#district_select').empty().trigger("change");
         var ops_url = baseurl + 'registration/get-city-details/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "state_id": state_id
             },
             success: function(result) {
                 $('#district_select').empty().trigger("change");
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var city_data = data.data;
                     $('#district_select').empty().trigger("change");
                     $('#district_select').append("<option value='-1' selected >Select</option>");
                     $.each(city_data, function(i, v) {
                         $('#district_select').append("<option value='" + v.city_id + "' >" + v.city_name + "</option>");
                     });
                     $('#district_select').trigger('change');
                 } else {
                     $('#district_select').empty().trigger("change");
                     $('#district_select').append("<option value='-1' selected >Select</option>");
                     $('#district_select').trigger('change');
                 }
             }
         });
     }

     function changed_religion() {
         var religion_id = $('#religion_select').val();
         var ops_url = baseurl + 'registration/get-caste-details/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "religion_id": religion_id
             },
             success: function(result) {
                 $('#caste_select').empty().trigger("change");
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var caste_data = data.data;
                     $('#caste_select').empty().trigger("change");
                     $('#caste_select').append("<option value='-1' selected >Select</option>");
                     $.each(caste_data, function(i, v) {
                         $('#caste_select').append("<option value='" + v.caste_id + "' data-communityselect='" + v.community_id + "' >" + v.caste_name + "</option>");
                     });
                     $('#caste_select').trigger('change');
                 } else {
                     $('#caste_select').empty().trigger("change");
                     $('#caste_select').append("<option value='-1' selected >Select</option>");
                     $('#caste_select').trigger('change');
                 }
             }
         });
     }
     $("#wizard").steps({
         headerTag: "h1",
         bodyTag: "fieldset",
         transitionEffect: "slideLeft",
         onStepChanging: function(event, currentIndex, newIndex) {
             // Always allow going backward even if the current step contains invalid fields!
             if (currentIndex > newIndex) {
                 return true;
             }
             // Forbid suppressing "Warning" step if the user is to young
             //                if (newIndex === 3)
             //                {
             //                    return false;
             //                }
             // Clean up if user went backward before
             if (currentIndex < newIndex) {
                 // To remove error styles
                 $(".body:eq(" + newIndex + ") label.error", form).remove();
                 $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
             }
             // Disable validation on fields that are disabled or hidden.
             //                form.validate().settings.ignore = ":disabled,:hidden";

             $('.registration-content').slimScroll({
                 position: 'right',
                 height: '350px',
                 railVisible: true,
                 alwaysVisible: false
             });
             // Start validation; Prevent going forward if false
             //                if (form.valid()) {

             //                if (newIndex == 1) {
             //                    if (save_other_details() == 0) {
             //                        swal('', 'Registration failed.<br> please try again later.', 'info');
             //                        return false;
             //                    } else {
             //                        swal('', 'Registration - Personal details saved successfully.', 'info');
             //                        return true;
             //                    }
             //
             //                }



             if (newIndex == 1) {
                 var form = $('#personal_details');
                 var studentid = $('#studentid').val();
                 var personal_validate = $('#personal_details').validate({
                     rules: {
                         firstname: {
                             required: true,
                             minlength: 3,
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 50,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         middlename: {
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 50,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         lastname: {
                             required: true,
                             minlength: 1,
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 50,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         dob_date: {
                             required: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         unique_identity: {
                             required: true,
                             minlength: $('#uuid_unit_limit').val(),
                             maxlength: $('#uuid_unit_limit').val(),
                             number: true,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-adhar/',
                                 data: {
                                     unique_identity: function() {
                                         return $('#unique_identity').val();
                                     },
                                     "studentid": studentid
                                 }
                             }
                         },
                         gender: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#gender').val();
                                 //                                    }}
                             }
                         },
                         country_select: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#country_select').val();
                                 //                                    }}
                             }
                         },
                         state_select: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#state_select').val();
                                 //                                    }}
                             }
                         },
                         district_select: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#district_select').val();
                                 //                                    }}
                             }
                         },
                         mother_tongue: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#mother_tongue').val();
                                 //                                    }}
                             }
                         },
                         language_select: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#language_select').val();
                                 //                                    }}
                             }
                         },
                         religion_select: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#religion_select').val();
                                 //                                    }}
                             }
                         },
                         caste_select: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#caste_select').val();
                                 //                                    }}
                             }
                         },
                         community_select: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#community_select').val();
                                 //                                    }}
                             }
                         },
                     },
                     messages: {
                         firstname: {
                             required: "Please provide First Name",
                             minlength: "Enter atleast 3 character",
                             regex: "Enter valid characters.(Only alphabets and space)",
                             maxlength: "Enter characters less than 50 characters"
                         },
                         middlename: {
                             regex: "Enter valid characters.",
                             maxlength: "Enter characters less than 50 characters"
                         },
                         lastname: {
                             required: "Please provide Last Name",
                             minlength: "Enter atleast 1 character",
                             regex: "Enter valid characters.",
                             maxlength: "Enter characters less than 50 characters"
                         },
                         dob_date: {
                             required: "Select Date of Birth"
                         },
                         unique_identity: {
                             required: "Enter " + $('#uuid_unit_limit_name').val(),
                             minlength: "Enter " + $('#uuid_unit_limit').val() + " digit " + $('#uuid_unit_limit_name').val(),
                             maxlength: $('#uuid_unit_limit_name').val() + " should not exceed more than " + $('#uuid_unit_limit').val()
                         },
                         gender: {
                             required: 'Select a Gender',
                             synchronousRemote: 'Select a Gender'
                         },
                         country_select: {
                             required: 'Select a Country',
                             synchronousRemote: 'Select a Country'
                         },
                         state_select: {
                             required: 'Select a State',
                             synchronousRemote: 'Select a State'
                         },
                         district_select: {
                             required: 'Select a District',
                             synchronousRemote: 'Select a District'
                         },
                         mother_tongue: {
                             required: 'Select a Mother Tongue',
                             synchronousRemote: 'Select a Mother Tongue'
                         },
                         religion_select: {
                             required: 'Select a Religion',
                             synchronousRemote: 'Select a Religion'
                         },
                         language_select: {
                             required: 'Select Known Languages',
                             synchronousRemote: 'Select Known Languages'
                         },
                         caste_select: {
                             required: 'Select a Caste',
                             synchronousRemote: 'Select a Caste'
                         },
                         community_select: {
                             required: 'Select a Community',
                             synchronousRemote: 'Select a Community'
                         }
                     },
                     errorPlacement: function(error, element) {
                         $(element).parents('.form-group').append(error);
                     }
                 });
                 personal_validate.form();
                 if (personal_validate.valid()) {
                     var studentid = $('#studentid').val();
                     var invalid = 0;
                     $('#personal_details select,#personal_details input')
                         .not('#middlename,#profile_image_data,#browse,#studentid,.select2-search__field')
                         .each(function() {
                             //                                        console.log($(this));
                             if ($(this).val() == '-1' || $(this).val() == '') {
                                 $(this).focusout();
                                 invalid += 1;
                             }
                         });
                     if (invalid != 0) {
                         swal('', 'Enter all the mandatory fields.', 'info');
                         return false;
                     }
                     if (save_personal_details() == 0) {
                         swal('', 'Registration failed.<br> please try again later.', 'info');
                         return false;
                     }
                     if (studentid > 0) {
                         swal('', 'Registration - Personal details updated successfully.', 'info');
                         $('#unique_identity').prop('readonly', 'true');
                         change_class_for_reg();
                         return true;
                     } else {
                         swal('', 'Registration - Personal details saved successfully.', 'info');
                         $('#unique_identity').prop('readonly', 'true');
                         change_class_for_reg();
                         return true;
                     }
                 } else {
                     swal('', 'Enter all the mandatory fields.', 'info');
                     return false;
                 }
             } else if (newIndex == 2) {
                 var form_academic = $('#academic_profile');

                 //                var admission_date = $('#admission_date').val();
                 //                var toyear = $("#academic_year :selected").data('toyear');
                 //                var fromyear = $("#academic_year :selected").data('fromyear');
                 //                var flag = 1;
                 //                var error_msg_adm_date = '';
                 //                var ops_url_vald = baseurl + 'profile/validate-admissiondate-custom/';
                 //                $.ajax({
                 //                    type: "POST",
                 //                    cache: false,
                 //                    async: false,
                 //                    url: ops_url_vald,
                 //                    data: {"admission_date": admission_date, "toyear": toyear, "fromyear": fromyear},
                 //                    success: function (result) {
                 //                        var data = JSON.parse(result);
                 //                        if (data.status == 1) {
                 //                            flag = 2;
                 //                            $('#admission_date').css('border', '1px solid #ccc')
                 //                        } else {
                 //                            flag = 3;
                 //                            error_msg_adm_date = data.message;
                 //                        }
                 //                    }
                 //                });
                 //                if (flag == 3) {
                 //                    swal('', error_msg_adm_date, 'info');
                 //                    $('#admission_date').css('border-color', 'red');
                 //                    return false;
                 //                } else {
                 //                    $('#admission_date').css('border', '1px solid #ccc')
                 //                }

                 $('#academic_profile').validate({
                     rules: {
                         data_1: {
                             required: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         birth_country: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                        data: {dropdown: function () {
                                 //                                                return $('#birth_country').val();
                                 //                                            }}
                             }
                         },
                         class_details: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                        data: {dropdown: function () {
                                 //                                                return $('#birth_country').val();
                                 //                                            }}
                             }
                         },
                         admission_date: {
                             required: true,
                             //                            remote: {
                             //                                type: "POST",
                             //                                cache: false,
                             //                                url: 'validate-admissiondate/',
                             //                                data: {admission_date: function () {
                             //                                        return $('#admission_date').val();
                             //                                    },
                             //                                    toyear: function () {
                             //                                        return $("#academic_year :selected").data('toyear');
                             //                                    },
                             //                                    fromyear: function () {
                             //                                        return $("#academic_year :selected").data('fromyear');
                             //                                    }
                             //                                }
                             //                            },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         birth_place: {
                             required: true,
                             minlength: 3,
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 30,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         id_mark_1: {
                             required: true,
                             minlength: 3,
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 200,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }

                         },
                         id_mark_2: {
                             required: true,
                             minlength: 3,
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 200,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }

                         },
                         academic_year: {
                             required: true,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 async: false,
                                 url: 'validate-dropdowns/',
                                 data: {
                                     dropdown: function() {
                                         return $('#academic_year').val();
                                     }
                                 }
                             }
                         },
                         stream_id: {
                             required: true,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 data: {
                                     dropdown: function() {
                                         return $('#stream_id').val();
                                     }
                                 }
                             }
                         },
                     },
                     messages: {
                         data_1: {
                             required: "Select a date"
                         },
                         admission_date: {
                             required: "Select Admission Date ",
                             //                            remote: 'Please choose a date between the given academic year'
                         },
                         birth_country: {
                             required: "Select Birth Country ",
                             synchronousRemote: "Select Birth Country "
                         },
                         class_details: {
                             required: "Select Current Class",
                             synchronousRemote: "Select Current Class"
                         },
                         birth_place: {
                             required: "Enter Birth Place ",
                             minlength: "Enter atleast 3 character",
                             regex: "Enter valid characters(Only alphabets and space)",
                             maxlength: "Maximum of 30 characters allowed"
                         },
                         id_mark_1: {
                             required: "Enter Identification Mark 1 ",
                             minlength: "Enter atleast 3 character",
                             regex: "Enter valid characters(Only alphabets and space)",
                             maxlength: "Maximum of 200 characters allowed"
                         },
                         id_mark_2: {
                             required: "Enter Identification Mark 2 ",
                             minlength: "Enter atleast 3 character",
                             regex: "Enter valid characters(Only alphabets and space)",
                             maxlength: "Maximum of 200 characters allowed"
                         }
                     },
                     errorPlacement: function(error, element) {
                         $(element).parents('.form-group').append(error);
                     }
                 });
                 if (form_academic.valid() == true && form_academic.valid()) {

                     var invalid = 0;
                     $('#academic_profile select,#academic_profile input')
                         .not('#selectedclass,#studentid,.select2-search__field,#admn_no')
                         .each(function() {
                             if ($(this).val() == '-1' || $(this).val() == '') {
                                 console.log($(this));
                                 $(this).focusout();
                                 invalid += 1;
                             }
                         });
                     if (invalid != 0) {
                         swal('', 'Enter the mandatory fields.', 'info');
                         return false;
                     }

                     if ($('input[name=admission_no]').val().split('/')[1] == 'TT') {
                         if ($('#class_details :selected').val() != '1' && $('#class_details :selected').val() != '2') {
                             swal('', 'This student only capable for KG1/KG2 class', 'info');
                             return false;
                         }
                     }

                     if (save_academic_details() == 0) {
                         swal('', 'Registration failed.<br> please try again later.', 'info');
                         return false;
                     } else {
                         swal('', 'Registration - Academic details saved successfully.', 'info');
                         $('#academic_year').prop('disabled', 'true');
                         $('#stream_id').prop('disabled', 'true');
                         $('#class_details').prop('disabled', 'true');
                         $('html, body').animate({
                             scrollTop: $("body").offset().top
                         }, 1000);


                         return true;
                     }
                 } else {
                     swal('', 'Enter all the mandatory fields.', 'info');
                     return false;
                 }
             } else if (newIndex == 3) {

                 var form = $('#parent_details');
                 $('.panel-collapse:not(".in")')
                     .collapse('show');
                 var parent_datails = $('#parent_details').validate({
                     rules: {
                         fprofession: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#fprofession').val();
                                 //                                    }}
                             }
                         },
                         mprofession: {
                             required: true,
                             synchronousRemote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-dropdowns/',
                                 //                                data: {dropdown: function () {
                                 //                                        return $('#mprofession').val();
                                 //                                    }
                                 //                                }
                             }
                         },
                         fname: {
                             required: true,
                             minlength: 3,
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 50,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         f_unique_identity: {
                             required: true,
                             minlength: $('#uuid_unit_limit').val(),
                             maxlength: $('#uuid_unit_limit').val(),
                             number: true,
                             remote: {
                                 url: 'f_validate-adhar/',
                                 type: "POST",
                                 cache: false,
                                 async: false,
                                 mode: "abort",
                                 data: {
                                     f_unique_identity: function() {
                                         return $('#f_unique_identity').val();
                                     },
                                     "studentid": studentid
                                 }
                             }
                         },
                         fadd1: {
                             required: true,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fadd2: {
                             required: true,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fzip: {
                             required: true,
                             minlength: 6,
                             maxlength: 7,
                             regex: /^[0-9]+$/,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fphone: {
                             required: true,
                             minlength: 7,
                             regex: /^[0-9]+$/,
                             maxlength: 12,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fmobile: {
                             required: true,
                             minlength: 9,
                             maxlength: 12,
                             regex: /^[0-9]+$/,
                             //                                number: true,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#fmobile').val();
                                     },
                                     sibling_student_data_id: function() {
                                         return $('#studentid').val();
                                     },
                                     relation: "F"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fmail: {
                             required: true,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#fmail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "F"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fcadd1: {
                             required: true,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fcadd2: {
                             required: true,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fczip: {
                             required: true,
                             minlength: 6,
                             maxlength: 7,
                             //                            number: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fcphone: {
                             required: true,
                             minlength: 7,
                             maxlength: 12,
                             regex: /^[0-9]+$/,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fcmobile: {
                             required: true,
                             minlength: 9,
                             maxlength: 12,
                             regex: /^[0-9]+$/,
                             //                                number: true,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#fcmobile').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "F"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fcmail: {
                             required: true,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#fcmail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "F"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         foadd1: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         foadd2: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fozip: {
                             required: false,
                             minlength: 6,
                             maxlength: 7,
                             //                            number: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fophone: {
                             required: false,
                             minlength: 7,
                             regex: /^[0-9]+$/,
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fomobile: {
                             required: false,
                             minlength: 9,
                             maxlength: 12,
                             regex: /^[0-9]+$/,
                             //                                number: true,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#fomobile').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "F"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         fomail: {
                             required: false,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#fomail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "F"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mname: {
                             required: true,
                             minlength: 3,
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 50,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         m_unique_identity: {
                             required: true,
                             minlength: $('#uuid_unit_limit').val(),
                             maxlength: $('#uuid_unit_limit').val(),
                             number: true,
                             remote: {
                                 url: 'm_validate-adhar/',
                                 type: "POST",
                                 cache: false,
                                 async: false,
                                 mode: "abort",
                                 data: {
                                     m_unique_identity: function() {
                                         return $('#m_unique_identity').val();
                                     },
                                     "studentid": studentid
                                 }
                             }
                         },
                         madd1: {
                             required: true,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         madd2: {
                             required: true,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mzip: {
                             required: true,
                             minlength: 6,
                             maxlength: 7,
                             regex: /^[0-9]+$/,
                             //                            number: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mphone: {
                             required: true,
                             minlength: 7,
                             regex: /^[0-9]+$/,
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mmobile: {
                             required: true,
                             minlength: 9,
                             maxlength: 12,
                             regex: /^[0-9]+$/,
                             //                                number: true,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#mmobile').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "M"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mmail: {
                             required: true,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#mmail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "M"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mcadd1: {
                             required: true,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mcadd2: {
                             required: true,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mczip: {
                             required: true,
                             minlength: 6,
                             maxlength: 7,
                             regex: /^[0-9]+$/,
                             //                            number: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mcphone: {
                             required: true,
                             minlength: 7,
                             regex: /^[0-9]+$/,
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mcmobile: {
                             required: true,
                             minlength: 9,
                             maxlength: 12,
                             regex: /^[0-9]+$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#mcmobile').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "M"
                                 }
                             },
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mcmail: {
                             required: true,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#mcmail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "M"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         moadd1: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         moadd2: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mozip: {
                             required: false,
                             minlength: 6,
                             maxlength: 7,
                             regex: /^[0-9]+$/,
                             //                            number: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         mophone: {
                             required: false,
                             minlength: 7,
                             regex: /^[0-9]+$/,
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         momobile: {
                             required: false,
                             minlength: 9,
                             maxlength: 12,
                             regex: /^[0-9]+$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#momobile').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "M"
                                 }
                             },
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         momail: {
                             required: false,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#momail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "M"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gname: {
                             required: false,
                             minlength: 3,
                             regex: /^[a-zA-Z ]*$/,
                             maxlength: 50,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         g_unique_identity: {
                             required: false,
                             minlength: $('#uuid_unit_limit').val(),
                             maxlength: $('#uuid_unit_limit').val(),
                             number: true,
                             remote: {
                                 url: 'g_validate-adhar/',
                                 type: "POST",
                                 cache: false,
                                 async: false,
                                 mode: "abort",
                                 data: {
                                     g_unique_identity: function() {
                                         return $('#g_unique_identity').val();
                                     },
                                     "studentid": studentid
                                 }
                             }
                         },
                         gadd1: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gadd2: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gzip: {
                             required: false,
                             minlength: 6,
                             maxlength: 7,
                             regex: /^[0-9]+$/,
                             //                            number: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gphone: {
                             required: false,
                             minlength: 7,
                             regex: /^[0-9]+$/,
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gmobile: {
                             required: false,
                             minlength: 9,
                             maxlength: 12,
                             regex: /^[0-9]+$/,
                             //                                number: true,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#gmobile').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "G"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gmail: {
                             required: false,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#gmail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "G"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gcadd1: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gcadd2: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gczip: {
                             required: false,
                             minlength: 6,
                             maxlength: 7,
                             regex: /^[0-9]+$/,
                             //                            number: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gcphone: {
                             required: false,
                             minlength: 7,
                             regex: /^[0-9]+$/,
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gcmobile: {
                             required: false,
                             minlength: 9,
                             regex: /^[0-9]+$/,
                             maxlength: 12,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#gcmobile').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "G"
                                 }
                             },
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gcmail: {
                             required: false,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#gcmail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "G"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         goadd1: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         goadd2: {
                             required: false,
                             minlength: 3,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gozip: {
                             required: false,
                             minlength: 6,
                             maxlength: 7,
                             regex: /^[0-9]+$/,
                             //                            number: true,
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gophone: {
                             required: false,
                             minlength: 7,
                             regex: /^[0-9]+$/,
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gomobile: {
                             required: false,
                             minlength: 9,
                             maxlength: 12,
                             regex: /^[0-9]+$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-mobile/',
                                 data: {
                                     mobile: function() {
                                         return $('#gomobile').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "G"
                                 }
                             },
                             //                                number: true,

                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                         gomail: {
                             required: false,
                             minlength: 5,
                             email: true,
                             regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                             remote: {
                                 type: "POST",
                                 cache: false,
                                 url: 'validate-email/',
                                 data: {
                                     email: function() {
                                         return $('#gomail').val();
                                     },
                                     sibling_student_id: function() {
                                         if ($('#sibling_student_data_id').val() == '0') {
                                             return $('#studentid').val();
                                         } else {
                                             return $('#sibling_student_data_id').val()
                                         }
                                     },
                                     relation: "G"
                                 }
                             },
                             normalizer: function(value) {
                                 return $.trim(value);
                             }
                         },
                     },
                     messages: {
                         fprofession: {
                             required: 'Select Profession',
                             synchronousRemote: 'Select Profession'
                         },
                         mprofession: {
                             required: 'Select Profession',
                             synchronousRemote: 'Select Profession'
                         },
                         fname: {
                             required: "Please provide Father Name",
                             minlength: "Enter atleast 3 character",
                             regex: "Enter valid characters.",
                             maxlength: "Enter characters less than 50 characters"
                         },
                         f_unique_identity: {
                             required: "Enter " + $('#uuid_unit_limit_name').val(),
                             minlength: "Enter " + $('#uuid_unit_limit').val() + " Digit " + $('#uuid_unit_limit_name').val(),
                             maxlength: $('#uuid_unit_limit_name').val() + " Should Not Exceed More Than " + $('#uuid_unit_limit').val()
                         },
                         fadd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         fadd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         fzip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters."
                         },
                         fphone: {
                             required: "Please provide Phone Number",
                             minlength: "Enter atleast 7 digit ",
                             maxlength: "Maximum characters should be less than 12 numbers",
                             regex: "Enter valid characters"

                         },
                         fmobile: {
                             required: "Please provide Mobile Number",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"
                         },
                         fmail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"
                         },
                         fcadd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         fcadd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         fczip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters."
                         },
                         fcphone: {
                             required: "Please provide Phone Number",
                             minlength: "Enter atleast 7 digit ",
                             regex: "Enter valid characters.",
                             maxlength: "Enter  12 digit number",

                         },
                         fcmobile: {
                             required: "Please provide Mobile Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"

                         },
                         fcmail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"
                         },
                         foadd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         foadd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         fozip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters."
                         },
                         fophone: {
                             required: "Please provide Phone Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 7 digit ",
                             maxlength: "Enter  7 digit code",
                         },
                         fomobile: {
                             required: "Please provide Mobile Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"

                         },
                         fomail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"
                         },
                         mname: {
                             required: "Please provide Mother Name",
                             minlength: "Enter atleast 3 character",
                             regex: "Enter valid characters.",
                             maxlength: "Enter characters less than 50 characters"
                         },
                         m_unique_identity: {
                             required: "Enter " + $('#uuid_unit_limit_name').val(),
                             minlength: "Enter " + $('#uuid_unit_limit').val() + " Digit " + $('#uuid_unit_limit_name').val(),
                             maxlength: $('#uuid_unit_limit_name').val() + " Should Not Exceed More Than " + $('#uuid_unit_limit').val()
                         },
                         madd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         madd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         mzip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters.",
                         },
                         mphone: {
                             required: "Please provide Phone Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 7 digit ",
                             maxlength: "Enter  12 digit number"

                         },
                         mmobile: {
                             required: "Please provide Mobile Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"

                         },
                         mmail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"

                         },
                         mcadd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         mcadd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         mczip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters."
                         },
                         mcphone: {
                             required: "Please provide Phone Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 7 digit ",
                             maxlength: "Enter  12 digit number"

                         },
                         mcmobile: {
                             required: "Please provide Mobile Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"

                         },
                         mcmail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"
                         },
                         moadd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         moadd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         mozip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters."
                         },
                         mophone: {
                             required: "Please provide Phone Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 7 digit ",
                             maxlength: "Enter  12 digit number"

                         },
                         momobile: {
                             required: "Please provide Mobile Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"

                         },
                         momail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"
                         },
                         gname: {
                             required: "Please provide Guardian Name",
                             minlength: "Enter atleast 3 character",
                             regex: "Enter valid characters.",
                             maxlength: "Enter characters less than 50 characters"
                         },
                         g_unique_identity: {
                             required: "Enter " + $('#uuid_unit_limit_name').val(),
                             minlength: "Enter " + $('#uuid_unit_limit').val() + " Digit " + $('#uuid_unit_limit_name').val(),
                             maxlength: $('#uuid_unit_limit_name').val() + " Should Not Exceed More Than " + $('#uuid_unit_limit').val()
                         },
                         gadd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         gadd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         gzip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters."
                         },
                         gphone: {
                             required: "Please provide Phone Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 7 digit ",
                             maxlength: "Enter  12 digit number"

                         },
                         gmobile: {
                             required: "Please provide Mobile Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"

                         },
                         gmail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"

                         },
                         gcadd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         gcadd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         gczip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters."

                         },
                         gcphone: {
                             required: "Please provide Phone Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 7 digit ",
                             maxlength: "Enter  12 digit number"

                         },
                         gcmobile: {
                             required: "Please provide Mobile Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"

                         },
                         gcmail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"
                         },
                         goadd1: {
                             required: "Please provide Address Line 1",
                             minlength: "Enter atleast 3 character"
                         },
                         goadd2: {
                             required: "Please provide Address Line 2",
                             minlength: "Enter atleast 3 character"
                         },
                         gozip: {
                             required: "Please provide Zip Code",
                             minlength: "Enter atleast 6 digit",
                             maxlength: "Enter maximum 7 digit",
                             regex: "Enter valid characters."
                         },
                         gophone: {
                             required: "Please provide Phone Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 7 digit ",
                             maxlength: "Enter  12 digit number"

                         },
                         gomobile: {
                             required: "Please provide Mobile Number",
                             regex: "Enter valid characters.",
                             minlength: "Enter atleast 9 digit",
                             maxlength: "Enter maximum 12 digit"
                         },
                         gomail: {
                             required: "Please provide Email ID",
                             minlength: "Enter atleast 5 characher ",
                             regex: "Please provide valid Email ID"
                         }
                     },
                     errorPlacement: function(error, element) {
                         $(element).parents('.form-group').append(error);
                     }
                 });
                 parent_datails.form();
                 if (form.valid() && ($('#fprofession').val() != -1) && ($('#mprofession').val() != -1)) {
                     //                    return false;

                     if (save_parent_details() == 0) {
                         swal('', 'Registration failed please try again later.', 'info');
                         return false;
                     } else {
                         swal('', 'Registration - Parent details saved successfully.', 'info');
                         return true;
                     }
                 } else {
                     swal('', 'Enter all the mandatory fields.', 'info');
                     return false;
                 }
             } else if (newIndex == 4) {
                 var form1 = $('#other_details-passport');
                 var form2 = $('#other_details-visa');
                 //                    form.validate().settings.ignore = ":disabled,:hidden";
                 //                    $.validator.messages.required = '';

                 var flag1 = 0;
                 var flag2 = 0;
                 if ($('#passno').val() !== '') {
                     flag1 = 1;
                     $(form1).validate({
                         rules: {
                             passno: {
                                 required: true,
                                 minlength: 6,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                             pissue_place: {
                                 required: true,
                                 minlength: 3,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                             pass_issue_date: {
                                 required: true,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                             pass_expiry_date: {
                                 required: true,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                             pdesc: {
                                 required: true,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             }
                         },
                         messages: {
                             passno: {
                                 required: "Enter Passport Number",
                                 minlength: "Enter atleast 6 character"
                             },
                             pissue_place: {
                                 required: "Enter Place of Issue",
                                 minlength: "Enter atleast 3 character"
                             },
                             pass_issue_date: {
                                 required: "Select Date of issue",
                             },
                             pass_expiry_date: {
                                 required: "Select Date of expiry",
                             },
                             pdesc: {
                                 required: "Enter description",
                                 minlength: "Enter atleast 5 character"
                             }
                         },
                         errorPlacement: function(error, element) {
                             $(element).parents('.form-group').append(error);
                         }
                     });
                 }
                 if ($('#visano').val() !== '') {
                     flag2 = 1;
                     $(form2).validate({
                         rules: {
                             visano: {
                                 required: true,
                                 minlength: 6,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                             vissue_place: {
                                 required: true,
                                 minlength: 3,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                             visa_issue_date: {
                                 required: true,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                             visa_expiry_date: {
                                 required: true,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                             vdesc: {
                                 required: true,
                                 minlength: 5,
                                 normalizer: function(value) {
                                     return $.trim(value);
                                 }
                             },
                         },
                         messages: {
                             visano: {
                                 required: "Enter Visa Number",
                                 minlength: "Enter atleast 6 character"
                             },
                             vissue_place: {
                                 required: "Enter Place of Issue",
                                 minlength: "Enter atleast 3 character"
                             },
                             visa_issue_date: {
                                 required: "Select Date of issue",
                             },
                             visa_expiry_date: {
                                 required: "Select Date of expiry",
                             },
                             vdesc: {
                                 required: "Enter description",
                                 minlength: "Enter atleast 5 character"
                             },
                         },
                         errorPlacement: function(error, element) {
                             $(element).parents('.form-group').append(error);
                         }
                     });
                 }
                 var flag3 = 0;
                 var flag4 = 0;

                 if (flag1 == 0 && flag2 == 0) {
                     swal('', 'Skipping other details for saving registration', 'info');
                     return true;
                 }
                 if (flag1 == 1) {
                     if (form1.valid()) {
                         flag3 = 1;
                         var a = moment($("#pass_issue_date").datepicker("getDate"));
                         var b = moment($("#pass_expiry_date").datepicker("getDate"));
                         var v = b.diff(a, 'days');
                         if (v <= 0) {
                             swal('', 'Passport Expiry Date should be greater than Passport Issue Date.', 'info');
                             return false;
                         }
                     } else {
                         flag3 = 0;
                     }
                 } else {
                     flag3 = 1
                 }

                 if (flag2 == 1) {
                     if (form2.valid()) {
                         flag4 = 1;
                         var c = moment($("#visa_issue_date").datepicker("getDate"));
                         var d = moment($("#visa_expiry_date").datepicker("getDate"));
                         var n = d.diff(c, 'days');
                         if (n <= 0) {
                             swal('', 'Visa Expiry Date should be greater than Visa Issue Date.', 'info');
                             return false;
                         }
                     } else {
                         flag4 = 0;
                     }
                 } else {
                     flag4 = 1
                 }

                 if (flag3 == 1 && flag4 == 1) {
                     var status = save_other_details(flag1, flag2);
                     if (status.otherflag == 0) {
                         if (status.message) {
                             swal('', status.message, 'info');
                             return false;
                         } else {
                             swal('', 'Registration failed.<br> please try again later.', 'info');
                             return false;
                         }
                     } else {
                         swal('', 'Other Details saved successfully.', 'info');
                         return true;
                     }
                 } else {
                     swal('', 'Enter all the mandatory fields.', 'info');
                     return false;
                 }
             }
         },
         onStepChanged: function(event, currentIndex, priorIndex) {
             // Suppress (skip) "Warning" step if the user is old enough.
             //                if (currentIndex === 2)
             //                {
             //                    $(this).steps("next");
             //                }

             // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
             //                if (currentIndex === 2 && priorIndex === 3)
             //                {
             //                    $(this).steps("previous");
             //                }
         },
         onFinishing: function(event, currentIndex) {
             if (save_facilities_details() == 0) {
                 swal('', 'Registration failed.<br> please try again later.', 'info');
                 return false;
             } else {
                 var admn_no = $('#admission_number_new').val();
                 swal({
                     title: 'Success',
                     text: 'Student Updated Successfully. Admission Number : ' + admn_no,
                     type: 'success',
                     showCancelButton: false,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'OK',
                     closeOnConfirm: true
                 }, function(isConfirm) {
                     if (isConfirm) {
                         var studentid = $('#studentid').val();
                         //profile_detail(studentid);
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
                                 $('#profile-detail-content').html('');
                                 $('#profile-detail-content').show();
                                 $('#profile-detail-content').html(data);
                                 $('.registration-view').hide();
                                 $('html, body').animate({
                                     scrollTop: $("#profile-detail-content").offset().top
                                 }, 1000);
                             }
                         });
                     }
                 });
                 return true;
             }
             //                var form = $(this);

             // Disable validation on fields that are disabled.
             // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
             //                form.validate().settings.ignore = ":disabled";

             // Start validation; Prevent form submission if false
             //                return form.valid();
         },
         onFinished: function(event, currentIndex) {
             //                var form = $(this);

             // Submit form input
             //                form.submit();
         }
     });

     function profile_detail(studentid) {

     }

     $(".select2_demo_1").select2({
         "theme": "bootstrap",
         "width": "100%"

     });
     $(".select2_demo_2").select2({
         "theme": "bootstrap",
         "width": "100%"
     });
     $(".select2_demo_3").select2({
         "theme": "bootstrap",
         "width": "100%"
     });
     $(".select2_registration").select2({
         "theme": "bootstrap",
         "width": "100%"
     });

     $('#dob_date').datepicker({
         format: 'dd-mm-yyyy',
         endDate: moment($('#agelimit').val() + '/' + new Date().getFullYear()).isValid() == true ? moment($('#agelimit').val() + '/' + new Date().getFullYear()).subtract(Number($('#agelimit').attr('data-val')), 'years').format('DD-MM-YYYY') : '-365d',
         maxDate: '0',
         //        todayBtn: "linked",
         autoclose: true,
         onClose: function() {

         }
     });
     $('#pass_issue_date').datepicker({
         format: 'dd-mm-yyyy',
         //        endDate: '+275d',
         //        todayBtn: "linked",
         autoclose: true,
         onClose: function() {

         }
     });
     //    $('#pass_issue_date').datepicker("setDate", new Date());
     $('#pass_expiry_date').datepicker({
         format: 'dd-mm-yyyy',
         //        endDate: '+275d',
         //        todayBtn: "linked",
         autoclose: true,
         onClose: function() {

         }
     });
     //    $('#pass_expiry_date').datepicker("setDate", new Date());
     $('#visa_issue_date').datepicker({
         format: 'dd-mm-yyyy',
         //        endDate: '+275d',
         //        todayBtn: "linked",
         autoclose: true,
         onClose: function() {

         }
     });
     //    $('#visa_issue_date').datepicker("setDate", new Date());
     $('#visa_expiry_date').datepicker({
         format: 'dd-mm-yyyy',
         //        endDate: '+275d',
         //        todayBtn: "linked",
         autoclose: true,
         onClose: function() {

         }
     });
     //    $('#visa_expiry_date').datepicker("setDate", new Date());
     //        $('#dob_date').datepicker("setDate", moment().format('DD-MM-YYYY'));
     //    $('#admission_date').datepicker({
     //        format: 'dd-mm-yyyy',
     //        endDate: '+0d',
     //        autoclose: true,
     //        onClose: function () {
     //
     //        }
     //    });
     $('#admission_date').datepicker("setDate", moment('<?php echo $profile_details['Admission_Date']; ?>').format('DD-MM-YYYY'));
     $('#search_student').hide();
     $('.i-checks').iCheck({
         checkboxClass: 'icheckbox_square-green',
         radioClass: 'iradio_square-green',
     });
     //    });
     function show_search() {
         $('#search_student').slideDown("slow");
     }

     function hide_search() {
         $('#search_student').slideUp("slow");
     }

     function age_changer() {
         if (moment($("#dob_date").datepicker("getDate")).isValid()) {
             var age = getAge(moment($("#dob_date").datepicker("getDate")).format('YYYY-MM-DD'));
             $('#age').attr('data-val', age.age);
             $('#age').val(age.agestr);
         } else {
             $('#age').attr('data-val', '');
             $('#age').val('0 Years 0 Months 0 Days');
         }
     }

     function checkEmirateAvailable() {
         if ($('#unique_identity').val().trim().length === parseInt($('#unique_identity').attr('maxlength'))) {
             var studentid = $('#studentid').val();
             var ops_url = baseurl + 'registration/validate-adhar';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "unique_identity": $('#unique_identity').val(),
                     "studentid": studentid
                 },
                 //                data: {"load": 1, "uuid": $('#unique_identity').val()},
                 success: function(result) {
                     var data = $.parseJSON(result);
                     if (data != 'true') {
                         $('#id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + ' is already exist</span>');
                     } else {
                         $('#id_spot_check').html('<span style="color:#009900;"><i class="fa fa-check"></i> ' + $('#uuid_unit_limit_name').val() + ' is available</span>');
                     }
                 }
             });
         } else {
             $('#id_spot_check').html('');
         }
     }

     function f_checkEmirateAvailable() {
         if ($('#f_unique_identity').val().trim().length === parseInt($('#f_unique_identity').attr('maxlength'))) {
             var flg = 0;
             var ops_url = baseurl + 'registration/search-f-uuid';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "load": 1,
                     "uuid": $('#f_unique_identity').val()
                 },
                 success: function(result) {
                     var data = $.parseJSON(result);
                     console.log(data.status);
                     if (data.status == 1) {
                         $('#f_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + ' is already exist</span>');
                         flg = 1;
                     } else {
                         $('#f_id_spot_check').html('<span style="color:#009900;"><i class="fa fa-check"></i> ' + $('#uuid_unit_limit_name').val() + ' is available</span>');
                     }
                 }
             });
             return flg;
         } else {
             $('#f_id_spot_check').html('');
         }
     }

     function m_checkEmirateAvailable() {
         if ($('#m_unique_identity').val().trim().length === parseInt($('#m_unique_identity').attr('maxlength'))) {
             var flg = 0;
             var ops_url = baseurl + 'registration/search-m-uuid';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "load": 1,
                     "uuid": $('#m_unique_identity').val()
                 },
                 success: function(result) {
                     var data = $.parseJSON(result);
                     if (data.status == 1) {
                         $('#m_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + ' is already exist</span>');
                         flg = 1;
                     } else {
                         $('#m_id_spot_check').html('<span style="color:#009900;"><i class="fa fa-check"></i> ' + $('#uuid_unit_limit_name').val() + ' is available</span>');
                     }
                 }
             });
             return flg;
         } else {
             $('#m_id_spot_check').html('');
         }
     }

     function g_checkEmirateAvailable() {
         if ($('#g_unique_identity').val().trim().length === parseInt($('#g_unique_identity').attr('maxlength'))) {
             var flg = 0;
             var ops_url = baseurl + 'registration/search-g-uuid';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "load": 1,
                     "uuid": $('#g_unique_identity').val()
                 },
                 success: function(result) {
                     var data = $.parseJSON(result);
                     if (data.status == 1) {
                         $('#g_unique_identity').css('border-color', 'red');
                         $('#g_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + ' is already exist</span>');
                         flg = 1;
                     } else {
                         $('#g_id_spot_check').html('<span style="color:#009900;"><i class="fa fa-check"></i> ' + $('#uuid_unit_limit_name').val() + ' is available</span>');
                     }
                 }
             });
             return flg;
         } else {
             $('#g_id_spot_check').html('');
         }
     }

     function getAge(dateVal) {
         let date1 = moment();
         if ($('#agelimit').val() != '0') {
             date1 = moment($('#agelimit').val() + '/' + new Date().getFullYear());
         } else {
             date1 = moment();
         }
         let date2 = moment(dateVal);
         let years = date1.diff(date2, 'year');
         date2.add(years, 'years');

         let months = date1.diff(date2, 'months');
         date2.add(months, 'months');

         let days = date1.diff(date2, 'days');
         date2.add(days, 'days');
         return {
             agestr: years + ' Years ' + months + ' Months ' + days + ' Days',
             age: years
         };
         //        var
         //                birthday = new Date(dateVal),
         //                today = new Date(),
         //                ageInMilliseconds = new Date(today - birthday),
         //                years = ageInMilliseconds / (24 * 60 * 60 * 1000 * 365.25),
         //                months = 12 * (years % 1),
         //                days = Math.floor(30 * (months % 1));
         //        return { agestr: Math.floor(years) + ' Years ' + Math.floor(months) + ' Months ' + days + ' Days', age: Math.floor(years) };
     }

     function change_class_for_reg() {
         var batchid = '#class_details';
         var age = $('#age').attr('data-val');
         var ops_url = baseurl + 'registration/get-classs-with-age-restriction/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "age": age
             },
             success: function(result) {
                 $(batchid).empty().trigger("change");
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var batch_data = data.data;
                     var selectedbatch = $('#selectedclass').val();
                     //                    console.log('class: ' + selectedbatch);
                     $(batchid).append("<option value='-1' selected >Select</option>");
                     $.each(batch_data, function(i, v) {
                         if (v.Course_Det_ID == selectedbatch) {
                             $(batchid).append("<option value='" + v.Course_Det_ID + "' data-masterid='" + v.Course_Master_ID + "' selected >" + v.Description + "</option>");
                         } else {
                             $(batchid).append("<option value='" + v.Course_Det_ID + "' data-masterid='" + v.Course_Master_ID + "' >" + v.Description + "</option>");
                         }
                     });
                     $(batchid).trigger('change');
                 } else {
                     $(batchid).empty().trigger("change");
                 }
             }
         });
     }

     function save_facilities_details() {
         var studentid = $('#studentid').val();
         var transport = $('#trans_port').prop('checked');
         if (transport == true) {
             var istransport = 1;
         } else {
             var istransport = 0;
         }
         var mess = $('#mess').prop('checked');
         if (mess == true) {
             var ismess = 1;
         } else {
             var ismess = 0;
         }
         var hostel = $('#hostel').prop('checked');
         if (hostel == true) {
             var ishostel = 1;
         } else {
             var ishostel = 0;
         }
         var o_service = $('#o_service').prop('checked');
         if (o_service == true) {
             var iso_service = 1;
         } else {
             var iso_service = 0;
         }
         var register_phase_four = new Object();
         register_phase_four.studentid = studentid;
         //        register_phase_four.admission_no = admission_no;
         register_phase_four.istransport = istransport;
         register_phase_four.ismess = ismess;
         register_phase_four.ishostel = ishostel;
         register_phase_four.iso_service = iso_service;
         var otherflag = 0;
         var update_other = 0;
         var student_id = $('#studentid').val();
         var studentdata = JSON.stringify(register_phase_four);
         var ops_url = baseurl + 'registration/save-student-facilities-details';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "update_other": update_other,
                 "studentid": student_id,
                 "studentdata": studentdata
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     //                    $('#studentid').val(data.studentid);
                     otherflag = 1
                     $('#admission_number_new').val(data.admn_no);
                 } else {
                     otherflag = 0;
                 }
             },
             error: function() {
                 otherflag = 0;
             }
         });
         return otherflag;
     }

     function save_other_details(flag1, flag2) {

         var studentid = $('#studentid').val();
         var admission_no = $('input[name=admission_no]').val();
         if (flag1 == 1) {
             var passportnum = $('#passno').val();
             var pasissue_place = $('#pissue_place').val();
             var pasissue_dat = (moment($("#pass_issue_date").datepicker("getDate")).isValid() == true) ? moment($("#pass_issue_date").datepicker("getDate")).format('YYYY-MM-DD') : '';
             var pasexpi_dat1 = (moment($("#pass_expiry_date").datepicker("getDate")).isValid() == true) ? moment($("#pass_expiry_date").datepicker("getDate")).format('YYYY-MM-DD') : '';
             var pasexpi_dat = pasexpi_dat1 > pasissue_dat ? pasexpi_dat1 : (moment($("#pass_expiry_date").datepicker("getDate")).isValid() == false);
             var pasdesc = $('#pdesc').val();
         } else {
             var passportnum = '';
             var pasissue_place = '';
             var pasissue_dat = '';
             var pasexpi_dat = '';
             var pasdesc = '';
         }

         if (flag2 == 1) {
             var visanum = $('#visano').val();
             var visissplace = $('#vissue_place').val();
             var visissudat = (moment($("#visa_issue_date").datepicker("getDate")).isValid() == true) ? moment($("#visa_issue_date").datepicker("getDate")).format('YYYY-MM-DD') : '';
             var visexpdat1 = (moment($("#visa_expiry_date").datepicker("getDate")).isValid() == true) ? moment($("#visa_expiry_date").datepicker("getDate")).format('YYYY-MM-DD') : '';
             var visexpdat = visexpdat1 > visissudat ? visexpdat1 : (moment($("#visa_expiry_date").datepicker("getDate")).isValid() == false);
             var visdesc = $('#vdesc').val();
         } else {
             var visanum = '';
             var visissplace = '';
             var visissudat = '';
             var visexpdat = '';
             var visdesc = '';
         }


         var register_phase_three = new Object();
         var return_status = new Object();
         register_phase_three.studentid = studentid;
         register_phase_three.admission_no = admission_no;
         register_phase_three.passportnum = passportnum;
         register_phase_three.pasissue_place = pasissue_place;
         register_phase_three.pasissue_dat = pasissue_dat;
         register_phase_three.pasexpi_dat = pasexpi_dat;
         register_phase_three.pasdesc = pasdesc;
         register_phase_three.visanum = visanum;
         register_phase_three.visissplace = visissplace;
         register_phase_three.visissudat = visissudat;
         register_phase_three.visexpdat = visexpdat;
         register_phase_three.visdesc = visdesc;
         var otherflag = 0;
         var update_other = 0;
         var student_id = $('#studentid').val();
         //        if (student_id > 0) {
         //            update_otherdetails = 1;
         //            alert('update under construction');
         //            return 0;
         //        }

         var studentdata = JSON.stringify(register_phase_three);
         var ops_url = baseurl + 'registration/save-student-other-details';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "update_other": update_other,
                 "studentid": student_id,
                 "studentdata": studentdata,
                 "flag1": flag1,
                 "flag2": flag2
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     return_status.otherflag = 1
                     return_status.message = '';
                 } else {
                     return_status.otherflag = 0
                     return_status.message = '';
                 }
             },
             error: function() {
                 //                console.log(register_phase_three);
                 return_status.otherflag = 0
                 return_status.message = 'Link Error';
             }
         });
         return return_status;
     }


     function save_parent_details() {

         //father details
         var fname = $('#fname').val();
         var f_uuid = $('#f_unique_identity').val();
         var fprofession_selected = $('#fprofession').val();
         //communication address
         var fcadd1 = $('#fadd1').val();
         var fcadd2 = $('#fadd2').val();
         var fcadd3 = $('#fadd3').val();
         var fczip = $('#fzip').val();
         var fcphone = $('#fphone').val();
         var fcmobile = $('#fmobile').val();
         var fcmail = $('#fmail').val();
         //offical address
         var foadd1 = $('#foadd1').val();
         var foadd2 = $('#foadd2').val();
         var foadd3 = $('#foadd3').val();
         var fozip = $('#fozip').val();
         var fophone = $('#fophone').val();
         var fomobile = $('#fomobile').val();
         var fomail = $('#fomail').val();
         //permanent address
         var fpadd1 = $('#fcadd1').val();
         var fpadd2 = $('#fcadd2').val();
         var fpadd3 = $('#fcadd3').val();
         var fpzip = $('#fczip').val();
         var fpphone = $('#fcphone').val();
         var fpmobile = $('#fcmobile').val();
         var fpmail = $('#fcmail').val();
         //mother details
         var mname = $('#mname').val();
         var m_uuid = $('#m_unique_identity').val();
         var mprofession_selected = $('#mprofession').val();
         //communication address
         var mcadd1 = $('#madd1').val();
         var mcadd2 = $('#madd2').val();
         var mcadd3 = $('#madd3').val();
         var mczip = $('#mzip').val();
         var mcphone = $('#mphone').val();
         var mcmobile = $('#mmobile').val();
         var mcmail = $('#mmail').val();
         //offical address
         var moadd1 = $('#moadd1').val();
         var moadd2 = $('#moadd2').val();
         var moadd3 = $('#moadd3').val();
         var mozip = $('#mozip').val();
         var mophone = $('#mophone').val();
         var momobile = $('#momobile').val();
         var momail = $('#momail').val();
         //permanent  address
         var mpadd1 = $('#mcadd1').val();
         var mpadd2 = $('#mcadd2').val();
         var mpadd3 = $('#mcadd3').val();
         var mpzip = $('#mczip').val();
         var mpphone = $('#mcphone').val();
         var mpmobile = $('#mcmobile').val();
         var mpmail = $('#mcmail').val();
         //Guardian details
         var gname = $('#gname').val();
         var g_uuid = $('#g_unique_identity').val();
         var gprofession_selected = $('#gprofession').val();
         var ggender = $('#ggender').val();
         //communication  address
         var gcadd1 = $('#gadd1').val();
         var gcadd2 = $('#gadd2').val();
         var gcadd3 = $('#gadd3').val();
         var gczip = $('#gzip').val();
         var gcphone = $('#gphone').val();
         var gcmobile = $('#gmobile').val();
         var gcmail = $('#gmail').val();
         //offical  address
         var goadd1 = $('#goadd1').val();
         var goadd2 = $('#goadd2').val();
         var goadd3 = $('#goadd3').val();
         var gozip = $('#gozip').val();
         var gophone = $('#gophone').val();
         var gomobile = $('#gomobile').val();
         var gomail = $('#gomail').val();
         //permanent  address
         var gpadd1 = $('#gcadd1').val();
         var gpadd2 = $('#gcadd2').val();
         var gpadd3 = $('#gcadd3').val();
         var gpzip = $('#gczip').val();
         var gpphone = $('#gcphone').val();
         var gpmobile = $('#gcmobile').val();
         var gpmail = $('#gcmail').val();
         var studentid = $('#studentid').val();
         var admission_no = $('#admission_no').val();
         //Employee Detail from WFM
         var who_worked = $('#who_worked').val();
         var emp_id = $('#emp_id').val();
         var emp_inst_id = $('#emp_inst_id').val();
         var register_phase_three = new Object();
         //father details
         register_phase_three.fname = fname;
         register_phase_three.f_uuid = f_uuid;
         register_phase_three.fprofession_selected = fprofession_selected;
         register_phase_three.fcadd1 = fcadd1;
         register_phase_three.fcadd2 = fcadd2;
         register_phase_three.fcadd3 = fcadd3;
         register_phase_three.fczip = fczip;
         register_phase_three.fcphone = fcphone;
         register_phase_three.fcmobile = fcmobile;
         register_phase_three.fcmail = fcmail;
         register_phase_three.foadd1 = foadd1;
         register_phase_three.foadd2 = foadd2;
         register_phase_three.foadd3 = foadd3;
         register_phase_three.fozip = fozip;
         register_phase_three.fophone = fophone;
         register_phase_three.fomobile = fomobile;
         register_phase_three.fomail = fomail;
         register_phase_three.fpadd1 = fpadd1;
         register_phase_three.fpadd2 = fpadd2;
         register_phase_three.fpadd3 = fpadd3;
         register_phase_three.fpzip = fpzip;
         register_phase_three.fpphone = fpphone;
         register_phase_three.fpmobile = fpmobile;
         register_phase_three.fpmail = fpmail;
         //mother details
         register_phase_three.mname = mname;
         register_phase_three.m_uuid = m_uuid;
         register_phase_three.mprofession_selected = mprofession_selected;
         register_phase_three.mcadd1 = mcadd1;
         register_phase_three.mcadd2 = mcadd2;
         register_phase_three.mcadd3 = mcadd3;
         register_phase_three.mczip = mczip;
         register_phase_three.mcphone = mcphone;
         register_phase_three.mcmobile = mcmobile;
         register_phase_three.mcmail = mcmail;
         register_phase_three.moadd1 = moadd1;
         register_phase_three.moadd2 = moadd2;
         register_phase_three.moadd3 = moadd3;
         register_phase_three.mozip = mozip;
         register_phase_three.mophone = mophone;
         register_phase_three.momobile = momobile;
         register_phase_three.momail = momail;
         register_phase_three.mpadd1 = mcadd1;
         register_phase_three.mpadd2 = mcadd2;
         register_phase_three.mpadd3 = mcadd3;
         register_phase_three.mpzip = mpzip;
         register_phase_three.mpphone = mcphone;
         register_phase_three.mpmobile = mcmobile;
         register_phase_three.mpmail = mcmail;
         //guardian details
         register_phase_three.gname = gname;
         register_phase_three.g_uuid = g_uuid;
         register_phase_three.gprofession_selected = gprofession_selected;
         register_phase_three.ggender = ggender;
         register_phase_three.gcadd1 = gcadd1;
         register_phase_three.gcadd2 = gcadd2;
         register_phase_three.gcadd3 = gcadd3;
         register_phase_three.gczip = gczip;
         register_phase_three.gcphone = gcphone;
         register_phase_three.gcmobile = gcmobile;
         register_phase_three.gcmail = gcmail;
         register_phase_three.goadd1 = goadd1;
         register_phase_three.goadd2 = goadd2;
         register_phase_three.goadd3 = goadd3;
         register_phase_three.gozip = gozip;
         register_phase_three.gophone = gophone;
         register_phase_three.gomobile = gomobile;
         register_phase_three.gomail = gomail;
         register_phase_three.gpadd1 = gpadd1;
         register_phase_three.gpadd2 = gpadd2;
         register_phase_three.gpadd3 = gpadd3;
         register_phase_three.gpzip = gpzip;
         register_phase_three.gpphone = gpphone;
         register_phase_three.gpmobile = gpmobile;
         register_phase_three.gpmail = gpmail;
         var status_flag = 0;
         var update_info = 0;
         var sibling_student_id = $('#sibling_student_data_id').val();
         if (sibling_student_id == "0") {
             update_info = 0;
         } else {
             update_info = 1;
         }
         var is_parent_update = $('#is_parent_update').val();
         var father_id = $('#father_id').val();
         var mother_id = $('#mother_id').val();
         var guardian_id = $('#guardian_id').val();


         var studentdata = JSON.stringify(register_phase_three);
         if (is_parent_update == 0) {
             var ops_url = baseurl + 'registration/save-student-parent-profile';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "load": 1,
                     "update_profile": update_info,
                     "sibling_student_id": sibling_student_id,
                     "studentid": studentid,
                     "studentdata": studentdata,
                     "who_worked": who_worked,
                     "emp_id": emp_id,
                     "emp_inst_id": emp_inst_id
                 },
                 success: function(result) {
                     var data = JSON.parse(result);
                     if (data.status == 1) {
                         $('#is_parent_update').val('1');
                         $('#father_id').val(data.father_id);
                         $('#mother_id').val(data.mother_id);
                         $('#guardian_id').val(data.guardian_id);
                         status_flag = 1
                     } else {
                         status_flag = 0;
                     }
                 },
                 error: function() {
                     status_flag = 0;
                 }
             });
             return status_flag;
         }
         if (is_parent_update == 1) {
             var ops_url = baseurl + 'registration/edit-student-parent-profile';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "load": 1,
                     "update_profile": update_info,
                     "sibling_student_id": sibling_student_id,
                     "studentid": studentid,
                     "studentdata": studentdata,
                     "father_id": father_id,
                     "mother_id": mother_id,
                     "guardian_id": guardian_id
                 },
                 success: function(result) {
                     var data = JSON.parse(result);
                     if (data.status == 1) {
                         status_flag = 1
                     } else {
                         status_flag = 0;
                     }
                 },
                 error: function() {
                     status_flag = 0;
                 }
             });
         }
         return status_flag;
     }

     function save_academic_details() {
         var studentid = $('#studentid').val();
         var admission_no = $('input[name=admission_no]').val();
         var admission_date = moment($("#admission_date").datepicker("getDate")).format('YYYY-MM-DD');
         var acd_year_id = $('#academic_year :selected').val();
         var stream = $('#stream_id :selected').val();
         var course_id = $('#class_details :selected').val();
         var course_master_id = $('#class_details :selected').data('masterid');
         var birth_country = $('#birth_country').val();
         var birth_place = $('#birth_place').val();
         var idmark1 = $('#id_mark1').val();
         var idmark2 = $('#id_mark_2').val();
         if (admission_date.length == 0 || admission_date == 'Invalid date') {
             swal('', 'Check admission date', 'info');
             return false;
         }

         var register_phase_two = new Object();
         register_phase_two.admission_date = admission_date;
         register_phase_two.acd_year_id = acd_year_id;
         register_phase_two.stream = stream;
         register_phase_two.course_id = course_id;
         register_phase_two.course_master_id = course_master_id;
         register_phase_two.birth_country = birth_country;
         register_phase_two.birth_place = birth_place;
         register_phase_two.idmark1 = idmark1;
         register_phase_two.idmark2 = idmark2;
         var update_info = 0;
         var status_flag = 0;
         if ($.trim(admission_no).length > 0 && admission_no != 'Auto' && admission_no != 'NA') {
             update_info = 1;
             register_phase_two.admission_no = admission_no;
         }
         var studentdata = JSON.stringify(register_phase_two);
         var ops_url = baseurl + 'registration/save-student-academic-profile';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "update_profile": update_info,
                 "studentid": studentid,
                 "studentdata": studentdata
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     $('input[name=admission_no]').val(data.admission_no);
                     status_flag = 1;
                 } else {
                     status_flag = 0;
                 }
             },
             error: function() {
                 status_flag = 0;
             }
         });
         return status_flag;
     }

     function save_personal_details() {
         var firstname = $('#firstname').val();
         var middlename = $('#middlename').val();
         var lastname = $('#lastname').val();
         var gender = $('#gender').val();
         var country_selected = $('#country_select').val();
         var nationality = $('#nationality').val();
         var state_selected = $('#state_select').val();
         var district_selected = $('#district_select').val();
         var dob = moment($("#dob_date").datepicker("getDate")).format('YYYY-MM-DD');
         var age = $('#age').attr('data-val');
         var religion_select = $('#religion_select').val();
         var caste_select = $('#caste_select').val();
         var community_select = $('#community_select').val();
         var mother_tongue = $('#mother_tongue').val();
         var language_select = $('#language_select').val();
         var unique_identity = $('#unique_identity').val();
         var register_phase_one = new Object();
         register_phase_one.firstname = firstname;
         register_phase_one.middlename = middlename;
         register_phase_one.lastname = lastname;
         register_phase_one.gender = gender;
         register_phase_one.country_selected = country_selected;
         register_phase_one.nationality = nationality;
         register_phase_one.state_selected = state_selected;
         register_phase_one.district_selected = district_selected;
         register_phase_one.dob = dob;
         register_phase_one.age = age;
         register_phase_one.religion_select = religion_select;
         register_phase_one.caste_select = caste_select;
         register_phase_one.community_select = community_select;
         register_phase_one.mother_tongue = mother_tongue;
         var known_lang = new Object();
         known_lang.language_select = language_select;
         var language_data = JSON.stringify(known_lang);
         register_phase_one.unique_identity = unique_identity;
         var flag111 = 0;
         var update_profile = 0;
         var student_id = $('#studentid').val();
         if (student_id > 0) {
             update_profile = 1;
         }
         var student_image = $('#profile_image_data').val();
         var studentdata = JSON.stringify(register_phase_one);
         var ops_url = baseurl + 'registration/save-student-personal-profile';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "update_profile": update_profile,
                 "studentid": student_id,
                 "studentdata": studentdata,
                 "student_image": student_image,
                 "language_data": language_data
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     $('#studentid').val(data.studentid);
                     flag111 = 1
                 } else {
                     flag111 = 0;
                 }
             },
             error: function() {
                 console.log(register_phase_one);
                 flag111 = 0;
             }
         });
         return flag111;
     }

     function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
                 $('#profile_image').attr('src', e.target.result);
                 $('#profile_image_data').val(e.target.result);
             };
             reader.readAsDataURL(input.files[0]);
         }
     }

     function show_search() {
         $('#search_student').slideDown("slow");
     }

     function hide_search() {
         $('#search_student').slideUp("slow");
     }


     function hide_search1() {
         $('#search_parent').slideUp("slow");
     }


     function new_search() {
         var ops_url = baseurl + 'registration/search-parent';
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
                     $('#add_type').hide();
                     $('html, body').animate({
                         scrollTop: $("body").offset().top
                     }, 1000);

                 } else {
                     alert('No data loaded');
                 }
             }
         });
     }

     function caste_change() {
         //        var community_id = $("#caste_select :selected").data("communityselect");
         //        $('#community_select').val(community_id);
         //        $('#community_select').trigger('change');
     }

     $("#language_select").select2({
         width: "100%"
     });

     $(document).ready(function() {
         $('#unique_identity').focus();
         age_changer();
         $.validator.addMethod(
             "regex",
             function(value, element, regexp) {
                 var re = new RegExp(regexp);
                 return this.optional(element) || re.test(value);
             },
             "Please check your input."
         );

         $('input, select').change(function() {
             $(this).focusout();
         });
         $('#language_select').siblings('.select2').click(function() {
             $('#language_select').select2('open');
         });
         /* Author :docme
          * Date 07/10/2017
          * Purpose : Address fill when same as checkbox is selected */

         $('#father_check').click(function() {

             if ($("#father_check").prop("checked") == true) {
                 var fcadd1 = $('#fadd1').val();
                 var fcadd2 = $('#fadd2').val();
                 var fcadd3 = $('#fadd3').val();
                 var fczip = $('#fzip').val();
                 var fcphone = $('#fphone').val();
                 var fcmobile = $('#fmobile').val();
                 var fcmail = $('#fmail').val();
                 $("#fcadd1").val(fcadd1).focusout();
                 $("#fcadd2").val(fcadd2).focusout();
                 $("#fcadd3").val(fcadd3).focusout();
                 $("#fczip").val(fczip).focusout();
                 $("#fcphone").val(fcphone).focusout();
                 $("#fcmobile").val(fcmobile).focusout();
                 $("#fcmail").val(fcmail).focusout();
             } else if ($("#father_check").prop("checked") == false) {
                 $("#fcadd1").val("").focusout();
                 $("#fcadd2").val("").focusout();
                 $("#fcadd3").val("").focusout();
                 $("#fczip").val("").focusout();
                 $("#fcphone").val("").focusout();
                 $("#fcmobile").val("").focusout();
                 $("#fcmail").val("").focusout();
             }
             $("#fcmobile").focusout();
         });
         $('#mthr_com_check').click(function() {
             if ($("#mthr_com_check").prop("checked") == true) {
                 var mcadd1 = $('#fadd1').val();
                 var mcadd2 = $('#fadd2').val();
                 var mcadd3 = $('#fadd3').val();
                 var mczip = $('#fzip').val();
                 var mcphone = $('#fphone').val();
                 $("#madd1").val(mcadd1).focusout();
                 $("#madd2").val(mcadd2).focusout();
                 $("#madd3").val(mcadd3).focusout();
                 $("#mzip").val(mczip).focusout();
                 $("#mphone").val(mcphone).focusout();
             } else if ($("#mthr_com_check").prop("checked") == false) {
                 $("#madd1").val("").focusout();
                 $("#madd2").val("").focusout();
                 $("#madd3").val("").focusout();
                 $("#mzip").val("").focusout();
                 $("#mphone").val("").focusout();
             }
         });
         $('#mother_check').click(function() {
             if ($("#mother_check").prop("checked") == true) {
                 var mcadd1 = $('#madd1').val();
                 var mcadd2 = $('#madd2').val();
                 var mcadd3 = $('#madd3').val();
                 var mczip = $('#mzip').val();
                 var mcphone = $('#mphone').val();
                 var mcmobile = $('#mmobile').val();
                 var mcmail = $('#mmail').val();
                 $("#mcadd1").val(mcadd1).focusout();
                 $("#mcadd2").val(mcadd2).focusout();
                 $("#mcadd3").val(mcadd3).focusout();
                 $("#mczip").val(mczip).focusout();
                 $("#mcphone").val(mcphone).focusout();
                 $("#mcmobile").val(mcmobile).focusout();
                 $("#mcmail").val(mcmail).focusout();
             } else if ($("#mother_check").prop("checked") == false) {
                 $("#mcadd1").val("").focusout();
                 $("#mcadd2").val("").focusout();
                 $("#mcadd3").val("").focusout();
                 $("#mczip").val("").focusout();
                 $("#mcphone").val("").focusout();
                 $("#mcmobile").val("").focusout();
                 $("#mcmail").val("").focusout();
             }
             $("#mcmobile").focusout();
         });
         $('#guardian_check').click(function() {
             if ($("#guardian_check").prop("checked") == true) {
                 var gcadd1 = $('#gadd1').val();
                 var gcadd2 = $('#gadd2').val();
                 var gcadd3 = $('#gadd3').val();
                 var gczip = $('#gzip').val();
                 var gcphone = $('#gphone').val();
                 var gcmobile = $('#gmobile').val();
                 var gcmail = $('#gmail').val();
                 $("#gcadd1").val(gcadd1).focusout();
                 $("#gcadd2").val(gcadd2).focusout();
                 $("#gcadd3").val(gcadd3).focusout();
                 $("#gczip").val(gczip).focusout();
                 $("#gcphone").val(gcphone).focusout();
                 $("#gcmobile").val(gcmobile).focusout();
                 $("#gcmail").val(gcmail).focusout();
             } else if ($("#guardian_check").prop("checked") == false) {
                 $("#gcadd1").val("").focusout();
                 $("#gcadd2").val("").focusout();
                 $("#gcadd3").val("").focusout();
                 $("#gczip").val("").focusout();
                 $("#gcphone").val("").focusout();
                 $("#gcmobile").val("").focusout();
                 $("#gcmail").val("").focusout();
             }
         });

         $(".select2-selection").on("focus", function() {
             $(this).parent().parent().prev().select2("open");
         });
     });
 </script>