<?php 
$currentPage="Item Subcategory";
$pageBack=base_url()."Settings/ItemSubCategory/";
$addPage=base_url()."Settings/ItemSubCategory/add/";
$deletePage=base_url()."Settings/ItemSubCategory/Delete/";
$addButton="Add";
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
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="<?=$pageBack?>">
                                <span>Item SubCategory</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <?php  if (check_role_assigned('item_sub_category','add')) {?>
                <div class="topbar-right">
                    <a href="<?=$addPage?>" class="btn btn-default btn-sm light fw600 ml10">
                        <span class="fa fa-plus pr5"></span> <?=$addButton?> </a>
                </div>
                <?php } ?>
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
                                                <th class="w20">#</th>
                                                <th>Category Name</th>
                                                <th>SubCategory Name</th>
                                                <th>Description</th>
                                                <th class="w100 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=1;
                                                foreach($ItemSubCategory as $post)
                                                {
                                                ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$post->category?></td>
                                                <td><?=$post->subcategory_name?></td>
                                                <td><?=$post->description?> </td>
                                                <td class="text-center">
                                                <!-- <div class="btn-group">
                                                <a href="item_subcategory_man_index.php?name" class="btn btn-default btn-xs">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                            </div> -->
                                            <?php 
                                                if (check_role_assigned('item_sub_category', 'edit')) {
                                                    echo "<div class='btn-group'>".anchor($addPage . $post->id, '<i class="fa fa-edit"></i>', ['title'=>'Edit Item SubCategory','class' => 'btn btn-warning btn-xs', 'style' => 'float:left; margin-right:5px; margin-top:1px;']);
                                                    echo '</div>';
                                                }
                                                if (check_role_assigned('item_sub_category', 'delete')) {
                                                    echo '<div class="btn-group"><a href="#" onclick="javascript:deleteBox(' . $post->id . ')" title="Delete Item SubCategory" class="btn btn-danger btn-xs cancel "><span class="fa fa-trash-o"></span></a>';
                                                    echo '</div>';
                                                }
                                                ?>
                                                </td>
                                            </tr>

                                            <?php }?>
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
            }],
            "sScrollXInner": "100%",
            "oLanguage": {
                "sEmptyTable": "No Record(s) added yet."
            }
        });
            }else{
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
    <!-- END: PAGE SCRIPTS -->

</body>

</html>