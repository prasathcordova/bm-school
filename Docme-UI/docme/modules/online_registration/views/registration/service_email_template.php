<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px
    }
</style>

<body>
    This is System Generated e-mail. Do not reply to this e-mail.<br />
    <br />
    The following data for online registration is not synced with RIMS @ <b><?php echo $school_name ?></b> . Please correct the data as per Remarks for syncing.<br /><br />
    <table style="border-collapse: collapse;font-size: 12px;">
        <tr>
            <th style="border: 1px solid #000;padding: 5px">#</th>
            <th style="border: 1px solid #000;padding: 5px">Temp Reg No.</th>
            <th style="border: 1px solid #000;padding: 5px">Student Name</th>
            <th style="border: 1px solid #000;padding: 5px">Applied Date</th>
            <th style="border: 1px solid #000;padding: 5px">Remarks</th>

        </tr>
        <?php
        $i = 0;
        foreach ($email_content as $key => $data) {
            if (is_array(json_decode($data['issue_remark'], true))) {
                $json_decode = json_decode($data['issue_remark'], true);
            } else {
                $json_decode['0']['message'] = "Error";
            }
            ?>
            <tr>
                <td style="border: 1px solid #000;padding: 5px"><?php echo ++$i ?></td>
                <td style="border: 1px solid #000;padding: 5px"><?php echo $data['TempAdmn_No'] ?></td>
                <td style="border: 1px solid #000;padding: 5px"><?php echo $data['stud_name'] ?></td>
                <td style="border: 1px solid #000;padding: 5px"><?php echo $data['applied_date'] ?></td>
                <td style="border: 1px solid #000;padding: 5px"><?php echo !empty($json_decode['0']['message']) ? $json_decode['0']['message'] : $data['issue_remark'] ?></td>

            </tr>
        <?php
        }
        ?>
    </table>
</body>