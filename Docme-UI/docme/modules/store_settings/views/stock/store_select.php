

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">     
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <!--<div class="ibox-tools" id="add_type">-->

<!--<a data-toggle="modal" class="btn btn-primary btn-xs" title="Add an Item" data-placement="left" href="javascript:void(0);" onclick="select_all();"><i ></i>SELECT ALL</a>-->

                    <!--</div>-->
                    <div class="ibox-content">
                        <div class="row">
                            <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                                <div class="row">

                                    <?php
                                    if (isset($store_data) && !empty($store_data) && is_array($store_data)) {
                                        $breaker = 0;
                                        foreach ($store_data as $store) {
                                            ?>

                                            <div class="col-lg-4">
                                                <div class="contact-box center-version" style="min-height: 210px; min-width: 150px;">
                                                    <a href="javascript:void(0);">

                                                        <h3 class="m-b-xs"><strong><?php echo $store['store_name'] ?></strong></h3>
                                                    </a>
                                                    <table class="table table-hover">
                                                        <tbody >
                                                        <div class="font-bold" style="padding-left: 30px;">Contact No : <?php echo $store['phone'] ?></div>
                                                        <div class="font-bold" style="padding-left: 30px;">Email ID : <?php echo $store['email'] ?></div>
                                                        <!--<div class="font-bold" style="padding-left: 30px;">Address : <?php echo address_formatter($store['address1'], $store['address2'], $store['address3']) ?></div>-->

                                                        </tbody>
                                                    </table>

                                                    <div class="contact-box-footer">
                                                        <div class="m-t-xs btn-group">
                                                            <a href="javascript:void(0);" onclick="select_list('<?php echo $store['store_id']; ?>', '<?php echo $store['store_name']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Select</a>        
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
        var ops_url = baseurl + 'stock/item-stock/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "storeid": storeid, "storename": storename},
            success: function (result) {
                try {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data-view').html(data.view);
                        $('#tbl_selected').dataTable({
                            columnDefs: [
                                {"width": "10%", className: "capitalize", "targets": 0},
                                {"width": "10%", className: "capitalize", "targets": 1},
                                {"width": "15%", className: "capitalize", "targets": 2},
                                {"width": "10%", className: "capitalize", "targets": 3},
                                {"width": "20%", className: "capitalize", "targets": 4},
                                {"width": "15%", className: "capitalize", "targets": 5},
                                {"width": "20%", className: "capitalize", "targets": 6}
                            ],

                            iDisplayLength: 10,

                        });
                    } else if (data.status == 2) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10004', 'info')
                        }
                    } else if (data.status == 3) {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10005', 'info')
                        }
                    } else {
                        if (data.message) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'An error occurred while creating purchase order. Please try again later or contact administrator with error code : DPRDTAER10006', 'info')
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });

    }

    function select_all() {
        select_list();
        return true;
    }

</script>

