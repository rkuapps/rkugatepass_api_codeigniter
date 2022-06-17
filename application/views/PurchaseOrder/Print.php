<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');    
    ?>
        <style>
            @media print {
                #content-footer {
                    display: none
                }
                #content {
                    margin-top: 80px;
					font-size: 12px;
                }
            }
            
            body {
                margin: 0 auto;
                font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.5;
                width: 100%;
                height:auto !important;
            }
            
            .table>thead>tr>td,
            .table>tbody>tr>td,
            .table>tfoot>tr>td {
                padding: 4px;
                line-height: 1.49;
                vertical-align: top;
                border-top: 1px solid #A9A9A9;
                border-bottom: 1px solid #A9A9A9;
            }
            
            table {
                width: 100%;
            }
            
            table,
            td,
            th,
            .table>thead>tr>th {
                border-spacing: 0px;
                border: 2px solid #A9A9A9;
            }
            
            td,
            th {
                padding: 6px;
            }
            
            .heading {
                position: relative;
                height: 40px;
                line-height: 36px;
                background: #fafafa;
                color: #A9A9A9;
                font-size: 13px;
                font-weight: 600;
                border: 1px solid #e5e5e5;
                padding: 0 10px;
            }
            
            .body {
                position: relative;
                border: 1px solid #e5e5e5;
                height: 130px;
                padding: 10px;
                font-size: 0.775rem;
            }
            
            .panel {
                margin-bottom: 5px;
            }
            
            .text-right {
                text-align: right;
            }
        </style>
</head>

<body class="invoice-page sb-l-m">
    <!-- Start: Main -->
    <div id="main">
        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">
            <!-- Start: Topbar -->
            <header id="topbar" class="ph10">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="packing_list_management.php">
                                <span>Purchase Order </span>
                            </a>
                        </li>
                    </ol>
                </div>
            </header>
            <!-- End: Topbar -->
            <!-- Begin: Content -->
            <section id="content" class="">
                <div class="panel invoice-panel">
                    <div class="panel-heading">
                        <span class="panel-title">
                            <span class="glyphicon glyphicon-print"></span> 
							PO No. - <?=$customerorder->ponumber?>
						</span>
						<div class="panel-header-menu pull-right mr10">
							<button type="button" class="btn btn-xs btn-primary btn-gradient mr5" onClick="javascript:window.print()">
							<i class="fa fa-print fs13"></i>  Print Order</button>
                            <a href="<?= base_url('PurchaseOrder/Pdf/'.$id); ?>" target="_blank" class="btn btn-xs btn-primary btn-gradient mr5">
                                <i class="fa fa-file fs13"></i> Order PDF</a>
						</div>
                    </div>
                    <div class="panel-body p20" id="invoice-item">
                        <div class="row">
                            <table style='width:100%;'>
                                <tr>
                                    <td align='center'>
                                        <h3 style='margin-top:10px; margin-bottom:5px'><b>PURCHASE ORDER</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table style='width:100%; margin-top:5px'>
                                <tr>
                                    <td style="line-height:15px; vertical-align:top; padding-left:10px; width:60%; ">
                                        Supplier : <strong><?=$customerorder->customer_name?></strong> <br>
                                        <address>
										<?=nl2br($customerorder->address)?>
										</address><br>
										State : <?= $customerorder->state_name?> (<?= $customerorder->state; ?>)<br> GSTIN No. : <b><?=$customerorder->gst_no?></b>
                                    </td>
                                    <td style="line-height:22px; vertical-align:top; padding-left:10px; width:40%; ">
                                        <p style="margin-bottom:0px;">
                                            <strong>PO No. : <?=$customerorder->ponumber?></strong>
                                            <br>
                                            <?php 
											$date=date_create_from_format('Y-m-d',$customerorder->po_date);
											$date=date_format($date,'d/m/Y');
										?> Date :
                                            <?= $date?> <br> Our GSTIN :
											<?=$companydetail->gst_no ?><br> Freight Terms : <?= $customerorder->freight; ?><br> Payment Terms : <?= $customerorder->pay_terms; ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row" id="invoice-table">
                            <table class="table" style="width: 100%; margin-top:5px">
                                <td colspan="2">
                                    <spem>Dear Sir,</spem><br>
                                    <spem>Please find Ordered item below and dispatch it as earliest</spem>
                                </td>
                            </table>
                            <table class="table" style="width: 100%; margin-top:5px; height:515px">
                                <thead>
                                    <tr>
                                        <th style='width:3%'>Sr No.</th>
                                        <th style='width:57%; text-align:center;'>Item</th>
                                        <th style='width:10%; text-align:center !important;'>HSN Code</th>
                                        <th style='width:10%; text-align:center !important;'>Qty</th>
                                        <th style='width:10%; text-align:center !important;'>Rate</th>
                                        <th class="pr10 text-center" style='width:10%'>Price</th>
                                        <!-- <th>Price In INR</th> -->
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								$i=0;
								$totalamt=0;
								$totalqty=0;
								foreach($subOrderList as $post): 
									$totalamt+=$post->total;
									$totalqty+=$post->qty;
									$itemname=$post->item_name." (".$post->unique_no.")";
                                    $item_unit= GENERAL_MEASUREMENT[$post->item_unit];
                                    ?>
                                    <tr>
                                        <td style='border-bottom:none; border-top:none;' class="text-center"><b><?=++$i?></b></td>
                                        <td style='border-bottom:none; border-top:none;'>
                                            <?=$itemname?>
                                            <?php 
                                            if($post->delivery_date != null){
                                                 $date= date_create_from_format('Y-m-d',$post->delivery_date);
                                                 echo " (Delivery Dt. ".date_format($date,'d/m/Y').")";
                                            }
                                            ?>
                                        </td>
                                        <td style='border-bottom:none; border-top:none; text-align:center;'>
                                            <?=$post->hsn_code?>
                                        </td>
                                        <td style='border-bottom:none; border-top:none;text-align:center;'>
                                            <?=(float)$post->qty?>
                                        </td>
                                        <td style='border-bottom:none; border-top:none;text-align:center;'>
                                            <?php
												echo sprintf("%.2f",$post->amount),"/".$item_unit;
												/*
												if($post->item_unit==1){
													echo sprintf("%.2f",$post->amount),"/".$item_unit;
												}else{
													echo $post->amount."/".$item_unit; 
												}
												*/
											?>
                                        </td>
                                        <td class="pr10 text-center" style='border-bottom:none; border-top:none;'>
                                            <?php echo sprintf("%.2f",$post->total)." ".$post->symbol?>
                                        </td>
                                    </tr>
								<?php endforeach; 
								 while($i<8){
									$i++;
								?>
									<tr>
										<td style='border-bottom:none; border-top:none;'>&nbsp;</td>
										<td style='border-bottom:none; border-top:none;'>&nbsp;</td>
										<td style='border-bottom:none; border-top:none;'>&nbsp;</td>
										<td style='border-bottom:none; border-top:none;'>&nbsp;</td>
										<td style='border-bottom:none; border-top:none;'>&nbsp;</td>
										<td style='border-bottom:none; border-top:none;'>&nbsp;</td>
									</tr>
								<?php } ?>
                                </tbody>
                                <?php
                                    $cgst=($totalamt*$customerorder->cgst)/100;
                                    $sgst=($totalamt*$customerorder->sgst)/100;
                                    $igst=($totalamt*$customerorder->igst)/100;
                                    if($cgst>0)
                                    {
                                        $grandtotal=$totalamt+$cgst+$sgst+$customerorder->freight;
                                    }
                                    else{
                                        $grandtotal=$totalamt+$igst+$customerorder->freight;
                                    }
                                    ?>
                                    <tfoot>
                                        <tr>
                                            <td style="border-top:2px solid #A9A9A9 !important;" class="text-right" colspan=3>Total</td>
                                            <td style="border-top:2px solid #A9A9A9 !important;" class="text-center">
                                                <?=(float)$totalqty?>
                                            </td>
                                            <td style="border-top:2px solid #A9A9A9 !important;"></td>
                                            <td style="border-top:2px solid #A9A9A9 !important;" class="text-center"><b><?=sprintf("%.2f",$totalamt)." ".$post->symbol?></b></td>
                                        </tr>
                                        <!-- <?php if($cgst>0){ ?>
                                    <tr>
                                    <th class="text-right" colspan=2>CGST</th>
                                   
                                    <th class="text-right" colspan=3><?=(float)$cgst." ".$post->symbol?></th>
                                    </tr>
                                    <tr>
                                    <th class="text-right" colspan=2>SGST</th>
                                  
                                    <th class="text-right" colspan=3><?=(float)$sgst." ".$post->symbol?></th>
                                    </tr>
                                    <?php }else{ ?>
                                    <tr>
                                    <th class="text-right" colspan=2>IGST</th>
                                   
                                    <th class="text-right" colspan=3><?=(float)$igst." ".$post->symbol?></th>
                                    </tr>
                                    <?php
                                    } ?> -->

                                    </tfoot>
                            </table>
                            <table cellpadding="0" border='1' cellspacing="0" style="width: 100%; margin-top:5px">
                                <tr>
                                    <td style="width: 60%; font-size:11px">
                                        <strong>Terms & Conditions:</strong>
                                        <ol style='padding-inline-start:20px !important;'>
                                            <li>Goods Should be of 100% Quality</li>
                                            <li>Subject to Jamnagar Jurisdiction Only.</li>
                                            <li>Material shall be Delivered Within stipulated delivery time . Otherwise we reserve the right for non-acceptance of material.
                                            </li>
                                            <li>Please mention our P.O.No. and Date in your invoice.</li>
                                        </ol>
                                    </td>
                                    <td valign='top'>
                                        <p style='text-align:right; margin-right:20px;'>
                                            <b>For, Supreme Industrial Fasteners</b></p><br><br><br>
                                        <p style='text-align:right; margin-right:20px;margin-bottom:0px;'><b>Authorized Signature</b></p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </section>
            <!-- End: Content -->
            <?php $this->load->view('Includes/footer');?>

        </section>
    </div>
    <!-- End: Main -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <!-- Datatables -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <?php $this->load->view('Includes/footerscript'); 
    
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