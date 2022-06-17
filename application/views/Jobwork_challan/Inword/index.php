<?php
$currentPage = "INWARD";
$pageBack = base_url() . "Jobwork_challan/Inword/index/" . $outwordid;
$addPage = base_url() . "Jobwork_challan/Inword/add/" . $outwordid . "/";
$planpage = base_url() . "Jobwork_challan/Inword/";
$deletePage = base_url() . "Jobwork_challan/Inword/delete/";
$addButton = "Add";
$PrintPage = base_url() . "Order/Print/";
$ItemPage = base_url() . "Item/index/";
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    $this->load->view('Includes/tablecss');
    ?>
    <style>
        span {
            cursor: pointer;
        }
    </style>
</head>

<body class="ecommerce-page sb-l-m">
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
                            <a href="<?= $pageBack ?>">
                                <span>JW CHALLAN</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <?php if (check_role_assigned('jobwork_challan', 'add')) { ?>
                    <div class="topbar-right">
                        <a href="<?= $addPage ?>" class="btn btn-default btn-sm light fw600 ml10">
                            <span class="fa fa-plus pr5"></span> <?= $addButton ?> </a>
                    </div>
                <?php } ?>
            </header>
            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">
			<div class="tray tray-center p15">
                <!-- begin: .tray-center -->
                <?php
                $expect_items = '';
                $weight = 0;
				$sr=1;
                ?>
                <div class="row">
                    <div class='col-lg-8'>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title hidden-xs">
                                    <span class="glyphicon glyphicon-tasks"></span>JW CHALLAN - <?= $outworddata->challan_no ?>
                                </div>
                            </div>
                            <div class="panel-body pn">
                                <table class='table table-striped' >
									<thead>
                                    <tr>
                                        <th class="w20">Sr.</th>
                                        <th>Item</th>
                                        <th>Weight</th>
                                        <th>Rec. Qty</th>
                                        <th>Rem. Qty</th>
                                    </tr>
									</thead>
									<tbody>
									<?php foreach ($outworditemlist as $item) {
                                    ?>
                                        <tr>
                                            <td><?= $sr++; ?></td>
                                            <td><?= $item->jw_itemname ?></td>
                                            <td><?= $item->weight ?></td>
                                            <td><?= sprintf("%0.3f", $item->recweight) ?></td>
                                            <td><?= sprintf("%0.3f", $item->weight - $item->recweight); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
									</tbody>
                                    <tfoot>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th class="pull-right">Total Weight</th>
                                        <th><b><?= $outworddata->weight ?></b></th>
                                        <th class="text-success"><b><?= sprintf("%0.3f", $outworddata->recweight); ?></b></th>
                                        <th class="text-danger"><b><?= sprintf("%0.3f", $outworddata->recweight - $outworddata->weight) ?></b></th>
                                    </tr>
									</tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title hidden-xs">
                                    <span class="glyphicon glyphicon-tasks"></span>INWARD
                                </div>
                            </div>
                            <div class="panel-body pn">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="w20">#</th>
                                            <th>Date</th>
                                            <th>Weight</th>
                                            <th class="w150 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($Inwordlist as $post) {
                                            $i++;
                                            $date = date_create_from_format('Y-m-d', $post->inword_date);
                                            $date = date_format($date, 'd/m/Y');
                                        ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $date ?></td>
                                                <td><?= $post->weight ?></td>
                                                <td class="text-center">
                                                    <!-- <div class="btn-group">
                                                    <a href="<?php echo $PrintPage . $post->id ?>" class="btn btn-default btn-xs" id="viewDetail">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                </div> -->
                                                    <?php if (check_role_assigned('jobwork_challan', 'edit')) { ?>
                                                        <div class="btn-group">
                                                            <a href="<?php echo $addPage . $post->id ?>" class="btn btn-warning btn-xs">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    <?php }
                                                    if (check_role_assigned('jobwork_challan', 'delete')) {
                                                        echo '<div class="btn-group"><a href="#" onclick="javascript:deleteBox(' . $post->id . ')" title="Delete Order" class="btn btn-danger btn-xs cancel "><span class="fa fa-trash-o"></span></a>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="delid" id="delid" value="0">
			</div>
            </section>
            <!-- End: Content -->
            <?php $this->load->view('Includes/footer'); ?>
        </section>
        <div id='myModal' class='modal'>
            <div class="modal-dialog panel  panel-default panel-border top">
                <div class="modal-content">
                    <div id='myModalContent'></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Main -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <?php $this->load->view('Includes/footerscript');
    $this->load->view('Includes/tablejs');
    ?>
    <script type="text/javascript">
        function deleteBox(frmname) {
            $("#delid").val(frmname);
        }
        jQuery(document).ready(function() {
            "use strict";
            // Init Theme Core    
            Core.init();
            // Init Demo JS  
            Demo.init();
            if (window.matchMedia('(max-width: 900px)').matches) {
                $('#datatable').dataTable({
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
            } else {
                $('#datatable').dataTable();
            }

            $('.cancel').click(function(e) {
                e.preventDefault();
                var delid = $("#delid").val();
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this Records!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            window.location.href = "<?= $deletePage ?>" + delid;
                        } else {
                            swal({
                                title: "Cancelled",
                                text: "Your Records are safe :)",
                                type: "error",
                                confirmButtonClass: "btn-danger"
                            });
                        }
                    });
            });
        });
    </script>
    <!-- END: PAGE SCRIPTS -->
</body>

</html>