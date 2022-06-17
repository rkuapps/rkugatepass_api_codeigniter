<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    ?>
    <style>
        .clearfix {
            clear: both;
        }

        b,
        strong {
            margin: 0 auto;
            font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
            font-size: 12px;
            font-weight: normal;
            line-height: 1.2;
        }

        body {
            margin: 0 auto;
            font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
            font-size: 12px;
            font-weight: normal;
            line-height: 1.2;
            background: #fff;
        }

        table {
            width: 100%;
        }

        table,
        td,
        th,
        .table>thead>tr>th {
            border-spacing: 0px;
            border: 1px solid #A9A9A9;
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

        .panel {
            margin-bottom: 0px;
        }

        /* Total Table width 630px */
        .tablebox {
            height: 505px;
            width: 100%;
        }

        .col1 {
            width: 30px;
        }

        .col2 {
            width: 310px;
        }

        .col3 {
            width: 60px;
        }

        .col4 {
            width: 50px;
        }

        .col5 {
            width: 80px;
        }

        .col6 {
            width: 80px;
        }

        #contentTable {
            width: 100%;
        }

        #contentTable table {
            border-width: 0px solid #fff;
        }

        #contentTable td+td {
            border-left: 1px solid #A9A9A9;
        }

        #contentTable td {
            border-top-width: 0px;
            border-bottom-width: 0px;
            vertical-align: text-top;
        }

        #contentTable th {
            border-bottom: 1px solid #A9A9A9;
        }
    </style>
</head>

<body class="invoice-page sb-l-m">
    <img src="<?= base_url('assets/img/letterhead_header.png'); ?>" style="width:100%; margin-bottom:5px;">
    <table style='width:100%;'>
        <tr>
            <td align='center'>
                <h2 style='margin-top:10px; margin-bottom:5px; font-weight:bold'>PURCHASE ORDER</h2>
            </td>
        </tr>
    </table>
    <table style='width:100%; margin-top:5px'>
        <tr>
            <td style="line-height:15px; vertical-align:top; padding-left:10px; width:60%; ">
                Supplier : <strong style="font-weight:bold;"><?= $customerorder->customer_name ?></strong> <br>
                <?= nl2br($customerorder->address) ?><br>
                State : <?= $customerorder->state_name ?> (<?= $customerorder->state; ?>)<br>
                GSTIN No. : <b style="font-weight:bold;"><?= $customerorder->gst_no ?></b>
            </td>
            <td style="line-height:15px; vertical-align:top; padding-left:10px; width:40%; ">
                <?php
                $date = date_create_from_format('Y-m-d', $customerorder->po_date);
                $date = date_format($date, 'd/m/Y');
                ?>
                <strong style="font-weight:bold;">PO No. : <?= $customerorder->ponumber ?></strong><br>
                Date : <?= $date ?> <br>
                Our GSTIN :<?= $companydetail->gst_no ?><br>
                Freight Terms : <?= $customerorder->freight; ?><br>
                Payment Terms : <?= $customerorder->pay_terms; ?>
            </td>
        </tr>
    </table>
    <table class="table" style="width: 100%; margin-top:5px">
        <td colspan="2">
            <spem>Dear Sir,</spem><br>
            <spem>Please find Ordered item below and dispatch it as earliest</spem>
        </td>
    </table>
    <div class="tablebox" cellpadding="0" cellspacing="0" style='overflow:hidden;margin-top:5px;'>
        <table id="contentTable">
            <thead>
                <tr>
                    <th class="col1 text-center">Sr.</th>
                    <th class="col2 text-center">Item</th>
                    <th class="col3 text-center">HSN</th>
                    <th class="col4 text-center">Qty</th>
                    <th class="col5 text-center">Rate</th>
                    <th class="col6 text-center">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $totalamt = 0;
                $totalqty = 0;
                foreach ($subOrderList as $post) :
                    $totalamt += $post->total;
                    $totalqty += $post->qty;
                    $itemname = $post->item_name . " (" . $post->unique_no . ")";
                    $item_unit = GENERAL_MEASUREMENT[$post->item_unit];
                ?>
                    <tr>
                        <td class="col1 text-center"><b><?= ++$i ?></b></td>
                        <td class="col2"><?= $itemname ?>
                            <?php
                            if ($post->delivery_date != null) {
                                $date = date_create_from_format('Y-m-d', $post->delivery_date);
                                echo " (Delivery Dt." . date_format($date, 'd/m/Y') . ")";
                            }
                            ?>
                        </td>
                        <td class="col3 text-center"><?= $post->hsn_code ?></td>
                        <td class="col4 text-center"><?= (float)$post->qty ?></td>
                        <td class="col5 text-center"><?= sprintf("%.2f", $post->amount), "/" . $item_unit; ?></td>
                        <td class="col6 text-center">
                            <?php echo sprintf("%.2f", $post->total) . " " . $post->symbol ?>
                        </td>
                    </tr>
                <?php endforeach;
                while ($i < 50) {
                    $i++;
                ?>
                    <tr>
                        <td class="col1"> </td>
                        <td class="col2"> </td>
                        <td class="col3"> </td>
                        <td class="col4"> </td>
                        <td class="col5"> </td>
                        <td class="col6"> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
    $cgst = ($totalamt * $customerorder->cgst) / 100;
    $sgst = ($totalamt * $customerorder->sgst) / 100;
    $igst = ($totalamt * $customerorder->igst) / 100;
    if ($cgst > 0) {
        $grandtotal = $totalamt + $cgst + $sgst + $customerorder->freight;
    } else {
        $grandtotal = $totalamt + $igst + $customerorder->freight;
    }
    ?>
    <table>
        <tfoot>
            <tr>
                <td class="col1" style="border-right-width:0px;">  </td>
                <td class="col2" style="border-right-width:0px;">  </td>
                <td class="col3 text-right">Total</td>
                <td class="col4 text-center"><?= (float)$totalqty ?></td>
                <td class="col5"> </td>
                <td class="col6 text-center"><b style="font-weight:bold;"><?= sprintf("%.2f", $totalamt) . " " . $post->symbol ?></b></td>
            </tr>
        </tfoot>
    </table>
    <table cellpadding="0" border='1' cellspacing="0" style="width: 100%; margin-top:5px">
        <tr>
            <td style="width: 60%; font-size:11px">
                <strong>Terms & Conditions:</strong>
                <ol style='padding-inline-start:20px !important;'>
                    <li>Goods Should be of 100% Quality</li>
                    <li>Subject to Jamnagar Jurisdiction Only.</li>
                    <li>Material shall be Delivered Within stipulated delivery time . Otherwise we reserve the right for non-acceptance of material.</li>
                    <li>Please mention our P.O.No. and Date in your invoice.</li>
                </ol>
            </td>
            <td valign='top' style="width: 40%;">
                <span class="pull-right mr10" style="font-weight:bold;">For, Supreme Industrial Fasteners</span>
                <br /><br /><br /><br /><br /><br />
                <span class="pull-right mr10 mb10" style="font-weight:bold;">Authorized Signature</p>
            </td>
        </tr>
    </table>
    <img src="<?= base_url('assets/img/letterhead_footer.png'); ?>" style="width:100%; margin-top:5px;">
    <?php $this->load->view('Includes/footerscript'); ?>
</body>

</html>