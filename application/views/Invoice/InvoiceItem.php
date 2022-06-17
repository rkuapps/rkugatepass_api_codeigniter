<?php     
  if ($id != "" && is_numeric($id)) {
      $val_invoiceno= StringRepair3($Invoice->invoiceno);
      
      
      $iseditable=$Invoice->iseditable;
      
          $packingid=$Invoice->packingid;
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
span
{
  cursor:pointer;
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

            <div class="row">
                    <div class="col-sm-12">
                
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
                                <li class="active">
                                    <a href="<?=base_url('Invoice/InvoiceItem/'.$id)?>" id="item-palleting-tab">Invoice Items</a>
                                </li>
                                <li>
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
                                <!-- PACKING LIST ITEMS FORM -->
                                <div class="col-lg-12 admin-form theme-primary">
                                    <table class="table table-hover table-bordered " style="width: 100%">
                                        <thead>
                                            <tr class="primary">
                                                <th>SE - <?=$customer_country?></th>
                                                <th>Description of Goods</th>
                                                <th>Order Number</th>
                                                <th>TOTAL QTY (IN PCS)</th>
                                                <th>Rate / Pcs (<i class='fa fa-inr'></i>)</th>
                                                <th>Amount (<i class='fa fa-inr'></i>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $total_carton=0;
                                            $total_amt=0;
                                            
                                            $i=0;
                                            $temp="";
                                            $temp_cr_range="";
                                            foreach ($InvoiceSub as $post) { 
                                                    $total_carton+=$post['total_carton'];
                                                    $total_amt+=$post['total_amount'];
                                                    $i++;
                                                   
                                                   
                                                ?>
                                                <tr>
                                             
                                                <td><?=$post['se_france']?></td>
                                               
                                                <td><?=nl2br($post['description_of_good'])?></td>
                                                <td><?=$post['orderno']?></td>
                                                <td><?=$post['total_qty_in_pcs']?></td>
                                                <td><?=$post['rate_per_pcs_euro']?></td>
                                                <td><?=$post['total_amount']?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        
                                            <tr class="primary">
                                                <th class="text-left" colspan="4">Total <?=$total_carton?> Carton </th>
                                                <th class="text-right">Total</th>
                                                <th><?=$total_amt?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                </div>
                <!-- end: .tray-center -->
            <?php $this->load->view('Includes/footer'); ?>    
            </section>
            </div>
            
            </div>
            <!-- End: Content -->

            

        </section>

                
    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->
    <?php $this->load->view('Includes/footerscript'); 
    $this->load->view('Includes/tablejs');
    ?>
    


    <script type="text/javascript">

    
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core    
            Core.init();

            // Init Demo JS  
            Demo.init();





        });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>