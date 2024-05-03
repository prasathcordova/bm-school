<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content" id="arrear_marking_loader_old">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content" id="arrear_marking_loader">
                                    <div class="sk-spinner sk-spinner-wave">
                                        <div class="sk-rect1"></div>
                                        <div class="sk-rect2"></div>
                                        <div class="sk-rect3"></div>
                                        <div class="sk-rect4"></div>
                                        <div class="sk-rect5"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Function</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>List Students</td>
                                                        <td id="student_status">Ready to Load Students</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Check and apply Arrear Data</td>
                                                        <td id="modification_status">Ready for Modification</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p style="padding-top: 13px;margin-left: 20px;" id="sync_starter">
                                                <a class="btn btn-primary " id="btn_student_data" href="#javascript:void(0)" onclick="get_students_data();" title="Get Students List">Get Students</a>
                                                <a class="btn btn-primary " id="btn_start_modification" style="display:none;" href="#javascript:void(0)" onclick="save_arrear_summary();" title="Start Modification">Save Arrear Details</a>
                                                <a class="btn btn-primary " href="#javascript:void(0)" onclick="reset_sync_window();" title="Reset Students List">Reset</a>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive" id="div_student_lister">
                                <table class="table table-hover dataTables-example" id="tbl_student" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Admission No.</th>
                                            <th>Student Name</th>
                                            <th>Class</th>
                                            <th>Batch</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    // var table = $('#tbl_student').dataTable({
    //     responsive: false,
    //     //stateSave: false,
    //     "lengthMenu": [
    //         [10, 100, 250, 500, -1],
    //         [10, 100, 250, 500, "All"]
    //     ],
    //     "aaSorting": [],
    //     iDisplayLength: 10,
    //     "ordering": false,
    // });

    function get_students_data() {
        $('#arrear_marking_loader').addClass('sk-loading');
        //var ops_url = baseurl + 'fees/fees-arrear-get-students/';
        var ops_url = baseurl + 'fees/list_students_with_arrears/';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                if (result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#div_student_lister').html(data.view);
                        var table = $('#tbl_student').dataTable({
                            responsive: false,
                            stateSave: false,
                            "lengthMenu": [
                                [100, 200, 250, 500, -1],
                                [100, 200, 250, 500, "All"]
                            ],
                            iDisplayLength: 100,
                            "ordering": true,
                        });
                        $('#btn_student_data').hide();
                        $('#btn_start_modification').show();
                        $('#arrear_marking_loader').removeClass('sk-loading');
                        $('#student_status').html('Students Loaded Successfully.')
                    } else {
                        $('#arrear_marking_loader').removeClass('sk-loading');
                        swal('', 'Student data not available. Please try again', 'info');
                        return false;
                    }
                } else {
                    $('#arrear_marking_loader').removeClass('sk-loading');
                    swal('', 'Student data not available. Please try again', 'info');
                    return false;
                }
            }
        });

    }

    function reset_sync_window() {
        $('#btn_student_data').show();
        $('#btn_start_modification').hide();
        $('#tbl_student_arrear').DataTable().clear().draw();
        $('#student_status').html('Ready to Load Students.');
        $('#modification_status').html('Ready for Modification.');
        $('#prograss_for_student_modification').css('width', '0%');
        $('#student_progress').hide();
    }

    function save_arrear_summary() {
        $('#arrear_marking_loader').addClass('sk-loading');
        var arrear_summary_data = $('#arrear_summary_data').val();
        var arrear_saved_today = $('#arrear_saved_today').val();
        if (arrear_saved_today == 1) {
            swal({
                    title: "Save Arrear Details",
                    //text: "Arrears of today already saved. If continue it will be replaced. \nProceed?",
                    text: "Arrears for the date is saved already.If continuing,it will be replaced.\nAre you sure you want to proceed?",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-primary",
                    confirmButtonText: "YES",
                    cancelButtonText: "NO",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(state) {
                    if (state) {
                        save_to_db(arrear_summary_data);
                    }

                });
        } else {
            save_to_db(arrear_summary_data);
        }
        $('#arrear_marking_loader').removeClass('sk-loading');
        return true
    }

    function save_to_db(arrear_summary_data) {
        var ops_url = baseurl + 'fees/save_todays_arrear_summary/';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "load": 1,
                "arrear_summary_data": arrear_summary_data
            },
            success: function(result) {
                if (result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        swal('Success', 'Arrear Details saved successfully', 'success');
                        $('#arrear_saved_today').val(1);
                        setTimeout(function() {
                            $('#modification_status').html('Arrear saved successfully');
                            $('#arrear_marking_loader').removeClass('sk-loading');
                        }, 50);
                    } else {
                        $('#modification_status').html('Please re run the data');
                        $('#arrear_marking_loader').removeClass('sk-loading');
                    }
                } else {
                    $('#modification_status').html('Arrear saving failed');
                    $('#arrear_marking_loader').removeClass('sk-loading');
                }
            }
        });
    }

    function start_modification() {
        $('#arrear_marking_loader').addClass('sk-loading');
        var arrear_summary_data = $('#arrear_summary_data').val();
        //        $('#student_progress').show();
        var student_id_datas = [];

        var tables = $('#tbl_student').DataTable();
        //        var student_count = tables.$('.student_data_id').length
        //        var cur_pos = 0;
        //        var status_d = 0;
        //        var indi_div = "";

        tables.$('.student_data_id').each(function() {
            var student_id = $(this).data('studentid');
            student_id_datas.push({
                "student_id": student_id
            });

        });

        //var ops_url = baseurl + 'fees/fees-arrear-modify-arrear-for-student/';
        var ops_url = baseurl + 'fees/save_todays_arrear_summary/';
        //        var flag = 1;
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "load": 1,
                //"student_id": btoa(JSON.stringify(student_id_datas))
                "arrear_summary_data": arrear_summary_data
            },
            //            data: {"load": 1, "student_id": (JSON.stringify(student_id_datas))},
            success: function(result) {
                if (result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        setTimeout(function() {
                            $('#modification_status').html('Arrear applied successfully');
                            $('#arrear_marking_loader').removeClass('sk-loading');
                        }, 50);
                    } else {
                        $('#modification_status').html('Please re run the data');
                        $('#arrear_marking_loader').removeClass('sk-loading');
                    }
                } else {
                    $('#modification_status').html('Arrear application failed');
                    $('#arrear_marking_loader').removeClass('sk-loading');
                }
            }
        });
        return true
    }

    function manage_arrear_for_student(student_id) {

    }
</script>