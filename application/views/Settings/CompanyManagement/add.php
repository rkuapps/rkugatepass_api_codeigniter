<?php 

  $currentPage="Company Management";
  $PageBack=base_url()."Settings/CompanyManagement/";
  $PageSave=base_url()."Settings/CompanyManagement/save";
  $pageBack=base_url()."Dashboard/";
  $operation = "Add";
  $val_countryid=1;
  $val_state=12;
  if ($id != "" and is_numeric($id)) {
    $operation = "Edit";  
    $val_company_name= StringRepair3($CompanyManagement->company_name);
     $val_company_code= StringRepair3($CompanyManagement->company_code);
     $val_gstno=StringRepair3($CompanyManagement->gst_no);
     $val_panno=StringRepair3($CompanyManagement->pan_no);
     $val_tdsno=StringRepair3($CompanyManagement->tds_no);
     $val_address=StringRepair3($CompanyManagement->address);
     $val_countryid =StringRepair3($CompanyManagement->country);
     $val_state =StringRepair3($CompanyManagement->state);
     $val_city = StringRepair3($CompanyManagement->city);
     $val_pincode=StringRepair3($CompanyManagement->pincode);
    

}

$managePage = $operation . " Country Master"; 

?>
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
                                    <span>Company Profile</span>
                                </a>
                            </li>
                        </ol>
                    </div>
                </header>
            <section id="content" class="table-layout animated fadeIn">

<div class="tray tray-center">

    <?php 
    
     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'CompanyMasterfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
    ?>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">
                  <ul class="nav panel-tabs-border panel-tabs  panel-tabs-left">
                <li class="active">
                    <a href="<?=base_url('Settings/CompanyManagement/add')?>">Company Details</a>
                </li>
                <?php 
                if($id!=0 && $id!=""):
                ?>
                <li>
                <a href="<?=base_url('Settings/CompanyManagement/addPerson/'.$id)?>" id="item-palleting-tab">Contact Person</a>
                </li>
                <?php endif;?>
                
            </ul>
                </span>
            </div>
             <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="panel-body">
            
                                <?php 
                                    echo '<div class="col-md-6" style="padding:0px !important">';
                                    editbox('6','Company Name','company_name','Enter Company Name',$val_company_name,'required');
                                    gstnumberbox('6','GST No.','gstno','Enter GST No.',$val_gstno,'required');
                                    editbox('6','PAN No.','panno','Enter PAN No.',$val_panno);
                                    editbox('6','TDS No.','tdsno','Enter TDS No.',$val_tdsno);
                                    echo '</div>';
                                    echo '<div class="col-md-6" style="padding:0px !important">';
                                    textareabox2('12','Address','address','Enter Address',$val_address,'required');
                                    echo '</div>';
                                    echo '<div class="clearfix"></div>';
                                    dropdownbox('3','Country Name','countryid',$countrylist,$val_countryid);
                                    dropdownbox('3','State','state',$statelist,$val_state,'required');
                                    editbox('3','City','city','Enter City',$val_city,'required');
                                    editbox('3','Pincode','pincode','Enter Pincode',$val_pincode,'required');
                                
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
            </section>

 <?php $this->load->view('Includes/footer'); ?>

        </section>

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <?php
     $this->load->view('Includes/footerscript'); 
        $this->load->view('Includes/tablejs');
    ?>
    <script>  jQuery(document).ready(function() {

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
$(document).on('change',"#gstno", function(){ 
    
     var inputvalue = $('#gstno').val();
     var res = inputvalue.substring(2);
     var code= inputvalue.substring(0,2);
    $('#panno').val(res);
    $('#state option:selected').removeAttr('selected');
    $('#state').html($('#state').html().replace('selected',''));
    $('#state [value='+code+']').attr('selected', 'true');
    
});

</script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>