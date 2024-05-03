 <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
 <link href="<?php echo base_url('assets/theme/css/plugins/steps/step.styles.css'); ?>" rel="stylesheet">
 <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
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
 <style>
     .wizard>.content>.body label.error {
         margin-left: 0px;
     }
 </style>
 <style>
     .input-group-prepend,
     .input-group-append {
         display: flex !important;
     }

     .btn {
         position: relative;
         z-index: 2;
     }
 </style>
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
                 <div class="ibox-content" id="registration_loader">
                     <div class="sk-spinner sk-spinner-wave">
                         <div class="sk-rect1"></div>
                         <div class="sk-rect2"></div>
                         <div class="sk-rect3"></div>
                         <div class="sk-rect4"></div>
                         <div class="sk-rect5"></div>
                     </div>
                     <div class="row">

                         <div class="col-lg-12">
                             <?php
                                if ($this->session->userdata('Age_Limit') != '0') {
                                ?>
                                 <input type="hidden" id="agelimit" value="<?php echo $this->session->userdata('Age_Limit') != '' ? date('d-m-Y', strtotime($this->session->userdata('Age_Limit'))) : date('d-m-Y') ?>" />
                             <?php
                                } else {
                                ?>
                                 <input type="hidden" id="agelimit" value="<?php echo date('d-m-Y') ?>" />
                             <?php
                                }
                                ?>
                             <div id="curd-content" style="display: none;"></div>
                         </div>
                         <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 wizard-big" id="wizard">
                             <h1>PERSONAL DETAILS</h1>
                             <?php echo $this->load->view('reg_partial_personal_details') ?>

                             <h1>ACADEMIC AND REGISTRATION</h1>
                             <?php echo $this->load->view('reg_partial_academic_details') ?>

                             <h1>PARENT</h1>
                             <?php echo $this->load->view('reg_partial_parent_details') ?>

                             <h1>OTHER DETAILS</h1>
                             <?php echo $this->load->view('reg_partial_other_details') ?>

                             <h1>FACILITIES</h1>
                             <?php echo $this->load->view('reg_partial_facilities_details') ?>
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
 <input type="hidden" name="temp_stud_id" id="temp_stud_id" value="-1" />
 <script>
     function getEmployees(ele) {
         var who_worked = $(ele).val();
         var inst_id = $('#emp_inst_id').val();
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
                 "gender": who_worked
                 // "fname": fname,
                 //"mname": mname
             },
             success: function(result) {
                 $('#emp_id').empty().trigger("change");
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var state_data = data.data;
                     $('#emp_id').append("<option value='-1'>Select</option>");
                     $.each(state_data, function(i, v) {
                         //$('#emp_id').append("<option value='-1'>None</option>");
                         $('#emp_id').append("<option value='" + v.Emp_id + "' >" + v.Emp_code + " - " + v.Emp_Name + "</option>");
                     });
                     $('#emp_id').trigger('change');
                 } else {
                     $('#emp_id').empty().trigger("change");
                     $('#emp_id').append("<option value='-1' selected >Select</option>");
                     $('#emp_id').trigger('change');
                 }
             }
         });
     }

     function set_tep_stud_values(values) {
         var data = JSON.parse(values);
         console.log(data);
         $.each(data, function(i, v) {

             if (parseInt(v.country) != 2) {
                 $('#check_yes').iCheck('uncheck')
                 $('#check_no').iCheck('check')
                 //  $('#check_yes').prop('disabled', true);
                 //  $('#check_no').prop('disabled', true);
                 $('#uuid_unit_limit_name').val('Unique ID');
                 $('#country_select').prop('disabled', false);
                 $('#country_select').val(-1);
                 $("#country_select option[value='2']").prop('disabled', true);
                 $('.required_by_citizen').hide();
                 $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').removeClass('digits');
                 $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').addClass('alphanumeric');
                 $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').attr('placeholder', 'Enter ' + $('#uuid_unit_limit_name').val());
                 $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').attr('maxlength', 16);
                 $('.unique_identity_label').html($('#uuid_unit_limit_name').val());
             }

             $('#firstname').val(v.fname);
             $('#middlename').val(v.mname);
             $('#lastname').val(v.lname);
             $('#gender').val(v.gender).trigger('change');
             $('#country_select').val(v.country).trigger('change');
             $('#nationality').val(v.Nationality);
             $('#state_select').val(v.state).trigger('change');
             $("#district_select").val(v.district);
             $('#district_select').trigger('change');
             $('#blood_group').val(v.blood_group).trigger('change');
             $('#dob_date').datepicker("setDate", moment(v.dob, 'YYYY-MM-DD').format('DD-MM-YYYY')).prop('readonly', true);
             $('#religion_select').val(v.religion).trigger('change');
             $('#caste_select').val(v.caste).trigger('change');
             $('#community_select').val(v.community).trigger('change');
             $('#mother_tongue').val(v.motherTongue).trigger('change');
             $('#language_select').val(v.knownLang.split(',')).trigger('change');
             if (v.emirate_Id == 0) {
                 $('#unique_identity').val('');
             } else {
                 $('#unique_identity').val(v.emirate_Id);
             }

             $('#temp_stud_id').val(v.TempReg_ID);
             $("#admission_date").val(moment(v.applicationDate, 'YYYY-MM-DD').format('DD-MM-YYYY'));
             $('#academic_year').val(v.Acd_Yr).trigger('change');
             $('#stream_id').val(v.stream).trigger('change');
             $('#class_details').val(v.class).trigger('change');
             $('#birth_country').val(v.birthCountry).trigger('change');
             $('#birth_place').val(v.birthPlace);
             if (v.admn_type == 'Sibling') {
                 $('#panelclass').hide();
                 $('#is_parent_update').val(1);
                 $('#sibling_student_data_id').val(v.sib_student_id);
                 $('#father_id').val(v.Father_Id);
                 $('#mother_id').val(v.Mother_Id);
                 $('#fname').val(v.Father);
                 $('#fname').attr('readonly', true);
                 $('#f_unique_identity').val(v.f_adhar);
                 if (v.f_adhar != '' && v.f_adhar != null) {
                     $('#f_unique_identity').attr('readonly', true);
                 }
                 $('#fprofession').val(v.F_profession_id).trigger('change');
                 if (v.F_profession_id != '' && v.F_profession_id != null) {
                     $("#fprofession").prop('disabled', true);
                 }

                 $('#fadd1').val(v.F_C_address1);
                 if (v.F_C_address1 != null)
                     $('#fadd1').prop('readonly', true);

                 $('#fadd2').val(v.F_C_address2);
                 if (v.F_C_address2 != null)
                     $('#fadd2').prop('readonly', true);

                 $('#fadd3').val(v.F_C_address3);
                 if (v.F_C_address3 != null)
                     $('#fadd3').prop('readonly', true);

                 $('#fzip').val(v.F_C_ZIP_CODE);
                 if (v.F_C_ZIP_CODE != 0)
                     $('#fzip').prop('readonly', true);

                 $('#fphone').val(v.F_C_Phone1);
                 if (v.F_C_Phone1 != null)
                     $('#fphone').prop('readonly', true);

                 $('#fmobile').val(v.F_C_Phone3);
                 if (v.F_C_Phone3 != null)
                     $('#fmobile').prop('readonly', true);

                 $('#fmail').val(v.Email);
                 if (v.Email != null)
                     $('#fmail').prop('readonly', true);


                 $('#foadd1').val(v.F_O_address1);
                 if (v.F_O_address1 != null)
                     $('#foadd1').prop('readonly', true);

                 $('#foadd2').val(v.F_O_address2);
                 if (v.F_O_address2 != null)
                     $('#foadd2').prop('readonly', true);

                 $('#foadd3').val(v.F_O_address3);
                 if (v.F_O_address3 != null)
                     $('#foadd3').prop('readonly', true);

                 $('#fozip').val(v.F_O_ZIP_CODE);
                 if (v.F_O_ZIP_CODE != 0)
                     $('#fozip').prop('readonly', true);

                 $('#fophone').val(v.F_O_Phone1);
                 if (v.F_O_Phone1 != null)
                     $('#fophone').prop('readonly', true);

                 $('#fomobile').val(v.F_O_Phone3);
                 if (v.F_O_Phone3 != null)
                     $('#fomobile').prop('readonly', true);

                 $('#fomail').val(v.OEmail);
                 if (v.OEmail != null)
                     $('#fomail').prop('readonly', true);


                 $('#fcadd1').val(v.F_H_address1);
                 if (v.F_H_address1 != null)
                     $('#fcadd1').prop('readonly', true);

                 $('#fcadd2').val(v.F_H_address2);
                 if (v.F_H_address2 != null)
                     $('#fcadd2').prop('readonly', true);

                 $('#fcadd3').val(v.F_H_address3);
                 if (v.F_H_address3 != null)
                     $('#fcadd3').prop('readonly', true);

                 $('#fczip').val(v.F_H_ZIP_CODE);
                 if (v.F_H_ZIP_CODE != 0)
                     $('#fczip').prop('readonly', true);

                 $('#fcphone').val(v.F_H_Phone1);
                 if (v.F_H_Phone1 != null)
                     $('#fcphone').prop('readonly', true);

                 $('#fcmobile').val(v.F_H_Phone3);
                 if (v.F_H_Phone3 != null)
                     $('#fcmobile').prop('readonly', true);

                 $('#fcmail').val(v.HEmail);
                 if (v.HEmail != null)
                     $('#fcmail').prop('readonly', true);



                 $('#mname').val(v.Mother);
                 if (v.Mother != null)
                     $('#mname').prop('readonly', true);

                 $('#m_unique_identity').val(v.m_adhar);
                 if (v.m_adhar != null)
                     $('#m_unique_identity').prop('readonly', true);


                 $("#mprofession").select2("val", v.M_profession_id);
                 $('#mprofession').trigger('change');
                 if (v.M_profession_id != null)
                     $('#mprofession').attr('disabled', true);

                 $('#madd1').val(v.M_C_address1);
                 if (v.M_C_address1 != null)
                     $('#madd1').prop('readonly', true);

                 $('#madd2').val(v.M_C_address2);
                 if (v.M_C_address2 != null)
                     $('#madd2').prop('readonly', true);

                 $('#madd3').val(v.M_C_address3);
                 if (v.M_C_address3 != null)
                     $('#madd3').prop('readonly', true);

                 $('#mzip').val(v.M_C_ZIP_CODE);
                 if (v.M_C_ZIP_CODE != 0)
                     $('#mzip').prop('readonly', true);

                 $('#mphone').val(v.M_C_Phone1);
                 if (v.M_C_Phone1 != null)
                     $('#mphone').prop('readonly', true);

                 $('#mmobile').val(v.M_C_Phone3);
                 if (v.M_C_Phone3 != null)
                     $('#mmobile').prop('readonly', true);

                 $('#mmail').val(v.M_C_Email);
                 if (v.M_C_Email != null)
                     $('#mmail').prop('readonly', true);


                 $('#moadd1').val(v.M_O_address1);
                 if (v.M_O_address1 != null)
                     $('#moadd1').prop('readonly', true);

                 $('#moadd2').val(v.M_O_address2);
                 if (v.M_O_address2 != null)
                     $('#moadd2').prop('readonly', true);

                 $('#moadd3').val(v.M_O_address3);
                 if (v.M_O_address3 != null)
                     $('#moadd3').prop('readonly', true);

                 $('#mozip').val(v.M_O_ZIP_CODE);
                 if (v.M_O_ZIP_CODE != 0)
                     $('#mozip').prop('readonly', true);

                 $('#mophone').val(v.M_O_Phone1);
                 if (v.M_O_Phone1 != null)
                     $('#mophone').prop('readonly', true);

                 $('#momobile').val(v.M_O_Phone3);
                 if (v.M_O_Phone3 != null)
                     $('#momobile').prop('readonly', true);

                 $('#momail').val(v.M_O_Email);
                 if (v.M_O_Email != null)
                     $('#momail').prop('readonly', true);



                 $('#mcadd1').val(v.M_H_address1);
                 if (v.M_H_address1 != null)
                     $('#mcadd1').prop('readonly', true);

                 $('#mcadd2').val(v.M_H_address2);
                 if (v.M_H_address2 != null)
                     $('#mcadd2').prop('readonly', true);

                 $('#mcadd3').val(v.M_H_address3);
                 if (v.M_H_address3 != null)
                     $('#mcadd3').prop('readonly', true);

                 $('#mczip').val(v.M_H_ZIP_CODE);
                 if (v.M_H_ZIP_CODE != 0)
                     $('#mczip').prop('readonly', true);

                 $('#mcphone').val(v.M_H_Phone1);
                 if (v.F_C_Phone3 != null)
                     $('#mcphone').prop('readonly', true);

                 $('#mcmobile').val(v.M_H_Phone3);
                 if (v.M_H_Phone3 != null)
                     $('#mcmobile').prop('readonly', true);

                 $('#mcmail').val(v.M_H_Email);
                 if (v.M_H_Email != null)
                     $('#mcmail').prop('readonly', true);


                 var guardId = 0;
                 $('#guardian_id').val(v.guardian_id);
                 $('#gname').val(v.Guardian);
                 if (v.Guardian != null)
                     $('#gname').prop('readonly', true);

                 $('#g_unique_identity').val(v.g_adhar);
                 if (v.g_adhar != null)
                     $('#g_unique_identity').prop('readonly', true);

                 $("#ggender").select2("val", v.Gender);
                 $('#ggender').trigger('change');
                 if (v.Gender != null)
                     $('#ggender option:not(:selected)').attr('disabled', true);


                 if (v.G_profession_id != null) {
                     $("#gprofession").select2("val", v.G_profession_id);
                     $('#gprofession').trigger('change');
                     $('#gprofession').attr('disabled', true);
                     $("#gprofession option[value='-1']").remove();
                     $('#gprofession option:not(:selected)').attr('disabled', true);
                 }


                 $('#gadd1').val(v.G_C_address1);
                 if (v.G_C_address1 != null)
                     $('#gadd1').prop('readonly', true);

                 $('#gadd2').val(v.G_C_address2);
                 if (v.G_C_address2 != null)
                     $('#gadd2').prop('readonly', true);

                 $('#gadd3').val(v.G_C_address3);
                 if (v.G_C_address3 != null)
                     $('#gadd3').prop('readonly', true);

                 $('#gzip').val(v.G_C_ZIP_CODE);
                 if (v.G_C_ZIP_CODE == 0 || v.G_C_ZIP_CODE == null)
                     $('#gzip').prop('readonly', false);
                 else
                     $('#gzip').prop('readonly', false);

                 $('#gphone').val(v.G_C_Phone1);
                 if (v.G_C_Phone1 != null)
                     $('#gphone').prop('readonly', true);

                 $('#gmobile').val(v.G_C_Phone3);
                 if (v.G_C_Phone3 != null)
                     $('#gmobile').prop('readonly', true);

                 $('#gmail').val(v.G_C_Email);
                 if (v.G_C_Email != null)
                     $('#gmail').prop('readonly', true);


                 $('#goadd1').val(v.G_O_address1);
                 if (v.G_O_address1 != null)
                     $('#goadd1').prop('readonly', true);

                 $('#goadd2').val(v.G_O_address2);
                 if (v.G_O_address2 != null)
                     $('#goadd2').prop('readonly', true);

                 $('#goadd3').val(v.G_O_address3);
                 if (v.G_O_address3 != null)
                     $('#goadd3').prop('readonly', true);

                 $('#gozip').val(v.G_O_ZIP_CODE);
                 if (v.G_O_ZIP_CODE == 0 || v.G_O_ZIP_CODE == null)
                     $('#gozip').prop('readonly', false);
                 else
                     $('#gozip').prop('readonly', true);

                 $('#gophone').val(v.G_O_Phone1);
                 if (v.G_O_Phone1 != null)
                     $('#gophone').prop('readonly', true);

                 $('#gomobile').val(v.G_O_Phone1);
                 if (v.G_O_Phone1 != null)
                     $('#gomobile').prop('readonly', true);

                 $('#gomail').val(v.G_O_Email);
                 if (v.G_O_Email != null)
                     $('#gomail').prop('readonly', true);



                 $('#gcadd1').val(v.G_H_address1);
                 if (v.G_H_address1 != null)
                     $('#gcadd1').prop('readonly', true);

                 $('#gcadd2').val(v.G_H_address2);
                 if (v.G_H_address2 != null)
                     $('#gcadd2').prop('readonly', true);

                 $('#gcadd3').val(v.G_H_address3);
                 if (v.G_H_address3 != null)
                     $('#gcadd3').prop('readonly', true);


                 $('#gczip').val(v.G_H_ZIP_CODE);
                 if (v.G_H_ZIP_CODE == 0 || v.G_H_ZIP_CODE == null)
                     $('#gczip').prop('readonly', false);
                 else
                     $('#gczip').prop('readonly', true);


                 $('#gcphone').val(v.G_H_Phone1);
                 if (v.G_H_Phone1 != null)
                     $('#gcphone').prop('readonly', true);


                 $('#gcmobile').val(v.G_H_Phone3);
                 if (v.G_H_Phone3 != null)
                     $('#gcmobile').prop('readonly', true);


                 $('#gcmail').val(v.G_H_Email);
                 if (v.G_H_Email != null)
                     $('#gcmail').prop('readonly', true);


             } else if (v.admn_type == 'Staff') {
                 var Empgender = v.Empgender;
                 var emp_id = v.Emp_id;
                 var emp_inst_id = v.emp_inst_id;
                 empChange(Empgender, emp_id, emp_inst_id);
                 $('#staff_con').prop('checked', true);
                 $('#staff_con').prop('disabled', true);

                 if (v.Father_Id != '' && v.Mother_Id != '' && v.Father_Id != null && v.Mother_Id != null) {
                     $('#is_parent_update').val(1);
                     $('#father_id').val(v.Father_Id);
                     $('#mother_id').val(v.Mother_Id);
                     $('#fname').val(v.Parent_Name1);
                     $('#fprofession').val(v.Profession1).trigger('change');
                     $('#f_unique_identity').val(v.aadhar1);
                     $('#mname').val(v.Parent_Name2);
                     $('#mprofession').val(v.Profession2).trigger('change');
                     $('#m_unique_identity').val(v.aadhar2);
                     if (typeof(v.F_Address1) != "undefined") { //female
                         //communication address
                         $('#madd1').val(v.L_Address1);
                         $('#madd2').val(v.L_Address2);
                         $('#madd3').val(v.L_Address3);
                         $('#mzip').val(v.L_zip);
                         $('#mphone').val(v.L_phone);
                         $('#mmobile').val(v.L_mobile);
                         $('#mmail').val(v.L_mail);
                         //permanent address
                         $('#mcadd1').val(v.O_Address1);
                         $('#mcadd2').val(v.O_Address2);
                         $('#mcadd3').val(v.O_Address3);
                         $('#mczip').val(v.O_zip);
                         $('#mcphone').val(v.O_phone);
                         $('#mcmobile').val(v.O_mobile);
                         $('#mcmail').val(v.O_mail);

                         if (v.Address_Type == 1) {
                             //communication address
                             $('#fadd1').val(v.F_Address1);
                             $('#fadd2').val(v.F_Address2);
                             $('#fadd3').val(v.F_Address3);
                             $('#fzip').val(v.F_PO_No);
                             $('#fphone').val(v.F_Phone1);
                             $('#fmobile').val(v.F_Phone3);
                             $('#fmail').val(v.F_EMAIL);
                         } else if (v.Address_Type == 3) {
                             //permanent address
                             $('#fcadd1').val(v.F_Address1);
                             $('#fcadd2').val(v.F_Address2);
                             $('#fcadd3').val(v.F_Address3);
                             $('#fczip').val(v.F_PO_No);
                             $('#fcphone').val(v.F_Phone1);
                             $('#fcmobile').val(v.F_Phone3);
                             $('#fcmail').val(v.F_EMAIL);
                         } else {
                             //office address
                             $('#foadd1').val(v.F_Address1);
                             $('#foadd2').val(v.F_Address2);
                             $('#foadd3').val(v.F_Address3);
                             $('#fozip').val(v.F_PO_No);
                             $('#fophone').val(v.F_Phone1);
                             $('#fomobile').val(v.F_Phone3);
                             $('#fomail').val(v.F_EMAIL);

                         }
                     } else if (typeof(v.M_Address1) != "undefined") { //male
                         $('#fadd1').val(v.L_Address1);
                         $('#fadd2').val(v.L_Address2);
                         $('#fadd3').val(v.L_Address3);
                         $('#fzip').val(v.L_zip);
                         $('#fphone').val(v.L_phone);
                         $('#fmobile').val(v.L_mobile);
                         $('#fmail').val(v.L_mail);
                         //permanent address
                         $('#fcadd1').val(v.O_Address1);
                         $('#fcadd2').val(v.O_Address2);
                         $('#fcadd3').val(v.O_Address3);
                         $('#fczip').val(v.O_zip);
                         $('#fcphone').val(v.O_phone);
                         $('#fcmobile').val(v.O_mobile);
                         $('#fcmail').val(v.O_mail);

                         if (v.Address_Type == 1) {
                             //communication address
                             $('#madd1').val(v.M_Address1);
                             $('#madd2').val(v.M_Address2);
                             $('#madd3').val(v.M_Address3);
                             $('#mzip').val(v.M_PO_No);
                             $('#mphone').val(v.M_Phone1);
                             $('#mmobile').val(v.M_Phone3);
                             $('#mmail').val(v.M_EMAIL);
                         } else if (v.Address_Type == 3) {
                             //permanent address
                             $('#mcadd1').val(v.M_Address1);
                             $('#mcadd2').val(v.M_Address2);
                             $('#mcadd3').val(v.M_Address3);
                             $('#mczip').val(v.M_PO_No);
                             $('#mcphone').val(v.M_Phone1);
                             $('#mcmobile').val(v.M_Phone3);
                             $('#mcmail').val(v.M_EMAIL);
                         } else {
                             //office address
                             $('#moadd1').val(v.M_Address1);
                             $('#moadd2').val(v.M_Address2);
                             $('#moadd3').val(v.M_Address3);
                             $('#mozip').val(v.M_PO_No);
                             $('#mophone').val(v.M_Phone1);
                             $('#momobile').val(v.M_Phone3);
                             $('#momail').val(v.M_EMAIL);

                         }

                     }
                 } else {
                     empChange(Empgender, emp_id, emp_inst_id);
                     if (v.parentRelation == 'F') {
                         $('#fname').val(v.Parent_Name1);
                         $('#fprofession').val(v.Profession1).trigger('change');
                         $('#f_unique_identity').val(v.aadhar1);
                         //communication address
                         $('#fadd1').val(v.L_Address1);
                         $('#fadd2').val(v.L_Address2);
                         $('#fadd3').val(v.L_Address3);
                         $('#fzip').val(v.L_zip);
                         $('#fphone').val(v.L_phone);
                         $('#fmobile').val(v.L_mobile);
                         $('#fmail').val(v.L_mail);
                         //permanent address
                         $('#fcadd1').val(v.O_Address1);
                         $('#fcadd2').val(v.O_Address2);
                         $('#fcadd3').val(v.O_Address3);
                         $('#fczip').val(v.O_zip);
                         $('#fcphone').val(v.O_phone);
                         $('#fcmobile').val(v.O_mobile);
                         $('#fcmail').val(v.O_mail);
                     }
                     if (v.parentRelation == 'M') {
                         $('#mname').val(v.Parent_Name1);
                         $('#mprofession').val(v.Profession1).trigger('change');
                         $('#m_unique_identity').val(v.aadhar1);
                         //communication address
                         $('#madd1').val(v.L_Address1);
                         $('#madd2').val(v.L_Address2);
                         $('#madd3').val(v.L_Address3);
                         $('#mzip').val(v.L_zip);
                         $('#mphone').val(v.L_phone);
                         $('#mmobile').val(v.L_mobile);
                         $('#mmail').val(v.L_mail);
                         //permanent address
                         $('#mcadd1').val(v.O_Address1);
                         $('#mcadd2').val(v.O_Address2);
                         $('#mcadd3').val(v.O_Address3);
                         $('#mczip').val(v.O_zip);
                         $('#mcphone').val(v.O_phone);
                         $('#mcmobile').val(v.O_mobile);
                         $('#mcmail').val(v.O_mail);
                     }
                     if (v.parentRelation == 'G') {
                         $('#gname').val(v.Parent_Name1);
                         $('#gprofession').val(v.Profession).trigger('change');
                         $('#g_unique_identity').val(v.aadhar1);
                         //communication address
                         $('#gadd1').val(v.L_Address1);
                         $('#gadd2').val(v.L_Address2);
                         $('#gadd3').val(v.L_Address3);
                         $('#gzip').val(v.L_zip);
                         $('#gphone').val(v.L_phone);
                         $('#gmobile').val(v.L_mobile);
                         $('#gmail').val(v.L_mail);
                         //permanent address
                         $('#gcadd1').val(v.O_Address1);
                         $('#gcadd2').val(v.O_Address2);
                         $('#gcadd3').val(v.O_Address3);
                         $('#gczip').val(v.O_zip);
                         $('#gcphone').val(v.O_phone);
                         $('#gcmobile').val(v.O_mobile);
                         $('#gcmail').val(v.O_mail);
                     }
                 }


             } else {
                 if (v.parentRelation == 'F') {
                     $('#fname').val(v.Parent_Name1);
                     $('#fprofession').val(v.Profession).trigger('change');
                     //communication address
                     $('#fadd1').val(v.L_Address1);
                     $('#fadd2').val(v.L_Address2);
                     $('#fadd3').val(v.L_Address3);
                     $('#fzip').val(v.L_zip);
                     $('#fphone').val(v.L_phone);
                     $('#fmobile').val(v.L_mobile);
                     $('#fmail').val(v.L_mail);
                     //permanent address
                     $('#fcadd1').val(v.O_Address1);
                     $('#fcadd2').val(v.O_Address2);
                     $('#fcadd3').val(v.O_Address3);
                     $('#fczip').val(v.O_zip);
                     $('#fcphone').val(v.O_phone);
                     $('#fcmobile').val(v.O_mobile);
                     $('#fcmail').val(v.O_mail);
                     //office address
                     $('#foadd1').val(v.Of_Address1);
                     $('#foadd2').val(v.Of_Address2);
                     $('#foadd3').val(v.Of_Address3);
                     $('#fozip').val(v.Of_zip);
                     $('#fophone').val(v.Of_phone);
                     $('#fomobile').val(v.Of_mobile);
                     $('#fomail').val(v.Of_mail);
                 }
                 if (v.parentRelation == 'M') {
                     $('#mname').val(v.Parent_Name1);
                     $('#mprofession').val(v.Profession).trigger('change');
                     //communication address
                     $('#madd1').val(v.L_Address1);
                     $('#madd2').val(v.L_Address2);
                     $('#madd3').val(v.L_Address3);
                     $('#mzip').val(v.L_zip);
                     $('#mphone').val(v.L_phone);
                     $('#mmobile').val(v.L_mobile);
                     $('#mmail').val(v.L_mail);
                     //permanent address
                     $('#mcadd1').val(v.O_Address1);
                     $('#mcadd2').val(v.O_Address2);
                     $('#mcadd3').val(v.O_Address3);
                     $('#mczip').val(v.O_zip);
                     $('#mcphone').val(v.O_phone);
                     $('#mcmobile').val(v.O_mobile);
                     $('#mcmail').val(v.O_mail);
                     //office address
                     $('#moadd1').val(v.Of_Address1);
                     $('#moadd2').val(v.Of_Address2);
                     $('#moadd3').val(v.Of_Address3);
                     $('#mozip').val(v.Of_zip);
                     $('#mophone').val(v.Of_phone);
                     $('#momobile').val(v.Of_mobile);
                     $('#momail').val(v.Of_mail);
                 }
                 if (v.parentRelation == 'G') {
                     $('#gname').val(v.Parent_Name1);
                     $('#gprofession').val(v.Profession).trigger('change');
                     //communication address
                     $('#gadd1').val(v.L_Address1);
                     $('#gadd2').val(v.L_Address2);
                     $('#gadd3').val(v.L_Address3);
                     $('#gzip').val(v.L_zip);
                     $('#gphone').val(v.L_phone);
                     $('#gmobile').val(v.L_mobile);
                     $('#gmail').val(v.L_mail);
                     //permanent address
                     $('#gcadd1').val(v.O_Address1);
                     $('#gcadd2').val(v.O_Address2);
                     $('#gcadd3').val(v.O_Address3);
                     $('#gczip').val(v.O_zip);
                     $('#gcphone').val(v.O_phone);
                     $('#gcmobile').val(v.O_mobile);
                     $('#gcmail').val(v.O_mail);
                     //office address
                     $('#goadd1').val(v.Of_Address1);
                     $('#goadd2').val(v.Of_Address2);
                     $('#goadd3').val(v.Of_Address3);
                     $('#gozip').val(v.Of_zip);
                     $('#gophone').val(v.Of_phone);
                     $('#gomobile').val(v.Of_mobile);
                     $('#gomail').val(v.Of_mail);
                 }
             }

         });
         swal({
             title: '',
             text: '<ol class="text-left"><b style="text-decoration:underline;">Temporary to Permanent Registration</b>\n\
                        <li>You must complete first 3 steps without quitting the registration window.</li>\n\
                        <li>If you quit after 1st step, academic details and parent details will be lost.</li></ol>',
             type: 'warning',
             showCancelButton: true,
             confirmButtonText: 'Proceed',
             cancelButtonText: 'Back',
             html: true
         }, function(isConfirm) {
             if (!isConfirm) {
                 window.location.href = baseurl + "registration/temp-registration";
                 return true;
             } else {
                 return true;
             }
         });
     }

     function getEmployeesForonlinereg(emp_id) {
         var who_worked = $('#who_worked').val();
         var inst_id = $('#emp_inst_id').val();
         var ops_url = baseurl + 'registration/get_employee_list_from_wfm/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "inst_id": inst_id,
                 "gender": who_worked
             },
             success: function(result) {
                 $('#emp_id').empty().trigger("change");
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var state_data = data.data;
                     $('#emp_id').append("<option value='-1'>Select</option>");
                     $.each(state_data, function(i, v) {
                         if (emp_id == v.Emp_id) {
                             $('#emp_id').append("<option selected value='" + v.Emp_id + "' >" + v.Emp_code + " - " + v.Emp_Name + "</option>");
                         } else {
                             $('#emp_id').append("<option value='" + v.Emp_id + "' >" + v.Emp_code + " - " + v.Emp_Name + "</option>");

                         }
                     });
                     $('#emp_id').trigger('change');
                 } else {
                     $('#emp_id').empty().trigger("change");
                     $('#emp_id').append("<option value='-1' selected >Select</option>");
                     $('#emp_id').trigger('change');
                 }
             }
         });
     }

     function empChange(Empgender, emp_id, emp_inst_id) {
         if ($('#staff_con').prop("checked")) {
             $('#forstaffcon').removeClass('notvisible');
             //$("#forstaffcon").load(baseurl + 'registration/load-staff-conc-page');
             ops_url = baseurl + 'registration/load-staff-conc-page';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "Empgender": Empgender,
                     "emp_id": emp_id,
                     "emp_inst_id": emp_inst_id,
                 },
                 success: function(result) {
                     $("#forstaffcon").html(result);
                     getEmployeesForonlinereg(emp_id);
                     $('#emp_inst_id').prop('disabled', true);
                     $('#who_worked').prop('disabled', true);
                     $('#emp_id').prop('disabled', true);

                 }
             });

             $("#parentSearch").addClass('notvisible');

         }
     }
     //Address fill functionality Ends here




     function changed_country() {

         var nationality = $("#country_select :selected").data('nationality');
         var country_id = $('#country_select').val();
         var country_text = $('#country_select :selected').text();
         $('#birth_country').val(country_text);
         $('#birth_country').trigger('change');
         $('#nationality').val(nationality);
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
                 $('#district_select').empty().trigger("change");
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var state_data = data.data;
                     $('#state_select').append("<option value='-1' selected >Select State</option>");
                     $.each(state_data, function(i, v) {
                         if (v.state_id == 1) {
                             $('#state_select').append("<option selected value='" + v.state_id + "' >" + v.state_name + "</option>");
                         } else {
                             $('#state_select').append("<option  value='" + v.state_id + "' >" + v.state_name + "</option>");
                         }
                     });
                     $('#state_select').trigger('change');
                     $('#state_select').valid();
                 } else {
                     $('#state_select').empty().trigger("change");
                     $('#state_select').append("<option value='-1' selected >Select State</option>");
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

                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var city_data = data.data;
                     $('#district_select').empty().trigger("change");
                     $('#district_select').append("<option value='-1' selected >Select District</option>");
                     $.each(city_data, function(i, v) {

                         $('#district_select').append("<option value='" + v.city_id + "' >" + v.city_name + "</option>");
                     });
                     $('#district_select').trigger('change');
                 } else {
                     $('#district_select').empty().trigger("change");
                     $('#district_select').append("<option value='-1' selected >Select District</option>");
                     $('#district_select').trigger('change');
                 }
             }
         });
     }

     function typeNumberOnly(eve) {
         var e = (eve.which) ? eve.which : event.keyCode;
         if (e != 8 && e != 0 && (e < 48 || e > 57)) {
             return false;
         }
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
         autoFocus: true,
         onStepChanging: function(event, currentIndex, newIndex) {
             // Always allow going backward even if the current step contains invalid fields!
             if (currentIndex > newIndex) {
                 $('input').removeClass('error');
                 return true;
             }

             $('.registration-content').slimScroll({
                 position: 'right',
                 height: '350px',
                 railVisible: true,
                 alwaysVisible: false
             });
             // Start validation; Prevent going forward if false
             if (newIndex == 1) {
                 $('#unique_identity').focus();
                 $('#curd-content').hide();

                 if (personal_details.valid() && personal_details.valid()) {
                     if (parseInt($('#personal_details input#age').val()) < 2) {
                         swal('', 'Cannot register a student with age as ' + $('#personal_details input#age').val() + '.', 'info');
                         return false;
                     }
                     var studentid = $('#studentid').val();
                     if (save_personal_details() == 0) {
                         swal('', 'Registration failed. Please Try Again Later.', 'info');
                         return false;
                     } else if (save_personal_details() == 2) {
                         swal('', 'Unique ID already exists.', 'info');
                         return false;
                     } else {
                         personal_details_validator.resetForm();
                         academic_profile_validator.resetForm();
                         if (studentid > 0) {
                             swal('', 'Personal details updated successfully.', 'info');
                             $('#unique_identity').prop('readonly', 'true');
                             $('#admn_no').focus();
                             return true;
                         } else {
                             swal('', 'Personal details saved successfully.', 'info');
                             $('#unique_identity').prop('readonly', 'true');
                             $('#admn_no').focus();
                             return true;
                         }
                     }
                 } else {
                     swal('', 'Enter the mandatory fields.', 'info');
                     return false;
                 }
             } else if (newIndex == 2) {
                 $('#admn_no').focus();
                 $('#curd-content').hide();
                 var academic_profile = $('#academic_profile');
                 var admission_date = $('#admission_date').val();
                 var toyear = $("#academic_year :selected").data('toyear');
                 var fromyear = $("#academic_year :selected").data('fromyear');
                 var flag = 1;
                 var error_msg_adm_date = '';
                 var ops_url_vald = baseurl + 'registration/validate-admissiondate-custom/';
                 if (academic_profile.valid() && academic_profile.valid()) {
                     if (save_academic_details() == 0) {
                         swal('', 'Registration failed. Please Try Again Later.', 'info');
                         return false;
                     } else {
                         academic_profile_validator.resetForm();
                         parent_details_validator.resetForm();
                         swal('', 'Academic details saved successfully.', 'info');
                         $('#academic_year').prop('disabled', 'true');
                         $('#academic_year').trigger('change');
                         $('#fname').focus();
                         return true;
                     }
                 } else {
                     swal('', 'Enter the mandatory fields.', 'info');
                     return false;
                 }
             } else if (newIndex == 3) {
                 $('#fname').focus();
                 var parent_details = $('#parent_details');
                 if (parent_details.valid() && parent_details.valid()) {
                     if (save_parent_details() == 0) {
                         swal('', 'Registration failed. Please Try Again Later1.', 'info');
                         return false;
                     } else {
                         parent_details_validator.resetForm();
                         other_details_passport_validator.resetForm();
                         other_details_visa_validator.resetForm();
                         swal('', 'Parent details saved successfully.', 'info');
                         $('#passno').focus();
                         return true;
                     }

                 } else {
                     swal('', 'Enter the mandatory fields..', 'info');
                     return false;
                 }
             } else if (newIndex == 4) {
                 $('#passno').focus();
                 $('#curd-content').hide();
                 var flag1 = 0;
                 var flag2 = 0;
                 if ($('#passno').val() !== '') {
                     flag1 = 1;
                 }
                 if ($('#visano').val() !== '') {
                     flag2 = 1;

                 }
                 var flag3 = 0;
                 var flag4 = 0;
                 if (flag1 == 0 && flag2 == 0) {
                     other_details_passport_validator.resetForm();
                     other_details_visa_validator.resetForm();
                     save_other_details(flag1, flag2);
                     $("#pass_issue_date").val('');
                     $("#pass_expiry_date").val('');
                     $("#visa_issue_date").val('');
                     $("#visa_expiry_date").val('');
                     swal('', 'Skipping other details for saving registration.', 'info');
                     return true;
                 }
                 if (flag1 == 1) {
                     if (other_details_passport.valid() && other_details_passport.valid()) {
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
                     if (other_details_visa.valid() && other_details_visa.valid()) {
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
                             swal('', 'Registration failed. Please try again later.', 'info');
                             return false;
                         }
                     } else {
                         other_details_passport_validator.resetForm();
                         other_details_visa_validator.resetForm();
                         swal('', 'Other details saved successfully.', 'info');
                         return true;
                     }
                 } else {
                     swal('', 'Enter the mandatory fields.', 'info');
                     return false;
                 }
             }
         },
         onStepChanged: function(event, currentIndex, priorIndex) {
             $('html, body').animate({
                 scrollTop: 0
             }, 1000);
         },
         onFinishing: function(event, currentIndex) {
             if (save_facilities_details() == 0) {
                 swal('', 'Registration failed. Please Try Again Later.', 'info');
                 return false;
             } else {
                 var admn_no = $('#admission_number_new').val();
                 swal({
                     title: 'Success',
                     text: 'Registration updated successfully for Admission no : ' + admn_no,
                     type: 'success',
                     showCancelButton: false,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'OK',
                     closeOnConfirm: false
                 }, function(isConfirm) {
                     swal({
                         title: '',
                         text: 'Do you want to view the registered student profile or proceed with new registration?',
                         type: 'info',
                         showCancelButton: true,
                         confirmButtonColor: '#3085d6',
                         cancelButtonColor: '#d33',
                         cancelButtonText: 'New Registration',
                         confirmButtonText: 'View Profile',
                         closeOnConfirm: true
                     }, function(isConfirm) {
                         if (isConfirm) {
                             var studentid = $('#studentid').val();
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
                                         scrollTop: $("#content").offset().top
                                     }, 1000);
                                 }
                             });
                         } else {
                             window.location.href = baseurl + "registration/add-registration";
                         }

                     });
                 });
                 return true;
             }
         },
         onFinished: function(event, currentIndex) {}
     });


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
         endDate: '31-12-' + (new Date().getFullYear() - 2).toString(),
         autoclose: true,

     }).on('changeDate', function(ev) {
         $(this).valid(); // triggers the validation test
     });

     $('#pass_issue_date').datepicker({
         format: 'dd-mm-yyyy',
         todayBtn: "linked",
         autoclose: true,

     }).on('changeDate', function(ev) {
         $(this).valid(); // triggers the validation test
     });

     $('#pass_expiry_date').datepicker({
         format: 'dd-mm-yyyy',
         todayBtn: "linked",
         autoclose: true,

     }).on('changeDate', function(ev) {
         $(this).valid(); // triggers the validation test
     });
     $('#visa_issue_date').datepicker({
         format: 'dd-mm-yyyy',
         todayBtn: "linked",
         autoclose: true,

     }).on('changeDate', function(ev) {
         $(this).valid(); // triggers the validation test
     });

     $('#visa_expiry_date').datepicker({
         format: 'dd-mm-yyyy',
         todayBtn: "linked",
         autoclose: true,

     }).on('changeDate', function(ev) {
         $(this).valid(); // triggers the validation test
     });

     $('#admission_date').datepicker({
         format: 'dd-mm-yyyy',
         endDate: '+0d',
         todayBtn: "linked",
         autoclose: true,
     }).on('changeDate', function(ev) {
         $(this).valid(); // triggers the validation test
     });

     $('#admission_date').datepicker("setDate", moment().format('DD-MM-YYYY'));
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
             //                var diff = getDiff(moment($("#dob_date").datepicker("getDate")).format('YYYY-MM-DD'));
             $('#age').attr('data-val', age.age);
             $('#age').val(age.agestr);
         } else {
             $('#age').attr('data-val', '');
             $('#age').val('0 Years 0 Months 0 Days');
         }
         var studentid = $('#studentid').val();

         //console.log('d33---' + studentid);
         //if (studentid == 0 || studentid == '' || studentid < 0)
         //if (classid == 0 || classid == '' || classid < 0)
         $('#class_details').attr('disabled', false);
         change_class_for_reg();
     }

     function getAge(dateVal) {
         //                console.log(moment($('#agelimit').val()+'/'+new Date().getFullYear()).subtract(4, 'years').format('DD-MM-YYYY'));
         let date1 = moment();
         //  if ($('#agelimit').val() != '0') {
         //      date1 = moment($('#agelimit').val() + '/' + new Date().getFullYear());
         //  } else {
         //      date1 = moment();
         //  }
         if ($('#agelimit').val() != '0') {
             date1 = moment($('#agelimit').val(), "DD-MM-YYYY");
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

         var yearstring;
         var monthstring;
         var daystring;

         if (years <= 1) {
             yearstring = ' Year ';
         } else {
             yearstring = ' Years ';
         }

         if (months <= 1) {
             monthstring = ' Month ';
         } else {
             monthstring = ' Months ';
         }
         if (days <= 1) {
             daystring = ' Day ';
         } else {
             daystring = ' Days ';
         }


         return {
             agestr: years + yearstring + months + monthstring + days + daystring,
             age: years
         };


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
                     otherflag = 1;
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
                 // console.log(register_phase_three);
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
         register_phase_three.mpadd1 = mpadd1;
         register_phase_three.mpadd2 = mpadd2;
         register_phase_three.mpadd3 = mpadd3;
         register_phase_three.mpzip = mpzip;
         register_phase_three.mpphone = mpphone;
         register_phase_three.mpmobile = mpmobile;
         register_phase_three.mpmail = mpmail;
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
         var sibling_student_data_id = $('#sibling_student_data_id').val();
         if (parseInt(sibling_student_data_id) > 0) {
             update_info = 1;
         } else {
             update_info = 0;
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
                     "sibling_student_data_id": sibling_student_data_id,
                     "studentid": studentid,
                     "studentdata": studentdata,
                     "father_id": father_id, //added salah
                     "mother_id": mother_id, //added salah
                     "guardian_id": guardian_id, //added salah
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
         } else if (is_parent_update == 1) {
             father_id = $('#father_id').val().trim();
             mother_id = $('#mother_id').val().trim();
             guardian_id = $('#guardian_id').val().trim();
             var ops_url = baseurl + 'registration/edit-student-parent-profile';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "load": 1,
                     "update_profile": update_info,
                     "sibling_student_data_id": sibling_student_data_id,
                     "studentid": studentid,
                     "studentdata": studentdata,
                     "father_id": father_id,
                     "mother_id": mother_id,
                     "guardian_id": guardian_id,
                     "who_worked": who_worked,
                     "emp_id": emp_id,
                     "emp_inst_id": emp_inst_id
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
                     //                            console.log(register_phase_three);
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
             swal('', 'Check Admission Date', 'info');
             return false;
         }

         var register_phase_two = new Object();
         //        register_phase_two.studentid = studentid;

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
         if ($.trim(admission_no).length > 0 && admission_no != 'Auto') {
             update_info = 1;
             register_phase_two.admission_no = admission_no;
         }

         //        if (update_info == 0) {
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
                 "studentdata": studentdata,
                 "temp_stud_id": $('#temp_stud_id').val()
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     $('input[name=admission_no]').val(data.admission_no)
                     status_flag = 1
                 } else {
                     status_flag = 0;
                 }
             },
             error: function() {
                 //                        console.log(register_phase_one);
                 status_flag = 0;
             }
             //                return status_flag;
         });
         //        } else {
         //            status_flag = 1;
         //        }
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
         var blood_group = $('#blood_group').val();
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
         register_phase_one.blood_group = blood_group;
         //        register_phase_one.language_select = language_select;
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
         //  console.log(register_phase_one);
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
                 "language_data": language_data,
                 "temp_stud_id": $('#temp_stud_id').val()
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     $('#studentid').val(data.studentid);
                     flag111 = 1;
                 } else if (data.status == 2) {
                     flag111 = 2;
                 } else {
                     flag111 = 0;
                 }
             },
             error: function() {
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
                 //                var str = $('#profile_image_data').val();
                 //                var res = str.replace("data:image/jpeg;base64,", '');
                 //                $('#profile_image_data').val(res);
             };
             if (input.files[0].type.indexOf("image") == -1) {
                 swal('', 'Invalid File. Please Try Again With a Valid File', 'info');
                 return false;
             }
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
         var community_id = $("#caste_select :selected").data("communityselect");
         $('#community_select').val(community_id);
         $('#community_select').trigger('change');
     }
     $("#language_select").select2({
         //                "theme": "bootstrap",
         "width": "100%"
     });

     function checkEmirateAvailable() {
         if ($('#unique_identity').val().trim().length === parseInt($('#unique_identity').attr('maxlength'))) {
             var flg = 0;
             var ops_url = baseurl + 'registration/search-uuid';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "load": 1,
                     "uuid": $('#unique_identity').val()
                 },
                 success: function(result) {
                     var data = $.parseJSON(result);
                     if (data.status == 1) {
                         //$('#id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + '  already exists</span>');
                         // $('#unique_identity').val('');
                         $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                         $(".actions ul li:nth-child(2)>a").removeAttr("href");
                         $(".actions ul li:nth-child(1)>a").removeAttr("href");
                         flg = 1;
                     } else if (data.status == 3) {
                         $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                         $(".actions ul li:nth-child(2)>a").removeAttr("href");
                         $(".actions ul li:nth-child(1)>a").removeAttr("href");
                         flg = 1;
                     } else {
                         //$('#id_spot_check').html('<span style="color:#009900;"><i class="fa fa-check"></i> ' + $('#uuid_unit_limit_name').val() + ' is available</span>');
                         $(".actions ul li:nth-child(2)").removeClass("disabled").attr("aria-disabled", "false");
                         $(".actions ul li:nth-child(2)>a").attr("href", "#next");
                         $(".actions ul li:nth-child(1)>a").attr("href", "#previous");
                     }
                 }
             });
             return flg;
         } else {
             $('#id_spot_check').html('');
         }
     }

     function f_checkEmirateAvailable() {
         var fuiid = $('#f_unique_identity').val();
         var muiid = $('#m_unique_identity').val();
         var guiid = $('#g_unique_identity').val();
         if (fuiid != muiid && guiid != fuiid) {
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
                         if (data.status == 1) {
                             $('#f_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + ' already exists</span>');
                             flg = 1;
                             // $('#f_unique_identity').val('');
                             $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                             $(".actions ul li:nth-child(2)>a").removeAttr("href");
                             $(".actions ul li:nth-child(1)>a").removeAttr("href");
                         } else {
                             $('#f_id_spot_check').html('<span style="color:#009900;"><i class="fa fa-check"></i> ' + $('#uuid_unit_limit_name').val() + ' is available</span>');
                             $(".actions ul li:nth-child(2)").removeClass("disabled").attr("aria-disabled", "false");
                             $(".actions ul li:nth-child(2)>a").attr("href", "#next");
                             $(".actions ul li:nth-child(1)>a").attr("href", "#previous");
                         }
                     }
                 });
                 // return flg;
             } else {
                 $('#f_id_spot_check').html('');
             }
         } else {
             if (fuiid != '') {
                 $('#f_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + ' is already exists in mother/guardian details</span>');
                 flg = 1;
                 return false;
             } else {
                 $('#f_id_spot_check').html('');
             }
         }
     }

     function m_checkEmirateAvailable() {
         var fuiid = $('#f_unique_identity').val();
         var muiid = $('#m_unique_identity').val();
         var guiid = $('#g_unique_identity').val();
         if (fuiid != muiid && guiid != muiid) {
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
                             $('#m_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + '  already exists</span>');
                             flg = 1;
                             // $('#m_unique_identity').val('');
                             $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                             $(".actions ul li:nth-child(2)>a").removeAttr("href");
                             $(".actions ul li:nth-child(1)>a").removeAttr("href");
                         } else {
                             $('#m_id_spot_check').html('<span style="color:#009900;"><i class="fa fa-check"></i> ' + $('#uuid_unit_limit_name').val() + ' is available</span>');
                             $(".actions ul li:nth-child(2)").removeClass("disabled").attr("aria-disabled", "false");
                             $(".actions ul li:nth-child(2)>a").attr("href", "#next");
                             $(".actions ul li:nth-child(1)>a").attr("href", "#previous");
                         }
                     }
                 });
                 return flg;
             } else {
                 $('#m_id_spot_check').html('');
             }
         } else {
             if (muiid != '') {
                 $('#m_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + ' is already exists in father/guardian details</span>');
                 flg = 1;
                 return false;
             } else {
                 $('#m_id_spot_check').html('');
             }

         }
     }

     function g_checkEmirateAvailable() {
         var fuiid = $('#f_unique_identity').val();
         var muiid = $('#m_unique_identity').val();
         var guiid = $('#g_unique_identity').val();
         if (fuiid != guiid && muiid != guiid) {
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
                             //$('#g_unique_identity').css('border-color', 'red');
                             $('#g_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + '  already exists</span>');
                             flg = 1;
                             // $('#g_unique_identity').val('');
                             $(".actions ul li:nth-child(2)").addClass("disabled").attr("aria-disabled", "true");
                             $(".actions ul li:nth-child(2)>a").removeAttr("href");
                             $(".actions ul li:nth-child(1)>a").removeAttr("href");
                         } else {
                             $('#g_id_spot_check').html('<span style="color:#009900;"><i class="fa fa-check"></i> ' + $('#uuid_unit_limit_name').val() + ' is available</span>');
                             $(".actions ul li:nth-child(2)").removeClass("disabled").attr("aria-disabled", "false");
                             $(".actions ul li:nth-child(2)>a").attr("href", "#next");
                             $(".actions ul li:nth-child(1)>a").attr("href", "#previous");
                         }
                     }
                 });
                 return flg;
             } else {
                 $('#g_id_spot_check').html('');
             }
         } else {
             if (guiid != '') {
                 $('#g_id_spot_check').html('<span style="color:#990000;"><i class="fa fa-times"></i> ' + $('#uuid_unit_limit_name').val() + ' is already exists in father/mother details</span>');
                 return false;
                 flg = 1;
             } else {
                 $('#g_id_spot_check').html('');
             }

         }
     }

     function get_uuid_status_data() {
         var uuid = $('#unique_identity').val().trim();
         var uuid_limit_name = $('#uuid_unit_limit_name').val();
         if (uuid.length < 3) {
             swal('', 'Enter atleast 3 digits to search', 'info');
             return false;
         }
         var ops_url = baseurl + 'registration/search-uuid';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "uuid": uuid,
                 "uuid_limit_name": uuid_limit_name
             },
             success: function(result) {
                 var data = $.parseJSON(result);
                 if (data.status == 1) {
                     $('#student_uuid_data').html(data.view);
                     var animation = "fadeInDown";
                     $('#student_uuid_data').addClass('animated');
                     $('#student_uuid_data').addClass(animation);
                     //                            $('#student_uuid_data').hide();
                     $('#student_uuid_data').show();
                     $('html, body').animate({
                         scrollTop: $("body").offset().top
                     }, 1000);
                 } else {
                     if (data.message) {
                         swal('', data.message, 'info');
                     } else {
                         swal('', 'No data found', 'info');
                     }

                     $('#student_uuid_data').html('');
                     $('#student_uuid_data').hide();
                     return false;
                 }
             }
         });
     }

     function change_class_for_reg() {
         var classid = $('#class_details').val();
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
                 "age": age,
                 "flag": 1 //1 is student_registration nd 2 is online registration
             },
             success: function(result) {
                 $(batchid).empty().trigger("change");
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     var batch_data = data.data;
                     $(batchid).empty().trigger("change");
                     $(batchid).append("<option value='-1' selected>Select</option>");
                     $.each(batch_data, function(i, v) {
                         $(batchid).append("<option value='" + v.Course_Det_ID + "' data-masterid='" + v.Course_Type_ID + "' >" + v.Description + "</option>");
                     });
                     //$(batchid).val(classid);
                     $(batchid).trigger('change');
                 } else {
                     $(batchid).empty().trigger("change");
                     $(batchid).append("<option value='-1' selected>Select</option>");
                     $(batchid).trigger('change');
                 }
             }
         });


     }

     $(document).ready(function() {

         $('#unique_identity').focus();
         $.validator.addMethod(
             "regex",
             function(value, element, regexp) {
                 var re = new RegExp(regexp);
                 return this.optional(element) || re.test(value);
             },
             "Please check your input."
         );
         $.validator.addMethod("synchronousRemote", function(value, element, param) {
             if (value == -1) {
                 return false;
             } else {
                 return true;
             }
         }, "Select any field.");

         //  $('input, select').change(function() {
         //      $(this).focusout();
         //  });
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
         //  $(".select2-selection").on("focus", function() {
         //      $(this).parent().parent().prev().select2("open");
         //  });


         $('#language_select').select2({
             placeholder: 'Select language',
         }).on('mouseup', function(e) {
             e.preventDefault();
             // i also tried return false but nothing happen.
         });
     });

     function fill_new_details(studentid) {
         $('#go_button').hide();
         var ops_url = baseurl + 'registration/edit-fill-profile';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "studentid": studentid
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data) {
                     console.log(data);
                     $('#studentid').val(studentid);

                     var prof_det = data.profile_details;
                     //  console.log(prof_det);
                     if (prof_det.Admn_No != 'NA') {
                         $('#admn_no').val(prof_det.Admn_No);
                     }


                     if (parseInt(prof_det.Nationality) != 2) {
                         $('#check_yes').iCheck('uncheck')
                         $('#check_no').iCheck('check')
                         $('#uuid_unit_limit_name').val('Unique ID');
                         $('#country_select').prop('disabled', false);
                         $('#country_select').val(-1);
                         $("#country_select option[value='2']").prop('disabled', true);
                         $('.required_by_citizen').hide();
                         $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').removeClass('digits');
                         $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').addClass('alphanumeric');
                         $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').attr('placeholder', 'Enter ' + $('#uuid_unit_limit_name').val());
                         $('#unique_identity,#f_unique_identity,#m_unique_identity,#g_unique_identity').attr('maxlength', 16);
                         $('.unique_identity_label').html($('#uuid_unit_limit_name').val());
                     }
                     $('#check_yes').prop('disabled', true);
                     $('#check_no').prop('disabled', true);


                     if (prof_det.profile_image_alternate != null)
                         $("#profile_image").attr("src", prof_det.profile_image_alternate);
                     $('#admission_date').datepicker("setDate", moment(prof_det.Admission_Date, 'YYYY-MM-DD').format('DD-MM-YYYY'));
                     $('#admission_date').attr('readonly', true);
                     $('#admission_date').attr('disabled', true);
                     $('#academic_year').val(prof_det.Cur_AcadYr);
                     if (prof_det.Cur_AcadYr == '' || prof_det.Cur_AcadYr == null || prof_det.Cur_AcadYr == 0) {
                         $('#academic_year').val(-1);
                         $('#academic_year').attr('disabled', false);
                     } else {
                         $('#academic_year').attr('disabled', true);
                     }

                     $('#academic_year').trigger('change');
                     $('#unique_identity').val(prof_det.Adhar_No);
                     if (prof_det.Adhar_No == '' || prof_det.Adhar_No.length == 0 || prof_det.Adhar_No == 0) {
                         $('#unique_identity').attr('readonly', false);
                     } else {
                         $('#unique_identity').attr('readonly', true);
                         $("#unique_identity").attr("onkeyup", "");
                     }

                     $('#stream_id').val(prof_det.Cur_Stream);
                     if (prof_det.Cur_Stream == '' || prof_det.Cur_Stream == null || prof_det.Cur_Stream == 0) {
                         $('#stream_id').val(-1);
                         $('#stream_id').attr('disabled', false);
                     } else {
                         $('#stream_id').attr('disabled', true);
                     }
                     $('#stream_id').trigger('change');

                     $('#blood_group').val(prof_det.BloodGroup);
                     $('#blood_group').trigger('change');


                     $("#firstname").val(prof_det.First_Name);
                     $("#middlename").val(prof_det.Middle_Name);
                     $("#lastname").val(prof_det.Last_Name);
                     $("#gender").val(prof_det.Sex);
                     $('#gender').trigger('change');
                     $('#dob_date').datepicker("setDate", moment(prof_det.DOB, 'YYYY-MM-DD').format('DD-MM-YYYY')).prop('disabled', true);
                     $('#dob_date').css('background-color', '#eee');
                     //age_changer();
                     $("#country_select").val(prof_det.Nationality);

                     $('#country_select').trigger('change');
                     $("#nationality").val(prof_det.NationalityName);
                     $("#state_select").val(prof_det.state);
                     $('#state_select').trigger('change');
                     $("#district_select").val(prof_det.district);
                     $('#district_select').trigger('change');
                     $("#mother_tongue").val(prof_det.MotherTongue);
                     $('#mother_tongue').trigger('change');
                     //  $("#language_select").val(prof_det.knownn_languages);
                     //  $('#language_select').trigger('change');
                     $("#religion_select").val(prof_det.Religion);
                     $('#religion_select').trigger('change');
                     $("#caste_select").val(prof_det.Caste);
                     $('#caste_select').trigger('change');
                     $("#community_select").val(prof_det.Community);
                     $('#community_select').trigger('change');


                     $.each($("#language_select"), function() {
                         $(this).select2('val', prof_det.language_known);
                     });


                     $('#class_details').val(prof_det.Cur_Class);
                     if (prof_det.Cur_Class == '' || prof_det.Cur_Class == null || prof_det.Cur_Class == 0) {
                         $('#class_details').val(-1);
                         $('#class_details').attr('disabled', false);
                     } else {
                         $('#class_details').attr('disabled', true);
                     }
                     $('#class_details').trigger('change');

                     //if (fillflag == 1) {
                     $("#birth_country").val(prof_det.Birth_Country);
                     if (prof_det.Birth_Country == '' || prof_det.Birth_Country == null || prof_det.Birth_Country == 0) {
                         $('#birth_country').val(-1);
                     }

                     $('#birth_country').trigger('change');
                     $("#birth_place").val(prof_det.Birth_place);
                     $("#id_mark1").val(prof_det.IDMark2);
                     $("#id_mark_2").val(prof_det.IDMark2);
                     //} else if (fillflag == 2) {
                     //$('#sibling_student_data_id').val(prof_det.student_id);
                     // $('#father_id').val(prof_det.father_id);
                     if (typeof(prof_det.father_id) != "undefined" && prof_det.father_id !== null) {
                         var father_id = $('#father_id').val(prof_det.father_id);
                     } else {
                         var father_id = 0;
                         //$('#is_parent_update').val(0);
                     }
                     var FC_address = prof_det.F_C_address1 + prof_det.F_C_address2 + prof_det.F_C_address3 + prof_det.F_C_ZIP_CODE + prof_det.F_C_Phone1 + prof_det.F_C_Phone3 + prof_det.Email;
                     var FP_address = prof_det.F_H_address1 + prof_det.F_H_address2 + prof_det.F_H_address3 + prof_det.F_H_ZIP_CODE + prof_det.F_H_Phone1 + prof_det.F_H_Phone3 + prof_det.HEmail;

                     if (prof_det.F_staff == 1) {
                         $('#fname').prop('disabled', true);
                         $('#f_unique_identity').prop('disabled', true);
                         $("#fprofession").prop('disabled', true);
                         $('#fadd1').prop('disabled', true);
                         $('#fadd2').prop('disabled', true);
                         $('#fadd3').prop('disabled', true);
                         $('#fzip').prop('disabled', true);
                         $('#fphone').prop('disabled', true);
                         $('#fmobile').prop('disabled', true);
                         $('#fmail').prop('disabled', true);
                         $('#foadd1').prop('disabled', true);
                         $('#foadd2').prop('disabled', true);
                         $('#foadd3').prop('disabled', true);
                         $('#fozip').prop('disabled', true);
                         $('#fophone').prop('disabled', true);
                         $('#fomobile').prop('disabled', true);
                         $('#fomail').prop('disabled', true);
                         $('#fcadd1').prop('disabled', true);
                         $('#fcadd2').prop('disabled', true);
                         $('#fcadd3').prop('disabled', true);
                         $('#fczip').prop('disabled', true);
                         $('#fcphone').prop('disabled', true);
                         $('#fcmobile').prop('disabled', true);
                         $('#fcmail').prop('disabled', true);
                         $('#father_check').prop('disabled', true);
                         $('#parentSearch').hide();
                         $('#panelclass').removeClass('panel-info');
                         $('#panelclass').addClass('panel-warning');
                         $('#titleforstaffcon').html('Staff concession enjoying student.Staff details edit is only permitted in WFM');
                     }
                     $('#fname').val(prof_det.Father);
                     $('#f_unique_identity').val(prof_det.f_adhar);
                     $("#fprofession").val(prof_det.F_profession_id);
                     $('#fprofession').trigger('change');
                     $('#fadd1').val(prof_det.F_C_address1);
                     $('#fadd2').val(prof_det.F_C_address2);
                     $('#fadd3').val(prof_det.F_C_address3);
                     $('#fzip').val(prof_det.F_C_ZIP_CODE);
                     $('#fphone').val(prof_det.F_C_Phone1);
                     $('#fmobile').val(prof_det.F_C_Phone3);
                     $('#fmail').val(prof_det.Email);
                     $('#foadd1').val(prof_det.F_O_address1);
                     $('#foadd2').val(prof_det.F_O_address2);
                     $('#foadd3').val(prof_det.F_O_address3);
                     $('#fozip').val(prof_det.F_O_ZIP_CODE);
                     $('#fophone').val(prof_det.F_O_Phone1);
                     $('#fomobile').val(prof_det.F_O_Phone3);
                     $('#fomail').val(prof_det.OEmail);
                     $('#fcadd1').val(prof_det.F_H_address1);
                     $('#fcadd2').val(prof_det.F_H_address2);
                     $('#fcadd3').val(prof_det.F_H_address3);
                     $('#fczip').val(prof_det.F_H_ZIP_CODE);
                     $('#fcphone').val(prof_det.F_H_Phone1);
                     $('#fcmobile').val(prof_det.F_H_Phone3);
                     $('#fcmail').val(prof_det.HEmail);
                     if (FC_address != '') {
                         if (FC_address == FP_address) {
                             $('#father_check').prop('checked', true);
                         } else {
                             $('#father_check').prop('checked', false);
                         }
                     }

                     //$("#fprofession option[value='-1']").remove();

                     //$('#mother_id').val(prof_det.mother_id);
                     if (typeof(prof_det.mother_id) != "undefined" && prof_det.mother_id !== null) {
                         var mother_id = $('#mother_id').val(prof_det.mother_id);
                     } else {
                         var mother_id = 0;
                         //$('#is_parent_update').val(0);
                     }
                     $('#mname').val(prof_det.Mother);
                     $('#m_unique_identity').val(prof_det.m_adhar);

                     $("#mprofession").val(prof_det.M_profession_id);
                     $('#mprofession').trigger('change');
                     var MCF_address = prof_det.M_C_address1 + prof_det.M_C_address2 + prof_det.M_C_address3 + prof_det.M_C_ZIP_CODE + prof_det.M_C_Phone1;
                     var FCF_address = prof_det.F_C_address1 + prof_det.F_C_address2 + prof_det.F_C_address3 + prof_det.F_C_ZIP_CODE + prof_det.F_C_Phone1;
                     if (MCF_address != '') {
                         if (MCF_address == FCF_address) {
                             $('#mthr_com_check').prop('checked', true);
                         } else {
                             $('#mthr_com_check').prop('checked', false);
                         }
                     }

                     var MC_address = MCF_address + prof_det.M_C_Phone3 + prof_det.M_C_Email;
                     var MP_address = prof_det.M_H_address1 + prof_det.M_H_address2 + prof_det.M_H_address3 + prof_det.M_H_ZIP_CODE + prof_det.M_H_Phone1 + prof_det.M_H_Phone3 + prof_det.M_H_Email;
                     if (MC_address != '') {
                         if (MC_address == MP_address) {
                             $('#mother_check').prop('checked', true);
                         } else {
                             $('#mother_check').prop('checked', false);
                         }
                     }

                     $('#madd1').val(prof_det.M_C_address1);
                     $('#madd2').val(prof_det.M_C_address2);
                     $('#madd3').val(prof_det.M_C_address3);
                     $('#mzip').val(prof_det.M_C_ZIP_CODE);
                     $('#mphone').val(prof_det.M_C_Phone1);
                     $('#mmobile').val(prof_det.M_C_Phone3);
                     $('#mmail').val(prof_det.M_C_Email);

                     $('#moadd1').val(prof_det.M_O_address1);
                     $('#moadd2').val(prof_det.M_O_address2);
                     $('#moadd3').val(prof_det.M_O_address3);
                     $('#mozip').val(prof_det.M_O_ZIP_CODE);
                     $('#mophone').val(prof_det.M_O_Phone1);
                     $('#momobile').val(prof_det.M_O_Phone3);
                     $('#momail').val(prof_det.M_O_Email);


                     $('#mcadd1').val(prof_det.M_H_address1);
                     $('#mcadd2').val(prof_det.M_H_address2);
                     $('#mcadd3').val(prof_det.M_H_address3);
                     $('#mczip').val(prof_det.M_H_ZIP_CODE);
                     $('#mcphone').val(prof_det.M_H_Phone1);
                     $('#mcmobile').val(prof_det.M_H_Phone3);
                     $('#mcmail').val(prof_det.M_H_Email);

                     if (prof_det.M_staff == 1) {
                         $('#mname').prop('disabled', true);
                         $('#m_unique_identity').prop('disabled', true);
                         $("#mprofession").prop('disabled', true);
                         $('#madd1').prop('disabled', true);
                         $('#madd2').prop('disabled', true);
                         $('#madd3').prop('disabled', true);
                         $('#mzip').prop('disabled', true);
                         $('#mphone').prop('disabled', true);
                         $('#mmobile').prop('disabled', true);
                         $('#mmail').prop('disabled', true);
                         $('#mthr_com_check').prop('disabled', true);
                         $('#mother_check').prop('disabled', true);
                         $('#moadd1').prop('disabled', true);
                         $('#moadd2').prop('disabled', true);
                         $('#moadd3').prop('disabled', true);
                         $('#mozip').prop('disabled', true);
                         $('#mophone').prop('disabled', true);
                         $('#momobile').prop('disabled', true);
                         $('#momail').prop('disabled', true);
                         $('#mcadd1').prop('disabled', true);
                         $('#mcadd2').prop('disabled', true);
                         $('#mcadd3').prop('disabled', true);
                         $('#mczip').prop('disabled', true);
                         $('#mcphone').prop('disabled', true);
                         $('#mcmobile').prop('disabled', true);
                         $('#mcmail').prop('disabled', true);
                     }
                     if (typeof(prof_det.guardian_id) != "undefined" && prof_det.guardian_id !== null) {
                         var guardId = $('#guardian_id').val(prof_det.guardian_id);
                     } else {
                         var guardId = 0;
                     }
                     $('#gname').val(prof_det.Guardian);
                     $('#g_unique_identity').val(prof_det.g_adhar);
                     $("#ggender").val(prof_det.Gender);
                     $('#ggender').trigger('change');
                     $("#gprofession").val(prof_det.G_profession_id);
                     $('#gprofession').trigger('change');
                     var GC_address = prof_det.G_C_address1 + prof_det.G_C_address2 + prof_det.G_C_address3 + prof_det.G_C_ZIP_CODE + prof_det.G_C_Phone1 + prof_det.G_C_Phone3 + prof_det.G_C_Email;
                     var GP_address = prof_det.G_H_address1 + prof_det.G_H_address2 + prof_det.G_H_address3 + prof_det.G_H_ZIP_CODE + prof_det.G_H_Phone1 + prof_det.G_H_Phone3 + prof_det.G_H_Email;
                     if (GC_address != '') {
                         if (GC_address == GP_address) {
                             $('#guardian_check').prop('checked', true);
                         } else {
                             $('#guardian_check').prop('checked', false);
                         }
                     }
                     $('#gadd1').val(prof_det.G_C_address1);
                     $('#gadd2').val(prof_det.G_C_address2);
                     $('#gadd3').val(prof_det.G_C_address3);
                     $('#gzip').val(prof_det.G_C_ZIP_CODE);
                     $('#gphone').val(prof_det.G_C_Phone1);
                     $('#gmobile').val(prof_det.G_C_Phone3);
                     $('#gmail').val(prof_det.G_C_Email);

                     $('#goadd1').val(prof_det.G_O_address1);
                     $('#goadd2').val(prof_det.G_O_address2);
                     $('#goadd3').val(prof_det.G_O_address3);
                     $('#gozip').val(prof_det.G_O_ZIP_CODE);
                     $('#gophone').val(prof_det.G_O_Phone1);
                     $('#gomobile').val(prof_det.G_O_Phone3);
                     $('#gomail').val(prof_det.G_O_Email);


                     $('#gcadd1').val(prof_det.G_H_address1);
                     $('#gcadd2').val(prof_det.G_H_address2);
                     $('#gcadd3').val(prof_det.G_H_address3);
                     $('#gczip').val(prof_det.G_H_ZIP_CODE);
                     $('#gcphone').val(prof_det.G_H_Phone1);
                     $('#gcmobile').val(prof_det.G_H_Phone3);
                     $('#gcmail').val(prof_det.G_H_Email);

                     if (father_id == 0 && mother_id == 0) {
                         $('#is_parent_update').val(0);
                     } else {
                         $('#is_parent_update').val(1);
                     }
                     $('#curd-content').html('')
                     //swal('','No data available !','info');
                     //} else if (fillflag == 3) {
                     // var pass_issue_dt = new Date(prof_det.pass_issue_dt);
                     //var pass_issue_dt_newDate = pass_issue_dt.toString('dd-MM-yy');

                     $('#passno').val(prof_det.PassportNo);
                     $('#pissue_place').val(prof_det.Pass_issue_location);
                     //$('#pass_issue_date').val(prof_det.pass_issue_dt);
                     if (prof_det.pass_issue_dt != '' && prof_det.pass_issue_dt != null && prof_det.pass_issue_dt != '1900-01-01')
                         $('#pass_issue_date').datepicker("setDate", moment(prof_det.pass_issue_dt, 'YYYY-MM-DD').format('DD-MM-YYYY'));
                     //$('#pass_expiry_date').val(prof_det.pass_expiry_dt);
                     if (prof_det.pass_expiry_dt != '' && prof_det.pass_expiry_dt != null && prof_det.pass_expiry_dt != '1900-01-01')
                         $('#pass_expiry_date').datepicker("setDate", moment(prof_det.pass_expiry_dt, 'YYYY-MM-DD').format('DD-MM-YYYY'));
                     $('#pdesc').val(prof_det.pass_desc);
                     $('#visano').val(prof_det.VisaNo);
                     $('#vissue_place').val(prof_det.Visa_issue_location);
                     //$('#visa_issue_date').val(prof_det.visa_issue_dt);
                     if (prof_det.visa_issue_dt != '' && prof_det.visa_issue_dt != null && prof_det.visa_issue_dt != '1900-01-01')
                         $('#visa_issue_date').datepicker("setDate", moment(prof_det.visa_issue_dt, 'YYYY-MM-DD').format('DD-MM-YYYY'));
                     //$('#visa_expiry_date').val(prof_det.Visa_Expiry_Dt);
                     if (prof_det.Visa_Expiry_Dt != '' && prof_det.Visa_Expiry_Dt != null && prof_det.Visa_Expiry_Dt != '1900-01-01')
                         $('#visa_expiry_date').datepicker("setDate", moment(prof_det.Visa_Expiry_Dt, 'YYYY-MM-DD').format('DD-MM-YYYY'));
                     $('#vdesc').val(prof_det.visa_description);


                     //} else if (fillflag == 4) {
                     if (prof_det.istransport == 1) {
                         $('#trans_port').iCheck('check');
                     } else {
                         $('#trans_port').iCheck('uncheck');
                     }

                     if (prof_det.ismess == 1) {
                         $('#mess').iCheck('check');
                     } else {
                         $('#mess').iCheck('uncheck');
                     }

                     if (prof_det.ishostel == 1) {
                         $('#hostel').iCheck('check');
                     } else {
                         $('#hostel').iCheck('uncheck');
                     }

                     if (prof_det.isonline_service == 1) {
                         $('#o_service').iCheck('check');
                     } else {
                         $('#o_service').iCheck('uncheck');
                     }

                     // }

                     /* $('#profile-detail-content').html('');
                      $('#profile-detail-content').html(data.view);
                      var animation = "fadeInDown";
                      $("#profile-detail-content").show();
                      $('#profile-detail-content').addClass('animated');
                      $('#profile-detail-content').addClass(animation);
                      //                    $('#country_select').trigger('change')
                      //                    $('#add_type').hide();*/
                 } else {
                     alert('No data loaded');
                 }
             }
         });
     }
     $("select").on("select2:close", function(e) {
         $(this).valid();
     });

     changed_country();

     <?php
        if (isset($temp_stud_data) && !empty($temp_stud_data)) {
        ?>
         set_tep_stud_values('<?php echo json_encode($temp_stud_data); ?>');
     <?php
        }
        ?>
 </script>
 <?php
    if (!empty($profile_details)) { ?>
     <script>
         fill_new_details(<?php echo $profile_details['student_id'] ?>);
     </script>

 <?php
    } ?>