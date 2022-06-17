<?php 

$currentPage="Backup";
$pageBack=base_url()."Settings/FinancialYear/";
    $addPage=base_url()."Settings/Backup/save/";
    $itemunit=base_url()."Settings/ItemUnit/";
    $addButton="Create";

    $backup=base_url()."Settings/Backup/";
$DownloadPage=base_url();
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
            <header id="topbar" class="ph10">
                <div class="topbar-left">
                    <ul class="nav nav-list nav-list-topbar pull-left">
                       <li>
                            <a href="<?=$pageBack?>">Financial Year</a>
                        </li>
                        <?php  if (check_role_assigned('backup','view')) {?>
                        <li class="active">
                            <a href="<?=$backup?>"><?=$currentPage?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php  if (check_role_assigned('backup','add')) {?>
                <div class="topbar-right">
                    <a href="<?=$addPage?>" class="btn btn-default btn-sm light fw600 ml10">
                        <span class="fa fa-plus pr5"></span> <?=$addButton?></a>
                </div>
                <?php }?>
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
                                <span class="glyphicon glyphicon-tasks"></span>Backup</div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-hover" id="datatable">

                            
                                <thead>
                                    <tr>
                                        <th class="w20">#</th>
                                        <th>Backup Date And Time</th>
                                        <th>Backup By</th>                                    

                                        <th class="w100 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
              $i=1;
                foreach($Backup as $post)
                { 

                    $date=date_create_from_format('Y-m-d H:i:s',$post->created_on);
                    $date=date_format($date,'d/m/Y H:i:s');
                    $download="#";
                    if(trim($post->file_name)!="")
                    {
                        $download=$DownloadPage.$post->file_name;
                    }
                ?>
                
                <tr>
                <td><?=$i++?></td>

                <td><?=$date?></td>
                <td><?=$post->backup_by?></td>
                
                <td class="text-center"> <?php 
                  if (check_role_assigned('backup', 'view')) {
                      
                      echo '<a href="'.$download.'" title="Download Backup" class="btn btn-default btn-xs" ><i class="fa fa-download"></i></a>';
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



        $(document).on('click','.change-status',function(){

  var id=$(this).data('id');
  $.post('<?=base_url('Settings/FinancialYear/ChangeStatus')?>',{id:id},function(data){
    data=$.parseJSON(data);
//
    if(data.status==1)
    {
      $('#status_'+id).html(data.html);    
    }else if(data.status==2)
    {
      $('#status_'+data.old).html(data.html); 
      $('#status_'+data.new).html(data.html2); 

    }

  });

});


        });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>