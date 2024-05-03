<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_schdldshow">

                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Temp.Adm.No</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Interview Date</th>
                                            <th>Interview Time</th>
                                            <!-- <th>Active</th> -->
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($document_data) && !empty($document_data) && !isset($document_data['data']['ErrorStatus'])) {
                                            $i = 1;
                                            $regid = 0;

                                            foreach ($document_data['data'] as $documents) {

                                                if ($regid != $documents['temp_id']) {

                                        ?>
                                                    <tr>
                                                        <td> <?php echo $i; ?></td>
                                                        <td> <?php echo $documents['TempAdmn_No']; ?></td>
                                                        <td> <?php echo $name = $documents['fname'] . " " . $documents['lname']; ?></td>
                                                        <td> <?php echo $documents['Description']; ?></td>
                                                        <td> <?php
                                                                $var_date = str_replace("/","-",$documents['interview_date']);
                                                                echo date('d-m-Y', strtotime($var_date)); ?>
                                                        </td>
                                                        <td> <?php
                                                                $time = date("g:i a", strtotime($documents['interview_time']));
                                                                echo $time; ?></td>
                                                        <td> <a data-temp_id="<?php echo $documents['temp_id']; ?>" data-name="<?php echo $name; ?>" data-schid="<?php echo $documents['schdld_id']; ?>" data-schdate="<?php echo $documents['interview_date']; ?>" data-schtime="<?php echo $documents['interview_time']; ?>" class="btn btn-info modal_schdate" data-toggle="modal" style="font-size: 12px;"><span class="fa fa-comments-o text-red"></span> Modify Scheduled date</a> </td>


                                                    </tr>
                                            <?php
                                                    $regid = $documents['temp_id'];
                                                    $i++;
                                                }
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No Data Found</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div id="myModalinterview1" class="modal fade" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Interview Schedule</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <form id="schedule_form" name="schedule_form" method="post" action="">

                                                            <div class="form-group"><label>Schedule Date</label>
                                                                <div class="input-group" data-autoclose="true">
                                                                    <input type="text" class="form-control" readonly="" placeholder="Enter Schedule date" style="background-color:#fff;" id="sch_date" name="sch_date">
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label>Schedule Time</label>
                                                                <div class="input-group clockpicker" data-autoclose="true">
                                                                    <input type="text" class="form-control" id="sch_time" name="sch_time" value="09:30" placeholder="Enter Schedule time">
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-clock-o"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="stud_id" name="stud_id" value="">
                                                            <input type="hidden" class="form-control" id="stud_name" name="stud_name" value="">
                                                            <input type="hidden" class="form-control" id="schid" name="schid" value="">
                                                            <div>
                                                                <a href="javascript:void(0)" onclick="submit_schedule_data();" class="btn btn-sm btn-primary float-right m-t-n-xs" style="font-size: 12px;"> <i class="material-icons" data-toggle="tooltip" title="Save"></i>Update Schedule </a>
                                                            </div>
                                                        </form>
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
        </div>
    </div>
</div>


<script type="text/javascript">
    // function modalshow(stud_id,stud_name,sch_id,sch_date,sch_time){
        
        var table = $('#tbl_schdldshow').dataTable({
        /* aoColumnDefs: [{
            bSortable: false,
            aTargets: [-1]
        }], */
        aoColumnDefs: [{
            type: 'extract-date',
            targets: [0]
        }]
       
    });


    $(".modal_schdate").click(function() {

        $('#stud_id').val("");
        $('#sch_date').val("");
        $('#stud_name').val("");
        $('#sch_time').val("");
        stud_id = $(this).attr("data-temp_id")
        name = $(this).attr("data-name")
        schid = $(this).attr("data-schid")
        schdate = $(this).attr("data-schdate")
        schtime = $(this).attr("data-schtime")
        $('#stud_id').val(stud_id);
        $('#stud_name').val(name);
        $('#sch_date').val(schdate);
        $('#sch_time').val(schtime);
        $('#schid').val(schid);
        $('#myModalinterview1').modal('show'); // #myModal (id of modal box)
        $('.clockpicker').clockpicker(); // clockpicker js
        $('#sch_date').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: 'TRUE',
            startDate: new Date(),
            autoOpen: false,
            autoclose: true
        })
    });

    function submit_schedule_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'country/add-country/';
        var sch_date = $('#sch_date').val();
        var sch_time = $('#sch_time').val();
        var stud_id = $("#stud_id").val();
        var stud_name = $("#stud_name").val();
        var schid = $("#schid").val();
        if (sch_date == '') {
            swal('', 'Schedule Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (sch_time == '') {
            swal('', 'Schedule Time is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'online-registration/edit-interview-schedule';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                sch_date: sch_date,
                sch_time: sch_time,
                temp_id: stud_id,
                stud_name: stud_name,
                schid: schid
            },
            success: function(result) {
                //console.log(result);
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $("#faculty_loader").removeClass("sk-loading");
                    swal('Success', data.message, 'success');
                    $('#myModalinterview1').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();


                    load_interview_schedule()
                } else if (data.status == 2) {
                    $("#faculty_loader").removeClass("sk-loading");
                    swal('Success', data.message, 'success');
                    $('#myModalinterview1').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    load_interview_schedule()
                } else if (data.status == 3) {
                    $("#faculty_loader").removeClass("sk-loading");
                    swal('Success', data.message, 'success');
                    $('#myModalinterview1').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    load_interview_schedule()
                } else {
                    $("#faculty_loader").removeClass("sk-loading");
                    $('#myModalinterview1').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    swal('', 'Connection Error. Please contact administrator', 'info');

                }

            }
        });
    }
</script>