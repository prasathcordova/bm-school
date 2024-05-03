<?php
$sno = 1;
?>
<html>

<head>


</head>

<body>
    <?php echo $this->load->view('report_settings/report/header') ?>
    <table class="table2 tableH" cellpadding="2" width="100%" style="font-family:Times New Roman, Georgia, Serif;" style="font-size: 11px">
        <thead>
            <tr class="header">
                <font weight="bold" font-size="60px">
                    <td width="10%">
                        <h3>Sl.No</h3>
                    </td>
                    <?php
                    if (isset($header) && is_array($header)) {
                        foreach ($header as $h) {
                    ?>
                            <td>
                                <h3><?php echo $h; ?></h3>
                            </td>
                    <?php
                        }
                    }
                    ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($rdata) && is_array($rdata)) {
                foreach ($rdata as $key => $data) {
                    if ($data['isactive'] == 1) {
            ?>
                        <tr>
                            <td><?php echo  $sno; ?></td>
                            <?php
                            foreach ($keys as $k) {
                            ?>
                                <td style="text-transform: uppercase;"><?php echo $data[$k]; ?></td>
                            <?php
                            }
                            ?>
                        </tr>
            <?php
                        $sno++;
                    }
                }
            }
            ?>
        </tbody>
    </table>

</body>

</html>