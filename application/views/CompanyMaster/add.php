<?php 
  $currentPage="Company Master";
  $PageBack=base_url()."CompanyMaster/";
  $PageSave=base_url()."CompanyMaster/save";
  $pageBack=base_url()."CompanyMaster/";
  $operation = "Add";
  
  

$val_iec_date=date('d/m/Y');
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  
      
      $val_company_name= StringRepair3($CompanyMaster->company_name);
      $val_short_name= StringRepair3($CompanyMaster->short_name);
      $val_bankid= StringRepair3($CompanyMaster->bankid);

      $val_place= StringRepair3($CompanyMaster->place);

      $val_pincode= StringRepair3($CompanyMaster->pincode);
      $val_state= StringRepair3($CompanyMaster->state);
     $val_countryid =StringRepair3($CompanyMaster->countryid);
      $val_gstno= StringRepair3($CompanyMaster->gstno);
      $val_code= StringRepair3($CompanyMaster->code);
      $val_currencyid= StringRepair3($CompanyMaster->currencyid);
      $val_address= StringRepair3($CompanyMaster->address);
      $val_iec_date=date_create_from_format('Y-m-d',$CompanyMaster->iec_date);
      $val_iec_date=date_format($val_iec_date,'d/m/Y');
      $val_arn=StringRepair($CompanyMaster->arn);      
    
  }
  
  $managePage = $operation . " Company Master"; 


?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');

    
    $this->load->view('Includes/tablecss');
    
    ?>

    
</head>

<body class="ecommerce-page">

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
                                    <span>Company Master</span>
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
                    
                     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'CompanyMasterfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
                    ?>
                        <!-- Input Fields -->
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title">
                                  <ul class="nav panel-tabs-border panel-tabs  panel-tabs-left">
                                <li class="active">
                                    <a href="<?=base_url('CompanyMaster/')?>">Company Details</a>
                                </li>
                                <?php 
                                if($id!=0 && $id!=""):
                                ?>
                                <li >
                                    <a href="<?=base_url('CompanyMaster/addANR/'.$id)?>" id="item-palleting-tab">ARN NUMBER</a>
                                </li>
                                <?php endif;?>
                            </ul>
                                </span>
                            </div>
                             <input type="hidden" name="id" value="<?= $id; ?>">
                            <div class="panel-body">
                                <?php 
                                
                                
                                    
                                    editbox('4','Company Name','company_name','Enter Company Name',$val_company_name,'required');
                                    editbox('4','Short Name','short_name','Enter Short Name',$val_short_name,'required');
                                    dropdownbox('4','Bank Account','bankid',$banklist,$val_bankid,'required');
                                    echo "<div class='clearfix'></div>";
                                    dropdownbox('4','Country Name','countryid',$countrylist,$val_countryid,'required');
                                    editbox('4','Place','place','Enter Place',$val_place,'required');
                                    editbox('4','Pincode','pincode','Enter Pincode',$val_pincode,'required');
                                    
                                    echo "<div class='clearfix'></div>";
                                    editbox('4','State','state','Enter State',$val_state,'required');
                                    editbox('4','GST No.','gstno','Enter GST No.',$val_gstno);
                                    editbox('4','IEC Code','code','Enter Code',$val_code);
                                    echo "<div class='clearfix'></div>";
                                    dropdownbox('4','Curreny','currencyid',$currencylist,$val_currencyid,'required');
                                    datepicker('4','IEC Date','iec_date','Enter IEC Date',$val_iec_date);
                                    
                                    echo "<div class='clearfix'></div>";
                                    textareabox('12','Address','address','Enter Address',$val_address,'required');
                                    
                                    
                                                                        
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

    $('#CompanyMasterfrom').submit(function(e){

        var bankid=$('#bankid').val();
        var currencyid=$('#currencyid').val();
        var error="0";
        if(bankid==0)
        {
            error="Select Bank Account";
        }else if(currencyid==0)
        {
            error="Select Currency";
        }

                if(error!="0")
            {
                e.preventDefault();
                
                alertbox('Error',error,'danger');
            }
    });

        });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>