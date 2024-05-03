<html>


<body>
    <table width="100%" cellpadding="2" cellspacing="0" border="0" align="left">
        <tr>
            <td width="10%" rowspan="2" align="center">
                <img src="<?php echo base_url('assets/inst_logos/2_logo.png'); ?>" alt="School Logo" width="90" />
            </td>
            <td width="80%" align="center">
                <img src="<?php echo base_url('assets/inst_logos/2_logo_words.png'); ?>" alt="School Name Logo" width="75%" />
            </td>

        </tr>
    </table>
    <div class="afr">
        <span style="font-size:14px;font-weight:bold;">APPLICATION FOR REGISTRATION</span>
        <span style="font-size:14px;font-weight:normal;" align="center">ACADEMIC YEAR <?php echo $temp_data['acdyr']; ?></span>
    </div>
    <div style="text-align:center">
        <span style="font-size:14px;font-weight:bold;">CLASS TO WHICH REGISTRATION IS REQUIRED</span><br />
        <span class="box-border" align="center"><?php echo $temp_data['class']; ?></span>
    </div>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td align="left">
                <span style="font-size:12px;font-style:italic"> * Please verify the following details submitted by you:
                </span>
            </td>
            <td class="default-font" width="12%" align="left" style="font-weight:bold;font-size:14px;">
                Token No.
            </td>
            <td align="left" width="2%">:</td>
            <td class="box-border default-font" align="left">
                <?php echo $temp_data['TempAdmn_No']; ?>
            </td>
        </tr>
    </table>
    <h4 style="text-align:center;margin-top:2px;margin-bottom:2px">DETAILS OF CHILD / CANDIDATE</h4>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="15%" align="left" style="font-weight:bold;font-size:12px;">
                Name of Child
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="50%" class="box-border default-font"> <?php echo $temp_data['fname'] . " " . $temp_data['mname'] . " " . $temp_data['lname']; ?></td>

            <td class="default-font" width="10%" align="left" style="font-weight:bold;font-size:12px;">
                Gender
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="20%" class="box-border default-font"> <?php echo $temp_data['gender']; ?></td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td>&nbsp;</td>
            <td class="italic_font" width="5%" align="center" style="font-weight:bold;font-size:12px;">
                Day
            </td>
            <td width="1%">&nbsp;</td>
            <td class="italic_font" width="6%" align="center" style="font-weight:bold;font-size:12px;">
                Month
            </td>
            <td width="1%">&nbsp;</td>
            <td class="italic_font" width="6%" align="center" style="font-weight:bold;font-size:12px;">
                Year
            </td>
            <td width="1%">&nbsp;</td>
            <td class="italic_font" width="15%" align="center" style="font-weight:bold;font-size:12px;">
                Age <span style="font-size:10px"> as on <?php echo date("dS M Y", strtotime($age_calc_date)); ?></span>
            </td>
        </tr>
        <tr>
            <td class="default-font" width="15%" align="left" style="font-weight:normal;font-size:12px;">
                Date Of Birth
            </td>
            <td align="left" width="5%" class="box-border default-font"><?php echo date("d", strtotime($temp_data['dobunformated'])); ?></td>
            <td>&nbsp;</td>
            <td align="left" width="5%" class="box-border default-font"><?php echo date("m", strtotime($temp_data['dobunformated'])); ?></td>
            <td>&nbsp;</td>
            <td align="left" width="6%" class="box-border default-font"><?php echo date("Y", strtotime($temp_data['dobunformated'])); ?></td>
            <td>&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font"> <?php echo $age_string; ?></td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="italic_font" width="12%" align="center" style="font-weight:bold;font-size:12px;">
                Nationality
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="14%" align="center" style="font-weight:bold;font-size:12px;">
                Place of Birth
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="12%" align="center" style="font-weight:bold;font-size:12px;">
                Country
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="14%" align="center" style="font-weight:bold;font-size:12px;">
                Religion
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="14%" align="center" style="font-weight:bold;font-size:12px;">
                Caste ( if any)
            </td>
        </tr>
        <tr>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['nationality']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['birthPlace']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['birthCountry']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['religion_name']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['caste_name']; ?>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="italic_font" width="14%" align="center" style="font-weight:bold;font-size:12px;">
                Mother Tongue
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="14%" align="center" style="font-weight:bold;font-size:12px;">
                Emirates ID No.
            </td>
            <td align="right" width="16%">&nbsp;</td>
            <td class="italic_font" width="8%" align="center" style="font-weight:bold;font-size:12px;">
                Number
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="12%" align="center" style="font-weight:bold;font-size:12px;">
                Place of Issue
            </td>
        </tr>
        <tr>
            <td align="left" width="10%" class="box-border font-size:12px;">
                <?php echo $temp_data['mothertongue']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border">
                <?php echo $temp_data['emirate_Id']; ?>
            </td>
            <td align="center" style="font-weight:bold;font-size:10px;" width="16%">Passport Details</td>
            <td align="left" width="15%" class="box-border">
                <?php echo $temp_data['stud_passport']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border">
                <?php echo $temp_data['stud_placeofissue']; ?>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="italic_font" width="25%" align="left" style="font-weight:bold;font-size:12px;">
                Detail of Present School /Last School Attended (If applicable)
            </td>
            <td width="75%">
                <table class="tabledeatilsparents">
                    <thead>
                        <tr>
                            <th>Name of School</th>
                            <th>Class</th>
                            <th>Curriculum</th>
                            <th>Academic Year</th>
                            <th>Medium of Instruction</th>

                        </tr>
                    </thead>
                    <tbody style="border:1px solid black">
                        <tr>
                            <td><?php echo $temp_data['prev_school']; ?></td>
                            <td><?php echo $temp_data['prev_class']; ?></td>
                            <td><?php echo $temp_data['prev_curriculum']; ?></td>
                            <td><?php echo $temp_data['prev_acdyr']; ?></td>
                            <td><?php echo $temp_data['prev_moi']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>


        </tr>
    </table>
    <h4 style="text-align:center;margin-top:3px;margin-bottom:3px">
        DETAILS OF PARENTS & OTHER RELEVANT INFORMATION</h4>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="15%" align="left" style="font-weight:bold;font-size:12px;">
                Name of Father
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="30%" class="box-border default-font">
                <?php echo $temp_data['parentName']; ?>
            </td>
            <td class="default-font" width="15%" align="left" style="font-weight:bold;font-size:12px;">
                Name of Mother
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="30%" class="box-border default-font">
                <?php echo $temp_data['m_name'];
                ?>
            </td>
        </tr>
        <tr>
            <td colspan=6></td>
        </tr>
        <!-- </table>
    <div class="topspace"></div>
    <table class="table" width="100%" cellpadding="5"> -->
        <tr>
            <td class="default-font" width="20%" align="left" style="font-weight:bold;font-size:12px;">
                Qualification
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="box-border default-font">
                <?php echo $temp_data['f_qualification'];
                ?>
            </td>
            <td class="default-font" width="20%" align="left" style="font-weight:bold;font-size:12px;">
                Qualification
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="box-border default-font">
                <?php echo $temp_data['m_qualification'];
                ?>
            </td>
        </tr>
        <tr>
            <td colspan=6></td>
        </tr>
        <!-- </table>
    <div class="topspace"></div>
    <table class="table" width="100%" cellpadding="5"> -->
        <tr>
            <td class="default-font" width="20%" align="left" style="font-weight:bold;font-size:12px;">
                Profession
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="box-border default-font">
                <?php echo $temp_data['profession_name']; ?>
            </td>
            <td class="default-font" width="20%" align="left" style="font-weight:bold;font-size:12px;">
                Profession
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="box-border default-font">
                <?php echo $temp_data['mother_profession'];
                ?>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td>&nbsp;</td>
            <td class="italic_font" width="8%" align="center" style="font-weight:bold;">
                P.O.Box
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="10%" align="center" style="font-weight:bold;">
                Mobile
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="12%" align="center" style="font-weight:bold;">
                Landline
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td class="italic_font" width="8%" align="center" style="font-weight:bold;">
                Email Id
            </td>
        </tr>
        <tr>
            <td class="default-font" width="18%" align="left" style="font-weight:bold;font-size:12px;">
                Contact Details
            </td>
            <td align="left" width="10%" class="box-border default-font">
                <?php echo $temp_data['L_zip']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['L_mobile']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['L_phone']; ?>
            </td>
            <td align="right" width="1%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['L_mail']; ?>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="italic_font" width="25%" align="left" style="font-weight:bold;font-size:12px;">
                Address in U.A.E.

            </td>
            <td width="75%">
                <table class="tabledeatilsparents">
                    <thead>
                        <tr>
                            <th>Area & Emirate</th>
                            <th>Building& Flat No.</th>
                            <th>Landmark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $formatted_address['communication_address_string']; ?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td class="italic_font" width="25%" align="left" style="font-weight:bold;font-size:12px;">
                Contact Details in Home Country
            </td>
            <td width="75%">
                <table width="100%" class="tabledeatilsparents">
                    <thead>
                        <tr>
                            <th width="65%">Address</th>
                            <th width="35%">Tel/Mobile No. (Area Code)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $formatted_address['permanent_address_string']; ?></td>
                            <td><?php echo $temp_data['O_mobile']; ?></td>

                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td>&nbsp;</td>
            <td class="italic_font" width="8%" align="center" style="font-weight:bold;">
                Nationality
            </td>
            <td align="center" width="2%">&nbsp;</td>
            <td class="italic_font" width="10%" align="center" style="font-weight:bold;">
                Passport No.
            </td>
            <td align="center" width="2%">&nbsp;</td>
            <td class="italic_font" width="12%" align="center" style="font-weight:bold;">
                Emirates ID No.
            </td>
        </tr>
        <tr>
            <td class="default-font" width="12%" align="left" style="font-weight:bold;font-size:12px;">
                Parent [ID]
            </td>
            <td align="left" width="10%" class="box-border default-font">
                <?php echo $temp_data['f_nationality']; ?>
            </td>
            <td align="center" width="2%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font"><?php echo $temp_data['f_passport']; ?></td>
            <td align="center" width="2%">&nbsp;</td>
            <td align="left" width="15%" class="box-border default-font">
                <?php echo $temp_data['f_emirate_id']; ?>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default_font" width="10%" align="left" style="font-weight:bold;font-size:12px;">
                Details of Brother/Sister studying in this school if any
            </td>
            <td width="90%">
                <table width="100%" class="tabledeatilsparents">
                    <thead>
                        <tr>
                            <th>Name of Brother/Sister</th>
                            <th>Computer No.</th>
                            <th>Class & Div.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $empty_rows = 5;
                        if ($temp_data['siblings_details'] != '') {
                            $sibiling_details = json_decode($temp_data['siblings_details'], true);
                            $size = sizeof($sibiling_details);
                            $empty_rows = 5 - $size;
                            $k = 0;
                            if ($size > 0) {
                                foreach ($sibiling_details as $sib_data) {
                                    if ($k < 5) { ?>
                                        <tr>
                                            <td><?php echo $sib_data['sib_name'] ?></td>
                                            <td><?php echo $sib_data['sib_admn'] ?></td>
                                            <td><?php echo $sib_data['sib_class'] ?></td>
                                        </tr>
                            <?php
                                            $k++;
                                        }
                                    }
                                }
                            }
                            for ($i = 0; $i < $empty_rows; $i++) { ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td class="default_font" width="10%" align="left" style="font-weight:bold;font-size:12px;">
                Total number of Children

            </td>
            <td width="90%">
                <table width="100%" class="tabledeatilsparents">
                    <thead>
                        <tr>
                            <th>Daughter/s</th>
                            <th>Son/s</th>
                            <th>No. of Brother/Sister studying in this school</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center"><?php echo $temp_data['daughter_count']; ?></td>
                            <td align="center"><?php echo $temp_data['son_count']; ?></td>
                            <td align="center"><?php echo $temp_data['sibling_count']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="italic_font" align="right" style="font-weight:normal;font-size:8px">
                <!--Contd...on page 2-->
            </td>
        </tr>
    </table>
    <br />
    <!--<br /> -->
    <table class="table" width="100%">
        <tr>
            <td class="italic_font" align="right" style="font-weight:normal;font-size:8px">&nbsp;</td>
        </tr>
    </table>
    <table class="table" width="100%">
        <tr>
            <td class="default-font" width="25%" align="left" style="font-weight:bold">
                Token No
            </td>
            <td align="right" width="5%;">:</td>
            <td align="left" width="25%" class="box-border default-font"><?php echo $temp_data['TempAdmn_No']; ?></td>
            <td class="italic_font" align="right" style="font-weight:normal;font-size:8px">Contd...from page 1</td>
        </tr>
    </table>
    <h4 style="text-align:center">SCHOOL TRANSPORT IF REQUIRED</h4>
    <p class="italic_font" style="font-weight:normal;font-size:12px">[*Please note that this is an optional school facility & depends on the Area & Location applied
        by the school transport system]
    </p>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" align="left" style="font-weight:bold">
                * Do you need school Transport facility?
            </td>
            <td align="right" width="2%">:</td>
            <td align="left">
                <?php if ($temp_data['pickpointName'] == '' || $temp_data['pickpointName'] == '-') {
                    $yes_img = 'unchecked-checkbox.png';
                    $no_img = 'checked-checkbox.png';
                } else {
                    $yes_img = 'checked-checkbox.png';
                    $no_img = 'unchecked-checkbox.png';
                } ?>
                <span class="img-label">Yes</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $yes_img); ?>" alt="School Name Logo" />
                <span class="img-label">No</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $no_img); ?>" alt="School Name Logo" />
                (Put <img class="img-tick" src="<?php echo base_url('assets/img/online-reg/tick.png'); ?>" alt="School Name Logo" /> Mark)
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default_font" width="25%" align="left" style="font-weight:bold;font-size:12px;">
                If Yes, Details of location[Sharjah / Ajman only]

            </td>
            <td width="75%">
                <table class="tabledeatilsparents">
                    <thead>
                        <tr>
                            <th>Address</th>
                            <th>Landmark for Location</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $temp_data['pickpointName'] ?></td>
                            <td>&nbsp;</td>

                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <p class="italic_font" style="font-weight:normal;font-size:12px">* Please note that it is compulsory to fill in all the applicable domains and kindly acknowledge
        all the formalities / details admission / submission of documents before agreeing and signing
        the declaration</p>
    <div class="rounded-border details_table_div" style="height:130px;padding:10px;border-bottom:1px solid">
        <h5 style="margin-left:30px;margin-bottom:10px">Conditions :</h5>
        <div style="margin-left:50px;font-size:12px">
            1) Registration does not guarantee admission.<br />
            2) Admission to KG.2 onwards will be based on Entrance Test.<br />
            3) Final admission depends upon the availability of seats in each grade.<br />
            4) Refer to other details/ conditions as published in the registration domain of school
            website.<br />
        </div>
        <h5 style="margin-left:30px;margin-bottom:10px">Copies of documents to be submitted alongwith this:</h5>
        <div style="margin-left:50px;font-size:12px">
            1) Photocopy of Valid Passport and Emirates ID of Student & Parents.<br />
            2) 2 Passport size Photographs.<br />
            3) Copy of Birth Certificate.<br />
            4) Copy of this duly completed “Application Online Registration Form” .<br />
        </div>
    </div><br />
    <div class="info">
        <p style="font-size:12px;font-weight:bold">Submission date of “Online Registration Forms" with required documents to the school registration office on <?php echo date("l dS F Y", strtotime($lastsubmissiondate)); ?> Between 8:00 AM & 01:00 PM</p>
    </div>
    <div style="height:100px;">
        <h4 style="text-decoration:underline">Declaration by Parent:</h4>
        <span style="font-size:12px">
            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;I hereby confirm that the details furnished herein <span style="font-weight:bold;"> [Application for registration] </span> are
            true to the best of my knowledge and all copies/ of originals of documents will be furnished as
            required. I also acknowledge all details and formalities of registration / admission and will
            abide to the rules and regulations of the school.
            <br />
            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; * I also hereby acknowledge that the submission of this ‘Registration Form‘ does not
            guarantee a seat for the application request.</span>

    </div><br />
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="50%" align="left" style="font-weight:bold">
                Date:
            </td>
            <td align="right" style="font-weight:bold">(Signature of the Parent)</td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="dotted-border"></td>
        </tr>
    </table>
    <h4 style="text-decoration:underline;text-align:center">For Office Use Only</h4>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class=" default-font" width="20%" align="left" style="font-weight:bold;font-size:12px;">
                Registration No
            </td>
            <td align="right" width="2%;">:</td>
            <td align="left" class="dotted-border">&nbsp;</td>
            <td class="default-font" width="22%" align="left" style="font-weight:normal;font-size:12px;">&nbsp;</td>
            <td align="right" width="2%">&nbsp;</td>
            <td align="left" width="25%">&nbsp;</td>
        </tr>
        <!-- </table>
    <table class="table" width="100%" cellpadding="5"> -->
        <tr>
            <td class="default-font" width="22%" align="left" style="font-weight:normal;font-size:12px;">
                Verified By
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="25%" class="dotted-border"></td>
            <td class="default-font" width="22%" align="right" style="font-weight:normal;font-size:12px;">
                Signature of PRINCIPAL
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="25%" class="dotted-border"></td>
        </tr>
    </table>
    <h4 style="text-decoration:underline;text-align:center">Fee Payment Details</h4>

    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="22%" align="left" style="font-weight:normal;font-size:12px;">
                Amount Paid
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="38%" class="dotted-border"></td>
            <td class="default-font" width="10%" align="left" style="font-weight:normal;font-size:12px;">
                Voucher No
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="26%" class="dotted-border"></td>
        </tr>
        <!-- </table>
    <table class="table" width="100%" cellpadding="5"> -->
        <tr>
            <td class="default-font" align="left" style="font-weight:normal;font-size:12px;">
                Signature of the Cashier
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
            <td class="default-font" align="left" style="font-weight:normal;font-size:12px;">
                Date
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
        </tr>
    </table>

</body>

</html>

<style>
    body {
        font-family: sans-serif;
    }

    .table {
        border-spacing: 0;
        border-collapse: collapse;
        font-size: 11px;
    }

    .dotted-border {
        border-bottom: 1px dotted;
    }

    .box-border {
        border: 1px solid;
    }

    .img-check {
        margin-bottom: -8px;
        margin-right: 9px;
        margin-left: 5px;

    }

    .img-tick {
        margin-bottom: -5px;
        margin-left: 5px;
    }

    .rounded-border {
        border: 1px solid;
        border-radius: 5px;
    }

    .details_table_div {
        width: 100%;
        height: 177px;
        margin: 0px;
        padding: 0px;
        border-bottom: none;
    }

    .default-font {
        font-size: 13px;

    }

    .italic_font {
        font-style: italic;
        font-weight: bold;
    }

    .first_cl {
        border-left: 0px !important;
    }

    .last_row {
        border-bottom: 0px !important;
    }

    .table-bordered tbody tr td,
    .table-bordered tbody tr th,
    .table-bordered tfoot tr td,
    .table-bordered tfoot tr th,
    .table-bordered thead tr td,
    .table-bordered thead tr th,
    .table-bordered tr th,
    .table-bordered tr td {
        border: 1px solid #333;
        border-right: 0px;
        border-top: 0px;
        height: 35px;
        padding: 5px;
    }

    .info {
        border: 2px solid black;
        padding: 5px;
    }

    .afr {
        border: 2px solid black;
        margin: auto;
        width: 40%;
        border-radius: 5px;
        text-align: center;
    }

    .tabledeatilsparents {
        padding: 2px;
        border-collapse: collapse;
    }

    .tabledeatilsparents thead tr th,
    .tabledeatilsparents tbody tr td {
        border: 1px solid black;
        padding: 5px;
    }

    .topspace {
        margin-top: 10px;
    }



    @page {
        size: auto;
        margin: 7mm;
    }
</style>