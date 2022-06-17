<?php 
  $currentPage="User";
  $PageBack=base_url()."HRMS/User/";
  $PageSave=base_url()."HRMS/User/save";
  $pageBack=base_url()."HRMS/User/";
  $operation = "Add";
  
$val_user_blocked=1; 
$val_have_login=1; 
$ispassword="required";
$isemail="required";
$isusername="required";
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit"; 
      
      $ispassword="";
      $val_user_email= StringRepair3($user->user_email);
      $val_user_fname= StringRepair3($user->user_fname);
      $val_user_lname= StringRepair3($user->user_lname);
      $val_user_mob= StringRepair3($user->user_mob);
      $val_user_name= StringRepair3($user->user_name);
      $val_user_type= StringRepair3($user->user_type);
      $val_card_id= StringRepair3($user->card_id);
      $val_basic_pay= StringRepair3($user->basic_pay);
      $val_user_blocked= StringRepair3($user->user_blocked);
      $val_attendance_group= StringRepair3($user->attendance_group);
      $val_pay_type= StringRepair3($user->pay_type);
      $val_have_login= StringRepair3($user->have_login);
      $val_companylist=explode(',',StringRepair3($user->user_companyid));
      if($val_have_login!=1)
      {
          $isemail="";
          $isusername="";

      }
    
  }
  
  $managePage = $operation . " User"; 


?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');

    
    $this->load->view('Includes/tablecss');
    
    ?>

    
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
                                    <span>User</span>
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
                    
                     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'userfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
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
                             <input type="hidden" name="id" id="saveid" value="<?= $id; ?>">
                            <div class="panel-body">
                                <?php 
                                    editbox('4','First Name','user_fname','Enter First Name',$val_user_fname,'required');
                                    editbox('4','Last Name','user_lname','Enter Last Name',$val_user_lname,'required');
                                    editbox('4','Mobile No.','user_mob','Enter Mobile No.',$val_user_mob,' pattern="[6-9]{1}[0-9]{9}" required');
                                    echo "<div id='islogininfo' >";
                                    form_divider('Login Information');
                                    emailbox('3','Email','user_email','Enter Email',$val_user_email);
                                    editbox('3','User Name','user_name','Enter Username',$val_user_name,$isusername);
                                    passwordbox('3','Password','user_password','Enter Password','',$ispassword);
                                    dropdownbox('3','Role','user_type',$userrole,$val_user_type,'required');
                                    echo "</div>";
                                                              
                                ?>
                                
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

  $('#userfrom').submit(function(e){
  
    var user_type=$('#user_type').val();
    var have_login=$('#have_login').is(":checked");  
    var attendance_group=$('#attendance_group').val();
    if(user_type==0 && have_login==true)
    {
      e.preventDefault();
      
         alertbox('Error','Select User Role','danger');
    }else if(attendance_group==0)
    {
         e.preventDefault();
         
         alertbox('Error','Select Attendance Group','danger');
    }
  });

    $(document).on('change','#have_login',function(){ 
    
    var id=$('#saveid').val();
    if($(this).is(":checked"))
    {
        $('#islogininfo').show();
        $('#user_email').prop("required", true);
        $('#user_name').prop("required", true);
        if(id==0)
        {
            $('#user_password').prop("required", true);
        }
        

        $('.select2-container').attr("style","width:100% !important;");
    }else{
        $('#islogininfo').hide();
        $('#user_email').prop("required", false);
        $('#user_name').prop("required", false);
        $('#user_password').prop("required", false);
        
        
    }
    
    
     });

        });

        
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>