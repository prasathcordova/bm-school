<table class="table table-striped table-bordered dataTables-example" id="tbl_student_arrear" style="width:100%;">
    <thead>
        <tr>
            <th width="15%">
                <input type='hidden' id='arrear_summary_data' value='<?php echo $summary; ?>'>
                <input type='hidden' id='arrear_saved_today' value='<?php echo $arrear_saved_today; ?>'>
                Admission No.
            </th>
            <th width="20%">Student Name</th>
            <th width="6%">Class</th>
            <th width="20%">Batch</th>
            <th width="6%">Status</th>
            <th width="15%">Fee</th>
            <th width="15%">Month</th>
            <th width="10%">Arrear amt.</th>

        </tr>
    </thead>
    <tbody>
        <?php
        //dev_export($student_data);
        //dev_export($summary);
        if (isset($student_data) && !empty($student_data)) {
            foreach ($student_data as $details) {
        ?>
                <tr>
                    <td class="student_data_id" data-studentid="<?php echo $details['STUDENT_ID'] ?>"><?php echo $details['Admn_No'] ?></td>
                    <td><?php echo $details['student_name'] ?></td>
                    <td align="center"><?php echo $details['class_name'] ?></td>
                    <td><?php echo isset($details['Batch_Name']) && !empty($details['Batch_Name']) ? $details['Batch_Name'] : "Batch Not Available"; ?></td>
                    <td><?php echo $details['StatusFlag'] ?></td>
                    <td><?php $arr = explode('demanded', $details['TRANSACTION_DESC'], 2);
                        echo $first = $arr[0]; ?></td>
                    <td><?php echo date('M-Y', strtotime($details['DEMAND_DATE'])); ?></td>
                    <td><?php echo my_money_format($details['PENDING_PAYMENT']); // use this function(number_format) only for displaying 
                        ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>
<script>
    var table = $('#tbl_student_arrear').dataTable({

        columnDefs: [{
                "width": "40%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            }, //, "orderable": false
            {
                "width": "20%",
                className: "capitalize",
                "targets": 3
            } //, "orderable": false
        ],
        "aaSorting": [],

        bPaginate: true,
        //        stateSave: true,
        "lengthMenu": [
            [250, 500, 750, -1],
            [250, 500, 750, "All"]
        ],
        pageLength: 250,
               dom: '<"html5buttons"B>lTfgitp',
               buttons: [
        
               ],


    });
</script>