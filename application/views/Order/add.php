<?php
$currentPage = "Sales Order";
$PageBack = base_url() . "Order/";
$PageSave = base_url() . "Order/save";
$pageBack = base_url() . "Order/";
$operation = "Add";
$saveItem = base_url() . "Order/saveItem";
$addItem = base_url() . "Item/add/";
$getItemUnit = base_url() . "Order/getItemUnit";
$deleteItem = base_url() . "Order/deleteItem";
$DeleteDocument = base_url() . "Order/deleteDocument/" . $id;
$getItemData = base_url() . "Order/SingleItem/" . $id . "/";
$getCurrency = base_url() . "Order/getCurrency/";
$getQuotation = base_url() . "Order/getQuotation/";
$val_order_date = date('d/m/Y');
$val_po_date = date('d/m/Y');
$order_status = array('0' => 'Open', '1' => 'Close');
$val_order_accept_date = date('d/m/Y');
$itemunit = array('Pcs' => 'Pcs', 'Kg' => 'Kg');
$val_orderno = "";
if ($id != "" and is_numeric($id)) {
    $operation = "Edit";
    $val_orderno = StringRepair3($Order->orderno);
    $val_order_date = date_create_from_format('Y-m-d', $Order->order_date);
    $val_order_date = date_format($val_order_date, 'd/m/Y');
    $val_customerid = StringRepair3($Order->customerid);
    //$val_companyid=StringRepair3($Order->companyid);
    $val_ponumber = StringRepair3($Order->ponumber);
    $val_po_date = date_create_from_format('Y-m-d', $Order->po_date);
    $val_po_date = date_format($val_po_date, 'd/m/Y');
    $val_order_accept_date = date_create_from_format('Y-m-d', $Order->order_accept_date);
    $val_order_accept_date = date_format($val_order_accept_date, 'd/m/Y');
    $val_order_accept_no = StringRepair3($Order->order_accept_no);
    $val_quotations_id = StringRepair3($Order->quotationid);
    $val_grand_total = StringRepair3($Order->total);
    $val_note = StringRepair3($Order->note);
    $val_status = StringRepair3($Order->status);
    $time = strtotime($val_order_date);
    $val_delivery_date = date("m/d/Y", strtotime("+2 day", $time));
    $val_cgst = StringRepair3($gstdetails->cgst);
    $val_sgst = StringRepair3($gstdetails->sgst);
    $val_igst = StringRepair3($gstdetails->igst);
    $symbol = "( " . $currencydetail->symbol . " )";
    $symbol1 = $currencydetail->symbol;
}
$temp = "";
if ($val_orderno != "") {
    $temp = " - " . $val_orderno;
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
        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">
            <!-- Start: Topbar -->
            <header id="topbar">
                <div class="topbar-left">
                    <ul class="nav nav-list nav-list-topbar pull-left">
                        <li class="active ">
                            <a href="<?= base_url('Order') ?>">Sales Order <?= $temp ?></a>
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
                                if ($id != "" && $id != 0) {
                                    echo '<li>';
                                } else {
                                    echo '<li class="active">';
                                } ?>
                                <a href="#order_from" data-toggle="tab" aria-expanded="false">Sales Order</a>
                                </li>
                                <?php
                                if ($id != "" && $id != 0) {
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
                                <div id="order_from" class="tab-pane <?php if ($id == 0) {
                                                                            echo 'active';
                                                                        } ?>">
                                    <div class="row">
                                        <?php echo form_open($PageSave, ['name' => 'frm1', 'id' => 'Orderfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform tab-pane active']); ?>
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <?php
                                        datepicker('4', 'Order Date', 'order_date', 'Select Order Date', $val_order_date, 'required');
                                        dropdownbox('4', 'Customer Name', 'customerid', $customerlist, $val_customerid, 'required');
                                        echo "<div class='chngqtation'>";
                                        dropdownbox('4', 'Quotation No', 'quotationid', $quotations, $val_quotations_id);
                                        echo "</div><div class='clearfix'></div>";
                                        //dropdownbox('4','Company Name','companyid',$companylist,$val_companyid,'required');                                
                                        editbox('4', 'PO Number', 'ponumber', 'Enter PO Number', $val_ponumber);
                                        datepicker('4', 'PO Date', 'podate', 'Enter PO Date', $val_po_date);
                                        dropdownbox('4', 'Order Status', 'status', $order_status, $val_status);
                                        // editbox('4','Mode Of Transport','mode_of_transport','Enter Mod Of Transport',$val_mode_of_transport,'list="mod_of_transportlist" required');
                                        // datalistbox($mod_of_transportlist,'mod_of_transportlist');
                                        echo "<div class='clearfix'></div>";
                                        ?>
                                        <input type="hidden" name='total_amount' value=<?= $val_grand_total ?>>
                                        <input type="hidden" name='cgst' id='cgst' value=<?= $val_cgst ?>>
                                        <input type="hidden" name=sgst id='sgst' value=<?= $val_sgst ?>>
                                        <input type="hidden" name=igst id='igst' value=<?= $val_igst ?>>
                                        <?php
                                        textareabox('12', 'Note', 'note', 'Enter About Order', $val_note);
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
                                                                    if ($id != "" && $id != 0) {
                                                                        echo 'active';
                                                                    }
                                                                    ?>">
                                    <div class="row">
                                        <input type="hidden" name="subid" id="subid" value="0">
                                        <?php
                                        $itembutton = '<a href=' . $addItem . $val_customerid . ' target="_()" class="btn btn-info btn-xs"><span class="fa fa-plus"></span></a>';
                                        dropdownbox('8', 'Item Name  ' . $itembutton, 'unique_no', $itemlist, '', 'required');
                                        datepicker('4', 'Delivery Date', 'delivery_date', 'Select Date', '');
                                        echo "<div class='clearfix'></div>";
                                        numberbox('3', 'Quantity', 'qty', 'Enter Qty', '', 'required');
                                        dropdownbox('1', 'Item Unit', 'item_unit', $itemunit, '', 'required');
                                        numberbox('4', '<span class="pricechange"> Rate (<i class="fa fa-inr"></i>)</span>', 'amount', 'Enter Rate', '', 'required');
                                        //numberbox('3','Discount','discount','Enter Discount','','min=1');
                                        numberbox('4', '<span class="pricechange1"> Amount (<i class="fa fa-inr"></i>)</span>', 'total', 'Enter Amount', '');
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
                                                        <th class='text-right'>Quantity</th>
                                                        <th class="text-right">Rate </th>
                                                        <!-- <th class="w80">Discount</th> -->
                                                        <th class="text-right">Amount </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemdata">
                                                    <?php
                                                    foreach ($ordersublist as $post) {
                                                        $delivery_date = date_create_from_format('Y-m-d', $post->delivery_date);
                                                        $delivery_date = date_format($delivery_date, 'd/m/Y');
                                                        //<td>".$post->discount."</td>
                                                        echo "
                                                           <tr id='item_tr_" . $post->id . "'>
                                                            <td>" . $post->item_name ."( ".$post->unique_no." )". "</td>
                                                            <td>" . $delivery_date . "</td>
                                                            <td class='text-right'>" . $post->qty . ' ' . $post->item_unit . "</td>
                                                            <td class='text-right'>" . $post->amount . "</td>
                                                            <td class='text-right'>" . $post->total . "</td>
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
                                                <tfoot>
                                                    <tr class="primary">
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th class='text-right'>Total</th>
                                                        <th class="item_total_price text-right"><?= sprintf("%.2f",$item_total_amount) ?></th>
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
        var symbol = "<?= $symbol ?>";
        var symbol1 = "<?= $symbol1 ?>";
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
            $('#customerid').on('change', (e) => {
                let id = $(e.target).val();
                $.post('<?= $getQuotation ?>' + id, (data) => {
                    if (data != '') {
                        $('.chngqtation').html(data);
                        $(".select2-single").select2();
                        $('.select2-container').attr("style", "width:100% !important;");
                    }
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
                $.get('<?= $getItemData ?>' + id, function(data) {
                    data = $.parseJSON(data);
                    $('#subid').val(data.id);
                    $('#item_unit').val(data.item_unit).trigger('change');
                    $('#unique_no').val(data.item_id).trigger('change');
                    //$('#unique_no').select2('val',data.unique_no);
                    $('#delivery_date').val(data.delivery_date);
                    $('#qty').val(data.qty);
                    $('#amount').val(data.amount);
                    $('#total').val(data.total);
                    $('#addItems').html('Update Item').removeClass('btn-success').addClass('btn-info');
                    $('.loading').hide();
                });
            });
            $('#addItems').click(function(e) {
                var subid = $('#subid').val();
                var unique_no = $('#unique_no').val();
                var date = $('#delivery_date').val();
                var qty = $('#qty').val();
                var amount = $('#amount').val();
                var item_unit = $('#item_unit').val();
                //var discount=$('#discount').val();
                var total = $('#total').val();
                var error = "0";
                if (unique_no == 0) {
                    error = "Select Item";
                } else if (date == "") {
                    error = "Enter Date";
                } else if (qty == '') {
                    error = "Enter Quantity";
                } else if (qty < 1) {
                    error = "Quantity Must be Grater Than 0";
                } else if (amount == "") {
                    error = "Enter Amount";
                } else if (amount < 0) {
                    error = "Amount Must be Grater Than 0 ";
                }
                // else if(discount!="" && discount<0)
                // {
                //     error="Discount Must be Grater Than 1";
                // }
                if (error != "0") {
                    e.preventDefault();
                    alertbox('Error', error, 'danger');
                } else {
                    $('.loading').show();
                    //,'discount':discount
                    $.post('<?= $saveItem ?>', {
                        'subid': subid,
                        'orderid': <?= $id ?>,
                        'unique_no': unique_no,
                        'item_unit': item_unit,
                        'delivery_date': date,
                        'qty': qty,
                        'amount': amount,
                        'total': total
                    }, function(data) {
                        console.log(data);
                        data = $.parseJSON(data);
                        if (data.status == 1) {
                            $('#itemdata').append(data.html);
                            $('.item_total_price').html(parseFloat(data.total));
                            $('#total_amount').val(data.total);
                            alertbox("Added", "Order Item Added Successfully", 'success');
                        } else if (data.status == 2) {
                            alertbox("Updated", "Order Item Updated Successfully", 'success');
                            $('#item_tr_' + subid).html(data.html);
                            $('.item_total_price').html(parseFloat(data.total));
                            // $('.cgst').html(parseFloat(data.cgst));
                            // $('.sgst').html(parseFloat(data.sgst));
                            // $('.igst').html(parseFloat(data.igst));
                            // $('.grand_item_total_price').html(parseFloat(data.grand_item_total));
                            $('#total_amount').val(data.total);
                            $('#addItems').html('Add Item').removeClass('btn-info').addClass('btn-success');
                        }
                        $('.loading').hide();
                        $('#subid').val(0);
                        $('#unique_no').val(0);
                        $('#unique_no').select2('val', '0');
                        $('#item_unit').select2('val', '');
                        $('#delivery_date').val('<?= date('d/m/Y') ?>');
                        $('#qty').val('');
                        $('#amount').val('');
                        //   $('#discount').val('');
                        $('#total').val('');
                        $('#description').val('');
                        $('.loading').hide();
                    });
                }
            });
            // $('#discount').on('change',function(){
            //     var discount=$(this).val();
            //     var amount=$('#amount').val();
            //     $('#total').val((amount-discount));
            // });
            $('#amount,#qty').on('change', function() {
                var qty = parseFloat($('#qty').val());
                var amount = parseFloat($('#amount').val());
                var total = amount * qty;
                $('#total').val(total.toFixed(3));
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
                            $.post('<?= $deleteItem ?>', {
                                'id': id,
                                'orderid': <?= $id ?>
                            }, function(data) {
                                data = $.parseJSON(data);
                                if (data.status == 1) {
                                    $('#item_tr_' + id).remove();
                                    $('.item_total_price').html(data.total);
                                    $('.cgst').html(parseFloat(data.cgst));
                                    $('.sgst').html(parseFloat(data.sgst));
                                    $('.igst').html(parseFloat(data.igst));
                                    $('.grand_item_total_price').html(parseFloat(data.grand_item_total));
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
        });
    </script>
    <!-- END: PAGE SCRIPTS -->
</body>
</html>