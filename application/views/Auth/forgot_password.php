<!DOCTYPE html>
<html>

<head>
    <?php 
    $this->load->view('Includes/head');
    ?>
</head>

<body class="external-page sb-l-c sb-r-c">

    <!-- Start: Main -->
    <div id="main" class="animated fadeIn">

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

            <!-- begin canvas animation bg -->
            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div>

            <!-- Begin: Content -->
            <section id="content" class="animated fadeIn">

                <div class="admin-form theme-info mw500" style="margin-top: 10%;" id="login">
                    <div class="row mb15 table-layout">

                        <div class="col-xs-6 text-right va-m pln">
                            <h2 class="img-responsive w250 text-white  text-right"><b>SUPREME</b> International</h2>
                            <!-- <a href="dashboard.html" title="Return to Dashboard">
                                <img src="assets/img/logos/logo_white.png" title="AdminDesigns Logo" class="img-responsive w250">
                            </a> -->
                        </div>
                                   

                        <div class="col-xs-6 text-right va-b pr5">
                            <div class="login-links">
                                <a href="<?=base_url('Auth/login')?>" class="active" title="Sign In"> <span class="fa fa-arrow-left"></span> Back To Sign In</a>
                            </div>

                        

                    </div>
                    </div>

                    <div class="panel panel-info heading-border br-n">

                        <?php echo form_open('Auth/forgot_password', ['name' => 'loginForm', 'id' => 'loginForm']); ?>
                            <div class="panel-body p15 pt25">

                  
                                <!-- <div class="alert alert-micro alert-border-left alert-info pastel alert-dismissable mn">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="fa fa-info pr10"></i> Enter your
                                    <b>Email</b> and instructions will be sent to you!
                                </div> -->

                            </div>
                            <!-- end .form-body section -->
                            <div class="panel-footer p25 pv15">

                                <div class="section mn">

                                    <div class="smart-widget sm-right smr-80">
                                        <label for="email" class="field prepend-icon">
                                            <input type="text" name="identity" id="email" class="gui-input" placeholder="Your Email Address" required>
                                            <label for="email" class="field-icon">
                                                <i class="fa fa-envelope-o"></i>
                                            </label>
                                        </label>
                                        <button type="submit" for="email" class="button">Reset</button>
                                    </div>
                                    <!-- end .smart-widget section -->
                <!-- <a href="<?=base_url('Auth/login')?>" class="tx-info tx-12 d-block mg-t-10">Goto Login </a> -->
                                </div>
                                <!-- end section -->

                            </div>
                            <!-- end .form-footer section -->

                        </form>

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
    <script src="<?php echo base_url()?>assets/vendor/plugins/canvasbg/canvasbg.js"></script>

    

    <!-- Page Javascript -->
    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core      
            Core.init();

            // Init Demo JS
            Demo.init();

            CanvasBG.init({
                Loc: {
                    x: window.innerWidth / 2,
                    y: window.innerHeight / 3.3
                },
            });

        });
    </script>
</body>

</html>