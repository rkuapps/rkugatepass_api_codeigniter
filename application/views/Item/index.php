<?php 
$currentPage="Item";
$pageBack=base_url()."Item/index/".$customerid."/";
$addPage=base_url()."Item/add/".$customerid."/";
$deletePage=base_url()."Item/Delete/".$customerid."/";
$addButton="Add";
$getItemList=base_url()."Item/getItemlist/".$customerid;
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $this->load->view('Includes/head');
    $this->load->view('Includes/tablecss');
    ?>
    <style>
    span {
        cursor: pointer;
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
                        <li class="active disabled">
                            <a href="#">Items</a>
                        </li>
                    </ul>
                </div>
                <div class="topbar-right">
                    <a href="<?=$addPage?>" class="btn btn-default btn-sm light fw600 ml10">
                        <span class="fa fa-plus pr5"></span> <?=$addButton?> </a>
                </div>
            </header>
            <div class="row">
                <div class="col-sm-12">
                    <section id="content" class="table-layout animated fadeIn">
                        <div class="tray tray-center">

                            <div class="panel panel-visible" id="spy3">
                                <div class="panel-heading">
                                    <div class="panel-title hidden-xs">
                                        <span class="glyphicon glyphicon-tasks"></span><?=$currentPage?>
                                    </div>
                                </div>
                                <div class="panel-body pn">
                                    <table class="table table-hover" id="datatable">
                                        <thead>
                                            <tr>
                                                <th class="fixed-wd-number">#</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Design No / Item No</th>
                                                <th>Item Name</th>
                                                <th>Item Weight</th>
                                                <th class="text-center fixed-wd-th">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($itemlist as $post) {
                                            $i++; ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $post->category_name ?></td>
                                                <td><?= $post->subcategory_name ?></td>
                                                <td><?= $post->unique_no ?></td>
                                                <td><?= $post->item_name ?></td>
                                                <td><?= $post->finalweight ?></td>
                                                <td>
                                                    <?php
                                                if (check_role_assigned('item', 'edit')) {
                                                    echo "<div class='btn-group'>".anchor($addPage . $post->id, '<i class="fa fa-edit"></i>', ['title'=>'Edit Packinglist','class' => 'btn btn-warning btn-xs', 'style' => 'float:left; margin-right:5px;  margin-top:1px;']);
                                                    echo '</div>';
                                                }
                                                
                                                if (check_role_assigned('item', 'delete')) {
                                                    echo '<div class="btn-group"><a href="#" onclick="javascript:deleteBox(' . $post->id . ')" title="Delete Order" class="btn btn-danger btn-xs cancel "><span class="fa fa-trash-o"></span></a>';
                                                    echo '</div>';
                                                } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="delid" id="delid" value="0">
                    </section>
                </div>
            </div>
            <?php $this->load->view('Includes/footer'); ?>
        </section>
        <div id='myModal' class='modal'>
            <div class="modal-dialog panel  panel-default panel-border top">
                <div class="modal-content">
                    <div id='myModalContent'></div>
                </div>
            </div>

        </div>
    </div>
    <?php $this->load->view('Includes/footerscript'); 
    $this->load->view('Includes/tablejs');
    ?>
    <script type="text/javascript">
    function deleteBox(frmname) {
        $("#delid").val(frmname);

    }
    jQuery(document).ready(function() {

        "use strict";
        Core.init();
        Demo.init();
        if (window.matchMedia('(max-width: 900px)').matches)
        {
        $('#datatable').dataTable({
            dom: '<"top"fl>rt<"bottom"ip>',
            "order": [],
            "scrollX": true,
            'columnDefs': [{
                'targets': [-1, 0],
                lengthChange: false,
                'orderable': false
            }, {
                type: 'date-eu',
                targets: 2
            }],
            "sScrollXInner": "100%",
            "oLanguage": {
                "sEmptyTable": "No Record(s) added yet."
            }
        });
        }
        else{
            $('#datatable').dataTable();
        }

        $('.cancel').click(function(e) {
            e.preventDefault();

            var delid = $("#delid").val();
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this Records!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        window.location.href = "<?=$deletePage?>" + delid;

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