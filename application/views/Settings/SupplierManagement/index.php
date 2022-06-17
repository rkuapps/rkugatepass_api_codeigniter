<?php 

$currentPage="Supplier Management";
$pageBack=base_url()."Settings/SupplierManagement/";
    $addPerson=base_url()."Settings/SupplierManagement/addPerson/";
    $addPage=base_url()."Settings/SupplierManagement/add/";
    $deletePage=base_url()."Settings/SupplierManagement/Delete/";
    $addButton="Add Supplier";
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
                                <span>Supplier Management</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <?php  if (check_role_assigned('supplier','add')) {?>
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
                                <span class="glyphicon glyphicon-tasks"></span><?=$currentPage?></div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-hover" id="datatable">

                            
                                
                            
                                <thead>
                                    <tr>
                                    <th class="w20">#</th>
                                        <th>Supplier Name</th>
                                        <th>GST Number</th>
                                        <th>Contact Person</th>  
                                        <th>Contact Number</th>  
                                        <th>State</th>  
                                        <th class="w100 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
              $i=1;

                foreach($CustomerManagement as $post)
                {
                ?>
                
                <tr>
                <td><?=$i++?></td>
            
                <td><?=$post->customer_name?></td>
                <td><?=$post->gst_no?></td>
                <td><?=$post->name?></td>
                <td><?=$post->contact_no?></td>
                <td><?=$post->state?></td>
                    
                
                
                <td class="text-center"> <?php 
                 
                 if (check_role_assigned('item', 'view')) {
                     echo "<div class='btn-group'>".anchor($ItemPage . $post->id, '<i class="fa fa-wrench"></i>', ['title'=>'Customer Items','class' => 'btn btn-default btn-xs', 'style' => 'float:left; margin-right:5px; margin-top:1px;']);
                   echo '</div>';
                 }
                
                  if (check_role_assigned('supplier', 'edit')) {
                      echo "<div class='btn-group'>".anchor($addPage . $post->id, '<i class="fa fa-edit"></i>', ['title'=>'Edit Company' ,'class' => 'btn btn-warning btn-xs', 'style' => 'float:left; margin-right:5px; margin-top:1px;']);
                    echo '</div>';
                  }
                  if (check_role_assigned('supplier', 'delete')) {
                      echo '<div class="btn-group"><a href="#" onclick="javascript:deleteBox(' . $post->id . ')" title="Delete Company" class="btn btn-danger btn-xs cancel "><span class="fa fa-trash-o"></span></a>';
                    echo '</div>';
                  }
                  ?>
                </td>
                </tr>
                
                <?php }?>
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
                "scrollX": true,
                "sScrollXInner": "100%",
                    "oLanguage": {
                "sEmptyTable": "No Record(s) added yet."
            }
            });
            }else{
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