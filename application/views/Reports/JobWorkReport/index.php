<?php
$date = date_create_from_format('Y-m-d', $post->challan_date);
$date = date_format($date, 'd/m/Y');
$val_start_date = date_create_from_format('Y-m-d', $this->session->userdata['jwreport_filter']['sdate']);
$val_start_date = date_format($val_start_date, 'd/m/Y');
$val_end_date = date_create_from_format('Y-m-d', $this->session->userdata['jwreport_filter']['edate']);
$val_end_date = date_format($val_end_date, 'd/m/Y');
$val_customerid = $this->session->userdata['jwreport_filter']['jobworker'];
$val_categoryid = $this->session->userdata['jwreport_filter']['itemcategory'];
$val_itemid = $this->session->userdata['jwreport_filter']['item'];
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    $this->load->view('Includes/tablecss');
    ?>
</head>

<body class="sb-l-m">
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
                                <span>Job Worker Report</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </header>
            <!-- End: Topbar -->
            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">
                <!-- begin: .tray-center -->
                <div class="tray tray-center ">
                    <div class="panel panel-visible" id="spy3">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <span class="glyphicon glyphicon-tasks"></span>Job Worker Report
                            </div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-striped table-hover" id="datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="w20">#</th>
                                        <th>Job Worker</th>
                                        <th>Item Cat.</th>
                                        <th>JW Item</th>
                                        <th class="text-right">Out</th>
                                        <th class="text-right">In</th>
                                        <th class="text-right">Diff.</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    $totalout = 0;
                                    $totalin = 0;
                                    $totaldif = 0;
                                    foreach ($reportdata as $post) {
                                        $totalout += $post->out_weight;
                                        $totalin += $post->in_weight;
                                        $diffenence = $post->in_weight - $post->out_weight;
                                        $totaldif += $diffenence;
                                    ?>
                                        <tr>
                                            <td class="w20"><?= $i++ ?></td>
                                            <td><?= $post->company_name ?></td>
                                            <td><?= $post->subcategory_name ?></td>
                                            <td><?= $post->item_name ?></td>
                                            <td class="text-right"><?= number_format($post->out_weight, 3) ?></td>
                                            <td class="text-right"><?= number_format($post->in_weight, 3) ?></td>
                                            <td class="text-right <?= ($diffenence < 0) ? "text-danger" : "" ?>"><?= number_format($diffenence, 3) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th class="text-right fs14"><?= number_format($totalout, 3) ?></th>
                                        <th class="text-right fs14 text-primary"><?= number_format($totalin, 3) ?></th>
                                        <th class="text-right fs14 <?= ($totaldif < 0) ? "text-danger" : "" ?>"><?= number_format($totaldif, 3) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: .tray-center -->
            </section>
            <!-- End: Content -->
        </section>

    </div>
    <!-- For Demo Purposes - Theme Settings Pane -->
    <div id="skin-toolbox">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon">
                    <i class="glyphicon glyphicon-filter fs18 text-primary"></i>
                </span>
                <span class="panel-title fs18"> Report Filter</span>
            </div>
            <div class="panel-body p10">

                <form role="form" class="col-lg-12" id="filter-form" action="<?= base_url('Reports/JobWorkReport/') ?>" method="post">
                    <?php
                    datepicker('', 'Start Date', 'start_date', 'Enter Start Date', $val_start_date, 'required');
                    datepicker('', 'End Date', 'end_date', 'Enter End Date', $val_end_date, 'required');
                    dropdownbox('', 'Job Worker', 'jobworker', $jobworkerlist, $val_customerid);
                    dropdownbox('', 'Item Category', 'itemcategory', $categorylist, $val_categoryid);
                    dropdownbox('', 'Item', 'item', $itemlist, $val_itemid);
                    ?>
                    <div class="form-group">
                        <button class="col-sm-6 btn btn-primary" type="submit" name='submit'>
                            Search
                        </button>
                        <a href='<?= base_url('Reports/JobWorkReport') ?>' class="col-sm-6 btn btn-danger" name='reset' value='reset'>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <?php
    $this->load->view('Includes/footerscript');
    $this->load->view('Includes/tablejs');
    ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="<?php echo base_url('assets/vendor/plugins/datatables/media/js/datatables_addons.min.js') ?>"></script>

    <script type="text/javascript">
        function customReset() {
            let jobworker = document.getElementById("jobworker");
            jobworker.value = 0;
            let itemcategory = document.getElementById("itemcategory");
            itemcategory.value = 0;
            let item = document.getElementById("item");
            item.value = 0;
        }
        jQuery(document).ready(function() {
            "use strict";
            // Init Theme Core    
            Core.init();
            // Init Demo JS  
            Demo.init();
            // Init Select2 - Basic Single
            $(".select2-single").select2();


            $('#datatable').dataTable({
                order: [],
                // dom: '<"top"fl>rt<"bottom"ip>',
                dom: 'Bfrtip',
                responsive: false,
                "paging": false,
                "scrollX": true,
                "sScrollXInner": "100%",
                'columnDefs': [{
                    'targets': [0],
                    lengthChange: false,
                    'orderable': false
                }, {
                    type: 'date-eu',
                    targets: 3
                }],
                buttons: [{
                    extend: "excel",
                    className: "btn btn-left-success btn-gradient btn-alt",
                    text: 'Export',
                    filename: '<?= $this->uri->segment(2) . "_" . date('Y_m_d_H_i_s_A'); ?>',
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button')
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
            });
        });
    </script>
</body>

</html>