<?php 

$currentPage="Country Master";
$pageBack=base_url()."Settings/CountryMaster/";
    $addPage=base_url()."Settings/CountryMaster/add/";
    $deletePage=base_url()."Settings/CountryMaster/Delete/";
    $addButton="Add Country Master";

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

<body class="ecommerce-page">

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
                                <span>Country Master</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="topbar-right">
                    <a href="<?=$addPage?>" class="btn btn-default btn-sm light fw600 ml10">
                        <span class="fa fa-plus pr5"></span> <?=$addButton?> </a>
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
                                <span class="glyphicon glyphicon-tasks"></span><?=$currentPage?></div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-hover" id="datatable">

                            
                                <thead>
                                    <tr>
                                    <th class="w20">#</th>
                                        <th>Country Name</th>
                                        <th>Short Name</th>
                                        <th class="w100 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
              $i=1;

                foreach($CountryMaster as $post)
                {
                ?>
                
                <tr>
                <td><?=$i++?></td>
            
                <td><?=$post->country_name?></td>
                <td ><?=$post->short_name?> </td>
                <td class="text-center"> <?php 
                  if (check_role_assigned('country_master', 'edit')) {
                      echo "<div class='btn-group'>".anchor($addPage . $post->id, '<i class="fa fa-pencil"></i>', ['title'=>'Edit Country','class' => 'btn btn-primary btn-xs', 'style' => 'float:left; margin-right:5px; margin-top:1px;']);
                    echo '</div>';
                  }
                  if (check_role_assigned('country_master', 'delete')) {
                      echo '<div class="btn-group"><a href="#" onclick="javascript:deleteBox(' . $post->id . ')" title="Delete Country" class="btn btn-danger btn-xs cancel "><span class="fa fa-trash-o"></span></a>';
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

            
 $('#datatable').dataTable({
                dom: '<"top"fl>rt<"bottom"ip>',
                 "order": [],
                "scrollX": true,
    'columnDefs': [ {
        'targets': [-1,0], lengthChange: false,
         'orderable': false}]
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