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
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container" style="padding-top:0px !important;">

                        <div class="row" id="data-view-feecode">
                            <div class="ibox-content" id="item_list_detail">
                                <div class="row" id="">
                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">

                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                FEE ALLOCATION DETAILS (<?php echo print_tax_vat(); ?> will be calculated at the time of collection)
                                                <span class="label label-info pull-right"><a href="javascript:void(0)" onclick="load_fee_code_allotment()"><i class="fa fa-close" style="font-size:22px;"></i></a></span>
                                            </div>

                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover margin bottom" id="allotted_fee_codes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fee code</th>
                                                                <th>description</th>
                                                                <th>Type</th>
                                                                <th>Demand Frequency</th>
                                                                <th><?php echo print_tax_vat(); ?></th>
                                                                <th class="text-center">Fees Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($fee_codes_already_linked) && !empty($fee_codes_already_linked)) {
                                                                foreach ($fee_codes_already_linked as $fee_codes) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $fee_codes['feeCode']; ?></td>
                                                                        <td><?php echo $fee_codes['description']; ?></td>
                                                                        <td><?php echo $fee_codes['feeTypeName']; ?></td>
                                                                        <td><?php echo ($fee_codes['monthSpan'] == -2 ? 'One Time Fee' : ($fee_codes['monthSpan'] == -3 ? 'CUSTOM TERM' : ($fee_codes['monthSpan'] == 12 ? 'Yearly' : $fee_codes['monthSpan'] . " month/s"))); ?></td>
                                                                        <td><?php echo $fee_codes['vat'] . " %"; ?></td>
                                                                        <td class="text-center"><?php echo $fee_codes['fee_amount']; ?> </td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var table3 = $('#allotted_fee_codes').dataTable({
        responsive: false,
        iDisplayLength: 10,
        "ordering": true,
    });

    function load_fee_code_allotment() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'fees/fees-student-allotment/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#faculty_loader').removeClass('sk-loading');
                $('#data-view').html(result);
            }
        });
        $('#faculty_loader').removeClass('sk-loading');
    }
</script>