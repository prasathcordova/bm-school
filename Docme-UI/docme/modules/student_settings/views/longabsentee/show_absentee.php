<?php
$acdstartdate = $_SESSION['acd_year_start'];
$acdenddate = $_SESSION['acd_year_end'];
?>
<input id="acdstartdate" type="hidden" value="<?php echo date('d-m-Y', strtotime($acdstartdate)); ?>">
<input id="acdenddate" type="hidden" value="<?php echo date('d-m-Y', strtotime($acdenddate)); ?>">
<div id="long_absentee_div">
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
                // dev_export($subject_data);die;
                ?>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;margin-left: -14px;margin-right: -14px;">
        <div class="ibox float-e-margins">
            <div class="ibox-content" id="long__absent_loader">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight" style="margin-left:15px;">
                    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <div class="input-group"><input type="text" id="searchname" name="searchname" placeholder="Search student By Name/Admission Number" class="form-control"> <span class="input-group-btn">
                                            <button type="button" id="search_name_btn" class="btn btn-primary btn-sm" title="Search" onclick="searchname();"><i style="font-size:17px;" class="material-icons">search</i> </button> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-top: 10px !important;">
                            <div class="row">
                                <?php
                                if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                    foreach ($details_data as $student) {
                                ?>
                                        <div class="col-lg-3">
                                            <div class="ibox float-e-margins">
                                                <div class="contact-box center-version">
                                                    <a href="javascript:void(0);" style="padding-bottom:5px !important;">
                                                        <?php
                                                        $profile_image = "";
                                                        if (!empty(get_student_image($student['student_id']))) {
                                                            $profile_image = get_student_image($student['student_id']);
                                                        } else if (isset($student['profile_image']) && !empty($student['profile_image'])) {
                                                            $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                        } else {
                                                            if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                                $profile_image = $student['profile_image_alternate'];
                                                            } else {
                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                            }
                                                        }
                                                        ?>
                                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                        <h3 class="m-b-xs pro-name" style="overflow:hidden;height: 48px;"><?php echo $student['student_name'] ?></h3>
                                                        <div>
                                                            . <p><b>Admission No.: </b><?php echo $student['Admn_No'] ?></p>
                                                            <p><b>Batch : </b><br /><?php echo $student['Batch_Name'] ?></p>
                                                            <p><b>Long Absentee Issued Date : </b><br /><?php echo str_replace('/', '-', $student['lb_assigned_date']) ?></p>
                                                        </div>
                                                    </a>
                                                    <script>
                                                        $('#feeenable_date_<?php echo  $student['student_id'] ?>').datepicker({
                                                            minViewMode: 1,
                                                            autoclose: true,
                                                            format: 'dd-mm-yyyy',
                                                            startDate: '<?php echo date('d-m-Y', strtotime($student['fee_disable_from'])) ?>',
                                                            endDate: '<?php echo date('d-m-Y', strtotime($acdenddate)) ?>'
                                                        });
                                                    </script>
                                                    <div class=" contact-box-footer">
                                                        <?php if (check_permission(505, 1099, 102)) { ?>
                                                            <div class="m-t-xs btn-group" style="padding-bottom:10px;">
                                                                <label class="font-normal"><b>Long Absentee Fee Enable Date</b> </label><span class="mandatory"> *</span>
                                                                <input type="text" class="form-control lb_fee_enable_date" id="feeenable_date_<?php echo $student['student_id'] ?>" value="<?php echo date('d-m-Y'); ?>" readonly="" style="background-color:#FFFFFF">
                                                            </div>
                                                        <?php } ?>
                                                        <div class="row">
                                                            <?php if (check_permission(505, 1099, 102)) { ?>
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <button class="btn btn-info btn-sm" type="button" onclick="longabbsentrelease('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name']; ?>', '<?php echo $student['admission_date'] ?>', '<?php echo $student['Cur_Batch'] ?>', '<?php echo $student['Cur_AcadYr'] ?>', '<?php echo $student['Class_ID'] ?>', event)" title="Long Absentee Release">Release Long Absentee </button>
                                                                </div>
                                                            <?php } ?>
                                                            <!-- </div>
                                                        <div class="row"> -->
                                                            <?php if (check_permission(505, 1100, 102)) { ?>
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <button class="btn btn-info btn-sm" type="button" onclick="fees_detail('<?php echo $student['student_id']; ?>')" title="Show Fees">Show Fees </button>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-lg-12">
                                        <h3 class=" text-muted">No data available.</h3>
                                        <a href="<?php echo base_url() . 'longabsentee/show-class-for-students' ?>" class="btn btn-success btn-md">Go to batch Filter</a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // This function Written by Elavarasan S @ 15-05-2019 @ 7:23
        var acdstartdate = $('#acdstartdate').val();
        var acdenddate = $('#acdenddate').val();
        $('#searchname').on("keypress", function(e) {
            if (e.keyCode == 13) {
                if ($('#searchname').val().trim().length < 3) {
                    swal('', 'Enter atleast three characters.', 'info');
                    return false;
                } else {
                    searchname();
                }
            }
        });
        $(document).ready(function() {
            $('#feeenable_date').datepicker({
                minViewMode: 1,
                autoclose: true,
                format: 'dd-mm-yyyy',
                startDate: acdstartdate,
                // endDate: '+0d'
                endDate: acdenddate
            });

            // $('#feeenable_date').datepicker({
            //     autoclose: true,
            //     format: 'dd-mm-yyyy',
            //     startDate: acdstartdate,
            //     endDate: '+0d',
            //     onClose: function() {}
            // }).datepicker('setDate', moment(new Date()).format('DD-MM-YYYY'));
        });

        function fees_detail(studentid) {
            var batchid = $('#batchid').val();
            var courseid = '';
            var ops_url = baseurl + 'longabsentee/long-fees/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "studentid": studentid,
                    "batchid": batchid,
                    "courseid": courseid
                },
                success: function(data) {
                    $('#long_absentee_div').html('');
                    $('#long_absentee_div').html(data);
                    $('html, body').animate({
                        scrollTop: $("#long_absentee_div").offset().top
                    }, 1000);
                }
            });
        }

        function searchname() {
            $("#close_button").show();
            var searchname = $('#searchname').val();
            if (searchname.length < 3) {
                swal('', 'Enter atleast three characters.', 'info');
                return false;
            }
            var ops_url = baseurl + 'long_absentee/search-admission-no';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "searchdata": searchname
                },
                success: function(result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#content').html('');
                        $('#content').html(data.view);

                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'No data available', 'info');
                            return false;
                        }
                    }
                }
            });
        }

        function load_students_after_filter(batch_id, acd_year, courseid) {

            // var acdid = '#acdyear_' + courseid;
            // var batchid = '#batch_' + courseid;

            var acdyear = acd_year;
            var batch_id = batch_id;

            var ops_url = baseurl + 'longabsent/show-studentlist';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "batchid": batch_id,
                    "acd_year": acdyear,
                    "courseid": courseid
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    console.log(data);
                    if (data.status == 1) {
                        $('#content').html('');
                        $('#content').html(data.view);
                    } else {

                    }
                },
                error: function() {}
            });
        }

        // function release_from_account_page(student_id, student_name, adm_date, curbatch, curacdyear, curclass, event) {
        //     load_students_after_filter(curbatch, curacdyear, curclass);
        //     longabbsentrelease(student_id, student_name, adm_date, curbatch, curacdyear, curclass, event);
        // }

        function longabbsentrelease(student_id, student_name, adm_date, curbatch, curacdyear, curclass, event) {
            var lb_en_data = moment($('#feeenable_date_' + student_id).datepicker('getDate')).format('YYYY-MM-DD');
            if (moment(lb_en_data).isValid() == false) {
                swal('', 'Select a valid long absentee release date', 'info');
                return false;
            }
            var admission_date = moment(adm_date, 'YYYY-MM-DD');
            if (lb_en_data < admission_date) {
                swal('', 'Long Absentee Fee Enable date must be greater than admission date.', 'warning');
                return false;
            }
            //var disdate = moment(assign_date, "DDMM.YYYY");
            if (student_id) {
                swal({
                    title: "",
                    text: "Are you sure to release the student " + student_name + " from long absentee status ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false
                }, function(isconfirm) {
                    if (isconfirm) {
                        var ops_url = baseurl + 'longabsent/longabsent-release/';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            async: false,
                            url: ops_url,
                            data: {
                                "student_id": student_id,
                                "studentname": student_name,
                                "fee_enable_date": lb_en_data
                            },
                            success: function(result) {
                                var data = JSON.parse(result);
                                if (data.status == 1) {
                                    swal('Success', 'The student ' + student_name + ' is released from long absentee status successfully', 'success');
                                    // window.location.href = baseurl + 'longabsentee/show-class-for-students/';
                                    load_students_after_filter(curbatch, curacdyear, curclass);
                                    // return false;
                                }
                            }
                        });
                    }
                });
            } else {
                swal('', 'An error encountered with student details. Please try again later or contact administrator.');
                return false;
            }

        }

        // function longabbsentrelease(student_id, student_name, adm_date, curbatch, curacdyear, curclass, event) {
        //     //        console.log($(event.target).siblings('div.btn-group').children('input.lb_fee_enable_date').val());
        //     var lb_en_data = moment(moment($(event.target).siblings('div.btn-group').children('input.lb_fee_enable_date').datepicker('getDate')).format('YYYY-MM-DD'));
        //     if (moment($(event.target).siblings('div.btn-group').children('input.lb_fee_enable_date').datepicker('getDate')).isValid() == false) {
        //         swal('', 'Select a valid date', 'info');
        //         return false;
        //     }
        //     //      Condition Written by Elavarasan S @ 15-05-2019 5:40

        //     var admission_date = moment(adm_date, 'YYYY-MM-DD');
        //     //        console.log(lb_en_data, admission_date, lb_en_data<admission_date);
        //     if (lb_en_data < admission_date) {
        //         //change message by vinoth @ 28-05-2019 16:11
        //         swal('', 'Long Absentee Fee Enable date must be greater than admission date.', 'warning');
        //         return false;
        //     }
        //     //        var disdate = moment(assign_date, "DDMM.YYYY");


        //     if (student_id) {
        //         swal({
        //             title: "",
        //             text: "Are you sure you want to release the student " + student_name + " from long absentee status ?",
        //             type: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#DD6B55",
        //             confirmButtonText: "Yes",
        //             cancelButtonText: "No",
        //             closeOnConfirm: false
        //         }, function(isconfirm) {
        //             if (isconfirm) {
        //                 var ops_url = baseurl + 'longabsent/longabsent-release/';
        //                 $.ajax({
        //                     type: "POST",
        //                     cache: false,
        //                     async: false,
        //                     url: ops_url,
        //                     data: {
        //                         "student_id": student_id,
        //                         "studentname": student_name
        //                     },
        //                     success: function(result) {
        //                         var data = JSON.parse(result);
        //                         if (data.status == 1) {
        //                             swal('Success', 'The student ' + student_name + ' is released from long absentee status successfully', 'success');
        //                             swal({
        //                                 title: "Success",
        //                                 text: 'The student ' + student_name + ' is released from long absentee status successfully',
        //                                 type: "success",
        //                                 showCancelButton: false,
        //                                 //confirmButtonColor: "#DD6B55",
        //                                 //confirmButtonText: "Yes,Remove purchase",
        //                                 closeOnConfirm: true
        //                             }, function(isconfirm) {
        //                                 load_students_after_filter(curbatch, curacdyear, curclass)
        //                                 //window.location.href = baseurl + 'longabsentee/show-class-for-students/';
        //                                 return true;
        //                             });

        //                         }

        //                     }
        //                 });
        //             }
        //         });
        //     } else {
        //         swal('', 'An error encountered with student details. Please try again later or contact administrator.');
        //         return false;
        //     }
        // }

        $('#searchname').focus();
    </script>

    <style>
        .profile-img {
            width: 110px;
            height: 110px;
            overflow: hidden;
            border-radius: 100%;
            margin: 0 auto;
        }

        .profile-img img {
            width: 110px;
        }

        .text-center h3 {
            height: 34px;
        }
    </style>