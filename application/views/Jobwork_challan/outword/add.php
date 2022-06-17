<?php 
    $currentPage="JW CHALLAN";
    $PageBack=base_url()."Jobwork_challan/outword/";
    $PageSave=base_url()."Jobwork_challan/outword/save";
    $pageBack=base_url()."Jobwork_challan/outword/";
    $operation = "Add";
    $saveItem=base_url()."Jobwork_challan/outword/saveItem";
    $deleteItem=base_url()."Jobwork_challan/outword/deleteItem";
    $DeleteDocument=base_url()."Jobwork_challan/outword/deleteDocument/".$id;
    $getItemData=base_url()."Jobwork_challan/outword/SingleItem/";    
    $getCurrency=base_url()."Jobwork_challan/outword/getCurrency/";
    $val_outword_date=date('d/m/Y');
    $val_supply='GUJRAT';
    $freightlist=array('0'=>'PAID','1'=>'To Pay');
    $val_challan_no = $challan_no;
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  
      $challan_date = date_create_from_format('Y-m-d',$outword->challan_date);
	  $val_outword_date = date_format($challan_date,'d/m/Y');
      $val_jobworkerid=StringRepair3($outword->jobworker_id);
      $val_challan_no=StringRepair3($outword->challan_no);
      $val_status=StringRepair3($outword->status);
      $val_dispatched_by=StringRepair3($outword->dispatched_by);
      $val_freight=StringRepair3($outword->freight_terms);
      $val_amount=StringRepair3($outword->amount);
      $val_supply=StringRepair3($outword->place_to_supply);
      $val_expected_item=explode(',',$outword->expected_item);
      $val_note=StringRepair3($outword->note);
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
                            <a href="<?=base_url('Jobwork_challan/Outword')?>">JW CHALLAN <?=$val_challan_no?></a>
                        </li>
                    </ul>
                </div>
            </header>
            
                <!-- End: Topbar -->

             <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">

                <!-- begin: .tray-center -->
                <div class="tray tray-center">
                    
                    <!-- Input Fields -->
                    <div class="panel">
                        <div class="panel-heading">
                        <ul class="nav panel-tabs-border panel-tabs  panel-tabs-left">
                                <?php
                                if ($id!="" && $id!=0) {
                                echo '<li>';
                                }else{
                                    echo '<li class="active">';
                                }?>
                                    <a href="#order_from" data-toggle="tab" aria-expanded="false">JW CHALLAN</a>
                                </li>
                                <?php
                                if ($id!="" && $id!=0) {
                                ?><li class="active">
                                            <a href="#item_form" data-toggle="tab" aria-expanded="false">Challan Items</a>
                                        </li>
                                        <?php 
                                }
                                ?>
                            </ul>      
                      
                        </div> 
                        <div class="panel-body ">
                            <div class="tab-content br-n pn">

                            <div id="order_from" class="tab-pane <?php if ($id==0) { echo 'active';}?>">
                                <div class="row">
                                <?php echo form_open($PageSave, ['name' => 'frm1', 'id' => 'Orderfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform tab-pane active']); ?>
                                    <input type="hidden" name="id" value="<?=$id?>">
                                    <input type="hidden" name="challan_no" value="<?=$val_challan_no?>">
                                    <?php 
                                   datepicker('3','Date','outword_date','Select Outword Date',$val_outword_date,'required');
                                   dropdownbox('3','JobWorker Name','jobworkerid',$jobworkerlist,$val_jobworkerid,'required');
                                   editbox('3','Dispatched By','dispatched_by','Enter Dispatcher',$val_dispatched_by);
                                   editbox('3','Place To Supply','place_supply','Enter Place To Supply',$val_supply);
                                   dropdownbox('3','Freight Terms','freight_term',$freightlist,$val_freight); 
                                   editbox('3','Challan Amount','challan_amount','Enter Amount',$val_amount);
                                   dropdownbox('3','Status','status',$Statuslist,$val_status);                                
                                   textareabox('12','Note','note','Enter Note',$val_note);
                                    // editbox('4','Mode Of Transport','mode_of_transport','Enter Mod Of Transport',$val_mode_of_transport,'list="mod_of_transportlist" required');
                                    // datalistbox($mod_of_transportlist,'mod_of_transportlist');
                                    echo "<div class='clearfix'></div> <div style='margin:10px'>";
                                    Submitbutton($pageBack);
                                    echo "</div>";
                                echo form_close(); 

                                ?>
                                  </div></div>
                                <div id="item_form" class="tab-pane <?php
                                if ($id!="" && $id!=0) { echo 'active'; }
                                ?>">
                                 <div class="row">
                                <?php
                                    echo '<input type="hidden" name="subid" id="subid" value="0">';
                                    echo "<div class='clearfix'></div>";
                                
                                    dropdownbox('3','JW Item Name','item_id',$itemlist,'');
                                    editbox('3','Process','process','Enter Process','');
                                    numberbox('2','Bags','bags','Enter Bags','0');
                                    editbox('2','Weight','weight','Enter Weight','0');
                                    editbox('2','Rate','rate','Enter Rate','0');
                                    editbox('2','Amount','amount','Enter Amount','0','disabled');
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
                                                <th>Process</th>
                                                <th>Bags</th>
                                                <th>Weight</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="metalTable">
                                        <?php foreach($outworditems as $post)
                                        { 
                                        
                                            echo "
                                            <tr id='item_tr_".$post->id."'>
                                             <td>".$post->jw_itemname."</td>
                                             <td>".$post->hsn_code."</td>
                                             <td>".$post->process."</td>
                                             <td>".$post->bags."</td>
                                             <td>".$post->weight."</td>
                                             <td>".$post->rate."</td>
                                             <td>".$post->amount."</td>
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
        $('#process').val(data.process);
        $('#weight').val(data.weight);
        $('#bags').val(data.bags);
        $('#rate').val(data.rate);
        $('#amount').val(data.amount);
        $('#btnAddMetal').html('Update Item').removeClass('btn-success').addClass('btn-info');
        $('.loading').hide();
    });
});

$('#btnAddMetal').click(function(e){
   
   
   var subid=$('#subid').val();
   var item_id=$('#item_id').val();
    var process=$('#process').val();
    var weight=$('#weight').val();
    var bags=$('#bags').val();
    var rate=$('#rate').val();
    var amount=$('#amount').val();
    var error="0";
    
    if(item_id==0)
        {
            error="Select Item";
        }
        if(error!="0")
        {
            e.preventDefault();
            
            alertbox('Error',error,'danger');
        }else{
            $('.loading').show();

                //,'discount':discount
                $.post('<?=$saveItem?>',{'subid':subid,'outwordid':<?=$id?>,'item_id':item_id,'process':process,'weight':weight,'bags':bags,'rate':rate,'amount':amount},function(data){
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
                        $('#process').val('');
                        $('#weight').val('0');
                        $('#bags').val('0');
                        $('#rate').val('0');
                        $('#amount').val('0');
                        
                });

        }

});

 $('#rate,#weight').on('change',function(){
    var rate=parseFloat($('#rate').val());
    var weight=parseFloat($('#weight').val());
    $('#amount').val(((parseFloat(rate*weight)).toFixed(2)));
   
});


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