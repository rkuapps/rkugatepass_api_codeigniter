<?php
$tab1active = 'active';
if (isset($errordata['activetab'])) {
    $tab1active = "";
    $tab2active = 'active';
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    ?>
</head>

<body class="ecommerce-page">

    <!-- Start: Main -->
    <div id="main">

        <?php
        $this->load->view('Includes/hadernav');
        $this->load->view('Includes/sidebar');
        ?>
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

            <!-- Start: Topbar -->
            <header id="topbar">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="<?= base_url('Profile') ?>">
                                <span>Profile</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </header>
            <!-- End: Topbar -->
            <!-- Begin: Content -->
            <section id="content" class="animated fadeIn">
                <!-- Begin .page-heading -->                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-block">
                            <ul class="nav nav-tabs">
                                <li class="<?= $tab1active ?>">
                                    <a href="#tab1" data-toggle="tab">Profile</a>
                                </li>
                                <li class="<?= $tab2active ?>">
                                    <a href="#tab2" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content p30">
                                <div id="tab1" class="tab-pane <?= $tab1active ?>">
                                    <?php echo form_open('Profile/save', ['name' => 'loginForm', 'id' => 'loginForm', 'enctype' => 'multipart/form-data']);
                                    ?>
                                    <div class="col-md-3">
                                        <div class="media clearfix">
                                            <div class="media-left pr30">
                                                <a href="#">
                                                    <img style="width: 100%;" class="media-object mw150" src="<?= base_url() . $userdata->user_image ?>" alt="...">
                                                </a>
                                            </div>
                                        </div>

                                    </div>                                    
                                    <div class="col-md-9">
                                        <?php

                                        editbox('12', 'First Name', 'user_fullname', 'Enter First Name', $userdata->user_fullname);
                                        emailbox('12', 'Email', 'user_email', 'Enter Email', $userdata->user_email);
                                        numberbox('12', 'Phone Number', 'user_mob', 'Enter Number', $userdata->user_mob);

                                        echo '<div class="clearfix"></div>';
                                        uploadbox('12', 'Profile Image', 'user_image', 'Choose Image');
                                        echo '<div class="clearfix"></div>
                                        <div class="col-lg-12">
                                        <div class="form-group" style="float:left;" >' .
                                            form_submit(['value' => 'Save', 'class' => 'btn btn-primary']) . '
                                        </div></div>';
                                        echo form_close();
                                        ?>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-pane <?= $tab2active ?>">
                                    <?php echo form_open('Auth/change_password', ['name' => 'ChangePwd', 'id' => 'ChangePwd', 'enctype' => 'multipart/form-data']);
                                    passwordbox('6', 'Current Password', 'old', 'Enter Current Password', '', 'required');
                                    echo '<div class="clearfix"></div>';
                                    passwordbox('6', 'New Password', 'new', 'Enter New Password', '', 'pattern="^.{6}.*$" required');
                                    echo '<div class="clearfix"></div>';
                                    passwordbox('6', 'New Confirm Password', 'new_confirm', 'Enter New Confirm Password', '', 'pattern="^.{6}.*$" required');
                                    echo '<div class="clearfix"></div>
                                        <div class="col-lg-12">
                                        <div class="form-group" style="float:left;" >' .
                                        form_submit(['value' => 'Change Password', 'class' => 'btn btn-primary']) . '
                                        </div></div>';
                                    echo form_close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End: Content -->
            <?php
                $this->load->view('Includes/footer');
            ?>
        </section>
    </div>
    <!-- End: Main -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <?php
        $this->load->view('Includes/footerscript');
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            "use strict";
            // Init Theme Core    
            Core.init();
            // Init Demo JS  
            Demo.init();
        });
    </script>
    </body>
</html>