<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    ?>
    <style>
        .panel-controls {
            float: right;
            display: block;
            cursor: pointer;
        }

        a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body class="dashboard-page sb-l-m sb-r-c">
    <!-- Start: Main -->
    <div id="main">
        <?php
        $this->load->view('Includes/hadernav');
        $this->load->view('Includes/sidebar');
        ?>
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">
            <!-- Start: Topbar -->
            <header id="topbar">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <li class="crumb-active">
                            <a href="<?= base_url('Dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="crumb-icon">
                            <a href="<?= base_url('Dashboard') ?>">
                                <span class="glyphicon glyphicon-home"></span>
                            </a>
                        </li>
                        <li class="crumb-link">
                            <a href="<?= base_url('Dashboard') ?>">Home</a>
                        </li>
                        <li class="crumb-trail">Dashboard</li>
                    </ol>
                </div>
            </header>
            <!-- End: Topbar -->
            <!-- Begin: Content -->
            <section id="content" class="animated fadeIn">
                <!-- Dashboard Tiles 
                <div class="row mb10">
                    <?php if (check_role_assigned('invoice', 'view')) { ?>
                        <div class="col-sm-6 col-md-2">
                            <div class="panel bg-danger light of-h mb10">
                                <div class="p5">
                                    <h4 class="m5 text-muted">Current Month Sales</h4>
                                    <h2 class="m5 text-muted">
                                        <b><?= $orders ?></b>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if (check_role_assigned('invoice', 'view')) { ?>
                        <div class="col-sm-6 col-md-2">
                            <div class="panel bg-danger light of-h mb10">
                                <div class="p5">
                                    <?php if (check_role_assigned('invoice', 'add')) { ?>
                                        <div class="icon-bg">
                                            <a href='<?= base_url("Invoice/add/") ?>' target="_blank" style="display: block;background: #e9e9e9;padding: 2px 4px;">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <a href='<?= base_url("Invoice") ?>' target="_blank">
                                        <h4 class="m5 text-muted">Invoices</h4>
                                        <h2 class="m5 text-muted">
                                            <b><?= $invoice ?></b>
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if (check_role_assigned('quotation', 'view')) { ?>
                        <div class="col-sm-6 col-md-2">
                            <div class="panel bg-alert light of-h mb10">
                                <div class="p5">
                                    <?php if (check_role_assigned('quotation', 'add')) { ?>
                                        <div class="icon-bg">
                                            <a href='<?= base_url("Quotations/add/") ?>' target="_blank" style="display: block;background: #e9e9e9;padding: 2px 4px;">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <a href='<?= base_url("Quotations/") ?>' target="_blank">
                                        <h4 class="m5 text-muted">Quotation</h4>
                                        <h2 class="m5 text-muted">
                                            <b><?= $quotations ?></b>
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if (check_role_assigned('purchase_order', 'view')) { ?>
                        <div class="col-sm-6 col-md-2">
                            <div class="panel bg-info light of-h mb10">
                                <div class="p5">
                                    <?php if (check_role_assigned('purchase_order', 'add')) { ?>
                                        <div class="icon-bg">
                                            <a href='<?= base_url("PurchaseOrder/add/") ?>' target="_blank" style="display: block;background: #e9e9e9;padding: 2px 4px;">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <a href='<?= base_url("PurchaseOrder/") ?>' target="_blank">
                                        <h4 class="m5 text-muted">Purchase Orders</h4>
                                        <h2 class="m5 text-muted">
                                            <b><?= $purchase_orders ?></b>
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if (check_role_assigned('jobwork_challan', 'view')) { ?>
                        <div class="col-sm-6 col-md-2">
                            <div class="panel bg-warning light of-h mb10">
                                <div class="p5">
                                    <?php if (check_role_assigned('jobwork_challan', 'add')) { ?>
                                        <div class="icon-bg">
                                            <a href='<?= base_url("Jobwork_challan/Outword/add/") ?>' target="_blank" style="display: block;background: #e9e9e9;padding: 2px 4px;">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    <?php  } ?>
                                    <a href='<?= base_url("Jobwork_challan/Outword") ?>' target="_blank">
                                        <h4 class="m5 text-muted">Jobwork Challan</h4>
                                        <h2 class="m5 text-muted">
                                            <b><?= $jwchallan ?></b>
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if (check_role_assigned('deliverychallan', 'view')) { ?>
                        <div class="col-sm-6 col-md-2">
                            <div class="panel bg-system light of-h mb10">
                                <div class="p5">
                                    <?php if (check_role_assigned('deliverychallan', 'add')) { ?>
                                        <div class="icon-bg">
                                            <a href='<?= base_url("DeliveryChallan/add/") ?>' target="_blank" style="display: block;background: #e9e9e9;padding: 2px 4px;">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <a href='<?= base_url("DeliveryChallan") ?>' target="_blank">
                                        <h4 class="m5 text-muted">Delivery Challan</h4>
                                        <h2 class="m5 text-muted">
                                            <b><?= $delievrychallan ?></b>
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="admin-panels fade-onload">
                    <div class="row" id="spy1">
                        <div class="col-md-6 col-lg-6 admin-grid">
                            <div class="panel panel-visible">
                                <div class="panel-heading">
                                    <div class="panel-title hidden-xs">
                                        <span class="glyphicon glyphicon-tasks"></span>Open Jobwork Challans
                                    </div>
                                </div>
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="w20">#</th>
                                            <th>Date</th>
                                            <th>Challan No</th>
                                            <th>JW Company</th>
                                            <th class="w70 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($openchallan as $post) {
                                            $date = date_create_from_format('Y-m-d', $post->challan_date);
                                            $date = date_format($date, 'd/m/Y');
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $date ?></td>
                                                <td><a href="<?= base_url('Jobwork_challan/outword/add/' . $post->id) ?>" target="_blank"><?= $post->challan_no ?></a></td>
                                                <td><?= $post->company_name ?></td>
                                                <td class="text-center">
                                                    <?php if (check_role_assigned('jobwork_challan', 'add')) { ?>
                                                        <div class="btn-group">
                                                            <a href="<?= base_url('Jobwork_challan/Inword/add/' . $post->id) ?>" class="btn btn-default btn-xs" id="viewDetail" target="_blank">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                -->
            </section>
            <!-- End: Content -->
            <?php $this->load->view('Includes/footer'); ?>
        </section>
        <!-- End: Content-Wrapper -->
    </div>
    <!-- End: Main -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <?php $this->load->view('Includes/footerscript');  ?>
    <script src="assets/vendor/plugins/datatables/media/js/datatables.min.js"></script>
    <!-- Demo Widget Javascript -->
    <script src="assets/js/demo/widgets.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            "use strict";
            // Init Theme Core    
            Core.init();
            // Init Demo JS  
            Demo.init();
            // Define chart color patterns
            var highColors = [bgWarning, bgPrimary, bgInfo, bgAlert,
                bgDanger, bgSuccess, bgSystem, bgDark
            ];
            var column1 = $('#high-column-custom');
            if (column1.length) {
                // Column Chart 1
                $('#high-column-custom').highcharts({
                    credits: false,
                    colors: highColors,
                    chart: {
                        backgroundColor: 'transparent',
                        type: 'column',
                        padding: 0,
                        margin: 0,
                        marginTop: 10
                    },
                    legend: {
                        enabled: false
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        lineWidth: 0,
                        tickLength: 0,
                        minorTickLength: 0,
                        title: {
                            text: null
                        },
                        labels: {
                            enabled: false
                        }
                    },
                    yAxis: {
                        gridLineWidth: 0,
                        title: {
                            text: null
                        },
                        labels: {
                            enabled: false
                        }
                    },
                    tooltip: {
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y} pcs</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            groupPadding: 0.05,
                            pointPadding: 0.25,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Copper',
                        data: [30]
                    }, {
                        name: 'Aluminium',
                        data: [60]
                    }, {
                        name: 'Stainless',
                        data: [90]
                    }, {
                        name: 'Brass',
                        data: [120]
                    }, {
                        name: 'Mild Steel',
                        data: [160]
                    }]
                });
            }
            // Init Admin Panels on widgets inside the ".admin-panels" container
            $('.admin-panels').adminpanel({
                grid: '.admin-grid',
                callback: function() {
                    bootbox.confirm('<h3>A Custom Callback!</h3>', function() {});
                },
                onFinish: function() {
                    $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');
                    // Init the rest of the plugins now that the panels
                    // have had a chance to be moved and organized.
                    // It's less taxing to organize empty panels
                    demoHighCharts.init();
                },
                onSave: function() {
                    $(window).trigger('resize');
                }
            });
            $('#datatable2').dataTable({
                dom: '<"top"fl>rt<"bottom"ip>',
                "order": [],
                "scrollX": true,
                'columnDefs': [{
                    'targets': [-1, 0],
                    lengthChange: false,
                    'orderable': false
                }, {
                    type: 'date-eu',
                    targets: 2
                }],
                "sScrollXInner": "100%",
                "oLanguage": {
                    "sEmptyTable": "No Record(s) added yet."
                }
            });
            // $('#datatable2').dataTable({
            //     // dom: "Bfrtip",
            //     // dom: "rtip",
            //     dom: '<"top"fl>rt<"bottom"ip>'
            //     // select: true
            // });
        });
    </script>
    <!-- END: PAGE SCRIPTS -->
</body>

</html>