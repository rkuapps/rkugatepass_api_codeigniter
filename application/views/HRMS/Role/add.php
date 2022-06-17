<?php 
       $currentPage="Add Role";
    $PageSave=base_url()."HRMS/Role/save";
    
  $pageBack=base_url()."HRMS/Role/";
  $operation = "Add";
  $val_role_name = "";
  $val_role_details = array();
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";
      $val_role_name = StringRepair3($role->user_role);
      $val_role_details = json_decode($role->role_details);
  }
  
  $managePage = $operation . " Role"; 



?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');

    
    $this->load->view('Includes/tablecss');
    
    ?>
<style>
        .role_ul {
            padding-left: 0px;
            border: 1px solid #dddddd;
            margin-bottom: 0px;
            font-size: 14px;
            font-weight: bold;
        }

        .role_ul li ul {
            padding-left: 0px;
        }

        .role_ul li ul li {
            border: 1px solid #dddddd;
        }


        .role_ul li {
            display: inline-block;
            width: 100%;
            padding: 5px;
            line-height: 20px;
        }

        .switcher {
            float: right;
            width: 50px;
            text-align: center;
        }

        .role_ul ul li:hover {
            background-color: #70829a;
            color: #fff;
        }

        .maintop span {
            width: 50px;
            text-align: center;
            display: inline-block;
        }
        </style>
    
</head>

<body class="ecommerce-page sb-l-m">

    <!-- Start: Main -->
    <div id="main">

        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

                <!-- Start: Topbar -->
                <header id="topbar">
                    <div class="topbar-left">
                        <ol class="breadcrumb">
                            <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                            <li class="crumb-active">
                                <a href="<?=$pageBack?>">
                                    <span>Role </span>
                                </a>
                            </li>
                        </ol>
                    </div>
                </header>
                <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- begin: .tray-center -->
                <div class="tray tray-center">

                    <?php 
                    
                     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'Rolefrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
                    ?>
                        <!-- Input Fields -->
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title">
                                    <?php 
                                        echo $managePage;
                                    ?>
                                </span>
                            </div>
                             <input type="hidden" name="id" value="<?= $id; ?>">
                            <div class="panel-body">
                                <?php 
                                
                                
                                     editbox('6','Role Name ','rolename','Enter Role Name',$val_role_name,'required');                                                                        
                                     
                                ?>
                                  <div class="col-lg-12">
                            <?php $menu_list_arr = json_decode(MENU_LIST_JSON);
                            echo '<ul class="role_ul maintop">';
                            echo '<li>Menu <div class="pull-right">
                            <span>Delete</span>
                            <span>Edit</span>
                            <span>Add</span>
                            <span>View</span>
                            </div></li>';
                            echo '</ul>';
                            foreach ($menu_list_arr as $m) {
                                echo '<ul class="role_ul">';
                                echo set_menu_role($m, $val_role_details);
                                echo '</ul>';
                            }

                            ?>
                        </div>
                            </div>  
                            <div class="panel-footer">
                                <?php 
                                    Submitbutton($pageBack);
                                ?>
                            </div>
                        </div>
                    <?php 
                        echo form_close();
                    ?>
                </div>
                <!-- end: .tray-center -->

            </section>
            <!-- End: Content -->

 <?php $this->load->view('Includes/footer'); ?>

        </section>

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <?php
     $this->load->view('Includes/footerscript'); 
        $this->load->view('Includes/tablejs');
    ?>

    

    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core    
            Core.init();

            // Init Demo JS  
            Demo.init();

            // Init Select2 - Basic Single
            $(".select2-single").select2();

            // Init DateRange plugin
            //$('.datetimepicker').daterangepicker({
                $('.datetimepicker').datepicker({
                    dateFormat: 'dd/mm/yy'
            });


        });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>