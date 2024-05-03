<?php if ($this->session->userdata('inst_id') == 2) {
    $parent_label = "Father Name";
    $permanent_address_label = "Home Country Address";
} else {
    $parent_label = "Parent Name";
    $permanent_address_label = "Permanent Address";
} ?>

<fieldset>
    <div class="row ">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <div class="alert alert-info" id="verify_well"></div> -->
                        <div class="ibox-content" id="faculty_loader2">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                        <div class="well" id="dataviewverification">
                            <div class="table-responsive m-t">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="4" align="center">
                                                <h2>STUDENT DETAILS VERIFICATION</h2>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody align="left">
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h3>CANDIDATE DETAILS</h3>
                                            </th>
                                        </tr>
                                        <tr>
                                            <?php // print_r($user_data);?>
                                            <td width="15%" class="alignment label_tb">First Name</td>
                                            <td width="1%">:</td>
                                            <td width="17%" class="alignment" id="firstName"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                            <td width="15%" class="alignment label_tb">Middle Name</td>
                                            <td width="1%">:</td>
                                            <td width="17%" class="alignment" id="middleName"><?php echo isset($user_data['mname']) ? $user_data['mname'] : "" ?></td>
                                            <td class="label_tb">Last Name</td>
                                            <td>:</td>
                                            <td class="alignment" id="lastName"><?php echo isset($user_data['lname']) ? $user_data['lname'] : "" ?></td>
                                            

                                        </tr>
                                        <tr>
                                            <td class="label_tb">Age</td>
                                            <td>:</td>
                                            <td class="alignment" id="agE"><?php echo isset($user_data['age']) ? $user_data['age'] : "" ?></td>
                                            <td class="alignment label_tb">Gender</td>
                                            <td>:</td>
                                            <td class="alignment" id="gendeR"><?php echo isset($user_data['gender']) ? $user_data['gender'] : "" ?></td>
                                            <td class="alignment label_tb"> Date Of Birth</td>
                                            <td>:</td>
                                            <td class="alignment" id="dob_datE"><?php echo isset($user_data['dob']) ? $user_data['dob'] : "" ?></td>


                                        </tr>

                                        <tr>
                                            <td class="alignment label_tb">Nationality</td>
                                            <td>:</td>
                                            <td class="alignment" id="nationalitY"><?php echo isset($user_data['nationality']) ? $user_data['nationality'] : "" ?></td>
                                            <td class="alignment label_tb">Mother Tongue</td>
                                            <td>:</td>
                                            <td class="alignment" id="mother_tonguE"><?php echo isset($user_data['mothertongue']) ? $user_data['mothertongue'] : "" ?></td>
                                            <td class="label_tb">Optional Language</td>
                                            <td>:</td>
                                            <td class="alignment" id="language_selecT"><?php echo isset($user_data['optionallanguage']) ? $user_data['optionallanguage'] : "" ?></td>
                                            

                                        </tr>
                                        <tr>
                                            <td class="label_tb">State</td>
                                            <td>:</td>
                                            <td class="alignment" id="state_selecT"><?php echo isset($user_data['state_name']) ? $user_data['state_name'] : "" ?></td>
                                            <td class="alignment label_tb">District</td>
                                            <td>:</td>
                                            <td class="alignment" id="district_selecT"><?php echo isset($user_data['city_name']) ? $user_data['city_name'] : "" ?></td>
                                            <td class="alignment label_tb">Country</td>
                                            <td>:</td>
                                            <td class="alignment" id="country_selecT"><?php echo isset($user_data['country_name']) ? $user_data['country_name'] : "" ?></td>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Community</td>
                                            <td>:</td>
                                            <td class="alignment" id="community_selecT"><?php echo isset($user_data['community_name']) ? $user_data['community_name'] : "" ?></td>
                                            <td class="alignment label_tb">Religion</td>
                                            <td>:</td>
                                            <td class="alignment" id="religion_selecT"><?php echo isset($user_data['religion_name']) ? $user_data['religion_name'] : "" ?></td>
                                            <td class="alignment label_tb">Caste</td>
                                            <td>:</td>
                                            <td class="alignment" id="caste_selecT"><?php echo isset($user_data['caste_name']) ? $user_data['caste_name'] : "" ?></td>
                                        </tr>

                                        <tr>
                                            <td class="alignment label_tb">Blood Group</td>
                                            <td>:</td>
                                            <td class="alignment" id="bloodGroup"><?php echo isset($user_data['blood_group']) ? $user_data['blood_group'] : "" ?></td>
                                            <td class="alignment label_tb">Pickup Point</td>
                                            <td>:</td>
                                            <td class="alignment" id="pickupPOINT"><?php echo isset($user_data['pickpointName']) ? $user_data['pickpointName'] : "" ?></td>

                                        </tr>
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h3>ACADEMIC AND REGISTRATION DETAILS</h3>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Academic Year</td>
                                            <td>:</td>
                                            <td class="alignment" id="academic_yeaR"><?php echo isset($user_data['acdyr']) ? $user_data['acdyr'] : "" ?></td>
                                            <td class="alignment label_tb">Syllabus</td>
                                            <td>:</td>
                                            <td class="alignment" id="stream_iD"><?php echo isset($user_data['stream_code']) ? $user_data['stream_code'] : "" ?></td>
                                            <td class="alignment label_tb">Class</td>
                                            <td>:</td>
                                            <td class="alignment" id="class_detailS"><?php echo isset($user_data['class']) ? $user_data['class'] : "" ?></td>
                                        </tr>

                                        <tr>
                                            <td class="label_tb">Birth Country</td>
                                            <td>:</td>
                                            <td class="alignment" id="birth_countrY"><?php echo isset($user_data['birthCountry']) ? $user_data['birthCountry'] : "" ?></td>
                                            <td class="alignment label_tb">Birth State</td>
                                            <td>:</td>
                                            <td class="alignment" id="birth_state_view"><?php echo isset($user_data['birth_state']) ? $user_data['birth_state'] : "" ?></td>
                                            <td class="alignment label_tb">Birth District</td>
                                            <td>:</td>
                                            <td class="alignment" id="birth_district_view"><?php echo isset($user_data['birth_district']) ? $user_data['birth_district'] : "" ?></td>

                                        </tr>
                                        <tr>
                                            <td class="label_tb">Birth Place</td>
                                            <td>:</td>
                                            <td class="alignment" id="birth_placE"><?php echo isset($user_data['birthPlace']) ? $user_data['birthPlace'] : "" ?></td>
                                            <td class="alignment label_tb">Entrance Date</td>
                                            <td>:</td>
                                            <td class="alignment" id="view_entrance_date"><?php echo isset($user_data['entrance_date']) ? $user_data['entrance_date'] : "" ?></td>
                                            <td class="alignment label_tb">Date Of Application</td>
                                            <td>:</td>
                                            <td class="alignment" id="admission_datE"><?php echo isset($user_data['applicationDate']) ? $user_data['applicationDate'] : "" ?></td>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Admission Type</td>
                                            <td>:</td>
                                            <td colspan='7' class="alignment" id="admType"><?php echo isset($user_data['admn_type']) ? $user_data['admn_type'] : "" ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h3>FAMILY DETAILS</h3>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb"><?php echo $parent_label ?></td>
                                            <td>:</td>
                                            <td class="alignment" id="fnamE"><?php echo isset($user_data['parentName']) ? $user_data['parentName'] : "" ?></td>

                                            <td class="alignment label_tb">Relation</td>
                                            <td>:</td>
                                            <td class="alignment" id="reltypE"><?php  echo  ($user_data['parentRelation'] == "M" ? "Mother" : $user_data['parentRelation'] == "F" ? "Father" : "Guardian"); ?></td>
                                            <td class="label_tb">Profession</td>
                                            <td>:</td>
                                            <td class="alignment" id="fprofessioN"><?php echo isset($user_data['profession_name']) ? $user_data['profession_name'] : "" ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h5 style="text-decoration:underline">COMMUNICATION ADDRESS</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb">Comm. Address</td>
                                            <td>:</td>
                                            <td class="alignment" id="fadD1"><?php echo isset($user_data['O_Address1']) ? $user_data['O_Address1'] : "" ?></td>
                                            <td class="alignment label_tb">Comm.Zip Code</td>
                                            <td>:</td>
                                            <td class="alignment" id="fziP"><?php echo isset($user_data['O_zip']) ? $user_data['O_zip'] : "" ?></td>
                                            <td class="alignment label_tb">Comm. Mobile No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="fmobilE"><?php echo isset($user_data['O_phone']) ? $user_data['O_phone'] : "" ?></td>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Comm. Phone No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="fphonE"><?php echo isset($user_data['O_mobile']) ? $user_data['O_mobile'] : "" ?></td>
                                            <td class="alignment label_tb">Comm.Email</td>
                                            <td>:</td>
                                            <td colspan='4' class="alignment" id="fmaiL"><?php echo isset($user_data['O_mail']) ? $user_data['O_mail'] : "" ?></td>

                                        </tr>
                                       <!--  <tr>
                                            <th colspan="9" align="center">
                                                <h5 style="text-decoration:underline"><?php echo strtoupper($permanent_address_label) ?></h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb">Permanent Address</td>
                                            <td>:</td>
                                            <td class="alignment" id="fcadD1"></td>
                                            <td class="alignment label_tb">Permanent Zip Code</td>
                                            <td>:</td>
                                            <td class="alignment" id="fczIP"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                            <td class="label_tb">Permanent Mobile No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="fcmobilE"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>

                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb">Permanent Phone No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="fcphonE"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                            <td class="alignment label_tb">Permanent Email</td>
                                            <td>:</td>
                                            <td colspan='4' class="alignment" id="fcmaiL"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h5 style="text-decoration:underline">OFFICE ADDRESS</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Office Address</td>
                                            <td>:</td>
                                            <td class="alignment" id="ofcadD1"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                            <td class="label_tb">Office Zip Code</td>
                                            <td>:</td>
                                            <td class="alignment" id="ofczIP"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                            <td class="alignment label_tb">Office Mobile No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="ofcmobilE"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb">Office Phone No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="ofcphonE"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                            <td class="label_tb">Office Email</td>
                                            <td>:</td>
                                            <td colspan='4' class="alignment" id="ofcmaiL"><?php echo isset($user_data['fname']) ? $user_data['fname'] : "" ?></td>
                                        </tr> -->
                                        <?php if ($this->session->userdata('inst_id') == 2) { ?>

                                            <tr>
                                                <th colspan="9" align="center">
                                                    <h5 style="text-decoration:underline">OTHER DETAILS</h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td class=" alignment label_tb">Student Passport </td>
                                                <td>:</td>
                                                <td class="alignment" id="stud_passport_view"><?php echo isset($user_data['stud_passport']) ? $user_data['stud_passport'] : "" ?></td>
                                                <td class="alignment label_tb">Place of Issue</td>
                                                <td>:</td>
                                                <td colspan='4' class="alignment" id="stud_placeofissue_view"><?php echo isset($user_data['stud_placeofissue']) ? $user_data['stud_placeofissue'] : "" ?></td>

                                            </tr>
                                            <tr>
                                                <td class="label_tb">Father Qualification</td>
                                                <td>:</td>
                                                <td class="alignment" id="f_qualification_view"><?php echo isset($user_data['f_qualification']) ? $user_data['f_qualification'] : "" ?></td>
                                                <td class="alignment label_tb">Father Nationality</td>
                                                <td>:</td>
                                                <td class="alignment" id="f_nationality_view"><?php echo isset($user_data['f_nationality']) ? $user_data['f_nationality'] : "" ?></td>
                                                <td class="alignment label_tb">Father Passport No.</td>
                                                <td>:</td>
                                                <td class="alignment" id="f_passport_view"><?php echo isset($user_data['f_passport']) ? $user_data['f_passport'] : "" ?></td>

                                            </tr>
                                            <tr>

                                                <td class="label_tb">Father Emirate ID</td>
                                                <td>:</td>
                                                <td class="alignment" id="f_emirate_id_view"><?php echo isset($user_data['f_emirate_id']) ? $user_data['f_emirate_id'] : "" ?></td>
                                                <td class="alignment label_tb">Mother Name</td>
                                                <td>:</td>
                                                <td class="alignment" id="m_name_view"><?php echo isset($user_data['m_name']) ? $user_data['m_name'] : "" ?></td>
                                                <td class="alignment label_tb">Mother Profession</td>
                                                <td>:</td>
                                                <td class="alignment" id="m_profession_view"><?php echo isset($user_data['m_profession']) ? $user_data['m_profession'] : "" ?></td>

                                            </tr>
                                            <tr>
                                                <td class="label_tb">Mother Qualification</td>
                                                <td>:</td>
                                                <td class="alignment" id="m_qualification_view"><?php echo isset($user_data['m_qualification']) ? $user_data['m_qualification'] : "" ?></td>
                                                <td class="alignment label_tb">Daughter/s</td>
                                                <td>:</td>
                                                <td class="alignment" id="daughter_count_view"><?php echo isset($user_data['daughter_count']) ? $user_data['daughter_count'] : "" ?></td>
                                                <td class="alignment label_tb">Son/s</td>
                                                <td>:</td>
                                                <td class="alignment" id="son_count_view"><?php echo isset($user_data['son_count']) ? $user_data['son_count'] : "" ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label_tb">Siblings in this School</td>
                                                <td>:</td>
                                                <td class="alignment" id="sibling_count_view"><?php echo isset($user_data['sibling_count']) ? $user_data['sibling_count'] : "" ?></td>
                                                <td class="alignment label_tb">Previous School</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_school_view"><?php echo isset($user_data['prev_school']) ? $user_data['prev_school'] : "" ?></td>
                                                <td class="alignment label_tb">Previous Class</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_class_view"><?php echo isset($user_data['prev_class']) ? $user_data['prev_class'] : "" ?></td>

                                            </tr>
                                            <tr>
                                                <td class="label_tb">Previous Curriculum</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_curriculum_view"></td>
                                                <td class="alignment label_tb">Previous Academic Year</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_acdyr_view"><?php echo isset($user_data['prev_acdyr']) ? $user_data['prev_acdyr'] : "" ?></td>
                                                <td class="alignment label_tb">Previous Medium of Instruction</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_moi_view"><?php echo isset($user_data['prev_moi']) ? $user_data['prev_moi'] : "" ?></td>
                                                <td class="alignment label_tb"></td>
                                            </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                            <div class="ibox ">
										
										<div class="ibox-content">
					
											<table class="table table-responsive" id="verify_table">
												<thead>
												<tr>
                                                    <th>#</th>
                                                    <th>Uploaded File Details</th>
													 <!-- <th>File</th> -->
													<!-- <th>Remarks</th>  -->
													<th>Verify</th> 
												</tr>
												</thead>
												<tbody>
                                                  <?php  $inc = 1; 
                                                  $document_id = 0;
                                                   foreach($documents_data as $docdata ){  
                                                       if($docdata['document_id']!=$document_id){
                                                        $document_id = $docdata['document_id'];
                                                       ?> 
												<tr>
                                                    <td><?php echo $inc; ?> </td>
                                                    <td><?php echo $docdata['document_name'];?></td>
													<td hidden><input type="hidden" class="temp_id" name="temp_id" value="<?php echo $docdata['temp_id'];?>"></td>
													<td hidden><input type="hidden" class="inst_id" name="inst_id" value="<?php echo $docdata['inst_id'];?>"></td>
													<td hidden><input type="hidden" class="document_id" name="document_id" value="<?php echo $docdata['document_id'];?>"></td>
                                                
													<!-- <td>
                                                        <?php if($docdata['file_1_type']!=".pdf"){?>
                                                        <a target="_blank" href="<?php echo base_url();?>/assets/Uploads/documents/temp_registration/<?php echo $docdata['file_1']; ?>" >
                                                                <img src="<?php echo base_url();?>/assets/Uploads/documents/temp_registration/<?php echo $docdata['file_1']; ?>" width="300px" height="100px" class="img-thumbnail img-rounded">
                                                            </a>
                                                        <?php }else{ ?>
                                                            <a class="btn btn-primary" target="_blank" href="<?php echo base_url();?>/assets/Uploads/documents/temp_registration/<?php echo $docdata['file_1']; ?>">
                                                            <i class="fa fa-file-pdf-o"></i>Show PDF</a>
                                                        <?php } ?>
                                                    </td> --><!-- 
                                                    <td><p><textarea data-max-words="25" rows="2"  data-announce="true"></textarea></p></td> -->
													<td class=""> <input type="checkbox" name="check_verify" onclick="$(this).attr('value', this.checked ? 1 : 0)" class="check_verify" value="<?php  if($docdata['isverified'] == 2){ $checked="checked"; echo 1;}else{ $checked=""; echo 0;} ?>" <?php echo $checked; ?>>  </td>
                                                </tr>
                                                <?php $inc++; } } ?>
                                                <tr><td class="text-center" colspan="3"><a class="btn btn-primary" target="_blank" href="<?php echo base_url();?>/uploads/documents/temp_registration/<?php echo $docdata['file_1_pdf']; ?>">
                                                            <i class="fa fa-file-pdf-o"></i>View Documents</a></td></tr> 
                                                <tr><td>Remarks :</td><td class="text-center"  colspan="3"><p>
                                                <?php if ((trim($docdata['remarks']))!="" ){?> 
                                                    <textarea name="remarks" class="form-group remarks"  data-toggle="tooltips" title="Please Give a Message" placeholder="Please Give a Message" style="margin: 0px; width: 600px; height: 80px; resize: none;" maxlength="240" data-max-words="25" rows="2"  data-announce="true"><?php if (empty(trim($docdata['remarks']))){echo  trim($docdata['remarks']);} ?> </textarea>
                                                    </p><span id="rchars"><?php if (empty(trim($docdata['remarks']))){ echo (240 - strlen(trim($docdata['remarks']))); }?></span> Character(s) Remaining
                                                <?php }else{ ?>
                                                    <textarea name="remarks" class="form-group remarks" data-toggle="tooltip" title="Please Give a Message" placeholder="Please Give a Message" style="margin: 0px; width: 600px; height: 80px; resize: none;" maxlength="240" data-max-words="25" rows="2"  data-announce="true"></textarea>
                                                    </p><span id="rchars">240</span> Character(s) Remaining
                                                    <?php } ?>
                                                
                                                
                                            </td><td class="pdfid" hidden><?php echo $docdata['pdfid']; ?></td></tr>
                                                
                                                </tbody>
											</table>
											<hr>
											<div class="text-center">
											<a class="btn btn-default" href="javascript:void(0);" class="icon-close" onclick="cancel_data();">Cancel</a>
											<a class="btn btn-danger" href="javascript:void(0);" class="icon-save" onclick="submit_data(3);">Reject</a>
											<a class="btn btn-warning" href="javascript:void(0);" class="icon-save" onclick="submit_data(4);">Resubmit</a>
											<a class="btn btn-primary" href="javascript:void(0);" class="icon-save" onclick="submit_data(2);">Accept</a>
											</div>
											<!-- <div id="blueimp-gallery" class="blueimp-gallery">
												<div class="slides"></div>
												<h3 class="title"></h3>
												<a class="prev">‹</a>
												<a class="next">›</a>
												<a class="close">×</a>
												<a class="play-pause"></a>
												<ol class="indicator"></ol>
							                </div>  -->
                                        </div>
                                        
									</div>
                                                            

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<script>
var maxLength = 240;
$('textarea').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  $('#rchars').text(textlen);
});
</script>
