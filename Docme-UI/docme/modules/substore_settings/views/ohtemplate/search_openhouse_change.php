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