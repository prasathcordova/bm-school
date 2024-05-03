
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
<div id="profile-detail-content">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <h2 style="font-size: 20px;">
                <?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
            </h2>
        </div>    
    </div>
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">                    
                    <div class="ibox-content">
                        <div class="row">
                            <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                                <div class="row">

                                    <?php
                                    if (isset($suppliers_data) && !empty($suppliers_data) && is_array($suppliers_data)) {
                                        $breaker = 0;
                                        foreach ($suppliers_data as $suppliers) {
                                            if ($suppliers['isactive'] == 1) {
                                                ?>

                                                <div class="col-lg-4">
                                                    <div class="contact-box center-version" style="min-height: 210px; min-width: 150px;">
                                                        <a href="javascript:void(0);">

                                                            <h3 class="m-b-xs"><strong><?php echo $suppliers['name'] ?></strong></h3>


                                                        </a>
                                                        <table class="table table-hover">
                                                            <tbody >
                                                            <div class="font-bold" style="padding-left: 30px;">Contact No : <?php echo $suppliers['contact'] ?></div>
                                                            <div class="font-bold" style="padding-left: 30px;">Email ID : <?php echo $suppliers['emailid'] ?></div>

                                                            </tbody>
                                                        </table>

                                                        <div class="contact-box-footer">
                                                            <div class="m-t-xs btn-group">
                                                                <a href="javascript:void(0);" onclick="selectreturn('<?php echo $suppliers['id']; ?>', '<?php echo $suppliers['name']; ?>')" class="btn btn-xs btn-white"  data-toggle="tooltip" title="Select Supplier"><i class="fa fa-user-plus"></i> Select</a>        
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $(".select2_demo_1").select2({
            "theme": "bootstrap",
            "width": "100%"

        });
        $(".select2_demo_2").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_demo_3").select2({
            "theme": "bootstrap",
            "width": "100%"
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#search_student').hide();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


    });

    function selectreturn(id, name) {
        var supplierid = id
        var suppliername = name
        var ops_url = baseurl + 'purchase/return-purchase/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "supplierid": supplierid, "suppliername": suppliername},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }


</script>

