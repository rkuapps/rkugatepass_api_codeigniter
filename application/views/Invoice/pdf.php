<?php 
$invoice_date=date_create_from_format('Y-m-d',$invoice->invoice_date);
		$invoice_date=date_format($invoice_date,'M d,Y');
?>
<!DOCTYPE html>
<html>

<head>
<style>
body
{
        margin: 0 auto;
    font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
    font-size: 0.875rem;
    font-weight: normal;
    line-height: 1.5;
    width:100%;
    
}
table
{
    width:100%;

}
table,td,th{
    
    border-spacing:0px;
    border: 1px solid #eee;
}
td,th{
    padding:6px;
}
    .heading
    {
        position: relative;
    height: 40px;
    line-height: 36px;
    background: #fafafa;
    color: #666;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid #e5e5e5;
    padding:0 10px;
    }
    .body{
        position: relative;
    border: 1px solid #e5e5e5;
    height:130px;
    padding:10px;
    font-size: 0.775rem;
    }



.text-right{
    text-align:right;
}
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


                        <table width="100%" style="border: solid 1px lightgray;font-size:16pxfont-family: Calibri;border-spacing: 2px;">
                            <tbody>
                                <tr>
                                    <td colspan="6" align="center" height="30" style="font-size:30px;"><b>INVOICE</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="heading print-td p-border-top p-border-bottom p-border-left p-border-right " align="center" width="40%" height="30" style="font-size:16px;"><b>Exporter Detail</b></td>
                                    <td colspan="2" class="heading print-td p-border-top p-border-bottom p-border-left p-border-right " align="center" width="30%" height="30" style="font-size:16px;"><b>Consignee Detail</b></td>
                                    <td colspan="2" class="heading print-td p-border-top p-border-bottom p-border-left p-border-right" align="center" width="30%" height="30" style="font-size:16px;"><b>Invoice Detail</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" valign="top" width="40%" style="border:solid 1px lightgray">
                                        <table cellspacing="0" style="border:none;">
                                            <tr>
                                                <td align="left" style="border:none;font-size:16px;padding-left: 5px;">
                                                    <b><?=$invoice->company_name?></b><br/>
                                                <?=nl2br($invoice->company_address)?></b>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td colspan="2" align="left" valign="top" width="30%" style="border:solid 1px lightgray">
                                        <table style="border:none;">
                                            <tr>
                                                <td align="left" style="border:none;font-size:16px;padding-left: 5px;">
                                                    <b><?=$invoice->customer_name?>(<?=$invoice->customer_short_name?>)</b><br/>
                                                    <?=nl2br($invoice->address);?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td colspan="2" align="right" valign="top" width="30%" style="border:solid 1px lightgray">
                                        <table style="border:none;">
                                            <tr>
                                                <td align="right" valign="top" style="border:none;font-size:16px;padding-right: 5px;">
                                                    Invoice No. & Dt.<br/>
                                                    <font color="#FF0000"><b><?=$invoice->invoiceno?></b></font>&nbsp;
                                                    <font color="#008800"><b><?=$invoice_date?></b></font><br/>
                                                    Order No. : <b><?=$ordernolist?></b>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            
                                <tr>
                                    <td colspan="6" align="center" height="30" style="font-size:16px;background-color:lightgrey;"><b>ITEM DETAILS</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="font-size:16pxfont-family: Calibri" cellspacing="0" cellpadding="0"  class="table-2" width="100%">
                            <thead>
                                <tr class="">
                                    <td class="print-td p-border-bottom p-border-left" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Marks & Nos.</td>
                                    <td class="print-td p-border-bottom p-border-left" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Order &nbsp;No</td>
                                    <td class="print-td p-border-bottom p-border-left" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Description of Goods</td>
                                    <td class="print-td p-border-bottom p-border-left" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">CH No.</td>
                                    <td class="print-td p-border-bottom p-border-left text-center" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Total Qty</td>
                                    <td class="print-td p-border-bottom p-border-left text-center" style="font-size:16px;font-weight: bolder; background-color:lightgrey;">Rate&nbsp; /&nbsp; Pcs</td>
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
                                   
                                    <td class="print-td p-border-bottom p-border-left">SE-<?=$post['case_no_from'] ?>&nbsp; To &nbsp;SE-<?=$post['case_no_to'] ?></td>
                                    <td class="print-td p-border-bottom p-border-left"><?=$post['orderno']?></td>
                                    <td class="print-td p-border-bottom p-border-left"><?=nl2br($post['description_of_good'])?></td>
                                    <td class="print-td p-border-bottom p-border-left"><?=$post['chno']?></td>
                                    <td class="print-td p-border-bottom p-border-left text-right"><?=$post['total_qty_in_pcs']?></td>
                                    <td class="print-td p-border-bottom p-border-left text-right"><?=round($post['rate_per_pcs_euro'],3)?></td>
                                    <td class="print-td p-border-bottom p-border-left p-border-right text-right"><?=custom_amount_formatter($post['total_amount'])?></td>
                                </tr>
                                            
                                            
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                          
                                                     <td class="print-td p-border-bottom p-border-left" style="font-weight: bolder;" colspan="4" align="center">Total <?=$total_carton?> Carton</td>
                                        <td class="print-td p-border-bottom p-border-left" style="font-weight: bolder;" colspan="2" align="right">Total  Amount:</td>
                                        <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($total_amt)?></td>

                                            </tr>
                                               <?php if(trim($invoice->description_of_fright)!="" || $invoice->fright_amount>0):?>
                                                <tr>
                                    
                                    <td class="print-td p-border-bottom p-border-left" style="font-weight: bolder;" colspan="6" align="right"><?=$invoice->description_of_fright?>:</td>
                                    <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($invoice->fright_amount)?></td>

                                            </tr>
                                            <?php endif;?>

                                                <tr>
                                    <td class="print-td p-border-bottom p-border-left" style="font-weight: bolder;" colspan="6" align="right">Grand Total:</td>
                                    <td class="print-td p-border-bottom p-border-left p-border-right" style="font-weight: bolder; background-color:lightgrey;" align="right"><?=custom_amount_formatter($total_amt+$invoice->fright_amount)?></td>

                                            </tr>
                                        </tfoot>
                        </table>
                        <table style="border-style: solid; border-width: 0 1px 1px 1px; border-color: lightgray; font-size:16pxfont-family: Calibri;border-spacing: 2px;font-size:16px" cellspacing="0" cellpadding="0" class="table-2" width="100%">
                            <tr>
                                <td class="print-td p-border-bottom p-border-left p-border-right p-border-top" colspan="2" style="font-size:16px line-height:1.5;">
                                <b>Narration: &nbsp; </b>SUPREME International having REX reg n?? INREX2408004781EC006 of the products covered by this document declares that, except where otherwise clearly indicated,these products are <br/>of India preferential origin according to rules of origin of the generalizad system of <br/>preferences of the european union and that the origin criterion met is "P".
                                </td>
                            </tr>
                            <tr>
                                                                <td class="print-td p-border-bottom p-border-left p-border-right p-border-top" style="font-size:14px;">
                                <?php 
                                   
                                ?>
                                   
                                    <b>GST Number :</b> <?=$invoice->company_gstno?>
                                </td>
                                <td class="print-td p-border-bottom p-border-left p-border-right p-border-top text-right " style="font-size:14px">
                                    <b>&nbsp;For <?=$invoice->company_name?></b><br/>
                                    Partner<br/><br/>
                                    <b>Signature & Date: </b> 
                                </td>
                            </tr>
                                <tr>
                                    <td colspan="2" class="heading" align="center" height="30" style="font-size:16px;"><b>We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</b></td>
                                </tr>
                        </table>

</body>

</html>