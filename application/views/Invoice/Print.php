<?php 
	$date = date_create($invoiceprint->invoice_date);
    $invoicedate = date_format($date,'d-m-Y');
?>
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
                    margin-top: 75px;
                    font-size: 12px;
                }
				#print2{
					height:140px;
				}
				.print:last-child {
					 page-break-after: auto;
				}
                html,body {
                    height:auto !important;
                    border: 1px solid white;
                    page-break-after: avoid !important;
                    page-break-before: avoid !important;
                }
                .print-display-none,.print-display-none * {
                    display: none !important;
                }
                .print-visibility-hide,.print-visibility-hide * {
                    visibility: hidden !important;
                }
                .printme,.printme * {
                    visibility: visible !important;
                }
                .printme {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }
            
            #top {
                vertical-align: top;
            }
            
            #bot {
                vertical-align: bottom;
            }
            
            body {
                margin: 0 auto;
                font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.2;
                width: 100%;
            }
            
            .table>thead>tr>td,.table>tbody>tr>td,.table>tfoot>tr>td {
                padding: 4px;
                line-height: 1.49;
                vertical-align: top;
                border-top: 2px solid #A9A9A9;
                border-bottom: 2px solid #A9A9A9;
            }
            
            .page {
                padding: 10mm;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
            
            table {
                width: 100%;
            }
            table,td,th,.table>thead>tr>th {
                border-spacing: 0px;
                border: 2px solid #A9A9A9;
                padding: 2px 1px 1px 2px;
            }
            td,th,.table>thead>tr>th {
                font-size: 12px;
                padding: 4px;
            }
            .t-table {
                border: 1px solid black;
                height: 300px;
                border-collapse: collapse;
            }
            .heading {
                position: relative;
                height: 40px;
                line-height: 36px;
                background: #fafafa;
                color: #666;
                font-size: 13px;
                font-weight: 600;
                border: 1px solid #A9A9A9;
                padding: 0 10px;
            }
            
            .body {
                position: relative;
                height: 130px;
                padding: 6px;
                font-size: 0.775rem;
            }
            
            .panel {
                margin-bottom: 5px;
            }
            
            .text-right {
                text-align: right;
            }
            
            .panel-header {
                position: relative;
                line-height: 36px;
                background: #fafafa;
                color: #666;
                font-size: 13px;
                font-weight: 600;
                border: 1px solid #e5e5e5;
                padding: 0 8px;
                border-bottom: 1px solid transparent;
                border-top-right-radius: 1px;
                border-top-left-radius: 1px;
            }
        </style>
</head>

<body class="invoice-page sb-l-m sb-r-c">
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
                                <span>Invoice </span>
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
							Invoice No. - <?=$invoiceprint->invoiceno?>
						</span>
						<div class="panel-header-menu pull-right mr10">
							<button type="button" class="btn btn-xs btn-primary btn-gradient mr5" onClick="javascript:window.print()">
							<i class="fa fa-print fs13"></i> Print Invoice</button>
						</div>
                    </div>
                    <div class="panel-body p20" id="invoice-item">
                        <div class="row">
                            <table style='width:100%;'>
                                <tr>
                                    <td><span><h3 style='margin-top:10px; margin-bottom:5px '>TAX INVOICE <small class='pull-right' style='padding-right:5px'>__ Original/ __ Duplicate/ __ Triplicate</small></h3></span>
                                    </td>
                                </tr>
                            </table>
                            <table style='width:100%; margin-top:5px;' id="print2">
                                <tr>
                                    <td style="line-height:15px; padding-left:10px; width:60%;"> Buyer : <strong><?=$invoiceprint->customer_name?></strong><br>
                                        <address>
											<?= nl2br($invoiceprint->address)?>
										</address> State : <?= $invoiceprint->state?> (<?= $invoiceprint->state_code; ?>)<br> GSTIN No. : <b><?=$invoiceprint->gst_no?></b> <br>
                                    </td>
                                    <td style="line-height:17px; padding-left:10px; width:40%">
                                        Invoice No. : <strong><?=$invoiceprint->invoiceno?></strong><span class="pull-right" style="margin-right:20px;">Dt : <?= $invoicedate; ?></span><br>
                                        <!-- Invoice No. : 20-21/2445 Dt.:09/03/2021 -->
                                        Dispatched By :
                                        <?=$invoiceprint->dispatched_by?><br> L.R.No. :
										<?=$invoiceprint->lr_number?><br> Place of Supply :
										<?=$invoiceprint->place_supply?><br> Cartoon/Bags : <?= $invoiceprint->bags; ?><br> PO No. :
										<?=$invoiceprint->po_number?><br> Payment Terms :
										<?=$invoiceprint->payment?><br>
										<!-- <abbr title="Phone">P:</abbr> (123) 456-7890 -->
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row" id="invoice-table">
                            <!-- <table class="table table-bordered">
                                <td colspan="2">
                                    <spem>Dear Sir,</spem><br>
                                    <spem>Please find Ordered item below and dispatch it as earliest</spem>
                                </td>
                            </table> -->
                            <table class="table" style='margin-top:5px; height:380px'>
                                <thead>
                                    <tr>
                                        <th style=' text-align: center; width:3%;'>NO</th>
                                        <th style=' text-align: center; width:57%;'>Particulars</th>
                                        <th style=' text-align: center; width:8%;'>HSN Code</th>
                                        <th style=' text-align: center; width:7%;'>Weight</th>
                                        <th style=' text-align: center; width:8%;'>Quantity</th>
                                        <th style=' text-align: center; width:7%;'>Rate</th>
                                        <th style=' text-align: right; width:10%;'>Amount Rs.</th>
                                        <!-- <th>Price In INR</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i=0;
                                        $totalamt=0;
                                        $totalqty=0;
                                        foreach($itemPrint as $post): 
                                            $totalamt+=$post->amount;
                                            $fweight+=$post->weight;
                                            $ratetype = "Pc";
                                            if($post->rate_type == 1){
                                                $ratetype = "Kg";
                                            }
                                        ?>
                                    <tr class='removeborder'>
                                        <td style='border-bottom:none; border-top:none; text-align: center;'><b><?=++$i?></b></td>
                                        <td style='border-bottom:none; border-top:none'>
                                            <?= $post->item_name ?> 
                                            <?php if($post->unique_no!="") echo "(",$post->unique_no,")";?></td>
                                        <td style='border-bottom:none; border-top:none; text-align: center;'>
                                            <?= $post->hsn_code ?>
                                        </td>
                                        <td style='border-bottom:none; border-top:none; text-align: center;'>
                                            <?= $post->weight ?>
                                        </td>
                                        <td style='border-bottom:none; border-top:none; text-align:center;'>
                                            <?= $post->qty ?>
                                        </td>
                                        <td style='border-bottom:none; border-top:none; text-align:center;'>
                                            <?php
												if($post->rate_type==1){
													echo sprintf("%.2f",$post->rate),"/".$ratetype;
												}else{
													echo $post->rate."/".$ratetype; 
												}
											?>
                                        </td>
                                        <td class="pr10 text-right" style='border-bottom:none; border-top:none'>
                                            <?= $post->amount ?>
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
                                        <td style='border-bottom:none; border-top:none;'>&nbsp;</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <!-- <td><?php //(float)$post->amount." ".$post->symbol?></td>
                                            <td class="pr10 text-right"><?php //(float)$post->total." ".$post->symbol?></td> -->
                                        <td style='border-bottom:none; border-top:none;'></td>
                                        <td style='border-bottom:none; border-top:none;'></td>
                                        <td class="text-center"><b>Total</b></td>
                                        <td class="text-center"><b><?= sprintf("%0.3f",$fweight)?></b></td>
                                        <td style='border-bottom:none; border-top:none;'></td>
                                        <td style='border-bottom:none; border-top:none;'></td>
                                        <td style='border-bottom:none; border-top:none;'></td>
                                    </tr>
                                </tfoot>
                            </table>
						<?php
							$gtotal=$totalamt+$invoiceprint->fright_amount;
								$cgst=($gtotal*$invoiceprint->cgst)/100;
								$sgst=($gtotal*$invoiceprint->sgst)/100;
								$igst=($gtotal*$invoiceprint->igst)/100;
								if($cgst>0)
								{
									$grandtotal=$gtotal+$cgst+$sgst;
								}
								else{
									$grandtotal=$gtotal+$igst;
								}

                                $tcs = 0;
								if($invoiceprint->tcs>0){
									$tcs=($grandtotal*$invoiceprint->tcs)/100;
									$grandtotal+=$tcs;
								}

                                $intVal = intval($grandtotal);
								if ($grandtotal - $intVal <= .50) {
										$roundof = $grandtotal - $intVal;
										$roundof = 0 - $roundof;
										$grandtotal = floor($grandtotal);
								}else{
										$roundof = $grandtotal - $intVal;
										$roundof = 1 - $roundof;
										$grandtotal = ceil($grandtotal); 
								}

								?>
							<table cellpadding="0" border="1" style='margin-top:5px' cellspacing="0" width="100%" id="item-data">
								<tr>
									<td style="width:60%;" valign='top' rowspan='7' class="b-top b-right b-left b-bottom">
										Amount In words : <br>
										<?= getIndianCurrencyInWord(round($grandtotal))?>
											<br><br><br><br>
									</td>
								</tr>
								<tr>
									<td style="border-bottom:none;" class="text-right" colspan=2>Total</td>
									<td style="border-bottom:none;" class="text-right">
										<?=custom_amount_formatter((float)$totalamt)?>
									</td>
								</tr>
								<tr>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>Plating/Packing/Fwdg. Rs.</td>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=3>
										<?=custom_amount_formatter((float)$invoiceprint->fright_amount) ?>
									</td>
								</tr>
								<tr>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>CGST <?= $invoiceprint->cgst; ?>%</td>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=3>
										<?=custom_amount_formatter((float)$cgst)?>
									</td>
								</tr>
								<tr>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>SGST <?= $invoiceprint->sgst; ?>%</td>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=3>
										<?=custom_amount_formatter((float)$sgst)?>
									</td>
								</tr>
								<tr>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>IGST <?= $invoiceprint->igst; ?>%</td>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=3>
										<?=custom_amount_formatter((float)$igst)?>
									</td>
								</tr>
								<tr>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>TCS</td>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=3>
										<?=custom_amount_formatter((float)$tcs)?>
									</td>
								</tr>
								
								<tr>
									<td rowspan="3" style="width:60%;">
										<li style="list-style-type:none;"> <b>Our Banker :</b> ICICI Branch Dared,Jamnagar</li>
										<li style="list-style-type:none;"> <b>A/c. No. :</b> 263105000538 <b>IFSC Code :</b> ICIC0002631</li>
									</td>
								</tr>
								<tr>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>Round Off</td>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=3>
										<?=custom_amount_formatter((float)$roundof)?>
									</td>
								</tr>
								<tr>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>Grand Total</td>
									<td style="border-bottom:none; border-top:none;" class="text-right" colspan=3><b><?=custom_amount_formatter($grandtotal)?></b>
									</td>
								</tr>
							</table>
							<table cellpadding="0" border='1' cellspacing="0" style="width: 100%; margin-top:5px">
								<tr>
									<td style="width: 65%; font-size:12px">
										<strong>Terms & Conditions:</strong>
										<ol style='padding-inline-start:30px !important;'>
											<li>Goods Once Sold, You Shall Check The Material in 20 Days & Inform Us. There After Our Responsibility Ceases.</li>
											<li>Our Responsibility Ceases Once Goods are Handed Over to Transport Company / Carriers.</li>
							 				<li>Interest @18% Will be Charged After Due Date</li>
											<li>Subject to Jamnagar Jurisdiction Only.</li>
										</ol>
									</td>
									<td valign='top'>
										<p style='text-align:right; margin-right:20px;'>
											<b>For, Supreme Industrial Fasteners</b></p><br><br><br><br>
										<p style='text-align:right; margin-right:20px;'><b>Partner</b></p>
									</td>
								</tr>
							</table>
						</div>
                    </div>
                </div>
            </section>
            <?php $this->load->view('Includes/footer');?>
        </section>
    </div>
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
</body>

</html>