<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    ?>
    <style>
        body.external-page #content .admin-form {
            max-width: 500px;
        }
    </style>
</head>

<body class="external-page sb-l-c sb-r-c">
    <!-- Start: Main -->
    <div id="main" class="animated fadeIn">
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">
            <!-- begin canvas animation bg -->
            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div> <!-- Begin: Content -->
            <section id="content">
                <div class="admin-form theme-info" id="login1">
                    <!-- <div class="row mb15 table-layout">
                        <div class="col-xs-12 text-right va-b pr5">
                            <div class="login-links">
                                <a href="javascript:void(0);" class="active" title="Sign In">Sign In</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="panel panel-info mt10 br-n">
                        <div class="panel-heading heading-border bg-white">
                            <h1 class="text-center text-info mn"><b>RK University</b> Hostel</h1>
                        </div> <?php echo form_open('Auth/login', ['name' => 'loginForm', 'id' => 'loginForm']); ?>
                        <!-- end .form-header section -->
                        <div class="panel-body bg-light p15">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="section">
                                        <label for="username" class="field-label text-muted fs18 mb10">Username</label>
                                        <label for="username" class="field prepend-icon">
                                            <input type="text" name="identity" id="identity" class="gui-input" placeholder="Enter username" required>
                                            <label for="username" class="field-icon">
                                                <i class="fa fa-user"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <!-- end section -->
                                    <div class="section">
                                        <label for="username" class="field-label text-muted fs18 mb10">Password</label>
                                        <label for="password" class="field prepend-icon">
                                            <input type="password" name="password" id="password" class="gui-input" placeholder="Enter password" required>
                                            <label for="password" class="field-icon">
                                                <i class="fa fa-lock"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <!-- end section -->
                                </div>
                            </div>
                        </div>
                        <!-- end .form-body section -->
                        <div class="panel-footer clearfix p10 ph15">
                            <button type="submit" class="button btn-primary mr10 pull-right">Sign In</button>
                        </div>
                        <!-- end .form-footer section -->
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </section>
            <!-- End: Content -->
        </section>
        <!-- End: Content-Wrapper -->
    </div>
    <!-- End: Main -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <?php
    $this->load->view('Includes/footerscript');
    ?>
    <!-- CanvasBG Plugin(creates mousehover effect) -->
    <script src="<?php echo base_url() ?>assets/vendor/plugins/canvasbg/canvasbg.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            "use strict"; // Init Theme Core      
            Core.init(); // Init Demo JS
            Demo.init();
            CanvasBG.init({
                Loc: {
                    x: window.innerWidth / 2,
                    y: window.innerHeight / 3.3
                },
            });
        });
    </script> <!-- END: PAGE SCRIPTS -->
</body>

</html>