<div class="ibox-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="well">

                    <img class="img-responsive" src="<?php echo base_url('assets/OnlineRegLogos/' . $inst_id . '_logo.png'); ?>" alt="logo" style="width:250px" />
                    <br />
                    <br />
                    <?php if (isset($otp)) {
                        echo "Hi,";
                        echo "<p>Welcome to Online Registration. 
                        One Time Password for verifying your email is " . $otp . "</p>";
                    } ?>
                </div>
                <p><i>Note : If you unsubscribe this mail,you won't be able to receive email from this domain.</i></p>
            </div>
        </div>
    </div>
</div>