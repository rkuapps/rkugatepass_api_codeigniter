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

            #print2 {
                height: 120px;
            }
            body{
                height:auto !important;
            }

            .footer-total {}

            .footer-total td {
                height: 30px;
                padding: 0;
            }
        }

        table#item-data>tbody>tr.footer-total>td {
            height: 20px;
            padding: 5px 10px;
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
            padding: 2px 1px 1px 2px;
        }

        td,
        th,
        .table>thead>tr>th {
            font-size: 12px;
            padding: 4px;
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
            border: 1px solid #000000;
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
                                <span>JW CHALLAN </span>
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
                            <span class="glyphicon glyphicon-print"></span> Challan No. - <?= $challandetail->challan_no ?></span>
                        <div class="panel-header-menu pull-right mr10">
                            <button type="button" class="btn btn-xs btn-primary btn-gradient mr5" onClick="javascript:window.print()">
                                <i class="fa fa-print fs13"></i> Print Challan</button>
                        </div>
                    </div>
                    <div class="panel-body p20" id="invoice-item">
                        <div class="row">
                            <table style='width:100%;'>
                                <tr>
                                    <td>
                                        <h3 class="m5 mt10">JOBWORK CHALLAN <small class='pull-right' style='padding-right:5px'>__ Original/ __ Duplicate/ __ Triplicate</small></h3>
                                    </td>
                                </tr>
                            </table>
                            <table style='width:100%; margin-top:5px' id="print2">
                                <tr>
                                    <td style="line-height:15px; padding-left:10px; width:60%; ">
                                        Consignee: <b><?= $challandetail->company_name ?></b><br>
                                        <address>
                                            <?= nl2br($challandetail->address) ?>
                                        </address>
                                        State : <?= $challandetail->state ?> (<?= $challandetail->state_code; ?>)<br>
                                        GSTIN No. : <b><?= $challandetail->gst_no ?></b>

                                    </td>
                                    <td style="line-height:20px; padding-left:10px; width:40%; vertical-align:top; ">

                                        <?php
                                        $challan_date = date_create_from_format('Y-m-d', $challandetail->challan_date);
                                        $challan_date = date_format($challan_date, 'd/m/Y');
                                        ?>
                                        Challan No : <strong><?= $challandetail->challan_no ?></strong>
                                        <span class="pull-right">Date : <?= $challan_date ?></span><br>
                                        Dispatched By : <?= $challandetail->dispatched_by ?><br>
                                        Cartoon/Bags : <?= $challandetail->bagscount; ?><br>
                                        Place of Supply : <?= $challandetail->place_to_supply ?><br>
                                        Freight Terms : <?php if ($customerorder->freight_terms == 0) {
                                                            echo "Paid";
                                                        } else {
                                                            echo "TO Pay";
                                                        } ?>

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row" id="invoice-table">
                            <table class="table" style='margin-top:5px; height:492px' cellspacing="0" width="100%" id="item-data">
                                <thead style='width:100%'>
                                    <tr>
                                        <th class="text-center" style="width:3%">Sr.</th>
                                        <th class="text-center" style="width:32%">Particulars</th>
                                        <th class="text-center" style="width:5%">HSN Code</th>
                                        <th class="text-center" style="width:20%">Process</th>
                                        <th class="text-center" style="width:5%;">Bags</th>
                                        <th class="text-center" style="width:5%;">Weight</th>
                                        <th class="text-center" style="width:5%;">Rate</th>
                                        <th class="text-center" style="width:5%;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $totalamt = 0;
                                    $totalbags = 0;
                                    $totalweight = 0;
                                    $totalqty = 0;
                                    foreach ($itemList as $post) :
                                        $totalamt += $post->amount;
                                        $totalbags += $post->bags;
                                        $totalweight += $post->weight;
                                        $itemname = $post->jw_itemname;
                                    ?>
                                        <tr>
                                            <td class="text-center" style='border-bottom:none; border-top:none;'><b><?= ++$i ?></b></td>
                                            <td style='border-bottom:none; border-top:none;'><?= $itemname ?> </td>
                                            <td style='border-bottom:none; border-top:none;'><?= $post->hsn_code ?> </td>
                                            <td style='border-bottom:none; border-top:none;'><?= $post->process ?></td>
                                            <td class="pr10 text-center" style='border-bottom:none; border-top:none;'><?= $post->bags ?></td>
                                            <td class="pr10 text-center" style='border-bottom:none; border-top:none;'><?= $post->weight ?></td>
                                            <td class="pr10 text-center" style='border-bottom:none; border-top:none;'><?= $post->rate ?></td>
                                            <td class="pr10 text-center" style='border-bottom:none; border-top:none;'><?= $post->amount ?></td>
                                        </tr>
                                    <?php endforeach;
                                    while ($i < 8) {
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
                                            <td style='border-bottom:none; border-top:none;'>&nbsp;</td>
                                        </tr>
                                    <?php } ?>
                                    <tr class="footer-total">
                                        <td style='border-bottom:none; border-top:none;'>&nbsp;</td>
                                        <td style='border-bottom:none; border-top:none;'>&nbsp;</td>
                                        <td style='border-bottom:none; border-top:none;'>&nbsp;</td>
                                        <td style='border-bottom:none; border-top:2px solid #A9A9A9; '>Total</td>
                                        <td style='border-bottom:none;  border-top:2px solid #A9A9A9; text-align:center;'><?= $totalbags; ?></td>
                                        <td style='border-bottom:none; border-top:2px solid #A9A9A9; text-align:center;'><?= sprintf("%0.3f", $totalweight); ?></td>
                                        <td style='border-bottom:none; border-top:none;'>&nbsp;</td>
                                        <td style='border-bottom:none; border-top:none;'>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                            $cgst = ($totalamt * $challandetail->cgst) / 100;
                            $sgst = ($totalamt * $challandetail->sgst) / 100;
                            $grandtotal = $totalamt + $cgst + $sgst;
                            ?>
                            <table cellpadding="0" style='margin-top:5px' cellspacing="0" width="100%">
                                <tr>
                                    <td style="width:65%;" valign='top' rowspan='5' class="b-top b-right b-left b-bottom">
                                        Amount In words : <br>
                                        <?= getIndianCurrencyInWord(round($grandtotal)) ?>
                                        <br><br><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom:none;" class="text-right" colspan=2>Total</td>
                                    <td style="border-bottom:none;" class="text-right">
                                        <?= custom_amount_formatter((float) $totalamt) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>CGST <?= $challandetail->cgst ?>%</td>
                                    <td style="border-bottom:none; border-top:none;" class="text-right" colspan=3>
                                        <?= custom_amount_formatter((float)$cgst) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>SGST <?= $challandetail->sgst ?>%</td>
                                    <td style="border-bottom:none; border-top:none;" class="text-right" colspan=3>
                                        <?= custom_amount_formatter((float)$sgst) ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border-bottom:none; border-top:none;" class="text-right" colspan=2>Grand Total</td>
                                    <td style="border-bottom:none; border-top:none;" class="text-right" colspan=3><b><?= custom_amount_formatter($grandtotal) ?></b>
                                    </td>
                                </tr>
                            </table>
                            <table cellpadding="0" cellspacing="0" style="width: 100%; margin-top:5px">
                                <tr>
                                    <td style="width: 65%; font-size:12px">
                                        <strong>Terms & Conditions:</strong>
                                        <ol style='padding-inline-start:30px !important;' class="mbn">
                                            <li>Goods Material Should Be Of 100 % Quality.</li>
                                            <li>Material Shall Be Delivered Within Stipulated Delivery Time.</li>
                                            <li>Material Should Not Be Accepted Without Test Report & Job Work Challan.</li>
                                            <li>Subject To Jamnagar Jurisdiction Only.</li>
                                        </ol>
                                    </td>
                                    <td valign='top'>
                                        <b class="pull-right mr10">For, Supreme Industrial Fasteners</b>
                                        <br><br><br><br>
                                        <span class="pull-right mr10"><b>Partner</b></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End: Content -->
            <?php $this->load->view('Includes/footer'); ?>

        </section>
    </div>
    <!-- End: Main -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <!-- Datatables -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <?php $this->load->view('Includes/footerscript');
    ?>
    <!-- END: PAGE SCRIPTS -->
</body>

</html>