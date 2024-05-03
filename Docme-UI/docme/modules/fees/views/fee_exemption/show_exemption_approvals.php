<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--style="box-shadow: none;"-->
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><i class="fa fa-money" style="padding-right:10px;"></i><?php echo isset($sub_title) ? $sub_title : "Cheque Reconciliation" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a class="btn btn-info" href="javascript:void(0)" onclick="load_excemptions();" data-toggle="tooltip" title="Fee Exemption" style="float: right; color: #fff;margin-top: -4px;"><i class="fa fa-backward"></i> Exemptions</a>
                    </div>
                </div>
                <div class="ibox-content" id="reconcile_loader">

                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>

                    <!--                    <h3 id="admission_div_h">Advanced Filter
                        <span style="float: right;"><a href="javascript:void(0)" title="Filter Options" onclick="toggle_advanced()"><i id="toggler" class="fa fa-plus"></i></a></span>
                        <hr style="margin-top:4px;">                        
                    </h3>
                    <div class="row" id="admission_div" style="display: none;">               
                        <div class="col-md-12">
                            <b>Transaction Date(Includes cheque for fee payment and Docme Wallet Payment)</b>
                            <div class="form-group">
                                <div class="form-line"> 
                                    <div class="input-group">
                                        <input type="text"  class="form-control" name="datefilter" id="datefilter" value="<?php echo date('d-m-Y') . ' to ' . date('d-m-Y'); ?>" readonly="" style="background-color: white;" />
                                        <span class="input-group-btn">
                                            <button type="button" id="search_name_btn" class="btn btn-primary" onclick="search_cheque_data();" title="Search">
                                                <i class="fa fa-search"></i>  
                                            </button> 
                                        </span>
                                    </div>                           
                                </div>
                            </div>

                        </div>
                    </div>-->

                    <!--<h3 id="advanced_search_h">Fee Exemption Requests<hr></h3>-->

                    <div id="advanced_search" class="row">
                        <div class="col-lg-12 col-xs-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered margin bottom dataTables-example" id="exemption_request_list">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Admission No.</th>
                                            <th>Request Date</th>
                                            <th style="text-align:right;">Exemption Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($exemptions_requests) && !empty($exemptions_requests)) {
                                            // dev_export($exemptions_requests);
                                            $starray = array();
                                            foreach ($exemptions_requests as $data) {
                                                $starray = [
                                                    "studentname" => $data['First_Name'],
                                                    "admnno" => $data['Admn_No'],
                                                    "requestdate" => date('d-m-Y', strtotime($data['createdon'])),
                                                    "amount" => ($data['amt_total']),
                                                    "status" => ($data['Exn_Status'] == 'A' ? '<span class=text-success>APPROVED</span>' : ($data['Exn_Status'] == 'R' ? '<span class=text-danger>REJECTED</span>' : '<span class=text-warning>PENDING</span>'))
                                                ];

                                        ?>
                                                <tr>
                                                    <td><?php echo $data['First_Name'] ?></td>
                                                    <td><?php echo $data['Admn_No'] ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($data['createdon'])); ?></td>
                                                    <td class="text-right"><?php echo my_money_format($data['amt_total']) ?></td>
                                                    <td><?php echo ($data['Exn_Status'] == 'A' ? '<span class="text-success">APPROVED</span>' : ($data['Exn_Status'] == 'R' ? '<span class="text-danger">REJECTED</span>' : '<span class="text-warning">PENDING</span>')) ?></td>
                                                    <td class="text-center">
                                                        <a title="View Details" href="javascript:void(0)" onclick="view_data('<?php echo $data['id'] ?>','<?php echo $data['student_id'] ?>', '<?php echo ($data['is_approved'] == 1 ? 'APPROVED' : ($data['is_rejected'] == 1 ? 'REJECTED' : 'PENDING')) ?>','<?php echo implode('*', $starray); ?>');">
                                                            <i class="fa fa-paper-plane"></i>
                                                        </a>
                                                    </td>
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
            </div>
            <div class="ibox float-e-margins" id="view-container"></div>
        </div>
    </div>
</div>



<script type="text/javascript">
    var table = $('#exemption_request_list').dataTable({
        responsive: false,
        stateSave: false,
        "lengthMenu": [
            [50, 100, 250, 500, -1],
            [50, 100, 250, 500, "All"]
        ],
        iDisplayLength: 50,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });

    function view_data(id, student_id, status, studdata) {
        var ops_url = baseurl + 'fees/view_exemption_details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "exmp_id": id,
                "student_id": student_id,
                "status": status,
                "studdata": studdata
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#view-container').html('');
                    $('#view-container').html(data.view);
                    $('html, body').animate({
                        scrollTop: $("#view-container").offset().top
                    }, 1000);
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>