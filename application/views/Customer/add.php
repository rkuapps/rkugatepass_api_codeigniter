<?php 
  $currentPage="Customer";
  $PageBack=base_url()."Customer/";
  $PageSave=base_url()."Customer/save";
  $pageBack=base_url()."Customer/";
  $operation = "Add";
  
  

  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  
      
      $val_customer_name= StringRepair3($Customer->customer_name);
      $val_short_name= StringRepair3($Customer->short_name);
      $val_customer_code= StringRepair3($Customer->customer_code);

      $val_countryid =StringRepair3($Customer->countryid);

      $val_currencyid= StringRepair3($Customer->currencyid);
            $val_companyid= StringRepair3($Customer->companyid);
      $val_final_destination= StringRepair3($Customer->final_destination);
      $val_address= StringRepair3($Customer->address);
    
  }
  
  $managePage = $operation . " Customer"; 


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
                    <ul class="nav nav-list nav-list-topbar pull-left">
                        <li class="active disabled">
                            <a href="#">Customer</a>
                        </li>
                        <?php if($id!=0 && $id!="")
                        {?>
                        <li >
                            <a href="<?=base_url('Item/index/'.$id)?>">Items</a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </header>
            
                <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- begin: .tray-center -->
                <div class="tray tray-center">

                    <?php 
            
                     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'Customerfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
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
                                
                                
                                    
                                    editbox('4','Customer Name','customer_name','Enter Customer Name',$val_customer_name,'required');
                                    editbox('4','Short Name','short_name','Enter Short Name',$val_short_name,'required');
                                    editbox('4','Customer Code','customer_code','Enter Customer Code',$val_customer_code,'required');
                                    
                                    echo "<div class='clearfix'></div>";
                                    //
                                    dropdownbox('4','Under Company of','companyid',$companylist,$val_companyid,'required');
                                    dropdownbox('4','Country Name','countryid',$countrylist,$val_countryid,'required');
                                    dropdownbox('4','Curreny','currencyid',$currencylist,$val_currencyid,'required');
                                   echo "<div class='clearfix'></div>";
                                    dropdownbox('4','Final Destination','final_destination',$finaldestinationlist,$val_final_destination,'required');
                                    echo "<div class='clearfix'></div>";
                                    textareabox('12','Address','address','Enter Address',$val_address);
                                    
                                    
                                                                        
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

    $('#Customerfrom').submit(function(e){

        var countryid=$('#countryid').val();
        var currencyid=$('#currencyid').val();
        var port=$('#final_destination').val();
        var companyid=$('#companyid').val();

        var error="0";
        if(countryid==0)
        {
            error="Select Country";
        }else if(currencyid==0)
        {
            error="Select Currency";
        }else if(port==0)
        {
            error="Select Final Destination";
        }else if(companyid==0)
        {
            error="Select Company";
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