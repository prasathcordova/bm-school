
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" title="New opening stock" data-placement="left"  onclick="add_stock();"><i class="fa fa-plus"></i>NEW OPENING STOCK</a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>


                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_stock_list" >

                                    <thead>
                                        <tr>                                            
                                            <th>Store</th>
                                            <th>Opening Date</th>                             
                                            <th>Items Modified</th>                           
                                            <th>Total Quantities Updated</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($store_data) && !empty($store_data) && is_array($store_data)) {
                                            foreach ($store_data as $store) {
//                                                                                                dev_export($item['item_id']);die;
                                                ?>
                                                <tr>                                                
                                                    <td> <?php echo $store['store_name']; ?></td>
                                                    <td> <?php echo date('d-m-Y', strtotime($store['date'])); ?></td>
                                                    <td> <?php  echo $store['TOTAL_ITEM']; ?> </td>
                                                    <td> <?php  echo $store['TOTAL_QTY_CHANGED']; ?> </td>
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


<script type="text/javascript">
    $('#tbl_stock_list').dataTable({

        columnDefs: [
            {"width": "10%", className: "capitalize", "targets": 0},
            {"width": "10%", className: "capitalize", "targets": 1},
            {"width": "10%", className: "capitalize", "targets": 2, },
            {"width": "10%", className: "capitalize", "targets": 3, },
//            {"width": "10%", className: "capitalize", "targets": 3},
//            {"width": "10%", className: "capitalize", "targets": 4},
//            {"width": "10%", className: "capitalize", "targets": 5},
//            {"width": "10%", className: "capitalize", "targets": 6}
//            {"width": "10%", className: "capitalize", "targets": 7},
//            {"width": "10%", className: "capitalize", "targets": 8}
        ],
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Report'}
        ],
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

    function add_stock() {
        var ops_url = baseurl + 'stock/opening-stock/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }

</script>


