<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">

<head style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
    <meta name="viewport" content="width=device-width" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
    <title style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">Alerts e.g. approaching your limit</title>
    <link href="styles.css" media="all" rel="stylesheet" type="text/css" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
    <style style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
        /* -------------------------------------
                    GLOBAL
                    A very basic CSS reset
                ------------------------------------- */
        * {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            box-sizing: border-box;
            font-size: 12px;
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
            font-size: 12px;
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
</head>

<body style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;line-height: 1.6;background-color: #f6f6f6;width: 100% !important;">
    <?php
    if ($type == 1) {

        $transaction_details_data['Transaction_status'] = "Success";
        $paystatus = "is sucessfully done.";
        $payrefelection = "Your payment will be reflected in next 24 hours. ";

        if ($transaction_details_data['discriminator'] == 'NB') {
            $transaction_details_data['discriminator'] = "Net Banking";
        } elseif ($transaction_details_data['discriminator'] == 'CC') {
            $transaction_details_data['discriminator'] = "Credit Card";
        } elseif ($transaction_details_data['discriminator'] == 'DC') {
            $transaction_details_data['discriminator'] = "Debit Card";
        } elseif ($transaction_details_data['discriminator'] == 'IM') {
            $transaction_details_data['discriminator'] = "IMPS";
        } elseif ($transaction_details_data['discriminator'] == 'MX') {
            $transaction_details_data['discriminator'] = "American Express Cards";
        } else {
            $transaction_details_data['discriminator'] = '';
        }
    }
    if ($type == 2) {
        $transaction_details_data['Transaction_status'] = "Failed";
        $paystatus = "is failed.";
        $payrefelection = "";
        $transaction_details_data['discriminator'] = '';
    }
    ?>
    <table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;background-color: #f6f6f6;width: 100%;">
        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;"></td>
            <td class="container" width="600" style="margin: 0 auto !important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;display: block !important;max-width: 600px !important;clear: both !important;">
                <div class="content" style="margin: 0 auto;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;max-width: 600px;display: block;">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                            <td class="alert alert-good " style="background-color: #fff!important;margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 16px;vertical-align: top;color: #fff;font-weight: 500;text-align: center;border-radius: 3px 3px 0 0;background: #1ab394;">
                                <span style="position: absolute;margin-left: -152px;margin-top: -22px;margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                    <img class="img-responsive" src="<?php echo base_url('assets/OnlineRegLogos/' . $inst_id . '_logo.png'); ?>" alt="logo" style="width:250px" />
                                </span>

                            </td>
                        </tr>
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                            <td class="content-wrap" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;">
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                        <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;">
                                            Dear <?php echo $detail['parentName']; ?>,
                                        </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                        <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;">
                                            This mail is to inform you that payment for your ward <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                <?php echo $detail['fname'] . ' ' . $detail['mname'] . ' ' . $detail['lname']; ?> </strong> for the <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;"> online registration with token no <?php echo $detail['TempAdmn_No'] ?> </strong> <?php echo $paystatus ?>
                                        </td>

                                    </tr>
                                    <?php if ($type == 2) { ?>
                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;">
                                                Please try again with the following link <br />
                                                Link : <?php echo $payment_link; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                        <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;">
                                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                    <!--<td class="content-block">-->
                                                    <h5 style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">Details are Furnished Below :</h5>
                                                    <!--</td>-->
                                                </tr>
                                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;">
                                                        <table class="invoice" style="margin: 40px auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;text-align: left;width: 80%;">
                                                            <!--                                            <tr>
                                                                                    <td>MUHAMMED YASIN .S<br>Admission Number : 00719/11</td>
                                                                                </tr>-->
                                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                                <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;">
                                                                    <table class="invoice-items" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;width: 100%;">
                                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;border-top: #eee 1px solid;">Class</td>
                                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: right;border-top: #eee 1px solid;"><?php echo $detail['Description'] ?></td>
                                                                        </tr>
                                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;border-top: #eee 1px solid;">Amount </td>
                                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: right;border-top: #eee 1px solid;"><?php echo $detail['registration_fees']; ?></td>
                                                                        </tr>
                                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;border-top: #eee 1px solid;">Transaction ID </td>
                                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: right;border-top: #eee 1px solid;"><?php echo isset($transaction_details_data['mmp_txn']) ? $transaction_details_data['mmp_txn'] : ''; ?></td>
                                                                        </tr>
                                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;border-top: #eee 1px solid;">Transaction Date </td>
                                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: right;border-top: #eee 1px solid;"><?php echo isset($transaction_details_data['date']) ? date('d-m-Y', strtotime($transaction_details_data['date'])) : '' ?></td>
                                                                        </tr>
                                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;border-top: #eee 1px solid;">Payment Channel </td>
                                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: right;border-top: #eee 1px solid;"> <?php echo $transaction_details_data['discriminator']; ?></td>
                                                                        </tr>
                                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                                                            <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;border-top: #eee 1px solid;">Transaction Status </td>
                                                                            <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: right;border-top: #eee 1px solid;"> <?php echo $transaction_details_data['Transaction_status']; ?></td>
                                                                        </tr>
                                                                        <!--                                                        <tr class="total">
                                                                                                <td class="alignright" width="80%">Total</td>
                                                                                                <td class="alignright">$ 36.00</td>
                                                                                            </tr>-->
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!--                                <tr>
                                                                        <td class="content-block">
                                                                            <a href="#">View in browser</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="content-block">
                                                                           
                                                                        </td>
                                                                    </tr>-->
                                            </table>
                                        </td>
                                    </tr>
                                    <!--                                <tr>
                                                            <td class="content-block">
                                                                <a href="#" class="btn-primary">DocME Store Login -</a>
                                                            </td>
                                                        </tr>-->

                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;width: 100%;clear: both;color: #999;">
                        <table width="100%" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;">
                                <td class="content-block" style="font-size: 10px;color: grey;margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;vertical-align: top;">
                                    This is an auto generated E-mail from . Do not reply to this mail as the sender will not receive the mail back.This E-Mail may contain Confidential and/or legally privileged Information and is meant for the intended recipient(s) only. If you have received this e-mail in error and are not the intended recipient/s, kindly notify us at then delete this e-mail immediately from your system.

                                    Internet Communications cannot be guaranteed to be secure or error-free as information could be delayed, intercepted, corrupted, lost, or contain viruses. We does not accept any liability for any errors, omissions, viruses or computer problems experienced by any recipient as a result of this e-mail.
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;"></td>
        </tr>
    </table>

</body>

</html>