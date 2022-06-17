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
    }
    </style>
</head>

<body class="invoice-page">

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
                                <span>Order </span>
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
                            <span class="glyphicon glyphicon-print"></span> Order No. -
                            <?=$customerorder->orderno?></span>
                        <div class="panel-header-menu pull-right mr10">
                            <button type="button" class="btn btn-xs btn-primary btn-gradient mr5"
                                onClick="javascript:window.print()">
                                <i class="fa fa-print fs13"></i> Print Order</button>
                        </div>
                    </div>
                    <div class="panel-body p20" id="invoice-item">
                        <div class="row" id="invoice-info">
                            <div class="col-md-6">
                                <div class="panel panel-alt">
                                    <div class="panel-heading">
                                        <span class="panel-title">
                                            <i class="fa fa-user"></i> Customer : </span>

                                    </div>
                                    <div class="panel-body" style="height:130px">
                                        <address>
                                            <strong><?=$customerorder->customer_name?></strong>
                                            <br>
                                            <?=nl2br($customerorder->address)?>

                                            <br>
                                            <!-- <abbr title="Phone">P:</abbr> (123) 456-7890 -->
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-alt">
                                    <div class="panel-heading">
                                        <span class="panel-title">
                                            <i class="fa fa-location-arrow"></i> Consignee:</span>
                                    </div>
                                    <div class="panel-body" style="height:130px">
                                        <address>
                                            <strong><?=$customerorder->company_name?></strong>
                                            <br>
                                            <?=$customerorder->company_address?>
                                            <br>
                                            <!-- <abbr title="Phone">P:</abbr> (123) 456-7890 -->
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="invoice-table">
                            <div class="col-md-6">
                                <h3>ORDER NO. <?=$customerorder->orderno?></h3>
                            </div>
                            <div class="col-md-6" style="text-align:right">
                                <?php 
                                $date=date_create_from_format('Y-m-d',$customerorder->order_date);
                                $date=date_format($date,'d/m/Y');
                                ?>
                                <h3>Date: <?=$date?></h3>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th class="pr10 text-right">Price</th>
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
                                        ?>
                                        <tr>
                                            <td><b><?=++$i?></b></td>
                                            <td><?=$itemname?> </td>
                                            <td><?=(float)$post->qty?></td>
                                            <td><?=(float)$post->amount." ".$post->symbol?></td>
                                            <td class="pr10 text-right"><?=(float)$post->total." ".$post->symbol?></td>
                                        </tr>
                                        <?php endforeach;?>
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
                                            <th class="text-right" colspan=2>Total</th>
                                            <th><?=(float)$totalqty?></th>
                                            <th></th>
                                            <th class="text-right"><?=(float)$totalamt." ".$post->symbol?></th>
                                        </tr>
                                        <?php if($cgst>0){ ?>
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
                                    } ?>
                                        <tr>
                                            <th class="text-right" colspan=2>FREIGHT</th>
                                            <th class="text-right" colspan=3>
                                                <?=(float)$customerorder->freight." ".$post->symbol?></th>
                                        </tr>
                                        <tr>
                                            <th class="text-right" colspan=2>Grand TOtal</th>
                                            <th class="text-right" colspan=3><?=(float)$grandtotal." ".$post->symbol?>
                                            </th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>

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

        $('#datatable').dataTable({
            dom: '<"top"fl>rt<"bottom"ip>',
            "scrollX": true,
            "sScrollXInner": "100%",
        });

    });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>