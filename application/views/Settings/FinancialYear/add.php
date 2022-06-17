<?php 
  $currentPage="Financial Year";
  $financialYear=base_url()."Settings/FinancialYear/";
  $PageSave=base_url()."Settings/FinancialYear/save";
  $pageBack=base_url()."Settings/FinancialYear/";
  $operation = "Add";
  $backup=base_url()."Settings/Backup/";
  $itemunit=base_url()."Settings/ItemUnit/";

  $val_isactive = 0;
  $val_start_date=date('01/04/Y');
  $val_end_date=date('31/03/Y',strtotime("+1 years"));
$val_ms_value=80;
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  
      $val_name= StringRepair3($FinancialYear->name);
      $val_ms_value= StringRepair3($FinancialYear->ms_value);
    $val_companyid= StringRepair3($FinancialYear->company_id);
    $val_start_date=date_create_from_format('Y-m-d',$FinancialYear->start_date);
    $val_start_date=date_format($val_start_date,'d/m/Y');
    $val_end_date=date_create_from_format('Y-m-d',$FinancialYear->end_date);
    $val_end_date=date_format($val_end_date,'d/m/Y');

  }
  
  $managePage = $operation . " Financial Year"; 


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
            <header id="topbar" class="ph10">
                <div class="topbar-left">
                    <ul class="nav nav-list nav-list-topbar pull-left">
                        <li class="active">
                            <a href="<?=$financialYear?>"><?=$currentPage?></a>
                        </li>
                        <li>
                            <a href="<?=$backup?>">Backup</a>
                        </li>
                     
                    </ul>
                </div>
            </header>
            <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- begin: .tray-center -->
                <div class="tray tray-center">

                    <?php 
                    
                     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'FinancialYearfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
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
                             <input type="hidden" name="company_id" value="<?= $val_companyid; ?>">
                            <div class="panel-body">
                                <?php 
                                
                                    editbox('4','Financial  Year ','name','Enter Financial  Year',$val_name,'readonly');
                                    dropdownbox('4','Company Name','companyid',$companylist,$val_companyid,'disabled');
                                    numberbox('4','Ms Value','ms_value','Enter Ms  Value',$val_ms_value,'min="0" required');
                                    datepicker('6','Start Date ','start_date','Enter Start Date',$val_start_date,'disabled');
                                    datepicker('6','End Date','end_date','Enter End Date',$val_end_date,'disabled');
                                   // daterangepicker('4','Select Date Range ','date','Enter Date Range',$val_date,'required');
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
$('#FinancialYearfrom').submit(function(e) {

var error="0";
 var start_date=$('#start_date').val().split("/");
 var end_date=$('#end_date').val().split("/");
 
 var sdate=start_date[2]+start_date[1]+start_date[0];
 var edate=end_date[2]+end_date[1]+end_date[0];
 if(edate<=sdate)
 {
   error="Please Select End Date Greater  Than Start Date";
 }
 


 if(error!="0")
 {
    e.preventDefault();
    
  alertbox('Error',error,'danger');
 }
 
});
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>