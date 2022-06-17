<?php
$currentPage = "Quotations";
$getContactPersonDropdown = base_url('Customer/getCotactPerson/');
$PageBack = base_url() . "Quotations/";
$PageSave = base_url() . "Quotations/save";
$pageBack = base_url() . "Quotations/";
$operation = "Add";
$saveItem = base_url() . "Quotations/saveItem";
$addItem = base_url() . "Item/add/";
$deleteItem = base_url() . "Quotations/deleteItem";
$DeleteDocument = base_url() . "Quotations/deleteDocument/" . $id;
$getItemData = base_url() . "Quotations/SingleItem/" . $id . "/";
$getCurrency = base_url() . "Quotations/getCurrency/";
$val_order_date = date('d/m/Y');
$val_po_date = date('d/m/Y');
$Paid = array('Paid ', 'To Pay');
$val_payment_terms = '30 Days';
$val_quotation_date = date('d/m/Y');
$val_quotation_validity = date('d/m/Y');
$val_orderno = "";
$val_quotationno = $quotation_no;
$val_qid = 0;
if ($id != "" and is_numeric($id)) {
    $operation = "Edit";

    $val_quotationno = StringRepair3($quotation->quotationno);
    $val_cid = StringRepair3($quotation->cid);
    $val_quotationm = StringRepair3($quotation->quotationm);
    $freight_terms = StringRepair3($quotation->freight_terms);
    $val_quotation_date = date('d/m/Y', strtotime($quotation->quotation_date));
    $val_revno = StringRepair3($quotation->revno);
    $val_moq = StringRepair3($quotation->moq);
    $val_payment_terms = StringRepair3($quotation->payment_terms);
    $val_quotation_validity = StringRepair3($quotation->quotation_validity);
    $val_note = StringRepair3($quotation->note);
    $val_qid = StringRepair3($quotation->qid);
    $val_consignee = StringRepair3($quotation->consignee);

}
$temp = "";
if ($val_orderno != "") {
    $temp = " - " . $val_orderno;
}
if ($val_qid == 0) {
    $field = "required";
} else {
    $field = "disabled";
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
    <div class="loading" style="display:none;">Loading…</div>
    <!-- Start: Main -->
    <div id="main">
        <?php $this->load->view('Includes/hadernav');?>
        <?php $this->load->view('Includes/sidebar');?>
        <section id="content_wrapper">
            <header id="topbar">
                <div class="topbar-left">
                    <ul class="nav nav-list nav-list-topbar pull-left">
                        <li class="active ">
                            <a href="<?=$PageBack?>">Quotation - <?=$val_quotationno?></a>
                        </li>
                    </ul>
                </div>
            </header>
            <section id="content" class="table-layout animated fadeIn">
                <div class="tray tray-center">
                    <div class="panel">

                        <div class="panel-heading">
                        <div id='tabs'>
                            <ul class="nav panel-tabs-border panel-tabs  panel-tabs-left">
                                <?php
if ($id != "" && $id != 0) {
    echo '<li>';
} else {
    echo '<li class="active">';
}?>
                                <a href="#order_from" data-toggle="tab" aria-expanded="false">Quotation </a>
                                </li>
                                <?php
if ($id != "" && $id != 0) {
    ?>
                                <li class="active">
                                    <a href="#item_form" data-toggle="tab" aria-expanded="false">Quotation Items</a>
                                </li>
                                <?php
}
?>
                            </ul>
                            </div>
                        </div>

                        <div class="panel-body ">
                            <div class="tab-content br-n pn">
                                <div id="order_from" class="tab-pane <?php if ($id == 0) {echo 'active';}?>">
                                    <div class="row">
                                        <?php echo form_open($PageSave, ['name' => 'frm1', 'id' => 'Quotationfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform tab-pane active']); ?>
                                        <input type="hidden" name="id" value="<?=$id?>">
                                        <input type="hidden" name="quotationno" value="<?=$val_quotationno?>">
                                        <?php
datepicker('4', 'Quotation Date', 'quotation_date', 'Enter Quotation Date', $val_quotation_date);
dropdownbox('4', 'Customer Name', 'cid', $customerlist, $quotation->cid, $field);
echo "<div class='changeItem'>";
dropdownbox('4', 'Consignee', 'consignee', $contactlist, $val_consignee, 'required');
echo "</div>";

echo "<div class='clearfix'></div>";
dropdownbox('4', 'Freight Terms', 'freight_terms', $Paid, $freight_terms);

editbox('4', 'Payment Terms', 'payment_terms', 'Enter Terms', $val_payment_terms);
datepicker('4', 'Quotation Validity', 'quotation_validity', 'Enter Quotation', $val_quotation_validity, 'required');
echo "<div class='clearfix'></div>";
?>
                                        <input type="hidden" name='total_amount' value=<?=$val_grand_total?>>
                                        <input type="hidden" name='cgst' id='cgst' value=<?=$val_cgst?>>
                                        <input type="hidden" name=sgst id='sgst' value=<?=$val_sgst?>>
                                        <input type="hidden" name=igst id='igst' value=<?=$val_igst?>>
                                        <?php
textareabox('12', 'Note', 'note', 'Enter About Order', $val_note);
echo "<div class='clearfix'></div>";
echo '<div style="margin:10px">';
Submitbutton($pageBack);
echo '</div>';
echo form_close();
?>
                                    </div>
                                </div>
                                <div id="item_form" class="tab-pane <?php
if ($id != "" && $id != 0) {echo 'active';}
?>">
                                    <div class="row">
                                        <input type="hidden" name="subid" id="subid" value="0">
                                        <input type="hidden" name="qid" id="qid" value="<?=$id?>">
                                        <?php
$itembutton = '<a href=' . $addItem . $val_cid . ' target="_()" class="btn btn-info btn-xs"><span class="fa fa-plus"></span></a>';
dropdownbox('3', 'Item Name  ' . $itembutton, 'item_id', $itemcategorylist, '', 'required');
// dropdownbox('4','Item Sub Category','subcat_id',$itemsubcategorylist,'required');
editbox('3', 'Platting', 'platting', 'Enter Platting', '');
editbox('3', 'MOQ', 'moq', 'Enter Moq Number', '');
editbox('3', 'Rate', 'rate', 'Enter Rate', '');
?>
                                        <div class="col-lg-12 p10 ">
                                            <button class="btn btn-success" id="addItems" type="button">Add
                                                Item</button>
                                        </div>
                                        <div class="col-lg-12 admin-form theme-primary">
                                            <div class="section-divider mb30">
                                                <span class=" bg-white">Quotation Items</span>
                                            </div>
                                            <table class="table table-hover ">
                                                <thead>
                                                    <tr class="primary">
                                                        <th>Item </th>
                                                        <th>HSN Code</th>
                                                        <th>Platting</th>
                                                        <th>MOQ</th>
                                                        <th>Rate</th>
                                                        <!-- <th class="w80">Dispatch Qty </th> -->
                                                        <th class="w80">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemdata">
                                                    <?php
foreach ($quotationsub as $post) {

    echo "
                                                        <tr id='item_tr_" . $post->id . "'>
                                                        <td>" . $post->item_name . " (" . $post->unique_no . ")</td>
                                                        <td>" . $post->hsn_code . "</td>
                                                        <td>" . $post->platting . "</td>
                                                        <td>" . $post->moq . "</td>
                                                        <td>" . sprintf("%0.2f", $post->rate) . "</td>
                                                        <td>
                                                            <div class=btn-group><a href='javascript:void(0)' class='btn btn-warning btn-xs  edittr' data-id='" . $post->id . "'><span class='fa fa-edit'></span></a>
                                                            </div>
                                                            <div class=btn-group><a href='javascript:void(0)' class='btn btn-danger btn-xs  removetr' data-id='" . $post->id . "'><span class='fa fa-minus'></span></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    ";
}
?>
                                                </tbody>

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
            <?php $this->load->view('Includes/footer');?>

        </section>

    </div>
    <?php
$this->load->view('Includes/footerscript');
$this->load->view('Includes/tablejs');
?>

    <script type="text/javascript">
    jQuery(document).ready(function() {
        "use strict";
        Core.init();
        Demo.init();
        $(".select2-single").select2();
        $('.datetimepicker').datepicker({
            dateFormat: 'dd/mm/yy'
        });
        $('.select2-container').attr("style","width:100% !important;");
    });


    $('#cid').change(function(){
    var id=$(this).val();
        $.get('<?=$getContactPersonDropdown?>'+id,function(data){
            $('.changeItem').html(data);
            $('#consignee').val(itemid).trigger('change');
            $(".select2-single").select2();
            $('.select2-container').attr("style","width:100% !important;");

        });
    });

    </script>

    <script type="text/javascript">

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



$(document).on('click','.edittr',function(e){

var id=$(this).data('id');
$('.loading').show();
    $.get('<?=$getItemData?>'+id,function(data){


        data=$.parseJSON(data);
        $('#subid').val(data.id);

        $('#item_id').val(data.subcat_id).trigger('change');
        //$('#unique_no').select2('val',data.unique_no);
        $('#platting').val(data.platting);
        $('#moq').val(data.moq);
        $('#rate').val(data.rate);
        $('#addItems').html('Update Item').removeClass('btn-success').addClass('btn-info');
        $('.loading').hide();
    });
});

    $('#addItems').click(function(e) {


        var qid = $('#qid').val();
        var subid = $('#subid').val();
        var item_id = $('#item_id').val();
        var rate = $('#rate').val();
        var moq=$('#moq').val();
        var platting = $('#platting').val();
        var error = "0";

        if (item_id == "") {
            error = "Select item";
        } else if (rate == "") {
            error = "Enter Rate";
        }  else if (cid == "") {
            error = "c";
        }else if(moq<=0)
        {
            error='Moq Must Be Greater Then 0';
        }
        if (error != "0") {
            e.preventDefault();
            alertbox('Error', error, 'danger');
        } else {

            $('.loading').show();
            $.post('<?=$saveItem?>', {
                'subid': subid,
                'qid': qid,
                'item_id': item_id,
                'platting':platting,
                'moq':moq,
                'rate': rate,
            }, function(data) {
                console.log(data);
                data = $.parseJSON(data);

                if (data.status == 1) {
                    $('#itemdata').append(data.html);
                    // alert("Hello" + data);
                    // $('.item_total_price').html(parseFloat(data.total));
                    // $('.cgst').html(parseFloat(data.cgst));
                    // $('.sgst').html(parseFloat(data.sgst));
                    // $('.igst').html(parseFloat(data.igst));
                    // $('.grand_item_total_price').html(parseFloat(data.grand_item_total));

                    // $('#total_amount').val(data.total);
                    alertbox("Added", "Quotation Item Added Successfully", 'success');

                } else if (data.status == 2) {

                    alertbox("Updated", "Quotation Item Updated Successfully", 'success');

                    $('#addItems').html('Add Item').removeClass('btn-info').addClass('btn-success');
                     $('#item_tr_' + subid).html(data.html);
                    // $('.item_total_price').html(parseFloat(data.total));
                    // $('.cgst').html(parseFloat(data.cgst));
                    // $('.sgst').html(parseFloat(data.sgst));
                    // $('.igst').html(parseFloat(data.igst));
                    // $('.grand_item_total_price').html(parseFloat(data.grand_item_total));
                    // $('#total_amount').val(data.total);
                    // $('#addItems').html('Add Item').removeClass('btn-info').addClass('btn-success');
                }
                $('.loading').hide();
                $('#subid').val(0);
                 $('#item_id').val(0);
                 $('#item_id').select2('val', '0');
                // $('#delivery_date').val('<?=date('d/m/Y')?>');
                $('#rate').val('');
                $('#platting').val('');
                $('#moq').val('');
                //   $('#discount').val('');
                // $('#total').val('');
                // $('#description').val('');
            });
        }
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
                        'id': id
                        // 'orderid': <?php //$id?>,
                        // 'cgst': <?php //$val_cgst?>,
                        // 'sgst': <?php //$val_sgst?>,
                        // 'igst': <?php //$val_igst?>,
                        // 'freight': freight
                    }, function(data) {

                        data = $.parseJSON(data);
                        if (data.status == 1) {

                            $('#item_tr_' + id).remove();
                            $('.item_total_price').html(data.total);
                            $('#total_amount').val(data.total);
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
        //console.log(subdata);

    });
    </script>
</body>

</html>