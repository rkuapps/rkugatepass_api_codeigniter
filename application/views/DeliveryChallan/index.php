<?php 

$currentPage="DeliveryChallan";
$pageBack=base_url()."DeliveryChallan/";
$addPage=base_url()."DeliveryChallan/add/";
$planpage=base_url()."DeliveryChallan/plan/";
$deletePage=base_url()."DeliveryChallan/Delete/";
$addButton="Add";

$PrintPage=base_url()."DeliveryChallan/Print/";
    $ItemPage=base_url()."Item/index/";

?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    $this->load->view('Includes/tablecss');
   
    
    ?>


<style>
span
{
  cursor:pointer;
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
                            <a href="<?=$pageBack?>">
                                <span>Delivery Challan</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="topbar-right">
                <?php if (check_role_assigned('deliverychallan', 'add')) { ?>
                    <a href="<?=$addPage?>" class="btn btn-default btn-sm light fw600 ml10">
                        <span class="fa fa-plus pr5"></span> <?=$addButton?> </a>
                <?php } ?>
                </div>
              
            </header>
            <!-- End: Topbar -->

            <div class="row">
                    <div class="col-sm-12">
                
            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">
                
                <!-- begin: .tray-center -->
                <div class="tray tray-center">
                    <div class="panel panel-visible" id="spy3">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <span class="glyphicon glyphicon-tasks"></span>Delivery Challan</div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="w20">#</th>
                                        <th>Delivery No.</th>
                                        <th>Delivery Date</th>
                                        <th>Customer Name</th>
                                        <th>Delivery Amount</th>
                                        <th class="w150 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($Delivery as $post) {
                                        $i++; 
                                            $date=date_create_from_format('Y-m-d',$post->delivery_date);
                                            $date=date_format($date,'d/m/Y');
                                        ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?= $post->deliveryno ?></td>
                                            <td><?= $date ?></td>
                                            <td><?= $post->customer_name ?></td>
                                            <td><?= $post->total ?></td>
                                            <td  class="w150 text-center">
                                            <?php 
                                                 if (check_role_assigned('deliverychallan', 'view')) { ?>
                                                <div class="btn-group">
                                                    <a href="<?php echo $PrintPage.$post->id ?>" class="btn btn-default btn-xs" id="viewDetail" target="_blank">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                </div>
                                                <?php }
                                                 if (check_role_assigned('deliverychallan', 'edit')) { ?>
                                                <div class="btn-group">
                                                    <a href="<?php echo $addPage.$post->id; ?>" class="btn btn-warning btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                                <?php }
                                                 if (check_role_assigned('deliverychallan', 'delete')) {
                                                    echo '<div class="btn-group"><a href="#" onclick="javascript:deleteBox(' . $post->id . ')" title="Delete Invoice" class="btn btn-danger btn-xs cancel "><span class="fa fa-trash-o"></span></a>';
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
               <!-- end: .tray-center -->
                <input type="hidden" name="delid" id="delid" value="0">
            </section>
            </div>
            </div>
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

            $('#datatable').dataTable({
                dom: '<"top"fl>rt<"bottom"ip>',
                 "Invoice": [],
                "scrollX": true,
    'columnDefs': [ {
        'targets': [-1,0], lengthChange: false,
         'orderable': false},{ type: 'date-eu', targets: 2 }]
                ,
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

                       window.location.href="<?=$deletePage?>"+delid; 

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