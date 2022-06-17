<?php
$currentPage = "Quotations";
$pageBack = base_url() . "Quotations/";
$addPage = base_url() . "Quotations/add/";
$planpage = base_url() . "Quotations/plan/";
$deletePage = base_url() . "Quotations/Delete/";
$addButton = "Add";
$addChieldPage = base_url() . "Quotations/addChield/";

$PrintPage = base_url() . "Quotations/Print/";
$ItemPage = base_url() . "Item/index/";

?>
<!DOCTYPE html>
<html>
<head>
<?php
$this->load->view('Includes/head');
$this->load->view('Includes/tablecss');
?>
<style>
span
{
  cursor:pointer;
}
</style>
</head>

<body class="ecommerce-page sb-l-m">
    <div id="main">
        <?php $this->load->view('Includes/hadernav');?>
        <?php $this->load->view('Includes/sidebar');?>
        <section id="content_wrapper">
            <header id="topbar">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                        <li class="crumb-active">
                            <a href="<?=$pageBack?>">
                                <span>Quotation Management</span>
                            </a>
                        </li>
                    </ol>
                </div>
                <?php if (check_role_assigned('quotation', 'add')) {?>
                <div class="topbar-right">
                    <a href="<?=$addPage?>" class="btn btn-default btn-sm light fw600 ml10">
                        <span class="fa fa-plus pr5"></span> <?=$addButton?> </a>
                </div>
                <?php }?>
            </header>
            <div class="row">
                    <div class="col-sm-12">
            <section id="content" class="table-layout animated fadeIn">
                <div class="tray tray-center">
                    <div class="panel panel-visible" id="spy3">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <span class="glyphicon glyphicon-tasks"></span>Quotations</div>
                        </div>
                        <div class="panel-body pn">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="w20">#</th>
                                        <th>Quotation No</th>
                                        <th>Quotation Date</th>
                                        <th>Customer</th>
                                        <th>Quotation Validity</th>
                                        <th class="w150 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$i = 0;
foreach ($QuotationManagement as $post) {
    $i++;
    $quotation_date = date_create_from_format('Y-m-d', $post->quotation_date);
    $quotation_date = date_format($quotation_date, 'd/m/Y');
    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$post->quotationno?></td>
                                            <td><?=$quotation_date?></td>
                                            <td><?=$post->cid?></td>
                                            <td><?=$post->quotation_validity?></td>
                                            <td class="text-center">
                                            <?php if (check_role_assigned('quotation', 'view')) {?>
                                                <div class="btn-group">
                                                    <a href="<?php echo $PrintPage . $post->id ?>" class="btn btn-default btn-xs" id="viewDetail" target="_blank">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                </div>
                                                <?php }if (check_role_assigned('quotation', 'edit')) {?>
                                                <div class="btn-group">
                                                    <a href="<?php echo $addChieldPage . $post->id ?>" class="btn btn-default btn-xs">
                                                        R
                                                    </a>
                                                </div>
                                            <?php }if (check_role_assigned('quotation', 'edit')) {?>
                                                <div class="btn-group">
                                                    <a href="<?php echo $addPage . $post->id ?>" class="btn btn-warning btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>

                                            <?php }if (check_role_assigned('quotation', 'delete')) {
        echo '<div class="btn-group"><a href="#" onclick="javascript:deleteBox(' . $post->id . ')" title="Delete Order" class="btn btn-danger btn-xs cancel"><span class="fa fa-trash-o"></span></a>';
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
            <?php $this->load->view('Includes/footer');?>
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
            $('#datatable').dataTable({
                dom: '<"top"fl>rt<"bottom"ip>',
                 "order": [],
                "scrollX": true,
                 'columnDefs': [ {
                'targets': [-1,0], lengthChange: false,
                'orderable': false},{ type: 'date-eu', targets: 2 }],
                "sScrollXInner": "100%",
                "oLanguage": {
                "sEmptyTable": "No Record(s) added yet."
            }
        });
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

                       window.location.href="<?=$deletePage?>"+delid;

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