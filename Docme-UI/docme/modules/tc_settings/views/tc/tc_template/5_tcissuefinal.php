<style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .tg td {
        font-size: 13.1px;
        padding: 10px 5px;
        border-left: 0;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border-color: black;
    }

    .tg th {
        font-size: 13.1px;
        font-weight: normal;
        border-left: 0;
        padding: 10px 5px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border-color: black;
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
        vertical-align: top;
        border-right: 0
    }

    .tg .tg-0lax {
        text-align: left;
        vertical-align: top;
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
<table width="380mm" style="font-family: Arial;">
    <tr>
        <td style="padding: 0 10px;">
            <table width="180mm" style="margin-bottom: 10px;">
                <tr>
                    <td width="20%" rowspan='4' align="center">
                        <img src="<?php echo base_url('/assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:80px;" />
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
                        <p style="text-align: center;margin:0px;">
                            <h5>TRANSFER CERTIFICATE</h5>
                        </p>
                    </td>
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
                    <td style="text-align: left;"><span class="spn">Admission No. : <?php echo $details_data[0]['admn_no']; ?></span></td>
                    <td style="text-align: right;"><span class="spn">TC No :<?php echo $details_data[0]['tc_no']; ?></span></td>
                </tr>
            </table>
            <table class="tg" style="table-layout: fixed; width: 180mm;">


                <tr>
                    <th class="tg-k8iw">1. Name of the Student</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['student_name']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">2. Sex</th>
                    <th class="tg-jpc1">
                        <?php
                        if ($details_data[0]['Sex'] == 'M') {
                            echo 'Male';
                        } else {
                            echo 'Female';
                        }
                        ?>
                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">3. Date of Birth <span style="margin-left:190px;">(in figures)</span>
                        <br>
                        <br>
                        <span style="margin-left:260px;">(in words)</span>
                    </th>
                    <th class="tg-jpc1"><?php
                                        $dobsDate = $details_data[0]['DOB'];
                                        $dobDate = date("d-m-Y", strtotime($dobsDate));
                                        echo $dobDate;
                                        ?>
                        <br />
                        <br />
                        <!--written by vinoth @ 15.05.2019 3:35-->
                        <span style="margin-left:260px;text-transform: uppercase;"><?php echo number_to_words(explode('-', date("d-M-Y", strtotime($dobsDate)))[0]) .
                                                                                        ' - ' . explode('-', date("d-M-Y", strtotime($dobsDate)))[1] . ' - ' . number_to_words(explode('-', date("d-M-Y", strtotime($dobsDate)))[2]); ?></span>
                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">4. Identification marks <span style="margin-left:190px;">(i)</span>
                        <br>
                        <br>
                        <span style="margin-left:290px;">(ii)</span>
                    </th>
                    <th class="tg-jpc1">
                        <?php echo $details_data[0]['IDMark1']; ?>
                        <br>
                        <br>
                        <span style="margin-left:290px;"> <?php echo $details_data[0]['IDMark2']; ?></span>


                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">5. Religion,Caste,Community</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['religion_name']; ?>&nbsp;&nbsp;
                        <?php echo $details_data[0]['caste_name']; ?>&nbsp;&nbsp;
                        <?php echo $details_data[0]['community_name']; ?>
                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">6. Nationality and Mother tongue</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['nationality']; ?> &nbsp;<?php echo $details_data[0]['mothertongue']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">7. Name of Father/Guardian</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['father']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">8. Name of Mother</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['mother']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">9. Class, Stream and date of admission in the school</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['admitted_class'] . " / " . $details_data[0]['stream'] . " / " . date('d-m-Y', strtotime($details_data[0]['Admission_Date'])); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">10. Class in which the student last studied</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['current_class']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">11. Whether qualified for promotion to a higher class,if so to which class</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['is_eligible_higheredu'] == 1 ? "YES, " . $details_data[0]['promotte_class'] : 'NO'; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">12. Date of student's last attendance in the School</th>
                    <th class="tg-jpc1"><?php echo date('d-m-Y', strtotime($details_data[0]['last_date_of_attendance'])); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">13. Date on which the name of the student was removed from the Rolls</th>
                    <th class="tg-jpc1"><?php echo date('d-m-Y', strtotime($details_data[0]['last_date_of_attendance'])); ?></th>
                </tr>

                <tr>
                    <th class="tg-k8iw">14. Whether the student has paid all the fees</th>
                    <!-- <th class="tg-jpc1"><?php //echo $details_data[0]['is_demand'] == 0 ? 'Y' : 'N'; 
                                                ?></th> -->
                    <th class="tg-jpc1"><?php echo $fee_summary == 0 ? 'Y' : 'N'; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">15. No. of School days</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['school_working_days']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">16. No. of days attended</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['no_of_days_presnet']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">17. Date of application for TC</th>
                    <th class="tg-jpc1"><?php echo date('d-m-Y', strtotime($details_data[0]['tc_app_date'])); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">18. Date of issue of T.C.</th>
                    <th class="tg-jpc1"><?php echo date('d-m-Y'); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">19. Reason for leaving</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['reason_for_leaveving']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">20. School to which the pupil intends to join</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['school_college_to_admitt']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">21. Conduct and Character</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['character_and_conduct']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">22. Remarks</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['tc_remark']; ?></th>
                </tr>


            </table>
            <!-- <br /><br /><br /><br /><br /><br /><br /> -->
            <br /><br />
            <table style="table-layout: fixed; width: 180mm;">
                <tr>
                    <td width="33.33%">
                        <span class="spn">Thiruvananthapuram</span><br />
                        <span class="spn">Date: <?php echo date('d-m-Y'); ?></span>
                    </td>
                    <td width="33.33%" style="text-align: center;"><span class="spn">Seal</span> </td>
                    <td width="33.33%" style="text-align: right;padding-right:20px;">
                        <span class="spn" style="font-style: italic; font-weight: bold;">Principal</span>
                    </td>
                </tr>

            </table>
        </td>
        <td style="padding: 0 10px;">
            <table width="180mm" style="margin-bottom: 10px;">
                <tr>
                    <td width="20%" rowspan='4' align="center">
                        <img src="<?php echo base_url('/assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:80px;" />
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
                        <p style="text-align: center;margin:0px;">
                            <h5>TRANSFER CERTIFICATE</h5>
                        </p>
                    </td>
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
                    <td style="text-align: left;"><span class="spn">Admission No. : <?php echo $details_data[0]['admn_no']; ?></span></td>
                    <td style="text-align: right;"><span class="spn">TC No :<?php echo $details_data[0]['tc_no']; ?></span></td>
                </tr>
            </table>
            <table class="tg" style="table-layout: fixed; width: 180mm;">


                <tr>
                    <th class="tg-k8iw">1. Name of the Student</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['student_name']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">2. Sex</th>
                    <th class="tg-jpc1">
                        <?php
                        if ($details_data[0]['Sex'] == 'M') {
                            echo 'Male';
                        } else {
                            echo 'Female';
                        }
                        ?>
                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">3. Date of Birth <span style="margin-left:190px;">(in figures)</span>
                        <br>
                        <br>
                        <span style="margin-left:260px;">(in words)</span>
                    </th>
                    <th class="tg-jpc1"><?php
                                        $dobsDate = $details_data[0]['DOB'];
                                        $dobDate = date("d-m-Y", strtotime($dobsDate));
                                        echo $dobDate;
                                        ?>
                        <br />
                        <br />
                        <!--written by vinoth @ 15.05.2019 3:35-->
                        <span style="margin-left:260px;text-transform: uppercase;"><?php echo number_to_words(explode('-', date("d-M-Y", strtotime($dobsDate)))[0]) .
                                                                                        ' - ' . explode('-', date("d-M-Y", strtotime($dobsDate)))[1] . ' - ' . number_to_words(explode('-', date("d-M-Y", strtotime($dobsDate)))[2]); ?></span>
                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">4. Identification marks <span style="margin-left:190px;">(i)</span>
                        <br>
                        <br>
                        <span style="margin-left:290px;">(ii)</span>
                    </th>
                    <th class="tg-jpc1">
                        <?php echo $details_data[0]['IDMark1']; ?>
                        <br>
                        <br>
                        <span style="margin-left:290px;"> <?php echo $details_data[0]['IDMark2']; ?></span>


                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">5. Religion,Caste,Community</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['religion_name']; ?>&nbsp;&nbsp;
                        <?php echo $details_data[0]['caste_name']; ?>&nbsp;&nbsp;
                        <?php echo $details_data[0]['community_name']; ?>
                    </th>
                </tr>
                <tr>
                    <th class="tg-k8iw">6. Nationality and Mother tongue</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['nationality']; ?> &nbsp;<?php echo $details_data[0]['mothertongue']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">7. Name of Father/Guardian</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['father']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">8. Name of Mother</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['mother']; ?></th>
                </tr>
                <!-- <tr>
                    <th class="tg-k8iw">9. Class and date of admission in the school</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['admitted_class'] . "( Admission Date : " . date('d-m-Y', strtotime($details_data[0]['Admission_Date'])) . " )"; ?></th>
                </tr> -->
                <tr>
                    <th class="tg-k8iw">9. Class, Stream and date of admission in the school</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['admitted_class'] . " / " . $details_data[0]['stream'] . " / " . date('d-m-Y', strtotime($details_data[0]['Admission_Date'])); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">10. Class in which the student last studied</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['current_class']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">11. Whether qualified for promotion to a higher class,if so to which class</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['is_eligible_higheredu'] == 1 ? "YES, " . $details_data[0]['promotte_class'] : 'NO'; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">12. Date of student's last attendance in the School</th>
                    <th class="tg-jpc1"><?php echo date('d-m-Y', strtotime($details_data[0]['last_date_of_attendance'])); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">13. Date on which the name of the student was removed from the Rolls</th>
                    <th class="tg-jpc1"><?php echo date('d-m-Y', strtotime($details_data[0]['last_date_of_attendance'])); ?></th>
                </tr>

                <tr>
                    <th class="tg-k8iw">14. Whether the student has paid all the fees</th>
                    <!-- <th class="tg-jpc1"><?php //echo $details_data[0]['is_demand'] == 0 ? 'Y' : 'N'; 
                                                ?></th> -->
                    <th class="tg-jpc1"><?php echo $fee_summary == 0 ? 'Y' : 'N'; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">15. No. of School days</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['school_working_days']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">16. No. of days attended</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['no_of_days_presnet']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">17. Date of application for TC</th>
                    <th class="tg-jpc1"><?php echo date('d-m-Y', strtotime($details_data[0]['tc_app_date'])); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">18. Date of issue of T.C.</th>
                    <th class="tg-jpc1"><?php echo date('d-m-Y'); ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">19. Reason for leaving</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['reason_for_leaveving']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">20. School to which the pupil intends to join</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['school_college_to_admitt']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">21. Conduct and Character</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['character_and_conduct']; ?></th>
                </tr>
                <tr>
                    <th class="tg-k8iw">22. Remarks</th>
                    <th class="tg-jpc1"><?php echo $details_data[0]['tc_remark']; ?></th>
                </tr>

            </table>
            <!-- <br /><br /><br /><br /><br /><br /><br /> -->
            <br /><br />
            <table style="table-layout: fixed; width: 180mm;">
                <tr>
                    <td width="33.33%">
                        <span class="spn">Thiruvananthapuram</span><br />
                        <span class="spn">Date: <?php echo date('d-m-Y'); ?></span>
                    </td>
                    <td width="33.33%" style="text-align: center;"><span class="spn">Seal</span> </td>
                    <td width="33.33%" style="text-align: right;padding-right:20px;">
                        <span class="spn" style="font-style: italic; font-weight: bold;">Principal</span>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>