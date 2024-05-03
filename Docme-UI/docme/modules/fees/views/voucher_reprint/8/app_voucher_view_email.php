<div class="row">
    <div class="col-lg-12 animated fadeInRight">
        <div class="mail-box-header">
            <div class="pull-right tooltip-demo">
            <?php 
            if ($vouchertype == 'temp_regfee') {
                $ptype = 'REGFEE';
            } else if ($vouchertype == 'temp_admfee') {
                $ptype = 'ADMFEE';
            } else {
                $ptype = substr($master_data[0]['voucher_code'], 0, 3);
            }
            ?>
                <!-- <a href="javascript:" onclick="sendmail()" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a> -->
                <a href="javascript:" onclick="re_print_voucher(<?php echo $master_data[0]['id']; ?>, '<?php echo $master_data[0]['voucher_code']; ?>','confirmmail');" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-send"></i> Send</a>
                <a href="javascript:" onclick="select_items(<?php echo $master_data[0]['id'] ?>,'<?php echo $master_data[0]['voucher_code'] ?>','<?php echo $ptype; ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
            </div>
            <h4>
                <?php $vouchercode = (isset($master_data[0]['cheque_reconciled_voucher']) ? $master_data[0]['cheque_reconciled_voucher'] : $master_data[0]['voucher_code']); ?>
                <i class="fa fa-file-text-o"></i> Send Voucher
            </h4>
        </div>
        <div class="mail-box">


            <div class="mail-body">

                <form class="form-horizontal" method="get">
                    <div class="form-group"><label class="col-sm-2 control-label">To:</label>

                        <div class="col-sm-10"><input type="text" class="form-control" value="" id="mailtosend"></div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>

                        <div class="col-sm-10"><input type="text" class="form-control" value="Fee Voucher" readonly></div>
                    </div>
                </form>

            </div>

            <div class="mail-text h-200">

                <div class="summernote" style="padding:1%;">
                    <?php echo $this->load->view('app_voucher_send_mail', TRUE); ?>

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="mail-body text-right tooltip-demo">
                <a href="javascript:" onclick="re_print_voucher(<?php echo $master_data[0]['id']; ?>, '<?php echo $master_data[0]['voucher_code']; ?>','confirmmail');" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-send"></i> Send</a>
                <a href="javascript:" onclick="select_items(<?php echo $master_data[0]['id'] ?>,'<?php echo $master_data[0]['voucher_code'] ?>','<?php echo $ptype; ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                <!-- <a href="javascript:" onclick="sendmail()" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a> -->
            </div>
            <div class="clearfix"></div>



        </div>
    </div>
</div>
<!-- SUMMERNOTE -->
<script>
    // $(document).ready(function() {

    //     $('.summernote').summernote();

    // });
</script>