<?php $inst_id_base64 = base64_encode($this->session->userdata('inst_id')); ?>
<input type="hidden" name="inst_id_val" id="inst_id_val" value="<?php echo 'c2Nob29sX2lk=' . base64_encode($this->session->userdata('inst_id')); ?>" />
<div class="alert alert-success" style="margin-top: 25px;">
    <p>Dear Parent,</p>
    <p>Thank you for using our online application form.</p>
    <p>Details of your ward's registration shall be E-mailed to you shortly.</p>
    <p>Please quote the Temporary Admission Number at the time of registration.</p>
    <br />
    <br />
    <p><button type="button" class="btn btn-primary" onclick="return_home('<?php echo $inst_id_base64; ?>')">Return Home</button></p>
</div>

<script>
    function return_home(inst_id) {
        var inst_id_val = 'c2Nob29sX2lk=' + inst_id;
        window.location.href = baseurl + "online-registration?" + inst_id_val;
    }
</script>