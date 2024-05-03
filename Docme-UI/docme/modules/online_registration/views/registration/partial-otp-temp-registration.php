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
                        <div class="alert alert-info" id="verify_well"></div>
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
                                            <?php if ($uuid_unit_limit == 12) {
                                                $label_uniq = 'Aadhar Number';
                                            } else {
                                                $label_uniq =  'Emirates ID';
                                            }   ?>
                                            <td width="16%" class="label_tb"><?php echo $label_uniq; ?></td>
                                            <td width="1%">:</td>
                                            <td width="17%" class="alignment" id="unique_identitY"></td>
                                            <td width="15%" class="alignment label_tb">First Name</td>
                                            <td width="1%">:</td>
                                            <td width="17%" class="alignment" id="firstName"></td>
                                            <td width="15%" class="alignment label_tb">Middle Name</td>
                                            <td width="1%">:</td>
                                            <td width="17%" class="alignment" id="middleName"></td>


                                        </tr>
                                        <tr>
                                            <td class="label_tb">Last Name</td>
                                            <td>:</td>
                                            <td class="alignment" id="lastName"></td>
                                            <td class="alignment label_tb">Gender</td>
                                            <td>:</td>
                                            <td class="alignment" id="gendeR"></td>
                                            <td class="alignment label_tb"> Date Of Birth</td>
                                            <td>:</td>
                                            <td class="alignment" id="dob_datE"></td>


                                        </tr>

                                        <tr>
                                            <td class="label_tb">Age</td>
                                            <td>:</td>
                                            <td class="alignment" id="agE"></td>
                                            <td class="alignment label_tb">Country</td>
                                            <td>:</td>
                                            <td class="alignment" id="country_selecT"></td>
                                            <td class="alignment label_tb">Nationality</td>
                                            <td>:</td>
                                            <td class="alignment" id="nationalitY"></td>


                                        </tr>
                                        <tr>
                                            <td class="label_tb">State</td>
                                            <td>:</td>
                                            <td class="alignment" id="state_selecT"></td>
                                            <td class="alignment label_tb">District</td>
                                            <td>:</td>
                                            <td class="alignment" id="district_selecT"></td>
                                            <td class="alignment label_tb">Mother Tongue</td>
                                            <td>:</td>
                                            <td class="alignment" id="mother_tonguE"></td>

                                        </tr>
                                        <tr>
                                            <td class="label_tb">Optional Language</td>
                                            <td>:</td>
                                            <td class="alignment" id="language_selecT"></td>
                                            <td class="alignment label_tb">Religion</td>
                                            <td>:</td>
                                            <td class="alignment" id="religion_selecT"></td>
                                            <td class="alignment label_tb">Caste</td>
                                            <td>:</td>
                                            <td class="alignment" id="caste_selecT"></td>
                                        </tr>

                                        <tr>
                                            <td class="label_tb">Community</td>
                                            <td>:</td>
                                            <td class="alignment" id="community_selecT"></td>
                                            <td class="alignment label_tb">Blood Group</td>
                                            <td>:</td>
                                            <td class="alignment" id="bloodGroup"></td>
                                            <td class="alignment label_tb">Pickup Point</td>
                                            <td>:</td>
                                            <td class="alignment" id="pickupPOINT"></td>

                                        </tr>
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h3>ACADEMIC AND REGISTRATION DETAILS</h3>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Academic Year</td>
                                            <td>:</td>
                                            <td class="alignment" id="academic_yeaR"></td>
                                            <td class="alignment label_tb">Syllabus</td>
                                            <td>:</td>
                                            <td class="alignment" id="stream_iD"></td>
                                            <td class="alignment label_tb">Class</td>
                                            <td>:</td>
                                            <td class="alignment" id="class_detailS"></td>
                                        </tr>
                                        <tr id="subjects_list">
                                            <td class="label_tb">Manadatory Subjects</td>
                                            <td>:</td>
                                            <td class="alignment" id="mand_subjects"></td>
                                            <td class="alignment label_tb">Optional Subject 1</td>
                                            <td>:</td>
                                            <td class="alignment" id="opt_sub_1"></td>
                                            <td class="alignment label_tb">Optional Subject 2</td>
                                            <td>:</td>
                                            <td class="alignment" id="opt_sub_2"></td>
                                        </tr>

                                        <tr>
                                            <td class="label_tb">Birth Country</td>
                                            <td>:</td>
                                            <td class="alignment" id="birth_countrY"></td>
                                            <td class="alignment label_tb">Birth State</td>
                                            <td>:</td>
                                            <td class="alignment" id="birth_state_view"></td>
                                            <td class="alignment label_tb">Birth District</td>
                                            <td>:</td>
                                            <td class="alignment" id="birth_district_view"></td>

                                        </tr>
                                        <tr>
                                            <td class="label_tb">Birth Place</td>
                                            <td>:</td>
                                            <td class="alignment" id="birth_placE"></td>
                                            <td class="alignment label_tb">Entrance Date</td>
                                            <td>:</td>
                                            <td class="alignment" id="view_entrance_date"></td>
                                            <td class="alignment label_tb">Date Of Application</td>
                                            <td>:</td>
                                            <td class="alignment" id="admission_datE"></td>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Admission Type</td>
                                            <td>:</td>
                                            <td colspan='7' class="alignment" id="admType"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="9">
                                                <h5 style="text-decoration:underline">Siblings List</h5>
                                                <table id="siblingList">
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h3>FAMILY DETAILS</h3>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb"><?php echo $parent_label ?></td>
                                            <td>:</td>
                                            <td class="alignment" id="fnamE"></td>
                                            <td class="alignment label_tb">Relation</td>
                                            <td>:</td>
                                            <td class="alignment" id="reltypE"></td>
                                            <td class="label_tb">Profession</td>
                                            <td>:</td>
                                            <td class="alignment" id="fprofessioN"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h5 style="text-decoration:underline">COMMUNICATION ADDRESS</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb">Comm. Address</td>
                                            <td>:</td>
                                            <td class="alignment" id="fadD1"></td>
                                            <td class="alignment label_tb">Comm.Zip Code</td>
                                            <td>:</td>
                                            <td class="alignment" id="fziP"></td>
                                            <td class="alignment label_tb">Comm. Mobile No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="fmobilE"></td>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Comm. Phone No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="fphonE"></td>
                                            <td class="alignment label_tb">Comm.Email</td>
                                            <td>:</td>
                                            <td colspan='4' class="alignment" id="fmaiL"></td>

                                        </tr>
                                        <tr>
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
                                            <td class="alignment" id="fczIP"></td>
                                            <td class="label_tb">Permanent Mobile No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="fcmobilE"></td>

                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb">Permanent Phone No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="fcphonE"></td>
                                            <td class="alignment label_tb">Permanent Email</td>
                                            <td>:</td>
                                            <td colspan='4' class="alignment" id="fcmaiL"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="9" align="center">
                                                <h5 style="text-decoration:underline">OFFICE ADDRESS</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="label_tb">Office Address</td>
                                            <td>:</td>
                                            <td class="alignment" id="ofcadD1"></td>
                                            <td class="label_tb">Office Zip Code</td>
                                            <td>:</td>
                                            <td class="alignment" id="ofczIP"></td>
                                            <td class="alignment label_tb">Office Mobile No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="ofcmobilE"></td>
                                        </tr>
                                        <tr>
                                            <td class="alignment label_tb">Office Phone No.</td>
                                            <td>:</td>
                                            <td class="alignment" id="ofcphonE"></td>
                                            <td class="label_tb">Office Email</td>
                                            <td>:</td>
                                            <td colspan='4' class="alignment" id="ofcmaiL"></td>
                                        </tr>
                                        <?php if ($this->session->userdata('inst_id') == 2) { ?>

                                            <tr>
                                                <th colspan="9" align="center">
                                                    <h5 style="text-decoration:underline">OTHER DETAILS</h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td class=" alignment label_tb">Student Passport </td>
                                                <td>:</td>
                                                <td class="alignment" id="stud_passport_view"></td>
                                                <td class="alignment label_tb">Place of Issue</td>
                                                <td>:</td>
                                                <td colspan='4' class="alignment" id="stud_placeofissue_view"></td>

                                            </tr>
                                            <tr>
                                                <td class="label_tb">Father Qualification</td>
                                                <td>:</td>
                                                <td class="alignment" id="f_qualification_view"></td>
                                                <td class="alignment label_tb">Father Nationality</td>
                                                <td>:</td>
                                                <td class="alignment" id="f_nationality_view"></td>
                                                <td class="alignment label_tb">Father Passport No.</td>
                                                <td>:</td>
                                                <td class="alignment" id="f_passport_view"></td>

                                            </tr>
                                            <tr>

                                                <td class="label_tb">Father Emirate ID</td>
                                                <td>:</td>
                                                <td class="alignment" id="f_emirate_id_view"></td>
                                                <td class="alignment label_tb">Mother Name</td>
                                                <td>:</td>
                                                <td class="alignment" id="m_name_view"></td>
                                                <td class="alignment label_tb">Mother Profession</td>
                                                <td>:</td>
                                                <td class="alignment" id="m_profession_view"></td>

                                            </tr>
                                            <tr>
                                                <td class="label_tb">Mother Qualification</td>
                                                <td>:</td>
                                                <td class="alignment" id="m_qualification_view"></td>
                                                <td class="alignment label_tb">Daughter/s</td>
                                                <td>:</td>
                                                <td class="alignment" id="daughter_count_view"></td>
                                                <td class="alignment label_tb">Son/s</td>
                                                <td>:</td>
                                                <td class="alignment" id="son_count_view"></td>
                                            </tr>
                                            <tr>
                                                <td class="label_tb">Siblings in this School</td>
                                                <td>:</td>
                                                <td class="alignment" id="sibling_count_view"></td>
                                                <td class="alignment label_tb">Previous School</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_school_view"></td>
                                                <td class="alignment label_tb">Previous Class</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_class_view"></td>

                                            </tr>
                                            <tr>
                                                <td class="label_tb">Previous Curriculum</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_curriculum_view"></td>
                                                <td class="alignment label_tb">Previous Academic Year</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_acdyr_view"></td>
                                                <td class="alignment label_tb">Previous Medium of Instruction</td>
                                                <td>:</td>
                                                <td class="alignment" id="prev_moi_view"></td>
                                                <td class="alignment label_tb"></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th colspan="9" align="left">
                                                <h5 style="text-decoration:underline">Instructions:</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="9" align="left">
                                                1.Online Registration is only completed on Payment if applicable.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" align="left">
                                                2.Auto filled Registration form will be sent to communication email id as attachment.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" align="left">
                                                3.Link for online payment can be found in the acknowldegement email send to the email <b><span id="f_c_email"></span></b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                            <form action="#" id="otp_form">
                                <table class="table invoice-total">
                                    <tbody>
                                        <tr>
                                            <td><strong>Enter OTP :</strong></td>
                                            <td style="text-align:left"><input type="text" id="otp_verification" name="otp_verification" maxlength="7" onkeypress="return typeNumberOnly(event)" />
                                                <input type="hidden" id="email_val_verify" name="email_val_verify" />
                                                <span id="otp_error" style="color:#8a1f11;font-weight:bold"></span>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <a href="#" onClick="ResendOTP()">Resend</a>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>