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
                <p style="text-align: center;font-size:20px;font-weight:bold">Academic Year <?php echo $temp_data['acdyr']; ?> </p>
            </td>
        </tr>
    </table>
    <div class="clear"></div>
    <hr style="color:#000">
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td align="left">
                <span style="font-weight:bold;font-size:13px">Dear Applicant,<br /><br />
                    Thank you for using our online registration facility. Your Temporary Token Number is <b><?php echo $temp_data['TempAdmn_No']; ?></b>. You may visit the school within five workng days to complete the registration process.
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
            <td class="dotted-border default-font" width="75%" align="left">
                <?php echo $temp_data['fname'] . " " . $temp_data['mname'] . " " . $temp_data['lname']; ?>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="50%" align="left">
                Standard to which Registration is required
            </td>
            <td align="right" width="2%">:</td>
            <td align="left">
                <input type="text" value="<?php echo $temp_data['class']; ?>" class="input_border default-font" style="width:150px">
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
                } else if ($temp_data['stream_code'] == 'CBSE I') {
                    $cbse_img = 'unchecked-checkbox.png';
                    $monti_img = 'unchecked-checkbox.png';
                    $cbsei_img = 'checked-checkbox.png';
                    $kb_img = 'unchecked-checkbox.png';
                } else if ($temp_data['stream_code'] == 'KERALA STATE') {
                    $cbse_img = 'unchecked-checkbox.png';
                    $monti_img = 'unchecked-checkbox.png';
                    $cbsei_img = 'unchecked-checkbox.png';
                    $kb_img = 'checked-checkbox.png';
                } else {
                    $cbse_img = 'unchecked-checkbox.png';
                    $monti_img = 'checked-checkbox.png';
                    $cbsei_img = 'unchecked-checkbox.png';
                    $kb_img = 'unchecked-checkbox.png';
                }
                ?>
                <span class="img-label">Montessori</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $monti_img); ?>" alt="Logo" />
                <span class="img-label">CBSE</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $cbse_img); ?>" alt="Logo" />
                <span class="img-label">CBSE I</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $cbsei_img); ?>" alt="Logo" />
                <span class="img-label">KB</span> <img class="img-check" src="<?php echo base_url('assets/img/online-reg/' . $kb_img); ?>" alt="Logo" />
                (Put <img class="img-tick" src="<?php echo base_url('assets/img/online-reg/tick.png'); ?>" alt="Logo" /> Mark)
            </td>
        </tr>

        <tr>
            <td class="default-font" width="50%" align="left">
                Last School attended (Name)
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border">

            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="7%" align="left">
                Place
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
            <td class="default-font" width="10%" align="left">
                Syllabus
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
            <td class="default-font" width="23%" align="left">
                Medium of Instruction
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
        </tr>
    </table>
    <h3 style="text-align:center">DETAILS OF THE CANDIDATE</h3>
    <div class="rounded-border details_table_div">
        <table class="table-bordered" width="100%" cellspacing="0">
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Date of Birth
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
                    <?php echo $temp_data['dob']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Age <span style="font-size:10px"> as on <?php echo date("dS M Y", strtotime($age_calc_date)); ?></span>
                </td>
                <td class="dotted-border default-font" style="font-size:13px" align="left" width="25%">
                    <?php echo $age_string; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Country of Birth
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
                    <?php echo $temp_data['birthCountry']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Place of Birth
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
                    <?php echo $temp_data['birthPlace']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Nationality
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
                    <?php echo $temp_data['nationality']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Gender
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
                    <?php echo $temp_data['gender']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Religion
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
                    <?php echo $temp_data['religion_name']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Caste (if any)
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
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
                    Emirates ID No
                </td>
                <td class="last_row default-font" align="left" width="25%">
                    <?php echo $temp_data['emirate_Id']; ?>
                </td>
            </tr>

        </table>

    </div>
    <h3 style="text-align:center">DETAILS OF THE PARENT</h3>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="18%" align="left">
                Name of Father
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="40%" class="dotted-border default-font">
                <?php echo $temp_data['parentName']; ?>
            </td>
            <td class="default-font" width="13%" align="left">
                Profession
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border default-font">
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
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $formatted_address['office_address_string']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Permanent Address
                </td>
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $formatted_address['permanent_address_string']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Emirate
                </td>
                <td class="default-font" align="left" width="25%">
                    <?php echo $temp_data['city_name']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    District/State/Country
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
                    <?php echo $temp_data['state_name']  ?></td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    P O Box No.
                </td>
                <td class="dotted-border default-font" align="left" width="25%">
                    <?php echo $temp_data['O_zip']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    E-Mail ID
                </td>
                <td class="dotted-border default-font" align="left" width="25%"><?php echo $temp_data['O_mail']; ?></td>
            </tr>
            <tr>
                <td class="first_cl italic_font last_row" width="25%" align="left">
                    Mobile No.
                </td>
                <td class="last_row default-font" align="left" width="25%">
                    <?php echo $temp_data['O_mobile']; ?>
                </td>
                <td class="italic_font last_row" width="25%" align="left">
                    Telephone No.
                </td>
                <td class="last_row default-font" align="left" width="25%"><?php echo $temp_data['O_phone']; ?></td>
            </tr>

        </table>

    </div>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="75%" align="left">
                No. of Children of the same parent studying in this school <br />
                <span class="italic_font" style="font-size:10px">(Please write their Admission numbers)</span>
            </td>
            <td align="right" width="4%"> :</td>
            <td class="default-font" align="left" class="dotted-border">(&nbsp;&nbsp;&nbsp;)</td>
        </tr>
    </table>
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
                Address of Residence in Detail(U.A.E):
            </td>
            <td align="left" width="15%" class="italic_font">
                Flat/Villa No
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="20%" class="dotted-border"></td>
            <td align="left" width="15%" class="italic_font">
                Building
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="20%" class="dotted-border"></td>
        </tr>
        <tr>
            <td class="default-font" width="10%" align="left" class="italic_font">
                Place :
            </td>
            <td align="left" width="25%" class="dotted-border"></td>
            <td align="left" class="italic_font">
                Landmark
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
            <td align="left" class="italic_font">
                Emirates
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
        </tr>

        <tr>
            <td class="default-font" colspan="2" align="left">
                My ward will attend the entrance test on: <?php echo $temp_data['entrance_date'] == "Not Applicable" ? $temp_data['entrance_date'] : $temp_data['entrance_date']  ?>
            </td>
            <td align="left" width="10%" colspan="2"></td>
            <td align="left" width="10%" class="italic_font" colspan="4">
                (for selecting the date ,please refer website)
            </td>

        </tr>
    </table>
    <br />
    <div class="rounded-border details_table_div" style="height:140px;padding:15px;border-bottom:1px solid">
        <h4 style="text-decoration:underline;text-align:left">Conditions</h4>
        <div style="margin-left:50px">
            1) Registration does not guarantee admission.<br />
            2) Admission to KG-2 onwards will be based on Entrance Test.<br />
            3) Final admission depends up on the availability of seats in each grade.<br />
        </div>
        <h4 style="text-decoration:underline;text-align:left">Documents to be submitted</h4>
        <h4 style="text-align:left">Montessori, KG1, KG 2 & Grade1:</h4>
        <div style="margin-left:50px">
            Copies of Passport with valid Visa, Emirates ID of Parent & Student and 1 photo.
        </div>
        <h4 style="text-align:left">Grade II and above:</h4>
        <div style="margin-left:50px">
            1) Copies of Passport with valid Visa, Emirates ID of Parent & Student and 1 Photo. Copy of Progress
            Report issued by the previous School at the time of Admission.<br />
            2) TC counter signed by a) Education officer (CBSE/KB/ICSE) b) Consulate / Embassy c) UAE Ministry of
            foreign affairs should be submitted at the time of admission.
        </div>
        <h4 style="text-align:left">Copy of this Acknowledgement</h4>
        <span style="font-weight:bold;text-decoration:underline;">Note:</span>
        <div style="margin-left:50px">
            Submission of the above documents within 5 working days will save you from invalidation of your
            request. Registration fee is non - refundable. <br /><br />
            <img class="img-tick" src="<?php echo base_url('assets/img/online-reg/tick.png'); ?>" alt="School Name Logo" /> Original Emirates ID of the Parent & Student is compulsory for admission to all grades.<br />
            <img class="img-tick" src="<?php echo base_url('assets/img/online-reg/tick.png'); ?>" alt="School Name Logo" /> Any Misleading information furnished will result in the cancellation of the registration.<br />
        </div>

    </div>
    <div style="height:80px;">
        <h4 style="text-decoration:underline">Declaration:</h4>
        <span style="font-weight:bold;font-size:15px">
            I hereby confirm that the details furnished above are true to the best of my knowledge and available supporting
            documents.
        </span>

    </div>
    <br /><br />
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="50%" align="left">
                Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;20
            </td>
            <td align="right">(Signature of the Parent/Guardian)</td>
        </tr>
    </table>
    <hr style="color:#000">
    <h3 style="text-decoration:underline;text-align:center">For Office Use Only</h3>
    <table cl ass="table" width="100%" style="margin:auto">
        <tr>
            <td class="default-font" align="left">
                Registration No
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="30%" style="border:1px solid">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="default-font" align="left">
                Verified By
            </td>
            <td align="right" width="2%">:</td>
            <td align="right" colspan=2 class="dotted-border">on&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>
    <h3 style="text-decoration:underline;text-align:center">Fee Payment Details</h3>
    <table class="table" width="100%" style="margin:auto">
        <tr>
            <td class="default-font" align="left" width="25%">
                Amount Paid
            </td>
            <td align="right" width="2%">:</td>
            <td class="default-font" align="left" width="22%"></td>
            <td class="default-font" align="left" width="22%">
                Voucher No
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
        </tr>
        <tr>
            <td class="default-font" align="left" width="25%">
                Signature of the Cashier
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="22%" class="dotted-border"></td>
            <td class="default-font" align="left" width="22%">
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
        height: 140px;
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