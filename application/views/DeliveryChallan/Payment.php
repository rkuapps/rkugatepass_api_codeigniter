<?php     
$saveItem=base_url()."Invoice/saveItem/";
$deleteItem=base_url()."Invoice/deleteItem/";
$getItemData=base_url()."Invoice/SingleItem/";

  if ($id != "" && is_numeric($id)) {
 
    $val_invoiceno= StringRepair3($Invoice->invoiceno);
        $packingid=$Invoice->packingid;

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
#price_in_inr
{
    cursor:not-allowed;
}
.w70
{
width:70px;

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
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="<?=base_url('Invoice')?>">
                                <span>Invoice - <?=$val_invoiceno?></span>
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="topbar-right">
                <a class="btn btn-default" href="<?=base_url('PackingList/add/'.$packingid)?>"><i class="fa fa-arrow-left"></i> Go To Packing list</a>
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
                                <li >
                                    <a href="<?=base_url('Invoice/add/'.$id)?>">Invoice</a>
                                </li>
                                <?php 
                                if($id!=0 && $id!=""):
                                ?>
                                <li >
                                    <a href="<?=base_url('Invoice/InvoiceItem/'.$id)?>" id="item-palleting-tab">Invoice Items</a>
                                </li>
                                <li >
                                    <a href="<?=base_url('Invoice/PostInvoice/'.$id)?>" id="packing-list-tab">Post Invoice Management</a>
                                </li>
                                <li class="active">
                                    <a href="<?=base_url('Invoice/Payment/'.$id)?>" id="packing-list-tab">Payment Received</a>
                                </li>
                                <?php endif;?>
                            </ul>
                        </div>
                        <div class="panel-body ">
                            <div class="tab-content br-n pn">
                                <!-- PACKING DETAILS FORM -->
                            
                                            <div class="col-lg-12">
                                            <form id="payment_form" method="post">
                                            <input type="hidden" name="invoiceid" id="invoiceid" value="<?=$id?>">
                                            <input type="hidden" name="subid" id="subid" value="0">
                                            <?php 
                                                datepicker('3','Payment Date','date','Enter Payment Date',date('d/m/Y'),'required');   
                                                numberbox('3','Payment Amount','amount','Enter Amount','','step="0.0001"  required');
                                                numberbox('3','Exchange Rate','exchange_rate','Enter Exchange Rate',$exchange_rate,'step="0.0001" required');
                                                numberbox('3','Price in INR','price_in_inr','Enter Price in INR','','step="0.0001" required readonly');
                                                numberbox('3','Advice No','advice_no','Enter Advice No.','','');
                                                dropdownbox('3','Status','status',array('0'=>'Pending','1'=>'Paid'),'','required');
                                                editbox('3','Transaction Details','detail','Enter Transaction Details','','');
                                                
                                            ?>
                                            
                                            <div class="col-lg-12 p10">
                                                <button class="btn btn-primary btn-sm" id="addPayment">Add</button>
                                            </div>
                                            </form>
                                            </div>
                                        <div class="col-lg-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="primary">
                                                
                                                <th>Payment Date</th>
                                                <th>Payment Amount</th>
                                                <th>Exchange Rate</th>
                                                <th>Price in INR</th>
                                                <th>Advice No.</th>
                                                <th>Status</th>
                                                <th>Transaction Details</th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabledata">
                                        <?php
                                        $i=0;
                                        foreach($paymentlist as $post):
                                        $i++;
                                        $date=date_create_from_format('Y-m-d',$post->date);
                                        $date=date_format($date,'d/m/Y');
                                        
                                        $status="<b>Pending</b>";
                                        if($post->status==1)
                                        $status="<b>Paid</b>";

                                       echo " <tr id='item_tr_".$post->id."'>
                                            
                                            <td>".$date."</td>
                                            <td>".(float)$post->amount."</td>
                                            <td>".(float)$post->exchange_rate."</td>
                                            <td>".(float)$post->price_in_inr."</td>
                                            <td>".$post->advice_no."</td>
                                            <td>".$status."</td>
                                            <td>".$post->detail."</td>
                                            <td class='w70'>
                                            <div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='".$post->id."'><span class='fa fa-edit'></span></a>
                                                                    </div>
                                                    <div class=btn-group>
                                                    <a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='".$post->id."'><span class='fa fa-minus'></span></a>
                                                    </div>
                                            </td>
                                            </td>
                                        </tr>";
                                        endforeach;
                                         ?>
                                         
                                        </tbody>
                                    </table>
                                    </div>
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

    var itemid=0;
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

          
$('.select2-container').attr("style","width:100% !important;");


$('#exchange_rate,#amount').on('change',()=>{
    var exchange_rate=parseFloat($('#exchange_rate').val());
    var amount=parseFloat($('#amount').val());
    var price_in_inr=exchange_rate*amount;
    $('#price_in_inr').val(price_in_inr);
});
$(document).on('click','.edittr',function(e){

var id=$(this).data('id');

$('.loading').show();
    $.get('<?=$getItemData?>'+id,function(data){    
        
        
        data=$.parseJSON(data);
        $('#subid').val(data.id);
        
        $('#date').val(data.date);
        $('#amount').val(parseFloat(data.amount));
        $('#exchange_rate').val(parseFloat(data.exchange_rate));
        $('#advice_no').val(parseFloat(data.advice_no));
        $('#price_in_inr').val(parseFloat(data.price_in_inr));
        $('#status').val(data.status).trigger('change');
        
        $('#detail').val(data.detail);
        $('#addPayment').html('Update').removeClass('btn-primary').addClass('btn-success');
        $('.loading').hide();
    });
});

$('#payment_form').submit(function(e){
   
   
   
    var form=$('#payment_form');
    var subid=$('#subid').val();
    $('.loading').show();
                e.preventDefault();
    
                  $.ajax({
                    url:'<?=$saveItem?>',
                    type:'POST',
                    data:form.serialize(),
                    
                    success:function(data){ 
                        
                            data=$.parseJSON(data);
                            if(data.status==1)
                            {
                                $('#tabledata').append(data.html);
                                alertbox("Added","Payment Added Successfully","success");
                                  
                            
                            }else if(data.status==2){
                                alertbox("Updated","Payment Updated Successfully","success");
                        
                                $('#item_tr_'+subid).html(data.html);
                            
                            	$('#addPayment').html('Add').removeClass('btn-success').addClass('btn-primary');
                            }
                            $('.loading').hide();
                             $('#subid').val(0);
                             $('#date').val('<?=date('d/m/Y')?>');
                             $('#amount').val('');
                             $('#exchange_rate').val('');
                             $('#advice_no').val('');
                             $('#price_in_inr').val('');
                             
                             $('#status').val('0');
                             $('#status').select2('val','0');
                             $('#detail').val('');
                             
                    },



                  });

    

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
                        $.post('<?=$deleteItem?>',{'id':id},function(data){
                            
                            
                            data=$.parseJSON(data);
                            if(data.status==1)
                            {
                             
                               $('#item_tr_'+id).remove();
                            }
                              alertbox("Deleted","Record Deleted Successfully","success");
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