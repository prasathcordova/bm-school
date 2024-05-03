<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="report_param_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="body">
                        <?php
                        echo form_open('report/stud-agewisepdf');
                        ?>
                        <input type="hidden" name="save_flag" id="save_flag" value="1" />
                        <div class="row clearfix">
                            <!--  <div class="col-lg-12 col-md-12 col-xs-12" id="form_data">
                                <div class="form-group" id="data_1">
                                    <label for="reportdate">
                                        &nbsp;Report Date:</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" data-date-startdate="2017-12-05" class="form-control" name="reportdate" id="reportdate" value="<?php echo date('d/m/Y'); ?> - <?php echo date('d/m/Y'); ?>" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="displaytaxorvat" value="<?php echo print_tax_vat(); ?>"> -->


                            <div class="col-lg-6 col-md-6 col-xs-12" id="form_data">
                                <div class="form-group" id="data_1">
                                    <label for="">
                                        &nbsp;Concession Type</label>
                                    <select name="concession_type" id="concession_type" class="form-control " style="width:100%;">
                                        <option value="1">Family Concession</option>
                                        <!-- <option value="2">Staff Concession</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12" align="left">
                                <a href="javascript:void(0);" class="btn btn-info btn-md" onclick="submit_data(1);">
                                    <i class="fa fa-file-pdf-o"></i> GET REPORT
                                </a>
                                
                            <a href="javascript:void(0);" class="btn btn-warning btn-md" onclick="submit_data(2);" style="cursor:pointer;"><i class="fa fa-file-excel-o"></i> Export to Excel</a> 

                            </div>
                        </div>

                        <a href="#" style="display:none" id="testpdf"></a>
                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="report_content"></div>
    <style>
        .panel-body-new {
            padding: 0 !important;
        }
    </style>

    <script type='text/javascript'>
        $('#concession_type').select2({
            'theme': 'bootstrap'
        });

        function submit_data(rpt_type = 1) {
            $('#report_param_loader').addClass('sk-loading');
            var concession_type = $('#concession_type').val();
            var ops_url = baseurl + 'fees/report/get_concession_students_report';
            $.ajax({
                type: "POST",
                cache: false,
                // async: false,
                url: ops_url,
                data: {
                    "concession_type": concession_type,
                    "type": 2,
                    "rpt_type": rpt_type
                },
                success: function(data) {
                    try {
                        var datas = JSON.parse(data);
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        } else if (datas.status == 1) {
                            window.open(datas.message, '_blank');
                            $('#report_param_loader').removeClass('sk-loading');
                        }
                    } catch (e) {
                        $('#report_param_loader').removeClass('sk-loading');
                        swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                        return false;
                    }
                }
            });
        }
    </script>