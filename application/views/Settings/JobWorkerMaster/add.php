<?php 
$currentPage="Job Worker Master";
$PageBack=base_url()."Settings/JobWorkerMaster/";
$PageSave=base_url()."Settings/JobWorkerMaster/save";
$pageBack=base_url()."Settings/JobWorkerMaster/";
$operation = "Add";
$val_countryid=1;
$val_state=24;
$val_cgst=9;
$val_sgst=9;
$val_igst=18;
if ($id != "" and is_numeric($id)) {
    $operation = "Edit";  
    $val_company_name= StringRepair3($JobWorkerMaster->company_name);
    $val_companyid= StringRepair3($JobWorkerMaster->company_id);
    $val_tdsno=StringRepair3($JobWorkerMaster->tds_no);
    $val_about=StringRepair3($JobWorkerMaster->party_type);
    $val_panno=StringRepair3($JobWorkerMaster->pan_no); 
    $val_address=StringRepair3($JobWorkerMaster->address);
    $val_countryid =StringRepair3($JobWorkerMaster->country);
    $val_state =StringRepair3($JobWorkerMaster->state);
    $val_city = StringRepair3($JobWorkerMaster->city);
    $val_pincode=StringRepair3($JobWorkerMaster->pincode);
    $val_gstno=StringRepair3($JobWorkerMaster->gst_no);
    $val_cgst=StringRepair3($JobWorkerMaster->cgst);
    $val_sgst=StringRepair3($JobWorkerMaster->sgst);
    $val_igst=StringRepair3($JobWorkerMaster->igst);
}
$managePage = $operation . " Job Worker Master"; 
?>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    $this->load->view('Includes/tablecss');
    ?>
</head>

<body class="ecommerce-page sb-l-m">
    <div id="main">
        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <section id="content_wrapper">
            <header id="topbar">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="<?=$pageBack?>">
                                <span>Job Worker Master</span>
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
                                        <a href="<?=base_url('Settings/JobWorkerMaster/')?>">Job Worker Details</a>
                                    </li>
                                    <?php 
                                    if($id!=0 && $id!=""):
                                    ?>
                                    <li>
                                        <a href="<?=base_url('Settings/JobWorkerMaster/addPerson/'.$id)?>"
                                            id="item-palleting-tab">Contact Person</a>
                                    </li>
                                    <?php endif;?>
                                </ul>
                            </span>
                        </div>
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <div class="panel-body">
                            <?php 
                                    echo "<div class='col-md-6' style='padding:0px !important'>";
                                    editbox('12','Company Name','company_name','Company Name',$val_company_name,'required');
                                    gstnumberbox('6','GST Number','gstno','Enter GST Number',$val_gstno);
                                    editbox('6','PAN No.','panno','Enter PAN No.',$val_panno,'minlength="10" maxlength="10"');
                                    echo "</div>";
                                    echo "<div class='col-md-6' style='padding:0px !important'>";
                                    textareabox2('12','Address','address','Enter Address',$val_address,'required');
                                    echo "</div><div class='clearfix'></div>";
                                    dropdownbox('3','Country Name','countryid',$countrylist,$val_countryid);
                                    dropdownbox('3','State','state',$statelist,$val_state,'required');
                                    editbox('3','City','city','Enter City',$val_city,'required');
                                    editbox('3','Pincode','pincode','Enter Pincode',$val_pincode,'required minlength="6" maxlength="6" pattern="[0-9]+"');
                                    echo "<div class='col-lg-12 admin-form theme-success'>";
                                    echo "<div class='section-divider mb30'>";
                                    echo "<span class='bg-white'>GST details</span>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "<div class='CGSTchangefix'>";
                                    editbox('4','CGST %','cgst','Enter CGST',$val_cgst);
                                    editbox('4','SGST %','sgst','Enter SGST',$val_sgst);
                                    echo "</div>";
                                    echo "<div class='IGSTchangefix' style='display:none';>";
                                    editbox('4','IGST %','igst','Enter IGST',$val_igst);
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
            </section>
            <?php $this->load->view('Includes/footer'); ?>
        </section>
    </div>
    <?php
     $this->load->view('Includes/footerscript'); 
        $this->load->view('Includes/tablejs');
    ?>
    <script>
    jQuery(document).ready(function() {

"use strict";
Core.init();

Demo.init();
var inputvalue = $('#state').val();
    var res = inputvalue.substring(0, 2);
    
    if (inputvalue == '24') 
    {
        $(".CGSTchangefix").show();
        $(".IGSTchangefix").hide();
    } else {
        $(".CGSTchangefix").hide();
       $(".IGSTchangefix").show();
    }
$(".select2-single").select2();

    $('.datetimepicker').datepicker({
        dateFormat: 'dd/mm/yy'
});

});
$(document).on('change',"#gstno", function(){ 
    
    var inputvalue = $('#gstno').val();
    var res = inputvalue.substring(2,12);
    var code= inputvalue.substring(0,2);
   $('#panno').val(res);
   $('#state option:selected').removeAttr('selected');
   $('#state').html($('#state').html().replace('selected',''));
   $('#state [value='+code+']').attr('selected', 'true');
   if (code == '24') 
    {
        $(".CGSTchangefix").show();
        $(".IGSTchangefix").hide();
    } else {
        $(".CGSTchangefix").hide();
       $(".IGSTchangefix").show();
    }
   
});

    </script>
</body>
</html>