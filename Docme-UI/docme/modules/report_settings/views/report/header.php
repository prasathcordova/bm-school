<?php
// $inst_id = $this->session->userdata('inst_id');
// $inst_name = $this->session->userdata('Institution_Name');
?>
<!-- <div style="text-align: center; padding-bottom:5px; display: block; font-family:Tahoma ;">
    <img src="<?php //echo base_url('assets/dashboard_logos/'.$inst_id.'_dashboard.png'); 
                ?>" alt="<?php echo $inst_name; ?>" style="height: 60px;width:200px;padding-top: 0px;margin-top: 0px;" />
    <br/><br/>
    <h4><?php //echo isset($title) & !empty($title) ? $title : ''; 
        ?> </h4>
</div> -->
<style>
    .table {
        border-spacing: 0;
        border-collapse: collapse;
        font-family: Roboto;
        font-size: 10px;
    }

    .table-bordered {
        border: 1px solid #b1b1b1;
    }

    .table-bordered tbody tr td,
    .table-bordered tbody tr th,
    .table-bordered tfoot tr td,
    .table-bordered tfoot tr th,
    .table-bordered thead tr td,
    .table-bordered thead tr th,
    .table-bordered tr th,
    .table-bordered tr td {
        border: 1px solid #b1b1b1 !important;
    }

    .table-bordered tr.header td,
    .table-bordered tr.footer td {
        vertical-align: middle;
        text-align: center;
        padding: 5px 0;
        font-weight: bold;
    }

    .table-bordered tr.bodyarea td {
        vertical-align: middle;
        text-align: center;
        padding: 7px 0 7px 3px;
        font-size: 10px;
    }

    .table-bordered tr.linetr td {
        padding: 2px 0;
    }

    .table-top tr.header td {
        text-align: left;
        padding: 7px 0;
    }

    .table-top tr.header td span {
        font-weight: bold;
        font-size: 12px;
    }

    .table-top {
        margin-bottom: 15px;
    }

    .table-bordered tr.bodyarea td.t-right,
    .table-bordered tr.footer td.t-right {
        text-align: right !important;
    }

    .table-bordered tr.bodyarea td.t-left,
    .table-bordered tr.footer td.t-left {
        text-align: left !important;
    }

    .pad-bot-0 {
        padding-bottom: 0px !important;
    }

    .headerdiv {
        text-align: center;
        padding-bottom: 5px;
        display: block;
        font-family: Arial;
        border-bottom: 1px solid #000;
        margin-bottom: 10px;
    }

    .footerdiv {
        border-top: #000 1px solid;
        font-size: 9px;
        font-weight: bold;
        font-family: Arial;
    }

    .t-right {
        text-align: right !important;
    }

    .t-left {
        text-align: left !important;
    }

    .t-center {
        text-align: center !important;
    }

    @page {
        size: auto;
        margin: 10mm;
        margin-top: 52mm;
        margin-bottom: 30mm;
        odd-header-name: html_myHeader1;
        even-header-name: html_myHeader1;
        odd-footer-name: html_myFooter1;
        even-footer-name: html_myFooter1;
    }
</style>
<htmlpageheader name="myHeader1" style="display:none">
    <?php
    $inst_id = $this->session->userdata('inst_id');
    $inst_name = $this->session->userdata('Institution_Name');
    $inst_place = $this->session->userdata('Institution_Place');
    $inst_email = $this->session->userdata('Institution_Email');
    $inst_phone = $this->session->userdata('Institution_Phone');
    $inst_url = $this->session->userdata('Institution_Url');
    ?>
    <br />
    <table width="100%" cellpadding="2" cellspacing="0" border="0" align="left" style="font-family:Times New Roman">';
        <tr>
            <td width="20%" rowspan='4' align="center">
                <img src="<?php echo base_url('/assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:100px;" />
            </td>
            <td width="60%" align="center">
                <p style="font-size:19px;">
                    <?php echo $inst_name ?></p>
            </td>
            <td width="20%" rowspan='4' align="right"></td>
        </tr>
        <tr>
            <td align="center" style="font-size:14px;"><?php echo $inst_place ?></td>
        </tr>
        <tr>
            <td align="center" style="font-size:9px;">Email: <?php echo $inst_email ?>,<br> Web: <?php echo $inst_url ?> </td>
        </tr>
        <tr>
            <td align="center" style="font-size:9px;"> Ph: <?php echo $inst_phone ?></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <p style="text-align: center;margin:0px;"><b><?php echo isset($title) & !empty($title) ? $title : 'NO TITLE'; ?></b></p>
            </td>
        </tr>
    </table>
    <!-- <hr style="color:#9eb9b9">
    </hr> -->
</htmlpageheader>

<htmlpagefooter name="myFooter1" style="display:none">
    <div style="border-top:#000 1px solid;font-size:9px;font-weight:bold">
        <div style="margin-bottom:0px">
            <div style="float:left;width:25%;text-align:left">Print by : <?php echo $user_name ?></div>
            <div style="float:left;width:50%;text-align:center"><?php echo '{PAGENO}' ?></div>
            <div style="float:right;width:20%;text-align:right"><?php echo date('d-m-Y - h:i:s') ?></div>
        </div>
        <h5 style="margin-top:0px;color: #888;overflow:visible;"><?php echo $bread_crumps ?></h5>
    </div>
</htmlpagefooter>