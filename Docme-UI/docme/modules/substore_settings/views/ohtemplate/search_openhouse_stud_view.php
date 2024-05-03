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

                            <table class="table" >
                                <thead >
                                    <tr style="">
                                        <td colspan="2">
                                            <p><span class="">From &nbsp; <b><?php echo date('d/m/Y', strtotime($master['oh_data']['start_date'])) ?></b> &nbsp; To  &nbsp;<b><?php echo date('d/m/Y', strtotime($master['oh_data']['end_date'])) ?></b> &nbsp;</span></p>
                                            <p><span class="">Kit per student : <B> <?php echo $master['oh_data']['kit_per_student']; ?></b></span></p>
                                        </td>
                                    </tr>


                                </thead>
                                <?php
                                foreach ($master['template_data'] as $template) {
                                    ?>

                                    <tbody>
                                        <tr>
                                            <td><?php echo $template['name'] ?>  </td>
                                            <td><a href="javascript:void(0);" onclick="list_student_assigned('<?php echo $master['oh_data']['id']; ?>', '<?php echo $template['template_id']; ?>');"><span class="label label-warning pull-right">List <i class="fa fa-arrow-right"></i></span></a> </td>
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

<style>
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
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
    $('.scroll_content').slimscroll({
        height: '250px',
        color: '#f8ac59'

    })

</script>
