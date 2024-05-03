<link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
<!--<link href="<?php //echo base_url('assets/plugins/steps/jquery.steps.min.js');      
                ?>" rel="stylesheet">-->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            //                                                                           dev_export($subject_data);die;
            ?>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="ibox">
                <div class="ibox-content text-center">

                    <div class="profile-image">
                        <?php
                        $profile_image = "";
                        if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {

                            $profile_image = "data:image/png;base64," . $student_data['profile_image'];
                        } else {
                            $profile_image = base_url('assets/img/a0.jpg');
                        }
                        ?>
                        <img src="<?php echo $profile_image; ?>" class="img-circle" alt="profile" style=" margin-left: 55px;">
                    </div>
                    <br>
                    <!--                    <div class="row">
                                        <b>  <?php // echo $student_data['student_name'];   
                                                ?></b>
                                        </div>-->
                    <br>
                    <table class="table table-stripped small m-t-md " style="border-top:0px !important; text-align: left; ">
                        <tr>
                            <th colspan="2" style="align-content: center">
                                <h4> <?php echo $student_data['student_name']; ?></h4>
                            </th>

                        </tr>
                        <tbody>
                            <tr>
                                <td>
                                    Admission No.
                                </td>
                                <td>
                                    :<b> <?php echo $student_data['Admn_NO']; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Batch Name
                                </td>
                                <td>
                                    :<b><?php echo $student_data['Batch_Name']; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Class
                                </td>
                                <td>
                                    :<b> <?php echo $student_data['Description']; ?></b>
                                </td>
                            </tr>
                            <!--                            <tr>
                                <td>
                                    Roll No 
                                </td>
                                <td>
                                    :<b> 58</b>
                                </td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-xs-12 col-md-9 col-lg-9">
            <div class="ibox">



                <div class="ibox-content">
                    <div class="col-lg-8 col-md-8">
                        <dl>
                            <dt>Completed:</dt>
                            <dd>
                                <div class="progress progress-striped active m-b-sm">
                                    <div style="width: 60%;" class="progress-bar"></div>
                                </div>
                                <small>Fee completed <strong>60%</strong>. Remaining close the project, sign a contract and invoice.</small>
                            </dd>
                        </dl>
                    </div>
                    <div class="ibox-tools" style="margin-top: 15px;">
                        <button style="margin-left: 30px;" type="button" class="btn btn-info btn-sm" onclick="longabsentee('<?php echo $student_data['student_id']; ?>', '<?php echo $student_data['Admn_NO']; ?>', '<?php echo $student_data['Cur_AcadYr']; ?>', '<?php echo $student_data['Class_ID']; ?>', '<?php echo $student_data['student_name']; ?>');">Mark as Long Absentee</button>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content ">
                            <div class="row">
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <div class="form-group" id="data_1">
                                        <label class="font-noraml"> Fee Disable Date:</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="feedisable_date" name="feedisable_date" placeholder=" Fee Disabled Date" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <div class="form-group" id="data_1">
                                        <label class="font-noraml"> Last Date of Attendance:</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="lastattend_date" name="lastattend_date" placeholder=" Last Date Attend" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="ibox float-e-margins">
                        <!--                        <div class="ibox-title">
                                                    <h5>Fee Structure  </h5>
                                                    <div class="ibox-tools">
                                                        <a class="collapse-link">
                                                            <i class="fa fa-chevron-up"></i>
                                                        </a>
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                            <i class="fa fa-wrench"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-user">
                                                            <li><a href="#">Config option 1</a>
                                                            </li>
                                                            <li><a href="#">Config option 2</a>
                                                            </li>
                                                        </ul>
                                                        <a class="close-link">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>-->
                        <div class="ibox-content">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data</th>
                                        <th>User</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><span class="pie">0.52,1.041</span></td>
                                        <td>Samantha</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 40% </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><span class="pie">226,134</span></td>
                                        <td>Jacob</td>
                                        <td class="text-warning"> <i class="fa fa-level-down"></i> -20% </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><span class="pie">0.52/1.561</span></td>
                                        <td>Damien</td>
                                        <td class="text-navy"> <i class="fa fa-level-up"></i> 26% </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {
        $('#feedisable_date').datepicker({
            format: 'dd-mm-yyyy',
            endDate: '+275d',
            todayBtn: "linked",
            autoclose: true,
            onClose: function() {

            }
        });
        $('#lastattend_date').datepicker({
            format: 'dd-mm-yyyy',
            endDate: '+275d',
            todayBtn: "linked",
            autoclose: true,
            onClose: function() {

            }
        });
    });

    function longabsentee(student_id, Admn_NO, Cur_AcadYr, Class_ID, student_name) {

        var date1 = $("#feedisable_date").val();
        var date2 = $("#lastattend_date").val();
        if (date1 == '') {
            swal('', 'Please provide fee disable date', 'info');
        }
        if (date2 == '') {
            swal('', 'Please provide fee disable date', 'info');
        }

        var student_id = student_id;

        var admno = Admn_NO;
        var absented_course = Class_ID;
        var acd_year = Cur_AcadYr;
        var studentname = student_name;

        //alert(CurAcadYr);return false;
        var fee_disablefrm = moment($('#feedisable_date').val(), "DD-MM-YYYY").format('YYYY-MM-DD');
        var last_date_attendance = moment($('#lastattend_date').val(), "DD-MM-YYYY").format('YYYY-MM-DD');
        var longabsent_saving = new Object();
        longabsent_saving.acd_year = acd_year;
        longabsent_saving.last_date_attendance = last_date_attendance;
        longabsent_saving.absented_course = absented_course;
        longabsent_saving.fee_disablefrm = fee_disablefrm;
        longabsent_saving.admno = admno;
        longabsent_saving.student_id = student_id;



        //        longabsent_saving.student_name = studentname;




        var studentdata = JSON.stringify(longabsent_saving);
        //        alert(studentdata);
        //        return;
        var ops_url = baseurl + 'profile/longabsente-save';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentdata": studentdata,
                "studentname": studentname
            },
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    swal('', 'Successfully marked as Long Absentee', 'success');
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'An error encountered while saving TC Application. Please try again later or contact administrator.');
                        return false;
                    }
                }

            }
        });
    }
</script>