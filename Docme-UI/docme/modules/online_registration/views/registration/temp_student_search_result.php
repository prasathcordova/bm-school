<?php
if(isset($student_data) && is_array($student_data) && !empty($student_data)){
    foreach($student_data as $sdata) {
      ?>
    <div class="col-lg-3">
        <div class=" contact-box center-version">
            <div class="text-center p-h-sm">
                <h3 class="text-uppercase"><strong><?php echo $sdata['fname'] .' '. $sdata['mname']. ' '. $sdata['lname'];?></strong></h3>
            </div>
            <table class="table p-h-sm">
                <tr>
                    <td>Class</td>
                    <td class="text-left">: <b><?php echo isset($sdata['class']) && !empty($sdata['class']) ? $sdata['class'] : 'NIL' ;?></b></td>
                </tr>
                <tr>
                    <td>Temporary <br/> Admission No.</td>
                    <td class="text-left">: <b><?php echo $sdata['TempAdmn_No'];?></b></td>
                </tr>
                <tr>
                    <td>Application Date</td>
                    <td class="text-left">: <b><?php echo $sdata['ApplicationDate'];?></b></td>
                </tr>
            </table>
            <div class=" contact-box-footer">    
                <button class="btn btn-xs btn-info pull-left" title="TAKE TO PERMANENT" onclick="take_to_permanent('<?php echo $sdata['TempReg_ID'];?>')"><i style="font-size:15px;" class="material-icons">how_to_reg</i> TAKE TO PERMANENT</button>
                <div class="clearfix"></div>
                <button class="btn btn-xs btn-info pull-left" title="EDIT" onclick="get_student_data('<?php echo $sdata['TempReg_ID'];?>')"><i style="font-size:15px;" class="material-icons">edit</i> EDIT</button>
                <button class="btn btn-xs btn-danger pull-right" title="CANCEL" onclick="cancel_student_reg('<?php echo $sdata['TempReg_ID'];?>', '<?php echo $sdata['TempAdmn_No'];?>')"><i style="font-size:15px;" class="material-icons">close</i> CANCEL</button>
                <div class=" clearfix"></div>
            </div>
        </div>
    </div>
    <?php
    }
} else {
    ?>
    <div class="col-lg-12">
        <h3 class=" text-muted">No data available.</h3>
    </div>
    <?php
}
?>