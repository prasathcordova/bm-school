<div class="row" style="margin-right:0px; padding-left: 2px;  padding-top: 2px;">
    <?php
    if (isset($template_data) && !empty($template_data) && is_array($template_data)) {
        foreach ($template_data as $template) {
            ?>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div id="iboxtitle_oh" class="ibox-title iboxtitle_oh" style="border-bottom-color:#23c6c8; height: 46px !important">
                        <b title="<?php echo $template['template_name']; ?>"><?php echo substr($template['template_name'], 0, 20); ?> </b>
                    </div>
                    <div class="ibox-content">
                        <li style="list-style: none;" class="warning-element ui-sortable-handle" id="task5">
                            <div class=" scroll_content_1" title="<?php echo $template['template_desc']; ?>">
                                <small> <?php echo $template['template_desc']; ?></small>
                            </div>
                            <div class="agile-detail" style="padding-top: 4px !important; text-align: center;">
                                <?php
                                        //                                                        if (check_permission(539, 1016, 0)) {
                                        ?>
                                <a style="margin-top : 5px" href="javascript:void(0);" onclick="detach_student_list('<?php echo $template['id']; ?>', '<?php echo $template['template_name']; ?>');" title="Select <?php echo $template['template_name']; ?>" class="btn btn-info btn-block">Deallocate Students <i class="fa fa-arrow-right"></i></a>
                                <!--<a href="javascript:void(0)" onclick="view_fee_code_with_template('<?php echo $template['id']; ?>','<?php echo $template['template_name']; ?>')" class="btn btn-warning btn-sm" title="View Fee codes attached with <?php echo $template['template_name']; ?>"><i style="font-size:12px;padding-right: 5px;" class="fa fa-eye"></i>  View Fee Code </a>-->
                                <?php
                                        //                                                        }
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