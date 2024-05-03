<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_uuid_details">
        <thead>
            <tr>
                <th><?php echo isset($uuid_name) ? $uuid_name : 'UUID' ?></th>
                <th>Admission No.</th>
                <th>Name</th>
                <th>Father's Name</th>
                <th>Contact No</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($uuid_data) && !empty($uuid_data)) {
                foreach ($uuid_data as $uuid_details) {
                    if (!empty($uuid_details['Inst_ID'])) {
                        if ($this->session->userdata('inst_id') == $uuid_details['Inst_ID']) {
                            if (isset($uuid_details['admn_no'])) { ?>
                                <tr>
                                    <td width="10%"><?php echo $uuid_details['UUID_NO'] ?></td>
                                    <td width="5%"><?php echo $uuid_details['admn_no'] ?></td>
                                    <td width="35%"><?php echo $uuid_details['student_name'] ?></td>
                                    <td width="35%"><?php echo $uuid_details['Parent_Name'] ?></td>
                                    <td width="10%"><?php echo $uuid_details['contact_no'] ?></td>
                                <?php if(trim($uuid_details['StatusFlag'],' ') == 'TP'){ ?>
                                    <td width="5%"><span class="label label-danger pull-right">TC ISSUED</span></td>
                                <?php }else{?>
                                    <td width="5%"> <a style="font-size: 18px; color: #f8ac59;" href="javascript:void(0)" data-toggle="tooltip" title="Edit student profile" onclick="edit_profile(<?php echo $uuid_details['student_id']; ?>)">
                                            <i class="fa fa-pencil-square-o"></i> </a></td>
                                <?php } ?>
                                </tr>
                            <?php
                            } else { ?>
                                <tr>
                                    <td>No Data Found On Students Details</td>
                                </tr>
                        <?php }
                        }
                    } else { ?>
                        <tr>
                            <td>No data found on students details in this institution.</td>
                        </tr>
            <?php }
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_uuid_details').dataTable({
            columnDefs: [{
                    "width": "20%",
                    className: "capitalize",
                    "targets": 0
                },
                {
                    "width": "15%",
                    className: "capitalize",
                    "targets": 1
                },
                {
                    "width": "30%",
                    className: "capitalize",
                    "targets": 2
                },
                {
                    "width": "15%",
                    className: "capitalize",
                    "targets": 3
                },
                {
                    "width": "20%",
                    className: "capitalize",
                    "targets": 4
                },
            ],
            responsive: false,
            iDisplayLength: 10,
            bPaginate: false
        });
    });

    function edit_profile(studentid) {
        $('#registration_loader').addClass('sk-loading');
        var ops_url = baseurl + 'registration/edit-profile';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#registration_loader').removeClass('sk-loading');
                    $('#content').html('');
                    $('#content').html(data.view);
                    var animation = "fadeInDown";
                    $("#content").show();
                    $('#content').addClass('animated');
                    $('#content').addClass(animation);
                } else {
                    alert('No data loaded');
                    $('#registration_loader').removeClass('sk-loading');
                }
            }
        });
    }
</script>