<?php 
  $currentPage="Company Person";
  $PageBack=base_url()."Settings/JobWorkerMaster/";
  $PageSave=base_url()."Settings/JobWorkerMaster/savePerson";
  $pageBack=base_url()."Settings/JobWorkerMaster/";
  $operation = "Add";
  
  

  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  
      
      $val_email= StringRepair3($customerperson->email);
      $val_name= StringRepair3($customerperson->name);
      $val_designation= StringRepair3($customerperson->designation);
      $val_number= StringRepair3($customerperson->contact_no);
      $val_status= StringRepair3($customerperson->status);

    
  }
  
  $managePage = $operation . " Company Management"; 


?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');

    
    $this->load->view('Includes/tablecss');
    
    ?>

    
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
                                    <span>Job Worker Master</span>
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
                                    <a href="<?=base_url('Settings/JobWorkerMaster/add/'.$customerid)?>">Job Worker Details</a>
                                </li>
                                <?php 
                                if($customerid!=0 && $customerid!=""):
                                ?>
                                <li class="active">
                                    <a href="<?=base_url('Settings/JobWorkerMaster/addPerson/'.$customerid)?>" id="item-palleting-tab">Contact Person</a>
                                </li>
                                <?php endif;?>
                            </ul>
                                </span>
                            </div>
                             <input type="hidden" name="id" value="<?= $id; ?>">
                              <input type="hidden" name="customerid" value="<?= $customerid; ?>">
                            <div class="panel-body">
                                <?php 
                                    editbox('2','Name','name','Enter Name',$val_name,'required');
                                    editbox('2','Designation','designation','Enter Designation',$val_designation);
                                    emailbox('3','Email','email','Enter Email Address',$val_email);
                                    phonebox('2','Contact Number','phonenumber','Enter Contact Number',$val_number);
                                    dropdownbox('2','Priority','status',$status,$val_status);
                                    if($customerid!=0 && $id!=0)
                                    {
                                    echo "<div class='col-md-6'><button class='btn btn-primary btn-sm'>SAVE</button></div>";
                                    }
                                    else
                                    {
                                        echo "<div class='col-md-6'><button class='btn btn-primary btn-sm'>ADD</button></div>";   
                                    }
                                    form_divider('AddPerson');
                                ?>
                                    <div class="col-lg-12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="primary">
                                            <th>Name</th>
                                                <th>Designation</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabledata">
                                        


                                        <?php
                                        if(count($personlist)>0):
                                        foreach($personlist as $post):
                                       
                                        if($post->status==0)
                                        {
                                            $status=" <span class='badge badge-primary'>Primary</span>";
                                        }
                                        elseif($post->status==1)
                                        {
                                            $status="<span class='badge badge-warning'>Secondary</span>";
                                        }
                                        else
                                        {
                                            $status=" <span class='badge'>Other</span>";
                                        }
                                       ?>
                                       <tr>
                                       <td><?=$post->name?></td>
                                       <td><?=$post->designation?></td>
                                       <td><?=$post->email?></td>
                                       <td><?=$post->contact_no?></td>
                                       <td><?=$status?></td>
                                       
                                            <td>
                                            <div class=btn-group><a href='<?=base_url('Settings/JobWorkerMaster/addPerson/'.$customerid."/".$post->id)?>' class='btn btn-warning btn-xs'><span class='fa fa-edit'></span></a>

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

                         window.location.href='<?=base_url('Settings/JobWorkerMaster/deletePerson/'.$customerid.'/')?>'+id;

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