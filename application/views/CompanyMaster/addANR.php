<?php 
  $currentPage="Company ANR Number";
  $PageBack=base_url()."CompanyMaster/";
  $PageSave=base_url()."CompanyMaster/saveANR";
  $pageBack=base_url()."CompanyMaster/";
  $operation = "Add";
  
  

$val_start_date=date('d/m/Y');
$val_end_date=date('d/m/Y');
$val_status=1; 
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  
      
      $val_anr_no= StringRepair3($companyanr->anr_no);
      $val_start_date= date_create_from_format('Y-m-d',$companyanr->start_date);
    $val_start_date=date_format($val_start_date,'d/m/Y');
      $val_end_date= date_create_from_format('Y-m-d',$companyanr->end_date);
      $val_end_date=date_format($val_end_date,'d/m/Y');
      $val_status= StringRepair3($companyanr->status);

    
  }
  
  $managePage = $operation . " Company Master"; 


?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');

    
    $this->load->view('Includes/tablecss');
    
    ?>

    
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
                                    <span>Company Master</span>
                                </a>
                            </li>
                        </ol>
                    </div>
                </header>
                <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- begin: .tray-center -->
                <div class="tray tray-center">

                    <?php 
                    
                     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'CompanyMasterfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
                    ?>
                        <!-- Input Fields -->
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title">
                                  <ul class="nav panel-tabs-border panel-tabs  panel-tabs-left">
                                <li >
                                    <a href="<?=base_url('CompanyMaster/add/'.$companyid)?>">Company Details</a>
                                </li>
                                <?php 
                                if($companyid!=0 && $companyid!=""):
                                ?>
                                <li class="active">
                                    <a href="<?=base_url('CompanyMaster/addANR/'.$companyid)?>" id="item-palleting-tab">ARN Number</a>
                                </li>
                                <?php endif;?>
                            </ul>
                                </span>
                            </div>
                             <input type="hidden" name="id" value="<?= $id; ?>">
                              <input type="hidden" name="companyid" value="<?= $companyid; ?>">
                            <div class="panel-body">
                                <?php 
                                
                                
                                    editbox('4','ARN No.','anr_no','Enter ARN No',$val_anr_no,'required');
                                    datepicker('4','Start Date','start_date','Enter Start Date',$val_start_date,'required');
                                    datepicker('4','End Date','end_date','Enter End Date',$val_end_date,'required');
                                                       checkbox($val_status,'Active','status');         
                                    echo "<div class='clearfix'></div>";

                                    
                                    echo "<div class='col-md-12'><button class='btn btn-primary btn-sm'>Save</button></div>";
                                    echo "<div class='clearfix'></div>";
                                    form_divider('ANR NUMBER');
                                ?>
                                    <div class="col-lg-12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="primary">
                                            <th>ANR No.</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabledata">
                                        
                                        <?php
                                        if(count($anrnolist)>0):
                                        foreach($anrnolist as $post):
                                        $start_date=date_create_from_format('Y-m-d',$post->start_date);
                                        $start_date=date_format($start_date,'d/m/Y');
                                        $end_date=date_create_from_format('Y-m-d',$post->end_date);
                                        $end_date=date_format($end_date,'d/m/Y');
                                        $status="<span class='badge badge-danger'>In Active</span>";
                                        if($post->status==1)
                                        {
                                            $status="<span class='badge badge-success'>Active</span>";
                                        }
                                       ?>
                                       <tr>
                                       <td><?=$post->anr_no?></td>
                                       <td><?=$start_date?></td>
                                       <td><?=$end_date?></td>
                                       <td><?=$status?></td>
                                            <td>
                                                    <div class=btn-group><a href='<?=base_url('CompanyMaster/addANR/'.$companyid."/".$post->id)?>' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a>
                                                                                        </div>
                                                                                        <div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='<?=$post->id?>'><span class='fa fa-minus'></span></a>
                                                                                        </div>
                                            </td>
                                           
                                        </tr>
                                        <?php 
                                        endforeach;
                                        else:
                                        echo "<tr><td colspan='5' style='text-align:center;'>No Record(s) added yet</td></tr>";
                                        endif;
                                         ?>
                                        </tbody>
                                    </table>
                                    </div>
                            
                            </div>
                            
                        </div>
                    <?php 
                        echo form_close();
                    ?>
                </div>
                <!-- end: .tray-center -->

            </section>
            <!-- End: Content -->

 <?php $this->load->view('Includes/footer'); ?>

        </section>

    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <?php
     $this->load->view('Includes/footerscript'); 
        $this->load->view('Includes/tablejs');
    ?>

    

    <script type="text/javascript">

    $(document).on('click','.removetr',function(){

        var id=$(this).data('id');
          swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this Records!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                         window.location.href='<?=base_url('CompanyMaster/deleteANR/'.$companyid.'/')?>'+id;

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
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core    
            Core.init();

            // Init Demo JS  
            Demo.init();

            // Init Select2 - Basic Single
            $(".select2-single").select2();

            // Init DateRange plugin
            //$('.datetimepicker').daterangepicker({
                $('.datetimepicker').datepicker({
                    dateFormat: 'dd/mm/yy'
            });

    

        });
    </script>
    <!-- END: PAGE SCRIPTS -->

</body>

</html>