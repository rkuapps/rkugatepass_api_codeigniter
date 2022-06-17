<?php 
$currentPage="Purchase Order";
$PageBack=base_url()."PurchaseOrder/";
$PageSave=base_url()."PurchaseOrder/save";
$pageBack=base_url()."PurchaseOrder/";
$operation = "Add";
$addItem=base_url()."Item/add/";
$saveItem=base_url()."PurchaseOrder/saveItem";
$deleteItem=base_url()."PurchaseOrder/deleteItem";
$getItemData=base_url()."PurchaseOrder/SingleItem/".$id."/";    
$val_order_date=date('d/m/Y');
$val_orderno="";
$val_ponumber = $ponumber;
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  
      $val_customerid=StringRepair3($PurchaseOrder->customerid);
      $val_ponumber=StringRepair3($PurchaseOrder->ponumber);
      $val_po_date= date_create_from_format('Y-m-d',$PurchaseOrder->po_date);
      $val_po_date=date_format($val_po_date,'d/m/Y');
      $val_freight=StringRepair3($PurchaseOrder->freight);
      $val_pay_terms=StringRepair3($PurchaseOrder->pay_terms);
      $val_grand_total=StringRepair3($PurchaseOrder->total);

        $symbol="( ".$currencydetail->symbol." )";
        $symbol1=$currencydetail->symbol;
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
                            <a href="<?=base_url('PurchaseOrder')?>">Purchase Order - <?=$val_ponumber?></a>
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
                                    <a href="#order_from" data-toggle="tab" aria-expanded="false">Purchase Order</a>
                                </li>
                                <?php
                                if ($id!="" && $id!=0) {
                                ?><li class="active">
                                            <a href="#item_form" data-toggle="tab" aria-expanded="false">Order Items</a>
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
                                        <input type="hidden" name="ponumber" value="<?=$val_ponumber?>">
                                   <?php 
                                   
                                   
                                   datepicker('4','PO Date','podate','Enter PO Date',$val_po_date);
                                   dropdownbox('4','Supplier Name','customerid',$customerlist,$val_customerid,'required');
                                   
                                   editbox('4','Freight','freight','Enter Freight',$val_freight);
                                   echo "<div class='clearfix'></div>";
                                   editbox('4','Payment Terms','pay_terms','Enter Payment Terms',$val_pay_terms);
                                   
                                    numberbox('4','Grand Total' ,'total_amount','Enter Grand Total ',$val_grand_total,'disabled');
                                    
                                        
                                        echo "<div class='clearfix'></div>";
                                        echo '<div style="margin:10px">';
                                        Submitbutton($pageBack);
                                        echo  '</div>';
                                echo form_close(); 
                            ?>


                                            </div>
                                        </div>

                                    <!-- Order Form end -->


                                        <div id="item_form" class="tab-pane <?php
                                if ($id!="" && $id!=0) { echo 'active'; }
                                ?>">
                                            <div class="row">
                                            <input type="hidden" name="subid" id="subid" value="0">
                                                <?php 
                                        $itembutton='<a href='.$addItem.$val_customerid.' target="_()" class="btn btn-info btn-xs"><span class="fa fa-plus"></span></a>';
                                        dropdownbox('4','Item Name  '.$itembutton,'unique_no',$itemlist,'','required');
                                        numberbox('4','PCS','qty','Enter PCS','','required');
                                        numberbox('4','<span class="pricechange"> Rate </span>','amount','Enter Rate','','required');
                                        echo "<div class='clearfix'></div>";
                                        datepicker('4','Delivery Date','delivery_date','Select Date',date('d/m/Y'),'');
                                       
                                        
                                        //numberbox('3','Discount','discount','Enter Discount','','min=1');
                                        numberbox('3','<span class="pricechange1"> Amount </span>','total','Enter Amount','','readonly');
                                    ?>
                                    
                                    <div class="col-lg-12 p10 ">
                                        <button class="btn btn-success" id="addItems" type="button">Add Item</button>
                                    </div>
                                    
                                    <div class="col-lg-12 admin-form theme-primary">
                                        <div class="section-divider mb30">
                                            <span class=" bg-white">Order Items</span>
                                        </div>
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr class="primary">
                                                    <th>Item Name</th>
                                                 
                                                    <th>Delivery Date</th>
                                                    <th>PCS</th>
                                                    <th class="w80"><span class="pricechange">Rate </span> </th>
                                                    <!-- <th class="w80">Discount</th> -->
                                                    <th class="w80"><span class="pricechange1">Amount </span></th>
                                                       
                                                    <th style="width:80px;"></th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="itemdata">
                                                <?php 
                                                foreach($ordersublist as $post)
                                                {
                                                        $delivery_date = date_create_from_format('Y-m-d',$post->delivery_date);
				                                        $delivery_date= date_format($delivery_date,'d/m/Y');
                                                        //<td>".$post->discount."</td>
                                                    echo "
                                                           <tr id='item_tr_".$post->id."'>
                                                            <td>".$post->unique_no."</td>
                                                            <td>".$delivery_date."</td>
                                                            <td>".$post->qty."</td>
                                                            <td>".$post->amount."</td>
                                                            
                                                            <td>".$post->total."</td>
                                                            
                                                            <td>
                                                                
                                                                    <div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='".$post->id."'><span class='fa fa-edit'></span></a>
                                                                    </div>
                                                                    <div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$post->id."'><span class='fa fa-minus'></span></a>
                                                                    </div>
                                                            </td>
                                                        </tr>
                                                         ";
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="primary">
                                                    <th></th>
                                                    <th></th>
                                                    <th>Total</th>
                                                    <th class="item_total_price"><?= sprintf("%0.2f",$item_total_amount) ?><span class="newsymbol"><?=" ".$symbol1?></span></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        
                                        </div>
                                    </div>
                                <!-- Item From End -->

                            
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- end: .tray-center -->
<div id='myModal' class='modal'>
                <div class="modal-dialog panel  panel-default panel-border top">
                    <div class="modal-content">
                        <div id='myModalContent'></div>
                    </div>
                </div>

            </div>
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
    var symbol="<?=$symbol?>";
    var symbol1="<?=$symbol1?>";
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
        $('.amtSymbol').html("Total Amount ");
        $('.pricechange').html("Price ");
        $('.pricechange1').html("Extended Price ");
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
        
        $('#unique_no').val(data.item_id).trigger('change');
        
       // $('#unique_no').select2('val',data.unique_no);
        $('#delivery_date').val(data.delivery_date);
        $('#qty').val(data.qty);
        $('#amount').val(data.amount);
        $('#total').val(data.total);
        $('#addItems').html('Update Item').removeClass('btn-success').addClass('btn-info');
        $('.loading').hide();
    });
});

$('#addItems').click(function(e){
   
   
   var subid=$('#subid').val();
   var unique_no=$('#unique_no').val();
   var date=$('#delivery_date').val();
    var qty=$('#qty').val();
    var amount=$('#amount').val();
    //var discount=$('#discount').val();
    var total=$('#total').val();
    var error="0";
   
    
    if(unique_no==0)
        {
            error="Select Item";
        }else if(date=="")
        {
            error="Enter Date";
        }else if(qty=='')
        {
            error="Enter Quantity";
        }else if(qty<1)
        {
            error="Quantity Must be Grater Than 0";
        }
        else if(amount=="")
        {
            error="Enter Amount";
        }else if(amount<0)
        {
            error="Amount Must be Grater Than 0 ";
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
                    $.post('<?=$saveItem?>',{'subid':subid,'orderid':<?=$id?>,'unique_no':unique_no,'delivery_date':date,'qty':qty,'amount':amount,'total':total},function(data){
                           console.log(data);
                            data=$.parseJSON(data);
                            if(data.status==1)
                            {
                                $('#itemdata').append(data.html);
                            $('.item_total_price').html(parseFloat(data.total).toFixed(2)+' <span class="newsymbol">'+" "+symbol1+'</span>');
                            $('#total_amount').val(parseFloat(data.total).toFixed(2));
                            alertbox("Added","Order Item Added Successfully",'success');
                            
                            }else if(data.status==2){

                                alertbox("Updated","Order Item Updated Successfully",'success');
                    
                        
                                $('#item_tr_'+subid).html(data.html);
                            $('.item_total_price').html(parseFloat(data.total).toFixed(2)+' <span class="newsymbol">'+" "+symbol1+'</span>');
                            $('#total_amount').val(parseFloat(data.total).toFixed(2));
                            $('#addItems').html('Add Item').removeClass('btn-info').addClass('btn-success');
                            }
                            $('.loading').hide();
                            $('#subid').val(0);
                            $('#unique_no').val(0);
                            $('#unique_no').select2('val','0');
                            $('#delivery_date').val('<?=date('d/m/Y')?>');
                                $('#qty').val('');
                                $('#amount').val('');
                             //   $('#discount').val('');
                                $('#total').val('');
                                $('#description').val('');
                            
                    });

            }

});

// $('#discount').on('change',function(){

//     var discount=$(this).val();
//     var amount=$('#amount').val();
//     $('#total').val((amount-discount));
   
// });
$('#amount,#qty').on('change',function(){

    var qty=parseFloat($('#qty').val());
    var amount=parseFloat($('#amount').val());
    var total=amount*qty;
    $('#total').val(total.toFixed(2));
    
});



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

                            $('.loading').show();
                        $.post('<?=$deleteItem?>',{'id':id,'orderid':<?=$id?>},function(data){
                            
                            
                            data=$.parseJSON(data);
                            if(data.status==1)
                            {
                             
                               $('#item_tr_'+id).remove();
                               $('.item_total_price').html(data.total);
                               $('#total_amount').val(data.total);
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
			//console.log(subdata);
		});
    });
    </script>
    <!-- END: PAGE SCRIPTS -->
</body>
</html>