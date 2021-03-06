<?php 
$currentPage="DeliveryChallan";
$getContactPersonDropdown = base_url('Customer/getCotactPerson/');
$PageBack=base_url()."DeliveryChallan/";
$PageSave=base_url()."DeliveryChallan/save/".$oderid.'/';
$pageBack=base_url()."DeliveryChallan/";
$operation = "Add";
$saveItem=base_url()."DeliveryChallan/saveItem";
$addItem=base_url()."Item/add/";
$deleteItem=base_url()."DeliveryChallan/deleteItem";
$getItemUnit=base_url()."Order/getItemUnit";
$DeleteDocument=base_url()."DeliveryChallan/deleteDocument/".$id;
$getItemData=base_url()."DeliveryChallan/SingleItem/";    
$getCurrency=base_url()."DeliveryChallan/getCurrency/";
$val_delivery_date=date('d/m/Y');
$val_payment="30 Days";
$rate_messure=array('0'=>'Qty','1'=>'Weight');
$val_deliveryno=$deliveryno;

  if ($id != "" and $id!=0 and is_numeric($id)) {
      $operation = "Edit";  
      
      $val_deliveryno= StringRepair3($details->deliveryno);
      $val_delivery_date= StringRepair3($details->delivery_date);
      $val_lr_number= StringRepair3($details->lr_number);
      $val_tcs=StringRepair3($details->tcs);
      $val_po_number=StringRepair3($details->po_number);
      $val_description=StringRepair3($details->description);
      $val_dispatched_by=StringRepair3($details->dispatched_by);
      $val_payment=StringRepair3($details->payment);
      $val_freight=StringRepair3($details->fright_amount);
      $val_supply=StringRepair3($details->place_supply);
      $val_customerid=StringRepair3($details->customer_id);
      $val_consignee=StringRepair3($details->consignee);
      $val_customer_order=explode(',',$details->oderid);
      $val_bags=StringRepair3($details->bags);
      $PrintPage=base_url()."DeliveryChallan/Print/";
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

    #total {
        cursor: not-allowed;
    }
    </style>
</head>
<body class="ecommerce-page sb-l-m">
    <div class="loading" style="display:none;">Loading???</div>
    <div id="main">
        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <section id="content_wrapper">
            <header id="topbar">
                <div class="topbar-left">
                    <ul class="nav nav-list nav-list-topbar pull-left">
                        <li class="active ">
                            <a href="<?=base_url('DelveryChallan')?>">Delivery Challan - <?=$val_deliveryno?></a>
                        </li>
                    </ul>
                </div>
                <?php
                if ($id!="" && $id!=0) { ?>
                <div class="topbar-right">
                    <a href="<?=$PrintPage.$id?>" target='_blank' class="btn btn-default btn-sm light fw600 ml10">
                        <span class="fa fa-plus pr5"></span> Print Delivery Challan </a>
                </div>
                <?php } ?>
            </header>
            <section id="content" class="table-layout animated fadeIn">
                <div class="tray tray-center">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav panel-tabs-border panel-tabs  panel-tabs-left">
                                <?php
                                if ($id!="" && $id!=0) {
                                echo '<li>';
                                }else{
                                    echo '<li class="active">';
                                }?>
                                <a href="#order_from" data-toggle="tab" aria-expanded="false">Delivey Challan</a>
                                </li>
                                <?php
                                if ($id!="" && $id!=0) {
                                ?><li class="active">
                                    <a href="#item_form" data-toggle="tab" aria-expanded="false">Delivery Challan Items</a>
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
                                        <input type="hidden" name="deliveryno" value="<?=$val_deliveryno?>">
                                        <?php 
                                   datepicker('4','Delivery Date','delivery_date','Select Delivery Date',$val_delivery_date,'required');
                                   dropdownbox('4','Customer Name','customerid',$customerlist,$val_customerid,'required');
                                   echo "<div class='changeItem'>";
                                   dropdownbox('4','Consignee','consignee',$contactlist,$val_consignee,'required');
                                   echo "</div>";
                                   echo '<div class="clearfix"></div>';
                                   editbox('4','LR Number','lr_number','Enter LR Number',$val_lr_number);
                                   editbox('4','TCS','tcs','Enter TCS',$val_tcs);
                                   editbox('4','PO Number','po_number','Enter PO Number',$val_po_number);
                                    editbox('4','Dispatched By','dispatched_by','Enter Dispatched By',$val_dispatched_by);
                                    editbox('4','Place To Supply','place_supply','Place To Supply',$val_supply);
                                    editbox('4','Freight Terms','payment','Freight Terms',$val_payment);
                                    editbox('4','Platting/Packing/Freight','freight','Enter Freight Charge',$val_freight);
                                    numberbox('4','Cartoons/Bags','bags','Enter Cartoon/Bags',$val_bags);
                                    multidropdownbox('4','Customer Orders','customer_order[]',$Order,$val_customer_order);
                                    echo "<div class='clearfix'></div>";
                                    
                                    textareabox('12','Description','description','Enter Description',$val_description);    
                                        echo "<div class='clearfix'></div>";
                                        echo '<div style="margin:10px">';
                                           Submitbutton($pageBack);
                                    echo '</div>';
                                    echo form_close(); 
                                      ?>
                                    </div>
                                </div>
                                <div id="item_form" class="tab-pane <?php
                                if ($id!="" && $id!=0) { echo 'active'; }
                                ?>">
                                    <div class="row">
                                        <input type="hidden" name="subid" id="subid" value="0">
                                        <input type='hidden' name='item_unit' id='item_unit'>
                                        <?php 
                                        $itembutton='<a href='.$addItem.$val_customerid.' target="_()" class="btn btn-info btn-xs"><span class="fa fa-plus"></span></a>';
                                        dropdownbox('2','Item Name  '.$itembutton,'item_id',$itemlist,'','required');
                                        numberbox('2','Weight','weight','Enter Weight','');
                                        numberbox('2','Quantity','qty','Enter Qty','');
                                        dropdownbox('2','Rate Measurement','rate_type',RATE_MEASUREMENT,'');
                                        numberbox('2','<span class="pricechange"> Rate (<i class="fa fa-inr"></i>)</span>','amount','Enter Rate','','required');
                                        numberbox('2','<span class="pricechange1"> Amount (<i class="fa fa-inr"></i>)</span>','total','Enter Amount','');
                                    ?>
                                        <div class="col-lg-12 p10 ">
                                            <button class="btn btn-success" id="addItems" type="button">Add
                                                Item</button>
                                        </div>
                                        <div class="col-lg-12 admin-form theme-primary">
                                            <div class="section-divider mb30">
                                                <span class=" bg-white">Delivery Challan Items</span>
                                            </div>
                                            <table class="table table-hover ">
                                                <thead>
                                                    <tr class="success">
                                                        <th>Item Name</th>
                                                        <th>HSN Code</th>
                                                        <th>Weight</th>
                                                        <th>Quantity</th>
                                                        <th class="w80">Rate </th>
                                                        <th class="w80">Amount </th>
                                                        <th style="width:80px;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemdata">
                                                    <?php 
                                                foreach($deliverysublist as $post)
                                                {
                                                    $ratype = "/Pcs";
                                                    $rates = $post->rate;
                                                    if($post->rate_type == 1){
                                                        $rates = sprintf("%0.2f",$post->rate);
                                                        $ratype = "/Kg";
                                                    }  
                                                    echo "
                                                           <tr id='item_tr_".$post->id."'>
                                                            <td>".$post->item_name." (".$post->unique_no.")</td>
                                                            <td>".$post->hsn_code."</td>
                                                            <td>".$post->weight."</td>
                                                            <td>".$post->qty."</td>
                                                            <td>".$rates.$ratype."</td>
                                                            <td>".$post->amount."</td>
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
                                                    <tr class="success">
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Total</th>
                                                        <th class="item_total_price"><?=$item_total_amount ?></th>
                                                        <th></th>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <?php
     $this->load->view('Includes/footerscript'); 
        $this->load->view('Includes/tablejs');
    ?>
    <script type="text/javascript">
    var symbol = "<?=$symbol?>";
    var symbol1 = "<?=$symbol1?>";
    jQuery(document).ready(function() {
        "use strict";
        Core.init();
        Demo.init();
        $(".select2-single").select2();
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
 
        $('#customerid').change(function(){
        var id=$(this).val();
            $.get('<?=$getContactPersonDropdown?>'+id,function(data){
                $('.changeItem').html(data);
                $('#consignee').val(itemid).trigger('change');
                $(".select2-single").select2();
                $('.select2-container').attr("style","width:100% !important;");

            });
        });

        $('#Orderfrom').submit(function(e) {
            var customerid = $('#customerid').val();
            var error = "0";
            if (customerid == 0) {
                error = "Select Customer";
            }
            if (error != "0") {
                e.preventDefault();
                alertbox('Error', error, 'danger');
            }
        });

        $('.select2-container').attr("style", "width:100% !important;");
        $(document).on('click', '.edittr', function(e) {
            var id = $(this).data('id');
            $('.loading').show();
            $.get('<?=$getItemData?>' + id, function(data) {
                data = $.parseJSON(data);
                $('#subid').val(data.id);
                $('#item_id').val(data.item_id).trigger('change');
                $('#weight').val(data.weight);
                $('#rate_type').val(data.rate_type).trigger('change');
                $('#qty').val(data.qty);
                $('#amount').val(data.rate);
                $('#total').val(data.amount);
                $('#addItems').html('Update Item').removeClass('btn-success').addClass(
                    'btn-info');
                $('.loading').hide();
            });
        });
        $('#addItems').click(function(e) {
            var subid = $('#subid').val();
            var item_id = $('#item_id').val();
            var date = $('#delivery_date').val();
            var qty = $('#qty').val();
            var weight = $('#weight').val();
            var rate_type=$('#rate_type').val();
            var amount = $('#amount').val();
            var total = $('#total').val();
            var error = "0";

            if (item_id == 0) {
                error = "Select Item";
            } else if (date == "") {
                error = "Enter Date";
            } else if (qty == '') {
                error = "Enter Quantity";
            } else if (rate_type==0 && qty < 1) {
                error = "Quantity Must be Grater Than 0"; 
            }else if (weight == '') {
                error = "Enter weight";
            } else if (weight < 0) {
                error = "weight Must be Grater Than 0";
            } else if (amount == "") {
                error = "Enter Amount";
            } else if (amount < 0) {
                error = "Amount Must be Grater Than 0 ";
            }
            if (error != "0") {
                e.preventDefault();

                alertbox('Error', error, 'danger');
            } else {
                $('.loading').show();

                $.post('<?=$saveItem?>', {
                    'subid': subid,
                    'orderid': <?=$id?>,
                    'item_id': item_id,
                    'qty': qty,
                    'weight': weight,
                    'rate_type':rate_type,
                    'amount': amount,
                    'total': total
                  
                }, function(data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    if (data.status == 1) {
                        $('#itemdata').append(data.html);
                        $('.item_total_price').html(parseFloat(data.total).toFixed(2));
                        $('.grand_item_total_price').html(parseFloat(data.grand_item_total).toFixed(2));
                        $('#total_amount').val(parseFloat(data.total).toFixed(2));
                        alertbox("Added", "Order Item Added Successfully", 'success');

                    } else if (data.status == 2) {

                        alertbox("Updated", "Order Item Updated Successfully", 'success');
                        $('#item_tr_' + subid).html(data.html);
                        $('.item_total_price').html(parseFloat(data.total).toFixed(2));
                        $('.grand_item_total_price').html(parseFloat(data.grand_item_total).toFixed(2));
                        $('#total_amount').val(parseFloat(data.total).toFixed(2));
                        $('#addItems').html('Add Item').removeClass('btn-info').addClass(
                            'btn-success');
                    }
                    $('.loading').hide();
                    $('#subid').val(0);
                    $('#item_id').val(0);
                    $('#item_id').select2('val', '0');
                    $('#rate_type').val(0);
                    $('#rate_type').select2('val', '0');
                    $('#qty').val('');
                    $('#weight').val('');
                    $('#amount').val('');
                    $('#total').val('');

                });
            }
        });
        $('#amount,#qty,#rate_type').on('change',function(){
             var item_unit=$('#rate_type').val();
             var qty=parseFloat($('#qty').val());
             var weight=parseFloat($('#weight').val());
             var amount=parseFloat($('#amount').val());
            if(item_unit==0)
            {
                var total=amount*qty;
            }
            else{
                var total=amount*weight;
            }
             $('#total').val(total.toFixed(2));
        });
        $('#unique_no').on('change',function(){
            var unique_no=$('#unique_no').val();
            $.post('<?=$getItemUnit?>',{'unique_no':unique_no},function(data){
            console.log(data);
            data=$.parseJSON(data);
            $('#item_unit').val(data.item_unit);
            });
        });

        $('#order_date').on('change', function() {
            var orderdate = strtotime($('#order_date').val());
            var order_accept = date("Y-m-d", strtotime("+2 month", orderdate));
            $('#order_accept_date').val(order_accept);
        });
        $(document).on('click', '.removetr', function() {
            var freight = $('#freight').val();
            var id = $(this).data('id');
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
                        $.post('<?=$deleteItem?>', {
                            'id': id,
                            'orderid': <?=$id?>,
                           
                        }, function(data) {
                            data = $.parseJSON(data);
                            if (data.status == 1) {
                                $('#item_tr_' + id).remove();
                                $('.item_total_price').html(parseFloat(data.total));
                            }
                            alertbox("Deleted", "Record Deleted Successfully", 'success');
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
</body>

</html>