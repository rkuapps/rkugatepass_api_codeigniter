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
                margin-top: 79px;
                font-size: 12px;
            }

            .print:last-child {
                page-break-after: auto;
            }

            html,
            body {
                height:auto !important;
                border: 1px solid white;
                page-break-after: avoid !important;
                page-break-before: avoid !important;
            }

            .print-display-none,
            .print-display-none * {
                display: none !important;
            }

            .print-visibility-hide,
            .print-visibility-hide * {
                visibility: hidden !important;
            }

            .printme,
            .printme * {
                visibility: visible !important;
            }

            .printme {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        .clearfix {
            clear: both;
        }

        body {
            margin: 0 auto;
            font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
            font-size: 12px;
            font-weight: normal;
            line-height: 1.5;
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
            padding: 5px;
        }

        .heading {
            position: relative;
            height: 40px;
            line-height: 36px;
            background: #fafafa;
            color: #666;
            font-size: 13px;
            font-weight: 600;
            padding: 0 10px;
        }

        .body {
            position: relative;
            height: 130px;
            padding: 10px;
            font-size: 0.775rem;
        }

        .panel {
            margin-bottom: 0px;
        }

        .text-right {
            text-align: right;
        }

        .panel-header {
            position: relative;
            height: 40px;
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

<body class="invoice-page sb-l-m">
    <!-- Start: Main -->
    <div id="main">
        <?php $this->load->view('Includes/hadernav');?>
        <?php $this->load->view('Includes/sidebar');?>
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">
            <!-- Start: Topbar -->
            <header id="topbar" class="ph10">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="packing_list_management.php">
                                <span>Quotation </span>
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
                            <span class="glyphicon glyphicon-print"></span> Quotation No. -
                            <?=$customerorder->quotationno?>
                        </span>
                        <div class="panel-header-menu pull-right mr10">
                            <button type="button" class="btn btn-xs btn-primary btn-gradient mr5" onClick="javascript:window.print()">
                                <i class="fa fa-print fs13"></i> Print Quotation</button>
                            <a href="<?=base_url('Quotations/Pdf/' . $id);?>" target="_blank" class="btn btn-xs btn-primary btn-gradient mr5">
                                <i class="fa fa-file fs13"></i> Quotation PDF</a>
                        </div>
                    </div>
                    <div class="panel-body p20" id="invoice-item">
                        <div class="row">
                            <table style='width:100%;'>
                                <tr>
                                    <td class="text-center">
                                        <h3 class="m5"><b>QUOTATION</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table style='width:100%; margin-top:5px;height:100px;'>
                                <tr>
                                    <td style="line-height:17px; vertical-align:top; padding-left:10px; width:60%">
                                        Consignee : <b><?=$customerorder->consignee?></b><br>
                                        Customer : <b><?=$customerorder->customer_name?></b><br>
                                        <p style="margin-bottom:0px;">
                                            <?=nl2br($customerorder->address)?>
                                            <br>
                                        </p>
                                    </td>
                                    <td style="line-height:18px; padding-left:10px; width:40%">
                                        <p style="margin-bottom:0px;">
                                            <?php $quotation_date = date_create_from_format('Y-m-d', $customerorder->quotation_date);
$quotation_date = date_format($quotation_date, 'd/m/Y');?>
                                            <strong>Quotation No : <?=$customerorder->quotationno?></strong><br> Date :
                                            <?=$quotation_date?><br> Against Form : N.A.<br> Insurance : N.A.<br> Freight Terms :
                                            <?php if ($customerorder->freight_terms == 0) {
    echo "Paid";
} else {
    echo "To Pay";
}?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row" id="invoice-table">
                            <table style='width:100%; margin-top:5px;'>
                                <td colspan="2">
                                    <span>Dear Sir,</span><br>
                                    <span>Thanks for your valued Inquiry. We are pleased to quote our best rate as under :</span>
                                </td>
                            </table>
							<div>
								<table class="table" border="1" style='margin-top:5px; height:310px;' cellspacing="0" width="100%">
									<thead style='width:100%'>
										<tr>
											<th  style="width:15px;">Sr.</th>
											<th class="text-center" style="width:90px;">Drg No</th>
											<th class="text-center">Item</th>
											<th class="text-center" style="width:150px;">Plating</th>
											<th class="text-center" style="width:50px;">MOQ</th>
											<th class="text-center" style="width:120px;">Rate</th>
										</tr>
									</thead>
									<tbody>
										<?php
$i = 0;
$totalamt = 0;
$totalqty = 0;
foreach ($subOrderList as $post):
    $totalamt += $post->amount;
    $itemname = $post->item_name;

    $item_unit = GENERAL_MEASUREMENT[$post->item_unit];

    ?>
												<tr>
													<td style='border-bottom:none; border-top:none;vertical-align:top;line-height: 14px;' class="text-center p5"><b><?=++$i?></b></td>
													<td style='border-bottom:none; border-top:none;vertical-align:top;line-height: 14px;' class="p5">
														<?=$post->unique_no?>
													</td>
													<td style='border-bottom:none; border-top:none;vertical-align:top;line-height: 14px;' class="p5">
														<?=$itemname?>
													</td>
													<td style='border-bottom:none; border-top:none;vertical-align:top;line-height: 14px;' class="text-center p5">
														<?=$post->platting?>
													</td>
													<td style='border-bottom:none; border-top:none;vertical-align:top;line-height: 14px;' class="text-center p5">
														<?=$post->moq?>
													</td>
													<td style='border-bottom:none; border-top:none;vertical-align:top;line-height: 14px;' class="text-center p5">
														<?php echo sprintf("%.2f", $post->rate) . " (" . $item_unit . ')' ?>
													</td>
												</tr>
											<?php endforeach;
while ($i < 6) {
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
										<?php }?>
									</tbody>
								</table>
							</div>
                            <table cellpadding="0" border="1" style='margin-top:5px; text-align:center;font-size:11px;' cellspacing="0">
                                <tfoot>
                                    <tr style="background-color: rgb(187, 187, 187); ">
                                        <th class=" b-right b-left b-bottom" style="width:5.5%; padding: 5px; text-align:center;">
                                            NO
                                        </th>
                                        <th class=" b-right b-bottom" style="width:10%;text-align:center;">Terms</th>
                                        <th colspan="3">Conditions</th>
                                    </tr>
                                    <tr style="vertical-align: top;">
                                        <td>1</td>
                                        <td>Delivery</td>
                                        <td colspan="3" class="b-bottom" style="text-align: left;">25-30 Days form the date of receipt of technically and commercially clear order. Qty may vary by +/-10%
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: top;">
                                        <td>2</td>
                                        <td>Packing</td>
                                        <td colspan="3" class="b-bottom" style="text-align: left;">Loose Packing
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: top;">
                                        <td>3</td>
                                        <td>Payment</td>
                                        <td colspan="3" class="b-bottom" style="text-align: left;">30 Day,Your bank charges to your account.
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: top;">
                                        <td>4</td>
                                        <td>Acceptance</td>
                                        <td colspan="3" class="b-bottom" style="text-align: left;">Your Order will be processed only on receipt of technically and commercially clear Purchase Order with applicable advance. The stated delivery period to commence form fulfillment of all the terms of our quotation.
                                            Rate prevailing at the time of acceptance will be applicable
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: top;">
                                        <td>5</td>
                                        <td>Validity</td>
                                        <td colspan="3" class=" b-bottom" style="text-align: left;">Because of highly fluctuating raw material prices offer valid till Today Only. Thereafter rate on the day of acceptance of order will be applicable
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: top;">
                                        <td class="b-right ">6</td>
                                        <td class="b-right "></td>
                                        <td colspan="3" style="text-align: left;">We will try our best to deliver prerfect material. But in an unfortunate incidence of deviation our liability will be limited to replcement of the material only Or we Will pay amount equivalent to rejection received.
                                            We Will not be responsible for any consequential losses.
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <table cellpadding="0" border="1" cellspacing="0" style="width: 100%; margin-top:5px">
                                <tr style="height: 10px;">
                                    <td style="vertical-align:top; border-right:0px;">
                                        Please favour us with your valued Order
                                    </td>
                                    <td style="border-left:0px;">
                                        <p style='text-align:right;'>
                                            <b>For, Supreme Industrial Fasteners</b>
                                        </p><br>
                                        <p style='text-align:right;margin-bottom:0px;'><b>Authorized Signature</b></p>
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
    <!-- END: PAGE SCRIPTS -->
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