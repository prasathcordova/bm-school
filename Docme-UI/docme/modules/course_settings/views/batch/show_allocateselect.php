<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                </div>

                <input type="hidden" id="cur_course" value="<?php echo $cur_course; ?>">
                <input type="hidden" id="cur_acd" value="<?php echo $cur_acd; ?>">
                <input type="hidden" id="cur_stream" value="<?php echo $cur_stream; ?>">
                <input type="hidden" id="cur_session" value="<?php echo $cur_session; ?>">
                <div class="ibox-content " id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="form-group <?php
                                                    if (form_error('batch_select')) {
                                                        echo 'has-error';
                                                    }
                                                    ?>">
                                <label>Batch</label><span class="mandatory"> *</span><br />

                                <select class="select2_batch form-control input-sm " style="width:100%" name="batch_select" id="batch_select">
                                    <option value="-1" selected="">Select</option>
                                    <?php
                                    if (isset($batch_data) && !empty($batch_data)) {


                                        foreach ($batch_data as $batch) {
                                            echo '<option value ="' . $batch['BatchID'] . '" >' . $batch['Batch_Name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('batch_select', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="  demo">
                        <div class="row ">
                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Students List
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Move to batch allocation list" onclick="select_students();">
                                            <span class="glyphicon glyphicon-menu-right span-icon-2"></span>
                                            <span class="glyphicon glyphicon-menu-right"></span>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Select All / Deselect All" onclick="select_all();" data-selectors="1" id="select_all_de_select">
                                            <i class="material-icons">select_all</i>
                                        </a></div>
                                    <div class="panel-body">
                                        <div class="scrollerdata" id="stud_list">
                                            <?php
                                            if (isset($details_data) && !empty($details_data)) {
                                                foreach ($details_data as $details) {
                                            ?>
                                                    <?php
                                                    $profile_image = "";
                                                    if (isset($details['profile_image']) && !empty($details['profile_image'])) {

                                                        $profile_image = "data:image/png;base64," . $details['profile_image'];
                                                    } else {
                                                        if (isset($details['profile_image_alternate']) && !empty($details['profile_image_alternate'])) {
                                                            $profile_image = $details['profile_image_alternate'];
                                                        } else {
                                                            $profile_image = base_url('assets/img/a0.jpg');
                                                        }
                                                    }
                                                    ?>
                                                    <div class="ibox-new" id="box_<?php echo $details['student_id'] ?>">
                                                        <div class="stu-photo">
                                                            <img id="student_<?php echo $details['student_id']; ?>" src="<?php echo $profile_image; ?>" />
                                                        </div>
                                                        <div class="stu-details">
                                                            <P><b><?php echo $details['student_name'] ?></b></p>
                                                            <P><b><?php echo $details['Admn_No'] ?></b></p>
                                                        </div>
                                                        <div class="i-checks student-list" data-toggle="tooltip" data-placement="top" title="Select students"><label> <input class="st_check" id="st_check_id" type="checkbox" data-image="<?php echo $profile_image; ?>" data-name="<?php echo $details['student_name'] ?>" data-studentid="<?php echo $details['student_id']; ?>" data-adminno="<?php echo $details['Admn_No'] ?>" value=""> <i></i></label></div>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Batch Allocation List
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove student(s)" onclick="deselect_students();">
                                            <span class="glyphicon glyphicon-menu-left span-icon-2"></span>
                                            <span class="glyphicon glyphicon-menu-left"></span>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Select All/ Deselect All" onclick="deselect_all();" data-selectors2="1" id="select_all_de_select2">
                                            <i class="material-icons">select_all</i></i>
                                        </a></div>
                                    <div class="panel-body">
                                        <div class="scrollerdata" id="allocation_list">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .ui-state-highlight {
        background: #dbf6f6
    }

    .ibox-title {
        border-bottom: solid 2px #F3F3F4 !important
    }

    .panel-info>.panel-heading {
        font-size: 16px;
    }

    .panel-info>.panel-heading a {
        float: right;
        color: #fff;
        margin: 0 0 0 20px;
        position: relative;
    }


    .span-icon-2 {
        position: absolute;
        right: 9px;
        top: 2px;
    }


    .panel-info>.panel-heading a i {
        font-size: 22px;
    }

    .panel-info>.panel-heading a:hover {
        opacity: 0.8;
    }

    .ibox-new {
        background: #fff;
        min-height: 55px;
        border: solid 1px #EAEAEA;
        margin-bottom: 15px;
    }

    .stu-photo {
        display: inline-block;
        width: 55px;
        float: left;
        background: #14B6B8;
    }

    .stu-details {
        display: inline-block;
        padding: 8px 10px;
    }

    .stu-details p {
        margin: 0;
    }

    .stu-photo img {
        width: 100%;
    }

    .i-checks {
        float: right;
        padding: 0 10px;
        line-height: 50px;
    }
</style>
<script>
    $("#batch_select").select2({
        placeholder: "Select a Batch",
        "theme": "bootstrap"
    });

    function select_students() {
        $('#faculty_loader').addClass('sk-loading');
        var students_flag = 0;
        $('.st_check').each(function(i, v) {
            if ($(v).prop('checked')) {
                students_flag = 1;
                var student_id = $(v).data('studentid');
                var student_name = $(v).data('name');
                var adminno = $(v).data('adminno');
                var student_image = $(v).data('image');
                var htmlto = '<div class="ibox-new" id="abox_' + student_id + '"> <div class="stu-photo"><img id="astudent_' + student_id + '" src="' + student_image + '"/></div><div class="stu-details"><P>Name : <b>' + student_name + '</b></p><P>Admission No. : <b>' + adminno + '</b></p> </div><div class="i-checks astudent-list"  data-toggle="tooltip" data-placement="top" title="Select students"><label><input  class="ast_check_id"  id="ast_check_id" type="checkbox" data-aimage="' + student_image + '" data-aname="' + student_name + '" data-astudentid="' + student_id + '"   data-aadminno="' + adminno + '" value=""> <i></i></label></div></div>';

                var imagestudid = '#astudent_' + student_id;
                $('#allocation_list').append(htmlto);
                var block1 = '#box_' + student_id;
                $(imagestudid).attr('src', $(v).data('image'))
                $(block1).remove();
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                $('#select_all_de_select').data('selectors', '1');
            }
        });
        setTimeout(function() {
            $('#faculty_loader').removeClass('sk-loading');
        }, 1000);
        if (students_flag == 0) {
            swal('', 'Select atleast one student for allocation', 'info');
            return false;
        }

    }

    function deselect_students() {
        $('#faculty_loader').addClass('sk-loading');
        var students_flag = 0;

        $('.ast_check_id').each(function(i, v) {
            //                console.log($(v).prop('checked'))
            if ($(v).prop('checked') == true) {
                students_flag = 1;
                var student_id = $(v).data('astudentid');
                var student_name = $(v).data('aname');
                var adminno = $(v).data('aadminno');
                var image = $(v).data('aimage');
                var htmlto = '<div class="ibox-new" id="box_' + student_id + '"><div class="stu-photo"><img id="student_' + student_id + '" src=""/></div><div class="stu-details"><P>Name : <b>' + student_name + '</b></p><P>Admission No. : <b>' + adminno + '</b></p></div><div class="i-checks student-list"  data-toggle="tooltip" data-placement="top" title="Select students"><label> <input class="st_check" id="st_check_id" type="checkbox" data-image="' + image + '" data-name="' + student_name + ' " data-studentid="' + student_id + '"   data-adminno=" ' + adminno + '" value=""> <i></i></label></div></div>'
                var imagestudid = '#student_' + student_id;
                $('#stud_list').append(htmlto);
                var block1 = '#abox_' + student_id;
                $(imagestudid).attr('src', $(v).data('aimage'))
                $(block1).remove();

            }
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            $('#select_all_de_select2').data('selectors', '1');
        });
        setTimeout(function() {
            $('#faculty_loader').removeClass('sk-loading');
        }, 1000);
        if (students_flag == 0) {
            swal('', 'Select atleast one student for deallocation', 'info');
            return false;
        }
    }





    $('.scrollerdata').slimscroll({
        height: '255px'
    });
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    function submit_data() {

        var batchid = $("#batch_select").val();
        var cur_course = $("#cur_course").val();
        var cur_acd = $("#cur_acd").val();
        var cur_stream = $("#cur_stream").val();
        var cur_session = $("#cur_session").val();

        if (batchid == -1) {
            swal('', 'Batch is required.', 'info');
            return;
        }

        var batch = new Object();
        var batch_allocate_data = new Array();

        $('.ast_check_id').each(function(i, v) {
            var student_id = $(v).data('astudentid');
            batch_allocate_data.push(student_id);
            //            console.log(batch_allocate_data);
        });

        var batch_data = JSON.stringify(batch_allocate_data);

        if (batch_data.length < 3) {
            swal('Info', 'Atleast one student is required  for batch allocation.', 'info');
            return false;
        }
        //        alert(batch_data);return
        var ops_url = baseurl + 'course/save-batch_allocate';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "batch_data": batch_data,
                "batchid": batchid,
                "cur_course": cur_course,
                "cur_acd": cur_acd,
                "cur_stream": cur_stream,
                "cur_session": cur_session
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Batch Allocated', 'Students batch allocated successfully.', 'success');
                    $('#data-view').html(data.view);
                } else {
                    swal('Info', data.data, 'info');
                    $('#data-view').html(data.view);

                }

            }
        });
    }


    function select_all() {

        if ($('#select_all_de_select').data('selectors') == 1) {
            $('#select_all_de_select').data('selectors', '0')
            $('.st_check').prop('checked', true);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        } else {
            $('#select_all_de_select').data('selectors', '1')
            $('.st_check').prop('checked', false);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    }

    function deselect_all() {

        if ($('#select_all_de_select2').data('selectors') == 1) {
            $('#select_all_de_select2').data('selectors', '0')
            $('.ast_check_id').prop('checked', true);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        } else {
            $('#select_all_de_select2').data('selectors', '1')
            $('.ast_check_id').prop('checked', false);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }
    }
</script>