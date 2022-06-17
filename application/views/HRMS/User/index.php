<?php 

$currentPage="User";
$pageBack=base_url()."HRMS/User/";
    $addPage=base_url()."HRMS/User/add/";
    $deletePage=base_url()."HRMS/User/Delete/";
    $addButton="Add";

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
                                <span>User</span>
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
                                        <th class="fixed-wd-number">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Contact No.</th>
                                        <th>Role</th>
                                        <th class="fixed-wd-th text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
              $i=1;

                foreach($user as $post)
                {
                   
                ?>
                
                <tr>
                <td><?=$i++?></td>
                <td><?=$post->user_fullname?></td>
                <td><?=$post->user_email?></td>
                <td><?=$post->user_name?></td>
                <td><?=$post->user_mob?></td>
                <td><?=$post->user_role?></td>
                
                <td class="text-center">  <?php 
                  if (check_role_assigned('user', 'edit')) {
                      echo anchor($addPage . $post->id, '<i class="fa fa-edit"></i>', ['title'=>'Edit User','class' => 'btn btn-warning btn-xs', 'style' => 'margin-right:5px; margin-top:1px;']);
                  }
                  if (check_role_assigned('user', 'delete')) {
                      echo '<a href="#" onclick="javascript:deleteBox(' . $post->id . ')" title="Delete User" class="btn btn-danger btn-xs cancel "><span class="fa fa-trash "></span></a>';
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