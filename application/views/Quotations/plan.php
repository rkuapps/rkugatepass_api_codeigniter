<!DOCTYPE html>
<html>

<head>
<?php
$this->load->view('Includes/head');?>

</head>

<body class="dashboard-page sb-l-m sb-r-c">

    <!-- Start: Main -->
    <div id="main">
        <?php $this->load->view('Includes/hadernav');?>
        <?php $this->load->view('Includes/sidebar');?>

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

            <!-- Start: Topbar -->
            <header id="topbar">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="order_management.php">
                                <span>Order Management</span>
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
                                <span class="glyphicon glyphicon-tasks"></span> Order Planning </div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-bordered mbn">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>Customer Name : </b> <?php echo $Order->customer_name; ?>
                                        </td>
                                        <td>
                                            <b>Order No. : </b> <?php echo $Order->orderno; ?>
                                        </td>
                                        <td>
                                            <b>Order Date : </b> <?php echo $Order->order_date; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                    <?php foreach ($Order_sub as $post) {
    $delivery_date = date_create_from_format('Y-m-d', $post->delivery_date);
    $delivery_date = date_format($delivery_date, 'd/m/Y');
    $data_qty = 0;
    foreach ($Order_list as $other_order) {
        if ($other_order->orderid != $id) {
            if ($post->item_number == $other_order->item_number) {
                if ($other_order->qty > $other_order->dispatched) {
                    $data_qty = $data_qty + $other_order->qty - $other_order->dispatched;
                }
            }
        }
    }

    ?>
                        <div class="col-md-4">

                            <div class="panel panel-visible heading-border panel-success" id="spy3">
                                <div class="panel-heading">
                                    <div class="panel-title hidden-xms">
                                        <b>Item:</b> <?php echo $post->item_number; ?>
                                        <div class="pull-right"><?php echo $delivery_date; ?></div>
                                    </div>

                                </div>
                                <div class="panel-body pn" style="border: none;">
                                    <table class="table table-bordered mn">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Current Order Qty
                                                </td>
                                                <td>
                                                    <?php echo $post->qty; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button class="btn btn-success btn-xs other-qty-btn"><i class="fa fa-plus"></i></button> Other Order Qty
                                                </td>
                                                <td>
                                                    <?php echo $data_qty; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Available Qty
                                                </td>
                                                <td>
                                                    3750
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary btn-xs m10">Dispatch</button>
                                        <button class="btn btn-warning btn-xs m10">Purchase</button>
                                    </div>
                                    <table class="table table-bordered mbn mt5 other-qty-details" style="display: none;">
                                        <thead>
                                            <tr class="success">
                                                <th>
                                                    Order No.
                                                </th>
                                                <th>
                                                    Qty
                                                </th>
                                                <th>
                                                    Due Date
                                                </th>
                                                <th>
                                                    Disp.
                                                </th>
                                                <th>
                                                    Rem.
                                                </th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($Order_list as $data) {
        $due_date = date_create_from_format('Y-m-d', $data->delivery_date);
        $due_date = date_format($due_date, 'd/m/Y');
        if ($data->orderid != $id) {
            if ($post->item_number == $data->item_number) {
                if ($data->qty > $data->dispatched) {
                    $qty = 0 + $data->qty - $data->dispatched;
                    ?>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $data->orderno; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data->qty; ?>
                                                </td>
                                                <td>
                                                    <?php echo $due_date; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data->dispatched; ?>
                                                </td>
                                                <td>
                                                    <?php echo $qty; ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                     <?php

                }
            }
        }
    }?>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <?php }?>
                    </div>
                </div>
                <!-- end: .tray-center -->

            </section>
            <?php $this->load->view('Includes/footer');?>
        </section>
        <!-- End: Content-Wrapper -->

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <?php
$this->load->view('Includes/footerscript');?>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core
            Core.init();

            // Init Demo JS
            Demo.init();
            $(".other-qty-btn").on("click", function() {
                $(this).closest(".panel-body").find(".other-qty-details").slideToggle();
                if ($(this).find('.fa').hasClass("fa-plus")) {
                    $(this).find('.fa').removeClass("fa-plus").addClass("fa-minus");
                } else if ($(this).find('.fa').hasClass("fa-minus")) {
                    $(this).find('.fa').removeClass("fa-minus").addClass("fa-plus");
                }
            });
        });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>