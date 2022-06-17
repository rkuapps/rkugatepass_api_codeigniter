<?php 
$currentPage="Inventory Management";
$pageBack=base_url()."Inventory/";
    $logPage=base_url()."Inventory/log/";
   
    $addButton="Add Inventory";
    ?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    ?>
    <!-- Datatables Core + Addons + Editor CSS -->
    <link rel="stylesheet" type="text/css" href="vendor/plugins/datatables/media/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/plugins/datatables/media/css/datatables_addons.min.css">
</head>

<body class="dashboard-page sb-l-m sb-r-c">

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
                            <a href="<?= $pageBack?>">
                                <span>History - <?= $items->unique_no ?></span>
                            </a>
                        </li>
                    </ol>
                </div>
            </header>
            <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" class="animated fadeIn">
                <!-- begin: .tray-center -->
                <div class="tray tray-center">
                    <div class="panel panel-visible" id="spy3">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <span class="glyphicon glyphicon-tasks"></span> <?= (isset($_GET['name'])) ? $_GET['name'] : '' ?> </div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="w50">#</th>
                                        <th class="w150">DATE</th>
                                        <th>Stock Type</th>
                                        <th class="w150">QTY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $total = 0;
                                    foreach ($inventorylog as $post) {
                                       
                                        $i++; 
                                        $order_date=$post->created_on;
                                        $middle=strtotime($order_date);
                                        $order_date=date('d-m-Y',$middle);
                                        if($post->stype ==0)
                                        {
                                            $class="text-success";
                                            $prefix="+";
                                            $total = $total + $post->qty;
                                            $status='<span class="badge badge-warning change-status">Opening Stock</span>';
                                        }
                                        else if($post->stype ==1)
                                        {
                                            $class="text-success";
                                            $prefix="+";
                                            $total = $total + $post->qty;
                                            $status='<span class="badge badge-success change-status">Purchased</span>';
                                        }
                                        else if($post->stype ==2)
                                        {
                                            $class="text-danger";
                                            $prefix="-";
                                            $total = $total - $post->qty;
                                            $status='<span class="badge badge-danger change-status">Used Item</span>';
                                        }
                                        else if($post->stype ==3)
                                        {
                                            $class="text-success";
                                            $prefix="+";
                                            $total = $total + $post->qty;
                                            $status='<span class="badge badge-success change-status">Voucher Inward</span>';
                                        }
                                        else if($post->stype ==4)
                                        {
                                            $class="text-danger";
                                            $prefix="-";
                                            $total = $total - $post->qty;
                                            $status='<span class="badge badge-danger change-status">Dispatch</span>';
                                        }
                                            ?>
                                        

                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $order_date ?></td>
                                            <td><?= $status ?></td>
                                            <td class='<?= $class?>'><?= $prefix.$post->qty ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th class="text-right">Current Stock</th>
                                        <th><?= $total ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <?php $this->load->view('Includes/footer'); ?>
        </section>
        <!-- End: Content-Wrapper -->

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <?php $this->load->view('Includes/footerscript'); ?>
    <!-- Datatables -->
    <script src="vendor/plugins/datatables/media/js/datatables.min.js"></script>

    <!-- Datatables Addons -->
    <script src="vendor/plugins/datatables/media/js/datatables_addons.min.js"></script>
    <script src="vendor/plugins/datatables/media/js/datatables_editor.min.js"></script>

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