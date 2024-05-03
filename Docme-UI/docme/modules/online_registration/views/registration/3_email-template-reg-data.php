<style>
    /* -------------------------------------
    GLOBAL
    A very basic CSS reset
------------------------------------- */
    * {
        margin: 0;
        padding: 0;
        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        box-sizing: border-box;
        font-size: 14px;
    }

    img {
        max-width: 100%;
    }

    body {
        -webkit-font-smoothing: antialiased;
        -webkit-text-size-adjust: none;
        width: 100% !important;
        height: 100%;
        line-height: 1.6;
    }

    /* Let's make sure all tables have defaults */
    table td {
        vertical-align: top;
    }

    /* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
    body {
        background-color: #f6f6f6;
    }

    .body-wrap {
        background-color: #f6f6f6;
        width: 100%;
    }

    .container {
        display: block !important;
        max-width: 600px !important;
        margin: 0 auto !important;
        /* makes it centered */
        clear: both !important;
    }

    .content {
        max-width: 600px;
        margin: 0 auto;
        display: block;
        padding: 20px;
    }

    /* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
    .main {
        background: #fff;
        border: 1px solid #e9e9e9;
        border-radius: 3px;
    }

    .content-wrap {
        padding: 20px;
    }

    .content-block {
        padding: 0 0 20px;
    }

    .header {
        width: 100%;
        margin-bottom: 20px;
    }

    .footer {
        width: 100%;
        clear: both;
        color: #999;
        padding: 20px;
    }

    .footer a {
        color: #999;
    }

    .footer p,
    .footer a,
    .footer unsubscribe,
    .footer td {
        font-size: 12px;
    }

    /* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
    h1,
    h2,
    h3 {
        font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        color: #000;
        margin: 40px 0 0;
        line-height: 1.2;
        font-weight: 400;
    }

    h1 {
        font-size: 32px;
        font-weight: 500;
    }

    h2 {
        font-size: 24px;
    }

    h3 {
        font-size: 18px;
    }

    h4 {
        font-size: 14px;
        font-weight: 600;
    }

    p,
    ul,
    ol {
        margin-bottom: 10px;
        font-weight: normal;
    }

    p li,
    ul li,
    ol li {
        margin-left: 5px;
        list-style-position: inside;
    }

    /* -------------------------------------
    LINKS & BUTTONS
------------------------------------- */
    a {
        color: #1ab394;
        text-decoration: underline;
    }

    .btn-primary {
        text-decoration: none;
        color: #FFF;
        background-color: #1ab394;
        border: solid #1ab394;
        border-width: 5px 10px;
        line-height: 2;
        font-weight: bold;
        text-align: center;
        cursor: pointer;
        display: inline-block;
        border-radius: 5px;
        text-transform: capitalize;
    }

    /* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
    .last {
        margin-bottom: 0;
    }

    .first {
        margin-top: 0;
    }

    .aligncenter {
        text-align: center;
    }

    .alignright {
        text-align: right;
    }

    .alignleft {
        text-align: left;
    }

    .clear {
        clear: both;
    }

    /* -------------------------------------
    ALERTS
    Change the class depending on warning email, good email or bad email
------------------------------------- */
    .alert {
        font-size: 16px;
        color: #fff;
        font-weight: 500;
        padding: 20px;
        text-align: center;
        border-radius: 3px 3px 0 0;
    }

    .alert a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        font-size: 16px;
    }

    .alert.alert-warning {
        background: #f8ac59;
    }

    .alert.alert-bad {
        background: #ed5565;
    }

    .alert.alert-good {
        background: #1ab394;
    }

    /* -------------------------------------
    INVOICE
    Styles for the billing table
------------------------------------- */
    .invoice {
        margin: 40px auto;
        text-align: left;
        width: 80%;
    }

    .invoice td {
        padding: 5px 0;
    }

    .invoice .invoice-items {
        width: 100%;
    }

    .invoice .invoice-items td {
        border-top: #eee 1px solid;
    }

    .invoice .invoice-items .total td {
        border-top: 2px solid #333;
        border-bottom: 2px solid #333;
        font-weight: 700;
    }

    /* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
    @media only screen and (max-width: 640px) {

        h1,
        h2,
        h3,
        h4 {
            font-weight: 600 !important;
            margin: 20px 0 5px !important;
        }

        h1 {
            font-size: 22px !important;
        }

        h2 {
            font-size: 18px !important;
        }

        h3 {
            font-size: 16px !important;
        }

        .container {
            width: 100% !important;
        }

        .content,
        .content-wrap {
            padding: 10px !important;
        }

        .invoice {
            width: 100% !important;
        }
    }
</style>
<table class="body-wrap" width="100%">
    <tr>
        <td></td>
        <td class="container" width="100%">
            <div class="content">
                <?php if (isset($temp_data) && !empty($temp_data)) {

                    ?>

                    <table class="main" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-wrap">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-block">
                                            <h2>Acknowledgement For Online Registration</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img class="img-responsive" src="<?php echo base_url('assets/OnlineRegLogos/' . $temp_data['inst_id'] . '_logo.gif'); ?>" alt="logo" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h3>Dear Applicant,</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Thank you for using our online registration facility. Your Token Number is <b><?php echo $temp_data['TempAdmn_No']; ?></b> . This is valid only for 2 working days.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h4><u>Conditions</u></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            1)Registration does not guarantee admission.<br />
                                            2)Admission to KG-2 onwards will be based on Entrance Test.<br />
                                            3)Final admission depends up on the availability of seats in each grade.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h4><u>Documents To Be Submitted</u></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            a)Copies of Birth Certificate, Passport with valid Visa, 2 Photographs, Emirates ID of the Parent & the Student.<br />
                                            b)Copy of Acknowledgement attached.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <br /><u><b> Note :</b></u> Submission of the above document will save you from invalidation of your request.<br />
                                            Registration fee is non-refundable.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            &nbsp; &nbsp; &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Please verify the following details submitted by you:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h4>Temporary Reg No: <?php echo $temp_data['TempAdmn_No']; ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h3>Candidate Details</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            First Name :&nbsp;<b><?php echo $temp_data['fname']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Middle Name :&nbsp;<b><?php echo $temp_data['mname']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Last Name :&nbsp;<b><?php echo $temp_data['lname']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Date Of Birth :&nbsp;<b><?php echo $temp_data['dob']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Gender :&nbsp;<b><?php echo $temp_data['gender']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Name of Parent :&nbsp;<b><?php echo $temp_data['parentName']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Profession :&nbsp;<b><?php echo $temp_data['profession_name']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            &nbsp; &nbsp; &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h3>Address Details</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h4> Address Details - Contact</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Address :&nbsp;<b><?php echo $formatted_address['communication_address_string']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            P O Box Number :&nbsp;<b><?php echo $temp_data['L_zip']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Phone Number :&nbsp;<b><?php echo $temp_data['L_phone']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Mobile Number :&nbsp;<b><?php echo $temp_data['L_mobile']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Email :&nbsp;<b><?php echo $temp_data['L_mail']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            &nbsp; &nbsp; &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h4>Address Details - Permanent </h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Address :&nbsp;<b><?php echo $formatted_address['permanent_address_string']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            P O Box Number :&nbsp;<b><?php echo $temp_data['O_zip']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Phone Number :&nbsp;<b><?php echo $temp_data['O_phone']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Mobile Number :&nbsp;<b><?php echo $temp_data['O_mobile']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Email :&nbsp;<b><?php echo $temp_data['O_mail']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            &nbsp; &nbsp; &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h3>Other Details</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Blood Group :&nbsp;<b><?php echo $temp_data['blood_group']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Country :&nbsp;<b><?php echo $temp_data['country_name']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Emirates/State :&nbsp;<b><?php echo $temp_data['state_name']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            District :&nbsp;<b><?php echo $temp_data['city_name']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Religion :&nbsp;<b><?php echo $temp_data['religion_name']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Caste :&nbsp;<b><?php echo $temp_data['caste_name']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Mother Tongue :&nbsp;<b><?php echo $temp_data['mothertongue']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Optional Language :&nbsp;<b><?php echo $temp_data['optionallanguage']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Syllabus :&nbsp;<b><?php echo $temp_data['stream_code']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Class :&nbsp;<b><?php echo $temp_data['class']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            &nbsp; &nbsp; &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h3> Birth Place Details </h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Country :&nbsp;<b><?php echo $temp_data['birthCountry']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Place :&nbsp;<b><?php echo $temp_data['birthPlace']; ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Pickup Point :&nbsp;<b><?php echo $temp_data['pickpointName']; ?></b>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                <?php
                } ?>
                <br /><br />
                <hr>
                <div class="footer">
                    <table width="100%">
                        <tr>
                            <td class="aligncenter content-block">
                                <u><b> Declaration:</b></u><br /><br />
                                I hereby confirm that the details furnished above are true to the best of my knowledge and available supporting documents.<br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature of the Parent/Guardian<br /><br />

                                <span style="color:red"> ****************DO NOT REPLY TO THIS E-MAIL****************<br>

                                    This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we won't receive your reply!</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td></td>
    </tr>
</table>
<p><i>Note : If you unsubscribe this mail,you won't be able to receive email from this domain.</i></p>