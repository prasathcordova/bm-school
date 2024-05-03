<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">     
                    <div class="ibox-title">
                        <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                                <div class="row">

                                    <?php
                                    if (isset($substore_data) && !empty($substore_data) && is_array($substore_data)) {
                                    $breaker = 0;
                                        foreach ($substore_data as $substore) {
                                    ?>

                                    <div class="col-lg-4">
                                        <div class="contact-box center-version" style="min-height: 210px; min-width: 150px;">
                                            <a href="javascript:void(0);">

                                                <h3 class="m-b-xs"><strong><?php echo $substore['store_name']  ?></strong></h3>
                                            </a>
                                            <table class="table table-hover">
                                                <tbody >
                                                <div class="font-bold" style="padding-left: 30px;">Contact No : <?php echo $substore['phone']  ?></div>
                                                <div class="font-bold" style="padding-left: 30px;">Email ID : <?php echo $substore['email']  ?></div>
                                                <!--<div class="font-bold" style="padding-left: 30px;">Address : <?php // echo address_formatter($store['address1'] , $store['address2'] ,$store['address3'] )  ?></div>-->

                                                </tbody>
                                            </table>

                                            <div class="contact-box-footer">
                                                <div class="m-t-xs btn-group">
                                                    <a href="javascript:void(0);" onclick="select_list('<?php echo $substore['store_id'];  ?>', '<?php echo $substore['store_name'];  ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Select</a>        
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php                               
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

    function select_list(id, name) {
        var storeid = id
        var storename = name
        var ops_url = baseurl + 'allotment/add-allotment/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "storeid": storeid, "storename": storename},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }

</script>