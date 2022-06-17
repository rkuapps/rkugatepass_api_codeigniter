<?php
    $currentPage = "Gate Pass Order";
    $pageBack = base_url() . "GatePass/";
    $addPage = base_url() . "GatePass/add/";
    $planpage = base_url() . "GatePass/plan/";
    $deletePage = base_url() . "GatePass/Delete/";
    $addButton = "Add";
    $penddingqty = base_url() . 'GatePass/getPendingqty';
    $PrintPage = base_url() . "GatePass/Print/";
    $invoice = base_url() . "GatePass/save/";
    $ItemPage = base_url() . "GatePass/index/";
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
    <div id="main">
        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <section id="content_wrapper">
            <header id="topbar">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="<?= $pageBack ?>">
                                <span>Gate Pass </span>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="topbar-right">
                    <?php if (check_role_assigned('order', 'add')) { ?>
                        <a href="<?= $addPage ?>" class="btn btn-default btn-sm light fw600 ml10">
                            <span class="fa fa-plus pr5"></span> <?= $addButton ?> </a>
                        </a>
                    <?php } ?>
                </div>
            </header>
            <div class="row">
                <div class="col-sm-12">
                    <section id="content" class="table-layout animated fadeIn">
                        <div class="tray tray-center">
                            <div class="panel panel-visible" id="spy3">
                                <div class="panel-heading">
                                    <div class="panel-title hidden-xs">
                                        <span class="glyphicon glyphicon-tasks"></span>Gate Pass Entry
                                    </div>
                                </div>
                                <div class="panel-body pn">
                                    <table class="table table-hover" id="datatable">
                                        <thead>
                                            <tr>
                                                <th class="w20">#</th>
                                                <th>User</th>
                                                <th>Room No </th>
                                                <th>Leave Period</th>
                                                <th>Reason</th>
                                                <th>Student No</th>
                                                <th>Test1</th>
                                                <th>Status</th>
                                                <th class="w150 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($Order as $post) {
                                                $i++;
                                                $date = date_create_from_format('Y-m-d', $post->order_date);
                                                $date = date_format($date, 'd/m/Y');
                                                $status = '<span class="badge badge-default" data-id="' . $post->id . '">Close</span>';
                                                if ($post->status == 0) {
                                                    $status = '<span class="badge badge-success" data-id="' . $post->id . '" >Open</span>';
                                                }
                                            ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $post->orderno ?></td>
                                                    <td><?= $date ?></td>
                                                    <td><?= $post->customer_name ?></td>
                                                    <td><?= $post->ponumber ?></td>
                                                    <td><?= $post->po_date ?></td>
                                                    <td><?= $post->total ?></td>
                                                    <td><?= $status ?></td>
                                                    <td class="text-center">
                                                        <?php if (check_role_assigned('order', 'view')) { ?>
                                                            <div class="btn-group">
                                                                <button class="btn btn-primary btn-xs" onclick="javascript:pendingQty(<?= $post->id; ?>)">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </div>
                                                        <?php }
                                                        if (check_role_assigned('order', 'edit')) { ?>
                                                            <div class="btn-group">
                                                                <a href="<?php echo $addPage . $post->id ?>" class="btn btn-warning btn-xs">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        <?php }

                                                        if (check_role_assigned('order', 'delete')) { ?>
                                                            <div class="btn-group">
                                                                <a href="#" onclick="javascript:deleteBox('<?= $post->id ?>')" title="Delete Order" class="btn btn-danger btn-xs cancel ">
                                                                    <span class="fa fa-trash-o"></span>
                                                                </a>
                                                            </div>
                                                        <?php
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
                        <input type="hidden" name="delid" id="delid" value="0">
                    </section>
                </div>
                <div class="modal fade" id="filterModal" role="dialog">
                    <div class="bg-none mfp-with-anim mfp-hide" style="max-width: 700px; margin:30px auto;">
                        <!-- Modal content-->
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title"> Order Item Status</span>

                            </div>
                            <div class="panel-body p10 ptn" id='data'>
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th class="pt5 pb5">Item Name</th>
                                            <th class="w100 pn text-right">Total</th>
                                            <th class="w100 pn text-right">Invoiced</th>
                                            <th class="w100  text-right">Pending</th>
                                        </tr>
                                    </thead>
                                    <tbody id='pendingdata'>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer">
                                <!-- <button type="button" class="btn btn-primary confirm" data-dismiss="modal">close</button> -->
                            </div>
                        </div>

                    </div>
                </div>
                <?php $this->load->view('Includes/footer'); ?>
        </section>
        <?php $this->load->view('Includes/footerscript');
        $this->load->view('Includes/tablejs');
        ?>
        <script type="text/javascript">
            function deleteBox(frmname) {
                $("#delid").val(frmname);
            }
            jQuery(document).ready(function() {
                "use strict";
                Core.init();
                Demo.init();
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

            function pendingQty(pono) {
                $.post('<?= $penddingqty ?>', {
                    'id': pono
                }, function(data) {
                    $('#filterModal').modal('show');
                    $('#pendingdata').html(data);
                });
            }
        </script>
</body>

</html>