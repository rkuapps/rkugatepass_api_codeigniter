<?php 
$invoice_date=date_create_from_format('Y-m-d',$invoice->invoice_date);
		$invoice_date=date_format($invoice_date,'M d,Y');
       $Export=base_url()."Invoice/Export/2/".$id;
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
</style>    <style>
        @page {
            size: A4 portrait;
            margin: 1cm;
        }

        @media print {
            @page {
                margin: 0;
                size: A4 portrait;
            }

            body {
                margin: 1cm 0;
            }

            td.heading {
                background-color: #c4c4c4;
                -webkit-print-color-adjust: exact;
            }

            #content-footer {
                display: none !important;
            }

        }

        @media screen {
            td.heading {
                background-color: #c4c4c4;
            }
        }

        table {
            border-collapse: unset;
            border-spacing: 0;
        }

        .custno {
            width: 20%;
        }

        td.code {
            width: 36%;
        }

        td.srno {
            width: 1%;
        }

        td.bill {
            width: 27%;
        }

        td.paise {
            width: 6%;
        }

        td.rs {
            width: 8%;
        }

        td.maxdem {
            width: 18%;
        }

        td.meterno {
            width: 27%;
        }

        td.active {
            width: 20%;
            border-right: solid 1px grey;
        }

        td.reative {
            width: 20%;
            border-right: solid 1px grey;
        }

        td.imp {
            width: 15%;
            border-right: solid 1px grey;
        }

        td.exp {
            width: 15%;

        }

        td.nov {
            width: 33.33%;
            border-right: solid 1px grey;
        }

        td.sep {
            width: 33.33%;
            border-right: solid 1px grey;
        }

        td.sign {
            padding-right: 2% !important;
        }

        td.sign2 {
            padding-right: 3%;
        }



        td.tarrif {
            border-right: solid 1px gray;
            border-bottom: solid 1px gray;
        }

        td.nrgp {
            border-right: solid 1px gray;
        }

        td.sd {
            border-bottom: solid 1px gray;
        }

        td.sd1 {
            border-bottom: solid 1px gray;
        }

        td.tarrif {
            width: 15%;
        }

        td.code.tarrif {
            width: 20%;
        }

        td.tarrif.kv {
            width: 15%;
        }

        td.tarrif.seasonal {
            width: 17%;
        }

        td.tarrif.days {
            width: 10.5%;
        }

        td.sd.ssd {
            width: 11%;
        }

        td.sd1.num3 {
            width: 11%;
        }

        td.nrgp.num2 {
            width: 10.5%;
        }

        td.nrgp.ss1 {
            width: 17%;
        }

        td.nrgp.num {
            width: 15%;
        }

        td.nrgp.b {
            width: 20%;
        }

        td.nrgp {
            width: 15%;
        }

        .print-td {
            line-height: 2;
            padding-left: 8px;
            padding-right: 8px;
        }

        .print-td.p-border-left {
            border-left: solid 1px lightgray;
        }

        .print-td.p-border-right {
            border-right: solid 1px lightgray;
        }

        .print-td.p-border-top {
            border-top: solid 1px lightgray;
        }

        .print-td.p-border-bottom {
            border-bottom: solid 1px lightgray;
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
                            <a href="#">
                                <span>Invoice</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="topbar-right">
                                  <?php if (check_role_assigned('invoice', 'view')) {?>
                    <a href="<?=$Export?>" class="btn btn-sm btn-default btn-gradient mr5">
                                <i class="fa fa-file-excel-o fs13"></i> Export Custom Invoice
                    
                  <?php }?>
                  <a href="<?=$pdf?>" class="btn btn-sm btn-default btn-gradient mr5" target="_blank">
                                <i class="fa fa-print fs13"></i> Print
                            </a>
                </div>
            </header>
            <!-- End: Topbar -->

            <div class="row">
                    <div class="col-sm-12">
                
    <!-- Begin: Content -->
            <section id="content" class="">

                <div class="panel invoice-panel">
                    <div class="panel-body " style="padding: 10px" id="invoice-item">

                        <table width="100%" style="border: solid 1px lightgray;font-size:16pxfont-family: Calibri;border-spacing: 2px;">
                            <tbody>
                                <tr>
                                    <td colspan="16" align="center" height="30" style="font-size:30px;"><b> CUSTOM INVOICE</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="heading print-td p-border-top p-border-bottom p-border-left p-border-right " align="center" height="30" style="font-size:16px;"><b>Exporter Detail</b></td>
                                    <td colspan="2" class="heading print-td p-border-top p-border-bottom p-border-left p-border-right " align="center" height="30" style="font-size:16px;"><b>Consignee Detail</b></td>
                                    <td colspan="2" class="heading print-td p-border-top p-border-bottom p-border-left p-border-right" align="center" height="30" style="font-size:16px;"><b>Invoice Detail</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" valign="top" width="40%" style="border:solid 1px lightgray">
                                        <table cellspacing=0>
                                            <tr>
                                                <td align="left" style="font-size:16px;padding-left: 5px;">
                                                    <b><?=$invoice->company_name?></b></br>
                                                <?=nl2br($invoice->company_address)?></b>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td colspan="2" align="left" valign="top" width="30%" style="border:solid 1px lightgray">
                                        <table>
                                            <tr>
                                                <td align="left" style="font-size:16px;padding-left: 5px;">
                                                    <b><?=$invoice->customer_name?>(<?=$invoice->customer_short_name?>)</b></br>
                                                    <?=nl2br($invoice->address);?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td colspan="2" align="right" valign="top" width="30%" style="border:solid 1px lightgray">
                                        <table>
                                            <tr>
                                                <td align="right" valign="top" style="font-size:16px;padding-right: 5px;">
                                                    Invoice No. & Dt.</br>
                                                    <font color="#FF0000"><b><?=$invoice->invoiceno?></b></font>
                                                    <font color="#008800"><b><?=$invoice_date?></b></font></br>
                                                    Order No. : <b><?=$ordernolist?></b>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="16" align="center" height="30" style="font-size:16px;background-color:lightgrey;"><b>OTHER DETAILS</b></td>
                                </tr>
                                <tr>
                                    <td valign="top" width="16.6%" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Place of pre carrier</b></br>
                                        <?=$invoice->place_for_pre_carrier?></td>
                                    <td valign="top" width="16.6%" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Pre Carriage By</b></br>
                                        <?=$invoice->pre_carriage_by ?></td>
                                    <td valign="top" width="16.6%" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Country of Origin</b></br>
                                        <?=$invoice->company_country_name?></td>
                                    <td valign="top" width="16.6%" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Port of Loading</b></br>
                                        <?=$invoice->port_name?></td>
                                    <td valign="top" width="16.6%" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Final Country</b></br>
                                        <?=$invoice->country_name?></td>
                                    <td valign="top" width="16.6%" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Port of Discharge</b></br>
                                        <?=$invoice->discharge_name?></td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="2" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Terms of Payment : </b></br><?=$invoice->term_of_payment?>
                                    </td>
                                    <td valign="top" colspan="2" style="border:solid 1px lightgray;padding-left: 5px;">
                                    </td>
                                    <td valign="top" colspan="2" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Final Destination</b></br>
                                        <?=$invoice->country_name?></br>
                                    </td>

                                </tr>
                                <tr>
                                    <td valign="top" colspan="3" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px"> Item Category : </b></br><?=wordwrap($item_categorylist,50,"<br>");?>
                                    </td>
                                    <td valign="top" colspan="3" style="border:solid 1px lightgray;padding-left: 5px;">
                                        <b style="font-size:16px">CET / CTH :</b><br /> 85389000
                                    </td>
                                   

                                </tr>
                            
                                <tr>
                                    <td colspan="16" align="center" height="30" style="font-size:16px;background-color:lightgrey;"><b>ITEM DETAILS</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="font-size:16pxfont-family: Calibri" cellspacing="0" cellpadding="0"  class="table-2" width="100%">
                            <thead>
                                <tr class="">
                                    <td class="print-td p-border-bottom p-border-left" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Marks & Nos.</td>
                                    <td class="print-td p-border-bottom p-border-left" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Order No</td>
                                    <td class="print-td p-border-bottom p-border-left" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Description of Goods</td>
                                    <td class="print-td p-border-bottom p-border-left" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">CH No.</td>
                                    <td class="print-td p-border-bottom p-border-left text-center" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Total Qty</td>
                                    <td class="print-td p-border-bottom p-border-left text-center" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Rate / Pcs</td>
                                    <td class="print-td p-border-bottom p-border-left p-border-right text-center" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Total Amount</td>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php 
                                            $total_carton=0;
                                            $total_amt=0;
                                            
                                            $i=0;
                                            
                                            $temp_cr_range="";
                                            foreach ($InvoiceSub as $post) { 
                                                    $total_carton+=$post['total_carton'];
                                                    $total_amt+=$post['total_amount'];
                                                    $i++;
                                                      
                                                ?>
                                                <tr>
                                    <?php if($temp_cr_range=="" || $temp_cr_range!=$post['carton_range']){ 
                                                    $temp_cr_range=$post['carton_range'];
                                        ?>
                                        <td  rowspan="<?=$post['same_carton_count']?>" class="print-td p-border-bottom p-border-left"><?=$post['se_france']?></td>
                                    <?php }?>
                                    <td class="print-td p-border-bottom p-border-left"><?=$post['orderno']?></td>
                                    <td class="print-td p-border-bottom p-border-left"><?=nl2br($post['description_of_good'])?></td>
                                    <td class="print-td p-border-bottom p-border-left"><?=$post['chno']?></td>
                                    <td class="print-td p-border-bottom p-border-left text-right"><?=$post['total_qty_in_pcs']?></td>
                                    <td class="print-td p-border-bottom p-border-left text-right"><?=$post['rate_per_pcs_euro']." ".$invoice->symbol?></td>
                                    <td class="print-td p-border-bottom p-border-left p-border-right text-right"><?=custom_amount_formatter($post['total_amount'])." ".$invoice->symbol?></td>
                                </tr>
                                            
                                            
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <?php 
                                        $total_pellets=str_pad(intval($total_pellets), 2, '0', STR_PAD_LEFT);
                                        ?>
                                            <td class="print-td p-border-bottom p-border-left" style="font-weight: bolder;" colspan="4" align="center">Total <?=$total_carton?> Carton in <?=$total_pellets?> Pallet(s) (SE-01 to SE-<?=$total_pellets?>)</td>
                                    <td class="print-td p-border-bottom p-border-left" style="font-weight: bolder;" colspan="2" align="right">Total <?=$invoice->incoterm?> <?=$invoice->short_name?>:</td>
                                    <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($total_amt)." ".$invoice->symbol?></td>

                                            </tr>
                                            <?php  if($total_ms_qty>0){
                                                ?>
                                            
                                               <tr>
                                                <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder;" colspan="6" align="right">Above SETS are comprising MS Screw <?=$total_ms_qty?>  Kgs  <?=$invoice->incoterm?> <?=$invoice->short_name?>:</td>
                                                <td class="print-td p-border-bottom  p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($total_ms_amount)." ".$invoice->symbol ?></td>
                                            </tr>
                                            <?php $total_amt+=$total_ms_amount;?>
                                            <tr>
                                                <td class="print-td p-border-bottom p-border-left" style="font-weight: bolder;" colspan="6" align="right">Total <?=$invoice->incoterm?> <?=$invoice->short_name?>:</td>
                                    <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($total_amt)." ".$invoice->symbol?></td>
                                            </tr>
                                            <?php }?>
                                                <tr>
                                                <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder;" colspan="6" align="right">1 <?=$invoice->short_name?> = INR <?=(float)$invoice->custom_exchange_rate?> Taxable Invoice Amt Rs</td>
                                                <?php 
                                                    $amount_in_inr=$total_amt*$invoice->custom_exchange_rate;
                                                    $IGST18=($amount_in_inr*18)/100;
                                                ?>
                                                <td class="print-td p-border-bottom  p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($amount_in_inr)." ".$invoice->inr_symbol ?></td>
                                            </tr>
                                                                                            <tr>
                                                <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder;" colspan="6" align="right">IGST @ 18% Rs</td>
                                                <td class="print-td p-border-bottom  p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($IGST18)." ".$invoice->inr_symbol?></td>
                                            </tr>

                                                <tr>
                                    <td class="print-td p-border-bottom p-border-left" style="font-weight: bolder;" colspan="6" align="right">Total Invoice Amt. Rs </td>
                                    <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($amount_in_inr+$IGST18)." ".$invoice->inr_symbol?></td>

                                            </tr>
                                        </tfoot>
                        </table>
                        <table style="border-style: solid; border-width: 0 1px 1px 1px; border-color: lightgray; font-size:16pxfont-family: Calibri;border-spacing: 2px;font-size:16px" cellspacing="0" cellpadding="0" class="table-2" width="100%">
                            <tr>
                                <td class="print-td p-border-bottom p-border-left p-border-right p-border-top" colspan="2" style="font-size:16px line-height:1.5;">
                                <b>Narration: </b> WE INTEND TO CLAIM REWARDS UNDER MERCHANDISE EXPORTS FROM INDIA SCHEME (MEIS)
                                </td>
                            </tr>
                            <tr>
                                <td class="print-td p-border-bottom p-border-left p-border-right p-border-top" style="font-size:14px;">
                                <?php 
                                    $iec_date=date_create_from_format('Y-m-d',$invoice->iec_date);
                                    $iec_date=date_format($iec_date,'d-m-Y');
                                ?>
                                    <b>IEC Code No. :</b> <?=$invoice->iec_code?>, Dt. <?=$iec_date?><br />
                                    <b>ARN :</b> <?=$invoice->company_anr_no?><br />
                                    <b>GST Number :</b> <?=$invoice->company_gstno?>
                                </td>
                                <td class="print-td p-border-bottom p-border-left p-border-right p-border-top text-right " style="font-size:14px">
                                    <b>For <?=$invoice->company_name?></b></br>
                                    Partner</br></br>
                                    <b>Signature & Date: </b> 
                                </td>
                            </tr>
                                <tr>
                                    <td colspan="2" class="heading" align="center" height="30" style="font-size:16px;"><b>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</b></td>
                                </tr>
                        </table>
                    </div>
                </div>

            </section>
            <!-- End: Content -->
            </div>
            </div>
            

            <?php $this->load->view('Includes/footer'); ?>

        </section>

<div id='myModal' class='modal'>
                <div class="modal-dialog panel  panel-default panel-bordered top">
                    <div class="modal-content">
                        <div id='myModalContent'></div>
                    </div>
                </div>

            </div>
    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->
    <?php $this->load->view('Includes/footerscript'); 
    $this->load->view('Includes/tablejs');
    ?>
    



    <!-- END: PAGE SCRIPTS -->

</body>

</html>