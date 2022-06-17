<!-----------------------------------------------------------------+ 
".navbar" Helper Classes: 
-------------------------------------------------------------------+ 
* Positioning Classes: 
'.navbar-static-top' - Static top positioned navbar
'.navbar-static-top' - Fixed top positioned navbar

* Available Skin Classes:
    .bg-dark    .bg-primary   .bg-success   
    .bg-info    .bg-warning   .bg-danger
    .bg-alert   .bg-system 
-------------------------------------------------------------------+
Example: <header class="navbar navbar-fixed-top bg-primary">
Results: Fixed top navbar with blue background 
------------------------------------------------------------------->
<?php
$username = "";
$image = "";
if ($this->session->userdata['logged_in']['user_fullname'] != "") {
    $username = $this->session->userdata['logged_in']['user_fullname'];
}
if ($this->session->userdata['logged_in']['user_image'] != "") {
    $image = base_url() . $this->session->userdata['logged_in']['user_image'];
}

?>
<header class="navbar navbar-fixed-top bg-system">
    <div class="navbar-branding dark bg-system">
        <a class="navbar-brand" href='<?= base_url('Dashboard') ?>'>
            <b>RKU Hostel</b>
        </a>
        <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
    </div>
    <ul class="nav navbar-nav navbar-left">
        <li class="hidden-xs">
            <a class="request-fullscreen toggle-active" href="#">
                <span class="ad ad-screen-full fs18"></span>
            </a>
        </li>
    </ul>
    <!-- <form class="navbar-form navbar-left navbar-search" role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search..." value="Search...">
        </div>
    </form> -->
    <ul class="nav navbar-nav navbar-right">
        <!--
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="fa fa-gear fa-2x"></span>
            </a>

            <ul class="dropdown-menu pv5 animated animated-short flipInX" role="menu">
                <li class="dropdown-header">
                    <span class="dropdown-title">Frequent Settings</span>
                </li>
                <?php if (check_role_assigned('item_category', 'view')) { ?>
                    <li>
                        <a href="<?= base_url('Settings/ItemCategory') ?>">
                            <span class="fa fa-th-large  mr10"></span> Item Category
                        </a>
                    </li>
                <?php }
                if (check_role_assigned('item_sub_category', 'view')) { ?>
                    <li>
                        <a href="<?= base_url('Settings/ItemSubCategory') ?>">
                            <span class="fa fa-th-large  mr10"></span> Sub Category
                        </a>
                    </li>
                <?php }
                if (check_role_assigned('item_parameters', 'view')) { ?>
                    <li>
                        <a href="<?= base_url('Settings/ItemParameters') ?>">
                            <span class="fa fa-list-alt  mr10"></span> Item Parameters
                        </a>
                    </li>
                <?php }
                if (check_role_assigned('customer', 'view')) { ?>
                    <li>
                        <a href="<?= base_url('Settings/CustomerManagement') ?>">
                            <span class="fa fa-users  mr10"></span> Customer Management
                        </a>
                    </li>
                <?php }
                if (check_role_assigned('supplier', 'view')) { ?>
                    <li>
                        <a href="<?= base_url('Settings/SupplierManagement') ?>">
                            <span class="fa fa-users  mr10"></span> Supplier Management
                        </a>
                    </li>
                <?php }
                if (check_role_assigned('jobworker', 'view')) { ?>
                    <li>
                        <a href="<?= base_url('Settings/JobWorkerMaster') ?>">
                            <span class="fa fa-industry mr10"></span> Job Worker Master
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
                -->
        <li class="menu-divider hidden-xs">
            <i class="fa fa-circle"></i>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown">
                <img src="<?= $image ?>" alt="avatar" class="mw30 br64 mr15"><?php echo $username; ?>
                <span class="caret caret-tp hidden-xs"></span>
            </a>
            <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
                <li class="list-group-item">
                    <a href="<?= base_url('Profile') ?>" class="animated animated-short fadeInUp">
                        <span class="fa fa-user"></span> Profile
                    </a>
                </li>
                <!--
                <?php if (check_role_assigned('company_master', 'view')) { ?>
                    <li class="list-group-item">
                        <a href="<?= base_url('Settings/CompanyManagement/add/' . $this->session->userdata['financial_year']['companyid']) ?>" class="animated animated-short fadeInUp">
                            <span class="fa fa-industry"></span>Company Profile
                        </a>
                    </li>
                <?php }
                if (check_role_assigned('financial_year', 'view')) { ?>
                    <li class="list-group-item">
                        <a href="<?= base_url('Settings/FinancialYear') ?>" class="animated animated-short fadeInUp">
                            <span class="fa fa-gear"></span> Settings
                        </a>
                    </li>
                <?php } ?>
                -->
                <li class="dropdown-footer">
                    <a href="<?= base_url('Auth/logout') ?>" class="">
                        <span class="fa fa-power-off pr5"></span> Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</header>