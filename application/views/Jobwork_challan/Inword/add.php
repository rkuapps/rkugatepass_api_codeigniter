<?php 
  $currentPage="Order";
  $PageBack=base_url()."Jobwork_challan/Inword/";
  $PageSave=base_url()."Jobwork_challan/Inword/save";
  $pageBack=base_url()."Jobwork_challan/Inword/";
  $operation = "Add";
  $saveItem=base_url()."Jobwork_challan/Inword/saveItem";
$deleteItem=base_url()."Jobwork_challan/Inword/deleteItem";
$DeleteDocument=base_url()."Jobwork_challan/Inword/deleteDocument/".$id;
$getItemData=base_url()."Jobwork_challan/Inword/SingleItem/";    
$getCurrency=base_url()."Jobwork_challan/Inword/getCurrency/";
  $val_inword_date=date('d/m/Y');
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  
      $val_inword_date = StringRepair3($outword->inword_date);
      $val_challan_no=StringRepair3($outword->challan_no);
  }
  $temp="";
if($val_orderno!="")
{
    $temp=" - ".$val_orderno;
}

  


?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');

    
    $this->load->view('Includes/tablecss');
    
    ?>
<style>
    input::-webkit-calendar-picker-indicator {
  display: none;
}
#total
{
    cursor:not-allowed;
}
</style>
    
</head>

<body class="ecommerce-page sb-l-m">
<div class="loading" style="display:none;">Loading…</div>
    <!-- Start: Main -->
    <div id="main"> 

        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">

                <!-- Start: Topbar -->
                
                   <header id="topbar">
                <div class="topbar-left">
                    <ul class="nav nav-list nav-list-topbar pull-left">
                        <li class="active ">
                            <a href="<?=base_url('Jobwork_challan/Inword/index/'.$outwordid)?>">INWARD <?=$temp?></a>
                        </li>
                    </ul>
                </div>
            </header>
            
                <!-- End: Topbar -->

             <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- begin: .tray-center -->
                <div class="tray tray-center">
                    <div class='panel' style='padding:10px 10px 10px 10px'>
                    <table class='table'>
                    <tr><td colspan="4" align='center'><h3>JW CHALLAN - <?= $outworddata->challan_no ?></h3></td></tr>
                    <tr>
                        <th>Date:</th>
                        <td><?= $outworddata->challan_date ?></td>
                        <th>Challan No:</th>
                        <td><?= $outworddata->challan_no ?></td>
                    </tr>
                    <tr>
                        <th>JW Company:</th>
                        <td><?= $outworddata->company_name ?></td>
                        <th>Total Weight:</th>
                        <td><?= $outworddata->weight ?></td>
                    </tr>
                    </table>
                    </div>
                    <!-- Input Fields -->
                    <div class="panel">
                        <div class="panel-heading">
                            
                        <ul class="nav panel-tabs-border panel-tabs  panel-tabs-left">
                                <?php
                                if ($id!="" && $id!=0) {
                                echo '<li class="active">';
                                }else{
                                    echo '<li class="active">';
                                }?>
                                    <a href="#order_from" data-toggle="tab" aria-expanded="false">INWARD</a>
                                </li>
                               
                            </ul>    
                        </div>
                        <div class="panel-body ">
                            <div class="tab-content br-n pn">

                            <div id="order_from" >
                                <div class="row">
                                <?php echo form_open($PageSave, ['name' => 'frm1', 'id' => 'Orderfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform tab-pane active']); ?>
                                                    <input type="hidden" name="id" value="<?=$id?>">
                                                    <input type="hidden" name="outwordid" id='outwordid' value="<?=$outwordid?>">
                                    <?php 
                                   
                                   datepicker('6','Date','inword_date','Select Outword Date',$val_inword_date,'required');
                                  
                                    
                                    echo '<div class="clearfix"></div>';
                                    echo '<div style="margin:10px">';
                                    Submitbutton($pageBack);
                                    echo  '</div>';
                                echo form_close(); ?>
                                  </div></div>
                                  <?php if($id != 0 && $id != ""){?>
                                <div id="item_form" >
                                 <div class="row">
                                     <?php
                                    echo '<input type="hidden" name="subid" id="subid" value="0">';
                                    echo "<div class='clearfix'></div>";
                                    dropdownbox('5','JW Item Name','item_id',$itemlist,$val_item_id);
                                    editbox('5','Weight','weight','Enter Weight',$val_weight);
                                    echo "  <div class='col-md-2'>";
                                    echo "<button class='btn btn-success mt25' id='btnAddMetal' style='width:100%'><span class='fa fa-plus pr5'></span>Add</button>";
                                    echo "</div>";
                                    echo "<div class='clearfix'></div>";
                                   
                                    ?>
                                  
                                <div class="col-md-12 admin-form theme-success ">
                                    <div class="section-divider mb30">
                                        <span class=" bg-white">Item Details</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr class="success">
                                              
                                                <th>JW Item Name</th>
                                                <th>HSN Code</th>
                                                <th>Weight</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="metalTable">
                                        <?php foreach($Inworditems as $post)
                                        { 
                                        
                                            echo "
                                            <tr id='item_tr_".$post->id."'>
                                            <td>".$post->jw_itemname."</td>
                                            <td>".$post->hsn_code."</td>
                                             <td>".$post->weight."</td>
                                             <td>
                                                 
                                                     <div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='".$post->id."'><span class='fa fa-edit'></span></a>
                                                     </div>
                                                     <div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$post->id."'><span class='fa fa-minus'></span></a>
                                                     </div>
                                             </td>
                                         </tr>
                                         ";
                                             } ?>
                                        </tbody>
                                    </table>
                            </div>
                                            </div>
                                            <?php } ?>
                                        </div>

                                    <!-- Order Form end -->


                            
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- end: .tray-center -->

            </section>
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
        dateFormat: 'dd/mm/yy',
           prevText: '<i class="fa fa-chevron-left"></i>',
nextText: '<i class="fa fa-chevron-right"></i>',
showButtonPanel: false,
beforeShow: function(input, inst) {
    var newclass = 'admin-form';
    var themeClass = $(this).parents('.admin-form').attr('class');
    var smartpikr = inst.dpDiv.parent();
    if (!smartpikr.hasClass(themeClass)) {
        inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
    }
    }
});


$('#customerid').on('change',(e) => {
    
    let id=$(e.target).val();
    $.get('<?=$getCurrency?>'+id,(data)=>{
        if(data!=0)
        {
            data=$.parseJSON(data);
        $('.amtSymbol').html("Total Amount ( "+data.symbol+" )");
        $('.pricechange').html("Price ( "+data.symbol+" )");
        $('.pricechange1').html("Extended Price ( "+data.symbol+" )");
        $('.newsymbol').html("( "+data.symbol+" )");
        symbol="( "+data.symbol+" )";
        }else{
                    $('.amtSymbol').html("Total Amount");
                    $('.pricechange').html("Price");
                    $('.pricechange1').html("Extended Price");
                    $('.newsymbol').html('');
                    symbol="";
        }
    
        
    });
});
    $('#Orderfrom').submit(function(e){

        var customerid=$('#customerid').val();
       
        
        var error="0";
        if(customerid==0)
        {
            error="Select Customer";
        }    
                if(error!="0")
            {
                e.preventDefault();
                
                  alertbox('Error',error,'danger');
            }
    });

$('.select2-container').attr("style","width:100% !important;");


$(document).on('click','.edittr',function(e){

var id=$(this).data('id');

$('.loading').show();
    $.get('<?=$getItemData?>'+id,function(data){    
        
        data=$.parseJSON(data);
        $('#subid').val(data.id);
        $('#item_id').val(data.item_id).trigger('change');
        //$('#unique_no').select2('val',data.unique_no);
        $('#weight').val(data.weight);
        $('#btnAddMetal').html('Update Item').removeClass('btn-success').addClass('btn-info');
        $('.loading').hide();
    });
});

$('#btnAddMetal').click(function(e){
   
   
   var subid=$('#subid').val();
   var item_id=$('#item_id').val();
    var weight=$('#weight').val();
    var outwordid=$('#outwordid').val();
    var error="0";
    
    if(item_id==0)
        {
            error="Select Item";
        }
     
        // else if(discount!="" && discount<0)
        // {
        //     error="Discount Must be Grater Than 1";
        // }
                if(error!="0")
            {
                e.preventDefault();
                
                alertbox('Error',error,'danger');
            }else{
                $('.loading').show();

                    //,'discount':discount
                    $.post('<?=$saveItem?>',{'subid':subid,'inwordid':<?=$id?>,'item_id':item_id,'weight':weight,'outwordid':outwordid},function(data){
                           console.log(data);
                            data=$.parseJSON(data);
                            if(data.status==1)
                             {
                                $('#metalTable').append(data.html);
                         
                          
                            alertbox("Added","Outword Item Added Successfully",'success');
                            
                            }else if(data.status==2){

                                alertbox("Updated","Outword Item Updated Successfully",'success');
                    
                        
                                $('#item_tr_'+subid).html(data.html);
                                
                            $('#btnAddMetal').html('Add Item').removeClass('btn-info').addClass('btn-success');
                            }
                            $('.loading').hide();
                            $('#subid').val(0);
                            $('#item_id').val(0);
                            $('#item_id').select2('val','0');
                                $('#weight').val('');
                            
                    });

            }

});

// $('#discount').on('change',function(){

//     var discount=$(this).val();
//     var amount=$('#amount').val();
//     $('#total').val((amount-discount));
   
// });




$(document).on('click','.removetr',function(){
        var freight=$('#freight').val();
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

                            $('.loading').show();
                        $.post('<?=$deleteItem?>',{'id':id},function(data){
                            
                            
                            data=$.parseJSON(data);
                            if(data.status==1)
                            {
                             
                               $('#item_tr_'+id).remove();
                               
                            }
                              alertbox("Deleted","Record Deleted Successfully",'success');
                            $('.loading').hide();
                            
                    });

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