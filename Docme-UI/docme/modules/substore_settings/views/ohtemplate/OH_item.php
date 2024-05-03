<script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/theme/js/plugins/dataTables/datatables.min.js'); ?>"></script>


<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">

    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12 ">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" style="min-height: 756px !important">


                    <div class="input-group" style="margin-bottom:26px">
                        <input type="text" id="openhouse" name="openhouse" placeholder="Search Open House by name..." class=" form-control">
                        <span class="input-group-btn">
                            <button type="button" id="button_id" class="btn btn-info" onclick="openhouse();"> Search</button>

                        </span>
                    </div>


                    <div class="row" id="openhouse-data">
                        <div class=" animated fadeInRight">


                            <?php
                            if (isset($oh_master) && !empty($oh_master) && is_array($oh_master)) {
                                foreach ($oh_master as $master) {
                            ?>

                                    <div class="col-lg-4">

                                        <div class="panel panel-info">

                                            <div class="panel-heading" style="height: 40px !important;">

                                                <h5><b><?php echo $master['oh_data']['description']; ?></b></h5>
                                            </div>

                                            <div class="panel-body">
                                                <div class="scroll_content">

                                                    <table class="table">
                                                        <thead>
                                                            <tr style="">
                                                                <td colspan="2">
                                                                    <p><span class="">From &nbsp; <b><?php echo date('d/m/Y', strtotime($master['oh_data']['start_date'])) ?></b> &nbsp; To &nbsp;<b><?php echo date('d/m/Y', strtotime($master['oh_data']['end_date'])) ?></b> &nbsp;</span></p>
                                                                    <p><span class="">Kit per student : <B> <?php echo $master['oh_data']['kit_per_student']; ?></b></span></p>
                                                                </td>
                                                            </tr>


                                                        </thead>
                                                        <?php
                                                        foreach ($master['template_data'] as $template) {
                                                        ?>

                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo $template['name'] ?> </td>
                                                                    <td><a href="javascript:void(0);" onclick="student_assignment('<?php echo $master['oh_data']['id']; ?>', '<?php echo $template['template_id']; ?>');"><span class="label label-warning pull-right">Select</span></a> </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                            ?>
                                                </div>
                                                </tbody>

                                                </table>

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



<style>
    .ibox-new-2 {
        padding: 15px !important;
    }

    .form-group-new input {
        border-radius: 3px;
        border: none;
    }

    .product-imitation {
        color: #898989;
        padding: 55px 0;
        margin: 0 0 15px 0;
    }

    .top-pad {
        padding: 15px 0 0 0;
    }

    .btn {
        margin: 0 0 0 10px;
    }

    .i-checks {
        position: absolute;
        right: 12px;
        top: 8px;
    }

    .transfer-list {
        margin: 10px 0;
        position: relative;
    }

    .ibox-new {
        margin: 15px 0 0 0;
        border: solid 2px #F3F3F4;
    }

    a .ibox-new {
        color: #676a6c
    }

    a .ibox-new:hover {
        border: solid 2px #23C6C8;
    }

    a .ibox-new .ibox-title {
        background: #F3F3F4
    }

    a .ibox-new:hover .ibox-title {
        background: #23C6C8 !important;
        color: #fff;
    }
</style>


<script>
    var input = document.getElementById("openhouse");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id").click();
        }
    });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
    $('.scroll_content').slimscroll({
        height: '250px',
        color: '#f8ac59'

    })
</script>

<script type="text/javascript">
    function openhouse() {
        var openhouse = $("#openhouse").val();
        var ops_url = baseurl + 'substore/item-templatepack_search/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "openhouse": openhouse
            },
            success: function(result) {
                var data = JSON.parse(result)

                if (data.status == 1) {
                    $('#openhouse-data').html('');
                    $('#openhouse-data').html(data.view);
                    var animation = "fadeInDown";
                    $("#openhouse-data").show();
                    $('#openhouse-data').addClass('animated');
                    $('#openhouse-data').addClass(animation);
                    //                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }

            }
        });
    }



    $('document').ready(function() {
        $('#item_list').css("display", "none");
        $('#confim_item_list').css("display", "none");
        $('#template-list').css("display", "block");
    });



    function item_confirm() {
        var element = document.getElementById("confim_item_list");

        $('#confim_item_list').css("display", "block");
        //#Detail_pack{display:block;}
    }

    function confirm_item_close() {
        var element = document.getElementById("confim_item_list");

        $('#confim_item_list').css("display", "none");
        //#Detail_pack{display:block;}
    }



    function temp_confirm() {
        var element = document.getElementById("item_list");

        $('#item_list').css("display", "block");
        //#Detail_pack{display:block;}
    }

    function temp_confirm_2() {
        var element = document.getElementById("template-list");

        $('#template-list').css("display", "none");
        //#Detail_pack{display:block;}
    }


    function item_close() {
        var element = document.getElementById("item_list");

        $('#item_list').css("display", "none");
        //#Detail_pack{display:block;}
    }

    function item_close_2() {
        var element = document.getElementById("template-list");

        $('#template-list').css("display", "block");
        //#Detail_pack{display:block;}
    }




    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },

                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });


    function student_assignment(openhouse_id, template_id) {
        //        alert(openhouse_id);
        //        alert(template_id);return false;
        var ops_url = baseurl + 'substore/item-stud_attach/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "openhouse_id": openhouse_id,
                "template_id": template_id
            },
            success: function(result) {
                var data = JSON.parse(result);

                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').stop().animate({
                        scrollTop: $($('.ibox-content')).offset().top - 55
                    }, 500);
                    return true;
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    return false;
                } else {
                    swal('', 'An error occurred while creating student assign . Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                    return false;
                }


            }
        });
    }

    var divs = ["Menu1", "Menu2", "Menu3", "Menu4", "Menu5", "Menu6"];
    var visibleDivId = null;

    function toggleVisibility(divId) {
        if (visibleDivId === divId) {
            //visibleDivId = null;
        } else {
            visibleDivId = divId;
        }
        hideNonVisibleDivs();
    }

    function hideNonVisibleDivs() {
        var i, divId, div;
        for (i = 0; i < divs.length; i++) {
            divId = divs[i];
            div = document.getElementById(divId);
            if (visibleDivId === divId) {
                div.style.display = "block";
            } else {
                div.style.display = "none";
            }
        }
    }


    // Add slimscroll to element
    $('.scroll_content').slimscroll({
        height: '415px'
    })

    $('.scroll_content-3').slimscroll({
        height: '380px'
    })

    $('.scroll_content-2').slimscroll({
        height: '405px'
    })

    $(".select2_demo_1").select2({
        "theme": "bootstrap",
        "width": "100%"

    });
</script>