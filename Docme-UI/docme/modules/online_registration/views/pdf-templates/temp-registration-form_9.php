<html>

<body>
    <table width="100%" cellpadding="2" cellspacing="0" border="0" align="left">
        <tr>
            <td width="20%" align="center">
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
            <td align="center">
                <input type="text" style="width:125px" value="REG NO :<?php echo $temp_data['TempAdmn_No']; ?>">
            </td>
            <td width="60%" align="center">
                <p style="text-align: center;font-size:20px;font-weight:bold">Academic Year <?php echo $temp_data['acdyr']; ?> </p>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="italic_font" style="font-weight:normal;font-size:10px" align="center">
                Note: Entries with regard to name, date and place of birth should be in conformity with the passport
            </td>
        </tr>
    </table>
    <div class="clear"></div>
    <!-- <hr style="color:#9eb9b9"> -->

    <table class="table" width="100%" cellpadding="5">
        <tr style="height:50px">
            <td class="default-font" width="25%" align="center">
                Name of the Candidate <br />(In Capital Letters)
            </td>
            <td width="2%" align="right">:</td>
            <td width="33%" align="center">
                <input type="text" value="<?php echo $temp_data['fname']; ?>" class="input_border default-font"><br /><span class="italic_font">(FIRST NAME)</span>
            </td>
            <td width="20%" align="center">
                <input type="text" value="<?php echo $temp_data['mname']; ?>" class="input_border default-font"><br /><span class="italic_font">(MIDDLE NAME)</span>
            </td>
            <td width="20%" align="center">
                <input type="text" value="<?php echo $temp_data['lname']; ?>" class="input_border default-font"><br /><span class="italic_font">(LAST NAME)</span>
            </td>
        </tr>
    </table>
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="italic_font default-font" style="font-weight:normal" width="20%" align="left">
                Standard to which <br />Registration is required
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="50%">
                <input type="text" value="<?php echo $temp_data['class']; ?>" class="input_border default-font">
            </td>
        </tr>

        <tr>
            <td class="default-font" align="left">
                Last School attended if applicable(Name)
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
            <td align="right" width="3%">:</td>
            <td align="left" class="dotted-border"></td>
            <td class="default-font" width="10%" align="left">
                Medium
            </td>
            <td align="right" width="4%">:</td>
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
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $temp_data['dob']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Age <span style="font-size:10px;"> as on <?php echo date("dS M Y", strtotime($age_calc_date)); ?></span>
                </td>
                <td class="dotted-border" align="left" style="font-size:13px" width="25%"> <?php echo $age_string; ?></td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Country of Birth
                </td>
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $temp_data['birthCountry']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Place of Birth
                </td>
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $temp_data['birthPlace']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Nationality
                </td>
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $temp_data['nationality']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Gender
                </td>
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $temp_data['gender']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Religion
                </td>
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $temp_data['religion_name']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    Mother Tongue
                </td>
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $temp_data['mothertongue']; ?>
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
    <div class="rounded-border details_table_div">
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
                    Emirates
                </td>
                <td class="" align="left" width="25%">
                    <?php echo  $temp_data['city_name']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    District/State/Country
                </td>
                <td class="dotted-border" align="left" width="25%">
                    <?php echo $temp_data['state_name']  ?></td>
            </tr>
            <tr>
                <td class="first_cl italic_font last_row" width="25%" align="left">
                    PO.Box.No.
                </td>
                <td class="last_row" align="left" width="25%">
                    <?php echo $temp_data['O_zip']; ?>
                </td>
                <td class="italic_font last_row" width="25%" align="left">
                    Telephone No.
                </td>
                <td class="last_row" align="left" width="25%">
                    <?php echo $temp_data['O_phone']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font last_row" width="25%" align="left">
                    Telephone No.
                </td>
                <td class="last_row" align="left" width="25%">
                    <?php echo $temp_data['Of_phone']; ?>
                </td>
                <td class="italic_font last_row" width="25%" align="left">
                    Mobile No.
                </td>
                <td class="last_row" align="left" width="25%">
                    <?php echo $temp_data['O_phone']; ?>
                </td>
            </tr>
            <tr>
                <td class="first_cl italic_font" width="25%" align="left">
                    Mobile No.
                </td>
                <td class="last_row" align="left" width="25%">
                    <?php echo $temp_data['Of_mobile']; ?>
                </td>
                <td class="italic_font" width="25%" align="left">
                    E-Mail ID
                </td>
                <td class="last_row" align="left" width="25%">
                    <?php echo $temp_data['O_mail']; ?>
                </td>
            </tr>


        </table>

    </div>
    <br />
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td class="default-font" width="65%" align="left">
                Siblings studying at present in this school
                <span class="italic_font" style="font-size:10px;font-weight:normal">(Please write their Admission numbers)</span>
            </td>
            <td align="right" width="4%"> :</td>
            <td class="default-font" align="left" class="dotted-border">(&nbsp;&nbsp;&nbsp;)</td>
        </tr>
        <tr>
            <td class="default-font" width="65%" align="left">
                Siblings studying in other schools in U.A.E
                <span class="italic_font" style="font-size:10px;font-weight:normal">(if yes class and name of that school)</span>
            </td>
            <td align="right" width="4%"> :</td>
            <td align="left" class="dotted-border"></td>
        </tr>
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
                Address of Residence in Detail(U.A.E):
            </td>
            <td align="left" class="italic_font">
                Flat/Villa No
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="20%" class="dotted-border"></td>
            <td align="left" class="italic_font">
                Building
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" width="20%" class="dotted-border"></td>
        </tr>
        <tr>
            <td class="default-font" width="10%" align="left" class="italic_font">
                Place :
            </td>
            <td align="left" width="30%" class="dotted-border"></td>
            <td align="left" width="10%" class="italic_font">
                Landmark
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
            <td align="left" width="10%" class="italic_font">
                Emirates
            </td>
            <td align="right" width="2%">:</td>
            <td align="left" class="dotted-border"></td>
        </tr>
    </table>
    <br /><br />
    <table class="table" width="100%" cellpadding="5">
        <tr>
            <td style="border-bottom:1px solid " width="50%" align="left">
                Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;20
            </td>
        </tr>
    </table>
    <br />
    <div class="rounded-border details_table_div" style="height:140px;padding:25px;border-bottom:1px solid">
        <h3 style="text-decoration:underline">Conditions</h3><br />
        <div class="default-font" style="margin-left:50px">
            1) Registration does not guarantee admission.<br /><br />
            2) All admission will be as per the availability of seats in each standard.<br /><br />
            <br /><br />

            <span style="font-weight:bold">Note:Submission of the registration form within the prescribed time will save you from invalidation
                of your request. Dates for submission of forms are available in our website : www.themodel.ae</span>
        </div>
    </div>
    <div style="height:100px;">
        <h4 style="text-decoration:underline">Declaration:</h4><br />
        <span class="default-font" style="font-weight:bold;">
            I hereby confirm that the details furnished above are true to the best of my knowledge.
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
    <h2 style="text-decoration:underline;text-align:center">For Office Use Only</h2><br />
    <table cl ass="table" width="75%" style="margin:auto">
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
            <td align="left" colspan=2 class="dotted-border"></td>
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

    .input_border {
        width: 175px;
        height: 30px;
        border: 1px solid;
        border-radius: 10px;
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

    /* table {
        overflow: wrap;
    } */

    @page {
        size: auto;
        margin: 8mm;
    }
</style>