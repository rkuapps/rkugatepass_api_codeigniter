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

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }


        /* Total Table width 630px */
        .tablebox {
            height: 330px;
        }
        .tablerow div.col1 {
            width: 40px;
        }
        .tablerow div.col2 {
            width: 80px;
        }
        .tablerow div.col3 {
            width: 250px;
        }
        .tablerow div.col4 {
            width: 90px;
        }
        .tablerow div.col5 {
            width: 70px;
        }
        .tablerow div.col6 {
            width: 100px;
        }
        #contentTable {
            width: 100%;
            height:330px;
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
            <td class="text-center">
                <h3 class="m5" style="font-weight:bold;">QUOTATION</h3>
            </td>
        </tr>
    </table>
    <table style='width:100%; margin-top:5px;height:100px;'>
        <tr>
            <td style="line-height:15px; vertical-align:top; padding-left:10px; width:60%">
                Consignee : <strong  style="font-weight:bold;"><?= $customerorder->consignee ?></strong><br>
                Customer : <b style="font-weight:bold;"><?= $customerorder->customer_name ?></b><br>
                <p style="margin-bottom:0px;">
                    <?= nl2br($customerorder->address) ?>
                    <br>
                </p>
            </td>
            <td style="line-height:15px; vertical-align:top; padding-left:10px; width:40%">
                <?php
                $quotation_date = date_create_from_format('Y-m-d', $customerorder->quotation_date);
                $quotation_date = date_format($quotation_date, 'd/m/Y');
                ?>
                <b style="font-weight:bold;">Quotation No : <?= $customerorder->quotationno ?></b><br>
                Date : <?= $quotation_date ?><br>
                Against Form : N.A.<br>
                Insurance : N.A.<br>
                Freight Terms :
                <?php if ($customerorder->freight_terms == 0) {
                    echo "Paid";
                } else {
                    echo "To Pay";
                } ?>

            </td>
        </tr>
    </table>

    <table style='width:100%; margin-top:5px;'>
        <td colspan="2">
            <span>Dear Sir,</span><br>
            <span>Thanks for your valued Inquiry. We are pleased to quote our best rate as under :</span>
        </td>
    </table>
    <div class="tablebox" cellpadding="0" cellspacing="0" style=' border-bottom: 1px solid #A9A9A9;overflow:hidden;margin-top:5px;'>
        <table id="contentTable">
            <thead>
                <tr>
                    <th class="col1 text-center">Sr.</th>
                    <th class="col2 text-center">Drg No</th>
                    <th class="col3 text-center">Item</th>
                    <th class="col4 text-center">Plating</th>
                    <th class="col5 text-center">MOQ</th>
                    <th class="col6 text-center">Rate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $totalamt = 0;
                $totalqty = 0;
                foreach ($subOrderList as $post) :
                    $totalamt += $post->amount;
                    $itemname = $post->item_name;
                    $item_unit = GENERAL_MEASUREMENT[$post->item_unit];
                ?>
                    <tr>
                        <td class="col1 text-center"><?= ++$i ?></td>
                        <td class="col2 text-left"><?= $post->unique_no ?></td>
                        <td class="col3 text-left"><?= $itemname ?></td>
                        <td class="col4 text-center"><?= $post->platting ?></td>
                        <td class="col5 text-center"><?= $post->moq ?></td>
                        <td class="col6 text-center"><?php echo sprintf("%.2f", $post->rate) . " (" . $item_unit . ')' ?></td>
                    </tr>
                <?php endforeach;
                while ($i < 30) {
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
    <table cellpadding="0" style='margin-top:5px; clear: both; text-align:center;width:100%;font-size:10px;' cellspacing="0">
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
    <table cellpadding="0" cellspacing="0" style="width: 100%; margin-top:5px">
        <tr style="height: 10px;">
            <td style="vertical-align:top; border-right:0px;">
                Please favour us with your valued Order
            </td>
            <td style="border-left:0px;">
                <p style='text-align:right;'>
                    <b style="font-weight:bold;">For, Supreme Industrial Fasteners</b>
                </p><br>
                <p style='text-align:right;margin-bottom:0px; '><b style="font-weight:bold;">Authorized Signature</b></p>
            </td>
        </tr>
    </table>
    <img src="<?= base_url('assets/img/letterhead_footer.png'); ?>" style="width:100%; margin-top:5px;">

</body>

</html>