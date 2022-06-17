<?php
$currentPage = "Inventory Management";
$pageBack = base_url() . "Inventory/";
$logPage = base_url() . "Inventory/log/";

$addButton = "Add Inventory";
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
                            <a href="<?= $addPage ?>">
                                <span>Inventory Management</span>
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
                                <span class="glyphicon glyphicon-tasks"></span> Inventory Management
                            </div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="w50">#</th>
                                        <th>Category</th>
                                        <th>Item Name</th>
                                        <th>Stock QTY</th>
                                        <th class="w150 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($inventoryitemlist as $post) {
                                        $i++;
                                        $id = $post->id; ?>

                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $post->category_name ?></td>
                                            <td><?= $post->item_name ?></td>
                                            <td><?= $post->qty - $post->minusqty ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?= $logPage . $id ?>" class="btn btn-success btn-xs" id="viewDetail">
                                                        <i class="fa fa-history"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
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

    <?php $this->load->view('Includes/footerscript');

    ?>
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