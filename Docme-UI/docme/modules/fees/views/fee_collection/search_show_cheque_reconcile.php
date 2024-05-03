<div class="col-lg-12 col-xs-12 col-md-12">
    <div class="table-responsive">
        <table class="table table-hover table-bordered margin bottom" id="available_cheque_for_reconcile">
            <thead>
                <tr>
                    <th>Tr.Date</th>
                    <th>Ch. No.</th>
                    <th>Ch.date</th>
                    <!--<th>Name</th>-->
                    <th>Bank Detail</th>
                    <!--<th>Branch Name</th>-->
                    <th>Voucher No.</th>
                    <th>Voucher Total</th>
                    <th>Student Name</th>
                    <th>Admission No.</th>
                    <th class="text-center">Task</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($cheque_data) && !empty($cheque_data)) {

                    foreach ($cheque_data as $data) {
                ?>
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($data['trans_date'])); ?></td>
                            <td><?php echo $data['ch']['number'] ?></td>
                            <td><?php echo date('d/m/Y', strtotime($data['ch']['cqdate'])) ?></td>
                            <!--<td><?php echo $data['ch']['account_holder_name'] ?></td>-->
                            <td><?php echo $data['ch']['bank_name'] . ', ' . $data['ch']['branch'] ?></td>
                            <!--<td><?php echo $data['ch']['branch'] ?></td>-->
                            <td><?php echo $data['VOUCHER'] ?></td>
                            <td><?php echo $data['Voucher_total'] ?></td>
                            <td><?php echo $data['psn']['student_name'] ?></td>
                            <td><?php echo $data['psn']['admn_no'] ?></td>
                            <!-- Added By SALAHUDHEEN May 29, 2019; Added title="Reconcile Cheque" in below <a> tag -->
                            <td class="text-center">
                                <a title="Reconcile Cheque" href="javascript:void(0)" onclick="reconcile_data('<?php echo $data['MASTER_ID'] ?>', '<?php echo $data['ch']['number'] ?>', this);"><i class="fa fa-paper-plane"></i></a>
                                <a title="Cancel Cheque" href="javascript:void(0)" onclick="cancel_cheque('<?php echo $data['MASTER_ID'] ?>', '<?php echo $data['ch']['number'] ?>', this);"><i class="fa fa-minus-square text-danger"></i></a>
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