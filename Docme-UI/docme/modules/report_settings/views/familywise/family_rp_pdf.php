<html>
<?php
$batch_data = $student_data['Batch_Name'];

$acdyr = explode('/', $batch_data);
//dev_export($acdyr[5]);die;
?>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/header') ?>
    <br>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <th align="left" colspan="2" style="text-transform: uppercase;font-size: 14px;">
                    <?php
                    if (isset($student_data['student_name']) && !empty($student_data['student_name'])) {

                        echo $student_data['student_name'] . "(" . $student_data['Admn_NO'] . ")";
                    } else {
                        echo 'Nil';
                    }
                    ?>

                </th>

            </tr>
        </thead>
        <tbody>
            <tr class="bodyarea">
                <!-- <td colspan="2">CLASS : VII-A</td> -->
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Class: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($student_data['Description']) && !empty($student_data['Description'])) {

                        echo $student_data['Description'];
                    } else {
                        echo 'Nil';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Batch: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($student_data['Batch_Name']) && !empty($student_data['Batch_Name'])) {

                        echo $student_data['Batch_Name'];
                    } else {
                        echo 'Nil';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Academic Year: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($student_data['Cur_AcadYr']) && !empty($student_data['Cur_AcadYr'])) {

                        echo $student_data['acdyr'];
                    } else {
                        echo 'Nil';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Current Status: </td>
                <td style="text-transform: uppercase;font-size: 13px;"><?php echo $student_data['stud_status']; ?> </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Father's Name: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['Father']) && !empty($parent_address[0]['Father'])) {

                        echo $parent_address[0]['Father'];
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Father's Profession: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['F_profession']) && !empty($parent_address[0]['F_profession'])) {

                        echo $parent_address[0]['F_profession'];
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Father's Communication Address: </td>
                <td style="text-transform: uppercase;font-size: 13px;">

                    <?php echo $parent_address[0]['F_C_address1']; ?>
                    <?php echo $parent_address[0]['F_C_address2']; ?>
                    <?php echo $parent_address[0]['F_C_address3']; ?>



                </td>


            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Phone: </td>
                <td style="text-transform:uppercase;font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['F_C_Phone1']) && !empty($parent_address[0]['F_C_Phone1'])) {

                        echo $parent_address[0]['F_C_Phone1'];
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Email: </td>
                <td style="font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['Email']) && !empty($parent_address[0]['Email'])) {

                        echo strtolower($parent_address[0]['Email']);
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Mother's Name: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['Mother']) && !empty($parent_address[0]['Mother'])) {

                        echo $parent_address[0]['Mother'];
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Mother's Profession: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['M_profession']) && !empty($parent_address[0]['M_profession'])) {

                        echo $parent_address[0]['M_profession'];
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Mother's Communication Address: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <!--<pre>-->
                    <?php echo $parent_address[0]['M_C_address1']; ?>
                    <?php echo $parent_address[0]['M_C_address2']; ?>
                    <?php echo $parent_address[0]['M_C_address3']; ?>
                    <!--</pre>-->
                </td>


            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Phone: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    //                                dev_export($parent_address);die;
                    if (isset($parent_address[0]['M_C_Phone1']) && !empty($parent_address[0]['M_C_Phone1'])) {
                        echo $parent_address[0]['M_C_Phone1'];
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Email: </td>
                <td style="font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['M_C_Email']) && !empty($parent_address[0]['M_C_Email'])) {

                        echo strtolower($parent_address[0]['M_C_Email']);
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>


            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Guardian's Name: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['Guardian']) && !empty($parent_address[0]['Guardian'])) {

                        echo $parent_address[0]['Guardian'];
                    } else {
                        echo 'NIL';
                    }
                    ?>

            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Guardian's Communication Address: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if ((isset($parent_address[0]['G_C_address1']) && !empty($parent_address[0]['G_C_address1'])) || (isset($parent_address[0]['G_C_address2']) && !empty($parent_address[0]['G_C_address2'])) || (isset($parent_address[0]['G_C_address3']) && !empty($parent_address[0]['G_C_address3']))) {
                    ?>
                        <?php echo $parent_address[0]['G_C_address1']; ?>
                        <?php echo $parent_address[0]['G_C_address2']; ?>
                        <?php echo $parent_address[0]['G_C_address3']; ?>
                    <?php
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>


            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Phone: </td>
                <td style="text-transform: uppercase;font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['G_C_Phone1']) && !empty($parent_address[0]['G_C_Phone1'])) {

                        echo $parent_address[0]['G_C_Phone1'];
                    } else {
                        echo 'NIL';
                    }
                    ?>
                </td>
            </tr>
            <tr class="bodyarea">
                <td style="font-weight:bold;font-size: 13px;" class="t-left">Email: </td>
                <td style="font-size: 13px;">
                    <?php
                    if (isset($parent_address[0]['G_C_Email']) && !empty($parent_address[0]['G_C_Email'])) {

                        echo strtolower($parent_address[0]['G_C_Email']);
                    } else {
                        echo 'NIL';
                    }
                    ?>

            </tr>
            <tr class="bodyarea">
                <th align="left" colspan="2" style="text-transform: uppercase;">
                    <h4>Siblings List</h4>
                </th>
            </tr>
            <tr class="bodyarea">
                <td colspan="2">
                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr class="header" style="text-align: center;background-color: white;">
                                <th>STUDENT NAME</th>
                                <th>Admission No.</th>
                                <th>CLASS</th>
                                <th>STATUS</th>
                                <th>PRIORITY</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white;">
                            <?php
                            if (isset($sibilings_data) && !empty($sibilings_data) && is_array($sibilings_data)) {
                                array_push($sibilings_data, array(
                                    'student_name' => isset($student_data['student_name']) && !empty($student_data['student_name']) ? $student_data['student_name'] : 'NIL',
                                    'Admn_No' => isset($student_data['Admn_NO']) && !empty($student_data['Admn_NO']) ? $student_data['Admn_NO'] : 'NIL',
                                    'Description' => isset($student_data['Description']) && !empty($student_data['Description']) ? $student_data['Description'] : 'NIL',
                                    'stud_status' => isset($student_data['stud_status']) && !empty($student_data['stud_status']) ? $student_data['stud_status'] : 'NIL',
                                    'Priority' => isset($student_data['Priority']) && !empty($student_data['Priority']) ? $student_data['Priority'] : 0,
                                ));
                                usort($sibilings_data, function ($a, $b) {
                                    return ($a["Priority"] <= $b["Priority"]) ? -1 : 1;
                                });
                                foreach ($sibilings_data as $sibiling) {
                            ?>
                                    <tr class="bodyarea">
                                        <td align="center" style="font-size:13px;"> <?php echo $sibiling['student_name']; ?></td>
                                        <td align="center" style="font-size:13px;"> <?php echo $sibiling['Admn_No']; ?></td>
                                        <td align="center" style="font-size:13px;"> <?php echo $sibiling['Description']; ?></td>
                                        <td align="center" style="font-size:13px;"> <?php echo $sibiling['stud_status']; ?></td>
                                        <td align="center" style="font-size:13px;"><?php echo $sibiling['Priority']; ?></td>
                                    </tr>

                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr class="bodyarea">
                <th align="left" colspan="2">
                    <h4><b>Note: </b>The siblings list contain all the family members studying in the school.</h4>
                </th>
            </tr>
        </tbody>
    </table>