<!-----------------------------------------------------------------+ 
    "#sidebar_left" Helper Classes: 
-------------------------------------------------------------------+ 
    * Positioning Classes: 
    '.affix' - Sets Sidebar Left to the fixed position 
    * Available Skin Classes:
        .sidebar-dark (default no class needed)
        .sidebar-light  
        .sidebar-light.light   
-------------------------------------------------------------------+
    Example: <aside id="sidebar_left" class="affix sidebar-light">
    Results: Fixed Left Sidebar with light/white background
------------------------------------------------------------------->
<!-- Start: Sidebar Left -->
<?php
$master = $this->uri->segment(1);
$sub = $this->uri->segment(2);
?>
<aside id="sidebar_left" class="nano nano-primary affix">
    <!-- Start: Sidebar Left Content -->
    <div class="sidebar-left-content nano-content">
        <!-- Start: Sidebar Left Menu -->
        <ul class="nav sidebar-menu">
            <li class="sidebar-label pt20">Menu</li>
            <?php if (check_role_assigned('dashboard', 'view')) { ?>
                <li <?php if ($master == "" || $master == "Dashboard") echo 'class="active"'; ?>>
                    <a href="<?= base_url('Dashboard') ?>">
                        <span class="glyphicon glyphicon-home"></span>
                        <span class="sidebar-title">Dashboard</span>
                    </a>
                </li>
            <?php } 
            if (check_role_assigned('order', 'view')) { ?>
                <li <?php if ($master == "Order") echo 'class="active"'; ?>>
                    <!-- <a href="#"> -->
                    <a href="<?= base_url('HostelUsers') ?>">
                        <span class="fa fa-users"></span>
                        <span class="sidebar-title"> Hostel Users</span>
                    </a>
                </li>
            <?php } 
            if (check_role_assigned('order', 'view')) { ?>
                <li <?php if ($master == "Order") echo 'class="active"'; ?>>
                    <!-- <a href="#"> -->
                    <a href="<?= base_url('GatePass') ?>">
                        <span class="fa fa-users"></span>
                        <span class="sidebar-title"> Gate Pass</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>