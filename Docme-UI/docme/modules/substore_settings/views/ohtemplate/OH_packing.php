

<div   class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content">



                    <!--<div class="col-lg-12">-->
                    <div class="input-group" style="margin-bottom:26px">
                        <input type="text" id="search_template" name="search_template" placeholder="Search Template by name..." class=" form-control">
                        <span class="input-group-btn">
                            <button type="button" id="button_id" class="btn btn-info" onclick="search_template();"> Search</button>      

                        </span>
                    </div>
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div  class="row" style="margin-left: -29px !important; margin-right: -30px !important;">-->
                    <!--<div class="col-lg-12">-->
                    <div class=" animated fadeInRight" id="template_replace">
                        <div class="row" style="margin-right:0px; padding-left: 2px;  padding-top: 2px;">

                            <?php
                            if (isset($oh_data) && !empty($oh_data) && is_array($oh_data)) {
                                foreach ($oh_data as $oh) {
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="ibox float-e-margins">
                                            <div id="iboxtitle_oh" class="ibox-title iboxtitle_oh" style="border-bottom-color:#23c6c8; height: 46px !important">
                                                <b title="Template name"><?php echo $oh['name']; ?> </b>
                                            </div>
                                            <div class="ibox-content">
                                                <li  style="list-style: none;"class="warning-element ui-sortable-handle" id="task5">
                                                    <div class=" scroll_content_1"  title="Description">
                                                        <small> <?php echo $oh['description']; ?></small>
                                                    </div>
                                                    <div class="agile-detail" style="padding-top: 4px !important">
                                                        <?php
                                                        if (check_permission(539, 1016, 0)) {
                                                            ?>
                                                            <a style="margin-top : 5px"  href="javascript:void(0);" onclick="items_add('<?php echo $oh['id']; ?>', '<?php echo $oh['name']; ?>');"><span  title="Select <?php echo $oh['name']; ?>" class="label label-warning pull-right">Select <i class="fa fa-arrow-right"></i></span></a> 
                                                            <span class="label label-info" title="<?php echo isset($oh['total_qty']) ? $oh['total_qty'] . ' items added' : 'No items added' ?> ">Items Qty : <?php echo isset($oh['total_qty']) ? $oh['total_qty'] : 0 ?> </span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </li>
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
    #iboxtitle_oh {
        border-bottom: solid 2px #23c6c8 !important;
    }
    .ibox-new-2{padding:15px !important;}

    .form-group-new input{border-radius:3px; border:none;}

    .product-imitation{color:#898989;padding:55px 0; margin:0 0 15px 0;}
    .top-pad{padding:15px 0 0 0;}
    .btn{margin:0 0 0 10px;}

    .i-checks{position:absolute;right:12px;top: 8px;}
    .transfer-list{margin:10px 0; position: relative;}
    .ibox-new{margin:15px 0 0 0; border:solid 2px #F3F3F4;}
    a .ibox-new{color:#676a6c}
    a .ibox-new:hover{border:solid 2px #23C6C8;}
    a .ibox-new .ibox-title{background:#F3F3F4}
    a .ibox-new:hover .ibox-title{background:#23C6C8 !important; color:#fff;}



</style>


<script>
    var input = document.getElementById("search_template");
    input.addEventListener("keyup", function (event) {
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
        height: '700px',
        color: '#f8ac59'

    })
    $('.scroll_content_1').slimscroll({
        height: '50px',
        color: '#f8ac59',
        scrollByX: '100px'

    })

</script>

<script type="text/javascript">
    $('document').ready(function () {
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




</script>


<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win) {
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

</script>

<script type="text/javascript">

    function search_template() {
        var search_template = $("#search_template").val();
        var ops_url = baseurl + 'substore/search_template_byname/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "search_template": search_template},
            success: function (result) {
                var data = JSON.parse(result)

                if (data.status == 1) {
                    $('#template_replace').html('');
                    $('#template_replace').html(data.view);
                    var animation = "fadeInDown";
                    $("#template_replace").show();
                    $('#template_replace').addClass('animated');
                    $('#template_replace').addClass(animation);
                     $('.scroll_content_1').slimscroll({
                       height: '50px',
                       color: '#f8ac59',
                       scrollByX: '100px'

                   })
                    //                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }

            }
        });
    }
    function items_add(id, name) {
        var ops_url = baseurl + 'substore/items-adding/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "id": id, "name": name},
            success: function (result) {
                $('#data-view').html(result);
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