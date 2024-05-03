<html>

<body>
    <table width="100%" cellpadding="2" cellspacing="0" border="0" align="left">
        <tr>
            <td width="20%" rowspan="2" align="center">
                <img src="<?php echo base_url('assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="School Logo" width="90" />
            </td>
            <td width="60%" align="center">
                <img src="<?php echo base_url('assets/inst_logos/' . $inst_id . '_logo_words.png'); ?>" alt="School Name Logo" width="50%" />
            </td>
            <td width="20%" align="center" rowspan="2">
                <img src="<?php echo base_url('assets/img/online-reg/photo.png'); ?>" alt="Photo" width="90" />
            </td>
        </tr>
        <tr>
            <td width="60%" align="center">
                <p style="text-align: center;font-size:20px;font-weight:bold">Academic Year <?php echo $temp_data['acdyr'] ?> </p>
            </td>
        </tr>
    </table>
    <div class="clear"></div>
    <hr style="color:#000">
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td align="left">
                <span style="font-weight:bold;font-size:15px">Dear Applicant,<br /><br />
                    Thank you for using our online registration facility. Your Token Number is <b><?php echo $temp_data['TempAdmn_No']; ?></b>. This is valid only for 7 working days.
                </span><br /><br />
                <span style="text-decoration:underline;font-size:10px">Please verify the following details submitted by you:
            </td>
            <td>

            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="25%" align="left">
                Name of the Student
            </td>
            <td align="right">:</td>
            <td class="default-font dotted-border" width="75%" align="left">
                <?php echo $temp_data['fname']; ?> <?php echo $temp_data['mname']; ?> <?php echo $temp_data['lname']; ?>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="50%" align="left">
                Standard to which Registration is required
            </td>
            <td align="right" width="2%">:</td>
            <td class="default-font" align="left">
                <input class="input_border" type="text" value="<?php echo $temp_data['class']; ?>">
            </td>
        </tr>
        <tr>
            <td class="default-font" align="left">
                Syllabus to which Registration is required
            </td>
            <td align="right" width="2%">:</td>
            <td align="left">
                <?php if ($temp_data['stream_code'] == 'CBSE') {
                    $cbse_img = 'checked-checkbox.png';
                    $monti_img = 'unchecked-checkbox.png';
                    $cbsei_img = 'unchecked-checkbox.png';
                    $kb_img = 'unchecked-checkbox.png';
                    // } else if ($temp_data['stream_code'] == 'CBSE I') {
                    //     $cbse_img = 'unchecked-checkbox.png';
                    //     $monti_img = 'unchecked-checkbox.png';
                    //     $cbsei_img = 'checked-checkbox.png';
                    //     $kb_img = 'unchecked-checkbox.png';
                    // } else if ($temp_data['stream_code'] == 'KERALA STATE') {
                    //     $cbse_img = 'unchecked-checkbox.png';
                    //     $monti_img = 'unchecked-checkbox.png';
                    //     $cbsei_img = 'unchecked-checkbox.png';
                    //     $kb_img = 'checked-checkbox.png';
                } else {
                    $cbse_img = 'checked-checkbox.png';
                    $monti_img = 'checked-checkbox.png';
                    $cbsei_img = 'unchecked-checkbox.png';
                    $kb_img = 'unchecked-checkbox.png';
                }
                ?>
                <span class="img-label">EYFS</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $monti_img); ?>" alt="Logo" />
                <span class="img-label">CBSE</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $cbse_img); ?>" alt="Logo" />
                <!-- <span class="img-label">CBSE I</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $cbsei_img); ?>" alt="Logo" /> -->
                <!-- <span class="img-label">KB</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $kb_img); ?>" alt="Logo" /> -->
                (Put <img class="img-tick" src="<?php echo base_url('assets/img/online-reg/tick.png'); ?>" alt="Logo" /> Mark)
            </td>
        </tr>
        <?php if (!empty($temp_data['mand_optional_subjects'])) { ?>
            <tr>
                <td class="default-font" align="left">
                    Subjects Opted
                </td>
                <td align="right" width="2%">:</td>
                <td align="left">
                    <?php
                    //$mand_optional_subjects = json_decode($temp_data['mand_optional_subjects']);
                    $m_sub_string = '';
                    if (is_array($temp_data['mand_optional_subjects']['mandatory_subject'])) {
                        $m_sub_string = implode(' , ', $temp_data['mand_optional_subjects']['mandatory_subject']);
                    }
                    ?>
                    Mandatory Subjects - <?php echo  $m_sub_string; ?><br />
                    Optional Subject 1 - <?php echo $temp_data['Optional_subject_1']; ?><br />
                    Optional Subject 2 - <?php echo $temp_data['Optional_subject_2']; ?><br />
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="default-font" width="50%" align="left">
                Last School attended (Name)
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left">

            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="7%" align="left">
                Place
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left">
                <?php //echo $temp_data['']; 
                ?>
            </td>
            <td class="default-font" width="10%" align="left">
                Syllabus
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left">
                <?php //echo $temp_data['']; 
                ?>
            </td>
            <td class="default-font" width="23%" align="left">
                Medium of Instruction
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left">
                <?php //echo $temp_data['']; 
                ?>
            </td>
        </tr>
    </table>
    <h2 style="text-align:center">Details of the Candidate</h2>
    <div class="rounded-border details_table_div">
        <table class="table-bordered" width="100%" cellspacing="0">
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Date of Birth
                </td>
                <td class="" align="left" width="25%">
                    <?php echo $temp_data['dob']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Age <span style="font-size:10px"> as on <?php echo date("dS M Y", strtotime($age_calc_date)); ?></span>
                </td>
                <td class="" style="font-size:13px" align="left" width="25%">
                    <?php echo $age_string; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Country of Birth
                </td>
                <td class="" align="left" width="25%">
                    <?php echo $temp_data['birthCountry']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Place of Birth
                </td>
                <td class="" align="left" width="25%">
                    <?php echo $temp_data['birthPlace']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Nationality
                </td>
                <td class="default-font" align="left" width="25%">
                    <?php echo $temp_data['nationality']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Gender
                </td>
                <td class="default-font" align="left" width="25%">
                    <?php echo $temp_data['gender'] ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Religion
                </td>
                <td class="default-font" align="left" width="25%">
                    <?php echo $temp_data['religion_name']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Caste (if any)
                </td>
                <td class="default-font" align="left" width="25%">
                    <?php echo $temp_data['caste_name']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font last_row" width="25%" align="left">
                    Mother Tongue
                </td>
                <td class="last_row default-font" align="left" width="25%">
                    <?php echo $temp_data['mothertongue']; ?>
                </td>
                <td class="italic_font last_row" width="25%" align="left">
                    Aadhar No
                </td>
                <td class="last_row default-font" align="left" width="25%">
                    <?php echo $temp_data['emirate_Id']; ?>
                </td>
            </tr>

        </table>

    </div>
    <h2 style="text-align:center">Details of the Parent</h2>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="18%" align="left">
                Name of Father
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border default-font" align="left" width="40%">
                <?php echo $temp_data['parentName']; ?>
            </td>
            <td class="default-font" width="13%" align="left">
                Profession
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border default-font" align="left">
                <?php echo $temp_data['profession_name']; ?>
            </td>
        </tr>
    </table>
    <br />
    <div class="rounded-border details_table_div" style="height:140px;">
        <table class="table-bordered" width="100%" cellspacing="0">
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Office Address
                </td>
                <td class="" align="left">
                    <?php echo $formatted_address['office_address_string']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Permanent Address
                </td>
                <td class="" align="left">
                    <?php echo $formatted_address['permanent_address_string']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" align="left">
                    City
                </td>
                <td class="default-font" align="left">
                    <?php //echo $temp_data['city_name']; 
                    ?>
                </td>
                <td class="italic_font" align="left">
                    District/State/Country
                </td>
                <td class="default-font" align="left">
                    <?php echo $temp_data['state_name']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" align="left">
                    District
                </td>
                <td class="default-font" align="left">
                    <?php echo $temp_data['city_name']; ?>
                </td>
                <td class="italic_font" align="left">
                    E-Mail ID
                </td>
                <td class="default-font" align="left">
                    <?php echo $temp_data['O_mail']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font last_row" align="left">
                    Mobile No.
                </td>
                <td class="last_row default-font" align="left">
                    <?php echo $temp_data['O_mobile']; ?>
                </td>
                <td class="italic_font last_row" align="left">
                    Telephone No.
                </td>
                <td class="last_row default-font" align="left">
                    <?php echo $temp_data['O_phone']; ?>
                </td>
            </tr>
        </table>

    </div>
    <br />
    <table class="table" width="100%" cellpadding="5">
        <?php $i = 1;
        if (!empty($temp_data['siblings_details']) && sizeof($temp_data['siblings_details']) > 0) {
            foreach ($temp_data['siblings_details'] as $row) { ?>
                <tr>
                    <?php if ($i == 1) { ?>
                        <td rowspan="<?php echo sizeof($temp_data['siblings_details']) ?>" width="50%" class="default-font" align="left">
                            Name of Siblings studying in this school :
                        </td>
                    <?php } ?>
                    <td align="right" width="4%">(<?php echo $i; ?>)</td>
                    <td class="dotted-border" align="left"><?php echo $row['student_name'] . ' - ' . $row['Admn_No']; ?></td>
                </tr>
            <?php $i++;
            }
        } else { ?>
            <tr>
                <td rowspan="<?php echo sizeof($temp_data['siblings_details']) ?>" width="50%" class="default-font" align="left">
                    Name of Siblings studying in this school :
                </td>
            </tr>
        <?php } ?>
    </table>
    <br />
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" align="left">
                Do you want to use School Transport
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
            <td class="default-font" align="left" colspan="2">
                Address of Residence in Detail :
            </td>
            <td class="italic_font" align="left">
                House No
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left" width="20%">

            </td>
            <td class="italic_font" align="left">
                Street
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left" width="20%">

            </td>
        </tr>
        <tr>
            <td class="italic_font" width="10%" align="left">
                Place :
            </td>
            <td class="dotted-border" align="left">

            </td>
            <td class="italic_font" align="left" width="10%">
                Landmark
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left">

            </td>
            <td class="italic_font" align="left" width="10%">
                State
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left">

            </td>
        </tr>
    </table>
    <br />
    <div class="rounded-border details_table_div" style="height:140px;padding:25px;border-bottom:1px solid">
        <h3 style="text-decoration:underline">Conditions :</h3><br />
        <div class="default-font" style="margin-left:50px">
            1) Registration does not guarantee admission.<br /><br />
            2) Final admission depends upon the availability of seats in each grade.<br /><br />
            3) Registration Fee is non-refundable.<br /><br />
        </div>
    </div>
    <div style="height:100px;">
        <h4 style="text-decoration:underline">Declaration:</h4><br />
        <span class="default-font" style="font-weight:bold;">
            I hereby confirm that the details furnished above are true to the best of my knowledge and available supporting
            documents.
        </span>

    </div>
    <br /><br />
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="50%" align="left">
                Date:
            </td>
            <td align="right">(Signature of the Parent/Guardian)</td>
        </tr>
    </table>
    <h3 style="text-decoration:underline;text-align:center">For Office Use Only</h3><br />
    <table cl ass="table" width="100%" style="margin:auto">
        <tr>
            <td class="default-font" align="left">
                Registration No
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left" width="70%"></td>
        </tr>
        <tr>
            <td class="default-font" align="left">
                Verified By
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left"></td>
        </tr>
    </table>
    <h3 style="text-decoration:underline;text-align:center">Fee Payment Details</h3><br />
    <table class="table" width="100%" style="margin:auto">
        <tr>
            <td class="default-font" align="left" width="25%">
                Amount
            </td>
            <td align="right" width="2%">:</td>
            <td class="default-font" align="left" width="22%">Rs. <?php echo $temp_data['registration_fees'] ?>/-</td>
            <td class="default-font" align="left" width="22%">
                Voucher No
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left" width="22%"></td>
        </tr>
        <tr>
            <td class="default-font" align="left" width="25%">
                Signature of the Cashier
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left" width="22%"></td>
            <td class="default-font" align="left" width="22%">
                Date
            </td>
            <td align="right" width="2%">:</td>
            <td class="dotted-border" align="left" width="22%"></td>
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
        font-size: 15px;

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



    @page {
        size: auto;
        margin: 10mm;
    }
</style>