
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;paddding-bottom:0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <span style="padding-right: 9px;"><a href="javascript:void(0);" class="btn btn-primary btn-xs" onclick="add_new_item();" ><i class="fa fa-plus"></i> NEW ITEM</a> </span>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_item_details" >

                                    <thead>
                                        <tr>                                            
                                            <th>Item Type </th>
                                            <th>Item Name </th>
                                            <th>Item Code </th>
                                            <th>publisher</th>
                                            <th>Category</th>
                                            <th>Edition</th>
                                            <th>Task</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($item_data as $item) {
                                            ?>
                                            <tr>                                            
                                                <td><?php echo $item['itemtype_name'] ?></td>
                                                <td><?php echo $item['item_name']; ?></td>
                                                <td><?php echo $item['item_code']; ?></td>
                                                <td><?php echo $item['pub_name']; ?></td>
                                                <td><?php echo $item['cate_name']; ?></td>
                                                <td><?php echo $item['edition_name']; ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" onclick="edit_item_details('<?php echo $item['item_id'] ?>');"><i style="font-size: 22px !important; color: #23C6C5;" class="material-icons">edit</i></a>                                                       
                                                </td>
                                            </tr>
                                            <?php
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


<script type="text/javascript">
    $('#tbl_item_details').dataTable({

        columnDefs: [
            {"width": " 8%", className: "capitalize", "targets": 0},
            {"width": "15%", className: "capitalize", "targets": 1},
            {"width": "15%", className: "capitalize", "targets": 2},
            {"width": "15%", className: "capitalize", "targets": 3},
            {"width": "15%", className: "capitalize", "targets": 4},
            {"width": "20%", className: "capitalize", "targets": 5},
            {"width": "10%", className: "capitalize", "targets": 6, "orderable": false}
        ],
        responsive: true,
        "fnDrawCallback": function (ele) {
            $('.js-switch').map(function () {
                if ($(this).is(":visible") == true) {
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    elems.forEach(function (html) {
                        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
                    });
                }
            })
        }


    });


    $('.js-switch').change(function (e) {

    });


    $(".js-switch").click(function () {
    });



    function refresh_add_panel() {
        $('#state_name').val('');
        $('#state_name').parent().removeAttr('class', 'has-error');

    }


    function close_add_details() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }


    function edit_item_details() {
        var ops_url = baseurl + 'details/add-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
                if (data) {
                    $('#curd-content').html(data);


                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function add_new_item() {
        var ops_url = baseurl + 'details/add-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
                if (data) {
                    var animation = "fadeInDown";
                    $('#data-view').addClass(animation);
                    $('#data-view').html('');
                    $('#data-view').html(data);

                    $('#publisher').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#itemtype').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#itemedition').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });

                    $('#stock_category').select2({
                        "theme": "bootstrap",
                        "width": "100%"
                    });
                    activateSwitchery();


                } else {
                    alert('No data loaded');
                }
            }
        });
    }
    var list_switchery = [];
    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#23C6C8', secondaryColor: '#F8AC59', size: 'small'});
            list_switchery.push(switchery);
        });
    }

</script>


