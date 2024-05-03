<html>

<head>
    <style>
        .ibox {
            clear: both;
            margin-bottom: 25px;
            margin-top: 0;
            padding: 0;
        }

        .ibox.collapsed .ibox-content {
            display: none;
        }

        .ibox.collapsed .fa.fa-chevron-up:before {
            content: "\f078";
        }

        .ibox.collapsed .fa.fa-chevron-down:before {
            content: "\f077";
        }

        .ibox:after,
        .ibox:before {
            display: table;
        }

        .ibox-title {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            background-color: #ffffff;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 2px 0 0;
            color: inherit;
            margin-bottom: 0;
            padding: 15px 15px 7px;
            min-height: 48px;
        }

        .ibox-content {
            background-color: #ffffff;
            color: inherit;
            padding: 15px 20px 20px 20px;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }

        .ibox-footer {
            color: inherit;
            border-top: 1px solid #e7eaec;
            font-size: 90%;
            background: #ffffff;
            padding: 10px 15px;
        }

        /* PANELS */
        .page-heading {
            border-top: 0;
            padding: 0 10px 20px 10px;
        }

        .panel-heading h1,
        .panel-heading h2 {
            margin-bottom: 5px;
        }

        /* TABLES */
        .table-bordered {
            border: 1px solid #EBEBEB;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>thead>tr>td {
            background-color: #F5F5F6;
            border-bottom-width: 1px;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 1px solid #e7e7e7;
        }

        .table>thead>tr>th {
            border-bottom: 1px solid #DDDDDD;
            vertical-align: bottom;
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            border-top: 1px solid #e7eaec;
            line-height: 1.42857;
            padding: 8px;
            vertical-align: top;
        }

        /* PANELS */
        .panel.blank-panel {
            background: none;
            margin: 0;
        }

        .blank-panel .panel-heading {
            padding-bottom: 0;
        }

        .nav-tabs>li>a {
            color: #A7B1C2;
            font-weight: 600;
            padding: 10px 20px 10px 25px;
        }

        .nav-tabs>li>a:hover,
        .nav-tabs>li>a:focus {
            background-color: #e6e6e6;
            color: #676a6c;
        }

        .ui-tab .tab-content {
            padding: 20px 0;
        }



        .invoice-total>tbody>tr>td:first-child {
            text-align: right;
        }

        .invoice-total>tbody>tr>td {
            border: 0 none;
        }

        .invoice-total>tbody>tr>td:last-child {
            border-bottom: 1px solid #DDDDDD;
            text-align: right;
            width: 15%;
        }
    </style>
    <title>Bill - <?php echo $details_data['master_data']['billing_code']; ?> Dtd : <?php echo date('d-m-Y', strtotime($details_data['master_data']['billing_date'])); ?></title>
</head>

<body>
    <div>
        Bill No : <?php echo $details_data['master_data']['billing_code']; ?>
    </div>
    <div>
        Bill Date : <?php echo date('d-m-Y', strtotime($details_data['master_data']['billing_date'])); ?>
    </div>
    Billed To,
    <div class="row">
        <?php
        if (isset($details_data['student_data']['First_Name']) && !empty($details_data['student_data']['First_Name'])) {
        ?>

            <div class="col-lg-12">
                <?php echo $details_data['student_data']['First_Name'] ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <?php echo $details_data['student_data']['Admn_No'] ?>
            </div>
        <?php } else { ?>
            <div class="col-lg-12">
                <?php echo $details_data['employyee_data']['Emp_Name'] ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <?php echo $details_data['employyee_data']['Emp_code'] ?>
            </div>

        <?php } ?>

        <div class="col-lg-12">

            <div class="table-responsive m-t scroll_content">
                <table class="table invoice-table" style="page-break-inside: always;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid black; padding-bottom: 5px; margin-bottom: 5px;padding-top: 5px;width:16px;">Items</th>
                            <th style="border-bottom: 1px solid black; padding-bottom: 5px; margin-bottom: 5px;padding-top: 5px;width:12px;text-align: right;">Rate</th>
                            <th style="border-bottom: 1px solid black; padding-bottom: 5px; margin-bottom: 5px;padding-top: 5px;width:12px;text-align: right;">Qty</th>
                            <th style="border-bottom: 1px solid black; padding-bottom: 5px; margin-bottom: 5px;padding-top: 5px;width:12px;text-align: right;">Disc Amt</th>
                            <th style="border-bottom: 1px solid black; padding-bottom: 5px; margin-bottom: 5px;padding-top: 5px;width:12px;text-align: right;">Sub-total</th>
                            <th style="border-bottom: 1px solid black; padding-bottom: 5px; margin-bottom: 5px;padding-top: 5px;width:12px;text-align: right;"><?php echo TAXNAME ?> %</th>
                            <th style="border-bottom: 1px solid black; padding-bottom: 5px; margin-bottom: 5px;padding-top: 5px;width:12px;text-align: right;"><?php echo TAXNAME ?> Amt</th>
                            <th style="border-bottom: 1px solid black; padding-bottom: 5px; margin-bottom: 5px;padding-top: 5px;width:12px;text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($details_data) && !empty($details_data)) {
                            foreach ($details_data['data'] as $items) {
                        ?>
                                <tr>
                                    <td style="padding-top:5px;width:16px;"><?php echo $items['item_name']; ?> </td>
                                    <td style="padding-top:5px;width:12px;text-align: right;"><?php echo $items['price']; ?></td>
                                    <td style="padding-top:5px;width:12px;text-align: right;"><?php echo $items['qty']; ?></td>
                                    <td style="padding-top:5px;width:12px;text-align: right;"><?php echo $items['discount_amount']; ?></td>
                                    <td style="padding-top:5px;width:12px;text-align: right;"><?php echo $items['sub_total_after_discount']; ?></td>
                                    <td style="padding-top:5px;width:12px;text-align: right;"><?php echo $items['tax_percent']; ?></td>
                                    <td style="padding-top:5px;width:12px;text-align: right;"><?php echo $items['tax_amount']; ?></td>
                                    <td style="padding-top:5px;width:12px;text-align: right;"><?php echo $items['final_total']; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                        <tr>
                            <td style="padding-top:30px;padding-bottom: 0px;" colspan="8">Bill Summary
                                <hr />
                            </td>

                        </tr>

                        <tr>
                            <td style="padding-top:20px;"><strong>Sub Total :</strong></td>
                            <td style="padding-top:20px;">
                                <p id="tbl_subtotal"><?php echo $details_data['master_data']['sub_total']; ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-top:10px;"><strong>VAT :</strong></td>
                            <td style="padding-top:10px;" id="">
                                <p id="tbl_tax"><?php echo $details_data['master_data']['tax_amount']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"><strong>Discount :</strong></td>
                            <td style="padding-top:10px;" id="">
                                <p id="tbl_discount"><?php echo $details_data['master_data']['discount_amount']; ?></p>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top:10px;"><strong>Total :</strong></td>
                            <td style="padding-top:10px;" id="">
                                <p id="tbl_total"><?php echo $details_data['master_data']['final_total']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>