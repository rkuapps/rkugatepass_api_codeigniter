<?php

$val_start_date = date('01/m/Y');
$val_end_date = date('t/m/Y');
if (!empty($search)) {
    $val_customerid = $search['customerid'];
    $val_start_date = $search['start_date'];
    $val_end_date = $search['end_date'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    $this->load->view('Includes/tablecss');
    ?>
</head>

<body class="ecommerce-page">

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
                            <a href="#">
                                <span>Dispatch Report</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="topbar-right">
                    <div class="ml15 ib va-m" id="toggle_sidemenu_r">
                        <a href="#" class="pl5">
                            <i class="glyphicon glyphicon-filter fs18 text-primary"></i>
                        </a>
                    </div>
                </div>
            </header>
            <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- begin: .tray-center -->
                <div class="tray tray-center">

                    <div class="panel panel-visible" id="spy3">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <span class="glyphicon glyphicon-tasks"></span>Dispatch Report
                            </div>
                        </div>
                        <div class="panel-body pn">


                            <table class="table table-striped table-hover" id="datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="w20">#</th>
                                        <th>Order No.</th>
                                        <th>Customer</th>
                                        <th>Invoice No.</th>
                                        <th>Invoice Date.</th>
                                        <th>Invoice Amount</th>
                                        <th>Bill Amount (INR)</th>
                                        <th>DBK Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($DispatchReport as $post) {
                                        $date = date_create_from_format('Y-m-d', $post->invoice_date);
                                        $date = date_format($date, 'd/m/Y');
                                        if ($post->pay_status == 0) {
                                            $invoice_amount = "<span class='badge badge-default'>" . (float)$post->invoice_amount . " " . $post->invoice_symbol . "</span>";
                                            $dbk_amount = "<span class='badge badge-default'>" . (float)$post->dbk_amount . "</span>";
                                        } else if ($post->pay_status == 1) {
                                            $invoice_amount = "<span class='badge badge-danger'>" . (float)$post->invoice_amount . " " . $post->invoice_symbol . "</span>";
                                            $dbk_amount = "<span class='badge badge-danger'>" . (float)$post->dbk_amount . "</span>";
                                        } else if ($post->pay_status == 2) {
                                            $invoice_amount = "<span class='badge badge-success'>" . (float)$post->invoice_amount . " " . $post->invoice_symbol . "</span>";
                                            $dbk_amount = "<span class='badge badge-success'>" . (float)$post->dbk_amount . "</span>";
                                        }


                                    ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $post->orderno ?></td>
                                            <td><?= $post->customer_name ?></td>

                                            <td><?= $post->invoiceno ?></td>
                                            <td><?= $date ?></td>
                                            <td><?= $invoice_amount ?></td>

                                            <td><?= (float)$post->amount_in_inr . " " . $post->inr_symbol ?></td>
                                            <td><?= $dbk_amount ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
                <!-- end: .tray-center -->

            </section>
            <!-- End: Content -->


        </section>

        <!-- Start: Right Sidebar -->
        <aside id="sidebar_right" class="nano affix">

            <!-- Start: Sidebar Right Content -->
            <div class="sidebar-right-content nano-content">

                <div class="tab-block sidebar-block br-n">
                    <div class="tab-content br-n">
                        <div id="sidebar-right-tab1" class="tab-pane active">
                            <h5 class="title-divider text-muted mb20">
                                Filter
                            </h5>
                            <form role="form" class="col-lg-12" id="filter-form" action="<?= base_url('Reports/DispatchReport/') ?>" method="post">
                                <?php

                                dropdownbox('', 'Customer', 'customerid', $customerlist, $val_customerid);
                                datepicker('', 'Start Date', 'start_date', 'Enter Start Date', $val_start_date);
                                datepicker('', 'End Date', 'end_date', 'Enter End Date', $val_end_date);
                                ?>

                                <div class="form-group">
                                    <button class="btn btn-primary mt15" type="submit" style="width:100%">
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- <div id="sidebar-right-tab2" class="tab-pane"></div>
                        <div id="sidebar-right-tab3" class="tab-pane"></div> -->
                    </div>
                    <!-- end: .tab-content -->
                </div>

            </div>
        </aside>
        <!-- End: Right Sidebar -->

    </div>
    <!-- End: Main -->

    <?php $this->load->view('Includes/footerscript');
    $this->load->view('Includes/tablejs');
    ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core    
            Core.init();

            // Init Demo JS  
            Demo.init();

            // Init Select2 - Basic Single
            $(".select2-single").select2();


            $('#datatable').dataTable({

                dom: "Bfrtip",
                order: [],
                responsive: false,
                "scrollX": true,
                "sScrollXInner": "100%",
                'columnDefs': [{
                    'targets': [0],
                    lengthChange: false,
                    'orderable': false
                }, {
                    type: 'date-eu',
                    targets: 4
                }],

                buttons: [{
                    extend: "excel",
                    className: "btn custom_btn",
                    text: 'Export',
                    filename: '<?= $this->uri->segment(2) . "_" . date('Y_m_d_H_i_s_A'); ?>',

                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                }
            });


            // Init DateRange plugin
            $('.datetimepicker').datepicker({
                dateFormat: 'dd/mm/yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                showButtonPanel: false,
                beforeShow: function(input, inst) {
                    var newclass = 'admin-form';
                    var themeClass = $(this).parents('.admin-form').attr('class');
                    var smartpikr = inst.dpDiv.parent();
                    if (!smartpikr.hasClass(themeClass)) {
                        inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                    }
                }
            });



        });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>