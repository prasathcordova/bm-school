<div class="ibox-title" style="border-bottom-color:#23C6C8!important">
    <h5 style="color: #1c84c6;">Log Details</h5>
    <!-- <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a New Pickup Point" data-placement="left" href="javascript:void(0)" onclick="add_new_pickuppoint();">ADD NEW Pickup POINT</a>
                    </div> -->
</div>
<div class="ibox-content" id="faculty_loader">
    <div class="sk-spinner sk-spinner-wave">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
    <div class="clearfix"></div>
    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

        <div class="row">
            <div class="col-lg-12 table-responsive">
                <?php if (isset($log_data) && !empty($log_data)) { ?>
                    <table class="table table-bordered table-condensed">
                        <tr>
                            <td width='40%'>Vehicle Number</td>
                            <td width='60%'><b class="text-uppercase"><?php echo $log_data['0']['vehiclenum'] ?> ( <?php echo $log_data['0']['schoolnum'] ?> )</b></td>
                        </tr>
                        <tr>
                            <td width='40%'>Conductor</td>
                            <td width='60%'><b class="text-uppercase"><?php echo $log_data['0']['conductor_name'] ?></b></td>
                        </tr>
                        <tr>
                            <td width='40%'>Driver</td>
                            <td width='60%'><b class="text-uppercase"><?php echo $log_data['0']['conductor_name'] ?></b></td>
                        </tr>
                        <tr>
                            <td width='40%'>Trip</td>
                            <td width='60%'><b class="text-uppercase"><?php echo $log_data['0']['tripName'] ?></b></td>
                        </tr>
                        <tr>
                            <td width='40%'>Date</td>
                            <td width='60%'><b class="text-uppercase"><?php echo date('d-m-Y', strtotime($log_data['0']['travel_date'])) ?></b></td>
                        </tr>
                    </table>
            </div>
            <div class="col-lg-12">
                <table id="logdetails_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <th>Admn No.</th>
                            <th>Student Name</th>
                            <th>Pick/Drop Point</th>
                            <th>Travel Type</th>
                            <th>Boarded Time</th>
                            <th>Arrival Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $breaker = 0;
                        //dev_export($log_data);

                        foreach ($log_data as $data) {
                        ?>
                            <tr>
                                <td><?php echo $data['Admn_No']; ?></td>
                                <td><?php echo $data['student_name']; ?></td>
                                <td><?php echo $data['pickpointName'] ?></td>
                                <td><?php echo $data['travel_status'] == 'P' ? 'Pickup' : 'Drop' ?></td>
                                <td><?php echo date('g:i a', strtotime($data['vehicle_boarded_datetime'])) ?></td>
                                <td><?php echo $data['vehicle_deboraded_datatime'] != NULL ? date('g:i a', strtotime($data['vehicle_deboraded_datatime'])) : 'Not Dropped' ?></td>
                            </tr>
                    <?php

                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var table = $('#logdetails_tbl').dataTable({
        // columnDefs: [{
        //     "width": "100%",
        //     "targets": 0
        // }, ],
        responsive: false,
        //iDisplayLength: 10,
        "order": [
            [1, "desc"],
        ],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
        ],
    });
</script>