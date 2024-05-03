<div class="panel panel-info">
    <div class="panel-heading">
        FEE DETAILS PAID FOR THE VOUCHER - <?php echo $voucher_no; ?>
        <span class="label label-info pull-right"><a href="javascript:void(0)" data-toggle="tooltip" title="Save payback request" onclick="save_payback_request()"><i class="fa fa-floppy-o" style="font-size:19px;"></i></a></span>

    </div>
    <div class="panel-body">
        <input type="hidden" name="master_id" id="master_id" value="<?php echo $master_id; ?>" />
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <b>Reason for Payback <span style="color:red;">*</span></b>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('reason')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" tabindex="1" class="form-control alpha" maxlength="60" name="reason" id="reason" placeholder="Reason for Payback" value="" />
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover margin bottom" id="available_fee_code_for_payback">
                        <thead>
                            <tr>
                                <!-- <th>Fee Code</th> -->
                                <th>Description</th>
                                <!-- <th>Paid Amount</th> -->
                                <th>Payback Approved</th>
                                <th>Payback Req. Amt</th>
                                <th>Available Amount</th>
                                <th>Possible Payback Amount</th>
                                <th>Amount for Current Transaction</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($fee_data) && !empty($fee_data)) {
                                foreach ($fee_data as $fees) {
                                    if ($fees['is_penalty'] == 1) $feedescription = 'Penalty ' . $fees['description'];
                                    else $feedescription = $fees['description'];
                            ?>
                                    <tr>
                                        <!-- <td><?php echo $fees['feeCode']; ?></td> -->
                                        <td><?php echo $feedescription; ?></td>
                                        <!-- <td><?php echo $fees['paid_amount']; ?></td> -->
                                        <td class="text-right"><?php echo $fees['payback_approved_amount'] == 0 ? 0.00 : my_money_format($fees['payback_approved_amount']); ?></td>
                                        <td class="text-right"><?php echo $fees['payback_request_amount'] == 0 ? 0.00 : my_money_format($fees['payback_request_amount']); ?></td>
                                        <td class="text-right"><?php echo $fees['payback_available_amount'] == 0 ? 0.00 : my_money_format($fees['payback_available_amount']); ?></td>
                                        <td class="text-right"><?php echo ($fees['payback_available_amount'] - $fees['payback_request_amount']) == 0 ? 0.00 : my_money_format($fees['payback_available_amount'] - $fees['payback_request_amount']); ?></td>

                                        <td>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" maxlength="8" class="form-control payback_payable_amount text-right digits" name="payback_request_amount" id="payback_request_amount" value="0" data-paymentdetailid="<?php echo $fees['details_id'] ?>" data-feedetailid="<?php echo $fees['details_id']; ?>" data-feecodeid="<?php echo $fees['feecode_id']; ?>" data-maxamount="<?php echo ($fees['payback_available_amount'] - $fees['payback_request_amount']) == 0 ? 0.00 : ($fees['payback_available_amount'] - $fees['payback_request_amount']); ?>" tabindex="1" />
                                                </div>
                                            </div>
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
<script type="text/javascript">
    var table1 = $('#available_fee_code_for_payback').dataTable({
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });
    //Function to allow only Decimal values to textbox
    function validateDec(key) {
        //getting key code of pressed key
        var keycode = (key.which) ? key.which : key.keyCode;
        //comparing pressed keycodes
        if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57)) {
            return false;
        } else {
            var parts = key.srcElement.value.split('.');
            if (parts.length > 1 && keycode == 46)
                return false;
            return true;
        }
    }
</script>