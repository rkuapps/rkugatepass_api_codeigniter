<?php 

$currentPage="JW CHALLAN";
$pageBack=base_url()."Jobwork_challan/outword/";
    $addPage=base_url()."Jobwork_challan/outword/add/";
    $planpage=base_url()."Jobwork_challan/outword/";
    $deletePage=base_url()."Jobwork_challan/outword/delete/";
    $addButton="Add";
    $InwordPage=base_url()."Jobwork_challan/Inword/index/";
$PrintPage=base_url()."Jobwork_challan/outword/Print/";
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
                                <span>JW CHALLAN</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <?php  if (check_role_assigned('jobwork_challan', 'add')) { ?>
                <div class="topbar-right">
                    <a href="<?=$addPage?>" class="btn btn-default btn-sm light fw600 ml10">
                        <span class="fa fa-plus pr5"></span> <?=$addButton?> </a>
                </div>
                <?php } ?>
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
                                <span class="glyphicon glyphicon-tasks"></span>JW CHALLAN</div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="w20">#</th>
                                        <th>Date</th>
                                        <th>Challan No</th>
                                        <th>JW Company</th>
                                        <th>Status</th>
                                        <th class="w150 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($outwordlist as $post) {
                                        $i++; 
                                            $date=date_create_from_format('Y-m-d',$post->challan_date);
                                            $date=date_format($date,'d/m/Y');
                                            $status='<span class="badge badge-default" data-id="'.$post->id.'">Close</span>';
                                            if($post->status==0)
                                            {
                                            $status='<span class="badge badge-success" data-id="'.$post->id.'" >Open</span>';
                                            }
                                        ?>

                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $date ?></td>
                                            <td><?= $post->challan_no ?></td>
                                            <td><?= $post->company_name ?></td>
                                            <td><?= $status ?></td>
                                            <td class="text-center">
                                            <?php  if (check_role_assigned('jobwork_challan', 'view')) { ?>
                                            <div class="btn-group">
                                                    <a href="<?php echo $InwordPage.$post->id ?>" class="btn btn-default btn-xs" id="viewDetail" target="_blank">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="<?php echo $PrintPage.$post->id ?>" target='_()' class="btn btn-default btn-xs" id="viewDetail">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                </div>
                                                <?php } if (check_role_assigned('jobwork_challan', 'edit')) { ?>
                                                <div class="btn-group">
                                                    <a href="<?php echo $addPage.$post->id ?>" class="btn btn-warning btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                                <?php } if (check_role_assigned('jobwork_challan', 'delete')) {
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
            if (window.matchMedia('(max-width: 900px)').matches)
            {
            $('#datatable').dataTable({
                dom: '<"top"fl>rt<"bottom"ip>',
                 "order": [],
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
            }
            else{
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