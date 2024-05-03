<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="text"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> - <?php echo $storename ?></h5>
                    <input type="hidden" id="storeid" value="<?php echo $storeid ?>">
                    <div class="ibox-tools" id="add_type">

                        <span><a href="javascript:void(0);" onclick="submit_data('<?php echo $storeid; ?>');"> <i style="font-size: 35px !important;  float: right;color: #23C6C5;" class="material-icons">save</i></a> </span>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>


                        <?php
                        //                        echo form_open('rate/update-rates', array('id' => 'rate_update', 'role' => 'form'));
                        ?>

                        <?php // echo form_close(); 
                        ?>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_rates">

                                    <thead>
                                        <tr>
                                            <th>Item Name </th>
                                            <th>Item Code </th>
                                            <th>Item Edition Name </th>
                                            <th> Old Rate</th>
                                            <th>New Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="storeid" id="storeid" value="<?php echo $storeid ?>">
                                        <?php
                                        if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
                                            foreach ($item_data as $item) {
                                                //                                                                                                dev_export($item['item_id']);die;
                                        ?>
                                                <tr>
                                                    <td> <?php echo $item['item_name']; ?></td>
                                                    <td> <?php echo $item['item_code']; ?></td>
                                                    <td> <?php echo $item['edition_name']; ?></td>
                                                    <td>

                                                        <?php
                                                        if ($item['rate'] != NULL) {
                                                            echo $item['rate'];
                                                        } else {
                                                            echo $item['selling_price'];
                                                        }
                                                        ?>
                                                    </td>


                                                    <td>
                                                        <input type="text" class="form-control rollno" name="new_rate" data-id="<?php echo $item['itemsid']; ?>" id="" value=""></input>
                                                        <!--<input type="text" class="form-control text-uppercase"  name="new_rate" id="new_rate" value="<?php // echo set_value('item_name', isset($item_name) ? $item_name : '');    
                                                                                                                                                            ?>" />-->
                                                    </td>
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
    $('#tbl_rates').dataTable({
        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 4
            }
        ],
        responsive: true,
    });


    function submit_data(storeid) {
        //var storeid = $("#storeid").val();
        //        var storeid = $(storeid).val();
        //        alert(storeid);
        var ratedata = [];
        var flag = 0;
        var flag2 = 0;
        //        var intRegex = /^\d+$/;
        var intRegex = /^(?!0\d)\d*(\.\d+)?$/mg;
        var flag3 = 0;
        var table = $('#tbl_rates').dataTable();
        table.$('input').each(function() {
            var id = $(this).val();
            if (id != '') {
                if (!(Math.floor(id) == id && $.isNumeric(id))) {
                    //                if (!(Math.floor(id) == id && $.isFloat(id))) {
                    flag = 1;
                }
                var itemrate = $(this).val();
                // console.log(itemrate)
                var item_id = $(this).attr('data-id');
                if (itemrate > 0) {
                    ratedata.push({
                        item_id: item_id,
                        selling_price: itemrate
                    });
                } else {
                    flag2 = 1;
                }
                //                if (!intRegex.test(itemrate)) {
                //                    flag3 = 1;
                //                }

            }

        });
        //        console.log(JSON.stringify(ratedata))
        var formatted_ratedata = JSON.stringify(ratedata)
        //        var myUnquotedJson = formatted_ratedata.replace(/"/, []);
        //        alert(myUnquotedJson);
        if (flag == 1) {
            swal('', 'Enter valid Rate.', 'info');
            return false;
        }
        //        if (flag3 == 1) {
        //            swal('', 'Error in Rate : Rate  must be float', 'info');
        //            return false;
        //        }
        if (flag2 == 1) {
            swal('', 'Error in Rate : Rate  must be greater than 0', 'info');
            return false;
        }
        //        if (item_rate.length == 0) {
        //            swal('', 'Item Rate is required.', 'info');
        //            return false;
        //        }
        var ops_url = baseurl + 'rate/update-rates/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "ratesetdata": formatted_ratedata,
                "storeid": storeid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal({
                        title: 'Success',
                        text: 'Rate added successfully',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }, function(isConfirm) {
                        load_rate();
                    })
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                } else if (data.status == 3) {
                    swal('', data.message, 'info');
                } else {
                    swal('Error', 'Transport Error', 'error');
                }
            }
        });

    }


    $(".select2_demo_1").select2({
        "theme": "bootstrap",
        width: "100%",
        placeholder: "Select a store"
    });
</script>