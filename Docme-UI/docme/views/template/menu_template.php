<?php
if (isset($_SERVER['PATH_INFO'])) {
    $path_info = $_SERVER['PATH_INFO'];
} else {
    $path_info = '/';
}

$user_name = $this->session->userdata('user_name');
$user_image = $this->session->userdata('profile_image');
$designation = $this->session->userdata('designation');
$is_store_user = $this->session->userdata('is_store_user');
$inst_id = $this->session->userdata('inst_id');
?>


<ul class="nav metismenu" id="side-menu" style="font-size: 12px;">
    <li class="nav-header" style="padding-bottom: 18px;">
        <div class="dropdown profile-element">
            <span>

                <?php
                if (isset($_SERVER['PATH_INFO'])) {
                    $path_info = $_SERVER['PATH_INFO'];
                } else {
                    $path_info = '/';
                }
                $user_name = $this->session->userdata('user_name');
                $user_image = $this->session->userdata('profile_image');
                $designation = $this->session->userdata('designation');
                $is_store_user = $this->session->userdata('is_store_user');
                $inst_id = $this->session->userdata('inst_id');
                ?>

                <img alt="USER" class="img-circle" width="50px" src="<?php echo $user_image; ?>" />
            </span>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo isset($user_name) ? $user_name : "USER"; ?></strong>
                    </span> <span class="text-muted text-xs block"><?php echo isset($designation) ? $designation : "USER"; ?><b class="caret"></b></span> </span> </a>

            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li>

                </li>
                <!--<li><a href="javascript:void(0);" onclick="view_faculty('<?php echo $this->session->userdata('empid') ? $this->session->userdata('empid') : '45421451421254'; ?>');">Profile</a></li>-->
                <li><a href="<?php echo base_url('change-password'); ?>"> Change Password</a></li>
                <li><a href="javascript:void(0);" onclick="logout_confirm()"> Log out</a></li>
            </ul>
        </div>
        <div class="logo-element" style="padding-bottom: 0px;    padding-top: 5px;">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="image" title="<?php echo isset($user_name) ? $user_name : "USER"; ?>" class="img-circle" width="50px" src="<?php echo $user_image; ?>" />
            </a>
            <ul class="dropdown-menu ">
                <!--<li><a href="javascript:void(0);" style="    color: black !important;" onclick="view_faculty('<?php echo $this->session->userdata('empid') ? $this->session->userdata('empid') : '45421451421254'; ?>');">Profile</a></li>-->
                <li><a href="<?php echo base_url('change-password'); ?>" style="color:black !important;"> Change Password</a></li>
                <li><a href="javascript:void(0);" onclick="logout_confirm()" style="color:black !important;">Logout</a></li>
            </ul>
        </div>
    </li>
    <li>
        <?php
        $store_link_array = [
            '/substore/show-dashboard',
            '/uniform_dashboard/show-dashboard',
            '/uniform/substore/show-store',
            '/substore/show-bookstore'
        ];
        if (in_array($path_info, $store_link_array) && $is_store_user == 1) {
        ?>
            <a href="javascript:void(0);" style="padding: 10px 7px 0 7px;"><img class="img-circle" src="<?php echo base_url('assets/theme/img/report/3.jpg'); ?>" alt="STORE MANAGEMENT" style="width: 50%;border-radius: 0;margin-left:20%" /></a>
        <?php } else {
        ?>
            <a href="javascript:void(0);" style="padding: 10px 7px 0 7px;"><img class="" src="<?php echo base_url('assets/dashboard_logos/' . $inst_id . '_dashboard.png'); ?>" alt="Docme College" style="width:100%;" /></a>
        <?php }
        ?>

    </li>
    <?php
    $dashboard_menu_array = [
        '/dashboard/show-dashboard',
        '/substore/show-dashboard',
        '/uniform_dashboard/show-dashboard',
    ];
    if (in_array($path_info, $dashboard_menu_array)) {
        $class_dash = 'active';
    } else {
        $class_dash = '';
    }
    if (($is_store_user != 1)) { ?>
        <li class="<?php echo $class_dash ?>">
            <a href="<?php echo base_url('dashboard/show-dashboard'); ?>" title="Dashboard"><i class="fa fa-inbox"></i> <span class="nav-label">Dashboard</span> </a>
        </li>
    <?php } else { ?>
        <li class="<?php echo $class_dash ?>">
            <a href="<?php echo base_url('school/home'); ?>" title="Dashboard"><i class="fa fa-inbox"></i> <span class="nav-label">Dashboard</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(0, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/dashboard/show-dashboard' ? 'active' : '' ?>">
                        <a href="<?php echo base_url('dashboard/show-dashboard'); ?>" title="Dashboard"><i class="fa fa-leanpub"></i>School</a>
                    </li>
                <?php }
                ?>
                <?php if (check_permission(0, 0, 109)) {
                ?>
                    <li class="<?php echo $path_info == '/substore/show-dashboard' ? 'active' : '' ?>"><a href="<?php echo base_url('substore/show-dashboard'); ?>" title="Book Store"><i class="fa fa-leanpub" data-toggle="tooltip"></i>Book Store</a></li>
                <?php }
                ?>
                <li class="<?php echo $path_info == '/uniform_dashboard/show-dashboard' ? 'active' : '' ?>"><a href="<?php echo base_url('uniform_dashboard/show-dashboard'); ?>" title="Uniform Store"><i class="fa fa-leanpub" data-toggle="tooltip"></i>Uniform Store</a></li>
                <?php //} 
                ?>
            </ul>
        </li>
    <?php } ?>
    <?php
    if (check_permission(544, 0, 114) || check_permission(560, 0, 114)) {
    ?>
        <?php
        $admin_menu_array = [
            '/user/show-activity',
            '/settings/show-settings',
            //'/registration/show-settings'
        ];
        if (in_array($path_info, $admin_menu_array)) {
            $class_admin = 'active';
        } else {
            $class_admin = '';
        } ?>
        <li class="<?php echo $class_admin ?>">
            <a href="<?php echo base_url('dashboard'); ?>" title="Administration"><i class="fa fa-ge " data-toggle="tooltip"></i> <span class="nav-label">Administration</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(544, 0, 114)) { ?>
                    <li class="<?php echo $path_info == '/user/show-activity' ? 'active' : '' ?>"><a href="<?php echo base_url('user/show-activity'); ?>" title="User Management"><i class="fa fa-language " data-toggle="tooltip"></i> User Management</a></li>
                <?php }
                if (check_permission(560, 0, 114)) { ?>
                    <li class="<?php echo $path_info == '/settings/show-settings' ? 'active' : '' ?>"><a href="<?php echo base_url('settings/show-settings'); ?>" title="General Settings"><i class="fa fa-gear " data-toggle="tooltip"></i> General Settings</a></li>
                <?php }
                //if (check_permission(561, 0, 114)) { 
                ?>
                <!-- <li class="</?php echo $path_info == '/registration/show-settings' ? 'active' : '' ?>"><a href="<?php echo base_url('registration/show-settings'); ?>" title="Registration Settings"><i class="fa fa-list"></i> Registration Settings</a></li> -->
                <!-- </?php } ?> -->
            </ul>

        </li>
    <?php
    } ?>

    <?php
    if (check_permission(561, 0, 114) || check_permission(502, 0, 102)) {
    ?>

        <?php
        $admission_menu_array = [
            '/registration/show-settings',
            '/registration/temp-registration',
            '/online-registration/load-needed-documents',
            '/online-registration/verify-documents',
            '/registration/show-admission-settings'
        ];
        if (in_array($path_info, $admission_menu_array)) {
            $class_admission = 'active';
        } else {
            $class_admission = '';
        } ?>

        <li class="<?php echo $class_admission ?>">
            <a href="#" title="Admission Management"><i class="fa fa-list"></i> <span class="nav-label">Admission Management</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(561, 0, 114)) { ?>
                    <li class="<?php echo $path_info == '/registration/show-settings' ? 'active' : '' ?>"><a href="<?php echo base_url('registration/show-settings'); ?>" title="Registration Settings"><i class="fa fa-list"></i> Registration Settings</a></li>
                <?php } ?>
                <?php if (check_permission(502, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/registration/temp-registration' ? 'active' : '' ?>"><a href="<?php echo base_url('registration/temp-registration'); ?>" data-toggle="tooltip" title="Temporary Registration"><i class="fa fa-star-half-o"></i> Temporary Registration</a></li>
                <?php } ?>
                <?php if (check_permission(562, 0, 114)) { ?>
                    <li class="<?php echo $path_info == '/online-registration/verify-documents' ? 'active' : '' ?>"><a href="<?php echo base_url('online-registration/verify-documents'); ?>" title="Verify Documents"><i class="fa fa-language " data-toggle="tooltip"></i> Verify Documents</a></li>
                <?php }
                if (check_permission(563, 0, 114)) { ?>
                    <li class="<?php echo $path_info == '/registration/show-admission-settings' ? 'active' : '' ?>"><a href="<?php echo base_url('registration/show-admission-settings'); ?>" title="Admission Settings"><i class="fa fa-cog"></i> Admission Settings</a></li>
                <?php } ?>

            </ul>
        </li>
    <?php } ?>

    <?php
    if (check_permission(0, 0, 102)) {
        $student_management_menu_array = [
            '/registration/add-registration',
            //'/registration/temp-registration',
            '/profile/show-class-for-students',
            '/profile/show-siblings',
            '/profile/show-class-for-sponsered-stud',
            //'/longabsentee/show-class-for-students',
            //'/registration/show-promotion',
            //'/tcprep/show-class-for-students',
            '/report/show-reportdata',
        ];
        if (in_array($path_info, $student_management_menu_array)) {
            $class_std_mngt = 'active';
        } else {
            $class_std_mngt = '';
        } ?>
        <li class="<?php echo $class_std_mngt ?>">
            <a href=" #" data-toggle="tooltip" title="Registration Management"><i class="fa fa-id-badge"></i> <span class="nav-label">Registration Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(501, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/registration/add-registration' ? 'active' : '' ?>"><a href="<?php echo base_url('registration/add-registration'); ?>" data-toggle="tooltip" title="Registration"><i class="fa fa-user-plus"></i> Registration</a></li>
                <?php } ?>
                <?php if (check_permission(503, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/profile/show-class-for-students' ? 'active' : '' ?>"><a href="<?php echo base_url('profile/show-class-for-students'); ?>" data-toggle="tooltip" title="Student Profile"><i class="fa fa-drivers-license-o"></i> Student Profile</a></li>
                <?php } ?>
                <?php if (check_permission(504, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/profile/show-siblings' ? 'active' : '' ?>"><a href="<?php echo base_url('profile/show-siblings'); ?>" data-toggle="tooltip" title="Family Members"><i class="fa fa-users"></i>Family Members</a></li>
                <?php } ?>
                <?php if (check_permission(0, 0, 102)) { ?>
                    <!--li class="<?php echo $path_info == '/profile/show-class-for-sponsered-stud' ? 'active' : '' ?>"><a href="<?php echo base_url('profile/show-class-for-sponsered-stud'); ?>" title="Sponsored Students"><i class="fa fa-dollar"></i> Sponsored Students</a></li-->
                <?php } ?>
                <!-- </?php if (check_permission(505, 0, 102)) { ?>
                    <li class="</?php echo $path_info == '/longabsentee/show-class-for-students' ? 'active' : '' ?>"><a href="<?php echo base_url('longabsentee/show-class-for-students'); ?>" data-toggle="tooltip" title="Long Absentee"><i class="fa fa-tablet"></i>&nbsp;&nbsp;Long Absentee</a></li>
                </?php } ?> -->
                <!-- </?php if (check_permission(506, 0, 102)) { ?>
                    <li class="</?php echo $path_info == '/registration/show-promotion' ? 'active' : '' ?>"><a href="<?php echo base_url('registration/show-promotion'); ?>" data-toggle="tooltip" title="Promotion/Detaining"><i class="fa fa-tencent-weibo"></i> &nbsp;Promotion/Detaining</a></li>
                </?php } ?> -->
                <!-- </?php if (check_permission(507, 0, 102)) { ?>
                    <li class="</?php echo $path_info == '/tcprep/show-class-for-students' ? 'active' : '' ?>"><a href="<?php echo base_url('tcprep/show-class-for-students'); ?>" data-toggle="tooltip" title="TC"><i class="fa fa-chain-broken"></i> TC</a></li>
                </?php } ?> -->
                <?php if (check_permission(508, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/report/show-reportdata' ? 'active' : '' ?>"><a href="<?php echo base_url('report/show-reportdata'); ?>" data-toggle="tooltip" title="Reports"><i class="fa fa-leaf"></i> Reports</a></li>
                <?php } ?>
            </ul>
        </li>
    <?php }
    ?>
    <?php
    if (check_permission(0, 0, 102)) {
        $promotion_management_menu_array = [
            '/registration/show-promotion',
            '/report/show-promotion-reportdata',
        ];
        if (in_array($path_info, $promotion_management_menu_array)) {
            $class_promotion_mngt = 'active';
        } else {
            $class_promotion_mngt = '';
        }
    ?>
        <li class="<?php echo $class_promotion_mngt ?>">
            <a href="javascript:void(0);" data-toggle="tooltip" title="Promotion Management" data-toggle="tooltip" title="Promotion Management"><i class="fa fa-tencent-weibo"></i> <span class="nav-label">Promotion Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(506, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/registration/show-promotion' ? 'active' : '' ?>"><a href="<?php echo base_url('registration/show-promotion'); ?>" data-toggle="tooltip" title="Promotion/Detaining"><i class="fa fa-tencent-weibo"></i> &nbsp;Promotion/Detaining</a></li>
                <?php } ?>
                <?php if (check_permission(508, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/report/show-promotion-reportdata' ? 'active' : '' ?>"><a href="<?php echo base_url('report/show-promotion-reportdata'); ?>" data-toggle="tooltip" title="Reports"><i class="fa fa-leaf"></i> Reports</a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php
    if (check_permission(0, 0, 102)) {
        $tcmanagement_menu_array = [
            '/tcprep/show-class-for-students',
            '/report/show-tc-reportdata',
            '/longabsentee/show-class-for-students'
        ];
        if (in_array($path_info, $tcmanagement_menu_array)) {
            $class_tc_mngt = 'active';
        } else {
            $class_tc_mngt = '';
        }
    ?>
        <li class="<?php echo $class_tc_mngt ?>">
            <a href="javascript:void(0);" data-toggle="tooltip" title="TC Management" data-toggle="tooltip" title="TC Management"><i class="fa fa-chain-broken"></i> <span class="nav-label">TC Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(507, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/tcprep/show-class-for-students' ? 'active' : '' ?>"><a href="<?php echo base_url('tcprep/show-class-for-students'); ?>" data-toggle="tooltip" title="TC"><i class="fa fa-chain-broken"></i> TC</a></li>
                <?php } ?>
                <?php if (check_permission(505, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/longabsentee/show-class-for-students' ? 'active' : '' ?>"><a href="<?php echo base_url('longabsentee/show-class-for-students'); ?>" data-toggle="tooltip" title="Long Absentee"><i class="fa fa-tablet"></i>&nbsp;&nbsp;Long Absentee</a></li>
                <?php } ?>
                <?php if (check_permission(508, 0, 102)) { ?>
                    <li class="<?php echo $path_info == '/report/show-tc-reportdata' ? 'active' : '' ?>"><a href="<?php echo base_url('report/show-tc-reportdata'); ?>" data-toggle="tooltip" title="Reports"><i class="fa fa-leaf"></i> Reports</a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php
    if (check_permission(0, 0, 101)) { ?>
        <li class="<?php echo $path_info == '/course/show-course' ? 'active' : '' ?>">
            <a href="javascript:void(0);" data-toggle="tooltip" title="Course Management" data-toggle="tooltip" title="Course Management"><i class="fa fa-globe"></i> <span class="nav-label">Course Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(517, 0, 101)) { ?>
                    <li class="<?php echo $path_info == '/course/show-course' ? 'active' : '' ?>"><a href="<?php echo base_url('course/show-course'); ?>" data-toggle="tooltip" title="Course Settings"><i class="fa fa-lemon-o"></i> Course Settings</a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
    <?php
    if (check_permission(0, 0, 112)) {

        $fee_management_menu_array = [
            '/fees/fee-management',
            '/fees/show-reports-data',
        ];
        if (in_array($path_info, $fee_management_menu_array)) {
            $class_fee_mngt = 'active';
        } else {
            $class_fee_mngt = '';
        } ?>
        <li class="<?php echo $class_fee_mngt ?>">
            <a href=" #" data-toggle="tooltip" title="Fee Management"><i class="fa fa-address-card"></i> <span class="nav-label">Fee Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(519, 0, 112)) { ?>
                    <li class="<?php echo $path_info == '/fees/fee-management' ? 'active' : '' ?>"><a href="<?php echo base_url('fees/fee-management'); ?>" data-toggle="tooltip" title="Fees Management"><i class="fa fa-user-plus"></i>Fees Management</a></li>
                <?php }
                if (check_permission(520, 0, 112)) { ?>
                    <li class="<?php echo $path_info == '/fees/show-reports-data' ? 'active' : '' ?>"><a href="<?php echo base_url('fees/show-reports-data'); ?>" data-toggle="tooltip" title="Reports"><i class="fa fa-leaf"></i> Reports</a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
    <?php if (check_permission(0, 0, 109) && ($is_store_user == 1)) {
        //if (($is_store_user == 1)) {

    ?>
        <?php
        $bookstore_menu_array = [
            '/substore/show-bookstore',
        ];
        if (in_array($path_info, $bookstore_menu_array)) {
            $class_bookstore = 'active';
        } else {
            $class_bookstore = '';
        } ?>
        <li class="<?php echo $class_bookstore ?>">
            <a href="javascript:void(0);" title="Book Store Sub"><i class="fa fa-pagelines" data-toggle="tooltip"></i> <span class="nav-label">Book Store-Sub</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li class="<?php echo $path_info == '/substore/show-bookstore' ? 'active' : '' ?>"><a href="<?php echo base_url('substore/show-bookstore'); ?>" title="Store Management"><i class="fa fa-leanpub" data-toggle="tooltip"></i>Store Management</a></li>
            </ul>
        </li>
    <?php
    }
    if (check_permission(0, 0, 111) && ($is_store_user == 1)) {
    ?>
        <?php
        $uniformstore_menu_array = [
            '/uniform/substore/show-store',
        ];
        if (in_array($path_info, $uniformstore_menu_array)) {
            $class_ufstore = 'active';
        } else {
            $class_ufstore = '';
        } ?>
        <li class="<?php echo $class_ufstore ?>">
            <a href="javascript:void(0);" title="Uniform Store-Sub"><i class="fa fa-shirtsinbulk"></i> <span class="nav-label">Uniform Store-Sub</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li class="<?php echo $path_info == '/uniform/substore/show-store' ? 'active' : '' ?>"><a href="<?php echo base_url('uniform/substore/show-store'); ?>" title="Uniform Store Management"><i class="fa fa-leanpub"></i>Uniform Store Management</a></li>

            </ul>
        </li>
    <?php
    }
    ?>
    <?php if (check_permission(0, 0, 115)) {
        //if (($is_store_user != 1)) { 
    ?>
        <?php

        $transport_menu_array = [
            '/transport/load-transport',
            '/report/show-transportreportdata'
        ];
        if (in_array($path_info, $transport_menu_array)) {
            $class_transport = 'active';
        } else {
            $class_transport = '';
        } ?>
        <li class="<?php echo $class_transport ?>">

            <a href="#" title="Transport Management"><i class="fa fa-id-badge"></i> <span class="nav-label">Transport Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(558, 0, 115)) { ?>
                    <li class="<?php echo $path_info == '/transport/load-transport' ? 'active' : '' ?>"><a href="<?php echo base_url('transport/load-transport'); ?>" title="Transport Settings"><i class="fa fa-user-plus"></i>Transport Settings</a></li>
                <?php }
                if (check_permission(559, 0, 115)) { ?>
                    <li class="<?php echo $path_info == '/report/show-transportreportdata' ? 'active' : '' ?>"><a href="<?php echo base_url('report/show-transportreportdata'); ?>" title="Reports"><i class="fa fa-leaf"></i> Reports</a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php
    if (check_permission(564, 0, 116)) {
        $notification_management_menu_array = [
            '/notification/show-notification-settings',
            '/report/show-notification-reportdata',
        ];
        if (in_array($path_info, $notification_management_menu_array)) {
            $class_notification_mngt = 'active';
        } else {
            $class_notification_mngt = '';
        }
    ?>
        <li class="<?php echo $class_notification_mngt ?>">
            <a href="javascript:void(0);" data-toggle="tooltip" title="Notification Management" data-toggle="tooltip" title="Notification Management"><i class="fa fa-bullhorn"></i> <span class="nav-label">Notification
                    Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <?php if (check_permission(564, 0, 116)) { ?>
                    <li class="<?php echo $path_info == '/notification/show-notification-settings' ? 'active' : '' ?>"><a href="<?php echo base_url('notification/show-notification-settings'); ?>" data-toggle="tooltip" title="Notification Settings"><i class="fa fa-wrench"></i> &nbsp;Notification Settings</a>
                    </li>
                <?php } ?>
                <!-- <?php /*if (check_permission(508, 0, 102)) { ?>
            <li class="<?php echo $path_info == '/report/show-promotion-reportdata' ? 'active' : '' ?>"><a
                    href="<?php echo base_url('report/show-promotion-reportdata'); ?>" data-toggle="tooltip"
                    title="Reports"><i class="fa fa-leaf"></i> Reports</a></li>
            <?php }*/ ?> -->
            </ul>
        </li>
    <?php } ?>

</ul>
<script>
    jQuery(function($) {
        $('#side-menu').slimScroll({
            height: '575px',
            railOpacity: 0.6,
            railWidth: '1px',
        });
        Number.prototype.toFixed = function(precision) {
            var power = Math.pow(10, precision || 0);
            return String(Math.round(this * power) / power);
        }

        $('.file-manager>.category-list>li').on("click", function(event) {
            $('.file-manager>.category-list>li').removeClass('settings-active');
            $(this).addClass('settings-active');
        });

        // $(document).on("click", function(event) {
        //     var $trigger = $(".right-sidebar-toggle");
        //     if ($trigger !== event.target && !$trigger.has(event.target).length) {
        //         //  //          $("#right-sidebar").slideUp("fast");
        //         //                $('#right-sidebar').removeClass('sidebar-open');
        //     }
        // });
    });
</script>
<!-- Matomo -->
<script type="text/javascript">
    var _paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u = "//analytics.educore.guru/";
        _paq.push(['setTrackerUrl', u + 'matomo.php']);
        _paq.push(['setSiteId', <?php echo MATOMO_SITE_ID ?>]);
        var d = document,
            g = d.createElement('script'),
            s = d.getElementsByTagName('script')[0];
        g.type = 'text/javascript';
        g.async = true;
        g.defer = true;
        g.src = u + 'matomo.js';
        s.parentNode.insertBefore(g, s);
    })();
    _paq.push(['setCustomVariable', 1, "School ID", '<?php echo $_SESSION['Institution_Name'] ?>', "visit"]);
    // _paq.push(['setCustomVariable', 2, "Role IDs", result.role_ids, "visit"]);
    // _paq.push(['setCustomVariable', 3, "Login Username ", result.quick_login_id, "visit"]);
    // _paq.push(['setCustomVariable', 4, "Admn No/Emp No ", empOrAdmnNo, "visit"]);
    // _paq.push(['setCustomVariable', 5, "User Details", userBatchDetails, "visit"]);
    _paq.push(['setUserId', '<?php echo $_SESSION['emailid'] ?>']);
    _paq.push(['trackPageView']);
</script>
<!-- End Matomo Code -->
<style>
    .sidebar-container ul.nav-tabs {
        background: #f9f9f9;
    }

    .settings-active {
        background: #f8f8f9;
        color: #5b5d5f;
        font-weight: bold;
    }

    h5,
    h2 {
        color: #1c84c6;
    }

    input[type="text"]::placeholder {

        /* Firefox, Chrome, Opera */
        text-align: left;
    }
</style>