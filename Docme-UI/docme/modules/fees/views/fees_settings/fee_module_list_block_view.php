<style>
    .roundicon {
        height: 150px;
        width: 150px;
        border-radius: 50%;
        padding-top: 10%;
    }

    .roundicon span b {
        font-size: 2rem;
        padding-top: 5px;
    }

    .cornerround {
        width: 170px;
        height: 170px;
        position: absolute;
        text-align: center;
        border-radius: 50%;
        background: #fff;
        border: 1px solid #00b1ac;
        z-index: 2222;
    }

    .cornerround:after {
        content: '';
        position: absolute;
        top: -3px;
        right: 6px;
        border: 6px solid #00b1ac;
        border-left: 0;
        border-bottom-right-radius: 100px;
        border-top-right-radius: 100px;
        width: 86px;
        height: calc(100% + 2px);
        transform: rotate(340deg) translate(15px, -15px);
        -ms-transform: rotate(340deg) translate(15px, -15px);
        -moz-transform: rotate(340deg) translate(15px, -15px);
        -webkit-transform: rotate(340deg) translate(15px, -15px);
        -o-transform: rotate(340deg) translate(15px, -15px);
    }

    .pad-bot-10 {
        padding-bottom: 10px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row" id="data-view-feecode">
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row">
                                <?php if (check_permission(519, 1153, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="counter_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_counter_collection();">
                                                <div class="bg-warning roundicon">
                                                    <span><i class="fa fa-cog fa-3x pad-bot-10"></i><br><b>Counter <br>Collection</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php } ?>
                                <?php if (check_permission(519, 1146, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="collection_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_fee_student();">
                                                <div class="bg-primary roundicon">
                                                    <span><i class="fa fa-credit-card fa-3x pad-bot-10"></i><br><b>Fee <br>Collection</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php } ?>
                                <?php if (check_permission(519, 1154, 112)) {?>
                                    <div class="col-lg-3 pad-bot-10" id="account_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_student_account();">
                                                <div class="bg-success roundicon" style="background-color:#963596!important;">
                                                    <span><i class="fa fa-user-circle fa-3x pad-bot-10"></i><br><b>Student <br>Account</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php } ?>
                                <?php if (check_permission(519, 1148, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="wallet_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_wallet_student();">
                                                <div class="bg-danger roundicon">
                                                    <span><i class="fa fa-address-book  fa-3x pad-bot-10"></i><br><b>Docme <br>Wallet</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php }?>

                                <!--/div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row"-->
                                <?php if (check_permission(519, 1151, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="recon_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_cheque_reconciliation();">
                                                <div class="bg-info roundicon" style="background-color : #795548!important"> 
                                                    <span><i class="fa fa-dashcube fa-3x pad-bot-10"></i><br><b>Cheque <br>Reconciliation</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php } ?>
                                <?php if (check_permission(519, 1152, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="blacklist_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_blacklist_student();">
                                                <div class="bg-danger roundicon" style="background-color :green!important">
                                                    <span><i class="fa fa-circle-o-notch fa-3x pad-bot-10"></i><br><b>Blacklist <br>Release</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php } ?>
                                <?php if (check_permission(519, 1149, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="voucher_cancel_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_student_voucher_cancellation();">
                                                <div class="bg-warning roundicon">
                                                    <span><i class="fa fa-file fa-3x pad-bot-10"></i><br><b>Voucher <br>Cancellation</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php } ?>
                                <?php if (check_permission(519, 1143, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="allotment_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_fee_student_allotment_list();">
                                                <div class="bg-success roundicon" style="background-color:#00aeef!important;">
                                                    <span><i class="fa fa-xing fa-3x pad-bot-10"></i><br><b>Student <br>Allocation <br>List</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php } ?>
                                <!--/div>
                            </div>
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="row"-->
                                <?php if (check_permission(519, 1142, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="dmd_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_fee_student_allotment_student_wise();">
                                                <div class="bg-danger roundicon">
                                                    <span><i class="fa fa-address-book  fa-3x pad-bot-10"></i><br><b>Template <br>Student <br>Assignment</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php } ?>
                                <?php  if (check_permission(519, 1145, 112)){?>
                                    <div class="col-lg-3 pad-bot-10" id="ndmd_button" >
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_fee_nondemand();">
                                                <div class="bg-success roundicon">
                                                    <span><i class="fa fa-cogs fa-3x pad-bot-10"></i><br><b>Other <br>Fee <br>Allocation</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                <?php }?>
                                    <!-- <div class="col-lg-3" id="_button">
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_fee_adjustment_one_time();">
                                                <div class="bg-primary roundicon" style="background-color:#00a63f!important;">
                                                    <span><i class="fa fa-home fa-3x pad-bot-10"></i><br><b>Fee Adjustment One Time</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div> -->
                                 <?php if (check_permission(519, 1155, 112)) {?>
                                    <div class="col-lg-3 pad-bot-10" id="payback_button" >
                                        <center><a class="sidemenulink" href="javascript:void(0);" onclick="load_student_payback();">
                                                <div class="bg-info roundicon" style="background-color:#e059aa!important;">
                                                    <!-- Change by Salahudheen May 29, 2019 font class Changed -->
                                                    <span><i class="fa fa-external-link-square fa-3x pad-bot-10"></i><br><b>Payback <br>Management</b></span>
                                                </div>
                                            </a>
                                        </center>
                                    </div>
                                 <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .roundicon {
        height: 180px;
        width: 180px;
    }
</style>