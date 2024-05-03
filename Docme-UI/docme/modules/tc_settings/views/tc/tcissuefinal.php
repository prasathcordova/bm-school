<style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .tg td {
        font-family: Arial, sans-serif;
        font-size: 12.1px;
        padding: 10px 5px;
        border-left: 0;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border-color: black;
    }

    .tg th {
        font-family: Arial, sans-serif;
        font-size: 12.1px;
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
        font-size: 10px;
        text-align: left;
        border-left: 0
    }

    .tg .tg-k9iw {
        font-size: 10px;
        text-align: left;
        border-left: 0;
        border-top: 0;
        border-right: 0;
    }

    .tg .tg-jpc1 {
        font-size: 10px;
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
        font-family: Arial, sans-serif;
        font-size: 10px;
        color: rgb(0, 0, 0);
    }
</style>

<table class="tg" style="table-layout: fixed; width: 730px">
    <!--<span class="spn">Admission No. : <?php echo $details_data[0]['admn_no']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="spn">TC No : IND/00091</span>-->
    <tr>
        <th class="tg-k9iw">Admission No. : <?php echo $details_data[0]['admn_no']; ?>
            </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="spn">TC No : <?php echo $details_data[0]['tc_no']; ?></span>
        </th>
        <!--<th class="tg-0lax">TC No :<?php echo $details_data[0]['tc_no']; ?></th>-->
    </tr>
</table>
<table class="tg" style="table-layout: fixed; width: 730px">
    <colgroup>
        <col style="width: 300px">
        <col style="width: 700px">
    </colgroup>

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
            <span style="margin-left:260px;"><?php echo date("d-M-Y", strtotime($dobsDate)); ?></span>
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
        <th class="tg-jpc1"><?php echo $details_data[0]['mothertongue']; ?></th>
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
        <th class="tg-k8iw">9. Class and date of admission in the school</th>
        <th class="tg-jpc1"><?php echo $details_data[0]['admitted_class'] . "( Admission Date : " . date('d-m-Y', strtotime($details_data[0]['Admission_Date'])) . " )"; ?></th>
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
        <th class="tg-jpc1"><?php echo 'Y'; ?></th>
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

</table>
<br>
<br>


<table class="tg" style="table-layout: fixed; width: 730px">
    <span class="spn">Thiruvananthapuram</span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="spn">Seal</span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="spn">Principal</span>
</table>