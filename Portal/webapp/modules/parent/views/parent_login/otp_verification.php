<div class="row">

    <div class="col-md-12">
        <?php
        echo form_open('login', array('class' => 'form-horizontal', 'id' => 'login_user_otp', 'role' => 'form'));
        ?>

        <div class="form-group">
            <?php if (ENVIRONMENT == 'development') {
                echo $sms . '<br/>';
            ?>
                <input type="text" class="form-control" placeholder="Enter OTP" id="otp" name="otp" required="" value="<?php echo $otp ?>">
            <?php } else {
            ?>
                <input type="text" class="form-control" placeholder="Enter OTP" id="otp" name="otp" required="" value="">
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-info block full-width m-b" onclick="initiate_OTP_login();">Verify & Login</button>
        <?php
        echo form_close();
        ?>
    </div>

    <hr />

</div>