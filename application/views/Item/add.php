<?php 
$currentPage="Item ";
$pageBack=base_url()."Item/index/".$customerid;
$PageSave=base_url()."Item/save/";
$operation = "Add";
$val_net_weight=0;

$val_sub_data="{}";
  if ($id != "" and is_numeric($id)) {
      $operation = "Edit";  

    $val_item_category= StringRepair3($Item->item_subcategory);
    $val_unique_no= StringRepair3($Item->unique_no);
    $val_item_name= StringRepair3($Item->item_name);
    $val_drawing_no= StringRepair3($Item->drawing_no);
    $val_rawmaterial= StringRepair3($Item->rawmaterial);
    $val_rivetweight= StringRepair3($Item->rivetweight);
    $val_finalweight= StringRepair3($Item->finalweight);
    $val_units= StringRepair3($Item->unit_measurement);
    $val_paramsize= StringRepair3($Item->paramsize);
    $val_hsncode=StringRepair3($Item->hsn_code);
    $val_jw_itemname=StringRepair3($Item->jw_itemname);

  }
    $managePage = $operation . " Item "; 
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    $this->load->view('Includes/head');
    $this->load->view('Includes/tablecss');
    ?>
    <script>
    var subdata = {};
    </script>
    <style>
    th,
    td {
        text-align: center;
    }
    </style>
</head>

<body class="ecommerce-page sb-l-m">
    <div id="main">
        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <section id="content_wrapper">
            <header id="topbar">
                <div class="topbar-left">
                    <ul class="nav nav-list nav-list-topbar pull-left">
                    <?php  if($party_type==1){?>
                        <li>
                            <a href="<?=base_url('Settings/CustomerManagement/')?>">Customer</a>
                        </li>
                        <?php }else{ ?>
                            <li>
                            <a href="<?=base_url('Settings/SupplierManagement/')?>">Supplier</a>
                        </li>
                        <?php } ?>
                        <li class="active ">
                            <a href="<?=base_url('Item/index/'.$customerid)?>">Items</a>
                        </li>
                    </ul>
                </div>
            </header>
            <section id="content" class="table-layout animated fadeIn">
                <div class="tray tray-center">
                    <?php 
                     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'itemform', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
                    ?>
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <?=$managePage?>
                            </span>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <input type="hidden" name="customerid" value="<?= $customerid; ?>">
                            <input type="hidden" name="net_weight" id="net_weight" value="<?= $val_net_weight; ?>">
                            <input type="hidden" name="sub_data" id="sub_data" value="<?=$val_sub_data?>">
                            <?php 
                                dropdownbox('4','Item Category ','item_category',$categorylist,$val_item_category,'required');
                                editbox('4','Design No/Item Code','unique_no','Enter Unique No',$val_unique_no,'');
                                editbox('4','Item Name','item_name','Enter Item Name',$val_item_name,'required');
                                editbox('4','JW Item Name','jw_itemname','Enter JW Item Name',$val_jw_itemname,'required');
                                editbox('4','Item Weight','finalweight','Enter Final Weight.',$val_finalweight,'required');
                                dropdownbox('4','Unit Measurement','units',GENERAL_MEASUREMENT,$val_units,'required');
                                editbox('4','HSN Code','hsncode','Enter HSN Code.',$val_hsncode);
                               
                                ?>
                          
                        </div>
                        <div class="panel-footer">
                            <?php   Submitbutton($pageBack);?>
                        </div>
                    </div>
                    <?php 
                        echo form_close();
                    ?>
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
    var i = <?=$i?>;
    var trdata = "";
    jQuery(document).ready(function() {
        subdata = JSON.stringify(subdata);
        $('#sub_data').val(subdata);
        "use strict";
        Core.init();
        $(".select2-single").select2();
        $("#btnAddMetal").on("click", (e) => {
            e.preventDefault();
            var metal_name = $('#metal_name').val();
            var part_type = $('#part_type').val();
            var part_name = $('#part_name').val();
            var weight = $('#weight').val();
            var error = "0";
            if (metal_name == 0)
            {
                error = "Select Metal Name";
            } else if (weight == "")
            {
                error = "Enter Weight";
            }
            weight = parseFloat($('#weight').val());
            weight = parseFloat(weight.toFixed(3));
            if (error != "0")
            {
                alertbox('Error', error, 'danger');
            } else {
                var object = {
                    'subid': 0,
                    'metal_name': metal_name,
                    'part_type': part_type,
                    'part_name': part_name,
                    'weight': weight,
                };
                i = i + 1;
                subdata = $.parseJSON($('#sub_data').val());
                subdata["remove_" + i] = object;
                subdata = JSON.stringify(subdata);
                $('#sub_data').val(subdata);
                trdata = `
                    <tr id="item_tr_` + i + `">
                        <td>` + metal_name + `</td>
                        <td>` + part_type + `</td>
                        <td>` + part_name + `</td>
                        <td>` + weight + `</td>
                        <td>
                                <div class="form-group mn">
                                    <button type="button"  class="btn btn-danger btn-xs mn removetr" data-id="` + i + `">
                                        <span class="fa fa-minus"></span>
                                    </button>
                                </div>
                        </td>
                </tr>`;
                $('#metal_name').val(0);
                $('#metal_name').select2('val', '0');
                $('#part_type').val('');
                $('#part_name').val('');
                $('#weight').val('');
                let total = parseFloat($('#net_weight').val());
                total = parseFloat(total.toFixed(4)) + parseFloat(weight.toFixed(4));
                total = parseFloat(total);
                $('#net_weight').val(total.toFixed(3));
                $('#net_weight2').val(total.toFixed(3));
                $('.total_net_weight').html(total.toFixed(3));
                $("#metalTable").append(trdata);
            }
        });
        $(document).on('click', '.removetr', function() {
            subdata = $('#sub_data').val();
            var id = "remove_";
            var id1 = $(this).data('id');
            id = id + id1;
            subdata = $.parseJSON(subdata);
            var total = parseFloat($('#net_weight').val());
            total = total - parseFloat(subdata[id].weight);

            $('#net_weight').val(total.toFixed(4));
            $('#net_weight2').val(total.toFixed(4));
            $('.total_net_weight').html(total.toFixed(4));
            delete subdata[id];
            subdata = JSON.stringify(subdata);
            $('#sub_data').val(subdata)
            $('#item_tr_' + id1).remove();
        });
        $('#itemform').submit(function(e) {
            var item_category = $('#item_category').val();
            var platting = $('#platting').val();
            var subdata = $('#sub_data').val();
            var error = "0";
            if (item_category == 0) {
                error = "Select Category";
            }
            // else if(platting==0)
            // {
            //     error="Select Platting";
            // }
            else if (subdata === JSON.stringify({})) {
                error = "Please Add Atleast One Metal";
            }
            if (error != "0") {
                e.preventDefault();
                alertbox('Error', error, 'danger');
            }
        });
    });
    </script>
    <!-- END: PAGE SCRIPTS -->
</body>
</html>