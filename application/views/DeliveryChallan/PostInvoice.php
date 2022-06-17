<?php     
$PageSave=base_url()."Invoice/savePostInvoice/";
$pageBack=base_url()."Invoice";
// $saveItem=base_url()."Invoice/saveItem/";
// $deleteItem=base_url()."Invoice/deleteItem/";
// $getItemData=base_url()."Invoice/SingleItem/";
$isrequired="";
  if ($id != "" && is_numeric($id)) {
 
    $val_invoiceno= StringRepair3($Invoice->invoiceno);
    $val_dbk_amount= StringRepair3($Invoice->dbk_amount);
    $val_cha_name= StringRepair3($Invoice->cha_name);
    $val_transporterid= StringRepair3($Invoice->transporterid);
    $val_shipping_bill_no= StringRepair3($Invoice->shipping_bill_no);
    $val_custom_exchange_rate=StringRepair3($Invoice->custom_exchange_rate);
    $val_shipping_bill_date=$Invoice->shipping_bill_date;
    if($val_shipping_bill_date=="0000-00-00")
    {
        $val_shipping_bill_date=date('Y-m-d');
    }
    $val_shipping_bill_date= date_create_from_format('Y-m-d',$val_shipping_bill_date);
    $val_shipping_bill_date=date_format($val_shipping_bill_date,'d/m/Y');
    $val_flight_no= StringRepair3($Invoice->flight_no);
    $val_vessel_no= StringRepair3($Invoice->vessel_no);
    $val_bl_no= StringRepair3($Invoice->bl_no);
    $val_shpping_company= StringRepair3($Invoice->shpping_company);
    $val_dbk_status=StringRepair3($Invoice->dbk_status);
    $packingid=$Invoice->packingid;
    $iseditable=$Invoice->iseditable;
    if($iseditable)
    {
        $isrequired="required";
    }
}    

?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');

    
    $this->load->view('Includes/tablecss');
    
    ?>
<style>
    input::-webkit-calendar-picker-indicator {
  display: none;
}
#extended_price
{
    cursor:not-allowed;
}
.w70
{
width:70px;

}
</style>
    
</head>

<body class="ecommerce-page sb-l-m">
<div class="loading" style="display:none;">Loading…</div>
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
                            <a href="<?=base_url('Invoice')?>">
                                <span>Invoice - <?=$val_invoiceno?></span>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="topbar-right">
                <a class="btn btn-default" href="<?=base_url('PackingList/add/'.$packingid)?>"><i class="fa fa-arrow-left"></i> Go To Packing list</a>
                </div>
            </header>
            <!-- End: Topbar -->

             <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                              <!-- begin: .tray-center -->
                <div class="tray tray-center">
                  
                    <!-- Input Fields -->
                    <div class="panel">
                     <div class="panel-heading">
                            <ul class="nav panel-tabs-border panel-tabs  panel-tabs-left">
                                <li >
                                    <a href="<?=base_url('Invoice/add/'.$id)?>">Invoice</a>
                                </li>
                                <?php 
                                if($id!=0 && $id!=""):
                                ?>
                                <li >
                                    <a href="<?=base_url('Invoice/InvoiceItem/'.$id)?>" id="item-palleting-tab">Invoice Items</a>
                                </li>
                                <li class="active">
                                    <a href="<?=base_url('Invoice/PostInvoice/'.$id)?>" id="packing-list-tab">Post Invoice Management</a>
                                </li>
                                 <?php if($iseditable):?>
                                <li >
                                    <a href="<?=base_url('Invoice/Payment/'.$id)?>" id="packing-list-tab">Payment Received</a>
                                </li>
                                <?php endif;?>
                                <?php endif;?>
                            </ul>
                        </div>
                        <div class="panel-body ">
                            <div class="tab-content br-n pn">
                                <!-- PACKING DETAILS FORM -->
                                
                                            <?php echo form_open($PageSave, ['name' => 'frm1', 'id' => 'postinvoiceform', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); ?>
                                                    <input type="hidden" name="id" id="id" value="<?=$id?>">

                                                    <?php 
                                                    numberbox('4','DBK Amount','dbk_amount','Enter DBK Amount',$val_dbk_amount,'required');
                                                    editbox('4','Custom Exchange Rate','custom_exchange_rate','Enter Custom Exchange Rate',$val_custom_exchange_rate);
                                                    editbox('4','Shipping Bill No','shipping_bill_no','Enter Shipping Bill No',$val_shipping_bill_no,$isrequired);
                                                    echo "<div class='clearfix'></div>";
                                                    editbox('4','Shipping Bill Date','shipping_bill_date','Enter Shipping Bill Date',$val_shipping_bill_date);
                                                    editbox('4','Vessel No / Flight No','flight_no','Enter Vessel No / Flight No',$val_flight_no);
                                                    editbox('4','B.L. No','bl_no','Enter B.L. No',$val_bl_no,$isrequired);
                                                    echo "<div class='clearfix'></div>";
                                                    ?>
                                                    <div class="col-lg-12 mt20 mb15">
                                            <?php 
                                                submitbutton($pageBack);
                                            ?>
                                        </div>
                                        <?php echo form_close(); ?>

                                            
                                        
                            </div>
                        </div>
                       
                    </div>
                </div>
                <!-- end: .tray-center -->

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



    <script type="text/javascript">
var iseditable=<?=$iseditable?>;
    var itemid=0;


    $('#postinvoiceform').submit(function(e){
var shipping_bill_no=$('#shipping_bill_no').val();
var bl_no=$('#bl_no').val();   
if(iseditable==0 && shipping_bill_no.trim()!="" && bl_no.trim()!="")
{

 e.preventDefault();
       swal({
                    title: "Are you sure?",
                    text: " Once Submitting this form The invoice would be locked and packing list would be non editable.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Submit it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                },
                function(isConfirm) {
                    if (isConfirm) {
                          e.currentTarget.submit();
                    }
                });
}
});
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
                    dateFormat: 'dd/mm/yy',
                       prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            showButtonPanel: false,
            beforeShow: function(input, inst) {
                var newclass = 'admin-form';
                var themeClass = $(this).parents('.admin-form').attr('class');
                var smartpikr = inst.dpDiv.parent();
                if (!smartpikr.hasClass(themeClass)) {
                    inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                }
                }
            });

          
$('.select2-container').attr("style","width:100% !important;");


        });
        
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>