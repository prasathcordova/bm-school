<div class="row " style="margin-right:0px; padding-left: 2px;  padding-top: 2px;">

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
                                <a style="margin-top : 5px"  href="javascript:void(0);" onclick="uniform_items_add('<?php echo $oh['id']; ?>', '<?php echo $oh['name']; ?>');"><span  title="Select <?php echo $oh['name']; ?>" class="label label-warning pull-right">Select <i class="fa fa-arrow-right"></i></span></a> 
                                <span class="label label-info" title="<?php echo isset($oh['total_qty']) ? $oh['total_qty'] . ' items added' : 'No items added' ?> ">Items Qty: <?php echo isset($oh['total_qty']) ? $oh['total_qty'] : 0 ?> </span>
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
