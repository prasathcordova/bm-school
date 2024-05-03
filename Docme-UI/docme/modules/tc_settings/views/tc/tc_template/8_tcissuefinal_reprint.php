<style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .tg td {
        font-size: 13.1px;
        padding: 10px 5px;
        border-left: 0;
        /* border-style: solid;
        border-width: 0;
        overflow: hidden;
        word-break: normal;
        border-color: black; */
        border: none;
        overflow: hidden;
        word-break: normal;
    }

    .tg th {
        font-size: 13.1px;
        font-weight: normal;
        border-left: 0;
        padding: 10px 5px;
        /* border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border-color: black; */
        border: none;
        overflow: hidden;
        word-break: normal;
    }

    .tg .tg-k8iw {
        font-size: 12px;
        text-align: left;
        border-left: 0
    }

    .tg .tg-k9iw {
        font-size: 12px;
        text-align: left;
        border-left: 0;
        border-top: 0;
        border-right: 0;
    }

    .tg .tg-jpc1 {
        font-size: 12px;
        text-align: left;
        /* vertical-align: top; */
        border-right: 0
    }

    .tg .tg-0lax {
        text-align: left;
        /* vertical-align: top; */
        border-right: 0
    }

    .spn {
        font-size: 12px;
        color: rgb(0, 0, 0);
    }
</style>
<!--img tag added by vinoth k @ 15.05.2019 4:10-->
<?php
$inst_id = $this->session->userdata('inst_id');
$inst_name = $this->session->userdata('Institution_Name');
$inst_place = $this->session->userdata('Institution_Place');
$inst_email = $this->session->userdata('Institution_Email');
$inst_phone = $this->session->userdata('Institution_Phone');
$inst_url = $this->session->userdata('Institution_Url');
?>
<table width="100%" style="font-family: Arial;">
    <tr>
        <td style="padding: 0 10px;">
            <table width="180mm" style="margin-bottom: 10px;">
                <tr>
                    <td width="20%" rowspan='4' align="center">
                        <img src="<?php echo base_url('/assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:80px;" />
                    </td>
                    <td width="70%" align="center">
                        <p style="font-size:19px;">
                            <?php echo $inst_name ?></p>
                    </td>
                    <td width="10%" rowspan='4' align="right"> &nbsp;</td>
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
                    <td> &nbsp;</td>
                    <td align="center">
                        <p style="text-align: center;margin:0px;">
                            <h5>TRANSFER CERTIFICATE</h5>
                        </p>
                    </td>
                    <td> &nbsp;</td>
                </tr>
                <!-- <tr>
                    <td width="33.33%">
                        <img src="<?php echo base_url('assets/inst_logos/5_logo.png'); ?>" width="50px" height="50px" style="margin-bottom:5px;" />
                    </td>
                    <td style="text-align:center;" width="33.33%">
                        <h5>THE OXFORD SCHOOL</h5>
                        <span style="font-weight:bold;font-size: 8px;">AMBALATHARA, TRIVANDRUM - 9</span>
                        <br /><br />
                        <h5>TRANSFER CERTIFICATE</h5>
                    </td>
                    <td width="33.33%"></td>
                </tr> -->
            </table>
            <table style="table-layout: fixed; width: 180mm;">
                <tr>
                    <td width="33.33%" style="text-align: left;font-weight: bold;"><span class=" spn">Book No :</span></td>
                    <td width="33.33%" style="text-align: center;font-weight: bold;"><span class="spn">Sl No : <?php echo $details_data[0]['tc_no']; ?></span></td>
                    <td width="33.33%" style="text-align: right;font-weight: bold;"><span class="spn">Admission No. : <?php echo $details_data[0]['admn_no']; ?></span></td>

                </tr>
            </table>
            <table class="tg" style="table-layout: fixed; width: 180mm;">


                <tr>
                    <th width="65%" class="tg-k8iw">1. Name of pupil</th>
                    <th width="35%" class="tg-jpc1">: <?php echo $details_data[0]['student_name']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">2. Name of Father/Guardian</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['father']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">3. Name of Mother</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['mother']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">4. Nationality</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['nationality']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">5. Religion / Caste</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['religion_name']; ?> / <?php echo $details_data[0]['caste_name']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">6. Whether the candidate belongs to Scheduled Caste or Scheduled Tribe</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['community_name'] == 'SC' || $details_data[0]['community_name'] == 'ST' ? 'Yes' : 'No'; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">7. Date of first admission in the school with class</th>
                    <th class="tg-jpc1">: <?php echo date('d-m-Y', strtotime($details_data[0]['Admission_Date'])) . ' - ' . $details_data[0]['admitted_class'] . " / " . $details_data[0]['stream'];  ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">8. Date of Birth (in Christian Era) according to Admission Register <br />(In figures and Words) </th>
                    <th class="tg-jpc1">:
                        <?php
                        $dobsDate = $details_data[0]['DOB'];
                        $dobDate = date("d-m-Y", strtotime($dobsDate));
                        echo $dobDate;
                        ?>
                        <br />
                        <span style="margin-left:260px;text-transform: uppercase;">
                            <?php echo number_to_words(explode('-', date("d-M-Y", strtotime($dobsDate)))[0]) . ' - ' . explode('-', date("d-M-Y", strtotime($dobsDate)))[1] . ' - ' . number_to_words(explode('-', date("d-M-Y", strtotime($dobsDate)))[2]); ?>
                        </span>
                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">9. Class in which the pupil last studied <br />(In figures and Words)</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['current_class']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">10. School/Board Annual Examination last taken with result</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['stream']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">11. Whether failed, if so once/twice in the same class </th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['whether_failed']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">12. Subjects Studied </th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['subjects_studied']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">13. Whether qualified for promotion to the higher class If so, to which class <br />(In figures and Words) </th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['is_eligible_higheredu'] == 1 ? "YES, " . $details_data[0]['promotte_class'] : 'NO'; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">14. Month up to which the (pupil has paid) school dues /Paid</th>
                    <th class="tg-jpc1">: No dues</th>
                </tr>
                <tr>
                    <th class="tg-k8iw">15. Any fee concession availed of, if so, the nature of such concession </th>
                    <th class="tg-jpc1">: </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">16. Total No: of working days </th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['school_working_days']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">17. Total No: of working days present </th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['no_of_days_presnet']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">18. Whether NCC cadet/Boy Scout/Girl Guide <br />(details may be given) </th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['whether_ncc']; ?> </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">19. Games played or extra-curricular activities in which the pupil usually took part (mention achievement level therein)</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['games_extra_curricular']; ?> </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">20. General conduct</th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['character_and_conduct']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">21. Date of application for certificate </th>
                    <th class="tg-jpc1">: <?php echo date('d-m-Y', strtotime($details_data[0]['tc_app_date'])); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">22. Date of issue of certificate </th>
                    <th class="tg-jpc1">: <?php echo date('d-m-Y', strtotime($details_data[0]['tc_issue_date'])); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">23. Reason for leaving the school </th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['reason_for_leaveving']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">24. Any other remarks </th>
                    <th class="tg-jpc1">: <?php echo $details_data[0]['tc_remark']; ?></th>
                </tr>

            </table>
            <br />

            <table style="table-layout: fixed; width: 180mm;">
                <tr>
                    <td width="33.33%" style="text-align: left;">
                        <span class="spn" style="font-weight: bold;">Signature of Class Teacher</span>
                    </td>
                    <td width="33.33%" style="text-align: center;">
                        <span class="spn"><span class="spn" style="font-weight: bold;">Checked by</span>
                    </td>
                    <td width="33.33%" style="text-align: right;">
                        <span class="spn" style="font-weight: bold;">Principal</span>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>