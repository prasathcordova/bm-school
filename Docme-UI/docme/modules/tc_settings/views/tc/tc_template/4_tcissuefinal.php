<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-size:13.1px;padding:10px 5px; border-left:0;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg th{font-size:13.1px;font-weight:normal;border-left:0;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
    .tg .tg-k8iw{font-size:12px;text-align:left;border-left: 0}
    .tg .tg-k9iw{font-size:12px;text-align:left;border-left: 0;border-top: 0;border-right: 0;}
    .tg .tg-jpc1{font-size:12px;text-align:left;vertical-align:top;border-right: 0}
    .tg .tg-0lax{text-align:left;vertical-align:top;border-right: 0}
    .spn{font-size:12px;color:rgb(0,0,0);}
    td {
        font-family: arial;
    }
    .data{
        height: 50px;
        font-size: 10px;
        font-weight: bold;
    }
    .datab {
        font-size: 13px !important;
    }
    .datatb td{
        margin-bottom: 12px;
        height: 28px;
    }
</style>
<!--img tag added by vinoth k @ 15.05.2019 4:10-->

<table width="100%">
    <tr>
        <td width="100%" style="border:1px solid;padding:5px;">
            <table width="100%" style="border-collapse:collapse;">
                <tr>
                    <td width="46%" style="vertical-align:top;">
                        <h5>UNITED ARAB EMIRATES</h5>
                        <h5>DUBAI EDUCATIONAL ZONE</h5>
                        <h5>NEW INDIAN MODEL SCHOOL, DUBAI</h5>
                        <br/>
                        <span style="font-size:9px;">Licensed by the Ministry of Education Under No.(76/2)</span>
                    </td>
                    <td>
                        <img src="<?php echo base_url('assets/inst_logos/4_logo.png'); ?>" width="60px" height="60px" 
                             style="margin-bottom:5px;" />
                    </td>
                </tr>
            </table>
            <span style="font-size:9px;font-weight:bold;">Affiliated to CBSE,India. vide No:6630009; Recognized by Boards of Kerala Govt. - Centre Nos: Grade 10th-43092 & Grade 12th-15004.</span>
            <table width="100%" style="border-collapse:collapse;margin-top:8px;margin-bottom:8px;">
                <tr>
                    <td width="30%"></td> 
                    <td width="40%" style="border:1px solid #000;text-align: center; padding: 5px;">
                        <h3>TRANSFER CERTIFICATE</h3>
                        <span style="font-size:11px;"><?php echo isset($details_data[0]['Descrtion']) && !empty($details_data[0]['Descrtion']) ? '( '.$details_data[0]['Descrtion'].' )':''; ?></span>
                    </td>
                    <td width="30%"></td>
                </tr>
            </table>
            <table width="100%" style="border-collapse:collapse;margin-bottom: 10px;">
                <tr>
                    <td width="35%">
                        <span style="font-size:13px;">TC No : <b><?php echo $details_data[0]['tc_no']; ?></b></span>
                    </td>
                    <td width="30%">
                    </td>
                    <td width="35%" style="text-align:right;padding-right: 8px;">
                        <span style="font-size:13px;">Comp. No : <b><?php echo $details_data[0]['admn_no']; ?></b></span>
                    </td>
                </tr>
            </table>
            <table width="100%" class="datatb" style=" table-layout: fixed;">
                <tr>
                    <td width="100%">
                        <p class="data">
                            Name of the Student : <b class="datab" style="text-transform:uppercase;"><?php echo $details_data[0]['student_name']; ?></b>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Sex : <b class="datab"><?php echo $details_data[0]['Sex']; ?></b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">Name of the Father/Guardian :  <b class="datab" style="text-transform:uppercase;"><?php echo $details_data[0]['father']; ?></b></p>
                    </td>
                </tr>
<!--                <tr>
                    <td width="100%">
                        <p class="data">Name of the Mother : <b class="datab" style="text-transform:uppercase;"><?php echo $details_data[0]['mother']; ?></b></p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">Identification marks <span style="font-weight:normal;">(i)
                                <?php echo $details_data[0]['IDMark1']; ?></span>
                            <br/><br/>
                            <span style="font-weight:normal;">(ii) <?php echo $details_data[0]['IDMark2']; ?></span>
                        </p>
                    </td>
                </tr>-->
                <tr>
                    <td width="100%">
                        <p class="data">
                                <!--Caste : <b class="datab"><?php echo $details_data[0]['caste_name']; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                Nationality : <b class="datab"><?php echo $details_data[0]['nationality']; ?></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Religion : <b class="datab"><?php echo $details_data[0]['religion_name']; ?></b>
                                <!--Community : <b class="datab"><?php echo $details_data[0]['community_name']; ?></b>-->
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">Date of Birth : 
                            <span style="font-weight: normal;">(in figures)</span> - 
                                <b class="datab"><?php
                                    $dobsDate = $details_data[0]['DOB'];
                                    $dobDate = date("d-m-Y", strtotime($dobsDate));
                                    echo $dobDate;
                                ?></b> 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="font-weight: normal;">(in words)</span> - 
                            <b style="text-transform: uppercase;"><?php echo number_to_words(explode('-', date("d-M-Y", strtotime($dobsDate)))[0]).
                                    ' - '.explode('-', date("d-M-Y", strtotime($dobsDate)))[1]. ' - '.number_to_words(explode('-', date("d-M-Y", strtotime($dobsDate)))[2]); ?></b>
                        </p>
                    </td>
                </tr>
<!--                <tr>
                    <td width="100%">
                        <p class="data"> &nbsp; Mother tongue : <b class="datab"><?php echo $details_data[0]['mothertongue']; ?></b></p>
                    </td>
                </tr>-->
                <tr>
                    <td width="100%">
                        <p class="data">
                            Date of Admission in the present School : <b class="datab"><?php echo date('d-m-Y', strtotime($details_data[0]['Admission_Date'])); ?></b> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Grade to which he was admitted : <b class="datab"><?php echo $details_data[0]['admitted_class']; ?></b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">Present Grade : <b class="datab"><?php echo $details_data[0]['current_class']; ?></b> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Section : <b class="datab"><?php echo isset($details_data[0]['Division']) && !empty($details_data[0]['Division']) ? $details_data[0]['Division'] :'N.A.'; ?></b>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Academic Year :- <b class="datab"><?php echo $details_data[0]['curr_acdyr']; ?></b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">
                            Last date of attendance at this School : <b class="datab"><?php echo date('d-m-Y', strtotime($details_data[0]['last_date_of_attendance'])); ?></b> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Attendance: <b class="datab"><?php echo $details_data[0]['no_of_days_presnet']; ?> days out of <?php echo $details_data[0]['school_working_days']; ?> days</b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">
                            *Program <span style="font-weight:normal;">(in full)</span> : <b class="datab">Central Board of Secondary Education,New Delhi.</b> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Stream: <b class="datab"><?php echo isset($details_data[0]['stream']) && !empty($details_data[0]['stream']) ? $details_data[0]['stream'] :'N.A.';?></b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <b class="datab">Result of the current Academic Year :- (<?php echo $details_data[0]['curr_acdyr']; ?>) </b>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">
                            *Passed & Promoted to Grade <span style="font-weight:normal;">(in words)</span> : <?php echo $details_data[0]['is_eligible_higheredu']==1? '<b class="datab">'.$details_data[0]['promotte_class'].'</b>':'*****'; ?> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            for the Academic Year : <?php echo $details_data[0]['is_eligible_higheredu']==1? '<b class="datab">'.$details_data[0]['promottee_yr'].'</b>':'*****'; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">
                            *Detained in Grade <span style="font-weight:normal;">(in words)</span> : <?php echo $details_data[0]['is_eligible_higheredu']!=1? '<b class="datab">'.$details_data[0]['promotte_class'].'</b>':'*****'; ?> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;
                            for the Academic Year : <?php echo $details_data[0]['is_eligible_higheredu']!=1? '<b class="datab">'.$details_data[0]['promottee_yr'].'</b>':'*****'; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="100%" style="word-break:break-all;">
                        <div class="data">Remarks <span style="font-weight:normal;">(if any)</span> : <?php echo isset($details_data[0]['tc_remark']) && !empty($details_data[0]['tc_remark']) ? '<b class="datab">'.wordwrap($details_data[0]['tc_remark'],65,' <br />',TRUE).'</b>' : 'NIL'; ?></div>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p class="data">Character & Conduct: <b class="datab"><?php echo $details_data[0]['character_and_conduct']; ?></b></p>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <p style="font-size:11px;font-weight: bold;border-bottom: 1px solid;">Registrar :-</p>
                    </td>
                </tr>
            </table>
            <table style="table-layout: fixed; width: 100%;margin-bottom: 8px;">
                <tr>
                    <td width="100%" height="100px" colspan="3" style="text-align: center;">
                        <span style="font-size:10px;font-style: italic;">(Seal of the School)</span> </td>
                </tr>
                <tr>
                    <td width="33.33%">
                        <span class="spn">Signature</span>
                    </td>
                    <td width="33.33%">
                        <span class="spn">Date: <?php echo date('d/m/Y'); ?></span>
                    </td>
                    <td width="33.33%" style="text-align: center;padding-right:20px;">
                        <p style="font-style:italic;font-weight: bold;font-size: 12px;">Dr Khurshid Alam Salar</p>
                        <span class="spn" style="font-weight: bold;">PRINCIPAL</span>
                    </td>    
                </tr>

            </table>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="100%" style="border:1px solid;padding:5px;text-align: center;">
            <p style="font-size:10px;">(FOR OFFICIAL USE)</p>
            <h5 style="border-bottom:1px solid;">FOREIGN SCHOOLS DEPARTMENT - MINISTRY OF EDUCATION, UAE.</h5>
            <table width="100%" style="margin-top:8px;">
                <tr>
                    <td colspan="3" style="text-align:left;">
                        <p style="font-size: 12px;">Above contents checked and found correct.</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:left;">
                        <p style="font-size: 12px;">Checked by:-</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:right;padding-right: 25px;">
                        <p style="font-size: 12px;font-weight: bold;">Approved</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center;" height="100px">
                        <p style="font-size: 11px;">Seal of the Department</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left;">
                        <p style="font-size: 12px;">Signature</p>
                        <p style="font-size: 12px;">Date :- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;</p>
                    </td>
                    <td style="text-align:center;">
                        <p style="font-size: 11px;">* Any kind of Tampering Invalidates the Certificate *</p>
                    </td>
                    <td style="text-align:right;padding-right: 25px;vertical-align: top;">
                        <p style="font-size: 12px;font-weight: bold;">DIRECTOR</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td width="100%" style="border-bottom: 1px solid;text-align: center;padding-bottom: 4px;">
            <p style="font-size: 11px;">P.O.Box 3100,Dubai -United Arab Emirates, Tel:-2824313,2824250,Fax:-2825454.Email:- nimsdxb@emirates.net.ae, Website :-www.nimsuae.com</p>
        </td>
    </tr>

</table>